<?php

	$limit = $limit = (isset($_GET['limit'])) ? $_GET['limit'] : 50;
	$allPosts = $posts->getAllPosts();

	if(empty($allPosts)) {
		echo '<small>Er zijn nog geen blogs geplaatst.</small>';
	} else {
		foreach ($allPosts as $post) {
			echo '<div class="col">
					<a class="text-decoration-none text-reset" href="?id=' . $post->id . '">
						<div class="card shadow border-0">
							<div class="card-body">
								<h5 class="card-title">' . $post->title . '</h5>
								' . formatCategories($post->categories, 6, 15) . '
								<p class="card-text mt-2">' . formatBody($post->body) . '</p>
								<div class="d-flex flex-row justify-content-between">
									<p class="card-text"><small class="text-muted">' . formatTime($post->creationtime) . '</small></p>
									<p class="card-text"><small class="text-muted">Klik om verder te lezen.</small></p>
									<p class="card-text"><small class="text-muted">Geplaatst door ' . $users->getUserName($post->userid) . '</small</p>
								</div>
							</div>
						</div>
					</a>
				</div>';
		}
	}