<?php
require_once '../config/database.php';

class AuthModel extends Database {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connection;
    }

    public function register($data) {
        // Iniciar transacción
        $this->db->begin_transaction();
        
        try {
            $telefono = $data['codigo_telefono'] . $data['numero_telefono'];
            $stmt = $this->db->prepare("
                INSERT INTO profiles (type_documentation, cedula, first_name, last_name, telefono)
                VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $data['tipo_cedula'], $data['numero_cedula'], $data['first_name'], $data['last_name'], $telefono);
            
            if (!$stmt->execute()) {
                throw new Exception("Error al crear el perfil: " . $stmt->error);
            }
            
            $profile_id = $stmt->insert_id;
            $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
            
            $stmt = $this->db->prepare("
                INSERT INTO users (profile_id, email, password, registration_date, role)
                VALUES (?, ?, ?, NOW(), 4)");
            $stmt->bind_param("iss", $profile_id, $data['email'], $hashed_password);
            
            if (!$stmt->execute()) {
                throw new Exception("Error al crear el usuario: " . $stmt->error);
            }

            $user_id = $stmt->insert_id;
            $hashed_answer = password_hash($data['security_answer'], PASSWORD_DEFAULT);

            // Insertar respuesta de seguridad
            $stmt = $this->db->prepare("
                INSERT INTO security_answers (user_id, question_id, answer_text)
                VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $user_id, $data['security_question'], $hashed_answer);

            if (!$stmt->execute()) {
                throw new Exception("Error al guardar la respuesta de seguridad: " . $stmt->error);
            }
            
            // Confirmar transacción
            $this->db->commit();
            
            return [
                "status" => "success",
                "message" => "Usuario registrado exitosamente."
            ];
            
        } catch (Exception $e) {
            // Revertir en caso de error
            $this->db->rollback();
            return [
                "status" => "error",
                "message" => $e->getMessage()
            ];
        }
    }

    public function login($email, $password) {
        $stmt = $this->db->prepare("
            SELECT id, profile_id, password, role
            FROM users 
            WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // Verificación CORRECTA con password hasheado
            if (password_verify($password, $user['password'])) {
                return [
                    "status" => "success",
                    "user" => [
                        "id" => $user['id'],
                        "profile_id" => $user['profile_id'],
                        "role" => $user['role'] // Agregar el rol si lo necesitas
                    ],
                ];
            } else {
                // Log para debugging (opcional)
                error_log("Login fallido: Password incorrecto para email: " . $email);
            }
        } else {
            // Log para debugging (opcional)
            error_log("Login fallido: Email no encontrado: " . $email);
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

    public function getSecurityQuestions() {
        $stmt = $this->db->prepare("SELECT id, question_text FROM security_questions WHERE is_active = 1");
        $stmt->execute();
        $result = $stmt->get_result();

        $questions = [];
        while ($row = $result->fetch_assoc()) {
            $questions[] = $row;
        }

        return $questions;
    }

    public function getSecurityQuestionByEmail($data) {
        $stmt = $this->db->prepare("
            SELECT sq.id, sq.question_text 
            FROM users u
            JOIN security_answers sa ON u.id = sa.user_id
            JOIN security_questions sq ON sa.question_id = sq.id
            WHERE u.email = ?");
        $stmt->bind_param("s", $data['email']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $question = $result->fetch_assoc();
            return [
                "status" => "success",
                "question_id" => $question['id'],
                "question_text" => $question['question_text']
            ];
        } else {
            return [
                "status" => "error",
                "message" => "Correo electrónico no encontrado."
            ];
        }
    }

    public function verifySecurityAnswer($data) {
        $stmt = $this->db->prepare("
            SELECT sa.answer_text 
            FROM users u
            JOIN security_answers sa ON u.id = sa.user_id
            WHERE u.email = ? AND sa.question_id = ?");
        $stmt->bind_param("si", $data['email'], $data['question_id']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $record = $result->fetch_assoc();
            if (password_verify($data['answer'], $record['answer_text'])) {
                return [
                    "status" => "success",
                    "message" => "Respuesta correcta."
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Respuesta incorrecta."
                ];
            }
        } else {
            return [
                "status" => "error",
                "message" => "No se encontró la pregunta de seguridad."
            ];
        }
    }

    public function updatePassword($data) {
        $hashed_password = password_hash($data['new_password'], PASSWORD_DEFAULT);
        
        $stmt = $this->db->prepare("
            UPDATE users 
            SET password = ? 
            WHERE email = ?");
        $stmt->bind_param("ss", $hashed_password, $data['email']);
        
        if ($stmt->execute()) {
            return [
                "status" => "success",
                "message" => "Contraseña actualizada exitosamente."
            ];
        } else {
            return [
                "status" => "error",
                "message" => "Error al actualizar la contraseña."
            ];
        }
    }
}