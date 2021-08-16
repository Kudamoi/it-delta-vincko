<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if (!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
?>

<div class="rating-center__items_bottom-pagin">


    <? if ($arResult["NavPageNomer"] > 1): ?>
        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>#rating-center"
           class="rating-center__items_bottom-arrow" data-href="<?=$arResult["NavPageNomer"] - 1?>"><img src="/upload/rating/pagin-arrow-left.svg" alt="img"></a>
    <? else: ?>
        <a style="pointer-events: none" class="rating-center__items_bottom-arrow"><img
                    src="/upload/rating/pagin-arrow-left.svg" alt="img"></a>
    <? endif ?>
    <div class="rating-center__items_bottom-links">
        <? while ($arResult["nStartPage"] <= $arResult["nEndPage"]): ?>

            <? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
                <a class="active" style="pointer-events: none" href="#rating-center"><?= $arResult["nStartPage"] ?></a>
            <? elseif ($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false): ?>
                <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>#rating-center"><?= $arResult["nStartPage"] ?></a>
            <? else: ?>
                <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>#rating-center" data-href="<?= $arResult["nStartPage"] ?>"><?= $arResult["nStartPage"] ?></a>
            <? endif ?>
            <? $arResult["nStartPage"]++ ?>
        <? endwhile ?>


    </div>
    <? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>#rating-center"
           class="rating-center__items_bottom-arrow" data-href="<?=$arResult["NavPageNomer"] + 1?>"><img src="/upload/rating/pagin-arrow-right.svg" alt="img"></a>
    <? else: ?>
        <a style="pointer-events: none" href="#rating-center"
           class="rating-center__items_bottom-arrow"><img src="/upload/rating/pagin-arrow-right.svg" alt="img"></a>
    <? endif ?>


</div>