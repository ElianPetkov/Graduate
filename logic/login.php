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
    }else {
              $isValid = false;
    }

    
}
?>