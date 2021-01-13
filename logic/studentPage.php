<?php
require_once '../config/includeClasses.php';

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

if ($_POST) {
    $fn = $_POST['fn'];
    $class = $_POST['class'];
    $task = new Tasks();
    $studentIsEnrolled;

    if (!$task->isStudentEnroll($fn, $class)) {
        $task->enrollStudent($fn,$class);
    }

    header("Location: " . "http://" . $_POST['serverPath']);

} else {
    $fn = $_GET["fn"];
    $password = $_GET["password"];

    try {
        $student = new Student($fn, $password);
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    $studentName = $student->getName();
    $studentClass = $student->getClass();
    $studentFN = $student->getFN();

    try {
        $ceremony = new Ceremony($student->getClass(), $student->getDegree());
    } catch (Exception $e) {
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
    $studentIsEnrolled = $task->isStudentEnroll($fn, $studentClass);
}
