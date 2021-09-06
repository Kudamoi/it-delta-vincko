<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");

use \Vincko\Order;

$session = \Bitrix\Main\Application::getInstance()->getSession();
$orderData = $session->get('orderData');


if(!isset($_GET['ORDER_ID']) && empty($orderData))
    LocalRedirect("/");


$orderData = (array)($orderData);
$orderItems = $orderData['items'];
$complectObj = $orderItems[0];
$subscriptionFeeObj = $orderItems[1];
$policyObj = $orderItems[2];
$totalObj = $orderData['total'];
$paymentMethodObj = $orderData['paymentMethod'];

if($_GET['itd']=='y')
{
    echo '<pre>';
    print_r($orderData);
    echo '</pre>';
}
$res = CIblockElement::getList(
        [],
        ['=IBLOCK_CODE'=>'documents-in-footer','=ACTIVE'=>'Y'],
        false, false,
        ['ID','NAME','PROPERTY_DOCUMENT','CODE']
);
while($arFields = $res->Fetch())
{
    if($arFields['CODE']=='polzovatelskoe-soglashenie') {
        continue;
    }

    $arFields['CONTRACT_LINK'] = CFile::GetPath($arFields['PROPERTY_DOCUMENT_VALUE']);
    $arResult["CONTRACTS"][] = $arFields;
}
$res = CIblockElement::getList(
    [],
    ['=IBLOCK_CODE'=>'strahovka','=ACTIVE'=>'Y'],
    false, false,
    ['ID','NAME','PROPERTY_DOCUMENTS']
);
while($arFields = $res->Fetch())
{
    $arFields['INSURANCE_LINK'] = CFile::GetPath($arFields['PROPERTY_DOCUMENTS_VALUE'][0]);
    $arResult['INSURANCE_INFO'] = $arFields;
}

$periodInstall = Vincko\Order::getPeriodInstallment();

//$arResult["PAYMENT"] = Order::getPaymentSystem();
$curStep = 1;

?>

    <style>
        .disabled
        {
            opacity: 50%;
        }
        .error_message {
            display: none
        }

        .error_message,.error {
            color: red
        }

        .error::-webkit-input-placeholder { /* WebKit browsers */
            color: red;
        }

        .error:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
            color: red;
        }

        .error::-moz-placeholder { /* Mozilla Firefox 19+ */
            color: red;
        }

        .error:-ms-input-placeholder { /* Internet Explorer 10+ */
            color: red;
        }

    </style>
<?/*
<div id="test" style="cursor:pointer" xmlns="http://www.w3.org/1999/html">Заполнить тестовыми данными</div>
<script>
    $(document).ready(function () {
        $("#test").click(function (){
            $("input").each(function(index){
                //console.log( index + ": " + $(this).attr("name") );
                var name = $(this).attr("type");

                if(name!== undefined && $(this).attr("type")!="hidden" && $(this).attr("type")!="radio") {
                    //console.log(name.indexOf("text"));
                    if (name.indexOf("text")!=-1) {
                        $(this).val($(this).attr("placeholder"));
                    } else if (name.indexOf("date")!=-1) {
                        $(this).val("2020-07-21");
                    } else if (name.indexOf("email")!=-1) {
                        $(this).val("test@test.ru");
                    }
                }
                var name = $(this).attr("name");

                if(name!== undefined && $(this).attr("type")!="hidden" && $(this).attr("type")!="radio") {
                    //console.log(name.indexOf("text"));
                    if (name.indexOf("text")!=-1) {
                        $(this).val($(this).attr("placeholder"));
                    } else if (name.indexOf("date")!=-1) {
                        $(this).val("2020-07-21");
                    } else if (name.indexOf("email")!=-1) {
                        $(this).val("test@test.ru");
                    }
                }
            });
        });

    })
</script>
*/?>

<?if(isset($_GET['ORDER_ID'])):?>
    <?$APPLICATION->IncludeComponent(
        "vincko:sale.order.ajax",
        "vincko",
        array(
            "ACTION_VARIABLE" => "soa-action",
            "ADDITIONAL_PICT_PROP_10" => "-",
            "ADDITIONAL_PICT_PROP_11" => "-",
            "ADDITIONAL_PICT_PROP_12" => "-",
            "ADDITIONAL_PICT_PROP_13" => "-",
            "ADDITIONAL_PICT_PROP_14" => "-",
            "ADDITIONAL_PICT_PROP_15" => "-",
            "ADDITIONAL_PICT_PROP_24" => "-",
            "ALLOW_APPEND_ORDER" => "Y",
            "ALLOW_AUTO_REGISTER" => "Y",
            "ALLOW_NEW_PROFILE" => "N",
            "ALLOW_USER_PROFILES" => "N",
            "BASKET_IMAGES_SCALING" => "adaptive",
            "BASKET_POSITION" => "before",
            "COMPATIBLE_MODE" => "N",
            "DELIVERIES_PER_PAGE" => "9",
            "DELIVERY_FADE_EXTRA_SERVICES" => "N",
            "DELIVERY_NO_AJAX" => "N",
            "DELIVERY_NO_SESSION" => "Y",
            "DELIVERY_TO_PAYSYSTEM" => "p2d",
            "DISABLE_BASKET_REDIRECT" => "N",
            "EMPTY_BASKET_HINT_PATH" => "/",
            "HIDE_ORDER_DESCRIPTION" => "N",
            "MESS_ADDITIONAL_PROPS" => "Дополнительные свойства",
            "MESS_AUTH_BLOCK_NAME" => "Авторизация",
            "MESS_AUTH_REFERENCE_1" => "Символом \"звездочка\" (*) отмечены обязательные для заполнения поля.",
            "MESS_AUTH_REFERENCE_2" => "После регистрации вы получите информационное письмо.",
            "MESS_AUTH_REFERENCE_3" => "Личные сведения, полученные в распоряжение интернет-магазина при регистрации или каким-либо иным образом, не будут без разрешения пользователей передаваться третьим организациям и лицам за исключением ситуаций, когда этого требует закон или судебное решение.",
            "MESS_BACK" => "Назад",
            "MESS_BASKET_BLOCK_NAME" => "Состав заказа",
            "MESS_BUYER_BLOCK_NAME" => "Контакты покупателя",
            "MESS_COUPON" => "Купон",
            "MESS_DELIVERY_BLOCK_NAME" => "Вид доставки",
            "MESS_DELIVERY_CALC_ERROR_TEXT" => "Вы можете продолжить оформление заказа, а чуть позже менеджер магазина свяжется с вами и уточнит информацию по доставке.",
            "MESS_DELIVERY_CALC_ERROR_TITLE" => "Не удалось рассчитать стоимость доставки.",
            "MESS_ECONOMY" => "Экономия",
            "MESS_EDIT" => "изменить",
            "MESS_FAIL_PRELOAD_TEXT" => "Вы заказывали в нашем интернет-магазине, поэтому мы заполнили все данные автоматически.<br />Обратите внимание на развернутый блок с информацией о заказе. Здесь вы можете внести необходимые изменения или оставить как есть и нажать кнопку \"#ORDER_BUTTON#\".",
            "MESS_FURTHER" => "Продолжить",
            "MESS_INNER_PS_BALANCE" => "На вашем пользовательском счете:",
            "MESS_NAV_BACK" => "Назад",
            "MESS_NAV_FORWARD" => "Вперед",
            "MESS_NEAREST_PICKUP_LIST" => "Ближайшие пункты:",
            "MESS_ORDER" => "Оформить заказ",
            "MESS_ORDER_DESC" => "Комментарии к заказу:",
            "MESS_PAYMENT_BLOCK_NAME" => "Оплата",
            "MESS_PAY_SYSTEM_PAYABLE_ERROR" => "Вы сможете оплатить заказ после того, как менеджер проверит наличие полного комплекта товаров на складе. Сразу после проверки вы получите письмо с инструкциями по оплате. Оплатить заказ можно будет в персональном разделе сайта.",
            "MESS_PERIOD" => "Срок доставки",
            "MESS_PERSON_TYPE" => "Тип плательщика",
            "MESS_PICKUP_LIST" => "Пункты самовывоза:",
            "MESS_PRICE" => "Стоимость",
            "MESS_PRICE_FREE" => "бесплатно",
            "MESS_REGION_BLOCK_NAME" => "Регион доставки",
            "MESS_REGION_REFERENCE" => "Выберите свой город в списке. Если вы не нашли свой город, выберите \"другое местоположение\", а город впишите в поле \"Город\"",
            "MESS_REGISTRATION_REFERENCE" => "Если вы впервые на сайте, и хотите, чтобы мы вас помнили и все ваши заказы сохранялись, заполните регистрационную форму.",
            "MESS_REG_BLOCK_NAME" => "Регистрация",
            "MESS_SELECT_PICKUP" => "Выбрать",
            "MESS_SELECT_PROFILE" => "Выберите профиль",
            "MESS_SUCCESS_PRELOAD_TEXT" => "Вы заказывали в нашем интернет-магазине, поэтому мы заполнили все данные автоматически.<br />Если все заполнено верно, нажмите кнопку \"#ORDER_BUTTON#\".",
            "MESS_USE_COUPON" => "Применить купон",
            "ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
            "PATH_TO_AUTH" => "/reg/",
            "PATH_TO_BASKET" => "",
            "PATH_TO_PAYMENT" => "payment.php",
            "PATH_TO_PERSONAL" => "index.php",
            "PAY_FROM_ACCOUNT" => "Y",
            "PAY_SYSTEMS_PER_PAGE" => "9",
            "PICKUPS_PER_PAGE" => "5",
            "PICKUP_MAP_TYPE" => "yandex",
            "PRODUCT_COLUMNS_HIDDEN" => array(
            ),
            "PRODUCT_COLUMNS_VISIBLE" => array(
                0 => "DISCOUNT_PRICE_PERCENT_FORMATED",
                1 => "PRICE_FORMATED",
            ),
            "PROPS_FADE_LIST_3" => array(
                0 => "20",
                1 => "21",
                2 => "22",
            ),
            "SEND_NEW_USER_NOTIFY" => "N",
            "SERVICES_IMAGES_SCALING" => "adaptive",
            "SET_TITLE" => "Y",
            "SHOW_BASKET_HEADERS" => "N",
            "SHOW_COUPONS" => "N",
            "SHOW_COUPONS_BASKET" => "Y",
            "SHOW_COUPONS_DELIVERY" => "Y",
            "SHOW_COUPONS_PAY_SYSTEM" => "Y",
            "SHOW_DELIVERY_INFO_NAME" => "Y",
            "SHOW_DELIVERY_LIST_NAMES" => "Y",
            "SHOW_DELIVERY_PARENT_NAMES" => "Y",
            "SHOW_MAP_IN_PROPS" => "Y",
            "SHOW_NEAREST_PICKUP" => "Y",
            "SHOW_NOT_CALCULATED_DELIVERIES" => "N",
            "SHOW_ORDER_BUTTON" => "final_step",
            "SHOW_PAY_SYSTEM_INFO_NAME" => "Y",
            "SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",
            "SHOW_PICKUP_MAP" => "Y",
            "SHOW_STORES_IMAGES" => "Y",
            "SHOW_TOTAL_ORDER_BUTTON" => "N",
            "SHOW_VAT_PRICE" => "N",
            "SKIP_USELESS_BLOCK" => "N",
            "SPOT_LOCATION_BY_GEOIP" => "Y",
            "TEMPLATE_LOCATION" => "popup",
            "TEMPLATE_THEME" => "site",
            "USER_CONSENT" => "Y",
            "USER_CONSENT_ID" => "1",
            "USER_CONSENT_IS_CHECKED" => "Y",
            "USER_CONSENT_IS_LOADED" => "N",
            "USE_CUSTOM_ADDITIONAL_MESSAGES" => "Y",
            "USE_CUSTOM_ERROR_MESSAGES" => "Y",
            "USE_CUSTOM_MAIN_MESSAGES" => "Y",
            "USE_ENHANCED_ECOMMERCE" => "N",
            "USE_PHONE_NORMALIZATION" => "Y",
            "USE_PRELOAD" => "N",
            "USE_PREPAYMENT" => "N",
            "USE_YM_GOALS" => "N",
            "COMPONENT_TEMPLATE" => "vincko",
            "SHOW_MAP_FOR_DELIVERIES" => array(
                0 => "7",
                1 => "9",
            )
        ),
        false
    );?>
