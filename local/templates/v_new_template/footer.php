<footer class="footer">
    <div class="container">
        <div class="footer__top">
            <div class="footer__top-logo">
                <a href="/">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/logo_footer.php"
                        )

                    ); ?>
                </a>
            </div>
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/include/top-service_footer.php"
                )
            ); ?>
        </div>
        <div class="footer__bottom">
            <nav class="footer__bottom-navigation">
                <ul class="footer__bottom-up footer__bottom-up--to-hide">
                    <li><a href="/">Главная</a></li>
                    <li><a href="/reviews/">Рейтинг охранных компаний</a></li>
                    <li><a href="">Отзывы об охранных компаниях</a></li>
                    <li class="footer__file"><a href="">Политика конфиденциальности</a></li>
                </ul>
                <ul class="footer__bottom-up footer__bottom-up--to-hide">
                    <li><a href="">Покупка за бонусы</a></li>
                    <li><a href="">Страхование недвижимости</a></li>
                    <li><a href="">Гарантии при заказе услуг</a></li>
                    <li class="footer__file"><a href="">Пользовательское соглашение</a></li>

                </ul>
                <ul class="footer__bottom-up footer__bottom-up--to-hide">
                    <li><a href="">Готовые решения</a></li>
                    <li><a href="">Индивидуальная заявка</a></li>
                    <li><a href="">О компании vincko</a></li>
                    <li class="footer__file"><a href="">Публичная оферта</a></li>

                </ul>


                <div class="footer__bottom-down">
                    <a href="/reviews/">Читайте отзывы о <span class="blue">vincko:</span></a>
                </div>

                <div class="footer__bottom-down">
                    <a href="https://yandex.ru/">
                        <svg width="40" height="12" viewBox="0 0 40 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.87658 1.39238H4.10473C2.68859 1.39238 1.94488 2.13352 1.94488 3.22932C1.94488 4.47372 2.45985 5.0519 3.51791 5.79242L4.39036 6.39995L1.87542 10.2961H0L2.25985 6.81454C0.95807 5.85174 0.228739 4.91828 0.228739 3.33297C0.228739 1.34805 1.55686 0 4.09036 0H6.6053V10.2961H4.87658V1.39238Z"
                                  fill="#FC3F1D"/>
                            <path d="M20.6371 2.84473H15.6742V3.4816C15.6742 5.30355 15.5599 7.65935 14.9593 8.90375H14.4312V12.0001H16.0048V10.2961H19.8203V12.0001H21.3951V8.90375H20.6371V2.84473ZM18.9353 8.90125H16.5323C17.0042 7.77736 17.1311 5.74562 17.1311 4.45689V4.2371H18.9335L18.9353 8.90125Z"
                                  fill="black"/>
                            <path d="M12.0142 5.79245H9.74055V2.84473H8.03818V10.2961H9.74055V7.18545H12.0142V10.2961H13.7159V2.84473H12.0142V5.79245Z"
                                  fill="black"/>
                            <path d="M38.3551 4.08886C39.0138 4.08886 39.6569 4.3255 40 4.54778V3.04926C39.6407 2.84196 39.0132 2.69336 38.1695 2.69336C35.9959 2.69336 34.8659 4.30864 34.8659 6.57516C34.8659 9.06396 35.9671 10.4414 38.2407 10.4414C39.0275 10.4414 39.585 10.2934 40 9.98243V8.54634C39.5713 8.85854 39.0563 9.05022 38.3413 9.05022C37.1252 9.05022 36.6252 8.07244 36.6252 6.53208C36.6252 4.91679 37.2401 4.08761 38.3551 4.08761"
                                  fill="black"/>
                            <path d="M34.6381 2.84399H32.9219L30.519 6.28123V2.84399H28.8172V10.296H30.519V6.63713L33.0363 10.296H34.9668L32.2351 6.28123L34.6381 2.84399Z"
                                  fill="black"/>
                            <path d="M24.8705 2.69586C22.7969 2.69586 21.8101 4.34049 21.8101 6.59202C21.8101 9.18509 23.04 10.4438 25.2142 10.4438C26.301 10.4438 27.1016 10.1479 27.6022 9.79199V8.35591C27.0729 8.72617 26.1867 9.05209 25.3567 9.05209C24.1131 9.05209 23.6406 8.44457 23.5693 7.20017H27.6735V6.26359C27.6735 3.67115 26.5723 2.69336 24.8705 2.69336V2.69586ZM25.9436 5.89333H23.5693C23.6125 4.707 24.0268 4.08636 24.8424 4.08636C25.6861 4.08636 25.9436 4.8119 25.9436 5.74535V5.89333Z"
                                  fill="black"/>
                        </svg>

                    </a>

                    <a href="https://www.google.com/">
                        <svg width="40" height="13" viewBox="0 0 40 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.5182 5.2506H5.00072V6.57775H8.20456C8.04631 8.4387 6.48233 9.23238 5.00614 9.23238C3.11746 9.23238 1.46932 7.76123 1.46932 5.69916C1.46932 3.69041 3.04038 2.14343 5.01031 2.14343C6.53008 2.14343 7.4256 3.10253 7.4256 3.10253L8.36428 2.14026C8.36428 2.14026 7.15955 0.8125 4.96235 0.8125C2.16446 0.8125 0 3.15028 0 5.67542C0 8.14978 2.03602 10.5625 5.03366 10.5625C7.6701 10.5625 9.6 8.77447 9.6 6.13037C9.6 5.57262 9.5182 5.25019 9.5182 5.25019V5.2506Z"
                                  fill="#4885ED"/>
                            <path d="M13.603 4.0625C11.7371 4.0625 10.4 5.5505 10.4 7.28584C10.4 9.04687 11.697 10.5625 13.6248 10.5625C15.3701 10.5625 16.8 9.20179 16.8 7.32373C16.8 5.17108 15.1368 4.0625 13.603 4.0625ZM13.6215 5.33906C14.539 5.33906 15.4085 6.09577 15.4085 7.31503C15.4085 8.50846 14.5427 9.28671 13.6173 9.28671C12.6004 9.28671 11.7982 8.45594 11.7982 7.30554C11.7982 6.17983 12.5905 5.33906 13.6215 5.33906Z"
                                  fill="#DB3236"/>
                            <path d="M20.803 4.0625C18.9372 4.0625 17.6 5.5505 17.6 7.28584C17.6 9.04687 18.897 10.5625 20.8249 10.5625C22.5702 10.5625 24 9.20179 24 7.32373C24.0001 5.17108 22.3368 4.0625 20.803 4.0625ZM20.8215 5.33906C21.7392 5.33906 22.6086 6.09577 22.6086 7.31503C22.6086 8.50846 21.7428 9.28671 20.8173 9.28671C19.8005 9.28671 18.9983 8.45594 18.9983 7.30554C18.9983 6.17983 19.7905 5.33906 20.8215 5.33906Z"
                                  fill="#F4C20D"/>
                            <path d="M28.0026 4.0625C26.2095 4.0625 24.8 5.51356 24.8 7.14227C24.8 8.9975 26.434 10.2277 27.9717 10.2277C28.9224 10.2277 29.4279 9.87906 29.8012 9.47882V10.0866C29.8012 11.1499 29.1024 11.7868 28.0477 11.7868C27.0287 11.7868 26.5177 11.0868 26.3401 10.6895L25.058 11.1848C25.5128 12.0734 26.4284 13 28.0584 13C29.8412 13 31.2 11.9624 31.2 9.78634V4.24787H29.8014V4.76999C29.3713 4.3418 28.7831 4.06257 28.0026 4.0625ZM28.1324 5.2708C29.0115 5.2708 29.9143 5.96442 29.9143 7.14884C29.9143 8.35281 29.0135 9.01632 28.113 9.01632C27.157 9.01632 26.2675 8.29914 26.2675 7.16028C26.2675 5.97695 27.1913 5.2708 28.1324 5.2708Z"
                                  fill="#4885ED"/>
                            <path d="M36.8551 4.0625C35.0856 4.0625 33.6 5.37222 33.6 7.30476C33.6 9.34972 35.2559 10.5625 37.0251 10.5625C38.5016 10.5625 39.4078 9.811 39.9485 9.13771L38.7421 8.39093C38.4291 8.84288 37.9058 9.28463 37.0324 9.28463C36.0513 9.28463 35.6003 8.78485 35.3208 8.30068L40 6.49439L39.7571 5.96503C39.3051 4.9284 38.2505 4.06264 36.8552 4.06264L36.8551 4.0625ZM36.916 5.31113C37.5536 5.31113 38.0125 5.6265 38.2074 6.00459L35.0826 7.21972C34.9478 6.27897 35.9058 5.31113 36.916 5.31113Z"
                                  fill="#DB3236"/>
                            <path d="M32 10.5625H32.8V0H32V10.5625Z" fill="#3CBA54"/>
                        </svg>
                    </a>

                    <a href="https://2gis.ru">

                        <svg width="30" height="12" viewBox="0 0 30 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 6.00005C12 5.26194 11.8601 4.55792 11.6163 3.90492C11.5518 6.0543 9.36725 7.71842 8.08467 8.81967H11.2951C11.7438 7.97882 12 7.01954 12 6.00005ZM9.67914 1.26732C8.66268 0.475909 7.38821 0 6.00013 0C2.68637 0 0 2.68645 0 6.00005C0 9.31363 2.68637 12 6.00013 12C7.51754 12 8.89922 11.4323 9.95584 10.5031H5.61195L5.59871 9.22744C8.21605 6.95204 9.82053 5.41323 9.82053 3.92688C9.82053 3.37448 9.61012 2.6774 8.66326 2.6774C7.91348 2.6774 7.19019 3.11173 7.32165 4.92657H5.79612C5.41463 2.82236 6.55889 1.15183 8.74195 1.15183C9.08041 1.15183 9.39348 1.19224 9.67914 1.26732Z"
                                  fill="#A3C626"/>
                            <path d="M18.4901 4.79007H20.0041C20.0558 3.71061 19.6678 2 17.1705 2C15.3329 2 14 3.0313 14 5.17826C14 5.46941 14.0128 6.97353 14.0128 7.90753C14.0128 10.2368 15.7341 10.7461 17.1833 10.7461C18.0503 10.7461 19.3055 10.5641 19.8877 9.96975V6.25783H17.0409V7.60435H18.3091V9.24199C17.3515 9.54517 15.6045 9.66656 15.6045 7.60435V5.17826C15.6045 3.73471 16.3163 3.23741 17.1055 3.23741C17.9209 3.23741 18.4901 3.6256 18.4901 4.79007ZM29.7515 8.39266C29.8161 5.06916 25.7531 6.17282 25.7917 4.31698C25.8045 3.66209 26.2575 3.23741 26.9953 3.23741C27.7846 3.23741 28.2501 3.67413 28.2372 4.8145H29.7254C29.7643 3.78323 29.5055 2.02442 27.0471 2.02442C25.52 2.02442 24.265 2.72811 24.2389 4.29281C24.1743 7.48286 28.2633 6.43978 28.1987 8.36857C28.1726 9.15698 27.5643 9.50869 26.8787 9.50869C26.0766 9.50869 25.4295 9.072 25.5589 7.76194H24.0576C23.8895 9.49665 24.7048 10.7341 26.8658 10.7341C28.6903 10.7341 29.7254 9.7877 29.7515 8.39266ZM22.9154 10.6246H21.3887V2.13353H22.9154V10.6246ZM22.9154 10.6246H21.3887V2.13353H22.9154V10.6246Z"
                                  fill="#434242"/>
                        </svg>

                    </a>
                </div>

                <div class="footer__bottom-down">
                    <a href="">
                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.002 18.0409C6.542 18.0409 6.252 18.0279 5.292 17.9859C4.54337 17.9613 3.80443 17.8091 3.107 17.5359C2.51018 17.3036 1.96818 16.9498 1.51542 16.4969C1.06266 16.0439 0.709035 15.5018 0.477001 14.9049C0.214307 14.2049 0.0726187 13.4654 0.0580008 12.7179C0.0020008 11.7599 0.00200081 11.4459 0.00200081 9.00488C0.00200081 6.53788 0.0150008 6.24988 0.0580008 5.29488C0.0729384 4.5484 0.214622 3.80989 0.477001 3.11088C0.708768 2.51322 1.06263 1.97046 1.51599 1.51727C1.96936 1.06408 2.51225 0.710423 3.11 0.478883C3.80864 0.215085 4.54735 0.073027 5.294 0.0588827C6.249 0.00488271 6.563 0.00488281 9.002 0.00488281C11.482 0.00488281 11.767 0.0178827 12.712 0.0588827C13.46 0.0728827 14.202 0.214883 14.902 0.478883C15.4996 0.710691 16.0424 1.06444 16.4957 1.5176C16.949 1.97075 17.303 2.51338 17.535 3.11088C17.802 3.82088 17.945 4.57088 17.956 5.32788C18.012 6.28588 18.012 6.59888 18.012 9.03888C18.012 11.4789 17.998 11.7989 17.956 12.7459C17.9411 13.4941 17.799 14.2343 17.536 14.9349C17.3034 15.5322 16.9491 16.0746 16.4956 16.5277C16.0422 16.9808 15.4995 17.3347 14.902 17.5669C14.202 17.8289 13.463 17.9709 12.716 17.9859C11.761 18.0409 11.448 18.0409 9.002 18.0409ZM8.968 1.58788C6.522 1.58788 6.268 1.59988 5.313 1.64288C4.74265 1.65034 4.1778 1.75553 3.643 1.95388C3.25293 2.1034 2.89852 2.33299 2.60262 2.62786C2.30671 2.92274 2.07588 3.27634 1.925 3.66588C1.725 4.20588 1.62 4.77688 1.614 5.35288C1.561 6.32188 1.561 6.57588 1.561 9.00488C1.561 11.4049 1.57 11.6959 1.614 12.6589C1.623 13.2289 1.728 13.7939 1.925 14.3289C2.231 15.1159 2.855 15.7379 3.644 16.0399C4.17811 16.2395 4.74285 16.3447 5.313 16.3509C6.281 16.4069 6.536 16.4069 8.968 16.4069C11.421 16.4069 11.675 16.3949 12.622 16.3509C13.1924 16.344 13.7573 16.2388 14.292 16.0399C14.68 15.8892 15.0324 15.6595 15.3268 15.3653C15.6212 15.071 15.8511 14.7188 16.002 14.3309C16.202 13.7909 16.307 13.2189 16.313 12.6429H16.324C16.367 11.6869 16.367 11.4319 16.367 8.98888C16.367 6.54588 16.356 6.28888 16.313 5.33388C16.304 4.76434 16.1988 4.20041 16.002 3.66588C15.8515 3.27743 15.6217 2.92459 15.3273 2.62983C15.0329 2.33508 14.6803 2.10487 14.292 1.95388C13.757 1.75388 13.192 1.64988 12.622 1.64288C11.655 1.58788 11.402 1.58788 8.968 1.58788ZM9.002 13.6239C8.08757 13.6245 7.19351 13.3539 6.43289 12.8463C5.67227 12.3387 5.07926 11.617 4.72886 10.7723C4.37847 9.92771 4.28643 8.99813 4.46439 8.10119C4.64235 7.20424 5.08231 6.38022 5.72863 5.73334C6.37495 5.08647 7.19859 4.64579 8.09538 4.46706C8.99217 4.28832 9.92182 4.37955 10.7668 4.72921C11.6117 5.07888 12.334 5.67126 12.8422 6.43144C13.3504 7.19162 13.6218 8.08545 13.622 8.99988C13.6204 10.2251 13.1333 11.3997 12.2673 12.2664C11.4014 13.1331 10.2272 13.6212 9.002 13.6239ZM9.002 5.99788C8.40866 5.99788 7.82864 6.17383 7.33529 6.50347C6.84194 6.83312 6.45742 7.30165 6.23036 7.84983C6.0033 8.39801 5.94389 9.00121 6.05964 9.58315C6.1754 10.1651 6.46112 10.6996 6.88068 11.1192C7.30024 11.5388 7.83479 11.8245 8.41673 11.9402C8.99867 12.056 9.60187 11.9966 10.1501 11.7695C10.6982 11.5425 11.1668 11.1579 11.4964 10.6646C11.8261 10.1712 12.002 9.59123 12.002 8.99788C12.0002 8.2028 11.6835 7.44081 11.1213 6.8786C10.5591 6.3164 9.79708 5.99973 9.002 5.99788ZM13.802 5.28488C13.6604 5.28436 13.5204 5.25595 13.3898 5.20129C13.2592 5.14663 13.1406 5.06679 13.0409 4.96632C12.8395 4.7634 12.7269 4.48879 12.728 4.20288C12.7291 3.91698 12.8437 3.64321 13.0466 3.44179C13.2495 3.24038 13.5241 3.12782 13.81 3.12888C14.0959 3.12994 14.3697 3.24454 14.5711 3.44745C14.7725 3.65036 14.8851 3.92498 14.884 4.21088C14.8829 4.49679 14.7683 4.77056 14.5654 4.97197C14.3625 5.17339 14.0879 5.28594 13.802 5.28488Z"
                                  fill="url(#paint0_linear)"/>
                            <defs>
                                <linearGradient id="paint0_linear" x1="18.0001" y1="20.9999" x2="2.50005" y2="5.99988"
                                                gradientUnits="userSpaceOnUse">
                                    <stop offset="0" stop-color="#FF9900"/>
                                    <stop offset="1" stop-color="#953B9D"/>
                                </linearGradient>
                            </defs>
                        </svg>

                    </a>

                    <a href="">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M2.32721 2.32721C2.66477 1.98964 3.12261 1.8 3.6 1.8H14.4C14.8774 1.8 15.3352 1.98964 15.6728 2.32721C16.0104 2.66477 16.2 3.12261 16.2 3.6V14.4C16.2 14.8774 16.0104 15.3352 15.6728 15.6728C15.3352 16.0104 14.8774 16.2 14.4 16.2H11.9606V10.4961H13.748C13.748 10.4961 13.9164 9.447 13.9974 8.2991H11.9709V6.8041C11.9709 6.5792 12.2615 6.2789 12.5495 6.2789H14V4H12.0261C9.28708 4 9.2947 6.1029 9.29613 6.496C9.29616 6.50411 9.29618 6.51148 9.29618 6.5181V8.3082H8V10.4961H9.29618V16.2H3.6C3.12261 16.2 2.66477 16.0104 2.32721 15.6728C1.98964 15.3352 1.8 14.8774 1.8 14.4V3.6C1.8 3.12261 1.98964 2.66477 2.32721 2.32721ZM14.4 0H3.6C2.64522 0 1.72955 0.379285 1.05442 1.05442C0.379285 1.72955 0 2.64522 0 3.6V14.4C0 15.3548 0.379285 16.2705 1.05442 16.9456C1.72955 17.6207 2.64522 18 3.6 18H14.4C15.3548 18 16.2705 17.6207 16.9456 16.9456C17.6207 16.2705 18 15.3548 18 14.4V3.6C18 2.64522 17.6207 1.72955 16.9456 1.05442C16.2705 0.379285 15.3548 0 14.4 0Z"
                                  fill="#337CD1"/>
                        </svg>
                    </a>
                </div>
            </nav>
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/include/bottom_footer.php"
                )
            ); ?>
        </div>

        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/footer_signature.php"
            )
        ); ?>
    </div>
