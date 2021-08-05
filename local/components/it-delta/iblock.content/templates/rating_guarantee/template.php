<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

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

<section class="guarantee" id="guarantee">
    <div class="container">
        <div class="guarantee__title">
            Гарантия <span>vincko:</span><br>
            <span>Безопасная сделка</span>
        </div>
        <div class="guarantee__wrapperTop">
            <div class="guarantee__text">
                <div class="guarantee__text_top">
                    <div class="guarantee__text_top-title">
                        для защиты Ваших интересов
                    </div>
                    <div class="guarantee__text_top-subtitle">
                        Гарантия действует при заказе услуг <span>одобренных</span> охранных компаний<br> из Рейтинга
                        через платформу <a href="#">vincko:</a>
                    </div>
                </div>
                <div class="guarantee__text_center">
                    Проанализировав все отзывы обо всех охранных компаниях, мы выявили, что некоторые пользователи услуг
                    охранных
                    организаций сталкиваются с такой сложностью:
                </div>
                <div class="guarantee__text_bottom">
                    Оплатив услуги охранной компании на несколько месяцев вперед, клиент понимает, что его не устраивает
                    качество
                    предоставляемых услуг. Трудности начинаются, когда клиент решает сменить охранную организацию:
                    <span>
                        Текущая компания не желает возвращать остаток оплаченных средств клиенту и не реагирует на
                        обращения клиентов
                    </span>
                    <span>
                        Сотрудники компании могут угрожать клиенту неустойками и штрафами за досрочное расторжение
                        договора, оказывая на клиента
                        психологическое давление
                    </span>
                    <div class="guarantee__text_bottom-link">
                        <a href="/reviews/">Читать отзывы людей, столкнувшихся с этой ситуаций</a>
                    </div>
                </div>
            </div>
            <div class="guarantee__img">
                <img src="/upload/rating/guarantee__img.svg" alt="img">
            </div>
        </div>
        <div class="guarantee__centerText">
            <div class="guarantee__centerText_icon">
                <img src="/upload/rating/guarantee__centerText_icon.svg" alt="img">
            </div>
            <div class="guarantee__centerText_text">
                Гарантия “Безопасная сделка” решает это так:
            </div>
        </div>
        <div class="guarantee__wrapper">
            <div class="guarantee__blockSlider">
                <div class="guarantee__blockSlider_icon">
                    <img src="/upload/rating/guarantee-arrow.svg" alt="img">
                </div>
                <div class="guarantee__text_center">
                    Покупатель сообщает нам о готовности сменить компанию
                </div>
            </div>
            <div class="guarantee__blockSlider">
                <div class="guarantee__blockSlider_icon">
                    <img src="/upload/rating/guarantee-arrow.svg" alt="img">
                </div>
                <div class="guarantee__text_center">
                    По истечении <span>1 рабочего дня</span> он будет иметь следующий результат:
                </div>
            </div>
            <div class="guarantee__blockInfo">
                <div class="guarantee__text_center">
                    Оперативно заключенный договор
                    с новой охранной организацией.
                </div>
            </div>
        </div>
    </div>
</section>


<section class="questions">
    <div class="container">
        <div class="questions__wrapper">
            <div class="questions__text questions__textHide">
                <button class="questions__text-show">Развернуть</button>
                <div class="questions__text_item">
                    <div class="questions__text_item-title">
                        Что <span class="green">является</span> причиной<br>
                        для использования гарантии “Безопасная сделка”
                    </div>
                    <? foreach ($arResult['ITEMS'] as $item): ?>
                        <? if (!empty($item['PROPERTIES']['IS_REASON']['VALUE'])): ?>
                            <div class="questions__text_itemRow toggle__item">
                                <div class="questions__text_itemRow-title toggle__item_title">
                                    <?= $item['NAME'] ?>
                                </div>
                                <div class="questions__text_itemRow-descr toggle__item_descr">
                                    <?= $item['PREVIEW_TEXT'] ?>
                                </div>
                            </div>
                        <? endif; ?>
                    <? endforeach; ?>
                </div>
                <div class="questions__text_item">
                    <div class="questions__text_item-title">
                        Что <span class="red">не является</span> причиной<br>
                        для использования гарантии “Безопасная сделка”
                    </div>
                    <? foreach ($arResult['ITEMS'] as $item): ?>
                        <? if (empty($item['PROPERTIES']['IS_REASON']['VALUE'])): ?>
                            <div class="questions__text_itemRow toggle__item">
                                <div class="questions__text_itemRow-title toggle__item_title">
                                    <?= $item['NAME'] ?>
                                </div>
                                <div class="questions__text_itemRow-descr toggle__item_descr">
                                    <?= $item['PREVIEW_TEXT'] ?>
                                </div>
                            </div>
                        <? endif; ?>
                    <? endforeach; ?>
                </div>
                <button class="questions__text-show questions__text-show_two">Развернуть</button>
            </div>
            <div class="questions__btns">
                <a href="#back_call">
                    Заказать звонок
                </a>
                <a href="#back_call">
                    Сменить компанию
                </a>
            </div>
        </div>
    </div>
</section>

