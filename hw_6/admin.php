<?php if ($_FILES) { 
      if (is_uploaded_file($_FILES["filename"]["tmp_name"]) && $_FILES["filename"]["type"] === 'application/json') {
            $name_file = date("Y.m.d_H.i.s") . $_FILES["filename"]["name"];
            move_uploaded_file($_FILES["filename"]["tmp_name"], __DIR__ . '/json/' . $name_file);
            header('Location: ./list.php');
        } else {
            http_response_code(400);
            echo 'Ошибка загрузки файла или файл не .json!';
        } 
} else { ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
        <title>Домашнее задание №5 - Загрузка тестов</title>
  </head>
  <body>
    <form action="admin.php" method="post" enctype="multipart/form-data">
      <h2>Загрузите тест</h2>
      <input type="file" name="filename"><br>
      <input type="submit" value="Загрузить"><br>
    </form>
  </body>  
</html>
<?php } ?>