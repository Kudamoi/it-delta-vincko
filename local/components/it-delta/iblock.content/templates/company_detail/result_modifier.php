<?php
if (!isset($_GET['COMPANY'])):
    header("Location: /raiting/");
    die();
endif;

use Bitrix\Main\Loader;

Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

$arResult = $arResult['ITEMS'][0];


//Получаем всех пользователей
$order = array('sort' => 'asc');
$tmp = 'sort'; // параметр проигнорируется методом, но обязан быть
$paramUser = array("ID");
$rsUsers = CUser::GetList($order, $tmp);
while ($user = $rsUsers->GetNext()) {
    $arrUsers[$user['ID']]['ID'] = $user['ID'];
    $arrUsers[$user['ID']]['NAME'] = $user['NAME'];
}

//создаем заготовку под выборку отзывов
$hlbl = 5; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

//Честный договор
if ($arResult['PROPERTIES']['HONEST_CONTRACT']['VALUE_XML_ID'] == 'Y'):
    $contract = CIBlockElement::GetList(array(), array("IBLOCK_CODE" => 'contract', "ACTIVE" => "Y"), false, false, array("ID", "NAME", "PROPERTY_CONTRACT"));
    while ($cont = $contract->GetNext()) {
        $arResult['PROPERTIES']['HONEST_CONTRACT']['ID'] = $cont["ID"];
        $arResult['PROPERTIES']['HONEST_CONTRACT']['NAME'] = $cont["NAME"];
        $arResult['PROPERTIES']['HONEST_CONTRACT']['SRC'] = CFile::GetPath($cont["PROPERTY_CONTRACT_VALUE"]);
    }
endif;

//Собираем всех производителей
$manufactureCompanies = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 18, "ACTIVE" => "Y"), false, false, array("ID", "NAME"));

while ($manufacture = $manufactureCompanies->GetNext()) {
    $arrManufactures[$manufacture["ID"]]['ID'] = $manufacture["ID"];
    $arrManufactures[$manufacture["ID"]]['NAME'] = $manufacture["NAME"];
}

//Получаем все готовые решения в гп данной компании
$classes = CIBlockElement::GetList(array(), array("IBLOCK_CODE" => 'classes'), false, false, array('ID', 'NAME'));

while ($class = $classes->GetNext()) {
    $arClasses[$class['ID']] = $class;
}
$packs = CIBlockSection::GetList(array(), array("IBLOCK_CODE" => 'packets'), false, array('ID', 'NAME'));

while ($pack = $packs->GetNext()) {
    $arPackages[$pack['ID']] = $pack;
}
$complects = CIBlockElement::GetList(array(), array("IBLOCK_CODE" => 'complect'), false, false, array('ID', 'NAME'));

while ($complect = $complects->GetNext()) {
    $arComplect[$complect['ID']] = $complect;
}

$packages = CIBlockElement::GetList(array(), array("IBLOCK_CODE" => 'chop-packet-ap', "PROPERTY_CPA_CHOP" => $arResult['ID'], "ACTIVE" => "Y"/*, 'ID' => 1537*/), false, false, array('ID', 'NAME', 'PROPERTY_CPA_PACKET.NAME','PROPERTY_CPA_PACKET.PREVIEW_TEXT', 'PROPERTY_CPA_PACKET.IBLOCK_SECTION_ID', 'PROPERTY_CPA_PACKET.ID', 'PROPERTY_CPA_PACKET.PROPERTY_CO_CLASS_REF', 'PROPERTY_CPA_PACKET.DETAIL_PAGE_URL', "PROPERTY_CPA_ABONPLATA","PROPERTY_CPA_PACKET.PROPERTY_P_COMPLECT"));
while ($package = $packages->GetNext()) {
    $package['PROPERTY_CPA_PACKET_IBLOCK_SECTION_ID'] = $arPackages[$package['PROPERTY_CPA_PACKET_IBLOCK_SECTION_ID']];
    $package['PROPERTY_CPA_PACKET_NAME'] = substr(trim($package['PROPERTY_CPA_PACKET_NAME']), strpos(trim($package['PROPERTY_CPA_PACKET_NAME']), '"'));
    $package['PROPERTY_CPA_PACKET_DETAIL_PAGE_URL'] = preg_replace('[//]', '/', $package['PROPERTY_CPA_PACKET_DETAIL_PAGE_URL']);
    $package['PROPERTY_CPA_PACKET_PROPERTY_CO_CLASS_REF_VALUE'] = $arClasses[$package['PROPERTY_CPA_PACKET_PROPERTY_CO_CLASS_REF_VALUE']];
    $package['PROPERTY_CPA_PACKET_PROPERTY_P_COMPLECT_VALUE'] = $arComplect[$package['PROPERTY_CPA_PACKET_PROPERTY_P_COMPLECT_VALUE']];
    $idOfferContainer[] = $package['PROPERTY_CPA_ABONPLATA_VALUE'];
    $arrPackages[$package['ID']] = $package;
}

