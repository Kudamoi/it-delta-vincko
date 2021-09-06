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

?>

<section class="first__page_ready-des">
    <div class="">
        <div class="first__page_ready-des--head container">
            <h2><span>Популярные</span> готовые решения<br>
                охранных услуг</h2>
            <a href="packages/" class="button">Смотреть все предложения</a>
        </div>
        <div class="group__pack group__pack_slider-js">
            <? foreach ($arResult['SECTIONS'] as $section): ?>
                <? foreach ($section['EQUIPMENT-KITS'] as $item): ?>
                    <div class="pack">
                        <div class="pack__predloj">
                            <div class="predloj__title">
                                <picture>
                                    <source type="image/gif" srcset="<?= $item['CLASS_INFO']['PREVIEW_PICTURE'] ?>">
                                    <img src="<?= $item['CLASS_INFO']['PREVIEW_PICTURE'] ?>" alt="img" loading="lazy">
                                </picture>
                                <div class="title__text">
                                    <h3><?= $section["NAME"] ?></h3>
                                    <h2><?= $item['CLASS_INFO']['NAME'] ?></h2>
                                </div>
                            </div>
                            <h6>Вариант решения включает:</h6>
                            <h4>
                                <picture>
                                    <source type="image/svg"
                                            srcset="<?= SITE_TEMPLATE_PATH ?>/img/ready-des/ico1large.svg">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/ready-des/ico1large.svg" alt="img"
                                         loading="lazy">
                                </picture>
                                Оборудование
                            </h4>
                            <div>
                                <p class="manuf-title"><?= $item['NAME'] ?></p>
                            </div>
                            <h4>
                                <picture>
                                    <source type="image/svg"
                                            srcset="<?= SITE_TEMPLATE_PATH ?>/img/ready-des/ico2large.svg">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/ready-des/ico2large.svg" alt="img"
                                         loading="lazy">
                                </picture>
                                Договор с охранной компанией
                            </h4>
                            <p>Вы выбираете компанию, мы предоставляем гарантии</p>
                            <h4>
                                <picture>
                                    <source type="image/svg"
                                            srcset="<?= SITE_TEMPLATE_PATH ?>/img/ready-des/ico3large.svg">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/ready-des/ico3large.svg" alt="img"
                                         loading="lazy">
                                </picture>
                                Страхование недвижимости
                            </h4>
                            <p>Некоторые полисы идут в подарок,
                                но решение принимаете Вы</p>
                            <div class="predloj__present">
                                <div class="present__text">
                                    <h5>В подарок:</h5>
                                    <ul>
                                        <? foreach ($item['PRESENTS'] as $present): ?>
                                            <li><span>&#10003;</span> <?= $present ?></li>
                                        <? endforeach; ?>
                                    </ul>
                                </div>
                                <picture>
                                    <source type="image/svg" srcset="/upload/images/equipment/podarok.svg">
                                    <img src="/upload/images/equipment/podarok.svg" alt="img" loading="lazy">
                                </picture>
                            </div>
                        </div>
                        <div class="pack__price">
                            <div class="price__main">
                                <div class="ready-pack__bottom">
                                    <div class="main__left">
                                        <h3>Всего</h3>
                                        <h2 class="currently-price">
                                            <? $price = (empty($item['DISCOUNT_PRICE']) ? $item['CATALOG_PRICE_1'] : $item['DISCOUNT_PRICE']) ?>
                                            <?= number_format($price, 0, ',', '&nbsp;') ?>&nbsp;₽
                                            <? if (!empty($arResult["PERIOD_INST"])): ?><span>или</span><? endif; ?>
                                        </h2>
                                    </div>
                                    <? if (!empty($arResult["PERIOD_INST"])): ?>
                                        <div class="ready-pack__bottom-right main__rigth js-installment">
                                            <div class="solutions__bottom_column">

                                                <div class="solutions__bottom_column-interest">
                                                    <p>все проценты<br>платит vincko:</p>
                                                </div>

                                                <div class="solutions__bottom_column-monthprice js-installment">
                                                    <div class="form__select" id="form_installment_plan">
                                                        <select name="solutions__bottom_column-select"
                                                                data-price="<?= $price ?>"
                                                                class="solutions__bottom_column-select js-installment-period">
                                                            <? foreach ($arResult["PERIOD_INST"] as $period): ?>
                                                                <option value="<?= $period["UF_MONTHS"] ?>"><?= $period["UF_MONTHS"] ?>
                                                                    мес.
                                                                </option>
                                                            <? endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <p>по</p>
                                                    <div class="solutions__bottom_column-price-flex-full">
                                                        <div class="solutions__bottom_column-price nowrap">
                                                       <span class="js-installment-price">
                                                            <?= Vincko\Other::formatInstalmentPrice($price, $arResult["PERIOD_INST"][0]["UF_MONTHS"]) ?>
                                                        </span>
                                                            <span style="font-family: Gilroy, sans-serif">₽</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <? endif; ?>
                                </div>
                            </div>
                            <div class="price__button">
                                <a href="equipment-kits/<?= $item['DETAIL_URL'] ?>/">ПОДРОБНЕЕ</a>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            <? endforeach; ?>
        </div>
    </div>
</section>