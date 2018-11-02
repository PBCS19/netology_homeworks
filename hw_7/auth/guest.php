<?php
require_once '../function.php';

if ( !empty($_SESSION['log_user']) && !empty($_SESSION['log_admin']) ) {
    redirect('../index.php');
    exit();
}
if (isset($_POST['submit'])) {
    if (!empty($_POST['name'])) {
        $_SESSION['guest'] = $_POST['name'];
        redirect('../index.php');
    } else {
        $errors[] = 'Введите имя';
    }
}
if (!empty($errors)) {
        echo '<p style="color: red;">' . array_shift($errors) . '</p>';
}
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <title>Гость</title>
  </head>
  <body>
    <form method="POST">
      Ваше имя <input name="name" type="text"><br>
      <input name="submit" type="submit" value="Отправить">
    </form>
    <a href="../index.php">На главную</a>
  </body>
</html>

