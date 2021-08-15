<?

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$APPLICATION->ShowAjaxHead();
$mark = $_POST['MARK'];
if($mark <2) {
    $min = 0;
    $max = 5;
} elseif ($mark < 4) {
    $min = 0;
    $max = 1.7;
} elseif ($mark < 7) {
    $min = 1.8;
    $max = 3.3;
} else {
    $min = 3.4;
    $max = 5;
}
$dbchops = CIBlockElement::GetList(
    array(),
    array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "PROPERTY_CITY_ID" => $_COOKIE["selected_city"], "PROPERTY_CH_TYPE" => $_POST['OBJECT'], ">=PROPERTY_CH_RATING_SUM" => $min,"<=PROPERTY_CH_RATING_SUM" => $max),
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
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "ASC",
        "COMPONENT_TEMPLATE" => "raiting_reputation_rating"
    ),
    false
);
