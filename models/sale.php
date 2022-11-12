<?php
	
	class Sale {

		private $id;
		private $name;
		private $email;
		private $date;
		private $product;

		public function __construct($id, $name, $email, $date, $product) {
			$this->id = $id;
			$this->name = $name;
			$this->email = $email;
			$this->date = $date;
			$this->product = $product;
		}

		public function __get($name) {
			return $this->$name;
		}

		public function __set($name, $value) {
			$this->$name = $value;
		}

	}
	
?>