<?php
require_once '../config/includeClasses.php';

    if($_POST && isset($_POST['ceremony']))
    {
        $class = $_POST['class'];
        $degree = $_POST['degree'];
        $address = $_POST['address'];
        $dateTime = $_POST['dateTime'];
        $newDate = str_replace('T', ' ', $dateTime).":00";

        $ceremony = new Ceremony();
        $ceremony->makeCeremony($class,$address,$newDate,$degree);

    }

    if($_POST && isset($_POST['student']))
    {
        $class = $_POST['class'];
        $degree = $_POST['degree'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $grade = $_POST['grade'];
        $fn = $_POST['fn'];

        $student = new Student();
        $student->createStudent($class,$grade,$name,$degree,$password,$fn);
    }