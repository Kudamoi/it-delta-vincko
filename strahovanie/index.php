<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>

	<main class="main">

		<div class="container">
			<? $APPLICATION->IncludeComponent(
				"vincko:variable.set",
				"benefits",
				array(
					"TITLE_LEFT"        => "Страхование вашей недвижимости и имущества",
					"IMG_LEFT_TOP"      => "/local/templates/v_new_template/img/insurance/scut.svg",
					"DESCRIPTION_LEFT"  => "Поможем выбрать охранную компанию по важным для вас критериям и готовое решение для безопасности вашего дома.",
					"IMG_LEFT_BOTTOM"   => "/local/templates/v_new_template/img/insurance/man.png",
					"TITLE_RIGHT"       => "Оплатите 100% стоимости полиса бонусами",
					"DESCRIPTION_RIGHT" => "Экономьте деньги на покупке полиса и сохраните нервы, будучи застрахованным",
					"BUTTON_RIGHT"      => "Получить бонусы",
					"IMG_RIGHT_BOTTOM"  => "/local/templates/v_new_template/img/insurance/gift.svg",
				),
				false
			); ?>
			<?$productID = $APPLICATION->IncludeComponent(
				"bitrix:catalog.element",
				"strahovanie",
				array(
					"ELEMENT_CODE"                    => "strakhovka-sao-reso-garantiya-na-150-000-rub",
					"IBLOCK_ID"                       => "14",
					"IBLOCK_TYPE"                     => "equipment",
					"COMPONENT_TEMPLATE"              => "strahovanie",
					"ELEMENT_ID"                      => $_REQUEST["ELEMENT_ID"],
					"SECTION_ID"                      => $_REQUEST["SECTION_ID"],
					"SECTION_CODE"                    => "",
					"SHOW_DEACTIVATED"                => "N",
					"HIDE_NOT_AVAILABLE_OFFERS"       => "N",
					"OFFERS_FIELD_CODE"               => array(
						0 => "NAME",
						1 => "PROPERTY_ILL",
						2 => "PROPERTY_MAX_PRICE",
						3 => "PROPERTY_PAYMENT_OPTIONS",
						4 => "PROPERTY_PAYMENT_PRICE",
					),
					"OFFERS_SORT_FIELD"               => "sort",
					"OFFERS_SORT_ORDER"               => "asc",
					"OFFERS_SORT_FIELD2"              => "id",
					"OFFERS_SORT_ORDER2"              => "desc",
					"OFFERS_LIMIT"                    => "0",
					"BACKGROUND_IMAGE"                => "-",
					"SECTION_URL"                     => "",
					"DETAIL_URL"                      => "",
					"SECTION_ID_VARIABLE"             => "SECTION_ID",
					"CHECK_SECTION_ID_VARIABLE"       => "N",
					"SEF_MODE"                        => "N",
					"CACHE_TYPE"                      => "A",
					"CACHE_TIME"                      => "36000000",
					"CACHE_GROUPS"                    => "Y",
					"SET_TITLE"                       => "Y",
					"SET_CANONICAL_URL"               => "N",
					"SET_BROWSER_TITLE"               => "Y",
					"BROWSER_TITLE"                   => "-",
					"SET_META_KEYWORDS"               => "Y",
					"META_KEYWORDS"                   => "-",
					"SET_META_DESCRIPTION"            => "Y",
					"META_DESCRIPTION"                => "-",
					"SET_LAST_MODIFIED"               => "N",
					"USE_MAIN_ELEMENT_SECTION"        => "N",
					"STRICT_SECTION_CHECK"            => "N",
					"ADD_SECTIONS_CHAIN"              => "Y",
					"ADD_ELEMENT_CHAIN"               => "N",
					"SHOW_SKU_DESCRIPTION"            => "N",
					"ACTION_VARIABLE"                 => "action",
					"PRODUCT_ID_VARIABLE"             => "id",
					"DISPLAY_COMPARE"                 => "N",
					"PRICE_CODE"                      => array("BASE","BONUS"),
					"USE_PRICE_COUNT"                 => "N",
					"SHOW_PRICE_COUNT"                => "1",
					"PRICE_VAT_INCLUDE"               => "Y",
					"PRICE_VAT_SHOW_VALUE"            => "N",
					"CONVERT_CURRENCY"                => "N",
					"BASKET_URL"                      => "/order-policy/",
					"USE_PRODUCT_QUANTITY"            => "N",
					"PRODUCT_QUANTITY_VARIABLE"       => "quantity",
					"ADD_PROPERTIES_TO_BASKET"        => "Y",
					"PRODUCT_PROPS_VARIABLE"          => "prop",
					"PARTIAL_PRODUCT_PROPERTIES"      => "N",
					"LINK_IBLOCK_TYPE"                => "",
					"LINK_IBLOCK_ID"                  => "",
					"LINK_PROPERTY_SID"               => "",
					"LINK_ELEMENTS_URL"               => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
					"USE_GIFTS_DETAIL"                => "Y",
					"USE_GIFTS_MAIN_PR_SECTION_LIST"  => "Y",
					"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "4",
					"GIFTS_DETAIL_HIDE_BLOCK_TITLE"   => "N",
					"GIFTS_DETAIL_BLOCK_TITLE"        => "Выберите один из подарков",
					"GIFTS_DETAIL_TEXT_LABEL_GIFT"    => "Подарок",
					"GIFTS_SHOW_DISCOUNT_PERCENT"     => "Y",
					"GIFTS_SHOW_OLD_PRICE"            => "Y",
					"GIFTS_SHOW_NAME"                 => "Y",
					"GIFTS_SHOW_IMAGE"                => "Y",

					"GIFTS_MESS_BTN_BUY"                           => "Выбрать",
					"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "4",
					"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE"   => "N",
					"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE"        => "Выберите один из товаров, чтобы получить подарок",
					"SET_STATUS_404"                               => "N",
					"SHOW_404"                                     => "N",
					"MESSAGE_404"                                  => "",
					"COMPATIBLE_MODE"                              => "Y",
					"USE_ELEMENT_COUNTER"                          => "Y",
					"DISABLE_INIT_JS_IN_COMPONENT"                 => "N",
					"SET_VIEWED_IN_COMPONENT"                      => "N",
					"TITLE_POLICY"                                 => "Доступные страховые полисы"
				),
				false
			);
			?>
		</div>
		<? $APPLICATION->IncludeComponent(
			"bitrix:main.include", "",
			[
				"AREA_FILE_SHOW" => "file",
				"EDIT_TEMPLATE"  => "",
				"PATH"           => "include/include-policy.php"
			]
		); ?>
		<? $APPLICATION->ShowViewContent('document'); ?>
		<? $APPLICATION->IncludeComponent(
			"bitrix:main.include", "",
			[
				"AREA_FILE_SHOW" => "file",
				"EDIT_TEMPLATE"  => "",
				"PATH"           => "include/for-bonuses.php"
			]
		); ?>
		<? $APPLICATION->IncludeComponent(
			"vincko:variable.set",
			"calculator",
			array(
				"IBLOCK_ID"        => 24,
				"PRODUCT_ID"      => $productID,
				"TEXT1" =>"Средняя заработная плата по городу",
				"TEXT2" =>"Москва",
				"TEXT3" =>"Тогда, при желаемом подарке в виде",
				"TEXT4" =>"(выберите из списка)",
				"NUM" =>"75000",
				"NUM_MAX" =>"200000",
				"NUM_MIN" =>"5000",
				"STEP" =>"5000",
				"MEAS" =>"руб.",
			),
			false
		); ?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "",
				"PATH" => "/include/callback.php"
			)
		);?>
	</main>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>