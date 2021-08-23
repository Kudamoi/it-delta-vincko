<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<main class="main norating" xmlns="http://www.w3.org/1999/html">
    <? $arrFilter =  array("ID" => $_GET['COMPANY']);?>
    <? $APPLICATION->IncludeComponent(
	"it-delta:iblock.content", 
	"company_detail", 
	array(
		"ACTIVE_DATE" => "N",
		"ADD_CACHE_STRING" => "",
		"CACHE_TIME" => "0",
		"CACHE_TYPE" => "A",
		"FILTER_NAME" => "arrFilter",
		"IBLOCK_ID" => "9",
		"IBLOCK_TYPE" => "chop",
		"PAGE_ELEMENT_COUNT" => "10",
		"RAND_ELEMENTS" => "N",
		"SORT_BY1" => "",
		"SORT_BY2" => "",
		"SORT_ORDER1" => "",
		"SORT_ORDER2" => "",
		"COMPONENT_TEMPLATE" => "company_detail"
	),
	false
); ?>
    <? $APPLICATION->IncludeComponent(
        "it-delta:iblock.content",
        "rating_guarantee",
        array(
            "ACTIVE_DATE" => "N",
            "ADD_CACHE_STRING" => "",
            "CACHE_TIME" => "0",
            "CACHE_TYPE" => "A",
            "FILTER_NAME" => "arrFilter1",
            "IBLOCK_ID" => "48",
            "IBLOCK_TYPE" => "Articles",
            "PAGE_ELEMENT_COUNT" => "10",
            "RAND_ELEMENTS" => "N",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC"
        )
    ); ?>
    <? $APPLICATION->IncludeComponent(
        "it-delta:iblock.content",
        "rating_open_for_yourself",
        array(
            "ACTIVE_DATE" => "N",
            "ADD_CACHE_STRING" => "",
            "CACHE_TIME" => "0",
            "CACHE_TYPE" => "A",
            "FILTER_NAME" => "arrFilter1",
            "IBLOCK_ID" => "47",
            "IBLOCK_TYPE" => "Articles",
            "PAGE_ELEMENT_COUNT" => "10",
            "RAND_ELEMENTS" => "N",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC"
        )
    ); ?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "PATH" => "/include/callback.php"
        )
    ); ?>

</main>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

