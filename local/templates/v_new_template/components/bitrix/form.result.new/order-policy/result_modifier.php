<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Vincko\Policy;
use \Vincko\Order;

// получим передаваемые значения
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();


$arResult["POLICY_ID"] = ($request->getPost('POLICY_ID') ?? $arResult["arrVALUES"]["form_hidden_" . $arResult["QUESTIONS"]["POLICY_ID"]["STRUCTURE"][0]["ID"]]);

// если ID полиса нет то перебрасываем на выбор полиса
if (empty($arResult["POLICY_ID"]) && $arResult["isFormNote"] != "Y") {
	LocalRedirect($arParams["BACK_LINK"]);
}

if ($arResult["isFormNote"] == "Y") {
	$arOrder = \CFormResult::GetDataByID(
		$request->get("RESULT_ID"),
		array("ORDER_ID"),
		$arOrderResult,
		$arOrderAnswer);
	$arResult["ORDER_ID"] = $arOrder["ORDER_ID"][0]["USER_TEXT"];

}
// сформируем массив с особыми классами, необходимыми для верификации на фронте
$domClass = [
	"REGISTRATION_HOUSE"     => "house-field",
	"ACTUAL_HOUSE"           => "house-field",
	"POLICY_HOUSE"           => "house-field",
	"REGISTRATION_APARTMENT" => "flat-field",
	"ACTUAL_APARTMENT"       => "flat-field",
	"POLICY_APARTMENT"       => "flat-field",
	"REGISTRATION_INDEX"     => "index-field",
	"ACTUAL_INDEX"           => "index-field",
	"POLICY_INDEX"           => "index-field",
	"REGISTRATION_STREET"    => "street-field",
	"ACTUAL_STREET"          => "street-field",
	"POLICY_STREET"          => "street-field",
	"REGISTRATION_HOUSING"   => "housing-field",
	"ACTUAL_HOUSING"         => "housing-field",
	"POLICY_HOUSING"         => "housing-field",
];
// сформируем массив с особыми id, необходимыми для верификации на фронте
$domId = [
	"PHONE"         => "phone-field",
	"PASSPORT_CODE" => "code",
	"INN"           => "inn",
	"PASSPORT"      => "passport",
];

