<?php

//подключение классов
CModule::AddAutoloadClasses(
    '',
    array(
        'MainService' => '/local/libs/service/MainService.php',
    )
);
//функция для кеширования данных
if (!function_exists('returnResultCache')) {
    function returnResultCache($timeSeconds, $cacheId, $callback, $arCallbackParams = '')
    {
        $obCache = new CPHPCache();
        $cachePath = '/' . SITE_ID . '/' . $cacheId;
        if ($obCache->InitCache($timeSeconds, $cacheId, $cachePath)) {
            $vars = $obCache->GetVars();
            $result = $vars['result'];
        } elseif ($obCache->StartDataCache()) {
            $result = $callback($arCallbackParams);
            $obCache->EndDataCache(array('result' => $result));
        }
        return $result;
    }
}

//AddEventHandler("main", "OnBeforeUserRegister", array("RegisterHandler", "OnBeforeUserRegisterHandler"));
//AddEventHandler("main", "OnAfterUserRegister", array("RegisterHandler", "OnAfterUserRegisterHandler"));
//AddEventHandler("main", "OnBeforeUserChangePassword", array("RegisterHandler", "OnBeforeUserChangePasswordHandler"));
//AddEventHandler("main", "OnAfterUserUpdate", array("RegisterHandler", "OnAfterUserUpdateHandler"));


class RegisterHandler
{
    private function rand_string($length)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars), 0, $length);
    }

    private function singleton($write = false, $newValue = false)
    {
        static $value;
        if ($write)
            $value = $newValue;
        return $value;
    }

    function OnBeforeUserRegisterHandler(&$arFields)
    {
        $password = self::rand_string(8);
        $arFields["LOGIN"] = $arFields['PHONE_NUMBER'];
        $arFields["PASSWORD"] = $password;
        $arFields["CONFIRM_PASSWORD"] = $password;
        return $arFields;
    }

    function OnAfterUserRegisterHandler(&$arFields)
    {
        // если регистрация успешна то
        if (($arFields['USER_ID'] > 0) && (isset($arFields['PHONE_NUMBER']))) {
            $fields = array(
                'USER_PHONE' => $arFields['PHONE_NUMBER'],
                'USER_NAME' => $arFields['NAME'],
                'USER_PASSWORD' => $arFields['PASSWORD'],
            );
            // отправляем СМС
            $sms = new \Bitrix\Main\Sms\Event('SEND_SMS_USER_SUCSESS_REGISTRATION', $fields);
            $sms->setSite('v1');
            $sms->setLanguage('ru');
            $sms->send();
        }
        return $arFields;
    }

    function OnBeforeUserChangePasswordHandler(&$arFields)
    {
        if ((isset($arFields['PASSWORD']))) {
            $password = self::rand_string(8);
            $arFields["PASSWORD"] = $password;
            $arFields["CONFIRM_PASSWORD"]=$password;
            self::singleton(true, $arFields);
        }
        return $arFields;
    }

    function OnAfterUserUpdateHandler(&$arFields)
    {
        if ($arFields["RESULT"]) {
            $arParams = self::singleton();
            $fields = array(
                'USER_PHONE' => $arParams['PHONE_NUMBER'],
                'USER_PASSWORD' => $arParams['PASSWORD'],
            );
            // отправляем СМС
            $sms = new \Bitrix\Main\Sms\Event('SEND_SMS_USER_SUCSESS_RESTORE_PASSWORD', $fields);
            $sms->setSite('v1');
            $sms->setLanguage('ru');
            $sms->send();
        }
        return $arFields;
    }
}


AddEventHandler("main", "OnPageStart", array("GeoCity", "AddUpdateGeoCookie"));
AddEventHandler("main", "OnAfterUserRegister", array("BonusBilling", "OnAfterUserRegisterHandler"));

class GeoCity
{
    function AddUpdateGeoCookie()
    {
        $ip["ip"] = \Bitrix\Main\Service\GeoIp\Manager::getRealIp();
        require_once($_SERVER['DOCUMENT_ROOT'] . "/include/geo.php");
        $geo = new Geo($ip);
        \Bitrix\Main\Loader::includeModule('iblock');

        if (!empty($_REQUEST["city"]) && isset($_REQUEST["city"])) {
            $cityID = intval($_REQUEST["city"]);
            $geoCityItem = \Bitrix\Iblock\ElementTable::getList(array(
                'order' => array(),
                'select' => array('ID', 'NAME', 'IBLOCK_ID'),
                'filter' => array('IBLOCK_ID' => 20, 'ID' => $cityID, "ACTIVE" => "Y"),
                'group' => array(),
                'limit' => 1,
                'offset' => 0,
                'count_total' => 1,
                'runtime' => array(),
                'data_doubling' => false,
                'cache' => array('ttl' => 3600, 'cache_joins' => true),
            ));
            $geoData = $geoCityItem->fetch();
            if (!empty($geoData["NAME"])) {
                $geoCookie = array("city" => $geoData["NAME"]);
                setcookie('geo', serialize($geoCookie), time() + 3600 * 24 * 7, '/');
            }
        } else {
            $geoCityItem = \Bitrix\Iblock\ElementTable::getList(array(
                'order' => array(),
                'select' => array('ID', 'NAME', 'IBLOCK_ID'),
                'filter' => array('IBLOCK_ID' => 20, 'NAME' => $geo->get_value('city', true), "ACTIVE" => "Y"),
                'group' => array(),
                'limit' => 1,
                'offset' => 0,
                'count_total' => 1,
                'runtime' => array(),
                'data_doubling' => false,
                'cache' => array('ttl' => 3600, 'cache_joins' => true),
            ));

            $geoData = $geoCityItem->fetch();
        }
        //если определен город, и он в списке городов сайта, то подставляем этот город. Иначе - Москва
        if (!empty($geoData)) {
            $GLOBALS["GEOCITY"] = array(
                "NAME" => $geoData["NAME"],
                "ID" => $geoData["ID"]
            );
            setcookie('selected_city', $GLOBALS["GEOCITY"]['ID'] , time() + 3600 * 24 * 7, '/');
        } else {
            $GLOBALS["GEOCITY"] = array(
                "NAME" => "Москва",
                "ID" => 644
            );
            setcookie('selected_city', $GLOBALS["GEOCITY"]['ID'] , time() + 3600 * 24 * 7, '/');
        }
    }
}

class BonusBilling
{
    function OnAfterUserRegisterHandler(&$arFields)
    {
        //приветственный бонус = 50 BNS
        $updateBNS = 50;
        $description = "MANUAL";
        $notes = "Приветственный бонус за регистрацию на vincko";
        if ($arFields["USER_ID"] > 0) {
            //пополнить бонусный счет
            CModule::IncludeModule("sale");
            CSaleUserAccount::UpdateAccount($arFields["USER_ID"], $updateBNS, "BNS", $description, 0, $notes);
        }
    }
}

class ExtraElement
{
    public static function getElementCodeByID($id)
    {
        global $DB;

        $id = intval($id);
        $sql = "SELECT `CODE` FROM `b_iblock_element` WHERE `ID` = $id LIMIT 1";

        $res = $DB->Query($sql, false, "FILE: " . __FILE__ . "<br> LINE: " . __LINE__);
        $arResult = $res->GetNext();

        if (isset($arResult['CODE'])) return $arResult['CODE'];
        else return false;
    }
}