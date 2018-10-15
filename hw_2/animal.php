<?php
//init_set ('display_errors', 1);
//init_set ('error_reporting', R_ALL);

// 1 задание
$array = [
    'Africa' => ['Giraffa camelopardalis rothschildi', 'Loxodonta'],
    'Antarctica' => ['Aptenodytes forsteri'],
    'Australia' => ['Macropus'],
    'Eurasia' => ['Pteromys volans', 'Bison bonasus', 'Apodemus agrarius'],
    'North America' => ['Mammuthus columbi', 'Bison bison'],
    'South America' => ['Eunectes murinus', 'Bradypodidae', 'Pithecia', 'Vicugna pacos']
        ];

// 2 задание
$count_animals = 0;
foreach ($array as $continents => $value){
    foreach ($value as $animals){
        $words = explode(" ", $animals); // разбиваем строку на подстроки по пробелу, получаем отдельно каждое слово
        $count_words = count($words); // кол-во слов
        if ($count_words === 2){
            $array_animals[$key][] = $animals;
            $word1[$continents][] = $words[0]; // массив [континент,первое слово]
            $word2[] = $words[1]; // массив из вторых слов
//            $count_animals++; //общее кол-во животных в назв. которых 2 слова
        }
    }
}

// 3 задание

foreach ($word1 as $animals) {
   shuffle($animals); 
}
shuffle ($word2);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Домашнее задание №2</title>
    <style>
        h2{
            text-decoration: underline;
        }
    </style>
  </head>
  <body>
    <h1>Жестокое обращение с животными</h1>
    <h2>Исходный массив:</h2>
    <details>
        <pre><?php var_dump($array); ?></pre>
    </details>
    <h2>Названия из 2-х слов:</h2>
    <?php
//    $count = 0;
    foreach ($array_animals as $continents => $values) { // обход массива с животными из 2-х слов
        $animals_2_words = implode(", ", $values);
        echo $animals_2_words;
//        foreach ($values as $animals_2_words) {
//            $count++;
//            echo $animals_2_words;
//            if ($count === $count_animals) {
//                echo '.';
//            } else {
//                echo ', ';
//            }
//        }
    }
    echo '.';
    ?>
    <h2>"Фантазийные" названия:</h2>
    <?php
    $i = 0;
    foreach ($word1 as $continents => $values) { // обход массива [континент,первое слово назв.животного]
        echo '<h3>' . $continents . '</h3>';
        $last_animal = end($values);
        foreach ($values as $word1) {
               echo $word1 . ' ' . $word2[$i];
               $i++;
               if ($word1 === $last_animal) {
                   echo '.';
               } else {
                   echo ', ';
               }
        }
    }
    ?>
  </body>