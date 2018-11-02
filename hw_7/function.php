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
    header("Location: $location");
    exit();
}

function logout() {
    session_destroy();
    header("Location: ../index.php");
    exit();
}

function delTest($testNum) {
    foreach (getJsonList() as $key => $testName) {
        if ($key === $testNum) {
            $test = $testName;
            break;
        }
    }
    unlink('json/' . $test);
}