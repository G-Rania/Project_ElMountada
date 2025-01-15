<?php
require_once('../../Controllers/User/subscriptionUser_controller.php');

session_start();

if (isset($_SESSION['username']) && isset($_SESSION['user_id']) ){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (
            isset($_POST['typeCarte']) &&
            isset($_FILES['photo']) && isset($_FILES['piece_identite']) && isset($_FILES['recu_paiement'])
        ) {
            $controller = new subscriptionUser_controller();
            $controller->send_cardRequest_controller(
                $_SESSION['user_id'],
                $_POST['typeCarte'],
                $_FILES['photo'],
                $_FILES['piece_identite'],
                $_FILES['recu_paiement']
            );
        } else {
            throw new Exception("Formulaire incomplet ou non envoyé correctement.");
        }
    } catch (Exception $ex) {
        echo "<p>Erreur : " . $ex->getMessage() . "</p>";
    }
    }else {
        $controller = new subscriptionUser_controller();
        $controller->display_subscriptionPage_controller();
    }
}else{
    header("Location: ./signinUser.php");
}

