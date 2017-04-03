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
<!--***********Twitter Handle******************-->
<?php
$twitterHandleText = changeTextFile("twitterHandle.txt", "twitter");
?>

<h2>Enter Twitter Handle:</h2>
<form action="" method="post">
<textarea name="twitter"><?php echo htmlspecialchars($twitterHandleText) ?></textarea><br>
<input type="submit" />
<input type="reset" />
</form>

<br>
<!--********About Us Text*******************-->
<?php
$aboutUsText = changeTextFile("aboutUs.txt", "aboutUs");
?>

<h2>Enter about us:</h2>
<form action="" method="post">
<textarea name="aboutUs" cols=48 rows=24><?php echo htmlspecialchars($aboutUsText) ?></textarea><br>
<input type="submit" />
<input type="reset" />
</form>

<!--*******************About Us Image***********-->
<?php
uploadAboutPicture("fileToUpload");
?>

<h2>Upload About Us Picture</h2>
<form action="admin_tools.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>