<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

const cityIbId = 20;
const companyIbId = 8;

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
    array("IBLOCK_ID" => cityIbId, "ACTIVE" => "Y"),
    false,
    false,
    array("ID","NAME")
);

while($arFields = $res->Fetch()){
    $arResult['CITIES'][$arFields['ID']] = $arFields;
}

$res = CIBlockElement::GetList(
    array(),
    array("IBLOCK_ID" => companyIbId, "ACTIVE" => "Y", "=ID" => $arResult['rows'][0]['UF_CHOP_ID']),
    false,
    false,
    array("ID","NAME")
);

while($arFields = $res->Fetch()){
    $arResult['CURRENT_SECURE_COMPANY'] = $arFields;
}
