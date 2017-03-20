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
	
	<div class="main">
		<!-- Most Popular Menu Items -->
		<div class="popItems well">
			<table class="table">
				<thead>
					<th>
						Popular Items
					</th>
					<tr>
						<th>#</th>
						<th>Item</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>Apple Juice</td>
					</tr>
					<tr>
						<td>2</td>
						<td>Orange Juice</td>
					</tr>
					<tr>
						<td>3</td>
						<td>Other Juice</td>
					</tr>
					<tr>
						<td>4</td>
						<td>Other Juice</td>
					</tr>
					<tr>
						<td>5</td>
						<td>Other other Juice</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="dealOfDay well">
			Deal of the day goes here
			<br>k
		</div>
		
		<div class="twitterFeed well">
			<a class="twitter-timeline" href="https://twitter.com/nuwcJuicing"> Tweets by nuwcJuicing </a>
			<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
		</div>
		<div class="footer ">
	<!--    Slideshow-->
	<div id="myCarousel" class="carousel slide" data-ride="carousel" style="width: 100%">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
			<li data-target="#myCarousel" data-slide-to="3"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class  ="carousel-inner" role="listbox">
			<div class="item active">
				<img src="images/img1.png" alt="Chania">
			</div>

			<div class="item">
				<img src="images/img2.png" alt="Chania">
			</div>

			<div class="item">
				<img src="images/img3.jpg" alt="Flower">
			</div>

		</div>

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	</div>
	<!--End Slideshow   -->

		
	</div>
	
	

	
</body>
</html>
