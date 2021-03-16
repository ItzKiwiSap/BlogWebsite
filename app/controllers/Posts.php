<?php

class Posts extends Controller {

	public function __construct() {
		$this->postModel = $this->model('Post');
	}

	public function add($user_id, $title, $body, $categories) {
		return $this->postModel->add($user_id, $title, $categories, $body);
	}

	public function remove($id) {
		return $this->postModel->remove($id);
	}

	public function getAllPosts() {
		return $this->postModel->getAllPosts();
	}
}