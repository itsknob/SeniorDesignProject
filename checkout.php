<!DOCTYPE html>
<?php
session_start();
$CompanyName = "NUWC Juicing";

// $_SESSION["cart"] should be either a string that contains what the order is for, or an array of strings for the different parts of the order(2x apple juice, 3x orange juice, etc.), it doesnt really matter. If that's done $order will be used to notify the truck what the order is for through stripe.
//$order = $_SESSION["cart"];
?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<html>
	<head>
		<title>Cart Page</title>
		<link rel="stylesheet" type"text/css" href="styles.css">
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
		</nav>
		Checkout Page


		<?php
		require 'vendor/autoload.php';

		\Stripe\Stripe::setApiKey('sk_test_YHeBtPwjJyLxSf1dYQhFTDyb ');

		$token = $_POST['stripeToken'];
		$email = $_POST['stripeEmail'];
		//If $_SESSION["cart"] was a string of arrays this will make it one big ole sting
		//$order = implode(", ", $order);
		$desc = "2x Orange Juice, 3x Apple Juice";

		try {
		    $charge = \Stripe\Charge::create(array(
		      "amount" => 1000,
		      "currency" => "usd",
		      "source" => $token,
		      "description" => $desc)//This will be changed to order and will be seen on stripe dashboard
		      );
		    $chargeId = $charge->id;
		    echo '<br>Your order for '.$desc.' has been received!';//$desc will change to order
		    echo '<br>Your order ID is: '.$chargeId;
		}catch(\Stripe\Error\Card $e){
		    echo $e->getMessage();
		    echo 'didnt work';
		}
		?>

		</body>
</html>