<!DOCTYPE html>
<html>
<head>
    <title>Student Database</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div>
        <br><table border="1">
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
                                
            </tr>
            <?php
$con = mysqli_connect('localhost', 'root', '', 'abc');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM students";

if (isset($_POST['telephone'])) {
    $telephone = $_POST['telephone'];
    // Use JOIN to prevent duplication
    $sql = "SELECT * FROM students 
            LEFT JOIN students_and_clubs ON students.ИИН = students_and_clubs.ИИН 
            WHERE students.Телефон = '$telephone'";
}

if (isset($_POST['lastnamesearch'])) {
    $lname = $_POST['lastnamesearch'];
    $sql = "SELECT * FROM students WHERE Фамилия = '$lname'";
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
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='9'>0 results</td></tr>";
}

mysqli_close($con);
?>

        
    
    <label>Поиск по фамилии</label>
    <form action="bdstudents.php" method="POST">
        <input type="text" name="lastnamesearch">
        <input type="submit" value="Поиск"><br>
    </form>

    <br><label>Поиск по телефону</label>
    <form action="bdstudents.php" method="POST">
        <input type="text" name="telephone">
        <input type="submit" value="Поиск">
    </form>

    </table></div>

</body>
</html>