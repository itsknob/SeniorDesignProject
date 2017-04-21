<?php
  include "scripts.php";
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "root";
  $dbname = "inventory";
  $output = '';
  $search = $_POST["query"];
	$db = new PDO('mysql:host=localhost;dbname=inventory;charset=utf8', 'root', 'root');
  if(isset($_POST["query"]))
  {
    
    $items = $db->prepare("
      SELECT * FROM items 
      WHERE itemName LIKE '%".$search."%'
      OR price LIKE '%".$search."%' 
      OR description LIKE '%".$search."%' 
    ");
    $items->execute();
    $items = $items->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($items);
    }
  else
  {
    return;
  }
?>