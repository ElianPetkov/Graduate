<?php

require_once '../config/includeClasses.php';

    session_start();
    // $password = $_GET['password'];
    $role = $_SESSION['role'];

   if($role == 'diploma') $select = "Select FN,Class,Curriculum,State,Last_change_date,Comment from Diploma";
   else if($role == 'sign') $select = "Select FN,Class,Curriculum,State,Last_change_date,Comment from Sign";
   else if($role == 'hat') $select = "Select FN,Class,Curriculum,State,Last_change_date,Comment from Hat";
   else if($role == 'gown') $select = "Select FN,Class,Curriculum,State,Last_change_date,Comment from Gown";
   else header("Location:../errorPage/404ErrorPage.html");
    $db = new Db();
    $conn = $db->getConnection();
    $statement = $conn->prepare($select);
    $statement->execute();
    $students = $statement->fetchAll();
    //print_r($students);


    if($_POST)
    {
        if(isset($_POST['state']))
        {   $state = $_POST['state'];
            $fn = $_POST['fn'];
            $task = $_POST['task'];
            $comment = $_POST['comment'];
            $t = new Student();
            $t->changeStateOFTask($fn,$state,$task,$comment);
        }
        header("Location: " . "http://" . $_POST['serverPath']);
    }

?>