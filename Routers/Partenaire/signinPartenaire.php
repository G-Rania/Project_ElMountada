<?php
 require_once('../../Controllers/Partenaire/connexionPartenaire_controller.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new connexionPartenaire_controller();
    $controller->signinPartenaire_controller($_POST['username'], $_POST['password']);
} else {
    $controller = new connexionPartenaire_controller();
    $controller->display_signinPartenairePage_controller();
}