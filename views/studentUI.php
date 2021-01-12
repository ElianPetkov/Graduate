<?php require '../logic/studentPage.php' ?>
<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" href="../css/student.css">
    <link rel="stylesheet" href="../css/main.css">
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
                echo "
            <p>
                В $ceremonyDate   на адрес $address  ще се състои церемония по връчване на дипломи. Моля отбележете дали ще присъствате на церемонията като подвърдите чрез натискане на бутона.
            </p>";
            ?>
            <div id="button-container">
            <form action="../logic/studentPage.php" method="POST">
                <button id="invite-button" type="submit">Ще присъствам</button>
                <input hidden value="<?= $studentClass ?>" name="class">
                <input hidden value="<?= $studentFN ?>" name="fn">
            </form>
            </div>
            <?php
            }
            else
            {
                echo "
                <p>
                $errorMessage
                </p>";
            }
            ?>

        </section>
        <section id="additional-information-container">
            <p>При присъствие на церемонията е важно да вземете тога и шапка. Можете да ги получите от отговорниците за тоги и шапки.След приключване на церемонията е важно да ги върнете при същите отговорници.</p>
        </section>
    </div>
</body>

</html>