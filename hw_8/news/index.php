<?php
require_once 'newsClass.php';
$new = new NewsClass;
if (empty($new->displayNews())) {
    http_response_code(404);
    exit('Нет новостей');
}
if (isset($_POST['goCom'])) 
{
    $arrayString = explode(' ', $_POST['goCom']);
    $fileName = $arrayString[5];
    $new->getComment($fileName, $_POST['nameCom'], $_POST['comment']);
}
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
      
  </head>
  <body>
  <?php
  foreach ($new->displayNews() as $values) :
    foreach ($values as $key => $data) :
        if ($key === 'date')
        {
            echo '<br>Дата: ' . $data;
            $nameFile = $data;
        } elseif ($key === 'name') {
            echo '<br>Автор:<br>' . '<b>' . $data . '</b>';
        } elseif ($key === 'new') {
            echo '<br>Новость:<br>' . '<b>' . $data . '</b>' . '<br>'; ?>
            <p>Добавить комментарий:</p>
            <details>
            <form method="POST">
              <br>Ваше имя:<br><input type="text" name="nameCom" /><br>
              Комментарий:<br><textarea name="comment" rows="4" cols="20"></textarea><br>
              <input type="submit" name="goCom" value="Отправить комментарий к новости от <?php echo $nameFile ?>" /><br>
            </form>
            </details><br>
        <?php  } elseif ($key === 'comment') {
            echo '<br>&emsp;&emsp;&emsp;&emsp;' . $data . '<br>';
        } elseif ($key === 'dateCom') {
            echo '<br>&emsp;&emsp;&emsp;&emsp;' . $data;
        } else {
            echo '<br>&emsp;&emsp;&emsp;&emsp;' . $data;
        } ?>
       <?php     
    endforeach;
  endforeach; ?>
  </body>
</html>

