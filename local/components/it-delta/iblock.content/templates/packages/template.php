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
//
// echo '<pre>';
// print_r($arResult);
// echo '</pre>';
?>
<!--<pre>-->
<!--    --><?//print_r($arResult)?>
<!--</pre>-->
<?php foreach ($arResult['SECTIONS'] as $section): ?>
    <? if (!empty($section['EQUIPMENT-KITS'])): ?>
        <?
        // echo '<pre>';
        // print_r($section);
        // echo '</pre>';
        ?>
        <?php $checkEquip = 1?>
        <div class="ready-des2__show-item close">
            <div class="ready-des2__show-header">
                <div class="ready-des2__show-header-left">
                    <picture class="ready-des2__show-photo">
                        <img src="<?= $section['PICTURE_SRC'] ?>" alt="photo">
                    </picture>
                </div>
                <div class="ready-des2__show-header-right">
                    <div class="ready-des2__show-title">
                        <div class="ready-des2__show-title-up">Готовое решение</div>
                        <div class="ready-des2__show-title-down"><?= $section['NAME'] ?></div>
                    </div>

                    <div class="ready-des2__show-desc">
                        <?= $section['DESCRIPTION'] ?>
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
                    <div class="ready-des2__show-more">
                        Смотреть варианты
                        <svg width="12" height="7" viewBox="0 0 12 7" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.40594 6.74815L0.246289 1.46799C-0.0820961 1.1321 -0.0820961 0.587528 0.246289 0.251809C0.574383 -0.0839371 1.10652 -0.083937 1.43459 0.251809L6.00009 4.92394L10.5654 0.251946C10.8937 -0.0838007 11.4257 -0.0838007 11.7538 0.251946C12.0821 0.587692 12.0821 1.13224 11.7538 1.46812L6.5941 6.74829C6.42998 6.91616 6.2151 7 6.00011 7C5.78502 7 5.56999 6.916 5.40594 6.74815Z"
                                  fill="#005DFF"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="ready-des2__show-main">
                <div class="wrapper">
                    <div class="ready-pack group__pack r-d-s" id="r-d-s-1">
                        <?php foreach ($section['EQUIPMENT-KITS'] as $item): ?>
                            <div class="ready-pack__item-wrapper">
                                <div class="ready-pack__item ready-pack__item--short">
                                    <div class="ready-pack__top">
                                        <picture>
                                            <source type="image/gif"
                                                    srcset="<?= $item['CLASS_INFO']['PREVIEW_PICTURE'] ?>">
                                            <img src="<?= $item['CLASS_INFO']['PREVIEW_PICTURE'] ?>" alt="img"
                                                 loading="lazy">
                                        </picture>
                                        <div class="ready-pack__top-title">
                                            <div class="text">Вариант</div>
                                            <div class="ready-pack__global-type">
                                                <?= $item['CLASS_INFO']['NAME'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ready-pack__mid ready-pack__mid--short">
                                        <div class="ready-pack__mid--short-title">
                                            Вариант решения включает:
                                        </div>
                                        <div class="ready-pack__short-list">
                                            <div class="ready-pack__short-item">
                                                <div class="ready-pack__short-img">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                              d="M7.2 0H8.8V2.4H7.2V0ZM13.0916 1.77715L14.223 2.9085L12.5259 4.60547L11.3945 3.47412L13.0916 1.77715ZM16 7.2H13.6V8.8H16V7.2ZM0 7.2H2.4V8.8H0V7.2ZM4.60568 3.47471L2.90859 1.77773L1.77721 2.90908L3.47429 4.60605L4.60568 3.47471ZM12 11.2V8C12 5.79443 10.2056 4 8 4C5.7944 4 4 5.79443 4 8V11.2C2.67679 11.2 1.6 12.2768 1.6 13.6C1.6 14.9232 2.67679 16 4 16H12C13.3232 16 14.4 14.9232 14.4 13.6C14.4 12.2768 13.3232 11.2 12 11.2ZM5.6 8C5.6 6.67676 6.67679 5.6 8 5.6C9.32321 5.6 10.4 6.67676 10.4 8V11.2H5.6V8ZM4 14.4C3.5592 14.4 3.2 14.0416 3.2 13.6C3.2 13.1584 3.5592 12.8 4 12.8H12C12.4416 12.8 12.8 13.1584 12.8 13.6C12.8 14.0416 12.4416 14.4 12 14.4H4ZM8 6.4V7.99844L9.6 8C9.6 7.11758 8.8832 6.4 8 6.4Z"
                                                              fill="#005DFF"/>
                                                    </svg>

                                                </div>

                                                <div class="ready-pack__short-title">
                                                    Оборудование
                                                </div>

                                                <div class="ready-pack__short-content ready-pack__short-content-h blue">
                                                    <?=$item['NAME']?>
                                                </div>
                                            </div>
                                            <div class="ready-pack__short-item">
                                                <div class="ready-pack__short-img">
                                                    <svg width="14" height="18" viewBox="0 0 14 18" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                              d="M4.6654 6.60938H11.9412C13.0764 6.60938 14 7.55564 14 8.71875V15.8906C14 17.0537 13.0764 18 11.9412 18H2.05882C0.923588 18 0 17.0537 0 15.8906V8.71875C0 7.55564 0.923588 6.60938 2.05882 6.60938H3.29285V3.71848C3.29285 1.66809 4.95531 0 6.99873 0C9.04215 0 10.7046 1.66809 10.7046 3.71848V6.60938H9.33206V3.71848C9.33206 2.4435 8.28532 1.40625 6.99873 1.40625C5.71214 1.40625 4.6654 2.4435 4.6654 3.71848V6.60938ZM11.9412 16.5938C12.3196 16.5938 12.6275 16.2783 12.6275 15.8906V8.71875C12.6275 8.33105 12.3196 8.01562 11.9412 8.01562H2.05882C1.68041 8.01562 1.37255 8.33105 1.37255 8.71875V15.8906C1.37255 16.2783 1.68041 16.5938 2.05882 16.5938H11.9412ZM5.73039 11.3555C5.73039 10.6371 6.2988 10.0547 7 10.0547C7.7012 10.0547 8.26961 10.6371 8.26961 11.3555C8.26961 11.8153 8.03652 12.2191 7.68501 12.4504V13.9922C7.68501 14.3805 7.37773 14.6953 6.99873 14.6953C6.6197 14.6953 6.31246 14.3805 6.31246 13.9922V12.4488C5.96235 12.2171 5.73039 11.8142 5.73039 11.3555Z"
                                                              fill="#005DFF"/>
                                                    </svg>


                                                </div>

                                                <div class="ready-pack__short-title">
                                                    Договор с охранной компанией
                                                </div>

                                                <div class="ready-pack__short-content ready-pack__short-content-h">
                                                    <?=$item['CLASS_INFO']['COMPANY_NAME']?>
                                                </div>
                                            </div>
                                            <div class="ready-pack__short-item">
                                                <div class="ready-pack__short-img">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="24" height="24" fill="white"/>
                                                        <path d="M9.338 5.04486C8.38559 5.30735 7.11663 5.81082 6.17798 6.11892C6.09227 6.14668 6.01608 6.19796 5.95809 6.26691C5.9001 6.33586 5.86264 6.41972 5.84998 6.50892C5.29598 10.6659 6.36063 14.135 7.88763 16.133C8.53415 16.9874 9.84341 18.2852 10.713 18.9112C11.059 19.1552 11.365 19.3312 11.606 19.4442C11.726 19.5012 11.824 19.5392 11.899 19.5622C11.9318 19.5737 11.9656 19.582 12 19.5872C12.034 19.5816 12.0674 19.5733 12.1 19.5622C12.176 19.5392 12.274 19.5012 12.394 19.4442C12.634 19.3312 12.941 19.1542 13.287 18.9112C14.1566 18.2852 15.4658 16.9874 16.1124 16.133C17.6394 14.136 18.704 10.6659 18.15 6.50892C18.1375 6.41968 18.1001 6.33577 18.042 6.2668C17.984 6.19783 17.9078 6.14658 17.822 6.11892C17.171 5.90592 15.749 5.34086 14.662 5.04586C13.552 4.74486 12.531 4.52186 12 4.52186C11.47 4.52186 10.448 4.74486 9.338 5.04586V5.04486ZM9.072 4.56C10.157 4.265 11.31 4 12 4C12.69 4 13.843 4.265 14.928 4.56C16.038 4.86 17.157 5.215 17.815 5.43C18.0901 5.52085 18.334 5.68747 18.5187 5.9107C18.7034 6.13394 18.8213 6.40474 18.859 6.692C19.455 11.169 18.072 14.487 16.394 16.682C15.6824 17.621 14.834 18.4479 13.877 19.135C13.5461 19.3728 13.1955 19.5819 12.829 19.76C12.549 19.892 12.248 20 12 20C11.752 20 11.452 19.892 11.171 19.76C10.8045 19.5819 10.4539 19.3728 10.123 19.135C9.16603 18.4478 8.31758 17.621 7.606 16.682C5.928 14.487 4.54501 11.169 5.14101 6.692C5.17869 6.40474 5.29665 6.13394 5.48132 5.9107C5.666 5.68747 5.9099 5.52085 6.185 5.43C7.1402 5.11681 8.10281 4.82672 9.072 4.56Z"
                                                              fill="#005DFF" stroke="#005DFF"/>
                                                        <path d="M14.9755 9.17508L11.5805 12.5568L10.0245 11.0068C9.79017 10.7734 9.41016 10.7734 9.17578 11.0068C8.94141 11.2403 8.94141 11.6187 9.17578 11.8522L11.1561 13.8249C11.2687 13.937 11.4213 14 11.5805 14C11.5805 14 11.5805 14 11.5805 14C11.7397 14 11.8923 13.937 12.0048 13.8249L15.8242 10.0205C16.0586 9.78707 16.0586 9.40858 15.8242 9.17512C15.5898 8.94165 15.2099 8.94161 14.9755 9.17508Z"
                                                              fill="#005DFF"/>
                                                    </svg>


                                                </div>

                                                <div class="ready-pack__short-title">
                                                    Страхование недвижимости
                                                </div>

                                                <div class="ready-pack__short-content ready-pack__short-content-text">
                                                    Некоторые полисы идут в подарок, но решение принимаете Вы
                                                </div>
                                            </div>
                                        </div>
                                        <? if (!empty($item['PROPERTY_CO_PRESENTS_REF_VALUE'])): ?>
                                            <div class="predloj__present">
                                                <div class="present__text">
                                                    <div class="h5">В подарок:</div>
                                                    <ul>
                                                        <? foreach ($item['PROPERTY_CO_PRESENTS_REF_VALUE'] as $present): ?>
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
                                </div>
                                <div class="ready-pack__bottom">
                                    <div class="ready-pack__bottom-left">
                                        <div class="ready-pack__bottom-all">
                                            Всего
                                        </div>

                                        <div class="ready-pack__bottom-result">
                                            <?= empty($item['DISCOUNT_PRICE']) ? number_format($item['CATALOG_PRICE_1'], 0, ',', ' ') : number_format($item['DISCOUNT_PRICE'], 0, ',', ' ') ?> ₽
                                            <span class="ready-pack__bottom-or">
                                                    или
                                                </span>
                                        </div>
                                    </div>

                                    <div class="ready-pack__bottom-right">
                                        <div class="solutions__bottom_column">

                                            <div class="solutions__bottom_column-interest">
                                                <p>все проценты<br>
                                                    за вас платит <span class="blue-vinco">vincko:</span>
                                                </p>
                                            </div>
                                            <div class="solutions__bottom_column-monthprice">
                                                <select name="solutions__bottom_column-select"
                                                        class="solutions__bottom_column-select">
                                                    <option selected value="12">12 мес.</option>
                                                    <option value="6">6 мес.</option>
                                                </select>
                                                <p>по</p>
                                                <div class="solutions__bottom_column-price">
                                                    1 000 ₽
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <button class="ready-pack__bottom-button button yellow-button" onclick="location.href='/packages/<?= $item['ELEMENT_CODE'] ?>/'">
                                        ПОДРОБНЕЕ
                                    </button>

                                </div>
                            </div>
                        <? endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="ready-des2__show-footer">
                <div class="blue-line"></div>
                <div class="ready-des2__show-close">
                    Свернуть
                    <svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.89604 0.179893L8.33581 3.95144C8.55473 4.19135 8.55473 4.58034 8.33581 4.82014C8.11708 5.05995 7.76232 5.05995 7.54361 4.82014L4.49994 1.4829L1.45638 4.82004C1.23756 5.05986 0.882842 5.05986 0.664113 4.82004C0.445296 4.58022 0.445296 4.19126 0.664113 3.95134L4.10393 0.179796C4.21335 0.059887 4.3566 4.59895e-08 4.49992 4.76986e-08C4.64332 4.94086e-08 4.78668 0.0600033 4.89604 0.179893Z"
                              fill="#A0A0A0"/>
                    </svg>
                </div>
                <div class="blue-line"></div>
            </div>

        </div>
<?endif; endforeach; ?>
<?php if ($checkEquip != 1):?>
    <div class="ready-des2__show-item close">
        <div class="ready-des2__show-header">
            <div class="ready-des2__show-header-left">
                <picture class="ready-des2__show-photo">
                    <img src="https://st2.depositphotos.com/1526816/6758/v/600/depositphotos_67585141-stock-illustration-oops.jpg" alt="photo">
                </picture>
            </div>
            <div class="ready-des2__show-header-right">
                <div class="ready-des2__show-title">
                    <div class="ready-des2__show-title-up">Данная компания не предоставляет услуги по поставленной задаче в выбранном городе</div>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>
<!--<div class="ready-des2__show-item close">-->
<!--    --><?php //foreach ($section['ITEMS'] as $item): ?>
<!--        <div class="packages-variants__item">-->
<!--            <img class="packages-variant-image" src="--><? //= $item['PREVIEW_PICTURE']['SRC'] ?><!--" alt="">-->
<!--            <div class="packages-variant-title">--><? //= $item['NAME'] ?><!--</div>-->
<!--            <div class="packages-variant-description">--><? //= $item['PREVIEW_TEXT'] ?><!--</div>-->
<!--        </div>-->
<!--    --><?php //endforeach; ?>
<!---->
<!---->
<!---->
<!--</div>-->