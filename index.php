<!-- CURRENTLY THE SAME AS LOGIN.PHP, ALSO REDIRECTS TO LOGIN.PHP THIS WILL BE THE LANDING PAGE IN THE FUTURE FEEL FREE TO CHANGE THIS -->


<?php
session_start();
?>
<html>
	<head>
		<title> Test </title>
	</head>
	<body>
		<!-- Make this a table later -->
		<form action="login.php" method=post>
			User: <input required="required" name="name" type="text"> <br>
			Pass: <input required="required" name="pass" type="password">
			<input align="center" type="submit" name="login" value="Login">
		</form>
	</body>
</html>
<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "phptesting";

//Connect and Select
mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if(isset($_POST['submit'])){
		$user_name = $_POST['name'];
		$user_pass = $_POST['pass'];

		$check_user = "select * from user_info where user='$user_name' AND pass='$user_pass'";

		$run = mysql_query($check_user);

		if(mysql_num_rows($run)>0){
			$_SESSION['user'] = $user_name;
			echo "<script>window.open('welcome.php','_self')</script>";
		}
		else{
			echo "<script>alert('Email or password is incorrect!')</script>";
		}
	}
?>