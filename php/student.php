<?php
require 'ConnectionDB.php';

class Student
{
    private $fn;
    private $password;
    private $name;
    private $grade;
    //private $email;
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

    public function __construct($fn, $password)
    {
        $this->db = new Db();
        $studentData = $this->getStudent($fn, $password);
        if(is_array($studentData))
        {    
        $this->fn = $studentData['FN'];
        $this->password = $studentData['Password'];
        $this->name = $studentData['Name'];
        $this->grade = $studentData['Grade'];
        }
        else
        {
            throw new Exception("Student doesn't exists!");
        }
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
}
