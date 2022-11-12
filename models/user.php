<?php
	
	class User {

		private $id;
		private $username;
		private $password;
		private $name;

		public function __construct($id, $username, $password, $name) {
			$this->id = $id;
			$this->username = $username;
			$this->password = $password;
			$this->name = $name;
		}
		
		public function __get($name) {
			return $this->$name;
		}

		public function __set($name, $value) {
			$this->$name = $value;
		}
		
	}
	
?>