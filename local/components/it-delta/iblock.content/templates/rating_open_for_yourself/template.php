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

//echo '<pre>';
//print_r($arResult);
//echo '</pre>';
?>

<section class="open__for open__for__yourself">
    <div class="container">
        <h2>Откройте для себя <span>vincko:</span></h2>
        <ul class="open__for-items">
            <?foreach ($arResult['ITEMS'] as $item):?>
            <li class="open__for-item">
                <a href="<?=$item['CODE']?>">
                    <p class="top">
                        <span class="icon">
                            <picture>
                                <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="alt" loading="lazy">
                            </picture>
                        </span>
                        <span class="text"><?=$item['NAME']?></span>
                        <span class="link"><?=$item['PROPERTIES']['TEXT_BUTTON']['VALUE']?></span>
                    </p>
                    <p class="text__adout">
                        <?=$item['PREVIEW_TEXT']?>
                    </p>
                </a>
            </li>
            <?endforeach;?>

        </ul>
    </div>
</section>

