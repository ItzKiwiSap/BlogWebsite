<?php

class Pages extends Controller {

	public function __construct() {
		$this->userModel = $this->model('User');
		$this->postModel = $this->model('Post');
	}

	public function index() {
		$data = [
			'title' => 'Home'
		];

		$this->view('index', $data);
	}

	public function blogs() {
		$data = [
			'title' => 'Blogs'
		];

		$this->view('blogs', $data);
	}

	public function blog($id, $title) {
		$data = [
			'title' => $title,
			'id' => $id
		];

		$this->view('blog', $data);
	}
}