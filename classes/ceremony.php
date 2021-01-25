<?php
require_once '../config/includeClasses.php';


class Ceremony
{
    private $class;
    private $curriculum;
    private $googleLink;
    private $duration;
    private $address;
    private $date;
    private $capacity;

    private $db;


    public function getCeremony($class, $Curriculum )
    {
        $select = "Select * From Ceremony Where class=? AND Curriculum=?";
        try {
            $conn = $this->db->getConnection();
            $statement = $conn->prepare($select);
            $statement->execute([$class, $Curriculum ]);
            return $statement->fetch();
        } catch (PDOException $error) {
            echo $error->getMessage();
            return;
        }
    }

    public function initialize($class, $Curriculum)
    {
        $ceremonyData = $this->getCeremony($class, $Curriculum);
        if(is_array($ceremonyData))
        {    
        $this->class = $ceremonyData['Class'];
        $this->address = $ceremonyData['Address'];
        $this->date = $ceremonyData['Start_time'];
        $this->duration = $ceremonyData['Duration'];
        $this->googleLink = $ceremonyData['Map_link'];
        $this->curriculum = $ceremonyData['Curriculum'];
        $this->capacity = $ceremonyData['Capacity'];
        }
        else
        {
            throw new Exception("Ceremony doesn't exists!");
        }
    }

    public function makeCeremony($class,$curriculum, $address, $dateTime,$googleLink,$duration,$capacity)
    {
        $insert = "INSERT INTO `ceremony` (`Curriculum`, `Class`, `Start_time`, `Duration`, `Address`, `Capacity`, `Map_link`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $conn = $this->db->getConnection();
        $statement = $conn->prepare($insert);
        $statement->execute([$curriculum,$class,$dateTime,$duration,$address,$capacity,$googleLink]);
    }

    public function changeCeremonyDate($class,$curriculum,$dateTime)
    {
        $update = "UPDATE ceremony SET Start_time = ? WHERE ceremony.Curriculum = ? AND ceremony.Class = ?";
        $conn = $this->db->getConnection();
        $statement = $conn->prepare($update);
        $statement->execute([$dateTime,$curriculum,$class]);
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

    public function getGoogleLink()
    {
        return $this->googleLink;
    }
}

?>