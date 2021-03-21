<?php
	require_once APPROOT . '/views/includes/head.inc.php';
	require_once APPROOT . '/views/includes/navigation.inc.php';

	if(!isLoggedIn()) {
		header("Location: " . URLROOT);
		return;
	}

	$users = new Users;
	$allPostsCount = $users->allPosts($_SESSION['user_id']);
?>

<style type="text/css">
	.card-text {
		font-size: 14px;
	}

	.card-text small {
		font-size: 11px;
	}
</style>

<div class="container mt-5">
	<div class="row d-flex">
		<div class="col-md-3">
			<div class="card text-center" style="width: 18rem;">
				<div class="card-header"><?php echo $_SESSION['username']; ?></div>
				<div class="card-body">
					<p class="card-text"><?php echo formatGroup($_SESSION['privilegegroup']); ?></p>
					<?php if(isBlogger()) : ?>
						<p class="card-text text-muted"><?php echo formatPostCount($allPostsCount); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<?php if(isBlogger()) : ?>
			<div class="col-md-9">
				<h1>Uw nieuwste berichten</h1>

				<div class="row row-cols-1 row-cols-md-2 g-4 mt-1">
					<?php
						require_once APPROOT . '/views/includes/profileposts.inc.php';
					?>
				</div>

				<?php
					if($allPostsCount > $limit) {
						echo '<p class="card-text text-muted mt-3"><a href="?limit=' . $limit = $limit * 2 . '">Laat meer zien...</a></p>';
					}
				?>
			</div>
		<?php endif; ?>
	</div>
</div>