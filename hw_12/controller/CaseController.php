<?php
require_once 'model/CaseClass.php';

class CaseController 
{   
    function add() {
        $case = new CaseClass();
        $data = ['user_id' => $_SESSION['user_id'], 'assigned_user_id' => $_SESSION['user_id']];
        $errors = [];
        if (isset($_POST['description'])) {
            $data['description'] = $_POST['description'];
        } else {
            $errors['description'] = 'Не задано описание';
        }
        if (empty($errors)) {
            $isAdd = $case->addCase($data);
            if ($isAdd) {
                redirect('index.php');
            }
        }
        redirect('addcase.php');
    }
    
    function del() {
        $case = new CaseClass();
        $data = ['user_id' => $_SESSION['user_id'], 'id' => $_POST['delcase']];
        $case->delCase($data);
        redirect('index.php');
    }
    
    function  delegate() {
        $case = new CaseClass();
        $data = ['assigned_user_id' => $_POST['assigned_user_id'], 'id' => $_POST['task_id'], 'user_id' => $_SESSION['user_id']];
        $case->delegateCase($data);
        redirect('index.php');
    }
    
    function  success() {
        $case = new CaseClass();
        $data = ['user_id' => $_SESSION['user_id'], 'id' => $_POST['success']];
        $case->updateCase($data);
        redirect('index.php');
    }
}
