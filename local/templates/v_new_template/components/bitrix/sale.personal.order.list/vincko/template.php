<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

$userName = $GLOBALS["USER"]->GetFullName();
?>

<div class="h1">Здравствуйте<?=($userName?", ".$userName :"")?></div>
<div class="profile__content">
    <div class="profile__tabs-choice">
        <a class="profile__tabs-chitem checked">
            Заказы и заявки
        </a>

        <a href="#" class="profile__tabs-chitem">
            Мои данные
        </a>

    </div>

    <div class="profile__tabs-content">
        <div class="profile__tabs-citem">
            <div class="profile__c-head">
                <div class="profile__c-head-wrapper">
                    <div class="profile__c-tabs">
                        <input checked id="c-all-orders" type="radio" name="profile__c-tabs">
                        <label for="c-all-orders">Все заказы</label>

                        <input id="c-p-requests" type="radio" name="profile__c-tabs">
                        <label for="c-p-requests">Индивидуальные заявки</label>

                    </div>

                    <a class="blue underline" target="_blank" href="/zayavka/">Создать заявку</a>
                </div>
            </div>

            <div class="profile__c-main profile__c-main--all-orders show">

                <div class="profile__active-subs profile__c-main-block">
                    <div class="profile__active-subs-title">
                        Активные гарантии и подписки
                    </div>

                    <div class="sb-item blue">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.20571 17.0405C3.22859 17.179 3.32773 17.2898 3.45756 17.322C3.58757 17.3541 3.72335 17.3017 3.80259 17.1886L4.51683 16.1688C5.92578 17.2035 7.60368 17.7554 9.32195 17.75C13.9693 17.75 17.75 13.7727 17.75 8.88397C17.7522 7.71134 17.5316 6.55007 17.1014 5.46823C17.0562 5.35162 16.9548 5.26924 16.8362 5.253C16.7173 5.23657 16.5992 5.28842 16.527 5.38879C16.4547 5.48937 16.4391 5.62301 16.4863 5.73884C16.8825 6.73497 17.0854 7.80428 17.0834 8.88397C17.0834 13.386 13.6016 17.0487 9.32195 17.0487C7.74616 17.0538 6.20682 16.5496 4.91245 15.6039L5.78548 14.4542C5.86471 14.3411 5.87197 14.1892 5.80426 14.0681C5.73656 13.9472 5.60654 13.8805 5.4743 13.8985H3.04055C2.95052 13.9108 2.86905 13.9613 2.81511 14.0382C2.76117 14.1151 2.73941 14.2119 2.75485 14.3062L3.20571 17.0405Z"
                                  fill="#005DFF" stroke="#005DFF" stroke-width="0.4"/>
                            <path d="M8.67815 0.951298C10.254 0.94621 11.7933 1.45043 13.0877 2.39607L12.2181 3.32781C12.1435 3.43445 12.1324 3.57591 12.1889 3.6939C12.2457 3.81208 12.3606 3.88643 12.4863 3.88643C12.5007 3.88643 12.515 3.88545 12.5293 3.88349L14.9594 4.10146C15.0495 4.08914 15.1309 4.03866 15.1849 3.96176C15.2388 3.88486 15.2606 3.78801 15.2451 3.6939L14.7947 0.959515C14.772 0.820986 14.6728 0.710241 14.5428 0.678153C14.4128 0.645868 14.2772 0.698306 14.198 0.811399L13.4837 1.83119C12.0746 0.796529 10.3964 0.244369 8.67815 0.250043C4.0307 0.250043 0.250014 4.22727 0.250014 9.1159C0.247968 10.2885 0.468381 11.4498 0.898604 12.5316C0.943803 12.6482 1.04517 12.7306 1.16384 12.747C1.2827 12.7634 1.40081 12.7114 1.47317 12.611C1.54552 12.5104 1.56096 12.3768 1.51371 12.261C1.11771 11.2649 0.9146 10.1958 0.916646 9.1159C0.916646 4.6139 4.39842 0.951298 8.67815 0.951298Z"
                                  fill="#005DFF" stroke="#005DFF" stroke-width="0.4"/>
                            <path d="M9.70921 9.7998H7.74558V10.8741H10.5819V11.537H7.74558V12.9998H6.98194V11.537H6.00012V10.8741H6.98194V9.7998H6.00012V9.04551H6.98194V4.99976H9.70921C10.3419 4.99976 10.8801 5.23595 11.3238 5.70833C11.7747 6.1731 12.0001 6.73691 12.0001 7.39978C12.0001 8.05502 11.7747 8.61884 11.3238 9.09122C10.8801 9.56361 10.3419 9.7998 9.70921 9.7998ZM7.74558 5.75405V9.04551H9.70921C10.131 9.04551 10.491 8.8855 10.7892 8.5655C11.0874 8.23788 11.2365 7.8493 11.2365 7.39978C11.2365 6.94263 11.0874 6.55406 10.7892 6.23405C10.491 5.91405 10.131 5.75405 9.70921 5.75405H7.74558Z"
                                  fill="#005DFF"/>
                        </svg>
                        Безопасная сделка
                    </div>

                    <div class="sb-item green">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 1.66663C5.40002 1.66663 1.66669 5.39996 1.66669 9.99996C1.66669 14.6 5.40002 18.3333 10 18.3333C14.6 18.3333 18.3334 14.6 18.3334 9.99996C18.3334 5.39996 14.6 1.66663 10 1.66663ZM10.7584 15.125C10.7001 15.1821 10.6264 15.2208 10.5463 15.2364C10.4663 15.252 10.3834 15.2438 10.308 15.2127C10.2326 15.1817 10.1679 15.1292 10.1221 15.0617C10.0762 14.9943 10.0512 14.9148 10.05 14.8333V14.1666H10C8.93335 14.1666 7.86669 13.7583 7.05002 12.95C6.48421 12.3828 6.09373 11.6646 5.92526 10.8814C5.75679 10.0981 5.81746 9.28296 6.10002 8.53329C6.25835 8.10829 6.81669 7.99996 7.13335 8.32496C7.31669 8.50829 7.35835 8.77496 7.27502 9.00829C6.89169 10.0416 7.10835 11.2416 7.94169 12.075C8.52502 12.6583 9.29169 12.9333 10.0584 12.9166V12.1333C10.0584 11.7583 10.5084 11.575 10.7667 11.8416L12.1167 13.1916C12.2834 13.3583 12.2834 13.6166 12.1167 13.7833L10.7584 15.125ZM12.8667 11.6833C12.7805 11.5946 12.7215 11.4833 12.6964 11.3623C12.6713 11.2412 12.6812 11.1155 12.725 11C13.1084 9.96663 12.8917 8.76663 12.0584 7.93329C11.475 7.34996 10.7084 7.06663 9.95002 7.08329V7.86663C9.95002 8.24163 9.50002 8.42496 9.24169 8.15829L7.88335 6.81663C7.71669 6.64996 7.71669 6.39163 7.88335 6.22496L9.23335 4.87496C9.29159 4.81786 9.36531 4.77911 9.44536 4.76351C9.52542 4.7479 9.60829 4.75614 9.68371 4.7872C9.75912 4.81825 9.82377 4.87076 9.86963 4.9382C9.91549 5.00565 9.94054 5.08507 9.94169 5.16663V5.84163C11.025 5.82496 12.1167 6.21663 12.9417 7.04996C13.5075 7.61715 13.898 8.33529 14.0665 9.11853C14.2349 9.90177 14.1742 10.717 13.8917 11.4666C13.7334 11.9 13.1834 12.0083 12.8667 11.6833Z"
                                  fill="#3CBA54"/>
                        </svg>
                        Подписка “Замена оборудования”
                    </div>

                </div>
                <? if (!empty($arResult["ORDERS"])): ?>
                    <? foreach ($arResult["ORDERS"] as $arOrder): ?>
                        <div class="profile__c-main-block profile__c-main-order <?= ($arOrder["PAY"]["STATUS_ID"] == 1 ? "profile__c-main-order--paid" : "profile__c-main-order--not-paid") ?>">
                            <div class="profile__c-main-order-head">
                                <div class="profile__c-main-order-title">
                                    <?= Loc::getMessage("SPOL_TPL_ORDER") ?>
                                    <?= Loc::getMessage("SPOL_TPL_NUMBER_SIGN") . $arOrder["ACCOUNT_NUMBER"] ?>
                                    <?= Loc::getMessage("SPOL_TPL_FROM_DATE") ?>
                                    <?= $arOrder["DATE_INSERT_FORMATED"] ?>
                                </div>

                                <div class="profile__c-main-order-status">
                                    <? if ($arOrder["CANCELED"] !== "Y"): ?>
                                        <?= $arOrder["STATUS"] ?>
                                    <? else : ?>
                                        <?= Loc::getMessage('SPOD_ORDER_CANCELED') ?>
                                    <? endif; ?>
                                </div>

                                <div class="profile__c-main-order-dates">
                                    <? /*<div class="profile__c-main-order-date">
                                    Дата получения: <span class="profile__c-main-order-date-value">28 марта 2021</span>
                                </div>*/ ?>
                                    <? if (!empty($arOrder["PROPS"]["MONTAZHTIME"])): ?>
                                        <div class="profile__c-main-order-date">
                                            Планируемая дата монтажа:
                                            <span class="profile__c-main-order-date-value"> <?= $arOrder["PROPS"]["MONTAZHTIME"] ?></span>
                                        </div>
                                    <? endif; ?>
                                </div>


                            </div>
                            <div class="profile__c-main-order-price">
                                <div class="profile__c-main-order-price-value">
                                    <?= $arOrder["PAY"]["FORMATED_SUM"] ?>
                                </div>
                                <div class="profile__c-main-order-price-type">
                                    <?= $arOrder["PAY"]["NAME"] ?>
                                </div>
                                <div class="profile__c-main-order-price-status">
                                    <div class="<?= ($arOrder["PAY"]["STATUS_ID"] == 1 ? "profile__c-main-order-price-status-paid" : "profile__c-main-order-price-status-not-paid") ?>">
                                        <?= $arOrder["PAY"]["STATUS"] ?>
                                    </div>

                                </div>
                            </div>

                            <div class="profile__c-main-order-main">
                                <div class="profile__c-main-order-main-name">
                                    <?= $arOrder["SOLUTION"]["NAME"] ?>
                                </div>

                                <div class="profile__c-main-order-main-firms">
                                    <? foreach ($arOrder["PRODUCT"] as $arProduct): ?>
                                        <div class="profile__c-main-order-main-firm">
                                            <div class="profile__c-main-order-main-firm-name">
                                                <?= $arProduct["NAME"] ?>
                                            </div>
                                            <? /*<a href="<?= $arProduct["URL"] ?>"
                                               class="profile__c-main-order-main-firm-more underline">Подробнее</a>*/ ?>
                                        </div>
                                    <? endforeach; ?>
                                </div>

                                <div class="profile__c-main-order-main-infos">
                                    <? foreach ($arOrder["PRODUCT"] as $arProduct): ?>
                                    <? if (!empty($arProduct["COMPANY"]["HONEST"]) || !empty($arProduct["COMPANY"]["CONTRACT"])) : ?>
                                        <div class="profile__c-main-order-main-info">

                                            <div class="products__info products__info--center">
                                                <div class="products__info-sign">
                                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M7 0C5.61553 0 4.26215 0.410543 3.11101 1.17971C1.95987 1.94888 1.06266 3.04213 0.532846 4.32121C0.00303299 5.6003 -0.13559 7.00776 0.134506 8.36563C0.404603 9.7235 1.07129 10.9708 2.05026 11.9497C3.02922 12.9287 4.2765 13.5954 5.63437 13.8655C6.99224 14.1356 8.3997 13.997 9.67879 13.4672C10.9579 12.9373 12.0511 12.0401 12.8203 10.889C13.5895 9.73784 14 8.38447 14 7C14 6.08074 13.8189 5.17049 13.4672 4.32121C13.1154 3.47194 12.5998 2.70026 11.9497 2.05025C11.2997 1.40024 10.5281 0.884626 9.67879 0.532843C8.82951 0.18106 7.91925 0 7 0ZM7 11.2C6.86155 11.2 6.72622 11.1589 6.6111 11.082C6.49599 11.0051 6.40627 10.8958 6.35329 10.7679C6.3003 10.64 6.28644 10.4992 6.31345 10.3634C6.34046 10.2276 6.40713 10.1029 6.50503 10.005C6.60292 9.90712 6.72765 9.84046 6.86344 9.81345C6.99923 9.78644 7.13997 9.8003 7.26788 9.85328C7.39579 9.90626 7.50511 9.99598 7.58203 10.1111C7.65895 10.2262 7.7 10.3615 7.7 10.5C7.7 10.6856 7.62625 10.8637 7.49498 10.995C7.3637 11.1262 7.18565 11.2 7 11.2ZM7.7 7.588V8.4C7.7 8.58565 7.62625 8.7637 7.49498 8.89497C7.3637 9.02625 7.18565 9.1 7 9.1C6.81435 9.1 6.6363 9.02625 6.50503 8.89497C6.37375 8.7637 6.3 8.58565 6.3 8.4V7C6.3 6.81435 6.37375 6.6363 6.50503 6.50502C6.6363 6.37375 6.81435 6.3 7 6.3C7.20767 6.3 7.41068 6.23842 7.58335 6.12304C7.75602 6.00767 7.8906 5.84368 7.97008 5.65182C8.04955 5.45995 8.07034 5.24883 8.02983 5.04515C7.98931 4.84147 7.88931 4.65438 7.74246 4.50754C7.59562 4.36069 7.40853 4.26069 7.20485 4.22017C7.00117 4.17966 6.79005 4.20045 6.59818 4.27992C6.40632 4.3594 6.24233 4.49398 6.12696 4.66665C6.01158 4.83932 5.95 5.04233 5.95 5.25C5.95 5.43565 5.87625 5.6137 5.74498 5.74497C5.6137 5.87625 5.43565 5.95 5.25 5.95C5.06435 5.95 4.8863 5.87625 4.75503 5.74497C4.62375 5.6137 4.55 5.43565 4.55 5.25C4.54817 4.79521 4.67296 4.34889 4.91041 3.961C5.14785 3.57311 5.48858 3.25897 5.89443 3.05375C6.30029 2.84853 6.75526 2.76033 7.2084 2.79901C7.66155 2.8377 8.09498 3.00176 8.46017 3.27281C8.82536 3.54387 9.1079 3.91122 9.27615 4.33375C9.44441 4.75627 9.49173 5.21729 9.41283 5.66518C9.33393 6.11308 9.13191 6.53017 8.8294 6.86977C8.5269 7.20936 8.13583 7.45805 7.7 7.588Z"
                                                              fill="#818181"></path>
                                                    </svg>

                                                </div>
                                                <div class="products__text-container products__text-container--snd">
                                                    <div class="products__info-text">
                                                        <div class="itemRating-open__popup-title">
                                                            <span class="blue">Договор</span> с охранной компанией
                                                        </div>
                                                        <div class="itemRating-open__popup-content">
                                                            <ul>
                                                                <? if (!empty($arProduct["COMPANY"]["HONEST"])): ?>
                                                                    <li>
                                                                        Честный договор составлен и рекомендован vincko:
                                                                        договор
                                                                        сформулирован таким образом, чтобы максимально
                                                                        защитить
                                                                        права и
                                                                        интересы клиентов, заказывающих услуги охранных
                                                                        компаний
                                                                        на
                                                                        платформе vincko:

                                                                        <div class="grey">
                                                                            <div class="blue underline">vincko: Честный
                                                                                договор
                                                                            </div>
                                                                            - доступен при покупке услуг данной компании
                                                                            <br>
                                                                            <div class="underline">vincko: Честный
                                                                                договор
                                                                            </div>
                                                                            -
                                                                            <div class="red">не</div>
                                                                            доступен при покупке услуг данной компании
                                                                        </div>

                                                                    </li>
                                                                <? endif; ?>
                                                                <? if (!empty($arProduct["COMPANY"]["CONTRACT"])) : ?>
                                                                    <li>
                                                                        Договор охранной компании: предоставляется
                                                                        индивидуально
                                                                        самой
                                                                        компанией, всю ответственность за условия такого
                                                                        договора
                                                                        несет
                                                                        данная охранная компания.
                                                                    </li>
                                                                <? endif; ?>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="profile__c-main-order-main-info-content">
                                                Договор на 3 месяца
                                                <? if (!empty($arProduct["COMPANY"]["HONEST"])) : ?>
                                                    <a class="blue underline"
                                                       href="<?= $arProduct["COMPANY"]["HONEST"] ?>">vincko: Честный
                                                        договор</a>
                                                <? endif; ?>
                                                <? if (!empty($arProduct["COMPANY"]["CONTRACT"])) : ?>
                                                    <a class="blue underline"
                                                       href="<?= $arProduct["COMPANY"]["CONTRACT"] ?>">Договор охранной
                                                        компании</a>
                                                <? endif; ?>
                                            </div>

                                        </div>
                                    <? elseif (!empty($arProduct["POLICY"]["PAYMENT_OPTIONS"])): ?>
                                        <div class="profile__c-main-order-main-info">
                                            <div class="products__info products__info--center">
                                                <div class="products__info-sign">
                                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M7 0C5.61553 0 4.26215 0.410543 3.11101 1.17971C1.95987 1.94888 1.06266 3.04213 0.532846 4.32121C0.00303299 5.6003 -0.13559 7.00776 0.134506 8.36563C0.404603 9.7235 1.07129 10.9708 2.05026 11.9497C3.02922 12.9287 4.2765 13.5954 5.63437 13.8655C6.99224 14.1356 8.3997 13.997 9.67879 13.4672C10.9579 12.9373 12.0511 12.0401 12.8203 10.889C13.5895 9.73784 14 8.38447 14 7C14 6.08074 13.8189 5.17049 13.4672 4.32121C13.1154 3.47194 12.5998 2.70026 11.9497 2.05025C11.2997 1.40024 10.5281 0.884626 9.67879 0.532843C8.82951 0.18106 7.91925 0 7 0ZM7 11.2C6.86155 11.2 6.72622 11.1589 6.6111 11.082C6.49599 11.0051 6.40627 10.8958 6.35329 10.7679C6.3003 10.64 6.28644 10.4992 6.31345 10.3634C6.34046 10.2276 6.40713 10.1029 6.50503 10.005C6.60292 9.90712 6.72765 9.84046 6.86344 9.81345C6.99923 9.78644 7.13997 9.8003 7.26788 9.85328C7.39579 9.90626 7.50511 9.99598 7.58203 10.1111C7.65895 10.2262 7.7 10.3615 7.7 10.5C7.7 10.6856 7.62625 10.8637 7.49498 10.995C7.3637 11.1262 7.18565 11.2 7 11.2ZM7.7 7.588V8.4C7.7 8.58565 7.62625 8.7637 7.49498 8.89497C7.3637 9.02625 7.18565 9.1 7 9.1C6.81435 9.1 6.6363 9.02625 6.50503 8.89497C6.37375 8.7637 6.3 8.58565 6.3 8.4V7C6.3 6.81435 6.37375 6.6363 6.50503 6.50502C6.6363 6.37375 6.81435 6.3 7 6.3C7.20767 6.3 7.41068 6.23842 7.58335 6.12304C7.75602 6.00767 7.8906 5.84368 7.97008 5.65182C8.04955 5.45995 8.07034 5.24883 8.02983 5.04515C7.98931 4.84147 7.88931 4.65438 7.74246 4.50754C7.59562 4.36069 7.40853 4.26069 7.20485 4.22017C7.00117 4.17966 6.79005 4.20045 6.59818 4.27992C6.40632 4.3594 6.24233 4.49398 6.12696 4.66665C6.01158 4.83932 5.95 5.04233 5.95 5.25C5.95 5.43565 5.87625 5.6137 5.74498 5.74497C5.6137 5.87625 5.43565 5.95 5.25 5.95C5.06435 5.95 4.8863 5.87625 4.75503 5.74497C4.62375 5.6137 4.55 5.43565 4.55 5.25C4.54817 4.79521 4.67296 4.34889 4.91041 3.961C5.14785 3.57311 5.48858 3.25897 5.89443 3.05375C6.30029 2.84853 6.75526 2.76033 7.2084 2.79901C7.66155 2.8377 8.09498 3.00176 8.46017 3.27281C8.82536 3.54387 9.1079 3.91122 9.27615 4.33375C9.44441 4.75627 9.49173 5.21729 9.41283 5.66518C9.33393 6.11308 9.13191 6.53017 8.8294 6.86977C8.5269 7.20936 8.13583 7.45805 7.7 7.588Z"
                                                              fill="#818181"></path>
                                                    </svg>

                                                </div>

                                                <div class="products__text-container products__text-container--snd">
                                                    <div class="products__info-text">
                                                        <div class="itemRating-open__popup-title">
                                                            <span class="blue">Выплаты</span> по пунктам
                                                        </div>
                                                        <div class="itemRating-open__popup-content">
                                                            <ul>
                                                                <? foreach ($arProduct["POLICY"]["PAYMENT_OPTIONS"] as $arPay): ?>
                                                                    <li<?= ($arPay["PRICE"] > 0 ? "" : " class='grey'") ?>>
                                                                        <?= $arPay["NAME"] ?> <br>
                                                                        <? if ($arPay["PRICE"] > 0): ?>
                                                                            <span class="blue"><?= CurrencyFormat($arPay["PRICE"], 'RUB') ?></span>
                                                                        <? else: ?>
                                                                            нет выплаты
                                                                        <? endif; ?>
                                                                    </li>
                                                                <? endforeach; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <? if ($arProduct["POLICY"]["MAX_PRICE"]): ?>
                                                <div class="profile__c-main-order-main-info-content">
                                                    Выплата до <?= $arProduct["POLICY"]["MAX_PRICE"] ?>
                                                </div>
                                            <? endif; ?>
                                        </div>
                                        <? else :?>
                                            <div class="profile__c-main-order-main-info"><br /></div>
                                    <? endif; ?>
                                    <? endforeach; ?>
                                </div>
                                <? if (!empty($arOrder["USER"])): ?>
                                    <div class="profile__c-main-order-main-getter">
                                        <p class="grey cmom-title">Получатель</p>
                                        <? if ($arOrder["USER"]["FIO"]): ?>
                                            <p class="grey"><? $arOrder["USER"]["FIO"] ?>></p>
                                        <? endif; ?>
                                        <? if ($arOrder["USER"]["PHONE"]): ?>
                                            <p class="grey"><?= $arOrder["USER"]["PHONE"] ?></p>
                                        <? endif; ?>
                                    </div>
                                <? endif; ?>
                                <? if (!empty($arOrder["DELIVERY"])): ?>
                                    <div class="profile__c-main-order-main-setter">
                                        <p class="grey cmom-title">Адрес доставки</p>
                                        <p class="grey"><?= $arOrder["DELIVERY"] ?></p>
                                        <p class="grey"><?= $arOrder["COMMENT"] ?></p>
                                    </div>
                                <? endif; ?>
                            </div>

                            <div class="profile__c-main-order-bottom">
                                <div class="profile__c-main-order-bottom-wrapper">
                                    <? if (!empty($arOrder["INSURANCE"]["POLICY"])): ?>
                                        <a class="profile__c-main-order-bottom-paid">
                                            <?= $arOrder["INSURANCE"]["POLICY"] ?>
                                        </a>
                                    <? endif; ?>
                                    <? if ($arOrder["PAY"]["STATUS_ID"] != 1): ?>
                                        <a href="/order/?ORDER_ID=<?= $arOrder["ACCOUNT_NUMBER"] ?>" target="_blank"
                                           class="profile__c-main-order-bottom-download">
                                            Оплатить
                                        </a>
                                    <? endif; ?>

                                </div>
                                <? if ($arOrder["PAY"]["STATUS_ID"] != 1): ?>
                                    <div class="profile__c-main-order-bottom-text">
                                        Оплатите, чтобы скачать полис
                                    </div>
                                <? endif; ?>
                            </div>
                        </div>
                    <? endforeach; ?>
                <? else : ?>
                    <div class="empty empty--order">
                        <picture>
                            <img src="/local/templates/v_new_template/img/profile/empty-man.png" alt="">
                        </picture>

                        <div class="empty-title">Заказов нет</div>
                        <div class="empty-text">Пока что вы не сделали заказ на платформе vincko:
                            Пора почувствовать себя в безопасности со страховым полисом или готовым решением, созданным
                            для
                            вас
                        </div>
                        <div class="empty-btns">
                            <a href="/strahovanie/" target="_blank" class="grey-border-button">
                                Выбрать страховой полис
                            </a>

                            <a href="/packages/" target="_blank" class="grey-border-button">
                                Выбрать готовое решение
                            </a>
                        </div>

                        <? /*<a href="" class="empty-error grey underline">Сообщить об ошибке</a>*/ ?>

                    </div>
                <? endif; ?>
            </div>
            <div class="profile__c-main profile__c-main--personal-requests">

                <div class="empty empty--requests">
                    <picture>
                        <img src="/local/templates/v_new_template/img/profile/empty-man.png" alt="">
                    </picture>

                    <div class="empty-title">Индивидуальных заявок нет</div>
                    <div class="empty-text">Вы пока не создали ни одной индивидуальной заявки
                        Создайте заявку для решения своей задачи или подберите готовое решение, созданное для вас
                    </div>
                    <div class="empty-btns">
                        <a href="/zayavka/" target="_blank" class="grey-border-button">
                            Создать заявку
                        </a>

                        <a href="/packages/" target="_blank" class="grey-border-button">
                            Выбрать готовое решение
                        </a>
                    </div>

                    <? /*<a href="#" class="empty-error grey underline">Сообщить об ошибке</a>*/ ?>

                </div>
            </div>
        </div>
    </div>
</div>
