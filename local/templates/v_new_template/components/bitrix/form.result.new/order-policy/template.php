<?
defined("B_PROLOG_INCLUDED") && B_PROLOG_INCLUDED === true || die ();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Sale;

if (!CModule::IncludeModule("sale")) {
	ShowError(GetMessage("SALE_MODULE_NOT_INSTALL"));
	return;
}
?>
<? if (!$USER->IsAuthorized()): ?>
	<? $APPLICATION->IncludeComponent(
		"bitrix:system.auth.authorize",
		"",
		array()
	); ?>
<? else: ?>
	<? if ($arResult["isFormNote"] == "Y"): ?>

		<? include(Bitrix\Main\Application::getDocumentRoot() . $templateFolder . '/success.php'); ?>

	<? else: ?>

		<section class="installment insurance-policy order">
			<div class="installment__left-column">
				<h2 class="installment__page-title"><?= $arParams["TITLE"] ?></h2>

				<div class="short-ins short-ins-mobile" id="fix-card">
					<div class="short-ins__item products__item">
						<picture class="products__head short-ins__head hidden">
							<img src="<?= $arParams[" POLICY"]["IMG"] ?>" alt="product-head">
						</picture>

						<div class="products__name">
							<div class="products__gray"><?= $arResult["POLICY"]["INSURANCE"]["NAME"] ?></div>
							<div class="h3 products__title">«<?= $arResult["POLICY"]["NAME"] ?>»</div>
							<div class="price hidden"><span><?= GetMessage('FORM_POLICY_TOTAL') ?></span>
								<span><?= $arResult["POLICY"]["PRICE"] ?> ₽</span></div>
						</div>
						<div class="ready-pack__details">
							<div class="hide-details hidden">
								<span>Скрыть детали</span>
								<svg width="16" height="16" viewBox="0 0 16 16" fill="none"
									 xmlns="http://www.w3.org/2000/svg">
									<path d="M8.89604 5.17989L12.3358 8.95144C12.5547 9.19135 12.5547 9.58034 12.3358 9.82014C12.1171 10.06 11.7623 10.06 11.5436 9.82014L8.49994 6.4829L5.45638 9.82004C5.23756 10.0599 4.88284 10.0599 4.66411 9.82004C4.4453 9.58022 4.4453 9.19126 4.66411 8.95134L8.10393 5.1798C8.21335 5.05989 8.3566 5 8.49992 5C8.64332 5 8.78668 5.06 8.89604 5.17989Z"
										  fill="#005DFF"/>
								</svg>
							</div>
						</div>
						<? if ($arResult["POLICY"]["MAX_PRICE"] > 0): ?>
							<div class="products__max-payment hidden">
								<div class="products__gray">
									<?= GetMessage('FORM_POLICY_MAX_PAY') ?>
								</div>

								<div class="h3 products__title"><?= $arResult["POLICY"]["MAX_PRICE"] ?></div>
							</div>
						<? endif; ?>

						<? if (!empty($arResult["POLICY"]["PAYMENT_OPTIONS"])): ?>
							<div class="products__payment">
								<div class="products__gray">
									<?= GetMessage('FORM_POLICY_OPTIONS_PAY') ?>
								</div>

								<? foreach ($arResult["POLICY"]["PAYMENT_OPTIONS"] as $arPaymentOptions): ?>
									<div class="products__payment-item<?= ($arPaymentOptions["PRICE"] > 0 ? " products__payment-item_active" : "") ?>">
										<div class="no-stroke products__payment-photo">
											<?= $arPaymentOptions["ICON"] ?>
										</div>
										<div class="products__payment-name">
											<?= $arPaymentOptions["NAME"] ?>
										</div>
										<div class="products__payment-cost">
											<?= ($arPaymentOptions["PRICE"] > 0 ?
												CurrencyFormat($arPaymentOptions["PRICE"], 'RUB')
												: "нет") ?>
										</div>
										<div class="products__info">
											<div class="products__info-sign">
												<picture><img
															src="/local/templates/v_new_template/img/insurance/product-info.svg"
															alt="info"></picture>
											</div>
											<div class="products__text-container">
												<div class="products__info-text">
													<?= htmlspecialchars_decode($arPaymentOptions["TEXT"]) ?>
												</div>
											</div>
										</div>
									</div>
								<? endforeach; ?>
							</div>
						<? endif; ?>

						<div class="short-rd__price hidden">
							<div class="short-rd__price-title"><?= GetMessage('FORM_POLICY_TOTAL') ?></div>
							<div class="short-rd__cost"><?= $arResult["POLICY"]["PRICE"] ?> ₽</div>
						</div>
						<div class="short-rd__footer hidden">
							<a href="<?= $arParams[" BACK_LINK"] ?>" class="short-rd-another">
								<svg width="14" height="12" viewBox="0 0 14 12" fill="none"
									 xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd"
										  d="M5.29289 11.7071C5.68342 12.0976 6.31658 12.0976 6.70711 11.7071C7.09763 11.3166 7.09763 10.6834 6.70711 10.2929L3.41421 7L13 7C13.5523 7 14 6.55228 14 6C14 5.44771 13.5523 5 13 5L3.41421 5L6.70711 1.70711C7.09763 1.31658 7.09763 0.683417 6.70711 0.292893C6.31658 -0.0976321 5.68342 -0.0976322 5.29289 0.292893L0.293739 5.29205C0.291278 5.2945 0.28883 5.29697 0.286396 5.29945C0.109253 5.47987 5.48388e-07 5.72718 5.24537e-07 6C5.12683e-07 6.13559 0.0269866 6.26488 0.0758796 6.38278C0.12432 6.49986 0.195951 6.6096 0.290776 6.70498M5.29289 11.7071L0.293092 6.7073L5.29289 11.7071Z"
										  fill="#005DFF"/>
								</svg>
								<?= GetMessage("FORM_POLICY_ANOTHER") ?>
							</a>
						</div>


						<div class="ready-pack__details">
							<div class="show-details">
								<span>Смотреть детали</span>
								<svg width="16" height="16" viewBox="0 0 16 16" fill="none"
									 xmlns="http://www.w3.org/2000/svg">
									<path d="M8.10396 9.82011L4.66419 6.04856C4.44527 5.80865 4.44527 5.41966 4.66419 5.17986C4.88292 4.94004 5.23768 4.94004 5.45639 5.17986L8.50006 8.5171L11.5436 5.17996C11.7624 4.94014 12.1172 4.94014 12.3359 5.17996C12.5547 5.41978 12.5547 5.80874 12.3359 6.04866L8.89607 9.8202C8.78665 9.94011 8.6434 10 8.50007 10C8.35668 10 8.21332 9.94 8.10396 9.82011Z"
										  fill="#005DFF"/>
								</svg>
							</div>
							<div class="hide-details hidden">
								<span>Скрыть детали</span>
								<svg width="16" height="16" viewBox="0 0 16 16" fill="none"
									 xmlns="http://www.w3.org/2000/svg">
									<path d="M8.89604 5.17989L12.3358 8.95144C12.5547 9.19135 12.5547 9.58034 12.3358 9.82014C12.1171 10.06 11.7623 10.06 11.5436 9.82014L8.49994 6.4829L5.45638 9.82004C5.23756 10.0599 4.88284 10.0599 4.66411 9.82004C4.4453 9.58022 4.4453 9.19126 4.66411 8.95134L8.10393 5.1798C8.21335 5.05989 8.3566 5 8.49992 5C8.64332 5 8.78668 5.06 8.89604 5.17989Z"
										  fill="#005DFF"/>
								</svg>
							</div>
						</div>
					</div>
				</div>
				<?= $arResult["FORM_HEADER"] ?>
				<input type="hidden" name="form_checkbox_AGREEMENT[]" data-field="AGREEMENT" value="37" disabled>
				<input type="hidden" name="web_form_apply"value="1">
				<input type="hidden" name="form_hidden_<?= $arResult["QUESTIONS"]["POLICY_ID"]["STRUCTURE"][0]["ID"] ?>"
					   value="<?= $arResult["POLICY_ID"] ?>"/>
				<div class="forms">
					<div class="form" id="form-1">
						<div class="h4 form__title">
							<span class="form__title-blue"><?= $arParams["SUB_TITLE"] ?></span>
							<span class="form__title-step"><?= Loc::getMessage("FORM_POLICY_STEP_1") ?></span>
						</div>

						<div class="form__content">
							<div class="form__section">
								<div class="h4">
									<?= Loc::getMessage("FORM_POLICY_INFORMATION") ?>
									<span class="form__required error_message" <?= (!empty($arResult['FORM_ERRORS']) ? " style='display:block'" : "") ?>><?= Loc::getMessage("FORM_POLICY_ERROR_MSG") ?></span>
								</div>
								<div class="form__section__content sex">
								<span class="js-check-valid-field"
									  data-field="GENDER"><?= Loc::getMessage("FORM_POLICY_GENDER") ?></span>
									<?= $arResult["QUESTIONS"]["GENDER"]["HTML_CODE"] ?>
								</div>
								<div class="form__section__content name">
									<?= $arResult["QUESTIONS"]["SURNAME"]["HTML_CODE"] ?>
									<?= $arResult["QUESTIONS"]["NAME"]["HTML_CODE"] ?>
									<?= $arResult["QUESTIONS"]["PATRONYMIC"]["HTML_CODE"] ?>
									<?= $arResult["QUESTIONS"]["DATE_OF_BIRTH"]["HTML_CODE"] ?>
									<?= $arResult["QUESTIONS"]["PLACE_OF_BIRTH"]["HTML_CODE"] ?><br/>
									<?= $arResult["QUESTIONS"]["EMAIL"]["HTML_CODE"] ?><br/>
									<?= $arResult["QUESTIONS"]["PHONE"]["HTML_CODE"] ?>
								</div>
							</div>
							<div class="form__section">
								<div class="h4"><?= Loc::getMessage("FORM_POLICY_PASSPORT") ?></div>
								<div class="form__section__content passport">
									<?= $arResult["QUESTIONS"]["PASSPORT"]["HTML_CODE"] ?>
									<?= $arResult["QUESTIONS"]["PASSPORT_DATE"]["HTML_CODE"] ?><br/>
									<?= $arResult["QUESTIONS"]["PASSPORT_ISSUED"]["HTML_CODE"] ?>
									<?= $arResult["QUESTIONS"]["PASSPORT_CODE"]["HTML_CODE"] ?>
									<?= $arResult["QUESTIONS"]["INN"]["HTML_CODE"] ?>
								</div>
							</div>
							<div class="form__section">
								<div class="h4"><?= Loc::getMessage("FORM_POLICY_REGISTRATION") ?></div>
								<div class="form__section__content address-registration">
									<?= $arResult["QUESTIONS"]["REGISTRATION_CITY"]["HTML_CODE"] ?>
									<?= $arResult["QUESTIONS"]["REGISTRATION_STREET"]["HTML_CODE"] ?><br/>
									<?= $arResult["QUESTIONS"]["REGISTRATION_HOUSE"]["HTML_CODE"] ?>
									<?= $arResult["QUESTIONS"]["REGISTRATION_HOUSING"]["HTML_CODE"] ?>
									<?= $arResult["QUESTIONS"]["REGISTRATION_APARTMENT"]["HTML_CODE"] ?><br/>
									<?= $arResult["QUESTIONS"]["REGISTRATION_DATE"]["HTML_CODE"] ?>
									<?= $arResult["QUESTIONS"]["REGISTRATION_INDEX"]["HTML_CODE"] ?>
								</div>
								<div class="h4"><?= Loc::getMessage("FORM_POLICY_ACTUAL") ?></div>

								<div class="form__section__content address-residense">
									<?= $arResult["QUESTIONS"]["ACTUAL_ADDRESS"]["HTML_CODE"] ?>

									<div class="no-checked address-registration">
										<?= $arResult["QUESTIONS"]["ACTUAL_CITY"]["HTML_CODE"] ?><br>
										<?= $arResult["QUESTIONS"]["ACTUAL_STREET"]["HTML_CODE"] ?>
										<?= $arResult["QUESTIONS"]["ACTUAL_HOUSE"]["HTML_CODE"] ?>
										<?= $arResult["QUESTIONS"]["ACTUAL_HOUSING"]["HTML_CODE"] ?>
										<?= $arResult["QUESTIONS"]["ACTUAL_APARTMENT"]["HTML_CODE"] ?><br>
										<?= $arResult["QUESTIONS"]["ACTUAL_DATE"]["HTML_CODE"] ?>
										<?= $arResult["QUESTIONS"]["ACTUAL_INDEX"]["HTML_CODE"] ?>
									</div>
									<p><?= Loc::getMessage("FORM_POLICY_ACTUAL_NOT_REGISTRATION") ?></p>
								</div>
								<div class="h4"><?= Loc::getMessage("FORM_POLICY_ADDRESS") ?></div>
								<div class="form__section__content address-installment">
									<?= $arResult["QUESTIONS"]["POLICY_ADDRESS"]["HTML_CODE"] ?>
									<p><?= Loc::getMessage("FORM_POLICY_ADDRESS_NOT_POLICY") ?></p>
									<div class="address-registration address-installment-other">
										<?= $arResult["QUESTIONS"]["POLICY_CITY"]["HTML_CODE"] ?>
										<?= $arResult["QUESTIONS"]["POLICY_STREET"]["HTML_CODE"] ?><br/>
										<?= $arResult["QUESTIONS"]["POLICY_HOUSE"]["HTML_CODE"] ?>
										<?= $arResult["QUESTIONS"]["POLICY_HOUSING"]["HTML_CODE"] ?>
										<?= $arResult["QUESTIONS"]["POLICY_APARTMENT"]["HTML_CODE"] ?><br/>
										<?= $arResult["QUESTIONS"]["POLICY_DATE"]["HTML_CODE"] ?>
										<?= $arResult["QUESTIONS"]["POLICY_INDEX"]["HTML_CODE"] ?>
									</div>
								</div>
							</div>
						</div>
						<div class="form__bottom">
							<div class="blue-button form__next-button js-check-form-valid">
								<span><?= Loc::getMessage("FORM_POLICY_NEXT") ?></span></div>
							<div class="form__complete hidden">
								<svg width="13" height="10" viewBox="0 0 13 10" fill="none"
									 xmlns="http://www.w3.org/2000/svg">
									<path d="M4.13132 7.88963L1.04946 4.78001L0 5.83147L4.13132 10L13 1.05145L11.9579 0L4.13132 7.88963Z"
										  fill="#005DFF"/>
								</svg>
								<span><?= Loc::getMessage("FORM_POLICY_DATA") ?></span>
							</div>
						</div>
					</div>
					<div class="form form__payment def-close" id="form-2">
						<div class="h4 form__title">
							<span class="form__title-blue"><?= Loc::getMessage("FORM_POLICY_STEP_PAY") ?></span>
							<span class="form__title-step"><?= Loc::getMessage("FORM_POLICY_STEP_2") ?></span>
						</div>

						<div class="form__content">
								<div class="form__section">
									<h4><?= Loc::getMessage("FORM_POLICY_PAY") ?></h4>
									<div class="form__section__content payment-method">
										<div class="payment-method-left">
											<? foreach ($arResult["PAYMENT"] as $arPayment): ?>
												<div class="radio-wrapper" id="card-radio">
													<input type="radio" id="<?= $arPayment["ID"] ?>" name="PAYMENT"
														   value="<?= $arPayment["ID"] ?>"/>
													<label for="<?= $arPayment["ID"] ?>"></label>
													<label for="<?= $arPayment["ID"] ?>"><?= $arPayment["NAME"] ?></label>
												</div>
											<? endforeach; ?>
										</div>

										<div class="payment-method-right">
											<div class="payment-method__card active">
												<h4><?= GetMessage('FORM_POLICY_TOTAL') ?></h4>
												<div class="payment-method__price"><?= $arResult["POLICY"]["PRICE"] ?> ₽</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form__section form__pay-info">
									<div class="form__section__content">
										<p><?= Loc::getMessage("FORM_POLICY_PAY_INFO") ?></p>
									</div>
								</div>

						</div>
					</div>
				</div>

				</form>
			</div>
			<div class="installment__right-column">
				<div class="short-ins ">
					<div id="short-rd" class="short-ins__item products__item hidden">
						<picture class="products__head short-ins__head">
							<img src="<?= $arResult["POLICY"]["IMG"] ?>" alt="<?= $arResult["POLICY"]["NAME"] ?>"/>
						</picture>

						<div class="products__name">
							<div class="products__gray"><?= $arResult["POLICY"]["INSURANCE"]["NAME"] ?></div>
							<div class="h3 products__title">«<?= $arResult["POLICY"]["NAME"] ?>»</div>
						</div>

						<? if ($arResult["POLICY"]["MAX_PRICE"] > 0): ?>
							<div class="products__max-payment">
								<div class="products__gray">
									<?= GetMessage('FORM_POLICY_MAX_PAY') ?>
								</div>

								<div class="h3 products__title"><?= $arResult["POLICY"]["MAX_PRICE"] ?></div>
							</div>

						<? endif; ?>

						<? if (!empty($arResult["POLICY"]["PAYMENT_OPTIONS"])): ?>
							<div class="products__payment">
								<div class="products__gray">
									<?= GetMessage('FORM_POLICY_OPTIONS_PAY') ?>
								</div>

								<? foreach ($arResult["POLICY"]["PAYMENT_OPTIONS"] as $arPaymentOptions): ?>
									<div class="products__payment-item<?= ($arPaymentOptions["PRICE"] > 0 ? " products__payment-item_active" : "") ?>">
										<div class="no-stroke products__payment-photo">
											<?= $arPaymentOptions["ICON"] ?>
										</div>
										<div class="products__payment-name">
											<?= $arPaymentOptions["NAME"] ?>
										</div>
										<div class="products__payment-cost">
											<?= ($arPaymentOptions["PRICE"] > 0 ?
												CurrencyFormat($arPaymentOptions["PRICE"], 'RUB')
												: "нет") ?>
										</div>
										<div class="products__info">
											<div class="products__info-sign">
												<picture><img
															src="/local/templates/v_new_template/img/insurance/product-info.svg"
															alt="info"></picture>
											</div>
											<div class="products__text-container">
												<div class="products__info-text">
													<?= htmlspecialchars_decode($arPaymentOptions["TEXT"]) ?>
												</div>
											</div>
										</div>
									</div>
								<? endforeach; ?>
							</div>
						<? endif; ?>

						<div class="short-rd__price">
							<div class="short-rd__price-title"><?= GetMessage('FORM_POLICY_TOTAL') ?></div>
							<div class="short-rd__cost"><?= $arResult["POLICY"]["PRICE"] ?> ₽</div>
						</div>
						<div class="short-rd__footer">
							<a href="<?= $arParams["BACK_LINK"] ?>" class="short-rd-another">
								<svg width="14" height="12" viewBox="0 0 14 12" fill="none"
									 xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd"
										  d="M5.29289 11.7071C5.68342 12.0976 6.31658 12.0976 6.70711 11.7071C7.09763 11.3166 7.09763 10.6834 6.70711 10.2929L3.41421 7L13 7C13.5523 7 14 6.55228 14 6C14 5.44771 13.5523 5 13 5L3.41421 5L6.70711 1.70711C7.09763 1.31658 7.09763 0.683417 6.70711 0.292893C6.31658 -0.0976321 5.68342 -0.0976322 5.29289 0.292893L0.293739 5.29205C0.291278 5.2945 0.28883 5.29697 0.286396 5.29945C0.109253 5.47987 5.48388e-07 5.72718 5.24537e-07 6C5.12683e-07 6.13559 0.0269866 6.26488 0.0758796 6.38278C0.12432 6.49986 0.195951 6.6096 0.290776 6.70498M5.29289 11.7071L0.293092 6.7073L5.29289 11.7071Z"
										  fill="#005DFF"/>
								</svg>
								<?= GetMessage("FORM_POLICY_ANOTHER") ?>
							</a>
						</div>
					</div>
				</div>

				<div class="installment__rules installment__rules--active">
					<div class="installment__rules-wall"></div>

					<label for="view-agree" class="installment__rules-mobile" id="label-view-agree">
						<span><span class="show"><?= GetMessage("FORM_POLICY_EXPAND") ?></span><span
									class="hide"><?= GetMessage("FORM_POLICY_HIDE") ?></span> <?= GetMessage("FORM_POLICY_TEXT_IF") ?><?= $arResult["POLICY"]["INSURANCE"]["NAME"] ?></span>
						<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M8.10396 9.82011L4.66419 6.04856C4.44527 5.80865 4.44527 5.41966 4.66419 5.17986C4.88292 4.94004 5.23768 4.94004 5.45639 5.17986L8.50006 8.5171L11.5436 5.17996C11.7624 4.94014 12.1172 4.94014 12.3359 5.17996C12.5547 5.41978 12.5547 5.80874 12.3359 6.04866L8.89607 9.8202C8.78665 9.94011 8.6434 10 8.50007 10C8.35668 10 8.21332 9.94 8.10396 9.82011Z"
								  fill="#A0A0A0"/>
						</svg>
					</label>
					<input type="checkbox" name="view-agree" id="view-agree">

					<p class="installment__rules-text">
						<? $APPLICATION->IncludeFile('/include/order_policy_agreement.php'); ?>
					</p>

					<?= $arResult["QUESTIONS"]["AGREEMENT"]["HTML_CODE"] ?>
					<button type="submit" class="button yellow-button" name="web_form_apply"
							value="1" disabled><?= $arResult["arForm"]["BUTTON"] ?></button>
				</div>
			</div>

		</section>
	<? endif; ?>
	<? endif; ?>