<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

Loader::includeModule("highloadblock");

$hlblock = HL\HighloadBlockTable::query()->addSelect('*')->where('NAME', 'ReviewsHL')->exec()->fetch();

$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$arSelect = array("UF_CITY_ID" => $_COOKIE['selected_city']);

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
<?php if(isset($_GET['REVIEW'])):
$APPLICATION->IncludeComponent(
    "bitrix:highloadblock.list",
    "search_review",
    array(
        "BLOCK_ID" => "5",
        "FILTER_NAME" => "reviewsFilter",
        "DETAIL_URL" => "",
        "PAGEN_ID" => "page",
        "ROWS_PER_PAGE" => "",
        "COMPONENT_TEMPLATE" => ".default",
        "SORT_FIELD" => '',
        "SORT_ORDER" => ''
    )
);
endif;
?>