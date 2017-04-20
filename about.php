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
		<link rel="stylesheet" type"text/css" href="aboutusstylesheet.css">
	</head>
	<body>

	<nav class="navbar navbar-inverse navbar-fixed-top aboutusnobuffernavbar">
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
		        		<li class = "active"><a href="about.php">About Us</a></li> 
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
									<li><a class='active' href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>
						    <!--   	<li><a href='cart.php'><span class='glyphicon glyphicon-shopping-cart'></span> Cart</a></li> -->
								</ul>
								"; // End of Navbar - Logged Out
						} 
					?>
		    	</div>
		  	</div>
		</nav>
		
		<div class="aboutuscontainer">
			<div class="aboutuspicture">
				<span class="helper"></span><img src="images/aboutuspic.png" class ="img-fluid mx-auto aboutuspic" alt = "Responsive image" align="middle">
			</div>
			
			<div class="aboutusheader">
				About Us
			</div>
		</div>
		
		<div class="main">
			<div class="aboutus">
				<?php
					echo nl2br( file_get_contents('admintools/aboutus.txt') ); // get the contents, and echo it out.
				?>
			</div>
		</div>
</body>
</html>