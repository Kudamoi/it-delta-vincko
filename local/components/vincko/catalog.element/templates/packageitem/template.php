<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
//$this->addExternalJS(SITE_TEMPLATE_PATH . "/js/equipitem.js");

$this->addExternalJS(SITE_TEMPLATE_PATH . "/js/basket.js");
if ($_GET['itd'] == 'y') {
    echo '<pre>';
    print_r($_COOKIE);
    print_r($arResult);
    echo '</pre>';
    die();
}

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);
//$this->addExternalCss('/bitrix/css/main/bootstrap.css');

$templateLibrary = array('popup', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES'])) {
    $templateLibrary[] = 'currency';
    $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
    'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES' => $currencyList,
    'ITEM' => array(
        'ID' => $arResult['ID'],
        'IBLOCK_ID' => $arResult['IBLOCK_ID'],
        'OFFERS_SELECTED' => $arResult['OFFERS_SELECTED'],
        'JS_OFFERS' => $arResult['JS_OFFERS']
    )
);
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
    'ID' => $mainId,
    'DISCOUNT_PERCENT_ID' => $mainId . '_dsc_pict',
    'STICKER_ID' => $mainId . '_sticker',
    'BIG_SLIDER_ID' => $mainId . '_big_slider',
    'BIG_IMG_CONT_ID' => $mainId . '_bigimg_cont',
    'SLIDER_CONT_ID' => $mainId . '_slider_cont',
    'OLD_PRICE_ID' => $mainId . '_old_price',
    'PRICE_ID' => $mainId . '_price',
    'DISCOUNT_PRICE_ID' => $mainId . '_price_discount',
    'PRICE_TOTAL' => $mainId . '_price_total',
    'SLIDER_CONT_OF_ID' => $mainId . '_slider_cont_',
    'QUANTITY_ID' => $mainId . '_quantity',
    'QUANTITY_DOWN_ID' => $mainId . '_quant_down',
    'QUANTITY_UP_ID' => $mainId . '_quant_up',
    'QUANTITY_MEASURE' => $mainId . '_quant_measure',
    'QUANTITY_LIMIT' => $mainId . '_quant_limit',
    'BUY_LINK' => $mainId . '_buy_link',
    'ADD_BASKET_LINK' => $mainId . '_add_basket_link',
    'BASKET_ACTIONS_ID' => $mainId . '_basket_actions',
    'NOT_AVAILABLE_MESS' => $mainId . '_not_avail',
    'COMPARE_LINK' => $mainId . '_compare_link',
    'TREE_ID' => $mainId . '_skudiv',
    'DISPLAY_PROP_DIV' => $mainId . '_sku_prop',
    'DISPLAY_MAIN_PROP_DIV' => $mainId . '_main_sku_prop',
    'OFFER_GROUP' => $mainId . '_set_group_',
    'BASKET_PROP_DIV' => $mainId . '_basket_prop',
    'SUBSCRIBE_LINK' => $mainId . '_subscribe',
    'TABS_ID' => $mainId . '_tabs',
    'TAB_CONTAINERS_ID' => $mainId . '_tab_containers',
    'SMALL_CARD_PANEL_ID' => $mainId . '_small_card_panel',
    'TABS_PANEL_ID' => $mainId . '_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
    : $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
    : $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
    : $arResult['NAME'];

$haveOffers = !empty($arResult['OFFERS']);
if ($haveOffers) {
    $actualItem = isset($arResult['OFFERS'][$arResult['OFFERS_SELECTED']])
        ? $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]
        : reset($arResult['OFFERS']);
    $showSliderControls = false;

    foreach ($arResult['OFFERS'] as $offer) {
        if ($offer['MORE_PHOTO_COUNT'] > 1) {
            $showSliderControls = true;
            break;
        }
    }
} else {
    $actualItem = $arResult;
    $showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

$showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['PRODUCT']['SUBSCRIBE'] === 'Y' || $haveOffers);

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');
$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$positionClassMap = array(
    'left' => 'product-item-label-left',
    'center' => 'product-item-label-center',
    'right' => 'product-item-label-right',
    'bottom' => 'product-item-label-bottom',
    'middle' => 'product-item-label-middle',
    'top' => 'product-item-label-top'
);

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION'])) {
    foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos) {
        $discountPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION'])) {
    foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos) {
        $labelPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}
