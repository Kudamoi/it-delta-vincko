<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

// id инфоблоков
$companyCityIblockId = 9;
$equipmentIblockId = 10;
$complectsIblockId = 11;
$packagesIblockId = 12;
$insuranceIblockId = 14;
$companyCityAndSubscriptionFeeIblockId = 25;
$insurancePaymentOptionsIblockId = 35;
$classesIblockId = 36;
$equipmentCharacteristicsIblockId = 41;
$equipmentTechCharacteristicsIblockId = 53;

// получает информацию по ценам с учетом скидок
if (!function_exists('getPricesInfoByProductId')) {
    function getPricesInfoByProductId($productID)
    {
        global $USER;
        $quantity = 1;
        $renewal = 'N';
        $arPrice = CCatalogProduct::GetOptimalPrice(
            $productID,
            $quantity,
            $USER->GetUserGroupArray(),
            $renewal
        );
        if (!$arPrice || count($arPrice) <= 0) {
            if ($nearestQuantity = CCatalogProduct::GetNearestQuantityPrice($productID, $quantity, $USER->GetUserGroupArray()))
            {
                $quantity = $nearestQuantity;
                $arPrice = CCatalogProduct::GetOptimalPrice($productID, $quantity, $USER->GetUserGroupArray(), $renewal);
            }
        }
        return $arPrice;
    }
}


//получаем готовое решение, которое содержит текущий комплект в выбранном городе
$res = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array("ACTIVE" => "Y", "IBLOCK_ID" => $packagesIblockId,"=PROPERTY_P_COMPLECT" => $arResult['ID']),
    false,
    false,
    array("ID", "*", "PROPERTY_CO_CLASS_REF", "PROPERTY_P_COMPLECT", "IBLOCK_SECTION_ID","PROPERTY_P_COMPLECT_WITH",
        "PROPERTY_P_ABONENTPLATA_WITH","PROPERTY_P_STRAHOVKA_WITH")
);

while ($arFields = $res->Fetch()) {
    $arResult['COMPLECT_PARENT_PACKAGE'] = $arFields;
    $arResult['COMPLECT_PARENT_PACKAGE']['PICTURE'] = CFile::ResizeImageGet($arFields['PREVIEW_PICTURE'], array("width" => 360, "height" => 290), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
}

$params = array(
    'IBLOCK_ID'=>9,
    'COOKIE'=>$_COOKIE
);

//найдем все готовые решения в текущем городе
$packages = MainService::getPackagesIds($params);
//если текущего готового решения нет в массиве доступных
if(!in_array($arResult['COMPLECT_PARENT_PACKAGE']['ID'],$packages))
    \Bitrix\Iblock\Component\Tools::process404("",true,true,true);

//получаем группу готового решения
$parentPackageGroupId = $arResult['COMPLECT_PARENT_PACKAGE']['IBLOCK_SECTION_ID'];
$res = CIBlockSection::GetByID($parentPackageGroupId);
while ($arFields = $res->Fetch()) {
    $arResult['PACKAGE_GROUP'] = $arFields;
    $arResult['PACKAGE_GROUP']['PICTURE'] = CFile::ResizeImageGet($arFields['PICTURE'], array("width" => 360, "height" => 290), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
}
//получаем все готовые решения из группы
$res = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array("ACTIVE" => "Y", "IBLOCK_ID" => $packagesIblockId,"=ID"=>$packages, "=IBLOCK_SECTION_ID" => $parentPackageGroupId),
    false,
    false,
    array("ID", "PROPERTY_CO_CLASS_REF", "PROPERTY_P_COMPLECT")
);
$complectFirstIds = array();
while ($arFields = $res->Fetch()) {
    $complectsIds = $arFields["PROPERTY_P_COMPLECT_VALUE"];
    if (is_array($complectsIds)) {
        array_push($complectFirstIds, $complectsIds[0]);
    }
    $arResult['PACKAGE_GROUP']['PACKAGES'][$arFields['ID']] = $arFields;
}
//получаем первые в списке комплекты в каждом готовом решении из группы
$res = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array("ACTIVE" => "Y", "IBLOCK_ID" => $complectsIblockId, "ID" => $complectFirstIds)
);
while ($arFields = $res->Fetch()) {
    $arResult['FIRST_LIST_COMPLECTS'][$arFields['ID']] = $arFields;
}
//получаем все комлекты в текущем готовом решении
$res = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array("ACTIVE" => "Y", "IBLOCK_ID" => $complectsIblockId, "ID" => $arResult['COMPLECT_PARENT_PACKAGE']['PROPERTY_P_COMPLECT_VALUE']),
    false,
    false,
    array('*', 'CATALOG_GROUP_1')
);
while ($arFields = $res->Fetch()) {
    $arResult['ALL_LIST_COMPLECTS_IN_PACKAGE'][$arFields['ID']] = $arFields;
    $arResult['ALL_LIST_COMPLECTS_IN_PACKAGE'][$arFields['ID']]['PRICES_INFO'] = getPricesInfoByProductId($arFields['ID']);

}