$idOfferContainer = array_unique($idOfferContainer);

foreach ($idOfferContainer as $id):
    $rsOffersId = CCatalogSKU::getOffersList(array('ID' => $id), false, false, array('ID'));
    foreach ($rsOffersId[$id] as $off):
        $idOffer[] = $off['ID'];
    endforeach;
    $offersList[$id] = $rsOffersId[$id];
endforeach;

$offers = CIBlockElement::GetList(array(), array("ID" => $idOffer), false, false, array("ID", 'CATALOG_GROUP_1', 'PROPERTY_APTP_MESYAC'));

while ($arOffer = $offers->GetNext()) {

    $arOffers[$arOffer['ID']]['ID'] = $arOffer['ID'];
    $arOffers[$arOffer['ID']]['MONTH'] = $arOffer['PROPERTY_APTP_MESYAC_VALUE'];
    $arOffers[$arOffer['ID']]['PRICE'] = $arOffer['CATALOG_PRICE_1'];
}

foreach ($offersList as &$offer):
    $keys = array_keys($offer);
    foreach ($keys as $key):
        $offer[$key] = $arOffers[$key];
    endforeach;
endforeach;

foreach ($arrPackages as &$package):
    $package['PROPERTY_CPA_ABONPLATA_VALUE'] = array_values($offersList[$package['PROPERTY_CPA_ABONPLATA_VALUE']]);
endforeach;

//Получаем города в котороых есть эта компания
$companies = CIBlockElement::GetList(array(), array("IBLOCK_CODE" => 'chopcity', 'PROPERTY_CHOP_ID' => $arResult['PROPERTIES']['CHOP_ID']['VALUE'], "ACTIVE" => "Y"), false, false, array("ID", "PROPERTY_CITY_ID.ID", "PROPERTY_CITY_ID.NAME", "PROPERTY_CHOP_ID.ID", "PROPERTY_CHOP_ID.NAME", "PROPERTY_CHOP_ID.PROPERTY_CH_ABOUT_COMPANY", 'PROPERTY_CHOP_ID.PROPERTY_CH_DATE_FROM', 'PROPERTY_CHOP_ID.PROPERTY_CH_DATE_ACTUAL', 'PROPERTY_MANUFACTURERS'));
while ($company = $companies->GetNext()) {
    $arrCities[$company['ID']]['CITY_COMPANY_ID'] = $company['ID'];
    $arrCities[$company['ID']]['CITY_ID'] = $company['PROPERTY_CITY_ID_ID'];
    $arrCities[$company['ID']]['CITY_NAME'] = $company['PROPERTY_CITY_ID_NAME'];
    $arrCities[$company['ID']]['COMPANY_ID'] = $company['PROPERTY_CHOP_ID_ID'];
    $arrCities[$company['ID']]['COMPANY_NAME'] = $company['PROPERTY_CHOP_ID_NAME'];
    if (empty($arResult['ABOUT_COMPANY'])) {
        $arResult['ABOUT_COMPANY']['DESC'] = $company['PROPERTY_CHOP_ID_PROPERTY_CH_ABOUT_COMPANY_VALUE']['TEXT'];
        $arResult['ABOUT_COMPANY']['START'] = $company['PROPERTY_CHOP_ID_PROPERTY_CH_DATE_FROM_VALUE'];
        $arResult['ABOUT_COMPANY']['ACTUAL'] = $company['PROPERTY_CHOP_ID_PROPERTY_CH_DATE_ACTUAL_VALUE'];
    }
    if ($company['PROPERTY_CITY_ID_ID'] == $arResult['PROPERTIES']['CITY_ID']['VALUE']):
        $arResult['ABOUT_COMPANY']['CURRENT_COMPANY'] = $company['PROPERTY_CHOP_ID_ID'];
        foreach ($company['PROPERTY_MANUFACTURERS_VALUE'] as $manufacture):
            $arResult['MANUFACTURE'][$manufacture] = $arrManufactures[$manufacture];
        endforeach;
    endif;

}

