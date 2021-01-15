<?php require '../logic/login.php' ?>
<!DOCTYPE html>
<html>
<head>
    <!--<link rel="stylesheet" href="../css/student.css">
    <link rel="stylesheet" href="../css/diplomаs.css">
    <link rel="stylesheet" href="../css/main.css"> -->
    <link rel="stylesheet" href="../css/login.css">
    <link href="../pictures/favicon.ico" rel="shortcut icon" type="image/icon" />
</head>

<body>
    <div id="background">
    <div id="main-container">
        <section id="greetings-container">
            <h1>
                Влезте в своя профил
            </h1>
            <hr>
            <form  action = "loginUI.php" method = "POST">
            <input type = "text" name = "user" placeholder = "Потребителско име" required autofocus></br>
            <input type = "password"  name = "password" placeholder = "Парола" required></br>
            <input  type = "submit" value = "Вход">
         </form>
        <?php
            if($isValid == false) echo '<p>Невалидно потребителско име или парола!</p>';
        ?>
    </div>
    </div>
</body>

</html>