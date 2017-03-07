<html>
	<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<title> Registration Page </title>
		<link rel="stylesheet" type"text/css" href="styles.css">
	</head>
	<body>
	
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span> 
					</button>
					<a class="navbar-brand" href="home.php">Juice Company</a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li class="active"><a href="home.php">Home</a></li>
						<li><a href="menu.php">Menu</a></li>
						<li><a href="about.php">About Us</a></li> 
						<li><a href="locations_contact.php">Locations & Contact Us</a></li> 
					</ul>		
					<?php
						if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
							echo "
								<ul class='nav navbar-nav navbar-right'>
							   		<li><a href='my_account.php'><span class='glyphicon glyphicon-user'></span> My Account</a></li>
							   		<li><a href='cart.php'><span class='glyphicon glyphicon-shopping-cart'></span> Cart</a></li>
							   		<li><a href='logout.php'><span class glyphicon-shopping-logout'></span> Logout</a><li>
						   		</ul>
						   		"; // End of Navbar - Logged In 
						} else {
							echo "
								<ul class='nav navbar-nav navbar-right'>
									<li><a href='registration.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>
									<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>
									<li><a href='cart.php'><span class='glyphicon glyphicon-shopping-cart'></span> Cart</a></li>
							   		<li><a href='logout.php'><span class glyphicon-shopping-logout'></span> Logout</a><li>
								</ul>
								"; // End of Navbar - Logged Out
						} 
					?>

				</div>
			</div>
		</div>

		<form action='registration.php' method='POST'>
			<table width='500' border='10' align='center'>
				<tr>
					<td align='center' colspan='5'><h2>Registration</h2></td>
				</tr>
				<tr>
					<td align='center'> Email:</td>
					<td><input type='email' required="required" name='email' /></td>
				</tr>
				<tr>
					<td align='center'> User Name:</td>
					<td><input type='text' required="required" name='name' /></td>
				</tr>
				<tr>
					<td align='center'> Password:</td>
					<td><input type='password' required="required" name='pass' /></td>
				</tr>
				<tr>
					<td align='center'> Confirm Password:</td>
					<td><input type='password' required="required" name='confirm_pass' /></td>
				</tr>
				<tr>
					<td align='center' colspan='3'><input type='submit' name='register' value='Submit' /></td>
				</tr>
				<tr>
					<td align='center' colspan='3'><p align='center'> Already have an account? <a href="login.php"> Click here to login. </a> </p></td>
				</tr>
			</table>
		</form>
	</body>
</html>
<?php
	
	//Variables
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "root";
	$dbname = "user_information";
	
	$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	//Check for Failure
	if(mysqli_connect_errno()){
		echo "Failed to connnect to MySQL: " . mysqli_connect_errno();
	}
	
	//Checks if login is set.
	if(isset($_POST['register'])){
		
		//Check that passwords match
		if($_POST['pass'] != $_POST['confirm_pass']){
			echo "Passwords do not match <br>";
			return;
		}
		//Strip html and php tags from user and pass
		$user_email = $_POST['email'];
		$user_name = strip_tags(trim($_POST['name']));
		$user_pass = strip_tags(trim($_POST['pass']));	
	}
	
	$add_user = "INSERT INTO login_information (user_name, user_pass, user_email) VALUES ('$user_name', '$user_pass', '$user_email')";
	
	$attempt_add = mysqli_query($con, $add_user);
	
	if($attempt_add){
		echo "Successful!";
		echo "<script>webpage.open('home.php', '_self');</script>";
	}
	else{
		echo "Failed to add new user.";
	}
	
?>
