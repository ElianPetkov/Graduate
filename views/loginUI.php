<?php require '../logic/login.php' ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/student.css">
    <link rel="stylesheet" href="../css/diplomаs.css">
    <link rel="stylesheet" href="../css/main.css">
    <link href="../pictures/favicon.ico" rel="shortcut icon" type="image/icon" />
</head>

<body>
    <div id="main-container">
        <section id="greetings-container">
            <h1>
                Въведете име и парола:
            </h1>
            <form  action = "../logic/login.php" method = "POST">
            <input type = "text" name = "user" placeholder = "Потребителско име" required autofocus></br>
            <input type = "password"  name = "password" placeholder = "Парола" required></br>
            <input  type = "submit" value = "Login">
         </form>
    </div>
</body>

</html>