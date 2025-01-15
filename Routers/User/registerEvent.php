<?php
require_once('../../Controllers/User/registerEvent_controller.php');
require_once('../../Controllers/User/homePageUser_controller.php');

session_start();

if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['event_id'])) {
            $instance = new registerEvent_controller();
            $instance->send_registration_controller($_SESSION['user_id'], $data['event_id']);

            echo json_encode(['success' => true, 'message' => 'Inscription réussie']);
        } else {
            echo json_encode(['success' => false, 'message' => 'ID de l\'événement manquant']);
        }
    } else {
        http_response_code(405); 
        echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
    }
} else {
    http_response_code(401); 
    echo json_encode(['success' => false, 'message' => 'Utilisateur non connecté']);
}
?>
