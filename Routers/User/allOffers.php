<?php
 require_once('../../Controllers/User/allOffers_controller.php');

 session_start();
 if (isset($_SESSION['username']) && isset($_SESSION['ID']) ){
     $instance = new allOffers_controller();
     $instance->display_allOffers_controller( $_SESSION['ID']);
 }else{
    header("Location: ./signinUser.php");
 }
