<?php
session_start();
require_once 'function.php';
?>

<html>
  <head>
    <title>Главная</title>
  </head>
  <?php if (empty($_SESSION['user_id'])) : ?>
  <body>
    <a href="auth/login.php">Войти</a><br>
    <a href="auth/signup.php">Зарегистрироваться</a>
  </body>
  <?php endif; ?>
  
  <?php if (!empty($_SESSION['user_id'])) : ?>
  <body>
    <form method="POST" action="addcase.php">
      <p>Добавление дела:</p>
      <p><textarea name="description" rows="4" cols="20"></textarea></p>
      <p><input name="addcase" type="submit" value="Добавить дело"></p>
    </form>
    
    <table border="1">
      <tr>
        <td>Дела</td>
        <td>Когда</td>
        <td>Статус</td>
        <td>Исполнитель</td>
      </tr>
        <?php //$description = prepExpr($pdo, "SELECT description, date_added FROM task WHERE user_id=:id ORDER BY date_added DESC", ['id'=>$_SESSION['user_id']]);
        $stmt = $pdo->prepare("SELECT * FROM task WHERE user_id=:id OR assigned_user_id=:id ORDER BY date_added DESC");
        $stmt->execute(['id'=>$_SESSION['user_id']]);
        while ($description = $stmt->fetch()) : ?>
        <tr>
            <td><?php echo $description['description'];?></td>
            <td><?php echo $description['date_added'];?></td>
            <td><?php if ((int)$description['is_done'] === 1) {
                echo 'Выполнено'; 
            } else {
                echo 'Невыполнено'; 
            } ?></td>
            <td>
              <?php 
//              $assignedUserList = $pdo->prepare("SELECT * FROM ?");
//              $assignedUserList->execute(['user']);
              $assignedUserList = $pdo->query("SELECT * FROM user"); ?>
              <form action="delegate.php" method="POST">
                <input name="task_id" type="hidden" value="<?php echo $description['id']; ?>"> 
                <select name="assigned_user_id">
                <?php foreach ($assignedUserList as $assignedUser): ?>
                  <option <?php if ($task['assigned_user_id'] == $assignedUser['id']):?>
                    selected<?php endif; ?> value="<?= $assignedUser['id'] ?>">
                    <?= $assignedUser['login'] ?>
                  </option>
                <?php endforeach; ?>
                </select>
                <button type="submit">Делегировать</button>
                <?php $userLogin = prepExpr($pdo, "SELECT login FROM user WHERE id=?", [$description['assigned_user_id']]) ?>
                <p>Исполнитель: <?php echo $userLogin['login']; ?></p>
              </form>
            </td>
            <td>
              <form method="POST" action="delcase.php">
                <p><button name="delcase" type="submit" value="<?php echo $description['id']; ?>">Удалить дело</button></p>
              </form>
              <form method="POST" action="success.php">
                <p><button name="success" type="submit" value="<?php echo $description['id']; ?>">Выполнено</button></p>
              </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table><br>
    
    <table border="1">
      <tr>
        <td>Делегировано на</td>
        <td>Дело</td>
      </tr>
      <?php
      $stmt = $pdo->prepare("SELECT * FROM task t INNER JOIN user u ON u.id=t.assigned_user_id WHERE t.user_id =:id OR t.assigned_user_id = :id");
      $stmt->execute(['id'=>$_SESSION['user_id']]);
      while ($delegate = $stmt->fetch()) : ?>
      <tr>
        <?php if ($delegate['user_id'] !== $delegate['assigned_user_id']) :?>
        <td><?= $delegate['login']?></td>
        <td><?= $delegate['description']?></td>
        <?php endif; ?>
      </tr>
      <?php endwhile; ?>
    </table>
    
    <p>Общее количество ваших дел: <?php $count = prepExpr($pdo, "SELECT count(*) as c FROM task as t WHERE t.user_id = :id OR t.assigned_user_id = :id", ['id'=>$_SESSION['user_id']]); 
    echo $count['c']?></p>
    
    <a href="auth/logout.php">Выход</a>
  </body>
  <?php endif; ?>
</html>