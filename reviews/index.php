<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

?>

<main class="main container">

    <? $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "EDIT_TEMPLATE" => "",
            "PATH" => "/include/reviews/top.php"
        )
    ); ?>

    <? $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "EDIT_TEMPLATE" => "",
            "PATH" => "/include/reviews/first_advantages.php"
        )
    ); ?>

    <div class="reviews__info-item--pseudo"><span>+</span></div>

    <? $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "EDIT_TEMPLATE" => "",
            "PATH" => "/include/reviews/second_advantages.php"
        )
    ); ?>

    <div class="reviews__info-item--pseudo"><span>=</span></div>

    <? $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "EDIT_TEMPLATE" => "",
            "PATH" => "/include/reviews/third_advantages.php"
        )
    ); ?>

    <?

    Loader::includeModule("highloadblock");

    $hlblock = HL\HighloadBlockTable::query()->addSelect('*')->where('NAME', 'ReviewsHL')->exec()->fetch();

    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();

    $rsData = $entity_data_class::getList(array(
        "select" => array("*"),
        "filter" => array("UF_CITY_ID" => $_COOKIE['selected_city'])
    ));
    $arrReviews = [];
    while ($arData = $rsData->Fetch()) {
        $arrReviews[] = $arData["ID"];
    }
    $reviewsFilter = array(
        "ID" => $arrReviews
    );
    ?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:highloadblock.list",
        "reviews",
        array(
            "BLOCK_ID" => "5",
            "FILTER_NAME" => "reviewsFilter",
            "DETAIL_URL" => "",
            "PAGEN_ID" => "page",
            "ROWS_PER_PAGE" => "5",
            "COMPONENT_TEMPLATE" => ".default",
            "SORT_FIELD" => "ID",
            "SORT_ORDER" => "DESC"
        )
    ); ?>

</main>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
