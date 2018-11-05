<?php
session_start();
require_once 'function.php';
if (empty($_SESSION['user_id'])) {
    redirect('index.php');
    exit();
}
prepExpr($pdo, 
        "UPDATE task SET assigned_user_id=:assigned_user_id WHERE id=:id AND user_id=:user_id", 
        ['assigned_user_id' => $_POST['assigned_user_id'], 'id' => $_POST['task_id'], 'user_id' => $_SESSION['user_id']]);
redirect('index.php');

