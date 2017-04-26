<!DOCTYPE html>
<?php
session_start();
if (empty($_POST["stripeToken"]) || empty($_SESSION["cart_item"]) ) {
    echo "<script>window.open('home.php','_self')</script>";
}

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


?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<html>
	<head>
		<title>Checkout</title>
		<link rel="stylesheet" type"text/css" href="checkoutstyles.css">
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
						       		<li><a href='logout.php'><span class glyphicon-shopping-logout'></span> Logout</a><li>
						   		</ul>
						   		"; // End of Navbar - Logged In 
						} else {
							echo "
								<ul class='nav navbar-nav navbar-right'>
									<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>
								</ul>
								"; // End of Navbar - Logged Out
						} 
					?>
		    	</div>
		  	</div>
		</nav>
		<h2>Checkout Page</h2>

		<div class="main">
		<h2>Thank you for shopping with us!</h2>
		<?php
		require 'vendor/autoload.php';
		$desc = "";

		$count = 0;
		foreach($_SESSION["cart_item"] as $item) {
			$count++;
			if ($count == 1 && $count == count($_SESSION["cart_item"])) {//If there is only one product in cart
				$desc = $desc.$item['quantity']."x ".$item['itemName'];
				break;
			}
			if ($count == count($_SESSION["cart_item"]))
				$desc = $desc."and ".$item['quantity']."x ".$item['itemName'];
			else
				$desc = $desc.$item['quantity']."x ".$item['itemName'].", ";
			$sql = $db->prepare('UPDATE items SET sales = sales + "'.$item["quantity"].'" WHERE itemName="'.$item['itemName'].'" ');
			$sql->execute();

		}

		unset($_SESSION["cart_item"]);


		\Stripe\Stripe::setApiKey('sk_test_YHeBtPwjJyLxSf1dYQhFTDyb ');

		$token = $_POST['stripeToken'];
		$email = $_POST['stripeEmail'];
		$total = $_SESSION["total"];

		$descr = mysqli_real_escape_string($con, $desc);
        $total = mysqli_real_escape_string($con, $total);
        $email = mysqli_real_escape_string($con, $email);

	    $sql = $db->prepare("INSERT INTO orders (description, price, email)
                   VALUES ('$descr', '$total', '$email')");

	    if (!($sql->execute()) ) {
	    	echo'<br>Your purchase could not be completed';
	    	die();
	    }
		try {
		    $charge = \Stripe\Charge::create(array(
		      "amount" => $_SESSION["total"],
		      "currency" => "usd",
		      "source" => $token,
		      "description" => $desc)
		      );
		    $chargeId = $charge->id;

				
		    echo '<br>Your order for '.$desc.' has been received!<br>'
		    echo '<br>Your order ID is:'.$chargeId.'<br>';
		}catch(\Stripe\Error\Card $e){
		    echo $e->getMessage();
		    echo '<br>Error. Your order could not be processed.<br>';
		}
		?>
		<br><br>
		Be sure to have your email address ready to pick up your items!
		</div>
		</body>
</html>