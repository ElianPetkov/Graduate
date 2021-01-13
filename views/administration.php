<?php require '../logic/administration.php' ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/administration.css">
    <link rel="stylesheet" href="../css/main.css">
    <link href="../pictures/favicon.ico" rel="shortcut icon" type="image/icon" />
</head>

<body>
    <div id="main-container">
        <div id="student-ceremony-enroll-container">
            <section id="enroll-ceremony">
                <form method="POST" action="../logic/administration.php">
                    <label for="class">Class</label>
                    <input name="class" type="text" />


                    <label for="address">Address</label>
                    <input name="address" type="text" />

                    <label for="degree">Degree: </label>
                    <select name="degree">
                        <option value="Bachelor">Bachelor</option>
                        <option value="Master">Master</option>
                        <option value="Doctorate">Doctorate</option>
                    </select>

                    <label for="dateTime">Дата и час на събитието:</label>
                    <input type="datetime-local" name="dateTime" value="2018-06-12T19:30">

                    <input type="submit" value="Запиши" />
                    <input hidden value="ceremony" name="ceremony">
                </form>

            </section>
        </div>
    </div>
</body>

</html>