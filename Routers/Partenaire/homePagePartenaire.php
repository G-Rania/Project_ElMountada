<?php
 require_once('../../Controllers/Partenaire/homePagePartenaire_controller.php');

 session_start();
 if (isset($_SESSION['username']) && isset($_SESSION['comptepartenaire_id']) ){
     $instance = new homePagePartenaire_controller();
     $instance->display_homePagePartenaire_controller($_SESSION['comptepartenaire_id']);
 }else{
    header("Location: ./signinPartenaire.php");
 }