<?php
require_once '../config/includeClasses.php';
session_start();
if ($_SESSION['role'] == 'admin') {

    function filterData(&$str)
    {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }

    if ($_POST && isset($_POST['export'])) {
        $class = $_POST['class'];
        $curriculum = $_POST['curriculum'];

        $task = $_POST['task'];
        $statement;

        switch ($task) {
            case 'hat':
                $hat = new Hat();
                $statement = $hat->getTasksForCeremony($curriculum, $class);
                break;
            case 'gown':
                $gown = new Gown();
                $statement = $gown->getTasksForCeremony($curriculum, $class);
                break;
            case 'sign':
                $sign = new sign();
                $statement = $sign->getTasksForCeremony($curriculum, $class);
                break;
            case 'diploma':
                $diploma = new diploma();
                $statement = $diploma->getTasksForCeremony($curriculum, $class);
                break;
            default:
                echo "NO such task to be exported from db, available are hat,gown,sign,diploma";
        }

        header("Content-Type: application/octet-stream");
        header("Content-Transfer-Encoding: binary");
        header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Content-Disposition: attachment; filename = '."Table for ".$task ." exported " . date("Y-m-d") .".csv");
        header('Pragma: no-cache');



        $flag = false;
        $data = $statement->fetchAll();

        foreach ($data as $row) {
            if (!$flag) {
                // display field/column names as first row
                echo implode("\t", array_keys($row)) . "\r\n";
                $flag = true;
            }
            array_walk($row, __NAMESPACE__ . 'filterData');
            echo implode("\t", array_values($row)) . "\r\n";
        }
    }

    if ($_POST && isset($_POST['move-student-order'])) {
        $fn = $_POST['Fn'];
        $student = new Student();
        $student->moveStudentToLastInOrder($fn);

        header("Location: " . "http://" . $_POST['serverPath']);
    }

    if ($_POST && isset($_POST['change-date'])) {
        $class = $_POST['class'];
        $curriculum = $_POST['curriculum'];
        $date = $_POST['dateTime'];
        $newDate = str_replace('T', ' ', $date) . ":00";

        $ceremony = new Ceremony();
        $ceremony->changeCeremonyDate($class, $curriculum, $newDate);
        header("Location: " . "http://" . $_POST['serverPath']);
    }

    if ($_POST && isset($_POST['reset'])) {

        $class = $_POST['class'];
        $curriculum = $_POST['curriculum'];

        $hat = new Hat();
        $hat->changeStateToDefault($class, $curriculum);

        $gown = new Gown();
        $gown->changeStateToDefault($class, $curriculum);

        $diploma = new diploma();
        $diploma->changeStateToDefault($class, $curriculum);

        $sign = new Sign();
        $sign->changeStateToDefault($class, $curriculum);

        header("Location: " . "http://" . $_POST['serverPath']);
    }

} else {
    header("Location:../errorPage/404ErrorPage.html");
}
