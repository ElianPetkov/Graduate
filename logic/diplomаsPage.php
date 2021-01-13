<?php

require_once '../config/includeClasses.php';

       // $user = $_GET['user'];
       // $password = $_GET['password'];
  

    $select = "Select FN,Class,Diploma from Tasks";
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