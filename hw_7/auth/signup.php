<?php
require_once '../function.php';
$dataArray = [];
$errors = [];
if (empty($_POST['login'])) {
    $errors[] = 'Введите логин';
} elseif (empty($_POST['password'])) {
    $errors[] = 'Введите пароль';
} elseif ($_POST['password'] !== $_POST['password_2'] || empty($_POST['password_2'])) {
    $errors[] = 'Пароли не совпадают';
}
if (!empty($errors)) {
    echo '<p style="color: red;">' . array_shift($errors) . '</p>';
} else {
    $dataArray = ['name' => $_POST['login'], 'pas' => $_POST['password'], 'role' => 'user'];
    file_put_contents('./login/' . $_POST['login'] . '.json', json_encode($dataArray));
    redirect('../index.php');
    exit();
}
?>
<form action="signup.php" method="POST">
  <p>
    <lable id="login">Ваш логин:</lable><br>
    <input id="login" type="text" name="login">
  </p>
  <p>
    <lable id="password">Ваш пароль:</lable><br>
    <input id="password" type="password" name="password">
  </p>
  <p>
    <lable id="password_2">Повторите пароль:</lable><br>
    <input id="password_2" type="password" name="password_2">
  </p>
  <p>
    <input type="submit" name="registration" value="Зарегистрироватся">
  </p>
</form>

