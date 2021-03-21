<?php
	require_once APPROOT . '/views/includes/head.inc.php';
	require_once APPROOT . '/views/includes/navigation.inc.php';

	require_once APPROOT . '/controllers/Users.php';

	$users = new Users;
?>

<div class="d-flex flex-column">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4 col-md-2">
				<div class="card shadow border-left-primary h-100 align-items-stretch">
					<div class="card-body">
						<div class="row align-items-center no-gutters">
							<div class="col mr-2">
								<div class="text-uppercase text-primary font-weight-bold text-xs mb-1">
									<span>Totaal aantal gebruikers</span>

									<div class="text-dark font-weight-bold h5 mb-0">
										<span><?php echo $users->getTotalUserCount(); ?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>