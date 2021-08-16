<?php 

$_SERVER['DOCUMENT_ROOT'] = __DIR__;
require_once __DIR__ . '/bitrix/modules/main/include/prolog_before.php';

use Bitrix\Main\Loader;

Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

/**
* Удаляет полностью постые строчки из файла и записывает, нужно чтобы в highload-инфоблоке не было пустых записей
*/
function deleteEmptyLines(string $filepath){
    $lines = file("reviews.csv", FILE_SKIP_EMPTY_LINES );
    $num_rows = count($lines);
    foreach ($lines as $lineNo => $line) {
        $csv = str_getcsv($line);
        if (count(array_filter($csv)) == 0) {
            unset($lines[$lineNo]);
        }
    }
    file_put_contents("reviews.csv", $lines);
}

/**
* Парсит csv файл и отдаёт массив
* 
* @param string $filepath
* @param string $delimiter
* @return array|false
*/
function csvToArray(string $filepath, string $delimiter = ','): array{
    if (!file_exists($filepath) || !is_readable($filepath))
        return false;

    $data = [];
    if ($handle = fopen($filepath, 'r')) {
        while ($row = fgetcsv($handle, 0, $delimiter)) {
            $data[] = $row;
        }
        fclose($handle);
    }

    return $data;
}

function addToHighload(){
    deleteEmptyLines("reviews.csv");
    $arParse = csvToArray("reviews.csv");

    $entity = HL\HighloadBlockTable::compileEntity('ReviewsHL');

    $entity_data_class = $entity->getDataClass();

    foreach($arParse as $fields){
        //print_r($fields);

        // $monthsList = array(".01." => "января", ".02." => "февраля", 
        //     ".03." => "марта", ".04." => "апреля", ".05." => "мая", ".06." => "июня", 
        //     ".07." => "июля", ".08." => "августа", ".09." => "сентября",
        //     ".10." => "октября", ".11." => "ноября", ".12." => "декабря"
        // );

        // $date = date($fields[3]);
        // $replaceDate = date(".m.");
        // $date = str_replace($_mD, " ".$monthsList[$_mD]." ", $currentDate);

        $data = array(
            "UF_CHOP_ID" => $fields[0],
            "UF_CITY_ID" => $fields[1],
            "UF_REVIEW_DATE" => $fields[2],
            "UF_ALLSCORE_REVIEW_SCORE_COMMENT" => $fields[3],
            "UF_ALLSCORE_REVIEW_SCORE" => $fields[4],
            "UF_SECURITY_SCORE" => $fields[5],
            "UF_COMFORT_SCORE" => $fields[6],
            "UF_CUSTOMER_FOCUS_SCORE" => $fields[7],
            "UF_REVIEW_TYPE_ID" => 1,
        );

        $rsData = $entity_data_class::getList(array(
            "select" => array("ID", /*"UF_USER_NAME"*/"UF_ALLSCORE_REVIEW_SCORE_COMMENT"),
            "order" => array("ID" => "ASC"),
            "filter" => array("UF_ALLSCORE_REVIEW_SCORE_COMMENT" => $fields[3])
        ));

        // Удаление всех элементов
        // while($t = $rsData->fetch()){
        //     $entity_data_class::Delete($t["ID"]);
        // }

        if($arData = $rsData->Fetch()){
            $entity_data_class::update($arData["ID"], $data);
        }else{
            $entity_data_class::add($data);
        }
    }

    return true;
}

addToHighload();
?>