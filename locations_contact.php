
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
						<li><a href="home.php">Home</a></li>
						<li><a href="menu.php">Menu</a></li>
						<li><a href="about.php">About Us</a></li> 
						<li class="active"><a href="locations_contact.php">Locations & Contact Us</a></li>
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
		
	<h2>Locations and Contact Us</h2>

	<?php
	$twitterHandle = file_get_contents('adminTools/twitterHandle.txt');
	?>

	<div class="main">
	<div class="contact">
		<?php
		echo nl2br( file_get_contents('adminTools/contactInfo.txt') );
		?>
		<!--123-456-7890 | company@email.com | 1176 Howell St, Newport, RI 02841-->
		<div id="map"></div>
		<script>
			function initMap() {
				var uluru = {lat: <?php echo nl2br( file_get_contents('adminTools/mapsLatitude.txt') ); ?>, lng: <?php echo nl2br( file_get_contents('adminTools/mapsLongitude.txt') ); ?> };
				var map = new google.maps.Map(document.getElementById('map'), {
					zoom: 14,
					center: uluru
				});
				var marker = new google.maps.Marker({
					position: uluru,
					map: map
				});
			}
		</script>
		<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDa_AlzHm7fCPqGli0agnoC8XFznqy50A&callback=initMap">
		</script>
		<br>
		<?php
		echo nl2br( file_get_contents('adminTools/locationInfo.txt') );
		?><br>
		<div id="loctwitter">
			<a class="twitter-timeline" href=<?php echo "https://twitter.com/$twitterHandle" ?>> Tweets by nuwcJuicing </a>
			<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
		</div>
		</div>
		</div>
	</body>
</html>