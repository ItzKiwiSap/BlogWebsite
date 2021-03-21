<?php

class PostModel {

	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function addPost($user_id, $title, $body, $categories) {
		$this->db->query('INSERT INTO posts (userid, title, categories, body) VALUES (:userid, :title, :categories, :body)');

		$this->db->bind(':userid', $user_id);
		$this->db->bind(':title', $title);
		$this->db->bind(':categories', $categories);
		$this->db->bind(':body', $body);

		return $this->db->execute();
	}

	public function remove($id) {
		$this->db->query('DELETE FROM posts WHERE id=:id');
		$this->db->bind(':id', $id);
		return $this->db->execute();
	}

	public function getPost($id) {
		$this->db->query('SELECT * FROM posts WHERE id=:id');
		$this->db->bind(':id', $id);
		return $this->db->single();
	}

	public function getAllPosts() {
		$this->db->query('SELECT * FROM posts ORDER BY creationtime DESC');
		return $this->db->resultSet();
	}

	public function getAllPostsLimit($limit) {
		$this->db->query('SELECT * FROM posts ORDER BY creationtime DESC LIMIT ' . $limit);
		return $this->db->resultSet();
	}

	public function getAllPostsOrdered() {
		$this->db->query('SELECT creationtime FROM posts ORDER BY creationtime');
		return $this->db->resultSet();
	}

	public function getPopularBloggers() {
		$this->db->query('SELECT userid FROM posts GROUP BY userid LIMIT 10');
		return $this->db->resultSet();
	}

	public function getTotalPostCount() {
        $this->db->query('SELECT * FROM posts');
        return $this->db->rowCount();
    }
}