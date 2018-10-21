<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
if (empty($argv[1])) {
    exit('Ошибка! Аргументы не заданы.');
}
$first_resource = 'https://data.gov.ru/opendata/7704206201-country/data-20180609T0649-structure-20180609T0649.csv?encoding=UTF-8';
$second_resource = 'https://raw.githubusercontent.com/netology-code/php-2-homeworks/master/files/countries/opendata.csv';
$arg = implode(" ", array_slice($argv, 1));
$countries = @file_get_contents($first_resource);
if ($countries === false){
    echo 'Ресурс 1 не доступен или имеете не верный формат, берем данные с ресурса 2<br>';
    $countries = @file_get_contents($second_resource);
    if ($countries === false) {
        $countries = 0;
    } else {
        $countries = fopen($second_resource, 'r');
    }
} else {
    $countries = fopen($first_resource, 'r');
}

if ($countries === 0) {
   echo 'Ресурс 2 не доступен или имеет не верный формат'; 
} else {
    $shortest = -1;
    while (($array = fgetcsv($countries, 1000, ",")) !== FALSE) {
        for ($i = 0; $i<count($array); $i++) {
            $lev = levenshtein($arg, $array[$i]);
            if ($lev === 0) {
                $county  = $array[$i];
                $entry = $array[4];
                $shortest = 0;
                break;
            }
            if ($lev <= $shortest || $shortest < 0) {
                $county  = $array[$i];
                $entry  = $array[4];
                $shortest = $lev;
            }
//            if ($arg === $array[$i]) {
//                echo $array[$i] . ': ' . $array[4];
//            }
        }
    }
    $conclusion = $lev >= 13 ? 'Не найдено совпадений' : $county . ': ' . $entry; //Попробовал вывод если совпадений нет, возможно не верно
    echo $conclusion;
}
?>