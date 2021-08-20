<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

/** @var PageNavigationComponent $component */
$component = $this->getComponent();

$this->setFrameMode(true);

?>
<!--<ul class="pagination">
    <li><a href="" class="prev">0</a></li>
    <li><span class="active">1</span></li>
    <li><a href="">2</a></li>
    <li><a href="">3</a></li>
    <li><a href="">4</a></li>
    <li><a href="">5</a></li>
    <li><a href="">6</a></li>
    <li><a href="">7</a></li>
    <li><a href="" class="next">8</a></li>
</ul>-->

<ul class="pagination">
    <? if ($arResult["REVERSED_PAGES"] === true): ?>

        <? if ($arResult["CURRENT_PAGE"] < $arResult["PAGE_COUNT"]): ?>
            <? if (($arResult["CURRENT_PAGE"] + 1) == $arResult["PAGE_COUNT"]): ?>
                <li><a class="prev" href="<? preg_match('/page=page-\d+/', $arResult["URL"], $res);
                    echo str_replace('page=', '', $res[0]) ?>">0</a></li>
            <? else: ?>
                <li><a class="prev"
                       href="<? preg_match('/page=page-\d+/', $component->replaceUrlTemplate($arResult["CURRENT_PAGE"] + 1), $res);
                       echo str_replace('page=', '', $res[0]) ?>">0</a></li>
            <? endif ?>
            <li class=""><a href="<? preg_match('/page=page-\d+/', $arResult["URL"], $res);
                echo str_replace('page=', '', $res[0]) ?>"><span>1</span></a></li>
        <? else: ?>
            <li><a href="" class="prev">0</a></li>
            <li><span class="active t-c-blue">1</span></li>
        <? endif ?>

        <?
        $page = $arResult["START_PAGE"] - 1;
        while ($page >= $arResult["END_PAGE"] + 1):
            ?>
            <? if ($page == $arResult["CURRENT_PAGE"]):?>
            <li><span class="active t-c-blue"><?= ($arResult["PAGE_COUNT"] - $page + 1) ?></span></li>
        <? else:?>
            <li class=""><a href="<? preg_match('/page=page-\d+/', $component->replaceUrlTemplate($page), $res);
                echo str_replace('page=', '', $res[0]) ?>"><span><?= ($arResult["PAGE_COUNT"] - $page + 1) ?></span></a>
            </li>
        <? endif ?>

            <? $page-- ?>
        <? endwhile ?>

        <? if ($arResult["CURRENT_PAGE"] > 1): ?>
            <? if ($arResult["PAGE_COUNT"] > 1): ?>
                <li class=""><a href="<? preg_match('/page=page-\d+/', $component->replaceUrlTemplate(1), $res);
                    echo str_replace('page=', '', $res[0]) ?>"><span><?= $arResult["PAGE_COUNT"] ?></span></a></li>
            <? endif ?>
            <li><a class="next"
                   href="<? preg_match('/page=page-\d+/', $component->replaceUrlTemplate($arResult["CURRENT_PAGE"] - 1), $res);
                   echo str_replace('page=', '', $res[0]) ?>"><span><? echo GetMessage("round_nav_forward") ?></span></a>
            </li>
        <? else: ?>
            <? if ($arResult["PAGE_COUNT"] > 1): ?>
                <li><span class="active t-c-blue"><?= $arResult["PAGE_COUNT"] ?></span></li>
            <? endif ?>
            <li><a class="next" href=""><? echo GetMessage("round_nav_forward") ?></a></li>
        <? endif ?>

    <? else: ?>

        <? if ($arResult["CURRENT_PAGE"] > 1): ?>
            <? if ($arResult["CURRENT_PAGE"] > 2): ?>
                <li><a class="prev"
                       href="<? preg_match('/page=page-\d+/', $component->replaceUrlTemplate($arResult["CURRENT_PAGE"] - 1), $res);
                       echo str_replace('page=', '', $res[0]) ?>"><span><? echo GetMessage("round_nav_back") ?></span></a>
                </li>
            <? else: ?>
                <li><a class="prev" href="<? preg_match('/page=page-\d+/', $arResult["URL"], $res);
                    echo str_replace('page=', '', $res[0]) ?>"><span><? echo GetMessage("round_nav_back") ?></span></a>
                </li>
            <? endif ?>

            <li class=""><a href="<? preg_match('/page=page-\d+/', $arResult["URL"], $res);
                echo str_replace('page=', '', $res[0]) ?>"><span>1</span></a></li>
            <? if ($arResult["CURRENT_PAGE"] > 3): ?>
                <li style="cursor: default">...</li>
            <? endif; ?>
        <? else: ?>

            <li><a class="prev" href=""><? echo GetMessage("round_nav_back") ?></a></li>
            <li><span class="active t-c-blue">1</span></li>

        <? endif ?>

        <?
        $page = $arResult["START_PAGE"] + 1;
        while ($page <= $arResult["END_PAGE"] - 1):
            ?>
            <? if ($page == $arResult["CURRENT_PAGE"]):?>
            <li><span class="active t-c-blue"><?= $page ?></span></li>
        <? else:?>
            <li class=""><a href="<? preg_match('/page=page-\d+/', $component->replaceUrlTemplate($page), $res);
                echo str_replace('page=', '', $res[0]) ?>"><span><?= $page ?></span></a></li>
        <? endif ?>
            <? $page++ ?>
        <? endwhile ?>

        <? if ($arResult["CURRENT_PAGE"] < $arResult["PAGE_COUNT"]): ?>
            <? if ($arResult["PAGE_COUNT"] > 1): ?>
                <? if ($arResult["CURRENT_PAGE"] < $arResult["PAGE_COUNT"] - 2): ?>
                    <li style="cursor: default">...</li>
                <? endif; ?>
                <li class=""><a
                            href="<? preg_match('/page=page-\d+/', $component->replaceUrlTemplate($arResult["PAGE_COUNT"]), $res);
                            echo str_replace('page=', '', $res[0]) ?>"><span><?= $arResult["PAGE_COUNT"] ?></span></a>
                </li>
            <? endif ?>

            <li><a class="next"
                   href="<? preg_match('/page=page-\d+/', $component->replaceUrlTemplate($arResult["CURRENT_PAGE"] + 1), $res);
                   echo str_replace('page=', '', $res[0]) ?>"><span><? echo GetMessage("round_nav_forward") ?></span></a>
            </li>
        <? else: ?>
            <? if ($arResult["PAGE_COUNT"] > 1): ?>
                <li><span class="active t-c-blue"><?= $arResult["PAGE_COUNT"] ?></span></li>
            <? endif ?>
            <li><a class="next" href=""><? echo GetMessage("round_nav_forward") ?></a></li>
        <? endif ?>
    <? endif ?>
</ul>