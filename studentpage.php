 <!DOCTYPE html>
<html>
<head>
    <title>Login 2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
		<nav>
			<ul>
	  <li><a class="active" href="signup.html">Home</a></li>
	  <li><a href="signup.php">Sign in</a></li>
	  <li><a href="aboutus.php">Кружки</a></li>
	  <li style="float:right"><a href="displogin.html">Login</a></li>
	</ul>
	</nav>
	</header>
<div>
    

    <form action="" method="get">
        <label for="table">Таблица для просмотра:</label>
        <select id="table" name="table">
            <option value="students">Личная информация</option>
            <option value="attendance">Посещения</option>
            <option value="payments">Оплаты</option>
            <!-- Add other tables options here -->
        </select>

        <input type="hidden" id="login" name="login" value="<?php echo isset($_GET['login']) ? $_GET['login'] : ''; ?>">

        <input type="submit" value="Посмотреть">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['login']) && isset($_GET['table'])) {
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "abc";

        $login = $_GET['login'];
        $table = $_GET['table'];

       
        $conn = new mysqli($servername, $username, $password, $dbname);

        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        
        $sql_columns = "SHOW COLUMNS FROM $table";
        $result_columns = $conn->query($sql_columns);

        if ($result_columns->num_rows > 0) {
            echo "<h2>Recordings for login: $login in table: $table</h2>";
            echo "<table>";

            // Output table header with column names
            echo "<tr>";
            while ($row_columns = $result_columns->fetch_assoc()) {
                echo "<th>" . $row_columns['Field'] . "</th>";
            }
            echo "</tr>";

            // Prepare and execute SQL query using the selected database
            $sql_data = "SELECT * FROM $table WHERE ИИН = '$login'";
            $result_data = $conn->query($sql_data);

            if ($result_data->num_rows > 0) {
                // Output data of each row
                while ($row_data = $result_data->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row_data as $key => $value) {
                        echo "<td>" . $value . "</td>";
                    }
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='" . $result_columns->num_rows . "'>No records found for login: $login in table: $table</td></tr>";
            }

            echo "</table>";
        } else {
            echo "No columns found for table: $table";
        }

        
   }  
    ?>
    <br><form action="" method="get">
    <label for="club">Зерегистрироваться на еще один кружок:</label>
    <select id="club" name="club">
        <option value="1">Хореографическая школа</option>
        <option value="2">Музыкальная школа</option>
        <option value="3">Художественная школа</option>
        <option value="4">Школа робототехники</option>
        <option value="5">Школа актёрского мастерства</option>
    </select>
    <input type="hidden" id="login" name="login" value="<?php echo isset($_GET['login']) ? $_GET['login'] : ''; ?>">
    <input type="submit" value="Зарегистрироваться">
</form>

<?php
// Check if the form was submitted and all required fields are set
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['login']) && isset($_GET['club'])) {
    // Retrieve login and club values from the form
    $login = $_GET['login'];
    $club = $_GET['club'];
    
    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "abc";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL query to insert the new record
    $sql = "INSERT INTO students_and_clubs (ИИН, Номер_кружка) VALUES ('$login', '$club')";

    if ($conn->query($sql) === TRUE) {
        echo "<p class=\"success-message\">New record added successfully.</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>



</div>
</body>
</html>

