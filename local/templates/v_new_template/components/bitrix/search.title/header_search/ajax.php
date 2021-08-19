<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(!empty($arResult["CATEGORIES"]) && $arResult['CATEGORIES_ITEMS_EXISTS']):?>
	<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
		<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
		<tr>
			<?if($category_id === "all"):?>
				<td class="title-search-all"><a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a></td>
			<?elseif(isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]])):
				$arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];
			?>
				<td class="title-search-item"><a href="<?echo $arItem["URL"]?>"><?
					if (is_array($arElement["PICTURE"])):?>
						<img align="left" src="<?echo $arElement["PICTURE"]["src"]?>" width="<?echo $arElement["PICTURE"]["width"]?>" height="<?echo $arElement["PICTURE"]["height"]?>">
					<?endif;?><?echo $arItem["NAME"]?></a>
					<p class="title-search-preview"><?echo $arElement["PREVIEW_TEXT"];?></p>
				</td>
			<?elseif(isset($arItem["ICON"])):?>
				<span class="itemText"><a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a></span>
			<?else:?>
				<td class="title-search-more"><a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a></td>
			<?endif;?>
		</tr>
		<?endforeach;?>
	<?endforeach;?>

	<div class="title-search-fader"></div>
<?endif;?>