<?php
 require 'ConnectionDB.php';

 class Student{
        private $fn;
        private $password;
        private $name;
        private $grade;
        //private $email;
        private $db;

        public function __construct($fn, $password) {
            $this->fn = $fn;
            $this->password = $password;

            $this->db = new Db();
        }


    }




?>