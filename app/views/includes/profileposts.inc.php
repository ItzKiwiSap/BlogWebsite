<?php

	$limit = (isset($_GET['limit'])) ? $_GET['limit'] : 2;
	$latestPosts = $users->latestPosts($_SESSION['user_id'], $limit);

	if(empty($latestPosts)) {
		echo '<small>U heeft nog geen berichten geplaatst.</small>';
	} else {
		foreach ($latestPosts as $post) {
			echo '<div class="col">
					<a class="text-decoration-none text-reset" href="' . URLROOT . '/pages/blogs?id=' . $post->id . '">
						<div class="card shadow border-0">';

			echo getImage($post->image);


			echo '<div class="card-body">
								<h5 class="card-title">' . $post->title . '</h5>
								' . formatCategories($post->categories) . '
								<p class="card-text">' . formatBody($post->body) . '</p>
								<div class="d-flex flex-row justify-content-between">
									<p class="card-text"><small class="text-muted">' . formatTime($post->creationtime) . '</small></p>
									<p class="card-text"><small class="text-muted">Klik om verder te lezen.</small></p>
								</div>
							</div>
						</div>
					</a>
				</div>';
		}
	}

	function getImage($image) {
		if(empty($image)) return '';
		else {
			return '<img src="' . $image . '" class="card-img-top" />';
		}
	}