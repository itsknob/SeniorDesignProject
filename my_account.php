<!DOCTYPE html>
<?php
	session_start(); 
	
	include "scripts.php";

	//Variables
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "root";
	$dbname = "user_information";

	//Connect and Select	
	$con = makeConnection($dbhost, $dbuser, $dbpass, $dbname);
	//Setup search for DB
	$query = "SELECT * from login_information";
	//Fetch from DB
	$result = mysqli_query($con, $query);
	//Hold Users from Database
	$userNameList = array();
	
	//Convert Data
	while($row = $result->fetch_assoc()){
		$userNameList[$row['user_id']] = (string)$row['user_name'];// => (string)$row['userName'];
	}

	//Debugging
	//var_dump($userNameList);

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

		<link rel="stylesheet" type="text/css" href="styles.css">
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
		
		<?php 
			if($_SESSION['isAdmin'] == false){
				//No admin content should display if user is not admin.
			}
			else if($_SESSION['isAdmin'] == true){
				echo "
					<!-- Edit Employee -->
					<form action=employee-working.php method='POST'>
						<p>
							<select name='employee'> ";
								foreach($userNameList as $id=>$user):
									echo "<option value='" . $user . "'>" . $id . "  - " . $user . "</option>";
								endforeach;
				echo 		"</select>
							<input type='submit' value='Submit'></input> 
						</p>
					</form>
					";
			} 
			else{}
		?>
		
		
		<table>
			<tr>
				<td>
					Username: <?php echo $_SESSION['user_name']; ?>
				</td>
			</tr>
			<tr>
				<td>
					Email: <?php echo $_SESSION['user_email']; ?>
				</td>
			</tr>
		</table>
	</body>  
</html>


