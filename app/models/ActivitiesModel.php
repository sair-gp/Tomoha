<?php
require_once '../config/database.php';

class ActivitiesModel extends Database {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connection;
    }

    public function getAll() {
        $stmt = $this->db->prepare("
            SELECT 
                a.*,
                s.status AS status_text
            FROM activities a
            LEFT JOIN activity_status s ON a.status_id = s.id");
        $stmt->execute();
        $result = $stmt->get_result();

        $activities = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $activities[] = $row;
            }
        }
        
        return $activities;
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO activities 
            (description, organizer, start_date, start_time, end_date, end_time, status_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        $statusId = $data['status_id'] ?? 5;

        $stmt->bind_param(
        "ssssssi",
        $data['description'],
        $data['organizer'],
        $data['start_date'],
        $data['start_time'],
        $data['end_date'],
        $data['end_time'],
        $statusId
        );
        
        if ($stmt->execute()) {
            return $this->db->insert_id;
        } else {
            throw new Exception("Error al crear la actividad: " . $stmt->error);
        }
    }

    public function upcoming() {
        $stmt = $this->db->prepare("
            SELECT 
                a.*,
                s.status AS status_text
                FROM activities a
                LEFT JOIN activity_status s ON a.status_id = s.id
                WHERE a.start_date >= CURDATE()
                ORDER BY a.start_date ASC
                LIMIT 5");
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $activities = [];
            while ($row = $result->fetch_assoc()) {
                $activities[] = $row;
            }
            return [
                "status" => "success",
                "data" => $activities
            ];
        }

        return [
            "status" => "error",
            "message" => "No se encontraron actividades próximas"
        ];
    }
}