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

    public function getSecurityQuestions() {
        $response = $this->authModel->getSecurityQuestions();

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

    public function resetPassword() {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        header('Content-Type: application/json');

        switch ($data['step']) {
            case 1:
                $response = $this->authModel->getSecurityQuestionByEmail($data);
                echo json_encode($response);
                break;
            case 2:
                $response = $this->authModel->verifySecurityAnswer($data);
                echo json_encode($response);
                break;
            case 3:
                $response = $this->authModel->updatePassword($data);
                echo json_encode($response);
                break;
            default:
                echo json_encode([
                    "status" => "error",
                    "message" => "Paso inválido."
                ]);
        }
    }
}