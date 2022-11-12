<?php
	
	require_once(__DIR__.'/../services/users.php');
	require_once(__DIR__.'/../utils/utils.php');

	session_start();

	try {
		$username = Utils::parseString($_POST, 'username', '');
		$password = Utils::parseString($_POST, 'password', '');
		$name = UsersService::check($username, $password);
		$_SESSION['logged'] = true;
		$_SESSION['name'] = $name;
		header('Location: /admin/events.php');
	} catch (InfoException $e) {
		$_SESSION = array();
		header('Location: /admin/index.php?info='.$e->getMessage());
	}

?>