<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Бонусный счет");
?><?$APPLICATION->IncludeComponent(
	"vincko:sale.personal.account",
	"vinckobill",
	Array(
		"SET_TITLE" => "N"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>