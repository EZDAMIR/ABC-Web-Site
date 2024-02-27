<!DOCTYPE html>
<html>
<head>
    <title>Welcome page</title>
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
        <input class="btn"type="submit" name="submit" value="Войти"><br>
        <?php
    
    if (isset($_GET['error'])) {
        echo "<p>Логин или пароль неверны.</p>";
    }
    ?>

    </form>

    <?php
    $con = mysqli_connect('localhost', 'root', '', 'abc');
    if (!$con) {
        echo mysqli_error($con);
    } else {
        if (isset($_POST['submit'])) {
            $login = $_POST['login'];
            $psw = $_POST['parol'];

            $sql = "SELECT * FROM loginadmin";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);

            if ($login == $row['login'] && $psw == $row['parol']) {
                header("Location: admin.html");
                exit;
            } else {
                header("Location: loginforadmin.php?error=incorrect_password");
            }
        }
    }
    ?>
</body>
</html>
