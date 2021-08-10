<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавление отзыва");

$APPLICATION->IncludeComponent(
	"it-delta:iblock.content",
	"reviews_add_review",
	Array(
		"ACTIVE_DATE" => "N",
		"ADD_CACHE_STRING" => "",
		"CACHE_TIME" => "0",
		"CACHE_TYPE" => "A",
		"FILTER_NAME" => "arrFilter1",
		"IBLOCK_ID" => "46",
		"IBLOCK_TYPE" => "Articles",
		"PAGE_ELEMENT_COUNT" => "10",
		"RAND_ELEMENTS" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC"
	)
);
?>⁠

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>