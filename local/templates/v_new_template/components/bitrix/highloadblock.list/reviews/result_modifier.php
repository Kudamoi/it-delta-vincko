<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

const cityIbId = 20;
const companyIbId = 8;
const criteriaIbId = 46;
const ReviewsScoresHL = 8;

    Loader::includeModule("highloadblock");


    $hlblock = HL\HighloadBlockTable::getById(ReviewsScoresHL)->fetch();

    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();

    $arrReviewsIds = array_column($arResult['rows'],'ID');
    $rsData = $entity_data_class::getList(array(
        "select" => array("*"),
        "filter" => array("UF_REVIEW_ID" => $arrReviewsIds)
    ));

    while ($arData = $rsData->Fetch()) {
        $arResult['ReviewsScores'][] = $arData;
    }


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

$res = CIBlockElement::GetList(
    array(),
    array("IBLOCK_ID" => companyIbId, "ACTIVE" => "Y", "=ID" => $arResult['rows'][0]['UF_CHOP_ID']),
    false,
    false,
    array("ID", "NAME")
);

while ($arFields = $res->Fetch()) {
    $arResult['CURRENT_SECURE_COMPANY'] = $arFields;
}

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