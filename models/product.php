<?php
	
	class Product {

		private $id;
		private $description;
		private $image;
		private $price;
		private $enabled;

		public function __construct($id, $description, $image, $price, $enabled) {
			$this->id = $id;
			$this->description = $description;
			$this->image = $image;
			$this->price = $price;
			$this->enabled = $enabled;
		}

		public function __get($name) {
			return $this->$name;
		}

		public function __set($name, $value) {
			$this->$name = $value;
		}

	}
	
?>