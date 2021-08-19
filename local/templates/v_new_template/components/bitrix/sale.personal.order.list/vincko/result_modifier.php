<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use  Bitrix\Main\Localization\Loc;

foreach ($arResult["ORDERS"] as $arOrder) {
    $orderId = $arOrder["ORDER"]["ID"];

    // соберем ид заказов
    $arOrderIds[] = $orderId;

    // соберем ид товаров и ид товаров заказа в корзине
    foreach ($arOrder["BASKET_ITEMS"] as $arBasketProducts) {

        // получим инфо о товарах
        $arPrInfoTmp = CCatalogSku::GetProductInfo($arBasketProducts["PRODUCT_ID"]);
        if (!empty($arPrInfoTmp)) {
            // соберем ид инфоблоков
            $arPrIblockIds[$arPrInfoTmp["IBLOCK_ID"]] = $arPrInfoTmp["IBLOCK_ID"];
        }
        $arPrInfo[$arBasketProducts["PRODUCT_ID"]] = $arPrInfoTmp;

    }
    // формируем статусы, чтобы в шаблоне меньше было обработки
    $payment = $arOrder["PAYMENT"];
    if ($payment['PAID'] === 'Y') {
        $payStatus = Loc::getMessage('SPOL_TPL_PAID');
        $payStatusId = 1;
    } elseif ($arOrder['ORDER']['IS_ALLOW_PAY'] == 'N') {
        $payStatus = Loc::getMessage('SPOL_TPL_RESTRICTED_PAID');
        $payStatusId = 0;
    } else {
        $payStatus = Loc::getMessage('SPOL_TPL_NOTPAID');
        $payStatusId = 0;

    }

    // что можем собираем здесь
    $order[$orderId] = [
        "ID" => $orderId,
        "ACCOUNT_NUMBER" => $arOrder["ORDER"]["ACCOUNT_NUMBER"],
        "DATE_INSERT_FORMATED" => $arOrder["ORDER"]["DATE_INSERT_FORMATED"],
        "STATUS" => $arResult["INFO"]["STATUS"][$arOrder["ORDER"]["STATUS_ID"]]["NAME"],
        "CANCELED" => $arOrder["ORDER"]["CANCELED"],
        "PAY" => [
            "NAME" => $arOrder["PAYMENT"]["PAY_SYSTEM_NAME"],
            "STATUS" => $payStatus,
            "STATUS_ID" => $payStatusId,
            "FORMATED_SUM" => $payment['FORMATED_SUM'],
        ]
    ];
}
// Получим свойства заказа
$obProps = CSaleOrderPropsValue::GetList(
    [],
    [
        "ORDER_ID" => $arOrderIds,
        "CODE" => [
            "MONTAZHTIME",
            "SOLUTION_ID",
            "COMPANY_CITY_ID",
            "FIO",
            "PHONE",
            "ADDRESS"
        ]
    ]
);
while ($arProps = $obProps->Fetch()) {
    $arOrderProps[$arProps["ORDER_ID"]][$arProps["CODE"]] = $arProps["VALUE"];
    if (empty($arProps["VALUE"])) {
        continue;
    }
    switch ($arProps["CODE"]) {
        case "SOLUTION_ID":
            // соберем ид готовых предложений
            $arSolutionIds[$arProps["VALUE"]] = $arProps["VALUE"];
            break;
        case "COMPANY_CITY_ID":
            // соберем ид компаний
            $arCompanyIds[$arProps["VALUE"]] = $arProps["VALUE"];
            break;
    }

}


// Получим информацию об инфоблоках для того чтобы определить тип товара
$arPrIblock = Vincko\Order::getIblock($arPrIblockIds);

//перебираем товары
foreach ($arPrInfo as $prId => $info) {

    $prIblock = $arPrIblock[$info["IBLOCK_ID"]];

    if ($prIblock != "strahovka") {
        continue;
    }
    $arPolicyIds[$prId] = $prId;
}

// Получим готовые решения
$arSolution = Vincko\Solution::getList($arSolutionIds);

// Соберем информацию о компаниях
$arCompany = Vincko\Company::getCompany($arCompanyIds);

// Получим страховые полисы
$arPolicy = Vincko\Policy::getList($arPolicyIds);
if (!empty($arPolicy)) {
    // получим все варианты выплаты по основным пунктам страховки
    $arAllPaymentOptions = Vincko\Policy::getPaymentOptions();
}

// Дособираем массив с заказами
foreach ($arResult["ORDERS"] as $arOrder) {
    // чтобы не таскать
    $orderId = $arOrder["ORDER"]["ID"];
    $props = $arOrderProps[$orderId];

    // свойства заказа
    $order[$orderId]["PROPS"] = $props;

    // готовое решение если оно есть
    if (!empty($props["SOLUTION_ID"])) {
        $order[$orderId]["SOLUTION"] = $arSolution[$props["SOLUTION_ID"]];
    }

    // соберем товары в удобном для нас виде
    // TODO пока не понятно куда должен вести урл того или иного товара
    foreach ($arOrder["BASKET_ITEMS"] as $arBasketProducts) {

        $prBId = $arBasketProducts["ID"];
        $prId = $arBasketProducts["PRODUCT_ID"];

        $arBPr = [
            "NAME" => $arBasketProducts["NAME"],
            //"URL" =>""
        ];
        $prInfo = $arPrInfo[$prId];

        // добавляем в зависимости от товара определенные свойства
        switch ($arPrIblock[$prInfo["IBLOCK_ID"]]) {
            case "abonplata":
                // если товар - услуги компании, то добавим информацию о компании
                $arBPr["COMPANY"] = $arCompany[$props["COMPANY_CITY_ID"]];

                break;
            case "strahovka":
                // если товар - страховка, то добавим информацию о страховке
                $arBPr["POLICY"] = Vincko\Policy::formatPolicy($arPolicy[$prId], $arAllPaymentOptions);
                break;

        }
        $order[$orderId]["PRODUCT"][$prBId] = $arBPr;
    }
}
$arResult["ORDERS"] = $order;
?>