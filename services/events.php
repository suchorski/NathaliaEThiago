<?php
	
	require_once(__DIR__.'/connections.php');
	require_once(__DIR__.'/photos.php');
	require_once(__DIR__.'/phrases.php');
	require_once(__DIR__.'/../models/event.php');
	require_once(__DIR__.'/../exceptions/info.php');
	
	class EventsService {

		public static function insert($event) {
			try {
				$sql = 'INSERT INTO event (title, text, date) VALUES (:title, :text, :date)';
				$svc = new ConnectionService();
				$svc->con->beginTransaction();
				$stmt = $svc->con->prepare($sql);
				$stmt->bindValue(':title', $event->title);
				$stmt->bindValue(':text', $event->text);
				$stmt->bindValue(':date', $event->date);
				$stmt->execute();
				$eventId = $svc->con->lastInsertId();
				foreach ($event->photos as $photo) {
					PhotosService::insert($photo, $eventId, $svc->con);
				}
				foreach ($event->phrases as $phrase) {
					PhrasesService::insert($phrase, $eventId, $svc->con);
				}
				$svc->con->commit();
			} catch (PDOException $e) {
				$svc->con->rollback();
				throw $e;
			}
		}

		public static function getById($id) {
			try {
				$sql = 'SELECT * FROM event WHERE id = :id';
				$svc = new ConnectionService();
				$svc->con->beginTransaction();
				$stmt = $svc->con->prepare($sql);
				$stmt->bindValue(':id', $id);
				$stmt->execute();
				if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$event = new Event($row['id'], $row['title'], $row['text'], $row['date'], PhotosService::listThumbsByEventId($id, $svc->con), PhrasesService::listByEventId($id, $svc->con), $row['count']);
					self::updateCount($id, $svc->con);
					$svc->con->commit();
					return $event;
				} else {
					$svc->con->commit();
					throw new InfoException('Evento não encontrado');
				}
			} catch (PDOException $e) {
				$svc->con->rollback();
				throw $e;
			}
		}

		public static function list($search = '') {
			$sql = 'SELECT * FROM event ORDER BY date DESC';
			if ($search !== '') {
				$sql = 'SELECT * FROM event WHERE title LIKE :search OR MONTHNAME(date) LIKE :search OR DATE_FORMAT(date, \'%d/%m/%Y\') LIKE :search ORDER BY date DESC';
			}
			$events = array();
			$svc = new ConnectionService(TRUE);
			$stmt = $svc->con->prepare($sql);
			if ($search !== '') {
				for ($i = 1; $i <= 3; ++$i) {
					$stmt->bindValue(':search', $search);
				}
			}
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$events[] = new Event($row['id'], $row['title'], $row['text'], $row['date'], array(), array(), $row['count']);
			}
			return $events;
		}

		public static function getLast() {
			try {
				$sql = 'SELECT * FROM event ORDER BY date DESC LIMIT 1';
				$svc = new ConnectionService(TRUE);
				$svc->con->beginTransaction();
				$stmt = $svc->con->prepare($sql);
				$stmt->execute();
				if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$eventId = $row['id'];
					$event = new Event($eventId, $row['title'], $row['text'], $row['date'], PhotosService::listThumbsByEventId($eventId, $svc->con), PhrasesService::listByEventId($eventId, $svc->con), $row['count']);
					self::updateCount($row['id'], $svc->con);
					$svc->con->commit();
					return $event;
				} else {
					$svc->con->commit();
					throw new InfoException('Evento não encontrado');
				}
			} catch (PDOException $e) {
				$svc->con->rollback();
				throw $e;
			}
		}

		public static function deleteById($id) {
			$sql = 'DELETE FROM event WHERE id = :id';
			$svc = new ConnectionService(TRUE);
			$stmt = $svc->con->prepare($sql);
			$stmt->bindValue(':id', $id);
			$stmt->execute();
		}

		private static function updateCount($id, $con) {
			$sql = 'UPDATE event SET count = count + 1 WHERE id = :id';
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':id', $id);
			$stmt->execute();
		}

	}
	
?>