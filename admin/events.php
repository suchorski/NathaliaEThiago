<?php
	
	require_once(__DIR__.'/../config.php');
	require_once(__DIR__.'/../services/events.php');
	require_once(__DIR__.'/../utils/utils.php');

	session_start();
	if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
		header('Location: /admin/login.php');
		exit();
	}
	
	$search = Utils::parseString($_GET, 'search', '');
	$events = EventsService::list($search);

?>
<?php include(__DIR__.'/template/start.php');?>
<h1>Eventos</h1>
<table class="table">
	<thead class="thead-dark">
		<tr>
			<th scope="col" class="col-7">Título</th>
			<th scope="col" class="col-3">Data</th>
			<th scope="col" class="col-2">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach ($events as $event) {
				?>
					<tr>
						<th scope="row"><?= $event->title ?></th>
						<td><?= $event->date ?></td>
						<td class="text-right">
							<form method="post" action="./put/event.php" enctype="multipart/form-data">
								<input type="hidden" name="action" value="delete" />
								<input type="hidden" name="id_event" value="<?= $event->id ?>" />
								<button class="btn btn-danger" type="submit">
									<i class="fa fa-trash" aria-hidden="true" aria-label="Excluir evento"></i>
								</button>
							</form>
						</td>
					</tr>
				<?php
			}
		?>
	</tbody>
</table>
<div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="Adicionar Evento" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Adicionar Evento</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<form method="post" action="./put/event.php" class="was-validated" enctype="multipart/form-data" onsubmit="$('#addEvent').prop('disabled', true);">
							<input type="hidden" name="action" value="create" />
							<div class="form-group">
								<label for="title">Título</label>
								<input type="text" class="form-control" id="title" name="title" placeholder="Título do evento" required />
							</div>
							<div class="form-group">
								<label for="text">Texto</label>
								<textarea class="form-control" id="text" rows="3" name="text" placeholder="Texto do evento" required></textarea>
							</div>
							<div class="form-group">
								<label for="text">Data do evento</label>
								<input type="text" class="form-control datetimepicker-input" id="date" data-toggle="datetimepicker" data-target="#date" name="date" placeholder="Data e hora do evento" required />
							</div>
							<div class="form-group">
								<label for="photos">Fotos</label>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="customFile" name="photos[]" required multiple />
									<label class="custom-file-label" for="customFile">Escolher fotos</label>
								</div>
							</div>
							<div id="phrases" class="form-group">
								<label>Frases</label>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<input type="button" class="btn btn-danger btn-block" value="Remover" onclick="removePhrase()" />
								</div>
								<div class="col-sm-6">
									<input type="button" class="btn btn-success btn-block" value="Adicionar" onclick="addPhrase()" />
								</div>
							</div>
							<button id="addEvent" type="submit" class="btn btn-primary btn-block mt-4">Enviar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include(__DIR__.'/template/end.php');?>