$params = array(
    'IBLOCK_ID' => $companyCityAndSubscriptionFeeIblockId,
    'PACKAGE_ID' => $arResult['COMPLECT_PARENT_PACKAGE']['ID'],
    'COMPANY_CITY_IBLOCK_ID' => $companyCityIblockId,
    'COOKIE' => $_COOKIE
);
//получаем все элементы, которые содержат id абонентской платы в выбранном городе
$arElements = MainService::getSecureCompanyAndSubscriptionFeeListByPackageId($params);
$secureCompanyIds = array_column($arElements, 'PROPERTY_CPA_CHOP_VALUE');
$subscriptionFeeIds = array_column($arElements, 'PROPERTY_CPA_ABONPLATA_VALUE');
//получаем варианты абонплаты
$arSKU = CCatalogSKU::getOffersList(
    $subscriptionFeeIds,
    0,
    array('ACTIVE' => 'Y'),
    array('ID', 'NAME', 'CODE','CATALOG_GROUP_1','PROPERTY_APTP_MESYAC'),
    array()
);

//получаем все элементы ИБ Компания-Город
$res = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array("ACTIVE" => "Y", "IBLOCK_ID" => $companyCityIblockId, "ID" =>$secureCompanyIds)

);
while ($arFields = $res->Fetch()) {

     $arResult['ALL_LIST_COMPANY_CITY'][$arFields['ID']] = $arFields;

}

foreach ($arElements as $element) {

    if ($arSKU[$element['PROPERTY_CPA_ABONPLATA_VALUE']]) {
        $arResult['ALL_LIST_COMPANY_CITY'][$element['PROPERTY_CPA_CHOP_VALUE']]['SUBSCRIPTION_FEE'] = $arSKU[$element['PROPERTY_CPA_ABONPLATA_VALUE']];
    }
}
foreach ($arResult['ALL_LIST_COMPANY_CITY'] as $item) {
    foreach ($item['SUBSCRIPTION_FEE'] as $el) {
        $arResult['ALL_LIST_COMPANY_CITY'][$item['ID']]['SUBSCRIPTION_FEE'][$el['ID']]['PRICES_INFO'] = getPricesInfoByProductId($el['ID']);
    }
}
//получаем все страховки с вариантами
$res = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array("ACTIVE" => "Y", "IBLOCK_ID" => $insuranceIblockId)

);

$SKU_Ids = array();
while ($arFields = $res->Fetch()) {

    $arResult['ALL_INSURANCE_LIST'][$arFields['ID']] = $arFields;
    $SKU_Ids[] = $arFields['ID'];
}

$arSKU = CCatalogSKU::getOffersList(
    $SKU_Ids,
    0,
    array('ACTIVE' => 'Y'),
    array('ID', 'NAME', 'CODE','CATALOG_GROUP_1','PROPERTY_ILL','PROPERTY_MAX_PRICE',
    'PROPERTY_PAYMENT_OPTIONS','PROPERTY_PAYMENT_PRICE','PROPERTY_MAX_PRICE_TEXT'),
    array()
);

foreach ($arResult['ALL_INSURANCE_LIST'] as $item) {

    if ($arSKU[$item['ID']]) {
        $arResult['ALL_INSURANCE_LIST'][$item['ID']]['ITEMS'] = $arSKU[$item['ID']];
    }

}

