<?
///define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вход в личный кабинет");
?><?$APPLICATION->IncludeComponent(
	"vincko:main.auth.form",
	"vincko",
	Array(
		"AUTH_FORGOT_PASSWORD_URL" => "/password-recovery/?forgot_password=yes",
		"AUTH_REGISTER_URL" => "/reg/",
		"AUTH_SUCCESS_URL" => $_REQUEST["backurl"] ? $_REQUEST["backurl"] : "/lk/orders/"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>