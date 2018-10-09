<?php
$x = (int) $_POST['x'];
$a = 1;
$b = 1;
while ($a <= $x) {
    $c = $a;
    $a = $a + $b;
    $b = $c;
}
if (isset($_POST['x']) && $a > $x) {
    echo "Задуманное число ($x) НЕ входит в числовой ряд";
} elseif ($a == $x) {
    echo "Задуманное число ($x) входит в числовой ряд";
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