<?php
session_start();
$name = isset($_SESSION['log_user']) ? $_SESSION['log_user'] : $_SESSION['guest'];
$rez = $_SESSION['rez'];
$string = 'Поздравляю, ' . $name . '!';
$rezult = 'Ваш результат: ' . $rez . ' правильных ответов!';
$center = 325;

header ('Contenr-Type: image/png');
$imgFile = imagecreatefromjpeg(__DIR__ . '/img/128651-3.jpg');

//RGB
$textColor = imagecolorallocate($imgFile, 255, 0, 0);

$fontFile = __DIR__ . '/font/7675.ttf';

$boxString = imagettfbbox(20, 0, $fontFile, $string);
$leftString = $center-round(($boxString[2]-$boxString[0])/2);
imagettftext($imgFile, 20, 0, $leftString, 180, $textColor, $fontFile, $string);

$boxRezult = imagettfbbox(20, 0, $fontFile, $rezult);
$leftRezult = $center-round(($boxRezult[2]-$boxRezult[0])/2);
imagettftext($imgFile, 20, 0, $leftRezult, 250, $textColor, $fontFile, $rezult);
imagepng($imgFile);
imagedestroy($imgFile);
