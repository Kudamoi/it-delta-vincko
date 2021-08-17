<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/**
 * Bitrix component iblock.content (webgsite.ru)
 * Компонент для битрикс, работа с инфоблоком одностраничный вывод
 *
 * @author    Falur <ienakaev@ya.ru>
 * @link      https://github.com/falur/bitrix.com.iblock.content
 * @copyright 2015 - 2016 webgsite.ru
 * @license   GNU General Public License http://www.gnu.org/licenses/gpl-2.0.html
 */
?>

<section class="first__page_top container">
    <div class="slider__items top__slider-js">
        <? foreach($arResult["ITEMS"] as $elementId => $params): ?>
        <div class="slider__item">
            <div class="slider__item-left">
                <div class="text">
                    <?=$params["PREVIEW_TEXT"]?>
                </div>
                <div class="slider__item-left--button">
                    <a href="<?=$params["PROPERTIES"]["S_LINK"]["VALUE"]?>" class="button">Узнать больше</a>
                </div>
            </div>

            <div class="slider__item-right">
                <picture>
                    <source type="image/webp" srcset="<?=CFile::GetPath($params["PROPERTIES"]["PREVIEW_PICTURE_WEBP"]["VALUE"])?>">
                    <source type="image/png" srcset="<?=$params["PREVIEW_PICTURE"]["SRC"]?>">
                    <img src="<?=$params["PREVIEW_PICTURE"]["SRC"]?>" alt="img">
                </picture>
            </div>

        </div>
        <? endforeach; ?>
    </div>
</section>