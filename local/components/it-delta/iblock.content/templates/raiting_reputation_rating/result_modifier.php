<?php
$dbchops = CIBlockElement::GetList(
    array(),
    array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "PROPERTY_CITY_ID" => $_COOKIE["selected_city"], "NAME" => $_POST["city"] ? : ""),
    false,
    false,
    array()
);

while($chop = $dbchops->GetNext()){
    $chopList[] = $chop;
}

$arResult["FILTER"] = $chopList;

foreach ($arResult["FILTER"] as $arItem) {
    // echo "<pre>";
    // print_r($arItem);
    // echo "</pre>";

    // Получаем активные элементы из инфоблока, они будут являться отзывами
    $dbreviews = CIBlockElement::GetList(
        array(),
        array("IBLOCK_ID" => 16, "ACTIVE" => "Y", "PROPERTY_R_CHOP" => $arItem["ID"]),
        false,
        false,
        array("ID", "PROPERTY_R_USER_ID", "PROPERTY_R_COMMENT", "PROPERTY_R_CHOP")
    );
    
    while($review = $dbreviews->GetNext()){
        $dbchops = CIBlockElement::GetList(
            array("SORT"=>"ASC"),
            array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "CHOP_ID" => $review["PROPERTY_R_CHOP_VALUE"]),
            false,
            false,
            array("ID", "PROPERTY_CITY_ID")
        )->fetch();
        
        $arr = array_merge($review, ["CITY_ID" => $dbchops["PROPERTY_CITY_ID_VALUE"]]);
        $arrReview[$review["PROPERTY_R_CHOP_VALUE"]][] = $arr;
    }
}

// echo "<pre>";
// print_r($arrReview);
// echo "</pre>";
$arResult["REVIEWS"] = $arrReview;
// echo "<pre>";
// print_r($arResult);
// echo "</pre>";
?>