foreach ($arResult['ALL_INSURANCE_LIST'] as $item) {
    foreach ($item['ITEMS'] as $el) {

        $arResult['ALL_INSURANCE_LIST'][$item['ID']]['ITEMS'][$el['ID']]['PICTURE'] = CFile::ResizeImageGet($el['PROPERTY_ILL_VALUE'], array("width" => 90, "height" => 110), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
        $arResult['ALL_INSURANCE_LIST'][$item['ID']]['ITEMS'][$el['ID']]['PRICES_INFO'] = getPricesInfoByProductId($el['ID']);

    }
}

//получаем весь справочник выплат по основным пунктам
$res = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array("ACTIVE" => "Y", "IBLOCK_ID" => $insurancePaymentOptionsIblockId),
    false,
    false,
    array("*","ID","PROPERTY_TEXT","PROPERTY_ICON")
);
while ($arFields = $res->Fetch()) {

    $arResult['ALL_INSURANCE_PAYMENT_OPTIONS_LIST'][$arFields['ID']] = $arFields;
}
//получаем весь справочник классов
$res = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array("ACTIVE" => "Y", "IBLOCK_ID" => $classesIblockId)
);
while ($arFields = $res->Fetch()) {
    $arResult['PACKAGES_CLASSES'][$arFields['ID']] = $arFields;
    $previewPicture = CFile::ResizeImageGet($arFields["PREVIEW_PICTURE"], array("width" => 110, "height" => 100), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
    $arResult['PACKAGES_CLASSES'][$arFields['ID']]['PICTURE'] = $previewPicture;
    $detailPicture = CFile::ResizeImageGet($arFields["DETAIL_PICTURE"], array("width" => 40, "height" => 40), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
    $arResult['PACKAGES_CLASSES'][$arFields['ID']]['ICON'] = $detailPicture;
}
//сформируем ссылки на первые в списке комплекты в каждом классе готовых решений
foreach ($arResult['PACKAGE_GROUP']['PACKAGES'] as $package) {

    $classId = $package['PROPERTY_CO_CLASS_REF_VALUE'];
    $complectId = $package['PROPERTY_P_COMPLECT_VALUE'][0];
    $slug = $arResult['FIRST_LIST_COMPLECTS'][$complectId]['CODE'];
    if (in_array($arResult['ID'], $package['PROPERTY_P_COMPLECT_VALUE'])) {
        $arResult['CURRENT_PACKAGE_CLASS'] = $classId;
        $slug = $arResult['CODE'];
    }
    $arResult['FIRST_LIST_COMPLECTS_SLUGS'][$classId] = array(
        "CLASS_ID" => $classId,
        "SLUG" => $slug
    );
}

/*
 * получить состав комплекта
 */

$arEquipSet = CCatalogProductSet::getAllSetsByProduct($arResult["ID"], CCatalogProductSet::TYPE_SET);
if (!empty($arEquipSet)) {
    $equipSet = reset($arEquipSet);
    $equipSetID = key($arEquipSet);
    $arResult["EQUIP_COMPLECT"] = array();
    $itemIds = array();
    $equipItemsTechCharacteristicsIds = array();
    $equipItemsCharacteristicsIds = array();
    foreach ($equipSet["ITEMS"] as $es) {
        array_push($itemIds, $es["ITEM_ID"]);
    }
    //получаем состав комплекта - все его оборудование
    $arSelect = array("ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE",
        "PROPERTY_EQUIPMENT_PICTURES", "PROPERTY_CO_CHARACTERISTICS_REF"
    , "PROPERTY_SENSOR_ADVANTAGES", "PROPERTY_PRINCIPLE_OF_OPERATION", "PROPERTY_FEATURES_OF_THE", "PROPERTY_CLASSIFICATION",
        "PROPERTY_TYPE_OF_INSTALLATION");
    $res = \CIBlockElement::GetList(array(), array("IBLOCK_ID" => $equipmentIblockId, "ID" => $itemIds, "ACTIVE" => "Y"), false,
        false, $arSelect);
    while ($arFields = $res->Fetch()) { // получаем сразу массив данных а не объект

        $picEnd = CFile::ResizeImageGet($arFields["PREVIEW_PICTURE"], array("width" => 90, "height" => 110), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);

        $equipmentPictures = array();
        foreach ($arFields["PROPERTY_EQUIPMENT_PICTURES_VALUE"] as $FILE) {
            $FILE = CFile::ResizeImageGet($FILE, array("width" => 170, "height" => 150), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
            if (is_array($FILE))
                $equipmentPictures[] = $FILE;
        }

        $techCharacteristicsIds = $arFields["PROPERTY_CO_TECH_CHARACTERISTICS_REF_VALUE"];
        if (is_array($techCharacteristicsIds)) {
            $equipItemsTechCharacteristicsIds = array_merge($equipItemsTechCharacteristicsIds, $techCharacteristicsIds);
        }

        $characteristicsIds = $arFields["PROPERTY_CO_CHARACTERISTICS_REF_VALUE"];
        if (is_array($characteristicsIds)) {
            $equipItemsCharacteristicsIds = array_merge($equipItemsCharacteristicsIds, $characteristicsIds);
        }

        $arResult["EQUIP_COMPLECT"][$arFields["ID"]] = array(
            "ID" => $arFields["ID"],
            "NAME" => $arFields["NAME"],
            "PREVIEW_TEXT" => $arFields["PREVIEW_TEXT"],
            "PREVIEW_PICTURE" => $picEnd["src"],
            "PREVIEW_PICTURE_MINI" => $picEnd["src"],
            "EQUIPMENT_PICTURES" => $equipmentPictures,
            "CHARACTERISTICS" => $characteristicsIds,
            "SENSOR_ADVANTAGES" => $arFields['PROPERTY_SENSOR_ADVANTAGES_VALUE'],
            "PRINCIPLE_OF_OPERATION" => $arFields['PROPERTY_PRINCIPLE_OF_OPERATION_VALUE'],
            "FEATURES_OF_THE" => $arFields['PROPERTY_FEATURES_OF_THE_VALUE'],
        );
    }
}

//получаем характеристики для оборудования
$res = \CIBlockElement::GetList(array(), array("IBLOCK_ID" => $equipmentCharacteristicsIblockId, "ID" => $equipItemsCharacteristicsIds, "ACTIVE" => "Y"), false,
    false, array("ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE"));
while ($arFields = $res->Fetch()) {
    $picEnd = CFile::ResizeImageGet($arFields["PREVIEW_PICTURE"], array("width" => 90, "height" => 110), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
    $arResult["EQUIP_ITEM_CHARACTERISTICS"][$arFields["ID"]] = array(
        "ID" => $arFields["ID"],
        "NAME" => $arFields["NAME"],
        "PREVIEW_TEXT" => $arFields["PREVIEW_TEXT"],
        "PREVIEW_PICTURE" => $picEnd["src"],
    );
}

//получаем Технические характеристики для оборудования
$res = \CIBlockElement::GetList(array(), array("IBLOCK_ID" => $equipmentTechCharacteristicsIblockId, "ACTIVE" => "Y"), false,
    false, array("ID", "*", "PROPERTY_EQ", "PROPERTY_EQ_CHAR_TYPE.NAME", "PROPERTY_EQ_CHAR_VALUE"));
while ($arFields = $res->Fetch()) {
    $arResult["EQUIP_ITEM_TECH_CHARACTERISTICS"][$arFields["ID"]] = $arFields;

}


foreach ($arResult['EQUIP_COMPLECT'] as $ec)
{
    foreach ($arResult['EQUIP_ITEM_TECH_CHARACTERISTICS'] as $techChar) {
        if($techChar['PROPERTY_EQ_VALUE'] === $ec['ID'])
        $arResult['EQUIP_COMPLECT'][$ec['ID']]["TECH_CHARACTERISTICS"][] = array(
            "EQ_CHAR_TYPE" => $techChar['PROPERTY_EQ_CHAR_TYPE_NAME'],
            "EQ_CHAR_VALUE" => $techChar['PROPERTY_EQ_CHAR_VALUE_VALUE'],
        );
    }

}

//получаем все картинки для оборудования
if (isset($arResult["DISPLAY_PROPERTIES"]["CO_CHARACTERISTICS_REF"]["LINK_ELEMENT_VALUE"])
    && is_array($arResult["DISPLAY_PROPERTIES"]["CO_CHARACTERISTICS_REF"]["LINK_ELEMENT_VALUE"])) {

    foreach ($arResult["DISPLAY_PROPERTIES"]["CO_CHARACTERISTICS_REF"]["LINK_ELEMENT_VALUE"] as $key => $item) {
        $arResult["DISPLAY_PROPERTIES"]["CO_CHARACTERISTICS_REF"]["LINK_ELEMENT_VALUE"][$key]['PREVIEW_PICTURE'] = CFile::GetFileArray($item['PREVIEW_PICTURE']);
    }
}
//изображение комплекта
$arResult['PREVIEW_PICTURE_RESIZED'] = CFile::ResizeImageGet($arResult['PREVIEW_PICTURE'], array("width" => 360, "height" => 290), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
$arResult['PREVIEW_PICTURE_RESIZED_SMALL'] = CFile::ResizeImageGet($arResult['PREVIEW_PICTURE'], array("width" => 110, "height" => 100), BX_RESIZE_IMAGE_PROPORTIONAL, false);
