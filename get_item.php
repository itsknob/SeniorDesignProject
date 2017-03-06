<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$q = intval($_GET['q']);

$con=mysqli_connect("localhost", "root", "") or die("Error connecting to database: ".mysqli_error());
  
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"juice_db");
$sql="SELECT * FROM items WHERE itemID = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>Name</th>
<th>Price</th>
<th>Description</th>
<th>Calories</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['itemName'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    echo "<td>" . $row['desc'] . "</td>";
    echo "<td>" . $row['calories'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>