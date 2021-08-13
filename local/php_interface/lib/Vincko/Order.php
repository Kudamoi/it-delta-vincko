<?php

namespace Vincko;

class Order
{
// ИД  инфоблока товаров (страховых компаний)
	const IBLOCK_POLICY = 14;
	// ИД  инфоблока товарных предложений(страховых полисов)
	const IBLOCK_POLICY_OFFER = 24;

	// получим варианты оплаты
	public static function getPaymentSystem()
	{
		\CModule::IncludeModule("main");
		\CModule::IncludeModule("sale");

		$obPaySystem = \CSalePaySystemAction::GetList(
			["SORT" => "ASC"],
			["ACTIVE" => "Y"],
			false,
			false,
			[
				"PS_DESCRIPTION",
				"NAME",
				"LOGOTIP"
			]
		);
		while ($arPaySystemTmp = $obPaySystem->Fetch()) {
			$arPayIcon = \CFile::GetFileArray($arPaySystemTmp["LOGOTIP"]);
			$arPaySystem[$arPaySystemTmp["ID"]] = $arPaySystemTmp;
			$arPaySystem[$arPaySystemTmp["ID"]]["ICON"] = $arPayIcon["SRC"];
		}
		return $arPaySystem;
	}

	public static function createOrderPolicy($arField, $paymentID, $quantity = false, $mounting = false)
	{

		\Bitrix\Main\Loader::includeModule("sale");

		// получаем ИД пользователя
		$userId = $GLOBALS["USER"]->IsAuthorized()
			? $GLOBALS["USER"]->GetID()
			: \CSaleUser::GetAnonymousUserID();

		// получаем информацию о продукте
		$basket = \Bitrix\Sale\Basket::create(\Bitrix\Main\Context::getCurrent()->getSite());

		$item = $basket->createItem('catalog', $arField["POLICY"]["ID"]);
		$item->setField('QUANTITY', 1);
		$item->setField('CURRENCY', 'RUB');
		$item->setField('PRODUCT_PROVIDER_CLASS', '\Bitrix\Catalog\Product\CatalogProvider');

		$arSetProps = $arField["PROPS"];

		$item->getPropertyCollection()->setProperty($arSetProps);

		$basket->refresh();

		$order = \Bitrix\Sale\Order::create(
			\Bitrix\Main\Context::getCurrent()->getSite(),
			$userId,
			\Bitrix\Currency\CurrencyManager::getBaseCurrency()
		);

		$order->setPersonTypeId(1);
		$order->setBasket($basket);
		$paymentCollection = $order->getPaymentCollection();
		$payment = $paymentCollection->createItem(
			\Bitrix\Sale\PaySystem\Manager::getObjectById($paymentID)
		);

		$payment->setField("SUM", $order->getPrice());
		$payment->setField("CURRENCY", $order->getCurrency());

		$order->save();
		return $order->getId();
	}

	//событие когда заказ со страховкой оплачены
	public static function orderPolicyPay($orderID)
	{
		\Bitrix\Main\Loader::includeModule("sale");
		\Bitrix\Main\Loader::includeModule("form");

		$policyData = static::getPolicyFromOrder($orderID);

		// получим товар
		$product = \CIBlockElement::GetList(
			[],
			[
				"IBLOCK_ID" => static::IBLOCK_POLICY,
				"ID"        => $productID,
			],
			false,
			false,
			[
				"ID",
				"PROPERTY_TEMPLATE",
				"PROPERTY_CURRENT",
			]
		)->GetNext();
		$objDateForm = new \Bitrix\Main\Type\DateTime();
		$date_form = $objDateForm->add("15 day");
		$objDateBy = new \Bitrix\Main\Type\DateTime();
		$date_by = $objDateBy->add("1 years");

		$result = $policyData["ORIGINAL_PROP"];

		// серию
		$result[] = [
			"NAME"  => "Серия полиса",
			"CODE"  => "SERIAL_NUMBER",
			"VALUE" => date("y")
		];
		// добавляем дату начала действия полиса
		$result[] = [
			"NAME"  => "Дата начала действия полиса",
			"CODE"  => "DATE_FROM",
			"VALUE" => $date_form->format("d.m.Y")
		];
		// добавляем дату начала срока действия полиса
		$result[] = [
			"NAME"  => "Дата начала срока действия полиса",
			"CODE"  => "DATE_TERM_FROM",
			"VALUE" => $date_form->format("d.m.Y")
		];
		// добавляем дату завершения срока полиса
		$result[] = [
			"NAME"  => "Дата завершения срока действия полиса",
			"CODE"  => "DATE_TERM_BY",
			"VALUE" => $date_by->format("d.m.Y")
		];
		// добавляем ссылку на pdf
		$result[] = [
			"NAME"  => "Ссылка на страховой полис",
			"CODE"  => "LINK",
			"VALUE" => "/lk/orders/policy/?ORDER_ID=".$orderID
		];

		// номер
		// прибавим и сохраним
		$current = $product["PROPERTY_CURRENT_VALUE"] + 1;
		\CIBlockElement::SetPropertyValuesEx(
			$product["ID"],
			static::IBLOCK_POLICY,
			['CURRENT' => $current]
		);

		$result[] = [
			"NAME"  => "Номер",
			"CODE"  => "NUMBER",
			"VALUE" => str_pad($current,7,"0",STR_PAD_LEFT)
		];

		$arFields["PROPS"] = $result;

		// обновляем  корзину
		\CSaleBasket::Update($policyData["ID"], $arFields);

		$arAnswers = \CFormResult::GetDataByID($policyData["PROP"]["RESULT_ID"], [], $arResult, $arAnswers2);

		$arEmails = [$policyData["EMAIL"],\CUser::GetEmail(), $arAnswers["EMAIL"][0]["USER_TEXT"]];
		$emails = implode(",",array_unique($arEmails));
		$eventField = [
			"EMAIL"      => htmlspecialchars($emails),
			"ORDER_USER" => htmlspecialchars($policyData["PROP"]["FULL_NAME"]),
			"ORDER_ID"   => $orderID,
		];
		// отправляем на почту ссылку
		\Bitrix\Main\Mail\Event::send(//Воспользоваться акцией ПОСЕТИТЕЛЬ
			[
				"EVENT_NAME" => "POLICY_PAY",
				"LID"        => "s1",
				"C_FIELDS"   => $eventField,
			]
		);
	}

