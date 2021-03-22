<?php
	require_once APPROOT . '/views/includes/head.inc.php';
	require_once APPROOT . '/views/includes/navigation.inc.php';

	require_once APPROOT . '/controllers/Posts.php';
	require_once APPROOT . '/controllers/Users.php';

	$posts = new Posts;
	$users = new Users;

	$limit = 3;
?>

<style type="text/css">
	.card-text {
		font-size: 14px;
	}

	.card-text small {
		font-size: 11px;
	}

	p.card-text.mt-2 {
		color: #000;
	}

	.card-title {
		color: #000;
	}

	.card-img-top {
		width: 100%;
		height: 40vh;
		object-fit: cover;
	}
</style>

<div class="container mt-5">
	<h1 class="col">Nieuwste blogs</h1>

	<div class="row row-cols-md-5 mt-4">
		<div class="col-xl">
			<div class="g-4">
				<?php
					require_once APPROOT . '/views/includes/blogposts.inc.php';
				?>
			</div>
		</div>

		<div class="col-sm">
			<div class="card">
				<div class="card-header">
					<h6 class="text-primary font-weight-bold m-0">Populaire bloggers</h6>
				</div>
				<div class="card-body">
					<?php require_once APPROOT . '/views/includes/popularbloggers.inc.php'; ?>
				</div>
			</div>

			<div class="card mt-3">
				<div class="card-header">
					<h6 class="text-primary font-weight-bold m-0">Statestieken</h6>
				</div>
				<div class="card-body">
					<p class="card-text">Totaal aantal blogs: <?php echo $posts->getTotalPostCount(); ?></p>
					<p class="card-text">Totaal aantal gebruikers: <?php echo $users->getTotalUserCount(); ?></p>
				</div>
			</div>
		</div>
	</div>
</div>