<?php
  include "scripts.php";
	$db = new PDO('mysql:host=localhost;dbname=inventory;charset=utf8', 'root', 'root');

    $pop= $db->prepare("
      SELECT itemName, sales FROM items
    ");
    $pop->execute();
    $pop = $pop->fetchAll(PDO::FETCH_ASSOC);
//    echo json_encode($pop);
    

?>