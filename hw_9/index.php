<?php
require_once 'db.php';
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", "$login", "$password");
if (isset($_POST['search'])) {
    $stmt = $pdo->prepare("SELECT * FROM books WHERE (name LIKE '%' ? '%') AND (isbn LIKE '%' ? '%') AND (author LIKE '%' ? '%')");
    $stmt->execute([htmlspecialchars($_POST['name']), htmlspecialchars($_POST['isbn']), htmlspecialchars($_POST['author'])]);
} else {
    $sql = $pdo->query('SELECT * FROM books');
}
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <style>
        table { 
            border-spacing: 0;
            border-collapse: collapse;
        }

        table td, table th {
            border: 1px solid #ccc;
            padding: 5px;
        }

        table th {
            background: #eee;
        }
    </style>
  </head>
  <body>
    <h1>Библиотека успешного человека</h1>
    <?php if (isset($_POST['search'])) : ?>
    <form method="POST">
        <input type="text" name="isbn" placeholder="ISBN" value="<?php echo $_POST['isbn'] ?>" />
        <input type="text" name="name" placeholder="Название книги" value="<?php echo $_POST['name'] ?>" />
        <input type="text" name="author" placeholder="Автор книги" value="<?php echo $_POST['author'] ?>" />
        <input type="submit" name="search" value="Поиск" />
    </form><br>
    
    <table>
      <tr>
        <td>Название</td>
        <td>Автор</td>
        <td>Год выпуска</td>
        <td>Жанр</td>
        <td>ISBN</td>
      </tr>
    <?php while ($search = $stmt->fetch()) : ?>
      <tr>
        <td><?php echo $search['name']; ?></td>
        <td><?php echo $search['author']; ?></td>
        <td><?php echo $search['year']; ?></td>
        <td><?php echo $search['genre']; ?></td>
        <td><?php echo $search['isbn']; ?></td>
      </tr>
    <?php endwhile; ?>
    </table>  
    <?php endif; ?>

    <?php if (!isset($_POST['search'])) : ?>
    <form method="POST">
        <input type="text" name="isbn" placeholder="ISBN" />
        <input type="text" name="name" placeholder="Название книги" />
        <input type="text" name="author" placeholder="Автор книги" />
        <input type="submit" name="search" value="Поиск" />
    </form><br>
    <table>
      <tr>
        <td>Название</td>
        <td>Автор</td>
        <td>Год выпуска</td>
        <td>Жанр</td>
        <td>ISBN</td>
      </tr>
    <?php foreach ($sql as $row): ?>
      <tr>  
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['author']; ?></td>
        <td><?php echo $row['year']; ?></td>
        <td><?php echo $row['genre']; ?></td>
        <td><?php echo $row['isbn']; ?></td>
      </tr>
    <?php endforeach; ?>
    </table>  
    <?php endif;?>
  </body>
</html>

