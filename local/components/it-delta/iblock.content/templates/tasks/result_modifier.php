<?php
$arResult['CURRENT_CITY'] = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array("ACTIVE" => "Y", "IBLOCK_ID" => '20', 'ID' => $_COOKIE['selected_city']),
    false,
    false,
    array('NAME', 'ID')
)->GetNext();

$companies = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array("ACTIVE" => "Y", "IBLOCK_ID" => '9', 'PROPERTY_CITY_ID' => $arResult['CURRENT_CITY']['ID']),
    false,
    false,
    array('NAME', 'ID','PROPERTY_CHOP_ID.NAME')
);
while ($company =$companies->fetch()) {
    $arResult['COMPANIES'][] = $company;
}
