<!DOCTYPE html>
<html>
<head>
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
	<table border="1">
		<tr>

   <th> Номер кружка </th>  
   <th> Название  </th>
   <th> Количество занятий </th> 

</tr>

	<?php
	$con = mysqli_connect('localhost', 'root', '', 'abc');
if (!$con) {
    echo mysqli_error($con);
} 



$sql="SELECT * FROM clubs";
$result=mysqli_query($con, $sql);
if(mysqli_num_rows($result)>0){
	while($row=mysqli_fetch_assoc($result)){
		echo "<tr>";
		echo "<td>".$row['Номер_кружка']."</td>";
		echo "<td>".$row['Название']."</td>";
		echo "<td>".$row['Количество_занятий']."</td>";
		
	}
		} else{echo "0 results";}





	?>
	</body>
</html>