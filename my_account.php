<!DOCTYPE html>
<?php
	session_start();
	$companyName = "Company Name";

?>

<html>
	<head>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<title>My Account</title>

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
		<h1>My Account</h1>
		
		<table>
			<tr>
				<td>
					Username: <?php echo $_SESSION['user']; ?>
				</td>
			</tr>
			<tr>
				<td>
					Email:
				</td>
			</tr>
		</table>
		  
		<?php
			//Retrives user information from Database
			//Used to set session information
			
			//Variables
			$dbhost = "localhost";
			$dbuser = "root";
			$dbpass = "root";
			$dbname = "user_information";

			//Connect and Select
			$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);	
			
			$query = "SELECT * FROM login_information WHERE user_name='" . $_SESSION['user'] . "'";
			echo $query;
			
			$result = mysqli_query($con, $query);
			
			$list =  mysql_fetch_array($result);
			$size_of_list = sizeof($list);

			if($result->num_rows > 0){
				echo "<br>YES<br>";
			}
			else{
				echo "<br>NO<br>";
			}
			
			for($i = 0; $i < $size_of_list; $i++)
			{
				echo $list[$i] . "<br>";
			}

			foreach($list as $data)
			{
				echo "$data <br>";
			}

			echo $list['user_name'];
			echo $list['user_email'];

		?>

	</body>  
</html>


