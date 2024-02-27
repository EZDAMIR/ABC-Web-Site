<html>
<head>
    <title>Welcome page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="body">
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
<form class="form" action="" method="POST">
        <h1>Введите логин и новый пароль</h1>
        <label for="email">ИИН</label><br>
        <input type="text" name="email" class="input" required><br>
        <label for="npass">Пароль</label><br>
        <input type="password" name="npass" class="input" required><br>
        <label for="cpass">Подтвердите пароль</label><br>
        <input type="password" name="cpass" class="input" required><br>
           <input type="submit" name="submit" value="Сменить" ><br>

</form>

<?php

if (isset($_POST['submit'])) {
$con = new mysqli('localhost', 'root', '', 'abc');

if (!$con) {
    die("Connection failed" );
}


$email = $_POST['email'];
$npass = $_POST['npass'];
$cpass = $_POST['cpass'];


$sql ="SELECT ИИН FROM students WHERE ИИН='$email'";
$result = mysqli_query($con, $sql);
if($result->num_rows > 0)
{
 if ($npass !== $cpass) {
        echo "Passwords do not match";
    } elseif (strlen($npass) < 8) {
        echo "Password must be at least 8 characters long";
    } elseif (!preg_match('/[A-Z]/', $npass) || !preg_match('/[a-z]/', $npass) || !preg_match('/[0-9]/', $npass)) {
        echo "Password must contain at least one uppercase letter, one lowercase letter, and one digit";
    }

else{
$sql = "UPDATE students SET Пароль = '$npass' WHERE ИИН='$email'";
$result = mysqli_query($con, $sql);


if ($result) {
    echo" Password updated";
} else {
    echo "Error";
}


mysqli_close($con);}}


else{echo "ИИН неверен";}}

?>

</body>
</html>