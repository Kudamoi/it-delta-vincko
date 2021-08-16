<?php
//Собираем компании ВСЕ
$companies = CIBlockElement::GetList(
    array(),
    array("IBLOCK_ID" => 8, "ACTIVE" => "Y"),
    false,
    false,
    array("ID", "NAME", "PROPERTY_CH_CONFIRMED")
);

while ($company = $companies->GetNext()) {
    $arrCompanies[$company["ID"]]['ID'] = $company["ID"];
    $arrCompanies[$company["ID"]]['NAME'] = $company["NAME"];
    $arrCompanies[$company["ID"]]['CH_CONFIRMED'] = $company["PROPERTY_CH_CONFIRMED_VALUE"];
}

//Получаем все города
$cities = CIBlockElement::GetList(
    array(),
    array("IBLOCK_ID" => 20, "ACTIVE" => "Y"),
    false,
    false,
    array("ID", "NAME")
);

while ($city = $cities->GetNext()) {
    $arrCities[$city["ID"]]['ID'] = $city["ID"];
    $arrCities[$city["ID"]]['NAME'] = $city["NAME"];
}

//Определяем ГП и записываем его в результирующий массив
$arResult['CITY_SELECTED']['ID'] = $arrCities[$_COOKIE["selected_city"]]['ID'];
$arResult['CITY_SELECTED']['NAME'] = $arrCities[$_COOKIE["selected_city"]]['NAME'];

//Собираем компании города
$companies = CIBlockElement::GetList(
    array(),
    array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "PROPERTY_CITY_ID" => $_COOKIE["selected_city"]),
    false,
    false,
    array("ID", "NAME", "PROPERTY_CHOP_ID")
);

while ($company = $companies->GetNext()) {
    $arrCompany[$arrCompanies[$company['PROPERTY_CHOP_ID_VALUE']]["ID"]] = $arrCompanies[$company['PROPERTY_CHOP_ID_VALUE']];
}


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
    array("ID", "CODE", "NAME", "UF_DESCRIPTION_FOR_REVIEWS", "UF_TEXT_BEFORE_FIELD"),
    false
);
while($sectRes = $dbResSect->GetNext()){
    if($sectRes["CODE"] !== "obshcheye-vpechatleniye"){
        $arSections[$sectRes['ID']] = $sectRes;
    }else{
        $mainSection = $sectRes;
    }
}
//прикрепляем элементы к разделам
foreach($arResult["ITEMS"] as $key => $arItem) {
   $arSections[$arItem['IBLOCK_SECTION_ID']]['ITEMS'][] = $arItem;
}

$arResult["COMPANY_NAME"] = $dbCompany["NAME"];
$arResult["COMPANY_ID"] = $dbCompany["ID"];
$arResult["CITY_ID"] = intval($_GET["city"]);
$arResult["SECTIONS"] = $arSections;
$arResult['CITY_COMPANIES'] = $arrCompany;
$arResult['CITIES'] = $arrCities;
$arResult["MAIN_SECTION"] = $mainSection;
?>