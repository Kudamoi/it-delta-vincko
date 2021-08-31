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

<section class="reputation__rating">
    <div class="container">
        <div class="reputation__rating_top">
            <div class="left">
                <h2><span>Репутационный рейтинг</span> охранных компаний</h2>
                <p class="description">Рейтинг формируется на основании отзывов об охранных организациях,
                    которые пользователи оставляют на платформе <span>vincko:</span></p>
            </div>
            <div class="right">
                <a href="raiting/" class="button">СМОТРЕТЬ весь РЕЙТИНГ</a>
            </div>
        </div>
        <div class="reputation__rating-mobil__show">
            <picture>
                <source type="image/png" srcset="<?=SITE_TEMPLATE_PATH?>/img/first__page/raiting/raiting_bg.png">
                <img src="<?=SITE_TEMPLATE_PATH?>/img/first__page/raiting/raiting_bg.png" alt="img">
            </picture>
        </div>
        <div class="reputation__rating_center"
            style="background-image: url(<?=SITE_TEMPLATE_PATH?>/img/first__page/raiting/raiting_bg.png);">
            <div class="reputation__rating_center-form">
                <form onchange="return reputationRatingFilter.setFilter();">
                    <select class="reputation__rating_select-js">
                        <? foreach ($arResult['CITIES'] as $item): ?>
                            <option <?=$_COOKIE['selected_city'] == $item['ID'] ? 'selected' : '';?> value="<?=$item['ID']?>"><?=$item["NAME"]?></option>
                            <? endforeach; ?>
                    </select>
                </form>
            </div>
            <div class="reputation__rating_center-items">
                <? foreach ($arResult['ITEMS'] as $item): ?>
                    <div class="reputation__rating_center-item <?=(++$i > 5) ? "hide" : ""?>">
                        <div class="info__block">
                            <div class="item_left">
                                <span class="icon">
                                    <? if((100/5)*$item["CH_RATING_SUM"]["VALUE"] == 100): ?>
                                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="18" cy="18" r="17" fill="white" stroke="#005DFF" stroke-width="2" />
                                        </svg>
                                    <? else: ?>
                                        <svg width="54" height="44" viewBox="0 0 54 44" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M52 17.0646C52 21.0211 51.0561 24.9209 49.2462 28.4416C47.4363 31.9623 44.8125 35.0029 41.5914 37.3122C38.3704 39.6214 34.6447 41.133 30.7221 41.7221C26.7995 42.3112 22.7927 41.9607 19.0328 40.6998C15.2728 39.4389 11.8677 37.3037 9.09867 34.4706C6.32967 31.6376 4.27634 28.1879 3.10832 24.4068C1.94031 20.6257 1.69115 16.6216 2.38143 12.7254C3.07172 8.82926 4.68163 5.15286 7.07814 2"
                                                stroke="#005DFF" stroke-width="4" />
                                        </svg>
                                    <? endif; ?>
                                </span>
                                <span class="text"><?=str_replace(".", ",", sprintf("%01.1f", $item["CH_RATING_SUM"]))?></span>
                            </div>
                            <div class="item_center">
                                <span class="item_center-company_numder"><?=$i?></span>
                                <span class="item_center-company_name"><?=$item["NAME"]?></span>
                                <? if($item['STATUS_COMPANY']['PICTURE']): ?>
                                    <span class="icon">
                                    <img src="<?=$item['STATUS_COMPANY']['PICTURE']?>"
                                        alt="<?=$item['STATUS_COMPANY']['NAME']?>" width="26" height="28">
                                    </span>
                                <? endif ?>
                            </div>
                        </div>
                        <div class="item_right">
                            <span class="item_right--pseudo" style="width: <?=(100/5)*$item["CH_RATING_SUM"]["VALUE"]?>%;">
                                <span class="text"><?=str_replace(".", ",", sprintf("%01.1f", $item["CH_RATING_SUM"]))?></span>
                            </span>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
            <div class="show__more">
                <a href="raiting/"><span class="button">Смотреть ещё</span></a>
            </div>
        </div>
        <div class="reputation__rating_bottom">
            <p class="top">
                <span class="icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17.7876 2.45603C18.337 2.36618 18.854 2.74232 18.9376 3.29273L19.3326 5.89268C19.3801 6.2056 19.573 6.47755 19.8526 6.62587L22.137 7.83773C22.6128 8.09013 22.8032 8.67398 22.5677 9.15834L21.3968 11.5669C21.2623 11.8436 21.2627 12.1669 21.3978 12.4433L22.5736 14.8482C22.8111 15.3341 22.6193 15.9207 22.1407 16.1725L19.835 17.3853C19.5538 17.5332 19.3596 17.806 19.3119 18.1201L18.9172 20.7183C18.8336 21.2685 18.3168 21.6447 17.7675 21.5551L15.3129 21.1547C14.9891 21.1018 14.66 21.2112 14.4322 21.4473L12.6929 23.25C12.2982 23.6591 11.6424 23.6574 11.2499 23.2462L9.5007 21.4135C9.27066 21.1725 8.93568 21.0618 8.60734 21.1185L6.19799 21.534C5.64651 21.6291 5.12431 21.2532 5.03956 20.7L4.6373 18.0746C4.58943 17.7622 4.3967 17.4908 4.11751 17.3426L1.85463 16.1421C1.37813 15.8893 1.18801 15.3041 1.42492 14.8195L2.60128 12.4133C2.73695 12.1358 2.73676 11.8112 2.60076 11.5338L1.43471 9.15585C1.1978 8.67271 1.38568 8.08872 1.85986 7.83436L4.15166 6.60499C4.42879 6.45633 4.61984 6.18597 4.66743 5.87511L5.06013 3.31028C5.1448 2.75723 5.66675 2.38124 6.21815 2.4761L8.63706 2.89223C8.9659 2.9488 9.30128 2.83763 9.53122 2.59585L11.2793 0.757841C11.672 0.344903 12.3299 0.34314 12.7248 0.753966L14.4625 2.56166C14.6904 2.79873 15.0203 2.9086 15.3449 2.85552L17.7876 2.45603Z"
                            fill="#35A34A" />
                        <path
                            d="M15.6828 9.21009L11.3178 13.2681L9.31723 11.4082C9.01594 11.1281 8.52735 11.128 8.22601 11.4081C7.92466 11.6883 7.92466 12.1425 8.22601 12.4226L10.7721 14.7899C10.9168 14.9244 11.1131 15 11.3177 15C11.3178 15 11.3177 15 11.3178 15C11.5224 15 11.7187 14.9244 11.8634 14.7899L16.774 10.2246C17.0753 9.94448 17.0753 9.4903 16.774 9.21014C16.4727 8.92999 15.9841 8.92994 15.6828 9.21009Z"
                            fill="white" />
                    </svg>
                </span>
                <span class="text">Компании-партнеры vincko:</span>
            </p>
            <p class="bottom">
                При заказе услуг компаний, одобренных <span>vincko:</span> вы получаете
                наши <a href="">гарантии</a> и подарки.
            </p>
        </div>
    </div>
</section>