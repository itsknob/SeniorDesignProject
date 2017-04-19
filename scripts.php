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
			    if (move_uploaded_file($_FILES[$ftu]["tmp_name"], $target_file)) {
			        echo "The file ". basename( $_FILES[$ftu]["name"]). " has been uploaded.";
			    } else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}
	}
	function uploadProdPic($ftu) {
		$target_dir = "images/";
		$target_file = $target_dir . basename($_FILES[$ftu]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		    $check = getimagesize($_FILES[$ftu]["tmp_name"]);
		    if($check !== false) {
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
			    if (move_uploaded_file($_FILES[$ftu]["tmp_name"], $target_file)) {
			       // echo "The file ". basename( $_FILES[$ftu]["name"]). " has been uploaded.";
			    } else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}
	}
	function changeTextFile($filename, $formName) {
		$file = 'adminTools/'. $filename;

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
    function addProductForm() {
    	echo 	'<form action="" method="POST" enctype="multipart/form-data">
    				Item Name:<br>
				    <textarea name="itemName" ></textarea>
				    <br>
				    Price:<br>
				    <textarea name="price" ></textarea>
				    <br>
				    Description:<br>
				    <textarea name="desc" rows=7 cols=40 ></textarea>
				    <br>
				    Calories:<br>
				    <textarea name="cal" ></textarea>
				    <br>
				    Protein:<br>
				    <textarea name="prot" ></textarea>
				    <br>
				    Choles:<br>
				    <textarea name="chol" ></textarea>
				    <br>
				    Sodium:<br>
				    <textarea name="sodi" ></textarea>
				    <br>
				    Carbohydrates:<br>
				    <textarea name="carb" ></textarea>
				    <br>
				    Sugar:<br>
				    <textarea name="sugar" ></textarea>
				    <br>
				    Picture:<br>
				    <input type="file" name="picLink" id="picLink">
				    <input type="submit" value="Add Product" name="prodSubmit">
				</form>';
    }
    function editProductForm($prod) {
    	echo 	'<form action="" method="POST" enctype="multipart/form-data">
    				<br>Item Name:<br>
				    <textarea name="itemName" >'.$prod["itemName"].'</textarea>
				    <br>
				    Price:<br>
				    <textarea name="price" >'.$prod["price"].'</textarea>
				    <br>
				    Description:<br>
				    <textarea name="desc" rows=7 cols=40 >'.$prod["description"].'</textarea>
				    <br>
				    Calories:<br>
				    <textarea name="cal" >'.$prod["calories"].'</textarea>
				    <br>
				    Protein:<br>
				    <textarea name="prot" >'.$prod["protein"].'</textarea>
				    <br>
				    Choles:<br>
				    <textarea name="chol" >'.$prod["choles"].'</textarea>
				    <br>
				    Sodium:<br>
				    <textarea name="sodi" >'.$prod["sodi"].'</textarea>
				    <br>
				    Carbohydrates:<br>
				    <textarea name="carb" >'.$prod["carbo"].'</textarea>
				    <br>
				    Sugar:<br>
				    <textarea name="sugar" >'.$prod["sugars"].'</textarea>
				    <br>
				    Current Picture:<br>
				    <img src=images/'.$prod["picLink"].' /><br />
				    New Picture:<br>
				    <input type="file" name="picLink" id="picLink"><br><br>
				    <input type="submit" value="Edit Product" name="changeSubmit">
				</form>';
    }
    function editProduct( $itm, $prc, $dsc, $cl, $prt, $chl, $sdi, $crb, $sgr, $pclnk=null ) {
    		$itemName = mysqli_real_escape_string($con, $_REQUEST[$itm]);
            $price = mysqli_real_escape_string($con, $_REQUEST[$prc]);
            $desc = mysqli_real_escape_string($con, $_REQUEST[$dsc]);
            $cal = mysqli_real_escape_string($con, $_REQUEST[$cl]);
            $prot = mysqli_real_escape_string($con, $_REQUEST[$prt]);
            $chol = mysqli_real_escape_string($con, $_REQUEST[$chl]);
            $sodi = mysqli_real_escape_string($con, $_REQUEST[$sdi]);
            $carb = mysqli_real_escape_string($con, $_REQUEST[$crb]);
            $sugar = mysqli_real_escape_string($con, $_REQUEST[$sgr]);
            if($pcLnk != null) {
            	$pic = mysqli_real_escape_string($con, basename($_FILES[$pcLnk]["name"]));

            	$sql = $db->prepare( 
            	"UPDATE items 
            	SET itemName='$itemName', price='$price', description='$desc', calories='$cal', protein='$prot', choles='$chol', 
            	sodi='$sodi', picLink='$pcLnk', carbo='$carb', sugars='$sugar'" );
            	if ($sql->execute()){
                	echo '<br>Product added successfully. Please refresh page to see changes.';
            	} else {
                	echo 'error';
            	}
            }
            else {
            	$sql = $db->prepare( 
            	"UPDATE items 
            	SET itemName='$itemName', price='$price', description='$desc', calories='$cal', protein='$prot', choles='$chol', 
            	sodi='$sodi', carbo='$carb', sugars='$sugar'" );
            	if ($sql->execute()){
                	echo '<br>Product added successfully. Please refresh page to see changes.';
            	} else {
                	echo 'error';
            	}
            }
            
    }
	
?>
