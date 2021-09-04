<div class="container company-info-card">
    <div class="company-info-card__page">
        <div class="company-info-card__page-column">
            <div class="company-info-card__page-title">
                <div class="company-info-card__page-sub-title">
                    Карточка сведений о компании в городе

                    <select name="cities" id="norating-cities"
                            onchange="window.location.href = this.options[this.selectedIndex].value">
                        <? foreach ($arResult['CITIES'] as $city): ?>
                            <option value="?COMPANY=<?= $city['CITY_COMPANY_ID'] ?>"<?= $_GET['COMPANY'] == $city['CITY_COMPANY_ID'] ? ' selected' : '' ?>><?= $city['CITY_NAME'] ?></option>
                        <? endforeach; ?>
                    </select>


                </div>
                <div class="btn-wrapper">
                    <button onclick="location.href='/reviews/?COMPANY=<?= $arResult['ABOUT_COMPANY']['CURRENT_COMPANY'] ?>'">
                        Отзывы
                    </button>
                    <button onclick="location.href='/raiting/?COMPANY=<?= $arResult['ABOUT_COMPANY']['CURRENT_COMPANY'] ?>'">
                        В рейтинге
                    </button>
                </div>
            </div>
            <div class="rating-center">
                <div class="rating-center__items">
                    <div class="rating-center__items-wrapper">
                        <div class="rating-center__item-wrapper item-rating-active">
                            <div class="itemRating-open show">
                                <div class="itemRating-open__left">
                                    <div class="itemRating-open__left_top">
                                        <div class="itemRating-open__left_num">
                                            <span class="num"><?= $arResult['POSITION'] ?></span>
                                            <span>в Рейтинге</span>
                                        </div>
                                        <div class="itemRating-open__left_endorsements<? if ($arResult['STATUS_COMPANY']['ID'] == 1497): echo ' t-c-green'; elseif ($arResult['STATUS_COMPANY']['ID'] == 1498): echo ' t-c-yellow-d'; else: echo ' t-c-gray'; endif; ?>">
                                            <img style="width: 24px" src="<?= $arResult['STATUS_COMPANY']['PICTURE'] ?>"
                                                 alt="<?= $arResult['STATUS_COMPANY']['NAME'] ?>">
                                            <span><?= $arResult['STATUS_COMPANY']['NAME'] ?></span>
                                        </div>
                                        <? if ($arResult['PROPERTIES']['SAFE_DEAL']['VALUE_XML_ID'] == '01a8c33537514f60a4b14ec8bd8badbe'): ?>
                                            <div class="itemRating-open__left_deal">
                                                <img src="/upload/rating/deal-icon.svg" alt="img">
                                                <span>Безопасная сделка</span>
                                            </div>
                                        <? endif; ?>
                                    </div>
                                    <div class="itemRating-open__left_name">
                                        <?= $arResult['CHOP_DETAIL']['COMPANY_NAME'] ?>
                                    </div>
                                    <div class="itemRating-open__left_info">
                                        <div class="info-block-one">
                                                <div class="info-block-one__left">
                                                    <span><?= str_replace('.', ',', sprintf("%01.1f", $arResult['PROPERTIES']['CH_RATING_SUM']['VALUE'])) ?></span>
                                                    <svg height="60" width="60">
                                                        <circle cx="30.5" cy="24.5" r="24"
                                                                style="stroke-dashoffset: 39;"/>
                                                    </svg>
                                                    <div class="info-block-one__left_icon">
                                                        <img src="/upload/rating/info-block-one__left_icon.svg" alt="img">
                                                    </div>
                                                </div>
                                                <div class="info-block-one__right">
                                                    <div class="info-block-one__right_row">
                                                        <div class="products__info">
                                                            <div class="products__info-sign">
                                                                <svg width="14" height="14" viewBox="0 0 14 14"
                                                                     fill="none"
                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M7 0C5.61553 0 4.26215 0.410543 3.11101 1.17971C1.95987 1.94888 1.06266 3.04213 0.532846 4.32121C0.00303299 5.6003 -0.13559 7.00776 0.134506 8.36563C0.404603 9.7235 1.07129 10.9708 2.05026 11.9497C3.02922 12.9287 4.2765 13.5954 5.63437 13.8655C6.99224 14.1356 8.3997 13.997 9.67879 13.4672C10.9579 12.9373 12.0511 12.0401 12.8203 10.889C13.5895 9.73784 14 8.38447 14 7C14 6.08074 13.8189 5.17049 13.4672 4.32121C13.1154 3.47194 12.5998 2.70026 11.9497 2.05025C11.2997 1.40024 10.5281 0.884626 9.67879 0.532843C8.82951 0.18106 7.91925 0 7 0ZM7 11.2C6.86155 11.2 6.72622 11.1589 6.6111 11.082C6.49599 11.0051 6.40627 10.8958 6.35329 10.7679C6.3003 10.64 6.28644 10.4992 6.31345 10.3634C6.34046 10.2276 6.40713 10.1029 6.50503 10.005C6.60292 9.90712 6.72765 9.84046 6.86344 9.81345C6.99923 9.78644 7.13997 9.8003 7.26788 9.85328C7.39579 9.90626 7.50511 9.99598 7.58203 10.1111C7.65895 10.2262 7.7 10.3615 7.7 10.5C7.7 10.6856 7.62625 10.8637 7.49498 10.995C7.3637 11.1262 7.18565 11.2 7 11.2ZM7.7 7.588V8.4C7.7 8.58565 7.62625 8.7637 7.49498 8.89497C7.3637 9.02625 7.18565 9.1 7 9.1C6.81435 9.1 6.6363 9.02625 6.50503 8.89497C6.37375 8.7637 6.3 8.58565 6.3 8.4V7C6.3 6.81435 6.37375 6.6363 6.50503 6.50502C6.6363 6.37375 6.81435 6.3 7 6.3C7.20767 6.3 7.41068 6.23842 7.58335 6.12304C7.75602 6.00767 7.8906 5.84368 7.97008 5.65182C8.04955 5.45995 8.07034 5.24883 8.02983 5.04515C7.98931 4.84147 7.88931 4.65438 7.74246 4.50754C7.59562 4.36069 7.40853 4.26069 7.20485 4.22017C7.00117 4.17966 6.79005 4.20045 6.59818 4.27992C6.40632 4.3594 6.24233 4.49398 6.12696 4.66665C6.01158 4.83932 5.95 5.04233 5.95 5.25C5.95 5.43565 5.87625 5.6137 5.74498 5.74497C5.6137 5.87625 5.43565 5.95 5.25 5.95C5.06435 5.95 4.8863 5.87625 4.75503 5.74497C4.62375 5.6137 4.55 5.43565 4.55 5.25C4.54817 4.79521 4.67296 4.34889 4.91041 3.961C5.14785 3.57311 5.48858 3.25897 5.89443 3.05375C6.30029 2.84853 6.75526 2.76033 7.2084 2.79901C7.66155 2.8377 8.09498 3.00176 8.46017 3.27281C8.82536 3.54387 9.1079 3.91122 9.27615 4.33375C9.44441 4.75627 9.49173 5.21729 9.41283 5.66518C9.33393 6.11308 9.13191 6.53017 8.8294 6.86977C8.5269 7.20936 8.13583 7.45805 7.7 7.588Z"
                                                                          fill="#818181"></path>
                                                                </svg>

                                                            </div>
                                                            <div class="products__text-container">

                                                                <div class="products__info-text">
                                                                    <div class="itemRating-open__popup-title">
                                                                        Оценки <span
                                                                                class="blue">Репутационного рейтинга</span>
                                                                    </div>
                                                                    <div class="itemRating-open__popup-content">
                                                                        <p>
                                                                            образуется на основании отзывов клиентов
                                                                            охранных компаний, которые оценивают свой
                                                                            опыт
                                                                            взаимодействия с ними по трем критериямм:
                                                                        <ul class="short-list">
                                                                            <li>
                                                                                Клиентоориентированность
                                                                            </li>

                                                                            <li>
                                                                                Безопасность

                                                                            </li>

                                                                            <li>
                                                                                Комфорт
                                                                            </li>
                                                                        </ul>
                                                                        <a href="" class="blue underline">
                                                                            Как формируется Рейтинг
                                                                        </a>
                                                                        </p>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        Оценка по критериям <a class="vl1" href="#"> vincko:</a>
                                                    </div>
                                                    <div class="info-block-one__right_row">
                                                        <img src="/upload/rating/info-block-one__left_right-row_icon1.svg"
                                                             alt="img">
                                                        <span><?= str_replace('.', ',', sprintf("%01.1f", $arResult['PROPERTIES']['CH_RATING_SPASENIE']['VALUE'])) ?></span>
                                                        Клиентоориентированность
                                                    </div>
                                                    <div class="info-block-one__right_row">
                                                        <img src="/upload/rating/info-block-one__left_right-row_icon2.svg"
                                                             alt="img">
                                                        <span><?= str_replace('.', ',', sprintf("%01.1f", $arResult['PROPERTIES']['CH_RATING_ZABOTA']['VALUE'])) ?></span>
                                                        Безопасность
                                                    </div>
                                                    <div class="info-block-one__right_row">
                                                        <img src="/upload/rating/info-block-one__left_right-row_icon3.svg"
                                                             alt="img">
                                                        <span><?= str_replace('.', ',', sprintf("%01.1f", $arResult['PROPERTIES']['CH_RATING_FINANCE']['VALUE'])) ?></span>
                                                        Комфорт
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="info-block-two">
                                            <? if ($arResult['STATUS_COMPANY']['ID'] == 1497): ?>
                                                <div class="info-block-two__contract">
                                                    <div class="products__info">
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
                                                                    <span class="blue">Договор</span> с охранной
                                                                    компанией
                                                                </div>
                                                                <div class="itemRating-open__popup-content">
                                                                    <ul>
                                                                        <li>
                                                                            Честный договор составлен и рекомендован
                                                                            vincko: договор сформулирован таким образом,
                                                                            чтобы максимально защитить права и интересы
                                                                            клиентов, заказывающих услуги охранных
                                                                            компаний на платформе vincko:

                                                                            <div class="grey">
                                                                                <div class="blue underline">vincko:
                                                                                    Честный договор
                                                                                </div>
                                                                                - доступен при покупке услуг данной
                                                                                компании
                                                                                <br>
                                                                                <div class="underline">vincko: Честный
                                                                                    договор
                                                                                </div>
                                                                                -
                                                                                <div class="red">не</div>
                                                                                доступен при покупке услуг данной
                                                                                компании
                                                                            </div>

                                                                        </li>
                                                                        <li>
                                                                            Договор охранной компании: предоставляется
                                                                            индивидуально самой компанией, всю
                                                                            ответственность за условия такого договора
                                                                            несет данная охранная компания.
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    Ссылка на договор
                                                </div>
                                                <a class="contract-link<?= $arResult['PROPERTIES']['HONEST_CONTRACT']['VALUE_XML_ID'] == 'Y' ? '' : ' t-c-gray' ?>" <?= $arResult['PROPERTIES']['HONEST_CONTRACT']['VALUE_XML_ID'] == 'Y' ? 'target=\'_blank\' href=\'' . $arResult['PROPERTIES']['HONEST_CONTRACT']['SRC'] . '\'' : ''; ?>>vincko:
                                                    Честный договор</a>
                                                <a class="contract-link<?= empty($arResult['PROPERTIES']['CONTRACT']['VALUE']) ? ' t-c-gray' : '' ?>" <?= empty($arResult['PROPERTIES']['CONTRACT']['VALUE']) ? '' : 'href=\'' . $arResult['PROPERTIES']['CONTRACT']['VALUE'] . '\' target=\'_blank\'' ?>>Договор
                                                    охранной компании</a>

                                                <p class="info-block-two__description">Перед покупкой услуг охранной
                                                    компании - ознакомьтесь с текстом договора</p>
                                            <? elseif ($arResult['STATUS_COMPANY']['ID'] == 1498): ?>
                                                <div class="info-block-two">
                                                    <div class="info-block-two__right">
                                                        <div class="text-descrip t-c-gray">
                                                            Мы оповестим охранные компании о вашем намерении и поможем
                                                            вам
                                                            заключить
                                                            договор охраны.
                                                        </div>
                                                        <div class="single-zayavka">
                                                            <a class="single-zayavka-btn" href="/zayavka/">Заполнить
                                                                индивидуальную
                                                                заявку</a>
                                                        </div>

                                                    </div>
                                                </div>

                                            <? endif; ?>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="company-info-card__content-container block">
                <div class="company-info-card__content-container block__title">О компании</div>
                <p class="company-info-card__content-container block__text"><?= $arResult['ABOUT_COMPANY']['DESC'] ?></p>
                <div class="company-info-card__content-container block__grid">
                    <div class="company-info-card__content-container block__grid item">
              <span>
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                          d="M7.12476 10.2251H8.67482V11.7752H7.12476V10.2251ZM7.12476 13.3252H8.67482V14.8753H7.12476V13.3252ZM10.2249 10.2251H11.7749V11.7752H10.2249V10.2251ZM10.2249 13.3252H11.7749V14.8753H10.2249V13.3252ZM13.325 10.2251H14.8751V11.7752H13.325V10.2251ZM13.325 13.3252H14.8751V14.8753H13.325V13.3252Z"
                          fill="#818181"/>
                  <path
                          d="M5.57472 18.7506H16.4252C17.28 18.7506 17.9752 18.0554 17.9752 17.2006V6.35013C17.9752 5.49527 17.28 4.80006 16.4252 4.80006H14.8751V3.25H13.325V4.80006H8.67485V3.25H7.12479V4.80006H5.57472C4.71986 4.80006 4.02466 5.49527 4.02466 6.35013V17.2006C4.02466 18.0554 4.71986 18.7506 5.57472 18.7506ZM16.8854 6.0996V17.5989H5.13108V6.0996H16.8854Z"
                          fill="#818181"/>
                </svg>
              </span>
                        <p>На площадке: с <?= $arResult['ABOUT_COMPANY']['START'] ?></p>
                    </div>
                    <div class="company-info-card__content-container block__grid item">
              <span>
                <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                          d="M18.1836 6.91714L18.5198 5.84118C18.5819 5.64296 18.7222 5.47694 18.9097 5.37964C19.0972 5.28233 19.3167 5.26172 19.5198 5.32234C19.7229 5.38296 19.893 5.51983 19.9926 5.70286C20.0923 5.88589 20.1134 6.10007 20.0513 6.29829L19.1147 9.28708C19.0526 9.48515 18.9125 9.65106 18.7251 9.74835C18.5378 9.84564 18.3185 9.86634 18.1156 9.80592L15.0534 8.8917C14.9507 8.86349 14.8548 8.81555 14.7714 8.75069C14.688 8.68583 14.6187 8.60535 14.5676 8.51399C14.5165 8.42262 14.4846 8.32221 14.4738 8.21865C14.463 8.11509 14.4735 8.01047 14.5047 7.91093C14.5359 7.81139 14.5872 7.71894 14.6555 7.63901C14.7238 7.55908 14.8078 7.49327 14.9026 7.44546C14.9973 7.39765 15.1009 7.36879 15.2072 7.36059C15.3135 7.35239 15.4204 7.365 15.5217 7.39769L16.8603 7.79698C16.2685 6.92097 15.4431 6.21912 14.473 5.76701C13.5029 5.31491 12.4247 5.12969 11.3548 5.23129C10.2848 5.3329 9.26345 5.71748 8.40079 6.34362C7.53814 6.96976 6.86685 7.81374 6.4592 8.78465L6.25105 9.27927C6.2132 9.3769 6.15568 9.46615 6.0819 9.54173C6.00812 9.6173 5.91957 9.67769 5.82148 9.71931C5.72339 9.76093 5.61774 9.78294 5.51079 9.78405C5.40384 9.78516 5.29774 9.76533 5.19877 9.72575C5.0998 9.68617 5.00996 9.62764 4.93455 9.5536C4.85914 9.47957 4.79969 9.39154 4.75973 9.29471C4.71976 9.19787 4.70007 9.09421 4.70184 8.98983C4.7036 8.88545 4.72677 8.78247 4.76999 8.68698L4.97814 8.19236C5.4955 6.96034 6.3469 5.88912 7.44093 5.09372C8.53496 4.29833 9.8303 3.80881 11.1879 3.67771C12.5454 3.54661 13.9139 3.7789 15.1464 4.34962C16.379 4.92035 17.4289 5.80796 18.1836 6.91714ZM5.7571 15.21L5.49531 16.2344C5.47189 16.336 5.4279 16.432 5.36592 16.5167C5.30394 16.6015 5.22523 16.6733 5.13441 16.7279C5.04359 16.7826 4.9425 16.819 4.83707 16.8349C4.73164 16.8509 4.624 16.8462 4.52048 16.821C4.41696 16.7958 4.31965 16.7506 4.23426 16.6882C4.14887 16.6257 4.07713 16.5473 4.02326 16.4574C3.96938 16.3675 3.93446 16.268 3.92054 16.1648C3.90662 16.0615 3.91398 15.9566 3.9422 15.8562L4.71635 12.8244C4.74247 12.7212 4.7899 12.6242 4.85574 12.5395C4.92157 12.4548 5.00443 12.3841 5.09923 12.3317C5.19404 12.2794 5.2988 12.2464 5.4071 12.2349C5.5154 12.2234 5.62496 12.2337 5.72908 12.2649L8.79368 13.0104C8.99974 13.0605 9.17695 13.1885 9.28632 13.3662C9.3957 13.5439 9.42828 13.7567 9.37689 13.9578C9.32551 14.1589 9.19438 14.3319 9.01233 14.4386C8.83029 14.5454 8.61226 14.5772 8.4062 14.527L6.97637 14.1793C7.58763 15.0926 8.45164 15.8181 9.46819 16.2716C10.4847 16.725 11.6122 16.8879 12.7198 16.7413C13.8273 16.5948 14.8696 16.1447 15.7257 15.4434C16.5819 14.7421 17.2168 13.8183 17.5568 12.7791C17.5887 12.6813 17.6401 12.5906 17.708 12.5122C17.7758 12.4338 17.8589 12.3692 17.9523 12.3221C18.0458 12.275 18.1478 12.2463 18.2526 12.2377C18.3574 12.2291 18.4629 12.2408 18.5631 12.272C18.6633 12.3032 18.7562 12.3533 18.8365 12.4195C18.9169 12.4858 18.983 12.5668 19.0313 12.658C19.0795 12.7492 19.1089 12.8488 19.1177 12.9511C19.1265 13.0534 19.1146 13.1564 19.0826 13.2542C18.7494 14.2746 18.191 15.2114 17.4469 15.9986C16.7028 16.7857 15.7909 17.4042 14.7756 17.8104C13.1935 18.443 11.4377 18.5301 9.79804 18.0573C8.1584 17.5845 6.73297 16.5801 5.7571 15.21Z"
                          fill="#818181"/>
                </svg>
              </span>
                        <p>Актуальность: <?= $arResult['ABOUT_COMPANY']['ACTUAL'] ?></p>
                    </div>
                    <div class="company-info-card__content-container block__grid item">
              <span>
                <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M16.3039 7.45287C17.6032 8.30267 18.6023 9.48282 19.1779 10.8475C19.2167 10.946 19.2167 11.0539 19.1779 11.1525C18.6023 12.5171 17.6032 13.6973 16.3039 14.5471C15.0047 15.3969 13.4622 15.879 11.8673 15.934C10.2723 15.879 8.72992 15.3969 7.43066 14.5471C6.1314 13.6973 5.13227 12.5171 4.55674 11.1525C4.51787 11.0539 4.51787 10.946 4.55674 10.8475C5.13227 9.48282 6.1314 8.30267 7.43066 7.45287C8.72992 6.60308 10.2723 6.1209 11.8673 6.06592C13.4622 6.1209 15.0047 6.60308 16.3039 7.45287ZM5.54029 11C6.53362 13.2741 9.27386 15.0369 11.8673 15.0369C14.4607 15.0369 17.201 13.2741 18.1943 11C17.201 8.72582 14.4607 6.96302 11.8673 6.96302C9.27386 6.96302 6.53362 8.72582 5.54029 11ZM10.2361 8.76216C10.7189 8.46644 11.2866 8.30859 11.8672 8.30859C12.6459 8.30859 13.3927 8.59214 13.9433 9.09686C14.4939 9.60157 14.8032 10.2861 14.8032 10.9999C14.8032 11.5322 14.631 12.0525 14.3084 12.4951C13.9858 12.9377 13.5273 13.2826 12.9908 13.4863C12.4543 13.69 11.864 13.7433 11.2945 13.6395C10.7249 13.5356 10.2018 13.2793 9.7912 12.9029C9.3806 12.5265 9.10097 12.047 8.98769 11.5249C8.8744 11.0029 8.93255 10.4618 9.15476 9.96998C9.37698 9.47821 9.75329 9.05788 10.2361 8.76216ZM10.7798 12.4917C11.1017 12.6889 11.4801 12.7941 11.8672 12.7941C12.3864 12.7941 12.8842 12.6051 13.2513 12.2686C13.6183 11.9321 13.8246 11.4757 13.8246 10.9999C13.8246 10.645 13.7098 10.2981 13.4947 10.0031C13.2796 9.70804 12.9739 9.47807 12.6163 9.34227C12.2586 9.20647 11.8651 9.17094 11.4854 9.24017C11.1057 9.3094 10.7569 9.48028 10.4832 9.7312C10.2095 9.98213 10.0231 10.3018 9.94754 10.6499C9.87202 10.9979 9.91078 11.3587 10.0589 11.6865C10.2071 12.0144 10.4579 12.2946 10.7798 12.4917Z"
                        fill="#818181"/>
                </svg>
              </span>
                        <p>Просмотров за <?= $arResult['CURRENT_MONTH'] ?>
                            : <?= !empty($arResult['PROPERTIES']['CH_COUNT_VIEWS_MONTH']['VALUE']) ? $arResult['PROPERTIES']['CH_COUNT_VIEWS_MONTH']['VALUE'] : 0 ?></p>
                    </div>
                    <div class="company-info-card__content-container block__grid item">
              <span>
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                          d="M17.3286 10.8658C16.8219 9.66426 15.9422 8.62516 14.7982 7.87694C13.6543 7.12872 12.2962 6.70417 10.8919 6.65576C9.48756 6.70417 8.12949 7.12872 6.98553 7.87694C5.84156 8.62516 4.96185 9.66426 4.45511 10.8658C4.42089 10.9526 4.42089 11.0476 4.45511 11.1344C4.96185 12.3359 5.84156 13.375 6.98553 14.1232C8.12949 14.8714 9.48756 15.296 10.8919 15.3444C12.2962 15.296 13.6543 14.8714 14.7982 14.1232C15.9422 13.375 16.8219 12.3359 17.3286 11.1344C17.3629 11.0476 17.3629 10.9526 17.3286 10.8658ZM10.8919 14.5545C8.60842 14.5545 6.19571 13.0024 5.3211 11.0001C6.19571 8.99774 8.60842 7.44564 10.8919 7.44564C13.1753 7.44564 15.588 8.99774 16.4627 11.0001C15.588 13.0024 13.1753 14.5545 10.8919 14.5545Z"
                          fill="#818181"/>
                  <path
                          d="M10.8917 8.63037C10.3804 8.63037 9.88062 8.76935 9.45551 9.02973C9.0304 9.2901 8.69907 9.66019 8.50342 10.0932C8.30776 10.5262 8.25657 11.0026 8.35631 11.4623C8.45606 11.922 8.70226 12.3442 9.06378 12.6756C9.42531 13.007 9.88592 13.2327 10.3874 13.3241C10.8888 13.4155 11.4086 13.3686 11.8809 13.1892C12.3533 13.0099 12.757 12.7062 13.0411 12.3165C13.3251 11.9268 13.4767 11.4687 13.4767 11C13.4767 10.3715 13.2044 9.76881 12.7196 9.32442C12.2348 8.88003 11.5773 8.63037 10.8917 8.63037Z"
                          fill="#818181"/>
                </svg>
              </span>
                        <p>Просмотров
                            всего: <?= !empty($arResult['PROPERTIES']['CH_COUNT_VIEWS']['VALUE']) ? $arResult['PROPERTIES']['CH_COUNT_VIEWS']['VALUE'] : 0 ?></p>
                    </div>
                </div>
            </div>
            <div class="company-info-card__content-container block">
                <div class="company-info-card__content-container block__title">Типы объектов, охраняемых компанией:
                </div>
                <? if ($arResult['STATUS_COMPANY']['ID'] == 1498 || $arResult['STATUS_COMPANY']['ID'] == 1497): ?>
                    <div class="company-info-card__content-container block__tab-group">
                        <form class="company-info-card__content-form">
                            <? if (in_array(639, $arResult['PROPERTIES']['CH_TYPE']['VALUE'])): ?>
                                <input checked type="radio" id="secureChoice1" name="secure" value="flat">
                                <label for="secureChoice1">
                                    Охрана квартиры
                                </label>
                            <? endif; ?>
                            <? if (in_array(640, $arResult['PROPERTIES']['CH_TYPE']['VALUE'])): ?>
                                <input type="radio" id="secureChoice2" name="secure" value="house">
                                <label for="secureChoice2">
                                    Охрана дома
                                </label>
                            <? endif; ?>
                            <? if (in_array(643, $arResult['PROPERTIES']['CH_TYPE']['VALUE'])): ?>
                                <input type="radio" id="secureChoice3" name="secure" value="commercial_real_estate"
                                       checked>
                                <label for="secureChoice3">
                                    Охрана коммерческой недвижимости
                                </label>
                            <? endif; ?>
                        </form>
                    </div>
                    <? if (in_array(639, $arResult['PROPERTIES']['CH_TYPE']['VALUE'])): ?>
                        <div class="company-info-card__content-container block__tab block__tab--flat">
                            <div class="company-info-card__content-container-left">
                                <div class="company-info-card__content-container block__title">Услуги</div>
                                <div class="company-info-card__content-container block__ac-container">
                                    <?= $arResult['PROPERTIES']['SERVICES_APPARTAMENT']['~VALUE']['TEXT'] ?>
                                </div>
                            </div>
                            <div class="company-info-card__content-container-right">
                                <div class="company-info-card__content-container block__title">Решение индивидуальных
                                    задач
                                </div>
                                <div class="company-info-card__content-container block__solution-info">
                                    <p class="block__solution-info text">
                                        <?= $arResult['PROPERTIES']['DESCRIPTION_APPARTAMENT']['~VALUE']['TEXT'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <? endif; ?>
                    <? if (in_array(640, $arResult['PROPERTIES']['CH_TYPE']['VALUE'])): ?>
                        <div class="company-info-card__content-container block__tab block__tab--house">
                            <div class="company-info-card__content-container-left">
                                <div class="company-info-card__content-container block__title">Услуги</div>
                                <div class="company-info-card__content-container block__ac-container">
                                    <?= $arResult['PROPERTIES']['SERVICES_HOME']['~VALUE']['TEXT'] ?>
                                </div>
                            </div>
                            <div class="company-info-card__content-container-right">
                                <div class="company-info-card__content-container block__title">Решение индивидуальных
                                    задач
                                </div>
                                <div class="company-info-card__content-container block__solution-info">
                                    <p class="block__solution-info text">
                                        <?= $arResult['PROPERTIES']['DESCRIPTION_HOME']['~VALUE']['TEXT'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <? endif; ?>
                    <? if (in_array(643, $arResult['PROPERTIES']['CH_TYPE']['VALUE'])): ?>
                        <div class="company-info-card__content-container block__tab block__tab--commercial">
                            <div class="company-info-card__content-container-left">
                                <div class="company-info-card__content-container block__title">Услуги</div>
                                <div class="company-info-card__content-container block__ac-container">
                                    <?= $arResult['PROPERTIES']['SERVICES_COMMERCE']['~VALUE']['TEXT'] ?>
                                </div>
                            </div>
                            <div class="company-info-card__content-container-right">
                                <div class="company-info-card__content-container block__title">Решение индивидуальных
                                    задач
                                </div>
                                <div class="company-info-card__content-container block__solution-info">
                                    <p class="block__solution-info text">
                                        <?= $arResult['PROPERTIES']['DESCRIPTION_COMMERCE']['~VALUE']['TEXT'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <? endif; ?>
                <? else: ?>
                    <div class="itemRating-open__left_text">
                        <? if (count($arResult['REVIEWS']) > 0): ?>
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
                                <a href="/reviews/?COMPANY=<?= $arResult['ID'] ?>">Читать все
                                    <span><?= count($arResult['REVIEWS']) ?></span> отзыва</a>
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
            <div class="company-info-card__content-container block">
                <div class="company-info-card__content-container block__title">Фирмы производители оборудования, с
                    которыми
                    работает компания
                </div>
                <div class="company-info-card__content-container block__link-wrapper">
                    <? foreach ($arResult['MANUFACTURE'] as $manufacture): ?>
                        <span><?= $manufacture['NAME'] ?></span>
                    <? endforeach; ?>
                </div>
            </div>
            <div class="company-info-card__page-title not-main" id="reviews">
                <h2>Отзывы о компании</h2>
                <div class="btn-wrapper">
                    <button onclick="location.href='/review-add/?COMPANY=<?= $arResult['ABOUT_COMPANY']['CURRENT_COMPANY'] ?>'">
                        Оставить отзыв
                    </button>
                    <button onclick="location.href='/reviews/?COMPANY=<?= $arResult['ABOUT_COMPANY']['CURRENT_COMPANY'] ?>'">
                        Читать все <?= count($arResult['REVIEWS']) ?> отзыва
                    </button>
                </div>
            </div>
            <div class="reviews__item">
                <div class="slick-slider-reviews">
                    <? $i = 0;
                    foreach ($arResult['REVIEWS'] as $review): if ($i++ > 2) break; ?>

                        <div class="slide">
                            <div class="reviews__item-left">
                                <div class="reviews__item__head">
                                    <div class="reviews__item__head--left">
                                        <div class="person__avatar">
                                            <img src="/upload/reviews/avatar.png" alt="img">
                                        </div>
                                        <div class="person__items">
                                            <span class="name"><?= !empty($review['NAME']) ? $review['NAME'] : 'Пользователь скрыл имя настройками приватности'; ?></span>
                                            <span class="town"><?= $review['CITY']['NAME'] ?></span>
                                            <? if ($review['TYPE'] == 3): ?>
                                                <span class="client">
                                                <span class="text">покупатель</span>
                                                <span class="icon">
                                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                                d="M7 0C5.61553 0 4.26215 0.410543 3.11101 1.17971C1.95987 1.94888 1.06266 3.04213 0.532846 4.32121C0.00303299 5.6003 -0.13559 7.00776 0.134506 8.36563C0.404603 9.7235 1.07129 10.9708 2.05026 11.9497C3.02922 12.9287 4.2765 13.5954 5.63437 13.8655C6.99224 14.1356 8.3997 13.997 9.67879 13.4672C10.9579 12.9373 12.0511 12.0401 12.8203 10.889C13.5895 9.73784 14 8.38447 14 7C14 6.08075 13.8189 5.17049 13.4672 4.32121C13.1154 3.47194 12.5998 2.70026 11.9497 2.05025C11.2997 1.40024 10.5281 0.884626 9.67879 0.532843C8.82951 0.18106 7.91925 0 7 0ZM7 11.2C6.86156 11.2 6.72622 11.1589 6.6111 11.082C6.49599 11.0051 6.40627 10.8958 6.35329 10.7679C6.3003 10.64 6.28644 10.4992 6.31345 10.3634C6.34046 10.2276 6.40713 10.1029 6.50503 10.005C6.60292 9.90713 6.72765 9.84046 6.86344 9.81345C6.99923 9.78644 7.13997 9.8003 7.26788 9.85328C7.39579 9.90626 7.50511 9.99598 7.58203 10.1111C7.65895 10.2262 7.7 10.3616 7.7 10.5C7.7 10.6856 7.62625 10.8637 7.49498 10.995C7.3637 11.1262 7.18565 11.2 7 11.2ZM7.7 7.588V8.4C7.7 8.58565 7.62625 8.7637 7.49498 8.89497C7.3637 9.02625 7.18565 9.1 7 9.1C6.81435 9.1 6.6363 9.02625 6.50503 8.89497C6.37375 8.7637 6.3 8.58565 6.3 8.4V7C6.3 6.81435 6.37375 6.6363 6.50503 6.50502C6.6363 6.37375 6.81435 6.3 7 6.3C7.20767 6.3 7.41068 6.23842 7.58335 6.12304C7.75602 6.00767 7.8906 5.84368 7.97008 5.65182C8.04955 5.45995 8.07034 5.24883 8.02983 5.04515C7.98931 4.84147 7.88931 4.65438 7.74246 4.50754C7.59562 4.36069 7.40853 4.26069 7.20485 4.22017C7.00117 4.17966 6.79005 4.20045 6.59818 4.27993C6.40632 4.3594 6.24233 4.49398 6.12696 4.66665C6.01158 4.83932 5.95 5.04233 5.95 5.25C5.95 5.43565 5.87625 5.6137 5.74498 5.74497C5.6137 5.87625 5.43565 5.95 5.25 5.95C5.06435 5.95 4.8863 5.87625 4.75503 5.74497C4.62375 5.6137 4.55 5.43565 4.55 5.25C4.54817 4.79521 4.67296 4.34889 4.91041 3.961C5.14785 3.57311 5.48858 3.25898 5.89443 3.05375C6.30029 2.84853 6.75526 2.76033 7.2084 2.79901C7.66155 2.8377 8.09498 3.00176 8.46017 3.27281C8.82536 3.54387 9.1079 3.91122 9.27615 4.33375C9.44441 4.75627 9.49173 5.21729 9.41283 5.66518C9.33393 6.11308 9.13191 6.53017 8.82941 6.86977C8.5269 7.20936 8.13583 7.45805 7.7 7.588Z"
                                                                fill="#93B5FF"/>
                                                    </svg>
                                                </span>
                                                <div class="client__icon-pseudo">
                                                    <p>Это отзыв покупателя платформы <a href="">vincko:</a></p>
                                                    <p> Преимущество <a href="">vincko:</a> отзыва перед остальными в том, что он
                                                        оставлен<span>реальным пользователем платформы</span> и содержит информацию онастоящемопыте сотрудничества с компанией.
                                                    </p>
                                                </div>
                                            </span>
                                            <? endif; ?>
                                        </div>
                                    </div>
                                    <div class="reviews__item__head--right">
                                        <p>Личная оценка по критериям <a href="">vincko:</a></p>
                                        <div class="raiting__content">
                                            <ul class="raiting__vincko">
                                                <? if (!empty($review['CUSTOMER'])): ?>
                                                    <li>
                                                    <span class="icon">
                                                        <svg width="15" height="17" viewBox="0 0 15 17" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                                d="M7.90409 7.99862C8.69508 7.99862 9.46831 7.76406 10.126 7.32461C10.7837 6.88516 11.2963 6.26056 11.599 5.52978C11.9017 4.799 11.9809 3.99487 11.8266 3.21908C11.6722 2.44329 11.2913 1.73069 10.732 1.17137C10.1727 0.612059 9.46011 0.231162 8.68432 0.0768474C7.90853 -0.0774668 7.1044 0.00173282 6.37362 0.304431C5.64285 0.607129 5.01824 1.11973 4.57879 1.77741C4.13934 2.4351 3.90479 3.20832 3.90479 3.99931C3.90479 5.05999 4.32614 6.07723 5.07616 6.82725C5.82617 7.57726 6.84341 7.99862 7.90409 7.99862ZM7.90409 1.99966C8.29959 1.99966 8.6862 2.11693 9.01504 2.33666C9.34388 2.55638 9.60018 2.86869 9.75153 3.23408C9.90288 3.59946 9.94248 4.00153 9.86533 4.38942C9.78817 4.77732 9.59772 5.13362 9.31806 5.41328C9.03841 5.69294 8.6821 5.88339 8.29421 5.96054C7.90631 6.0377 7.50425 5.9981 7.13886 5.84675C6.77347 5.6954 6.46117 5.4391 6.24144 5.11026C6.02172 4.78142 5.90444 4.3948 5.90444 3.99931C5.90444 3.46897 6.11512 2.96035 6.49012 2.58534C6.86513 2.21033 7.37375 1.99966 7.90409 1.99966Z"
                                                                fill="#005DFF"/>
                                                        <path
                                                                d="M7.90412 8.99805C6.2565 9.01447 4.66639 9.60595 3.40856 10.6703C2.15073 11.7346 1.30422 13.2049 1.01531 14.827C0.990822 14.9571 0.9924 15.0907 1.01995 15.2202C1.04751 15.3496 1.10049 15.4723 1.17582 15.5812C1.25116 15.69 1.34735 15.7827 1.45882 15.8541C1.57028 15.9255 1.69481 15.974 1.82517 15.9968C1.95522 16.0198 2.08853 16.0167 2.21739 15.9878C2.34625 15.959 2.46812 15.9049 2.57595 15.8286C2.68378 15.7524 2.77545 15.6556 2.84565 15.5437C2.91586 15.4319 2.96321 15.3072 2.98497 15.177C3.19367 14.0244 3.80049 12.9816 4.69954 12.2307C5.59858 11.4799 6.73275 11.0685 7.90412 11.0685C9.07549 11.0685 10.2097 11.4799 11.1087 12.2307C12.0077 12.9816 12.6146 14.0244 12.8233 15.177C12.8637 15.4117 12.9867 15.6243 13.17 15.7765C13.3533 15.9286 13.5849 16.0103 13.8231 16.0068H13.9931C14.1224 15.9839 14.246 15.9357 14.3567 15.865C14.4674 15.7943 14.5631 15.7025 14.6383 15.5948C14.7136 15.4871 14.7668 15.3656 14.795 15.2373C14.8233 15.109 14.826 14.9764 14.8029 14.847C14.5179 13.2195 13.6717 11.7433 12.4114 10.6748C11.1511 9.60627 9.55634 9.013 7.90412 8.99805Z"
                                                                fill="#005DFF"/>
                                                    </svg>
                                                    </span>
                                                        <span class="text"><?= $review['CUSTOMER'] ?></span>
                                                    </li>
                                                <? endif; ?>
                                                <? if (!empty($review['SECURITY'])): ?>
                                                    <li>
                                                    <span class="icon">
                                                        <svg width="11" height="15" viewBox="0 0 11 15" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                    d="M3.43736 14.9571C3.32973 14.9109 3.24028 14.8294 3.18314 14.7256C3.126 14.6218 3.10441 14.5016 3.12179 14.3839L4.07904 8.0358H1.53864C1.4581 8.03801 1.37815 8.02134 1.30493 7.98709C1.23172 7.95283 1.16722 7.9019 1.11639 7.83823C1.06557 7.77456 1.02978 7.69985 1.0118 7.61985C0.993821 7.53987 0.994121 7.45674 1.01268 7.37688L2.59057 0.412686C2.61833 0.292832 2.68579 0.186381 2.78158 0.111251C2.87738 0.036121 2.99567 -0.00309958 3.11653 0.000191468H8.37614C8.45472 -8.06562e-05 8.53235 0.0175825 8.60335 0.0518831C8.67434 0.0861837 8.73689 0.13625 8.78639 0.198403C8.83659 0.261258 8.87214 0.334894 8.89036 0.413766C8.90858 0.492639 8.909 0.574694 8.89158 0.653755L7.98167 4.82156H10.48C10.5786 4.82136 10.6752 4.84938 10.7589 4.90242C10.8426 4.95546 10.91 5.03139 10.9534 5.12156C10.991 5.20809 11.0055 5.30326 10.9954 5.39736C10.9852 5.49146 10.9508 5.58114 10.8955 5.65726L4.058 14.7643C4.01179 14.8341 3.95009 14.8918 3.8779 14.9327C3.80571 14.9737 3.72506 14.9967 3.64249 15C3.57211 14.9987 3.50258 14.9841 3.43736 14.9571ZM6.66677 5.89297L7.71869 1.07161H3.5373L2.20135 6.96439H5.30979L4.47351 12.4715L9.42806 5.89297H6.66677Z"
                                                                    fill="#005DFF"/>
                                                        </svg>
                                                    </span>
                                                        <span class="text"><?= $review['SECURITY'] ?></span>
                                                    </li>
                                                <? endif; ?>
                                                <? if (!empty($review['COMFORT'])): ?>
                                                    <li>
                                                    <span class="icon">
                                                        <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                    d="M8.99805 0C4.58685 0 0.998047 3.5888 0.998047 8C0.998047 12.4112 4.58685 16 8.99805 16C13.4092 16 16.998 12.4112 16.998 8C16.998 3.5888 13.4092 0 8.99805 0ZM8.99805 14.5455C5.38883 14.5455 2.45259 11.6092 2.45259 8C2.45259 4.39084 5.38883 1.45455 8.99805 1.45455C12.6073 1.45455 15.5435 4.39084 15.5435 8C15.5435 11.6092 12.6072 14.5455 8.99805 14.5455Z"
                                                                    fill="#005DFF"/>
                                                            <path
                                                                    d="M12.3932 5.0239L7.73721 9.35248L5.60329 7.36855C5.28191 7.06977 4.76075 7.06972 4.43932 7.3685C4.11788 7.66733 4.11788 8.1518 4.43932 8.45063L7.15519 10.9757C7.30954 11.1192 7.51888 11.1998 7.73715 11.1998C7.73721 11.1998 7.73715 11.1998 7.73721 11.1998C7.95548 11.1998 8.16481 11.1192 8.31916 10.9757L13.5572 6.10609C13.8786 5.80725 13.8786 5.32279 13.5572 5.02395C13.2357 4.72512 12.7146 4.72507 12.3932 5.0239Z"
                                                                    fill="#005DFF"/>
                                                        </svg>
                                                    </span>
                                                        <span class="text"><?= $review['COMFORT'] ?></span>
                                                    </li>
                                                <? endif; ?>
                                                <? if (!empty($review['ALLSCORE'])): ?>
                                                    <li>
                                                <span class="icon">
                                                <svg width="11" height="13" viewBox="0 0 11 13" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                        d="M7.06627 8.02286H4.17578V9.52714H8.62821V10.79H4.17578V13H2.52408V10.79H0.998047V9.52714H2.52408V8.02286H0.998047V6.46286H2.52408V0H7.06627C8.15544 0 9.08303 0.39619 9.84903 1.18857C10.615 1.96857 10.998 2.91571 10.998 4.03C10.998 5.14429 10.615 6.09143 9.84903 6.87143C9.09499 7.63905 8.16741 8.02286 7.06627 8.02286ZM4.17578 1.61571V6.46286H7.06627C7.68865 6.46286 8.22127 6.22762 8.66411 5.75714C9.11893 5.27429 9.34634 4.69857 9.34634 4.03C9.34634 3.36143 9.12492 2.7919 8.68207 2.32143C8.23922 1.85095 7.70062 1.61571 7.06627 1.61571H4.17578Z"
                                                        fill="#005DFF"/>
                                                </svg>
                                                </span>
                                                        <span class="text"><?= $review['ALLSCORE'] ?></span>
                                                    </li>
                                                <? endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="reviews__item__body">

                                    <div class="reviews__item__body--center">
                                        <span>Комментарий пользователя:</span>
                                        <p><?= $review['COMMENT'] ?></p>
                                    </div>

                                </div>
                                <div class="reviews__item__footer">
                                </div>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
        <div class="installment__right-column">
            <div class="solutions-card card-two">
                <div class="solutions-card__switch-btn">
                    <div class="solutions-card__switch-btn--open show">
                        Цены
                        <svg width="5" height="8" viewBox="0 0 5 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.179893 3.60396L3.95144 0.164193C4.19135 -0.0547314 4.58034 -0.0547314 4.82014 0.164193C5.05996 0.382921 5.05996 0.737679 4.82014 0.95639L1.4829 4.00006L4.82004 7.04362C5.05986 7.26244 5.05986 7.61716 4.82004 7.83589C4.58022 8.0547 4.19126 8.0547 3.95134 7.83589L0.179797 4.39607C0.0598873 4.28665 3.37155e-07 4.1434 3.49685e-07 4.00007C3.6222e-07 3.85668 0.0600037 3.71332 0.179893 3.60396Z"
                                  fill="white"/>
                        </svg>

                    </div>

                    <div class="solutions-card__switch-btn--close">
                        Цены
                        <svg width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.82011 4.89604L1.04856 8.33581C0.808646 8.55473 0.419663 8.55473 0.179864 8.33581C-0.0599547 8.11708 -0.0599547 7.76232 0.179864 7.54361L3.5171 4.49994L0.179961 1.45638C-0.0598576 1.23756 -0.0598576 0.882842 0.179961 0.664113C0.41978 0.445296 0.808743 0.445296 1.04866 0.664113L4.8202 4.10393C4.94011 4.21335 5 4.3566 5 4.49992C5 4.64332 4.94 4.78668 4.82011 4.89604Z"
                                  fill="white"/>
                        </svg>

                    </div>
                </div>
                <? if ($arResult['STATUS_COMPANY']['ID'] == 1497): ?>
                    <div class="solutions-card__substrate" data-company="<?=$arResult['ID']?>">
                        <div class="solutions-card__close">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.17564 7.98187L15.8076 1.36761C15.9387 1.21497 16.0072 1.01864 15.9994 0.817837C15.9916 0.617035 15.9082 0.426555 15.7657 0.28446C15.6232 0.142366 15.4322 0.0591225 15.2309 0.0513664C15.0295 0.0436103 14.8327 0.111912 14.6796 0.242623L8.04764 6.85688L1.41563 0.234644C1.26499 0.084404 1.06068 0 0.847635 0C0.634593 0 0.430278 0.084404 0.279635 0.234644C0.128992 0.384884 0.0443614 0.588653 0.0443614 0.801125C0.0443614 1.0136 0.128992 1.21737 0.279635 1.36761L6.91964 7.98187L0.279635 14.5961C0.195889 14.6677 0.127873 14.7557 0.0798545 14.8547C0.0318359 14.9536 0.00485175 15.0615 0.000596153 15.1713C-0.00365944 15.2812 0.0149049 15.3908 0.0551246 15.4932C0.0953442 15.5956 0.156351 15.6886 0.234315 15.7663C0.312278 15.8441 0.405516 15.9049 0.508176 15.945C0.610836 15.9851 0.720702 16.0036 0.830878 15.9994C0.941053 15.9952 1.04916 15.9682 1.14841 15.9204C1.24766 15.8725 1.33592 15.8046 1.40763 15.7211L8.04764 9.10685L14.6796 15.7211C14.8327 15.8518 15.0295 15.9201 15.2309 15.9124C15.4322 15.9046 15.6232 15.8214 15.7657 15.6793C15.9082 15.5372 15.9916 15.3467 15.9994 15.1459C16.0072 14.9451 15.9387 14.7488 15.8076 14.5961L9.17564 7.98187Z"
                                      fill="white"/>
                            </svg>

                        </div>
                        <div class="solutions-card__center">
                            <div class="h2">
                                Вы можете заказать услуги этой компании в рамках <span
                                        class="blue">Готового решения</span>
                            </div>
                            <div class="solution-card__list">
                                <div class="solution-card__list-current win-open">
                                    <div class="solution-card__list-current-help">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7 0C5.61553 0 4.26215 0.410543 3.11101 1.17971C1.95987 1.94888 1.06266 3.04213 0.532846 4.32121C0.00303299 5.6003 -0.13559 7.00776 0.134506 8.36563C0.404603 9.7235 1.07129 10.9708 2.05026 11.9497C3.02922 12.9287 4.2765 13.5954 5.63437 13.8655C6.99224 14.1356 8.3997 13.997 9.67879 13.4672C10.9579 12.9373 12.0511 12.0401 12.8203 10.889C13.5895 9.73784 14 8.38447 14 7C14 6.08074 13.8189 5.17049 13.4672 4.32121C13.1154 3.47194 12.5998 2.70026 11.9497 2.05025C11.2997 1.40024 10.5281 0.884626 9.67879 0.532843C8.82951 0.18106 7.91925 0 7 0ZM7 11.2C6.86155 11.2 6.72622 11.1589 6.6111 11.082C6.49599 11.0051 6.40627 10.8958 6.35329 10.7679C6.3003 10.64 6.28644 10.4992 6.31345 10.3634C6.34046 10.2276 6.40713 10.1029 6.50503 10.005C6.60292 9.90712 6.72765 9.84046 6.86344 9.81345C6.99923 9.78644 7.13997 9.8003 7.26788 9.85328C7.39579 9.90626 7.50511 9.99598 7.58203 10.1111C7.65895 10.2262 7.7 10.3615 7.7 10.5C7.7 10.6856 7.62625 10.8637 7.49498 10.995C7.3637 11.1262 7.18565 11.2 7 11.2ZM7.7 7.588V8.4C7.7 8.58565 7.62625 8.7637 7.49498 8.89497C7.3637 9.02625 7.18565 9.1 7 9.1C6.81435 9.1 6.6363 9.02625 6.50503 8.89497C6.37375 8.7637 6.3 8.58565 6.3 8.4V7C6.3 6.81435 6.37375 6.6363 6.50503 6.50502C6.6363 6.37375 6.81435 6.3 7 6.3C7.20767 6.3 7.41068 6.23842 7.58335 6.12304C7.75602 6.00767 7.8906 5.84368 7.97008 5.65182C8.04955 5.45995 8.07034 5.24883 8.02983 5.04515C7.98931 4.84147 7.88931 4.65438 7.74246 4.50754C7.59562 4.36069 7.40853 4.26069 7.20485 4.22017C7.00117 4.17966 6.79005 4.20045 6.59818 4.27992C6.40632 4.3594 6.24233 4.49398 6.12696 4.66665C6.01158 4.83932 5.95 5.04233 5.95 5.25C5.95 5.43565 5.87625 5.6137 5.74498 5.74497C5.6137 5.87625 5.43565 5.95 5.25 5.95C5.06435 5.95 4.8863 5.87625 4.75503 5.74497C4.62375 5.6137 4.55 5.43565 4.55 5.25C4.54817 4.79521 4.67296 4.34889 4.91041 3.961C5.14785 3.57311 5.48858 3.25897 5.89443 3.05375C6.30029 2.84853 6.75526 2.76033 7.2084 2.79901C7.66155 2.8377 8.09498 3.00176 8.46017 3.27281C8.82536 3.54387 9.1079 3.91122 9.27615 4.33375C9.44441 4.75627 9.49173 5.21729 9.41283 5.66518C9.33393 6.11308 9.13191 6.53017 8.8294 6.86977C8.5269 7.20936 8.13583 7.45805 7.7 7.588Z" fill="#818181"></path>
                                        </svg>
                                    </div>
                                    <div class="solution-card__list-current-text">
                                        <?=current($arResult['OFFERS'])['PROPERTY_CPA_PACKET_PROPERTY_CO_CLASS_REF_VALUE']['NAME']?> <?=current($arResult['OFFERS'])['PROPERTY_CPA_PACKET_IBLOCK_SECTION_ID']['NAME']?>: <?=current($arResult['OFFERS'])['PROPERTY_CPA_PACKET_PROPERTY_P_COMPLECT_VALUE']['NAME']?>
                                    </div>
                                    <div class="solution-card__list-current-open-list">
                                        <svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 6L9 0H0L4.5 6Z" fill="#005DFF"/>
                                        </svg>
                                    </div>
                                    <div class="solution-card__list-current-help-window" style="display:none;">
                                        <div class="solution-card__list-current-help-window-close">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.17564 7.98187L15.8076 1.36761C15.9387 1.21497 16.0072 1.01864 15.9994 0.817837C15.9916 0.617035 15.9082 0.426555 15.7657 0.28446C15.6232 0.142366 15.4322 0.0591225 15.2309 0.0513664C15.0295 0.0436103 14.8327 0.111912 14.6796 0.242623L8.04764 6.85688L1.41563 0.234644C1.26499 0.084404 1.06068 0 0.847635 0C0.634593 0 0.430278 0.084404 0.279635 0.234644C0.128992 0.384884 0.0443614 0.588653 0.0443614 0.801125C0.0443614 1.0136 0.128992 1.21737 0.279635 1.36761L6.91964 7.98187L0.279635 14.5961C0.195889 14.6677 0.127873 14.7557 0.0798545 14.8547C0.0318359 14.9536 0.00485175 15.0615 0.000596153 15.1713C-0.00365944 15.2812 0.0149049 15.3908 0.0551246 15.4932C0.0953442 15.5956 0.156351 15.6886 0.234315 15.7663C0.312278 15.8441 0.405516 15.9049 0.508176 15.945C0.610836 15.9851 0.720702 16.0036 0.830878 15.9994C0.941053 15.9952 1.04916 15.9682 1.14841 15.9204C1.24766 15.8725 1.33592 15.8046 1.40763 15.7211L8.04764 9.10685L14.6796 15.7211C14.8327 15.8518 15.0295 15.9201 15.2309 15.9124C15.4322 15.9046 15.6232 15.8214 15.7657 15.6793C15.9082 15.5372 15.9916 15.3467 15.9994 15.1459C16.0072 14.9451 15.9387 14.7488 15.8076 14.5961L9.17564 7.98187Z" fill="#D1DBE3"/>
                                            </svg>
                                        </div>
                                        <div class="solution-card__list-current-help-window-title">
                                            <span>Готовое решение </span><span class="name t-c-yellow-d"><?=current($arResult['OFFERS'])['PROPERTY_CPA_PACKET_IBLOCK_SECTION_ID']['NAME']?></span>
                                        </div>
                                        <br>
                                        <div class="solution-card__list-current-help-window-desc">
                                            <?=current($arResult['OFFERS'])['PROPERTY_CPA_PACKET_PREVIEW_TEXT']?>
                                        </div>
                                    </div>
                                </div>
                                <div class="solution-card__list-select">
                                    <div class="solution-card__list-current-help-window-close">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.17564 7.98187L15.8076 1.36761C15.9387 1.21497 16.0072 1.01864 15.9994 0.817837C15.9916 0.617035 15.9082 0.426555 15.7657 0.28446C15.6232 0.142366 15.4322 0.0591225 15.2309 0.0513664C15.0295 0.0436103 14.8327 0.111912 14.6796 0.242623L8.04764 6.85688L1.41563 0.234644C1.26499 0.084404 1.06068 0 0.847635 0C0.634593 0 0.430278 0.084404 0.279635 0.234644C0.128992 0.384884 0.0443614 0.588653 0.0443614 0.801125C0.0443614 1.0136 0.128992 1.21737 0.279635 1.36761L6.91964 7.98187L0.279635 14.5961C0.195889 14.6677 0.127873 14.7557 0.0798545 14.8547C0.0318359 14.9536 0.00485175 15.0615 0.000596153 15.1713C-0.00365944 15.2812 0.0149049 15.3908 0.0551246 15.4932C0.0953442 15.5956 0.156351 15.6886 0.234315 15.7663C0.312278 15.8441 0.405516 15.9049 0.508176 15.945C0.610836 15.9851 0.720702 16.0036 0.830878 15.9994C0.941053 15.9952 1.04916 15.9682 1.14841 15.9204C1.24766 15.8725 1.33592 15.8046 1.40763 15.7211L8.04764 9.10685L14.6796 15.7211C14.8327 15.8518 15.0295 15.9201 15.2309 15.9124C15.4322 15.9046 15.6232 15.8214 15.7657 15.6793C15.9082 15.5372 15.9916 15.3467 15.9994 15.1459C16.0072 14.9451 15.9387 14.7488 15.8076 14.5961L9.17564 7.98187Z" fill="#D1DBE3"/>
                                        </svg>
                                    </div>
                                    <div class="solution-card__list-select-title">
                                        Выберите Готовое решение, в рамках которого можно заказать услуги данной охранной компании
                                    </div>
                                    <div class="solution-card__list-select-packages-list">
                                        <?$first = true; foreach ($arResult['GROUP_OFFERS'] as $group):?>
                                            <div class="solution-card__list-select-package<?=$first ? ' active': ' ';?>">
                                            <div class="solution-card__list-select-package-title">
                                                Готовое решение “<span><?=$group['NAME']?></span>”
                                            </div>
                                                <?foreach ($group['ITEMS'] as $item):?>
                                                <div class="solution-card__list-select-package-change win-open">
                                                <input type="radio" name="select-package"  id="package-change-<?=$item?>"<?=$first ? ' checked': ' '; $first = false;?>>
                                                <label data-id="<?=$item?>" for="package-change-<?=$item?>"><span><span class="class"><?=$arResult['OFFERS'][$item]['PROPERTY_CPA_PACKET_PROPERTY_CO_CLASS_REF_VALUE']['NAME']?></span> <span class="complect"><?=$arResult['OFFERS'][$item]['PROPERTY_CPA_PACKET_PROPERTY_P_COMPLECT_VALUE']['NAME']?></span></span> <span class="balance">от <?=number_format($arResult['OFFERS'][$item]['PROPERTY_CPA_ABONPLATA_VALUE'][0]['PRICE'], 0, '.', ' ') ?> руб</span></label>
                                                <div class="solution-card__list-current-help">
                                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M7 0C5.61553 0 4.26215 0.410543 3.11101 1.17971C1.95987 1.94888 1.06266 3.04213 0.532846 4.32121C0.00303299 5.6003 -0.13559 7.00776 0.134506 8.36563C0.404603 9.7235 1.07129 10.9708 2.05026 11.9497C3.02922 12.9287 4.2765 13.5954 5.63437 13.8655C6.99224 14.1356 8.3997 13.997 9.67879 13.4672C10.9579 12.9373 12.0511 12.0401 12.8203 10.889C13.5895 9.73784 14 8.38447 14 7C14 6.08074 13.8189 5.17049 13.4672 4.32121C13.1154 3.47194 12.5998 2.70026 11.9497 2.05025C11.2997 1.40024 10.5281 0.884626 9.67879 0.532843C8.82951 0.18106 7.91925 0 7 0ZM7 11.2C6.86155 11.2 6.72622 11.1589 6.6111 11.082C6.49599 11.0051 6.40627 10.8958 6.35329 10.7679C6.3003 10.64 6.28644 10.4992 6.31345 10.3634C6.34046 10.2276 6.40713 10.1029 6.50503 10.005C6.60292 9.90712 6.72765 9.84046 6.86344 9.81345C6.99923 9.78644 7.13997 9.8003 7.26788 9.85328C7.39579 9.90626 7.50511 9.99598 7.58203 10.1111C7.65895 10.2262 7.7 10.3615 7.7 10.5C7.7 10.6856 7.62625 10.8637 7.49498 10.995C7.3637 11.1262 7.18565 11.2 7 11.2ZM7.7 7.588V8.4C7.7 8.58565 7.62625 8.7637 7.49498 8.89497C7.3637 9.02625 7.18565 9.1 7 9.1C6.81435 9.1 6.6363 9.02625 6.50503 8.89497C6.37375 8.7637 6.3 8.58565 6.3 8.4V7C6.3 6.81435 6.37375 6.6363 6.50503 6.50502C6.6363 6.37375 6.81435 6.3 7 6.3C7.20767 6.3 7.41068 6.23842 7.58335 6.12304C7.75602 6.00767 7.8906 5.84368 7.97008 5.65182C8.04955 5.45995 8.07034 5.24883 8.02983 5.04515C7.98931 4.84147 7.88931 4.65438 7.74246 4.50754C7.59562 4.36069 7.40853 4.26069 7.20485 4.22017C7.00117 4.17966 6.79005 4.20045 6.59818 4.27992C6.40632 4.3594 6.24233 4.49398 6.12696 4.66665C6.01158 4.83932 5.95 5.04233 5.95 5.25C5.95 5.43565 5.87625 5.6137 5.74498 5.74497C5.6137 5.87625 5.43565 5.95 5.25 5.95C5.06435 5.95 4.8863 5.87625 4.75503 5.74497C4.62375 5.6137 4.55 5.43565 4.55 5.25C4.54817 4.79521 4.67296 4.34889 4.91041 3.961C5.14785 3.57311 5.48858 3.25897 5.89443 3.05375C6.30029 2.84853 6.75526 2.76033 7.2084 2.79901C7.66155 2.8377 8.09498 3.00176 8.46017 3.27281C8.82536 3.54387 9.1079 3.91122 9.27615 4.33375C9.44441 4.75627 9.49173 5.21729 9.41283 5.66518C9.33393 6.11308 9.13191 6.53017 8.8294 6.86977C8.5269 7.20936 8.13583 7.45805 7.7 7.588Z" fill="#818181"></path>
                                                    </svg>
                                                </div>
                                                <div class="solution-card__list-current-help-window" style="display:none;">
                                                    <div class="solution-card__list-current-help-window-close">
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9.17564 7.98187L15.8076 1.36761C15.9387 1.21497 16.0072 1.01864 15.9994 0.817837C15.9916 0.617035 15.9082 0.426555 15.7657 0.28446C15.6232 0.142366 15.4322 0.0591225 15.2309 0.0513664C15.0295 0.0436103 14.8327 0.111912 14.6796 0.242623L8.04764 6.85688L1.41563 0.234644C1.26499 0.084404 1.06068 0 0.847635 0C0.634593 0 0.430278 0.084404 0.279635 0.234644C0.128992 0.384884 0.0443614 0.588653 0.0443614 0.801125C0.0443614 1.0136 0.128992 1.21737 0.279635 1.36761L6.91964 7.98187L0.279635 14.5961C0.195889 14.6677 0.127873 14.7557 0.0798545 14.8547C0.0318359 14.9536 0.00485175 15.0615 0.000596153 15.1713C-0.00365944 15.2812 0.0149049 15.3908 0.0551246 15.4932C0.0953442 15.5956 0.156351 15.6886 0.234315 15.7663C0.312278 15.8441 0.405516 15.9049 0.508176 15.945C0.610836 15.9851 0.720702 16.0036 0.830878 15.9994C0.941053 15.9952 1.04916 15.9682 1.14841 15.9204C1.24766 15.8725 1.33592 15.8046 1.40763 15.7211L8.04764 9.10685L14.6796 15.7211C14.8327 15.8518 15.0295 15.9201 15.2309 15.9124C15.4322 15.9046 15.6232 15.8214 15.7657 15.6793C15.9082 15.5372 15.9916 15.3467 15.9994 15.1459C16.0072 14.9451 15.9387 14.7488 15.8076 14.5961L9.17564 7.98187Z" fill="#D1DBE3"/>
                                                        </svg>
                                                    </div>
                                                    <div class="solution-card__list-current-help-window-title">
                                                        <span>Готовое решение </span><span class="name t-c-yellow-d"><?=$group['NAME']?></span>
                                                    </div>
                                                    <br>
                                                    <div class="solution-card__list-current-help-window-desc">
                                                        <?=$arResult['OFFERS'][$item]['PROPERTY_CPA_PACKET_PREVIEW_TEXT']?>
                                                    </div>
                                                </div>
                                            </div>
                                                <?endforeach;?>
                                        </div>
                                        <?endforeach;?>
                                    </div>
                                </div>
                            </div>
                            <div class="solutions-card__contract">
                                <div class="solutions-card__contract_title">
                                    Заключаем договор
                                </div>
                                <div class="solutions-card__contract_wrapper">
                                    <? foreach (current($arResult['OFFERS'])['PROPERTY_CPA_ABONPLATA_VALUE'] as $offer): ?>
                                        <div data-id='<?= $offer["ID"] ?>' class="contract__item no-active">
                                            <div class="contract__item_top">
                                                <div class="contract__item_title">
                                                    На <?= $offer['MONTH'] ?> месяца
                                                </div>
                                                <div class="contract__item_img">
                                                    <svg width="200" height="92" viewBox="0 0 200 92" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <g filter="url(#filter0_d)">
                                                            <path d="M170 25C170 22.2386 167.761 20 165 20H30V52H170V25Z"
                                                                  fill="#F4F4F4"/>
                                                        </g>
                                                        <path d="M170 52L153 52V74L170 52Z" fill="#DADADA"/>
                                                        <defs>
                                                            <filter id="filter0_d" x="0" y="0" width="200" height="92"
                                                                    filterUnits="userSpaceOnUse"
                                                                    color-interpolation-filters="sRGB">
                                                                <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                                                <feColorMatrix in="SourceAlpha" type="matrix"
                                                                               values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                                                                <feOffset dy="10"/>
                                                                <feGaussianBlur stdDeviation="15"/>
                                                                <feColorMatrix type="matrix"
                                                                               values="0 0 0 0 0 0 0 0 0 0.219333 0 0 0 0 0.783333 0 0 0 0.1 0"/>
                                                                <feBlend mode="normal" in2="BackgroundImageFix"
                                                                         result="effect1_dropShadow"/>
                                                                <feBlend mode="normal" in="SourceGraphic"
                                                                         in2="effect1_dropShadow" result="shape"/>
                                                            </filter>
                                                        </defs>
                                                    </svg>

                                                    <span><?= number_format($offer['PRICE'], 0, '.', ' ') ?> ₽</span>
                                                </div>
                                            </div>
                                        </div>
                                    <? endforeach; ?>
                                </div>
                            </div>
                            <div class="blue-button-wrapper">
                                <div class="blue-button location-href-pack"
                                     data-link="<?= current($arResult['OFFERS'])['PROPERTY_CPA_PACKET_DETAIL_PAGE_URL'] ?>">
                                    Заказать охрану для квартиры
                                </div>
                            </div>
                        </div>
                        <div class="solutions-card__substrate_bottom single-zayavka">
                            <p class="solutions-card__substrate_bottom-ptext">
                                Для охраны дома или коммерческой недвижимости, а так же для решения нестандартных задач
                            </p>

                            <div class="grey-border-button single-zayavka-btn" onclick="location.href='/zayavka/'">
                                Заполнить индивидуальную заявку
                            </div>
                        </div>
                    </div>
                <? endif; ?>
            </div>
        </div>
    </div>
</div>