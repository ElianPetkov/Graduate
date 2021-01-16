<?php require '../logic/studentPage.php' ?>
<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/student.css">

    <link href="../pictures/favicon.ico" rel="shortcut icon" type="image/icon" />
</head>

<body>
    <div id="main-container">
        <section id="greetings-container">
            <h1>
                Добре дошли: <?= $studentName ?>
            </h1>

            <div id="pic-container">
                <img src="../pictures/congratulations.jpg" alt="congratulations" id="image">
            </div>
        </section>
        <section id="invitation-container">

            <?php
            if (!$isCeremonyOver) {
                $serverPath = $_SERVER['SERVER_NAME'] . "$_SERVER[REQUEST_URI]";
                echo "
                <h2>Информация за предстоящата церемония</h2>
                <hr>
            <p>
                В $ceremonyDate   на адрес $address  ще се състои церемония по връчване на дипломи. Моля отбележете дали ще присъствате на церемонията като подвърдите чрез натискане на бутона.
            </p>";
            ?>
                <div id="button-container">
                    <form action="../logic/studentPage.php" method="POST">
                        <button id="invite-button" style="display: <?php echo ($studentIsEnrolled ? "none" : "") ?>" type="submit">Ще присъствам</button>
                        <input hidden value="<?= $studentClass ?>" name="class">
                        <input hidden value="<?= $studentFN ?>" name="fn">
                        <input hidden value="<?= $serverPath ?>" name="serverPath">
                    </form>
                </div>
                <div class="enrollMessage">
                    <?php
                    if (isset($studentIsEnrolled) && $studentIsEnrolled){
                        echo "
                        <hr>
                     <p>
                        Записан сте за предстоящата церемония на $ceremonyDate
                    </p>";
                    }
                    ?>
                </div>
            <?php
            } else {
                echo "
                <p>
                $errorMessage
                </p>";
            }
            ?>

        </section>
        <section id="additional-information-container">
            <h2>Важна информация за присъстващите на церемонията!</h2>
            <?php
                    if (isset($studentIsEnrolled) && $studentIsEnrolled){
                        echo "
                        <hr>        
                        <p>Вие сте $studentOrder по ред за получване на диплома. Моля бъдете готови не по-късно от $timeToTakeDiplomaStudent часа да ви се връчи дипломата.</p>";
                    }
                    ?>
            <hr>
            <p>При присъствие на церемонията е важно да вземете тога и шапка. Можете да ги получите от отговорниците за тоги и шапки. След приключване на церемонията е важно да ги върнете при същите отговорници.</p>
            <hr>
            <p>Важно е да се подпишете, че сте си взели дипломата при съответветния отговорник за това.</p>
        </section>
    </div>
</body>

</html>