<?php
require_once '../config/includeClasses.php';
session_start();
if($_SESSION['role'] == 'admin')
{
    if ($_POST && isset($_POST['ceremony'])) {
        $class = $_POST['class'];
        $address = $_POST['address'];
        $googleLink = $_POST['google-maps-link'];
        $capacity = $_POST['capacity'];
        $duration = $_POST['duration'];
        $curriculum = $_POST['curriculum'];
        $dateTime = $_POST['dateTime'];
        $newDate = str_replace('T', ' ', $dateTime) . ":00";

        $ceremony = new Ceremony();
        $ceremony->makeCeremony($class,$curriculum, $address, $dateTime,$googleLink,$duration,$capacity);
        header("Location: " . "http://" . $_POST['serverPath']);
    }

    if ($_POST && isset($_POST['student'])) {
        $class = $_POST['class'];
        $degree = $_POST['degree'];

        $password = $_POST['password'];
        $hashPassword = hash("sha256",$password);

        $grade = $_POST['grade'];
        $fn = $_POST['fn'];
        if(isset($_POST['diplomaNumber']))
            $diplomaNumber = $_POST['diplomaNumber'];
        else
            $diplomaNumber = null;
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $faculty = $_POST['faculty'];
        $group = $_POST['group'];
        $curriculum = $_POST['curriculum'];

        $student = new Student();
        $student->createStudent($class,$curriculum, $grade, $firstName,$lastName,$faculty,$group,$degree,$hashPassword,$fn,$diplomaNumber);
        header("Location: " . "http://" . $_POST['serverPath']);
    }

    function enrollStudent($data)
    {
                $containerForCVSData = array(0=>"", 1=>"", 2=>"",3=>"",4=>"",5=>"",6=>"",7=>"",8=>"",9=>"",10=>"");//0->fn,1->firstName,2->lastName,3->password,4->class,5->grade,6->Degree,7->faculty,8->group,9->curriculum,10->diploma number
                $numberOfCharactersOnCurrentLine = count($data);
                $fieldsArrayCounter = 0;
                for ($currentCharacter = 0; $currentCharacter < $numberOfCharactersOnCurrentLine; $currentCharacter++) {
                        $containerForCVSData[$fieldsArrayCounter] = $data[$currentCharacter];
                        $fieldsArrayCounter++;
                }
                $student = new Student();
                $hashPassword = hash("sha256",$containerForCVSData[3]);
                $student->createStudent($containerForCVSData[4],$containerForCVSData[9],$containerForCVSData[5],$containerForCVSData[1],$containerForCVSData[2],
                                        $containerForCVSData[7],$containerForCVSData[8],$containerForCVSData[6],$hashPassword,$containerForCVSData[0],
                                        $containerForCVSData[10]);
    }

    if ($_POST && isset($_POST['file'])) {
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