// отредактируем некоторые поля
foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
	if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] != 'hidden') {
		$idAnsw = $arQuestion['STRUCTURE'][0]["ID"];
		$arQuestion["CAPTION"] = ($arQuestion["REQUIRED"] == "Y" ? $arQuestion["CAPTION"] . " *" : $arQuestion["CAPTION"]);

		switch ($arQuestion['STRUCTURE'][0]['FIELD_TYPE']) {
			case "radio":
				$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"] = "";
				$name = "form_radio_" . $FIELD_SID;
				$i = 0;
				foreach ($arQuestion['STRUCTURE'] as $arAnsw) {
					$value = ($arResult["arrVALUES"][$name] == $arAnsw["ID"] ? 'checked' : '');
					// если текущее поле "Адрес квартиры, для которой вы оформляете страховку", у ответа "Указать другой адрес" будет особый id и отображение, предусмотренное на верстке
					if ($FIELD_SID == 'POLICY_ADDRESS' && $arAnsw["VALUE"] == 3) {
						$id = "other";
						if (!empty($value)) {
							$arResult["VIEW_BLOCK"][$FIELD_SID] = 1;
						}
					} else {
						$id = $arAnsw["ID"];
					}
					if ($FIELD_SID == 'GENDER') {
						$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"] .= '<input type="radio"  id="' . $id . '" name="' . $name . '" value="' . $arAnsw["ID"] . '" ' . ($value ? $value : ($i == 0 ? " checked" : $i)) . '>
																	<label for="' . $id . '"></label>
																	<label for="' . $id . '">' . $arAnsw["MESSAGE"] . '</label>';
					} else {
						$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"] .= ($id != "other" ? '  <div class="radio-wrapper">' : '') . '
                                        <input type="radio"  id="' . $id . '" name="' . $name . '" value="' . $arAnsw["ID"] . '" ' . ($value ? $value : ($i == 0 ? " checked" : $i)) . '>
                                        <label for="' . $id . '"></label>
                                        <label for="' . $id . '">' . $arAnsw["MESSAGE"] . '</label>
                                   ' . ($id != "other" ? ' </div>' : '');
					}
					$i++;
				}
				break;
			case "date":
				$name = "form_date_" . $idAnsw;
				$value = ($arResult["arrVALUES"][$name] ? ' value="' . $arResult["arrVALUES"][$name] . '"' : '');

				$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"] = '
				<input' . $value . ' data-field="' . $FIELD_SID . '" type="text" class="form_date js-check-valid-field' . (!empty($arResult['FORM_ERRORS'][$FIELD_SID]) ? ' error' : '') . '" name="' . $name . '" placeholder="' . $arQuestion["CAPTION"] . '" onclick="BX.calendar({node: this, value: \'' . date('d.m.Y') . '\',field: this, bTime: false});" autocomplete="off">
				';
				break;
			case "email":
				$name = "form_email_" . $idAnsw;
				$value = ($arResult["arrVALUES"][$name] ? ' value="' . $arResult["arrVALUES"][$name] . '"' : '');

				$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"] = '<input' . $value . ' id="email-field"  class="js-check-valid-field' . (!empty($arResult['FORM_ERRORS'][$FIELD_SID]) ? ' error' : '') . '" data-field="' . $FIELD_SID . '" type="text" name="' . $name . '" inputmode="email"  placeholder="' . $arQuestion["CAPTION"] . '" value="">';
				break;
			case "text":
				$name = "form_text_" . $idAnsw;
				$value = ($arResult["arrVALUES"][$name] ? ' value="' . $arResult["arrVALUES"][$name] . '"' : '');
				$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"] = '<input' . $value . ' ' . ($domId[$FIELD_SID] ? 'id="' . $domId[$FIELD_SID] . '"' : '') . 'class="js-check-valid-field ' . ($domClass[$FIELD_SID] ?? "text-field") . (!empty($arResult['FORM_ERRORS'][$FIELD_SID]) ? ' error' : '') . '" data-field="' . $FIELD_SID . '" type="text" inputmode="text" name="' . $name . '" placeholder="' . $arQuestion["CAPTION"] . '" value="">';
				break;
			case "checkbox":
				$name = "form_checkbox_" . $FIELD_SID . "[]";
				$value = ($arResult["arrVALUES"][$name] ? ' value="' . $arResult["arrVALUES"][$name] . '"' : '');

				$arResult["QUESTIONS"][$FIELD_SID]["HTML_CODE"] = '<input' . $value . ' class="js-check-valid-field' . (!empty($arResult['FORM_ERRORS'][$FIELD_SID]) ? ' error' : '') . '" data-field="' . $FIELD_SID . '" type="checkbox" name="' . $name . '" id="' . $idAnsw . '" value="' . $idAnsw . '">
				                                					<label for="' . $idAnsw . '" class="js-check-valid-field' . (!empty($arResult['FORM_ERRORS'][$FIELD_SID]) ? ' error' : '') . '" data-field="' . $FIELD_SID . '">' . $arQuestion["CAPTION"] . '</label>';
				break;

		}


	}
}

// получим информацию о полисе(торговом предложении)
$arOffer = Policy::getById($arResult["POLICY_ID"]);

// получим информацию о страховой(товаре) предлагающей полис
$arInsurance = Policy::getInsurance($arOffer["PROPERTIES"]["CML2_LINK"]["VALUE"]);

// получим варианты выплаты по основным пунктам страховки
$arAllPaymentOptions = Policy::getPaymentOptions($arOffer["PROPERTIES"]["PAYMENT_OPTIONS"]["VALUE"]);

//соберем массив полиса
$arResult["POLICY"] = Policy::formatPolicy($arOffer, $arAllPaymentOptions, $arInsurance);

$arResult["PAYMENT"] = Order::getPaymentSystem();

?>