</footer>
<!--<footer class="footer container">-->
<!--    <div class="footer__top">-->
<!--        <div class="footer__top-logo">-->
<!--            -->
<!--        </div>-->
<!--        --><? // $APPLICATION->IncludeComponent(
//            "bitrix:main.include",
//            "",
//            array(
//                "AREA_FILE_SHOW" => "file",
//                "AREA_FILE_SUFFIX" => "inc",
//                "EDIT_TEMPLATE" => "",
//                "PATH" => "/include/top-service_footer.php"
//            )
//        ); ?>
<!--    </div>-->
<!--    <div class="footer__bottom">-->
<!--        --><? //$APPLICATION->IncludeComponent(
//            "bitrix:menu",
//            "desc_bottom",
//            Array(
//                "ALLOW_MULTI_SELECT" => "N",
//                "CHILD_MENU_TYPE" => "left",
//                "DELAY" => "N",
//                "MAX_LEVEL" => "1",
//                "MENU_CACHE_GET_VARS" => array(""),
//                "MENU_CACHE_TIME" => "3600",
//                "MENU_CACHE_TYPE" => "N",
//                "MENU_CACHE_USE_GROUPS" => "Y",
//                "ROOT_MENU_TYPE" => "desc_bottom",
//                "USE_EXT" => "N"
//            )
//        );?>
<!---->
<!--        --><? // $APPLICATION->IncludeComponent(
//            "bitrix:main.include",
//            "",
//            array(
//                "AREA_FILE_SHOW" => "file",
//                "AREA_FILE_SUFFIX" => "inc",
//                "EDIT_TEMPLATE" => "",
//                "PATH" => "/include/bottom_footer.php"
//            )
//        ); ?>
<!--    </div>-->
<!--    --><? // $APPLICATION->IncludeComponent(
//        "bitrix:main.include",
//        "",
//        array(
//            "AREA_FILE_SHOW" => "file",
//            "AREA_FILE_SUFFIX" => "inc",
//            "EDIT_TEMPLATE" => "",
//            "PATH" => "/include/footer_signature.php"
//        )
//    ); ?>
<!--</footer>-->
</body>

</html>

