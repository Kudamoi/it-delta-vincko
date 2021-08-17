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

		if (empty($field["EMAIL"]) && empty($field["PHONE"]) && empty($field["LOGIN"])) {
			return false;
		}

		if (!empty($field["EMAIL"])) {
			$rsUser = \CUser::GetList(
				false,
				false,
				["EMAIL" => $field["EMAIL"]]
			);
		} elseif (!empty($field["PHONE"])) {
			// нормализуем номер телефона
			$phone = \Bitrix\Main\UserPhoneAuthTable::normalizePhoneNumber($field["PHONE"]);
			// выборка пользователя с подтвержденным номером, если пользователь не подтвержден,
			// значит пароль ему не высылался или возникла какая то проблема, тогда он пойдет по этапу восстановления пароля
			$user = \Bitrix\Main\UserPhoneAuthTable::getList([
				'filter' => [
					'PHONE_NUMBER' => $phone,
				]
			]);
			if ($row = $user->fetch()) {
				$rsUser = \CUser::GetByID($row['USER_ID']); // найдем пользователя по ID
			}
		} else {
			$rsUser = \CUser::GetList(
				false,
				false,
				["LOGIN" => $field["LOGIN"]]
			);
		}

		return (!empty($rsUser)? $rsUser->Fetch() : false );
	}


