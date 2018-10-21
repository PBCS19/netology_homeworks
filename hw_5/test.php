<?php
$test_number = $_GET['n'];
$list_file = scandir('./json', 1);
foreach (scandir('./json', 1) as $file) {
    $files[$file] = filemtime("./json/$file");
}
asort($files);
$files = array_keys($files);
var_dump($files[$test_number]);
$test = file_get_contents(__DIR__ . '/json/' . $files[$test_number]);
$test_array = json_decode($test, true);
var_dump($_POST);
var_dump($test_array);
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
        <title>Домашнее задание №5</title>
  </head>
  <body>
    <h1><?php echo $test_array['Name_Test']; ?></h1>
    <form action="" method="POST">
      <fieldset>
        <legend>Сколько граммов в одном килограмме?</legend>
          <label><input type="radio" name="q1"> 10</label>
          <label><input type="radio" name="q1"> 100</label>
          <label><input type="radio" name="q1"> 1000</label>
          <label><input type="radio" name="q1"> 10000</label>
      </fieldset>
      <fieldset>
        <legend>Сколько метров в одном дециметре?</legend>
          <label><input type="radio" name="q2"> 100</label>
          <label><input type="radio" name="q2"> 10</label>
          <label><input type="radio" name="q2"> 0.1</label>
          <label><input type="radio" name="q2"> 0.01</label>
      </fieldset>
      <input type="submit" value="Отправить">  
    </form>
   </body>
</html>