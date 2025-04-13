<?php
class AuthController {
    private $userModel;
    private $model;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function login($username, $password) {
        $user = $this->userModel->getUserByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid credentials.";
            include '../app/views/login.php';
        }
    }
    public function register($username, $password) {
        if ($this->userModel->getUserByUsername($username)) {
            $error = "Username already exists.";
            include '../app/views/register.php';
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $this->userModel->createUser($username, $hashedPassword);
            header("Location: login.php");
            exit;
        }
    }
    

    public function logout() {
        session_start();
        session_destroy();
        header("Location: login.php");
        exit;
    }
}
?>