<?else:?>
<main class="container main">
    <section>
    <form method="post" id="b-form-order-ajax" class="installment insurance-policy order">

        <div class="installment__left-column">
            <h2 class="installment__page-title">Оформление заказа</h2>

            <div class="ready-pack__item-wrapper ready-pack__item-mobile" id="fix-card">
                <div class="ready-pack__item ready-pack__item--short">
                    <div class="ready-pack__top">
                        <picture>
                            <source srcset="<?=$complectObj->package_info->picture_src?>">
                            <img src="<?=$complectObj->package_info->picture_src?>" alt="var-image-1">
                        </picture>
                        <div class="ready-pack__top-title">
                            <div class="text">Вариант</div>
                            <div class="ready-pack__global-type">
                                <?=$complectObj->name1?>
                            </div>
                        </div>
                    </div>
                    <div class="ready-pack__details">
                        <div class="hide-details hidden">
                            <span>Скрыть детали</span>
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.89604 5.17989L12.3358 8.95144C12.5547 9.19135 12.5547 9.58034 12.3358 9.82014C12.1171 10.06 11.7623 10.06 11.5436 9.82014L8.49994 6.4829L5.45638 9.82004C5.23756 10.0599 4.88284 10.0599 4.66411 9.82004C4.4453 9.58022 4.4453 9.19126 4.66411 8.95134L8.10393 5.1798C8.21335 5.05989 8.3566 5 8.49992 5C8.64332 5 8.78668 5.06 8.89604 5.17989Z"
                                      fill="#005DFF"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ready-pack__mid ready-pack__mid--short hidden">
                        <div class="ready-pack__mid--short-title">
                            Вариант решения включает:
                        </div>
                        <div class="ready-pack__short-list">
                            <?if($complectObj->active):?>
                                <div class="ready-pack__short-item">
                                    <div class="ready-pack__short-img">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M7.2 0H8.8V2.4H7.2V0ZM13.0916 1.77715L14.223 2.9085L12.5259 4.60547L11.3945 3.47412L13.0916 1.77715ZM16 7.2H13.6V8.8H16V7.2ZM0 7.2H2.4V8.8H0V7.2ZM4.60568 3.47471L2.90859 1.77773L1.77721 2.90908L3.47429 4.60605L4.60568 3.47471ZM12 11.2V8C12 5.79443 10.2056 4 8 4C5.7944 4 4 5.79443 4 8V11.2C2.67679 11.2 1.6 12.2768 1.6 13.6C1.6 14.9232 2.67679 16 4 16H12C13.3232 16 14.4 14.9232 14.4 13.6C14.4 12.2768 13.3232 11.2 12 11.2ZM5.6 8C5.6 6.67676 6.67679 5.6 8 5.6C9.32321 5.6 10.4 6.67676 10.4 8V11.2H5.6V8ZM4 14.4C3.5592 14.4 3.2 14.0416 3.2 13.6C3.2 13.1584 3.5592 12.8 4 12.8H12C12.4416 12.8 12.8 13.1584 12.8 13.6C12.8 14.0416 12.4416 14.4 12 14.4H4ZM8 6.4V7.99844L9.6 8C9.6 7.11758 8.8832 6.4 8 6.4Z"
                                                  fill="#005DFF"/>
                                        </svg>

                                    </div>

                                    <div class="ready-pack__short-title">
                                        Оборудование
                                        <div class="ready-pack__subscription">
                                            Подписка
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.0003 1.66669C5.40033 1.66669 1.66699 5.40002 1.66699 10C1.66699 14.6 5.40033 18.3334 10.0003 18.3334C14.6003 18.3334 18.3337 14.6 18.3337 10C18.3337 5.40002 14.6003 1.66669 10.0003 1.66669ZM10.7587 15.125C10.7004 15.1821 10.6267 15.2209 10.5467 15.2365C10.4666 15.2521 10.3837 15.2438 10.3083 15.2128C10.2329 15.1817 10.1682 15.1292 10.1224 15.0618C10.0765 14.9943 10.0515 14.9149 10.0503 14.8334V14.1667H10.0003C8.93366 14.1667 7.86699 13.7584 7.05033 12.95C6.48452 12.3828 6.09403 11.6647 5.92556 10.8814C5.75709 10.0982 5.81776 9.28302 6.10033 8.53335C6.25866 8.10835 6.81699 8.00002 7.13366 8.32502C7.31699 8.50835 7.35866 8.77502 7.27533 9.00835C6.89199 10.0417 7.10866 11.2417 7.94199 12.075C8.52533 12.6584 9.29199 12.9334 10.0587 12.9167V12.1334C10.0587 11.7584 10.5087 11.575 10.767 11.8417L12.117 13.1917C12.2837 13.3584 12.2837 13.6167 12.117 13.7834L10.7587 15.125ZM12.867 11.6834C12.7809 11.5947 12.7218 11.4833 12.6967 11.3623C12.6716 11.2413 12.6815 11.1156 12.7253 11C13.1087 9.96669 12.892 8.76669 12.0587 7.93335C11.4753 7.35002 10.7087 7.06669 9.95033 7.08335V7.86669C9.95033 8.24169 9.50033 8.42502 9.24199 8.15835L7.88366 6.81669C7.71699 6.65002 7.71699 6.39169 7.88366 6.22502L9.23366 4.87502C9.2919 4.81792 9.36561 4.77917 9.44567 4.76357C9.52572 4.74797 9.6086 4.7562 9.68401 4.78726C9.75943 4.81831 9.82407 4.87082 9.86993 4.93826C9.91579 5.00571 9.94085 5.08513 9.94199 5.16669V5.84169C11.0253 5.82502 12.117 6.21669 12.942 7.05002C13.5078 7.61721 13.8983 8.33535 14.0668 9.11859C14.2352 9.90183 14.1746 10.717 13.892 11.4667C13.7337 11.9 13.1837 12.0084 12.867 11.6834Z"
                                                      fill="#3CBA54"/>
                                            </svg>
                                        </div>
                                    </div>

                                    <div class="ready-pack__short-content ready-pack__short-content-h blue">
                                        <?=$complectObj->name2?>
                                    </div>
                                </div>
                            <?endif;?>
                            <?if($subscriptionFeeObj->active):?>
                                <div class="ready-pack__short-item">
                                    <div class="ready-pack__short-img">
                                        <svg width="14" height="18" viewBox="0 0 14 18" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M4.6654 6.60938H11.9412C13.0764 6.60938 14 7.55564 14 8.71875V15.8906C14 17.0537 13.0764 18 11.9412 18H2.05882C0.923588 18 0 17.0537 0 15.8906V8.71875C0 7.55564 0.923588 6.60938 2.05882 6.60938H3.29285V3.71848C3.29285 1.66809 4.95531 0 6.99873 0C9.04215 0 10.7046 1.66809 10.7046 3.71848V6.60938H9.33206V3.71848C9.33206 2.4435 8.28532 1.40625 6.99873 1.40625C5.71214 1.40625 4.6654 2.4435 4.6654 3.71848V6.60938ZM11.9412 16.5938C12.3196 16.5938 12.6275 16.2783 12.6275 15.8906V8.71875C12.6275 8.33105 12.3196 8.01562 11.9412 8.01562H2.05882C1.68041 8.01562 1.37255 8.33105 1.37255 8.71875V15.8906C1.37255 16.2783 1.68041 16.5938 2.05882 16.5938H11.9412ZM5.73039 11.3555C5.73039 10.6371 6.2988 10.0547 7 10.0547C7.7012 10.0547 8.26961 10.6371 8.26961 11.3555C8.26961 11.8153 8.03652 12.2191 7.68501 12.4504V13.9922C7.68501 14.3805 7.37773 14.6953 6.99873 14.6953C6.6197 14.6953 6.31246 14.3805 6.31246 13.9922V12.4488C5.96235 12.2171 5.73039 11.8142 5.73039 11.3555Z"
                                                  fill="#005DFF"/>
                                        </svg>


                                    </div>

                                    <div class="ready-pack__short-title">
                                        Договор с охранной компанией
                                    </div>

                                    <div class="ready-pack__short-content ready-pack__short-content-h">
                                        <?=$subscriptionFeeObj->name2?>
                                        <br>
                                        на <?=$subscriptionFeeObj->name1?>
                                    </div>
                                </div>
                            <?endif;?>
                            <?if($policyObj->active):?>
                                <div class="ready-pack__short-item">
                                    <div class="ready-pack__short-img">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <rect width="24" height="24" fill="white"/>
                                            <path d="M9.338 5.04486C8.38559 5.30735 7.11663 5.81082 6.17798 6.11892C6.09227 6.14668 6.01608 6.19796 5.95809 6.26691C5.9001 6.33586 5.86264 6.41972 5.84998 6.50892C5.29598 10.6659 6.36063 14.135 7.88763 16.133C8.53415 16.9874 9.84341 18.2852 10.713 18.9112C11.059 19.1552 11.365 19.3312 11.606 19.4442C11.726 19.5012 11.824 19.5392 11.899 19.5622C11.9318 19.5737 11.9656 19.582 12 19.5872C12.034 19.5816 12.0674 19.5733 12.1 19.5622C12.176 19.5392 12.274 19.5012 12.394 19.4442C12.634 19.3312 12.941 19.1542 13.287 18.9112C14.1566 18.2852 15.4658 16.9874 16.1124 16.133C17.6394 14.136 18.704 10.6659 18.15 6.50892C18.1375 6.41968 18.1001 6.33577 18.042 6.2668C17.984 6.19783 17.9078 6.14658 17.822 6.11892C17.171 5.90592 15.749 5.34086 14.662 5.04586C13.552 4.74486 12.531 4.52186 12 4.52186C11.47 4.52186 10.448 4.74486 9.338 5.04586V5.04486ZM9.072 4.56C10.157 4.265 11.31 4 12 4C12.69 4 13.843 4.265 14.928 4.56C16.038 4.86 17.157 5.215 17.815 5.43C18.0901 5.52085 18.334 5.68747 18.5187 5.9107C18.7034 6.13394 18.8213 6.40474 18.859 6.692C19.455 11.169 18.072 14.487 16.394 16.682C15.6824 17.621 14.834 18.4479 13.877 19.135C13.5461 19.3728 13.1955 19.5819 12.829 19.76C12.549 19.892 12.248 20 12 20C11.752 20 11.452 19.892 11.171 19.76C10.8045 19.5819 10.4539 19.3728 10.123 19.135C9.16603 18.4478 8.31758 17.621 7.606 16.682C5.928 14.487 4.54501 11.169 5.14101 6.692C5.17869 6.40474 5.29665 6.13394 5.48132 5.9107C5.666 5.68747 5.9099 5.52085 6.185 5.43C7.1402 5.11681 8.10281 4.82672 9.072 4.56Z"
                                                  fill="#005DFF" stroke="#005DFF"/>
                                            <path d="M14.9755 9.17508L11.5805 12.5568L10.0245 11.0068C9.79017 10.7734 9.41016 10.7734 9.17578 11.0068C8.94141 11.2403 8.94141 11.6187 9.17578 11.8522L11.1561 13.8249C11.2687 13.937 11.4213 14 11.5805 14C11.5805 14 11.5805 14 11.5805 14C11.7397 14 11.8923 13.937 12.0048 13.8249L15.8242 10.0205C16.0586 9.78707 16.0586 9.40858 15.8242 9.17512C15.5898 8.94165 15.2099 8.94161 14.9755 9.17508Z"
                                                  fill="#005DFF"/>
                                        </svg>


                                    </div>

                                    <div class="ready-pack__short-title">
                                        Страхование недвижимости
                                    </div>

                                    <div class="ready-pack__short-content ready-pack__short-content-text">
                                        Полис “<?=$policyObj->policy_name?>"
                                        <br>
                                        на <?=$policyObj->name2?>
                                    </div>
                                </div>
                            <?endif;?>
                        </div>

                    <?if(sizeof($complectObj->gift)>0):?>
                        <div class="predloj__present">
                            <div class="present__text">
                                <div class="h5">В подарок:</div>
                                <ul>
                                    <?foreach ($complectObj->gift as $gift):?>
                                        <li><span>&#10003;</span><?=$gift?></li>
                                    <?endforeach;?>
                                </ul>
                            </div>
                            <picture>
                                <source type="image/svg" srcset="/upload/images/equipment/podarok.svg">
                                <img src="/upload/images/equipment/podarok.svg" alt="img" loading="lazy">
                            </picture>
                        </div>
                    <?endif;?>
                    </div>

                    <div class="short-rd__price hidden">
                        <div class="short-rd__price-title">Всего</div>
                        <?if(intval($totalObj->total_sum)!=intval($totalObj->total_old_sum)):?>
                            <div class="short-rd__price-old"><?=$totalObj->total_old_sum?> ₽</div>
                            <div class="short-rd__cost"><?=$totalObj->total_sum?> ₽</div>
                        <?else:?>
                            <div data-old-sum="<?=$totalObj->total_old_sum?>" id="b-data-old-sum" class="short-rd__cost"><?=$totalObj->total_old_sum?> ₽</div>
                        <?endif;?>
                    </div>
                    <div class="short-rd__footer hidden">
                        <a onclick="window.history.back();" href="#" class="short-rd-another">
                            <svg width="14" height="12" viewBox="0 0 14 12" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M5.29289 11.7071C5.68342 12.0976 6.31658 12.0976 6.70711 11.7071C7.09763 11.3166 7.09763 10.6834 6.70711 10.2929L3.41421 7L13 7C13.5523 7 14 6.55228 14 6C14 5.44771 13.5523 5 13 5L3.41421 5L6.70711 1.70711C7.09763 1.31658 7.09763 0.683417 6.70711 0.292893C6.31658 -0.0976321 5.68342 -0.0976322 5.29289 0.292893L0.293739 5.29205C0.291278 5.2945 0.28883 5.29697 0.286396 5.29945C0.109253 5.47987 5.48388e-07 5.72718 5.24537e-07 6C5.12683e-07 6.13559 0.0269866 6.26488 0.0758796 6.38278C0.12432 6.49986 0.195951 6.6096 0.290776 6.70498M5.29289 11.7071L0.293092 6.7073L5.29289 11.7071Z"
                                      fill="#005DFF"/>
                            </svg>
                            Изменить выбор
                        </a>
                    </div>
                    <div class="ready-pack__details">
                        <div class="show-details">
                            <span>Смотреть детали</span>
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.10396 9.82011L4.66419 6.04856C4.44527 5.80865 4.44527 5.41966 4.66419 5.17986C4.88292 4.94004 5.23768 4.94004 5.45639 5.17986L8.50006 8.5171L11.5436 5.17996C11.7624 4.94014 12.1172 4.94014 12.3359 5.17996C12.5547 5.41978 12.5547 5.80874 12.3359 6.04866L8.89607 9.8202C8.78665 9.94011 8.6434 10 8.50007 10C8.35668 10 8.21332 9.94 8.10396 9.82011Z"
                                      fill="#005DFF"/>
                            </svg>
                        </div>
                        <div class="hide-details hidden">
                            <span>Скрыть детали</span>
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.89604 5.17989L12.3358 8.95144C12.5547 9.19135 12.5547 9.58034 12.3358 9.82014C12.1171 10.06 11.7623 10.06 11.5436 9.82014L8.49994 6.4829L5.45638 9.82004C5.23756 10.0599 4.88284 10.0599 4.66411 9.82004C4.4453 9.58022 4.4453 9.19126 4.66411 8.95134L8.10393 5.1798C8.21335 5.05989 8.3566 5 8.49992 5C8.64332 5 8.78668 5.06 8.89604 5.17989Z"
                                      fill="#005DFF"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="forms">
                <div id="b-form-order-ajax-errors"></div>
                <?if($policyObj->active):?>
                <div class="form b-step-top" id="form-1">
                    <div class="h4 form__title">
                        <span class="form__title-blue">Страхование</span>
                        <span class="form__title-step">Шаг <?=$curStep++?></span>
                    </div>

                    <div class="form__content">
                            <div class="form__section">
                                <div class="h4">
                                    Общая информация для оформления полиса
                                    <span style="display: none" class="form__required">Заполните обязательные поля *</span>
                                </div>
                                <div class="form__section__content sex">
                                    <span>Пол *</span>
                                    <input type="radio" name="policyContactInfo[sex]" value="Мужской" id="male" checked>
                                    <label for="male"></label>
                                    <label for="male">Мужской</label>
                                    <input type="radio" name="policyContactInfo[sex]" value="Женский" id="female">
                                    <label for="female"></label>
                                    <label for="female">Женский</label>
                                </div>
                                <div class="form__section__content name">
                                    <input type="text" name="policyContactInfo[surname]" placeholder="Фамилия *" class="js-policy-validate js-check-valid-field text-field">
                                    <input type="text" name="policyContactInfo[name]" placeholder="Имя *" class="js-policy-validate js-check-valid-field text-field">
                                    <input type="text" name="policyContactInfo[patronomic]" placeholder="Отчество" class="js-check-valid-field text-field">
                                    <input type="text" name="policyContactInfo[date]" placeholder="Дата рождения *"
                                           onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'"
                                           class="date js-policy-validate js-check-valid-field">
                                    <input type="text" name="policyContactInfo[place]" placeholder="Место рождения *"
                                           class="address-field js-policy-validate js-check-valid-field"><br>
                                    <input class="js-check-valid-field js-policy-validate" type="text" name="policyContactInfo[email]" placeholder="E-mail *"><br>
                                    <input class="js-check-valid-field js-policy-validate" type="text" name="policyContactInfo[phone]" placeholder="Телефон *" id="phone-field">
                                </div>
                            </div>
                            <div class="form__section">
                                <div class="h4">Паспортные данные</div>

                                <div class="form__section__content passport">
                                    <input class="js-check-valid-field js-policy-validate" type="text" name="passportData[number]" placeholder="Серия и номер паспорта *"
                                           id="passport">
                                    <input class="js-check-valid-field js-policy-validate date" type="text" name="passportData[date]" placeholder="Дата выдачи *"
                                           onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'"><br>
                                    <input type="text" name="passportData[whom]" placeholder="Кем выдан *" class="js-check-valid-field js-policy-validate text-field">
                                    <input class="js-check-valid-field js-policy-validate" type="text" name="passportData[code]" placeholder="Код подразделения *" id="code">
                                    <input class="js-check-valid-field" type="text" name="passportData[inn]" placeholder="ИНН" id="inn">
                                </div>
                            </div>
                            <div class="form__section">
                                <div class="h4">Адрес регистрации</div>
                                <div class="form__section__content address-registration">
                                    <input type="text" name="addressRegistration[city]" placeholder="Город/населенный пункт *"
                                           class="js-policy-validate address-field js-check-valid-field">
                                    <input type="text" name="addressRegistration[street]" placeholder="Улица *" class="js-policy-validate js-check-valid-field street-field"><br>
                                    <input type="text" name="addressRegistration[house]" placeholder="Дом *" class="js-policy-validate js-check-valid-field house-field">
                                    <input type="text" name="addressRegistration[housing]" placeholder="Корпус" class="js-check-valid-field housing-field">
                                    <input type="text" name="addressRegistration[flat]" placeholder="Квартира" class="js-check-valid-field flat-field"><br>
                                    <input class="js-policy-validate js-check-valid-field date" type="text" name="addressRegistration[date]" placeholder="Дата регистрации *"
                                           onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'">
                                    <input type="text" name="addressRegistration[index]" placeholder="Индекс" class="js-check-valid-field index-field">
                                </div>
                                <div class="h4">Адрес фактического проживания</div>
                                <div class="form__section__content address-residense">
                                    <input type="checkbox" name="same" id="same" checked>
                                    <label for="same">Совпадает с адресом постоянной регистрации</label>
                                    <div class="no-checked address-registration">
                                        <input type="text" name="addressResidense[city]" placeholder="Город/населенный пункт *"
                                               class="valid-cond1 js-check-valid-field address-field">
                                        <input type="text" name="addressResidense[street]" placeholder="Улица *" class="valid-cond1 js-check-valid-field street-field"><br>
                                        <input type="text" name="addressResidense[house]" placeholder="Дом *" class="valid-cond1 js-check-valid-field house-field">
                                        <input type="text" name="addressResidense[housing]" placeholder="Корпус" class="js-check-valid-field housing-field">
                                        <input type="text" name="addressResidense[flat]" placeholder="Квартира" class="js-check-valid-field flat-field"><br>
                                        <input class="valid-cond1 js-check-valid-field date" type="text" name="addressResidense[date]" placeholder="Дата регистрации *"
                                               onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'">
                                        <input type="text" name="addressResidense[index]" placeholder="Индекс" class="js-check-valid-field index-field">
                                    </div>
                                    <p>Если адрес фактического проживания не совпадает с адресом регистрации - снимите
                                        галочку и укажите
                                        достоверную информацию. Это важно.</p>
                                </div>
                                <div class="h4">Адрес квартиры, для которой вы оформляете страховку</div>
                                <div class="form__section__content address-installment">
                                    <div class="radio-wrapper">
                                        <input checked type="radio" name="address-installment" value="1" id="permanent">
                                        <label for="permanent"></label>
                                        <label for="permanent">Совпадает с адресом постоянной регистрации</label>
                                    </div>
                                    <div class="radio-wrapper" id="b-actual">
                                        <input type="radio" name="address-installment" value="2" id="actual">
                                        <label for="actual"></label>
                                        <label for="actual">Совпадает с адресом фактического проживания</label>
                                    </div>
                                    <input type="radio" name="address-installment" value="3" id="other">
                                    <label for="other"></label>
                                    <label for="other">Указать другой адрес</label>
                                    <p>Если адрес объекта страхования не совпадает с адресом регистрации или адресом
                                        фактического
                                        проживания - выберите пункт <span>“Указать другой адрес”</span>. Это важно.</p>
                                    <div class="address-registration address-installment-other">
                                        <input id="b-uq" type="text" name="policyOtherAddress[city]" placeholder="Город/населенный пункт *"
                                               class="valid-cond2 js-check-valid-field address-field">
                                        <input type="text" name="policyOtherAddress[street]" placeholder="Улица *" class="valid-cond2 js-check-valid-field street-field"><br>
                                        <input type="text" name="policyOtherAddress[house]" placeholder="Дом *" class="valid-cond2 js-check-valid-field house-field">
                                        <input type="text" name="policyOtherAddress[housing]" placeholder="Корпус" class="js-check-valid-field housing-field">
                                        <input type="text" name="policyOtherAddress[flat]" placeholder="Квартира" class="js-check-valid-field flat-field"><br>
                                        <input class="valid-cond2 js-check-valid-field date" type="text" name="policyOtherAddress[date]" placeholder="Дата регистрации *"
                                               onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'">
                                        <input type="text" name="policyOtherAddress[index]" placeholder="Индекс" class="js-check-valid-field index-field">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="form__bottom">
                        <button type="button" class="disabled blue-button form__next-button" id="js-policy-validate-btn"><span>Далее</span></button>
                        <div class="form__complete hidden">
                            <svg width="13" height="10" viewBox="0 0 13 10" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.13132 7.88963L1.04946 4.78001L0 5.83147L4.13132 10L13 1.05145L11.9579 0L4.13132 7.88963Z"
                                      fill="#005DFF"/>
                            </svg>
                            <span>Данные введены</span>
                        </div>
                    </div>
                </div>
                <?endif;?>
                <?if($complectObj->active || $subscriptionFeeObj->active):?>
                <div class="form b-step-top <?=$policyObj->active ? 'def-close' : $curStep=1?>" id="form-2">
                    <div class="h4 form__title">
                        <span class="form__title-blue"><?if($complectObj->active):?>Доставка<?;else:?>Контактная информация<?endif;?></span>
                        <span class="form__title-step">Шаг <?=$curStep++;?></span>
                    </div>
                    <div class="form__content">
                            <div class="form__section">
                                <div class="h4">
                                    Данные контактного лица
                                    <span style="display: none" class="form__required">Заполните обязательные поля *</span>
                                </div>
                                <div class="form__section__content">
                                    <?if($policyObj->active):?>
                                    <input type="checkbox" name="same-name" id="same-name" checked>
                                    <label for="same-name">Совпадает с указанными данными в “Шаге 1”</label>
                                    <div class="form__contact-person">
                                        <div class="contact-person__name contact-person__data">
                                            Иванов Иван Иванович
                                        </div>
                                        <div class="contact-person__email contact-person__data">
                                            mailmy@mail.com
                                        </div>
                                        <div class="contact-person__phone contact-person__data">
                                            +7 (000) 000 - 00 - 00
                                        </div>
                                    </div>
                                    <?else:?>
                                        <input hidden type="checkbox" name="same-name" id="same-name">
                                    <?endif;?>
                                    <div class="form__contact-person no-checked">
                                        <input type="text" name="contactData[surname]" placeholder="Фамилия *" class="valid-cond3 js-check-valid-field text-field">
                                        <input type="text" name="contactData[name]" placeholder="Имя *" class="valid-cond3 js-check-valid-field text-field">
                                        <input type="text" name="contactData[patronomic]" placeholder="Отчество" class="js-check-valid-field text-field">
                                        <br>
                                        <input type="text" name="contactData[email]" placeholder="E-mail *" class="valid-cond3 js-check-valid-field"><br>
                                        <input type="text" name="contactData[phone]" placeholder="Телефон *" class="valid-cond3 js-check-valid-field phone-field">
                                    </div>
                                </div>
                            </div>
                            <?if($complectObj->active):?>
                            <div class="form__section">
                                <div class="h4">
                                    Адрес доставки
                                    <span class="form__delivery">СДЭК
                                        <span class="form__delivery-cost">Бесплатно</span>
                                    </span>
                                </div>
                                <div class="form__section__content address-installment">
                                    <?if($policyObj->active):?>
                                    <div class="radio-wrapper">
                                        <input checked type="radio" name="delivery-address-installment" value="1"
                                               id="permanent-delivery">
                                        <label for="permanent-delivery"></label>
                                        <label for="permanent-delivery">Совпадает с адресом постоянной
                                            регистрации</label>
                                    </div>
                                    <div class="radio-wrapper" id="b-actual-delivery">
                                        <input type="radio" name="delivery-address-installment" value="2" id="actual-delivery">
                                        <label for="actual-delivery"></label>
                                        <label for="actual-delivery">Совпадает с адресом фактического проживания</label>
                                    </div>
                                    <?endif;?>
                                    <input <?=$policyObj->active ? '' : 'checked style="display:none;"'?> type="radio" name="delivery-address-installment" value="3" id="other-delivery">
                                    <label <?=$policyObj->active ? '' : 'checked style="display:none;"'?> for="other-delivery"></label>
                                    <label <?=$policyObj->active ? '' : 'checked style="display:none;"'?> for="other-delivery">Указать другой адрес</label>

                                    <div class="input-address">
                                        Россия, Москва, переулок Свободы, дом 21, квартира 12
                                    </div>
                                    <div class="address-registration address-installment-other">
                                        <input type="text" name="deliveryOtherAddress[city]" placeholder="Город/населенный пункт *"
                                               class="valid-cond4 js-check-valid-field address-field">
                                        <input type="text" name="deliveryOtherAddress[street]" placeholder="Улица *" class="valid-cond4 js-check-valid-field street-field"><br>
                                        <input type="text" name="deliveryOtherAddress[house]" placeholder="Дом *" class="valid-cond4 js-check-valid-field house-field">
                                        <input type="text" name="deliveryOtherAddress[housing]" placeholder="Корпус" class="js-check-valid-field housing-field">
                                        <input type="text" name="deliveryOtherAddress[flat]" placeholder="Квартира" class="js-check-valid-field flat-field"><br>
                                        <input type="text" name="deliveryOtherAddress[index]" placeholder="Индекс" class="js-check-valid-field index-field">
                                    </div>
                                    <textarea name="orderComment" placeholder="Комментарий к заказу"></textarea>
                                </div>
                                <div class="h4">
                                    Дата и время монтажа оборудования
                                    <span class="form__delivery-cost">Бесплатно</span>
                                </div>
                                <input class="js-check-valid-field date date-install" type="text" name="date-install"
                                       placeholder="Дата и время *">
                            </div>
                            <?endif;?>
                    </div>
                    <div class="form__bottom">
                        <button id="js-item-validate-btn" type="button" class="disabled blue-button form__next-button"><span>Далее</span></button>
                        <div class="form__complete hidden">
                            <svg width="13" height="10" viewBox="0 0 13 10" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.13132 7.88963L1.04946 4.78001L0 5.83147L4.13132 10L13 1.05145L11.9579 0L4.13132 7.88963Z"
                                      fill="#005DFF"/>
                            </svg>
                            <span>Данные введены</span>
                        </div>
                    </div>
                </div>
                <?endif;?>
                <div class="form form__payment def-close" id="form-3">
                    <div class="h4 form__title">
                        <span class="form__title-blue">Оплата</span>
                        <span class="form__title-step">Шаг <?=$curStep?></span>
                    </div>

                    <div class="form__content">
                            <div class="form__section">
                                <h4>Способ оплаты</h4>
                                <div class="form__section__content payment-method">
                                    <div class="payment-method-left">
                                        <div class="radio-wrapper" id="card-radio">
                                            <input type="radio" name="payment-method" value="10" id="card" <?=$paymentMethodObj=='installment' ? '' : 'checked'?>>
                                            <label for="card"></label>
                                            <label for="card">Картой онлайн</label>
                                        </div>
                                        <div class="radio-wrapper" id="installment-radio">
                                            <input type="radio" name="payment-method" value="11"
                                                   id="installment" <?=$paymentMethodObj=='installment' ? 'checked' : ''?>>
                                            <label for="installment"></label>
                                            <label for="installment">Покупай со Сбером в рассрочку
                                                <svg width="30" height="28" viewBox="0 0 30 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.06601 1.02619C5.62548 1.10807 4.34234 1.95931 3.7081 3.25384L0.407119 9.99142C-0.217582 11.2665 -0.117965 12.7786 0.668809 13.9637L4.68725 20.0165C5.47514 21.2033 6.83354 21.8835 8.25442 21.8027L26.2287 20.781C28.4342 20.6557 30.1168 18.7663 29.9867 16.561L29.2326 3.77262C29.1025 1.56731 27.2091 -0.118809 25.0035 0.00656221L7.06601 1.02619ZM5.44963 13.447C6.43656 13.447 7.23663 12.6619 7.23663 11.6934C7.23663 10.725 6.43656 9.93986 5.44963 9.93986C4.4627 9.93986 3.66263 10.725 3.66263 11.6934C3.66263 12.6619 4.4627 13.447 5.44963 13.447Z" fill="url(#paint0_linear)"/>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.06601 1.02619C5.62548 1.10807 4.34234 1.95931 3.7081 3.25384L0.407119 9.99142C-0.217582 11.2665 -0.117965 12.7786 0.668809 13.9637L4.68725 20.0165C5.47514 21.2033 6.83354 21.8835 8.25442 21.8027L26.2287 20.781C28.4342 20.6557 30.1168 18.7663 29.9867 16.561L29.2326 3.77262C29.1025 1.56731 27.2091 -0.118809 25.0035 0.00656221L7.06601 1.02619ZM5.44963 13.447C6.43656 13.447 7.23663 12.6619 7.23663 11.6934C7.23663 10.725 6.43656 9.93986 5.44963 9.93986C4.4627 9.93986 3.66263 10.725 3.66263 11.6934C3.66263 12.6619 4.4627 13.447 5.44963 13.447Z" fill="url(#paint1_radial)"/>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M21.4162 5.39661L22.9287 4.03079C21.3557 3.04594 19.433 2.54373 17.4223 2.75978L17.4241 2.7761C15.2562 3.01322 13.3668 4.03657 12.0201 5.5238L12.0121 5.51691C10.4749 7.20975 9.65525 9.49663 9.91757 11.9143C9.91789 11.9173 9.91821 11.9203 9.91855 11.9233C9.91861 11.9239 9.91867 11.9244 9.91874 11.925C9.91927 11.9299 9.91981 11.9347 9.92035 11.9396L9.92038 11.9396C10.1617 14.0645 11.2053 15.9162 12.7222 17.236L12.7152 17.2437C14.44 18.7485 16.7696 19.5513 19.2331 19.2961C19.2352 19.2959 19.2372 19.2957 19.2392 19.2955C19.243 19.2952 19.2467 19.2948 19.2504 19.2944C21.4297 19.0602 23.3285 18.0317 24.6793 16.5358L24.6955 16.5499C26.2233 14.8693 27.0581 12.5542 26.7873 10.1273C26.731 9.62233 26.6266 9.13903 26.489 8.6593L24.8249 10.1733L24.8431 10.3362C25.0395 12.0971 24.4825 13.7641 23.4316 15.0355L23.4152 15.0226C22.3829 16.3204 20.8491 17.194 19.0544 17.3868L19.0544 17.3868L19.0544 17.3868C18.9977 17.3929 18.9411 17.3983 18.8846 17.4029C18.8315 17.4065 18.778 17.4081 18.7202 17.4063L18.7207 17.4143C17.0523 17.5099 15.4847 16.973 14.2697 16.0118L14.2755 16.0047C12.9684 14.9912 12.0609 13.4898 11.8646 11.7307C11.8642 11.7263 11.8637 11.722 11.8632 11.7178C11.8576 11.6666 11.8526 11.6154 11.8483 11.5644C11.8446 11.5123 11.843 11.4599 11.8449 11.4031L11.8368 11.4036C11.7416 9.78027 12.2884 8.23257 13.2687 7.04038L13.2759 7.04603C14.3101 5.76456 15.8587 4.87289 17.6367 4.68183C17.7531 4.66934 17.8528 4.65862 17.9709 4.66241L17.9697 4.64155C19.2128 4.58212 20.3987 4.85532 21.4162 5.39661ZM25.6597 6.80331C25.3118 6.24728 24.9176 5.72919 24.4624 5.2671L18.3183 10.79L14.8911 9.16368L15.1565 11.5418L18.6021 13.1826L25.6597 6.80331Z" fill="white"/>
                                                    <path d="M1.49028 27.0243C2.33542 27.0243 2.85245 26.7365 2.85245 26.0291C2.85245 25.5852 2.65857 25.3168 2.23102 25.2437C2.58897 25.1071 2.74805 24.8485 2.74805 24.4582C2.74805 23.8923 2.35034 23.6094 1.57479 23.6094H0.0634766V27.0243H1.49028ZM0.684906 26.4633V25.5315H1.53999C1.97748 25.5315 2.22605 25.6583 2.22605 25.9852C2.22605 26.3121 2.00731 26.4633 1.53005 26.4633H0.684906ZM0.684906 25.0534V24.1704H1.50022C1.94268 24.1704 2.12662 24.3168 2.12662 24.5899C2.12662 24.8827 1.87805 25.0534 1.48531 25.0534H0.684906Z" fill="#62D53F"/>
                                                    <path d="M4.751 27.9659H5.33265V26.6535C5.45694 26.8828 5.73037 27.078 6.12808 27.078C6.80917 27.078 7.25163 26.7121 7.25163 25.751C7.25163 24.8973 6.80917 24.5363 6.1778 24.5363C5.65083 24.5363 5.38734 24.8192 5.29785 25.0924V24.5851H4.751V27.9659ZM5.33265 25.7022C5.3426 25.2925 5.5514 25.0436 6.00877 25.0436C6.40648 25.0436 6.66997 25.2388 6.66997 25.7754C6.66997 26.3511 6.46614 26.5755 5.99883 26.5755C5.59117 26.5755 5.33265 26.3267 5.33265 25.8876V25.7022Z" fill="#62D53F"/>
                                                    <path d="M7.84498 25.4681C8.01401 25.2095 8.27749 25.0339 8.73487 25.0339C9.06795 25.0339 9.23698 25.1412 9.23698 25.4876V25.5949H8.67521C8.06372 25.5949 7.65109 25.751 7.65109 26.3072C7.65109 26.7853 7.94938 27.0633 8.45149 27.0633C8.84921 27.0633 9.15246 26.8682 9.27178 26.5852V27.0243H9.81864V25.4144C9.81864 24.7802 9.46069 24.5363 8.73487 24.5363C8.30732 24.5363 8.00903 24.6339 7.84498 24.7558V25.4681ZM8.63544 26.5511C8.37692 26.5511 8.23772 26.434 8.23772 26.2486C8.23772 26.0291 8.40178 25.9657 8.74481 25.9657H9.23698V26.1657C9.21212 26.3316 9.02818 26.5511 8.63544 26.5511Z" fill="#62D53F"/>
                                                    <path d="M12.4681 26.7804V26.195C12.3439 26.4096 12.0704 26.5804 11.6578 26.5804C11.1905 26.5804 10.9121 26.3462 10.9121 25.8437V25.7705C10.9121 25.2778 11.1706 25.029 11.6479 25.029C12.0108 25.0339 12.2743 25.2095 12.4433 25.4681V24.7558C12.2792 24.6339 11.9809 24.5363 11.6479 24.5314C10.8574 24.5363 10.3205 24.9558 10.3205 25.7949C10.3205 26.6487 10.8475 27.078 11.6429 27.078C12.0456 27.078 12.3588 26.917 12.4681 26.7804Z" fill="#62D53F"/>
                                                    <path d="M14.915 26.7804V26.195C14.7907 26.4096 14.5173 26.5804 14.1047 26.5804C13.6374 26.5804 13.359 26.3462 13.359 25.8437V25.7705C13.359 25.2778 13.6175 25.029 14.0947 25.029C14.4576 25.0339 14.7211 25.2095 14.8902 25.4681V24.7558C14.7261 24.6339 14.4278 24.5363 14.0947 24.5314C13.3043 24.5363 12.7674 24.9558 12.7674 25.7949C12.7674 26.6487 13.2943 27.078 14.0898 27.078C14.4924 27.078 14.8056 26.917 14.915 26.7804Z" fill="#62D53F"/>
                                                    <path d="M15.4464 27.9659H16.028V26.6535C16.1523 26.8828 16.4258 27.078 16.8235 27.078C17.5046 27.078 17.947 26.7121 17.947 25.751C17.947 24.8973 17.5046 24.5363 16.8732 24.5363C16.3462 24.5363 16.0827 24.8192 15.9932 25.0924V24.5851H15.4464V27.9659ZM16.028 25.7022C16.038 25.2925 16.2468 25.0436 16.7042 25.0436C17.1019 25.0436 17.3654 25.2388 17.3654 25.7754C17.3654 26.3511 17.1615 26.5755 16.6942 26.5755C16.2866 26.5755 16.028 26.3267 16.028 25.8876V25.7022Z" fill="#62D53F"/>
                                                    <path d="M19.5893 27.078C20.3599 27.0731 20.8819 26.6584 20.8819 25.8144C20.8819 24.9656 20.3798 24.5363 19.6092 24.5314C18.8337 24.5314 18.3117 24.951 18.3117 25.7949C18.3117 26.6487 18.8138 27.078 19.5893 27.078ZM18.9033 25.7949C18.9033 25.2827 19.1469 25.0339 19.5893 25.029C20.0268 25.029 20.2903 25.2632 20.2903 25.7998V25.8144C20.2903 26.3316 20.0417 26.5804 19.5993 26.5804C19.1618 26.5804 18.9033 26.3462 18.9033 25.8096V25.7949Z" fill="#62D53F"/>
                                                    <path d="M22.9243 27.0243H23.5059V24.5851H22.9243V25.6876C22.7751 25.7608 22.5862 25.7998 22.3874 25.7998C22.0791 25.7998 21.9101 25.6632 21.9101 25.3705V24.5851H21.3284V25.4583C21.3284 26.0437 21.6864 26.3072 22.283 26.3072C22.5116 26.3072 22.7503 26.2633 22.9243 26.1657V27.0243Z" fill="#62D53F"/>
                                                    <path d="M24.2095 27.0243H24.7912V26.0145H25.1889L25.9694 27.0243H26.6753L25.6661 25.7364L26.5361 24.5851H25.8899L25.1938 25.5364H24.7912V24.5851H24.2095V27.0243Z" fill="#62D53F"/>
                                                    <path d="M27.8293 27.0341C27.7349 27.3658 27.6006 27.4829 27.4217 27.4829C27.3123 27.4829 27.198 27.4341 27.1234 27.3609V27.8927C27.198 27.9561 27.367 28 27.5211 28C27.8492 28 28.0729 27.8683 28.2917 27.2829L29.286 24.5851H28.6695L28.1127 26.2584L27.4316 24.5851H26.7804L27.8293 27.0341Z" fill="#62D53F"/>
                                                    <defs>
                                                        <linearGradient id="paint0_linear" x1="28.1438" y1="8.03485e-07" x2="28.4876" y2="21.8402" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#0381DF"/>
                                                            <stop offset="0.827488" stop-color="#279632"/>
                                                        </linearGradient>
                                                        <radialGradient id="paint1_radial" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(3.88596 21.84) rotate(-67.5451) scale(29.2883 27.1197)">
                                                            <stop stop-color="#FFFD54"/>
                                                            <stop offset="0.47658" stop-color="#62D53F"/>
                                                            <stop offset="1" stop-color="#49A9EF" stop-opacity="0.4"/>
                                                        </radialGradient>
                                                    </defs>
                                                </svg>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="payment-method-right">
                                        <div class="payment-method__card <?=$paymentMethodObj=='installment' ? '' : 'active'?>">
                                            <h4>Всего</h4>
                                            <?if(intval($totalObj->total_sum)!=intval($totalObj->total_old_sum)):?>
                                                <div class="payment-method__old-price"><?=$totalObj->total_old_sum?> ₽</div>
                                                <div class="payment-method__price"><?=$totalObj->total_sum?> ₽</div>
                                            <?else:?>
                                                <div class="payment-method__price"><?=$totalObj->total_old_sum?> ₽</div>
                                            <?endif;?>

                                        </div>
                                        <div class="payment-method__installment <?=$paymentMethodObj=='installment' ? 'active' : ''?>">
                                            <div class="payment-method__installment-title">
                                                <span>Проценты <br> платит <span>vincko:</span></span>
                                                <select name="solutions__bottom_column-select"
                                                        data-price="<?=$totalObj->total_sum?>"
                                                        class="solutions__bottom_column-select js-installment-period">
                                                    <? foreach ($periodInstall as $period): ?>
                                                        <option value="<?=$period["UF_MONTHS"]?>"><?=$period["UF_MONTHS"]?> мес.</option>
                                                    <? endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="payment-method__price-month">1 000 ₽/мес</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form__section form__pay-info">
                                <div class="form__section__content">
                                    <p>Выберите способ оплаты. В случае оплаты картой, после нажатия кнопки <br>
                                        “Оформить заказ” Вы будете перенаправлены на сайт банка для совершения оплаты заказа.<br>
                                        В случае выбора способа оплаты “Покупай со Сбером в рассрочку” <br>
                                        Вы будете перенаправлены на сайт ПАО Сбербанк для оформления рассрочки.
                                        <a target="_blank" href="https://pokupay.ru/credit_terms">Подробнее об условиях рассрочки</a></p>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="installment__right-column order__right-column">
            <div class="ready-pack__item-wrapper">
                <div class="ready-pack__item ready-pack__item--short">
                    <div class="ready-pack__top">
                        <picture>
                            <source srcset="<?=$complectObj->package_info->picture_src?>">
                            <img src="<?=$complectObj->package_info->picture_src?>" alt="var-image-1">
                        </picture>
                        <div class="ready-pack__top-title">
                            <div class="text">Вариант</div>
                            <div class="ready-pack__global-type">
                                <?=$complectObj->name1?>
                            </div>
                        </div>
                    </div>
                    <div class="ready-pack__mid ready-pack__mid--short">
                        <div class="ready-pack__mid--short-title">
                            Вариант решения включает:
                        </div>
                        <div class="ready-pack__short-list">
                            <?if($complectObj->active):?>
                            <div class="ready-pack__short-item">
                                <div class="ready-pack__short-img">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M7.2 0H8.8V2.4H7.2V0ZM13.0916 1.77715L14.223 2.9085L12.5259 4.60547L11.3945 3.47412L13.0916 1.77715ZM16 7.2H13.6V8.8H16V7.2ZM0 7.2H2.4V8.8H0V7.2ZM4.60568 3.47471L2.90859 1.77773L1.77721 2.90908L3.47429 4.60605L4.60568 3.47471ZM12 11.2V8C12 5.79443 10.2056 4 8 4C5.7944 4 4 5.79443 4 8V11.2C2.67679 11.2 1.6 12.2768 1.6 13.6C1.6 14.9232 2.67679 16 4 16H12C13.3232 16 14.4 14.9232 14.4 13.6C14.4 12.2768 13.3232 11.2 12 11.2ZM5.6 8C5.6 6.67676 6.67679 5.6 8 5.6C9.32321 5.6 10.4 6.67676 10.4 8V11.2H5.6V8ZM4 14.4C3.5592 14.4 3.2 14.0416 3.2 13.6C3.2 13.1584 3.5592 12.8 4 12.8H12C12.4416 12.8 12.8 13.1584 12.8 13.6C12.8 14.0416 12.4416 14.4 12 14.4H4ZM8 6.4V7.99844L9.6 8C9.6 7.11758 8.8832 6.4 8 6.4Z"
                                              fill="#005DFF"/>
                                    </svg>

                                </div>

                                <div class="ready-pack__short-title">
                                    Оборудование
                                    <div class="ready-pack__subscription">
                                        Подписка
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.0003 1.66669C5.40033 1.66669 1.66699 5.40002 1.66699 10C1.66699 14.6 5.40033 18.3334 10.0003 18.3334C14.6003 18.3334 18.3337 14.6 18.3337 10C18.3337 5.40002 14.6003 1.66669 10.0003 1.66669ZM10.7587 15.125C10.7004 15.1821 10.6267 15.2209 10.5467 15.2365C10.4666 15.2521 10.3837 15.2438 10.3083 15.2128C10.2329 15.1817 10.1682 15.1292 10.1224 15.0618C10.0765 14.9943 10.0515 14.9149 10.0503 14.8334V14.1667H10.0003C8.93366 14.1667 7.86699 13.7584 7.05033 12.95C6.48452 12.3828 6.09403 11.6647 5.92556 10.8814C5.75709 10.0982 5.81776 9.28302 6.10033 8.53335C6.25866 8.10835 6.81699 8.00002 7.13366 8.32502C7.31699 8.50835 7.35866 8.77502 7.27533 9.00835C6.89199 10.0417 7.10866 11.2417 7.94199 12.075C8.52533 12.6584 9.29199 12.9334 10.0587 12.9167V12.1334C10.0587 11.7584 10.5087 11.575 10.767 11.8417L12.117 13.1917C12.2837 13.3584 12.2837 13.6167 12.117 13.7834L10.7587 15.125ZM12.867 11.6834C12.7809 11.5947 12.7218 11.4833 12.6967 11.3623C12.6716 11.2413 12.6815 11.1156 12.7253 11C13.1087 9.96669 12.892 8.76669 12.0587 7.93335C11.4753 7.35002 10.7087 7.06669 9.95033 7.08335V7.86669C9.95033 8.24169 9.50033 8.42502 9.24199 8.15835L7.88366 6.81669C7.71699 6.65002 7.71699 6.39169 7.88366 6.22502L9.23366 4.87502C9.2919 4.81792 9.36561 4.77917 9.44567 4.76357C9.52572 4.74797 9.6086 4.7562 9.68401 4.78726C9.75943 4.81831 9.82407 4.87082 9.86993 4.93826C9.91579 5.00571 9.94085 5.08513 9.94199 5.16669V5.84169C11.0253 5.82502 12.117 6.21669 12.942 7.05002C13.5078 7.61721 13.8983 8.33535 14.0668 9.11859C14.2352 9.90183 14.1746 10.717 13.892 11.4667C13.7337 11.9 13.1837 12.0084 12.867 11.6834Z"
                                                  fill="#3CBA54"/>
                                        </svg>
                                    </div>
                                </div>

                                <div class="ready-pack__short-content ready-pack__short-content-h blue">
                                    <?=$complectObj->name2?>
                                </div>
                            </div>
                            <?endif;?>
                            <?if($subscriptionFeeObj->active):?>
                            <div class="ready-pack__short-item">
                                <div class="ready-pack__short-img">
                                    <svg width="14" height="18" viewBox="0 0 14 18" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M4.6654 6.60938H11.9412C13.0764 6.60938 14 7.55564 14 8.71875V15.8906C14 17.0537 13.0764 18 11.9412 18H2.05882C0.923588 18 0 17.0537 0 15.8906V8.71875C0 7.55564 0.923588 6.60938 2.05882 6.60938H3.29285V3.71848C3.29285 1.66809 4.95531 0 6.99873 0C9.04215 0 10.7046 1.66809 10.7046 3.71848V6.60938H9.33206V3.71848C9.33206 2.4435 8.28532 1.40625 6.99873 1.40625C5.71214 1.40625 4.6654 2.4435 4.6654 3.71848V6.60938ZM11.9412 16.5938C12.3196 16.5938 12.6275 16.2783 12.6275 15.8906V8.71875C12.6275 8.33105 12.3196 8.01562 11.9412 8.01562H2.05882C1.68041 8.01562 1.37255 8.33105 1.37255 8.71875V15.8906C1.37255 16.2783 1.68041 16.5938 2.05882 16.5938H11.9412ZM5.73039 11.3555C5.73039 10.6371 6.2988 10.0547 7 10.0547C7.7012 10.0547 8.26961 10.6371 8.26961 11.3555C8.26961 11.8153 8.03652 12.2191 7.68501 12.4504V13.9922C7.68501 14.3805 7.37773 14.6953 6.99873 14.6953C6.6197 14.6953 6.31246 14.3805 6.31246 13.9922V12.4488C5.96235 12.2171 5.73039 11.8142 5.73039 11.3555Z"
                                              fill="#005DFF"/>
                                    </svg>


                                </div>

                                <div class="ready-pack__short-title">
                                    Договор с охранной компанией
                                </div>

                                <div class="ready-pack__short-content ready-pack__short-content-h">
                                    <?=$subscriptionFeeObj->name2?>
                                    <br>
                                    на <?=$subscriptionFeeObj->name1?>
                                </div>
                            </div>
                            <?endif;?>
                            <?if($policyObj->active):?>
                            <div class="ready-pack__short-item">
                                <div class="ready-pack__short-img">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <rect width="24" height="24" fill="white"/>
                                        <path d="M9.338 5.04486C8.38559 5.30735 7.11663 5.81082 6.17798 6.11892C6.09227 6.14668 6.01608 6.19796 5.95809 6.26691C5.9001 6.33586 5.86264 6.41972 5.84998 6.50892C5.29598 10.6659 6.36063 14.135 7.88763 16.133C8.53415 16.9874 9.84341 18.2852 10.713 18.9112C11.059 19.1552 11.365 19.3312 11.606 19.4442C11.726 19.5012 11.824 19.5392 11.899 19.5622C11.9318 19.5737 11.9656 19.582 12 19.5872C12.034 19.5816 12.0674 19.5733 12.1 19.5622C12.176 19.5392 12.274 19.5012 12.394 19.4442C12.634 19.3312 12.941 19.1542 13.287 18.9112C14.1566 18.2852 15.4658 16.9874 16.1124 16.133C17.6394 14.136 18.704 10.6659 18.15 6.50892C18.1375 6.41968 18.1001 6.33577 18.042 6.2668C17.984 6.19783 17.9078 6.14658 17.822 6.11892C17.171 5.90592 15.749 5.34086 14.662 5.04586C13.552 4.74486 12.531 4.52186 12 4.52186C11.47 4.52186 10.448 4.74486 9.338 5.04586V5.04486ZM9.072 4.56C10.157 4.265 11.31 4 12 4C12.69 4 13.843 4.265 14.928 4.56C16.038 4.86 17.157 5.215 17.815 5.43C18.0901 5.52085 18.334 5.68747 18.5187 5.9107C18.7034 6.13394 18.8213 6.40474 18.859 6.692C19.455 11.169 18.072 14.487 16.394 16.682C15.6824 17.621 14.834 18.4479 13.877 19.135C13.5461 19.3728 13.1955 19.5819 12.829 19.76C12.549 19.892 12.248 20 12 20C11.752 20 11.452 19.892 11.171 19.76C10.8045 19.5819 10.4539 19.3728 10.123 19.135C9.16603 18.4478 8.31758 17.621 7.606 16.682C5.928 14.487 4.54501 11.169 5.14101 6.692C5.17869 6.40474 5.29665 6.13394 5.48132 5.9107C5.666 5.68747 5.9099 5.52085 6.185 5.43C7.1402 5.11681 8.10281 4.82672 9.072 4.56Z"
                                              fill="#005DFF" stroke="#005DFF"/>
                                        <path d="M14.9755 9.17508L11.5805 12.5568L10.0245 11.0068C9.79017 10.7734 9.41016 10.7734 9.17578 11.0068C8.94141 11.2403 8.94141 11.6187 9.17578 11.8522L11.1561 13.8249C11.2687 13.937 11.4213 14 11.5805 14C11.5805 14 11.5805 14 11.5805 14C11.7397 14 11.8923 13.937 12.0048 13.8249L15.8242 10.0205C16.0586 9.78707 16.0586 9.40858 15.8242 9.17512C15.5898 8.94165 15.2099 8.94161 14.9755 9.17508Z"
                                              fill="#005DFF"/>
                                    </svg>


                                </div>

                                <div class="ready-pack__short-title">
                                    Страхование недвижимости
                                </div>

                                <div class="ready-pack__short-content ready-pack__short-content-text">
                                    Полис “<?=$policyObj->policy_name?>"
                                    <br>
                                    на <?=$policyObj->name2?>
                                </div>
                            </div>
                            <?endif;?>
                        </div>

                     <?if(sizeof($complectObj->gift)>0):?>
                        <div class="predloj__present">
                            <div class="present__text">
                                <div class="h5">В подарок:</div>
                                <ul>
                                    <?foreach ($complectObj->gift as $gift):?>
                                    <li><span>&#10003;</span><?=$gift?></li>
                                    <?endforeach;?>
                                </ul>
                            </div>
                            <picture>
                                <source type="image/svg" srcset="/upload/images/equipment/podarok.svg">
                                <img src="/upload/images/equipment/podarok.svg" alt="img" loading="lazy">
                            </picture>
                        </div>
                     <?endif;?>
                    </div>
                    <div class="short-rd__price">
                        <div class="short-rd__price-title">Всего</div>
                        <?if(intval($totalObj->total_sum)!=intval($totalObj->total_old_sum)):?>
                        <div class="short-rd__price-old"><?=$totalObj->total_old_sum?> ₽</div>
                        <div class="short-rd__cost"><?=$totalObj->total_sum?> ₽</div>
                        <?else:?>
                            <div class="short-rd__cost"><?=$totalObj->total_old_sum?> ₽</div>
                        <?endif;?>
                    </div>
                    <div class="short-rd__footer">
                        <a onclick="window.history.back();" href="#" class="short-rd-another">
                            <svg width="14" height="12" viewBox="0 0 14 12" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M5.29289 11.7071C5.68342 12.0976 6.31658 12.0976 6.70711 11.7071C7.09763 11.3166 7.09763 10.6834 6.70711 10.2929L3.41421 7L13 7C13.5523 7 14 6.55228 14 6C14 5.44771 13.5523 5 13 5L3.41421 5L6.70711 1.70711C7.09763 1.31658 7.09763 0.683417 6.70711 0.292893C6.31658 -0.0976321 5.68342 -0.0976322 5.29289 0.292893L0.293739 5.29205C0.291278 5.2945 0.28883 5.29697 0.286396 5.29945C0.109253 5.47987 5.48388e-07 5.72718 5.24537e-07 6C5.12683e-07 6.13559 0.0269866 6.26488 0.0758796 6.38278C0.12432 6.49986 0.195951 6.6096 0.290776 6.70498M5.29289 11.7071L0.293092 6.7073L5.29289 11.7071Z"
                                      fill="#005DFF"/>
                            </svg>
                            Изменить выбор
                        </a>
                    </div>
                </div>
            </div>

            <div class="installment__rules installment__rules--active">
                <div class="installment__rules-wall"></div>
                <label for="view-agree" class="installment__rules-mobile" id="label-view-agree">
                    <span><span class="show">Показать</span><span class="hide">Скрыть</span> текст с условиями САО “ВСК”</span>
                    <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.10396 9.82011L4.66419 6.04856C4.44527 5.80865 4.44527 5.41966 4.66419 5.17986C4.88292 4.94004 5.23768 4.94004 5.45639 5.17986L8.50006 8.5171L11.5436 5.17996C11.7624 4.94014 12.1172 4.94014 12.3359 5.17996C12.5547 5.41978 12.5547 5.80874 12.3359 6.04866L8.89607 9.8202C8.78665 9.94011 8.6434 10 8.50007 10C8.35668 10 8.21332 9.94 8.10396 9.82011Z"
                              fill="#A0A0A0"/>
                    </svg>
                </label>
                <?if($policyObj->active):?>
                <input type="checkbox" name="view-agree" id="view-agree">
                <p class="installment__rules-text">
                    Я даю согласие САО «ВСК», находящемуся по адресу 121552, г. Москва, ул. Островная, д. 4, на
                    обработку моих персональных данных, включая сбор, систематизацию, накопление, хранение, уточнение
                    (обновление, изменение), использование, распространение (в том числе передачу), обезличивание,
                    блокирование, уничтожение, внесение в информационную систему, обработку с использованием средств
                    автоматизации или без использования таких средств, в том числе на основании исключительно
                    автоматизированной обработки, персональных данных указанных в заявлении (договоре, полисе), в
                    соответствие с Федеральным законом от 27.07.2006 г. №152-ФЗ «О персональных данных». Указанные
                    данные предоставляются в целях заключения и исполнения договора страхования, а также разработки,
                    продвижения и получения информации о новых страховых продуктах и услугах, получения мной
                    рекламно-информационных рассылок. Согласие предоставляется с момента подписания настоящего полиса и
                    действует в течение пяти лет после исполнения обязательств. Согласие может быть отозвано путём
                    письменного заявления в САО «ВСК». Подтверждаю ознакомление и согласие
                    <a class="installment__rules-agree" target="_blank" href="<?=$arResult['INSURANCE_INFO']['INSURANCE_LINK']?>">с правилами страховки</a>
                    За достоверность указанных в заявлении персональных данных страхователя, включая серию и номер
                    паспорта, мобильный телефон, e-mail ответственность несет страхователь.
                </p>
                <input type="checkbox" id="agreement">
                <label for="agreement" class="installment__rules-agreement">
                    Я даю согласие и подтверждаю достоверность указанных данных
                </label>
                <?endif;?>
                <label for="view-agree-two" class="installment__rules-mobile" id="label-view-agree-two">
                    <span><span class="show">Показать</span><span class="hide">Скрыть</span> текст с условиями обработки данных и договором оферты</span>
                    <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.10396 9.82011L4.66419 6.04856C4.44527 5.80865 4.44527 5.41966 4.66419 5.17986C4.88292 4.94004 5.23768 4.94004 5.45639 5.17986L8.50006 8.5171L11.5436 5.17996C11.7624 4.94014 12.1172 4.94014 12.3359 5.17996C12.5547 5.41978 12.5547 5.80874 12.3359 6.04866L8.89607 9.8202C8.78665 9.94011 8.6434 10 8.50007 10C8.35668 10 8.21332 9.94 8.10396 9.82011Z"
                              fill="#A0A0A0"/>
                    </svg>
                </label>
                <input type="checkbox" name="view-agree" id="view-agree-two">
                <p class="installment__rules-text">
                    За достоверность указанных в заказе персональных данных ответственность несете Вы. Нажимая на кнопку
                    “Оформить заказ” Вы подтверждает, что ознакомились и согласны с
                    <a class="installment__rules-agree" target="_blank" href="<?=$arResult["CONTRACTS"][0]['CONTRACT_LINK']?>">условиями обработки персональных данных</a>
                    <a class="installment__rules-agree" target="_blank" href="<?=$arResult["CONTRACTS"][1]['CONTRACT_LINK']?>">договором оферты</a>
                </p>

                <input type="checkbox" id="agreement-two">
                <label for="agreement-two" class="installment__rules-agreement">
                    Я согласен с условиями и договором
                </label>
                <input type="hidden" name="parentPackageId" value="<?=$complectObj->parent_package_id?>">
                <input type="hidden" name="companyCityId" value="<?=$subscriptionFeeObj->company_city_id?>">
                <?foreach ($orderItems as $orderItem):?>
                    <?if($orderItem->active):?>
                        <input type="hidden" name="orderItemsIds[]" value="<?=$orderItem->id?>#<?=$orderItem->isFree?>">
                    <?endif;?>
                <?endforeach;?>
                <button id="b-add-order" type="button" class="disabled button yellow-button">Оформить заказ</button>
            </div>
        </div>
    </form>
    </section>

</main>
<?endif;?>
<script>
    $( document ).ready(function() {

        var count = 0;
        var btnsCount = $('.form__next-button').length
        $('#js-policy-validate-btn').on('click', function () {
                //контактные данные совпадают с данными из страховки
                let fio = $("input[name='policyContactInfo[surname]']").val() + ' ' + $("input[name='policyContactInfo[name]']").val()
                    + ' ' + $("input[name='policyContactInfo[patronomic]']").val()
                let email = $("input[name='policyContactInfo[email]']").val()
                let phone = $("input[name='policyContactInfo[phone]']").val()
                $('.contact-person__name').html(fio);
                $('.contact-person__email').html(email);
                $('.contact-person__phone').html(phone);
                setAddressRegistration();
        });
        $('#js-policy-validate-btn').on('click',{name:'#js-policy-validate-btn'}, isValidPolicy);
        if($('#same').is(':checked'))
        {
            $('#b-actual').css('display','none');
            $('#b-actual-delivery').css('display','none');
        }
        $('#same').on('click', function () {
            if($(this).is(':checked'))
            {
                $('#b-actual').css('display','none');
                $('#b-actual-delivery').css('display','none');
            }
            else {
                $('#b-actual').css('display','block');
                $('#b-actual-delivery').css('display','block');
            }
        });
        $('#permanent-delivery').on('click', function () {
            setAddressRegistration();
        });
        $('#actual-delivery').on('click', function () {
            setAddressResidense();
        });
        function setAddressRegistration()
        {
            //адрес доставки по умолчанию совпадает с адресом страховки
            let addressRegistration = $("input[name='addressRegistration[city]']").val() +' улица '+ $("input[name='addressRegistration[street]']").val()
                + ' дом ' + $("input[name='addressRegistration[house]']").val()
            $('.input-address').html(addressRegistration);
        }
        //устанавливает адрес фактического проживания
        function setAddressResidense()
        {
            //адрес доставки по умолчанию совпадает с адресом страховки
            let addressResidense = $("input[name='addressResidense[city]']").val() +' улица '+ $("input[name='addressResidense[street]']").val()
                + ' дом ' + $("input[name='addressResidense[house]']").val()
            $('.input-address').html(addressResidense);
        }
        let $error = $("#b-form-order-ajax").find(".form__required")
        let top1 = $("#b-form-order-ajax").position().top

        $('.form__next-button').on('click', function () {
            if (!$(this).hasClass('disabled')) {
                count++;
                $error.hide();
            } else {
                $('html').scrollTop($(this).closest('.b-step-top').position().top);
                $error.show();
            }
        });
        $('.form__next-button').on('click',{name:'#b-add-order'}, isValidFinal);


        $('.js-check-valid-field').on('keyup',{name:'#js-policy-validate-btn'}, isValidPolicy);
        $('#same').on('change',{name:'#js-policy-validate-btn'}, isValidPolicy);
        $('input[type=radio][name=address-installment]').on('change',{name:'#js-policy-validate-btn'}, isValidPolicy);
        $('.date').on('change',{name:'#js-policy-validate-btn'}, isValidPolicy);
        function isValidPolicy(event) {
            let requiredInputs = $('.js-policy-validate');
            let emptyField = false;
            $.each(requiredInputs, function() {
                $(this).removeClass('error');
                    if( $(this).val().trim().length == 0 ) {
                        emptyField = true;
                        $(this).addClass('error');
                    }
            });
            if(!$('#same').is(':checked'))
            {
                let requiredInputs = $('.valid-cond1');
                $.each(requiredInputs, function() {
                    $(this).removeClass('error');
                    if( $(this).val().trim().length == 0 ) {
                        emptyField = true;
                        $(this).addClass('error');
                    }
                });
            }
            if($('#other').is(':checked'))
            {
                let requiredInputs = $('.valid-cond2');
                $.each(requiredInputs, function() {
                    $(this).removeClass('error');
                    if( $(this).val().trim().length == 0 ) {
                        emptyField = true;
                        $(this).addClass('error');
                    }
                });
            }

            if(!emptyField) {
                $(event.data.name).removeClass('disabled');
            }else{
                $(event.data.name).addClass('disabled');
            }
        }
        $('#js-item-validate-btn').on('click',{name:'#js-item-validate-btn'}, isValid);
        $('.js-check-valid-field').on('keyup',{name:'#js-item-validate-btn'}, isValid);
        $('#same-name').on('change',{name:'#js-item-validate-btn'}, isValid);
        $('input[type=radio][name=delivery-address-installment]').on('change',{name:'#js-item-validate-btn'}, isValid);
        function isValid(event) {
            let requiredInputs = $('.date-install');
            let emptyField = false;
            $.each(requiredInputs, function() {
                $(this).removeClass('error');
                if( $(this).val().trim().length == 0 ) {
                    emptyField = true;
                    $(this).addClass('error');
                }
            });
            if(!$('#same-name').is(':checked'))
            {
                let requiredInputs = $('.valid-cond3');
                $.each(requiredInputs, function() {
                    $(this).removeClass('error');
                    if( $(this).val().trim().length == 0 ) {
                        emptyField = true;
                        $(this).addClass('error');
                    }
                });
            }
            if($('#other-delivery').is(':checked'))
            {
                let requiredInputs = $('.valid-cond4');
                $.each(requiredInputs, function() {
                    $(this).removeClass('error');
                    if( $(this).val().trim().length == 0 ) {
                        emptyField = true;
                        $(this).addClass('error');
                    }
                });
            }

            if(!emptyField) {
                $(event.data.name).removeClass('disabled');
            }else{
                $(event.data.name).addClass('disabled');
            }
        }

        $('#agreement').on('change',{name:'#b-add-order'}, isValidFinal);
        $('#agreement-two').on('change',{name:'#b-add-order'}, isValidFinal);
        function isValidFinal(event) {
            let isDisabledOrderBtn = false;
            if($('#agreement').length && !$('#agreement').is(':checked'))
            {
                isDisabledOrderBtn = true;
            }
            if(!$('#agreement-two').is(':checked'))
            {
                isDisabledOrderBtn = true;
            }
            if(count!=btnsCount)
            {
                isDisabledOrderBtn = true;
            }

            if(!isDisabledOrderBtn) {
                $(event.data.name).removeClass('disabled');
            }else{
                $(event.data.name).addClass('disabled');
            }
        }
    });

</script>

<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>