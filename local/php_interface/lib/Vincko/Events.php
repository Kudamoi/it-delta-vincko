<?php

namespace Vincko;

use Vincko\Order;
use Bitrix\Main\Application;
use Bitrix\Main\Loader;

class Events
{
	// событие после добавления результата формы
	public static function onBeforeResultAdd($formId, &$arFields, &$arrVALUES)
	{
		switch ($formId) {
			case 1 :
				$arrVALUES = \Vincko\Order::validOrderPolicy($formId, $arrVALUES);
				break;
		}
	}

	// событие после добавления результата формы
	public static function afterResultAdd($formId, $resultId)
	{
		\Bitrix\Main\Loader::includeModule('form');
		$arAnswers = \CFormResult::GetDataByID($resultId, [], $arResult, $arAnswers2);

		switch ($formId) {
			case 1 :

				// TODO пока ограничиваем набор полей для страховки
				// в дальнейшем развитии этот набор нужно будет генерировать после оплаты полиса
				// в соответсвии с актуальным шаблоном страховки
				foreach ($arAnswers as $arValue) {
					$arField[$arValue[0]["SID"]] = $arValue[0]["USER_TEXT"];
				}
				if ($arOffer = Policy::getById($arField["POLICY_ID"])) {
					// получим информацию о страховой(товаре) предлагающей полис
					$arInsurance = Policy::getInsurance($arOffer["PROPERTIES"]["CML2_LINK"]["VALUE"]);

					// получим варианты выплаты по основным пунктам страховки
					$arAllPaymentOptions = Policy::getPaymentOptions($arOffer["PROPERTIES"]["PAYMENT_OPTIONS"]["VALUE"]);

					$arPolicy = Policy::formatPolicy($arOffer, $arAllPaymentOptions, $arInsurance);

					$arPolicyField["POLICY"]["ID"] = $arField["POLICY_ID"];
					$arPolicyField["POLICY"]["PHONE"] = $arField["PHONE"];

					// сформируем необходимый мыссив для передачи в заказ
					$arPolicyField["PROPS"][] = [
						"NAME"  => "Идентификатор страховки",
						"CODE"  => "POLICY_ID",
						"VALUE" => $arField["POLICY_ID"]
					];

					$arPolicyField["PROPS"][] = [
						"NAME"  => "Шаблон страховки",
						"CODE"  => "DOCUMENT_ID",
						"VALUE" => $arPolicy["INSURANCE"]["TEMPLATE"]
					];

					$arPolicyField["PROPS"][] = [
						"NAME"  => "Идентификатор результата формы",
						"CODE"  => "RESULT_ID",
						"VALUE" => $resultId
					];

					$arPolicyField["PROPS"][] = [
						"NAME"  => "Фамилия Имя Отчество",
						"CODE"  => "FULL_NAME",
						"VALUE" => $arField["SURNAME"] . " " . $arField["NAME"] . " " . $arField["PATRONYMIC"]
					];

					$arPolicyField["PROPS"][] = [
						"NAME"  => "Паспортные данные и ИНН (при наличии)",
						"CODE"  => "DOCUMENT",
						"VALUE" => $arField["PASSPORT"] . " выдан " . $arField["PASSPORT_ISSUED"] . " от " . $arField["PASSPORT_DATE"] . " " . $arField["PASSPORT_CODE"] . ", " . $arField["INN"]
					];

					$arPolicyField["PROPS"][] = [
						"NAME"  => "Адрес регистрации Страхователя",
						"CODE"  => "REGISTRATION_ADDRESS",
						"VALUE" => "г. ".$arField["REGISTRATION_CITY"] . ", ул." . $arField["REGISTRATION_STREET"] . ", д." . $arField["REGISTRATION_HOUSE"] . ($arField["REGISTRATION_HOUSING"] ? ", корпус" . $arField["REGISTRATION_HOUSING"] : "") . ($arField["REGISTRATION_APARTMENT"] ? ", кв. " . $arField["REGISTRATION_APARTMENT"] : "")
					];

					$arPolicyField["PROPS"][] = [
						"NAME"  => "Телефон/e-mail",
						"CODE"  => "CONTACTS",
						"VALUE" => $arField["PHONE"] . "/" . $arField["EMAIL"]
					];

					$arPolicyField["PROPS"][] = [
						"NAME"  => "Дата рождения",
						"CODE"  => "DATE_OF_BIRTH",
						"VALUE" => $arField["DATE_OF_BIRTH"]
					];

					$arPolicyField["PROPS"][] = [
						"NAME"  => "Адрес объекта страхования",
						"CODE"  => "OBJECT_ADDRESS",
						"VALUE" => "г. ".$arField["POLICY_CITY"] . ", ул." . $arField["POLICY_STREET"] . ", д." . $arField["POLICY_HOUSE"] . ($arField["POLICY_HOUSING"] ? ", корпус" .  $arField["POLICY_HOUSING"] : "") . ($arField["POLICY_APARTMENT"] ? ", кв. " . $arField["POLICY_APARTMENT"] : "")
					];

					$arPolicyField["PROPS"][] = [
						"NAME"  => "Сумма по конструктивным элементам ж.п.",
						"CODE"  => "SUM_1",
						"VALUE" => $arPolicy["PAYMENT_OPTIONS"]["950"]["PRICE"]
					];

					$arPolicyField["PROPS"][] = [
						"NAME"  => "Сумма по внутренней отделке и инженерному оборудованию ж.п.",
						"CODE"  => "SUM_2",
						"VALUE" => $arPolicy["PAYMENT_OPTIONS"]["954"]["PRICE"]
					];

					$arPolicyField["PROPS"][] = [
						"NAME"  => "Сумма по движимому (домашнему) имуществу ж.п.",
						"CODE"  => "SUM_3",
						"VALUE" => $arPolicy["PAYMENT_OPTIONS"]["985"]["PRICE"]
					];

					$arPolicyField["PROPS"][] = [
						"NAME"  => "Сумма по гражданской ответственности",
						"CODE"  => "SUM_4",
						"VALUE" => $arPolicy["PAYMENT_OPTIONS"]["986"]["PRICE"]
					];

					$arPolicyField["PROPS"][] = [
						"NAME"  => "Страховая премия по договору",
						"CODE"  => "SUM_5",
						"VALUE" => $arPolicy["MAX_PRICE_ORIGINAL"]
					];

					$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

					$arPayment = $request["PAYMENT"];

					if ($orderId = Order::createOrderPolicy($arPolicyField, $arPayment, 1, false)) {
						// TODO 40 - это ИД ответа на вопрос ORDER_ID в форме заказа полиса
						\CFormResult::SetField($resultId, "ORDER_ID", ["40" => $orderId]);
					}
				}
		}
	}

	// событие оплаты заказа
	public static function OnSaleOrderPaid($order)
	{

		if (!$order->isPaid() || $order->isPaid() == false) {
			return false;
		}
		dump($order->isPaid());
		Order::orderPolicyPay($order->getId());

	}

	// событие при изменении пароля
	public static function OnBeforeUserChangePassword(&$arFields){

		if ($GLOBALS["USER"]->isAuthorized()){

			if($_REQUEST["NEW_PASSWORD"] == $_REQUEST["NEW_PASSWORD_CONFIRM"] && isset($_REQUEST["PASSWORD"])){
				$checkOldPassword = \Vincko\Auth::checkPassword($_REQUEST);
				if (!$checkOldPassword) {
die();
				}
			}

		}
	}
}