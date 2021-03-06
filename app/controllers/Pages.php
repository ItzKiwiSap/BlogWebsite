<?php

class Pages extends Controller {

	public function __construct() {
		$this->userModel = $this->model('UserModel');
		$this->postModel = $this->model('PostModel');
		$this->adminModel = $this->model('AdminModel');
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

	public function dashboarddata() {
		$data = [
			'title' => 'Data'
		];

		$this->view('dashboarddata', $data);
	}
}