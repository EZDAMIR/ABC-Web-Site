<?php 
    $min  = 1;
    $max  = 10;
    $num1 = rand( $min, $max );
    $num2 = rand( $min, $max );
    $sum  = $num1 + $num2;
?>
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

        <label for="quiz"><b>Captcha: <span><?php echo htmlspecialchars($num1 . ' + ' . $num2); ?></span> ?</b></label>
    <input type="text" placeholder="write number" name="quiz" class="form-control quiz-control" required>
        

        <div class="link">
            <a href="forget.php">Забыл пароль?</a><br>
            <a href="signup.php">Зарегистрироваться</a><br>
        </div>
        <input data-res="<?php echo $sum; ?>" type="submit" name="submit" class="btn" value="Войти"><br>
    </form>

    <?php
    if (isset($_GET['error'])) {
        echo "<div class=\"alert alert-danger\" role=\"alert\">Логин или пароль неверны.</div>";
    }
    ?>

<script>
			const submitButton = document.querySelector('[type="submit"]');
			const quizInput = document.querySelector(".quiz-control");
			quizInput.addEventListener("input", function(e) {
				const res = submitButton.getAttribute("data-res");
				if ( this.value == res ) {
					submitButton.removeAttribute("disabled");
				} else {
					submitButton.setAttribute("disabled", "");
				}
			});
</script>

<?php
function caesar_decrypt($text, $shift) {
    $decryptedText = ''; // Initialize an empty string to store the decrypted message
    $length = strlen($text);

    for ($i = 0; $i < $length; $i++) {
        $symbol = ord($text[$i]); // Get the ASCII code of the current character
        $adjustedShift = $shift >= 0 ? $shift : 26 + $shift; // Adjust the shift for negative values

        $decryptedSymbol = $symbol - $adjustedShift; // Calculate the decrypted character's ASCII code
        if ($decryptedSymbol < 0) {
            $decryptedSymbol += 26; // Handle wrapping around the alphabet
        }

        $decryptedText .= chr($decryptedSymbol); // Append the decrypted character to the decryptedText string
    }

    return $decryptedText; // Return the decrypted message
}
function caesar_encrypt($text, $shift) {
    $encrypted_text = "";
    $length = strlen($text);
    for ($i = 0; $i < $length; $i++) {
        $char = $text[$i];
        if (ctype_alpha($char)) {
            $ascii = ord($char);
            if ($char >= 'a' && $char <= 'z') {
                $encrypted_ascii = (($ascii - ord('a') + $shift) % 26) + ord('a');
            } elseif ($char >= 'A' && $char <= 'Z') {
                $encrypted_ascii = (($ascii - ord('A') + $shift) % 26) + ord('A');
            }
        } elseif (ctype_digit($char)) {
            $encrypted_ascii = (($char - '0' + $shift) % 10) + '0';
        } else {
            $encrypted_text .= $char;
            continue; // Skip further processing for non-alphanumeric characters
        }
        $encrypted_text .= chr($encrypted_ascii);
    }
    return $encrypted_text;
  }


if (isset($_POST['submit'])) {
    $con = mysqli_connect('localhost', 'root', '', 'abc');
    if (!$con) {
        echo mysqli_error($con);
    } else {
        $login = $_POST['login'];
        $user_psw = $_POST['parol'];
        $shift = 3; // Caesar cipher shift value, adjust as needed
            $psw = caesar_encrypt($user_psw, $shift);
            $sql = "SELECT ИИН, Пароль FROM students WHERE ИИН = '$login' AND Пароль='$psw'";
            $result = mysqli_query($con, $sql);
            if (!$result) {
                echo "Error executing query: " . mysqli_error($con);
            } else {
                
                if (mysqli_num_rows($result) > 0) {
                    
                    header("Location: studentpage.php?login=" . urlencode($login));
                    
                    exit;}
                 else {
                    header("Location: login.php?error=incorrect_password_$psw");
                    
                }
            }
        }
    }

?>


</body>
</html>
