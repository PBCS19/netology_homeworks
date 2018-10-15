<?php
if ($argv[1] === null) {
    echo 'Пустой запрос';
} else {
    $arg = implode(" ", array_slice($argv, 1));
    $countries = @file_get_contents('https://data.gov.ru/opendata/7704206201-country/data-20180609T0649-structure-20180609T0649.csv?encoding=UTF-8');
    if ($countries === false){
        echo 'Ресурс 1 не доступен или имеете не верный формат, берем данные с ресурса 2<br>';
        $countries = @file_get_contents('https://raw.githubusercontent.com/netology-code/php-2-homeworks/master/files/countries/opendata.csv');
        if ($countries === false) {
            $countries = 0;
        } else {
            $countries = fopen('https://raw.githubusercontent.com/netology-code/php-2-homeworks/master/files/countries/opendata.csv','r');
        }
    } else {
        $countries = fopen('https://data.gov.ru/opendata/7704206201-country/data-20180609T0649-structure-20180609T0649.csv?encoding=UTF-8','r');
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
        echo $lev;
        $conclusion = $lev >= 13 ? 'Не найдено совпадений' : $county . ': ' . $entry; //Попробовал вывод если совпадений нет, возможно не верно
        echo $conclusion;
    }
}
?>