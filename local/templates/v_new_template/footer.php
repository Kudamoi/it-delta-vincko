<div role="dialog" aria-live="polite" aria-label="cookieconsent" aria-describedby="cookieconsent:desc" class="cc-window cc-banner cc-type-info cc-theme-block cc-bottom cc-color-override--1488729520 <?=$_COOKIE["siteCookie"] ? "cc-invisible" : ""?>">
    <span id="cookieconsent:desc" class="cc-message">Этот сайт использует cookie для хранения данных. Продолжая использовать сайт, Вы даете свое согласие на работу с этими файлами.</span>
    <div class="cc-compliance">
        <a aria-label="dismiss cookie message" role="button" tabindex="0" class="cc-btn cc-dismiss">Ок</a>
    </div>
</div>

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
            <? $APPLICATION->IncludeComponent(
                "it-delta:iblock.content",
                "footer_documents",
                array(
                    "ACTIVE_DATE"        => "N",
                    "ADD_CACHE_STRING"   => "",
                    "CACHE_TIME"         => "0",
                    "CACHE_TYPE"         => "A",
                    "IBLOCK_ID"          => "55",
                    "ESTATE_IB_ID"       => "19",
                    "IBLOCK_TYPE"        => "documents",
                    "PAGE_ELEMENT_COUNT" => "10",
                    "RAND_ELEMENTS"      => "N",
                    "SORT_BY1"           => "ACTIVE_FROM",
                    "SORT_BY2"           => "SORT",
                    "SORT_ORDER1"        => "DESC",
                    "SORT_ORDER2"        => "ASC"
                )
            ); ?> 

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

