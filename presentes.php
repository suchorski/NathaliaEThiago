<?php
	
	require_once(__DIR__.'/config.php');
	require_once(__DIR__.'/services/products.php');
	
	try {
		$products = ProductsService::list();
	} catch (Exception $e) {
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
</head>
<body style="background: url('/img/pattern.jpg') repeat">
	<nav class="navbar navbar-expand-md navbar-light bg-light mb-5 sticky-top">
		<button class="navbar-toggler mr-2" type="button" data-toggle="collapse" data-target="#navbar">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="d-flex flex-fill">&nbsp;</div>
		<div class="d-flex flex-fill">&nbsp;</div>
		<div class="navbar-collapse collapse" id="navbar">
			<ul class="navbar-nav justify-content-center d-flex flex-fill">
				<li class="nav-item">
					<a class="nav-link smooth-anchor" href="custom.php">SITE DO CASAMENTO</a>
				</li>
				<li class="nav-item">
					<a class="nav-link smooth-anchor" href="evento.php">OUTROS EVENTOS</a>
				</li>
			</ul>
		</div>
		<div class="d-flex flex-fill">&nbsp;</div>
		<span class="navbar-brand d-flex flex-fill">
			<a class="nav-link smooth-anchor btn btn-secondary" href="carrinho.php">CARRINHO</a>
		</span>
	</nav>
	<div class="container-fluid">
		<div class="row justify-content-around">
			<?php foreach ($products as $product): ?>
				<div class="col-lg-3 m-5">
					<div class="row">
						<div class="col">
							<img class="img-fluid img-thumbnail img-stretch" src="/gifts/<?= $product->image ?>" />
						</div>
					</div>
					<div class="row my-2">
						<div class="col-12"><div class="alert alert-secondary"><?= $product->description ?></div></div>
						<div class="col-12"><a class="btn btn-primary btn-block<?php if (!$product->enabled) { echo ' disabled'; } ?>" role="button" href="carrinho.php?action=add&id=<?= $product->id ?>"><i class="fa fa-shopping-cart"> R$ <?= number_format($product->price, 2, ',', '.') ?></i></a></div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</body>
</html>