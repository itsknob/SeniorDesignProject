<?php
	$db = new PDO('mysql:host=localhost;dbname=juicing;charset=utf8', 'root', '');

  $checkerClass = $_POST['class'];
  $checkerValue = $_POST['value'];

  if($checkerClass == 'calories'){
      $calories = (isset($_POST['value'])) ? $_POST['value'] : null;
    
      if ($calories){
    
      $items = $db->prepare('SELECT * FROM items WHERE calories < :value');
      $items->execute(['value' => $calories]);
      $items = $items->fetchAll(PDO::FETCH_ASSOC);

      echo json_encode($items);
      }
    }  
//     Sugar is not in the database yet
//  else if($checkerClass == 'sugar'){
//      $sugar = (isset($_POST['value'])) ? $_POST['value'] : null;
//      if ($sugar) {
//    
//      $items = $db->prepare('SELECT * FROM items WHERE sugar < :value');
//      $items->execute(['value' => $sugar]);
//      $items = $items->fetchAll(PDO::FETCH_ASSOC);
//
//      echo json_encode($items);
//  }
//    }

  else if($checkerClass == 'price'){
      $price = (isset($_POST['value'])) ? $_POST['value'] : null;
    
      if ($price) {
    
      $items = $db->prepare('SELECT * FROM items WHERE price < :value');
      $items->execute(['value' => $price]);
      $items = $items->fetchAll(PDO::FETCH_ASSOC);

      echo json_encode($items);
  }
    }
  
  //$v = mysqli_real_escape_string($con,$v);
  //$type = $_POST['value'];
    




//mysqli_free_result($result);
//mysqli_close($connection);
//else {
//  ...
//}
?>
