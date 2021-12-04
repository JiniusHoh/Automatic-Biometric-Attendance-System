<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
		$password1 = $_POST['password1'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name) && $password == $password1 && validPW($password))
		{

			//save to database
			$user_id = random_num(20);
			$query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}
		elseif($password != $password1)
		{
			echo "Please enter same password and confirmed password";
		}
		elseif(!validPW($password))
		{
			echo "Please make your password equal or longer than 8 keys and consists of letters and number";
		}
		else
		{
			echo "Please enter some valid information!";
		}
	}

	function validPW($password){
		if(strlen($password) >= 8){
			if(!ctype_upper($password) && !ctype_lower($password)){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
</head>
<body>

	<style type="text/css">

	body {
  		background-image: url('LoginSignupBG.jpeg');
  		background-repeat: no-repeat;
  		background-size: cover;

	}
	
	#text{

		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}

	#button{

		padding: 10px;
		width: 100px;
		color: white;
		background-color: lightblue;
		border: none;
	}

	#box{

		background-color: grey;
		margin: auto;
		width: 300px;
		padding: 20px;
	}

	</style>

	<div id="box" style='margin:200px 550px 250px 550px;'>
		
		<form method="post">
			<div style="font-size: 20px;color: white;">Signup</div>

			<label for="Name">Full Name:</label><br>
			<input id="text" type="text" name="user_name"><br><br>
			<label for="password">Password:</label><br>
			<input id="text" type="password" name="password"><br><br>
			<label for="password">Confirmed Password:</label><br>
			<input id="text" type="password" name="password1"><br><br>

			<input id="button" type="submit" value="Signup"><br><br>

			<a href="login.php">Click to Login</a><br><br>
		</form>
	</div>
</body>
</html>