<?php

	require_once(__DIR__.'/../../services/events.php');
	require_once(__DIR__.'/../../utils/utils.php');
	require_once(__DIR__.'/../../exceptions/info.php');

	session_start();
	if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
		header('Location: /admin/login.php');
		exit();
	}

	$action = Utils::parseString($_POST, 'action', '');
	$id_event = Utils::parseInt($_POST, 'id_event', 0);

	switch ($action) {
		case 'create':
			$title = Utils::parseString($_POST, 'title', '');
			$text = Utils::parseString($_POST, 'text', '');
			$date = Utils::parseDate($_POST, 'date');
			$photos = array();
			$count = count($_FILES['photos']['name']);
			for ($i = 0; $i < $count; ++$i) {
				$type = mime_content_type($_FILES['photos']['tmp_name'][$i]);
				if (in_array($type, array('image/png', 'image/jpeg'))) {
					$filename = $_FILES['photos']['name'][$i];
					$content = Utils::exifRotate($_FILES['photos']['tmp_name'][$i]);
					$photo = Utils::imageResize($content, 1920, 1080);
					$thumb = Utils::imageResize($content, 640, 360, 60);
					$portrait = imagesx($content) < imagesy($content);
					$photos[] = new Photo(0, $filename, 'image/jpeg', base64_encode($photo), base64_encode($thumb), $portrait);
				}
			}
			if (count($photos) === 0) {
				throw new InfoException("Nenhuma foto foi selecionada");
				break;
			}
			$phrases = array();
			foreach ($_POST['phrases'] as $phrase) {
				$phrases[] = new Phrase(0, $phrase['phrase'], $phrase['author']);
			}
			EventsService::insert(new Event(0, $title, $text, $date, $photos, $phrases, 0));
			break;
		case 'delete':
			EventsService::deleteById($id_event);
			break;
		default:
			break;
	}

	header('Location: /admin/events.php');

?>