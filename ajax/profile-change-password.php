<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
?>

<? $APPLICATION->IncludeComponent(
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
		"REGISTER_URL" => "/ajax/profile-registration.php",
		"FORGOT_URL"   => "/ajax/profile-forgot.php",
		"PROFILE_URL"  => "/personal/",
		"SHOW_ERRORS"  => "Y",
		"TIMEOUT"      => "20",
		"AUTH_URL"     => "/ajax/profile-auth.php",
	)
); ?>