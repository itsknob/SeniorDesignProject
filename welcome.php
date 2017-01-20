<?php
session_start();

if(!$_SESSION['user']){
	header("location: login.php");
}

?>
<html>
	<head>
		<title> Login Page </title>
	</head>
	<body>
		<b> Welcome, </b><?php echo $_SESSION['user']; ?>
		<br>
		<a href="logout.php"> Logout Here </a>
	</body>
</html>
