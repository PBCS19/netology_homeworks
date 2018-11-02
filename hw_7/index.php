<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
        <title>Главная</title>
  </head>
  <body>
    <?php if (empty($_SESSION['log_user']) && empty($_SESSION['guest']) && empty($_SESSION['log_admin'])): ?>
    <div>
    <a href="auth/login.php">Авторизоваться</a><br />
    <a href="auth/signup.php">Регистрация</a><br />
    <a href="auth/guest.php">Войти как гость</a>
    </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['log_admin'])): ?>
    <div>
    <h1>Добро пожаловать <?= $_SESSION['log_admin'] ?></h1>
    <a href="list.php">Список тестов</a><br />
    <a href="admin.php">Добавить тест</a><br />
    <a href="auth/logout.php">Выход</a>
    </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['guest']) || !empty($_SESSION['log_user'])): ?>
    <div>
    <h1>Добро пожаловать <?php $user = !empty($_SESSION['guest']) ? $_SESSION['guest'] : $_SESSION['log_user']; 
    echo $user;?></h1>
    <a href="list.php">Список тестов</a><br />
    <a href="auth/logout.php">Выход</a>
    </div>
    <?php endif; ?>
  </body>
</html>