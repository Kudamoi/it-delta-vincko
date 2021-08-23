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
<div class="rating-center__items-wrapper">
    <? foreach ($arResult['ITEMS'] as $item): ?>
        <div class="rating-center__item-wrapper <?= str_replace('.', ',', sprintf("%01.1f", $item['CH_RATING_SUM'])) == '0,0' ? ' item-rating-hide' : ''; ?>">
            <div class="rating-center__item">
                <div class="rating-center__item_wrappers" data-id="<?= $item['CHOP_ID']['ID'] ?>">
                    <div class="rating-center__item_circle">
                        <span><?= str_replace('.', ',', sprintf("%01.1f", $item['CH_RATING_SUM'])) ?></span>
                        <svg height="40" width="40">
                            <circle cx="20.5" cy="20.5" r="18" style="stroke-dashoffset: 14.5;"/>
                        </svg>
                    </div>
                    <div class="rating-center__item_num">
                        <?= $item['POSITION'] ?>
                    </div>
                    <div class="rating-center__item_name">
                        <?= $item['CHOP_ID']['NAME'] ?>
                    </div>
                    <div class="rating-center__item_icon">
                        <div class="rating-center__item_icon-one">
                            <img src="<?= $item['STATUS_COMPANY']['PICTURE'] ?>"
                                 alt="<?= $item['STATUS_COMPANY']['NAME'] ?>">
                        </div>
                        <div class="rating-center__item_icon-two">
                            <img src="/upload/rating/icon-arrow-down.svg" alt="img">
                        </div>
                    </div>
                </div>
                <div class="num"><?= str_replace('.', ',', sprintf("%01.1f", $item['CH_RATING_SUM'])) ?></div>
            </div>
            <div class="rating-center__item-rating">
                <div class="line-panel-percent"></div>
            </div>
            <div class="itemRating-open" data-id="<?= $item['CHOP_ID']['ID'] ?>">
                <button class="itemRating-open__closed">
                    <img src="/upload/rating/closed-icon.svg" alt="img">
                </button>
                <div class="itemRating-open__top">
                    <div class="itemRating-open__left_top">
                        <div class="itemRating-open__left_num">
                            <span class="num"><?= $item['POSITION'] ?></span> <span>в Рейтинге</span>
                            <p>г. <?= $item['CITY']['NAME'] ?></p>
                        </div>
                        <div class="itemRating-open__left_endorsements <? if ($item['STATUS_COMPANY']['ID'] == 1497): echo 't-c-green'; elseif ($item['STATUS_COMPANY']['ID'] == 1498): echo 't-c-yellow-d'; else: echo 't-c-gray'; endif; ?>">
                            <img src="<?= $item['STATUS_COMPANY']['PICTURE'] ?>"
                                 alt="<?= $item['STATUS_COMPANY']['NAME'] ?>">
                            <span><?= $item['STATUS_COMPANY']['NAME'] ?></span>
                            <div class="endorsements_modal modal-mini">
                                <div class="modal-mini__title">
                                    <span>Охранные услуги</span> одобренной компании
                                </div>
                                <div class="modal-mini__text">
                                    Вы можете <span>заказать на платформе:</span> конфортно, без переплат,
                                    скрытых платежей
                                    за монтаж оборудования и с гарантиями <span>vincko:</span>
                                </div>
                            </div>
                        </div>
                        <? if ($item['SAFE_DEAL'] == '01a8c33537514f60a4b14ec8bd8badbe'): ?>
                            <div class="itemRating-open__left_deal">
                                <a href="#guarantee">Безопасная сделка</a>
                                <img src="/upload/rating/deal-icon.svg" alt="img">
                                <div class="deal_modal modal-mini">
                                    <div class="modal-mini__title">
                                        <span>Безопасная сделка</span> при покупке услуг охраны
                                    </div>
                                    <div class="modal-mini__text">
                                        <span>vincko:</span> предоставляет дополнительные гарантии при
                                        покупке
                                        услуг
                                        <span class="green">одобренных</span>
                                        охранных компаний на платформе
                                        <a href="#guarantee">Подробнее</a>
                                    </div>
                                </div>
                            </div>
                        <? endif; ?>
                    </div>
                    <div class="itemRating-open__left_name">
                        <?= $item['CHOP_ID']['NAME'] ?>
                    </div>
                    <div class="itemRating-open__showRating">
                        <div class="itemRating-open__showRating_title">
                            Показаны рейтинг, услуги и отзывы для города:
                            <span>г. <?= $item['CITY']['NAME'] ?></span>
                        </div>
                    </div>
                </div>
                <div class="itemRating-open__wrapper">
                    <div class="itemRating-open__left">
                        <? if (count($item['REVIEWS']) > 0): ?>
                            <div class="itemRating-open__left_info">
                                <div class="info-block-one rating-check-window">
                                    <div class="info-block-one__left">
                                        <span><?= str_replace('.', ',', sprintf("%01.1f", $item['CH_RATING_SUM'])) ?></span>
                                        <svg height="60" width="60">
                                            <circle cx="30.5" cy="24.5" r="24" style="stroke-dashoffset: 39;"/>
                                        </svg>
                                        <div class="info-block-one__left_icon">
                                            <img src="/upload/rating/info-block-one__left_icon.svg" alt="img">
                                        </div>
                                    </div>
                                    <div class="info-block-one__right">
                                        <div class="info-block-one__right_row">
                                            <img class="icon-open-info-block" src="/upload/rating/icon-info.svg"
                                                 alt="img">
                                            Оценка по критериям <a href="#">vincko:</a>
                                        </div>
                                        <div class="info-block-one__right_row">
                                            <img src="/upload/rating/info-block-one__left_right-row_icon2.svg"
                                                 alt="img">
                                            <span><?= str_replace('.', ',', sprintf("%01.1f", $item['CH_RATING_ZABOTA'])) ?></span>
                                            Безопасность
                                        </div>
                                        <div class="info-block-one__right_row">
                                            <img src="/upload/rating/info-block-one__left_right-row_icon1.svg"
                                                 alt="img">
                                            <span><?= str_replace('.', ',', sprintf("%01.1f", $item['CH_RATING_SPASENIE'])) ?></span>
                                            Клиентоориентированность
                                        </div>
                                        <div class="info-block-one__right_row">
                                            <img src="/upload/rating/info-block-one__left_right-row_icon3.svg"
                                                 alt="img">
                                            <span><?= str_replace('.', ',', sprintf("%01.1f", $item['CH_RATING_FINANCE'])) ?></span>
                                            Комфорт
                                        </div>
                                    </div>
                                    <div class="rating-help-window active" style="display: none;">
                                        <div class="rating-help-window-close">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.17564 7.98187L15.8076 1.36761C15.9387 1.21497 16.0072 1.01864 15.9994 0.817837C15.9916 0.617035 15.9082 0.426555 15.7657 0.28446C15.6232 0.142366 15.4322 0.0591225 15.2309 0.0513664C15.0295 0.0436103 14.8327 0.111912 14.6796 0.242623L8.04764 6.85688L1.41563 0.234644C1.26499 0.084404 1.06068 0 0.847635 0C0.634593 0 0.430278 0.084404 0.279635 0.234644C0.128992 0.384884 0.0443614 0.588653 0.0443614 0.801125C0.0443614 1.0136 0.128992 1.21737 0.279635 1.36761L6.91964 7.98187L0.279635 14.5961C0.195889 14.6677 0.127873 14.7557 0.0798545 14.8547C0.0318359 14.9536 0.00485175 15.0615 0.000596153 15.1713C-0.00365944 15.2812 0.0149049 15.3908 0.0551246 15.4932C0.0953442 15.5956 0.156351 15.6886 0.234315 15.7663C0.312278 15.8441 0.405516 15.9049 0.508176 15.945C0.610836 15.9851 0.720702 16.0036 0.830878 15.9994C0.941053 15.9952 1.04916 15.9682 1.14841 15.9204C1.24766 15.8725 1.33592 15.8046 1.40763 15.7211L8.04764 9.10685L14.6796 15.7211C14.8327 15.8518 15.0295 15.9201 15.2309 15.9124C15.4322 15.9046 15.6232 15.8214 15.7657 15.6793C15.9082 15.5372 15.9916 15.3467 15.9994 15.1459C16.0072 14.9451 15.9387 14.7488 15.8076 14.5961L9.17564 7.98187Z"
                                                      fill="#D1DBE3"></path>
                                            </svg>

                                        </div>
                                        <div class="rating-help-window-body">
                                            <div class="block-rating-help-item">
                                                <div class="top-block-rating-help-item" style="color:#000000;">
                                                    <div class="top-block-rating-help-item-title">
                                                        Оценки <span
                                                                class="t-c-blue">Репутационного рейтинга</span>
                                                    </div>
                                                </div>
                                                <div class="content-top-block-rating-help-item t-c-black">
                                                    <br>
                                                    образуется на основании отзывов клиентов охранных компаний,
                                                    которые оценивают свой опыт взаимодействия с ними по трем
                                                    критериямм:
                                                    <br><br>

                                                    <ul>
                                                        <li>Клиентоориентированность</li>
                                                        <li>Безопасность</li>
                                                        <li>Комфорт</li>
                                                    </ul>
                                                    <br>

                                                    <a href="#formation" class="link-item">Как формируется
                                                        Рейтинг</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <? if ($item['STATUS_COMPANY']['ID'] == 1497): ?>
                                    <div class="info-block-two rating-check-window">
                                        <div class="info-block-two__right">
                                            <div class="info-block-two__right_row">
                                                <img class="icon-open-info-block"
                                                     src="/upload/rating/icon-info.svg"
                                                     alt="img">
                                                Ссылка на договор
                                            </div>
                                            <div class="info-block-bottom">
                                                <div class="links-contract">
                                                    <a class="link-item<?= $item['HONEST_CONTRACT'] == 'Y' ? '' : ' t-c-gray' ?>" <?= $item['HONEST_CONTRACT'] == 'Y' ? 'target=\'_blank\' href=\'' . $arResult['CONTRACT']['SRC'] . '\'' : ''; ?>>vincko:
                                                        Честный договор</a>
                                                    <a class="link-item<?= empty($item['CONTRACT']) ? ' t-c-gray' : '' ?>" <?= empty($item['CONTRACT']) ? '' : 'href=\'' . $item['CONTRACT'] . '\' target=\'_blank\'' ?>>Договор
                                                        охранной компании</a>
                                                </div>
                                                <div class="text-descrip t-c-gray">
                                                    Перед покупкой услуг охранной компании - ознакомьтесь с текстом
                                                    договора
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rating-help-window active" style="display: none;">
                                            <div class="rating-help-window-close">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9.17564 7.98187L15.8076 1.36761C15.9387 1.21497 16.0072 1.01864 15.9994 0.817837C15.9916 0.617035 15.9082 0.426555 15.7657 0.28446C15.6232 0.142366 15.4322 0.0591225 15.2309 0.0513664C15.0295 0.0436103 14.8327 0.111912 14.6796 0.242623L8.04764 6.85688L1.41563 0.234644C1.26499 0.084404 1.06068 0 0.847635 0C0.634593 0 0.430278 0.084404 0.279635 0.234644C0.128992 0.384884 0.0443614 0.588653 0.0443614 0.801125C0.0443614 1.0136 0.128992 1.21737 0.279635 1.36761L6.91964 7.98187L0.279635 14.5961C0.195889 14.6677 0.127873 14.7557 0.0798545 14.8547C0.0318359 14.9536 0.00485175 15.0615 0.000596153 15.1713C-0.00365944 15.2812 0.0149049 15.3908 0.0551246 15.4932C0.0953442 15.5956 0.156351 15.6886 0.234315 15.7663C0.312278 15.8441 0.405516 15.9049 0.508176 15.945C0.610836 15.9851 0.720702 16.0036 0.830878 15.9994C0.941053 15.9952 1.04916 15.9682 1.14841 15.9204C1.24766 15.8725 1.33592 15.8046 1.40763 15.7211L8.04764 9.10685L14.6796 15.7211C14.8327 15.8518 15.0295 15.9201 15.2309 15.9124C15.4322 15.9046 15.6232 15.8214 15.7657 15.6793C15.9082 15.5372 15.9916 15.3467 15.9994 15.1459C16.0072 14.9451 15.9387 14.7488 15.8076 14.5961L9.17564 7.98187Z"
                                                          fill="#D1DBE3"></path>
                                                </svg>

                                            </div>
                                            <div class="rating-help-window-body">
                                                <div class="block-rating-help-item">
                                                    <div class="top-block-rating-help-item"
                                                         style="color:#000000;">
                                                        <div class="top-block-rating-help-item-title">
                                                            <span class="t-c-blue">Договор</span> с охранной
                                                            компанией
                                                        </div>
                                                    </div>
                                                    <div class="content-top-block-rating-help-item t-c-black">
                                                        <br>
                                                        <ul>
                                                            <li>
                                                                <span>Честный договор составлен и рекомендован vincko: договор сформулирован таким образом, чтобы максимально защитить права и интересы клиентов, заказывающих услуги охранных компаний на платформе vincko:</span>
                                                                <br><br>
                                                                <span class="t-c-gray"
                                                                      style="font-weight: normal"><span
                                                                            class="t-c-blue t-u-under b">vincko: Честный договор</span> - доступен при покупке услуг данной компании</span>
                                                                <br>
                                                                <span class="t-c-gray"
                                                                      style="font-weight: normal"><span
                                                                            class="t-u-under g">vincko: Честный договор</span> - <span
                                                                            class="t-c-red">не</span> доступен при покупке услуг данной компании</span>
                                                                <br><br>
                                                            </li>
                                                            <li>
                                                                <span>Договор охранной компании: предоставляется индивидуально самой компанией, всю ответственность за условия такого договора несет данная охранная компания.</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <? elseif ($item['STATUS_COMPANY']['ID'] == 1498): ?>
                                    <div class="info-block-two">
                                        <div class="info-block-two__right">
                                            <div class="text-descrip t-c-gray">
                                                Мы оповестим охранные компании о вашем намерении и поможем вам
                                                заключить
                                                договор охраны.
                                            </div>
                                            <div class="single-zayavka">
                                                <a class="single-zayavka-btn" href="/zayavka/">Заполнить индивидуальную
                                                    заявку</a>
                                            </div>

                                        </div>
                                    </div>

                                <? endif; ?>
                            </div>
                        <? endif; ?>
                        <? if ($item['STATUS_COMPANY']['ID'] == 1498 || $item['STATUS_COMPANY']['ID'] == 1497): ?>
                            <div class="itemRating-open__tab">
                                <div class="tabs-wrapper links-tab">
                                    <a class="tab tab-one tab_active" href="#">
                                        Охрана квартиры
                                    </a>
                                    <a class="tab tab-two" href="#">
                                        Охрана дома
                                    </a>
                                    <a class="tab tab-three" href="#">
                                        Охрана коммерческой недвижимости
                                    </a>
                                </div>
                                <div class="tabs-wrapper content-tab">
                                    <div class="tabs-content content-one tabs-content_active">
                                        <div class="tabs-content__column">
                                            <div class="tabs-content__column_title">
                                                Услуги
                                            </div>
                                            <div class="tabs-content__column_lists">
                                                <?= $item['SERVICES_APPARTAMENT'] ?>
                                            </div>
                                        </div>
                                        <div class="tabs-content__column">
                                            <div class="tabs-content__column_title">
                                                Стандартные<br>
                                                периоды обслуживания
                                            </div>
                                            <div class="tabs-content__column_lists">
                                                <?= $item['DESCRIPTION_APPARTAMENT'] ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tabs-content content-two">
                                        <div class="tabs-content__column">
                                            <div class="tabs-content__column_title">
                                                Услуги
                                            </div>
                                            <div class="tabs-content__column_lists">
                                                <?= $item['SERVICES_HOME'] ?>
                                            </div>
                                        </div>
                                        <div class="tabs-content__column border-none">
                                            <div class="tabs-content__column_title">
                                                Решение индивидуальных задач
                                            </div>
                                            <div class="tabs-content__column_text tabs-content__column_lists">
                                                <?= $item['DESCRIPTION_HOME'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tabs-content content-three">
                                        <div class="tabs-content__column">
                                            <div class="tabs-content__column_title">
                                                Услуги
                                            </div>
                                            <div class="tabs-content__column_lists">
                                                <?= $item['SERVICES_COMMERCE'] ?>
                                            </div>
                                        </div>
                                        <div class="tabs-content__column border-none">
                                            <div class="tabs-content__column_title">
                                                Решение индивидуальных задач
                                            </div>
                                            <div class="tabs-content__column_text tabs-content__column_lists">
                                                <?= $item['DESCRIPTION_COMMERCE'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="itemRating-open__left_bottom">
                                <? if (count($item['REVIEWS']) > 0): ?>
                                    <div class="itemRating-open__left_bottom-mobilLinks">
                                        <a href="/reviews/?COMPANY=<?= $item['CHOP_ID']['ID'] ?>">Читать все
                                            <span><?= count($item['REVIEWS']) ?></span> отзыва</a>
                                        <span class="closed-card">Закрыть карточку</span>
                                    </div>
                                <? endif; ?>
                                <div class="itemRating-open__left_bottom-btns">
                                    <a href="/norating/?COMPANY=<?= $item['CHOP_ID']['ID'] ?>"
                                       class="itemRating-open__left_bottom-btn">
                                        к компании
                                    </a>
                                    <? if ($item['STATUS_COMPANY']['ID'] == 1497): ?>
                                        <a href="/packages/?COMPANY=<?= $item['ID'] ?>"
                                           class="itemRating-open__left_bottom-btn">
                                            Заказать услуги
                                        </a>
                                    <? endif; ?>
                                </div>
                                <div class="itemRating-open__left_bottom-text">
                                    Производители, с оборудованием которых работает компания:
                                    <div>
                                        <? foreach ($item['MANUFACTURERS'] as $manufacture): ?>
                                            <span><?= $manufacture['NAME'] ?></span>
                                        <? endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <? else: ?>
                            <div class="itemRating-open__left_text">
                                <? if (count($item['REVIEWS']) > 0): ?>
                                    <div class="itemRating-open__left_text-top">
                                        <span>О компании есть отзывы на платформе, но Не является партнером vincko:</span>
                                    </div>
                                    <div class="itemRating-open__left_text-bottom">
                                        Для вас мы постарались найти оценки и отзывы о компании и в сторонних
                                        источниках,<br>
                                        но этого оказалось недостаточно, чтобы распространить <a
                                                href="#guarantee">гарантии
                                            vincko:</a> на услуги этой компании.
                                    </div>
                                    <div class="itemRating-open__left_text-mobilLinks">
                                        <a href="/reviews/?COMPANY=<?= $item['CHOP_ID']['ID'] ?>">Читать все
                                            <span><?= count($item['REVIEWS']) ?></span> отзыва</a>
                                        <span class="closed-card">Закрыть карточку</span>
                                    </div>
                                <? else: ?>
                                    <div class="itemRating-open__left_text-top">
                                        <span>О компании нет отзывов на платформе vincko:</span>
                                    </div>
                                    <div class="itemRating-open__left_text-bottom">
                                        Для вас мы постарались найти оценки и отзывы о компании и в сторонних
                                        источниках,<br>
                                        но этого оказалось недостаточно, чтобы распространить <a
                                                href="#guarantee">гарантии
                                            vincko:</a> на услуги этой компании.
                                    </div>
                                <? endif; ?>
                            </div>
                        <? endif; ?>
                    </div>
                    <div class="itemRating-open__right">
                        <? if (count($item['REVIEWS']) > 0): ?>
                            <div class="itemRating-open__right_top">
                                <a href="/reviews/?COMPANY=<?= $item['CHOP_ID']['ID'] ?>">Читать все
                                    <span><?= count($item['REVIEWS']) ?></span> отзыва</a>
                            </div>
                            <div class="itemRating-open__right_wrapper">
                                <div class="swiper-container mySwiper">
                                    <div class="swiper-wrapper">
                                        <? $i = 0;
                                        foreach ($item['REVIEWS'] as $review): $i++; ?>
                                            <div class="swiper-slide">
                                                <div class="itemRating-open__review">
                                                    <div class="itemRating-open__review_top">
                                                        <div class="itemRating-open__review_top-icon">
                                                            <img src="/upload/rating/itemRating-open__review_top-icon.svg"
                                                                 alt="img">
                                                        </div>
                                                        <div class="itemRating-open__review_top-text">
                                                            <span class="name"><?= !empty($review['NAME']) ? $review['NAME'] : 'Пользователь скрыл имя настройками приватности'; ?></span>
                                                            <span class="city"><?= $review['CITY']['NAME'] ?></span>
                                                            <? if ($review['TYPE'] == 3): ?>
                                                                <span class="buyer">покупатель</span>
                                                                <!--<img src="/upload/rating/icon-info.svg" alt="img">-->
                                                            <? endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="itemRating-open__review_bottom">
                                                        <span>Комментарий пользователя:</span>
                                                        <?= $review['COMMENT'] ?>
                                                        <? if (!empty($review['COMMENT'])): ?>
                                                            <button onclick="location.href='/reviews/?COMPANY=<?= $item['ID'] ?>&REVIEW=<?= $review['ID'] ?>'">
                                                                Читать далее
                                                            </button>
                                                        <? else: ?>
                                                            <p>Пользователь не оставил комментарий</p>
                                                        <? endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <? if ($i == 3):break;endif;endforeach; ?>
                                    </div>
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        <? endif; ?>
                        <br>
                        <div class="itemRating-open__right_bottom">
                            <a class="itemRating-open__right_bottom-btn" href="/review-add/">Оставить свой отзыв</a>
                            <div class="itemRating-open__right_bottom-text">
                                <span>источник</span>
                                <img src="/upload/rating/info-block-one__left_icon.svg" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <? endforeach; ?>
</div>
<div class="rating-center__items_bottom">
    <a href="#rating-center" class="rating-center__items_bottom-btnTop">
        Подняться к фильтрам
    </a>
    <?= $arResult['PAGINATION'] ?>
</div>