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
	<div class="tabs__content_slider presents__tabs_slider-js">
		<? foreach ($arResult["POLICIES"] as $arPolicy) : ?>
		<div class="item">
			<div class="item__top">
				<div class="item__img">
					<picture>
						<source type="image/webp" srcset="/local/templates/v_new_template/img/loyality/restayling/presents_item1.webp">
						<source type="image/png" srcset="/local/templates/v_new_template/img/loyality/restayling/presents_item1.png">
						<img src="<?=$arPolicy["IMG"]?>"  alt="<?= $arPolicy["NAME"] ?>" loading="lazy">
					</picture>
				</div>
				<div class="item__top__content">
					<div class="item__top__content-name">
						<div class="left">
							<span class="left_top"><?= $arPolicy["INSURANCE"]["NAME"] ?></span>
							<span class="left_bottom">«<?= $arPolicy["NAME"] ?>»</span>
						</div>
						<div class="right">
							<span class="right_top"><?=$arPolicy["BONUS"]?></span>
							<span class="right_bottom">Бонусов</span>
						</div>
					</div>
					<div class="item__top__content-max">
						<span class="max_top">Максимальная выплата</span>
						<?= $arPolicy["MAX_PRICE"] ?>
					</div>
				</div>
			</div>
			<div class="item__bottom">
				<div class="item__bottom-bonuses">
					<div class="item__bottom-left">
						Для покупки полиса за бонусы, вам не хватает
					</div>
					<div class="item__bottom-right">
						Всего
						<div class="num">
							0 бонусов
						</div>
					</div>
				</div>
				<a href="" class="blue-border-button button js-bonuce">получить бонусы</a>
			</div>
		</div>
		<? endforeach;?>
	</div>
<? endif;?>