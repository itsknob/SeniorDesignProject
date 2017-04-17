<?php
  include "scripts.php";

  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "";
  $dbname = "juicing";

  $output = '';

  $connect = mysqli_connect("localhost", "root", "", "juicing");
  if(isset($_POST["query"]))
  {
    $search = mysqli_real_escape_string($connect, $_POST["query"]);
    $query = "
      SELECT * FROM items 
      WHERE itemName LIKE '%".$search."%'
      OR price LIKE '%".$search."%' 
      OR description LIKE '%".$search."%' 
      OR calories LIKE '%".$search."%' 
      OR protein LIKE '%".$search."%'
    ";
    }
  else
  {
    return;
  }
  $result = mysqli_query($connect, $query);
  if(mysqli_num_rows($result) > 0)
  {
    $output .= '
    <div class="table-responsive">
    <table class="table table bordered">
      <tr>
      <th>Drink Name</th>
      <th>Price</th>
      <th>Description</th>
      <th>Calories</th>
      <th>Protein</th>
      </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
    $output .= '
    <tr>
      <td>'.$row["itemName"].'</td>
      <td>'.$row["price"].'</td>
      <td>'.$row["description"].'</td>
      <td>'.$row["calories"].'</td>
      <td>'.$row["protein"].'</td>
    </tr>
    ';
  }
  echo $output;
  }
  else
  {
    echo 'Data Not Found';
  }
?>