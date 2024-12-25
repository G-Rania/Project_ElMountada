<?php
 require_once('../../Controllers/User/connexionUser_controller.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new connexionUser_controller();
    $controller->signupUser_controller($_POST['username'], $_POST['email'], $_POST['password']);
} else {
    $controller = new connexionUser_controller();
    $controller->display_signupUserPage_controller();
}