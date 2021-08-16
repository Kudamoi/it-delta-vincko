<?php

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
$companies = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 8, "ACTIVE" => "Y"), false, false, array("ID", "NAME", "PROPERTY_CH_CONFIRMED"));

while ($company = $companies->GetNext()) {
    $arrCompanies[$company["ID"]]['ID'] = $company["ID"];
    $arrCompanies[$company["ID"]]['NAME'] = $company["NAME"];
    $arrCompanies[$company["ID"]]['CH_CONFIRMED'] = $company["PROPERTY_CH_CONFIRMED_VALUE"];
}

//Собираем статусы компаний
$statusCompanies = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 49, "ACTIVE" => "Y"), false, false, array("ID", "NAME", "PREVIEW_PICTURE"));

while ($status = $statusCompanies->GetNext()) {
    $arrStatus[$status["ID"]]['ID'] = $status["ID"];
    $arrStatus[$status["ID"]]['NAME'] = $status["NAME"];
    $arrStatus[$status["ID"]]['PICTURE'] = CFile::GetPath($status["PREVIEW_PICTURE"]);;
}

//Собираем всех производителей
$manufactureCompanies = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 18, "ACTIVE" => "Y"), false, false, array("ID", "NAME"));

while ($manufacture = $manufactureCompanies->GetNext()) {
    $arrManufactures[$manufacture["ID"]]['ID'] = $manufacture["ID"];
    $arrManufactures[$manufacture["ID"]]['NAME'] = $manufacture["NAME"];
}

//Собираем все обьекты для охраны
$objects = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 19, "ACTIVE" => "Y"), false, false, array("ID", "NAME", "PROPERTY_SVG_PICTURE"));

while ($obj = $objects->GetNext()) {
    $arrObj[$obj["ID"]]['ID'] = $obj["ID"];
    $arrObj[$obj["ID"]]['NAME'] = $obj["NAME"];
    $arrObj[$obj["ID"]]['SVG'] = $obj['~PROPERTY_SVG_PICTURE_VALUE']['TEXT'];
}

foreach ($arResult['ITEMS'] as $item):
    $newArrItem[$item['ID']]['CODE'] = $item['CODE'];
    $newArrItem[$item['ID']]['ID'] = $item['ID'];
    $newArrItem[$item['ID']]['NAME'] = $item['NAME'];
    $newArrItem[$item['ID']]['CH_RATING_SUM'] = $item['PROPERTIES']['CH_RATING_SUM']['VALUE'];
    $newArrItem[$item['ID']]['CH_RATING_ZABOTA'] = $item['PROPERTIES']['CH_RATING_ZABOTA']['VALUE'];
    $newArrItem[$item['ID']]['CH_RATING_SPASENIE'] = $item['PROPERTIES']['CH_RATING_SPASENIE']['VALUE'];
    $newArrItem[$item['ID']]['CH_RATING_FINANCE'] = $item['PROPERTIES']['CH_RATING_FINANCE']['VALUE'];
    $newArrItem[$item['ID']]['CHOP_ID'] = $arrCompanies[$item['PROPERTIES']['CHOP_ID']['VALUE']];
    $newArrItem[$item['ID']]['STATUS_COMPANY'] = $arrStatus[$item['PROPERTIES']['STATUS_COMPANY']['VALUE']];
    $newArrItem[$item['ID']]['SAFE_DEAL'] = $item['PROPERTIES']['SAFE_DEAL']['VALUE_XML_ID'];
    $newArrItem[$item['ID']]['HONEST_CONTRACT'] = $item['PROPERTIES']['HONEST_CONTRACT']['VALUE_XML_ID'];
    $newArrItem[$item['ID']]['CONTRACT'] = CFile::GetPath($item['PROPERTIES']['CONTRACT']['VALUE']);
    $newArrItem[$item['ID']]['DESCRIPTION_HOME'] = $item['PROPERTIES']['DESCRIPTION_HOME']['~VALUE']['TEXT'];
    $newArrItem[$item['ID']]['SERVICES_HOME'] = $item['PROPERTIES']['SERVICES_HOME']['~VALUE']['TEXT'];
    $newArrItem[$item['ID']]['DESCRIPTION_APPARTAMENT'] = $item['PROPERTIES']['DESCRIPTION_APPARTAMENT']['~VALUE']['TEXT'];
    $newArrItem[$item['ID']]['SERVICES_APPARTAMENT'] = $item['PROPERTIES']['SERVICES_APPARTAMENT']['~VALUE']['TEXT'];
    $newArrItem[$item['ID']]['SERVICES_COMMERCE'] = $item['PROPERTIES']['SERVICES_COMMERCE']['~VALUE']['TEXT'];
    $newArrItem[$item['ID']]['DESCRIPTION_COMMERCE'] = $item['PROPERTIES']['DESCRIPTION_COMMERCE']['~VALUE']['TEXT'];
    foreach ($item['PROPERTIES']['MANUFACTURERS']['VALUE'] as $manufacture):
        $newArrItem[$item['ID']]['MANUFACTURERS'][$manufacture] = $arrManufactures[$manufacture];
    endforeach;
endforeach;


//Получаем все города
$cities = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 20, "ACTIVE" => "Y"), false, false, array("ID", "NAME"));
$checkCityArr = false;
while ($city = $cities->GetNext()) {
    $checkCityArr = ($city["ID"] == $_COOKIE["selected_city"]);
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
