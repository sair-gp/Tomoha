<?php
require_once '../config/database.php';

class AuthModel extends Database {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connection;
    }

    public function login($email, $password) {
        $stmt = $this->db->prepare("
            SELECT id, profile_id, password
            FROM users
            WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            //if (password_verify($password, $user['password'])) {
            if ($password == $user['password']) {
                return [
                    "status" => "success",
                    "user" => [
                        "id" => $user['id'],
                        "profile_id" => $user['profile_id']
                    ],
                ];
            }
        }
        return [
            "status" => "error",
            "message" => "Datos de acceso incorrectos."
        ];
    }

    public function getSessionData($profile_id) {
        $stmt = $this->db->prepare("
            SELECT first_name, last_name 
            FROM profiles
            WHERE id = ?");
        $stmt->bind_param("i", $profile_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $profile = $result->fetch_assoc();
                return [
                    "status" => "success",
                    "first_name" => $profile['first_name'],
                    "last_name" => $profile['last_name']
                ];
        }
    }
}