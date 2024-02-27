<?php
$conn = new mysqli('localhost', 'root', '', 'propic');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$pass = $_POST['new_pass'];
$confirmPass = $_POST['confirm_pass'];

if ($pass !== $confirmPass) {
  echo "New password and confirmation password do not match.";
}
else{
$sql = "UPDATE propic SET password = '$pass' WHERE email = '$email'"; 

if (mysqli_query($conn, $sql)) {
    if (mysqli_affected_rows($conn) > 0) {
        echo "Password updated successfully";
    } else {
        echo "No such user exists";
    }
} else {
    echo "Error updating password: " . mysqli_error($conn);
}
}
$conn->close();
?>