<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$usersIds = '';
foreach ($arResult['rows'] as $row)
{
    $usersIds .= $row['UF_USER_ID'].' | ';
}

global $USER;
$filter = array("ID"=>$usersIds);
$rsUsers = CUser::GetList(($by = "id"), ($order = "desc"), $filter);
while ($arUser = $rsUsers->Fetch()) {
    $arSpecUser[$arUser['ID']] = $arUser;
}
$arResult['USERS_LIST'] = $arSpecUser;

$res = CIBlockElement::GetList(
    array(),
    array("IBLOCK_ID" => 20, "ACTIVE" => "Y"),
    false,
    false,
    array("ID","NAME")
);

while($arFields = $res->Fetch()){
    $arResult['CITIES'][$arFields['ID']] = $arFields;
}

$res = CIBlockElement::GetList(
    array(),
    array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "=PROPERTY_CITY_ID" => $_COOKIE["selected_city"]),
    false,
    false,
    array("ID","PROPERTY_CHOP_ID.NAME")
);

while($arFields = $res->Fetch()){
    $arResult['SECURE_COMPANIES'][$arFields['ID']] = $arFields;
}
