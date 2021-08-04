<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->RestartBuffer();

header('Content-type: application/json');

echo json_encode($APPLICATION->arAuthResult);

/*
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_REQUEST["code_submit_button"] <> '' && !$USER->IsAuthorized())
{
	$result = [
		"TYPE" => "ERROR",
		"MESSAGE" => "Неверный код"
	];

	if($_REQUEST["SIGNED_DATA"] <> '')
	{
		if(($params = \Bitrix\Main\Controller\PhoneAuth::extractData($_REQUEST["SIGNED_DATA"])) !== false)
		{
			if(($userId = CUser::VerifyPhoneCode($params['phoneNumber'], $_REQUEST["SMS_CODE"])))
			{
				$result = [
					"TYPE" => "OK",
					"MESSAGE" => ""
				];
			}}}

	echo json_encode($result);
}else{
	echo '{
	"MESSAGE": "На ваш номер было выслано СМС с кодом подтверждения.",
    "TYPE": "OK",
    "SIGNED_DATA": "YToxOntzOjExOiJwaG9uZU51bWJlciI7czoxMjoiKzc5MTc2NjkyMDEyIjt9.4161c6a160573de00cd7d967a7b46052414d0f25213b4f727e8514a6776ad30f",
    "ID": 62
}';
}

/*
 * 	<div class="info-popup">
							<div class="info-popup__wrapper">
								<div class="info-popup__sign">
									<svg width="18" height="18" viewBox="0 0 18 18" fill="none"
										 xmlns="http://www.w3.org/2000/svg">
										<path d="M8.99996 17.3333C4.40496 17.3333 0.666626 13.595 0.666626 8.99998C0.666626 4.40498 4.40496 0.666645 8.99996 0.666645C13.595 0.666645 17.3333 4.40498 17.3333 8.99998C17.3333 13.595 13.595 17.3333 8.99996 17.3333ZM9.83329 4.83331H8.16663V9.83331H9.83329V4.83331ZM9.83329 11.5H8.16663V13.1666H9.83329V11.5Z"
											  fill="#FF3232"/>
									</svg>
								</div>
								<div class="info-popup__text">
									Извините, пользователь с таким номером телефона не зарегистрирован. Проверьте
									правильность ввода номера.
								</div>
							</div>
						</div>*/


	require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
?>