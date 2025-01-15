<?php
 require_once('../../Controllers/Admin/partenairesAdmin_controller.php');

 session_start();
 if (isset($_SESSION['username']) && isset($_SESSION['admin_id']) ){

    $instance = new partenairesAdmin_controller();

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $instance->add_partenaire_controller($_POST['nom'],$_POST['description'],$_POST['logo'],$_POST['categorie'],$_POST['ville'],$_POST['email']);
    }
    $instance->display_partenairesAdmin_controller();
 }else{
    header("Location: ./signinAdmin.php");
 }