<?php
	
	class Event {

		private $id;
		private $title;
		private $text;
		private $date;
		private $photos = array();
		private $phrases = array();
		private $count;

		public function __construct($id, $title, $text, $date, $photos, $phrases, $count = 0) {
			$this->id = $id;
			$this->title = $title;
			$this->text = $text;
			$this->date = $date;
			$this->photos = $photos;
			$this->phrases = $phrases;
			$this->count = $count;
		}

		public function __get($name) {
			return $this->$name;
		}

		public function __set($name, $value) {
			$this->$name = $value;
		}

	}
?>