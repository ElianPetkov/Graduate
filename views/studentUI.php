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
                Добре дошли: <?= $studentFistName ?> <?= $studentLastName ?>
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
                В $ceremonyDate на адрес <a href=$googleLink target=`_blank` style=color:white>$address</a>  ще се състои церемония по връчване на дипломи. ";
                if (!$isStudentEnrolledToCeremony) {
                    echo  "Моля отбележете дали ще присъствате на церемонията като подвърдите чрез натискане на бутона.
            </p>";
                }
            ?>
                <div id="button-container">
                    <form action="../logic/studentPage.php" method="POST">
                        <button id="invite-button" style="display: <?php echo ($isStudentEnrolledToCeremony ? "none" : "") ?>" type="submit">Ще присъствам</button>
                        <input hidden value="<?= $studentClass ?>" name="class">
                        <input hidden value="<?= $studentFN ?>" name="fn">
                        <input hidden value="<?= $serverPath ?>" name="serverPath">
                    </form>
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

                <?php
                 if (isset($isStudentEnrolledToCeremony) && $isStudentEnrolledToCeremony) {
                     echo "
                    <section id='tasks-container'>
                        <div class='enrollMessage'>
                            <p>
                            Записан сте за предстоящата церемония на $ceremonyDate
                            </p>        
                        </div>
                        <div>
                        <hr>
                            <h2>Оставащи задачи:</h2>
                        <hr>";
    
                        echo "<p><b>Диплома: </b>" . $msgDiploma."</p>";
                        echo "<p><b>Подпис: </b>" . $msgSign."</p>";
                        echo "<p><b>Шапка: </b>" . $msgHat."</p>";
                        echo "<p><b>Тога: </b>" . $msgGown."</p>";
                        echo " </div>
                    </section>";
                    }
                    ?>

      
        <section id="additional-information-container" style="display: <?php echo ($isStudentEnrolledToCeremony ? "" : "none") ?>">
            <?php
            if (isset($isStudentEnrolledToCeremony) && $isStudentEnrolledToCeremony) {
                echo "
                <h2>Важна информация за присъстващите на церемонията!</h2>
                        <hr>        
                        <p>Вие сте $studentOrder по ред за получване на диплома. Моля бъдете готови не по-късно от $timeToTakeDiplomaStudent часа да ви се връчи дипломата.</p>
            <hr>
            <p>При присъствие на церемонията е важно да вземете тога и шапка. Можете да ги получите от отговорниците за тоги и шапки. След приключване на церемонията е важно да ги върнете при същите отговорници.</p>
            <hr>
            <p>Важно е да се подпишете, че сте си взели дипломата при съответветния отговорник за това.</p>";
            }
            ?>
        </section>
    </div>
</body>

</html>