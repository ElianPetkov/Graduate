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
        //проверка дали студента е записан ако не е се записва в задачите
        $fn = $_SESSION['fn'];
        $password = $_SESSION['password'];

        $student = new Student();
        $student->initialize($fn,$password);
        $class = $student->getClass();

        $isStudentEnrolledToCeremony = $student->getIsParticipation();

        if (!$isStudentEnrolledToCeremony) {
            //TODO enroll in all tasks
            //And give order number
            $student->enrollStudent($fn);
        }

        header("Location: " . "http://" . $_POST['serverPath']);
    } else {
        $fn = $_SESSION['fn'];
        $password = $_SESSION['password'];

        $student = new Student();
        $student->initialize($fn,$password);
        $studentClass = $student->getClass();

        /*variables used in UI*/
        $studentFistName = $student->getStudentFirstName();
        $studentLastName = $student->getStudentLastName();
        /**/

        $ceremony = new Ceremony();
        try {
            $ceremony->initialize($studentClass, $student->getCurriculum());
        } catch (Exception $e) {
            echo $e->getMessage();
        }


        $ceremonyDate = $ceremony->getDate();
        if (isCeremonyOver($ceremonyDate)) {
            $errorMessage = "Церемонията е приключила на " . explode(" ", $ceremonyDate)[0] . " !";
            $isCeremonyOver = true;
        } else {
            $isCeremonyOver = false;
            /*variables used in UI*/
            $googleLink = $ceremony->getGoogleLink();
            $address = $ceremony->getAddress();
            /**/
        }

       
        $isStudentEnrolledToCeremony = $student->getIsParticipation();

        //оптимизации за ред на студента и ориентировачно време
        //$studentOrder = $task->getStudentOrder($studentClass, $fn);
        //$timeToTakeDiplomaStudent = studentWillGetDiplomaAt($ceremonyDate, $studentOrder);
    }
} else {
    header("Location:../errorPage/404ErrorPage.html");
}
