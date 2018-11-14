<!DOCTYPE html>
<html lang="ru">
  <head>
    <title>Регистрация</title>
  </head>
  <body>
    <?php if (!empty($errors)) : ?>
    <p style="color: red;"><?= array_shift($errors);?></p>
    <?php endif ?>
    <form action="index.php?c=guest&a=signup" method="POST">
      <p>
        <lable id="login">Ваш логин:</lable><br>
        <input id="login" type="text" name="login">
      </p>
      <p>
        <lable id="password">Ваш пароль:</lable><br>
        <input id="password" type="password" name="password">
      </p>
      <p>
        <lable id="password_2">Повторите пароль:</lable><br>
        <input id="password_2" type="password" name="password_2">
      </p>
      <p>
        <input type="submit" name="registration" value="Зарегистрироватся">
      </p>
    </form>
  </body>
</html>

