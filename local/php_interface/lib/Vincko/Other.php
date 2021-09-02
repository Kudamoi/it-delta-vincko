<?php

namespace Vincko;


class Other
{

    // считает и форматирует рассрочку
    public static function formatInstalmentPrice($price, $div)
    {
        $result = 0;

        if($price > 0 && $div > 0){
            $result = ceil($price / $div);
        }
        return number_format($result, 0, ',', ' ');
    }

}
