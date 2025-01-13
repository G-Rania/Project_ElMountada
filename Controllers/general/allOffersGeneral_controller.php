<?php
require_once('../../Views/general/allOffersGeneral_view.php');

class allOffersGeneral_controller{

    public function display_allOffersGeneral_controller(){
        $view = new allOffersGeneral_view();
        $view->display_allOffersGeneral_view();
    }
}

?>