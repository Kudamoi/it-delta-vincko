<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application;


$request = Application::getInstance()->getContext()->getRequest();


if ($request->isAjaxRequest() && !empty($_REQUEST["USER_LOGIN"])) {

	$arUser = \Vincko\Auth::getUser(["LOGIN" => $_REQUEST["USER_LOGIN"]]);
	if($arUser) {
		$ar = $GLOBALS["USER"]->SendPhoneCode($_REQUEST["USER_LOGIN"], "SMS_USER_CONFIRM_NUMBER", "v1");
		$result = \Vincko\Auth::getError("SUCCESS_SMS");
}else{
		$result = \Vincko\Auth::getError("ERROR_SMS");

	}
	echo json_encode($result);

}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
?>