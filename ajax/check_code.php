<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application;


$request = Application::getInstance()->getContext()->getRequest();


if ($request->isAjaxRequest()) {

	if($_REQUEST["SIGNED_DATA"] <> '')
	{
		$result = [
			"TYPE" => "ERROR",
			"MESSAGE" => "Неверный код"
		];

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

}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
?>