<?php
	
	class Phrase {

		private $id;
		private $phrase;
		private $author;

		public function __construct($id, $phrase, $author) {
			$this->id = $id;
			$this->phrase = $phrase;
			$this->author = $author;
		}
		
		public function __get($name) {
			return $this->$name;
		}

		public function __set($name, $value) {
			$this->$name = $value;
		}
		
	}
	
?>