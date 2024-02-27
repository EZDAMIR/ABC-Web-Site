
<!DOCTYPE html>
<html>
<head>
    <title>Clubs Information</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div>
        <h2>Add New Club</h2>
        <form action="" method="POST">
            <label for="clubNumber">Номер кружка:</label>
            <input type="text" id="clubNumber" name="clubNumber" required><br><br>
            
            <label for="clubName">Название:</label>
            <input type="text" id="clubName" name="clubName" required><br><br>
            
            <label for="numLessons">Количество занятий:</label>
            <input type="number" id="numLessons" name="numLessons" required><br><br>
            
            <input type="submit" name="submit" value="Добавить кружок">
        </form>

        <?php
        $con = mysqli_connect('localhost', 'root', '', 'abc');
        if (!$con) {
            echo mysqli_error($con);
        } else {
            if (isset($_POST['submit'])) {
                $clubNumber = $_POST['clubNumber'];
                $clubName = $_POST['clubName'];
                $numLessons = $_POST['numLessons'];

                // Insert new club record into database
                $sql = "INSERT INTO clubs (Номер_кружка, Название, Количество_занятий) 
                        VALUES ('$clubNumber', '$clubName', '$numLessons')";
                $result = mysqli_query($con, $sql);

                if ($result) {
                    echo "New club record added successfully!";
                } else {
                    echo "Error: " . mysqli_error($con);
                }
            }
        }

        ?>
    </div>

    <div>
        <h2>Clubs Information</h2>
        <table border="1">
            <tr>
                <th>Номер кружка</th>  
                <th>Название</th>
                <th>Количество занятий</th> 
                <th>Действия</th>
            </tr>
            <?php
            if (isset($_POST['delete'])) {
                $con = mysqli_connect('localhost', 'root', '', 'abc');
                if (!$con) {
                    echo mysqli_error($con);
                } else {
                    $con->query("SET FOREIGN_KEY_CHECKS=0");
                    $clubIdToDelete = $_POST['delete'];
                    $deleteSql = "DELETE FROM clubs WHERE Номер_кружка = '$clubIdToDelete'";
                    $deleteResult = mysqli_query($con, $deleteSql);
                    if ($deleteResult) {
                        echo "Record with Номер кружка ".$clubIdToDelete." deleted successfully!";
                    } else {
                        echo "Error deleting record: " . mysqli_error($con);
                    }
                    $con->query("SET FOREIGN_KEY_CHECKS=1");
                }
            }

            $con = mysqli_connect('localhost', 'root', '', 'abc');
            if (!$con) {
                echo mysqli_error($con);
            } else {
                $sql = "SELECT * FROM clubs";
                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$row['Номер_кружка']."</td>";
                        echo "<td>".$row['Название']."</td>";
                        echo "<td>".$row['Количество_занятий']."</td>";
                        echo "<td><form action='' method='POST'>";
                        echo "<input type='hidden' name='delete' value='".$row['Номер_кружка']."'>";
                        echo "<input type='submit' value='Удалить'></form></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>0 results</td></tr>";
                }
            }
            ?>
        </table>
    </div>
</body>
</html>
