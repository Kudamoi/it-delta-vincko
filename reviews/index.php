<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<main class="main container">

    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "EDIT_TEMPLATE" => "",
            "PATH" => "/include/reviews/top.php"
        )
    );?>

    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "EDIT_TEMPLATE" => "",
            "PATH" => "/include/reviews/first_advantages.php"
        )
    );?>

    <div class="reviews__info-item--pseudo"><span>+</span></div>

    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "EDIT_TEMPLATE" => "",
            "PATH" => "/include/reviews/second_advantages.php"
        )
    );?>

    <div class="reviews__info-item--pseudo"><span>=</span></div>

    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "EDIT_TEMPLATE" => "",
            "PATH" => "/include/reviews/third_advantages.php"
        )
    );?>

    <?
    $dbchops = CIBlockElement::GetList(
        array(),
        array("IBLOCK_ID" => 9, "ACTIVE" => "Y", "PROPERTY_CITY_ID" => $_COOKIE["selected_city"]),
        false,
        false,
        array("ID")
    );
    
    while($chop = $dbchops->GetNext()){
        $dbreview = CIBlockElement::GetList(
            array(),
            array("IBLOCK_ID" => 16, "ACTIVE" => "Y", "PROPERTY_R_CHOP" => $chop["ID"]),
            false,
            false,
            array("ID")
        );

        while($review = $dbreview->GetNext()) {
            $arrReviews[] = $review["ID"];
        }
    }
    $reviewsFilter = array(
        "ID" => $arrReviews
    );

    $APPLICATION->IncludeComponent(
        "it-delta:iblock.content",
        "reviews_raiting",
        Array(
            "ACTIVE_DATE" => "N",
            "ADD_CACHE_STRING" => "",
            "CACHE_TIME" => "0",
            "CACHE_TYPE" => "A",
            "FILTER_NAME" => "reviewsFilter",
            "IBLOCK_ID" => "16",
            "IBLOCK_TYPE" => "reviews",
            "PAGE_ELEMENT_COUNT" => "16",
            "RAND_ELEMENTS" => "N",
            "SORT_BY1" => "SORT",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "ASC",
            "SORT_ORDER2" => "ASC"
        )
    );?>

</main>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
