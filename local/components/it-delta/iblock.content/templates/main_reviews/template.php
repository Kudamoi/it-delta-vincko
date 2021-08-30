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

<section class="you__reviews">
    <div class="container">
        <div class="you__reviews_head">
            <h2><span>Ваши отзывы</span> влияют<br>
                на рейтинг охранных компаний</h2>
            <a href="reviews/" class="button">Смотреть все отзывы</a>
        </div>
        <div class="you__reviews_items you__reviews_slider-js">
            <!-- vinco__raityng - класс для рейтинга vinco (для него меняються стили и иконки) -->
            <? foreach($arResult["ITEMS"] as $item): ?>
            <? $city = CIBlockElement::GetList(array("SORT"=>"ASC"), array("ID" => $item["PROPERTIES"]["R_CHOP"]["VALUE"]), false, false, array("PROPERTY_CITY_ID"))->fetch();?>
            <? if($_COOKIE['selected_city'] == $city['PROPERTY_CITY_ID_VALUE']): ?>
            <div class="you__reviews_item <?=($item["PROPERTIES"]["R_SOURCE"]["VALUE_ENUM"] == "Vincko") ? "vinco__raityng" : ""?>">
                <div class="you__reviews_item-top">
                    <div class="top_user">
                        <div class="top_user-avatar">
                            <picture>
                                <source type="image/webp" srcset="<?=SITE_TEMPLATE_PATH?>/img/first__page/you__reviews/avatar.webp">
                                <source type="image/png" srcset="<?=SITE_TEMPLATE_PATH?>/img/first__page/you__reviews/avatar.png">
                                <img src="<?=SITE_TEMPLATE_PATH?>/img/first__page/you__reviews/avatar.png" alt="img" loading="lazy">
                            </picture>
                        </div>
                        <div class="top_user-about">
                            <? $userName = CUser::GetByID($item["PROPERTIES"]["R_USER_ID"]["VALUE"])->fetch(); ?>
                            <span class="name"><?=$userName["NAME"].' '.$userName["LAST_NAME"];?></span>
                            <div class="name-info">
                                <span class="text">покупатель</span>
                                <span class="icon">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7 0C5.61553 0 4.26215 0.410543 3.11101 1.17971C1.95987 1.94888 1.06266 3.04213 0.532846 4.32121C0.00303299 5.6003 -0.13559 7.00776 0.134506 8.36563C0.404603 9.7235 1.07129 10.9708 2.05026 11.9497C3.02922 12.9287 4.2765 13.5954 5.63437 13.8655C6.99224 14.1356 8.3997 13.997 9.67879 13.4672C10.9579 12.9373 12.0511 12.0401 12.8203 10.889C13.5895 9.73784 14 8.38447 14 7C14 6.08075 13.8189 5.17049 13.4672 4.32121C13.1154 3.47194 12.5998 2.70026 11.9497 2.05025C11.2997 1.40024 10.5281 0.884626 9.67879 0.532843C8.82951 0.18106 7.91925 0 7 0ZM7 11.2C6.86156 11.2 6.72622 11.1589 6.6111 11.082C6.49599 11.0051 6.40627 10.8958 6.35329 10.7679C6.3003 10.64 6.28644 10.4992 6.31345 10.3634C6.34046 10.2276 6.40713 10.1029 6.50503 10.005C6.60292 9.90713 6.72765 9.84046 6.86344 9.81345C6.99923 9.78644 7.13997 9.8003 7.26788 9.85328C7.39579 9.90626 7.50511 9.99598 7.58203 10.1111C7.65895 10.2262 7.7 10.3616 7.7 10.5C7.7 10.6856 7.62625 10.8637 7.49498 10.995C7.3637 11.1262 7.18565 11.2 7 11.2ZM7.7 7.588V8.4C7.7 8.58565 7.62625 8.7637 7.49498 8.89497C7.3637 9.02625 7.18565 9.1 7 9.1C6.81435 9.1 6.6363 9.02625 6.50503 8.89497C6.37375 8.7637 6.3 8.58565 6.3 8.4V7C6.3 6.81435 6.37375 6.6363 6.50503 6.50502C6.6363 6.37375 6.81435 6.3 7 6.3C7.20767 6.3 7.41068 6.23842 7.58335 6.12304C7.75602 6.00767 7.8906 5.84368 7.97008 5.65182C8.04955 5.45995 8.07034 5.24883 8.02983 5.04515C7.98931 4.84147 7.88931 4.65438 7.74246 4.50754C7.59562 4.36069 7.40853 4.26069 7.20485 4.22017C7.00117 4.17966 6.79005 4.20045 6.59818 4.27993C6.40632 4.3594 6.24233 4.49398 6.12696 4.66665C6.01158 4.83932 5.95 5.04233 5.95 5.25C5.95 5.43565 5.87625 5.6137 5.74498 5.74497C5.6137 5.87625 5.43565 5.95 5.25 5.95C5.06435 5.95 4.8863 5.87625 4.75503 5.74497C4.62375 5.6137 4.55 5.43565 4.55 5.25C4.54817 4.79521 4.67296 4.34889 4.91041 3.961C5.14785 3.57311 5.48858 3.25898 5.89443 3.05375C6.30029 2.84853 6.75526 2.76033 7.2084 2.79901C7.66155 2.8377 8.09498 3.00176 8.46017 3.27281C8.82536 3.54387 9.1079 3.91122 9.27615 4.33375C9.44441 4.75627 9.49173 5.21729 9.41283 5.66518C9.33393 6.11308 9.13191 6.53017 8.82941 6.86977C8.5269 7.20936 8.13583 7.45805 7.7 7.588Z"
                                            fill="#93B5FF" />
                                    </svg>
                                </span>
                                <div class="icon__pseudo">
                                    <??>
                                    <p>Это отзыв покупателя платформы <a href="">vincko:</a></p>
                                    <p> Преимущество <a href="">vincko:</a> отзыва перед остальными в том, что
                                        он
                                        оставлен
                                        <span>реальным пользователем платформы</span> и содержит информацию о
                                        настоящем
                                        опыте сотрудничества с компанией.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="top_rigt-raityng">
                        <span class="text"><?=$item["PROPERTIES"]["R_RATING_SUM"]["VALUE"];?></span>
                        <span class="icon">
                            <svg width="54" height="44" viewBox="0 0 54 44" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M52 17.0646C52 21.0211 51.0561 24.9209 49.2462 28.4416C47.4363 31.9623 44.8125 35.0029 41.5914 37.3122C38.3704 39.6214 34.6447 41.133 30.7221 41.7221C26.7995 42.3112 22.7927 41.9607 19.0328 40.6998C15.2728 39.4389 11.8677 37.3037 9.09867 34.4706C6.32967 31.6376 4.27634 28.1879 3.10832 24.4068C1.94031 20.6257 1.69115 16.6216 2.38143 12.7254C3.07172 8.82926 4.68163 5.15286 7.07814 2"
                                    stroke="<?=($item["PROPERTIES"]["R_SOURCE"]["VALUE_ENUM"] == "Vincko") ? "#005DFF" : "#FDE74C"?>" stroke-width="4" />
                            </svg>
                        </span>
                    </div>
                    <div class="top_bottom-raityng">
                        <p class="left">
                            <span class="icon">
                                <svg width="16" height="13" viewBox="0 0 16 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.5 4.25L0.5 5.25C0.5 5.44891 0.579017 5.63968 0.71967 5.78033C0.860323 5.92098 1.05109 6 1.25 6L14.75 6C14.9489 6 15.1397 5.92098 15.2803 5.78033C15.421 5.63968 15.5 5.44891 15.5 5.25L15.5 4.25C15.5 4.05109 15.421 3.86032 15.2803 3.71967C15.1397 3.57902 14.9489 3.5 14.75 3.5L1.25 3.5C1.05109 3.5 0.860323 3.57902 0.71967 3.71967C0.579017 3.86032 0.5 4.05109 0.5 4.25ZM0.499999 12.25L0.5 11.25C0.5 11.0511 0.579017 10.8603 0.71967 10.7197C0.860322 10.579 1.05109 10.5 1.25 10.5L12.25 10.5C12.4489 10.5 12.6397 10.579 12.7803 10.7197C12.921 10.8603 13 11.0511 13 11.25L13 12.25C13 12.4489 12.921 12.6397 12.7803 12.7803C12.6397 12.921 12.4489 13 12.25 13L1.25 13C1.05109 13 0.860322 12.921 0.71967 12.7803C0.579017 12.6397 0.499999 12.4489 0.499999 12.25ZM0.5 7.75L0.5 8.75C0.5 8.94891 0.579017 9.13968 0.71967 9.28033C0.860323 9.42098 1.05109 9.5 1.25 9.5L8.75 9.5C8.94891 9.5 9.13968 9.42098 9.28033 9.28033C9.42098 9.13968 9.5 8.94891 9.5 8.75L9.5 7.75C9.5 7.55109 9.42098 7.36032 9.28033 7.21967C9.13968 7.07902 8.94891 7 8.75 7L1.25 7C1.05109 7 0.860323 7.07902 0.71967 7.21967C0.579017 7.36032 0.5 7.55109 0.5 7.75ZM0.5 0.749999L0.5 1.75C0.5 1.94891 0.579018 2.13968 0.71967 2.28033C0.860323 2.42098 1.05109 2.5 1.25 2.5L5.75 2.5C5.94891 2.5 6.13968 2.42098 6.28033 2.28033C6.42098 2.13968 6.5 1.94891 6.5 1.75L6.5 0.75C6.5 0.551087 6.42098 0.360322 6.28033 0.21967C6.13968 0.0790172 5.94891 -4.17491e-07 5.75 -4.26186e-07L1.25 -6.22887e-07C1.05109 -6.31582e-07 0.860323 0.079017 0.71967 0.219669C0.579018 0.360322 0.5 0.551087 0.5 0.749999Z"
                                        fill="#005DFF" />
                                </svg>
                            </span>
                            <span class="text">1</span>
                        </p>
                        <? $companyCity = $arResult["COMPANY_CITY"][$item["PROPERTIES"]["R_CHOP"]["VALUE"]]?>
                        <p class="right">
                            <span class="company_name"><?=$companyCity["PARENT"]["NAME"]?></span>
                            <?/*<span class="company_city"><?=$_COOKIE['selected_city']?></span>*/?>
                        </p>
                    </div>
                </div>
                <div class="you__reviews_item-body">
                    <span>Комментарий пользователя:</span>
                    <?=$item["PROPERTIES"]["R_COMMENT"]["~VALUE"]["TEXT"]?>
                </div>
                <div class="you__reviews_item-footer">
                    <div class="left">
                        <a href="">Читать далее</a>
                    </div>
                    <div class="right">
                        <span class="text">источник</span>
                        <span class="icon">
                            <a href="">
                                <picture>
                                <? if($item["PROPERTIES"]["R_SOURCE"]["VALUE_ENUM"] == "Vincko"): ?>
                                    <source type="immage/webp"
                                        srcset="<?=SITE_TEMPLATE_PATH?>/img/first__page/you__reviews/vinco_icon.webp">
                                    <source type="immage/png" srcset="<?=SITE_TEMPLATE_PATH?>/img/first__page/you__reviews/vinco_icon.png">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/img/first__page/you__reviews/vinco_icon.png" alt="img" loading="lazy">
                                <? elseif($item["PROPERTIES"]["R_SOURCE"]["VALUE_ENUM"] == "2GIS"): ?>
                                    <source type="immage/webp"
                                        srcset="<?=SITE_TEMPLATE_PATH?>/img/first__page/you__reviews/google_icon.webp">
                                    <source type="immage/png" srcset="<?=SITE_TEMPLATE_PATH?>/img/first__page/you__reviews/vinco_icon.png">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/img/first__page/you__reviews/vinco_icon.png" alt="img" loading="lazy">
                                <? elseif($item["PROPERTIES"]["R_SOURCE"]["VALUE_ENUM"] == "Яндекс"): ?>
                                    <source type="immage/webp"
                                        srcset="<?=SITE_TEMPLATE_PATH?>/img/first__page/you__reviews/vinco_icon.webp">
                                    <source type="immage/png" srcset="<?=SITE_TEMPLATE_PATH?>/img/first__page/you__reviews/vinco_icon.png">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/img/first__page/you__reviews/vinco_icon.png" alt="img" loading="lazy">
                                <? elseif($item["PROPERTIES"]["R_SOURCE"]["VALUE_ENUM"] == "Google"): ?>
                                    <source type="immage/webp"
                                        srcset="<?=SITE_TEMPLATE_PATH?>/img/first__page/you__reviews/google_icon.webp">
                                    <source type="immage/png" srcset="<?=SITE_TEMPLATE_PATH?>/img/first__page/you__reviews/google_icon.png">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/img/first__page/you__reviews/google_icon.png" alt="img" loading="lazy">
                                <? endif; ?>
                                </picture>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
            <? endif; ?>
            <? endforeach; ?>
        </div>
        <div class="you__reviews_bottom">
            <p>На Репутационный рейтинг только отзывы клиентов охранных компаний, в том числе - из сторонних источников, которые мы тщательно
                собрали их для вас, чтобы вы могли принять максимально взвешенное решение.</p>
        </div>
    </div>
</section>