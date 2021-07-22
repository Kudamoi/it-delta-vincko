<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Комплекты оборудования");
?>

<?$APPLICATION->IncludeComponent(
        "vincko:catalog.element",
        "equipitem",
        array(
            "ACTION_VARIABLE" => "action",
            "ADD_DETAIL_TO_SLIDER" => "N",
            "ADD_ELEMENT_CHAIN" => "Y",
            "ADD_PICT_PROP" => "-",
            "ADD_PROPERTIES_TO_BASKET" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "ADD_TO_BASKET_ACTION" => array(),
            "ADD_TO_BASKET_ACTION_PRIMARY" => array("BUY"),
            "BACKGROUND_IMAGE" => "-",
            "BASKET_URL" => "",
            "BRAND_USE" => "N",
            "BROWSER_TITLE" => "-",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_SECTION_ID_VARIABLE" => "Y",
            "COMPATIBLE_MODE" => "Y",
            "CONVERT_CURRENCY" => "N",
            "DETAIL_PICTURE_MODE" => array(),
            "DETAIL_URL" => "",
            "DISABLE_INIT_JS_IN_COMPONENT" => "N",
            "DISPLAY_COMPARE" => "N",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PREVIEW_TEXT_MODE" => "E",
            "ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],
            "ELEMENT_ID" => "",
            "GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
            "GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
            "GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "4",
            "GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
            "GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
            "GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
            "GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "4",
            "GIFTS_MESS_BTN_BUY" => "Выбрать",
            "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
            "GIFTS_SHOW_IMAGE" => "Y",
            "GIFTS_SHOW_NAME" => "Y",
            "GIFTS_SHOW_OLD_PRICE" => "Y",
            "HIDE_NOT_AVAILABLE_OFFERS" => "N",
            "IBLOCK_ID" => "11",
            "IBLOCK_TYPE" => "equipment",
            "IMAGE_RESOLUTION" => "1by1",
            "LABEL_PROP" => array(),
            "LABEL_PROP_MOBILE" => array(),
            "LABEL_PROP_POSITION" => "top-left",
            "LINK_ELEMENTS_URL" => "",
            "LINK_IBLOCK_ID" => "",
            "LINK_IBLOCK_TYPE" => "",
            "LINK_PROPERTY_SID" => "",
            "MAIN_BLOCK_PROPERTY_CODE" => array("CO_BRAND_REF", "CO_OPTIONS", "CO_CLASS_REF"),
            "MESSAGE_404" => "",
            "MESS_BTN_ADD_TO_BASKET" => "В корзину",
            "MESS_BTN_BUY" => "Купить",
            "MESS_BTN_SUBSCRIBE" => "Подписаться",
            "MESS_COMMENTS_TAB" => "Комментарии",
            "MESS_DESCRIPTION_TAB" => "Описание",
            "MESS_NOT_AVAILABLE" => "Нет в наличии",
            "MESS_PRICE_RANGES_TITLE" => "Цены",
            "MESS_PROPERTIES_TAB" => "Характеристики",
            "META_DESCRIPTION" => "-",
            "META_KEYWORDS" => "-",
            "OFFERS_LIMIT" => "0",
            "PARTIAL_PRODUCT_PROPERTIES" => "N",
            "PRICE_CODE" => array("BASE"),
            "PRICE_VAT_INCLUDE" => "N",
            "PRICE_VAT_SHOW_VALUE" => "N",
            "PRODUCT_ID_VARIABLE" => "id",
            "PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
            "PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
            "PRODUCT_PROPS_VARIABLE" => "prop",
            "PRODUCT_QUANTITY_VARIABLE" => "quantity",
            "PRODUCT_SUBSCRIPTION" => "N",
            "SECTION_CODE" => "",
            "SECTION_CODE_PATH" => "",
            "SECTION_ID" => "33",
            "SECTION_ID_VARIABLE" => "",
            "SECTION_URL" => "",
            "SEF_MODE" => "Y",
            "SEF_RULE" => "/komplekty-oborudovaniya/#ELEMENT_CODE#/",
            "SET_BROWSER_TITLE" => "Y",
            "SET_CANONICAL_URL" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "Y",
            "SET_META_KEYWORDS" => "Y",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "Y",
            "SET_VIEWED_IN_COMPONENT" => "N",
            "SHOW_404" => "N",
            "SHOW_CLOSE_POPUP" => "N",
            "SHOW_DEACTIVATED" => "N",
            "SHOW_DISCOUNT_PERCENT" => "N",
            "SHOW_MAX_QUANTITY" => "N",
            "SHOW_OLD_PRICE" => "Y",
            "SHOW_PRICE_COUNT" => "1",
            "SHOW_SLIDER" => "N",
            "STRICT_SECTION_CHECK" => "N",
            "TEMPLATE_THEME" => "blue",
            "USE_COMMENTS" => "N",
            "USE_ELEMENT_COUNTER" => "Y",
            "USE_ENHANCED_ECOMMERCE" => "N",
            "USE_GIFTS_DETAIL" => "N",
            "USE_GIFTS_MAIN_PR_SECTION_LIST" => "N",
            "USE_MAIN_ELEMENT_SECTION" => "N",
            "USE_PRICE_COUNT" => "N",
            "USE_PRODUCT_QUANTITY" => "N",
            "USE_RATIO_IN_RANGES" => "N",
            "USE_VOTE_RATING" => "N"
        )
    );

?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>