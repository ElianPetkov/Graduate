<?php require '../logic/administrationEnrollStudentsAndCeremonies.php' ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/administration.css">
    <link href="../pictures/favicon.ico" rel="shortcut icon" type="image/icon" />
</head>

<body>
    <header class="main-header">
        <nav class="main-nav">
            <ul class="main-nav-items">
                <li class="main-nav-item">
                    <a href="administrationEnrollStudentsAndCeremoniesUI.php">Добавяне на церемония или студенти</a>
                </li>
                <li class="main-nav-item">
                    <a href="administrationCeremonyChangesUI.php">Управление на церемония</a>
                </li>
            </ul>
        </nav>
    </header>
    <?php $serverPath = $_SERVER['SERVER_NAME'] . "$_SERVER[REQUEST_URI]"; ?>
    <div id="main-container">
        <div id="student-ceremony-enroll-container">
            <section id="enroll-ceremony">
                <h1>Добавяне на церемония</h1>
                <hr>
                <form method="POST" action="../logic/administrationEnrollStudentsAndCeremonies.php">
                    <label for="class">Випуск:</label>
                    <input name="class" type="text" />

                    <label for="curriculum">Специалност:</label>
                    <input name="curriculum" type="text" />

                    <label for="duration">Продължителност:</label>
                    <input name="duration" type="text" />

                    <label for="capacity">Свободни места:</label>
                    <input name="capacity" type="text" />

                    <label for="address">Адрес:</label>
                    <input name="address" type="text" />

                    <label for="google-maps-link">Линк към Google maps:</label>
                    <input name="google-maps-link" type="text" />

                    <label for="dateTime">Дата и час на събитието:</label>
                    <input type="datetime-local" name="dateTime" value="2021-01-13T19:30">

                    <input type="submit" value="Запиши" />
                    <input hidden value="ceremony" name="ceremony">
                    <input hidden value="<?= $serverPath ?>" name="serverPath">

                </form>
            </section>

            <section id="enroll-student">
                <h1>Добавяне на студент</h1>
                <hr>
                <form method="POST" action="../logic/administrationEnrollStudentsAndCeremonies.php">

                    <label for="fn">Факултетен номер:</label>
                    <input name="fn" type="text" />

                    <label for="curriculum">Специалност:</label>
                    <input name="curriculum" type="text" />

                    <label for="group">Група на студента:</label>
                    <input name="group" type="text" />

                    <label for="faculty">Факултет:</label>
                    <input name="faculty" type="text" />

                    <label for="grade">Оценка:</label>
                    <input name="grade" type="text" />

                    <label for="password">Парола:</label>
                    <input name="password" type="text" />

                    <label for="firstName">Име:</label>
                    <input name="firstName" type="text" />

                    <label for="lastName">Фамилия:</label>
                    <input name="lastName" type="text" />

                    <label for="diplomaNumber">Номер на диплома:</label>
                    <input name="diplomaNumber" type="text" />

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
                    <input hidden value="<?= $serverPath ?>" name="serverPath">

                </form>
            </section>
        </div>

        <div id="file-uploader-container">
            <section id="file-upload">
                <h2>Качете CSV файл с данни за студенти</h2>
                <hr>
                <form enctype="multipart/form-data" action="../logic/administrationEnrollStudentsAndCeremonies.php" method="POST">
                    <input type="file" name="file" id="file-uploaded" accept=".csv" />
                    <input type="submit" name="Качи файл" value="Запиши" />
                    <input hidden value="<?= $serverPath ?>" name="serverPath">
                    <input hidden value="file" name="file">
                </form>
                <div class="clearfix"></div>
            </section>
        </div>
    </div>
</body>

</html>