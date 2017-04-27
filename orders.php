<!DOCTYPE html>
<?php
session_start();

error_reporting(0);
if ($_SESSION['isAdmin'] == false && $_SESSION['isEmployee'] == false ) {
    http_response_code(404);
    echo 'You are not authorized';
    die();
}
error_reporting(-1);

$CompanyName = "NUWC Juicing";

$db = new PDO('mysql:host=localhost;dbname=inventory;charset=utf8', 'root', 'root');
		    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

include "scripts.php";
    //Variables
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "inventory";
    //Connect and Select    
$con = makeConnection($dbhost, $dbuser, $dbpass, $dbname);
$sql = $db->prepare("SELECT * FROM orders");
$sql->execute();
$orders = $sql->fetchAll(PDO::FETCH_ASSOC);
foreach($orders as $order) {
	if (isset($_POST[$order['orderID']])) {
		$sql = $db->prepare("DELETE FROM orders WHERE orderID='".$order['orderID']."'");
		$sql->execute();
	}
}
?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<html>
	<head>
		<title>Checkout Page</title>
		<link rel="stylesheet" type"text/css" href="styles.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">

	</head>
	<body>
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
									<li><a href='registration.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>
									<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>
						    <!--   	<li><a href='cart.php'><span class='glyphicon glyphicon-shopping-cart'></span> Cart</a></li> -->
						       		<li><a href='logout.php'><span class glyphicon-shopping-logout'></span> Logout</a><li>
								</ul>
								"; // End of Navbar - Logged Out
						} 
					?>
		    	</div>
		  	</div>
		</nav>
		<h2>Orders Page</h2>

		<div class="main">
		<div id="displayOrders"></div>
		</div>
</body>
</html>

<script>
	$("#displayOrders").load("displayOrders.php");
	var auto_refresh = setInterval(
	(function () {
	    $("#displayOrders").load("displayOrders.php"); //Load the content into the div
	}), 1000);
</script>