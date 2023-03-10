<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Application;

$request = Application::getInstance()->getContext()->getRequest();

if ($request->get("AJAX")) {
	include(Application::getDocumentRoot() . $templateFolder . '/ajax.php');
} else {
	if (!$GLOBALS["USER"]->IsAuthorized()) {
		include(Application::getDocumentRoot() . $templateFolder . '/registration.php');
	} else {
		LocalRedirect($arParams['PROFILE_URL']);
	}
}

?>