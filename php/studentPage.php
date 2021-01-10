<?php
    require 'student.php';

    $fn = $_GET["fn"];
    $password = $_GET["password"];

    $student = new Student($fn, $password);

    echo $fn . " " . $password;


?>