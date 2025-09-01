<?php
session_start();
require_once __DIR__ . '/../models/AuthModel.php';

class AuthController {

    public function __construct() {
        $this->authModel = new AuthModel();
    }

    public function index() {
        require __DIR__ . '/../views/login.php';
    }

    public function signup() {
        require __DIR__ . '/../views/signup.php';
    }

    public function register() {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $response = $this->authModel->register($data);

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function login() {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';
        
        $response = $this->authModel->login($email, $password);

        if ($response['status'] === 'success') {
            $_SESSION['user_id'] = $response['user']['id'];
            $_SESSION['profile_id'] = $response['user']['profile_id'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function getSessionData() {
        $response = $this->authModel->getSessionData($_SESSION['profile_id']);

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function logout() {
        session_destroy();
        header('Location: /');
    }
}