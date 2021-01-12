<?php
    require '../classes/student.php';

    try
    {   
    $fn = $_GET["fn"];
    $password = $_GET["password"];
    $student = new Student($fn, $password);
    $studentName = $student->getName();
    //require_once("../views/studentPage.php");

    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }

?>