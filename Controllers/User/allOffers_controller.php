<?php
require_once('../../Views/User/allOffers_view.php');

class allOffers_controller{

    public function display_allOffers_controller($idUser){
        $view = new allOffers_view();
        $view->display_allOffers_view($idUser);
    }
}

?>