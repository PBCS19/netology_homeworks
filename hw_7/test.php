<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'function.php';

if ( empty($_SESSION['log_user']) && empty($_SESSION['guest'])) {
    redirect('index.php');
    exit();
}

//открытие теста по номеру
if(!isset($_GET['n'])) {
    http_response_code(400);
    exit('Передайте переменную n. Пример: /test.php?n=1');
}
$testNumber = $_GET['n'];
$id = (int)$testNumber - 1;
if (empty(getJsonList()[$id]) || $id === -1) {
    http_response_code(404);
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
        <title>Тесты</title>
  </head>
  <body>
    <div>
    <form action="" method="POST">
      <h2><?php echo $testArray['NameTest']; ?></h2>
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
        $countTrue = 0;
        echo '<br><div><table border="1">';
        foreach ($questions as $questionNum => $question) {
            echo '<tr>';
            if (!isset($_POST['q' . ($questionNum + 1)])) {
                echo '<td>Ответ на вопрос №' . ($questionNum+1) . '</td><td>Не был дан!</td>';
            } else if ($_POST['q' . ($questionNum + 1)] === $rightAnswers[$questionNum+1]) {
                $countTrue++;
                echo '<td>Ответ на вопрос №' . ($questionNum + 1) . '</td><td>Верный</td>';
            } else {
                echo '<td>Ответ на вопрос №' . ($questionNum + 1) . '</td><td>Не верный</td>';
            }
            echo '</tr>';
        }
        echo '</table></div>';
        $_SESSION['rez'] = $countTrue;
    ?>
   <h2>Ваш сертификат:</h2>
   <img src="sertificate.php" /><br>
   <a href="index.php">На главную</a>
    <?php } ?>
   </body>
</html>