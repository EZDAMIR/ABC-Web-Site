<!DOCTYPE html>
<html>
<head>
    <title>Attendance Information</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div>
        <h2>Новая запись</h2>
        <form action="" method="POST">
            <label for="iin">ИИН:</label>
            <input type="text" id="iin" name="iin" required><br><br>
            
            <label for="clubNumber">Номер кружка:</label>
            <input type="text" id="clubNumber" name="clubNumber" required><br><br>
            
            <label for="date">Дата:</label>
            <input type="date" id="date" name="date" required><br><br>
            
            <input type="submit" name="submit" value="Добавить запись">
        </form>

        <?php
        $con = mysqli_connect('localhost', 'root', '', 'abc');
        if (!$con) {
            echo mysqli_error($con);
        } else {
            if (isset($_POST['submit'])) {
                $iin = $_POST['iin'];
                $clubNumber = $_POST['clubNumber'];
                $date = $_POST['date'];

                
                $sql = "INSERT INTO attendance (ИИН, Номер_кружка, Дата) 
                        VALUES ('$iin', '$clubNumber', '$date')";
                $result = mysqli_query($con, $sql);

                if ($result) {
                    echo "Добавлено!";
                } else {
                    echo "Error: " . mysqli_error($con);
                }
            }
        }

        ?>

        
    </div>
<div class="mycontainer">
    <div>

        <h2>Журнал</h2>
        
        <table border="1">
            <tr>
                <th>ИИН</th>  
                <th>Номер кружка</th>
                <th>Дата</th> 
                <th>Действия</th>
            </tr>
            <?php
            $lessons = 0;
            if (isset($_POST['delete'])) {
                $con = mysqli_connect('localhost', 'root', '', 'abc');
                if (!$con) {
                    echo mysqli_error($con);
                } else {
                    $iinToDelete = $_POST['iin'];
                    $clubNumberToDelete = $_POST['clubNumber'];
                    $dateToDelete = $_POST['date'];

                    $deleteSql = "DELETE FROM attendance WHERE ИИН = '$iinToDelete' AND Номер_кружка = '$clubNumberToDelete' AND Дата = '$dateToDelete'";
                    $deleteResult = mysqli_query($con, $deleteSql);
                    if ($deleteResult) {
                        echo "Record with ИИН ".$iinToDelete.", Номер кружка ".$clubNumberToDelete.", and Дата ".$dateToDelete." deleted successfully!";
                    } else {
                        echo "Error deleting record: " . mysqli_error($con);
                    }
                }
            }

            
    $sql = "SELECT * FROM attendance";




    $result = mysqli_query($con, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $lessons = $lessons+1;
                echo "<tr>";
                echo "<td>".$row['ИИН']."</td>";
                echo "<td>".$row['Номер_кружка']."</td>";
                echo "<td>".$row['Дата']."</td>";
                echo "<td><form action='' method='POST' onsubmit=\"return confirm('Are you sure you want to delete this record?');\">";
                echo "<input type='hidden' name='iin' value='".$row['ИИН']."'>";
                echo "<input type='hidden' name='clubNumber' value='".$row['Номер_кружка']."'>";
                echo "<input type='hidden' name='date' value='".$row['Дата']."'>";
                echo "<input type='submit' name='delete' value='Удалить'>";
                echo "</form></td>";
                echo "</tr>";
            } 
            
        } else {
            echo "<tr><td colspan='4'>0 results</td></tr>";

        }
    } else {
        echo "Error executing query: " . mysqli_error($con);
    }







            ?></table> </div>


<div><form action="bdattendance.php" method="GET">
            <label for="search">Найти и посчитать количество посещений по ИИН:</label>
            <input type="number" id="search" name="search" required>
                        <label for="month">за месяц:</label>
            <input type="number" id="month" name="month" min="1" max="12" required><br>
            <label for="year">за год:</label>
            <input type="number" id="year" name="year" required>
            
            <input type="submit" value="Search">
             
        </form><br>
    <table border="1">
            <tr>
                <th>ИИН</th>  
                <th>Номер кружка</th>
                <th>Дата</th> 
                

            </tr>
        <?php
        $con = mysqli_connect('localhost', 'root', '', 'abc');

