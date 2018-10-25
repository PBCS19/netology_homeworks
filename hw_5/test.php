<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include 'function.php';

//открытие теста по номеру
if(!isset($_GET['n'])) {
    exit('Передайте переменную n. Пример: /test.php?n=1');
}
$testNumber = $_GET['n'];
$id = (int)$testNumber - 1;
if (empty(getJsonList()[$id]) || $id === -1) {
    exit('Не правильный номер теста');
}
foreach (getJsonList() as $key => $files) {
    if ($key === $id) {
        $file = $files;
        break;
    }
}
$test = file_get_contents(__DIR__ . '/json/' . $file);
$testArray = json_decode($test, true);
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
        <title>Домашнее задание №5 - Тесты</title>
  </head>
  <body>
    <div>
    <h1><?php echo $testArray['NameTest']; ?></h1>
    <form action="" method="POST">
      <?php  // вывод вопросов и ответов
      $numbersQuestions = 0; // номер вопроса
      $questions = isset($testArray['Questions']) ? $testArray['Questions'] : [];
      foreach ($questions as $values) {
          foreach ($values as $keys => $questionsValues) {
              if ($keys === 'Question') {
                  $numbersQuestions++;
                  echo '<fieldset>';
                  echo '<legend>' . $questionsValues . '</legend>'; // вопрос
              } elseif ($keys === 'Answers') {
                  foreach ($questionsValues as $answer) {
                      // ответы
                      echo '<label><input type="radio" name=q' . $numbersQuestions . ' value="' . $answer . '">' . $answer . '</label>';
                  }
                  echo '</fieldset>';
              } else {
                  $rightAnswers[$numbersQuestions] = $questionsValues; // запись верных ответов
              }
          }
      }
      ?>
      <input type="submit" value="Отправить">  
    </form>
    </div>
    <?php
    // обработка ответов
    if (!empty($_POST)) {
        echo '<div><table border="1">';
/*        $nmbsQuestions = 0; // номер вопроса
        foreach ($_POST as $questions => $answers) {
            echo '<tr>';
            $nmbsQuestions++;
            if ($answers === $rightAnswers[$nmbsQuestions]) {
                echo '<td>Ответ на вопрос №' . $nmbsQuestions . '</td><td>Верный</td>';
            } else {
                echo '<td>Ответ на вопрос №' . $nmbsQuestions . '</td><td>Не верный</td>';
            }
            echo '</tr>';
        } */
        foreach ($questions as $questionNum => $question) {
            echo '<tr>';
            if (!isset($_POST['q' . ($questionNum + 1)])) {
                echo '<td>Ответ на вопрос №' . ($questionNum+1) . '</td><td>Не был дан!</td>';
            } else if ($_POST['q' . ($questionNum + 1)] === $rightAnswers[$questionNum+1]) {
                echo '<td>Ответ на вопрос №' . ($questionNum + 1) . '</td><td>Верный</td>';
            } else {
                echo '<td>Ответ на вопрос №' . ($questionNum + 1) . '</td><td>Не верный</td>';
            }
            echo '</tr>';
        }
        echo '</table></div>';
    }
    ?>
   </body>
</html>