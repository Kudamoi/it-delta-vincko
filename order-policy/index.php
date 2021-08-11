<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Оформление страхового полиса");
?>
<main class="container main">
<?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new",
	"order-policy",
	array(
		"CACHE_TIME"             => "3600",
		"CACHE_TYPE"             => "N",
		"CHAIN_ITEM_LINK"        => "",
		"CHAIN_ITEM_TEXT"        => "",
		"EDIT_URL"               => "",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"LIST_URL"               => "",
		"SEF_MODE"               => "N",
		"USE_EXTENDED_ERRORS"    => "Y",
		"VARIABLE_ALIASES"       => array(
			"RESULT_ID"   => "RESULT_ID",
			"WEB_FORM_ID" => "WEB_FORM_ID"
		),
		"WEB_FORM_ID"            => "1",
		"PAY_TO_LIST" => "/order/",
		"BACK_LINK" => "/strahovanie/",
		"TITLE" => "Оформление заказа",
		"SUB_TITLE" => "Страхование"



	)
);?>
</main>
<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>