<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

if ($request->isAjaxRequest()) { ?>
	<script src="<?= SITE_TEMPLATE_PATH ?>/components/bitrix/system.auth.changepasswd/popup/script.js"></script>
<? }

$APPLICATION->IncludeComponent(
	"bitrix:main.profile",
	"popup.changepasswd",
	array(
		"USER_PROPERTY_NAME"  => "",
		"SET_TITLE"           => "Y",
		"AJAX_MODE"           => "N",
		"USER_PROPERTY"       => array(),
		"SEND_INFO"           => "Y",
		"CHECK_RIGHTS"        => "Y",
		"AJAX_OPTION_JUMP"    => "N",
		"AJAX_OPTION_STYLE"   => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"REGISTER_URL"        => "/ajax/registration.php",
		"FORGOT_PASSWORD_URL" => "/ajax/forgot.php",
		"PROFILE_URL"         => "/personal/",
		"SHOW_ERRORS"         => "Y",
		"TIMEOUT"             => "20",
		"AUTH_URL"            => "/ajax/auth.php",
	)
); ?>