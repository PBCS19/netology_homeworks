<?php
session_start();
require_once 'function.php';
if (empty($_SESSION['user_id'])) {
    redirect('login.php');
}
prepExpr($pdo, 
        "INSERT INTO task (user_id, assigned_user_id, description) VALUES (:user_id, :assigned_user_id, :description)", 
        ['user_id' => $_SESSION['user_id'], 'assigned_user_id' => $_SESSION['user_id'], 'description' => $_POST['description']]);
redirect('index.php');
?>



