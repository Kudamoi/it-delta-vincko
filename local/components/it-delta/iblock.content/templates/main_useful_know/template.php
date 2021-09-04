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

<section class="must__now">
    <h2 class="container">Полезно знать</h2>
    <div class="must__now_items must__now_slider-js">
        <? foreach($arResult["ITEMS"] as $elementId => $item): ?>
        <div class="must__now_item-container">
            <div class="must__now_item">
                <div class="must__now_item-top">
                    <div class="head">
                        <span>vinco:охрана</span>
                    </div>
                    <span class="questions"><?=$item["NAME"]?></span>
                </div>
                <div class="must__now_item-bottom">
                    <div class="img">
                        <? if(!empty($item["PREVIEW_PICTURE"])) :?>
                            <img src="<?=$item["PREVIEW_PICTURE"]["SRC"]?>" alt="img">
                        <? endif; ?>
                    </div>
                </div>
            </div>
            <div class="must__now_item--pseudo-items must__now-pseudo_slider-js hide">
                <? foreach($item["PROPERTIES"]["PZ_TEXT"]["VALUE"] as $id => $answer): ?>
                <div class="must__now_item--pseudo">
                    <div class="must__now_item-top">
                        <div class="head">
                            <span>vinco:охрана</span>
                        </div>
                        <span class="questions"><?=$item["NAME"]?></span>
                    </div>
                    <div class="must__now_item-center">
                        <p class="text"><?=$answer["TEXT"]?></p>

                    </div>
                    <div class="img">
                        <img src="<?=CFile::GetPath($item["PROPERTIES"]["PZ_PIC"]["VALUE"][$id])?>" alt="img">
                    </div>
                </div>
                <? endforeach; ?>
            </div>
        </div>
        <? endforeach; ?>
    </div>
</section>