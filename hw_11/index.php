<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once 'db.php';
require_once 'TableClass.php';
session_start();
$table = new TableClass;
if (isset($_POST['create'])) {
    $table->getTable($pdo);
}
$listTable = $table->showTable($pdo);
if (isset($_POST['table'])) {
    $listFields = $table->describeTable($pdo, $_POST['table']);
    $_SESSION['table'] = $_POST['table'];
}
if (isset($_POST['delete'])) {
    $table->del($pdo, $_SESSION['table'], $_POST['delete']);
    echo '<p style="color: red;">ТАБЛИЦА БЫЛА УДАЛЕНА</p>';
}
if (isset($_POST['goEditType'])) {
    if(empty($_POST['edit'])) {
        $error[] = 'Введите на что изменить!';
    }
    $table->editTypeField($pdo, $_SESSION['table'], $_POST['goEditType'], $_POST['edit']);
    echo '<p style="color: red;">ТИП ИЗМЕНЕН</p>';
}
if (isset($_POST['goEditName'])) {
    if(empty($_POST['edit'])) {
        $error[] = 'Введите на что изменить!';
    }
    $arr = explode(' ',$_POST['goEditName']);
    $table->editNameField($pdo, $_SESSION['table'], $arr[0], '`'.$_POST['edit'].'`' . $arr[1]);
    echo '<p style="color: red;">ИМЯ ИЗМЕНЕНО</p>';
}
if (!empty($errors)) {
    echo '<p style="color: red;">' . array_shift($errors) . '</p>';
}
?>
<html>
  <head>
    <title>Главная</title>
  </head>
  <body>
    <form method="POST">
      <button type="submit" name="create" value="create">Создать таблицу</button>
    </form>
    
    <form method="POST">
    <?php foreach ($listTable as $nameTable) : ?>
      <button type="submit" name="table" value="<?php echo $nameTable['Tables_in_' . $dbname]; ?>"><?php echo $nameTable['Tables_in_' . $dbname]; ?></button>
    <?php endforeach; ?>
    </form>
    
    <?php if (isset($_POST['table'])) : ?>
    <table border="1">
      <tr>
        <td>Field</td>
        <td>Изменить Field</td>
        <td>Type</td>
        <td>Изменить Type</td>
        <td>Null</td>
        <td>Key</td>
        <td>Default</td>
        <td>Extra</td>
      </tr>
    <?php foreach ($listFields as $nameFields) : ?>
      <tr>
        <?php foreach ($nameFields as $key=>$fields) : ?>
        <td><?php echo $fields;?></td>
        <?php //if (!empty($nameFields['Null'])) { $null = $nameFields['Null'] === 'NO' ? 'NOT NULL' : 'NULL'; }
              //if (!empty($nameFields['Key'])) { $key1 = $nameFields['Null'] === 'PRI' ? 'PRIMARY KEY' : 'NULL'; }
              //if (!empty($nameFields['Default'])) { $default = 'DEFAULT ' . $nameFields['Default']; }
              //if (!empty($nameFields['Extra'])) { $extra = $nameFields['Extra']; }?>
        <?php if ($key === 'Field') : ?>
        <td>
          <form method="POST">
            <input type="text" name="edit" value="<?php echo $nameFields[$key]?>" />
            <button type="submit" name="goEditName" value="<?php echo $nameFields[$key] . ' ' . $nameFields['Type']?>">Изменить</button>
          </form>
        </td>
        <?php endif; ?>
        <?php if ($key === 'Type') : ?>
        <td>
          <form method="POST">
            <input type="text" name="edit" value="<?php echo $nameFields[$key]?>" />
            <button type="submit" name="goEditType" value="<?php echo $nameFields['Field']?>">Изменить</button>
          </form>
          <p>Не забудь доп.атрибуты!</p>
        </td>
        <?php endif; ?>
        <?php endforeach; ?>
        <td>
          <form method="POST">
            <button type="submit" name="delete" value="<?php echo $nameFields['Field']?>">Удалить</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
    </table>
    <?php endif; ?>
  </body>
</html>  
