
<!DOCTYPE html>
<html>
<head>
    <title>Welcome page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="body">
<div class="form">
    <form action="" method="POST">
    	<select name="club" class="input">
                        <option value="1">Хореографическая школа</option>
                        <option value="2">Музыкальная школа</option>
                        <option value="3">Художественная школа</option>
                        <option value="4">Школа робототехники</option>
                        <option value="5">Школа актёрского мастерства</option>
                    </select>
                    <input type="submit" value="Поиск">
        <table border="1">
            <tr>
                <th>ИИН</th>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Отчество</th>
                <th>Телефон</th>
                <th>Улица</th>
                <th>Дом</th>
                <th>Квартира</th>
                <th>Дата Рождения</th>
                <th>Номер_кружка</th>
            </tr>
           
            <?php
            $con = mysqli_connect('localhost', 'root', '', 'abc');
            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT students.ИИН, Фамилия, Имя, Отчество, Телефон, Улица, Дом, Квартира, Дата_рождения, Номер_кружка FROM students, students_and_clubs WHERE students.ИИН=students_and_clubs.ИИН";

            if (isset($_POST['club'])) {
                $lname = $_POST['club'];
                $sql .= " AND Номер_кружка='$lname'";
            }

            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$row['ИИН']."</td>";
                    echo "<td>".$row['Фамилия']."</td>";
                    echo "<td>".$row['Имя']."</td>";
                    echo "<td>".$row['Отчество']."</td>";
                    echo "<td>".$row['Телефон']."</td>";
                    echo "<td>".$row['Улица']."</td>";
                    echo "<td>".$row['Дом']."</td>";
                    echo "<td>".$row['Квартира']."</td>";
                    echo "<td>".$row['Дата_рождения']."</td>";
                    echo "<td>".$row['Номер_кружка']."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='11'>0 results</td></tr>";
            }

            mysqli_close($con);
            ?>
        </table>
    </form>
</div>
</body>
</html>