?>
<? $currentComplectIndex = isset($_COOKIE['selected_complect_id']) && array_key_exists($_COOKIE['selected_complect_id'], $arResult['ALL_LIST_COMPLECTS_IN_PACKAGE']) ? $_COOKIE['selected_complect_id'] : array_key_first($arResult['ALL_LIST_COMPLECTS_IN_PACKAGE']); ?>
<main>
    <section class="solutions">
        <div class="container">
            <div class="solutions__top">
                <div class="solutions__top_left">
                    <div class="solutions__top_left-title">
                        <h1>Готовое решение</h1>
                        <h2><?= $arResult['PACKAGE_GROUP']['NAME'] ?></h2>
                    </div>
                    <div class="solutions__top_left-items">
                        <? if (isset($arResult["PACKAGE_GROUP_CHARACTERISTICS"])): ?>
                            <? foreach ($arResult['PACKAGE_GROUP_CHARACTERISTICS'] as $ch): ?>
                                <div class="solutions__top_left-item">
                                    <div class="solutions__top_left-item_icon">
                                        <img src="<?= $ch['PREVIEW_PICTURE'] ?>" alt="<?= $ch['NAME'] ?>">
                                    </div>
                                    <div class="solutions__top_left-item_text">
                                        <?= $ch['NAME'] ?>
                                    </div>
                                </div>
                            <? endforeach; ?>
                        <? endif; ?>
                    </div>
                </div>
                <div class="solutions__top_right" style="background-color: #8BABFE;"></div>
            </div>
        </div>
            <div id="solutions__center" class="solutions__center">
                <div class="container rating-center">
                    <div class="solutions__center_title">
                        Измените параметры согласно вашим пожеланиям <br>
                        <span><?= $arResult['PACKAGE_GROUP']['NAME'] ?></span>
                    </div>
                    <div class="solutions__center_wrapper">
                        <!--no-subscribe no-circles  -->
                        <div class="solutions-card card-one no-subscribe ">
                            <div id="eq-plus" class="solutions-card__icon-plus">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/solutions/solutions-card__icon-plus.svg"
                                     alt="img">
                                <p>Оборудование</p>
                            </div>
                            <div class="solutions-card__substrate">
                                <div class="solutions-card__substrate_top">
                                    <div class="solutions-card__substrate_top-title">
                                        Оборудование
                                    </div>
                                    <? if (!$arResult['PROPERTIES']['P_COMPLECT_WITH']['VALUE']): ?>
                                    <div id="closed-card-eq" class="closed-card">

                                        <div class="closed-card__icon">
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/solutions/closed-icon.svg"
                                                 alt="img">
                                        </div>
                                    </div>
                                    <?endif;?>
                                </div>
                                <div class="solutions-card__center ">
                                    <div class="solutions-card__top">
                                        <div class="solutions-card__top_img">
                                            <img src="<?= $arResult['PACKAGES_CLASSES'][$arResult['CURRENT_PACKAGE_CLASS']]['PICTURE']['src'] ?>"
                                                 alt="<?= $arResult['PACKAGES_CLASSES'][$arResult['CURRENT_PACKAGE_CLASS']]['NAME'] ?>">
                                        </div>
                                        <div class="solutions-card__top_text">
                                            <div class="h4 solutions-card__top_text-title"><?= $arResult['ALL_LIST_COMPLECTS_IN_PACKAGE'][$currentComplectIndex]['NAME'] ?></div>
                                            <div class="solutions-card__top_text-subtitle">
                                                <div class="solutions-card__subscribe">
                                                    <a href="#subscribe" class="solutions-card__subscribe-in">Подписка
                                                        включена
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9.00033 0.666748C4.40033 0.666748 0.666992 4.40008 0.666992 9.00008C0.666992 13.6001 4.40033 17.3334 9.00033 17.3334C13.6003 17.3334 17.3337 13.6001 17.3337 9.00008C17.3337 4.40008 13.6003 0.666748 9.00033 0.666748ZM9.75866 14.1251C9.70042 14.1822 9.62671 14.2209 9.54665 14.2365C9.4666 14.2521 9.38372 14.2439 9.30831 14.2128C9.23289 14.1818 9.16824 14.1293 9.12239 14.0618C9.07653 13.9944 9.05147 13.915 9.05033 13.8334V13.1667H9.00033C7.93366 13.1667 6.86699 12.7584 6.05033 11.9501C5.48452 11.3829 5.09403 10.6647 4.92556 9.88151C4.75709 9.09827 4.81776 8.28308 5.10033 7.53341C5.25866 7.10841 5.81699 7.00008 6.13366 7.32508C6.31699 7.50841 6.35866 7.77508 6.27533 8.00842C5.89199 9.04175 6.10866 10.2417 6.94199 11.0751C7.52533 11.6584 8.29199 11.9334 9.05866 11.9167V11.1334C9.05866 10.7584 9.50866 10.5751 9.76699 10.8417L11.117 12.1917C11.2837 12.3584 11.2837 12.6167 11.117 12.7834L9.75866 14.1251ZM11.867 10.6834C11.7809 10.5948 11.7218 10.4834 11.6967 10.3624C11.6716 10.2413 11.6815 10.1157 11.7253 10.0001C12.1087 8.96675 11.892 7.76675 11.0587 6.93342C10.4753 6.35008 9.70866 6.06675 8.95033 6.08342V6.86675C8.95033 7.24175 8.50033 7.42508 8.24199 7.15841L6.88366 5.81675C6.71699 5.65008 6.71699 5.39175 6.88366 5.22508L8.23366 3.87508C8.2919 3.81798 8.36561 3.77923 8.44567 3.76363C8.52572 3.74803 8.6086 3.75626 8.68401 3.78732C8.75943 3.81837 8.82407 3.87088 8.86993 3.93833C8.91579 4.00577 8.94085 4.0852 8.94199 4.16675V4.84175C10.0253 4.82508 11.117 5.21675 11.942 6.05008C12.5078 6.61727 12.8983 7.33542 13.0668 8.11865C13.2352 8.90189 13.1746 9.71708 12.892 10.4667C12.7337 10.9001 12.1837 11.0084 11.867 10.6834Z"
                                                                  fill="#3CBA54"/>
                                                        </svg>
                                                    </a>

                                                    <a href="#subscribe" class="solutions-card__subscribe-out">
                                                        Подписка исключена
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M8 0C3.584 0 0 3.584 0 8C0 12.416 3.584 16 8 16C12.416 16 16 12.416 16 8C16 3.584 12.416 0 8 0ZM8.728 12.92C8.67209 12.9748 8.60133 13.012 8.52447 13.027C8.44762 13.042 8.36806 13.0341 8.29566 13.0043C8.22326 12.9744 8.1612 12.924 8.11718 12.8593C8.07315 12.7945 8.0491 12.7183 8.048 12.64V12H8C6.976 12 5.952 11.608 5.168 10.832C4.62482 10.2875 4.24996 9.59808 4.08823 8.84617C3.92649 8.09426 3.98474 7.31168 4.256 6.592C4.408 6.184 4.944 6.08 5.248 6.392C5.424 6.568 5.464 6.824 5.384 7.048C5.016 8.04 5.224 9.192 6.024 9.992C6.584 10.552 7.32 10.816 8.056 10.8V10.048C8.056 9.688 8.488 9.512 8.736 9.768L10.032 11.064C10.192 11.224 10.192 11.472 10.032 11.632L8.728 12.92ZM10.752 9.616C10.6693 9.5309 10.6126 9.42399 10.5885 9.3078C10.5644 9.19161 10.574 9.07096 10.616 8.96C10.984 7.968 10.776 6.816 9.976 6.016C9.416 5.456 8.68 5.184 7.952 5.2V5.952C7.952 6.312 7.52 6.488 7.272 6.232L5.968 4.944C5.808 4.784 5.808 4.536 5.968 4.376L7.264 3.08C7.31991 3.02518 7.39068 2.98798 7.46753 2.973C7.54438 2.95803 7.62394 2.96594 7.69634 2.99575C7.76874 3.02556 7.8308 3.07596 7.87482 3.14071C7.91885 3.20546 7.9429 3.28171 7.944 3.36V4.008C8.984 3.992 10.032 4.368 10.824 5.168C11.3672 5.7125 11.742 6.40192 11.9038 7.15383C12.0655 7.90574 12.0073 8.68832 11.736 9.408C11.584 9.824 11.056 9.928 10.752 9.616Z"
                                                                  fill="#FF5252"/>
                                                        </svg>
                                                    </a>


                                                </div>
                                                <? if (count($arResult['ALL_LIST_COMPLECTS_IN_PACKAGE']) > 1): ?>

                                                <div class="select">
                                                    <form action="#">
                                                        <input class="select__input" type="hidden"
                                                               name="solutions-card__top-select">
                                                        <div class="select__head">Выбрать другой комплект</div>
                                                        <div class="select__list" style="display: none;">
                                                            <div class="select__list-item">
                                                                <!-- Выбрано -->
                                                                <div class="select__list-item_title">Выбрано</div>
                                                                <div class="select__list-item_policy">
                                                                    <div class="select__list-item_policy-top">
                                                                <span class="font-weight policy-title">
                                                                    Комплект “ <span
                                                                            class="font-weight"><?= $arResult['ALL_LIST_COMPLECTS_IN_PACKAGE'][$currentComplectIndex]['NAME'] ?></span> ”
                                                                </span>
                                                                        <span>
                                                                    <?= $arResult['ALL_LIST_COMPLECTS_IN_PACKAGE'][$currentComplectIndex]['PRICES_INFO']['RESULT_PRICE']['DISCOUNT_PRICE'] ?> руб
                                                                </span>
                                                                    </div>
                                                                </div>


                                                                <!-- Все комплекты -->
                                                                <div class="select__list-item_title color-grey">Все
                                                                    комплекты
                                                                </div>
                                                                <? foreach ($arResult['ALL_LIST_COMPLECTS_IN_PACKAGE'] as $key => $item): ?>
                                                                    <? if ($key == $currentComplectIndex) {
                                                                        continue;
                                                                    } ?>
                                                                    <div class="select__list-item_policy">
                                                                        <div class="select__list-item_policy-top">
                                                                            <span data-slug="<?= $arResult['CODE'] ?>" onclick="BX.setCookie('selected_complect_id',<?= $item['ID'] ?>, {expires: 86400, path: '/'});"
                                                                                  class="js-refresh-packageitem-data-ajax policy-title">Комплект“<span
                                                                                        class="p"><?= $item['NAME'] ?></span>”</span>
                                                                            <span class="opacity"><?= $item['PRICES_INFO']['RESULT_PRICE']['DISCOUNT_PRICE'] ?> руб</span>
                                                                        </div>
                                                                    </div>
                                                                <? endforeach; ?>

                                                            </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <? endif; ?>
                                        </div>


                                    </div>
                                </div>
                                <div class="solutions-card__subtitle">
                                    Выберите Вариант

                                    <div class="products__info">
                                        <div class="products__info-sign">
                                            <picture><img
                                                        src="<?= SITE_TEMPLATE_PATH ?>/img/insurance/product-info.svg"
                                                        alt="info"></picture>
                                        </div>
                                        <div class="products__text-container">
                                            <div class="products__info-text">
                                                <div class="h4"> Принимается на страхование следующее движимое
                                                    (домашнее) имущество:
                                                </div>

                                                <p>под домашним имуществом, принимаемым на страхование в рамках
                                                    настоящего договора, понимается движимое имущество, не имеющие
                                                    особой (культурной, художественной, исторической и т.п.)
                                                    ценности: мебель, предметы интерьера, ковры; теле-, аудио- и
                                                    видеоаппаратура; бытовая и вычислительная техника; осветительные
                                                    приборы (люстры, светильники и т.п.); посуда; одежда и
                                                    обувь.</p>

                                                <div class="h4">Не принимается на страхование следующее движимое
                                                    (домашнее) имущество:
                                                </div>

                                                <p>изделия из меха и кожи, изделия из драгоценных металлов или из
                                                    драгоценных камней; книги, коллекции марок, монет, рисунков,
                                                    картин, скульптур, иные произведения искусства; предметы
                                                    религиозного культа; технические носители информации; средства
                                                    мототранспорта, квадрои гидроциклы, снегоходы, мопеды и лодки;
                                                    малогабаритные строительные, сельскохозяйственные машины;
                                                    садовый инвентарь, строительные инструменты, а также иное
                                                    имущество в соответствии с п. 3.5 Правил № 100</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="solutions-card__circles">
                                    <? foreach ($arResult['PACKAGES_CLASSES'] as $key => $class): ?>
                                        <? if (!empty($arResult['PACKAGES_SLUGS'][$key])): ?>
                                            <div data-slug="<?= $arResult['PACKAGES_SLUGS'][$key]['SLUG'] ?>"
                                                 class="js-refresh-packageitem-data-ajax solutions-card__circles_item <?= $arResult['CURRENT_PACKAGE_CLASS'] == $key ? 'show' : 'hide' ?>">
                                                <div class="solutions-card__circles_item-icon">
                                                    <img src="<?= $class['ICON']['src'] ?>" alt="<?= $class['NAME'] ?>">
                                                </div>
                                                <div class="solutions-card__circles_item-text">
                                                    <?= $class['NAME'] ?>
                                                </div>
                                            </div>
                                        <? endif; ?>
                                    <? endforeach; ?>
                                </div>
                                <div class="solutions-card__info">
                                    <? if (!empty($arResult["ALL_LIST_COMPLECTS_IN_PACKAGE"][$currentComplectIndex]['PROPERTY_CO_CHARACTERISTICS_REF_VALUE'])): ?>
                                        <? foreach ($arResult["ALL_LIST_COMPLECTS_IN_PACKAGE"][$currentComplectIndex]['PROPERTY_CO_CHARACTERISTICS_REF_VALUE'] as $key => $el): ?>
                                            <div class="solutions-card__info_item">
                                                <div class="solutions-card__info_item-icon">
                                                    <img src="<?= $arResult['COMPLECTS_CHARACTERISTICS'][$el]['PREVIEW_PICTURE'] ?>"
                                                         alt="<?= $arResult['COMPLECTS_CHARACTERISTICS'][$el]['NAME'] ?>">
                                                </div>
                                                <div class="solutions-card__info_item-text"><?= $arResult['COMPLECTS_CHARACTERISTICS'][$el]['NAME'] ?></div>
                                            </div>
                                        <? endforeach; ?>
                                    <? endif; ?>
                                    <div class="solutions-card__info-bottom">
                                        <div class="solutions-card__info-tech">
                                            <a href="#gotovoe__reshenie-main">Технические характеристики</a>
                                        </div>

                                        <div class="solutions-card__info-switch">
                                            <div class="solutions-card__info-open">Развернуть
                                                <svg width="8" height="5" viewBox="0 0 8 5" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3.60396 4.82011L0.164193 1.04856C-0.0547314 0.808645 -0.0547314 0.419663 0.164193 0.179864C0.382921 -0.059955 0.737679 -0.059955 0.95639 0.179864L4.00006 3.5171L7.04362 0.179961C7.26244 -0.0598577 7.61716 -0.0598576 7.83589 0.179961C8.0547 0.41978 8.0547 0.808743 7.83589 1.04866L4.39607 4.8202C4.28665 4.94011 4.1434 5 4.00007 5C3.85668 5 3.71332 4.94 3.60396 4.82011Z"
                                                          fill="#A0A0A0"/>
                                                </svg>

                                            </div>

                                            <div class="solutions-card__info-close">Свернуть
                                                <svg width="9" height="5" viewBox="0 0 9 5" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.89604 0.179893L8.33581 3.95144C8.55473 4.19135 8.55473 4.58034 8.33581 4.82014C8.11708 5.05995 7.76232 5.05995 7.54361 4.82014L4.49994 1.4829L1.45638 4.82004C1.23756 5.05986 0.882842 5.05986 0.664113 4.82004C0.445296 4.58022 0.445296 4.19126 0.664113 3.95134L4.10393 0.179796C4.21335 0.059887 4.3566 4.59895e-08 4.49992 4.76986e-08C4.64332 4.94086e-08 4.78668 0.0600033 4.89604 0.179893Z"
                                                          fill="#A0A0A0"/>
                                                </svg>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="solutions-card__substrate_bottom">
                                <p class="solutions-card__substrate_bottom-text">
                                    Всего <span>32 000 ₽</span>
                                </p>
                                <div id="eq-price"
                                     data-eq-price="<?= $arResult['ALL_LIST_COMPLECTS_IN_PACKAGE'][$currentComplectIndex]['PRICES_INFO']['RESULT_PRICE']['BASE_PRICE'] ?>"
                                     data-eq-disc-price="<?= $arResult['ALL_LIST_COMPLECTS_IN_PACKAGE'][$currentComplectIndex]['PRICES_INFO']['RESULT_PRICE']['DISCOUNT_PRICE'] ?>"
                                     data-eq-id="<?= $currentComplectIndex ?>"
                                     class="solutions-card__substrate_bottom-price">
                                    <?= $arResult['ALL_LIST_COMPLECTS_IN_PACKAGE'][$currentComplectIndex]['PRICES_INFO']['RESULT_PRICE']['DISCOUNT_PRICE'] ?>
                                    ₽
                                </div>
                                <div class="solutions-card__substrate_bottom-icon">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/solutions/present-icon.svg" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?
                    $currentSecureCompanyIndex = isset($_COOKIE['selected_company_id']) && array_key_exists($_COOKIE['selected_company_id'], $arResult['ALL_LIST_COMPANY_CITY']) ? $_COOKIE['selected_company_id'] : array_key_first($arResult['ALL_LIST_COMPANY_CITY']);
                    ?>
                    <div class="solutions-card card-two">
                        <div id="subscription-fee-plus" class="solutions-card__icon-plus">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/solutions/solutions-card__icon-plus.svg"
                                 alt="img">
                            <p>Охранные услуги</p>
                        </div>
                        <div class="solutions-card__substrate">
                            <div class="solutions-card__substrate_top">
                                <div class="solutions-card__substrate_top-title">
                                    Охранные услуги
                                </div>
                                <? if (!$arResult['PROPERTIES']['P_ABONENTPLATA_WITH']['VALUE']): ?>
                                <div id="closed-card-company" class="closed-card">

                                    <div class="closed-card__icon">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/solutions/closed-icon.svg"
                                             alt="img">
                                    </div>
                                </div>
                                <?endif;?>
                            </div>
                            <div class="solutions-card__center">
                                <div class="solutions-card__top">
                                    <div class="solutions-card__top_img flex-centr">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/solutions/solutions-card__top_img2.svg"
                                             alt="img">
                                        <span>10,0</span>
                                    </div>
                                    <div class="solutions-card__top_text">
                                        <div class="h4 solutions-card__top_text-title">
                                            <?= $arResult['ALL_LIST_COMPANY_CITY'][$currentSecureCompanyIndex]['NAME'] ?>
                                        </div>
                                        <div class="itemRating-open__left_deal">
                                            <a href="#guarantee">Безопасная сделка</a>
                                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/rating/deal-icon.svg" alt="img">
                                            <div class="deal_modal modal-mini" style="display: none;">
                                                <div class="modal-mini__title">
                                                    <span>Безопасная сделка</span> при покупке услуг охраны
                                                </div>
                                                <div class="modal-mini__text">
                                                    <span>vincko:</span> предоставляет дополнительные гарантии при
                                                    покупке услуг
                                                    <span class="green">одобренных</span>
                                                    охранных компаний на платформе
                                                    <a href="#guarantee">Подробнее</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="solutions-card__top_text-subtitle">
                                            <div class="select">
                                                <form action="#">
                                                    <input class="select__input" type="hidden"
                                                           name="solutions-card__top-select">
                                                    <div class="select__head">Выбрать другую компанию</div>
                                                    <div class="select__list" style="display: none;">
                                                        <div class="select__input-search">
                                                            <div class="select__input-search_icon">
                                                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/solutions/search-icon.svg"
                                                                     alt="img">
                                                            </div>
                                                            <input type="text" placeholder="Поиск" name="search">
                                                        </div>
                                                        <div class="select__list-item">

                                                            <!-- Все компании -->
                                                            <div class="select__list-item_title color-grey">Все
                                                                компании
                                                            </div>
                                                            <? foreach ($arResult['ALL_LIST_COMPANY_CITY'] as $key => $item): ?>
                                                                <div data-slug="<?=$arResult['CODE']?>" id="selected_company"
                                                                     onclick="BX.setCookie('selected_company_id',<?= $item['ID'] ?>, {expires: 86400, path: '/'});"
                                                                     class="js-refresh-packageitem-data-ajax select__item">
                                                                    <div class="select__item_text">
                                                                        <?= $item['NAME'] ?>
                                                                    </div>
                                                                    <div class="select__item_num">4</div>
                                                                    <span class="select__item_bg"
                                                                          style="width: 70%;"></span>
                                                                </div>
                                                            <? endforeach; ?>

                                                        </div>
                                                        <div class="box-shadow"></div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="solutions-card__contract">
                                    <div class="solutions-card__contract_title">
                                        Заключаем договор
                                    </div>
                                    <? $currentSubcriptionFeeIndex = isset($_COOKIE['selected_subscription_fee_id']) && array_key_exists($_COOKIE['selected_subscription_fee_id'], $arResult['ALL_LIST_COMPANY_CITY'][$currentSecureCompanyIndex]['SUBSCRIPTION_FEE']) ? $_COOKIE['selected_subscription_fee_id'] : array_key_last($arResult['ALL_LIST_COMPANY_CITY'][$currentSecureCompanyIndex]['SUBSCRIPTION_FEE']); ?>
                                    <div class="solutions-card__contract_wrapper">
                                        <? foreach ($arResult['ALL_LIST_COMPANY_CITY'][$currentSecureCompanyIndex]['SUBSCRIPTION_FEE'] as $key => $item): ?>
                                            <div data-slug="<?=$arResult['CODE']?>" onclick="BX.setCookie('selected_subscription_fee_id',<?= $item['ID'] ?>, {expires: 86400, path: '/'});"
                                                 class="js-refresh-packageitem-data-ajax contract__item <?= isset($_COOKIE['selected_subscription_fee_id']) && array_key_exists($_COOKIE['selected_subscription_fee_id'], $arResult['ALL_LIST_COMPANY_CITY'][$currentSecureCompanyIndex]['SUBSCRIPTION_FEE']) ? (intval($item['ID']) === intval($_COOKIE['selected_subscription_fee_id']) ? 'active' : 'no-active') : (intval($item['PROPERTY_APTP_MESYAC_VALUE']) === 12 ? 'active' : 'no-active') ?>">
                                                <div class="contract__item_top">
                                                    <div class="contract__item_title">
                                                        На <?= $item['PROPERTY_APTP_MESYAC_VALUE'] ?>
                                                        месяц<?= in_array($item['PROPERTY_APTP_MESYAC_VALUE'], array(2,3, 4,22,23,24)) ? 'а' : 'ев' ?>
                                                    </div>
                                                    <div class="contract__item_img">
                                                        <? if (in_array($item['PROPERTY_APTP_MESYAC_VALUE'], array(3, 4))): ?>
                                                            <svg width="200" height="92" viewBox="0 0 200 92"
                                                                 fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <g filter="url(#filter0_d)">
                                                                    <path d="M170 25C170 22.2386 167.761 20 165 20H30V52H170V25Z"
                                                                          fill="#F4F4F4"/>
                                                                </g>
                                                                <path d="M170 52L153 52V74L170 52Z" fill="#DADADA"/>
                                                                <defs>
                                                                    <filter id="filter0_d" x="0" y="0" width="200"
                                                                            height="92" filterUnits="userSpaceOnUse"
                                                                            color-interpolation-filters="sRGB">
                                                                        <feFlood flood-opacity="0"
                                                                                 result="BackgroundImageFix"/>
                                                                        <feColorMatrix in="SourceAlpha" type="matrix"
                                                                                       values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                                                                        <feOffset dy="10"/>
                                                                        <feGaussianBlur stdDeviation="15"/>
                                                                        <feColorMatrix type="matrix"
                                                                                       values="0 0 0 0 0 0 0 0 0 0.219333 0 0 0 0 0.783333 0 0 0 0.1 0"/>
                                                                        <feBlend mode="normal" in2="BackgroundImageFix"
                                                                                 result="effect1_dropShadow"/>
                                                                        <feBlend mode="normal" in="SourceGraphic"
                                                                                 in2="effect1_dropShadow"
                                                                                 result="shape"/>
                                                                    </filter>
                                                                </defs>
                                                            </svg>
                                                        <? elseif (in_array($item['PROPERTY_APTP_MESYAC_VALUE'], array(6, 8))): ?>
                                                            <svg width="200" height="92" viewBox="0 0 200 92"
                                                                 fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <g filter="url(#filter0_d)">
                                                                    <path d="M170 25C170 22.2386 167.761 20 165 20H30V52H170V25Z"
                                                                          fill="#DDE8FF"/>
                                                                </g>
                                                                <path d="M170 52L153 52V74L170 52Z" fill="#93B6FF"/>
                                                                <defs>
                                                                    <filter id="filter0_d" x="0" y="0" width="200"
                                                                            height="92" filterUnits="userSpaceOnUse"
                                                                            color-interpolation-filters="sRGB">
                                                                        <feFlood flood-opacity="0"
                                                                                 result="BackgroundImageFix"/>
                                                                        <feColorMatrix in="SourceAlpha" type="matrix"
                                                                                       values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                                                                        <feOffset dy="10"/>
                                                                        <feGaussianBlur stdDeviation="15"/>
                                                                        <feColorMatrix type="matrix"
                                                                                       values="0 0 0 0 0 0 0 0 0 0.219333 0 0 0 0 0.783333 0 0 0 0.1 0"/>
                                                                        <feBlend mode="normal" in2="BackgroundImageFix"
                                                                                 result="effect1_dropShadow"/>
                                                                        <feBlend mode="normal" in="SourceGraphic"
                                                                                 in2="effect1_dropShadow"
                                                                                 result="shape"/>
                                                                    </filter>
                                                                </defs>
                                                            </svg>
                                                        <? else: ?>
                                                            <svg width="200" height="92" viewBox="0 0 200 92"
                                                                 fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <g filter="url(#filter0_d)">
                                                                    <path d="M170 25C170 22.2386 167.761 20 165 20H30V52H170V25Z"
                                                                          fill="#FEE74C"/>
                                                                </g>
                                                                <path d="M170 52L153 52V74L170 52Z" fill="#983333"/>
                                                                <defs>
                                                                    <filter id="filter0_d" x="0" y="0" width="200"
                                                                            height="92" filterUnits="userSpaceOnUse"
                                                                            color-interpolation-filters="sRGB">
                                                                        <feFlood flood-opacity="0"
                                                                                 result="BackgroundImageFix"/>
                                                                        <feColorMatrix in="SourceAlpha" type="matrix"
                                                                                       values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                                                                        <feOffset dy="10"/>
                                                                        <feGaussianBlur stdDeviation="15"/>
                                                                        <feColorMatrix type="matrix"
                                                                                       values="0 0 0 0 0 0 0 0 0 0.219333 0 0 0 0 0.783333 0 0 0 0.1 0"/>
                                                                        <feBlend mode="normal" in2="BackgroundImageFix"
                                                                                 result="effect1_dropShadow"/>
                                                                        <feBlend mode="normal" in="SourceGraphic"
                                                                                 in2="effect1_dropShadow"
                                                                                 result="shape"/>
                                                                    </filter>
                                                                </defs>
                                                            </svg>
                                                        <? endif; ?>
                                                        <span><?= $item['PRICES_INFO']['RESULT_PRICE']['DISCOUNT_PRICE'] ?> ₽</span>
                                                    </div>
                                                </div>
                                                <div class="contract__item_bottom">
                                                    <div class="contract__item_bottom-row">
                                                        <span>В подарок:</span>
                                                    </div>
                                                    <div class="contract__item_bottom-row">
                                                        <span>Страхование имущества на</span><span class="present">600 000
                                                    руб.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        <? endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="solutions-card__substrate_bottom">
                                <p class="solutions-card__substrate_bottom-text">
                                    Всего <span>32 000 ₽</span>
                                </p>
                                <div id="subscription-fee-price"
                                     data-subscription-fee-price="<?= $arResult['ALL_LIST_COMPANY_CITY'][$currentSecureCompanyIndex]['SUBSCRIPTION_FEE'][$currentSubcriptionFeeIndex]['PRICES_INFO']['RESULT_PRICE']['BASE_PRICE'] ?>"
                                     data-subscription-fee-disc-price="<?= $arResult['ALL_LIST_COMPANY_CITY'][$currentSecureCompanyIndex]['SUBSCRIPTION_FEE'][$currentSubcriptionFeeIndex]['PRICES_INFO']['RESULT_PRICE']['DISCOUNT_PRICE'] ?>"
                                     data-subscription-fee-id="<?= $currentSubcriptionFeeIndex ?>"
                                     class="solutions-card__substrate_bottom-price">
                                    <?= $arResult['ALL_LIST_COMPANY_CITY'][$currentSecureCompanyIndex]['SUBSCRIPTION_FEE'][$currentSubcriptionFeeIndex]['PRICES_INFO']['RESULT_PRICE']['DISCOUNT_PRICE'] ?>
                                    ₽
                                </div>
                                <div class="solutions-card__substrate_bottom-icon">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/solutions/present-icon.svg" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>
                    <? $currentPolicyIndex = isset($_COOKIE['selected_policy_id']) ? $_COOKIE['selected_policy_id'] : array_key_first($arResult['ALL_INSURANCE_LIST'][array_key_first($arResult['ALL_INSURANCE_LIST'])]['ITEMS']); ?>
                    <div class="solutions-card card-three">
                        <div id="policy-plus" class="solutions-card__icon-plus">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/solutions/solutions-card__icon-plus.svg"
                                 alt="img">
                            <p>Страхование</p>
                        </div>
                        <div class="solutions-card__substrate ">
                            <div class="solutions-card__substrate_top">
                                <div class="solutions-card__substrate_top-title">
                                    Страхование
                                </div>
                                <? if (!$arResult['PROPERTIES']['P_STRAHOVKA_WITH']['VALUE']): ?>
                                <div id="closed-card-ins" class="closed-card">
                                    <div class="closed-card__icon">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/solutions/closed-icon.svg"
                                             alt="img">
                                    </div>
                                </div>
                                <?endif;?>
                            </div>
                            <div class="solutions-card__center  products__item">
                                <div class="solutions-card__top">
                                    <div class="solutions-card__top_img flex-centr">
                                        <? foreach ($arResult['ALL_INSURANCE_LIST'] as $key => $item): ?>
                                            <img src="<?= $item['ITEMS'][$currentPolicyIndex]['PICTURE']['src'] ?>"
                                                 alt="<?= $item['ITEMS'][$currentPolicyIndex]['NAME'] ?>">
                                        <? endforeach; ?>
                                    </div>
                                    <div class="solutions-card__top_text">
                                        <div class="h4 solutions-card__top_text-title">
                                            <? foreach ($arResult['ALL_INSURANCE_LIST'] as $key => $item): ?>
                                                <? foreach ($item['ITEMS'] as $index => $el): ?>
                                                    <? if ($el['ID'] == $currentPolicyIndex): ?>
                                                        <?= $item['NAME'] ?>
                                                    <? endif; ?>
                                                <? endforeach; ?>
                                            <? endforeach; ?>
                                        </div>
                                        <div class="solutions-card__top-subtitle">
                                            <? foreach ($arResult['ALL_INSURANCE_LIST'] as $key => $item): ?>
                                                <? if (!empty($item['ITEMS'][$currentPolicyIndex]['NAME'])): ?>
                                                    <?= $item['ITEMS'][$currentPolicyIndex]['NAME'] ?>
                                                <? endif; ?>
                                            <? endforeach; ?>
                                        </div>
                                        <div class="solutions-card__top_text-subtitle">
                                            <div class="select">
                                                <form action="#">
                                                    <input class="select__input" type="hidden"
                                                           name="solutions-card__top_text-subtitle">
                                                    <div class="select__head">Выбрать другой полис</div>
                                                    <div class="select__list" style="display: none;">
                                                        <div class="select__input-search">
                                                            <div class="select__input-search_icon">
                                                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/solutions/search-icon.svg"
                                                                     alt="img">
                                                            </div>
                                                            <input type="text" placeholder="Поиск" name="search">
                                                        </div>
                                                        <div class="select__list-item">
                                                            <!-- Выбрано -->
                                                            <div class="select__list-item_title">Выбрано</div>
                                                            <? foreach ($arResult['ALL_INSURANCE_LIST'] as $key => $item): ?>
                                                                <? if (!empty($item['ITEMS'][$currentPolicyIndex]['NAME'])): ?>
                                                                    <div class="select__list-item_policy">
                                                                        <div class="select__list-item_policy-top">
                                                                <span class="font-weight policy-title">
                                                                    Полис “ <span
                                                                            class="font-weight"><?= $item['ITEMS'][$currentPolicyIndex]['NAME'] ?></span> ”
                                                                </span>
                                                                            <span>
                                                                    <?= $item['ITEMS'][$currentPolicyIndex]['PRICES_INFO']['RESULT_PRICE']['DISCOUNT_PRICE'] ?> руб
                                                                </span>
                                                                        </div>
                                                                        <div class="select__list-item_policy-bottom">
                                                                <span class="policy">
                                                                    СК “<?= $item['NAME'] ?>”
                                                                </span>
                                                                            <span>
                                                                    Сумма выплаты
                                                                </span>
                                                                            <span>
                                                                    <?= $item['ITEMS'][$currentPolicyIndex]['PROPERTY_MAX_PRICE_VALUE'] ?> руб
                                                                </span>
                                                                        </div>
                                                                    </div>

                                                                <? endif; ?>
                                                            <? endforeach; ?>


                                                            <!-- Все полисы -->
                                                            <div class="select__list-item_title color-grey">Все
                                                                полисы
                                                            </div>
                                                            <? foreach ($arResult['ALL_INSURANCE_LIST'] as $key => $item): ?>
                                                                <? foreach ($item['ITEMS'] as $index => $el): ?>
                                                                    <? if ($index == $currentPolicyIndex) {
                                                                        continue;
                                                                    } ?>
                                                                    <div data-slug="<?=$arResult['CODE']?>" onclick="BX.setCookie('selected_policy_id',<?= $el['ID'] ?>, {expires: 86400, path: '/'});"
                                                                         class="js-refresh-packageitem-data-ajax select__list-item_policy">
                                                                        <div class="select__list-item_policy-top">
                                                                <span class="policy-title">
                                                                    Полис “ <span class="p"><?= $el['NAME'] ?></span> ”
                                                                </span>
                                                                            <span class="opacity">
                                                                    <?= $el['PRICES_INFO']['RESULT_PRICE']['DISCOUNT_PRICE'] ?> руб
                                                                </span>
                                                                        </div>
                                                                        <div class="select__list-item_policy-bottom">
                                                                <span class="policy">
                                                                    СК “<?= $item['NAME'] ?>”
                                                                </span>
                                                                            <span>
                                                                    Сумма выплаты
                                                                </span>
                                                                            <span class="opacity">
                                                                    <?= $el['PROPERTY_MAX_PRICE_VALUE'] ?> руб
                                                                </span>
                                                                        </div>
                                                                    </div>
                                                                <? endforeach; ?>
                                                            <? endforeach; ?>
                                                        </div>
                                                        <div class="box-shadow"></div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="products__max-payment">
                                    <div class="products__container">
                                        <div class="products__gray">Максимальная выплата</div>
                                        <div class="products__info">
                                            <div class="products__info-sign">
                                                <picture><img
                                                            src="<?= SITE_TEMPLATE_PATH ?>/img/insurance/product-info.svg"
                                                            alt="info"></picture>
                                            </div>
                                            <div class="products__text-container">
                                                <? foreach ($arResult['ALL_INSURANCE_LIST'] as $key => $item): ?>
                                                    <? if (!empty($item['ITEMS'][$currentPolicyIndex]['PROPERTY_MAX_PRICE_TEXT_VALUE']['TEXT'])): ?>
                                                        <div class="products__info-text"><?= $item['ITEMS'][$currentPolicyIndex]['PROPERTY_MAX_PRICE_TEXT_VALUE']['TEXT'] ?>
                                                        </div>
                                                    <? endif ?>
                                                <? endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <? $currentPolicyMaxPrice = 0; ?>
                                    <? foreach ($arResult['ALL_INSURANCE_LIST'] as $key => $item): ?>
                                        <? if (!empty($item['ITEMS'][$currentPolicyIndex]['PROPERTY_MAX_PRICE_VALUE'])): ?>
                                            <? $currentPolicyMaxPrice = $item['ITEMS'][$currentPolicyIndex]['PROPERTY_MAX_PRICE_VALUE']; ?>
                                            <div class="products__m-price"><?= $item['ITEMS'][$currentPolicyIndex]['PROPERTY_MAX_PRICE_VALUE'] ?>
                                                руб
                                            </div>
                                        <? endif ?>
                                    <? endforeach; ?>
                                </div>

                                <div class="products__payment">
                                    <div class="products__gray">
                                        Выплаты по основным пунктам:
                                    </div>
                                    <? foreach ($arResult['ALL_INSURANCE_LIST'] as $key => $item): ?>
                                        <? foreach ($item['ITEMS'][$currentPolicyIndex]['PROPERTY_PAYMENT_OPTIONS_VALUE'] as $index => $el): ?>
                                            <div class="products__payment-item <?= !empty($item['ITEMS'][$currentPolicyIndex]['PROPERTY_PAYMENT_PRICE_VALUE'][$index]) && $item['ITEMS'][$currentPolicyIndex]['PROPERTY_PAYMENT_PRICE_VALUE'][$index] != '-' ? 'products__payment-item_active' : '' ?>">
                                                <div class="no-stroke products__payment-photo">
                                                    <?= $arResult['ALL_INSURANCE_PAYMENT_OPTIONS_LIST'][$el]['PROPERTY_ICON_VALUE']['TEXT'] ?>
                                                </div>

                                                <div class="products__payment-name"><?= $arResult['ALL_INSURANCE_PAYMENT_OPTIONS_LIST'][$el]['NAME'] ?>
                                                </div>
                                                <div class="products__payment-cost"><?= $item['ITEMS'][$currentPolicyIndex]['PROPERTY_PAYMENT_PRICE_VALUE'][$index] != '-' && $item['ITEMS'][$currentPolicyIndex]['PROPERTY_PAYMENT_PRICE_VALUE'][$index] != '' ? $item['ITEMS'][$currentPolicyIndex]['PROPERTY_PAYMENT_PRICE_VALUE'][$index] : '' ?>
                                                    руб.
                                                </div>

                                                <div class="products__info">
                                                    <div class="products__info-sign">
                                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M7 0C5.61553 0 4.26215 0.410543 3.11101 1.17971C1.95987 1.94888 1.06266 3.04213 0.532846 4.32121C0.00303299 5.6003 -0.13559 7.00776 0.134506 8.36563C0.404603 9.7235 1.07129 10.9708 2.05026 11.9497C3.02922 12.9287 4.2765 13.5954 5.63437 13.8655C6.99224 14.1356 8.3997 13.997 9.67879 13.4672C10.9579 12.9373 12.0511 12.0401 12.8203 10.889C13.5895 9.73784 14 8.38447 14 7C14 6.08074 13.8189 5.17049 13.4672 4.32121C13.1154 3.47194 12.5998 2.70026 11.9497 2.05025C11.2997 1.40024 10.5281 0.884626 9.67879 0.532843C8.82951 0.18106 7.91925 0 7 0ZM7 11.2C6.86155 11.2 6.72622 11.1589 6.6111 11.082C6.49599 11.0051 6.40627 10.8958 6.35329 10.7679C6.3003 10.64 6.28644 10.4992 6.31345 10.3634C6.34046 10.2276 6.40713 10.1029 6.50503 10.005C6.60292 9.90712 6.72765 9.84046 6.86344 9.81345C6.99923 9.78644 7.13997 9.8003 7.26788 9.85328C7.39579 9.90626 7.50511 9.99598 7.58203 10.1111C7.65895 10.2262 7.7 10.3615 7.7 10.5C7.7 10.6856 7.62625 10.8637 7.49498 10.995C7.3637 11.1262 7.18565 11.2 7 11.2ZM7.7 7.588V8.4C7.7 8.58565 7.62625 8.7637 7.49498 8.89497C7.3637 9.02625 7.18565 9.1 7 9.1C6.81435 9.1 6.6363 9.02625 6.50503 8.89497C6.37375 8.7637 6.3 8.58565 6.3 8.4V7C6.3 6.81435 6.37375 6.6363 6.50503 6.50502C6.6363 6.37375 6.81435 6.3 7 6.3C7.20767 6.3 7.41068 6.23842 7.58335 6.12304C7.75602 6.00767 7.8906 5.84368 7.97008 5.65182C8.04955 5.45995 8.07034 5.24883 8.02983 5.04515C7.98931 4.84147 7.88931 4.65438 7.74246 4.50754C7.59562 4.36069 7.40853 4.26069 7.20485 4.22017C7.00117 4.17966 6.79005 4.20045 6.59818 4.27992C6.40632 4.3594 6.24233 4.49398 6.12696 4.66665C6.01158 4.83932 5.95 5.04233 5.95 5.25C5.95 5.43565 5.87625 5.6137 5.74498 5.74497C5.6137 5.87625 5.43565 5.95 5.25 5.95C5.06435 5.95 4.8863 5.87625 4.75503 5.74497C4.62375 5.6137 4.55 5.43565 4.55 5.25C4.54817 4.79521 4.67296 4.34889 4.91041 3.961C5.14785 3.57311 5.48858 3.25897 5.89443 3.05375C6.30029 2.84853 6.75526 2.76033 7.2084 2.79901C7.66155 2.8377 8.09498 3.00176 8.46017 3.27281C8.82536 3.54387 9.1079 3.91122 9.27615 4.33375C9.44441 4.75627 9.49173 5.21729 9.41283 5.66518C9.33393 6.11308 9.13191 6.53017 8.8294 6.86977C8.5269 7.20936 8.13583 7.45805 7.7 7.588Z"
                                                                  fill="#818181"/>
                                                        </svg>

                                                    </div>
                                                    <div class="products__text-container">
                                                        <div class="products__info-text"><?= $arResult['ALL_INSURANCE_PAYMENT_OPTIONS_LIST'][$el]['PROPERTY_TEXT_VALUE']['TEXT'] ?></div>
                                                    </div>
                                                </div>
                                            </div>

                                        <? endforeach; ?>


                                    <? endforeach; ?>

                                    <div class="products__payment-bottom">

                                        <div class="products__payment-switch">
                                            <div class="products__payment-open">Развернуть
                                                <svg width="8" height="5" viewBox="0 0 8 5" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3.60396 4.82011L0.164193 1.04856C-0.0547314 0.808645 -0.0547314 0.419663 0.164193 0.179864C0.382921 -0.059955 0.737679 -0.059955 0.95639 0.179864L4.00006 3.5171L7.04362 0.179961C7.26244 -0.0598577 7.61716 -0.0598576 7.83589 0.179961C8.0547 0.41978 8.0547 0.808743 7.83589 1.04866L4.39607 4.8202C4.28665 4.94011 4.1434 5 4.00007 5C3.85668 5 3.71332 4.94 3.60396 4.82011Z"
                                                          fill="#A0A0A0"/>
                                                </svg>

                                            </div>

                                            <div class="products__payment-close">Свернуть
                                                <svg width="9" height="5" viewBox="0 0 9 5" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.89604 0.179893L8.33581 3.95144C8.55473 4.19135 8.55473 4.58034 8.33581 4.82014C8.11708 5.05995 7.76232 5.05995 7.54361 4.82014L4.49994 1.4829L1.45638 4.82004C1.23756 5.05986 0.882842 5.05986 0.664113 4.82004C0.445296 4.58022 0.445296 4.19126 0.664113 3.95134L4.10393 0.179796C4.21335 0.059887 4.3566 4.59895e-08 4.49992 4.76986e-08C4.64332 4.94086e-08 4.78668 0.0600033 4.89604 0.179893Z"
                                                          fill="#A0A0A0"/>
                                                </svg>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="solutions-card__substrate_bottom <?/*present*/?>">
                                <? foreach ($arResult['ALL_INSURANCE_LIST'] as $key => $item): ?>
                                    <? if (!empty($item['ITEMS'][$currentPolicyIndex]['PRICES_INFO']['RESULT_PRICE']['BASE_PRICE'])): ?>
                                        <p class="solutions-card__substrate_bottom-text">
                                            Всего
                                            <span><?= $item['ITEMS'][$currentPolicyIndex]['PRICES_INFO']['RESULT_PRICE']['BASE_PRICE'] ?> ₽</span>
                                        </p>

                                        <div id="policy-price"
                                             data-policy-price="<?= $item['ITEMS'][$currentPolicyIndex]['PRICES_INFO']['RESULT_PRICE']['BASE_PRICE'] ?>"
                                             data-policy-disc-price="<?= $item['ITEMS'][$currentPolicyIndex]['PRICES_INFO']['RESULT_PRICE']['DISCOUNT_PRICE'] ?>"
                                             data-policy-id="<?= $currentPolicyIndex ?>"
                                             class="solutions-card__substrate_bottom-price">
                                            <?/*В подарок*/?>
                                            <span><?= $item['ITEMS'][$currentPolicyIndex]['PRICES_INFO']['RESULT_PRICE']['DISCOUNT_PRICE'] ?> ₽</span>
                                        </div>
                                    <? endif; ?>
                                <? endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="b-vincko-basket-component"></div>

    </section>

    <div class="container">
        <section class="subscribe" id="subscribe">
            <div class="subscribe__head">
                <h2 class="h2">Подписка <span>vincko: <br>
                “Замена оборудования”</span>
                </h2>


            </div>

            <div class="subscribe__content">
                <div class="subscribe__column">
                    <div class="subscribe__sub-title">
                        <svg width="33" height="33" viewBox="0 0 33 33" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.5 0.25C7.53 0.25 0.25 7.53 0.25 16.5C0.25 25.47 7.53 32.75 16.5 32.75C25.47 32.75 32.75 25.47 32.75 16.5C32.75 7.53 25.47 0.25 16.5 0.25ZM17.9788 26.4937C17.8652 26.6051 17.7214 26.6807 17.5653 26.7111C17.4092 26.7415 17.2476 26.7254 17.1006 26.6649C16.9535 26.6043 16.8274 26.5019 16.738 26.3704C16.6486 26.2389 16.5997 26.084 16.5975 25.925V24.625H16.5C14.42 24.625 12.34 23.8288 10.7475 22.2525C9.64417 21.1465 8.88272 19.7461 8.55421 18.2188C8.22569 16.6915 8.344 15.1019 8.895 13.64C9.20375 12.8112 10.2925 12.6 10.91 13.2337C11.2675 13.5912 11.3487 14.1113 11.1862 14.5663C10.4387 16.5813 10.8612 18.9212 12.4862 20.5462C13.6237 21.6838 15.1187 22.22 16.6138 22.1875V20.66C16.6138 19.9288 17.4913 19.5713 17.995 20.0912L20.6275 22.7237C20.9525 23.0487 20.9525 23.5525 20.6275 23.8775L17.9788 26.4937ZM22.09 19.7825C21.922 19.6096 21.8068 19.3925 21.7579 19.1565C21.709 18.9205 21.7283 18.6754 21.8138 18.45C22.5613 16.435 22.1388 14.095 20.5138 12.47C19.3763 11.3325 17.8812 10.78 16.4025 10.8125V12.34C16.4025 13.0712 15.525 13.4288 15.0212 12.9087L12.3725 10.2925C12.0475 9.9675 12.0475 9.46375 12.3725 9.13875L15.005 6.50625C15.1186 6.3949 15.2623 6.31934 15.4184 6.28891C15.5745 6.25849 15.7361 6.27456 15.8832 6.33511C16.0303 6.39567 16.1563 6.49805 16.2457 6.62958C16.3352 6.7611 16.384 6.91597 16.3862 7.075V8.39125C18.4988 8.35875 20.6275 9.1225 22.2362 10.7475C23.3396 11.8535 24.101 13.2539 24.4295 14.7812C24.7581 16.3085 24.6397 17.8981 24.0888 19.36C23.78 20.205 22.7075 20.4163 22.09 19.7825Z"
                                  fill="#3CBA54"/>
                        </svg>

                        Что такое подписка “Замена оборудования”

                    </div>

                    <p>
                        Подписка дает вам возможность бесплатно получить новый датчик для комплекта оборудования,
                        купленного на платформе в рамках готового решения.
                    </p>
                </div>

                <div class="subscribe__column">
                    <div class="subscribe__sub-title">
                        Почему эта подписка дает уверенность при покупке оборудования
                    </div>

                    <p>
                        В случае, если один из датчиков в комплекте вышел из строя, с этой подпиской Вы просто
                        получите новый взамен, а ваша недвижимость останется под надежной охраной.
                    </p>
                </div>

                <div class="subscribe__column subscribe__column-to-buy">
                    <div class="subscribe__sub-title subscribe__sub-title--first">
                        На какой срок оформить подписку?
                    </div>
                    <div class="subscribe__sub-title subscribe__sub-title--ordered">
                        В ваш комплект включена эта подписка
                    </div>
                    <div class="subscribe__column-to-buy-content">
                        <div class="subscribe__conditions">
                            <p>
                                Длительность гарантии
                            </p>
                            <select name="time-choice" id="time-choice" class="time-choice">
                                <option value="12">12 месяцев</option>
                                <option value="6">6 месяцев</option>
                            </select>

                            <div class="subscribe__text">
                                Спокойствия и уверенности
                            </div>

                            <div class="subscribe__result">
                                Всего за
                                <div class="price">
                                    600 ₽
                                </div>
                            </div>

                        </div>

                        <button id="b-add-subscribe-price" data-subscribe-price="600" class="blue-button to-card-btn">
                            добавить в заказ</a></button>
                        <button id="b-del-subscribe-price" data-subscribe-price="0"
                                class="button button-ordered to-card-btn">Исключить
                        </button>

                    </div>
                </div>

                <div class="subscribe__column subscribe__column-bought">
                    <div class="subscribe__column-bought-head">
                    <span>
                        Поздравляем!
                    </span>

                        <svg width="50" height="37" viewBox="0 0 50 37" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M1.02433 17.998C2.38976 16.6592 4.60355 16.6592 5.96898 17.998L16.0099 28.7236L44.0313 1.00409C45.3967 -0.334696 47.6105 -0.334696 48.9759 1.00409C50.3414 2.34288 50.3414 4.51348 48.9759 5.85227L18.4822 35.9959C17.1168 37.3347 14.903 37.3347 13.5376 35.9959L1.02433 22.8462C-0.341092 21.5074 -0.341093 19.3368 1.02433 17.998Z"
                                  fill="white"/>
                        </svg>

                    </div>
                    <div class="subscribe__column-bought-content">
                        <p>
                            Ранее Вы уже получили подписку “Замена Оборудования”.
                        </p>
                        <p>
                            Она будет действительна до 16.05.2021.
                        </p>
                        <p>
                            У Вас возникли вопросы? Свяжитесь с нами.
                        </p>
                    </div>
                </div>

            </div>

        </section>
    </div>

    <div class="container">

        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/callback.php"
            )
        ); ?>
    </div>
