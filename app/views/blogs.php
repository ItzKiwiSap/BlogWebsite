<?php
	require_once APPROOT . '/views/includes/head.inc.php';
	require_once APPROOT . '/views/includes/navigation.inc.php';

	require_once APPROOT . '/controllers/Posts.php';
	require_once APPROOT . '/controllers/Users.php';

	$posts = new Posts;
	$users = new Users;

	$allPostsCount = $posts->getAllPostsCount();
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

	input[name="visibleCategories"] {
		border: none;
		outline: none;
	}

	input[name="visibleCategories"]:focus {
		border: none;
		outline: none;
		box-shadow: none;
	}

	.card-img-top {
		width: 100%;
		height: 40vh;
		object-fit: cover;
	}

	.img-show {
		width: 100%;
		height: 50vh;
		object-fit: cover;
	}
</style>

<?php if(isset($_GET['id'])) : ?>

	<div class="container mt-5">
		<?php require_once APPROOT . '/views/includes/blogpost.inc.php'; ?>

		<div class="row mb-4">
			<div class="col-xl">
				<h1><?php echo $post->title; ?></h1>
				<div class="row row-cols-md-2 g-1">
					<?php echo formatCategories($post->categories, 8); ?>
				</div>
				
				<?php 
					if(!empty($post->image)) {
						echo '<img src="' . $post->image . '" class="img-show mt-3">';
					}
				?>

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

				<?php if(isLoggedIn() && ($post->userid == $_SESSION['user_id']) || isAdmin()) : ?>
					<div class="card mt-4">
						<div class="card-header">
							<h6 class="text-primary font-weight-bold m-0">Bewerken</h6>
						</div>
						<div class="card-body">
							<p class="card-text"><a href="<?php echo URLROOT; ?>/posts/remove?removeid=<?php echo $post->id ?>">Verwijderen</a></p>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

<?php elseif(isset($_GET['create']) && isLoggedIn() && isBlogger()) : ?>

	<div class="container mt-5">
		<h1 class="col">Een nieuwe blog schrijven</h1>

		<form method="POST" class="mt-4" action="<?php echo URLROOT; ?>/posts/create" onkeydown="return event.key != 'Enter';" enctype="multipart/form-data">
			<div class="form-group">
				<input type="text" class="form-control" name="title" placeholder="Titel" required>

				<input type="file" class="form-control mt-4" name="imageHeader" accept="image/png, image/jpg, image/jpeg">

				<div class="container border rounded mt-4">
					<div class="category-container gap-1 d-flex flex-row p-1">
						<input type="text" class="form-control d-flex align-content-stretch flex-wrap" name="visibleCategories" placeholder="Voeg een categorie toe">
					</div>
				</div>

				<div class="invisible-category-container">
					<input type="text" name="categories" hidden>
				</div>

				<textarea class="form-control mt-4" maxlength="3000" minlength="500" name="body" rows="20" placeholder="Blog" required></textarea>

				<input type="submit" name="submit" class="form-control btn btn-primary mt-4" value="Plaats blog">
			</div>
		</form>
	</div>

<?php else : ?>

	<div class="container mt-5">
		<div class="row">
			<div class="col-xl">
				<div class="row">
					<h1 class="col">Blogs</h1>
					<?php 
						if(isLoggedIn() && isBlogger()) {
							echo '<a class="col d-flex justify-content-end mt-4" href="?create">Schrijf een nieuwe blog...</a>';
						}
					?>
				</div>

				<div class="row row-cols-md-2 g-4 mt-1">
					<?php
						require_once APPROOT . '/views/includes/blogposts.inc.php';
					?>
				</div>

				<?php
					if($allPostsCount > $limit) {
						echo '<p class="card-text text-muted mt-3 mb-4"><a href="?limit=' . $limit = $limit * 2 . '">Laat meer zien...</a></p>';
					}
				?>
			</div>
		</div>
	</div>

<?php endif; ?>

<script>
	const categoryContainer = document.querySelector('.category-container');
	const input = document.querySelector('.category-container input');
	const categoryInput = document.querySelector('.invisible-category-container input');
	var categories = [];

	function createCategory(label) {
		const button = document.createElement('button');
		button.setAttribute('type', 'button');
		button.setAttribute('class', 'btn btn-primary btn-sm me-md-1 d-flex align-content-stretch flex-wrap category');
		button.setAttribute('data-item', label);
		button.innerHTML = label;
		return button;
	}

	function reset() {
		document.querySelectorAll('.category').forEach(function(category) {
			category.parentElement.removeChild(category);
		});
	}

	function addCategories() {
		reset();
		categories.slice().reverse().forEach(function(category) {
			const cat = createCategory(category);
			categoryContainer.prepend(cat);
		});

		categoryInput.value = categories.join(', ');
	}

	input.addEventListener('keyup', function(e) {
		if(e.key == 'Enter') {
			const category = createCategory(input.value);

			if(input.value == '' || input.value.length > 15 || categories.includes(input.value)) return;

			categories.push(input.value);
			addCategories();

			if(categories.length == 5) {
				input.value = 'Je kan maximaal 5 categorieën toevoegen';
				input.disabled = true;
				input.style = 'background: none;';
				return;
			}

			input.value = '';
		}
	});

	document.addEventListener('click', function(e) {
		if(e.target.tagName == 'BUTTON') {
			const value = e.target.getAttribute('data-item');
			const index = categories.indexOf(value);
			categories = [...categories.slice(0, index), ...categories.slice(index + 1)];
			addCategories();

			if(categories.length == 4) {
				input.disabled = false;
				input.value = '';
			}
		}
	});
</script>