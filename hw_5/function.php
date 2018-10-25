<?php
function getJsonList() {
    $file = scandir('./json');
    if (empty($file[2])) {
        exit('Пустой список тестов. Загрузите тест! <a href="admin.php">На главную!</a>');
    }
    foreach ($file as $files) {
        if (preg_match ('~\.json$~',$files)) {
            $listFile[] = $files;
        }
    }
    return $listFile;
}