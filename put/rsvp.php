<?php

	require_once(__DIR__.'/../services/rsvps.php');
	require_once(__DIR__.'/../models/event.php');

	$status = false;
	$message = "Por favor digite o captcha corretamente.";

	if (isset($_POST['g-recaptcha-response'])) {
		$captchaData = $_POST['g-recaptcha-response'];
		$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfII3kUAAAAAHqGydqTOwS_UfW_fOM78MLMLBxj&response=".$captchaData."&remoteip=".$_SERVER['REMOTE_ADDR']);
		if (json_decode($response, true)['success']) {
			try {
				RsvpsService::insert(new Rsvp(0, $_POST['name'], $_POST['showup'], $_POST['adults'], $_POST['children'], 0, new Event(3, '', '', 0, NULL, NULL)));
				$status = true;
				$message = "Obrigado por confirmar sua presença!";
			} catch (Exception $e) {
				$message = "Erro ao registrar sua presença.";
			}
		}
	}

	echo json_encode(array('status' => $status, 'message' => $message));

?>