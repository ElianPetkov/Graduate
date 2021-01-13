<?php
require_once '../config/includeClasses.php';


class Ceremony
{
    private $class;
    private $degree;
    private $address;
    private $date;
    private $db;


    public function getCeremony($class, $degree)
    {
        $select = "Select * From Ceremony Where class=? AND degree=?";
        try {
            $conn = $this->db->getConnection();
            $statement = $conn->prepare($select);
            $statement->execute([$class, $degree]);
            return $statement->fetch();
        } catch (PDOException $error) {
            echo $error->getMessage();
            return;
        }
    }

    public function initialize($class, $degree)
    {
        $ceremonyData = $this->getCeremony($class, $degree);
        if(is_array($ceremonyData))
        {    
        $this->class = $ceremonyData['Class'];
        $this->degree = $ceremonyData['Degree'];
        $this->address = $ceremonyData['Address'];
        $this->date = $ceremonyData['Date'];
        }
        else
        {
            throw new Exception("Ceremony doesn't exists!");
        }
    }

    public function makeCeremony($class, $address, $dateTime, $degree)
    {
        $insert = "INSERT INTO ceremony (Class,Address,Date,Degree) VALUES (?,?,?,?)";
        $conn = $this->db->getConnection();
        $statement = $conn->prepare($insert);
        $statement->execute([$class,$address,$dateTime,$degree]);
    }

    public function __construct()
    {
        $this->db = new Db();
    }

    public function getClass() {
        return $this->class;
    }

    public function getDegree() {
        return $this->degree;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getDate() {
        return $this->date;
    }
}

?>