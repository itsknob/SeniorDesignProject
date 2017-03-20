<?php
	//Variables
	//$dbhost = "localhost";
	//$dbuser = "root";
	//$dbpass = "root";
	
	function makeConnection($dbhost, $dbuser, $dbpass, $dbname){
		return $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);	
	}
	
	//Gets run on Login to populate session with user data.
	function populateSession($connection){
		$query = "SELECT * FROM login_information WHERE user_name='" . $_SESSION['user_name'] . "'";
		//echo $query;
	
		$result = mysqli_query($connection, $query);
		
		/*
		$list = mysql_fetch_array($result);
		$size_of_list = sizeof($list);
		*/
		//This one Works
		while($row = $result->fetch_assoc())
		{
			//Username is already stored on login.
			$_SESSION['user_email'] = $row['user_email'];
			$_SESSION['isAdmin'] = $row['isAdmin'];
		}
	}

?>
