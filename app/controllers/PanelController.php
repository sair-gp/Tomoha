<?php
session_start();

class PanelController {

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . '/');
            exit();
        }
    }
    
    public function index() {
        require __DIR__ . '/../views/dashboard.php';
    }
}