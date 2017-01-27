<?php
session_start();
?>
<html>
	<head>
		<title> Login Page </title>
	</head>
	<body>
		<!-- Make this a table later -->
		<form action="login.php" method="post">
			User: <input required="required" name="name" type="text"/> <br>
			Pass: <input required="required" name="pass" type="password"/>
			<input align="center" type="submit" name="login" value="Login"/>
		</form>
	</body>
</html>
<?php

//Variables
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "phptesting";

//Connect and Select
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

//Check for Failure
if(mysqli_connect_errno()){
	echo "Failed to connnect to MySQL: " . mysqli_connect_errno();
}
//Checks if login is set.
if(isset($_POST['login'])){
	$user_name = $_POST['name'];
	$user_pass = $_POST['pass'];

//	Debugging
//	echo "$user_name, $user_pass";

	//SQL Statement -> Checks username against password.
	$check_user = "select * from user_info where user='$user_name' AND pass='$user_pass'";

	//Database Query
	$run = mysqli_query($con, $check_user);

	//Check to make sure that there is at least one row matching in the database
	if($run->num_rows > 0)
	{
		$_SESSION['user'] = $user_name;
		echo "<script>window.open('welcome.php','_self')</script>";
	}
	//If not, inform user.
	else
	{
		echo "<script>alert('Email or password is incorrect!')</script>";
	}
}
?>
