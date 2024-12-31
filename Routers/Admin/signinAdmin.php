<?php
 require_once('../../Controllers/Admin/connexionAdmin_controller.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new connexionAdmin_controller();
    $controller->signinAdmin_controller($_POST['username'], $_POST['password']);
} else {
    $controller = new connexionAdmin_controller();
    $controller->display_signinAdminPage_controller();
}