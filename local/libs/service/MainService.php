<?php

//класс MainService реализует сервисный слой
class MainService
{
    //получает id всех готовых решений по id города
    function getPackagesIds()
    {
        if (CModule::IncludeModule("iblock")) {
            $city_id = $_COOKIE['selected_city'];
            $packagesIds = array();

            $res = CIBlockElement::GetList(array("SORT" => "ASC"),
                array('IBLOCK_CODE' => 'chopcity', 'ACTIVE' => 'Y',
                    "PROPERTY_CITY_ID" => $city_id),
                false,
                false,
                array('ID', 'PROPERTY_CH_PACKETS'));

            $arElements = array();
            while ($arFields = $res->Fetch()) {
                $arElements[$arFields['ID']] = $arFields;
            }

            foreach ($arElements as $key => $arItem) {
                $item = $arItem['PROPERTY_CH_PACKETS_VALUE'];
                if (is_array($item))
                    $packagesIds = array_merge($packagesIds, $item);
            }
            return $packagesIds;
        }

    }

    //получает id всех охранных компаний и абонентских плат по id города и id Готового решения
    function getSecureCompanyAndSubscriptionFeeListByPackageId($packageId)
    {
        if (CModule::IncludeModule("iblock")) {
            $city_id = $_COOKIE['selected_city'];

            $res = CIBlockElement::GetList(array("SORT" => "ASC"),
                array('IBLOCK_CODE' => 'chop-packet-ap', 'ACTIVE' => 'Y',
                    'PROPERTY_CPA_PACKET' => $packageId),
                false,
                false,
                array('ID', 'PROPERTY_CPA_CHOP', 'PROPERTY_CPA_CHOP.PROPERTY_CITY_ID', 'PROPERTY_CPA_ABONPLATA'));

            while ($arFields = $res->Fetch()) {
                if ($arFields['PROPERTY_CPA_CHOP_PROPERTY_CITY_ID_VALUE'] == $city_id)
                    $arElements[$arFields['ID']] = $arFields;
            }

            return $arElements;
        }
    }

    //получает позиции в рейтинге всех компаний по id города
    function calculateSecureCompanyRatingPositionsByCityId($cityId)
    {
        if (CModule::IncludeModule("iblock")) {
            $arSort = array('PROPERTY_EL_RATING_SUM' => 'DESC', 'PROPERTY_CHOP_ID.NAME' => 'ASC');
            $res = CIBlockElement::GetList(
                $arSort,
                array('IBLOCK_CODE' => "chopcity", "PROPERTY_CITY_ID"=>$cityId, 'ACTIVE' => 'Y'),
                false,
                false,
                array("ID", "NAME", "PROPERTY_CHOP_ID.ID", "PROPERTY_CHOP_ID.NAME", "PROPERTY_EL_RATING_SUM"));

            $arElements = array();
            while ($arFields = $res->Fetch()) {
                $arElements[$arFields['ID']] = $arFields;
            }


            $posInRating = 1;
            $arPositions = [];
            foreach ($arElements as $key => $el)
            {
                $arPositions[$el['PROPERTY_CHOP_ID_ID']] = array(
                    'CHOP_ID' => $el['PROPERTY_CHOP_ID_ID'],
                    'POSITION_IN_RATING' => $posInRating++,
                );
            }

            return $arPositions;
        }
    }


}