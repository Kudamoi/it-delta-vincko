<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Grid\Declension;
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="wrap">
	<div class="chop-item">
			<div class="chop-item__info">
				<h1><?=$arResult["NAME"]?></h1>
				<?if ($arResult["CH_CONFIRMED"]):?><div class="chop-item__verify">Подтвержденный партнер</div><?endif;?>
				<div class="chop-item__cityinfo">
					<div class="chop-item__city"><div uk-form-custom="target: > * > span:last-child">
						<select name="price" class="js-chop-select-link">
							<option value=""><?=$arResult["DISPLAY_PROPERTIES"]["CITY_ID"]["LINK_ELEMENT_VALUE"][$arResult["DISPLAY_PROPERTIES"]["CITY_ID"]["VALUE"]]["NAME"]?></option>
							<?foreach ($arResult["CH_ALL_LIST"] as $arChItem):?>
							<?if ($arResult["DISPLAY_PROPERTIES"]["CITY_ID"]["LINK_ELEMENT_VALUE"][$arResult["DISPLAY_PROPERTIES"]["CITY_ID"]["VALUE"]]["NAME"] != $arChItem["CITY_NAME"]):?>
							<option value="<?=$arChItem["DETAIL_PAGE_URL"]?>"><?=$arChItem["CITY_NAME"]?></option>
							<?endif;?>
							<?endforeach;?>
						</select>
						<span class="uk-link">
							<span></span>
							<span uk-icon="icon: triangle-down"></span>
						</span>
						</div>
					</div>
					<div class="chop-item__citieslist">Присутствует в <?=$arResult["CH_ALL_COUNT"]?> <?=(new Declension("городе","городах","городах"))->get($arResult["CH_ALL_COUNT"])?></div>
					<div class="chop-item__reviewscount"><a class="js-tab" data-id="3" href="#"><?=$arResult["CHOP_REVIEWS_ALL_COUNT"]?></a> <?=(new Declension("отзыв","отзыва","отзывов"))->get($arResult["CHOP_REVIEWS_ALL_COUNT"])?></div>
				</div>
				<div class="chop-item__text">
					<?echo $arResult["DETAIL_TEXT"];?>
				</div>
				<div class="chop-item__data">
					<?if ($arResult["CHOP_CREATE"]):?><div class="chop-item__data-item chop-item__data-naploshadke">На площадке: с <?=$arResult["CHOP_CREATE"]?></div><?endif;?>
					<?if ($arResult["CHOP_UPDATE"]):?><div class="chop-item__data-item chop-item__data-actual">Актуальность: <?=$arResult["CHOP_UPDATE"]?></div><?endif;?>
					<?if ($arResult["DISPLAY_PROPERTIES"]["CH_COUNT_VIEWS_MONTH"]["VALUE"]):?><div class="chop-item__data-item chop-item__data-viewsmonth">Просмотров за март: <?=$arResult["DISPLAY_PROPERTIES"]["CH_COUNT_VIEWS_MONTH"]["VALUE"]?></div><?endif;?>
					<?if ($arResult["DISPLAY_PROPERTIES"]["CH_COUNT_VIEWS"]["VALUE"]):?><div class="chop-item__data-item chop-item__data-viewsall">Просмотров всего: <?=$arResult["DISPLAY_PROPERTIES"]["CH_COUNT_VIEWS"]["VALUE"]?></div><?endif;?>
				</div>
			</div>
			<div class="chop-item__rate">
				<div class="chop-item__rate-wrap">
					<div class="chop-item__rate-full">
						<div class="chop-item__rate-place">
							<div class="chop-item__rate-place-name"><a href="#" class="js-chopitem-rate-switcher chop-item__rate-link selected" data-value="city"><?=$arResult["DISPLAY_PROPERTIES"]["CITY_ID"]["LINK_ELEMENT_VALUE"][$arResult["DISPLAY_PROPERTIES"]["CITY_ID"]["VALUE"]]["NAME"]?></a></div>
							<div class="chop-item__rate-place-name chop-item__rate-place-name-all"><a href="#" class="js-chopitem-rate-switcher chop-item__rate-link" data-value="all">Общий рейтинг</a></div>
						</div>
						<div class="chop-item__rate-value"><span id="js-rate-chop-city" class="js-chopitem-rate"><?=number_format((float)$arResult["DISPLAY_PROPERTIES"]["CH_RATING_SUM"]["VALUE"],1,".","");?></span><span id="js-rate-chop-all" class="js-chopitem-rate chop-item__rate-value-all"><?=$arResult["CH_ALL"]?></span></div>
					</div>
					<div class="chop-item__rate-list">
						<div class="chop-item__rate-row">
							<div class="chop-item__rate-row-fill" style="width: <?=$arResult["DISPLAY_PROPERTIES"]["CH_RATING_ZABOTA"]["VALUE"]*10?>%;"></div>
							<div class="chop-item__rate-row-flex">
								<div class="chop-item__rate-row-name chop-item__rate-icon-client">Забота о клиенте</div>
								<div class="chop-item__rate-row-value"><?=number_format((float)$arResult["DISPLAY_PROPERTIES"]["CH_RATING_ZABOTA"]["VALUE"],1,".","");?></div>
							</div>
						</div>
						<div class="chop-item__rate-row">
							<div class="chop-item__rate-row-fill" style="width: <?=$arResult["DISPLAY_PROPERTIES"]["CH_RATING_SPASENIE"]["VALUE"]*10?>%;"></div>
							<div class="chop-item__rate-row-flex">
								<div class="chop-item__rate-row-name chop-item__rate-icon-speed">Скорость спасения</div>
								<div class="chop-item__rate-row-value"><?=number_format((float)$arResult["DISPLAY_PROPERTIES"]["CH_RATING_SPASENIE"]["VALUE"],1,".","");?></div>
							</div>
						</div>
						<div class="chop-item__rate-row">
							<div class="chop-item__rate-row-fill" style="width: <?=$arResult["DISPLAY_PROPERTIES"]["CH_RATING_FINANCE"]["VALUE"]*10?>%;"></div>
							<div class="chop-item__rate-row-flex">
								<div class="chop-item__rate-row-name chop-item__rate-icon-finance">Финансовая надежность</div>
								<div class="chop-item__rate-row-value"><?=number_format((float)$arResult["DISPLAY_PROPERTIES"]["CH_RATING_FINANCE"]["VALUE"],1,".","");?></div>
							</div>
						</div>
						<div class="chop-item__rate-row">
							<div class="chop-item__rate-row-fill" style="width: <?=$arResult["DISPLAY_PROPERTIES"]["CH_RATING_DOGOVOR"]["VALUE"]*10?>%;"></div>
							<div class="chop-item__rate-row-flex">
								<div class="chop-item__rate-row-name chop-item__rate-icon-dogovor">Честный договор</div>
								<div class="chop-item__rate-row-value"><?=number_format((float)$arResult["DISPLAY_PROPERTIES"]["CH_RATING_DOGOVOR"]["VALUE"],1,".","");?></div>
							</div>
						</div>
						<div class="chop-item__rate-row">
							<div class="chop-item__rate-row-fill" style="width: <?=$arResult["DISPLAY_PROPERTIES"]["CH_RATING_RECOMMEND"]["VALUE"]*10?>%;"></div>
							<div class="chop-item__rate-row-flex">
								<div class="chop-item__rate-row-name chop-item__rate-icon-recommend">Рекомендации сотрудников</div>
								<div class="chop-item__rate-row-value"><?=number_format((float)$arResult["DISPLAY_PROPERTIES"]["CH_RATING_RECOMMEND"]["VALUE"],1,".","");?></div>
							</div>
						</div>
						<div class="chop-item__rate-row">
							<div class="chop-item__rate-row-fill" style="width: <?=$arResult["DISPLAY_PROPERTIES"]["CH_RATING_SERVICES"]["VALUE"]*10?>%;"></div>
							<div class="chop-item__rate-row-flex">
								<div class="chop-item__rate-row-name chop-item__rate-icon-online">Онлайн сервисы</div>
								<div class="chop-item__rate-row-value"><?=number_format((float)$arResult["DISPLAY_PROPERTIES"]["CH_RATING_SERVICES"]["VALUE"],1,".","");?></div>
							</div>
						</div>
					</div>
					<a href="#" data-id="1" class="js-tab chop-item__button-packet">Выбрать пакет услуг</a>
					<a href="/review-add/?op=<?=$arResult["ID"]?>" class="chop-item__button-review">Оставить отзыв</a>
				</div>
			</div>
		</div>
		<div class="chop__tabs">
			<a href="#" id="js-tab1" data-id="1" class="js-tab chop__tab-item selected">Пакеты услуг</a>
			<?if (!empty($arResult["CHOP_SERVICES"])):?><a href="#" data-id="2" id="js-tab2" class="js-tab chop__tab-item">Услуги</a><?endif;?>
			<a href="#" id="js-tab3" data-id="3" class="js-tab chop__tab-item">Отзывы</a>
		</div>
		<div id="js-block">
		<div id="js-block1" class="js-tabblock chop-item__block selected">
			<div class="h1-title">Пакеты услуг</div>
			<div class="packets__list">
			<?if (!empty($arResult["CHOP_PACKETS"])){?>
				<?foreach ($arResult["CHOP_PACKETS"] as $arcp):?>
				<div class="packet__item<?if (!empty($arcp["P_RED_VALUE"])):?> action<?endif;?>">
					<?if (!empty($arcp["P_RED_VALUE"])):?><div class="packet__item-action">
						<div class="packet__item-action-red"><?=$arcp["P_RED_VALUE"]?></div>
					</div><?endif;?>
					<div class="packet__item-title"><a href="<?=$arcp["DETAIL_PAGE_URL"]?>?op=<?=$arResult["ID"]?>"><?=$arcp["NAME"]?></a></div>
					
					<div class="packet__item-data">
						<div class="packet__item-complect">
							<?if (count($arcp["COMPLECT_NAME"]) > 0){?>
							<div class="packet__item-complect-item">
								<div class="packet__item-complect-item-title">Поддерживается оборудование:</div>
								<div class="packet__item-complect-item-values">
									<?if (count($arcp["PROPERTY_P_COMPLECT_VALUE"]) == 1){?>
									<div class="packet__item-complect-item-val"><?=$arcp["PROPERTY_P_COMPLECT_NAME"]?></div>
									<?}else{?>
									<div class="packet__item-complect-item-val"><?=count($arcp["PROPERTY_P_COMPLECT_VALUE"])?> комплекта</div>
									<?}?>
								</div>
							</div>
							<?}?>
							<?if ($arcp["P_ABONENTPLATA_Y"] == "Да"):?>
							<div class="packet__item-complect-item">
								<div class="packet__item-complect-item-title">Абонплата:</div>
								<div class="packet__item-complect-item-values">
									<div class="packet__item-complect-item-val">Есть</div>
								</div>
							</div>
							<?endif;?>
							<?if (!empty($arcp["STRAHOVKA"])):?>
							<div class="packet__item-complect-item">
								<div class="packet__item-complect-item-title">Страховка:</div>
								<div class="packet__item-complect-item-values">
									<div class="packet__item-complect-item-val"><?=$arcp["STRAHOVKA"]?></div>
									<?/*<?foreach ($item["P_STRAHOVKA_SKU"] as $itemS):?>
									<div class="packet__item-complect-item-val"><?=$itemS["NAME"]?></div>
									<?endforeach;?>*/?>
								</div>
							</div>
							<?endif;?>
						</div>
						
						<div class="packet__item-options">
							<?/*<?foreach ($item["DISPLAY_PROPERTIES"]["P_OPTIONS"]["LINK_ELEMENT_VALUE"] as $ipopt):?>*/?>
							<?foreach ($arcp["P_OPTIONS"] as $ipov):?>
							<div class="packet__item-option-element">
								<div class="packet__item-option-element-val">
									<div class="packet__item-option-element-pic inline-block">
										<img src="<?=$ipov["ICON"]["src"]?>" alt="<?=$ipov["NAME"]?>">
									</div>
									<div class="packet__item-option-element-text inline-block"><?=$ipov["NAME"]?></div>
								</div>
							</div>
							<?endforeach;?>
						</div>
					
						<div class="packet__item-price">
							<div class="packet__item-startprice">от <span class="js-price"><?=$arcp["PRICE"]?></span> ₽</div>
							<?if ($arcp["P_BONUSES"]):?>
							<div class="packet__item-bonuses">
								<?foreach ($arcp["P_BONUSES"] as $bonusItem):?>
								<div class="packet__item-gift-item"><?=$bonusItem?></div>
								<?endforeach;?>
							</div>
							<?endif;?>
							<?/*<div class="good__item-discount">
								<div class="good__item-discount-item">скидка 10% при покупке абонплаты</div>
								<div class="good__item-discount-item">скидка 10% при покупке абонплаты</div>
								<div class="good__item-discount-item">скидка 10% при покупке абонплаты</div>
							</div>*/?>
							<a href="<?=$item["DETAIL_PAGE_URL"]?>?op=<?=$arResult["ID"]?>" class="packet__item-link">Подробнее</a>
						</div>
					</div>
				</div>
				
				
				<?/*
				<div class="good__item">
					<div class="good__item-pic">
						<a href="<?=$arcp["DETAIL_PAGE_URL"]?>?op=<?=$arResult["ID"]?>"><img src="<?=$arcp["PREVIEW_PICTURE"]?>" alt="<?=$arcp["NAME"]?>"></a>
					</div>
					<div class="good__item-data">
						<div class="good__item-info">
							<div class="good__item-title"><a href="<?=$arcp["DETAIL_PAGE_URL"]?>?op=<?=$arResult["ID"]?>"><?=$arcp["NAME"]?></a></div>
							<div class="good__item-description"><?=$arcp["PREVIEW_TEXT"]?></div>
							<div class="good__item-complect">
								<div class="good__item-complect-item">
									<div class="good__item-complect-item-title">Базовый комплект:</div>
									<div class="good__item-complect-item-values">
										<div class="good__item-complect-item-val"><?=$arcp["COMPLECT_NAME"]?></div>
									</div>
								</div>
								<?if ($arcp["P_ABONENTPLATA_Y"] == "Да"):?>
								<div class="good__item-complect-item">
									<div class="good__item-complect-item-title">Абонплата:</div>
									<div class="good__item-complect-item-values">
										<?foreach ($arcp["ABONPLATA"] as $arcpa):?>
										<div class="good__item-complect-item-val"><?=$arcpa["NAME"]?> - <?=ceil($arcpa["PRICE_1"])?> ₽</div>
										<?endforeach;?>
									</div>
								</div>
								<?endif;?>
								<?if ($arcp["STRAHOVKA"]):?>
								<div class="good__item-complect-item">
									<div class="good__item-complect-item-title">Страховка:</div>
									<div class="good__item-complect-item-values">
										<?foreach ($arcp["STRAHOVKA"] as $astrah):?>
										<div class="good__item-complect-item-val"><?=$astrah["NAME"]?></div>
										<?endforeach;?>
									</div>
								</div>
								<?endif;?>
							</div>
						</div>
						<div class="good__item-price">
							<div class="good__item-startprice">от <span class="js-price"><?=$arcp["PRICE"]?></span> ₽</div>
							
							<a href="<?=$arcp["DETAIL_PAGE_URL"]?>?op=<?=$arResult["ID"]?>" class="good__item-link">Подробнее</a>
						</div>
					</div>
				</div>*/?>
				<?endforeach;?>
			<?}else{?>
				<p>Нет действующих пакетов услуг для данного охранного предприятия.</p>
			<?}?>
			</div>
			<?/*<div class="package__list-loadmore">
				<a href="#" class="button__ajax-loader">Загрузить еще</a>
			</div>*/?>
		</div>
		
		<?if (!empty($arResult["CHOP_SERVICES"])):?>
		<div id="js-block2" class="js-tabblock chop-item__block">
			<div class="h1-title">Услуги</div>
			<div class="services__list">
				<?foreach ($arResult["CHOP_SERVICES"] as $arcs):?>
				<div class="services__item">
					<div class="services__item-title"><?=$arcs["NAME"]?></div>
					<div class="services__item-description">
						<?=$arcs["PREVIEW_TEXT"]?>
					</div>
					<a href="#" class="services__item-link inline-block">Заявка на расчет</a>
				</div>
				<?endforeach;?>
			</div>
		</div>
		<?endif;?>
		
		<div id="js-block3" class="js-tabblock chop-item__block">
			<div class="h1-title h1-title-review">Отзывы об организации <?=$arResult["NAME"]?></div>
			<div class="review__list">
			<?if ($arResult["CHOP_REVIEWS"]){?>
				<?foreach ($arResult["CHOP_REVIEWS"] as $cReviews):?>
				<div class="review__item">
					<div class="review__item-header">
						<div class="review__item-top">
							<div class="review__item-fio"><?=$cReviews["NAME"]?></div>
							<?if ($cReviews["PROPERTY_R_REVIEW_VERIFY_VALUE"]):?><div class="review__item-verified">Проверенный клиент</div><?endif;?>
						</div>
						<div class="review__item-city"><?=$cReviews["PROPERTY_R_CITY_VALUE"]?></div>
					</div>
					<?if ($cReviews["PROPERTY_R_REVIEW_VERIFY_VALUE"]):?><div class="review__item-rate">
						<div class="review__item-rate-value"><?=$cReviews["PROPERTY_R_RATING_SUM_VALUE"]?></div>
						<div class="review__item-rate-title">Общая оценка</div>
					</div><?endif;?>
					<div class="review__item-comment">
						<div class="review__item-comment-title">Комментарий:</div>
						<div class="review__item-comment-val"><?=$cReviews["PROPERTY_R_COMMENT_VALUE"]["TEXT"]?></div>
					</div>
					<div class="review__item-data">
						<div class="review__item-date"><?=$cReviews["PROPERTY_R_DATETIME_VALUE"]?></div>
						<div class="review__item-useful-title">Отзыв полезен?</div>
						<a href="#" class="review__item-useful-likes"></a>
						<a href="#" class="review__item-useful-dislikes"></a>
					</div>
				</div>
				<?endforeach;?>
			<?}else{?>
			<p style="margin-top: 25px;">Отзывов ещё нет - ваш может стать первым!</p>
			<?}?>
			</div>
		</div>
		</div>
</div>
<?/*
<div class="news-detail" style="display: none;">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img
			class="detail_picture"
			border="0"
			src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
			width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
			height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
			alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
			title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
			/>
	<?endif?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h3><?=$arResult["NAME"]?></h3>
	<?endif;?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
	<?elseif($arResult["DETAIL_TEXT"] <> ''):?>
		<?echo $arResult["DETAIL_TEXT"];?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	<div style="clear:both"></div>
	<br />
	<?foreach($arResult["FIELDS"] as $code=>$value):
		if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code)
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?
			if (!empty($value) && is_array($value))
			{
				?><img border="0" src="<?=$value["SRC"]?>" width="<?=$value["WIDTH"]?>" height="<?=$value["HEIGHT"]?>"><?
			}
		}
		else
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?><?
		}
		?><br />
	<?endforeach;
	foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

		<?=$arProperty["NAME"]?>:&nbsp;
		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
		<?else:?>
			<?=$arProperty["DISPLAY_VALUE"];?>
		<?endif?>
		<br />
	<?endforeach;
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>
</div>
*/?>