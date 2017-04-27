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
		<title>Login</title>
		<link rel="stylesheet" type"text/css" href="styles.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
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
					<?php
						if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
							echo "
								<ul class='nav navbar-nav navbar-right'>
						       		<li><a href='my_account.php'><span class='glyphicon glyphicon-user'></span> My Account</a></li>
						    <!--   	<li><a href='cart.php'><span class='glyphicon glyphicon-shopping-cart'></span> Cart</a></li> -->
						       		<li><a href='logout.php'><span class glyphicon-shopping-logout'></span> Logout</a><li>
						   		</ul>
						   		"; // End of Navbar - Logged In 
						} else {
							echo "
								<ul class='nav navbar-nav navbar-right'>
									<li class = 'active'><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>
						    <!--   	<li><a href='cart.php'><span class='glyphicon glyphicon-shopping-cart'></span> Cart</a></li> -->
								</ul>
								"; // End of Navbar - Logged Out
						} 
					?>
		    	</div>
		  	</div>
		</nav>

		<h2>Login</h2>

		<div class = "main container form-signin login-container">
			<form action="login.php" style="width: 100%" method="post">
				<input type = "text" class = "form-control" name = "name" placeholder = "Username" required autofocus></br>
				<input type = "password" class = "form-control" name = "pass" placeholder = "Password" required></br>
				<button class = "btn btn-lg btn-primary btn-block" type = "submit" name = "login">Login</button>
			</form>
			<br>
			<div class = "seperator">
				<span class = "seperator-span">
					Don't Already Have an Account?
				</span>
			</div>
			<!-- Trigger/Open The Modal -->
			<button id="SignUp">Sign Up</button>

			<!-- The Modal -->
			<div id="myModal" class="modal">
				<span class="close"></span>
				<form action="/login.php" method="post">
				  <div class="registrationContainer">
					<label><b>Username</b></label>
					<input type="text" placeholder="Enter Username" name="username" required>
					
					<label><b>Email</b></label>
					<input type="text" placeholder="Enter Email" name="email" required>

					<label><b>Password</b></label>
					<input type="password" placeholder="Enter Password" name="psw" required>

					<label><b>Repeat Password</b></label>
					<input type="password" placeholder="Repeat Password" name="psw-repeat" required>

					<div class="formButtons">
					  <input type="submit" name="cancel" value="Cancel" class="cancelbtn"></input>
					  <input type="submit" name="register" value="Sign Up" class="signupbtn"></input>
					</div>
				  </div>
				</form>
			</div>
			<?php
				
			?>

			<script>
			// Get the modal
			var modal = document.getElementById('myModal');

			// Get the button that opens the modal
			var btn = document.getElementById("SignUp");

			// Get the <span> element that closes the modal
			var cancelBtn = document.getElementsByClassName("cancelbtn")[0];

			// When the user clicks the button, open the modal 
			btn.onclick = function() {
				modal.style.display = "block";
				
			}

			// When the user clicks on <span> (x), close the modal
			cancelBtn.onclick = function() {
				modal.style.display = "none";
			}

			// When the user clicks anywhere outside of the modal, close it
			window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
				}
			}
			</script>

		</div>
	</body>
</html>

<?php

	include "scripts.php"; 

	//Variables
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "root";
	$dbname = "user_information";
	//Connect and Select
	$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	//Check for Failure
	if(mysqli_connect_errno()) {
		echo "Failed to connnect to MySQL";
	}
	$db = new PDO('mysql:host=localhost;dbname=user_information;charset=utf8', 'root', 'root');


	//Checks if login is set.
	if(isset($_POST["register"])) {
		$username = mysqli_real_escape_string($con,$_POST["username"]);
		$pass = $_POST["psw"];
		$email = mysqli_real_escape_string($con,$_POST["email"]);
		$pass2 = $_POST["psw-repeat"];
		if ($pass !== $pass2) {
			echo "<div class= 'passworderror'><br>Your passwords did not match. Please try to register again </div>";
			goto a;
		}
		$pass = mysqli_real_escape_string($con,$_POST["psw"]);
		$pass2 = mysqli_real_escape_string($con,$_POST["psw-repeat"]);
		$sql = $db->prepare("INSERT INTO login_information (user_name, user_pass, user_email)
           					VALUES ('$username', '$pass', '$email')");
        if ($sql->execute()){
            echo "<br><div class='passworderror'>You have successfully registered. Feel free to sign in now. </div>";
        } else {
            echo "<br><div class='passworderror'There was an error. You were unable to register.</div>";
        }
		
	}
	a:
	if(isset($_POST['login'])){

		$user_name = strip_tags(trim($_POST['name']));
		$user_pass = strip_tags(trim($_POST['pass']));

		//SQL Statement -> Checks username against password.
		$check_user = "SELECT * FROM login_information WHERE user_name='$user_name' AND user_pass='$user_pass'";

		//Database Query
		$run = mysqli_query($con, $check_user);

		//Check to make sure that there is at least one row matching in the database
		if($run->num_rows > 0)
		{
			$_SESSION['user_name'] = $user_name;
			$_SESSION['loggedin'] = true;
			populateSession($con);
			echo "<script>window.open('home.php','_self')</script>";
		}
		//If not, inform user.
		else
		{
			echo "<script>alert('Email or password is incorrect!')</script>";
		}
	}

?>
