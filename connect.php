<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$con = mysqli_connect('localhost', 'root', '', 'abc');
if (!$con) {
    echo mysqli_error($con);
}

$iin = $_POST['IIN'];
$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$thirdname = $_POST['thirdname'];
$tel = $_POST['tel'];
$street = $_POST['street'];
$house = $_POST['house'];
$appartment = $_POST['appartment'];
$bday = $_POST['bday'];
$parol = $_POST['parol'];
$club = $_POST['club'];


$sql = "SELECT * FROM students WHERE ИИН = '$iin'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "Student is already registered, otherwise IIN is not correct";
} else {
    $sql1 = "INSERT INTO students (ИИН, Фамилия, Имя, Отчество, Телефон, Улица, Дом, Квартира, Дата_рождения, Пароль) 
            VALUES ('$iin', '$lastname', '$firstname', '$thirdname', '$tel', '$street', '$house', '$appartment', '$bday', '$parol')";
    
    $sql2 = "INSERT INTO students_and_clubs (ИИН, Номер_кружка) 
            VALUES ('$iin', '$club')";
    
    if (mysqli_query($con, $sql1) && mysqli_query($con, $sql2)) {
        echo "Student is registered!";
    } else {
        echo "Try again";
    }
}

mysqli_close($con);
?>


 