<?php
require_once '../config/includeClasses.php';
session_start();
if($_SESSION['role'] == 'admin')
{
if($_POST && $_POST['move-student-order'])
    {
        $fn = $_POST['Fn'];
        $student = new Student();
        $student->moveStudentToLastInOrder($fn);

        header("Location: " . "http://" . $_POST['serverPath']);
    }

    if($_POST && $_POST['change-date'])
    {
        $class = $_POST['class'];
        $curriculum = $_POST['curriculum'];
        $date = $_POST['dateTime'];
        $newDate = str_replace('T', ' ', $date) . ":00";

        $ceremony = new Ceremony();
        $ceremony->changeCeremonyDate($class,$curriculum,$newDate);
        header("Location: " . "http://" . $_POST['serverPath']);
    }
}
else{
    header("Location:../errorPage/404ErrorPage.html");
}