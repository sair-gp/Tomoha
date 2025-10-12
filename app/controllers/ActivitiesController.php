<?php
session_start();
require_once __DIR__ . '/../models/ActivitiesModel.php';

class ActivitiesController {

    public function __construct() {
        $this->activitiesModel = new ActivitiesModel();
    }

    private function requireAuth() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /');
            exit();
        }
    }
    
    public function index() {
        $this->requireAuth();
        require __DIR__ . '/../views/administration/activities.php';
    }

    public function get() {
        $this->requireAuth();
        $activities = $this->activitiesModel->get();

        header('Content-Type: application/json');
        echo json_encode($activities);
    }

    public function upcoming() {
        $activities = $this->activitiesModel->upcoming();

        header('Content-Type: application/json');
        echo json_encode($activities);
    }
}