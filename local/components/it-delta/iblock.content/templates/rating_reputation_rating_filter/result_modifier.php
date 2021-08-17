<?php

use Bitrix\Main\Loader;

Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

//создаем заготовку под выборку отзывов
$hlbl = 5; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();


//Получаем всех пользователей
$order = array('sort' => 'asc');
$tmp = 'sort'; // параметр проигнорируется методом, но обязан быть
$paramUser = array("ID");
$rsUsers = CUser::GetList($order, $tmp);
while ($user = $rsUsers->GetNext()) {
    $arrUsers[$user['ID']]['ID'] = $user['ID'];
    $arrUsers[$user['ID']]['NAME'] = $user['NAME'];
}

//Получаем честный договор и кладем его в массив
$contract = CIBlockElement::GetList(array(), array("IBLOCK_CODE" => 'contract', "ACTIVE" => "Y"), false, false, array("ID", "NAME", "PROPERTY_CONTRACT"));

while ($cont = $contract->GetNext()) {
    $arrContract['ID'] = $cont["ID"];
    $arrContract['NAME'] = $cont["NAME"];
    $arrContract['SRC'] = CFile::GetPath($cont["PROPERTY_CONTRACT_VALUE"]);
}

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
    $arrStatus[$status["ID"]]['PICTURE'] = CFile::GetPath($status["PREVIEW_PICTURE"]);
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

//Получаем все отзывы
$reviews = $entity_data_class::getList(array("select" => array("*"), "order" => array("UF_ALLSCORE_REVIEW_SCORE" => "DESC"), 'filter' => array('UF_CITY_ID' => $arResult['CITY_SELECTED']['ID'])));

while($review = $reviews->fetch()) {

    $arrReviews[$review["UF_CHOP_ID"]][$review["ID"]]['ID'] = $review["ID"];
    $arrReviews[$review["UF_CHOP_ID"]][$review["ID"]]['NAME'] = !empty($review['UF_USER_NAME']) ? $review["UF_USER_NAME"] : $arrUsers[$review['UF_USER_ID']]['NAME'];
    $arrReviews[$review["UF_CHOP_ID"]][$review["ID"]]['COMMENT'] = $review['UF_ALLSCORE_REVIEW_SCORE_COMMENT'];

}

foreach ($arResult['ITEMS'] as $item):
    $newArrItem[$item['ID']]['CODE'] = $item['CODE'];
    $newArrItem[$item['ID']]['ID'] = $item['ID'];
    $newArrItem[$item['ID']]['NAME'] = $item['NAME'];
    $newArrItem[$item['ID']]['CH_TYPE'] = $item['PROPERTIES']['CH_TYPE']['VALUE'];
    $newArrItem[$item['ID']]['CITY'] = $arrCities[$item['PROPERTIES']['CITY_ID']['VALUE']];
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
    $newArrItem[$item['ID']]['POSITION'] = MainService::calculateSecureCompanyRatingPositionsByCityId($newArrItem[$item['ID']]['CITY']['ID'])[$newArrItem[$item['ID']]['CHOP_ID']['ID']]['POSITION_IN_RATING'];
    $newArrItem[$item['ID']]['REVIEWS'] = $arrReviews[$newArrItem[$item['ID']]['CHOP_ID']['ID']];
    foreach ($item['PROPERTIES']['MANUFACTURERS']['VALUE'] as $manufacture):
        $newArrItem[$item['ID']]['MANUFACTURERS'][$manufacture] = $arrManufactures[$manufacture];
    endforeach;
endforeach;


//Собираем компании города
$companies = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "PROPERTY_CITY_ID" => $_COOKIE["selected_city"]), false, false, array("ID", "NAME", "PROPERTY_CHOP_ID"));

while ($company = $companies->GetNext()) {
    $arrCompany[$arrCompanies[$company['PROPERTY_CHOP_ID_VALUE']]["ID"]] = $arrCompanies[$company['PROPERTY_CHOP_ID_VALUE']];
}


//Собираем данные в результирующий массив

$arResult['CONTRACT'] = $arrContract;
$arResult['OBJECTS'] = $arrObj;
$arResult['CITY_COMPANIES'] = $arrCompany;
$arResult['CITIES'] = $arrCities;
$arResult['ITEMS'] = $newArrItem;
