<?php
foreach($arResult["ITEMS"] as $elementCount => $arItem){
    
    $dbcompany = CIBlockElement::GetList(
        array(),
        array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "ID" => $arItem["PROPERTIES"]["R_CHOP"]["VALUE"]),
        false,
        false,
        array("NAME", "PROPERTY_CITY_ID")
    )->fetch();

    if($dbcompany["PROPERTY_CITY_ID_VALUE"] === $_COOKIE["selected_city"]){
        $userName = CUser::GetByID($arItem["PROPERTIES"]["R_USER_ID"]["VALUE"])->fetch();
        
        $arItem = array_merge($arItem, ["COMPANY_NAME" => $dbcompany["NAME"], "COMPANY_CITY_ID" => $dbcompany["PROPERTY_CITY_ID_VALUE"], "USER_NAME" => $userName["NAME"].' '.$userName["LAST_NAME"]]);
        $arItems["ITEMS"][$dbcompany["NAME"]][] = $arItem;
    }
}

$dbcompany = CIBlockElement::GetList(
    array(),
    array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "PROPERTY_CITY_ID" => $_COOKIE["selected_city"]),
    false,
    false,
    array("NAME")
);

while($company = $dbcompany->GetNext()){
    $arrCompany[] = $company;
}

$dbcity = CIBlockElement::GetList(
    array(),
    array("IBLOCK_ID" => 20, "ACTIVE" => "Y"),
    false,
    false,
    array("NAME")
);

while($city = $dbcity->GetNext()){
    $arrCity[] = $city;
}

unset($arResult["ITEMS"]);

$arResult = $arItems;
$arResult["COMPANY"] = $arrCompany;
$arResult["CITY"] = $arrCity;
?>