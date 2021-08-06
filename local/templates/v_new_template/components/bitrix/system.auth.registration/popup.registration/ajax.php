<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->RestartBuffer();

header('Content-type: application/json');

echo Vincko\Auth::registration($_REQUEST, $APPLICATION->arAuthResult);

	require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
?>