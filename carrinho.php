<?php

	session_start();
	
	require_once(__DIR__.'/config.php');
	require_once(__DIR__.'/services/products.php');
	require_once(__DIR__.'/exceptions/info.php');
	require_once(__DIR__.'/ml/mercadopago.php');
	
	$action = isset($_GET['action']) ? $_GET['action'] : 'list';
	$id = isset($_GET['id']) ? $_GET['id'] : '0';

	if (!isset($_SESSION['cart'])) {
		$_SESSION['cart'] = array();
	}

	switch ($action) {
		case 'add':
			$_SESSION['cart'][] = $id;
		break;
		case 'del':
			if (($key = array_search($id, $_SESSION['cart'])) !== false) {
				unset($_SESSION['cart'][$key]);
			}
		break;
		default:
	}

	$_SESSION['cart'] = array_unique($_SESSION['cart']);

	$products = array();
	$total = 0;

	foreach ($_SESSION['cart'] as $id) {
		try {
			$p = ProductsService::getById($id);
			$products[] = $p;
		} catch (InfoException $e) {
			unset($_SESSION['cart'][$id]);
		}
	}

	if (count($products) > 0) {
		$mp = new MP('8477109722162108', 'XjDOczcBfQGVScsrhJtna8IsfvuDMPTw');
		$preference_data = array(
			'items' => array(),
			'back_urls' => array(
				'success' => 'https://www.nathaliaethiago.com.br/'
			)
		);
		foreach ($products as $i) {
			$preference_data['items'][] = array(
				'title' => $i->description,
				'currency_id' => 'BRL',
				'category_id' => 'Casamento',
				'quantity' => 1,
				'unit_price' => $i->price
			);
		}
		$preference = $mp->create_preference($preference_data);
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
</head>
<body style="background: url('/img/pattern.jpg') repeat">
	<div id="loader-wrapper">
		<div id="loader"></div>
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
					<a class="nav-link smooth-anchor" href="custom.php">SITE DO CASAMENTO</a>
				</li>
				<li class="nav-item">
					<a class="nav-link smooth-anchor" href="evento.php">OUTROS EVENTOS</a>
				</li>
			</ul>
		</div>
		<div class="d-flex flex-fill">&nbsp;</div>
		<span class="navbar-brand d-flex flex-fill">
			<a class="nav-link smooth-anchor btn btn-secondary" href="presentes.php">LISTA DE PRESENTES</a>
		</span>
	</nav>
	<div class="container-fluid">
		<?php if (count($products) > 0) { ?>
				<table class="table table-hover">
					<thead class="thead-dark"><tr><th class="col-1 d-none d-sm-table-cell">Imagem</th><th class="col-8">Produto</th><th class="col-2">Valor</th><th class="col-1">&nbsp;</th></tr></thead>
					<tbody class="table-striped">
						<?php foreach ($products as $product): ?>
							<?php $total += $product->price; ?>
							<tr class="table-light">
								<td class="d-none d-sm-table-cell"><img class="img-fluid" style="width: 3em" src="/gifts/<?= $product->image ?>" /></td>
								<td class="align-middle"><?= $product->description ?></td>
								<td class="align-middle">R$ <?= number_format($product->price, 2, ',', '.') ?></td>
								<td class="align-middle text-right">
									<a class="btn btn-danger" role="button" href="/carrinho.php?action=del&id=<?= $product->id ?>"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
					<tfoot class="thead-dark">
						<tr>
							<th class="d-none d-sm-table-cell">&nbsp;</th>
							<th class="align-middle text-right">Total:</th>
							<th class="align-middle">R$ <?= number_format($total, 2, ',', '.') ?></th>
							<th class="align-middle"><a class="btn btn-primary btn-block" role="button" href="<?= $preference['response']['init_point'] ?>"><i class="fa fa-shopping-cart"></i></a></th>
						</tr>
					</tfoot>
				</table>
			<?php } else { ?>
				<div class="alert alert-info">Carrinho vazio</div>
			<?php } ?>
	</div>
</body>
</html>