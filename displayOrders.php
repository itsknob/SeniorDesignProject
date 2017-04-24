<table cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;"><strong>Time</strong></th>
<th style="text-align:left;"><strong>Order ID</strong></th>
<th style="text-align:right;"><strong>Order Description</strong></th>
<th style="text-align:right;"><strong>Total</strong></th>
<th style="text-align:center;"><strong>Email</strong></th>
</tr>	
<tr>

<?php
	$db = new PDO('mysql:host=localhost;dbname=inventory;charset=utf8', 'root', 'root');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = $db->prepare("SELECT * FROM orders");
		$sql->execute();
		$orders = $sql->fetchAll(PDO::FETCH_ASSOC);
		//print_r($orders);
		echo '<br>';

	foreach($orders as $order) {
		if (isset($_POST[$order['orderID']])) {
			$sql = $db->prepare("DELETE FROM orders WHERE orderID='".$order['orderID']."'");
			if($sql->execute()) {
				echo 'Order Deleted Successfully';
			}
		}
		//print_r($order);
		echo '<br><br>';
		$order["price"] = $order["price"]/100;
		$time = date('Y-m-d h:iA', strtotime($order["Time"]));

	?>
		<tr>
		<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $time; ?></td>
		<td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $order["orderID"]; ?></strong></td>
		<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $order["description"]; ?></td>
		<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo "$".number_format($order["price"], 2); ?></td>
		<td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><?php echo $order["email"]; ?></td>
		<td style="text-align:center;border-bottom:#F0F0F0 1px solid;">
			<form method="post" action="/orders.php">
				<input type="submit" name="<?php echo $order['orderID'] ?>" value="Delete">
			</form>
		</td>
		</tr>
<?php
	}
?>
</tr>
</tbody>
</table>