<?php

use Bitrix\Main\Page\Asset;

$Asset = Asset::getInstance();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#fff">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="shortcut icon" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/favicon.ico" type="image/x-icon">
    <link rel="icon" sizes="16x16" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/favicon-16x16.png" type="image/png">
    <link rel="icon" sizes="32x32" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/favicon-32x32.png" type="image/png">
    <link rel="apple-touch-icon" href="<?= SITE_TEMPLATE_PATH ?>/img/favicons/apple-touch-icon.png">
    <title><?= $APPLICATION->ShowTitle(); ?></title>

	<link href="<?= SITE_TEMPLATE_PATH ?>/libs/slick/slick.css" rel="stylesheet">
	<link href="<?= SITE_TEMPLATE_PATH ?>/libs/slick/slick-theme.css" rel="stylesheet">
	<link href="<?= SITE_TEMPLATE_PATH ?>/libs/select/styles/choices.css" rel="stylesheet">
	<link href="<?= SITE_TEMPLATE_PATH ?>/libs/funcy_box/jquery.fancybox.css" rel="stylesheet">
	<link href="<?= SITE_TEMPLATE_PATH ?>/libs/range/component.css" rel="stylesheet">
	<link href="<?= SITE_TEMPLATE_PATH ?>/libs/range/ion.rangeSlider.min.css" rel="stylesheet">
	<link href="<?= SITE_TEMPLATE_PATH ?>/libs/swiper/swiper.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/styles/main.css">



	<? $Asset->addJs(SITE_TEMPLATE_PATH."/libs/jquery.js");?>
	<? $Asset->addJs(SITE_TEMPLATE_PATH."/libs/slick/slick.js");?>
	<? $Asset->addJs(SITE_TEMPLATE_PATH."/libs/select/scripts/choices.js");?>
	<? $Asset->addJs(SITE_TEMPLATE_PATH."/libs/funcy_box/jquery.fancybox.js");?>
	<? $Asset->addJs(SITE_TEMPLATE_PATH."/libs/range/ion.rangeSlider.min.js");?>
	<? $Asset->addJs(SITE_TEMPLATE_PATH."/libs/swiper/swiper.min.js");?>

	<? $Asset->addJs(SITE_TEMPLATE_PATH."/libs/jquery_maskedinput/jquery.maskedinput.min.js");?>
	<? $Asset->addJs(SITE_TEMPLATE_PATH."/libs/Inputmask/jquery.inputmask.min.js");?>
	<? $Asset->addJs("https://atuin.ru/demo/ui-slider/jquery-ui.min.js");?>
	<? $Asset->addJs("https://atuin.ru/demo/ui-slider/jquery.ui.touch-punch.min.js");?>
	<? $Asset->addJs(SITE_TEMPLATE_PATH."/libs/Inputmask/jquery.inputmask.min.js");?>

	<? $Asset->addJs(SITE_TEMPLATE_PATH."/js/site.js");?>
	<? $Asset->addJs(SITE_TEMPLATE_PATH."/js/main.js");?>
	<? $Asset->addJs(SITE_TEMPLATE_PATH."/js/custom.js");?>

	<? $Asset->addJs(SITE_TEMPLATE_PATH."/site.js?v=14");?>
	<? $Asset->addJs(SITE_TEMPLATE_PATH."/js/auth.js");?>
	<? $Asset->addCss(SITE_TEMPLATE_PATH . "/css/custom.css"); ?>

    <?= $APPLICATION->ShowHead(); ?>

</head>

