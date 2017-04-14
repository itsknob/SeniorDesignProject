<?php # Item.php
		# Heavily Influenced by Larry Ullman

	class Item{
		protected $id;
		protected $name;
		protected $price;
		#protected $description;
		#protected $calories;
		#protected $cholesterol;
		#protected $sodium;
		#protected $picture;

		# Constructor
		public function __construct($id, $name, $price){#, $description, $calories, $cholesterol, $sodium, $picture){
			$this->id = $id;
			$this->name = $name;
			$this->price = $price;
			#$this->description = $description;
			#$this->calories = $calories;
			#$this->cholesterol = $cholesterol;
			#$this->sodium = $sodium;
			#$this->picture = $picture;
		}

		# Retrieve Item ID
		public function getID(){
			return $this->id;
		}
		# Retrieve Item Name
		public function getName(){
			return $this->name;
		}
		# Retrieve Item Price
		public function getPrice(){
			return $this->price;
		}
	}
?>