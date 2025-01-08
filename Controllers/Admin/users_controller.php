<?php
require_once('../../Views/Admin/users_view.php');
require_once('../../Models/Admin/users_model.php');

class users_controller{

     public function get_users_controller(){
        $model = new users_model();
        $users = $model->get_users_model();
        return $users;
    }

    public function display_users_controller(){
        $view = new users_view();
        $view->display_users_view();
    }
}

?>