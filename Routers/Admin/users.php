<?php
 require_once('../../Controllers/Admin/users_controller.php');

 session_start();
 if (isset($_SESSION['username']) && isset($_SESSION['admin_id']) ){
     $instance = new users_controller();
     $instance->display_users_controller();
 }else{
    header("Location: ./signinAdmin.php");
}
