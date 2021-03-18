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

<?php if(isset($_GET['id'])) : ?>
	<div class="container mt-5">
		<?php require_once APPROOT . '/views/includes/blogpost.inc.php'; ?>

		<div class="row">
			<div class="col-xl">
				<h1><?php echo $post->title; ?></h1>
				<div class="row row-cols-md-2 g-1">
					<?php echo formatCategories($post->categories, 6, 20); ?>
				</div>
				
				<div class="mt-3">
					<?php echo wordwrap($post->body, 150, "<br />\n", true); ?>
				</div>
			</div>

			<div class="col-sm-2">
				<div class="card">
					<div class="card-header">
						<h6 class="text-primary font-weight-bold m-0">Auteur</h6>
					</div>
					<div class="card-body">
						<p class="card-text">Naam: <?php echo $users->getUsername($post->userid); ?></p>
						<p class="card-text"><?php echo ($users->allPosts($post->userid) == 1) ? $users->allPosts($post->userid) . ' post' : $users->allPosts($post->userid) . ' posts'; ?></p>
						<p class="card-text">Laatste blog geplaatst op <?php echo $users->latestPosts($post->userid, 1)[0]->creationtime; ?></p>
					</div>
				</div>

				<?php if(isLoggedIn() && $post->userid == $_SESSION['user_id']) : ?>
					<div class="card mt-4">
						<div class="card-header">
							<h6 class="text-primary font-weight-bold m-0">Bewerken</h6>
						</div>
						<div class="card-body">
							<p class="card-text">Bewerken (TODO)</p>
							<p class="card-text"><a href="<?php echo URLROOT; ?>/posts/remove?removeid=<?php echo $post->id ?>">Verwijderen</a></p>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php else : ?>
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
<?php endif; ?>