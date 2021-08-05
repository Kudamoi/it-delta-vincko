<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
	<main class="container main">
		<? $APPLICATION->IncludeComponent(
			"bitrix:system.auth.changepasswd",
			"",
			array(
				"REGISTER_URL" => "/ajax/profile-registration.php",
				"FORGOT_URL"   => "/ajax/profile-forgot.php",
				"PROFILE_URL"  => "/personal/",
				"SHOW_ERRORS"  => "Y",
				"TIMEOUT"      => "20",
				"AUTH_URL"     => "/ajax/profile-auth.php",
			)
		); ?>

		<? $APPLICATION->IncludeComponent(
			"bitrix:system.auth.forgotpasswd",
			"",
			array(
				"REGISTER_URL" => "/ajax/profile-registration.php",
				"FORGOT_URL"   => "/ajax/profile-forgot.php",
				"PROFILE_URL"  => "/personal/",
				"SHOW_ERRORS"  => "Y",
				"TIMEOUT"      => "20",
				"AUTH_URL"     => "/ajax/profile-auth.php",
			)
		); ?>
		<? // TODO нужно выяснить как должна выглядеть страница авторизации, если не в попапе создать шаблон?>
		<? $APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			array(
				"AREA_FILE_SHOW"   => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE"    => "",
				"PATH"             => "/ajax/forgot.php"
			),
			false,
			array(
				"HIDE_ICONS" => "Y"
			)
		); ?>
	</main>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>