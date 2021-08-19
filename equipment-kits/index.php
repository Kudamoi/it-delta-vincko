<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$packages = MainService::getPackagesIds();

if(!empty($packages))
{
    $packagesFilter = array(
        "ID"=>$packages
    );
    $APPLICATION->IncludeComponent(
    "it-delta:iblock.content",
    "equipment-kits",
    Array(
        "ACTIVE_DATE" => "N",
        "ADD_CACHE_STRING" => "",
        "CACHE_TIME" => "0",
        "CACHE_TYPE" => "A",
        "EQUIPMENT-KITS_IBLOCK_ID" => "11",
        "FILTER_NAME" => "packagesFilter",
        "IBLOCK_ID" => "12",
        "IBLOCK_TYPE" => "references",
        "PAGE_ELEMENT_COUNT" => "10",
        "RAND_ELEMENTS" => "N",
        "SORT_BY1" => "SORT",
        "SORT_BY2" => "NAME",
        "SORT_ORDER1" => "ASC",
        "SORT_ORDER2" => "ASC"
    )
);
}else{
    require("../404.php");
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>