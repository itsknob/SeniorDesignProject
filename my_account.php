<!DOCTYPE html>
<?php
	$companyName = "NUWC Juicing";

	session_start(); 

	error_reporting(0);
	if ($_SESSION['loggedin'] == false) {
	    http_response_code(404);
	    echo 'Oops! You need to log into an account to access this page.';
	    die();
	}
	error_reporting(-1);
	
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
		<meta name="viewport" content="width=device-width, initial-scale=1">
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
					<a class="navbar-brand" href="home.php"><?php echo $companyName ?></a>
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
							   		<li class = 'active'><a href='my_account.php'><span class='glyphicon glyphicon-user'></span> My Account</a></li>
						    <!--   	<li><a href='cart.php'><span class='glyphicon glyphicon-shopping-cart'></span> Cart</a></li> -->
							   		<li><a href='logout.php'><span class glyphicon-shopping-logout'></span> Logout</a><li>
						   		</ul>
						   		"; // End of Navbar - Logged In 
						} else {
							echo "
								<ul class='nav navbar-nav navbar-right'>
									<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>
						    <!--   	<li><a href='cart.php'><span class='glyphicon glyphicon-shopping-cart'></span> Cart</a></li> -->
								</ul>
								"; // End of Navbar - Logged Out
						} 
					?>

				</div>
			</div>
		</div>

		<h2>My Account</h2>
		
		<div class="main">
			<table style="font-size: 24px; margin-left: 3vw;">
				<tr>
					<td>
						Your Username: <?php echo $_SESSION['user_name']; ?>
					</td>
				</tr>
				<tr>
					<td>
						Your Email: <?php echo $_SESSION['user_email']; ?>
					</td>
				</tr>
			</table>
			<br>
			<br>
			<br>
	        <?php 
	            if($_SESSION['isEmployee'] == true) {
	                echo '<a href="orders.php"><h4>Click Here to look at recent orders</h4></a>';
	            }
	            if($_SESSION['isAdmin'] == true){
	                echo "
	                    <a href='admin_tools.php'><h4>Click Here to Edit the Website</h4></a><br>
	                    <h4> Edit Employee's Status </h4>

	                    <!-- Edit Employee -->
	                    <form style='margin-left: 3vw;' action=my_account.php?go method='POST'>
	                        <p>
	                            <select name='employee'> ";
	                                foreach($userNameList as $id=>$user):
	                                    echo "<option value='" . $user . "'>" . $id . "  - " . $user . "</option>";
	                                endforeach;
	                echo         "</select>
	                            <input type='submit' name=submitButton value='Submit'></input> 
	                        </p>
	                    </form>
	                    ";
	            } 
	        ?>

			
			
			<?php
				//echo var_dump($_GET);
				//echo var_dump($_POST);

				//If employee was updated
				//if(isset($_GET['updated'])){
				//	echo "<b>Updated Employee</b><br>";
				//}

				//If employee information is being changed.
				if(isset($_GET['edit']) && isset($_POST['updateButton'])){
					echo "Edited Employee.<br>";
					echo "Employee Status: ".$_POST['Employee']."<br>";
					$updateQuery = "UPDATE login_information SET `isEmployee`='".$_POST['Employee']."' WHERE `user_name`='".$_SESSION['editableEmployeeName']."'";
					var_dump($updateQuery);
					mysqli_query($con, $updateQuery);
				}

				//If employee information is being changed.
				if(isset($_POST['updateButton']) && isset($_GET['go'])){
					//Update user's employee status
					var_dump($_POST);
				}

				if(isset($_GET['go']) && isset($_POST['submitButton'])){
					$employeeQuery = "SELECT * FROM login_information WHERE user_name='".$_POST['employee']."'";
				//	echo $employeeQuery; //Debugging
					$employeeResult = mysqli_query($con, $employeeQuery);
				//	echo "Num rows: " . $employeeResult->num_rows;
					while($row = $employeeResult->fetch_assoc()){
				//		echo var_dump($row);
				//		echo var_dump($_POST);
						echo "
								<div class=employeeContainter>
									<div class=employeeInformation>
										<ul>
											<li>User Name:  " . $row['user_name'] . "</li>
											<li>User ID:    " . $row['user_id'] . "</li>
											<li>User Email: " . $row['user_email'] . "</li>
											<form action='my_account.php?edit' method='POST'>
												<label for='NotEmployed'>Not Employee</label>
												<input type='radio' value='0' id='NotEmployed' name='Employee'"; 			//Look for something breaking this code
											  		if($row['isEmployee']==0) echo "checked='checked'/>";
											  		else echo "/>";
									  echo "<br><label for='YesEmployed'>Employee</label>
									  			<input type='radio' value='1' id='YesEmployed' name='Employee'"; 
													if($row['isEmployee']==1) echo "checked='checked'/>";
											  		else echo "/>";
									  echo "<br><input type='submit' name=updateButton value='Update User'/>
											</form>
										</ul>
									</div>
								</div>
							 ";
					}
				}
			?>
		</div>
	</body>  
</html>


