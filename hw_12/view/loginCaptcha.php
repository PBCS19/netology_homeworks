<!DOCTYPE html>
<html lang="ru">  
  <head>
    <title>Авторизация</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
  </head>
  <body>
    <?php if (!empty($errors)) : ?>
    <p style="color: red;"><?= array_shift($errors);?></p>
    <?php endif ?>
    <form method="POST" action="index.php?c=guest&a=auth">
    Логин <input name="login" type="text"><br>
    Пароль <input name="password" type="password"><br>
    <div class="g-recaptcha" data-sitekey="6LfASncUAAAAALxm8HOzYmtziGG5o72r2_OG1X1o"></div>
    <input name="submit" type="submit" value="Войти">
    </form>
    <a href="../index.php">На главную</a>
  </body>
</html>

