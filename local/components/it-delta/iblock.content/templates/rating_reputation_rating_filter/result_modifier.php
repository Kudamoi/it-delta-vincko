<?php
//echo "<pre>";
//    print_r($arResult);
//echo "</pre>";

//Собираем компании ВСЕ
$companies = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 8, "ACTIVE" => "Y"), false, false, array("ID","NAME","PROPERTY_CH_CONFIRMED"));

while ($company = $companies->GetNext()) {
    $arrCompanies[$company["ID"]]['ID'] = $company["ID"];
    $arrCompanies[$company["ID"]]['NAME'] = $company["NAME"];
    $arrCompanies[$company["ID"]]['CH_CONFIRMED'] = $company["PROPERTY_CH_CONFIRMED_VALUE"];
}

//Собираем статусы компаний
$statusCompanies = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 49, "ACTIVE" => "Y"), false, false, array("ID","NAME","PREVIEW_PICTURE"));

while ($status = $statusCompanies->GetNext()) {
    $arrStatus[$status["ID"]]['ID'] = $status["ID"];
    $arrStatus[$status["ID"]]['NAME'] = $status["NAME"];
    $arrStatus[$status["ID"]]['PICTURE'] = CFile::GetPath($status["PREVIEW_PICTURE"]);;
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
endforeach;



//Получаем все города
$cities = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 20, "ACTIVE" => "Y"), false, false, array("ID","NAME"));

while ($city = $cities->GetNext()) {
    $arrCities[$city["ID"]]['ID'] = $city["ID"];
    $arrCities[$city["ID"]]['NAME'] = $city["NAME"];
}

//Определяем ГП и записываем его в результирующий массив
$arResult['CITY_SELECTED']['ID'] = $arrCities[$_COOKIE["selected_city"]]['ID'];
$arResult['CITY_SELECTED']['NAME'] = $arrCities[$_COOKIE["selected_city"]]['NAME'];


//Собираем компании города
$companies = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "PROPERTY_CITY_ID" => $_COOKIE["selected_city"]), false, false, array("ID","NAME","PROPERTY_CHOP_ID"));

while ($company = $companies->GetNext()) {
    $arrCompany[$arrCompanies[$company['PROPERTY_CHOP_ID_VALUE']]["ID"]] = $arrCompanies[$company['PROPERTY_CHOP_ID_VALUE']];
}



//Собираем данные в результирующий массив

$arResult['CITY_COMPANIES'] = $arrCompany;
$arResult['CITIES'] = $arrCities;
$arResult['ITEMS'] = $newArrItem;
//echo "<pre>";
//print_r($arResult);
//echo "</pre>";