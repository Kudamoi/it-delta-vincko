<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use  Bitrix\Main\Localization\Loc;

foreach ($arResult["ORDERS"] as $arOrder) {
    $arOrderIds[] = $arOrder["ORDER"]["ID"];
    $payment = $arOrder["PAYMENT"];
    if ($payment['PAID'] === 'Y') {
        $payStatus = Loc::getMessage('SPOL_TPL_PAID');
        $payStatusClass = "profile__c-main-order-price-status-paid";
    } elseif ($arOrder['ORDER']['IS_ALLOW_PAY'] == 'N') {
        $payStatus = Loc::getMessage('SPOL_TPL_RESTRICTED_PAID');
        $payStatusClass = "profile__c-main-order-price-status-not-paid";
    } else {
        $payStatus = Loc::getMessage('SPOL_TPL_NOTPAID');
        $payStatusClass = "profile__c-main-order-price-status-not-paid";

    }
    $arResult["ORDER"][$arOrder["ORDER"]["ID"]] = [
        "ACCOUNT_NUMBER" => $arOrder["ORDER"]["ACCOUNT_NUMBER"],
        "DATE_INSERT_FORMATED" => $arOrder["ORDER"]["DATE_INSERT_FORMATED"],
        "STATUS" => $arResult["INFO"]["STATUS"][$arOrder["ORDER"]["STATUS_ID"]]["NAME"],
        "CANCELED" => $arOrder["ORDER"]["CANCELED"],
        "PAY" => [
            "NAME" => $arOrder["PAYMENT"]["PAY_SYSTEM_NAME"],
            "STATUS" => $payStatus,
            "STATUS_CLASS"=>$payStatusClass,
            "FORMATED_SUM"=>$payment['FORMATED_SUM'] ,
        ]
    ];
}

$obOrdersProps = CSaleOrderPropsValue::GetList(
    [],
    [
        "ORDER_ID" => $arOrderIds,
        "CODE" => [
            "MONTAZHTIME"
        ]
    ]
);
while ($arOrdersProps = $obOrdersProps->Fetch()) {
    $arResult["ORDER"][$arProps["ORDER_ID"]][$arProps["CODE"]] = $arProps["VALUE"];
}
dump($arResult["ORDER"]);
?>

