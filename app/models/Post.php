<?php

class Post {

	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function addPost($user_id, $title, $body, $categories) {
		$this->db->query('INSERT INTO posts (userid, title, categories, body) VALUES (:userid, :title, :categories, :body');

		$this->db->bindValue(':userid', $user_id);
		$this->db->bindValue(':title', $title);
		$this->db->bindValue(':categories', $categories);
		$this->db->bindValue(':body', $body);

		return $this->db->execute();
	}

	public function remove($id) {
		$this->db->query('DELETE FROM posts WHERE id=:id');
		$this->db->bindValue(':id', $id);
		return $this->db->execute();
	}

	public function getAllPosts() {
		$this->db->query('SELECT * FROM posts');
		return $this->db->resultSet();
	}
}