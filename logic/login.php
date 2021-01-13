<?php

require_once '../config/includeClasses.php';


session_start();


if (!empty($_POST['user']) && !empty($_POST['password'])) {  
    
    if ($_POST['user'] == 'Diploma' && $_POST['password'] == '123456') {
              $_SESSION['valid'] = true;
              $_SESSION['timeout'] = time();
              $_SESSION['user'] = 'Diploma';
              
              header("Location:../views/diplomаsUI.php");
              //echo 'You have entered valid username and password';
    }else {
              echo 'Wrong username or password';
    }
}
?>