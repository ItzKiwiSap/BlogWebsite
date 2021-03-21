<?php
	if(!isAdmin()) {
		header("Location: " . URLROOT);
		return;
	}

	require_once '../app/controllers/Users.php';
	require_once '../app/controllers/Posts.php';

	$users = new Users;
	$posts = new Posts;

	require_once '../app/views/includes/dashboarddata.inc.php';
?>