<?php
//класс MainService реализует сервисный слой
class MainService
{
    //получает id всех готовых решений по id города и id объекта охраны
    function getPackagesIds($params)
    {
        if(CModule::IncludeModule("iblock")) {
            $cookie = $params['COOKIE'];
            if (isset($cookie["selected_city"]) && isset($cookie["selected_estate"]))
            {
                $city_id = $cookie['selected_city'];
                $estate_id = $cookie['selected_estate'];
            }

            $res = CIBlockElement::GetList(array("SORT"=>"ASC"),
                array('IBLOCK_ID'=>$params['IBLOCK_ID'], 'ACTIVE'=>'Y',
                    "PROPERTY_CITY_ID"=>$city_id, "PROPERTY_CH_TYPE" => $estate_id),
                false,
                false,
                array('ID','PROPERTY_CH_PACKETS'));

            $arElements = array();
            while($arFields = $res->Fetch())
            {
                $arElements[$arFields['ID']] = $arFields;
            }

            $packagesIds = array();

            foreach ($arElements as $key => $arItem) {
                $item = $arItem['PROPERTY_CH_PACKETS_VALUE'];
                if(is_array($item))
                    $packagesIds = array_merge($packagesIds, $item);
            }

            return $packagesIds;
        }
    }
}