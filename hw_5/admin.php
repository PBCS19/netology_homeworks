<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
        <title>Домашнее задание №5</title>
  </head>
  <body>
  <?php if (!$_FILES) { ?>
  <form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="filename"><br>
    <input type="submit" value="Загрузить"><br>
  </form>
  <?php } else {
        if (is_uploaded_file($_FILES["filename"]["tmp_name"])) {
            $name_file = date("d.m.Y_H.i.s") . $_FILES["filename"]["name"];
            move_uploaded_file($_FILES["filename"]["tmp_name"], __DIR__ . '/json/' . $name_file);
            $string = '<a target="_blank" href="' . __DIR__ . '/json/' . $name_file . '">Тест: ' . $name_file . '</a>';
            $list = fopen('list.php', 'a+');
            fwrite($list, '<br>' . $name_file);
            fclose($list);
//            $test = file_get_contents(__DIR__ . '/' . $name_file);
//            $test_array = json_decode($test, true);
            echo 'Тест загружен!';
        } else {
            echo("Ошибка загрузки файла");
        }
    } ?>
  </body>  
</html>