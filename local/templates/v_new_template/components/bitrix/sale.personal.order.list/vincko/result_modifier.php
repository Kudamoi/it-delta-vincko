<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use  Bitrix\Main\Localization\Loc;

foreach ($arResult["ORDERS"] as $arOrder) {
    $arOrderIds[] = $arOrder["ORDER"]["ID"];
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
    $arResult["ORDER"][$arOrder["ORDER"]["ID"]] = [
        "ACCOUNT_NUMBER" => $arOrder["ORDER"]["ACCOUNT_NUMBER"],
        "DATE_INSERT_FORMATED" => $arOrder["ORDER"]["DATE_INSERT_FORMATED"],
        "STATUS" => $arResult["INFO"]["STATUS"][$arOrder["ORDER"]["STATUS_ID"]]["NAME"],
        "CANCELED" => $arOrder["ORDER"]["CANCELED"],
        "PAY" => [
            "NAME" => $arOrder["PAYMENT"]["PAY_SYSTEM_NAME"],
            "STATUS" => $payStatus,
            "STATUS_ID"=>$payStatusId,
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

?>

SOLUTION

//Получаем честный договор и кладем его в массив
$contract = CIBlockElement::GetList(array(), array("IBLOCK_CODE" => 'contract', "ACTIVE" => "Y"), false, false, array("ID", "NAME", "PROPERTY_CONTRACT"));

while ($cont = $contract->GetNext()) {
$arrContract['ID'] = $cont["ID"];
$arrContract['NAME'] = $cont["NAME"];
$arrContract['SRC'] = CFile::GetPath($cont["PROPERTY_CONTRACT_VALUE"]);
}
    $arOrder["CONTRACT"]["HONEST"])) : ?>
    <a class="blue underline" href="">vincko: Честный договор</a>
<? endif; ?>
<? if (!empty($arOrder["CONTRACT"]["COMPANY"])) : ?>
      <? if (!empty($arOrder["INSURANCE"]["PAY"])): ?>
                                            <div class="products__text-container products__text-container--snd">
                                                <div class="products__info-text">
                                                    <div class="itemRating-open__popup-title">
                                                        <span class="blue">Выплаты</span> по пунктам
                                                    </div>
                                                    <div class="itemRating-open__popup-content">
                                                        <ul>
                                                            <? foreach ($arOrder["INSURANCE"]["PAY"] as $arInsurance): ?>
                                                                <li<?= (!empty($arInsurance["PRICE"]) ? " class='blue'" : "") ?>>
                                                                    <?= $arInsurance["NAME"] ?> <br>
                                                                    <? if (!empty($arInsurance["PRICE"])): ?>
                                                                        <span class="blue"><?= $arInsurance["PRICE"] ?></span>
                                                                    <? else: ?>
                                                                        нет выплаты
                                                                    <? endif; ?>
                                                                </li>
                                                            <? endforeach; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        <? endif; ?>
                                    </div>
                                    <? if ($arOrder["INSURANCE"]["MAX_PRICE"]): ?>
                                        <div class="profile__c-main-order-main-info-content">
                                            Выплата до <?= $arOrder["INSURANCE"]["MAX_PRICE"] ?>
                                        </div>
                                    <? endif; ?>
                                </div>
                            </div>
