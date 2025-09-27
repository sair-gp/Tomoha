<?php
require_once '../config/database.php';

class ActivitiesModel extends Database {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connection;
    }

    public function get() {
        $stmt = $this->db->prepare("
            SELECT 
                a.*,
                s.status AS status_text
                FROM activities a
                LEFT JOIN activity_status s ON a.status_id = s.id");
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
            "message" => "No se encontraron actividades"
        ];
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