<?php
	
	require_once(__DIR__.'/connections.php');
	require_once(__DIR__.'/../models/phrase.php');
	
	class PhrasesService {

		public static function insert($phrase, $idEvent, $con) {
			$sql = 'INSERT INTO phrase (phrase, author, id_event) VALUES (:phrase, :author, :id_event)';
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':phrase', $phrase->phrase);
			$stmt->bindValue(':author', $phrase->author);
			$stmt->bindValue(':id_event', $idEvent);
			$stmt->execute();
		}

		public static function listByEventId($idEvent, $con) {
			$sql = 'SELECT * FROM phrase WHERE id_event = :id_event ORDER BY id ASC';
			$phrases = array();
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':id_event', $idEvent);
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$phrases[] = new Phrase($row['id'], $row['phrase'], $row['author']);
			}
			return $phrases;
		}

	}
	
?>