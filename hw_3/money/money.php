<?php
$filename = 'money.csv';
$price_arr = array_slice($argv, 1, 1);
foreach ($price_arr as $numeric) {
    $num = is_numeric($numeric);
}

if ($price_arr[0] === '--today') {
    if (file_exists($filename)) {
        $data = fopen($filename, "r");
        $sum = 0;
        while (($data_arr = fgetcsv($data, 1000, ",")) !== false) {
            for ($i=0; $i < count($data_arr); $i++) {
               if ($data_arr[$i] === date('Y-m-d')) {
                   $sum += $data_arr[1];
               }
            }
        }
        echo 'расход за день:' . $sum;
    } else {
        echo 'Файл ' . $filename . ' не существует';
    }
} elseif ($price_arr[0] === null) {
    echo 'Ошибка! Аргументы не заданы. Укажите флаг --today или запустите скрипт с аргументами {цена} и {описание покупки}';
} elseif ($num === false) {
    echo 'Ошибка! Аргументы заданы не верно (цена не является числом). Укажите флаг --today или запустите скрипт с аргументами {цена} и {описание покупки}';
} elseif ($argv[2] === null) {
    echo 'Ошибка! Не указано описание покупки. Укажите флаг --today или запустите скрипт с аргументами {цена} и {описание покупки}';
} else {
    $description = implode(' ',array_slice($argv, 2));
    $price = number_format($price_arr[0], 2, '.','');
    $price_arr = [date('Y-m-d'), $price, $description];
    $data = fopen($filename, "a+");
    fputcsv($data, $price_arr, ',');
    fclose($data);
    echo 'Добавлена строка: ' . date('Y-m-d') . ', ' . $price . ', ' . $description;
}

?>