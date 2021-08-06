<div class="container">
	<section class="presents__tabs">
		<div class="tabs__head">
			<h2>
				<span class="red">Скоро</span> Вы можете купить полис
				и многое другое <span class="blue js-bonuce">за бонусы</span>
			</h2>

			<div class="tabs__head-bonuses">
				<div class="tabs__head-bonuses-up ">У вас есть</div>
				<div class="tabs__head-bonuses-down blue">0 бонусов</div>
			</div>
		</div>
		<div class="presents__tabs-tab">
			<ul class="presents__tabs-tablinks tab-js">
				<li class="item active" data-tab-name="tab-1"><span>Страховка за бонусы</span>
				</li>
				<li class="item" data-tab-name="tab-2"><span>Датчики за бонусы</span></li>
				<li class="item" data-tab-name="tab-3"><span>Подписки за бонусы</span>
				</li>

				<li class="get-more-bonuses">
					<a href="">Получить еще</a>
				</li>
			</ul>
			<div class="presents__tabs-tabs__content tab-1 active tabs__content-js">
					<? $APPLICATION->IncludeComponent(
						"bitrix:main.include", "",
						[
							"AREA_FILE_SHOW" => "file",
							"EDIT_TEMPLATE"  => "",
							"PATH" => "include/for-bonuses-tab1.php"
						]
					); ?>
			</div>
			<div class="presents__tabs-tabs__content tab-2 tabs__content-js">
				<? $APPLICATION->IncludeComponent(
					"bitrix:main.include", "",
					[
						"AREA_FILE_SHOW" => "file",
						"EDIT_TEMPLATE"  => "",
						"PATH" => "include/for-bonuses-tab2.php"
					]
				); ?>
			</div>
			<div class="presents__tabs-tabs__content tab-3 tabs__content-js">
				<? $APPLICATION->IncludeComponent(
					"bitrix:main.include", "",
					[
						"AREA_FILE_SHOW" => "file",
						"EDIT_TEMPLATE"  => "",
						"PATH" => "include/for-bonuses-tab3.php"
					]
				); ?>
			</div>
		</div>
	</section>
</div>
