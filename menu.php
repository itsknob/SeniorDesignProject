<!DOCTYPE html>
<?php

$companyName = "Company Name";

?>

<html>
	<head>
		<title>Menu Page</title>
		<link rel="stylesheet" type"text/css" href="styles.css">
	</head>
	<body>
		<div class="header">
			<div class="container">
				<div class="nav">
					<li><a href="home.php">Home</a></li>
					<li><a class="active" href="menu.php">Menu</a></li>
					<li><a href="about.php">About Us</a></li>
					<li><a href="locations_contact.php">Locations & Contact Us</a></li>
				</div>
			</div>
		</div>
		
		<div class="container">
			<div class="content">
				<p><br><br><br><?php echo $companyName ?> <--- Test of php in html<br>Welcome to the Menu Page</p>
			</div>
		</div>
	</body>
</html>