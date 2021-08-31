<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

// соберем массивы
foreach ($arResult["ITEMS"] as $item) {
    // компании в городах
    $companyId = $item["PROPERTIES"]["R_CHOP"]["VALUE"];
    $arCompanyCityIds[$companyId] = $companyId;
}

// получим все необходимые компании в городе
$arCompanyCitys = Vincko\Company::getCompany($arCompanyCityIds);

foreach ($arCompanyCitys as $arCompanyCity) {
    // соберем массив компаний
    $arCompanyIds[$arCompanyCity["CHOP_ID"]] = $arCompanyCity["CHOP_ID"];
    // соберем массив городов
    $arCityIds[$arCompanyCity["CITY_ID"]] = $arCompanyCity["CITY_ID"];
}

// получим сами компании
$arCompany = Vincko\Company::getList($arCompanyIds);

// получим список городов
$arCity = Vincko\City::getList($arCityIds);

// сформируем удобный массив
foreach ($arCompanyCitys as $companyId => $arCompanyCity) {
    $arCompanyCitys[$companyId]["PARENT"] = $arCompany[$arCompanyCity["CHOP_ID"]];
    $arCompanyCitys[$companyId]["CITY"] = $arCity[$arCompanyCity["CITY_ID"]];

}

$arResult["COMPANY_CITY"] = $arCompanyCitys;
?>