<?php
	session_start();

	function isLoggedIn() {
		return isset($_SESSION['user_id']);
	}

	function isBlogger() {
		return isLoggedIn() && (isAdmin() || $_SESSION['privilegegroup'] == 'blogger');
	}

	function isAdmin() {
		return isLoggedIn() && $_SESSION['privilegegroup'] == 'admin';
	}