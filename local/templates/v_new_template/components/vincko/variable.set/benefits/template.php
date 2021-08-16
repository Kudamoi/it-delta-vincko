<? defined("B_PROLOG_INCLUDED") && B_PROLOG_INCLUDED === true || die (); ?>

<div class="benefits">
	<div class="benefits__item benefits__item-left">
		<h1><?=$arParams["TITLE_LEFT"]?></h1>
		<picture class="scut">
			<img src="<?=$arParams["IMG_LEFT_TOP"]?>" alt="<?=$arParams["TITLE_LEFT"]?>" />
		</picture>
		<div class="desc">
			<?=$arParams["DESCRIPTION_LEFT"]?>
		</div>
		<picture class="benefits__man">
			<img src="<?=$arParams["IMG_LEFT_BOTTOM"]?>" alt="">
		</picture>
	</div>
	<div class="benefits__item benefits__item-right">
		<h2><?=$arParams["TITLE_RIGHT"]?></h2>
		<div class="desc">
			<?=$arParams["DESCRIPTION_RIGHT"]?>
		</div>
		<a class="blue-button benefits__get-bonuses js-bonuce">
			<?=$arParams["BUTTON_RIGHT"]?>
		</a>
		<picture class="benefits__gift">
			<img src="<?=$arParams["IMG_RIGHT_BOTTOM"]?>" alt="<?=$arParams["TITLE_RIGHT"]?>">
		</picture>
	</div>
</div>