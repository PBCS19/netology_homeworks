<?php
    $userName = 'Виктор';
    $userSurname = 'Костарев';
    $userAge = 21;
    $userEmail = 'kostarev.victor15@yandex.ru';
    $userCity = 'Новоуральск';
    $userAbout = 'Студент';
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <title>Домашнее задание №1</title>
  </head>
  <body>
    <div>
      <h2>Информация о пользователе <?= $userName . ' ' . $userSurname ?></h2>
      <table border="1">
        <tr>
		  <td>Имя:</td>
		  <td><?= $userName ?></td>
		</tr>
        <tr>
		  <td>Фамилия:</td>
		  <td><?= $userSurname ?></td>
		</tr>  
        <tr>
		  <td>Возраст:</td>
		  <td><?= $userAge ?></td>
		</tr>
        <tr>
		  <td>Адрес электронной почты:</td>
		  <td><a href="mailto:<?= $userEmail ?>"><?= $userEmail ?></td>
		</tr>
        <tr>
		  <td>Город:</td>
		  <td><?= $userCity ?></td>
		</tr>
        <tr>
		  <td>О себе:</td>
		  <td><?= $userAbout ?></td>
		</tr>
      </table>
    </div>
  </body>
</html>
