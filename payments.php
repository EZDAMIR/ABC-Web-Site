<html>
<title>Welcome page</title>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
	</head>
<body class="body">
	
<header>
	<nav>
		<ul>
  <li><a class="active" href="signup.html">Home</a></li>
  <li><a href="signup.php">Sign in</a></li>
  <li><a href="aboutus.php">Кружки</a></li>
  <li style="float:right"><a href="http://localhost/demo4/displogin.html">Login</a></li>
</ul>
</nav>
</header>

	<form>
		 <div>
        <table border="1">
            <tr>
                <th>ИИН</th>
                <th>месяц</th>
                <th>год</th>
                <th>сумма</th>
                <th>статус</th>
            </tr>
             <form method="post">
        <div class="form">
            <table border="1">
                <tr>
                    <th>ИИН</th>
                    <th>месяц</th>
                    <th>год</th>
                    <th>сумма</th>
                    <th>статус</th>
                    <th>Update Status</th>
                </tr>
                <?php
                $con = mysqli_connect('localhost', 'root', '', 'abc');
                if (!$con) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                $sql = "SELECT * FROM payments";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$row['ИИН']."</td>";
                        echo "<td>".$row['месяц']."</td>";
                        echo "<td>".$row['год']."</td>";
                        echo "<td>".$row['Сумма']."</td>";
                        echo "<td>".$row['статус']."</td>";
                        echo "<td><input type='checkbox' name='status_checkbox[]' value='".$row['ИИН']."'></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>0 results</td></tr>";
                }
                mysqli_close($con);
                ?>
            </table>
            <input type="submit" name="submit" value="Update Status" class="btn">
        </div>
    </form>
    <?php
    if (isset($_POST['submit'])) {
        if (!empty($_POST['status_checkbox'])) {
            $con = mysqli_connect('localhost', 'root', '', 'abc');
            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }
            foreach ($_POST['status_checkbox'] as $id) {
                $id = mysqli_real_escape_string($con, $id);
                $sql = "UPDATE payments SET статус = 1 WHERE ИИН = $id"; // Assuming '1' represents checked status
                mysqli_query($con, $sql);
            }
            mysqli_close($con);
            echo "<script>alert('Status updated successfully!');</script>";
        } else {
            echo "<script>alert('Please select at least one record to update status.');</script>";
        }
    }
    ?></div></form>
</body>
</html>