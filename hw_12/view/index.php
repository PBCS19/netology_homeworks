<html>
  <head>
    <title>Главная</title>
  </head>
  <body>
    <form method="POST" action="index.php?c=case&a=add">
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
        <?php
        foreach ($stmt as $description) : ?>
        <tr>
            <td><?php echo $description['description'];?></td>
            <td><?php echo $description['date_added'];?></td>
            <td><?php if ((int)$description['is_done'] === 1) {
                echo 'Выполнено'; 
            } else {
                echo 'Невыполнено'; 
            } ?></td>
            <td>
              <form action="index.php?c=case&a=delegate" method="POST">
                <input name="task_id" type="hidden" value="<?php echo $description['id']; ?>"> 
                <select name="assigned_user_id">
                <?php foreach ($assignedUserList as $assignedUser): ?>
                  <option <?php if ($description['assigned_user_id'] == $assignedUser['id']):?>
                  selected<?php endif;?> value="<?= $assignedUser['id'] ?>">
                    <?= $assignedUser['login'] ?>
                  </option>
                <?php endforeach; ?>
                </select>
                <button type="submit">Делегировать</button>
              </form>
            </td>
            <td>
              <form method="POST" action="index.php?c=case&a=del">
                <p><button name="delcase" type="submit" value="<?php echo $description['id']; ?>">Удалить дело</button></p>
              </form>
              <form method="POST" action="index.php?c=case&a=success">
                <p><button name="success" type="submit" value="<?php echo $description['id']; ?>">Выполнено</button></p>
              </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table><br>
    
    <table border="1">
      <tr>
        <td>Делегировано на</td>
        <td>Дело</td>
      </tr>
      <?php
      foreach ($stmtDelegate as $delegate) : ?>
      <tr>
        <?php if ($delegate['user_id'] !== $delegate['assigned_user_id']) :?>
        <td><?= $delegate['login']?></td>
        <td><?= $delegate['description']?></td>
        <?php endif; ?>
      </tr>
      <?php endforeach; ?>
    </table>
    
    <p>Общее количество ваших дел: <?php echo $count['c']?></p>
    
    <a href="index.php?c=user&a=logout">Выход</a>
  </body>
</html>