// функция проверяет высланный код на валидность
	public static function signedCheck($request)
	{
		$result = false;
		$request["SIGNED_DATA"] = \Bitrix\Main\Controller\PhoneAuth::signData(['phoneNumber' => $request['USER_LOGIN']]);
        $smsCode = (!empty($request["SMS_CODE"])? $request["SMS_CODE"] : $request["USER_CHECKWORD"]);
		if (($params = \Bitrix\Main\Controller\PhoneAuth::extractData($request["SIGNED_DATA"])) !== false) {
			if (($userId = \CUser::VerifyPhoneCode($params['phoneNumber'], $smsCode))) {
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

// функция проверяетна соответсвие введеного пароля с текущим
	public
	static function checkPassword($request)
	{
		$userData = \CUser::GetByID($request['ID'])->Fetch();
		$checkOldPassword = \Bitrix\Main\Security\Password::equals($userData['PASSWORD'], $_REQUEST['PASSWORD']);
		return $checkOldPassword;
	}

	// функция получает ошибку
	public static function getError($event, $arAuthResult = [], $arResult = [])
	{
		switch ($event) {
			case "PHONE_REGISTERED":
				$result = [
					"TYPE"    => "ERROR",
					"MESSAGE" => "Пользователь с таким номером телефона был ранее зарегистрирован.",
					"FIELD"   => "USER_LOGIN"
				];
				break;
			case "PHONE_NOT_REGISTERED":
				$result = [
					"TYPE"    => "ERROR",
					"MESSAGE" => "Извините, пользователь с таким номером телефона не зарегистрирован. Проверьте правильность ввода номера.",
					"FIELD"   => "USER_LOGIN"
				];
				break;
			case "EMAIL_NOT_REGISTERED":
				$result = [
					"TYPE"    => "ERROR",
					"MESSAGE" => "Извините, пользователь с таким e-mail не зарегистрирован. Проверьте правильность ввода e-mail.",
					"FIELD"   => "USER_EMAIL"
				];
				break;
			case "BAD_CHECKWORD_PHONE":
				$result = [
					"TYPE"    => "ERROR",
					"MESSAGE" => "Проверьте правильность введенного кода или запросите SMS с кодом повторно",
					"FIELD"   => "CHECKWORD"
				];
				break;
			case "BAD_CHECKWORD_EMAIL":
				$result = [
					"TYPE"    => "ERROR",
					"MESSAGE" => "Неверный проверочный код",
					"FIELD"   => "CHECKWORD"
				];
				break;
			case "CONFIRM_PASSWORD":
				$result = [
					"TYPE"    => "ERROR",
					"MESSAGE" => "Проли не совпадают",
					"FIELD"   => "USER_CONFIRM_PASSWORD"
				];
				break;
			case "USER_PASSWORD":
				$result = [
					"TYPE"    => "ERROR",
					"MESSAGE" => "Неверный пароль",
					"FIELD"   => "USER_PASSWORD"
				];
				break;
			case "GET_SMS":
				$result = [
					"TYPE"    => "ERROR",
					"MESSAGE" => "Для регистрации необходимо получить код",
					"FIELD"   => "CHECKWORD"
				];
				break;
			case "ERROR_SMS":
				$result = [
					"TYPE"    => "ERROR",
					"MESSAGE" => "Ошибка отправки смс",
					"FIELD"   => "CHECKWORD"
				];
				break;
			case "SUCCESS":
				$result = [
					"TYPE"    => "OK",
					"MESSAGE" => "",
					"RESULT"  => $arResult
				];
				break;
			case "SUCCESS_SMS":
				$result = [
					"TYPE"    => "OK",
					"MESSAGE" => "На ваш номер было выслано смс с паролем",
					"RESULT"  => $arResult
				];
				break;
			default:
				$result = $arAuthResult;
		}


		return $result;
	}

	// функция генерирует ошибки при заполнении формы регистрации, включает пользователя
	public static function registration($request, $arAuthResult)
	{
		// проверяем существует ли пользователь
		$arUser = self::getUser(["PHONE" => $_REQUEST["USER_LOGIN"]]);
		if ($request["Register"] == 1) {
			if ($arUser && $arUser["ACTIVE"] != "Y") {
				$password = self::generatePassword();
				self::sendSmsPassword($arUser, $password);
				$user = new \CUser;
				$user->Update($arUser["ID"],
					[
						"ACTIVE"           => "Y",
						"PASSWORD"         => $password,
						"CONFIRM_PASSWORD" => $password
					]);
				$result = self::getError("SUCCESS_SMS");
			} elseif (empty($_REQUEST["SMS_CODE"])) {
				$result = self::getError("GET_SMS");
			}
		} elseif ($request["code_submit_button"] == 1) {
			if ($arUser && $arAuthResult["TYPE"] == "ERROR") {
				$result = self::getError("PHONE_REGISTERED");
			}
		}

		if (empty($result)) {
			if ($arAuthResult["TYPE"] == "ERROR") {
				$result = $arAuthResult;
			} else {
				$result = self::getError("SUCCESS");
			}
		}

		return json_encode($result);
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

			if ($request["NEW_PASSWORD"] != $request["NEW_PASSWORD_CONFIRM"]) {
				$result = [
					"TYPE"    => "ERROR",
					"MESSAGE" => "Пароли не совпадают, проверьте правильность ввода пароля",
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
				"MESSAGE" => "Пользователь не авторизован",
				"EVENT"   => "FORGOT"
			];
		}
		return json_encode($result);
	}

	// функция генерирует ошибки авторизации пользователя
	public
	static function auth($request)
	{
		$arUser = self::getUser(["PHONE" => strip_tags($request["USER_LOGIN"])]);
		$return = $GLOBALS["USER"]->Login($arUser['LOGIN'], strip_tags($request['USER_PASSWORD']), ($request['USER_REMEMBER'] == "Y" ? $request['USER_REMEMBER'] : "N"));

		if (empty($return['MESSAGE'])) {
			$result = self::getError("SUCCESS");
		} else {
			if ($arUser) {
				$result = self::getError("USER_PASSWORD");
			} else {
				$result = self::getError("PHONE_NOT_REGISTERED");
			}
		}


		return json_encode($result);
	}

	// функция генерирует ошибки при изменении пароля зарегистрированного пользователя
	public static function forgot($request, $arAuthResult, $arResult)
	{

		if (!empty($request["USER_EMAIL"]) || !empty($request["USER_LOGIN"])) {
			// получаем пользователя
			if (!empty($request["USER_EMAIL"])) {
				$field = ["EMAIL" => $request["USER_EMAIL"]];
			} elseif (!empty($request["USER_PHONE_NUMBER"])) {
				$field = ["PHONE" => $request["USER_PHONE_NUMBER"]];
			} else {
				$field = ["LOGIN" => $request["USER_LOGIN"]];
			}
			$arUsers = self::getUser($field);
		}

		if ($arUsers) {
			if ($request["USER_PASSWORD"] != $request["USER_CONFIRM_PASSWORD"]) {
				$result = self::getError("CONFIRM_PASSWORD");
			}
		} else {

			if (!empty($request["USER_EMAIL"])) {
				$result = self::getError("EMAIL_NOT_REGISTERED");
			} elseif (!empty($request["USER_LOGIN"])) {
				$result = self::getError("PHONE_NOT_REGISTERED");
			}
		}

		if ($request["code_check_submit_button"] == 1) {
			$result = self::getError("SUCCESS", [], $arResult);
		}

		if (empty($result)) {
			if ($arAuthResult["TYPE"] == "ERROR") {
				if (!empty($request["USER_CHECKWORD"]) && $arUsers) {
					if (!empty($request["USER_CHECKWORD_SMS"])) {
						$result = self::getError("BAD_CHECKWORD_PHONE");
					} else {
						$result = self::getError("BAD_CHECKWORD_EMAIL");
					}
				} else {
					$result = $arAuthResult;
				}
			} else {
				$result = self::getError("SUCCESS", [], $arResult);
			}
		}

		return json_encode($result);
	}

}

