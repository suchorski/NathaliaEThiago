<?php
	
	session_start();
	if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {
		header('Location: /admin/events.php');
		exit();
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Administração - Nathália e Thiago</title>
	<link rel="icon" type="image/png" href="/img/favicon.png"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous" />
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-7 text-center py-3">
				<img class="text-center" src="/img/favicon.png" />
			</div>
			<div class="col-md-7">
				<form method="post" action="login.php">
					<div class="form-group">
						<label for="username">Usuário</label>
						<input id="username" type="text" name="username" class="form-control" placeholder="Usuário" required autofocus>
					</div>
					<div class="form-group">
						<label for="password">Senha</label>
						<input id="password" type="password" name="password" class="form-control" placeholder="Senha" required>
					</div>
					<?php
						if (isset($_GET['info']) && !empty($_GET['info'])) {
							?>
								<div class="alert alert-danger"><?= $_GET['info'] ?></div>
							<?php
						}
					?>
					<input id="submit" type="submit" class="btn btn-primary btn-block" value="Entrar" />
				</form>
			</div>
		</div>
	</div>
</body>
</html>