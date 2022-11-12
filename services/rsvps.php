<?php
	
	require_once(__DIR__.'/connections.php');
	require_once(__DIR__.'/../models/rsvp.php');
	
	class RsvpsService {

		public static function insert($rsvp) {
				$sql = 'INSERT INTO rsvp (name, is_going, quantity_adult, quantity_children, id_event) VALUES (:name, :is_going, :quantity_adult, :quantity_children, :id_event)';
				$svc = new ConnectionService(TRUE);
				$stmt = $svc->con->prepare($sql);
				$stmt->bindValue(':name', $rsvp->name);
				$stmt->bindValue(':is_going', $rsvp->isGoing);
				$stmt->bindValue(':quantity_adult', $rsvp->adults);
				$stmt->bindValue(':quantity_children', $rsvp->children);
				$stmt->bindValue(':id_event', $rsvp->event->id);
				$stmt->execute();
		}

		public static function listByEventId($idEvent) {
			$sql = 'SELECT * FROM rsvp ORDER BY name ASC WHERE id_event = :id_event';
			$rsvps = array();
			$svc = new ConnectionService(TRUE);
			$stmt = $svc->con->prepare($sql);
			$stmt->bindValue(':id_event', $idEvent);
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$rsvps[] = new Rsvp($row['id'], $row['name'], $row['is_going'], $row['quantity_adult'], $row['quantity_children'], $row['creation_date'], NULL);
			}
			return $rsvps;
		}

	}
	
?>