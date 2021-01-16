<?php require '../logic/responsiblePeoplePage.php' ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/student.css">
    <link rel="stylesheet" href="../css/responsibility.css">
    <link rel="stylesheet" href="../css/main.css">
    <link href="../pictures/favicon.ico" rel="shortcut icon" type="image/icon" />
    <?php
        if($role != "gown") header("Location:../errorPage/404ErrorPage.html");
    ?>
</head>

<body>
    <div id="main-container">
        <section id="greetings-container">
            <h1>
                Добре дошли: <?= $_SESSION['name'] ?>
            </h1>
            <p id = "responsibility">Вие сте отговорник за раздаването и събирането на тоги на абсолвентите. Вашата задача е да дадете на всеки абсолвент тога. След това трябва да съберете тогите от абсолвентите. За всяко получаване или връщане, отразете събитието за съответния абсолвент. </p>
        
        </section>
        <table id ="table">
        <thread>
        <tr>
        <th>Факултетен номер</th>
        <th>Випуск</th>
        <th>Състояние</th>
        <th> Промени състоянието </th>
        </tr>
        </thread>
        <tbody>
        <?php
        $serverPath = $_SERVER['SERVER_NAME'] . "$_SERVER[REQUEST_URI]";
            foreach($students as $row){
                echo "<tr>";
                foreach($row as $key =>$val){
                    echo "<td> ".$val." </td>";
                }
                echo '<td>
                <form action="../logic/responsiblePeoplePage.php" method="POST">
                    <select id="state" name="state">
                        <optgroup>
                            <option value="NotTaken">NotTaken</option>
                            <option value="Taken">Taken</option>
                            <option value="Returned">Returned</option>
                        </optgroup>
                    </select> 
                    <input hidden value='.$row['FN'].' name="fn">
                    <input hidden value = "Gown" name = "task">
                    <input hidden value = '.$row['Class'].' name = "class">
                    <input hidden value='.$serverPath.' name="serverPath">
                    <input type="submit" id = "button" value="Промени" />
                </form>
                </td>';
                echo "</tr>\n";
            }
        ?>
        </tbody>
        </table>
    </div>
</body>

</html>