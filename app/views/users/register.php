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
		<h6 class="text-primary font-weight-bold m-0">Registreren</h6>
	</div>

	<form class="card-body" method="POST" action="<?php echo URLROOT; ?>/users/register">
		<div class="form-group">
			<label for="username">Gebruikersnaam</label>
			<br>
			<small class="text-danger"><?php echo $data['usernameError']; ?></small>
			<input type="text" class="form-control" name="username" aria-describedby="usernameHelp" required>
			<small id="usernameHelp" class="form-text text-muted">Vul hier uw gebruikersnaam in.</small>
		</div>

		<div class="form-group">
			<label for="email">Email</label>
			<br>
			<small class="text-danger"><?php echo $data['usernameError']; ?></small>
			<input type="email" class="form-control" name="email" aria-describedby="emailHelp" required>
			<small id="emailHelp" class="form-text text-muted">Vul hier uw email in.</small>
		</div>

		<div class="form-group">
			<label for="password">Wachtwoord</label>
			<br>
			<small class="text-danger"><?php echo $data['passwordError']; ?></small>
			<input type="password" class="form-control" name="password" required>
			<small id="passwordHelp" class="form-text text-muted">Vul hier uw wachtwoord in.</small>
		</div>

		<div class="form-group">
			<label for="confirmPassword">Herhaal wachtwoord</label>
			<br>
			<small class="text-danger"><?php echo $data['confirmPasswordError']; ?></small>
			<input type="password" class="form-control" name="confirmPassword" required>
			<small id="confirmPasswordHelp" class="form-text text-muted">Herhaal uw wachtwoord.</small>
		</div>

		<button type="submit" class="btn btn-primary">Registreren</button>

		<p class="form-text text-muted">Heb je al een account? <a href="<?php echo URLROOT; ?>/users/login">Log in!</a></p>
	</form>
</div>