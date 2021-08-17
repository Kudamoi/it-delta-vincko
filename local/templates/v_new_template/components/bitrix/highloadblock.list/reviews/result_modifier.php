<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

const cityIbId = 20;
const companyIbCode = 'chopcity';
const criteriaIbId = 46;
const ReviewsScoresHL = 8;
const ReviewsSourcesHL = 6;

Loader::includeModule("highloadblock");

//получаем оценки критериев 3-го уровня
$hlblock = HL\HighloadBlockTable::getById(ReviewsScoresHL)->fetch();

$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$arrReviewsIds = array_column($arResult['rows'], 'ID');
$rsData = $entity_data_class::getList(array(
    "select" => array("*"),
    "filter" => array("UF_REVIEW_ID" => $arrReviewsIds)
));

while ($arData = $rsData->Fetch()) {
    $arResult['ReviewsScores'][] = $arData;
}
//получаем источники отзывов
$hlblock = HL\HighloadBlockTable::getById(ReviewsSourcesHL)->fetch();

$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$arrSourcesIds = array_column($arResult['rows'], 'UF_REVIEW_SOURCE_ID');
$rsData = $entity_data_class::getList(array(
    "select" => array("*"),
    "filter" => array("ID" => $arrSourcesIds)
));

while ($arData = $rsData->Fetch()) {
    $arData['UF_REVIEW_SOURCE_LOGO'] = CFile::ResizeImageGet($arData['UF_REVIEW_SOURCE_LOGO'], array('width' => 60, 'height' => 15), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult['ReviewsSources'][$arData['ID']] = $arData;
}

//получаем список пользоваетелей
$usersIds = '';
foreach ($arResult['rows'] as $row) {
    $usersIds .= $row['UF_USER_ID'] . ' | ';
}

global $USER;
$filter = array("ID" => $usersIds);
$rsUsers = CUser::GetList(($by = "id"), ($order = "desc"), $filter);
while ($arUser = $rsUsers->Fetch()) {
    $arSpecUser[$arUser['ID']] = $arUser;
}
$arResult['USERS_LIST'] = $arSpecUser;

//получаем список городов
$res = CIBlockElement::GetList(
    array(),
    array("IBLOCK_ID" => cityIbId, "ACTIVE" => "Y"),
    false,
    false,
    array("ID", "NAME")
);

while ($arFields = $res->Fetch()) {
    $arResult['CITIES'][$arFields['ID']] = $arFields;
}

$arChopIds = array_column($arResult['rows'],'UF_CHOP_ID');
//получаем список компаний
$res = CIBlockElement::GetList(
    array(),
    array("IBLOCK_CODE" => companyIbCode, "ACTIVE" => "Y", "=PROPERTY_CITY_ID" => $arResult['rows'][0]['UF_CITY_ID'],"=PROPERTY_CHOP_ID" => $arChopIds),
    false,
    false,
    array("ID", "NAME","PROPERTY_CHOP_ID.ID","PROPERTY_CHOP_ID.NAME","PROPERTY_EL_RATING_SUM")
);

while ($arFields = $res->Fetch()) {
    $arResult['SECURE_COMPANY_LIST'][$arFields['PROPERTY_CHOP_ID_ID']] = $arFields;
}

//получаем список критериев
$res = CIBlockSection::GetList(
    array(),
    array("IBLOCK_ID" => criteriaIbId, "ACTIVE" => "Y"),
    false,
    array("UF_REVIEW_SCORE_PROPERTY_NAME"),
    false
);

while ($arFields = $res->Fetch()) {
    $arResult['CRITERIA'][$arFields['ID']] = $arFields;
    $file = CFile::ResizeImageGet($arFields['PICTURE'], array('width' => 25, 'height' => 20), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult['CRITERIA'][$arFields['ID']]['ICON'] = $file;
}
//получаем список вопросов к критериям
$res = CIBlockElement::GetList(
    array(),
    array("IBLOCK_ID" => criteriaIbId, "ACTIVE" => "Y"),
    false,
    array(),
    false
);

while ($arFields = $res->Fetch()) {
    $arResult['CRITERIA_QUESTIONS'][$arFields['ID']] = $arFields;
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

//Собираем компании ВСЕ
$companies = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 8, "ACTIVE" => "Y"), false, false, array("ID", "NAME", "PROPERTY_CH_CONFIRMED"));

while ($company = $companies->GetNext()) {
    $arrCompanies[$company["ID"]]['ID'] = $company["ID"];
    $arrCompanies[$company["ID"]]['NAME'] = $company["NAME"];
    $arrCompanies[$company["ID"]]['CH_CONFIRMED'] = $company["PROPERTY_CH_CONFIRMED_VALUE"];
}


//Получаем все отзывы
$hlblock = HL\HighloadBlockTable::query()->addSelect('*')->where('NAME', 'ReviewsHL')->exec()->fetch();

$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$reviewData = $entity->getDataClass();

$reviews = $reviewData::getList(array(
    "select" => array("*"),
        "order" => array("UF_ALLSCORE_REVIEW_SCORE" => "DESC"),
        'filter' => array('UF_CITY_ID' => $arResult['CITY_SELECTED']['ID'])
    )
);

while($review = $reviews->Fetch()) {
    $arrReviews[$review["UF_CHOP_ID"]][$review["ID"]]['ID'] = $review["ID"];

}
//Собираем компании города
$companies = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "PROPERTY_CITY_ID" => $_COOKIE["selected_city"]), false, false, array("ID", "NAME", "PROPERTY_CHOP_ID"));

while ($company = $companies->GetNext()) {
    $arrCompany[$arrCompanies[$company['PROPERTY_CHOP_ID_VALUE']]["ID"]] = $arrCompanies[$company['PROPERTY_CHOP_ID_VALUE']];
    $arrCompany[$arrCompanies[$company['PROPERTY_CHOP_ID_VALUE']]["ID"]]['REVIEWS'] = $arrReviews[$company['PROPERTY_CHOP_ID_VALUE']];
}

//Собираем данные в результирующий массив
$arResult['CITY_COMPANIES'] = $arrCompany;
$arResult['OBJECTS'] = $arrObj;
$arResult['CITIES'] = $arrCities;
$arResult['COMPANIES_RATING_POSITIONS'] = MainService::calculateSecureCompanyRatingPositionsByCityId($arResult['rows'][0]['UF_CITY_ID']);