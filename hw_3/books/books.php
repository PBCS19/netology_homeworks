<?php
if (!$argv) {
    exit();
}
if ($argv[1] === null) {
    echo 'Пустой запрос';
} else {
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
        $id = $array_books['items'][0]['id'];
        $title = $array_books['items'][0]['volumeInfo']['title'];
        $authors = $array_books['items'][0]['volumeInfo']['authors'][0];

        $array = ['id' => $id, 'title' => $title, 'authors' => $authors];

        $data = fopen("data.csv", "a+");
        fputcsv($data, $array, ',');
        fclose($data);
    }
}

?>