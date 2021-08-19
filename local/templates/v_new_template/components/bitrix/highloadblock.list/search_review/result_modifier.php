<?php
$i = 0;

foreach ($arResult['rows'] as $item):
    $i++;
    $arItem[] =$item['ID'];
    if($_GET['REVIEW'] == $item['ID']) {
        break;
    }
endforeach;
$arResult['PAGE'] = ceil($i/5);
