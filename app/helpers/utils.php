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

	function formatBody($body) {
		if(strlen($body) > 200) {
			return substr($body, 0, 200) . '...';
		} else {
			return $body;
		}
	}

	function milliseconds() {
	    $mt = explode(' ', microtime());
	    return ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
	}