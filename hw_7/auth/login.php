<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once '../function.php';
require_once 'captcha.php';

if (!empty($_COOKIE['ban'])) {
    http_response_code(403);
    exit('Подождите часок, мы вас заблокировали, а затем попробуйте снова');
}

if (isset($_POST['submit'])) {
    $errors = [];
    if (isset($_POST['login'])) {
        if (file_exists('./login/' . $_POST['login'] . '.json')) {
            $files = scandir('./login');
            foreach ($files as $file) {
                if ($file === $_POST['login'] . '.json') {
                    $login = file_get_contents(__DIR__ . '/login/' . $file);
                    $loginArray = json_decode($login, true);
                    break;
                }
            }
            if ($loginArray['pas'] === $_POST['password']) {
//                echo 'логин верный, редирект на list.php для админа';
                $_SESSION['log_user'] = $loginArray['name'];
                redirect('list.php');
            } else {
                $errors[] = 'Не верный пароль!';
            }
        } else {
            $errors[] = 'Пользователя с таким логин не существует!';
        }
    }
}
if (!empty($errors)) {
    if (!isset($_SESSION['countBan']) || $_SESSION['countBan'] < 5) {
        echo '<p style="color: red;">' . array_shift($errors) . '</p>';
        // считаем кол-во ошибок, для вывода каптчи.
        $countCaptcha++;
        $_SESSION['countCaptcha'] = $countCaptcha;
    } else {
        http_response_code(403);
        exit('Подождите часок, мы вас заблокировали, а затем попробуйте снова');
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
  <?php if (!isset($_SESSION['countCaptcha']) || $_SESSION['countCaptcha'] < 6) { ?>
  <head>
    <title>Авторизация</title>
  </head>
  <body>
    <form method="POST">
    Логин <input name="login" type="text"><br>
    Пароль <input name="password" type="password"><br>
    <input name="submit" type="submit" value="Войти">
    </form>
    <a href="../index.php">На главную</a>
  </body>
  <?php } elseif ($_SESSION['countCaptcha'] >= 6) { ?>
  <head>
    <title>Авторизация</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
  </head>
  <body>
    <form method="POST">
    Логин <input name="login" type="text"><br>
    Пароль <input name="password" type="password"><br>
    <div class="g-recaptcha" data-sitekey="6LfASncUAAAAALxm8HOzYmtziGG5o72r2_OG1X1o"></div>
    <input name="submit" type="submit" value="Войти">
    </form>
    <a href="../index.php">На главную</a>
  </body>
  <?php } ?>
</html>