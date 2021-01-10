<?php
    require 'student.php';

    $fn = $_GET["fn"];
    $password = $_GET["password"];

    try
    {   
    $student = new Student($fn, $password);
    echo $student->getName() . " " . $student->getFN() . " " . $student->getGrade() . " " . $student->getPassword(). "HELLO IT'S MEEEE" ;
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }

?>