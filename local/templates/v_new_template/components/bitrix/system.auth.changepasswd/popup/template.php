<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Application;
use Bitrix\Main\Localization\Loc;

$request = Application::getInstance()->getContext()->getRequest();

if ($request->getPost("AJAX")) {
	include(Application::getDocumentRoot() . $templateFolder . '/ajax.php');
} else {
	if (!$GLOBALS["USER"]->IsAuthorized()) {
		LocalRedirect("/auth/");
	} else {
		include(Application::getDocumentRoot() . $templateFolder . '/changepasswd.php');
	}

}

?>