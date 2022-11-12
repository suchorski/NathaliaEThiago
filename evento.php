<?php
	
	require_once(__DIR__.'/config.php');
	require_once(__DIR__.'/services/events.php');
	
	try {
		if (isset($_GET['id']) && preg_match('/^[1-9]+[0-9]*$/', $_GET['id'])) {
			$event = EventsService::getById($_GET['id']);
		} else {
			$event = EventsService::getLast();
		}
		$photos = PhotosService::listMaxFourByEventId($event->id);
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
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-125048408-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'UA-125048408-1');
	</script>
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
	<script type="text/javascript">
		var date = new Date(<?= 1000 * (new DateTime($event->date))->getTimestamp() ?>);
		var phrases = [
			<?php
				foreach ($event->phrases as $phrase) {
					echo '["\"'.$phrase->phrase.'\"", "'.$phrase->author.'"],';
				}
			?>
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
				<a class="nav-link smooth-anchor" href="#event"><big class="display-3 stroke"><?= $event->title ?></big></a>
				<i class="fa fa-angle-double-down stroke white"></i>
			</div>
		</div>
		<div id="carousel-inner" class="carousel-inner">
			<?php
				$i = 0;
				foreach ($photos as $photo) {
					?>
						<div class="carousel-item" style="background-image: url('data:<?= $photo->type ?>;base64,<?= $photo->photo ?>');"></div>
					<?php
					if (++$i === 3) {
						break;
					}
				}
			?>
		</div>
		<script type="text/javascript">$('#carousel-inner div').first().addClass('active');</script>
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
					<a class="nav-link smooth-anchor" href="#event">O EVENTO</a>
				</li>
				<li class="nav-item">
					<a class="nav-link smooth-anchor" data-anchor="center" href="#date">CONTAGEM</a>
				</li>
				<li class="nav-item">
					<a class="nav-link smooth-anchor" href="#pictures">FOTOS</a>
				</li>
			</ul>
		</div>
		<div class="d-flex flex-fill">&nbsp;</div>
		<span class="navbar-brand d-flex flex-fill">
			<button class="nav-link smooth-anchor btn btn-secondary" data-toggle="modal" data-target="#modalEvents">EVENTOS</button>
		</span>
	</nav>
	<div class="container-fluid">
		<div class="row text-center">
			<div class="col mb-5">
				<h1 id="event" class="display-3 pt-5"><?= $event->title ?></h1>
				<h4><?= strftime('%d de %B de %Y', (new DateTime($event->date))->getTimestamp()) ?></h4>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-10 text-justify">
				<p><?= $event->text ?></p>
			</div>
		</div>
		<div class="row">
			<div class="col parallax parallax-image" style="background-image: url('data:<?= end($photos)->type ?>;base64,<?= end($photos)->photo ?>');" data-paroller-factor="0.5"></div>
		</div>
		<div id="date" class="row justify-content-center counter bg-highlight text-center">
			<div class="col-md-2"><big id="dm">0</big><br /><small id="tm">mêses</small></div>
			<div class="col-md-2"><big id="dd">0</big><br /><small id="td">dias</small></div>
			<div class="col-md-2"><big id="dh">0</big><br /><small id="th">horas</small></div>
			<div class="col-md-2"><big id="dn">0</big><br /><small id="tn">minutos</small></div>
			<div class="col-md-2"><big id="ds">0</big><br /><small id="ts">segundos</small></div>
		</div>
		<div class="row justify-content-center">
			<div class="col-10 text-center mb-5">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- Nathalia e Thiago -->
				<ins class="adsbygoogle"
					 style="display:block"
					 data-ad-client="ca-pub-9684036913093488"
					 data-ad-slot="3707346652"
					 data-ad-format="auto"
					 data-full-width-responsive="true"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-10 text-center">
				<h1 id="pictures" class="display-2 mb-5">Fotos</h1>
			</div>
		</div>
		<div class="row justify-content-center">
			<?php
				foreach ($event->photos as $photo) {
					?>
						<div class="col-sm-4 my-3 text-center">
							<a href="/foto.php?id=<?= $photo->id ?>">
								<img src="/imagem.php?thumb=1&id=<?= $photo->id ?>" class="img-div" />
							</a>
							<div><span class="badge badge-secondary">Cliques: <?= $photo->count ?></span></div>
						</div>
					<?php
				}
			?>
		</div>
		<div class="row justify-content-center bg-highlight pt-5 pb-3 mt-4">
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
					<form method="get">
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