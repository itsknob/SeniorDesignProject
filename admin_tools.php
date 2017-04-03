<!DOCTYPE HTML>  
<?php
    session_start();
    $CompanyName = "NUWC Juicing";
    //Used to set session information
    include "scripts.php";
    //Variables
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "root";
    $dbname = "admin_tools";
    $con = makeConnection($dbhost, $dbuser, $dbpass, $dbname);

?>
<html>
<head>
</head>
<body>  

<?php
// define variables and set to empty values
$twitter = "";
$nameErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //$twitter = test_input($_POST["twitter"]);
  if (!preg_match("/^[a-zA-Z ]*$/",$twitter)) {
    $nameErr = "Please only enter your twitter handle without the '@'"; 
}
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h1>Admin Tools</h1>

<h2>Enter Twitter Handle:</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
  Twitter: <input type="text" name="twitter">  
</form>

<br>

<?php

$file = 'aboutus.txt';

// check if form has been submitted
if (isset($_POST['text']))
{
    // save the text contents
    file_put_contents($file, $_POST['text']);

}

// read the textfile
$text = file_get_contents($file);

?>
<!-- HTML form -->
<h2>Enter about us:</h2>
<form action="" method="post">
<textarea name="text" cols=48 rows=24><?php echo htmlspecialchars($text) ?></textarea><br>
<input type="submit" />
<input type="reset" />
</form>



<!-- HTML form for editing the about us picture -->
<h2>Upload About Us Picture</h2>
<form action="admin_tools.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

<!--************File upload for About Us Page*************-->
<?php
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
//Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
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
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "images/aboutuspic.png")) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

</body>
</html>