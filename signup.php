<html>
<title>
  Registration
</title>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="styles.css">
</head>
<body class ="body">
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
  <h1>Registration of student</h1>

  <label for="IIN">IIN</label><br>
  <input type="text" name="IIN" class="input" required value="<?php echo isset($_POST['IIN']) ? htmlspecialchars($_POST['IIN']) : ''; ?>"><br>
  <?php if (isset($errors['IIN'])): ?>
    <span class="error"><?php echo $errors['IIN']; ?></span>
  <?php endif; ?>

  <label for="lastname">Last Name</label><br>
  <input type="text" name="lastname" class="input" required value="<?php echo isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : ''; ?>"><br>

  <label for="firstname">First Name</label><br>
  <input type="text" name="firstname" class="input" required value="<?php echo isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : ''; ?>"><br>

  <label for="thirdname">Middle Name</label><br>
  <input type="text" name="thirdname" class="input" required value="<?php echo isset($_POST['thirdname']) ? htmlspecialchars($_POST['thirdname']) : ''; ?>"><br>

  <label for="club">Select Club</label><br>
  <select name="club" class="input" required>
    <option value="1">Choreographic School</option>
    <option value="2">Music School</option>
    <option value="3">Art School</option>
    <option value="4">Robotics School</option>
    <option value="5">Acting School</option>
  </select><br>

  <label for="tel">Contact Phone</label><br>
  <input type="text" name="tel" class="input" required value="<?php echo isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : ''; ?>"><br>

  <label for="street">Street</label><br>
  <input type="text" name="street" class="input" required value="<?php echo isset($_POST['street']) ? htmlspecialchars($_POST['street']) : ''; ?>"><br>

  <label for="house">House</label><br>
<input type="text" name="house" class="input" required value="<?php echo isset($_POST['house']) ? htmlspecialchars($_POST['house']) : ''; ?>"><br>

<label for="appartment">Apartment</label><br>
<input type="text" name="appartment" class="input" required value="<?php echo isset($_POST['appartment']) ? htmlspecialchars($_POST['appartment']) : ''; ?>"><br>


  <label for="parol">Password</label><br>
  <input type="password" name="parol" class="input" required><br>

  <label for="confirm_parol">Confirm Password</label><br>
  <input type="password" name="confirm_parol" class="input" required><br>

  <label for="bday">Date of Birth</label><br>
  <input type="date" name="bday" required value="<?php echo isset($_POST['bday']) ? htmlspecialchars($_POST['bday']) : ''; ?>"><br>

  <input type="submit" value="Submit" class="button">
</form>

</body>
</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to the database
$con = mysqli_connect('localhost', 'root', '', 'abc');
if (!$con) {
    echo mysqli_error($con);
    exit;
}
// Initialize variables and error messages
$errors = [];
$iin = null;
$lastname = null;
$firstname = null;
$thirdname = null;
$tel = null;
$street = null;
$house = null;
$appartment = null;
$bday = null;
$parol = null;
$club = null;

// Assign values to variables from POST data
$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$thirdname = $_POST['thirdname'];
$appartment = $_POST['appartment'];
$street = $_POST['street'];
$house = $_POST['house'];
$tel = $_POST['tel'];
$parol = $_POST['parol'];
$confirm_parol = $_POST['confirm_parol'];
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $con->query("SET FOREIGN_KEY_CHECKS=0");
    


    // Validate IIN
    if (!empty($_POST["IIN"])) {
        if (!preg_match("/^\d{12}$/", $_POST["IIN"])) {
            $errors['IIN'] = "IIN must consist of 12 digits.";
        } else {
            $iin = trim($_POST["IIN"]);
        }
    } else {
        $errors['IIN'] = "IIN is required.";
    }

    // Validate date of birth (at least 2 years ago)
    if (!empty($_POST['bday'])) {
        $bday = new DateTime($_POST['bday']);
        $twoYearsAgo = new DateTime('-2 years');
        if ($bday->getTimestamp() > $twoYearsAgo->getTimestamp()) {
            $errors['bday'] = "Date of birth must be at least 2 years ago.";
        }
    } else {
        $errors['bday'] = "Date of birth is required.";
    }
    // Validate password
    if (empty($parol) || empty($confirm_parol) || $parol !== $confirm_parol) {
      $errors['parol'] = "Passwords do not match.";
  } elseif (strlen($parol) < 8) {
      $errors['parol'] = "Password must be at least 8 characters long.";
  } elseif (!preg_match("/[0-9]/", $parol)) {
      $errors['parol'] = "Password must contain at least 1 number.";
  } elseif (!preg_match("/[A-Z]/", $parol)) {
      $errors['parol'] = "Password must contain at least 1 uppercase letter.";
  }

    // Validate other fields (lastname, firstname, thirdname, club, tel, street, house, appartment, parol, confirm_parol)
    // You can add similar validation logic for each field as above


    
         


    }

    // Display errors or success message
    if (!empty($errors)) {
        echo "<ul class=\"error-list\">";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    } else {
      $sql = "SELECT * FROM students WHERE ИИН = '$iin'";
    $result = mysqli_query($con, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $errors["registered"] = "Student is already registered, otherwise IIN is not correct";
    } else {
         
        $bdayString = $bday->format('Y-m-d'); // Format DateTime object as string

$sql1 = "INSERT INTO students (ИИН, Фамилия, Имя, Отчество, Телефон, Улица, Дом, Квартира, Дата_рождения, Пароль) 
        VALUES ('$iin', '$lastname', '$firstname', '$thirdname', '$tel', '$street', '$house', '$appartment', '$bdayString', '$parol')";

$sql2 = "INSERT INTO students_and_clubs (ИИН, Номер_кружка) 
        VALUES ('$iin', '$club')";
        if (mysqli_query($con, $sql1) && mysqli_query($con, $sql2)) {
          echo "<p class=\"success-message\">Student registered</p>";
      }
    }
}
$con->query("SET FOREIGN_KEY_CHECKS=1");
mysqli_close($con);
?>