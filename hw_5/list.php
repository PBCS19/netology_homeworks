<?php
include 'function.php';
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
        <title>Домашнее задание №5 - Список тестов</title>
  </head>
  <body>
    <ol>
      <?php
      foreach ($listFile as $key => $test) {
          $id = $key + 1;
          echo '<li><a href="test.php?n=' . $id . '">Тест №' . $id . '</a></li><br>';
      }
      ?>
    </ol>
  </body>
</html>