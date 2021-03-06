<?php

	$limit = (isset($limit)) ? $limit : ((isset($_GET['limit'])) ? $_GET['limit'] : 50);
	$allPosts = $posts->getAllPostsLimit($limit);

	if(empty($allPosts)) {
		echo '<small>Er zijn nog geen blogs geplaatst.</small>';
	} else {
		foreach ($allPosts as $post) {
			echo '<div class="col mb-4">
					<a class="text-decoration-none text-reset" href="'. URLROOT . '/pages/blogs?id=' . $post->id . '">
						<div class="card shadow border-0">';
							
			echo getImage($post->image);
								
			echo '<div class="card-body">
								<h5 class="card-title">' . $post->title . '</h5>
								' . formatCategories($post->categories) . '
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

	function getImage($image) {
		if(empty($image)) return '';
		else {
			return '<img src="' . $image . '" class="card-img-top" />';
		}
	}