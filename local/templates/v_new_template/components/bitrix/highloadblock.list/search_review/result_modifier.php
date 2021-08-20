<?php
$i = 0;
$search = false;
foreach ($arResult['rows'] as $item):
    $i++;
    $arItem[] =$item['ID'];
    if($_GET['REVIEW'] == $item['ID']) {
        $search = true;
        break;
    }
endforeach;
    if ($search) {
        $arResult['PAGE'] = ceil($i/5);
    } else {
        $arResult['PAGE'] = false;
    }

