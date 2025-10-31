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

    // GET /api/activities
    public function getAll() {
        $this->requireAuth();
        
        try {
            $activities = $this->activitiesModel->getAll();

            header('Content-Type: application/json');
            
            if (!empty($activities)) {
                echo json_encode([
                    'success' => true,
                    'data' => $activities,
                    'count' => count($activities)
                ]);
            } else {
                echo json_encode([
                    'success' => true,
                    'data' => [],
                    'count' => 0,
                    'message' => 'No se encontraron actividades'
                ]);
            }
            
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'error' => 'Error al obtener las actividades: ' . $e->getMessage()
            ]);
        }
    }

    // POST /api/activities
    public function create() {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode([
                'success' => false,
                'error' => 'Método no permitido'
            ]);
            return;
        }

        try {
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!$input) {
                throw new Exception('Datos no proporcionados');
            }

            $activityId = $this->activitiesModel->create($input);
                    
            http_response_code(201);
            echo json_encode([
                'success' => true,
                'message' => 'Actividad creada exitosamente',
                'id' => $activityId
            ]);
            
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function upcoming() {
        $activities = $this->activitiesModel->upcoming();

        header('Content-Type: application/json');
        echo json_encode($activities);
    }
}