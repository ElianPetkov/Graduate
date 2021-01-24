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
        <div id="change-data-container">
            <section id="move-student-order">
                <h3>Попълнете факултетния номер на студента изпуснал реда си за да го преместите на последно място по ред</h3>
                <hr>
                <form method="POST" action="../logic/administration.php">
                    <label for="Fn">Факултетен номер:</label>
                    <input name="Fn" type="text" />

                    <input type="submit" value="Премести" />
                    <input hidden value="move-student-order" name="move-student-order">
                    <input hidden value="<?= $serverPath ?>" name="serverPath">
                </form>
            </section>

            <section id="change-date">
                <h3>Променете датата на церемония</h3>
                <hr>
                <form method="POST" action="../logic/administration.php">
                    <label for="class">Випуск:</label>
                    <input name="class" type="text" />

                    <label for="curriculum">Специалност:</label>
                    <input name="curriculum" type="text" />

                    <label for="dateTime">Нова дата и час за събитието:</label>
                    <input type="datetime-local" name="dateTime" value="2021-01-13T19:30">

                    <input type="submit" value="Промени" />
                    <input hidden value="change-date" name="change-date">
                    <input hidden value="<?= $serverPath ?>" name="serverPath">
            </section>
        </div>
    </div>
    </div>
</body>

</html>