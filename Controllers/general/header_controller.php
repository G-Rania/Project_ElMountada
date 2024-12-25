<?php
require_once('../../Models/general/header_model.php');
require_once('../../Views/general/header_view.php');

class header_controller{
   
    public function get_menu_controller(){
        $model = new header_model();
        $menu = $model->get_menu_model();
        return $menu;
    }

    public function get_submenu_controller($idMenu){
        $model = new header_model();
        $submenu = $model->get_submenu_model($idMenu);
        return $submenu;
    }

    public function display_header_controller(){
        $view = new header_view();
        $view->display_header_view();
    }

}


?>