<?php
require_once '../config/includeClasses.php';

class Tasks
{
    private $fn;
    private $diploma;
    private $sign;
    private $hat;
    private $grown;
    private $db;

    public function getTasks($fn)
    {
        $select = "Select * From Tasks Where fn=?";
        try {
            $conn = $this->db->getConnection();
            $statement = $conn->prepare($select);
            $statement->execute([$fn]);
            return $statement->fetch();
        } catch (PDOException $error) {
            echo $error->getMessage();
            return;
        }
    }

    public function __construct($fn)
    {
        $this->db = new Db();
        $tasksData = $this->getTasks($fn);
        if(is_array($tasksData))
        {    
        $this->fn = $tasksData['FN'];
        $this->diploma = $tasksData['Diploma'];
        $this->sign = $tasksData['Sign'];
        $this->hat = $tasksData['Hat'];
        $this->grown = $tasksData['Grown'];
        }
        else
        {
            throw new Exception("Student with tasks doesn't exists!");
        }
    }

    public function getFN() {
        return $this->fn;
    }

    public function getDiploma() {
        return $this->diploma;
    }  

    public function getSign() {
        return $this->sign;
    }

    public function getHat() {
        return $this->hat;
    }

    public function getGrown() {
        return $this->grown;
    }
}