<html>
	<head>
		<title>My Shopping Cart</title>
	</head>
	<body>
		<div id=itemContainer>
		</div>
		
		<?php
			# Heavily Influenced by Larry Ullman
			try{
				require("myCart.php");
				$cart = new Cart();

				require("Item.php");
				$item1 = new Item("777", "Test Item 1", 4.95);
				$item2 = new Item("757", "Test Item 2", 5.55);
				$item3 = new Item("737", "Test Item 3", 3.33);
				
				//Test Cart
				$cart->addItem($item1);
				$cart->addItem($item2);
				$cart->addItem($item3);

				#var_dump($cart);

				//Update Quantities
				$cart->updateItem($item1, 99);
				$cart->updateItem($item3, 0);	

				#var_dump($cart->current());

				#var_dump($cart);

				//Delete Items
				$cart->deleteItem($item2);

				//Display contents
				echo "<h2> Cart Contains (" . count($cart) . " items)</h2>";

				if(!$cart->isEmpty()){
					foreach($cart as $array){
						$item = $array['item'];
						$subtotal = $array['quantity']*$item->getPrice();

						printf('<p><strong>%s</strong>: %d @ $%0.2f each. -- Subtotal: $%0.2f<p>', $item->getName(), $array['quantity'], $item->getPrice(), $subtotal);
					}
				}
			}
			catch(Exception $e){
				//Handle here, but I'm not going to.
			}
		?>

	</body>
</html>