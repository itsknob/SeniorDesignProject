<?php
	$db = new PDO('mysql:host=localhost;dbname=juicing;charset=utf8', 'root', '');
  $calories = (isset($_POST['calories'])) ? $_POST['calories'] : null;



  //$v = mysqli_real_escape_string($con,$v);
  //$type = $_POST['value'];
  if ($calories) {
    
    $items = $db->prepare('SELECT * FROM items WHERE calories < :calories');
    $items->execute(['calories' => $calories]);
    $items = $items->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($items);
  }
//mysqli_free_result($result);
//mysqli_close($connection);
//else {
//  ...
//}
?>
