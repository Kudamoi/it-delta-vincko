<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Context,
    Bitrix\Currency\CurrencyManager,
    Bitrix\Sale\Order,
    Bitrix\Sale\Basket,
    Bitrix\Sale\Delivery,
    Bitrix\Sale\PaySystem;


global $USER;

Bitrix\Main\Loader::includeModule("sale");
Bitrix\Main\Loader::includeModule("catalog");
//получает свойство по коду
function getPropertyByCode($propertyCollection, $code)  {
    foreach ($propertyCollection as $property)
    {
        if($property->getField('CODE') == $code)
            return $property;
    }
}
//фильтрует данные
function clean($value = "") {
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);

    return $value;
}
//фильтрует данные в массиве
function cleanArr($arr) {

    foreach ($arr as &$item)
    {
        $item = clean($item);
    }

    return $arr;
}
//json ответ
function jsonResponse(array $result)
{
    $response = new \Bitrix\Main\Engine\Response\Json($result);
    $response->send();
}



$request = Context::getCurrent()->getRequest();

if ($request->isPost() && $request->isAjaxRequest() && $GLOBALS['USER']->IsAuthorized()) {


    $errors = [];
    $errorsValidate = [];

    $arProductsIds = [];
    if(!isset($request['orderItemsIds']))
    {
        return false;
    }
    if(empty($request['orderItemsIds']))
    {
        return false;
    }

    //Данные страхового полиса
    if(isset($request['policyContactInfo']))
    {
        //Общая информация для оформления полиса
        $arPolicyContactInfo = cleanArr($request->getPost('policyContactInfo'));

        if(empty($arPolicyContactInfo['sex']))
            $errors[] = 'Не выбран пол';
        if(empty($arPolicyContactInfo['surname']))
            $errorsValidate[] = 'policyContactInfo[surname]';
        if(empty($arPolicyContactInfo['name']))
            $errorsValidate[] = 'policyContactInfo[name]';
        if(empty($arPolicyContactInfo['date']))
            $errorsValidate[] = 'policyContactInfo[date]';
        if(empty($arPolicyContactInfo['place']))
            $errorsValidate[] = 'policyContactInfo[place]';
        if(empty($arPolicyContactInfo['email']))
            $errorsValidate[] = 'policyContactInfo[email]';
        elseif (!filter_var($arPolicyContactInfo['email'], FILTER_VALIDATE_EMAIL))
            $errorsValidate[] = 'policyContactInfo[email]';
        if(empty($arPolicyContactInfo['phone']))
            $errorsValidate[] = 'policyContactInfo[phone]';
        elseif (!preg_match('/^\+7\([0-9][0-9][0-9]\) [0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]/', $arPolicyContactInfo['phone']))
            $errorsValidate[] = 'policyContactInfo[phone]';

        //Паспортные данные
        $arPassportData = cleanArr($request->getPost('passportData'));

        if(empty($arPassportData['number']))
            $errorsValidate[] = 'passportData[number]';
        if(empty($arPassportData['date']))
            $errorsValidate[] = 'passportData[date]';
        if(empty($arPassportData['whom']))
            $errorsValidate[] = 'passportData[whom]';
        if(empty($arPassportData['code']))
            $errorsValidate[] = 'passportData[code]';

        //Адрес регистрации
        $arAddressRegistration = cleanArr($request->getPost('addressRegistration'));

        if(empty($arAddressRegistration['city']))
            $errorsValidate[] = 'addressRegistration[city]';
        if(empty($arAddressRegistration['street']))
            $errorsValidate[] = 'addressRegistration[street]';
        if(empty($arAddressRegistration['house']))
            $errorsValidate[] = 'addressRegistration[house]';
        if(empty($arAddressRegistration['date']))
            $errorsValidate[] = 'addressRegistration[date]';

        //Если адрес фактического проживания и регистрации не совпадают
        if(!isset($request['same'])) {
            //Адрес фактического проживания
            $arAddressResidense = cleanArr($request->getPost('addressResidense'));

            if(empty($arAddressResidense['city']))
                $errorsValidate[] = 'addressResidense[city]';
            if(empty($arAddressResidense['street']))
                $errorsValidate[] = 'addressResidense[street]';
            if(empty($arAddressResidense['house']))
                $errorsValidate[] = 'addressResidense[house]';
            if(empty($arAddressResidense['date']))
                $errorsValidate[] = 'addressResidense[date]';
        }
        //Адрес квартиры, для которой вы оформляете страховку "Укажите другой адрес"
        if(intval($request->getPost('address-installment'))==1)
        {
            $arPolicyOtherAddress = cleanArr($request->getPost('policyOtherAddress'));

            if(empty($arPolicyOtherAddress['city']))
                $errorsValidate[] = 'policyOtherAddress[city]';
            if(empty($arPolicyOtherAddress['street']))
                $errorsValidate[] = 'policyOtherAddress[street]';
            if(empty($arPolicyOtherAddress['house']))
                $errorsValidate[] = 'policyOtherAddress[house]';
            if(empty($arPolicyOtherAddress['date']))
                $errorsValidate[] = 'policyOtherAddress[date]';
        }

    }
    //Данные контактного лица
    if(isset($request['contactData']))
    {
        if(!isset($request['same-name'])) {
            $arContactData = cleanArr($request->getPost('contactData'));

            if(empty($arContactData['surname']))
                $errorsValidate[] = 'contactData[surname]';
            if(empty($arContactData['name']))
                $errorsValidate[] = 'contactData[name]';
            if(empty($arContactData['email']))
                $errorsValidate[] = 'contactData[email]';
            elseif (!filter_var($arContactData['email'], FILTER_VALIDATE_EMAIL))
                $errorsValidate[] = 'contactData[email]';
            if(empty($arContactData['phone']))
                $errorsValidate[] = 'contactData[phone]';
            elseif (!preg_match('/^\+7\([0-9][0-9][0-9]\) [0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]/', $arContactData['phone']))
                $errorsValidate[] = 'contactData[phone]';
        }
        if(isset($request['delivery-address-installment'])) {
            //Адрес доставки
            if (intval($request->getPost('delivery-address-installment')) == 1) {
                $arDeliveryOtherAddress = cleanArr($request->getPost('deliveryOtherAddress'));

                if (empty($arDeliveryOtherAddress['city']))
                    $errorsValidate[] = 'deliveryOtherAddress[city]';
                if (empty($arDeliveryOtherAddress['street']))
                    $errorsValidate[] = 'deliveryOtherAddress[street]';
                if (empty($arDeliveryOtherAddress['house']))
                    $errorsValidate[] = 'deliveryOtherAddress[house]';
            }
            //комментарий к заказу
            $orderComment = clean($request->getPost('orderComment'));
            //дата и время монтажа оборудования
            $dateInstall = clean($request->getPost('date-install'));
            if (empty($dateInstall))
                $errorsValidate[] = 'date-install';
        }
    }

    if(!empty($errorsValidate)) {
        jsonResponse([
            'msg' => $errorsValidate,
            'type' => 'error'
        ]);
        return false;
    }

//    if ($_SERVER['REMOTE_ADDR'] == '46.147.123.63' || $_SERVER['REMOTE_ADDR'] == '178.76.225.235') {
//        echo '<pre>';
//        print_r($request);
//        echo '</pre>';
//        die();
//    }

    $siteId = Context::getCurrent()->getSite();
    $currencyCode = CurrencyManager::getBaseCurrency();
    $productProviderClass = \Bitrix\Catalog\Product\Basket::getDefaultProviderName();

    // Создаёт новый заказ
    $order = Order::create($siteId, $USER->isAuthorized() ? $USER->GetID() : 1);
    $order->setPersonTypeId(3);
    $order->setField('CURRENCY', $currencyCode);


    $products = [];
    $arProductsIds = $request['orderItemsIds'];
    foreach ($arProductsIds as $arProductsId)
    {
         $productData = explode('#',$arProductsId);
         $arProductId = intval($productData[0]);
            $isFreeFlag = $productData[1];
         if($isFreeFlag == '1') {
             array_push($products, array('PRODUCT_ID' => $arProductId, 'PRICE'=>0, 'CUSTOM_PRICE' => 'Y', 'CURRENCY' => $currencyCode, 'QUANTITY' => 1, 'LID' => $siteId, 'PRODUCT_PROVIDER_CLASS' => $productProviderClass));
         } else
         {
             array_push($products, array('PRODUCT_ID' => $arProductId, 'CURRENCY' => $currencyCode, 'QUANTITY' => 1, 'LID' => $siteId, 'PRODUCT_PROVIDER_CLASS' => $productProviderClass));
         }

    }

    $basket = Basket::create($siteId);

    foreach ($products as $product) {
        if ($item = $basket->getExistsItem('catalog', $product["PRODUCT_ID"])) {
            $item->setField('QUANTITY', $item->getQuantity() + 1); //добавляем указанное количество к существующему товару

        } else {
            $item = $basket->createItem("catalog", $product["PRODUCT_ID"]);
            unset($product["PRODUCT_ID"]);
            $item->setFields($product);
        }
    }

    $order->setBasket($basket);

    $shipmentCollection = $order->getShipmentCollection();
    $shipment = $shipmentCollection->createItem(
        Bitrix\Sale\Delivery\Services\Manager::getObjectById(1)
    );

    $shipmentItemCollection = $shipment->getShipmentItemCollection();

    /** @var Sale\BasketItem $basketItem */

    foreach ($basket as $basketItem)
    {
        $item = $shipmentItemCollection->createItem($basketItem);
        $item->setQuantity($basketItem->getQuantity());
    }

    $paymentId = intval($request['payment-method']);
    $paymentCollection = $order->getPaymentCollection();
    $payment = $paymentCollection->createItem(
        Bitrix\Sale\PaySystem\Manager::getObjectById($paymentId)
    );
    $payment->setField("SUM", $order->getPrice());
    $payment->setField("CURRENCY", $order->getCurrency());

    // Устанавливаем свойства

    $propertyCollection = $order->getPropertyCollection();

    $policyContactInfo = 'Общая информация для оформления полиса: ' .'Пол '. $arPolicyContactInfo['sex'] . ' Фамилия: ' . $arPolicyContactInfo['surname'] . ' Имя '.
        $arPolicyContactInfo['name'] . ' Отчество'.$arPolicyContactInfo['patronomic']. ' Дата рождения: '. $arPolicyContactInfo['date']. ' Место рождения: '. $arPolicyContactInfo['place'] . ' E-mail'
        .$arPolicyContactInfo['email'] .' Телефон' .$arPolicyContactInfo['phone'];

    $passportData = 'Паспортные данные: Серия и номер паспорта: ' . $arPassportData['number'] . ' Дата выдачи: ' . $arPassportData['date'] . ' Кем выдан '.
        $arPassportData['whom'] . ' Код подразделения: '. $arPassportData['code']. ' ИНН: '. $arPassportData['inn'];

    $addressRegistration = 'Адрес регистрации: Город/населенный пункт: ' . $arAddressRegistration['city'] . ' Улица: ' . $arAddressRegistration['street'] . ' Дом '.
     $request['house'] . ' Корпус: '. $arAddressRegistration['housing']. ' Квартира: '. $arAddressRegistration['flat'] . ' Дата регистрации'
        .$arAddressRegistration['date'] . 'Индекс' .$arAddressRegistration['index'];

    $addressResidense = ' Адрес фактического проживания: Город/населенный пункт: ' . $arAddressResidense['city'] . ' Улица: ' . $arAddressResidense['street'] . ' Дом '.
        $arAddressResidense['house'] . ' Корпус: '. $arAddressResidense['housing']. ' Квартира: '. $arAddressResidense['flat'] . ' Дата регистрации'
        .$arAddressResidense['date'] . ' Индекс' .$arAddressResidense['index'];

    $policyOtherAddress = ' Адрес квартиры(другой адрес): Город/населенный пункт: ' . $arPolicyOtherAddress['city'] . ' Улица: ' . $arPolicyOtherAddress['street'] . ' Дом '.
        $arPolicyOtherAddress['house'] . ' Корпус: '. $arPolicyOtherAddress['housing']. ' Квартира: '. $arPolicyOtherAddress['flat'] . ' Дата регистрации'
        .$arPolicyOtherAddress['date'] . ' Индекс' .$arPolicyOtherAddress['index'];

    $deliveryOtherAddress = ' Адрес достаки(другой адрес): Город/населенный пункт: ' . $arDeliveryOtherAddress['city'] . ' Улица: ' . $arDeliveryOtherAddress['street'] . ' Дом '.
        $arDeliveryOtherAddress['house'] . ' Корпус: '. $arDeliveryOtherAddress['housing']. ' Квартира: '. $arDeliveryOtherAddress['flat'] . ' Дата регистрации'
        .$arDeliveryOtherAddress['date'] . ' Индекс' .$arDeliveryOtherAddress['index'];

    $property = getPropertyByCode($propertyCollection, 'ADDRESS');
    $property->setValue($deliveryOtherAddress);

    if(!isset($request['same-name'])) {
        $propertyFIO = $arContactData['surname'] . ' ' . $arContactData['name'] . ' ' . $arContactData['patronomic'];
        $propertyEmail = $arContactData['email'];
        $propertyPhone = $arContactData['phone'];
    }
    else
    {
        $propertyFIO = $arPolicyContactInfo['surname'] .' '. $arPolicyContactInfo['name'] . ' '. $arPolicyContactInfo['patronomic'];
        $propertyEmail = $arPolicyContactInfo['email'];
        $propertyPhone = $arPolicyContactInfo['phone'];
    }

    $property = getPropertyByCode($propertyCollection, 'FIO');
    $property->setValue($propertyFIO);

    $property = getPropertyByCode($propertyCollection, 'EMAIL');
    $property->setValue($propertyEmail);

    $property = getPropertyByCode($propertyCollection, 'PHONE');
    $property->setValue($propertyPhone);

    $property = getPropertyByCode($propertyCollection, 'MONTAZHTIME');
    $property->setValue($dateInstall);

    $orderComment = ' Комментарий к заказу: '.$orderComment;

    $comment = $passportData .' '. $addressRegistration .' '. $addressResidense .' '. $policyOtherAddress
        .' '. $deliveryOtherAddress .' '. $orderComment;
    $order->setField('USER_DESCRIPTION', $comment); // Устанавливаем поля комментария покупателя

    // Сохраняем
    $order->doFinalAction(true);
    $result = $order->save();
    $orderId = $order->getId();
    if ($result->isSuccess())
    {
        $session = \Bitrix\Main\Application::getInstance()->getSession();
        $orderItems = $session->remove('orderData');
        jsonResponse([
            'url' => '/order/?ORDER_ID=' . $orderId,
            'type' => 'ok'
        ]);

        //LocalRedirect("/order/?ORDER_ID=" . $orderId);
    }
}
