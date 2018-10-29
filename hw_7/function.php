<?php
session_start();
function getJsonList() {
    $files = scandir('./json');
    if (empty($files[2])) {
        http_response_code(404);
        exit('Пустой список тестов. Загрузите тест! <a href="admin.php">На главную!</a>');
    }
    foreach ($files as $file) {
        if (preg_match ('~\.json$~',$file)) {
            $listFile[] = $file;
        }
    }
    return $listFile;
}

function redirect($location) {
    $host  = $_SERVER['HTTP_HOST'];
    header("Location: http://$host/hw_7/$location");
    exit();
}

function logout() {
    session_destroy();
    $host  = $_SERVER['HTTP_HOST'];
    header("Location: http://$host/hw_7/index.php");
    exit();
}