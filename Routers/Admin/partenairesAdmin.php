<?php
 require_once('../../Controllers/Admin/partenairesAdmin_controller.php');

 session_start();
 if (isset($_SESSION['username']) && isset($_SESSION['ID']) ){
     $instance = new partenairesAdmin_controller();
     $instance->display_partenairesAdmin_controller();
 }else{
    header("Location: ./signinAdmin.php");
 }