	// получает из заказа товар полис
	public static function getPolicyFromOrder($orderID)
	{
		\Bitrix\Main\Loader::includeModule("sale");

		// получим заказ
		$obOrder = \CSaleOrderPropsValue::GetOrderProps($orderID);

		while ($arOrder = $obOrder->fetch()) {
			if ($arOrder['IS_EMAIL'] == 'Y' && check_email($arOrder['VALUE'])) {
				$order["EMAIL"] = $arOrder['VALUE'];
			}
		}
		// получим массив
		$obBasket = \CSaleBasket::GetList(
			[],
			[
				"ORDER_ID" => $orderID
			],
			false,
			false,
			[]
		);

		while ($arBasket = $obBasket->Fetch()) {
			$arBasketIds[] = $arBasket["ID"];
		}

		$obBasketProductProp = \CSaleBasket::GetPropsList(
			[],
			[
				"BASKET_ID" => $arBasketIds
			]
		);
		while ($arBasketProductProp = $obBasketProductProp->Fetch()) {
			$arProduct[$arBasketProductProp["BASKET_ID"]][$arBasketProductProp["CODE"]] = $arBasketProductProp["VALUE"];
			$prop[$arBasketProductProp["BASKET_ID"]][] = $arBasketProductProp;
		}

		foreach ($arProduct as $basketID => $arField) {
			//рассматриваем только полисы
			if (empty($arField["POLICY_ID"])) {
				continue;
			}

			//TODO предполагаем что в заказе может быть только одна страховка
			$policy = [
				"EMAIL"         => $order["EMAIL"],
				"ID"            => $basketID,
				"PROP"          => $arField,
				"ORIGINAL_PROP" => $prop[$basketID]
			];
		}
		return $policy;
	}

	// оплачен ли заказ
	public static function getOrder($orderID)
	{
		\CModule::IncludeModule("sale");
		$order = \Bitrix\Sale\Order::load($orderID);
		return $order;
	}

	//  предварительная обработка полей, передаваемых в форме
	public static function validOrderPolicy($formId, $arrVALUES)
	{
		$arFieldLogicRequired = [
			"form_checkbox_ACTUAL_ADDRESS" =>
				[
					"form_text_22" => "form_text_14",
					"form_text_23" => "form_text_15",
					"form_text_24" => "form_text_16",
					"form_text_25" => "form_text_17",
					"form_text_38" => "form_text_18",
					"form_date_26" => "form_date_19",
					"form_text_27" => "form_text_20",
				],
			"form_radio_POLICY_ADDRESS"    =>
				[
					"form_text_31" => [
						"form_text_14", "form_text_22"
					],
					"form_text_33" => [
						"form_text_15", "form_text_23"
					],
					"form_text_32" => [
						"form_text_16", "form_text_24"
					],
					"form_text_34" => [
						"form_text_17", "form_text_25"
					],
					"form_text_39" => [
						"form_text_18", "form_text_38"
					],
					"form_date_35" => [
						"form_date_19", "form_date_26"
					],
					"form_text_36" => [
						"form_text_20", "form_text_27"
					],
				]
		];

		if (!empty($arrVALUES['form_checkbox_ACTUAL_ADDRESS'])) {
			foreach ($arFieldLogicRequired['form_checkbox_ACTUAL_ADDRESS'] as $fieldName => $fieldValue) {
				$arrVALUES[$fieldName] = $arrVALUES[$fieldValue];
			}
		}
		if ($arrVALUES["form_radio_POLICY_ADDRESS"] != 30) {

			foreach ($arFieldLogicRequired['form_radio_POLICY_ADDRESS'] as $fieldName => $fieldValue) {
				if ($arrVALUES["form_radio_POLICY_ADDRESS"] == 28) {
					$arrVALUES[$fieldName] = $arrVALUES[$fieldValue[0]];

				} else {
					$arrVALUES[$fieldName] = $arrVALUES[$fieldValue[1]];
				}
			}
		}

		foreach ($arrVALUES as $fieldName => $fieldValue) {
			if (stripos($fieldName, "date") && !empty($fieldValue)) {
				$date = new \DateTime($fieldValue);
				$arrVALUES[$fieldName] = $date->format("d.m.Y");
			} else {
				$arrVALUES[$fieldName] = $fieldValue;
			}
		}
		return $arrVALUES;
	}
}
