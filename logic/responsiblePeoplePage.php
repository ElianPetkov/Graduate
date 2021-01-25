<?php

require_once '../config/includeClasses.php';

    session_start();
    $role = $_SESSION['role'];

   if($role == 'diploma') $select = "Select FN,State,Last_change_date,Comment from Diploma where Class = ? AND Curriculum = ?";
   else if($role == 'sign') $select = "Select FN,State,Last_change_date,Comment from Sign where Class = ? AND Curriculum = ?";
   else if($role == 'hat') $select = "Select FN,State,Last_change_date,Comment from Hat where Class = ? AND Curriculum = ?";
   else if($role == 'gown') $select = "Select FN,State,Last_change_date,Comment from Gown where Class = ? AND Curriculum = ?";
   else header("Location:../errorPage/404ErrorPage.html");
    $db = new Db();
    $conn = $db->getConnection();
    $statement = $conn->prepare($select);
    $statement->execute([$_SESSION['Class'], $_SESSION['Curriculum']]);
    $students = $statement->fetchAll();


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