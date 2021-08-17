<?php
//Получаем все города
$cities = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 20, "ACTIVE" => "Y"), false, false, array("ID", "NAME"));
$checkCityArr = false;
while ($city = $cities->GetNext()) {
    $city["ID"] == $_COOKIE["selected_city"] ? $checkCityArr = true : '';
    $arrCities[$city["ID"]]['ID'] = $city["ID"];
    $arrCities[$city["ID"]]['NAME'] = $city["NAME"];
}

//Определяем ГП и записываем его в результирующий массив
if (!empty($_COOKIE["selected_city"]) && $checkCityArr):

    $arResult['CITY_SELECTED']['ID'] = $arrCities[$_COOKIE["selected_city"]]['ID'];
    $arResult['CITY_SELECTED']['NAME'] = $arrCities[$_COOKIE["selected_city"]]['NAME'];
else:

    foreach ($arrCities as $city):
        $_COOKIE["selected_city"] = $city['ID'];
        $arResult['CITY_SELECTED']['ID'] = $city['ID'];
        $arResult['CITY_SELECTED']['NAME'] = $city['NAME'];
        break;
    endforeach;
endif;

//Cоздаем фильтр для рейтинга
$dbchops = CIBlockElement::GetList(
    array(),
    array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "PROPERTY_CITY_ID" => $_COOKIE["selected_city"]),
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
$arResult['FILTER'] = $raitingFilter;

$arrFilter = $raitingFilter;
//Собираем компании ВСЕ
$companies = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 8, "ACTIVE" => "Y"), false, false, array("ID", "NAME", "DETAIL_PAGE_URL","PROPERTY_CH_CONFIRMED"));

while ($company = $companies->GetNext()) {
    $arrCompanies[$company["ID"]]['ID'] = $company["ID"];
    $arrCompanies[$company["ID"]]['NAME'] = $company["NAME"];
    $arrCompanies[$company["ID"]]['DETAIL_PAGE_URL'] = $company["DETAIL_PAGE_URL"];
    $arrCompanies[$company["ID"]]['CH_CONFIRMED'] = $company["PROPERTY_CH_CONFIRMED_VALUE"];
}

//Собираем компании города
$companies = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "PROPERTY_CITY_ID" => $_COOKIE["selected_city"]), false, false, array("ID", "NAME", "PROPERTY_CHOP_ID"));

while ($company = $companies->GetNext()) {
    $arrCompany[$arrCompanies[$company['PROPERTY_CHOP_ID_VALUE']]["ID"]] = $arrCompanies[$company['PROPERTY_CHOP_ID_VALUE']];
}

//Собираем данные в результирующий массив

$arResult['OBJECTS'] = $arrObj;
$arResult['CITY_COMPANIES'] = $arrCompany;
$arResult['CITIES'] = $arrCities;
$arResult['ITEMS'] = $newArrItem;
?>