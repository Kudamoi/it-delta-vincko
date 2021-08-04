<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "EDIT_TEMPLATE" => "",
        "PATH" => "/include/rating/top.php"
    )
);?>

<?
$dbchops = CIBlockElement::GetList(
    array(),
    array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "PROPERTY_CITY_ID" => $_COOKIE["selected_city"], "NAME" => $_POST["city"] ? : ""),
    false,
    false,
    array("ID")
);

while($chop = $dbchops->GetNext()){
    $chopList[] = $chop["ID"];
}

$raitingFilter = array(
    "ID" => $chopList
);

$APPLICATION->IncludeComponent(
    "it-delta:iblock.content", 
	"raiting_reputation_rating", 
	array(
		"ACTIVE_DATE" => "N",
		"ADD_CACHE_STRING" => "",
		"CACHE_TIME" => "0",
		"CACHE_TYPE" => "A",
		"FILTER_NAME" => "raitingFilter",
		"IBLOCK_ID" => "9",
		"IBLOCK_TYPE" => "chop",
		"PAGE_ELEMENT_COUNT" => "16",
		"RAND_ELEMENTS" => "N",
		"SORT_BY1" => "PROPERTY_69",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"COMPONENT_TEMPLATE" => "raiting_reputation_rating"
	),
	false
);
?>

<?$APPLICATION->IncludeComponent(
	"it-delta:iblock.content", 
	"rating_how_useful", 
	array(
		"ACTIVE_DATE" => "N",
		"ADD_CACHE_STRING" => "",
		"CACHE_TIME" => "0",
		"CACHE_TYPE" => "A",
		"FILTER_NAME" => "",
		"IBLOCK_ID" => "54",
		"IBLOCK_TYPE" => "Articles",
		"PAGE_ELEMENT_COUNT" => "3",
		"RAND_ELEMENTS" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"COMPONENT_TEMPLATE" => "rating_how_useful"
	),
	false
);?>


<?$APPLICATION->IncludeComponent(
    "it-delta:iblock.content",
    "rating_forming",
    Array(
        "ACTIVE_DATE" => "N",
        "ADD_CACHE_STRING" => "",
        "CACHE_TIME" => "0",
        "CACHE_TYPE" => "A",
        "FILTER_NAME" => "arrFilter1",
        "IBLOCK_ID" => "46",
        "IBLOCK_TYPE" => "Articles",
        "PAGE_ELEMENT_COUNT" => "10",
        "RAND_ELEMENTS" => "N",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "ASC"
    )
);?>
<?$APPLICATION->IncludeComponent(
    "it-delta:iblock.content",
    "rating_open_for_yourself",
    Array(
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
);?>

<?$APPLICATION->IncludeComponent(
    "it-delta:iblock.content",
    "rating_tasks",
    Array(
        "ACTIVE_DATE" => "N",
        "ADD_CACHE_STRING" => "",
        "CACHE_TIME" => "0",
        "CACHE_TYPE" => "A",
        "FILTER_NAME" => "arrFilter1",
        "IBLOCK_ID" => "34",
        "IBLOCK_TYPE" => "references",
        "PAGE_ELEMENT_COUNT" => "10",
        "RAND_ELEMENTS" => "N",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "ASC"
    )
);?>

<?$APPLICATION->IncludeComponent(
    "it-delta:iblock.content",
    "rating_guarantee",
    Array(
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
);?>

<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => "/include/questions.php"
    )
);?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
