<?php

class Posts extends Controller {

	public function __construct() {
		$this->postModel = $this->model('PostModel');
	}

	public function create() {
		$data = [
			'title' => 'Plaats blog',
			'blogtitle' => '',
			'categories' => '',
			'body' => ''
		];

		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'title' => 'Plaats blog',
				'blogtitle' => trim($_POST['title']),
				'categories' => $_POST['categories'],
				'body' => trim($_POST['body'])
			];

			if(!empty($data['blogtitle']) && !empty($data['categories']) && !empty($data['body'])) {
				$this->postModel->addPost($_SESSION['user_id'], $data['blogtitle'], $data['body'], $data['categories']);
			}
		}

		header("Location: " . URLROOT . "/pages/blogs");
	}

	public function remove() {
		$id;

		if(isset($_GET['removeid'])) {
			$id = $_GET['removeid'];
		}

		$this->postModel->remove($id);

		header("Location: " . URLROOT . "/pages/blogs");
	}

	public function getPost($id) {
		return $this->postModel->getPost($id);
	}

	public function getAllPosts() {
		return $this->postModel->getAllPosts();
	}
}