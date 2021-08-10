<?
/**
* parse csv file into 1 multi array
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


csvToArray("reviews.csv");
?>