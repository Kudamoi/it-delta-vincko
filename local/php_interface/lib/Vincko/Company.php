<?php

namespace Vincko;

class Company
{
    // инфоблок компаний
    const IBLOCK_COMPANY = "chopcity";

    // инфоблок честного договора
    const IBLOCK_HONEST = "contract";

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
    public static function getCompany($ids)
    {
        //получим честный договор
        $honesContract = self::getHonestContract();

        // получим договоры компании
        $obContractCompany = \CIBlockElement::GetList(
            [],
            [
                "ID" => $ids,
                "IBLOCK_CODE" => static::IBLOCK_COMPANY,
                "ACTIVE" => "Y"
            ],
            false,
            false,
            [
                "ID",
                "PROPERTY_CONTRACT",
                "PROPERTY_HONEST_CONTRACT",
            ]
        );

        while ($arContractCompany = $obContractCompany->Fetch()) {
            // собираем в нужном виде
            $arCompany[$arContractCompany["ID"]] = [
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

