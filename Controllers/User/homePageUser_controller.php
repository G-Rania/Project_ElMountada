<?php
require_once('../../Views/User/homePageUser_view.php');

class homePageUser_controller{

    public function display_homePageUser_controller(){
        $view = new homePageUser_view();
        $view->display_homePageUser_view();
    }
}

?>