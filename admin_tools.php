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

<h2>PHP Form Validation Example</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
  Twitter: <input type="text" name="twitter">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $twitter;
?>


<?php

// configuration
//$url = 'http://domain.com/backend/editor.php';
$file = 'aboutus.txt';

// check if form has been submitted
if (isset($_POST['text']))
{
    // save the text contents
    file_put_contents($file, $_POST['text']);

    // redirect to form again
    //header(sprintf('Location: %s', $url));
    //printf('<a href="%s">Moved</a>.', htmlspecialchars($url));
    //exit();
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

</body>
</html>