</main>


<?
unset($actualItem, $itemIds, $jsParams);

//расчет итоговой цены со скидкой для корзины
$complectPrice = 0;
$complectOldPrice = 0;

$subscriptionFeePrice = 0;
$subscriptionFeeOldPrice = 0;

$policyPrice = 0;
$policyOldPrice = 0;

$complectOldPrice = $arResult['ALL_LIST_COMPLECTS_IN_PACKAGE'][$currentComplectIndex]['PRICES_INFO']['RESULT_PRICE']['BASE_PRICE'];
$complectPrice = $arResult['ALL_LIST_COMPLECTS_IN_PACKAGE'][$currentComplectIndex]['PRICES_INFO']['RESULT_PRICE']['DISCOUNT_PRICE'];;

$subscriptionFeeOldPrice = $arResult['ALL_LIST_COMPANY_CITY'][$currentSecureCompanyIndex]['SUBSCRIPTION_FEE'][$currentSubcriptionFeeIndex]['PRICES_INFO']['RESULT_PRICE']['BASE_PRICE'];
$subscriptionFeePrice = $arResult['ALL_LIST_COMPANY_CITY'][$currentSecureCompanyIndex]['SUBSCRIPTION_FEE'][$currentSubcriptionFeeIndex]['PRICES_INFO']['RESULT_PRICE']['DISCOUNT_PRICE'];

