<? defined("B_PROLOG_INCLUDED") && B_PROLOG_INCLUDED === true || die (); ?>
<div class="container">
	<section class="loyality__calculator loyality__calculator--insurance">
		<div class="loyality__calculator_head">
			<div class="left">

				<h2><span>Это выгодно, </span>посчитайте сами!</h2>
				<p>Воспользуйтесь калькулятором, чтобы рассчитать, сколько времени понадобится человеку с некой
					зарплатой,
					чтобы заработать на интересующий Вас подарок.</p>
			</div>
		</div>
		<div class="loyality__calculator-content">

			<div class="content__items">
				<div class="content__items-left">
					<p class="text"><?= $arParams["TEXT1"] ?></p>
					<span class="town"><?= $arParams["TEXT2"] ?></span>
					<div class="result">
						<p><span class="result-number"><?= $arParams["NUM"] ?></span>
							<span class="result-text"><?= $arParams["MEAS"] ?></span></p>
					</div>
					<input class="content__items-left--range"
						   type="range"
						   name=""
						   id="calculator__range-js"
						   min="<?= $arParams["NUM_MIN"] ?>"
						   max="<?= $arParams["NUM_MAX"] ?>"
						   step="<?= $arParams["STEP"] ?>"
						   value="<?= $arParams["NUM"] ?>">
					<p class="text"><?= $arParams["TEXT3"] ?></p>
					<span class="content__items-left--small"><small><?= $arParams["TEXT4"] ?></small></span>
					<select class="content__items-left--select" id="calculator__select-js">
						<? $curr = 0; ?>
						<? foreach ($arResult["POLICIES"] as $policy): ?>
							<? $curr++;
							if ($curr == 1) {
								$bonus = $policy["BONUS"];
							}
							?>
							<option value="<?= $policy["BONUS"] ?>" <?= ($curr == 1 ? "selected" : "") ?>>Полис
								“<?= $policy["NAME"] ?>”
							</option>
						<? endforeach; ?>
					</select>
					<p class="content__items-left--bottom">
						<span><span class="number"><?= $bonus ?></span><span>бонусов</span></span>
						<span>Вам понадобится</span>
					</p>
				</div>
				<div class="content__items-center">
					<div class="content__items-center--top">
						<picture class="calc-1">
							<source type="image/webp"
									srcset="/local/templates/v_new_template/img/insurance/calculator-1.svg">
							<source type="image/png"
									srcset="/local/templates/v_new_template/img/insurance/calculator-1.svg">
							<img src="/local/templates/v_new_template/img/insurance/calculator-1.svg" alt="alt"
								 loading="lazy">
						</picture>
					</div>
					<div class="content__items-center--bottom">
						<p><span>7</span><small>минут</small></p>
						<span class="text">чтобы заработать на него по программе лояльности
                                <a href="">vincko:</a></span>
					</div>
				</div>
				<div class="content__items-right">
					<div class="content__items-right--top">
						<picture>
							<source type="image/webp"
									srcset="/local/templates/v_new_template/img/insurance/calculator-2.svg">
							<source type="image/png"
									srcset="/local/templates/v_new_template/img/insurance/calculator-2.svg">
							<img src="/local/templates/v_new_template/img/insurance/calculator-2.svg" alt="alt"
								 loading="lazy">
						</picture>
					</div>
					<div class="content__items-right--bottom">
						<p><span>2<small>ч</small></span><span>54<small>мин</small></span></p>
						<span class="text">чтобы заработать на него при указанной заработной плате <span>на
                                    работе</span></span>
					</div>
				</div>
			</div>

		</div>
	</section>
</div>