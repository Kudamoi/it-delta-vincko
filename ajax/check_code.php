<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application;


$request = Application::getInstance()->getContext()->getRequest();


if ($request->isAjaxRequest()) {
	$signedCheck = \Vincko\Auth::signedCheck($_REQUEST);
	if ($signedCheck) {
		$result = [
			"TYPE"    => "OK",
			"MESSAGE" => ""
		];
	} else {
		$result = [
			"TYPE"    => "ERROR",
			"MESSAGE" => "Неверный код",
			"FIELD"   => "SMS_CODE"
		];
	}

	echo json_encode($result);

}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
?>