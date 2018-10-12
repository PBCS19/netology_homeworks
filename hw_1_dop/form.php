<?php
$x = isset($_POST['x']) ? (int)$_POST['x'] : null;
$a = 1;
$b = 1;
while ($a < $x) {
    $c = $a;
    $a = $a + $b;
    $b = $c;
}
if ($x != null && $a > $x) {
    echo "Задуманное число ($x) НЕ входит в числовой ряд Фибоначчи";
} else {
    echo "Задуманное число ($x) входит в числовой ряд Фибоначчи";
}
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <title>Домашнее задание №1 (дополнительное)</title>
  </head>
  <body>
    <form method="post" action="">
      <label>Введите число:</label>
      <input type="text" name="x">
      <button type="submit">Отправить</button>
    </form>
  </body>
</html>