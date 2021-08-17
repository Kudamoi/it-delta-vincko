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
<?php
echo "<pre>";
    print_r($arResult);
echo "</pre>";
?>
<?php /*
<ul class="reviews__items">
    <? foreach ($arResult['rows'] as $row): ?>
        <? $currentSourceName = $arResult['ReviewsSources'][$row['UF_REVIEW_SOURCE_ID']]['UF_REVIEW_SOURCE_NAME']; ?>
        <li class="reviews__item <?= $currentSourceName == "Vincko" ? "" : "not-vinco__raiting" ?>">
            <div class="reviews__item-left">
                <div class="reviews__item__head">
                    <div class="reviews__item__head--left">
                        <div class="person__avatar">
                            <img src="/upload/reviews/avatar.png" alt="img">
                        </div>
                        <div class="person__items">
                            <? if ($currentSourceName == "Vincko"): ?>
                                <span class="name"><?= $arResult['USERS_LIST'][$row['UF_USER_ID']]['NAME'] ?> <?= $arResult['USERS_LIST'][$row['UF_USER_ID']]['LAST_NAME'] ?></span>
                            <? else: ?>
                                <span class="name"><?= $row['UF_USER_NAME'] ?></span>
                            <? endif; ?>
                            <span class="town"><?= $arResult['CITIES'][$row['UF_CITY_ID']]['NAME'] ?></span>
                        </div>
                    </div>
                    <div class="reviews__item__head--right">
                        <p>Личная оценка по критериям <a href="">vincko:</a></p>
                        <div class="raiting__content">
                            <ul class="raiting__vincko">
                                <? foreach ($arResult['CRITERIA'] as $criteria): ?>
                                    <? if (!empty((float)$row[$criteria['UF_REVIEW_SCORE_PROPERTY_NAME']])): ?>
                                        <li>
                                            <span class="icon"><img src="<?= $criteria['ICON']['src'] ?>" alt="<?= $criteria['NAME'] ?>"></span>
                                            <span class="text"><?=(float)$row[$criteria['UF_REVIEW_SCORE_PROPERTY_NAME']] ?></span>
                                        </li>
                                    <? endif; ?>
                                <? endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="reviews__item__body">
                    <div class="reviews__item__body--top">
                        <? if (!empty($row['UF_ALLSCORE_REVIEW_SCORE_COMMENT'])): ?>
                            <span>Общее впечатление: </span>
                            <p><?= $row['UF_ALLSCORE_REVIEW_SCORE_COMMENT'] ?></p>
                        <? endif; ?>
                    </div>
                    <div class="reviews__item__body--center">
                        <? if (!empty($row['UF_CUSTOMER_FOCUS_COMMENT'])): ?>
                            <span>Клиентоориентированность: </span>
                            <p><?= $row['UF_CUSTOMER_FOCUS_COMMENT'] ?></p>
                        <? endif; ?>
                        <? if (!empty($row['UF_SECURITY_SCORE_COMMENT'])): ?>
                            <span>Безопасность: </span>
                            <p><?= $row['UF_SECURITY_SCORE_COMMENT'] ?></p>
                        <? endif; ?>
                        <? if (!empty($row['UF_COMFORT_SCORE_COMMENT'])): ?>
                            <span>Комфорт: </span>
                            <p><?= $row['UF_COMFORT_SCORE_COMMENT'] ?></p>
                        <? endif; ?>
                        <? if (!empty($arResult['ReviewsScores'])): ?>
                            <? foreach ($arResult['ReviewsScores'] as $reviewsScore): ?>
                                <? if ($row['ID'] == $reviewsScore['UF_REVIEW_ID']): ?>
                                    <span><?= $arResult['CRITERIA_QUESTIONS'][$reviewsScore['UF_QUESTION_ID']]['NAME'] ?></span>
                                    <p><?= $reviewsScore['UF_REVIEW_SCORE_COMMENT'] ?></p>
                                <? endif; ?>
                            <? endforeach; ?>
                        <? endif; ?>
                    </div>
                </div>
                <div class="reviews__item__footer">
                </div>
            </div>
            <div class="reviews__item-right">
                <div class="reviews__item-right--top">
                    <div class="raiting">
                        <div class="raiting__position">
                                <span class="icon">
                                    <svg width="54" height="44" viewBox="0 0 54 44" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M52 17.0646C52 21.0211 51.0561 24.9209 49.2462 28.4416C47.4363 31.9623 44.8125 35.0029 41.5914 37.3122C38.3704 39.6214 34.6447 41.133 30.7221 41.7221C26.7995 42.3112 22.7927 41.9607 19.0328 40.6998C15.2728 39.4389 11.8677 37.3037 9.09867 34.4706C6.32967 31.6376 4.27634 28.1879 3.10832 24.4068C1.94031 20.6257 1.69115 16.6216 2.38143 12.7254C3.07172 8.82926 4.68163 5.15286 7.07814 2"
                                            stroke="#005DFF" stroke-width="4"/>
                                    </svg>
                                </span>
                            <span class="raiting__satr-number"><?= $arResult['SECURE_COMPANY_LIST'][$row['UF_CHOP_ID']]['PROPERTY_EL_RATING_SUM_VALUE'] ?></span>
                        </div>
                        <p><a href="">vincko:</a></p>
                    </div>
                    <div class="raiting__about">
                        <span class="raiting__about-name"><?= $arResult['SECURE_COMPANY_LIST'][$row['UF_CHOP_ID']]['PROPERTY_CHOP_ID_NAME'] ?></span>
                        <span class="raiting__about-btn"><a href="/review-add/">Оставить отзыв</a></span>
                        <span class="raiting__about-chart">
                                <span class="icon">
                                    <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M4.75 15.5H5.75C5.94891 15.5 6.13968 15.421 6.28033 15.2803C6.42098 15.1397 6.5 14.9489 6.5 14.75V1.25C6.5 1.05109 6.42098 0.860322 6.28033 0.71967C6.13968 0.579018 5.94891 0.5 5.75 0.5H4.75C4.55109 0.5 4.36032 0.579018 4.21967 0.71967C4.07902 0.860322 4 1.05109 4 1.25V14.75C4 14.9489 4.07902 15.1397 4.21967 15.2803C4.36032 15.421 4.55109 15.5 4.75 15.5ZM12.75 15.5H11.75C11.5511 15.5 11.3603 15.421 11.2197 15.2803C11.079 15.1397 11 14.9489 11 14.75V3.75C11 3.55109 11.079 3.36032 11.2197 3.21967C11.3603 3.07902 11.5511 3 11.75 3H12.75C12.9489 3 13.1397 3.07902 13.2803 3.21967C13.421 3.36032 13.5 3.55109 13.5 3.75V14.75C13.5 14.9489 13.421 15.1397 13.2803 15.2803C13.1397 15.421 12.9489 15.5 12.75 15.5ZM8.25 15.5H9.25C9.44891 15.5 9.63968 15.421 9.78033 15.2803C9.92098 15.1397 10 14.9489 10 14.75V7.25C10 7.05109 9.92098 6.86032 9.78033 6.71967C9.63968 6.57902 9.44891 6.5 9.25 6.5H8.25C8.05109 6.5 7.86032 6.57902 7.71967 6.71967C7.57902 6.86032 7.5 7.05109 7.5 7.25V14.75C7.5 14.9489 7.57902 15.1397 7.71967 15.2803C7.86032 15.421 8.05109 15.5 8.25 15.5ZM1.25 15.5H2.25C2.44891 15.5 2.63968 15.421 2.78033 15.2803C2.92098 15.1397 3 14.9489 3 14.75V10.25C3 10.0511 2.92098 9.86032 2.78033 9.71967C2.63968 9.57902 2.44891 9.5 2.25 9.5H1.25C1.05109 9.5 0.860322 9.57902 0.71967 9.71967C0.579018 9.86032 0.5 10.0511 0.5 10.25V14.75C0.5 14.9489 0.579018 15.1397 0.71967 15.2803C0.860322 15.421 1.05109 15.5 1.25 15.5Z"
                                              fill="#005DFF"/>
                                    </svg>
                                </span>
                                <span class="number"><?= $arResult['COMPANIES_RATING_POSITIONS'][$row['UF_CHOP_ID']]['POSITION_IN_RATING'] ?></span>
                                <a href="">в Рейтинге</a>
                            </span>
                    </div>
                </div>
                <div class="reviews__item-right--bottom">

                    <a href="" class="button blue-color">Перейти к рейтингу
                        <span class="icon">
                                    <svg width="13" height="10" viewBox="0 0 13 10" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M0.499512 5C0.499511 4.81059 0.57852 4.62894 0.719157 4.49501C0.859794 4.36108 1.05054 4.28584 1.24943 4.28584L9.93796 4.28584L6.71782 1.22068C6.64809 1.15428 6.59278 1.07545 6.55505 0.9887C6.51732 0.901945 6.49789 0.808961 6.49789 0.715058C6.49789 0.621155 6.51732 0.528171 6.55505 0.441416C6.59278 0.354662 6.64809 0.275834 6.71782 0.209435C6.78754 0.143036 6.87032 0.0903642 6.96141 0.0544297C7.05251 0.0184943 7.15015 -2.90709e-07 7.24876 -2.95019e-07C7.34736 -2.99329e-07 7.445 0.0184943 7.5361 0.0544297C7.6272 0.0903641 7.70997 0.143036 7.7797 0.209435L12.2792 4.49438C12.349 4.56071 12.4044 4.63952 12.4422 4.72629C12.4801 4.81305 12.4995 4.90606 12.4995 5C12.4995 5.09394 12.4801 5.18695 12.4422 5.27371C12.4044 5.36048 12.349 5.43928 12.2792 5.50562L7.7797 9.79056C7.70997 9.85696 7.6272 9.90963 7.5361 9.94557C7.445 9.9815 7.34736 10 7.24876 10C7.15015 10 7.05251 9.9815 6.96141 9.94557C6.87032 9.90963 6.78754 9.85696 6.71782 9.79056C6.577 9.65646 6.49789 9.47459 6.49789 9.28494C6.49789 9.19104 6.51732 9.09805 6.55505 9.0113C6.59278 8.92454 6.64809 8.84572 6.71782 8.77932L9.93796 5.71416L1.24943 5.71416C1.05054 5.71416 0.859794 5.63892 0.719157 5.50498C0.57852 5.37105 0.499512 5.18941 0.499512 5Z"
                                              fill="#005DFF"/>
                                    </svg>
                                </span>
                    </a>
                    <br>
                    <a href="" class="button">Охранные услуги компании<span class="icon">
                                <svg width="13" height="10" viewBox="0 0 13 10" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M0.499512 5C0.499511 4.81059 0.57852 4.62894 0.719157 4.49501C0.859794 4.36108 1.05054 4.28584 1.24943 4.28584L9.93796 4.28584L6.71782 1.22068C6.64809 1.15428 6.59278 1.07545 6.55505 0.9887C6.51732 0.901945 6.49789 0.808961 6.49789 0.715058C6.49789 0.621155 6.51732 0.528171 6.55505 0.441416C6.59278 0.354662 6.64809 0.275834 6.71782 0.209435C6.78754 0.143036 6.87032 0.0903642 6.96141 0.0544297C7.05251 0.0184943 7.15015 -2.90709e-07 7.24876 -2.95019e-07C7.34736 -2.99329e-07 7.445 0.0184943 7.5361 0.0544297C7.6272 0.0903641 7.70997 0.143036 7.7797 0.209435L12.2792 4.49438C12.349 4.56071 12.4044 4.63952 12.4422 4.72629C12.4801 4.81305 12.4995 4.90606 12.4995 5C12.4995 5.09394 12.4801 5.18695 12.4422 5.27371C12.4044 5.36048 12.349 5.43928 12.2792 5.50562L7.7797 9.79056C7.70997 9.85696 7.6272 9.90963 7.5361 9.94557C7.445 9.9815 7.34736 10 7.24876 10C7.15015 10 7.05251 9.9815 6.96141 9.94557C6.87032 9.90963 6.78754 9.85696 6.71782 9.79056C6.577 9.65646 6.49789 9.47459 6.49789 9.28494C6.49789 9.19104 6.51732 9.09805 6.55505 9.0113C6.59278 8.92454 6.64809 8.84572 6.71782 8.77932L9.93796 5.71416L1.24943 5.71416C1.05054 5.71416 0.859794 5.63892 0.719157 5.50498C0.57852 5.37105 0.499512 5.18941 0.499512 5Z"
                                          fill="black"/>
                                </svg>
                            </span></a>
                </div>
            </div>
        </li>
    <? endforeach; ?>

</ul>
<div class="reviews__form-bottom">
    <div class="reviews__form-bottom--left"><span class="icon"><svg width="10" height="7" viewBox="0 0 10 7"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.9988 1.13553L8.91021 5.05793C9.15916 5.30745 9.15916 5.71199 8.91021 5.96138C8.66149 6.21079 8.25809 6.21079 8.00939 5.96138L4.54839 2.49065L1.08752 5.96128C0.838695 6.21069 0.435335 6.21069 0.186615 5.96128C-0.0622052 5.71187 -0.0622052 5.30734 0.186615 5.05783L4.09809 1.13543C4.22251 1.01072 4.3854 0.948437 4.54837 0.948437C4.71143 0.948437 4.87444 1.01084 4.9988 1.13553Z"
                            fill="#A0A0A0"/>
                    </svg></span>
        <a class="text return_to_filter-js" href="#reviews__form">Подняться к фильтрам</a>
    </div>
    <div class="reviews__form-bottom--right">
        <ul class="pagination">
            <li><a href="" class="prev">0</a></li>
            <li><span class="active">1</span></li>
            <li><a href="">2</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href="">5</a></li>
            <li><a href="">7</a></li>
            <li><a href="" class="next">8</a></li>
        </ul>
    </div>
</div>