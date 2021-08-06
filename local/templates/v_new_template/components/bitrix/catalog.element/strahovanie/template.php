<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);
?>

<? if (!empty($arResult["POLICIES"])): ?>
	<div class="products">
		<h2 class="title"><?= $arParams["TITLE_POLICY"] ?></h2>
		<div class="products__main-info">

		</div>
		<? foreach ($arResult["POLICIES"] as $arPolicy) : ?>
			<div class="products__item">

				<? $APPLICATION->IncludeComponent(
					'bitrix:main.include', '',
					[
						'AREA_FILE_SHOW' => 'file',
						'EDIT_TEMPLATE'  => '',
						'PATH'           => '/include/policy_template.php',
						'POLICY'         => $arPolicy,
					],
					false,
					["HIDE_ICONS" => "Y"]
				); ?>

				<div class="products__footer">
					<div class="products__footer-up">
						<div class="products__cost"><?= $arPolicy["PRICE"] ?>/год</div>
						<form method="POST" action="<?= $arParams["BASKET_URL"] ?>">
							<input type="hidden" name="POLICY_ID" value="<?= $arPolicy["ID"] ?>">
							<button class="products__order js-modal js-modal-auth" value="1"><?= GetMessage('T_INSURANCE_ORDER') ?></button>
						</form>
					</div>
					<div class="products__footer-down">
						<div class="products__offer">
							<?= GetMessage('T_INSURANCE_BONUCE') ?>
						</div>

						<a class="products__get-bonuses blue-border-button js-bonuce">
							<?= GetMessage('T_INSURANCE_GET_BONUCE') ?>
						</a>

						<div class="products__instalment">
							<div class="products__instalment-offer">
								<?= GetMessage('T_INSURANCE_ORDER_POLICE') ?>
							</div>
							<a class="products__instalment-info">
								<?= GetMessage('T_INSURANCE_MORE') ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		<? endforeach; ?>
		<? $APPLICATION->IncludeComponent(
			"bitrix:main.include", "",
			[
				"AREA_FILE_SHOW" => "file",
				"EDIT_TEMPLATE"  => "",
				"PATH"           => "/include/strahovanie-loyalty-program.php"
			]
		); ?>
	</div>
<? endif; ?>

<? // БЛОК ВКЛЮЧЕНО В ПОЛИС ?>


<? // БЛОК С ДОКУМЕНТАМИ ?>
<? $this->SetViewTarget("document"); ?>
<? if (!empty($arResult["PROPERTIES"]["DOCUMENTS"]["VALUE"])): ?>
	<div class="container">
		<div class="documents">
			<div class="documents__head">
				<div class="documents__title">
					<span class="blue">
						<?= GetMessage('T_INSURANCE_DOC') ?>
					</span>
					<?= $arResult["NAME"] ?>
				</div>

				<div class="documents__switch">
					<div class="documents__switch-open">
						<span>
							<?= GetMessage('T_INSURANCE_EXPAND') ?>
						</span>
						<svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M4.10396 4.82011L0.664193 1.04856C0.445269 0.808645 0.445269 0.419663 0.664193 0.179864C0.882921 -0.059955 1.23768 -0.059955 1.45639 0.179864L4.50006 3.5171L7.54362 0.179961C7.76244 -0.0598577 8.11716 -0.0598576 8.33589 0.179961C8.5547 0.41978 8.5547 0.808743 8.33589 1.04866L4.89607 4.8202C4.78665 4.94011 4.6434 5 4.50007 5C4.35668 5 4.21332 4.94 4.10396 4.82011Z"
								  fill="#A0A0A0"/>
						</svg>
					</div>

					<div class="documents__switch-close">
						<span>
							<?= GetMessage('T_INSURANCE_COLLAPSE') ?>
						</span>
						<svg width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M3.60396 0.179893L0.164193 3.95144C-0.0547314 4.19135 -0.0547314 4.58034 0.164193 4.82014C0.382921 5.05996 0.737679 5.05996 0.95639 4.82014L4.00006 1.4829L7.04362 4.82004C7.26244 5.05986 7.61716 5.05986 7.83589 4.82004C8.0547 4.58022 8.0547 4.19126 7.83589 3.95134L4.39607 0.179796C4.28665 0.0598871 4.1434 1.68577e-07 4.00007 1.74842e-07C3.85668 1.8111e-07 3.71332 0.0600035 3.60396 0.179893Z"
								  fill="#A0A0A0"/>
						</svg>
					</div>
				</div>
			</div>

			<div class="documents__content">
				<? foreach ($arResult["PROPERTIES"]["DOCUMENTS"]["VALUE"] as $arDocument): ?>
					<? $arFile = CFile::GetFileArray($arDocument); ?>
					<a href="<?= $arFile["SRC"] ?>" target="_blank">
						<?= $arFile["DESCRIPTION"] ?>
					</a>
				<? endforeach; ?>
				<div class="documents__switch">
					<div class="documents__switch-close">
						<?= GetMessage('T_INSURANCE_COLLAPSE') ?>
						<svg width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M3.60396 0.179893L0.164193 3.95144C-0.0547314 4.19135 -0.0547314 4.58034 0.164193 4.82014C0.382921 5.05996 0.737679 5.05996 0.95639 4.82014L4.00006 1.4829L7.04362 4.82004C7.26244 5.05986 7.61716 5.05986 7.83589 4.82004C8.0547 4.58022 8.0547 4.19126 7.83589 3.95134L4.39607 0.179796C4.28665 0.0598871 4.1434 1.68577e-07 4.00007 1.74842e-07C3.85668 1.8111e-07 3.71332 0.0600035 3.60396 0.179893Z"
								  fill="#A0A0A0"/>
						</svg>
					</div>
				</div>

			</div>
		</div>
	</div>
<? endif; ?>
<? $this->EndViewTarget("document"); ?>

<? // БЛОК ЭТО ВЫГОДНО ?>
