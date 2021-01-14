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
                <h1>Добавяне на церемония</h1>
                <hr>
                <form method="POST" action="../logic/administration.php">
                    <label for="class">Випуск:</label>
                    <input name="class" type="text" />

                    <label for="address">Адрес:</label>
                    <input name="address" type="text" />

                    <label for="degree">Degree: </label>
                    <select name="degree">
                        <option value="Bachelor">Bachelor</option>
                        <option value="Master">Master</option>
                        <option value="Doctorate">Doctorate</option>
                    </select>

                    <label for="dateTime">Дата и час на събитието:</label>
                    <input type="datetime-local" name="dateTime" value="2021-01-13T19:30">

                    <input type="submit" value="Запиши" />
                    <input hidden value="ceremony" name="ceremony">
                </form>
            </section>
            <section id="enroll-student">
                <h1>Добавяне на студент</h1>
                <hr>
                <form method="POST" action="../logic/administration.php">

                    <label for="fn">Факултетен номер:</label>
                    <input name="fn" type="text" />
                    <label for="grade">Оценка:</label>
                    <input name="grade" type="text" />
                    <label for="password">Парола:</label>
                    <input name="password" type="text" />
                    <label for="name">Име:</label>
                    <input name="name" type="text" />
                    <label for="class">Випуск:</label>
                    <input name="class" type="text" />
                    <label for="degree">Степен на образование:</label>
                    <select name="degree">
                        <option value="Bachelor">Bachelor</option>
                        <option value="Master">Master</option>
                        <option value="Doctorate">Doctorate</option>
                    </select>

                    <input type="submit" value="Запиши" />
                    <input hidden value="student" name="student">

                </form>
                <div class="clearfix"></div>
            </section>
        </div>
        <div id="file-uploader-container">
            <section id="file-upload">
                <h2>Качете CSV файл с данни за студенти</h2>
                    <?php $serverPath = $_SERVER['SERVER_NAME'] . "$_SERVER[REQUEST_URI]"; ?>
                <form enctype="multipart/form-data" action="../logic/administration.php" method="POST">
                    <input type="file" name="file" accept=".csv" />
                    <input type="submit" name="Качи файл" />
                    <input hidden value="<?= $serverPath ?>" name="serverPath">
                </form>
            </section>
        </div>
    </div>
</body>

</html>