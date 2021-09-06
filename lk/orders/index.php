<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Все заказы");
?><?$APPLICATION->IncludeComponent(
	"vincko:sale.personal.order",
	"vinckolkorders",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ALLOW_INNER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CUSTOM_SELECT_PROPS" => array(""),
		"DETAIL_HIDE_USER_INFO" => array(),
		"DISALLOW_CANCEL" => "N",
		"HISTORIC_STATUSES" => array("F"),
		"NAV_TEMPLATE" => "",
		"ONLY_INNER_FULL" => "N",
		"ORDERS_PER_PAGE" => "20",
		"ORDER_DEFAULT_SORT" => "ACCOUNT_NUMBER",
		"PATH_TO_BASKET" => "",
		"PATH_TO_CATALOG" => "/pakety-okhrannykh-uslug/",
		"PATH_TO_PAYMENT" => "/personal/order/payment/",
		"PROP_3" => array(""),
		"PROP_4" => array(""),
		"REFRESH_PRICES" => "N",
		"RESTRICT_CHANGE_PAYSYSTEM" => array("F","N","P"),
		"SAVE_IN_SESSION" => "Y",
		"SEF_MODE" => "N",
		"SET_TITLE" => "Y",
		"STATUS_COLOR_F" => "gray",
		"STATUS_COLOR_N" => "red",
		"STATUS_COLOR_P" => "green",
		"STATUS_COLOR_PSEUDO_CANCELLED" => "red"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>