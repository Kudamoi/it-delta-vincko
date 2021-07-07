<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("page_title", "Рейтинг охранных предприятий");
$APPLICATION->SetTitle("Рейтинг охранных предприятий");
global $arChopFilter;
if (!empty($_REQUEST["city"])){$arChopFilter["PROPERTY_CITY_ID"] = (int)$_REQUEST["city"];}
if (!empty($_REQUEST["s"])){$arChopFilter["PROPERTY_CH_SERVICES"] = (int)$_REQUEST["s"];}
if (!empty($_REQUEST["object"])){$arChopFilter["PROPERTY_CH_TYPE"] = (int)$_REQUEST["object"];}
if (!empty($_REQUEST["rate"])){$arRateOrder = $_REQUEST["rate"];}
?><?
$APPLICATION->IncludeComponent(
	"vincko:news.list",
	"choplist",
	Array(
		"ACTIVE_DATE_FORMAT" => "",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("NAME","PREVIEW_TEXT",""),
		"FILTER_NAME" => "arChopFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "9",
		"IBLOCK_TYPE" => "chop",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("CH_SERVICES_PRICE","CH_MONTAZHPODKL","CH_SERVICES","CITY_ID","CHOP_ID","CH_RATING_SUM","CH_RATING_ZABOTA","CH_RATING_SPASENIE","CH_RATING_FINANCE","CH_RATING_DOGOVOR","CH_RATING_RECOMMEND","CH_RATING_SERVICES",""),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => $_REQUEST["rate"] ? "PROPERTY_CH_RATING_SUM" : "sort",
		"SORT_BY2" => "TIMESTAMP_X",
		"SORT_ORDER1" => $_REQUEST["rate"] ? $arRateOrder : "asc",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>