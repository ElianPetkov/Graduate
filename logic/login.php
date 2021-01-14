<?php

require_once '../config/includeClasses.php';


session_start();

$isValid = true;
if (!empty($_POST['user']) && !empty($_POST['password'])) {  
    $user = $_POST['user'];
    $password = $_POST['password'];

    $student = new Student();
    $studentData = $student->getStudent($user, $password);
    if(is_array($studentData))
    {
        $_SESSION['fn'] = $user;
        $_SESSION['name'] = $studentData['Name'];
        $_SESSION['password'] = $studentData['Password'];
        $_SESSION['grade'] = $studentData['Grade'];
        $_SESSION['class'] = $studentData['Class'];
        $_SESSION['degree'] = $studentData['Degree'];
        header("Location:../views/studentUI.php");
    }
    else if ($_POST['user'] == 'Diploma' && $_POST['password'] == '123456') {
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['user'] = 'Diploma';
        $_SESSION['name'] = 'Петър';
              
        header("Location:../views/diplomаsUI.php");
              //echo 'You have entered valid username and password';
    }else if($user == 'Sign' && $password == '123456'){
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['user'] = 'Sign';
        $_SESSION['name'] = 'Десислава';

        header("Location:../views/signsUI.php");
    }else if($user == 'Hat' && $password == '123456'){
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['user'] = 'Hat';
        $_SESSION['name'] = 'Валентин';

        header("Location:../views/hatsUI.php");
    }else if($user == 'Gown' && $password == '123456'){
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['user'] = 'Gown';
        $_SESSION['name'] = 'Мария';

        header("Location:../views/gownsUI.php");
    }else if($user == 'admin' && $password == 'admin'){
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['user'] = 'admin';
        $_SESSION['name'] = 'Администратор';

        header("Location:../views/administration.php");
    }
    else {
              $isValid = false;
    }

    
}
?>