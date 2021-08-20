<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$APPLICATION->ShowAjaxHead();

$arSelect = array("IBLOCK_ID" => 9, "ACTIVE" => "Y");

$mark = (float) $_POST['MARK'];

if($mark >= 2 && $mark < 4) {
    $arSelect["<=PROPERTY_CH_RATING_SUM"] = 1.7;
} elseif ($mark >= 4 && $mark < 7) {
    $arSelect[">=PROPERTY_CH_RATING_SUM"] = 1.8;
    $arSelect["<=PROPERTY_CH_RATING_SUM"] = 3.3;
} elseif ($mark >= 7) {
    $arSelect[">=PROPERTY_CH_RATING_SUM"] = 3.4;
    $arSelect["<=PROPERTY_CH_RATING_SUM"] = 5;
}

if(isset($_REQUEST['CITY'])) {
    $arSelect["PROPERTY_CITY_ID"] = $_REQUEST['CITY'];
}
if(isset($_POST['OBJECT'])) {
    $arSelect['PROPERTY_CH_TYPE'] = $_POST['OBJECT'];
}

$dbchops = CIBlockElement::GetList(
    array(),
    $arSelect,
    false,
    false,
    array("ID")
);
while ($chop = $dbchops->GetNext()) {
    $chopList[] = $chop["ID"];
}

$raitingFilter = array(
    "ID" => $chopList
);
empty($raitingFilter['ID'])? $raitingFilter['ID'] = -1:'';

$APPLICATION->IncludeComponent(
    "it-delta:iblock.content",
    "rating_reputation_rating_filter",
    array(
        "ACTIVE_DATE" => "N",
        "ADD_CACHE_STRING" => "",
        "CACHE_TIME" => "0",
        "CACHE_TYPE" => "A",
        "FILTER_NAME" => "raitingFilter",
        "IBLOCK_ID" => "9",
        "IBLOCK_TYPE" => "chop",
        "PAGE_ELEMENT_COUNT" => "10",
        "RAND_ELEMENTS" => "N",
        "SORT_BY1" => "PROPERTY_69",
        "SORT_BY2" => "PROPERTY_CHOP_ID.NAME",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "ASC",
        "COMPONENT_TEMPLATE" => "raiting_reputation_rating"
    ),
    false
);
