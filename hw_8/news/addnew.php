<?php
require_once 'newsClass.php';
if (isset($_POST['submit'])) 
{
    $new = new NewsClass;
    $new->addNews(htmlspecialchars($_POST['name']), $_POST['new']);
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <title>Добавить новость</title>
  </head>
  <body>
    <form method="POST" action="">
      <p>
        <lable id="name">Вашe имя:</lable><br>
        <input type="text" name="name" />
      </p>
      <p>
        <lable id="new">Новость:</lable><br>
        <textarea name="new" rows="8" cols="40"></textarea>
      </p>
      <p>
        <input type="submit" name="submit" value="Отправить">
      </p>
    </form>
  </body>
</html>

