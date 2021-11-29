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
	
		$sql = "SELECT * FROM `attendance`";
	
		// $sql = "SELECT Name, Check-In Time FROM attendance";
		// $result = mysqli_query($conn, $sql);
	
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
		$sql = "SELECT * FROM `attendance` WHERE `name` LIKE '%$name1%'";
	
		// $sql = "SELECT Name, Check-In Time FROM attendance";
		// $result = mysqli_query($conn, $sql);
	
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
	<h1><p style="text-align:center;">This is your attendance record in COURSE_NAME!</p></h1>

<style>
body {
  background-image: url('LoginBackground.jpg');
  background-repeat: no-repeat;
  background-size: cover;

	}

table, th, td {
    border: 1px solid black;
	margin-left:auto;
	margin-right:auto;
}
</style>

	<br>
	<p style="text-align:center;">Hello, </p><br>
	<center><?php echo $user_data['user_name']?></center>

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