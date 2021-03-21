<?php

	function formatTime($time) {
		$stamp = strtotime($time) * 1000;
		$now = milliseconds();

		if($now - $stamp < 60 * 1000) {
			return 'Een paar seconden geleden.';
		} else if($now - $stamp < 120 * 1000) {
			return 'Een minuut geleden.';
		} else if($now - $stamp < 3600 * 1000) {
			return 'Een paar minuten geleden.';
		} else if($now - $stamp < 3600 * 5 * 1000) {
			return 'Een paar uur geleden.';
		} else {
			return $time;
		}
	}

	function getOtherGroups($group) {
		if($group == 'admin') {
			return ['blogger', 'user'];
		} else if($group == 'blogger') {
			return ['admin', 'user'];
		} else if($group == 'user') {
			return ['admin', 'blogger'];
		}
	}

	function getGroupFromId($id) {
		if($id == 3) return 'admin';
		if($id == 2) return 'blogger';
		if($id == 1) return 'user';
	}

	function getOtherGroupOptions($group) {
		$others = getOtherGroups($group);
		$msg = '';

		foreach ($others as $gr) {
			$msg = $msg . '<option value="' . getGroupId($gr) . '">' . formatGroup($gr) . '</option>';
		}

		return $msg;
	}

	function formatPostCount($count) {
		return ($count == 1) ? $count . ' blog' : $count . ' blogs';
	}

	function formatGroup($group) {
		if($group == 'user') return 'Gebruiker';
		if($group == 'blogger') return 'Blogger';
		if($group == 'admin') return 'Beheerder';
	}

	function formatBody($body) {
		if(strlen($body) > 200) {
			return substr($body, 0, 200) . '...';
		} else {
			return $body;
		}
	}

	function formatCategories($categories) {
		$str = '<div class="me-md-1 d-flex align-content-stretch flex-wrap">';

		foreach (explode(', ', $categories) as $category) {
				$str = $str . '<p class="card-text btn btn-primary btn-sm m-1 d-flex"><small>' . $category . '</small></p>';
		}

		return $str . '</div>';
	}

	function milliseconds() {
	    $mt = explode(' ', microtime());
	    return ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
	}