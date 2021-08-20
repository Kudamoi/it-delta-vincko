<?php

namespace Vincko;

class Equiment
{
// ИД  инфоблока товарных предложений(страховых полисов)
    const IBLOCK_EQUIMENT = "complect";

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

        $obEquiment = \CIBlockElement::GetList(
            [],
            [
                "IBLOCK_CODE" => static::IBLOCK_EQUIMENT,
                "ID" => $ids,
            ],
            false,
            false,
            []
        );

        while ($arEquiment = $obEquiment->Fetch()) {
            $equiment[$arEquiment["ID"]] = [
                "ID" => $arEquiment["ID"],
                "CODE" => $arEquiment["CODE"],
                "NAME" => $arEquiment["NAME"],
            ];

        }

        return $equiment;
    }

}