foreach ($arResult['ALL_INSURANCE_LIST'] as $key => $item) {
    if (!empty($item['ITEMS'][$currentPolicyIndex]['PRICES_INFO']['RESULT_PRICE']['BASE_PRICE'])) {
        $policyOldPrice = $item['ITEMS'][$currentPolicyIndex]['PRICES_INFO']['RESULT_PRICE']['BASE_PRICE'];
    }
    if (!empty($item['ITEMS'][$currentPolicyIndex]['PRICES_INFO']['RESULT_PRICE']['DISCOUNT_PRICE'])) {
        $policyPrice = $item['ITEMS'][$currentPolicyIndex]['PRICES_INFO']['RESULT_PRICE']['DISCOUNT_PRICE'];
    }
}

$totalPrice = $complectPrice + $subscriptionFeePrice + $policyPrice;
$totalDiscountPrice = $complectOldPrice + $subscriptionFeeOldPrice + $policyOldPrice;

$currentSubscriptionFeeMonthsCount = $arResult['ALL_LIST_COMPANY_CITY'][$currentSecureCompanyIndex]['SUBSCRIPTION_FEE'][$currentSubcriptionFeeIndex]['PROPERTY_APTP_MESYAC_VALUE'];

foreach ($arResult['ALL_INSURANCE_LIST'] as $key => $company) {
    foreach ($company['ITEMS'] as $policy) {
        if ($policy['ID'] == $currentPolicyIndex) {
            $policy_name = $policy['NAME'];
            break;
        }
    }

}
$data = [
    'items' => [
        0 => [
            'id' => $currentComplectIndex,
            'title' => 'Комплект оборудования',
            'name1' => $arResult['PACKAGES_CLASSES'][$arResult['CURRENT_PACKAGE_CLASS']]['NAME'],
            'name2' => $arResult['ALL_LIST_COMPLECTS_IN_PACKAGE'][$currentComplectIndex]['NAME'],
            'gift' => 'доставка/монтаж в подарок',
            'active' => true,
            'sum' => $complectPrice,
            'old_sum' => $complectOldPrice,
            'package_info' => ['name' => $arResult['PACKAGE_GROUP']['NAME'], 'picture_src' => $arResult['PACKAGES_CLASSES'][$arResult['CURRENT_PACKAGE_CLASS']]['PICTURE']['src']]
        ],
        1 => [
            'id' => $currentSubcriptionFeeIndex,
            'title' => 'Охранная компания',
            'name1' => $currentSubscriptionFeeMonthsCount .
                ' месяц' . (in_array($currentSubscriptionFeeMonthsCount, array(2, 3, 4, 22,23,24)) ? 'а' : 'ев') . ' обслуживания',
            'name2' => $arResult['ALL_LIST_COMPANY_CITY'][$currentSecureCompanyIndex]['NAME'],
            'months_count' => $currentSubscriptionFeeMonthsCount,
            'gift' => '1 мес. в подарок',
            'active' => true,
            'sum' => $subscriptionFeePrice,
            'old_sum' => $subscriptionFeeOldPrice
        ],
        2 => [
            'id' => $currentPolicyIndex,
            'title' => 'Страховая выплата',
            'name1' => 'при наступлении страхового случая',
            'name2' => $currentPolicyMaxPrice . ' руб',
            'policy_name' => $policy_name,
            'gift' => 'подарок',
            'active' => true,
            'sum' => $policyPrice,
            'old_sum' => $policyOldPrice
        ],
    ],
    'sum' => $totalPrice,
    'old_sum' => $totalDiscountPrice,
    'subscribe_sum' => 0
];

