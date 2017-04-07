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
  else if($checkerClass == 'sugars'){
      $sugars = (isset($_POST['value'])) ? $_POST['value'] : null;
      if ($sugars) {
    
      $items = $db->prepare('SELECT * FROM items WHERE sugars < :value');
      $items->execute(['value' => $sugars]);
      $items = $items->fetchAll(PDO::FETCH_ASSOC);

      echo json_encode($items);
  }
    }

  else if($checkerClass == 'price'){
      $price = (isset($_POST['value'])) ? $_POST['value'] : null;
    
      if ($price) {
    
      $items = $db->prepare('SELECT * FROM items WHERE price < :value');
      $items->execute(['value' => $price]);
      $items = $items->fetchAll(PDO::FETCH_ASSOC);

      echo json_encode($items);
  }
    }
?>
