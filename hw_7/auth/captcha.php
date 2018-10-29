<?php
$countCaptcha = (isset($_SESSION['countCaptcha'])) ? $_SESSION['countCaptcha'] : 0;
$countBan = (isset($_SESSION['countBan'])) ? $_SESSION['countBan'] : 0;

if (isset($_POST['g-recaptcha-response'])) {
    $countBan++;
    $_SESSION['countBan'] = $countBan; //кол-во не правильных вводов данных с каптчей
    if ($_SESSION['countBan'] > 5) {
        setcookie('ban','бан на 1 час', time()+3600);
        exit();
    }
    $urlToGoogleApi = "https://www.google.com/recaptcha/api/siteverify";
    $secret_key = '6LfASncUAAAAAG9zh38syXzQcqO353hMGUq2ZboX';
    $query = $urlToGoogleApi . '?secret=' . $secret_key . '&response=' . $_POST['g-recaptcha-response'] . '&remoteip=' . $_SERVER['REMOTE_ADDR'];
    $data = json_decode(file_get_contents($query));
    if ($data->success) {
        // Продолжаем работать с данными для авторизации из POST массива
    } else {
        exit('Извините, но похоже вы робот \(0_0)/');
    }
}

