<?php
require_once '../config/includeClasses.php';
session_start();
if($_SESSION['role'] == 'admin')
{
    if ($_POST && isset($_POST['ceremony'])) {
        $class = $_POST['class'];
        $degree = $_POST['degree'];
        $address = $_POST['address'];
        $dateTime = $_POST['dateTime'];
        $newDate = str_replace('T', ' ', $dateTime) . ":00";

        $ceremony = new Ceremony();
        $ceremony->makeCeremony($class, $address, $newDate, $degree);
    }

    if ($_POST && isset($_POST['student'])) {
        $class = $_POST['class'];
        $degree = $_POST['degree'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $grade = $_POST['grade'];
        $fn = $_POST['fn'];

        $student = new Student();
        $student->createStudent($class, $grade, $name, $degree, $password, $fn);
    }

    function enrollStudent($data)
    {
                $containerForCVSData = array(0=>"", 1=>"", 2=>"",3=>"",4=>"",5=>"");//0->fn,1->name,2->password,3->class,4->grade,5->degree
                $numberOfCharactersOnCurrentLine = count($data);
                $fieldsArrayCounter = 0;
                for ($currentCharacter = 0; $currentCharacter < $numberOfCharactersOnCurrentLine; $currentCharacter++) {
                        $containerForCVSData[$fieldsArrayCounter] = $data[$currentCharacter];
                        $fieldsArrayCounter++;
                }
                $student = new Student();
                $student->createStudent($containerForCVSData[3],$containerForCVSData[4],
                                        $containerForCVSData[1],$containerForCVSData[5],
                                        $containerForCVSData[2],$containerForCVSData[0]);//optimize
    }

    if ($_POST && isset($_POST['serverPath'])) {
        $skipFirstTwoLinesFromFile = 0;
        if (($handle = fopen($_FILES['file']['tmp_name'], "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $skipFirstTwoLinesFromFile++;
                if($skipFirstTwoLinesFromFile <= 2)
                {
                    continue;
                }

                enrollStudent($data);
            }
            fclose($handle);
        }
        header("Location: " . "http://" . $_POST['serverPath']);
    }
}
else{
    header("Location:../errorPage/404ErrorPage.html");
}