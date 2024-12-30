<?php
 require_once('../../Controllers/User/subscriptionUser_controller.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try{
        $controller = new subscriptionUser_controller();
        $controller->send_cardRequest_controller($_POST['typeCarte'],$_FILES['photo'],$_FILES['piece_identite'],$_FILES['recu_paiement']);
    }catch (PDOException $ex) {
        echo "<p>Erreur : " . $ex->getMessage() . "</p>";
    }
} else {
    $controller = new subscriptionUser_controller();
    $controller->display_subscriptionPage_controller();
}