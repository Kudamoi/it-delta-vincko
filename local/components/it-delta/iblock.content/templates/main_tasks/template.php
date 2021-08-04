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

<section class="what__task">
    <div>
        <h2 class="container"><span>Какую задачу </span><br>
            вы хотите решить с <span>vincko:</span></h2>
        <div class="what__task_items what__task-js">

            <? foreach($arResult["ITEMS"] as $elementCount => $item): ?>
                <div class="what__task_item">
                    <a href="packages/?task=<?=$item["ID"]?>&company=">
                        <div class="what__task_item-top">
                            <picture>
                                <source type="image/webp" srcset="<?=$item['PREVIEW_PICTURE']['SRC']?>">
                                <source type="image/png" srcset="<?=$item['PREVIEW_PICTURE']['SRC']?>">
                                <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="img" loading="lazy">
                            </picture>
                        </div>
                        <div class="what__task_item-center">
                            <h3><?=$item['NAME'];?></h3>
                            <p><?=$item['PREVIEW_TEXT'];?></p>
                        </div>
                    </a>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</section>