<?php
	
	require_once(__DIR__.'/connections.php');
	require_once(__DIR__.'/../models/photo.php');
	
	class PhotosService {

		public static function insert($photo, $idEvent, $con) {
			$sql = 'INSERT INTO photo (filename, type, photo, thumb, portrait, id_event) VALUES (:filename, :type, :photo, :thumb, :portrait, :id_event)';
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':filename', $photo->filename);
			$stmt->bindValue(':type', $photo->type);
			$stmt->bindValue(':photo', $photo->photo);
			$stmt->bindValue(':thumb', $photo->thumb);
			$stmt->bindValue(':portrait', $photo->portrait);
			$stmt->bindValue(':id_event', $idEvent);
			$stmt->execute();
		}

		public static function getById($id, $thumb) {
			$sql = 'SELECT id, filename, type, photo, thumb, portrait, count FROM photo WHERE id = :id';
			$svc = new ConnectionService(TRUE);
			$stmt = $svc->con->prepare($sql);
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				if (!$thumb) {
					self::updateCount($id);
					return new Photo($row['id'], $row['filename'], $row['type'], $row['photo'], false, $row['portrait'], $row['count']);
				}
				return new Photo($row['id'], $row['filename'], $row['type'], $row['thumb'], true, $row['portrait'], $row['count']);
			}
			throw new InfoException('Foto não encontrada');
		}

		public static function listThumbsByEventId($idEvent, $con) {
			$sql = 'SELECT id, filename, type, thumb, portrait, count FROM photo WHERE id_event = :id_event ORDER BY id ASC';
			$thumbs = array();
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':id_event', $idEvent);
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$thumbs[] = new Photo($row['id'], $row['filename'], $row['type'], $row['thumb'], true, $row['portrait'], $row['count']);
			}
			return $thumbs;
		}

		public static function listMaxFourByEventId($idEvent) {
			$sql = 'SELECT id, filename, type, photo, portrait, count FROM photo WHERE id_event = :id_event ORDER BY id ASC LIMIT 4';
			$photos = array();
			$svc = new ConnectionService(TRUE);
			$stmt = $svc->con->prepare($sql);
			$stmt->bindValue(':id_event', $idEvent);
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$photos[] = new Photo($row['id'], $row['filename'], $row['type'], $row['photo'], false, $row['portrait'], $row['count']);
			}
			return $photos;
		}

		private static function updateCount($id) {
			$sql = 'UPDATE photo SET count = count + 1 WHERE id = :id';
			$svc = new ConnectionService(TRUE);
			$stmt = $svc->con->prepare($sql);
			$stmt->bindValue(':id', $id);
			$stmt->execute();
		}

	}
	
?>