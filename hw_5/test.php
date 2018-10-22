<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

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
        <legend><?php echo $test_array['Question'][0]['First_Question']; ?></legend>
          <label><input type="radio" name="q1" value="a"><?php echo $test_array['Question'][0]['Answers'][0]; ?></label>
          <label><input type="radio" name="q1" value="b"><?php echo $test_array['Question'][0]['Answers'][1]; ?></label>
          <label><input type="radio" name="q1" value="c"><?php echo $test_array['Question'][0]['Answers'][2]; ?></label>
          <label><input type="radio" name="q1" value="d"><?php echo $test_array['Question'][0]['Answers'][3]; ?></label>
      </fieldset>
      <input type="submit" value="Отправить">  
    </form>
   </body>
</html>