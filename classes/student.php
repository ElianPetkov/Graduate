<?php
require_once '../config/includeClasses.php';

class Student
{
    private $fn;
    private $password;
    private $firstName;
    private $lastName;
    private $faculty;
    private $group;
    private $curriculum;
    private $diplomaNumber;
    private $grade;
    private $class;
    private $degree;
    private $isParticipating;
    private $participationOrder;

    private $db;

    private function findStudentOrder()
    {
        $select = "SELECT COUNT(FN) AS number from student where Participation = 1";
        try {
            $conn = $this->db->getConnection();
            $statement = $conn->prepare($select);
            $statement->execute([]);
            $data = $statement->fetch();
            return $data['number'];
            
        } catch (PDOException $error) {
            echo $error->getMessage();
            return;
        }
    }

    private function setStudentOrder()
    {
        $studentOrder = $this->findStudentOrder();

        $update = "UPDATE student SET Participation_order =".$studentOrder. " WHERE student.FN =".$this->fn;
        $conn = $this->db->getConnection();
        $statement = $conn->prepare($update);
        $statement->execute([]);

        $this->participationOrder = $studentOrder;
    }

    public function getStudentOrder()
    {
        if(isset($this->participationOrder))
            return $this->participationOrder;
        else
        {
            $this->setStudentOrder();
            return $this->participationOrder;
        }

    }

    private function enrollAllTasks()
    {
        $insertDiploma = "INSERT INTO Diploma (FN, Class, Curriculum) VALUES (?,?,?)";
        $insertHat = "INSERT INTO Hat (FN, Class, Curriculum) VALUES (?,?,?)";
        $insertGown = "INSERT INTO Gown (FN, Class, Curriculum) VALUES (?,?,?)";
        $insertSign = "INSERT INTO Sign (FN, Class, Curriculum) VALUES (?,?,?)";
        $conn = $this->db->getConnection();
        $statement = $conn->prepare($insertDiploma);
        $statement->execute([$this->fn,$this->class,$this->curriculum]);

        $statement = $conn->prepare($insertHat);
        $statement->execute([$this->fn,$this->class,$this->curriculum]);

        $statement = $conn->prepare($insertGown);
        $statement->execute([$this->fn,$this->class,$this->curriculum]);

        $statement = $conn->prepare($insertSign);
        $statement->execute([$this->fn,$this->class,$this->curriculum]);
    }

    public function changeStateOfTask($fn,$state,$task)
    {
        if(strcmp($task, "Diploma" ) == 0) {   $update = "UPDATE Diploma SET State = ? WHERE FN = ?";}
        if(strcmp($task, "Sign" ) == 0) {   $update = "UPDATE Sign SET State = ? WHERE FN = ?";}
        if(strcmp($task, "Hat" ) == 0) {   $update = "UPDATE Hat SET State = ? WHERE FN = ?";}
        if(strcmp($task, "Gown" ) == 0) {   $update = "UPDATE Gown SET State = ? WHERE FN = ?";}
            $conn = $this->db->getConnection();
            $statement = $conn->prepare($update);
            $statement->execute([$state, $fn]);
         
    }


    //administration use for moving one student with fn to last order position for diplomas
    private function newOrderForDiplomas($fn)
    {
        $update = "UPDATE `student` SET `Participation_order` = `Participation_order`-1 
                    WHERE `Participation_order`> (SELECT Participation_order From student Where FN = ?)";

         $conn = $this->db->getConnection();
         $statement = $conn->prepare($update);
         $statement->execute([$fn]);

    }

    private function moveStudentLastInOrderForDiplomas($fn)
    {
        $update = "UPDATE student SET Participation_order = (SELECT COUNT(FN) from student where Participation = 1) WHERE student.FN = ?";

        $conn = $this->db->getConnection();
        $statement = $conn->prepare($update);
        $statement->execute([$fn]);

    }

    public function moveStudentToLastInOrder($fn)
    {
        $this->newOrderForDiplomas($fn);
        $this->moveStudentLastInOrderForDiplomas($fn);
    }


    public function enrollStudent($studentFn) {
        $update = "UPDATE `student` SET `Participation` = '1' WHERE FN = ?";
        $conn = $this->db->getConnection();
        $statement = $conn->prepare($update);
        $statement->execute([$studentFn]);
        $this->enrollAllTasks();

        $this->isParticipating = true;
    }

    public function getStudent($fn, $password)
    {
        $select = "Select * From Student Where fn=? AND password=?";
        try {
            $conn = $this->db->getConnection();
            $statement = $conn->prepare($select);
            $statement->execute([$fn, $password]);
            return $statement->fetch();
        } catch (PDOException $error) {
            echo $error->getMessage();
            return;
        }
    }

    public function createStudent($class,$curriculum, $grade, $firstName,$lastName,$faculty,$group,$degree,$password,$fn,$diplomaNumber)
    {
        $insert = "INSERT INTO `student` (`FN`, `Curriculum`, `Class`, `Student_group`, `Faculty`, `Degree`, `First_name`, `Last_name`, `Password`, `Diploma_number`, `Grade`) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
        $conn = $this->db->getConnection();
        $statement = $conn->prepare($insert);
        $statement->execute([$fn,$curriculum,$class,$group,$faculty,$degree,$firstName,$lastName,$password,$diplomaNumber,$grade]);
    }

    public function initialize($fn,$password)
    {
        $studentData = $this->getStudent($fn, $password);
        if(is_array($studentData))
        {    
        $this->fn = $studentData['FN'];
        $this->password = $studentData['Password'];
        $this->firstName = $studentData['First_name'];
        $this->lastName = $studentData['Last_name'];
        $this->group = $studentData['Student_group'];
        $this->faculty = $studentData['Faculty'];
        $this->curriculum = $studentData['Curriculum'];
        $this->grade = $studentData['Grade'];
        $this->class = $studentData['Class'];
        $this->degree = $studentData['Degree'];
        $this->isParticipating = $studentData['Participation'];
        if(isset($studentData['Participation_order']))
            $this->participationOrder = $studentData['Participation_order'];
        else
            $this->participationOrder = null;
        }
        else
        {
            throw new Exception("Student doesn't exists!");
        }
    }
    

    public function __construct()
    {
        $this->db = new Db();
    }

    public function getName() {
        return $this->name;
    }
    
    public function getGrade() {
        return $this->grade;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function getFN() {
        return $this->fn;
    }

    public function getClass() {
        return $this->class;
    }  

    public function getDegree() {
        return $this->degree;
    }

    public function getCurriculum() {
        return $this->curriculum;
    }
    public function getStudentFirstName() {
        return $this->firstName;
    }
    public function getStudentLastName() {
        return $this->lastName;
    }
    public function getIsParticipation() {
        return $this->isParticipating;
    }
}
