<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? //if (!empty($arResult)): ?>
    <nav class="footer__bottom-navigation">
        <ul class="footer__bottom-up footer__bottom-up--to-hide">
            <?
            foreach ($arResult as $arItem):
                if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                    continue;
                ?>
                <? if ($arItem["SELECTED"]): ?>
                    <li><a class="active" href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
                <? else: ?>
                    <li><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
                <? endif ?>
            <? endforeach ?>
        </ul>
    </div>
<? //endif ?>