<body>
<div id="panel"><?= $APPLICATION->ShowPanel(); ?></div>
<header class="header">
	<div class="header__top container">
		<div class="header__top-left__block">
			<div class="header__top-menu">
				<div class="header__top-menu--burger burger-js"><span></span></div>

			</div>

			<div class="header__top-menu--open">
				<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd"
						  d="M5.91294 8.00001L1.27385e-05 13.913L2.08694 16L7.99987 10.087L13.9128 16L15.9998 13.913L10.0868 8.00001L15.9998 2.08695L13.9129 0L7.99987 5.91306L2.08693 4.40557e-05L0 2.08699L5.91294 8.00001Z"
						  fill="#005DFF"/>
				</svg>
			</div>
			<div class="header__top-logo">
				<a href="/">
					<? $APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						array(
							"AREA_FILE_SHOW"   => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE"    => "",
							"PATH"             => "/include/logo_header.php"
						)
					); ?>
				</a>
			</div>
			<div class="header__top-info">
				<? $APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					array(
						"AREA_FILE_SHOW"   => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE"    => "",
						"PATH"             => "/include/contact_header.php"
					)
				); ?>

			</div>
		</div>
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/vincko_citymodal.php"
            )
        ); ?>

		<? $APPLICATION->IncludeComponent(
			"bitrix:search.title",
			"header_search",
			array(
				"CATEGORY_0"           => array("no"),
				"CATEGORY_0_TITLE"     => "",
				"CHECK_DATES"          => "N",
				"CONTAINER_ID"         => "title-search",
				"CONVERT_CURRENCY"     => "N",
				"INPUT_ID"             => "title-search-input",
				"NUM_CATEGORIES"       => "1",
				"ORDER"                => "date",
				"PAGE"                 => "#SITE_DIR#search/index.php",
				"PREVIEW_HEIGHT"       => "75",
				"PREVIEW_TRUNCATE_LEN" => "",
				"PREVIEW_WIDTH"        => "75",
				"PRICE_CODE"           => array(),
				"PRICE_VAT_INCLUDE"    => "Y",
				"SHOW_INPUT"           => "Y",
				"SHOW_OTHERS"          => "N",
				"SHOW_PREVIEW"         => "Y",
				"TOP_COUNT"            => "5",
				"USE_LANGUAGE_GUESS"   => "Y"
			)
		); ?>

		<? $APPLICATION->IncludeComponent(
			"vincko:main.auth.form",
			"vincko",
			array(
				"AUTH_FORGOT_PASSWORD_URL" => "/auth/forgot/",
				"AUTH_REGISTER_URL"        => "/auth/",
				"AUTH_SUCCESS_URL"         => "/personal/"
			)
		); ?>


	</div>
	<div class="header__submenu">
		<div class="container">
			<div class="header__submenu-up">

				<? $APPLICATION->IncludeComponent(
					"bitrix:menu",
					"main_section",
					array(
						"ALLOW_MULTI_SELECT"    => "N",
						"CHILD_MENU_TYPE"       => "left",
						"DELAY"                 => "N",
						"MAX_LEVEL"             => "1",
						"MENU_CACHE_GET_VARS"   => array(""),
						"MENU_CACHE_TIME"       => "3600",
						"MENU_CACHE_TYPE"       => "N",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"ROOT_MENU_TYPE"        => "main_section",
						"USE_EXT"               => "N"
					)
				); ?>

				<? $APPLICATION->IncludeComponent(
					"bitrix:menu",
					"advantages",
					array(
						"ALLOW_MULTI_SELECT"    => "N",
						"CHILD_MENU_TYPE"       => "left",
						"DELAY"                 => "N",
						"MAX_LEVEL"             => "1",
						"MENU_CACHE_GET_VARS"   => array(""),
						"MENU_CACHE_TIME"       => "3600",
						"MENU_CACHE_TYPE"       => "N",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"ROOT_MENU_TYPE"        => "advantages",
						"USE_EXT"               => "N"
					)
				); ?>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "for_flats",
                    array(
                        "ALLOW_MULTI_SELECT"    => "N",
                        "CHILD_MENU_TYPE"       => "left",
                        "DELAY"                 => "N",
                        "MAX_LEVEL"             => "1",
                        "MENU_CACHE_GET_VARS"   => array(""),
                        "MENU_CACHE_TIME"       => "3600",
                        "MENU_CACHE_TYPE"       => "N",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE"        => "for_flats",
                        "USE_EXT"               => "N"
                    )
                ); ?>
				<? $APPLICATION->IncludeComponent(
					"bitrix:menu",
					"for_house",
					array(
						"ALLOW_MULTI_SELECT"    => "N",
						"CHILD_MENU_TYPE"       => "left",
						"DELAY"                 => "N",
						"MAX_LEVEL"             => "1",
						"MENU_CACHE_GET_VARS"   => array(""),
						"MENU_CACHE_TIME"       => "3600",
						"MENU_CACHE_TYPE"       => "N",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"ROOT_MENU_TYPE"        => "for_house",
						"USE_EXT"               => "N"
					)
				); ?>
				<? $APPLICATION->IncludeComponent(
					"bitrix:menu",
					"for_property",
					array(
						"ALLOW_MULTI_SELECT"    => "N",
						"CHILD_MENU_TYPE"       => "left",
						"DELAY"                 => "N",
						"MAX_LEVEL"             => "1",
						"MENU_CACHE_GET_VARS"   => array(""),
						"MENU_CACHE_TIME"       => "3600",
						"MENU_CACHE_TYPE"       => "N",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"ROOT_MENU_TYPE"        => "for_property",
						"USE_EXT"               => "N"
					)
				); ?>


			</div>

            <div class="header__submenu-down">
                <div class="header__submenu-location">
                    <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 0.5C3.0975 0.5 0.75 2.8475 0.75 5.75C0.75 9.6875 6 15.5 6 15.5C6 15.5 11.25 9.6875 11.25 5.75C11.25 2.8475 8.9025 0.5 6 0.5ZM6 7.625C5.50272 7.625 5.02581 7.42746 4.67418 7.07583C4.32254 6.7242 4.125 6.24728 4.125 5.75C4.125 5.25272 4.32254 4.77581 4.67418 4.42418C5.02581 4.07254 5.50272 3.875 6 3.875C6.49728 3.875 6.9742 4.07254 7.32583 4.42418C7.67746 4.77581 7.875 5.25272 7.875 5.75C7.875 6.24728 7.67746 6.7242 7.32583 7.07583C6.9742 7.42746 6.49728 7.625 6 7.625Z" fill="#005DFF"/>
                    </svg>

                    <a data-modal-target="#header__top-info"><?=$GLOBALS["GEOCITY"]["NAME"]?></a>
                </div>

                <div class="header__submenu-question">
                        <span class="header__submenu-question-content" >
                            Это ваш город?
                        </span>

                    <span class="header__submenu-question-yes">Да</span>
                    <a class="header__submenu-question-no">Нет, выбрать другой</a>

                </div>

                <div class="header__submenu-close">
                    Скрыть меню
                    <svg width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.39604 0.179893L7.83581 3.95144C8.05473 4.19135 8.05473 4.58034 7.83581 4.82014C7.61708 5.05995 7.26232 5.05995 7.04361 4.82014L3.99994 1.4829L0.956381 4.82004C0.737564 5.05986 0.382842 5.05986 0.164113 4.82004C-0.0547043 4.58022 -0.0547043 4.19126 0.164113 3.95134L3.60393 0.179796C3.71335 0.059887 3.8566 4.59895e-08 3.99992 4.76986e-08C4.14332 4.94086e-08 4.28668 0.0600033 4.39604 0.179893Z" fill="#A0A0A0"/>
                    </svg>

                </div>
            </div>
        </div>
    </div>
	<? $APPLICATION->IncludeComponent(
		"it-delta:iblock.content",
		"header_filter",
		array(
			"ACTIVE_DATE"        => "N",
			"ADD_CACHE_STRING"   => "",
			"CACHE_TIME"         => "0",
			"CACHE_TYPE"         => "A",
			"IBLOCK_ID"          => "20",
			"ESTATE_IB_ID"       => "19",
			"IBLOCK_TYPE"        => "references",
			"PAGE_ELEMENT_COUNT" => "10",
			"RAND_ELEMENTS"      => "N",
			"SORT_BY1"           => "ACTIVE_FROM",
			"SORT_BY2"           => "SORT",
			"SORT_ORDER1"        => "DESC",
			"SORT_ORDER2"        => "ASC"
		)
	); ?>

</header>
<div class="header__wall"></div>
<? $APPLICATION->IncludeComponent(
	"vincko:breadcrumb",
	"vincko",
	array(
		"PATH"       => "",
		"SITE_ID"    => "v1",
		"START_FROM" => "0"
	)
); ?>