?>

<script>
    var data = JSON.parse('<?=json_encode($data)?>');

    $(document).ready(function () {
        var itd_basket = new basket({
            target: document.getElementById('b-vincko-basket-component'),
            props: data,
        });

        function updateBasket(data) {
            data.sum = 0;
            data.old_sum = 0;
            data.items.forEach(e => {
                if (e.active) {
                    data.sum += e.sum;
                    data.old_sum += e.old_sum;
                }
            })
            if (data.subscribe_sum > 0) {
                data.sum += data.subscribe_sum;
                data.old_sum += data.subscribe_sum;
            } else {
                data.sum -= data.subscribe_sum;
                data.old_sum -= data.subscribe_sum;
            }


            itd_basket.$set(data);
        }

        function handleActive(id, val) {
            data.items = data.items.map(e => {
                if (e.id == id) {
                    e.active = val;
                }
                return e;
            });
        }

        //subscribe
        $("#b-add-subscribe-price").on('click', (e) => {
            data.subscribe_sum = $("#b-add-subscribe-price").data("subscribe-price");
            updateBasket(data);
        })
        $("#b-del-subscribe-price").on('click', (e) => {
            data.subscribe_sum = $("#b-del-subscribe-price").data("subscribe-price");
            ;
            updateBasket(data);
        })

        //complect
        $("#closed-card-eq").on('click', (e) => {
            let id = $("#eq-price").data("eq-id");
            handleActive(id, false);
            updateBasket(data);
        })

        $("#eq-plus").on('click', (e) => {
            let id = $("#eq-price").data("eq-id");
            handleActive(id, true);
            updateBasket(data);
        })
        //subscription fee
        $("#closed-card-company").on('click', (e) => {
            let id = $("#subscription-fee-price").data("subscription-fee-id");
            handleActive(id, false);
            updateBasket(data);
        })

        $("#subscription-fee-plus").on('click', (e) => {
            let id = $("#subscription-fee-price").data("subscription-fee-id");
            handleActive(id, true);
            updateBasket(data);
        })
        //policy
        $("#closed-card-ins").on('click', (e) => {
            let id = $("#policy-price").data("policy-id");
            handleActive(id, false);
            updateBasket(data);
        })

        $("#policy-plus").on('click', (e) => {
            let id = $("#policy-price").data("policy-id");
            handleActive(id, true);
            updateBasket(data);
        })
    });
    $("#subscribe .blue-button").on("click", function () {
        $(".subscribe").addClass("subscribe-ordered");
        $('.card-one').removeClass("no-subscribe");
    });
    $("#subscribe .subscribe .button-ordered").on("click", function () {
        $(".subscribe").removeClass("subscribe-ordered");
        $('.card-one').addClass("no-subscribe");
    });
    $(".to-card-btn").on("click", function () {
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#solutions__center").offset().top
        }, 300);
    });

</script>
