<?php
	require_once APPROOT . '/views/includes/head.inc.php';
	require_once APPROOT . '/views/includes/navigation.inc.php';

	$users = new Users;
	$allPostsCount = $users->allPosts($_SESSION['user_id']);
?>

<div class="container mt-5">
	<div class="row">
		<div class="col-xs-6 col-md-3">
			<div class="card text-center" style="width: 18rem;">
				<div class="card-header"><?php echo $_SESSION['username']; ?></div>
				<div class="card-body">
					<p class="card-text"><?php echo $_SESSION['privilegegroup']; ?></p>
				</div>
			</div>
		</div>
		<div class="col-xl">
			<h1>Jouw laatste berichten</h1>

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
	</div>
</div>