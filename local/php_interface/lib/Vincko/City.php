<?php

namespace Vincko;

class City
{
    // инфоблок компаний
    const IBLOCK_CITY = "city";

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
    public static function getList($ids = [])
    {
        \Bitrix\Main\Loader::includeModule("iblock");

        $result = [];
        if(empty($ids)){
            return $result;
        }

        $ob = \CIBlockElement::GetList(
            [],
            [
                "IBLOCK_CODE" => static::IBLOCK_CITY,
                "ID" => $ids,
            ],
            false,
            false,
            []
        );

        while ($ar = $ob->Fetch()) {
            $result[$ar["ID"]] = [
                "ID" => $ar["ID"],
                "CODE" => $ar["CODE"],
                "NAME" => $ar["NAME"],
            ];

        }

        return $result;
    }


}

