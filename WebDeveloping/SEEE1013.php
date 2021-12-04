<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

//read
	$nameA = $user_data['user_name'];
	if($nameA === 'ADMIN')
	{	
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "attendance";
	
		$num_rows = 1;
	
		$conn = mysqli_connect($servername, $username, $password, $dbname);
	
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
	
		$sql = "SELECT * FROM `seee1013`";
	
		$result = $conn->query($sql);
	}
	else
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "attendance";
	
		$num_rows = 1;
	
		$conn = mysqli_connect($servername, $username, $password, $dbname);
	
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
	
		$name1 = $user_data['user_name'];
		$sql = "SELECT * FROM `seee1013` WHERE `name` LIKE '%$name1%'";
	
		$result = $conn->query($sql);
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Student Attendance Management Portal</title>
</head>
<body>

	<a href="logout.php"><p style="text-align:right;">Logout</p></a>
	<a href="SSCE1693.php"><p style="text-align:left;">Engineering Maths I</p></a>
	<a href="SEEE1013.php"><p style="text-align:left;">Electrical Circuit Analysis</p></a>
	<h1><p style="text-align:center;">Attendance Record - Electrical Circuit Analysis</p></h1>

<style>
body {
  background-image: url('Palette.jpg');
  background-repeat: no-repeat;
  background-size: cover;

	}


table {
  font-family: arial, sans-serif;
  font-size: 18px;
  border-collapse: collapse;
  width: 50%;
  margin-left:auto;
  margin-right:auto;
}


td, th {
  border: 1px solid black #dddddd;
  text-align: center;
  padding: 10px;
 
}

tr:nth-child(even) {
  background-color: #dddddd;
}

</style>


	<?php
	echo "<br>";

	if ($result->num_rows > 0) {

		echo "<table><tr><th>Name</th><th>Date</th><th>Check-In Time</th></tr>";
    // output data of each row

		while($row = $result->fetch_assoc()) {
        	echo "<tr><td>" . $row['name']. "</td><td>" . $row['date']. "</td><td>" . $row['time']. "</td></tr>";
    	}
    	echo "</table>";

		
	}
	else{
		echo "<p align=center>No record has been found!</p>";
	}

	$conn->close();

	?>
	
</body>
</html>