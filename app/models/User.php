<?php

class User {

	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function register($data) {
        $this->db->query('INSERT INTO users (username, email, password, privilegegroup) VALUES(:username, :email, :password, :privilegegroup)');

        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':privilegegroup', (isset($data['privilegegroup']) ? $data['privilegegroup'] : 'user'));

        return $this->db->execute();
    }

    public function login($username, $password) {
        $this->db->query('SELECT * FROM users WHERE username = :username OR email = :username');

        $this->db->bind(':username', $username);

        $row = $this->db->single();
        if(is_null($row)) return false;

        $hashedPassword = $row->password;

        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    public function allPosts($userId) {
        $this->db->query('SELECT id FROM posts WHERE userid = :userid');
        $this->db->bind(':userid', $userId);
        return $this->db->rowCount();
    }

    public function latestPosts($userId, $limit) {
        $this->db->query('SELECT * FROM posts WHERE userid = :userid ORDER BY creationtime DESC LIMIT ' . $limit);
        $this->db->bind(':userid', $userId);
        return $this->db->resultSet();
    }

    public function getUserName($userId) {
        $this->db->query('SELECT username FROM users WHERE id = :userid');
        $this->db->bind(':userid', $userId);
        return $this->db->single();
    }

    public function findAdminUsers() {
        $this->db->query('SELECT * FROM users WHERE privilegegroup=admin');
    }

    public function findUserByUsername($username) {
        $this->db->query('SELECT * FROM users WHERE username = :username');
        $this->db->bind(':username', $username);
        return $this->db->rowCount() > 0;
    }

    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        return $this->db->rowCount() > 0;
    }
}