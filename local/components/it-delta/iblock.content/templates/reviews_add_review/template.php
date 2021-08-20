<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

global $USER;

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
<main class="review">
    
    <div class="container">
        <!-- <div class="breadcumbs">
            <nav>
                <ul>
                    <li><a href="/">Главная </a></li>
                    <li><a href="">Охранные предприятия</a></li>
                    <li><a href="">ООО «ЧОП «ЗУБР»</a></li>
                    <li><a href="">Оставить отзыв</a></li>
                </ul>
            </nav>
        </div> -->

        <!-- Эта версия фильтра временно не используется -->
        <!-- <div class="reviews__form-top">
            <form>
                <div class="pseudo__search">
                    <p class="text search-top-text">Оставить отзыв о другой компании</p>
                    <input type="text" class="form__control" placeholder="Найти компанию">
                </div>
                <div class="pseudo__range">
                    <p class="text">Найдите компании по рейтингу <span class="pseudo__range-text__select">Все</span></p>
                    <input type="range" id="pseudo__range" min="0" max="10" step="1" value="1">
                </div>
                <div class="reviews__form-top--hidden ">
                    <div class="close__btn-top close-js">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.17564 7.98187L15.8076 1.36761C15.9387 1.21497 16.0072 1.01864 15.9994 0.817837C15.9916 0.617035 15.9082 0.426555 15.7657 0.28446C15.6232 0.142366 15.4322 0.0591225 15.2309 0.0513664C15.0295 0.0436103 14.8327 0.111912 14.6796 0.242623L8.04764 6.85688L1.41563 0.234644C1.26499 0.084404 1.06068 0 0.847635 0C0.634593 0 0.430278 0.084404 0.279635 0.234644C0.128992 0.384884 0.0443614 0.588653 0.0443614 0.801125C0.0443614 1.0136 0.128992 1.21737 0.279635 1.36761L6.91964 7.98187L0.279635 14.5961C0.195889 14.6677 0.127873 14.7557 0.0798545 14.8547C0.0318359 14.9536 0.00485175 15.0615 0.000596153 15.1713C-0.00365944 15.2812 0.0149049 15.3908 0.0551246 15.4932C0.0953442 15.5956 0.156351 15.6886 0.234315 15.7663C0.312278 15.8441 0.405516 15.9049 0.508176 15.945C0.610836 15.9851 0.720702 16.0036 0.830878 15.9994C0.941053 15.9952 1.04916 15.9682 1.14841 15.9204C1.24766 15.8725 1.33592 15.8046 1.40763 15.7211L8.04764 9.10685L14.6796 15.7211C14.8327 15.8518 15.0295 15.9201 15.2309 15.9124C15.4322 15.9046 15.6232 15.8214 15.7657 15.6793C15.9082 15.5372 15.9916 15.3467 15.9994 15.1459C16.0072 14.9451 15.9387 14.7488 15.8076 14.5961L9.17564 7.98187Z"
                                fill="#005DFF" />
                        </svg>
                    </div>
                    <div class="left">
                        <p>Город</p>
                        <div class="left__filter_city">
                            <input id="filter_city-js" type="text" placeholder="Введите город" value="">
                        </div>
                        <ul class="left__filter_city-items">
                            <li><a href="">Москва</a></li>
                            <li><a href="">Орел</a></li>
                            <li><a href="">Воркута</a></li>
                            <li><a href="">Новосибирск</a></li>
                            <li><a href="">Севастополь</a></li>
                            <li><a href="">Ростов-на-Дону</a></li>
                            <li><a href="">Пенза</a></li>
                            <li><a href="">Петропавловск-Камчатский</a></li>
                            <li><a href="">Алупка</a></li>
                            <li><a href="">Алушта</a></li>
                            <li><a href="">Симферополь</a></li>
                            <li><a href="">Таганрг</a></li>
                            <li><a href="">Псков</a></li>
                            <li><a href="">Звенигород</a></li>
                            <li><a href="">Рига</a></li>
                            <li><a href="">Рим</a></li>
                        </ul>
                    </div>
                    <div class="center">
                        <p>Компании, которые есть в <a href="">Рейтинге Репутаций</a></p>
                        <div class="center__overflow">
                            <div class="center__selected">
                                <span>Выбраны</span>
                            </div>
                            <div class="center__top_in">
                                <span>Топ-3</span>
                                <label class="center__selected-label">
                                    <input class="input" type="checkbox" name="company_in_raiting">
                                    <span>
                                        <span class="text">ООО “Беркут Дефенд Компани”</span>
                                        <span class="icon">
                                            <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M4.75 15.5H5.75C5.94891 15.5 6.13968 15.421 6.28033 15.2803C6.42098 15.1397 6.5 14.9489 6.5 14.75V1.25C6.5 1.05109 6.42098 0.860322 6.28033 0.71967C6.13968 0.579018 5.94891 0.5 5.75 0.5H4.75C4.55109 0.5 4.36032 0.579018 4.21967 0.71967C4.07902 0.860322 4 1.05109 4 1.25V14.75C4 14.9489 4.07902 15.1397 4.21967 15.2803C4.36032 15.421 4.55109 15.5 4.75 15.5ZM12.75 15.5H11.75C11.5511 15.5 11.3603 15.421 11.2197 15.2803C11.079 15.1397 11 14.9489 11 14.75V3.75C11 3.55109 11.079 3.36032 11.2197 3.21967C11.3603 3.07902 11.5511 3 11.75 3H12.75C12.9489 3 13.1397 3.07902 13.2803 3.21967C13.421 3.36032 13.5 3.55109 13.5 3.75V14.75C13.5 14.9489 13.421 15.1397 13.2803 15.2803C13.1397 15.421 12.9489 15.5 12.75 15.5ZM8.25 15.5H9.25C9.44891 15.5 9.63968 15.421 9.78033 15.2803C9.92098 15.1397 10 14.9489 10 14.75V7.25C10 7.05109 9.92098 6.86032 9.78033 6.71967C9.63968 6.57902 9.44891 6.5 9.25 6.5H8.25C8.05109 6.5 7.86032 6.57902 7.71967 6.71967C7.57902 6.86032 7.5 7.05109 7.5 7.25V14.75C7.5 14.9489 7.57902 15.1397 7.71967 15.2803C7.86032 15.421 8.05109 15.5 8.25 15.5ZM1.25 15.5H2.25C2.44891 15.5 2.63968 15.421 2.78033 15.2803C2.92098 15.1397 3 14.9489 3 14.75V10.25C3 10.0511 2.92098 9.86032 2.78033 9.71967C2.63968 9.57902 2.44891 9.5 2.25 9.5H1.25C1.05109 9.5 0.860322 9.57902 0.71967 9.71967C0.579018 9.86032 0.5 10.0511 0.5 10.25V14.75C0.5 14.9489 0.579018 15.1397 0.71967 15.2803C0.860322 15.421 1.05109 15.5 1.25 15.5Z"
                                                    fill="white" />
                                            </svg>
                                        </span>
                                        <span class="raiting__number">4</span>
                                    </span>
                                </label>
                                <label class="center__selected-label">
                                    <input class="input" type="checkbox" name="company_in_raiting">
                                    <span>
                                        <span class="text">Сальса Чача Классно</span>
                                        <span class="icon">
                                            <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M4.75 15.5H5.75C5.94891 15.5 6.13968 15.421 6.28033 15.2803C6.42098 15.1397 6.5 14.9489 6.5 14.75V1.25C6.5 1.05109 6.42098 0.860322 6.28033 0.71967C6.13968 0.579018 5.94891 0.5 5.75 0.5H4.75C4.55109 0.5 4.36032 0.579018 4.21967 0.71967C4.07902 0.860322 4 1.05109 4 1.25V14.75C4 14.9489 4.07902 15.1397 4.21967 15.2803C4.36032 15.421 4.55109 15.5 4.75 15.5ZM12.75 15.5H11.75C11.5511 15.5 11.3603 15.421 11.2197 15.2803C11.079 15.1397 11 14.9489 11 14.75V3.75C11 3.55109 11.079 3.36032 11.2197 3.21967C11.3603 3.07902 11.5511 3 11.75 3H12.75C12.9489 3 13.1397 3.07902 13.2803 3.21967C13.421 3.36032 13.5 3.55109 13.5 3.75V14.75C13.5 14.9489 13.421 15.1397 13.2803 15.2803C13.1397 15.421 12.9489 15.5 12.75 15.5ZM8.25 15.5H9.25C9.44891 15.5 9.63968 15.421 9.78033 15.2803C9.92098 15.1397 10 14.9489 10 14.75V7.25C10 7.05109 9.92098 6.86032 9.78033 6.71967C9.63968 6.57902 9.44891 6.5 9.25 6.5H8.25C8.05109 6.5 7.86032 6.57902 7.71967 6.71967C7.57902 6.86032 7.5 7.05109 7.5 7.25V14.75C7.5 14.9489 7.57902 15.1397 7.71967 15.2803C7.86032 15.421 8.05109 15.5 8.25 15.5ZM1.25 15.5H2.25C2.44891 15.5 2.63968 15.421 2.78033 15.2803C2.92098 15.1397 3 14.9489 3 14.75V10.25C3 10.0511 2.92098 9.86032 2.78033 9.71967C2.63968 9.57902 2.44891 9.5 2.25 9.5H1.25C1.05109 9.5 0.860322 9.57902 0.71967 9.71967C0.579018 9.86032 0.5 10.0511 0.5 10.25V14.75C0.5 14.9489 0.579018 15.1397 0.71967 15.2803C0.860322 15.421 1.05109 15.5 1.25 15.5Z"
                                                    fill="white" />
                                            </svg>
                                        </span>
                                        <span class="raiting__number">10</span>
                                    </span>
                                </label>
                                <label class="center__selected-label">
                                    <input class="input" type="checkbox" name="company_in_raiting">
                                    <span>
                                        <span class="text">Василиск Секьюрити</span>
                                        <span class="icon">
                                            <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M4.75 15.5H5.75C5.94891 15.5 6.13968 15.421 6.28033 15.2803C6.42098 15.1397 6.5 14.9489 6.5 14.75V1.25C6.5 1.05109 6.42098 0.860322 6.28033 0.71967C6.13968 0.579018 5.94891 0.5 5.75 0.5H4.75C4.55109 0.5 4.36032 0.579018 4.21967 0.71967C4.07902 0.860322 4 1.05109 4 1.25V14.75C4 14.9489 4.07902 15.1397 4.21967 15.2803C4.36032 15.421 4.55109 15.5 4.75 15.5ZM12.75 15.5H11.75C11.5511 15.5 11.3603 15.421 11.2197 15.2803C11.079 15.1397 11 14.9489 11 14.75V3.75C11 3.55109 11.079 3.36032 11.2197 3.21967C11.3603 3.07902 11.5511 3 11.75 3H12.75C12.9489 3 13.1397 3.07902 13.2803 3.21967C13.421 3.36032 13.5 3.55109 13.5 3.75V14.75C13.5 14.9489 13.421 15.1397 13.2803 15.2803C13.1397 15.421 12.9489 15.5 12.75 15.5ZM8.25 15.5H9.25C9.44891 15.5 9.63968 15.421 9.78033 15.2803C9.92098 15.1397 10 14.9489 10 14.75V7.25C10 7.05109 9.92098 6.86032 9.78033 6.71967C9.63968 6.57902 9.44891 6.5 9.25 6.5H8.25C8.05109 6.5 7.86032 6.57902 7.71967 6.71967C7.57902 6.86032 7.5 7.05109 7.5 7.25V14.75C7.5 14.9489 7.57902 15.1397 7.71967 15.2803C7.86032 15.421 8.05109 15.5 8.25 15.5ZM1.25 15.5H2.25C2.44891 15.5 2.63968 15.421 2.78033 15.2803C2.92098 15.1397 3 14.9489 3 14.75V10.25C3 10.0511 2.92098 9.86032 2.78033 9.71967C2.63968 9.57902 2.44891 9.5 2.25 9.5H1.25C1.05109 9.5 0.860322 9.57902 0.71967 9.71967C0.579018 9.86032 0.5 10.0511 0.5 10.25V14.75C0.5 14.9489 0.579018 15.1397 0.71967 15.2803C0.860322 15.421 1.05109 15.5 1.25 15.5Z"
                                                    fill="white" />
                                            </svg>
                                        </span>
                                        <span class="raiting__number">9</span>
                                    </span>
                                </label>
                            </div>
                            <div class="center__not_selected">
                                <span>Не выбраны</span>
                                <label class="center__selected-label">
                                    <input class="input" type="checkbox" name="company_in_raiting">
                                    <span>
                                        <span class="text">ООО “Беркут Дефенд Компани”</span>
                                        <span class="icon">
                                            <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M4.75 15.5H5.75C5.94891 15.5 6.13968 15.421 6.28033 15.2803C6.42098 15.1397 6.5 14.9489 6.5 14.75V1.25C6.5 1.05109 6.42098 0.860322 6.28033 0.71967C6.13968 0.579018 5.94891 0.5 5.75 0.5H4.75C4.55109 0.5 4.36032 0.579018 4.21967 0.71967C4.07902 0.860322 4 1.05109 4 1.25V14.75C4 14.9489 4.07902 15.1397 4.21967 15.2803C4.36032 15.421 4.55109 15.5 4.75 15.5ZM12.75 15.5H11.75C11.5511 15.5 11.3603 15.421 11.2197 15.2803C11.079 15.1397 11 14.9489 11 14.75V3.75C11 3.55109 11.079 3.36032 11.2197 3.21967C11.3603 3.07902 11.5511 3 11.75 3H12.75C12.9489 3 13.1397 3.07902 13.2803 3.21967C13.421 3.36032 13.5 3.55109 13.5 3.75V14.75C13.5 14.9489 13.421 15.1397 13.2803 15.2803C13.1397 15.421 12.9489 15.5 12.75 15.5ZM8.25 15.5H9.25C9.44891 15.5 9.63968 15.421 9.78033 15.2803C9.92098 15.1397 10 14.9489 10 14.75V7.25C10 7.05109 9.92098 6.86032 9.78033 6.71967C9.63968 6.57902 9.44891 6.5 9.25 6.5H8.25C8.05109 6.5 7.86032 6.57902 7.71967 6.71967C7.57902 6.86032 7.5 7.05109 7.5 7.25V14.75C7.5 14.9489 7.57902 15.1397 7.71967 15.2803C7.86032 15.421 8.05109 15.5 8.25 15.5ZM1.25 15.5H2.25C2.44891 15.5 2.63968 15.421 2.78033 15.2803C2.92098 15.1397 3 14.9489 3 14.75V10.25C3 10.0511 2.92098 9.86032 2.78033 9.71967C2.63968 9.57902 2.44891 9.5 2.25 9.5H1.25C1.05109 9.5 0.860322 9.57902 0.71967 9.71967C0.579018 9.86032 0.5 10.0511 0.5 10.25V14.75C0.5 14.9489 0.579018 15.1397 0.71967 15.2803C0.860322 15.421 1.05109 15.5 1.25 15.5Z"
                                                    fill="white" />
                                            </svg>
                                        </span>
                                        <span class="raiting__number">4</span>
                                    </span>
                                </label>
                                <label class="center__selected-label">
                                    <input class="input" type="checkbox" name="company_in_raiting">
                                    <span>
                                        <span class="text">Сальса Чача Классно</span>
                                        <span class="icon">
                                            <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M4.75 15.5H5.75C5.94891 15.5 6.13968 15.421 6.28033 15.2803C6.42098 15.1397 6.5 14.9489 6.5 14.75V1.25C6.5 1.05109 6.42098 0.860322 6.28033 0.71967C6.13968 0.579018 5.94891 0.5 5.75 0.5H4.75C4.55109 0.5 4.36032 0.579018 4.21967 0.71967C4.07902 0.860322 4 1.05109 4 1.25V14.75C4 14.9489 4.07902 15.1397 4.21967 15.2803C4.36032 15.421 4.55109 15.5 4.75 15.5ZM12.75 15.5H11.75C11.5511 15.5 11.3603 15.421 11.2197 15.2803C11.079 15.1397 11 14.9489 11 14.75V3.75C11 3.55109 11.079 3.36032 11.2197 3.21967C11.3603 3.07902 11.5511 3 11.75 3H12.75C12.9489 3 13.1397 3.07902 13.2803 3.21967C13.421 3.36032 13.5 3.55109 13.5 3.75V14.75C13.5 14.9489 13.421 15.1397 13.2803 15.2803C13.1397 15.421 12.9489 15.5 12.75 15.5ZM8.25 15.5H9.25C9.44891 15.5 9.63968 15.421 9.78033 15.2803C9.92098 15.1397 10 14.9489 10 14.75V7.25C10 7.05109 9.92098 6.86032 9.78033 6.71967C9.63968 6.57902 9.44891 6.5 9.25 6.5H8.25C8.05109 6.5 7.86032 6.57902 7.71967 6.71967C7.57902 6.86032 7.5 7.05109 7.5 7.25V14.75C7.5 14.9489 7.57902 15.1397 7.71967 15.2803C7.86032 15.421 8.05109 15.5 8.25 15.5ZM1.25 15.5H2.25C2.44891 15.5 2.63968 15.421 2.78033 15.2803C2.92098 15.1397 3 14.9489 3 14.75V10.25C3 10.0511 2.92098 9.86032 2.78033 9.71967C2.63968 9.57902 2.44891 9.5 2.25 9.5H1.25C1.05109 9.5 0.860322 9.57902 0.71967 9.71967C0.579018 9.86032 0.5 10.0511 0.5 10.25V14.75C0.5 14.9489 0.579018 15.1397 0.71967 15.2803C0.860322 15.421 1.05109 15.5 1.25 15.5Z"
                                                    fill="white" />
                                            </svg>
                                        </span>
                                        <span class="raiting__number">14</span>
                                    </span>
                                </label>
                                <label class="center__selected-label">
                                    <input class="input" type="checkbox" name="company_in_raiting">
                                    <span>
                                        <span class="text">Василиск Секьюрити</span>
                                        <span class="icon">
                                            <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M4.75 15.5H5.75C5.94891 15.5 6.13968 15.421 6.28033 15.2803C6.42098 15.1397 6.5 14.9489 6.5 14.75V1.25C6.5 1.05109 6.42098 0.860322 6.28033 0.71967C6.13968 0.579018 5.94891 0.5 5.75 0.5H4.75C4.55109 0.5 4.36032 0.579018 4.21967 0.71967C4.07902 0.860322 4 1.05109 4 1.25V14.75C4 14.9489 4.07902 15.1397 4.21967 15.2803C4.36032 15.421 4.55109 15.5 4.75 15.5ZM12.75 15.5H11.75C11.5511 15.5 11.3603 15.421 11.2197 15.2803C11.079 15.1397 11 14.9489 11 14.75V3.75C11 3.55109 11.079 3.36032 11.2197 3.21967C11.3603 3.07902 11.5511 3 11.75 3H12.75C12.9489 3 13.1397 3.07902 13.2803 3.21967C13.421 3.36032 13.5 3.55109 13.5 3.75V14.75C13.5 14.9489 13.421 15.1397 13.2803 15.2803C13.1397 15.421 12.9489 15.5 12.75 15.5ZM8.25 15.5H9.25C9.44891 15.5 9.63968 15.421 9.78033 15.2803C9.92098 15.1397 10 14.9489 10 14.75V7.25C10 7.05109 9.92098 6.86032 9.78033 6.71967C9.63968 6.57902 9.44891 6.5 9.25 6.5H8.25C8.05109 6.5 7.86032 6.57902 7.71967 6.71967C7.57902 6.86032 7.5 7.05109 7.5 7.25V14.75C7.5 14.9489 7.57902 15.1397 7.71967 15.2803C7.86032 15.421 8.05109 15.5 8.25 15.5ZM1.25 15.5H2.25C2.44891 15.5 2.63968 15.421 2.78033 15.2803C2.92098 15.1397 3 14.9489 3 14.75V10.25C3 10.0511 2.92098 9.86032 2.78033 9.71967C2.63968 9.57902 2.44891 9.5 2.25 9.5H1.25C1.05109 9.5 0.860322 9.57902 0.71967 9.71967C0.579018 9.86032 0.5 10.0511 0.5 10.25V14.75C0.5 14.9489 0.579018 15.1397 0.71967 15.2803C0.860322 15.421 1.05109 15.5 1.25 15.5Z"
                                                    fill="white" />
                                            </svg>
                                        </span>
                                        <span class="raiting__number">4</span>
                                    </span>
                                </label>
                                <label class="center__selected-label">
                                    <input class="input" type="checkbox" name="company_in_raiting">
                                    <span>
                                        <span class="text">ООО “Беркут Дефенд Компани”</span>
                                        <span class="icon">
                                            <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M4.75 15.5H5.75C5.94891 15.5 6.13968 15.421 6.28033 15.2803C6.42098 15.1397 6.5 14.9489 6.5 14.75V1.25C6.5 1.05109 6.42098 0.860322 6.28033 0.71967C6.13968 0.579018 5.94891 0.5 5.75 0.5H4.75C4.55109 0.5 4.36032 0.579018 4.21967 0.71967C4.07902 0.860322 4 1.05109 4 1.25V14.75C4 14.9489 4.07902 15.1397 4.21967 15.2803C4.36032 15.421 4.55109 15.5 4.75 15.5ZM12.75 15.5H11.75C11.5511 15.5 11.3603 15.421 11.2197 15.2803C11.079 15.1397 11 14.9489 11 14.75V3.75C11 3.55109 11.079 3.36032 11.2197 3.21967C11.3603 3.07902 11.5511 3 11.75 3H12.75C12.9489 3 13.1397 3.07902 13.2803 3.21967C13.421 3.36032 13.5 3.55109 13.5 3.75V14.75C13.5 14.9489 13.421 15.1397 13.2803 15.2803C13.1397 15.421 12.9489 15.5 12.75 15.5ZM8.25 15.5H9.25C9.44891 15.5 9.63968 15.421 9.78033 15.2803C9.92098 15.1397 10 14.9489 10 14.75V7.25C10 7.05109 9.92098 6.86032 9.78033 6.71967C9.63968 6.57902 9.44891 6.5 9.25 6.5H8.25C8.05109 6.5 7.86032 6.57902 7.71967 6.71967C7.57902 6.86032 7.5 7.05109 7.5 7.25V14.75C7.5 14.9489 7.57902 15.1397 7.71967 15.2803C7.86032 15.421 8.05109 15.5 8.25 15.5ZM1.25 15.5H2.25C2.44891 15.5 2.63968 15.421 2.78033 15.2803C2.92098 15.1397 3 14.9489 3 14.75V10.25C3 10.0511 2.92098 9.86032 2.78033 9.71967C2.63968 9.57902 2.44891 9.5 2.25 9.5H1.25C1.05109 9.5 0.860322 9.57902 0.71967 9.71967C0.579018 9.86032 0.5 10.0511 0.5 10.25V14.75C0.5 14.9489 0.579018 15.1397 0.71967 15.2803C0.860322 15.421 1.05109 15.5 1.25 15.5Z"
                                                    fill="white" />
                                            </svg>
                                        </span>
                                        <span class="raiting__number">24</span>
                                    </span>
                                </label>
                                <label class="center__selected-label">
                                    <input class="input" type="checkbox" name="company_in_raiting">
                                    <span>
                                        <span class="text">Сальса Чача Классно</span>
                                        <span class="icon">
                                            <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M4.75 15.5H5.75C5.94891 15.5 6.13968 15.421 6.28033 15.2803C6.42098 15.1397 6.5 14.9489 6.5 14.75V1.25C6.5 1.05109 6.42098 0.860322 6.28033 0.71967C6.13968 0.579018 5.94891 0.5 5.75 0.5H4.75C4.55109 0.5 4.36032 0.579018 4.21967 0.71967C4.07902 0.860322 4 1.05109 4 1.25V14.75C4 14.9489 4.07902 15.1397 4.21967 15.2803C4.36032 15.421 4.55109 15.5 4.75 15.5ZM12.75 15.5H11.75C11.5511 15.5 11.3603 15.421 11.2197 15.2803C11.079 15.1397 11 14.9489 11 14.75V3.75C11 3.55109 11.079 3.36032 11.2197 3.21967C11.3603 3.07902 11.5511 3 11.75 3H12.75C12.9489 3 13.1397 3.07902 13.2803 3.21967C13.421 3.36032 13.5 3.55109 13.5 3.75V14.75C13.5 14.9489 13.421 15.1397 13.2803 15.2803C13.1397 15.421 12.9489 15.5 12.75 15.5ZM8.25 15.5H9.25C9.44891 15.5 9.63968 15.421 9.78033 15.2803C9.92098 15.1397 10 14.9489 10 14.75V7.25C10 7.05109 9.92098 6.86032 9.78033 6.71967C9.63968 6.57902 9.44891 6.5 9.25 6.5H8.25C8.05109 6.5 7.86032 6.57902 7.71967 6.71967C7.57902 6.86032 7.5 7.05109 7.5 7.25V14.75C7.5 14.9489 7.57902 15.1397 7.71967 15.2803C7.86032 15.421 8.05109 15.5 8.25 15.5ZM1.25 15.5H2.25C2.44891 15.5 2.63968 15.421 2.78033 15.2803C2.92098 15.1397 3 14.9489 3 14.75V10.25C3 10.0511 2.92098 9.86032 2.78033 9.71967C2.63968 9.57902 2.44891 9.5 2.25 9.5H1.25C1.05109 9.5 0.860322 9.57902 0.71967 9.71967C0.579018 9.86032 0.5 10.0511 0.5 10.25V14.75C0.5 14.9489 0.579018 15.1397 0.71967 15.2803C0.860322 15.421 1.05109 15.5 1.25 15.5Z"
                                                    fill="white" />
                                            </svg>
                                        </span>
                                        <span class="raiting__number">4</span>
                                    </span>
                                </label>
                                <label class="center__selected-label">
                                    <input class="input" type="checkbox" name="company_in_raiting">
                                    <span>
                                        <span class="text">Василиск Секьюрити</span>
                                        <span class="icon">
                                            <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M4.75 15.5H5.75C5.94891 15.5 6.13968 15.421 6.28033 15.2803C6.42098 15.1397 6.5 14.9489 6.5 14.75V1.25C6.5 1.05109 6.42098 0.860322 6.28033 0.71967C6.13968 0.579018 5.94891 0.5 5.75 0.5H4.75C4.55109 0.5 4.36032 0.579018 4.21967 0.71967C4.07902 0.860322 4 1.05109 4 1.25V14.75C4 14.9489 4.07902 15.1397 4.21967 15.2803C4.36032 15.421 4.55109 15.5 4.75 15.5ZM12.75 15.5H11.75C11.5511 15.5 11.3603 15.421 11.2197 15.2803C11.079 15.1397 11 14.9489 11 14.75V3.75C11 3.55109 11.079 3.36032 11.2197 3.21967C11.3603 3.07902 11.5511 3 11.75 3H12.75C12.9489 3 13.1397 3.07902 13.2803 3.21967C13.421 3.36032 13.5 3.55109 13.5 3.75V14.75C13.5 14.9489 13.421 15.1397 13.2803 15.2803C13.1397 15.421 12.9489 15.5 12.75 15.5ZM8.25 15.5H9.25C9.44891 15.5 9.63968 15.421 9.78033 15.2803C9.92098 15.1397 10 14.9489 10 14.75V7.25C10 7.05109 9.92098 6.86032 9.78033 6.71967C9.63968 6.57902 9.44891 6.5 9.25 6.5H8.25C8.05109 6.5 7.86032 6.57902 7.71967 6.71967C7.57902 6.86032 7.5 7.05109 7.5 7.25V14.75C7.5 14.9489 7.57902 15.1397 7.71967 15.2803C7.86032 15.421 8.05109 15.5 8.25 15.5ZM1.25 15.5H2.25C2.44891 15.5 2.63968 15.421 2.78033 15.2803C2.92098 15.1397 3 14.9489 3 14.75V10.25C3 10.0511 2.92098 9.86032 2.78033 9.71967C2.63968 9.57902 2.44891 9.5 2.25 9.5H1.25C1.05109 9.5 0.860322 9.57902 0.71967 9.71967C0.579018 9.86032 0.5 10.0511 0.5 10.25V14.75C0.5 14.9489 0.579018 15.1397 0.71967 15.2803C0.860322 15.421 1.05109 15.5 1.25 15.5Z"
                                                    fill="white" />
                                            </svg>
                                        </span>
                                        <span class="raiting__number">42</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <label class="selected__all_item">
                            <input type="checkbox" id="center__all_item-js">
                            <span class="text">Выбрать все</span>
                        </label>
                        <a class="raiting__reputation" href="">Что такое Рейтинг Репутации</a>
                    </div>
                    <div class="right">
                        <p>Другие компании</p>
                        <div class="right__overflow">
                            <div class="right__top">
                                <span>Выбраны</span>
                            </div>
                            <div class="right__bottom">
                                <span>Не выбраны</span>
                                <label class="center__selected-label">
                                    <input class="input" type="checkbox" name="company_in_raiting">
                                    <span class="text">ООО “Сармизегетуза”</span>
                                </label>
                                <label class="center__selected-label">
                                    <input class="input" type="checkbox" name="company_in_raiting">
                                    <span class="text">Василиск Секьюрити</span>
                                </label>
                                <label class="center__selected-label">
                                    <input class="input" type="checkbox" name="company_in_raiting">
                                    <span class="text">ООО “Оракул”</span>
                                </label>
                                <label class="center__selected-label">
                                    <input class="input" type="checkbox" name="company_in_raiting">
                                    <span class="text">ООО “Сармизегетуза”</span>
                                </label>
                                <label class="center__selected-label">
                                    <input class="input" type="checkbox" name="company_in_raiting">
                                    <span class="text">Василиск Секьюрити</span>
                                </label>
                                <label class="center__selected-label">
                                    <input class="input" type="checkbox" name="company_in_raiting">
                                    <span class="text">ООО “Оракул”</span>
                                </label>
                                <label class="center__selected-label">
                                    <input class="input" type="checkbox" name="company_in_raiting">
                                    <span class="text">ООО “Оракул”</span>
                                </label>
                                <label class="center__selected-label">
                                    <input class="input" type="checkbox" name="company_in_raiting">
                                    <span class="text">ООО “Оракул”</span>
                                </label>
                                <label class="center__selected-label">
                                    <input class="input" type="checkbox" name="company_in_raiting">
                                    <span class="text">ООО “Оракул”</span>
                                </label>
                            </div>
                        </div>
                        <label class="selected__all_item">
                            <input type="checkbox" id="right__all_item-js">
                            <span class="text">Выбрать все</span>
                        </label>
                        <a class="raiting__reputation" href="">Почему этих компаний нет в Рейтинге</a>
                    </div>
                    <div class="reviews__form-top--submit">
                        <input type="submit" value="смотреть отзывы по выбранным">
                    </div>
                    <span class="close__btn-bottom close-js">Закрыть</span>
                </div>
            </form>
        </div> -->

        <div class="rating-center__search">

            <div class="rating-center__search_item item-one">
                <div class="rating-center__search_item-title">
                    Город
                </div>
                <div class="rating-center__search_form select-city">
                    <button class="rating-center__search_form-btn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 21L11.3254 21.7382L12 22.3546L12.6746 21.7382L12 21ZM12 21C12.6746 21.7382 12.6747 21.7381 12.6749 21.7379L12.6754 21.7374L12.677 21.736L12.6819 21.7315L12.6991 21.7156C12.7139 21.7019 12.7351 21.6822 12.7623 21.6567C12.8168 21.6057 12.8953 21.5314 12.9946 21.4358C13.1929 21.2447 13.4743 20.9681 13.811 20.6215C14.4833 19.9294 15.382 18.9526 16.2834 17.8165C17.1823 16.6834 18.0998 15.372 18.7964 14.0109C19.4871 12.6615 20 11.1878 20 9.75C20 7.6826 19.148 5.70756 17.6439 4.25718C16.141 2.80801 14.1102 2 12 2C9.88977 2 7.85897 2.80801 6.35612 4.25718C4.85203 5.70755 4 7.6826 4 9.75C4 11.1878 4.51291 12.6615 5.20357 14.0109C5.90021 15.372 6.8177 16.6834 7.7166 17.8165C8.61795 18.9526 9.51668 19.9294 10.189 20.6215C10.5257 20.9681 10.8071 21.2447 11.0054 21.4358C11.1047 21.5314 11.1832 21.6057 11.2377 21.6567C11.2649 21.6822 11.2861 21.7019 11.3009 21.7156L11.3181 21.7315L11.323 21.736L11.3246 21.7374L11.3251 21.7379C11.3253 21.7381 11.3254 21.7382 12 21ZM12 12.125C11.3255 12.125 10.6855 11.8663 10.2193 11.4166C9.75422 10.9682 9.5 10.3679 9.5 9.75C9.5 9.13209 9.75422 8.5318 10.2193 8.08336C10.6855 7.63373 11.3255 7.375 12 7.375C12.6745 7.375 13.3145 7.63373 13.7807 8.08336C14.2458 8.5318 14.5 9.13209 14.5 9.75C14.5 10.3679 14.2458 10.9682 13.7807 11.4166C13.3145 11.8663 12.6745 12.125 12 12.125Z"
                                  stroke="#005DFF" stroke-width="2"/>
                        </svg>
                    </button>
                    <div class="rating-center__search_form-input rating-center__search_form-select">
                        <input type="text" data-pre-id="<?= $arResult['CITY_SELECTED']['ID']?>" data-id="<?= $arResult['CITY_SELECTED']['ID']?>" placeholder="<?= $arResult['CITY_SELECTED']['NAME'] ?>">
                    </div>
                    <div class="searchForm__modal">
                        <div class="searchForm__modal_closed">
                            <img src="/upload/rating/closed-icon.svg" alt="img">
                        </div>
                        <div class="searchForm__modal_input">
                            <input type="text" id="filterCity" placeholder="Поиск по названию">
                            <button>
                                <img src="/upload/rating/search-icon.svg" alt="img">
                            </button>
                        </div>
                        <div class="searchForm__modal_wrapper">
                            <div class="searchForm__modal_topChek actived">
                                <div class="searchForm__modal_item bottomChekItem">
                                    <input type="checkbox" class="checkbox">
                                    <span data-id="<?= $arResult['CITY_SELECTED']['ID']?>" class="itemText"><?= $arResult['CITY_SELECTED']['NAME'] ?></span>
                                </div>
                            </div>
                            <div class="searchForm__modal_centerChek">
                            </div>
                            <div class="searchForm__modal_bottomChek">
                                <? foreach ($arResult['CITIES'] as $item): ?>
                                    <div class="searchForm__modal_item bottomChekItem">
                                        <input type="checkbox" class="checkbox">
                                        <span data-id="<?= $item['ID']?>" class="itemText"><?= $item['NAME'] ?></span>
                                    </div>
                                <? endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rating-center__search_item item-two">
                <div class="rating-center__search_item-title">
                    Найдите компании по названию
                </div>
                <div class="rating-center__search_form select-company">
                    <button class="rating-center__search_form-btn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 21L16.7501 16.7425L21 21ZM19.1053 11.0526C19.1053 13.1883 18.2569 15.2365 16.7467 16.7467C15.2365 18.2569 13.1883 19.1053 11.0526 19.1053C8.91694 19.1053 6.86872 18.2569 5.35856 16.7467C3.8484 15.2365 3 13.1883 3 11.0526C3 8.91694 3.8484 6.86872 5.35856 5.35856C6.86872 3.8484 8.91694 3 11.0526 3C13.1883 3 15.2365 3.8484 16.7467 5.35856C18.2569 6.86872 19.1053 8.91694 19.1053 11.0526V11.0526Z"
                                  stroke="#93B6FF" stroke-width="2" stroke-linecap="round"/>
                        </svg>

                    </button>
                    <div class="rating-center__search_form-select">
                        <input type="text" placeholder="Найти компанию">
                    </div>
                    <div class="searchForm__modal">
                        <div class="searchForm__modal_closed">
                            <img src="/upload/rating/closed-icon.svg" alt="img">
                        </div>
                        <div class="searchForm__modal_input">
                            <input type="text" id="filterCity" placeholder="Поиск по названию">
                            <button>
                                <img src="/upload/rating/search-icon.svg" alt="img">
                            </button>
                        </div>
                        <div class="searchForm__modal_wrapper">
                            <div class="searchForm__modal_topChek active">
                            </div>
                            <div class="searchForm__modal_centerChek">
                            </div>
                            <div class="searchForm__modal_bottomChek">
                                <? foreach ($arResult['CITY_COMPANIES'] as $item): ?>
                                    <div class="searchForm__modal_item bottomChekItem">
                                        <input type="checkbox" class="checkbox">
                                        <span data-id="<?= $item['ID'] ?>" class="itemText"><?= $item['NAME'] ?></span>
                                    </div>
                                <? endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?
        $result = 0;
        foreach($arResult["ORDERS"] as $order):
            if($order["PROPERTY_CHOP_ID_VALUE"] == $_GET["chop"] && $order["PROPERTY_CITY_ID_VALUE"] == $_GET["city"]){
                $result = 1;
            }
        endforeach; 
        ?>
        <div class="review__massage <?=$USER->IsAuthorized() && $result ? "" : "bad"?>" data-type="<?=$USER->IsAuthorized() && $result ? "1" : "0"?>">
            <div class="review__massage-icon">
                <picture>
                    <source srcset="/upload/review/massage-good.svg">
                    <img src="/upload/review/massage-good.svg" alt="good">
                </picture>
            </div>
            <div class="review__massage-text">
                <p>Этот отзыв влияет на рейтинг, так как вы авторизовались на платформе <a href="">vincko</a>: и являетесь покупателем услуг данной охранной компании в городе <a href="">Ростов-на-Дону</a> в рамках платформы.</p>
            </div>
        </div>
        <div class="review__top">
            <p>Оставьте отзыв о компании <br> <span><?=$arResult["COMPANY_NAME"]?></span></p>
        </div>
        <? if($arResult["COMPANY_NAME"]): ?>
            <div class="review__mid">
                <div class="review__mid-step-1 step active">
                    <picture class="pic">
                        <source srcset="/upload/review/step-1-active.svg">
                        <img src="/upload/review/step-1-active.svg" alt="good">
                    </picture>
                    <p><span>1</span> Общее впечатление</p>
                </div>
                <div class="review__mid-step-2 step">
                    <picture class="pic">
                        <source srcset="/upload/review/step-2-no-active.svg">
                        <img src="/upload/review/step-2-no-active.svg" alt="good">
                    </picture>
                    <p><span>2</span> Всего 3 вопроса</p>
                    <!-- Временно отключил блок, так как не работает функционал бонусов -->
                    <!-- <picture class="icon">
                        <source srcset="/upload/review/step-2-icon.svg">
                        <img src="/upload/review/step-2-icon.svg" alt="good">
                    </picture>
                    <p class="bonus">500 бонусов</p> -->
                </div>
                <div class="review__mid-step-3 step">
                    <picture class="pic">
                        <source srcset="/upload/review/step-3-no-active.svg">
                        <img src="/upload/review/step-3-no-active.svg" alt="good">
                    </picture>
                    <p><span>3</span> Немного подробнее</p>
                    <!-- Временно отключил блок, так как не работает функционал бонусов -->
                    <!-- <picture class="icon">
                        <source srcset="/upload/review/step-3-icon.svg">
                        <img src="/upload/review/step-3-icon.svg" alt="good">
                    </picture>
                    <p class="bonus">600 бонусов</p> -->
                </div>
            </div>
            <div class="review__mid mobile">
                <div class="review__mid-step-1 step mob active">
                    <picture class="pic">
                        <source srcset="/upload/review/step-1-active.svg">
                        <img src="/upload/review/step-1-active.svg" alt="good">
                    </picture>
                    <p><span>1</span> Общее впечатление</p>
                </div>
                <div class="review__mid-step-2 mob step">
                    <picture class="pic">
                        <source srcset="/upload/review/step-1-active.svg">
                        <img src="/upload/review/step-1-active.svg" alt="good">
                    </picture>
                    <p><span>2</span> Всего 3 вопроса</p>
                    <!-- Временно отключил блок, так как не работает функционал бонусов -->
                    <!-- <picture class="icon">
                        <source srcset="/upload/review/step-2-icon.svg">
                        <img src="/upload/review/step-2-icon.svg" alt="good">
                    </picture>
                    <p class="bonus">500</p> -->
                </div>
                <div class="review__mid-step-3 mob step">
                    <picture class="pic">
                        <source srcset="/upload/review/step-1-active.svg">
                        <img src="/upload/review/step-1-active.svg" alt="good">
                    </picture>
                    <p><span>3</span>По подробнее</p>
                    <!-- Временно отключил блок, так как не работает функционал бонусов -->
                    <!-- <picture class="icon">
                        <source srcset="/upload/review/step-3-icon.svg">
                        <img src="/upload/review/step-3-icon.svg" alt="good">
                    </picture>
                    <p class="bonus">600</p> -->
                </div>
            </div>

            <div class="review__bottom step-1">
                <div class="review__bottom-step-1">
                    <div class="review__bottom-step-1-left">
                        <p><?=$arResult["MAIN_SECTION"]["NAME"]?> <br> от сотрудничества с охранной <br> компанией</p>
                        <div class="input-block">
                            <ul>
                                <li class="smile">
                                    <picture>
                                        <source srcset="/upload/review/smile-1.svg">
                                        <img src="/upload/review/smile-1.svg" alt="good">
                                    </picture> 
                                </li>
                                <li class="smile">
                                    <picture>
                                        <source srcset="/upload/review/smile-2.svg">
                                        <img src="/upload/review/smile-2.svg" alt="good">
                                    </picture> 
                                </li>
                                <li class="smile"> 
                                    <picture>
                                        <source srcset="/upload/review/smile-3.svg">
                                        <img src="/upload/review/smile-3.svg" alt="good">
                                    </picture> 
                                </li>
                                <li class="active smile">
                                    <picture>
                                        <source srcset="/upload/review/smile-4.svg">
                                        <img src="/upload/review/smile-4.svg" alt="good">
                                    </picture> 
                                </li>
                                <li class="smile">
                                    <picture>
                                        <source srcset="/upload/review/smile-5.svg">
                                        <img src="/upload/review/smile-5.svg" alt="good">
                                    </picture> 
                                </li>
                            </ul>
                            <div class="pseudo__range-reivew">
                                <input type="range" id="pseudo__range-review-1" class="smile-input" min="0" max="49999" value="36160">
                            </div>
                        </div>
                        <p class="text-2"><?=$arResult["MAIN_SECTION"]["~UF_TEXT_BEFORE_FIELD"]?></p>
                        <div class="coment-block">
                            <p><?=$arResult["MAIN_SECTION"]["~UF_DESCRIPTION_FOR_REVIEWS"]?></p>
                            <textarea name="step-1-coment" placeholder="Комментарий"></textarea>
                        </div>
                    </div>
                    <div class="review__bottom-step-1-right">
                        <div class="picture">
                            <img src="/upload/review/img-step-1.png">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="review__btn step-1">
                <button class="add-review">Оставить отзыв</button>
                <? if($USER->IsAuthorized()): ?>
                    <button class="next">Продолжить</button>
                    <!-- Временно отключил блок, так как не работает функционал бонусов -->
                    <!-- <div class="bonus-block">
                        <span>и получить</span>
                        <picture>
                            <source srcset="/upload/review/step-2-icon.svg">
                            <img src="/upload/review/step-2-icon.svg" alt="good">
                        </picture> 
                        <span>500</span>
                    </div> -->
                <? endif ?>
            </div>
            <div class="review__bottom step-2">
            <? foreach($arResult["SECTIONS"] as $section): ?>
                <?++$i?>
                <div class="review__bottom-item <?=$i == 1 ? "first" : ""?>">
                    <div class="value-block">
                        <svg height="58" width="58">
                            <circle cx="28.5" cy="28.5" r="24" style="stroke-dashoffset: 29;"/>
                        </svg>
                        <div class="number-wrapper">
                            <span>4</span>
                        </div>
                        <div class="item-name" id="<?=$section["CODE"]?>"><?=$section["NAME"]?></div>
                    </div>
                    <ul>
                        <li class="review-item-step-2">Не могу <br> оценить</li>
                        <li class="review-item-step-2">0</li>
                        <li class="review-item-step-2">1</li>
                        <li class="review-item-step-2">2</li>
                        <li class="review-item-step-2">3</li>
                        <li class="review-item-step-2 active">4</li>
                        <li class="review-item-step-2">5</li>
                    </ul>
                    <div class="pseudo__range-reivew">
                        <input type="range" id="pseudo__range-review-2" class="smile-input" min="0" max="77999" value="63931">
                    </div>
                    <p><?=$section["~UF_DESCRIPTION_FOR_REVIEWS"]?></p>
                    <div class="coment-block">
                        <p><?=$section["~UF_TEXT_BEFORE_FIELD"]?></p>
                        <textarea name="step-2-coment" placeholder="Комментарий"></textarea>
                    </div>
                </div>
            <? endforeach ?>
            </div>
            <div class="review__btn step-2">
                <div class="step-2-massage">
                    <picture>
                        <source srcset="/upload/review/massage-good.svg">
                        <img src="/upload/review/massage-good" alt="good">
                    </picture>
                    <p>Выберите «<span>Не могу оценить</span>» если вы не сталкивались с каким-
                        либо из параметров. Так вы формируете честный рейтинг.
                    </p>
                </div>
                <div class="add-review-block">
                    <button class="add-review">Оставить отзыв</button>
                    <!-- Временно отключил блок, так как не работает функционал бонусов -->
                    <!-- <div class="bonus-block">
                        <picture>
                            <source srcset="/upload/review/step-2-icon.svg">
                            <img src="/upload/review/step-2-icon" alt="good">
                        </picture>
                        <span>500</span>
                    </div> -->
                </div>
                <div class="next-block">
                    <button class="next">Продолжить</button>
                    <!-- Временно отключил блок, так как не работает функционал бонусов -->
                    <!-- <div class="bonus-block">
                        <picture>
                            <source srcset="/upload/review/step-3-icon.svg">
                            <img src="/upload/review/step-2-icon.svg" alt="good">
                        </picture> 
                        <span>еще 600 бонусов</span>
                        <span class="mob">600</span>
                    </div> -->
                </div>
            </div>

            <div class="review__bottom step-3">
                <? foreach($arResult["SECTIONS"] as $section): ?>
                    <?++$k?>
                    <div class="step-3-item <?=$k == 1 ? "active" : ""?><?=$k == 2 ? "next" : ""?><?=$k == 3 ? "pre-next" : ""?>" >
                        <div class="content">
                        <? if($k !== 1): ?>
                            <div class="content">
                        <? endif ?>
                            <div class="content-wrapper">
                                <div class="left">
                                    <div class="number-block">
                                        <div class="number" id="<?=$section["CODE"]?>"><span>?</span></div>
                                        <p class="num-text"><?=$section["NAME"]?> <br> <span>Подробная оценка</span></p>
                                    </div>
                                    <div class="left-text">
                                        <p><?=$section["~UF_DESCRIPTION_FOR_REVIEWS"]?></p>
                                    </div>
                                </div>
                                <div class="right">
                                    <div class="block-q">
                                        <ul class="list-q">
                                            <? foreach($section["ITEMS"] as $item): ?>
                                                <?++$q?>
                                                <li class="q <?=$q == 1 ? "active" : "before"?>">
                                                    <div class="q-left">
                                                        <h5 data-id="<?=$item["ID"]?>"><?=$item["NAME"]?></h5>
                                                    </div>
                                                    <div class="q-right">
                                                        <span>4</span>
                                                    </div>
                                                    <div class="active-block">
                                                        <p><?=$item["~PREVIEW_TEXT"]?></p>
                                                        <ul>
                                                            <li class="review-item-step-3">Не могу <br> оценить</li>
                                                            <li class="review-item-step-3">0</li>
                                                            <li class="review-item-step-3">1</li>
                                                            <li class="review-item-step-3">2</li>
                                                            <li class="review-item-step-3">3</li>
                                                            <li class="review-item-step-3 active">4</li>
                                                            <li class="review-item-step-3">5</li>
                                                        </ul>
                                                        <div class="pseudo__range-reivew">
                                                            <input type="range" id="pseudo__range-review-5" class="smile-input step-3" min="0" max="77999" value="63931">
                                                        </div>
                                                        <div class="block-coment">
                                                            <textarea name="coment"  placeholder="Комментарий"></textarea>
                                                            <div class="next-btn">Далее</div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <? endforeach ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <? if($k !== 1): ?>
                                </div>
                            <? endif ?>
                        </div>
                    </div>
                <? endforeach?>
            </div>
            <div class="review__btn step-3 stop">
                <div class="step-2-massage">
                    <picture>
                        <source srcset="/upload/review/massage-good.svg">
                        <img src="/upload/review/massage-good.svg" alt="good">
                    </picture>
                    <p>Выберите «<span>Не могу оценить</span>» если вы не сталкивались с каким-
                        либо из параметров. Так вы формируете честный рейтинг.
                    </p>
                </div>
                <button class="next-btn-bottom step-1" disabled>Далее</button>
                <div class="stop">
                    <button class="stop-btn">Завершить</button>
                    <!-- Временно отключил блок, так как не работает функционал бонусов -->
                    <!-- <div class="bonus-block">
                        <picture>
                            <source srcset="/upload/review/step-3-icon.svg">
                            <img src="/upload/review/step-3-icon.svg" alt="good">
                        </picture>
                        <span>1 100</span>
                    </div> -->
                </div>
            </div>
        <? else: ?>
            <p>Выберите компанию, которой вы хотите оставить отзыв</p>
        <? endif ?>
    </div>
</main>

<?
// echo '<pre>';
// print_r($arResult);
// echo '</pre>';
?>