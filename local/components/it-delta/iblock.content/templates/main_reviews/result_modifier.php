<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

// соберем массивы
foreach ($arResult["ITEMS"] as $item) {
    // компании в городах
    $companyId = $item["PROPERTIES"]["R_CHOP"]["VALUE"];
    $arCompanyCityIds = $companyId;
}

// получим все необходимые компании в городе
$arCompanyCitys = Vincko\Company::getCompany($arCompanyCityIds);

// соберем массив компаний
foreach ($arCompanyCitys as $arCompanyCity) {
    $arCompanyIds[$arCompanyCity["CHOP_ID"]] = $arCompanyCity["CHOP_ID"];
}

// получим сами компании
$arCompany = Vincko\Company::getList($arCompanyIds);

// сформируем удобный массив
foreach ($arCompanyCitys as $companyId => $arCompanyCity) {
    $arCompanyCitys[$companyId]["PARENT"] = $arCompany[$arCompanyCity["CHOP_ID"]];
}

$arResult["COMPANY_CITY"] = $arCompanyCitys;
?>