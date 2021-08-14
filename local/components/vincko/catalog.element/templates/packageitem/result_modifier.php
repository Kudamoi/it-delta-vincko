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
$complectsCharacteristicsIblockId = 37;
$packagesCharacteristicsIblockId = 39;

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

$params = array(
    'IBLOCK_ID'=>9,
    'COOKIE'=>$_COOKIE
);

//найдем все готовые решения в текущем городе
$packages = MainService::getPackagesIds($params);
//если текущего готового решения нет в массиве доступных
if(!in_array($arResult['ID'],$packages))
    \Bitrix\Iblock\Component\Tools::process404("",true,true,true);

//получаем группу готового решения
$parentPackageGroupId = $arResult['IBLOCK_SECTION_ID'];
$res = CIBlockSection::GetList(
    array("SORT" => "ASC"),
    array("ACTIVE" => "Y", "IBLOCK_ID" => $packagesIblockId, "=ID" => $parentPackageGroupId),
    false,
    array("UF_CHARACTERISTICS_REF"),
    array("ID","*","PROPERTY_CO_CLASS_REF","PROPERTY_CO_CHARACTERISTICS_REF")
);
while ($arFields = $res->Fetch()) {
    $arResult['PACKAGE_GROUP'] = $arFields;
}
if(!empty($arResult['PACKAGE_GROUP']['UF_CHARACTERISTICS_REF']))
{
    //получаем характеристики для группы готовых решений
    $res = \CIBlockElement::GetList(array(), array("IBLOCK_ID" => $packagesCharacteristicsIblockId ,"ID"=>$arResult['PACKAGE_GROUP']['UF_CHARACTERISTICS_REF'], "ACTIVE" => "Y"), false,
        false, array("ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE","PROPERTY_CO_CHARACTERISTICS_REF"));
    while ($arFields = $res->Fetch()) {
        $picEnd = CFile::ResizeImageGet($arFields["PREVIEW_PICTURE"], array("width" => 90, "height" => 110), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
        $arResult["PACKAGE_GROUP_CHARACTERISTICS"][$arFields["ID"]] = array(
            "ID" => $arFields["ID"],
            "NAME" => $arFields["NAME"],
            "PREVIEW_TEXT" => $arFields["PREVIEW_TEXT"],
            "PREVIEW_PICTURE" => $picEnd["src"],
        );
    }
}

//получаем все готовые решения из группы
$res = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array("ACTIVE" => "Y", "IBLOCK_ID" => $packagesIblockId,"=ID"=>$packages, "=IBLOCK_SECTION_ID" => $parentPackageGroupId),
    false,
    false,
    array("ID","*","PROPERTY_CO_CLASS_REF", "PROPERTY_P_COMPLECT")
);
$complectFirstIds = array();
while ($arFields = $res->Fetch()) {
    $complectsIds = $arFields["PROPERTY_P_COMPLECT_VALUE"];
    if (is_array($complectsIds)) {
        array_push($complectFirstIds, $complectsIds[0]);
    }
    $arResult['PACKAGE_GROUP']['PACKAGES'][$arFields['ID']] = $arFields;
}

//получаем все комлекты в текущем готовом решении
$complectsCharacteristicsIds = array();
$res = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array("ACTIVE" => "Y", "IBLOCK_ID" => $complectsIblockId, "ID" => $arResult['PROPERTIES']['P_COMPLECT']['VALUE']),
    false,
    false,
    array('*', 'CATALOG_GROUP_1','PROPERTY_CO_CHARACTERISTICS_REF')
);
while ($arFields = $res->Fetch()) {
    $complectsCharacteristicsIds = array_merge($complectsCharacteristicsIds,$arFields['PROPERTY_CO_CHARACTERISTICS_REF_VALUE']);
    $arResult['ALL_LIST_COMPLECTS_IN_PACKAGE'][$arFields['ID']] = $arFields;
    $arResult['ALL_LIST_COMPLECTS_IN_PACKAGE'][$arFields['ID']]['PREVIEW_PICTURE'] = CFile::ResizeImageGet($arFields['PREVIEW_PICTURE'], array("width" => 110, "height" => 100), BX_RESIZE_IMAGE_PROPORTIONAL, false);
    $arResult['ALL_LIST_COMPLECTS_IN_PACKAGE'][$arFields['ID']]['PRICES_INFO'] = getPricesInfoByProductId($arFields['ID']);

}

$complectsCharacteristicsIds = array_unique($complectsCharacteristicsIds);
//получаем характеристики для комплектов
$res = \CIBlockElement::GetList(array(), array("IBLOCK_ID" => $complectsCharacteristicsIblockId ,"ID"=>$complectsCharacteristicsIds, "ACTIVE" => "Y"), false,
    false, array("ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE","PROPERTY_CO_CHARACTERISTICS_REF"));
while ($arFields = $res->Fetch()) {
    $picEnd = CFile::ResizeImageGet($arFields["PREVIEW_PICTURE"], array("width" => 90, "height" => 110), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
    $arResult["COMPLECTS_CHARACTERISTICS"][$arFields["ID"]] = array(
        "ID" => $arFields["ID"],
        "NAME" => $arFields["NAME"],
        "PREVIEW_TEXT" => $arFields["PREVIEW_TEXT"],
        "PREVIEW_PICTURE" => $picEnd["src"],
    );
}

$params = array(
    'IBLOCK_ID' => $companyCityAndSubscriptionFeeIblockId,
    'PACKAGE_ID' => $arResult['ID'],
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

//получим честный договор
$res = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array("ACTIVE" => "Y", "IBLOCK_CODE" => "contract"),
    false,
    false,
    array("ID","*","PROPERTY_CONTRACT")
);
while ($arFields = $res->Fetch()) {

    $arResult['FAIR_CONTRACT'] = $arFields;
    $arResult['FAIR_CONTRACT']['CONTRACT_LINK'] = CFile::GetPath($arFields['PROPERTY_CONTRACT_VALUE']);

}

//получаем все элементы ИБ Компания-Город
$res = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array("ACTIVE" => "Y", "IBLOCK_ID" => $companyCityIblockId, "ID" =>$secureCompanyIds),
    false,
    false,
    array("ID","*","PROPERTY_CONTRACT","PROPERTY_HONEST_CONTRACT")

);
while ($arFields = $res->Fetch()) {

    $arResult['ALL_LIST_COMPANY_CITY'][$arFields['ID']] = $arFields;
    $arResult['ALL_LIST_COMPANY_CITY'][$arFields['ID']]['CONTRACT_LINK'] = CFile::GetPath($arFields['PROPERTY_CONTRACT_VALUE']);

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
$arResult['CURRENT_PACKAGE_CLASS'] = $arResult['PROPERTIES']['CO_CLASS_REF']['VALUE'];
foreach ($arResult['PACKAGE_GROUP']['PACKAGES'] as $package) {

    $classId = $package['PROPERTY_CO_CLASS_REF_VALUE'];
    $slug = $package['CODE'];
    $arResult['PACKAGES_SLUGS'][$classId] = array(
        "CLASS_ID" => $classId,
        "SLUG" => $slug
    );
}



