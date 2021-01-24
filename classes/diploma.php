<?php
require_once '../config/includeClasses.php';

class hat
{
    private $fn;
    private $class;
    private $curriculum;
    private $state;
    private $lastChangeDate;
    private $comment;
    private $db;


    public function getTasks($fn,$curriculum,$class)
    {
        $select = "Select * From diploma Where fn=? AND class=? AND curriculum=?";
        try {
            $conn = $this->db->getConnection();
            $statement = $conn->prepare($select);
            $statement->execute([$fn,$class,$curriculum]);
            return $statement->fetch();
        } catch (PDOException $error) {
            echo $error->getMessage();
            return;
        }
    }



    public function changeStateToDefault($class,$curriculum)
    {
            $update = "UPDATE diploma SET State = 'NotTaken' WHERE class = ? AND curriculum = ?";
            $conn = $this->db->getConnection();
            $statement = $conn->prepare($update);
            $statement->execute([$class,$curriculum]);
         
    }

    public function __construct()
    {
        $this->db = new Db();
    }

    public function initialize($fn,$class,$curriculum)
    {
        $tasksData = $this->getTasks($fn,$class,$curriculum);
        if(is_array($tasksData))
        {    
        $this->fn = $tasksData['FN'];
        $this->class = $tasksData['Class'];
        $this->curriculum = $tasksData['Curriculum'];
        $this->state = $tasksData['State'];
        $this->lastChangeDate = $tasksData['Last_change_date'];
        $this->comment = $tasksData['Comment'];
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