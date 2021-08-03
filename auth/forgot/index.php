<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
	<main class="container main">
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
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>