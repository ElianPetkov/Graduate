<?php
require_once '../config/includeClasses.php';

class Student
{
    private $fn;
    private $password;
    private $name;
    private $grade;
    private $class;
    private $degree;

    private $db;

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
        $this->name = $studentData['Name'];
        $this->grade = $studentData['Grade'];
        $this->class = $studentData['Class'];
        $this->degree = $studentData['Degree'];
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
}
