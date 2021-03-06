<?php

require_once '../config/includeClasses.php';


session_start();

$isValid = true;
if (!empty($_POST['user']) && !empty($_POST['password'])) {  
    $user = $_POST['user'];
    $password = hash("sha256",$_POST['password']);

    $student = new Student();
    $studentData = $student->getStudent($user, $password);
    if(is_array($studentData))
    {
        $_SESSION['fn'] = $user;
        $_SESSION['password'] = $studentData['Password'];
        $_SESSION['role'] = "student";
        header("Location:../views/studentUI.php");
    }
    else if ($_POST['user'] == 'Diploma' && $_POST['password'] == '123456') {
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['user'] = 'Diploma';
        $_SESSION['name'] = 'Петър';
        $_SESSION['role'] = "diploma"; 
        $_SESSION['Class'] = '2021';
        $_SESSION['Curriculum'] = 'КН';    
        header("Location:../views/diplomаsUI.php");
    }else if($user == 'Sign' && $_POST['password'] == '123456'){
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['user'] = 'Sign';
        $_SESSION['name'] = 'Десислава';
        $_SESSION['role'] = "sign"; 
        $_SESSION['Class'] = '2021';
        $_SESSION['Curriculum'] = 'КН';
        header("Location:../views/signsUI.php");
    }else if($user == 'Hat' && $_POST['password'] == '123456'){
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['user'] = 'Hat';
        $_SESSION['name'] = 'Валентин';
        $_SESSION['role'] = "hat"; 
        $_SESSION['Class'] = '2021';
        $_SESSION['Curriculum'] = 'КН';
        header("Location:../views/hatsUI.php");
    }else if($user == 'Gown' && $_POST['password'] == '123456'){
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['user'] = 'Gown';
        $_SESSION['name'] = 'Мария';
        $_SESSION['role'] = "gown";
        $_SESSION['Class'] = '2021';
        $_SESSION['Curriculum'] = 'КН';
        header("Location:../views/gownsUI.php");
    }else if($user == 'admin' && $_POST['password'] == 'admin'){
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['user'] = 'admin';
        $_SESSION['name'] = 'Администратор';
        $_SESSION['role'] = "admin";
        $_SESSION['Class'] = '2021';
        $_SESSION['Curriculum'] = 'КН';
        header("Location:../views/administrationEnrollStudentsAndCeremoniesUI.php");
    }
    else {
              $isValid = false;
    }

    
}
?>