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
	protected static function signedCheck($request)
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
	public
	static function registration($request, $arAuthResult)
	{
		// проверяем существует ли пользователь
		$arUser = self::getUser($request);
		// если в возвращаемом результате есть ошибка
		if ($arAuthResult["TYPE"] == "ERROR") {

			if (!$arUser) {
				$arAuthResult["FIELD"] = "USER_LOGIN";
				$arAuthResult["MESSEGE"] = "Пользователь существует";
			}
		} else {

			if ($request["Register"] == 1) {
				$signedCheck = self::signedCheck($request);
				if ($signedCheck && !empty($request["USER_AGREEMENT"]) && $arUser) {
					if($arUser["ACTIVE"]!="Y") {
						$password = self::generatePassword();
						self::sendSmsPassword($arUser, $password);
						\CUser::Update($arUser["ID"],
							[
								"ACTIVE"           => "Y",
								"PASSWORD"         => $password,
								"CONFIRM_PASSWORD" => $password
							]);
					}
				}
			}
		}
		return json_encode($request);
	}
}
