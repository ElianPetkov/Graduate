<?php require '../php/studentPage.php' ?>
<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" href="../css/student.css">
    <link rel="stylesheet" href="../css/main.css">
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
            <p>
                В <Дата,час> на <адрес> ще се състои церемония по връчване на дипломи. Моля отбележете дали ще присъствате на церемонията като подвърдите чрез натискане на бутона.
            </p>
            <div id="button-container">
                <button id="invite-button">Ще присъствам</button>
            </div>
        </section>
        <section id="additional-information-container">
            <p>При присъствие на церемонията е важно да вземете тога и шапка. Можете да ги получите от отговорниците за тоги и шапки.След приключване на церемонията е важно да ги върнете при същите отговорници.</p>
        </section>
    </div>
</body>

</html>