<?php
 require_once('../../Controllers/Partenaire/homePagePartenaire_controller.php');

 session_start();
 if (isset($_SESSION['username']) && isset($_SESSION['ID']) ){
     $instance = new homePagePartenaire_controller();
     $instance->display_homePagePartenaire_controller($_SESSION['ID']);
 }else{
    header("Location: ./signinPartenaire.php");
 }