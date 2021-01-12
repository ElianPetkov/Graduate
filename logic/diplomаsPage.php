<?php

require_once '../config/includeClasses.php';

        $user = $_GET['user'];
        $password = $_GET['password'];
  

    $select = "Select FN,Diploma from Tasks";
    $db = new Db();
    $conn = $db->getConnection();
    $statement = $conn->prepare($select);
    $statement->execute();
    $students = $statement->fetchAll();
    //print_r($students);


?>