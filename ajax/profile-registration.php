<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
?>
<?php
$APPLICATION->IncludeComponent(
	"bitrix:system.auth.registration",
	"popup",
	array(
		"REGISTER_URL" => "/ajax/profile-registration.php",
		"FORGOT_URL"   => "/ajax/profile-forgot.php",
		"PROFILE_URL"  => "/personal/",
		"SHOW_ERRORS"  => "Y",
		"TIMEOUT"      => "20",
		"AUTH_URL"     => "/ajax/profile-auth.php",
	)
); ?>