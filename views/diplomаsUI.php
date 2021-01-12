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
                Добре дошли: <?= $user ?>
            </h1>
            
        </section>
        <table>
        <thread>
        <tr>
        <th>Факултетен номер</th>
        <th>Състояние на диплома</th>
        <th> Промени състоянието
        </tr>
        </thread>
        <tbody>
        <?php
            foreach($students as $row){
                echo "<tr>";
                foreach($row as $key =>$val){
                    echo "<td> ".$val." </td>";
                }
                echo '<td>
                <form action="" method="post">
                    <select id="state" name="state">
                        <optgroup>
                            <option value="NotTaken">NotTaken</option>
                            <option value="Taken">Taken</option>
                            <option value="Returned">Returned</option>
                        </optgroup>
                    </select> 
                    <input type="submit" value="Въвеждане" />
                </td>';
                echo "</tr>\n";
            }
        ?>
        </tbody>
        </table>
    </div>
</body>

</html>