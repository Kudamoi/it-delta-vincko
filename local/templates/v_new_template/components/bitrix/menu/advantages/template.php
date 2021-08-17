<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
    <div class="header__submenu-item header__submenu-item--up">
        <div class="h3">
            Преимущества
        </div>
        <ul>
            <?
            foreach ($arResult as $arItem):
                if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                    continue;
                ?>
                <? if ($arItem["SELECTED"]): ?>
                    <li><a class="active" href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
                <? elseif($arItem["PARAMS"]): ?>
                    <? foreach ($arItem["PARAMS"] as $key => $value): ?>
                        <li><a <?=$key?>="<?=$value?>" href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
                    <? endforeach ?>
                <? else: ?>
                    <li><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
                <? endif ?>

            <? endforeach ?>
        </ul>
    </div>
<? endif ?>