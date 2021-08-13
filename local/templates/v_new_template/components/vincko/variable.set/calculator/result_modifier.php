<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Vincko\Policy;

if ($arParams["PRODUCT_ID"] > 0) {
$arInsurance = CCatalogSKU::GetInfoByOfferIBlock($arParams["IBLOCK_ID"]);
	if (is_array($arInsurance)) {
		$rsOffers = CIBlockElement::GetList(
			[],
			[
				'IBLOCK_ID'                                   => $arInsurance['IBLOCK_ID'],
				'PROPERTY_' . $arInsurance['SKU_PROPERTY_ID'] => $arParams["PRODUCT_ID"]
			]
		);
		while ($arOffer = $rsOffers->GetNext()) {
			$arID[] = $arOffer["ID"];
			$arOffers[] = $arOffer;
		}
		$obOferBonuce = \CPrice::GetList(
			array(),
			array(
				"PRODUCT_ID"       => $arID,
				"CATALOG_GROUP_ID" => 2
			));
		while ($arOferBonuce = $obOferBonuce->Fetch()) {
			$arBonuce[$arOferBonuce["PRODUCT_ID"]] = $arOferBonuce["PRICE"];

		}
		foreach ($arOffers as $arOffer) {
			$arOffer["PRICES"]["BONUS"]["VALUE"] = $arBonuce[$arOffer["ID"]];

			$arResult["POLICIES"][] = Policy::formatPolicy($arOffer);
		}
	}
}




?>
