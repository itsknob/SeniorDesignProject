<!DOCTYPE html>
!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


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
	$dbpass = "";
	$dbname = "juice_db";

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

 
  //Get the value and type from the javascript below
  //If the type is null display the whole table
  //$value = $_POST['type'];
  $v = mysqli_real_escape_string($con,$v);
  //$type = $_POST['value'];

  if($c==null){
	$query = "SELECT * FROM items";
  }
  else{
  $query = "SELECT * FROM items WHERE '"$c"' < '"$v"' ";  
  }
   
	$result = mysqli_query($con, $query);
	
	//Collect data from all items
	while($row = $result->fetch_assoc())
	{
		$tempItem = new Item($row['itemID'], $row['itemName'],  $row['price'], $row['desc'], $row['calories'], $row['protein'], $row['choles'], $row['sodi'], $row['picLink']);

		$itemList[] = $tempItem;
	}
 ?>





<html>
<head>
  
</head>
<body>
  
  
  
</body>
</html>