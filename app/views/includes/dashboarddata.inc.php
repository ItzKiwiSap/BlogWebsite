<?php

	header('Content-Type: application/json');

	$allPosts = $posts->getAllPostsOrdered();

	$allUsers = $users->getUsers();
	$allBloggers = $users->getBloggers(false);
	$allAdmins = $users->getAdmins();

	$topUsers = $posts->getPopularBloggers();

	$data = array();
	$postData = array();
	$userData = array('users' => $allUsers, 'bloggers' => $allBloggers, 'admins' => $allAdmins);
	$topUserData = array();

	foreach($allPosts as $post) {
		$postData[] = $post;
	}

	foreach ($topUsers as $bloggerId) {
		$user = $users->getUserName($bloggerId->userid);
		$postCount = $users->allPosts($bloggerId->userid);
		$topUserData += [$user => $postCount];
	}

	$data['posts'] = $postData;
	$data['users'] = $userData;
	$data['topUsers'] = $topUserData;

	print json_encode($data);