<?php
require_once '../config/includeClasses.php';

session_start();
if($_SESSION['role'] == 'student')
{    function isCeremonyOver($ceremonyDate)
    {

        $partsOfTodayDate = explode('-', date("Y-m-d"));
        $partsOfCeremonyDate = explode('-', $ceremonyDate);

        $equalsYears = intval($partsOfTodayDate[0]) == intval($partsOfCeremonyDate[0]);
        $equalsMonths = intval($partsOfTodayDate[1]) == intval($partsOfCeremonyDate[1]);

        if (intval($partsOfTodayDate[0]) > intval($partsOfCeremonyDate[0])) {
            return 1;
        } else if ($equalsYears && intval($partsOfTodayDate[1]) > intval($partsOfCeremonyDate[1])) {
            return 1;
        } else if ($equalsYears && $equalsMonths && intval($partsOfTodayDate[2]) > intval($partsOfCeremonyDate[2])) {
            return 1;
        }

        return 0;
    }

    if ($_POST) {
        $fn = $_SESSION['fn'];
        $class = $_SESSION['class'];
        $task = new Tasks();
        $studentIsEnrolled;

        if (!$task->isStudentEnroll($fn, $class)) {
            $task->enrollStudent($fn,$class);
        }

        header("Location: " . "http://" . $_POST['serverPath']);

    } else {
        //$fn = $_SESSION["fn"];
        $password = $_SESSION["password"];

        
        /*$student = new Student();
        try {
            $student->initialize($fn, $password);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $studentName = $student->getName();
        $studentClass = $student->getClass();
        $studentFN = $student->getFN();
    */
        $studentName = $_SESSION['name'];
        $studentClass = $_SESSION['class'];
        $studentFN = $_SESSION['fn'];
        $studentDegree = $_SESSION['degree'];

        $ceremony = new Ceremony();
        try{
        $ceremony->initialize($studentClass, $studentDegree);
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    

        $ceremonyDate = $ceremony->getDate();
        if (isCeremonyOver($ceremonyDate)) {
            $errorMessage = "Церемонията е приключила на " . explode(" ", $ceremonyDate)[0] . " !";
            $isCeremonyOver = true;
        } else {
            $isCeremonyOver = false;
            $address = $ceremony->getAddress();
        }

        $task = new Tasks();
        $studentIsEnrolled = $task->isStudentEnroll($studentFN, $studentClass);
    }
}else{
    header("Location:../errorPage/404ErrorPage.html");
}