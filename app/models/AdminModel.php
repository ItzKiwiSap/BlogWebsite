<?php

class AdminModel {

	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function getUsers() {
		$this->db->query('SELECT * FROM users');
		return $this->db->resultSet();
	}

	public function changeGroup($userid, $group) {
		$this->db->query('UPDATE users SET privilegegroup=:group WHERE id=:id');

		$this->db->bind(':group', $group);
		$this->db->bind(':id', $userid);

		return $this->db->execute();
	}

	public function deleteUser($userid) {
		$this->db->query('DELETE FROM users WHERE id=:id');
		$this->db->bind(':id', $userid);
		return $this->db->execute();
	}

	public function removePosts($userId) {
        $this->db->query('DELETE FROM posts WHERE userid = :userid');
        $this->db->bind(':userid', $userId);
        return $this->db->execute();
    }
}