<?php
session_start();
require_once 'function.php';
if (empty($_SESSION['user_id'])) {
    redirect('login.php');
}
prepExpr($pdo, 
        "DELETE FROM task WHERE user_id=:user_id AND id=:id LIMIT 1", 
        ['user_id' => $_SESSION['user_id'], 'id' => $_POST['delcase']]);
redirect('index.php');

