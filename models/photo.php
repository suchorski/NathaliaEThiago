<?php
	
	class Photo {

		private $id;
		private $filename;
		private $type;
		private $photo;
		private $thumb;
		private $portrait;
		private $count;

		public function __construct($id, $filename, $type, $photo, $thumb, $portrait, $count = 0) {
			$this->id = $id;
			$this->filename = $filename;
			$this->type = $type;
			if (is_bool($thumb)) {
				$this->photo = $thumb ? '' : $photo;
				$this->thumb = $thumb ? $photo : '';
			} else {
				$this->photo = $photo;
				$this->thumb = $thumb;
			}
			$this->portrait = $portrait;
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