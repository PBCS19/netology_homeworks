<?php
require_once 'function.php';

if ( empty($_SESSION['log_user']) && empty($_SESSION['guest'])) {
    redirect('index.php');
    exit();
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
      foreach (getJsonList() as $key => $test) {
          $id = $key + 1;
          echo '<li><a href="test.php?n=' . $id . '">Тест №' . $id . '</a></li><br>';
      }
      ?>
    </ol>
    <?php if ($_SESSION['log_user']): ?>
    <a href="admin.php">Добавить тест</a>
    <?php endif; ?>
  </body>
</html>