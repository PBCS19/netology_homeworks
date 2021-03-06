<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
if (empty($argv[1])) {
    exit('Ошибка! Аргументы не заданы.');
}
$query = implode(" ", array_slice($argv, 1));
$filename = 'https://www.googleapis.com/books/v1/volumes?q=' . urlencode($query) . '&startIndex=0&maxResults=1';
$books = @file_get_contents($filename);
if ($books === false) {
    echo 'Не правильный URL или сервер не отвечает';
} else {
    $array_books = json_decode($books, true);
    foreach ($array_books as $book) {
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                echo '';
            break;
            case JSON_ERROR_DEPTH:
                echo ' - Достигнута максимальная глубина стека';
            break;
            case JSON_ERROR_STATE_MISMATCH:
                echo ' - Некорректные разряды или несоответствие режимов';
            break;
            case JSON_ERROR_CTRL_CHAR:
                echo ' - Некорректный управляющий символ';
            break;
            case JSON_ERROR_SYNTAX:
                echo ' - Синтаксическая ошибка, некорректный JSON';
            break;
            case JSON_ERROR_UTF8:
                echo ' - Некорректные символы UTF-8, возможно неверно закодирован';
            break;
            default:
                echo ' - Неизвестная ошибка';
            break;
        }
    }
//        $id = $array_books['items'][0]['id'];
//        $title = $array_books['items'][0]['volumeInfo']['title'];
//        $authors = $array_books['items'][0]['volumeInfo']['authors'][0];

//    foreach ($array_books as $key => $values) { //проход по массиву $array_books
//        if ($key === 'items') {
//            foreach ($values as $values2) {
//                foreach ($values2 as $keys_items => $values_items) {
//                    if ($keys_items === 'id') {
//                        $id = $values_items; //id
//                    } elseif ($keys_items === 'volumeInfo') {
//                        foreach ($values_items as $keys_volinf => $values_volinf) {
//                            if ($keys_volinf === 'title') {
//                                $title = $values_volinf; //title
//                            } elseif ($keys_volinf === 'authors') {
//                                foreach ($values_volinf as $values_authors) {
//                                    $authors_array[] = $values_authors; //массив авторов
//                                }
//                            }
//                        }
//                    }
//                }    
//            }
//        }
//    }
    
    function getValue($arg) { // возвращает сам элемент (если он не пуст) или пустую строку
        return (!empty($arg)) ? $arg : '';		
    }

    $id = getValue($array_books['items'][0]['id']);
    $title = getValue($array_books['items'][0]['volumeInfo']['title']);
    $authors = getValue($array_books['items'][0]['volumeInfo']['authors'][0]);

//    $authors = implode(",", $authors_array);

    $array = ['id' => $id, 'title' => $title, 'authors' => $authors];

    $data = fopen("data.csv", "a+");
    fputcsv($data, $array, ',');
    fclose($data);
}


?>