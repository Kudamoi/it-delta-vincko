<?php
$dbsocialLinks = CIBlockElement::GetList(
    array(),
    array("ACTIVE" => "Y", "IBLOCK_ID" => 56),
    false,
    false,
    array("NAME", "CODE", "PROPERTY_LINK")
);

while ($socialLink = $dbsocialLinks->Fetch()) {
    $arResult["LINKS"][] = $socialLink;
}

foreach ($arResult["ITEMS"] as $element => $item) {
    $src = CFile::GetFileArray($item["PROPERTIES"]["DOCUMENT"]["VALUE"]);

    $arResult["ITEMS"][$element]["PROPERTIES"]["DOCUMENT"]["DOCUMENT_INFO"] = $src;
}
?>