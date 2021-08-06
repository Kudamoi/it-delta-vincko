<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

if ($request->isAjaxRequest()) { ?>
	<script src="<?= SITE_TEMPLATE_PATH ?>/components/bitrix/system.auth.form/popup/script.js"></script>
<? }

$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form",
	"popup",
	array(
		"REGISTER_URL"        => "/ajax/registration.php",
		"FORGOT_URL" => "/ajax/forgot.php",
		"PROFILE_URL"         => "/personal/",
		"SHOW_ERRORS"         => "Y",
		"TIMEOUT"             => "20",
		"AUTH_URL"            => "/ajax/auth.php",
	)
); ?>