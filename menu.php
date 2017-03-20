	<!DOCTYPE html>
<?php
	session_start();
	$CompanyName = "NUWC Juicing";
//~~~ Begin Menu Formatting ~~~//
	//Debugging
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	//Used to set session information
	include "scripts.php";
	//Variables
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "root";
	$dbname = "inventory";

	//Class to hold item data from database
	class Item{
		var $itemID;
		var $name;
		var $price;
		var $desc;
		var $cals;
		var $prot;
		var $chol;
		var $sodi;
		var $picture;
		
		public function Item($id, $na, $pr, $de, $ca, $pt, $ch, $so, $pi){
			$this->itemID = $id;
			$this->name = $na;
			$this->price = $pr;
			$this->desc = $de;
			$this->cals = $ca;
			$this->prot = $pt;
			$this->chol = $ch;
			$this->sodi = $so;
			$this->picture = $pi;

		}
	}

	//This array holds items from database.
	$itemList = array();

	//Connect and Select	
	$con = makeConnection($dbhost, $dbuser, $dbpass, $dbname);
	$query = "SELECT * FROM items";
	$result = mysqli_query($con, $query);
	
	//Collect data from all items
	while($row = $result->fetch_assoc())
	{
		$tempItem = new Item($row['itemID'], $row['itemName'],  $row['price'], $row['description'], $row['calories'], $row['protein'], $row['choles'], $row['sodi'], $row['picLink']);

		$itemList[] = $tempItem;
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
		<title>Menu Page</title>
		<link rel="stylesheet" type="text/css" href="styles.css">
		<link rel="javascript" type="text/javascript" href="scripts/scripts.js">
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
		        		<li class="active"><a href="menu.php">Menu</a></li>
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
		<div id="menu-content" align="center">
			<h2>Welcome to the Menu Page</h2>
			<div id="menu-item-container" align="center">
				<!-- REQUIRED FOR SCRIPTS TO POPULATE MENU -->
				<!-- 			 DO NOT DELETE 	 		   -->
			</div>
			<script src="scripts/scripts.js">
			</script>
			<script> 
				var newItemList = [];
				var allItemsArray = <?php echo json_encode($itemList); ?>;
				//console.log("AllItemArray: " + allItemsArray);
				//Convert PHP Items to Javascript Items
				for(var i = 0; i < allItemsArray.length; i++){
					var tempItem = new ItemJS();
					var object = allItemsArray[i];
					//console.log(object);

					tempItem.name = object.name;
					tempItem.picture = object.picture;
					tempItem.description = object.desc;
					tempItem.cost = object.price;
				
					//Save to Array at index [i]
					newItemList[i] = tempItem;
				}
		
				//Call function to format data
				document.getElementById('menu-item-container').appendChild(createTableFormattedListOfItems(newItemList));	//Was itemArray

			</script>
		</div>
	</body>
</html>
