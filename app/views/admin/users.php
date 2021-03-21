<?php
	require_once APPROOT . '/views/includes/head.inc.php';
	require_once APPROOT . '/views/includes/navigation.inc.php';

	if(!isAdmin()) {
		header("Location: " . URLROOT);
		return;
	}

	require_once APPROOT . '/controllers/Users.php';

	$admin = new Admin;
	$users = new Users;
?>

<div class="container mt-5">
	<div class="row">
		<h1 class="col">Gebruikers</h1>
		<a class="col d-flex justify-content-end mt-4" href="<?php echo URLROOT; ?>/admin/dashboard">Bekijk dashboard</a>
	</div>

	<table class="table table-hover mt-3">
		<thead>
			<th>ID</th>
			<th>Gebruikersnaam</th>
			<th>E-mail</th>
			<th>Groep</th>
			<th>Aantal posts</th>
			<th></th>
			<th></th>
		</thead>
		<tbody>
			<?php require_once APPROOT . '/views/includes/adminusers.inc.php'; ?>
		</tbody>
	</table>
</div>

<div class="modal fade" id="modalDelete" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Weet u zeker dat u deze gebruiker wilt verwijderen?</h4>
			</div>
			<div class="modal-body">
				<p>Klik op verwijderen om deze gebruiker te verwijderen.</p>
			</div>
			<div class="modal-footer">
				<form method="POST" action="<?php echo URLROOT; ?>/admin/delete">
					<input type="text" class="modalUserDeleteInput" name="deleteInput" hidden required>
					<button type="submit" name="modalUserDelete" class="btn btn-danger">Verwijderen</button>
				</form>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Sluiten</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalEdit" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">De groep aanpassen van deze gebruiker.</h4>
			</div>
			<form method="POST" action="<?php echo URLROOT; ?>/admin/change">
				<div class="modal-body">
					<select class="form-select" name="newGroup">
						<option disabled hidden>Kies een groep.</option>
						<option value="3">Beheerder</option>
						<option value="2">Blogger</option>
						<option value="1">Gebruiker</option>
					</select>
				</div>
				<div class="modal-footer">
					<input type="text" class="modalUserEditInput" name="editInput" hidden required>
					<button type="submit" name="modalUserEdit" class="btn btn-success">Opslaan</button>

					<button type="button" class="btn btn-primary" data-dismiss="modal">Sluiten</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	function setIdDelete(id) {
		const input = document.querySelector('.modalUserDeleteInput');
		input.value = id;
	}

	function setIdEdit(id) {
		const input = document.querySelector('.modalUserEditInput');
		input.value = id;
	}
</script>