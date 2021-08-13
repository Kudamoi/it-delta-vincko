<?php
//$dbResSect = CIBlockSection::GetList(
//    Array("SORT"=>"ASC"),
//    Array("ACTIVE"=>"Y","IBLOCK_ID"=>$arParams['IBLOCK_ID'],"ID"=>$arParams['PACKAGES_IDS'])
//);
////получаем разделы и собираем в массив
//while($sectRes = $dbResSect->GetNext())
//{
//    //получаем путь картинки раздела
//    $sectRes['PICTURE_SRC'] = CFile::GetPath($sectRes["PICTURE"]);
//    $arSections[$sectRes['ID']] = $sectRes;
//}
////прикрепляем элементы к разделам
//foreach($arResult["ITEMS"] as $key => $arItem) {
//    $arSections[$arItem['IBLOCK_SECTION_ID']]['ITEMS'][] = $arItem;
//}
//
//$arResult["SECTIONS"] = $arSections;
//

//Подготовка классов решений
$arrClassFetch = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array("IBLOCK_ID" => "36"),
    false,
    false,
    array("ID", "NAME", "PREVIEW_PICTURE", "SORT")
);
while ($class = $arrClassFetch->GetNext()) {
    $arrClass[$class['ID']] = $class;
    $arrClass[$class['ID']]['PREVIEW_PICTURE'] = CFile::GetPath($class["PREVIEW_PICTURE"]);
}
//Подготовка характеристик разделов
$arrCharacteristicsFetch = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array("IBLOCK_ID" => "39"),
    false,
    false,
    array("ID", "NAME", "PREVIEW_PICTURE")
);
while ($class = $arrCharacteristicsFetch->GetNext()) {
    $arrCharacteristics[$class['ID']] = $class;
    $arrCharacteristics[$class['ID']]['PREVIEW_PICTURE'] = CFile::GetPath($class["PREVIEW_PICTURE"]);
}
//Подготовка компании в городе для сортировки готовых предложений
$arrCompanyInfo = CIBlockElement::GetList(
    false,
    array("IBLOCK_ID" => "9", "ID" => $_POST['COMPANY']),
    false,
    false,
    array("ID", "NAME", "PROPERTY_CH_PACKETS")
)->fetch();

//получаем разделы и собираем в массив
$dbResSect = CIBlockSection::GetList(
    array("SORT" => "ASC"),
    array("ACTIVE" => "Y", "IBLOCK_ID" => $arParams['IBLOCK_ID']),
    false,
    array('UF_CHARACTERISTICS_REF'),
    false
);
while ($sectRes = $dbResSect->GetNext()) {
    //Заполняем разделы характеристиками с инфоблока
    foreach ($sectRes['UF_CHARACTERISTICS_REF'] as $uf):
        if (!empty($arrCharacteristics[$uf]['PREVIEW_PICTURE'])):
            $sectRes['CHARACTERISTICS'][] = $arrCharacteristics[$uf];
        else:
            $arrWithoutImage[] = $arrCharacteristics[$uf];
        endif;
    endforeach;
    $sectRes['CHARACTERISTICS'] = array_merge($sectRes['CHARACTERISTICS'], $arrWithoutImage);
    //получаем путь картинки раздела
    $sectRes['PICTURE_SRC'] = CFile::GetPath($sectRes["PICTURE"]);
    $arSections[$sectRes['ID']] = $sectRes;
    $arrWithoutImage = null;
}


foreach ($arResult["ITEMS"] as $key => $arItem) {
    $arSections[$arItem['IBLOCK_SECTION_ID']]['ITEMS'][] = $arItem;

    $arSections[$arItem['IBLOCK_SECTION_ID']]['CLASS_INFO'] = $arrClass[$arItem['PROPERTIES']['CO_CLASS_REF']['VALUE']];

}


