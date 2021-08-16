<div class="header__popup popup hidden">
	<div class="popup__wall"></div>
	<div class="header-popup__content popup__content">
		<div class="header-popup__close popup__close">
			<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M8.99926 8.00005L14.8713 2.12797C14.9874 1.99246 15.048 1.81816 15.0411 1.63989C15.0343 1.46162 14.9604 1.29251 14.8342 1.16636C14.7081 1.04021 14.5389 0.966307 14.3607 0.959421C14.1824 0.952535 14.0081 1.01317 13.8726 1.12922L8.00051 7.0013L2.12843 1.12213C1.99504 0.988752 1.81414 0.913818 1.62551 0.913818C1.43688 0.913818 1.25598 0.988752 1.12259 1.12213C0.989211 1.25552 0.914278 1.43642 0.914278 1.62505C0.914278 1.81368 0.989211 1.99458 1.12259 2.12797L7.00176 8.00005L1.12259 13.8721C1.04844 13.9356 0.988221 14.0138 0.945705 14.1017C0.903188 14.1895 0.879296 14.2853 0.875528 14.3828C0.87176 14.4804 0.888197 14.5776 0.923808 14.6685C0.959419 14.7594 1.01344 14.842 1.08247 14.911C1.1515 14.98 1.23405 15.0341 1.32495 15.0697C1.41584 15.1053 1.51312 15.1217 1.61067 15.1179C1.70822 15.1142 1.80394 15.0903 1.89182 15.0478C1.9797 15.0053 2.05784 14.945 2.12134 14.8709L8.00051 8.9988L13.8726 14.8709C14.0081 14.9869 14.1824 15.0476 14.3607 15.0407C14.5389 15.0338 14.7081 14.9599 14.8342 14.8337C14.9604 14.7076 15.0343 14.5385 15.0411 14.3602C15.048 14.1819 14.9874 14.0076 14.8713 13.8721L8.99926 8.00005Z"
					  fill="#005DFF"/>
			</svg>
		</div>
		<h2 class="header-popup__title">Совсем скоро!</h2>
		<picture class="header-popup__image">
			<source type="image/webp" srcset="/local/templates/v_new_template/img/header/header-popup.webp">
			<source type="image/png" srcset="/local/templates/v_new_template/img/header/header-popup.png">
			<img src="/local/templates/v_new_template/img/header/header-popup.png" alt="header-popup" loading="lazy">
		</picture>
		<p>Программа лояльности для Вас вот-вот будет запущена
			и это отличные новости!</p>
		<p> Совсем скоро Вы сможете совершать покупки на платформе за бонусы. А пока исследуйте отзывы, изучите
			рейтинг и узнайте о всех преимуществах работы с vincko:</p>
		<button class="blue-button header-popup__button">Понятно</button>
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

