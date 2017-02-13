<!DOCTYPE html>
<?php
session_start();
$CompanyName = "NUWC Juicing";
?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<html>
	<head>
		<title>Sample Juice Truck Page</title>
		<link rel="stylesheet" type"text/css" href="styles.css">
	</head>
	<body>

	<!-- Tried to get the navbar to change if the user is logged in. It doesnt work though. -->
	<?php
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		include 'navbar_authorized.php';
	} else {
		include 'navbar_unauthorized.php';
	}
	?>
		<!-- Once the php code above works this can be deleted -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
		 	<div class="container-fluid">
		    	<div class="navbar-header">
		     		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        		<span class="icon-bar"></span>
		        		<span class="icon-bar"></span>
		        		<span class="icon-bar"></span> 
		      		</button>
		    		<a class="navbar-brand" href="home.php"><?php echo $CompanyName; ?></a>
		    	</div>
		    	<div class="collapse navbar-collapse" id="myNavbar">
		      		<ul class="nav navbar-nav">
		        		<li><a href="home.php">Home</a></li>
		        		<li><a href="menu.php">Menu</a></li>
		        		<li><a href="about.php">About Us</a></li> 
		        		<li><a href="locations_contact.php">Locations & Contact Us</a></li> 
		      		</ul>
		      		<ul class="nav navbar-nav navbar-right">
		        		<li><a href="registration.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
		        		<li class="active"><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
		        		<li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
		      		</ul>
		    	</div>
		  	</div>
		</nav>
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
$dbpass = "root";
$dbname = "user_information";

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
	$check_user = "SELECT * FROM login_information WHERE user_name='$user_name' AND user_pass='$user_pass'";

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
