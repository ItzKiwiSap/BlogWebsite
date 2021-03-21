<?php

class Users extends Controller {

	public function __construct() {
		$this->userModel = $this->model('UserModel');
	}

	public function register() {
		$data = [
			'title' => 'Registreren',
			'username' => '',
			'email' => '',
			'password' => '',
			'confirmPassword' => '',
			'usernameError' => '',
			'emailError' => '',
			'passwordError' => '',
			'confirmPasswordError' => ''
		];

		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'title' => 'Registreren',
				'username' => trim($_POST['username']),
				'email' => trim($_POST['email']),
				'password' => trim($_POST['password']),
				'confirmPassword' => trim($_POST['confirmPassword']),
				'usernameError' => '',
				'emailError' => '',
				'passwordError' => '',
				'confirmPasswordError' => ''
			];

			$nameValidation = "/^[a-zA-Z0-9]*$/";
			$passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

			if(empty($data['username'])) {
				$data['usernameError'] = 'Vul een gebruikersnaam in.';
			} elseif(!preg_match($nameValidation, $data['username'])) {
				$data['usernameError'] = 'Een gebruikersnaam mag alleen letters en nummers bevatten.';
			} else {
				if($this->userModel->findUserByUsername($data['username'])) {
					$data['usernameError'] = 'Gebruikersnaam is al in gebruik.';
				}
			}

			if (empty($data['email'])) {
                $data['emailError'] = 'Vul een email adres in.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Deze email adres bestaat niet.';
            } else {
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['emailError'] = 'Email adres is al in gebruik.';
                }
            }

            if(empty($data['password'])){
                $data['passwordError'] = 'Vul een wachtwoord in.';
            } elseif(strlen($data['password']) < 6){
                $data['passwordError'] = 'Wachtwoord moet minimaal 8 tekens zijn.';
            } elseif (preg_match($passwordValidation, $data['password'])) {
                $data['passwordError'] = 'Dit wachtwoord is niet sterk genoeg.';
            }

             if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Vul een wachtwoord in.';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                    $data['confirmPasswordError'] = 'Wachtwoorden komen niet overeen.';
                }
            }

            if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if ($this->userModel->register($data)) {
                    header('location: ' . URLROOT . '/users/login');
                } else {
                    die('Er is iets fout gegaan.');
                }
            }
        }

        $this->view('users/register', $data);
	}

	public function login() {
		$data = [
            'title' => 'Inloggen',
            'usernameOrEmail' => '',
            'password' => '',
            'usernameOrEmailError' => '',
            'passwordError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Inloggen',
                'usernameOrEmail' => trim($_POST['usernameOrEmail']),
                'password' => trim($_POST['password']),
                'usernameOrEmailError' => '',
                'passwordError' => '',
            ];

            if (empty($data['usernameOrEmail'])) {
                $data['usernameOrEmailError'] = 'Vul een gebruikersnaam of email adres in.';
            }

            if (empty($data['password'])) {
                $data['passwordError'] = 'Vul een wachtwoord in.';
            }

            if (empty($data['usernameOrEmailError']) && empty($data['passwordError'])) {
                $loggedInUser = $this->userModel->login($data['usernameOrEmail'], $data['password']);

                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['passwordError'] = 'Gebruikersnaam of wachtwoord is ongeldig.';
                }
            }

        } else {
            $data = [
                'title' => 'Inloggen',
                'usernameOrEmail' => '',
                'password' => '',
                'usernameOrEmailError' => '',
                'passwordError' => ''
            ];
        }

        $this->view('users/login', $data);
	}

    public function profile() {
        $data = ['title' => 'Profiel'];
        $this->view('users/profile', $data);
    }

    public function allPosts($userId) {
        return $this->userModel->allPosts($userId);
    }

    public function latestPosts($userId, $limit) {
        return $this->userModel->latestPosts($userId, $limit);
    }

    public function getUserName($userId) {
        return $this->userModel->getUserName($userId);
    }

    public function getUser($userId) {
        return $this->userModel->getUser($userId);
    }

    public function getTotalUserCount() {
        return $this->userModel->getTotalUserCount();
    }

	public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['email'] = $user->email;
        $_SESSION['privilegegroup'] = $user->privilegegroup;
        header('location:' . URLROOT . '/users/profile');
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['privilegegroup']);
        header('location:' . URLROOT . '/users/login');
    }
}