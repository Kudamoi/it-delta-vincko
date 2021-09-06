<?
//define ("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Восстановление пароля");
?>
<?$APPLICATION->IncludeComponent(
"bitrix:system.auth.forgotpasswd",
"flat",
Array("AUTH_RESULT" => $APPLICATION->arAuthResult)
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>