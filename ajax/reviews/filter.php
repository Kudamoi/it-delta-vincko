<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$APPLICATION->ShowAjaxHead();

use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

Loader::includeModule("highloadblock");

$hlblock = HL\HighloadBlockTable::query()->addSelect('*')->where('NAME', 'ReviewsHL')->exec()->fetch();

$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$arSelect = array("UF_CITY_ID" => $_COOKIE['selected_city']);
if(isset($_POST['MARK'])) {
    $mark = (float)$_POST['MARK'];

    if ($mark >= 2 && $mark < 4) {
        $arSelect["<=UF_ALLSCORE_REVIEW_SCORE"] = 1;
    } elseif ($mark >= 4 && $mark < 7) {
        $arSelect[">=UF_ALLSCORE_REVIEW_SCORE"] = 2;
        $arSelect["<=UF_ALLSCORE_REVIEW_SCORE"] = 3;
    } elseif ($mark >= 7) {
        $arSelect[">=UF_ALLSCORE_REVIEW_SCORE"] = 4;
        $arSelect["<=UF_ALLSCORE_REVIEW_SCORE"] = 5;
    }
}
if(isset($_POST['COMPANY'])) {
    $arSelect['UF_CHOP_ID'] = $_POST['COMPANY'];
}
if(isset($_POST['SORT'])) {
    $sort = $_POST['SORT'];
    if ($sort == 0) {
        $sortF = '';
        $sortED = '';
    } elseif ($sort == 1) {
        $sortF = 'UF_ALLSCORE_REVIEW_SCORE';
        $sortED = 'DESC';
    } elseif ($sort == 2) {
        $sortF = 'UF_ALLSCORE_REVIEW_SCORE';
        $sortED = 'ASC';
    }
}
$rsData = $entity_data_class::getList(array(
    "select" => array("*"),
    "filter" => $arSelect
));
$arrReviews = [];
while ($arData = $rsData->Fetch()) {
    $arrReviews[] = $arData["ID"];
}
$reviewsFilter = array(
    "ID" => $arrReviews
);
?>
<? $APPLICATION->IncludeComponent(
    "bitrix:highloadblock.list",
    "reviews_filter",
    array(
        "BLOCK_ID" => "5",
        "FILTER_NAME" => "reviewsFilter",
        "DETAIL_URL" => "",
        "PAGEN_ID" => "page",
        "ROWS_PER_PAGE" => "5",
        "COMPONENT_TEMPLATE" => ".default",
        "SORT_FIELD" => $sortF,
        "SORT_ORDER" => $sortED
    )
); ?>