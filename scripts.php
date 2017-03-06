<?php
	//Variables
	//$dbhost = "localhost";
	//$dbuser = "root";
	//$dbpass = "root";
	
	function makeConnection($dbhost, $dbuser, $dbpass, $dbname){
		return $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);	
	}
	
	function populateSession($connection){
		echo "<h1>".$_SESSION['user']."</h1>"
		$query = "SELECT * FROM login_information WHERE user_name='" . $_SESSION['user'] . "'";
		//echo $query;
	
		$result = mysqli_query($connection, $query);
	
		$list =  mysql_fetch_array($result);
		$size_of_list = sizeof($list);
	
		//This one Works
		while($row = $result->fetch_assoc())
		{
			$_SESSION["user_name"] = $row["user_name"];
			$_SESSION["user_email"] = $row["user_email"];
		}
	}

?>
