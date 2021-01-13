<?php
require_once '../config/includeClasses.php';

class Tasks
{
    private $fn;
    private $class;
    private $diploma;
    private $sign;
    private $hat;
    private $grown;
    private $db;

    public function getTasks($fn,$class)
    {
        $select = "Select * From Tasks Where fn=? AND class=?";
        try {
            $conn = $this->db->getConnection();
            $statement = $conn->prepare($select);
            $statement->execute([$fn,$class]);
            return $statement->fetch();
        } catch (PDOException $error) {
            echo $error->getMessage();
            return;
        }
    }

    public function isStudentEnroll($fn,$class)
    {
        return is_array($this->getTasks($fn,$class));
    }

    public function enrollStudent($fn,$class)
    {
        $insert = "INSERT INTO tasks (FN, Class) VALUES (?,?)";
        $conn = $this->db->getConnection();
        $statement = $conn->prepare($insert);
        $statement->execute([$fn, $class]);
    }

    public function changeState($fn,$class,$state,$task)
    {
        if(strcmp($task, "Diploma" ) == 0) {   $update = "UPDATE tasks SET Diploma = ? WHERE FN = ? AND Class = ?";}
        if(strcmp($task, "Sign" ) == 0) {   $update = "UPDATE tasks SET Sign = ? WHERE FN = ? AND Class = ?";}
        if(strcmp($task, "Hat" ) == 0) {   $update = "UPDATE tasks SET Hat = ? WHERE FN = ? AND Class = ?";}
        if(strcmp($task, "Grown" ) == 0) {   $update = "UPDATE tasks SET Grown = ? WHERE FN = ? AND Class = ?";}
            $conn = $this->db->getConnection();
            $statement = $conn->prepare($update);
            $statement->execute([$state, $fn, $class]);
         
    }

    public function __construct()
    {
        $this->db = new Db();
    }

    public function initialize($fn,$class)
    {
        $tasksData = $this->getTasks($fn,$class);
        if(is_array($tasksData))
        {    
        $this->fn = $tasksData['FN'];
        $this->class = $tasksData['Class'];
        $this->diploma = $tasksData['Diploma'];
        $this->sign = $tasksData['Sign'];
        $this->hat = $tasksData['Hat'];
        $this->grown = $tasksData['Grown'];
        }
        else
        {
            throw new Exception("No tasks is found for this student !");
        }
    }

    public function getFN() {
        return $this->fn;
    }

    public function getClass() {
        return $this->class;
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