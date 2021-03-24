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
			'body' => '',
			'image' => ''
		];

		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'title' => 'Plaats blog',
				'blogtitle' => trim($_POST['title']),
				'categories' => $_POST['categories'],
				'body' => trim($_POST['body']),
				'image' => ''
			];

			if(empty($data['image']) && isset($_FILES['imageHeader']) && !empty($_FILES['imageHeader']['name'])) {
				$extension = pathinfo($_FILES['imageHeader']['tmp_name'], PATHINFO_EXTENSION);
				$imgBase64 = base64_encode(file_get_contents($_FILES['imageHeader']['tmp_name']));
				$image = "data::image/" . $extension . ";base64," . $imgBase64;

				$data['image'] = $image;
			}

			if(!empty($data['blogtitle']) && !empty($data['categories']) && !empty($data['body'])) {
				$this->postModel->addPost($_SESSION['user_id'], $data['blogtitle'], $data['body'], $data['categories'], $data['image']);
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

	public function getAllPostsLimit($limit) {
		return $this->postModel->getAllPostsLimit($limit);
	}

	public function getAllPosts() {
		return $this->postModel->getAllPosts();
	}

	public function getAllPostsCount() {
		return $this->postModel->getAllPostsCount();
	}

	public function getAllPostsOrdered() {
		return $this->postModel->getAllPostsOrdered();
	}

	public function getPopularBloggers() {
		return $this->postModel->getPopularBloggers();
	}

	public function getTotalPostCount() {
        return $this->postModel->getTotalPostCount();
    }
}