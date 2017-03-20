<!DOCTYPE html>
<?php
session_start();
$CompanyName = "NUWC Juicing";
?>

<link rel="stylesheet" href="/lib/w3.css">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<html>
	<head>
		<title>About Us Page</title>
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
		        		<li class="active"><a href="about.php">About Us</a></li> 
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

		<div class="aboutusmain" style="height: 100vh">
			
			<div class="aboutuspicture">
				<span class="helper"></span><img src="images/Happy-employees-at-work.jpg" class ="img-fluid mx-auto" alt = "Responsive image">
			</div>

			<div class="aboutus">
				<div class="aboutusheader">
					ABOUT US
				</div>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vel consectetur lacus. Donec id augue vel eros feugiat lobortis. Quisque non ligula dolor. Mauris quis ligula vel enim accumsan vulputate quis vel tortor. Sed eget augue ac lectus rutrum cursus. Sed non ligula vitae elit elementum egestas a ut enim. Etiam elit justo, volutpat ac lacinia sed, condimentum at leo. Nullam tempus hendrerit lacinia.

				Duis malesuada ultricies ipsum, mollis scelerisque leo feugiat id. Fusce sed mauris in ipsum posuere ullamcorper non ac dui. Cras enim enim, mattis nec velit placerat, placerat semper lectus. Pellentesque ac posuere felis. Aenean pretium malesuada massa eget feugiat. Pellentesque urna augue, efficitur eget nibh efficitur, facilisis accumsan est. Integer varius rhoncus diam, vel finibus tellus dignissim a. In ac consectetur ex. Sed in erat pharetra, laoreet eros id, euismod tortor. Quisque ultrices nibh eu augue luctus lacinia. Duis commodo lectus magna, a tempor ante lacinia eget.

				Nam dictum laoreet tellus, sit amet laoreet magna finibus eu. Phasellus ac augue pulvinar, mollis arcu vehicula, viverra nulla. Etiam mollis nunc justo, commodo luctus lacus hendrerit a. Nunc vitae nisi ipsum. Proin non ullamcorper augue, sit amet consequat urna. Ut in sem laoreet, egestas nunc condimentum, laoreet diam. Donec ac dictum ante.</p>
			</div>
		</div>
</body>
</html>