if (!$con) {
    echo mysqli_error($con);
} else {
        
if (isset($_GET['search']) && isset($_GET['month']) && isset($_GET['year'])) {



        $search = mysqli_real_escape_string($con, $_GET['search']);
        $month = mysqli_real_escape_string($con, $_GET['month']);
        $year = mysqli_real_escape_string($con, $_GET['year']);
        $lessons=0;
        $agesale=0;
        $clubsale=0;
        $sale=0;

        $sql .= " WHERE ИИН = '$search' AND MONTH(Дата) = $month AND YEAR(Дата) =$year" ;
         
    
     $result = mysqli_query($con, $sql);

    if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $lessons = 0; // Initialize lessons count
        while ($row = mysqli_fetch_assoc($result)) {
            $lessons++; // Increment lessons count
            echo "<tr>";
            echo "<td>".$row['ИИН']."</td>";
            echo "<td>".$row['Номер_кружка']."</td>";
            echo "<td>".$row['Дата']."</td>";
            echo "</tr>";
        }
        echo "Number of recordings:".$lessons."<br>";

        $search = mysqli_real_escape_string($con, $_GET['search']);

        $query = "SELECT Дата_рождения FROM students WHERE ИИН = '$search'";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $birthdate = $row['Дата_рождения'];

            $today = new DateTime();
            $birth = new DateTime($birthdate);
            $age = $today->diff($birth)->y;

            if ($age > 10) {
                echo "The student is older than 10 years."."<br>";
            } else {
                echo "The student is under 10 years."."<br>";
                $agesale = 0.05;
            }
        } else {
            echo "No records found for the provided IIN."."<br>";
        }

        $sql = "SELECT * FROM students_and_clubs WHERE ИИН='$search'";
        $result = mysqli_query($con, $sql);

        if ($result && mysqli_num_rows($result) > 1) {
            echo "Ребенок посещает больше одного кружка"."<br>";
            $clubsale = 0.15;
        } else {
            echo "Ребенок посещает один кружок"."<br>";
        }

        if ($agesale > $clubsale) {
            echo "Скидка: 5%"."<br>";
            $sale = $agesale;
        } elseif ($agesale == $clubsale) {
            echo "Скидок не полагается"."<br>";
            $sale = 0;
        } else {
            echo "Скидка: 15%"."<br>";
            $sale = $clubsale;}
            $sum=(1000*$lessons);
            $sum=$sum - $sum * $sale;
        
    echo "Сумма за посещенные занятия за месяц:".$sum."<br>";} 




    else {
        echo "<tr><td colspan='4'>0 results</td></tr>";
    }

}

  
}
}
 ?><br>

  <?php
            
            if (isset($sum)) {
                echo "<form action='' method='POST'>";
                echo "<input type='hidden' name='iin' value='$search'>";
                echo "<input type='hidden' name='month' value='$month'>";
                echo "<input type='hidden' name='year' value='$year'>";
                echo "<input type='submit' name='addPayment' value='Add Payment'><br>";
                echo "</form>";
            }
            ?>
   <?php
    
    if (isset($_POST['addPayment'])) {
        
        $sql="SELECT * FROM payments WHERE ИИН='$search' AND месяц='$month' AND год='$year'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {

            $q = "UPDATE payments WHERE ИИН='$search' AND месяц='$month' AND год='$year'
        SET Сумма = '$sum'";}

        else{$q= "INSERT INTO payments (ИИН, месяц, год, сумма)  VALUES ('$search', '$month', '$year', '$sum')";}

if (mysqli_query($con, $q)) {
    echo "Record updated successfully";
}
    
else {
                    echo "Error: " . mysqli_error($con);
                }
}

    ?>

<br></table><br>
</div></div>
        
   
</body>
</html>
