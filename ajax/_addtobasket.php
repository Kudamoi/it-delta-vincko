<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application;

$request = Application::getInstance()->getContext()->getRequest();

if ($request->isPost()) {

    $items = json_decode($request->getPost('items'));

    //получаем id товаров
//    $complect_id = $items[0]->active == true ? $items[0]->id : null;
//    $subscription_fee_id = $items[1]->active == true ? $items[1]->id : null;
//    $policy_id = $items[2]->active == true ? $items[2]->id : null;

    Bitrix\Main\Loader::includeModule("sale");
    Bitrix\Main\Loader::includeModule("catalog");

    $siteId = Bitrix\Main\Context::getCurrent()->getSite(); //для публичного раздела
    $currency = Bitrix\Currency\CurrencyManager::getBaseCurrency(); // Базовая валюта  "RUB","USD",...
    $productProviderClass = \Bitrix\Catalog\Product\Basket::getDefaultProviderName();

    $products = [];
    foreach ($items as $item)
    {
        if($item->active)
            array_push($products, array('PRODUCT_ID' => $item->id, 'CURRENCY' => $currency,

                'QUANTITY' => 1,'LID' => $siteId,'PRODUCT_PROVIDER_CLASS' =>$productProviderClass));
    }

    if(empty($products))
        return;

    $basket = \Bitrix\Sale\Basket::create($siteId);
    CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());


    foreach ($products as $product)
    {
        if ($item = $basket->getExistsItem('catalog', $product["PRODUCT_ID"])) {
            $item->setField('QUANTITY', $item->getQuantity() + 1); //добавляем указанное количество к существующему товару

        } else
        {
            $item = $basket->createItem("catalog", $product["PRODUCT_ID"]);
            unset($product["PRODUCT_ID"]);
            $item->setFields($product);
        }

    }

    $basket->save();

    LocalRedirect("/order/order_test.php");
}
?>

