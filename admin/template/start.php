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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" integrity="sha256-5Z/4A9O2iG86Ca27OwgMwLmRYt9bjLOoEpPXy7yhiSs=" crossorigin="anonymous" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js" integrity="sha256-CutOzxCRucUsn6C6TcEYsauvvYilEniTXldPa6/wu0k=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js" integrity="sha256-VrmtNHAdGzjNsUNtWYG55xxE9xDTz4gF63x/prKXKH0=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js" integrity="sha256-jgMYw0Xf+iO0EYC4pnX8tS4vmDqyjtJ9dwfSMMjSZuY=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css" integrity="sha256-sJQnfQcpMXjRFWGNJ9/BWB1l6q7bkQYsRqToxoHlNJY=" crossorigin="anonymous" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.js" integrity="sha256-m68J/1YV2ekOkpVRiOlz7WamDtyEAitsWGNJjAk8Uz4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-pt_BR.js" integrity="sha256-I8L8Qw8w7cKxu+sxX7YUooXx0ecodKAfrJjtcpgbsiU=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="/inc/loader.css" />
	<script src="/inc/loader.js"></script>
	<script src="/inc/admin.js"></script>
</head>
<body>
	<div id="loader-wrapper">
		<div id="loader"></div>
	</div>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="/">Visualizar o site</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Alterar navegação">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="/admin/events.php">Gerenciar eventos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#" data-toggle="modal" data-target="#addEventModal">Adicionar evento</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/admin/logout.php">Sair</a>
				</li>
			</ul>
			<form class="form-inline my-2 my-lg-0" method="get">
				<input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar" name="search" />
				<button class="btn btn-primary my-2 my-sm-0" type="submit">Buscar</button>
			</form>
		</div>
	</nav>
	<div class="container-fluid">