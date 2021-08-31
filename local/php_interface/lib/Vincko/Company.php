<?php

namespace Vincko;

class Company
{
    // инфоблок компаний
    const IBLOCK_COMPANY = "chop";

    // инфоблок компаний в городах
    const IBLOCK_COMPANY_CITY = "chopcity";

    // инфоблок честного договора
    const IBLOCK_HONEST = "contract";

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

        $obCompany = \CIBlockElement::GetList(
            [],
            [
                "IBLOCK_CODE" => static::IBLOCK_COMPANY,
                "ID" => $ids,
            ],
            false,
            false,
            []
        );

        while ($arCompany = $obCompany->Fetch()) {
            $result[$arCompany["ID"]] = [
                "ID" => $arCompany["ID"],
                "CODE" => $arCompany["CODE"],
                "NAME" => $arCompany["NAME"],
            ];

        }

        return $result;
    }


    // получение честного договора
    public static function getHonestContract()
    {
        // получаем честный договор он дб 1 на весь сайт
        $arContractHonest = \CIBlockElement::GetList(
            [],
            [
                "IBLOCK_CODE" => static::IBLOCK_HONEST,
                "ACTIVE" => "Y"
            ],
            false,
            [
                "nTopCount" => 1
            ],
            [
                "PROPERTY_CONTRACT"
            ]
        )->GetNext();

        return \CFile::GetPath($arContractHonest["PROPERTY_CONTRACT_VALUE"]);
    }

    // получим информацию о компаниях
    public static function getCompany($ids = [])
    {
        if(!is_array($ids)){ return false;}

        //получим честный договор
        $honesContract = self::getHonestContract();

        // получим договоры компании
        $obContractCompany = \CIBlockElement::GetList(
            [],
            [
                "ID" => $ids,
                "IBLOCK_CODE" => static::IBLOCK_COMPANY_CITY,
                "ACTIVE" => "Y"
            ],
            false,
            false,
            [
                "ID",
                "PROPERTY_CONTRACT",
                "PROPERTY_HONEST_CONTRACT",
                "PROPERTY_CHOP_ID",
                "PROPERTY_CITY_ID"
            ]
        );

        while ($arContractCompany = $obContractCompany->Fetch()) {
            // собираем в нужном виде
            $arCompany[$arContractCompany["ID"]] = [
                "CHOP_ID" => $arContractCompany["PROPERTY_CHOP_ID_VALUE"],
                "CITY_ID" => $arContractCompany["PROPERTY_CITY_ID_VALUE"],
                "CONTRACT" => \CFile::GetPath($arContractCompany["PROPERTY_CONTRACT_VALUE"]),
                "HONEST" => (!empty($arContractCompany["PROPERTY_HONEST_CONTRACT_VALUE"]) ?
                    $honesContract
                    :
                    ""
                )
            ];
        }
        return $arCompany;
    }
}

