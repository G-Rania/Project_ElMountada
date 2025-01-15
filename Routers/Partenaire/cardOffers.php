<?php
require_once('../../Controllers/Partenaire/cardOffers_controller.php');
require_once('../../Controllers/Partenaire/homePagePartenaire_controller.php');

session_start();

if (isset($_SESSION['username']) && isset($_SESSION['comptepartenaire_id']) ){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            if (isset($_POST['cardId'])) {
                $controller = new cardOffers_controller();
                $controller->display_cardOffers_controller($_POST['cardId'], $_SESSION['comptepartenaire_id']);
            } else {
                throw new Exception("ID de la carte non spécifié.");
            }
        } catch (Exception $ex) {
            echo "<p>Erreur : " . $ex->getMessage() . "</p>";
        }
    }else {
        $controller = new homePagePartenaire_controller();
        $controller->display_homePagePartenaire_controller($_SESSION['comptepartenaire_id']);
    }
}else{
    header("Location: ./signinPartenaire.php");
}