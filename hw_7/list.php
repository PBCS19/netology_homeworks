<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once 'function.php';

if ( empty($_SESSION['log_user']) && empty($_SESSION['guest']) && empty($_SESSION['log_admin'])) {
    redirect('./index.php');
    exit();
}
if (isset($_POST['delTest'])) {
    $arr = explode(' ', $_POST['delTest']);
    $testNum = (int)$arr[3] - 1;
    delTest($testNum);
}
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
        <title>Список тестов</title>
  </head>
  <body>
    <ol>
      <?php
      foreach (getJsonList() as $key => $test) :
          $id = $key + 1;
          echo '<li><a href="test.php?n=' . $id . '">Тест №' . $id . '</a>'; ?>
      <?php if (isset($_SESSION['log_admin'])): ?>
      <form method="POST">
        <input type="submit" name="delTest" value="Удалить тест № <?php echo $id?>" />
      </form></li><br>
      <?php endif; ?>
      <?php endforeach; ?>
    </ol>
    <?php if (isset($_SESSION['log_admin'])): ?>
    <a href="admin.php">Добавить тест</a>
    <?php endif; ?>
  </body>
</html>