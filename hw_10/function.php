<?php
require_once 'db.php';
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

function redirect($location) {
    header("Location: $location");
    exit();
}

function prepExpr($pdo, $expression, $login) {
    $stmt = $pdo->prepare($expression);
    $stmt->execute($login);
    return $stmt->fetch();
}

function logout() {
    session_destroy();
    redirect('../index.php');
    exit();
}
