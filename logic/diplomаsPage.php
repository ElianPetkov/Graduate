<?php

require_once '../config/includeClasses.php';


    try{
        $user = $_GET['user'];
        $password = $_GET['password'];
    }catch(Exception $e){
       echo $e->getMessage();
    }

    $select = "Select FN,Diploma from Tasks";
    $db = new Db();
    $conn = $db->getConnection();
    $statement = $conn->prepare($select);
    $statement->execute();
    $students = $statement->fetchAll();
    //print_r($students);


?>