<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use  Bitrix\Main\Localization\Loc;
use Vincko\Policy;

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
        } else {
            //TODO если появятся новый тип товаров  нужно будет переработать получение инфоблоков

            // соберем ид товаров - оборудования, не являющимися торговым предложением
            $arEquimentIds[$arBasketProducts["PRODUCT_ID"]] = $arBasketProducts["PRODUCT_ID"];
        }
        $arPrInfo[$arBasketProducts["PRODUCT_ID"]] = $arPrInfoTmp;
        $arBasketProductIds[$arBasketProducts["ID"]] = $arBasketProducts["ID"];

    }
    // формируем статусы, чтобы в шаблоне меньше было обработки
    $payment = $arOrder["PAYMENT"][0];
    if ($arOrder["ORDER"]["PAYED"] === "Y") {
        $payStatus = Loc::getMessage("SPOL_TPL_PAID");
    } elseif ($arOrder["ORDER"]["IS_ALLOW_PAY"] == "N") {
        $payStatus = Loc::getMessage("SPOL_TPL_RESTRICTED_PAID");
    } else {
        $payStatus = Loc::getMessage("SPOL_TPL_NOTPAID");
    }

    // что можем собираем здесь
    $order[$orderId] = [
        "ID" => $orderId,
        "ACCOUNT_NUMBER" => $arOrder["ORDER"]["ACCOUNT_NUMBER"],
        "DATE_INSERT_FORMATED" => $arOrder["ORDER"]["DATE_INSERT_FORMATED"],
        "STATUS" => $arResult["INFO"]["STATUS"][$arOrder["ORDER"]["STATUS_ID"]]["NAME"],
        "CANCELED" => $arOrder["ORDER"]["CANCELED"],
        "PAY" => [
            "PAYED" => $arOrder["ORDER"]["PAYED"],
            "NAME" => $payment["PAY_SYSTEM_NAME"],
            "STATUS" => $payStatus,
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
    $arInsuranceIds[$info["ID"]] = $info["ID"];
}

// Получим готовые решения
if (!empty($arSolutionIds)) {
    $arSolution = Vincko\Solution::getList($arSolutionIds);
}

// Соберем информацию о компаниях
if (!empty($arCompanyIds)) {
    $arCompany = Vincko\Company::getCompany($arCompanyIds);
}

// Соберем информацию об оборудовании
if (!empty($arEquimentIds)) {
    $arEquiment = Vincko\Equiment::getList($arEquimentIds);
}

// Получим свойства товаров в заказах
if (!empty($arBasketProductIds)) {
    $arBasketProductProp = Vincko\Order::getBasketProductProp($arBasketProductIds);
}

// Получим страховые полисы
if (!empty($arPolicyIds)) {
    $arPolicy = Policy::getList($arPolicyIds);
    if (!empty($arPolicy)) {
        // получим все варианты выплаты по основным пунктам страховки
        $arAllPaymentOptions = Policy::getPaymentOptions();
        // получим информацию о страховой(товаре) предлагающей полис
        $arInsurance = Policy::getListInsurance($arInsuranceIds);
    }
}

// Дособираем массив с заказами
foreach ($arResult["ORDERS"] as $arOrder) {
    // чтобы не таскать
    $orderId = $arOrder["ORDER"]["ID"];
    $propsOrder = $arOrderProps[$orderId];

    // свойства заказа
    $order[$orderId]["PROPS"] = $propsOrder;

    // готовое решение если оно есть
    if (!empty($propsOrder["SOLUTION_ID"])) {
        $order[$orderId]["SOLUTION"] = $arSolution[$propsOrder["SOLUTION_ID"]];
    } elseif (count($arOrder["BASKET_ITEMS"]) > 1) {
        // иначе это готовое решение
        $order[$orderId]["SOLUTION"]["NAME"] = Loc::getMessage("SPOL_TPL_TITLE_SOLUTION");
    } else {
        // иначе это страховка
        $order[$orderId]["SOLUTION"]["NAME"] = Loc::getMessage("SPOL_TPL_TITLE_POLICY");
    }

    // соберем товары в удобном для нас виде
    foreach ($arOrder["BASKET_ITEMS"] as $arBasketProducts) {

        $prBId = $arBasketProducts["ID"];
        $prId = $arBasketProducts["PRODUCT_ID"];
        $propPr = $arBasketProductProp[$arBasketProducts["ID"]];
        $arBPr = [
            "NAME" => $arBasketProducts["NAME"],
            "PROP" => $propPr,
        ];
        $prInfo = $arPrInfo[$prId];

        // добавляем в зависимости от товара определенные свойства
        switch ($arPrIblock[$prInfo["IBLOCK_ID"]]) {
            case "abonplata":
                // если товар - услуги компании, то добавим информацию о компании
                $arBPr["COMPANY"] = $arCompany[$propsOrder["COMPANY_CITY_ID"]];
                $arBPr["URL"] = "/norating/?company=" . $propsOrder["COMPANY_CITY_ID"];
                $order[$orderId]["COMPANY_EXISTS"] = 1;
                break;
            case "strahovka":
                // если товар - страховка, то добавим информацию о страховке
                $arBPr["POLICY"] = Policy::formatPolicy($arPolicy[$prId], $arAllPaymentOptions, $arInsurance[$prInfo["ID"]]);
                $arBPr["URL"] = "/strahovanie/#policy" . $prId;
                $order[$orderId]["DOWNLOAD_POLICY"] = $propPr["LINK"];
                $order[$orderId]["POLICY_EXISTS"] = 1;
                break;
            default:
                $arBPr["URL"] = "/equipment-kits/" . $arEquiment[$prId]["CODE"] . "/";
                $order[$orderId]["EQUIMENT_EXISTS"] = 1;
        }

        $order[$orderId]["PRODUCT"][$prBId] = $arBPr;
    }
}
$arResult["ORDERS"] = $order;
?>