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
        <h1>Войдите в аккаунт</h1>
        <label for="login">ИИН</label><br>
        <input type="text" name="login" class="input"><br>
        <label for="parol">Пароль</label><br>
        <input type="password" name="parol" class="input"><br>
        <?php
    
    if (isset($_GET['error'])) {
        echo "<p>Логин или пароль неверны.</p>";
    }
    ?>

        <div class="link">
            <a href="forget.php">Забыл пароль?</a><br>
            <a href="signup.php">Зарегистрироваться</a><br>
        </div>
        <input type="submit" name="submit" class="btn" value="Войти"><br>
    </form>

    <?php
if (isset($_POST['submit'])) {
    $con = mysqli_connect('localhost', 'root', '', 'abc');
    if (!$con) {
        echo mysqli_error($con);
    } else {
        $login = $_POST['login'];
        $psw = $_POST['parol'];
        $sql = "SELECT ИИН, Пароль FROM students WHERE ИИН = '$login' AND Пароль='$psw'";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            echo "Error executing query: " . mysqli_error($con);
        } else {
            
            if (mysqli_num_rows($result) > 0) {
                
                header("Location: studentpage.php?login=" . urlencode($login));
                
                exit;}
             else {
                header("Location: login.php?error=incorrect_password");
                
            }
        }
    }
}
?>

</body>
</html>
