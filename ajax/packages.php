<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$APPLICATION->ShowAjaxHead();

$packages = MainService::getPackagesIds();

if(!empty($packages))
{
    $packagesGroups = $_POST['PACKAGES_ARRAY'];
    $packagesFilter = array(
        "IBLOCK_SECTION_ID" => $packagesGroups, "ID"=>$packages
    );
    $APPLICATION->IncludeComponent(
        "it-delta:iblock.content",
        "packages",
        array(
            "ACTIVE_DATE" => "N",
            "ADD_CACHE_STRING" => "",
            "CACHE_TIME" => "0",
            "CACHE_TYPE" => "A",
            "FILTER_NAME" => "packagesFilter",
            "IBLOCK_ID" => "12",
            "IBLOCK_TYPE" => "references",
            "PAGE_ELEMENT_COUNT" => "10",
            "RAND_ELEMENTS" => "N",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC"
        )
    );
}

 ?>