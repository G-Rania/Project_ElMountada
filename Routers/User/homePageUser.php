<?php
 require_once('../../Controllers/User/homePageUser_controller.php');

 session_start();
 if (isset($_SESSION['username']) && isset($_SESSION['ID']) ){
     $instance = new homePageUser_controller();
     $instance->display_homePageUser_controller( $_SESSION['ID']);
 }else{
    header("Location: ./signinUser.php");
 }
