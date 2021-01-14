<?php require '../logic/diplomаsPage.php' ?>
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
                Добре дошли: <?= $_SESSION['name'] ?>
            </h1>
            
        </section>
        <table>
        <thread>
        <tr>
        <th>Факултетен номер</th>
        <th>Випуск</th>
        <th>Състояние на диплома</th>
        <th> Промени състоянието
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
                <form action="../logic/diplomаsPage.php" method="POST">
                    <select id="state" name="state">
                        <optgroup>
                            <option value="NotTaken">NotTaken</option>
                            <option value="Taken">Taken</option>
                            <option value="Returned">Returned</option>
                        </optgroup>
                    </select> 
                    <input hidden value='.$row['FN'].' name="fn">
                    <input hidden value = "Diploma" name = "task">
                    <input hidden value = '.$row['Class'].' name = "class">
                    <input hidden value='.$serverPath.' name="serverPath">
                    <input type="submit" value="Промени" />
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