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

<section class="tasks">
    <div class="container">
        <div class="tasks__top">
            <div class="tasks__top_title">
                Посмотрите, <span>какие задачи</span> вы<br> можете решить с <span>vincko:</span>
            </div>
            <div class="tasks__top_subtitle">
                заказывая на платформе услуги одобренных компаний
            </div>
            <?/*<div class="tasks__top_text">
                <div class="tasks__top_text-icon">
                    <img src="/upload/rating/endorsements-icon_mini.svg" alt="img">
                </div>
                <div>
                    <p>Услуги компании <a class="item__content-company-not">
                            <select name="solutions__bottom_column-select" class="solutions__bottom_column-select">
                                <?foreach ($arResult['COMPANIES'] as $company):?>
                                    <option <?=isset($_GET['company']) && $_GET['company'] == $company['ID']? 'selected' : '';?> value="<?=$company['ID']?>"><?=$company['NAME']?></option>
                                <?endforeach;?>
                            </select>
                        </a>
                        в городе <a style="cursor: text" class="item__content-city"><?= $arResult['CURRENT_CITY']['NAME'] ?></a></p>
                </div>
            </div>*/?>
        </div>
        <div class="ready-des2__choice">
            <? foreach ($arResult['ITEMS'] as $item):
                $params = $item['PROPERTIES']['PACKAGES']['VALUE']; ?>
                <div class="choice-slide">
                    <a href="<?=$arParams['DETAIL_URL']."?task=".$item['ID'] ?>" class="ready-des2__choice-item" data-id="<?=$item['ID']?>">
                        <picture><img src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt=""></picture>
                        <span class="ready-des2__choice-title"><?= $item['NAME'] ?></span>
                        <span class="ready-des2__choice-desc"><?= $item['PREVIEW_TEXT'] ?></span>
                        <span class="ready-des2__choice-footer">
                    Смотреть решение
                </span>
                    </a>
                </div>
            <?php endforeach; ?>
            <div class="choice-slide ready-des2__choice-spec-item">
                <a href="<?=$arParams['DETAIL_URL']?>" class="ready-des2__choice-item ready-des2__choice-item ready-des2__choice-item--all" data-id="allC">
                    <span class="ready-des2__choice-title--all">Смотреть все Решения
                        <svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.24742 7.13991L0.451192 1.6585C-0.114569 1.01192 0.344609 0 1.20377 0H10.7962C11.6554 0 12.1146 1.01192 11.5488 1.6585L6.75258 7.13991C6.35417 7.59524 5.64583 7.59524 5.24742 7.13991Z"
                                  fill="#818181"/>
                        </svg>
                    </span>

                    <span class="ready-des2__choice-title--all-hover">Смотреть все Решения
                        <svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.69274 7.13991L0.896504 1.6585C0.330744 1.01192 0.789922 0 1.64908 0H11.2415C12.1007 0 12.5599 1.01192 11.9941 1.6585L7.19789 7.13991C6.79948 7.59524 6.09115 7.59524 5.69274 7.13991Z"
                                  fill="#93B6FF"/>
                        </svg>
                    </span>
                    <span class="ready-des2__choice-title--all-blue">Показаны все Решения
                        <svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.69274 7.13991L0.896504 1.6585C0.330744 1.01192 0.789922 0 1.64908 0H11.2415C12.1007 0 12.5599 1.01192 11.9941 1.6585L7.19789 7.13991C6.79948 7.59524 6.09115 7.59524 5.69274 7.13991Z"
                                  fill="#93B6FF"/>
                        </svg>
                    </span>
                </a>

            </div>


        </div>
    </div>
</section>

