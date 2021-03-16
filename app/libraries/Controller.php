<?php

class Controller {

	public function model($model) {
		require_once '../app/models/' . $model . '.php';
		return new $model();
	}

	public function view($view, $data = []) {
		if(file_exists('../app/views/' . $view . '.php')) {
			if(isset($data['title'])) {
				$title = ' | ' . $data['title'];
			} else {
				$title = '';
			}

			require_once '../app/views/' . $view . '.php';
		} else {
			die("View does not exists.");
		}
	}
}