//Собираем статусы компаний
$statusCompany = CIBlockElement::GetList(array(), array("IBLOCK_CODE" => 'ststus', "ACTIVE" => "Y"), false, false, array("ID", "NAME", "PREVIEW_PICTURE"));
while ($status = $statusCompany->GetNext()) {
    $arrStatus[$status["ID"]]['ID'] = $status["ID"];
    $arrStatus[$status["ID"]]['NAME'] = $status["NAME"];
    $arrStatus[$status["ID"]]['PICTURE'] = CFile::GetPath($status["PREVIEW_PICTURE"]);
}

//Получаем все отзывы компании
$reviews = $entity_data_class::getList(array("select" => array("*"), "order" => array("UF_ALLSCORE_REVIEW_SCORE" => "DESC"), 'filter' => array('UF_CITY_ID' => $arResult['PROPERTIES']['CITY_ID']['VALUE'], 'UF_CHOP_ID' => $arResult['PROPERTIES']['CHOP_ID']['VALUE'])));

while ($review = $reviews->fetch()) {

    $arResult['REVIEWS'][$review["ID"]]['ID'] = $review["ID"];
    $arResult['REVIEWS'][$review["ID"]]['NAME'] = !empty($review['UF_USER_NAME']) ? $review["UF_USER_NAME"] : $arrUsers[$review['UF_USER_ID']]['NAME'];
    $arResult['REVIEWS'][$review["ID"]]['COMMENT'] = $review['UF_ALLSCORE_REVIEW_SCORE_COMMENT'];
    $arResult['REVIEWS'][$review["ID"]]['TYPE'] = $review['UF_REVIEW_TYPE_ID'];
    $arResult['REVIEWS'][$review["ID"]]['CITY'] = $arrCities[$review['UF_CITY_ID']];
    $arResult['REVIEWS'][$review["ID"]]['ALLSCORE'] = $review['UF_ALLSCORE_REVIEW_SCORE'];
    $arResult['REVIEWS'][$review["ID"]]['CUSTOMER'] = $review['UF_CUSTOMER_FOCUS_SCORE'];
    $arResult['REVIEWS'][$review["ID"]]['COMFORT'] = $review['UF_COMFORT_SCORE'];
    $arResult['REVIEWS'][$review["ID"]]['SECURITY'] = $review['UF_SECURITY_SCORE'];
}


//Получаем позицию
$arrPositions = MainService::calculateSecureCompanyRatingPositionsByCityId($arResult['PROPERTIES']['CITY_ID']['VALUE']);

$_monthsList = array(
    "1" => "Январь", "2" => "Февраль", "3" => "Март",
    "4" => "Апрель", "5" => "Май", "6" => "Июнь",
    "7" => "Июль", "8" => "Август", "9" => "Сентябрь",
    "10" => "Октябрь", "11" => "Ноябрь", "12" => "Декабрь");
$arResult['CURRENT_MONTH'] = $_monthsList[date("n")];

$arResult['OFFERS'] = $arrPackages;
foreach ($arResult['OFFERS'] as $offer) {
    empty($arResult['GROUP_OFFERS'][$offer['PROPERTY_CPA_PACKET_IBLOCK_SECTION_ID']['ID']]['NAME']) ? $arResult['GROUP_OFFERS'][$offer['PROPERTY_CPA_PACKET_IBLOCK_SECTION_ID']['ID']]['NAME'] = $offer['PROPERTY_CPA_PACKET_IBLOCK_SECTION_ID']['NAME'] : '';
    $arResult['GROUP_OFFERS'][$offer['PROPERTY_CPA_PACKET_IBLOCK_SECTION_ID']['ID']]['ITEMS'][] = $offer['ID'];
}

$arResult['CHOP_DETAIL'] = $arrCities[$arResult['ID']];
$arResult['POSITION'] = $arrPositions[$arResult['PROPERTIES']['CHOP_ID']['VALUE']]['POSITION_IN_RATING'];
$arResult['STATUS_COMPANY'] = $arrStatus[$arResult['PROPERTIES']['STATUS_COMPANY']['VALUE']];
$arResult['PROPERTIES']['CONTRACT']['VALUE'] = CFile::GetPath($arResult['PROPERTIES']['CONTRACT']['VALUE']);
$arResult['CITIES'] = $arrCities;