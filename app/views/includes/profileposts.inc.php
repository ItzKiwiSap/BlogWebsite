<?php

	$limit = (isset($_GET['limit'])) ? $_GET['limit'] : 2;
	$latestPosts = $users->latestPosts($_SESSION['user_id'], $limit);

	if(empty($latestPosts)) {
		echo '<small>Je hebt nog geen berichten geplaatst.</small>';
	} else {
		foreach ($latestPosts as $post) {
			echo '<div class="col">
					<div class="card shadow border-0">
						<div class="card-body">
							<h5 class="card-title">' . $post->title . '</h5>
							<p class="card-text btn btn-primary">' . $post->categories . '</p>
							<p class="card-text">' . formatBody($post->body) . '</p>
							<p class="card-text"><small class="text-muted">' . formatTime($post->creationtime) . '</small></p>
						</div>
					</div>
				</div>';
		}
	}