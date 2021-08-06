<?php

namespace Vincko;

class Auth
{

	// рандомные символы
	public static function rand_string($length)
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		return substr(str_shuffle($chars), 0, $length);
	}

	// функция генерирует пароль
	public static function generatePassword()
	{
		$password = self::rand_string(8);
		return $password;
	}

	// функция получает пользователя
	public static function getUser($field)
	{

		if ($field["USER_EMAIL"]) {
			$filter = ["EMAIL" => $field["USER_EMAIL"]];
		} else {
			$filter = ["LOGIN" => $field["USER_LOGIN"]];
		}

		$rsUsers = \CUser::GetList(
			false,
			false,
			$filter
		);

		return $rsUsers->Fetch();
	}


// функция проверяет высланный код на валидность
	public static function signedCheck($request)
	{
		$result = false;

		if (($params = \Bitrix\Main\Controller\PhoneAuth::extractData($request["SIGNED_DATA"])) !== false) {
			if (($userId = \CUser::VerifyPhoneCode($params['phoneNumber'], $request["SMS_CODE"]))) {
				$result = true;
			}
		}
		return $result;
	}

	protected static function sendSmsPassword($arUser, $password)
	{

		$fields = array(
			'USER_PHONE'    => $arUser["LOGIN"],
			'USER_PASSWORD' => $password,
		);
		// отправляем СМС
		$sms = new \Bitrix\Main\Sms\Event('SEND_SMS_USER_SUCSESS_RESTORE_PASSWORD', $fields);
		$sms->setSite('v1');
		$sms->setLanguage('ru');
		$sms->send();
	}

	// функция генерирует ошибки при заполнении формы регистрации, включает пользователя
	public static function registration($request, $arAuthResult)
	{
		// проверяем существует ли пользователь
		$arUser = self::getUser($request);
		if ($request["Register"] == 1) {
			if (!empty($request["USER_AGREEMENT"]) && !empty($arUser)) {
				if ($arUser["ACTIVE"] != "Y") {
					$password = self::generatePassword();
					self::sendSmsPassword($arUser, $password);
					$user = new \CUser;
					$user->Update($arUser["ID"],
						[
							"ACTIVE"           => "Y",
							"PASSWORD"         => $password,
							"CONFIRM_PASSWORD" => $password
						]);
					$arAuthResult["ERROR"] = "OK";
					$arAuthResult["MESSAGE"] = "На ваш номер было выслано смс с паролем";
				}
			}
		} else {
			// если в возвращаемом результате есть ошибка
			if ($arAuthResult["TYPE"] == "ERROR") {
				if ($arUser) {
					$arAuthResult["FIELD"] = "USER_LOGIN";
					$arAuthResult["MESSAGE"] = "Пользователь с таким номером существует";
				}
			}
		}

		return json_encode($arAuthResult);
	}

// функция проверяетна соответсвие введеного пароля с текущим
	public
	static function checkPassword($request)
	{
		$userData = \CUser::GetByID($request['ID'])->Fetch();
		$checkOldPassword = \Bitrix\Main\Security\Password::equals($userData['PASSWORD'], $_REQUEST['PASSWORD']);
		return $checkOldPassword;
	}

// функция генерирует ошибки при изменении пароля зарегистрированного пользователя
	public
	static function changepasswd($request)
	{
		$result = [
			"TYPE" => "ERROR"
		];
		// проверяем авторизован ли пользователь
		if ($GLOBALS["USER"]->isAuthorized()) {
			// проверяем старый пароль
			$checkOldPassword = self::checkPassword($request);
			if ($checkOldPassword) {
				if ($request["NEW_PASSWORD"] != $request["NEW_PASSWORD_CONFIRM"]) {
					$result = [
						"TYPE"    => "ERROR",
						"MESSAGE" => "Пароль отличается от введенного в предыдущем поле",
						"FIELD"   => "NEW_PASSWORD_CONFIRM"
					];
				} else {
					$result = [
						"TYPE"    => "OK",
						"MESSAGE" => "Пароль успешно изменен",
					];
				}
			} else {
				$result = [
					"TYPE"    => "ERROR",
					"MESSAGE" => "Текущий пароль не подходит",
					"FIELD"   => "PASSWORD"
				];
			}

		} else {
			$result = [
				"TYPE"    => "ERROR",
				"MESSAGE" => "Пользователь не авторизован",
				"EVENT"   => "FORGOT"
			];
		}
		return json_encode($result);
	}

	// функция генерирует ошибки авторизации пользователя
	public
	static function authh($request)
	{

	$return = $GLOBALS["USER"]->Login(strip_tags($request['USER_LOGIN']),strip_tags($request['USER_PASSWORD']),($request['USER_REMEMBER'] == "Y" ? $request['USER_REMEMBER'] : "N"));

		if (empty($return['MESSAGE'])) {
			$result = [
				"TYPE" => "OK",
			];
		} else {
			$rsUser = \CUser::GetByLogin(strip_tags($request['USER_LOGIN']));
			if ($arUser = $rsUser->Fetch()) {
				$result = [
					"TYPE"    => "ERROR",
					"MESSAGE" => "Неверный пароль",
					"FIELD"   => "USER_PASSWORD"
				];
			} else {
				$result = [
					"TYPE"    => "ERROR",
					"MESSAGE" => "Пользователь с текущем номером не существует",
					"FIELD"   => "USER_LOGIN"
				];
			}
		}


		return json_encode($result);
	}
}
