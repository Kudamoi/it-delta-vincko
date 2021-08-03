<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->RestartBuffer();

header('Content-type: application/json');

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





if (!empty($APPLICATION->arAuthResult)) {
	//echo json_encode($APPLICATION->arAuthResult);
}
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
?>