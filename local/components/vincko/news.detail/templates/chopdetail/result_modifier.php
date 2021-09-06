<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
$chopID = $arResult["ID"];
$iblockID = $arResult["IBLOCK_ID"];
//дата обновления информации о ЧОПе
$arResult["CHOP_UPDATE"] = date("d.m.Y", strtotime($arResult["TIMESTAMP_X"]));
//данные, подгружаемые из "родительского" ЧОПа (дата создания, количество ЧОПов во всех городах, подтвержденный ЧОП
$chopAllRate = \Bitrix\Iblock\Elements\ElementChopTable::getByPrimary($arResult["DISPLAY_PROPERTIES"]["CHOP_ID"]["LINK_ELEMENT_VALUE"][$arResult["DISPLAY_PROPERTIES"]["CHOP_ID"]["VALUE"]]["ID"],array('select'=>array('CH_RATING_SUM', 'CH_CONFIRMED', 'CH_DATE_FROM', 'CH_DATE_ACTUAL')))->fetch();
$arResult["CH_ALL"] = number_format($chopAllRate["IBLOCK_ELEMENTS_ELEMENT_CHOP_CH_RATING_SUM_VALUE"],1,'.','');
//значение = 35 - это подтвержденный партнер
$arResult["CH_CONFIRMED"] = $chopAllRate["IBLOCK_ELEMENTS_ELEMENT_CHOP_CH_CONFIRMED_VALUE"] == 35 ? true : false;
$arResult["CHOP_CREATE"] = date("d.m.Y", strtotime($chopAllRate["IBLOCK_ELEMENTS_ELEMENT_CHOP_CH_DATE_ACTUAL_VALUE"]));
$chopAllCount = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "PROPERTY_CHOP_ID" => $arResult["DISPLAY_PROPERTIES"]["CHOP_ID"]["LINK_ELEMENT_VALUE"][$arResult["DISPLAY_PROPERTIES"]["CHOP_ID"]["VALUE"]]["ID"]), false, array(), array("ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_CITY_ID.NAME"));
$arCity = array();
while ($el = $chopAllCount->GetNextElement()){
	$res = $el->GetFields();
	$arCity[] = array(
		"NAME" => $res["NAME"],
		"CITY_NAME" => $res["PROPERTY_CITY_ID_NAME"],
		"DETAIL_PAGE_URL" => $res["DETAIL_PAGE_URL"]
	);
}
$arResult["CH_ALL_COUNT"] = $chopAllCount->SelectedRowsCount();
$arResult["CH_ALL_LIST"] = $arCity;

/*в новом ядре ещё не научились выводить свойства и фильтровать по ним, поэтому юзаем старый API*/
/*\Bitrix\Main\Loader::includeModule('iblock');
$reviews = \Bitrix\Iblock\ElementTable::getList(array("order" => array("SORT" => "ASC"), "select" => array("ID", "PREVIEW_TEXT", "PREVIEW_PICTURE", "NAME"), "filter" => array("IBLOCK_ID" => 15, "ACTIVE" => "Y"), "group" => array(), 'limit' => 3, 'offset' => 0));
*/

/*получаем список пакетов, с которыми работает ЧОП*/
$chopPackets = CIBlockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 12, "ACTIVE" => "Y", "ID" => $arResult["DISPLAY_PROPERTIES"]["CH_PACKETS"]["VALUE"]), false, array("nPageSize" => 5), array("IBLOCK_ID", "ID", "CODE", "LANG_DIR", "NAME", "PREVIEW_TEXT", "DETAIL_PAGE_URL", "PREVIEW_PICTURE", "PROPERTY_P_COMPLECT", "PROPERTY_P_COMPLECT.NAME", "PROPERTY_P_STRAHOVKA.NAME", "PROPERTY_P_ABONENTPLATA_Y", "PRICE_1", "PROPERTY_P_RED", "PROPERTY_P_BONUSES", "PROPERTY_P_OPTIONS"));
$arResult["CHOP_PACKETS"] = array();
while ($cpres = $chopPackets->GetNextElement()){
	//print_r ($cpres);die;
	//превью к пакету
	$pic = CFile::GetFileArray($cpres->fields["PREVIEW_PICTURE"]);
	//список торговых предложений-абонплат
	$chopPacketAbonplata = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 25, "PROPERTY_CPA_CHOP" => $chopID, "PROPERTY_CPA_PACKET" => $cpres->fields["ID"]), false, array(), array("ID", "PROPERTY_CPA_ABONPLATA"));
	$abonplataSKU = array();
	while ($cpap = $chopPacketAbonplata->GetNextElement()){
		$abonplata = CCatalogSKU::getOffersList(array($cpap->fields["PROPERTY_CPA_ABONPLATA_VALUE"]), 13, array(), array("NAME", "PRICE_1"), array());
		$abonplataSKU = $abonplata[$cpap->fields["PROPERTY_CPA_ABONPLATA_VALUE"]];
	};
	//список торговых предложений-страховок
	//$strahovkaSKU = CCatalogSKU::getOffersList(array($cpres->fields["PROPERTY_P_STRAHOVKA_VALUE"]), 14, array(), array("NAME"), array());
	$packetOptions = CIBlockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 26, "ACTIVE" => "Y", "ID" => $cpres->fields["PROPERTY_P_OPTIONS_VALUE"]), false, Array("nPageSize" => 15), array("ID", "NAME", "PREVIEW_PICTURE"));
	$optionsArr = array();
	foreach ($packetOptions->arResult as $idpo){
		$optionsArr[] = array(
			"NAME" => $idpo["NAME"],
			"ICON" => CFile::ResizeImageGet($idpo["PREVIEW_PICTURE"], array("width" => 24, "height" => 30), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false),
			"ICON2x" => CFile::ResizeImageGet($idpo["PREVIEW_PICTURE"], array("width" => 48, "height" => 60), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false)
		);
	}
	$arResult["CHOP_PACKETS"][] = array(
		"NAME" => $cpres->fields["NAME"],
		"PREVIEW_TEXT" => $cpres->fields["PREVIEW_TEXT"],
		"DETAIL_PAGE_URL" => $cpres->fields["DETAIL_PAGE_URL"],
		"PREVIEW_PICTURE" => $pic["SRC"],
		"PROPERTY_P_COMPLECT_VALUE" => $cpres->fields["PROPERTY_P_COMPLECT_VALUE"],
		"PROPERTY_P_COMPLECT_NAME" => $cpres->fields["PROPERTY_P_COMPLECT_NAME"],
		"P_ABONENTPLATA_Y" => $cpres->fields["PROPERTY_P_ABONENTPLATA_Y_VALUE"],
		"PRICE" => ceil($cpres->fields["PRICE_1"]),
		"COMPLECT_NAME" => $cpres->fields["PROPERTY_P_COMPLECT_NAME"],
		"ABONPLATA" => $abonplataSKU,
		"STRAHOVKA" => $cpres->fields["PROPERTY_P_STRAHOVKA_NAME"],
		"P_RED_VALUE" => $cpres->fields["P_RED_VALUE"],
		"P_BONUSES" => $cpres->fields["PROPERTY_P_BONUSES_VALUE"],
		"P_OPTIONS" => $optionsArr
	);
}

