<?php
 require_once('../../Controllers/Admin/donnations_controller.php');

 session_start();
 if (isset($_SESSION['username']) && isset($_SESSION['ID']) ){
     $instance = new donnations_controller();
     $instance->display_donnations_controller();
     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action'])) {
            $controller = new donnations_controller();
            $data = json_decode(file_get_contents('php://input'), true);
            try {
                if ($_GET['action'] === 'accept' && isset($data['donnation_id'])) {
                    $controller->accept_donnation_controller($data['donnation_id']);
                    echo json_encode(['success' => true, 'message' => 'Don accepté']);
                } else if($_GET['action'] === 'reject' && isset($data['donnation_id'])) {
                    $controller->reject_donnation_controller($data['donnation_id']);
                    echo json_encode(['success' => true, 'message' => 'Don refusé']);
                }
                else {
                    echo json_encode(['success' => false, 'message' => 'Paramètres manquants ou invalides']);
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
    }
 }else{
    header("Location: ./signinAdmin.php");
 }
