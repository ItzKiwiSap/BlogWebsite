<?php
	require_once APPROOT . '/views/includes/head.inc.php';
	require_once APPROOT . '/views/includes/navigation.inc.php';

	require_once APPROOT . '/controllers/Posts.php';
	require_once APPROOT . '/controllers/Users.php';

	$posts = new Posts;
	$users = new Users;
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
	<div class="row">
		<div class="col-xl">
			<h1>Blogs</h1>

			<div class="row row-cols-md-2 g-4 mt-1">
				<?php
					require_once APPROOT . '/views/includes/blogposts.inc.php';
				?>
			</div>
		</div>
	</div>
</div>