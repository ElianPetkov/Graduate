<?php
require_once '../config/includeClasses.php';

session_start();
if ($_SESSION['role'] == 'student') {

    function isCeremonyOver($ceremonyDate)
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

    function studentWillGetDiplomaAt($ceremonyDate, $orderOfStudent)
    {
        $timeAdded = $orderOfStudent * 2;
        $dateTime = new DateTime($ceremonyDate);
        $dateTime->modify("+ " . $timeAdded . "minutes");
        $HourAndMinutes = $dateTime->format('H:i');
        return $HourAndMinutes;
    }

    if ($_POST) {
        $fn = $_SESSION['fn'];
        $class = $_SESSION['class'];
        $task = new Tasks();
        $studentIsEnrolled;

        if (!$task->isStudentEnroll($fn, $class)) {
            $task->enrollStudent($fn, $class);
        }

        header("Location: " . "http://" . $_POST['serverPath']);
    } else {
        $password = $_SESSION["password"];
        $studentName = $_SESSION['name'];
        $studentClass = $_SESSION['class'];
        $studentFN = $_SESSION['fn'];
        $studentDegree = $_SESSION['degree'];

        $ceremony = new Ceremony();
        try {
            $ceremony->initialize($studentClass, $studentDegree);
        } catch (Exception $e) {
            echo $e->getMessage();
        }


        $ceremonyDate = $ceremony->getDate();
        if (isCeremonyOver($ceremonyDate)) {
            $errorMessage = "Церемонията е приключила на " . explode(" ", $ceremonyDate)[0] . " !";
            $isCeremonyOver = true;
            exit;
        } else {
            $isCeremonyOver = false;
            $address = $ceremony->getAddress();
        }

        $task = new Tasks();
        $studentIsEnrolled = $task->isStudentEnroll($studentFN, $studentClass);

        $studentOrder = $task->getStudentOrder($studentClass, $studentFN);
        $timeToTakeDiplomaStudent = studentWillGetDiplomaAt($ceremonyDate, $studentOrder);
    }
} else {
    header("Location:../errorPage/404ErrorPage.html");
}
