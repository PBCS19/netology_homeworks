<?php
require_once 'db.php';

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
