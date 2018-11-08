<?php
$dbname = 'vkostarev';
try {
    $pdo = new PDO("mysql:host=localhost;dbname=$dbname;charset=utf8", "vkostarev", "neto1910");
} catch (PDOException $e) {
    echo 'Error!: ' . $e->getMessage() . '<br>';
    exit();
}