/*получаем услуги*/
if ($arResult["DISPLAY_PROPERTIES"]["CH_SERVICES"]){
	$chopServices = CIBlockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 21, "ACTIVE" => "Y", "ID" => $arResult["DISPLAY_PROPERTIES"]["CH_SERVICES"]["VALUE"]), false, array("nPageSize" => 5), array("ID", "NAME", "PREVIEW_TEXT"));
	$arResult["CHOP_SERVICES"] = $chopServices->arResult;
}

/*получаем отзывы*/
if ($arResult["IBLOCK_ID"] == 9){
	$reviews = CIBlockElement::GetList(array("PROPERTY_R_DATETIME" => "DESC"), array("IBLOCK_ID" => 16, "ACTIVE" => "Y", "PROPERTY_R_CHOP" => $chopID), false, Array("nPageSize" => 5), array("IBLOCK_ID", "ID", "NAME", "PROPERTY_R_RATING_SUM", "PROPERTY_R_CHOP", "PROPERTY_R_DATETIME", "PROPERTY_R_CITY", "PROPERTY_R_RATING_SUM", "PROPERTY_R_RATING_ZABOTA", "PROPERTY_R_RATING_SPASENIE", "PROPERTY_R_RATING_FINANCE", "PROPERTY_R_RATING_DOGOVOR", "PROPERTY_R_RATING_RECOMMEND", "PROPERTY_R_RATING_SERVICES", "PROPERTY_R_COMMENT", "PROPERTY_R_REVIEW_VERIFY"));
	$arResult["CHOP_REVIEWS_ALL_COUNT"] = $reviews->SelectedRowsCount();
} else {
	$citiesChops = CIBlockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "PROPERTY_CHOP_ID" => $chopID), false, Array(), array("ID"));
	$allCities = array();
	while ($cChop = $citiesChops->fetch()){
		$allCitiesIDs[] = $cChop["ID"];
	}
	//если надо будет добавить ID ЧОПа по всей России для случаев, когда оставили отзыв без привязки к региону
	//$allCitiesIDs[] = $chopID;
	$reviews = CIBlockElement::GetList(array("PROPERTY_R_DATETIME" => "DESC"), array("IBLOCK_ID" => 16, "ACTIVE" => "Y", "PROPERTY_R_CHOP" => $allCitiesIDs), false, Array("nPageSize" => 5), array("IBLOCK_ID", "ID", "NAME", "PROPERTY_R_RATING_SUM", "PROPERTY_R_CHOP", "PROPERTY_R_DATETIME", "PROPERTY_R_CITY", "PROPERTY_R_RATING_SUM", "PROPERTY_R_RATING_ZABOTA", "PROPERTY_R_RATING_SPASENIE", "PROPERTY_R_RATING_FINANCE", "PROPERTY_R_RATING_DOGOVOR", "PROPERTY_R_RATING_RECOMMEND", "PROPERTY_R_RATING_SERVICES", "PROPERTY_R_COMMENT", "PROPERTY_R_REVIEW_VERIFY"));
}
$res = array();
while ($rev = $reviews->fetch()){
	$res[] = $rev;
}
$arResult["CHOP_REVIEWS"] = $res;
?>