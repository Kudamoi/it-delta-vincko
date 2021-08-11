<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application;


$request = Application::getInstance()->getContext()->getRequest();


if ($request->isAjaxRequest()) {
	$signedCheck = \Vincko\Auth::signedCheck($_REQUEST);
	if ($signedCheck) {
		$result = \Vincko\Auth::getError("SUCCESS");
	} else {
		$result = \Vincko\Auth::getError("BAD_CHECKWORD_PHONE");
	}

	echo json_encode($result);

}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
?>