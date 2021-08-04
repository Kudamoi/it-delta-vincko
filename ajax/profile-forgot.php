<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

if ($request->isAjaxRequest()) { ?>
	<script src="<?= SITE_TEMPLATE_PATH ?>/components/bitrix/system.auth.forgotpasswd/popup.forgotpasswd/script.js"></script>
<? }

$APPLICATION->IncludeComponent(
	"bitrix:system.auth.forgotpasswd",
	"popup.forgotpasswd",
	array(
		"REGISTER_URL" => "/ajax/profile-registration.php",
		"FORGOT_URL"   => "/ajax/profile-forgot.php",
		"PROFILE_URL"  => "/personal/",
		"SHOW_ERRORS"  => "Y",
		"TIMEOUT"      => "20",
		"AUTH_URL"     => "/ajax/profile-auth.php",
	)
); ?>
