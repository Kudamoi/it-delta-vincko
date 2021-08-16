<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Заявка на индивидуальную охрану");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/zayavka_styles.css");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/zayavka_mobile.css");
?>


    <div class="wrap">
        <h1><?= $APPLICATION->ShowTitle(false); ?></h1>


        <div id="js-izayavka-wrap" class="izayavka__wrap">
            <div class="izayavka">
                <div class="izayavka__title">Данные заявки</div>
                <div class="izayavka__form">
                    <form method="POST" id="iz-form" action="/ajax/izayavka.php">
                        <div class="izayavka__form-block">
                            <label for="iz-type" class="izayavka__label">Тип охраны</label>
                            <select class="js-localstor izayavka__select" name="iz_type" id="iz-type">
                                <?
                                \Bitrix\Main\Loader::includeModule("iblock");
                                $ohranaList = \Bitrix\Iblock\ElementTable::getList(array(
                                    "order" => array("SORT" => "ASC"),
                                    "select" => array("ID", "NAME", "IBLOCK_ID"),
                                    "filter" => array("IBLOCK_ID" => 21, "ACTIVE" => "Y"),
                                    "group" => array(),
                                    "limit" => 1000,
                                    "offset" => 0,
                                    "cache" => array(
                                        "ttl" => 3600,
                                        "cache_joins" => true
                                    ),
                                ))->fetchAll();
                                ?>
                                <? foreach ($ohranaList as $aOhrana): ?>
                                    <option value="<?= $aOhrana["ID"] ?>"<? if ($_REQUEST["s"] == $aOhrana["ID"]): ?> selected="selected"<? endif; ?>><?= $aOhrana["NAME"] ?></option>
                                <? endforeach; ?>
                            </select>
                        </div>
                        <div class="izayavka__form-block">
                            <label for="iz-object" class="izayavka__label">Тип недвижимости</label>
                            <select class="js-localstor izayavka__select" name="iz_object" id="iz-object">
                                <?
                                \Bitrix\Main\Loader::includeModule("iblock");
                                $realestateList = \Bitrix\Iblock\ElementTable::getList(array(
                                    "order" => array("SORT" => "ASC"),
                                    "select" => array("ID", "NAME", "IBLOCK_ID"),
                                    "filter" => array("IBLOCK_ID" => 19, "ACTIVE" => "Y"),
                                    "group" => array(),
                                    "limit" => 1000,
                                    "offset" => 0,
                                    "cache" => array(
                                        "ttl" => 3600,
                                        "cache_joins" => true
                                    ),
                                ))->fetchAll();
                                ?>
                                <? foreach ($realestateList as $aEstate): ?>
                                    <option value="<?= $aEstate["ID"] ?>"<? if ($_REQUEST["object"] == $aEstate["ID"]): ?> selected="selected"<? endif; ?>><?= $aEstate["NAME"] ?></option>
                                <? endforeach; ?>
                            </select>
                        </div>
                        <div class="izayavka__form-block">
                            <label for="iz-city" class="izayavka__label">Населенный пункт</label>
                            <select class="js-localstor izayavka__select" name="iz_city" id="iz-city">
                                <?
                                \Bitrix\Main\Loader::includeModule("iblock");
                                $cityList = \Bitrix\Iblock\ElementTable::getList(array(
                                    "order" => array("SORT" => "ASC"),
                                    "select" => array("ID", "NAME", "IBLOCK_ID"),
                                    "filter" => array("IBLOCK_ID" => 20, "ACTIVE" => "Y"),
                                    "group" => array(),
                                    "limit" => 1000,
                                    "offset" => 0,
                                    "cache" => array(
                                        "ttl" => 3600,
                                        "cache_joins" => true
                                    ),
                                ))->fetchAll();
                                ?>
                                <option>Выберите город</option>
                                <? foreach ($cityList as $aCity): ?>
                                    <option value="<?= $aCity["ID"] ?>"<? if ($_REQUEST["city"] == $aCity["ID"]): ?> selected="selected"<? endif; ?>><?= $aCity["NAME"] ?></option>
                                <? endforeach; ?>
                            </select>
                        </div>
                        <div class="izayavka__form-block">
                            <label for="iz-comment" class="izayavka__label">Комментарий</label>
                            <textarea id="iz-comment" class="js-localstor izayavka__textarea" name="iz_comment"
                                      placeholder="Например: необходимо обеспечить охрану и пожарную безопасность коммерческого помещения в г.Суздаль"></textarea>
                        </div>
                        <div class="izayavka__chop">
                            <div class="izayavka__title">Охранные организации</div>
                            <div class="izayavka__chop-description">Вы можете выбрать одну или несколько охранных
                                компаний, работающих в вашем городе и добавить их в заявку. Мы совместно с сотрудниками
                                каждой из компаний подготовим индивидуальные предложения персонально для вас.
                            </div>
                            <div class="clear"></div>
                            <a href="/zayavka/choplist/" class="izayavka__chop-link inline-block">Перейти в список</a>
                            <div class="clear"></div>
                            <div class="izayavka__chop-list">
                                <? if (empty($_REQUEST["chop"])) { ?>
                                    <div class="izayavka__chop-count">Организации не выбраны</div>
                                <? } else { ?>
                                    <? /*<?foreach ($_REQUEST["chop"] as $k => $rchop):?>*/ ?>
                                    <? global $arChopFilter;
                                    $arChopFilter["ID"] = $_REQUEST["chop"];
                                    $APPLICATION->IncludeComponent(
                                        "vincko:news.list",
                                        "chopzayavkalist",
                                        array(
                                            "ACTIVE_DATE_FORMAT" => "",
                                            "ADD_SECTIONS_CHAIN" => "N",
                                            "AJAX_MODE" => "N",
                                            "AJAX_OPTION_ADDITIONAL" => "",
                                            "AJAX_OPTION_HISTORY" => "N",
                                            "AJAX_OPTION_JUMP" => "N",
                                            "AJAX_OPTION_STYLE" => "N",
                                            "CACHE_FILTER" => "N",
                                            "CACHE_GROUPS" => "Y",
                                            "CACHE_TIME" => "36000000",
                                            "CACHE_TYPE" => "A",
                                            "CHECK_DATES" => "Y",
                                            "DETAIL_URL" => "",
                                            "DISPLAY_BOTTOM_PAGER" => "Y",
                                            "DISPLAY_DATE" => "N",
                                            "DISPLAY_NAME" => "Y",
                                            "DISPLAY_PICTURE" => "N",
                                            "DISPLAY_PREVIEW_TEXT" => "Y",
                                            "DISPLAY_TOP_PAGER" => "N",
                                            "FIELD_CODE" => array("NAME", "PREVIEW_TEXT", ""),
                                            "FILTER_NAME" => "arChopFilter",
                                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                            "IBLOCK_ID" => "9",
                                            "IBLOCK_TYPE" => "chop",
                                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                            "INCLUDE_SUBSECTIONS" => "N",
                                            "MESSAGE_404" => "",
                                            "NEWS_COUNT" => "20",
                                            "PAGER_BASE_LINK_ENABLE" => "N",
                                            "PAGER_DESC_NUMBERING" => "N",
                                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                            "PAGER_SHOW_ALL" => "N",
                                            "PAGER_SHOW_ALWAYS" => "N",
                                            "PAGER_TEMPLATE" => ".default",
                                            "PAGER_TITLE" => "Новости",
                                            "PARENT_SECTION" => "",
                                            "PARENT_SECTION_CODE" => "",
                                            "PREVIEW_TRUNCATE_LEN" => "",
                                            "PROPERTY_CODE" => array("CH_SERVICES_PRICE", "CH_MONTAZHPODKL", "CH_SERVICES", "CITY_ID", "CHOP_ID", "CH_RATING_SUM", "CH_RATING_ZABOTA", "CH_RATING_SPASENIE", "CH_RATING_FINANCE", "CH_RATING_DOGOVOR", "CH_RATING_RECOMMEND", "CH_RATING_SERVICES", ""),
                                            "SET_BROWSER_TITLE" => "N",
                                            "SET_LAST_MODIFIED" => "N",
                                            "SET_META_DESCRIPTION" => "N",
                                            "SET_META_KEYWORDS" => "N",
                                            "SET_STATUS_404" => "N",
                                            "SET_TITLE" => "N",
                                            "SHOW_404" => "N",
                                            "SORT_BY1" => "SORT",
                                            "SORT_BY2" => "TIMESTAMP_X",
                                            "SORT_ORDER1" => "ASC",
                                            "SORT_ORDER2" => "DESC",
                                            "STRICT_SECTION_CHECK" => "N"
                                        )
                                    ); ?>
                                    <? /*<?endforeach;?>*/ ?>
                                <? } ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="izayavka__submit">
                <a href="#" class="izayavka__submit-link inline-block" id="iz-submit">Отправить</a>
            </div>
            <div id="js-hidden-loader" class="izayavka__hidden-loader"></div>
        </div>
        <div id="js-izayavka-ok" class="izayavka__ok">Ваша заявка принята!</div>
    </div>
<? $APPLICATION->IncludeFile('/include/vincko_callback.php'); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>