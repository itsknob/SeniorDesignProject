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
	function uploadAboutPicture($ftu){
		$target_dir = "images/";
		$target_file = $target_dir . basename($_FILES[$ftu]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["aboutPicSubmit"])) {
		    $check = getimagesize($_FILES[$ftu]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
			//Check file size
			if ($_FILES[$ftu]["size"] > 5000000) {
			    echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "Sorry, your file was not uploaded.";
			} else { // if everything is ok, try to upload file
			    if (move_uploaded_file($_FILES[$ftu]["tmp_name"], "images/aboutuspic.png")) {
			        echo "The file ". basename( $_FILES[$ftu]["name"]). " has been uploaded.";
			    } else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}
		}
	}
	function uploadSlidePicture($ftu){
		$target_dir = "images/slideshow/";
		$target_file = $target_dir . basename($_FILES[$ftu]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["slideSubmit"])) {
		    $check = getimagesize($_FILES[$ftu]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		
			//Check file size
			if ($_FILES[$ftu]["size"] > 5000000) {
			    echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "Sorry, your file was not uploaded.";
			} else { // if everything is ok, try to upload file
			    if (move_uploaded_file($_FILES[$ftu]["tmp_name"], "images/slideshow/$ftu.png")) {
			        echo "The file ". basename( $_FILES[$ftu]["name"]). " has been uploaded.";
			    } else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}
		}
	}
	function changeTextFile($filename, $formName) {
		$file = $filename;

		// check if form has been submitted
		if (isset($_POST[$formName]))
		{
		    // save the text contents
		    file_put_contents($file, $_POST[$formName]);
		}

		// read the textfile
		$text = file_get_contents($file);
		return $text;
	}
?>
