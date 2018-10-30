<?php
require_once 'newsClass.php';
$new = new NewsClass;
foreach ($new->displayNews() as $values)
{
    foreach ($values as $key => $data) 
    {
        if ($key === 'date')
        {
            echo '<br>Дата: ' . $data;
        } elseif ($key === 'name') {
            echo '<br>Автор:<br>' . '<b>' . $data . '</b>';
        } else {
            echo '<br>Новость:<br>' . '<b>' . $data . '</b>' . '<br><br>';
        }
    }
}
?>

