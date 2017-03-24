<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  

<?php
// define variables and set to empty values
$twitter = "";
$nameErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $twitter = test_input($_POST["twitter"]);
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

<h2>PHP Form Validation Example</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
  Twitter: <input type="text" name="twitter">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $twitter;
?>

</body>
</html>