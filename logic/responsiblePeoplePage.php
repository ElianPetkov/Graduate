<?php

require_once '../config/includeClasses.php';

    session_start();
    // $password = $_GET['password'];
    $role = $_SESSION['role'];

   if($role == 'diploma') $select = "Select FN,Class,Diploma from Tasks";
   else if($role == 'sign') $select = "Select FN,Class,Sign from Tasks";
   else if($role == 'hat') $select = "Select FN,Class,Hat from Tasks";
   else if($role == 'gown') $select = "Select FN,Class,Gown from Tasks";
   else header("Location:../errorPage/404ErrorPage.html");
    $db = new Db();
    $conn = $db->getConnection();
    $statement = $conn->prepare($select);
    $statement->execute();
    $students = $statement->fetchAll();
    //print_r($students);


    if($_POST)
    {
        $state = $_POST['state'];
        $fn = $_POST['fn'];
        $task = $_POST['task'];
        $class = $_POST['class'];
        $t = new Tasks();
        $t->changeState($fn,$class, $state,$task);
        header("Location: " . "http://" . $_POST['serverPath']);
    }

?>