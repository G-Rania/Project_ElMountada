<?php
 require_once('../../Controllers/User/homePageUser_controller.php');

 session_start();
 if (isset($_SESSION['username']) && isset($_SESSION['user_id']) ){
     $instance = new homePageUser_controller();
     $instance->display_homePageUser_controller( $_SESSION['user_id']);
 }else{
    header("Location: ./signinUser.php");
 }
