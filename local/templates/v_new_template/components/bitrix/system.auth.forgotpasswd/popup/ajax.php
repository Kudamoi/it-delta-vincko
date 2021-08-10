<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->RestartBuffer();

header('Content-type: application/json');
<? $fullName = (!empty($GLOBALS["USER"]->GetFullName())? ", " . $GLOBALS["USER"]->GetFullName() : "" );?>
						<?= str_replace("#NAME#", $fullName, Loc::getMessage("CHANGE_HELLO"))?>
echo \Vincko\Auth::forgot($_REQUEST, $APPLICATION->arAuthResult, $arResult);


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
?>