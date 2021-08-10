<?

use Bitrix\Main\Loader;

Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

/**
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
    $arParse = csvToArray("reviews.csv");

    foreach($arParse as $fields){
        $hlblock = HL\HighloadBlockTable::getById(5)->fetch(); 

        $entity = HL\HighloadBlockTable::compileEntity($hlblock); 
        $entity_data_class = $entity->getDataClass(); 

        // Массив полей для добавления
        $data = array(
            "UF_CHOP_ID" => $fields[1],
            "UF_USER_NAME" => $fields[2],
            "UF_REVIEW_DATE" => $fields[3],
            "UF_ALLSCORE_REVIEW_SCORE" => $fields[4],
            "UF_CUSTOMER_FOCUS_SCORE" => $fields[5],
            "UF_COMFORT_SCORE" => $fields[6],
            "UF_SECURITY_SCORE" => $fields[7],
        );

        $result = $entity_data_class::add($data);
    }
}

addToHighload();
?>