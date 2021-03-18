<?php

class Posts extends Controller {

	public function __construct() {
		$this->postModel = $this->model('Post');
	}

	public function add($user_id, $title, $body, $categories) {
		return $this->postModel->add($user_id, $title, $categories, $body);
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