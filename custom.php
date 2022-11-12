<?php
	
	require_once(__DIR__.'/config.php');
	require_once(__DIR__.'/services/events.php');
	
	try {
		$events = EventsService::list();
	} catch (InfoException $e) {
		include(__DIR__.'/errors/404.php');
		exit();
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Nathália e Thiago</title>
	<link rel="icon" type="image/png" href="/img/favicon.png"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous" />
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css" integrity="sha256-sJQnfQcpMXjRFWGNJ9/BWB1l6q7bkQYsRqToxoHlNJY=" crossorigin="anonymous" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.js" integrity="sha256-m68J/1YV2ekOkpVRiOlz7WamDtyEAitsWGNJjAk8Uz4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-pt_BR.js" integrity="sha256-I8L8Qw8w7cKxu+sxX7YUooXx0ecodKAfrJjtcpgbsiU=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/paroller.js@1.4.4/dist/jquery.paroller.min.js" integrity="sha256-me2GHKjxs5tJsJFaJjp/aHOfptn7pArJel3g748NGOs=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="/inc/event.css" />
	<script src="/inc/event.js"></script>
	<link rel="stylesheet" href="/inc/loader.css" />
	<script src="/inc/loader.js"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<script type="text/javascript">
		var date = new Date(2019, 1, 16, 20, 30, 0, 0);
		var phrases = [
		["Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.", "Desconhecido"],
		["Phasellus ultrices nulla quis nibh. Quisque a lectus.", "Lorem Ipsum"]
		];
		$(document).ready(function() {
			changePhrase(phrases);
			setInterval(function() {
				changePhrase(phrases);
			}, 5000);
			updateDate(date);
			setInterval(function() {
				updateDate(date);
			}, 1000);
			$('#showup').on('change', function() {
				var showUp = $(this).val() == 1;
				$('#adults').prop('disabled', !showUp);
				$('#children').prop('disabled', !showUp);
			});
			$('#ajaxForm').submit(function() {
				$('#ajaxSubmit').attr('disabled', 'disabled');
				var dt = $(this).serialize();
				$.ajax({
					type: 'post',
					url: '/put/rsvp.php',
					data: dt,
					success: function(data) {
						$('#ajaxSubmit').removeAttr('disabled');
						alert($.parseJSON(data).message);
					}
				});
				return false;
			});
		});
	</script>
</head>
<body>
	<div id="loader-wrapper">
		<div id="loader"></div>
	</div>
	<div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
		<div class="carousel-indicators">
			<div class="vert-move text-center">
				<a class="nav-link smooth-anchor" href="#event"><big class="display-2 stroke">O Casamento</big></a>
				<i class="fa fa-angle-double-down stroke white"></i>
			</div>
		</div>
		<div class="carousel-inner">
			<div class="carousel-item active" style="background-image: url('/img/banner1.jpg')">&nbsp;</div>
			<div class="carousel-item" style="background-image: url('/img/banner2.jpg')">&nbsp;</div>
			<div class="carousel-item" style="background-image: url('/img/banner3.jpg')">&nbsp;</div>
		</div>
	</div>
	<nav class="navbar navbar-expand-md navbar-light bg-light mb-5 sticky-top">
		<button class="navbar-toggler mr-2" type="button" data-toggle="collapse" data-target="#navbar">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="d-flex flex-fill">&nbsp;</div>
		<div class="d-flex flex-fill">&nbsp;</div>
		<div class="navbar-collapse collapse" id="navbar">
			<ul class="navbar-nav justify-content-center d-flex flex-fill">
				<li class="nav-item">
					<a class="nav-link smooth-anchor" href="#carousel">INÍCIO</a>
				</li>
				<li class="nav-item">
					<a class="nav-link smooth-anchor" href="#bride">OS NOIVOS</a>
				</li>
				<li class="nav-item">
					<a class="nav-link smooth-anchor" href="#where">QUANDO & ONDE</a>
				</li>
				<li class="nav-item">
					<a class="nav-link smooth-anchor" href="#list">LISTA DE PRESENTES</a>
				</li>
				<li class="nav-item">
					<a class="nav-link smooth-anchor" href="#rsvp">RSVP</a>
				</li>
			</ul>
		</div>
		<div class="d-flex flex-fill">&nbsp;</div>
		<span class="navbar-brand d-flex flex-fill">
			<button class="nav-link smooth-anchor btn btn-secondary" data-toggle="modal" data-target="#modalEvents">EVENTOS</button>
		</span>
	</nav>
	<div class="container-fluid">
		<div class="row justify-content-around">
			<div class="col-4 text-center bg-white">
				<img src="/img/rosto1.jpg" class="img-fluid rounded-circle" alt="Rosto" />
			</div>
			<div class="col-2 text-center bg-white">&nbsp;</div>
			<div class="col-4 text-center bg-white">
				<img src="/img/rosto2.jpg" class="img-fluid rounded-circle" alt="Rosto" />
			</div>
			<div class="w-100"></div>
			<div class="col-4 text-center bg-white">
				<h2 class="mt-4">Noiva da Silva</h2>
			</div>
			<div class="col-2 text-center bg-white"><big>&</big></div>
			<div class="col-4 text-center bg-white">
				<h2 class="mt-4">Noivo de Tal</h2>
			</div>
		</div>
		<div class="text-center my-5">
			<h2 class="display-3">Vão se Casar</h2>
			<p>em 16 de Fevereiro, 2019 - Lagoa Santa, Minas Gerais</p>
		</div>
		<div>
			<div id="date" class="row justify-content-around counter bg-highlight text-center">
			<div class="col-sm-1"><big id="dm">0</big><br /><small id="tm">mêses</small></div>
			<div class="col-sm-1"><big id="dd">0</big><br /><small id="td">dias</small></div>
			<div class="col-sm-1"><big id="dh">0</big><br /><small id="th">horas</small></div>
			<div class="col-sm-1"><big id="dn">0</big><br /><small id="tn">minutos</small></div>
			<div class="col-sm-1"><big id="ds">0</big><br /><small id="ts">segundos</small></div>
			</div>
		</div>
		<h1 id="bride" class="display-2 my-4 text-center">Os Noivos</h1>
		<div class="row justify-content-center no-gutters">
			<div class="col-lg-3">
				<img src="/img/noiva.jpg" class="img-100 img-fluid" alt="Noiva" />
			</div>
			<div class="col-lg-3 p-4 bg-highlight">
				<p>Noiva da Silva</p>
				<p class="text-justify">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
			</div>
		</div>
		<div class="row justify-content-center no-gutters">
			<div class="col-lg-3 order-12 order-sm-12 order-md-12 order-md-1 p-4 bg-highlight">
				<p>Noivo de Tal</p>
				<p class="text-justify">Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.</p>
			</div>
			<div class="col-lg-3 order-1 order-sm-1 order-md-1 order-lg-12">
				<img src="/img/noivo.jpg" class="img-100 img-fluid" alt="Noivo" />
			</div>
		</div>
		<div class="row">
			<div class="col parallax parallax-image" style="background-image: url('/img/parallax.jpg');" data-paroller-factor="0.5"></div>
		</div>
		<h1 id="where" class="display-2 text-center py-4">Quando & Onde</h1>
		<div class="row justify-content-around">
			<div class="col-md-5 bg-highlight pt-3 pb-2 mt-3">
				<div class="row text-justify-center">
					<div class="col-md-12 mb-4">
						<img src="/img/igreja.jpg" class="img-fluid" alt="Igreja" />
					</div>
					<div class="col-md-12">
						<p class="text-justify">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
					</div>
				</div>
			</div>
			<div class="col-md-5 bg-highlight pt-3 pb-2 mt-3">
				<div class="row text-justify-center">
					<div class="col-md-12 mb-4">
						<img src="/img/salao.jpg" class="img-fluid" alt="Salão" />
					</div>
					<div class="col-md-12">
						<p class="text-justify">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="row map my-5">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3757.730203956172!2d-43.8885124!3d-19.6388289!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xa67c134ae26bcd%3A0x1816d0142ceb872!2zUGFyw7NxdWlhIFPDo28gU2ViYXN0acOjbw!5e0!3m2!1spt-BR!2sbr!4v1532565737836" width="100%" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
		<h2 id="list" class="display-3 text-center my-5">Lista de Presentes</h2>
		<div class="row justify-content-center">
			<div class="col-8 text-center my-3">
				<p>Ficaremos agradecidos apenas por sua presença para celebrar a ocasião conosco!<br />Se você quiser nos presentear, iremos amar também! Clique na caixa abaixo e veja nossa lista de presentes.</p>
			</div>
			<div class="col-8 text-center my-5">
				<a href="presentes.php"><img src="/img/presente.png" alt="Salão" /></a>
			</div>
		</div>
		<div id="rsvp" class="row">
			<div class="col parallax my-5" style="background-image: url('/img/parallax.jpg');" data-paroller-factor="0.5">
				<div class="row justify-content-center">
					<div class="col-11 col-sm-10 col-md-8 col-lg-6 p-5 my-5 bg-white">
						<h2 class="display-4 text-center">Confirme sua Presença</h2>
						<form id="ajaxForm" method="post" class="was-validated">
							<input type="hidden" name="id_event" value="3" />
							<div class="form-group">
								<label for="name">Seu nome</label>
								<input type="text" class="form-control" id="name" name="name" placeholder="Digite seu nome" required />
							</div>
							<div class="row justify-content-around">
								<div class="col-4">
									<label for="showup">Irá comparecer?</label>
									<select class="custom-select" id="showup" name="showup" required>
										<option disabled selected>---</option>
										<option value="0">Não</option>
										<option value="1">Sim</option>
									</select>
								</div>
								<div class="col-4">
									<div class="form-group">
										<label for="adults">Quantos adultos?</label>
										<input type="number" class="form-control" id="adults" name="adults" min="1" value="1" disabled />
									</div>
								</div>
								<div class="col-4">
									<div class="form-group">
										<label for="children">Quantas crianças?</label>
										<input type="number" class="form-control" id="children" name="children" min="0" value="0" disabled />
									</div>
								</div>
							</div>
							<div class="g-recaptcha" data-sitekey="6LfII3kUAAAAAMc4HFNovEcV7hSxh4dxU5pjnJtn"></div>
							<button id="ajaxSubmit" class="btn btn-primary btn-block mt-4" type="submit">Confirmar presença</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row justify-content-center bg-highlight pt-5 pb-3">
			<div class="col-8 text-center">
				<p id="phrases">&nbsp;</p>
				<p><small id="authors">&nbsp;</small></p>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modalEvents" tabindex="-1" role="dialog" aria-labelledby="modalEventsTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalEventsTitle">Mudar evento</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="get" action="evento.php">
						<div class="form-group">
							<select class="selectpicker form-control" data-live-search="true" data-size="8" data-style="btn-secondary" name="id">
								<?php
									foreach ($events as $e) {
										?>
											<option value="<?= $e->id ?>"><?= $e->title ?> (<?= strftime('%B de %Y', (new DateTime($e->date))->getTimestamp()) ?>)</option>
										<?php
									}
								?>
							</select>
						</div>
						<button type="submit" class="btn btn-primary btn-block">Alterar evento</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>