<?php
 require_once('../../Controllers/User/allOffers_controller.php');

 session_start();
 if (isset($_SESSION['username']) && isset($_SESSION['user_id']) ){
     $instance = new allOffers_controller();
     $instance->display_allOffers_controller( $_SESSION['user_id']);
 }else{
    header("Location: ./signinUser.php");
 }
