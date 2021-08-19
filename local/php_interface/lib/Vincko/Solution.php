<?php

namespace Vincko;

class Solution
{
// ИД  инфоблока товарных предложений(страховых полисов)
    const IBLOCK_SOLUTION_OFFER = "packets";

    /**
     * @param $id
     *
     * @return array|null
     * @throws LoaderException
     */
    public static function getById($id)
    {
        return !is_array($id)
            ? current(self::getList([$id]))
            : null;
    }

    /**
     * @param array $ids
     * @return array
     * @throws LoaderException
     */
    public static function getList($ids)
    {
        \Bitrix\Main\Loader::includeModule("iblock");

        $solution = [];

        $obSolution = \CIBlockElement::GetList(
            [],
            [
                "IBLOCK_CODE" => static::IBLOCK_SOLUTION_OFFER,
                "ID"        => $ids,
            ],
            false,
            false,
            []
        );

        while ($arSolution = $obSolution->Fetch()) {
            $solution[$arSolution["ID"]] = [
                "ID"         => $arSolution["ID"],
                "NAME"       => $arSolution["NAME"],
            ];

        }

        return $solution;
    }

}

