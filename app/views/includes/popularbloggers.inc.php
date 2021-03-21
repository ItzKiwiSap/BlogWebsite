<?php

	$popularBloggers = $posts->getPopularBloggers();

	$count = 0;
	foreach ($popularBloggers as $bloggerId) {
		$count++;
		$user = $users->getUserName($bloggerId->userid);

		echo '<p class="card-text">' . $count . '. ' . $user . ' (' . formatPostCount($users->allPosts($bloggerId->userid)) . ')</p>';
	}