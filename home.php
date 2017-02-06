<!DOCTYPE html>
<?php
session_start();
$companyName = "Company Name";

?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
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
		    		<a class="navbar-brand" href="home.php">Juice Company</a>
		    	</div>
		    	<div class="collapse navbar-collapse" id="myNavbar">
		      		<ul class="nav navbar-nav">
		        		<li class="active"><a href="home.php">Home</a></li>
		        		<li><a href="menu.php">Menu</a></li>
		        		<li><a href="about.php">About Us</a></li> 
		        		<li><a href="locations_contact.php">Locations & Contact Us</a></li> 
		      		</ul>
		      		<ul class="nav navbar-nav navbar-right">
		        		<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
		        		<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
		        		<li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
		      		</ul>
		    	</div>
		  	</div>
		</nav>
	

		<div class="container">
			<div class="content">
				<p>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br>@<br></p>
			</div>
		</div>
		
	
	<a class="twitter-timeline" href="https://twitter.com/nuwcJuicing"> Tweets by nuwcJuicing </a>
	<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
	
	</body>
</html>