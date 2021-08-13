<?php

use Bitrix\Main\Error;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\Localization\Loc;
use OT\Main\Helpers\CompaniesIblockHelper;

Loc::loadMessages(__FILE__);

class PolicyPdf extends CBitrixComponent
{
	const IBLOCK_DOCUMENT = 40;
	protected $error = [];
	protected $orderPay = false;
	protected $policyData = [];
	protected $policyInfo = [];

	/**
	 * @throws LoaderException
	 */
	public function includeModules()
	{
		Loader::includeModule("sale");
	}

	public function getOrder()
	{

		$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

		$orderID = $request->get("ORDER_ID");

		if (empty($orderID)) {
			$this->errors = "Заказ не найден";
			return false;
		}

		$this->order = \Vincko\Order::getOrder($orderID);
		$this->orderPay = $this->order->isPaid();

		$this->policyData = \Vincko\Order::getPolicyFromOrder($orderID)["PROP"];
	}

	// проверка: действительно ли в заказе есть страховка и заказ оплачен?
	public function checkOrder()
	{

		if (empty($this->orderPay)) {
			$this->errors = "Заказ не оплачен";
		}

		if (empty($this->policyData)) {
			$this->errors = "В заказе нет страховки";
		}

		if (empty($this->policyData) || ($this->order->getUserId() !== $GLOBALS["USER"]->GetID() && !$GLOBALS["USER"]->IsAdmin())) {
			$this->errors = "Заказ не существует";
		}

	}

	// проверка полиса: все ли поля в заказе необходимые для полиса?
	public function checkPolicy()
	{
		foreach ($this->policyInfo["DATA"] as $pageID => $field) {
			foreach ($field as $fieldName => $fieldValue) {
				if (!isset($this->policyData[$fieldName])) {
					$this->errorsAdmin[] = "Не хватает данных для генерации страховки " . $fieldName;
				}
			}
		}
	}

	// получим документ страховки и его координаты
	public function getPolicy()
	{
		// получаем шаблон и данные для генерации шаблона
		$arDocument = \CIBlockElement::GetList(
			[],
			[
				"IBLOCK_ID" => static::IBLOCK_DOCUMENT,
				"ID"        => $this->policyData["DOCUMENT_ID"],
			],
			false,
			false,
			[
				"ID",
				"IBLOCK_ID",
				"PROPERTY_FILE",
				"PROPERTY_DATA"
			]
		)->GetNext();

		$file = \CFile::GetFileArray($arDocument["PROPERTY_FILE_VALUE"]);

		$policy = [
			"FILE" => $file["SRC"],
			"DATA" => json_decode($arDocument["~PROPERTY_DATA_VALUE"]["TEXT"]),
		];

		$this->policyInfo = $policy;
	}

	// разбираем данные в необходимом виде
	public function getPageField()
	{

		if (!empty($this->errors)) {
			return false;
		}

		$template["FILE"] = $this->policyInfo["FILE"];
		// разберем постранично
		foreach ($this->policyInfo["DATA"] as $id => $field) {
			foreach ($field as $fieldName => $fieldValue) {
				// преобразуем  шаблон
				$template["DATA"][$id][$fieldName] = [
					"LENGTH"      => $fieldValue->LENGTH,
					"ALIGN"       => $fieldValue->ALIGN,
					"COORDINATES" => $fieldValue->COORDINATES,
					"LINE"        => $fieldValue->LINE,
					"VALIGN"      => $fieldValue->VALIGN,
					"TEXT"        => $this->policyData[$fieldName]
				];
			}
		}
		return $template;
	}

	// получим массив для вывода
	public function prepareResult()
	{
		$this->arResult["ERROR"] = $this->errors;
		$this->arResult["PAGE"] = $this->getPageField();
	}


	public function executeComponent()
	{
		$this->includeModules();
		$this->getOrder();
		$this->checkOrder();
		$this->getPolicy();
		$this->checkPolicy();
		$this->prepareResult();
		$this->includeComponentTemplate($this->templatePage);
	}
}
