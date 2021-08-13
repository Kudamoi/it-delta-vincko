<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Vincko\Policy;

// получим все варианты выплаты по основным пунктам страховки
$arAllPaymentOptions = Policy::getPaymentOptions();

$arInsurance = [
	"NAME"     => $arResult["NAME"],
];

// переберем все торговые предложения и сформируем необходимый массив
if (!empty($arResult["OFFERS"])) {
	foreach ($arResult["OFFERS"] as $arOffer) {
		if(empty($arOffer["PRICES"]["BONUS"]["VALUE"])){ continue; }
		$arResult["POLICIES"][] = Policy::formatPolicy($arOffer, $arAllPaymentOptions, $arInsurance);
	}
}

?>