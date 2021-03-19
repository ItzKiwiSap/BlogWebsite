<?php
	require_once APPROOT . '/views/includes/head.inc.php';
	require_once APPROOT . '/views/includes/navigation.inc.php';
?>

<style type="text/css">
	html, body {
	    min-height: 100%;
	    margin:0;
	}

	body {
	    background-image: linear-gradient(to right bottom, #22d3ff, #a236ff);
	    background-image: -moz-linear-gradient(to right bottom, #22d3ff, #a236ff) no-repeat;
	    background-image: -ms-linear-gradient(to right bottom, #22d3ff, #a236ff) no-repeat;
	    background-image: -webkit-linear-gradient(to right bottom, #22d3ff, #a236ff) no-repeat;
	    background-image: -webkit-linear-gradient(to right bottom, #22d3ff, #a236ff) no-repeat;
	    background-image: -o-linear-gradient(to right bottom, #22d3ff, #a236ff) no-repeat;
	    background-image:  linear-gradient(to right bottom, #22d3ff, #a236ff) no-repeat;
	}
</style>

<div class="card col-6 shadow border-0 position-absolute top-50 start-50 translate-middle">
	<div class="card-header d-flex justify-content-between align-items-center">
		<h6 class="text-primary font-weight-bold m-0">Inloggen</h6>
	</div>

	<form class="card-body" method="POST" action="<?php echo URLROOT; ?>/users/login">
		<div class="form-group">
			<label for="username">Gebruikersnaam of email adres</label>
			<input type="text" class="form-control" name="usernameOrEmail" aria-describedby="usernameHelp" required>
			<small id="usernameHelp" class="form-text text-muted">Vul hier uw gebruikersnaam of email in.</small>
			<small class="form-text text-muted"><?php echo $data['usernameOrEmailError']; ?></small>
		</div>

		<div class="form-group">
			<label for="password">Wachtwoord</label>
			<input type="password" class="form-control" name="password" required>
			<small id="usernameHelp" class="form-text text-muted">Vul hier uw wachtwoord in.</small>
			<small class="form-text text-muted"><?php echo $data['passwordError']; ?></small>
		</div>

		<button type="submit" class="btn btn-primary">Inloggen</button>

		<p class="form-text text-muted">Nog niet geregistreerd? <a href="<?php echo URLROOT; ?>/users/register">Maak een account aan!</a></p>
	</form>
</div>