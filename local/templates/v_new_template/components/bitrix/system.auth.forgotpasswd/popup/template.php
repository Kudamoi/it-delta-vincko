<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Application;



$request = Application::getInstance()->getContext()->getRequest();

if ($request->getPost("AJAX")) {
/*	if(!empty($arResult["LAST_LOGIN"])){
		include(Application::getDocumentRoot() . $templateFolder . '/chagepasswd.php');
	}else {*/
		include(Application::getDocumentRoot() . $templateFolder . '/ajax.php');
	//}
}else {
	if (!$GLOBALS["USER"]->IsAuthorized()) {
		include(Application::getDocumentRoot() . $templateFolder . '/forgot.php');
	} else {
		LocalRedirect($arParams['PROFILE_URL']);
	}
}
?>