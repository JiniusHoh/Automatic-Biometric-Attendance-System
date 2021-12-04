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
	
		// $sql = "SELECT * FROM `attendance`";
	
		// $sql = "SELECT Name, Check-In Time FROM attendance";
		// $result = mysqli_query($conn, $sql);
	
		// $result = $conn->query($sql);
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
	
		// $name1 = $user_data['user_name'];
		// $sql = "SELECT * FROM `attendance` WHERE `name` LIKE '%$name1%'";
	
		// $sql = "SELECT Name, Check-In Time FROM attendance";
		// $result = mysqli_query($conn, $sql);
	
		// $result = $conn->query($sql);
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Student Attendance Management Portal</title>
</head>
<body>

	<a href ="logout.php" id = logout><p style="text-align:right;">Logout</p></a>
	<h1><p style="text-align:center;">Welcome to the Student Attendance Management Portal!</p></h1>
	<h1><p style="text-align:center;">Please choose your course attendance!</p></h1>

	<br>
	<p style="text-align:center;">Hello, <?php echo $user_data['user_name']?></p><br>

	<a href="SSCE1693.php"><p style="text-align:center;">Engineering Mathematics I</p></a>
	<a href="SEEE1013.php"><p style="text-align:center;">Electrical Circuit Analysis</p></a>



<style>
body {
  background-image: url('Palette.jpg');
  background-repeat: no-repeat;
  background-size: cover;

	}

/* #subject {
  background-color: #367cf4;
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  align-self: center;
} */



</style>

</body>
</html>