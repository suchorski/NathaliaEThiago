<?php

	class ConnectionService {

		const URL = 'mysql:dbname=u420570477_event;host=localhost';
		const USERNAME = 'u420570477_event';
		const PASSWORD = 'RiL3O|Fl5N9ueE*T';

		private $con;

		public function __construct($autoCommit = FALSE) {
			try {
				$this->con = new PDO(self::URL, self::USERNAME, self::PASSWORD);
				$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->con->setAttribute(PDO::ATTR_AUTOCOMMIT, $autoCommit);
				$this->con->exec('SET NAMES utf8');
			} catch (PDOException $e) {
				die($e->getMessage());
			}
		}

		public function __destruct() {
			$con = null;
		}

		public function __get($name) {
			return $this->$name;
		}
		
	}

?>