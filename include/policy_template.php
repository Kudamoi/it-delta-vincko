<picture class="products__head">
	<img src="<?= $arParams["POLICY"]["IMG"] ?>" alt="<?= $arParams["POLICY"]["NAME"] ?>"/>
</picture>
<div class="products__name">
	<div class="products__gray"><?= $arParams["POLICY"]["INSURANCE"]["NAME"] ?></div>
	<h3 class="products__title">«<?= $arParams["POLICY"]["NAME"] ?>»</h3>
</div>
<? if ($arParams["POLICY"]["MAX_PRICE"] > 0): ?>
	<div class="products__max-payment">
		<div class="products__container">
			<div class="products__gray"><?= GetMessage('T_INSURANCE_MAX_PAY') ?></div>

			<? if (!empty($arParams["POLICY"]["MAX_PRICE_TEXT"])) : ?>
				<div class="products__info">
					<div class="products__info-sign">
						<picture><img
									src="/local/templates/v_new_template/img/insurance/product-info.svg"
									alt="info"></picture>
					</div>
					<div class="products__text-container">
						<div class="products__info-text">
							<?= htmlspecialchars_decode($arParams["POLICY"]["MAX_PRICE_TEXT"]) ?>
						</div>
					</div>
				</div>
			<? endif; ?>
		</div>
		<div class="products__title h3">
			<?= $arParams["POLICY"]["MAX_PRICE"] ?>
		</div>
	</div>
<? endif; ?>
<? if (!empty($arParams["POLICY"]["PAYMENT_OPTIONS"])): ?>
	<div class="products__payment">
		<div class="products__gray">
			<?= GetMessage('T_INSURANCE_OPTIONS_PAY') ?>
		</div>

		<? foreach ($arParams["POLICY"]["PAYMENT_OPTIONS"] as $arPaymentOptions): ?>
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