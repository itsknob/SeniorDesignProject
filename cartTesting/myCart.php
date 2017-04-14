<?php	# myCart.php
		# Heavily Influenced by Larry Ullman
	
	# Implements Iterator for loopability, and Countable for count()
	class Cart implements Iterator, Countable {
		protected $itemList = array();		# List of items in cart
		protected $index = 0;				# Position in list
		protected $itemIDList = array();	# List of item's IDs

		# Constructor, Initialize this instance of Cart.
		function __construct(){
			$this->itemList = array();
			$this->itemIDList = array();
		}

		# Checks if list is empty
		public function isEmpty(){
			return (empty($this->itemList));
		}

		# Add item to cart.
		public function addItem(Item $item){
			//Acquire Item ID
			$id = $item->getID();

			//If the item's id doesn't exist, throw exception.
			if(!$id) 
				throw new Exception("Requires Unique ID");

			//If item is in the list, update the item's quantity instead
			if(isset($this->itemList[$id])){
				$this->updateItem($item, $this->itemList[$id]['quantity']+1);
			}
			//Otherwise, just add the item.
			else{
				$this->itemList[$id] = array('item' => $item, 'quantity' => 1);
				$this->itemIDList[] = $id;
			}

		}

		# Update the quantity of the item, remove if 0.
		public function updateItem($item, $quantity){
			//Acquire Item ID
			$id = $item->getId();

			//If quantity is 0, remove the item from the list.
			if($quantity === 0){
				$this->deleteItem($item);
			}
			//As long as the quantity is not zero AND not the currently set value Update the quantity
			else if(($quantity > 0) && ($quantity != $this->itemList[$id]['quantity'])){
				$this->itemList[$id]['quantity'] = $quantity;
			}
		}

		public function deleteItem($item){
			//Acquire Item ID
			$id = $item->getID();

			//Remove the item
			if(isset($this->itemList[$id])){
				//Remove from itemList
				unset($this->itemList[$id]);

				//Remove from itemIDList
				$index = array_search($id, $this->itemIDList);
				unset($this->itemIDList[$index]);

				//Fix Array so there's no gaps.
				$this->itemIDList = array_values($this->itemIDList);
			}
		}

		public function current(){
			//Get Current Index and return it.
			$index = $this->itemIDList[$this->index];
			return $this->itemList[$index];
		}

		// Required by Iterator; returns the current key:
		public function key() {
		    return $this->position;
		}

		// Required by Iterator; increments the position:
		public function next() {
		    $this->index++;
		}

		// Required by Iterator; returns the position to the first spot:
		public function rewind() {
		    $this->index = 0;
		}

		// Required by Iterator; returns a Boolean indiating if a value is indexed at this position:
		public function valid() {
			return (isset($this->itemIDList[$this->index]));
		}
		
		// Required by Countable:
		public function count() {
			return count($this->itemList);
		}

	}
?>