<?php
	
	class Rsvp {

		private $id;
		private $name;
		private $isGoing;
		private $adults;
		private $children;
		private $creationDate;
		private $event;

		public function __construct($id, $name, $isGoing, $adults, $children, $creationDate, $event) {
			$this->id = $id;
			$this->name = $name;
			$this->isGoing = $isGoing;
			$this->adults = $adults;
			$this->children = $children;
			$this->creationDate = $creationDate;
			$this->event = $event;
		}

		public function __get($name) {
			return $this->$name;
		}

		public function __set($name, $value) {
			$this->$name = $value;
		}

	}
	
?>