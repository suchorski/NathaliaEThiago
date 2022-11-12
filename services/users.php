<?php
	
	require_once(__DIR__.'/connections.php');
	require_once(__DIR__.'/../models/user.php');
	require_once(__DIR__.'/../exceptions/info.php');
	
	class UsersService {

		public static function check($username, $password) {
			$sql = 'SELECT name FROM user WHERE username = :username AND password = SHA1(:password)';
			$svc = new ConnectionService(TRUE);
			$stmt = $svc->con->prepare($sql);
			$stmt->bindValue(':username', $username);
			$stmt->bindValue(':password', $password);
			$stmt->execute();
			if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				return $row['name'];
			}
			throw new InfoException('Usuário ou senha inválidos');
		}

	}
	
?>