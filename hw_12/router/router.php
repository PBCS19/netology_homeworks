<?php
session_start();
require_once 'controller/AuthController.php';
require_once 'controller/CaseController.php';

if (!empty($_COOKIE['ban'])) {
    http_response_code(403);
    exit('Подождите часок, мы вас заблокировали, а затем попробуйте снова');
}

if (empty($_SESSION['user_id'])) {
    if (! isset($_GET['c']) || ! isset($_GET['a'])) {
        $controller = 'guest';
        $action = 'not';
    } else {
        $controller = $_GET['c'];
        $action = $_GET['a'];
    }
} else {
    if (! isset($_GET['c']) || ! isset($_GET['a'])) {
        $controller = 'user';
        $action = 'index';
    } else {
        $controller = $_GET['c'];
        $action = $_GET['a'];
    }
}

if ($controller == 'guest') {
    $auth = new AuthController();
    if ($action == 'not') {
        $auth->getIndexNotAutorized();
    } elseif ($action == 'auth') {
        $auth->auth();
    } elseif ($action == 'signup') {
        $auth->signup();
    }
} elseif ($controller == 'case') {
    $case = new CaseController();
    if ($action == 'add') {
        $case->add();
    } elseif ($action == 'del') {
        $case->del();
    } elseif ($action == 'delegate') {
        $case->delegate();
    } elseif ($action == 'success') {
        $case->success();
    }    
} elseif ($controller == 'user') {
    $auth = new AuthController();
    if ($action == 'logout') {
        $auth->logout();
    } elseif ($action == 'index') {
        $case = new CaseClass();
        $assignedUserList = $case->selectUser();
        $stmt = $case->assignedUser();
        $stmtDelegate = $case->selectDelegate();
        $count = $case->countCase();
        require_once 'view/index.php';
    }
}