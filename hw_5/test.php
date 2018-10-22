<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//открытие теста по номеру
$testNumber = $_GET['n'];
$listFile = scandir('./json');
$id = $testNumber + 1;
foreach ($listFile as $key => $files) {
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
          foreach ($values as $keys => $questions) {
              if ($keys !== 'Answers' && $keys !== 'RightAnswer') {
                  $numbersQuestions++;
                  echo '<fieldset>';
                  echo '<legend>' . $questions . '</legend>'; // вопрос
              } elseif ($keys === 'Answers') {
                  foreach ($questions as $answer) {
                      // ответы
                      echo '<label><input type="radio" name=q' . $numbersQuestions . ' value="' . $answer . '">' . $answer . '</label>';
                  }
                  echo '</fieldset>';
              } else {
                  $rightAnswers[$numbersQuestions] = $questions; // запись верных ответов
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
        $nmbsQuestions = 0; // номер вопроса
        foreach ($_POST as $questions => $answers) {
            echo '<tr>';
            $nmbsQuestions++;
            if ($answers === $rightAnswers[$nmbsQuestions]) {
                echo '<td>Ответ на вопрос №' . $nmbsQuestions . '</td><td>Верный</td>';
            } else {
                echo '<td>Ответ на вопрос №' . $nmbsQuestions . '</td><td>Не верный</td>';
            }
            echo '</tr>';
        }
        echo '</table></div>';
    }
    ?>
   </body>
</html>