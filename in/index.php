<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вход в личный кабинет");
?><?$APPLICATION->IncludeComponent(
	"vincko:main.auth.form",
	"vincko",
	Array(
		"AUTH_FORGOT_PASSWORD_URL" => "",
		"AUTH_REGISTER_URL" => "/reg/",
		"AUTH_SUCCESS_URL" => $_REQUEST["backurl"]
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>