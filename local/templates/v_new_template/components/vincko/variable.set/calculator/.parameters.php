<?php
if (!CModule::IncludeModule("lists"))
	return;

$strSelectedType = "equipment";

$arIBlocks = array();
$rsIBlocks = CIBlock::GetList(array("sort" => "asc"), array("TYPE" => $strSelectedType, "ACTIVE" => "Y"));
while ($ar = $rsIBlocks->Fetch()) {
	$arIBlocks[$ar["ID"]] = "[" . $ar["ID"] . "] " . $ar["NAME"];
}

$arTemplateParameters = array(
	"IBLOCK_ID"      => array(
		"PARENT"            => "BASE",
		"NAME"              => "Выберите инфоблок",
		"TYPE"              => "LIST",
		"VALUES"            => $arIBlocks,
		"ADDITIONAL_VALUES" => "Y",
		"DEFAULT"           => '={$_REQUEST["list_id"]}',
	),
	"PRODUCT_ID"     => array(
		"PARENT" => "BASE",
		"NAME"   => "Идентификатор товара",
		"TYPE"   => "STRING",
	),
	"TEXT1"          => array(
		"PARENT"  => "BASE",
		"NAME"    => "Текст 1",
		"TYPE"    => "STRING",
		"DEFAULT" => "Средняя заработная плата по городу",
	),
	"TEXT2"          => array(
		"PARENT"  => "BASE",
		"NAME"    => "Текст 2",
		"TYPE"    => "STRING",
		"DEFAULT" => "Москва",
	),
	"TEXT3"          => array(
		"PARENT"  => "BASE",
		"NAME"    => "Текст 3",
		"TYPE"    => "STRING",
		"DEFAULT" => "Тогда, при желаемом подарке в виде",
	),
	"TEXT4"          => array(
		"PARENT"  => "BASE",
		"NAME"    => "Текст 4",
		"TYPE"    => "STRING",
		"DEFAULT" => "(выберите из списка)",
	),
	"NUM"            => array(
		"PARENT"  => "BASE",
		"NAME"    => "Значение на ползунке",
		"TYPE"    => "STRING",
		"DEFAULT" => "75000",
	),
	"NUM_MAX"        => array(
		"PARENT"  => "BASE",
		"NAME"    => "Максимальное значение ползунка",
		"TYPE"    => "STRING",
		"DEFAULT" => "200000",
	),
	"NUM_MIN"        => array(
		"PARENT"  => "BASE",
		"NAME"    => "Минимальное значение ползунка",
		"TYPE"    => "STRING",
		"DEFAULT" => "5000",
	),
	"STEP"           => array(
		"PARENT"  => "BASE",
		"NAME"    => "Шаг",
		"TYPE"    => "STRING",
		"DEFAULT" => "5000",
	),
	"MEAS"           => array(
		"PARENT"  => "BASE",
		"NAME"    => "Размерность",
		"TYPE"    => "STRING",
		"DEFAULT" => "руб.",
	)
);