//собираем id комплектов из всех готовых решений
$equipmentKitsIds = array();
foreach ($arSections as $key => $arSection) {


    foreach ($arSection['ITEMS'] as $arItem) {
        if(in_array($arItem['ID'], $arrCompanyInfo['PROPERTY_CH_PACKETS_VALUE'])) {
            $item = $arItem['PROPERTIES']['P_COMPLECT']['VALUE'];
            if (is_array($item))
                $equipmentKitsIds = array_merge($equipmentKitsIds, $item);
            foreach ($arItem['PROPERTIES']['P_COMPLECT']['VALUE'] as $complect):
                $element_code[$complect] = $arItem["CODE"];
                $arConnect[$complect] = $arrClass[$arItem['PROPERTIES']['CO_CLASS_REF']['VALUE']];
                $arConnect[$complect]['COMPANY_NAME'] = $arrCompanyInfo['NAME'];
            endforeach;
        }
    }
}

empty($equipmentKitsIds) ? $equipmentKitsIds = -1: '';
//print_r($equipmentKitsIds);
$dbResEquipmentKits = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array("ACTIVE" => "Y", "IBLOCK_ID" => $arParams['EQUIPMENT-KITS_IBLOCK_ID'], "ID" => $equipmentKitsIds),
    false,
    false,
    array("ID", "NAME", "PROPERTY_CO_CHARACTERISTICS_REF", "CODE", "PROPERTY_CO_PRESENTS_REF", 'CATALOG_GROUP_1')
);

$arCharacteristic = array();
while ($equipmentKitsRes = $dbResEquipmentKits->GetNext()) {

    $arDiscounts = CCatalogDiscount::GetDiscountByProduct(
        $equipmentKitsRes['ID'],
    );
    !empty($arDiscounts) ? $equipmentKitsRes["DISCOUNT_PRICE"] = $equipmentKitsRes['CATALOG_PRICE_1'] - ($equipmentKitsRes['CATALOG_PRICE_1'] * $arDiscounts[0]['VALUE'] / 100) : '';
    
    $equipmentKitsRes['DETAIL_URL'] = $equipmentKitsRes['CODE'];

    $equipmentKitsRes['PROPERTY_CO_CLASS_REF_VALUE'] != null ? $arrComplect[] = $equipmentKitsRes['PROPERTY_CO_CLASS_REF_VALUE'] : '';
    $equipmentKitsRes['PROPERTY_CO_CHARACTERISTICS_REF_VALUE'] != null ? $arCharacteristic = array_merge($arCharacteristic, $equipmentKitsRes['PROPERTY_CO_CHARACTERISTICS_REF_VALUE']) : '';
    $equipmentKitsRes = array_merge($equipmentKitsRes, ["ELEMENT_CODE" => $element_code[$equipmentKitsRes["ID"]]]);
    
    $arEquipmentKits[$equipmentKitsRes['ID']] = $equipmentKitsRes;
}

$characteristicsFetch = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array("IBLOCK_ID" => "37", "ID" => $arCharacteristic),
    false,
    false,
    array("ID", "NAME", "PREVIEW_PICTURE")
);
while ($detail = $characteristicsFetch->GetNext()) {
    $characteristicDetail[$detail['ID']] = $detail;
    $characteristicDetail[$detail['ID']]["PREVIEW_PICTURE"] = CFile::GetPath($detail["PREVIEW_PICTURE"]);
}


foreach ($arEquipmentKits as $eq):
    foreach ($eq['PROPERTY_CO_CHARACTERISTICS_REF_VALUE'] as $characteristicID):
        $arEquipmentKits[$eq['ID']]['COMPLECT_CHARACTERISTICS'][$characteristicID] = $characteristicDetail[$characteristicID];
    endforeach;
    $arEquipmentKits[$eq['ID']]['CLASS_INFO'] = $arConnect[$eq['ID']];
endforeach;


//прикрепляем комплекты к разделам
foreach ($arSections as $key => $arSection) {
    foreach ($arSection['ITEMS'] as $arItem) {
        $item = $arItem['PROPERTIES']['P_COMPLECT']['VALUE'];
        if (is_array($item)) {
            foreach ($item as $value) {
                if (key_exists($value, $arEquipmentKits))
                    $arSections[$arSection['ID']]['EQUIPMENT-KITS'][] = $arEquipmentKits[$value];

            }
        }
    }

}

$arResult["SECTIONS"] = $arSections;


