<?php

class Admin extends Controller {

	public function __construct() {
		$this->adminModel = $this->model('AdminModel');
	}

	public function getAllUsers() {
		return $this->adminModel->getUsers();
	}

	public function dashboard() {
		$data = ['title' => 'Dashboard'];
        $this->view('admin/dashboard', $data); 
	}

	public function users() {
		$data = ['title' => 'Gebruikers'];
        $this->view('admin/users', $data); 
	}

	public function change() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if(!empty($_POST['editInput']) && !empty($_POST['newGroup'])) {
				$this->adminModel->changeGroup($_POST['editInput'], getGroupFromId($_POST['newGroup']));

				if($_POST['editInput'] == $_SESSION['user_id']) {
					$_SESSION['privilegegroup'] = getGroupFromId($_POST['newGroup']);
				}
			}
		}

		header("Location: " . URLROOT . '/admin/users');
	}

	public function delete() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if(!empty($_POST['deleteInput'])) {
				$this->adminModel->deleteUser($_POST['deleteInput']);
				$this->adminModel->removePosts($_POST['deleteInput']);

				if($_POST['deleteInput'] == $_SESSION['user_id']) {
					unset($_SESSION['user_id']);
			        unset($_SESSION['username']);
			        unset($_SESSION['email']);
			        unset($_SESSION['privilegegroup']);
			        header('location:' . URLROOT . '/users/login');
					return;
				}
			}
		}

		header("Location: " . URLROOT . '/admin/users');
	}
}