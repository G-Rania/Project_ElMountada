<?php
 require_once('../../Controllers/Admin/cardRequests_controller.php');

 session_start();
 if (isset($_SESSION['username']) && isset($_SESSION['ID']) ){
     $instance = new cardRequests_controller();
     $instance->display_cardRequests_controller();
     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action'])) {
            $controller = new cardRequests_controller();
            $data = json_decode(file_get_contents('php://input'), true);

            try {
                if ($_GET['action'] === 'accept' && isset($data['cardRequest_id'])) {
                    $controller->accept_cardRequest_controller($data['cardRequest_id']);
                    echo json_encode(['success' => true, 'message' => 'Demande acceptée']);
                } else if($_GET['action'] === 'reject' && isset($data['cardRequest_id'])) {
                    $controller->reject_cardRequest_controller($data['cardRequest_id'], $data['motif']);
                    echo json_encode(['success' => true, 'message' => 'Demande refusée']);
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
