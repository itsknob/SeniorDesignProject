<?php
  include "scripts.php";
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "root";
  $dbname = "inventory";
  $output = '';
  $search = $_POST["query"];
	$db = new PDO('mysql:host=localhost;dbname=user_information;charset=utf8', 'root', 'root');
  if(isset($_POST["query"]))
  {
    
    $users= $db->prepare("
      SELECT * FROM login_information 
      WHERE user_name LIKE '%".$search."%'
    ");
    $users->execute();
    $users = $users->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($users);
    }
  else
  {
    return;
  }
?>