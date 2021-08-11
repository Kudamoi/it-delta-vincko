<?php
$dbCompany = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array("IBLOCK_ID" => 8, "ID" => intval($_GET["chop"])),
    false,
    false,
    array("ID", "NAME")
)->fetch();

$dbResSect = CIBlockSection::GetList(
    array("SORT"=>"ASC"),
    array("ACTIVE"=>"Y", "IBLOCK_ID" => 46),
    false,
    array("UF_DESCRIPTION_FOR_REVIEWS", "UF_TEXT_BEFORE_FIELD"),
    false
);
while($sectRes = $dbResSect->GetNext()){
   $arSections[$sectRes['ID']] = $sectRes;
}
//прикрепляем элементы к разделам
foreach($arResult["ITEMS"] as $key => $arItem) {
   $arSections[$arItem['IBLOCK_SECTION_ID']]['ITEMS'][] = $arItem;
}

$arResult["COMPANY_NAME"] = $dbCompany["NAME"];
$arResult["COMPANY_ID"] = $dbCompany["ID"];
$arResult["CITY_ID"] = intval($_GET["city"]);
$arResult["SECTIONS"] = $arSections;

// echo "<pre>";
// print_r($arResult);
// echo "</pre>";
?>