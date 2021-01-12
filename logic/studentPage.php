<?php
    require_once '../config/includeClasses.php';


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

    $ceremony = new Ceremony($student->getClass(),$student->getDegree());
    var_dump($ceremony);
    if(isset($ceremony))
    {


    }



?>