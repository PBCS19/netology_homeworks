<?php
require_once 'model/AuthClass.php';
class AuthController 
{
    function getIndexNotAutorized() {
        require_once 'view/notAutorized.php';
    }
    
    function auth() {
        $log = isset($_POST['login']) ? $_POST['login'] : '';
        $pas = isset($_POST['password']) ? $_POST['password'] : '';
        $errors = $this->loginPass($log,$pas);
        $this->checkErrorsAuth($errors);
    }
    
    function signup() {
        $errors = $this->registration();
        $this->checkErrorsSignup($errors);
    }
    
    function index() {
        $case = new CaseClass();
        $assignedUserList = $case->selectUser();
        $stmt = $case->assignedUser();
        $stmtDelegate = $case->selectDelegate();
        $count = $case->countCase();
        require_once 'view/index.php';
    }
            
    function loginPass($login, $password) {
        $errors = [];
        if (!empty($login) && !empty($password)) {
            $auth = new AuthClass;
            $login = $auth->checkLoginPass([$login, $password]);
            if (!$login['id']) {
                $errors[] = 'Не верный логин или пароль!';
            }
        } else {
            $errors[] = 'Введите логин или пароль!';
        }
        if (!empty($errors)) {
            return $errors;
        } else {
            $_SESSION['user_id'] = $login['id'];
        }
    }
    
    function registration() {
        $errors = [];
        if (empty($_POST['login'])) {
            $errors[] = 'Введите логин';
        } elseif (empty($_POST['password'])) {
            $errors[] = 'Введите пароль';
        } elseif ($_POST['password'] !== $_POST['password_2'] || empty($_POST['password_2'])) {
            $errors[] = 'Пароли не совпадают';
        } else {
            $auth = new AuthClass;
            $login = $auth->checkUser([$_POST['login']]);
            if ($login['id']) {
                $errors[] = 'Такой логин существует!';
            }
        }
        if (!empty($errors)) {
            return $errors;
        } else {
            $auth->regUser(['login' => $_POST['login'], 'password' => $_POST['password']]); 
            redirect('index.php');
            exit();
        }
    } 
    
    function checkErrorsAuth($errors) {
        if (!empty($errors)) {
            $auth = new AuthClass();
            if (!isset($_SESSION['countCaptcha']) || $_SESSION['countCaptcha'] < 6) {
                $count = isset($_SESSION['countCaptcha']) ? $_SESSION['countCaptcha'] : 0;
                $auth->countCaptcha($count);
                require_once 'view/login.php';
            } elseif($_SESSION['countCaptcha'] >= 6 && $_SESSION['countCaptcha'] < 12) {
                $auth->countCaptcha($_SESSION['countCaptcha']);
                if (isset($_POST['g-recaptcha-response'])) {
                    $auth->checkGoogleCaptcha($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
                }
                require_once 'view/loginCaptcha.php';
            } else {
                setcookie('ban','бан на 1 час', time()+3600);
                http_response_code(403);
                exit('Подождите часок, мы вас заблокировали, а затем попробуйте снова');
            }    
        } else {
            redirect('index.php');
        }
    }
    
    function checkErrorsSignup($errors) {
        if (!empty($errors)) {
            require_once 'view/signup.php';
        } else {
            require_once 'view/login.php';
        }
    }
    
    function logout() {
        session_destroy();
        redirect('index.php');
        exit();
    }
}
