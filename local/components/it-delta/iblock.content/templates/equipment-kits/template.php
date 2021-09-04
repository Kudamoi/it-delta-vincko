<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
//echo "<pre>";
//print_r($arResult);
//echo "</pre>";
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
<main class="container complect-obor">
    <section class="safe__pay rating-top">
        <div class="safe__pay_left">
            <div class="safe__pay_left-text">
                <h1 class="h1">
                    Комплекты <br>
                    охранного <br>
                    оборудования<br>
                </h1>
                <p class="text">
                    Узнайте, что умеют делать наши комплекты охранного оборудования и выберите подходящий вариант
                </p>
            </div>
            <div class="safe__pay_left-img">
                <picture>
                    <img src="/upload/images/equipment/equipment.svg" alt="img" loading="lazy">
                </picture>
            </div>
        </div>
        <div class="safe__pay_right" style="background-image: none;">
            <div class="h3">
                Готовые <br>
                решения <br>
                для охраны
            </div>
            <p class="text">
                Созданы для вас с целью решения задач оптимальным образом. Один из вариантов точно удовлетворит Ваши
                потребности.
            </p>
            <a href="/packages/" class="button">узнать больше</a>
        </div>
    </section>


    <div class="equipmnet-kits">
        <?php foreach ($arResult['SECTIONS'] as $section): ?>
            <? if (!empty($section['EQUIPMENT-KITS'])): ?>
                <section class="ready-pack ready-pack--global">
                    <div class="ready-pack__head">
                        <div class="ready-pack__title">
                            <div class="ready-pack__title-up">Набор оборудования для готового решения</div>
                            <h2 class="h2 ready-pack__title-down"><?= $section['NAME'] ?></h2>
                        </div>

                        <div class="ready-des2__show-list">
                            <? foreach ($section['CHARACTERISTICS'] as $charact): ?>
                                <div class="ready-des2__show-list-item<?= empty($charact['PREVIEW_PICTURE']) ? ' ready-des2__show-list-item--inactive' : '' ?>">
                                    <? if (!empty($charact['PREVIEW_PICTURE'])): ?>
                                        <img src="<?= $charact['PREVIEW_PICTURE'] ?>" alt="<?= $charact['NAME'] ?>">
                                    <? endif; ?>
                                    <?= $charact['NAME'] ?>
                                </div>
                            <? endforeach; ?>
                        </div>
                        <div class="ready-pack__items">
                            <? foreach ($section['EQUIPMENT-KITS'] as $item): ?>
                                <!--                            --><? //if($_SERVER['REMOTE_ADDR'] == '46.147.123.63'):?>
                                <!--                            <pre>-->
                                <!--                                --><? //print_r($item)?>
                                <!--                            </pre>-->
                                <!--                            --><? //endif;?>
                                <div class="ready-pack__item">
                                    <div class="ready-pack__top">
                                        <picture>
                                            <source srcset="<?= $item['CLASS_INFO']['PREVIEW_PICTURE'] ?>">
                                            <img src="<?= $item['CLASS_INFO']['PREVIEW_PICTURE'] ?>" alt="var-image-1">
                                        </picture>
                                        <div class="ready-pack__top-title">
                                            <div class="text">Вариант</div>
                                            <div class="ready-pack__global-type">
                                                <?= $item['CLASS_INFO']['NAME'] ?>
                                            </div>
                                            <div class="h4"><?= $item['NAME'] ?></div>
                                        </div>
                                    </div>
                                    <div class="ready-pack__mid">
                                        <ul class="ready-pack__mid-list" data-list="1">
                                            <? foreach ($item['COMPLECT_CHARACTERISTICS'] as $characteristic): ?>
                                                <li>
                                                    <div class="img">
                                                        <picture>
                                                            <source srcset="<?= $characteristic['PREVIEW_PICTURE'] ?>">
                                                            <img src="<?= $characteristic['PREVIEW_PICTURE'] ?>"
                                                                 alt="photo">
                                                        </picture>
                                                    </div>
                                                    <div class="text"><?= $characteristic['NAME'] ?></div>
                                                </li>
                                            <? endforeach; ?>
                                        </ul>

                                        <div class="ready-pack__switch">
                                            <div class="ready-pack__open">Развернуть
                                                <svg width="8" height="5" viewBox="0 0 8 5" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3.60396 4.82011L0.164193 1.04856C-0.0547314 0.808645 -0.0547314 0.419663 0.164193 0.179864C0.382921 -0.059955 0.737679 -0.059955 0.95639 0.179864L4.00006 3.5171L7.04362 0.179961C7.26244 -0.0598577 7.61716 -0.0598576 7.83589 0.179961C8.0547 0.41978 8.0547 0.808743 7.83589 1.04866L4.39607 4.8202C4.28665 4.94011 4.1434 5 4.00007 5C3.85668 5 3.71332 4.94 3.60396 4.82011Z"
                                                          fill="#A0A0A0"/>
                                                </svg>

                                            </div>

                                            <div class="ready-pack__close">Свернуть
                                                <svg width="9" height="5" viewBox="0 0 9 5" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.89604 0.179893L8.33581 3.95144C8.55473 4.19135 8.55473 4.58034 8.33581 4.82014C8.11708 5.05995 7.76232 5.05995 7.54361 4.82014L4.49994 1.4829L1.45638 4.82004C1.23756 5.05986 0.882842 5.05986 0.664113 4.82004C0.445296 4.58022 0.445296 4.19126 0.664113 3.95134L4.10393 0.179796C4.21335 0.059887 4.3566 4.59895e-08 4.49992 4.76986e-08C4.64332 4.94086e-08 4.78668 0.0600033 4.89604 0.179893Z"
                                                          fill="#A0A0A0"/>
                                                </svg>

                                            </div>
                                        </div>
                                        <? if (!empty($item['PRESENTS'])): ?>
                                            <div class="predloj__present">
                                                <div class="present__text">
                                                    <div class="h5">В подарок:</div>
                                                    <ul>
                                                        <? foreach ($item['PRESENTS'] as $present): ?>
                                                            <li><span>&#10003;</span> <?= $present ?></li>
                                                        <? endforeach; ?>
                                                    </ul>
                                                </div>
                                                <picture>
                                                    <source type="image/svg"
                                                            srcset="/upload/images/equipment/podarok.svg">
                                                    <img src="/upload/images/equipment/podarok.svg" alt="img"
                                                         loading="lazy">
                                                </picture>
                                            </div>
                                        <? endif; ?>
                                    </div>

                                    <div class="ready-pack__bottom">
                                        <div class="ready-pack__bottom-left">
                                            <div class="ready-pack__bottom-all">
                                                Всего
                                            </div>

                                            <div class="ready-pack__bottom-result">
                                                <div style="display: flex; flex-direction: column">
                                                    <? if ($item['DISCOUNT_PRICE']!=$item['CATALOG_PRICE_1']): ?>
                                                        <? $price = $item['DISCOUNT_PRICE']?>
                                                        <? $oldPrice = $item['CATALOG_PRICE_1'];?>
                                                    <? else: ?>
                                                        <? $price = $item['CATALOG_PRICE_1'];?>
                                                        <? $oldPrice = 0;?>
                                                    <? endif; ?>
                                                    <? if($oldPrice > 0 ): ?>
                                                        <div class="solutions__bottom_column-oldprice nowrap">
                                                            <span class="solutions__bottom_column-oldprice">
                                                                <?=number_format($oldPrice, 0, ',', ' ')?>
                                                            </span>
                                                            <span>₽</span>
                                                        </div>
                                                    <? endif; ?>
                                                    <div>
                                                        <span class="currently-price">
                                                            <?=number_format($price, 0, ',', ' ') ?>
                                                        </span>
                                                        <span>₽</span>
                                                        <? if(!empty($arResult["PERIOD_INST"])): ?>
                                                            <span class="ready-pack__bottom-or">или</span>
                                                        <? endif; ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <? if(!empty($arResult["PERIOD_INST"])): ?>
                                            <div class="ready-pack__bottom-right">
                                            <div class="solutions__bottom_column">

                                                <div class="solutions__bottom_column-interest">
                                                    <p>все проценты<br>
                                                        за вас платит <span class="blue-vinco">vincko:</span>
                                                    </p>
                                                </div>

                                                <div class="solutions__bottom_column-monthprice js-installment">
                                                    <select class="installment-period__select js-installment-period" data-price="<?=$price?>">
                                                        <? foreach ($arResult["PERIOD_INST"] as $period): ?>
                                                            <option value="<?=$period["UF_MONTHS"]?>"><?=$period["UF_MONTHS"]?> мес.</option>
                                                        <? endforeach; ?>
                                                    </select>
                                                    <p>по</p>
                                                    <div class="solutions__bottom_column-price nowrap">
                                                        <span class="js-installment-price">
                                                            <?=Vincko\Other::formatInstalmentPrice($price, $arResult["PERIOD_INST"][0]["UF_MONTHS"])?>
                                                        </span>
                                                        ₽
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <? endif; ?>

                                        <button onclick="location.href='<?= $item['DETAIL_URL'] ?>/'"
                                                class="ready-pack__bottom-button button yellow-button">
                                            ПОДРОБНЕЕ
                                        </button>
                                    </div>
                                </div>
                            <? endforeach; ?>
                        </div>
                    </div>
                </section>
            <? endif; ?>
        <?php endforeach; ?>
    </div>


    <section class="subscribe subscribe__bought" id="subscribe">
        <div class="subscribe__head">
            <h2 class="h2">Подписка <span>vincko: <br>
            “Замена оборудования”</span>
            </h2>


        </div>

        <div class="subscribe__content">
            <div class="subscribe__column">
                <div class="subscribe__sub-title">
                    <svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.5 0.25C7.53 0.25 0.25 7.53 0.25 16.5C0.25 25.47 7.53 32.75 16.5 32.75C25.47 32.75 32.75 25.47 32.75 16.5C32.75 7.53 25.47 0.25 16.5 0.25ZM17.9788 26.4937C17.8652 26.6051 17.7214 26.6807 17.5653 26.7111C17.4092 26.7415 17.2476 26.7254 17.1006 26.6649C16.9535 26.6043 16.8274 26.5019 16.738 26.3704C16.6486 26.2389 16.5997 26.084 16.5975 25.925V24.625H16.5C14.42 24.625 12.34 23.8288 10.7475 22.2525C9.64417 21.1465 8.88272 19.7461 8.55421 18.2188C8.22569 16.6915 8.344 15.1019 8.895 13.64C9.20375 12.8112 10.2925 12.6 10.91 13.2337C11.2675 13.5912 11.3487 14.1113 11.1862 14.5663C10.4387 16.5813 10.8612 18.9212 12.4862 20.5462C13.6237 21.6838 15.1187 22.22 16.6138 22.1875V20.66C16.6138 19.9288 17.4913 19.5713 17.995 20.0912L20.6275 22.7237C20.9525 23.0487 20.9525 23.5525 20.6275 23.8775L17.9788 26.4937ZM22.09 19.7825C21.922 19.6096 21.8068 19.3925 21.7579 19.1565C21.709 18.9205 21.7283 18.6754 21.8138 18.45C22.5613 16.435 22.1388 14.095 20.5138 12.47C19.3763 11.3325 17.8812 10.78 16.4025 10.8125V12.34C16.4025 13.0712 15.525 13.4288 15.0212 12.9087L12.3725 10.2925C12.0475 9.9675 12.0475 9.46375 12.3725 9.13875L15.005 6.50625C15.1186 6.3949 15.2623 6.31934 15.4184 6.28891C15.5745 6.25849 15.7361 6.27456 15.8832 6.33511C16.0303 6.39567 16.1563 6.49805 16.2457 6.62958C16.3352 6.7611 16.384 6.91597 16.3862 7.075V8.39125C18.4988 8.35875 20.6275 9.1225 22.2362 10.7475C23.3396 11.8535 24.101 13.2539 24.4295 14.7812C24.7581 16.3085 24.6397 17.8981 24.0888 19.36C23.78 20.205 22.7075 20.4163 22.09 19.7825Z"
                              fill="#3CBA54"/>
                    </svg>

                    Что такое подписка “Замена оборудования”

                </div>

                <p>
                    Подписка дает вам возможность бесплатно получить новый датчик для комплекта оборудования, купленного
                    на платформе в рамках готового решения.
                </p>
            </div>

            <div class="subscribe__column">
                <div class="subscribe__sub-title">
                    Почему эта подписка дает уверенность при покупке оборудования
                </div>

                <p>
                    В случае, если один из датчиков в комплекте вышел из строя, с этой подпиской Вы просто получите
                    новый взамен, а ваша недвижимость останется под надежной охраной.
                </p>
            </div>

            <div class="subscribe__column subscribe__column-to-buy">
                <div class="subscribe__sub-title">
                    На какой срок оформить подписку?
                </div>
                <div class="subscribe__column-to-buy-content">
                    <div class="subscribe__conditions">
                        <p>
                            Длительность гарантии
                        </p>
                        <select name="time-choice" id="time-choice" class="time-choice">
                            <option value="12">12 месяцев</option>
                            <option value="6">6 месяцев</option>
                        </select>

                        <div class="subscribe__text">
                            Спокойствия и уверенности
                        </div>

                        <div class="subscribe__result">
                            Всего за
                            <div class="price">
                                600 ₽
                            </div>
                        </div>

                    </div>

                    <button class="blue-button">Купить</button>

                </div>
            </div>

            <div class="subscribe__column subscribe__column-bought">
                <div class="subscribe__column-bought-head">
                <span>
                    Поздравляем!
                </span>

                    <svg width="50" height="37" viewBox="0 0 50 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M1.02433 17.998C2.38976 16.6592 4.60355 16.6592 5.96898 17.998L16.0099 28.7236L44.0313 1.00409C45.3967 -0.334696 47.6105 -0.334696 48.9759 1.00409C50.3414 2.34288 50.3414 4.51348 48.9759 5.85227L18.4822 35.9959C17.1168 37.3347 14.903 37.3347 13.5376 35.9959L1.02433 22.8462C-0.341092 21.5074 -0.341093 19.3368 1.02433 17.998Z"
                              fill="white"/>
                    </svg>

                </div>
                <div class="subscribe__column-bought-content">
                    <p>
                        Ранее Вы уже получили подписку “Замена Оборудования”.
                    </p>
                    <p>
                        Она будет действительна до 16.05.2021.
                    </p>
                    <p>
                        У Вас возникли вопросы? Свяжитесь с нами.
                    </p>
                </div>
            </div>

        </div>

    </section>
</main>