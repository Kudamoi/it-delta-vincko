<?php

$arResult['CURRENT_CITY'] = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array("ACTIVE" => "Y", "IBLOCK_ID" => '20', 'ID' => $_COOKIE['selected_city']),
    false,
    false,
    array('NAME', 'ID')
)->GetNext();

$companiesCity = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array("ACTIVE" => "Y", "IBLOCK_ID" => '9', 'PROPERTY_CITY_ID' => $arResult['CURRENT_CITY']['ID']),
    false,
    false,
    array('NAME', 'ID', 'PROPERTY_CHOP_ID')
);
while ($companyCity = $companiesCity->fetch()) {
    $company = CIBlockElement::GetList(
        array("SORT" => "ASC"),
        array("ACTIVE" => "Y", "IBLOCK_ID" => '8', 'ID' => $companyCity["PROPERTY_CHOP_ID_VALUE"]),
        false,
        false,
        array('NAME', 'ID')
    )->fetch();

    $arResult['COMPANIES'][] = $company;
}