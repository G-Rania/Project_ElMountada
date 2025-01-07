<?php
require_once('../../Views/User/homePageUser_view.php');
require_once('../../Models/User/homePageUser_model.php');

class homePageUser_controller{

    public function get_cardUser_controller($idUser){
        $model = new homePageUser_model();
        $special_offers = $model->get_cardUser_model($idUser);
        return $special_offers;
    }
    
     public function get_specialOffersUser_controller($idUser){
        $model = new homePageUser_model();
        $special_offers = $model->get_specialOffersUser_model($idUser);
        return $special_offers;
    }
    public function get_offersUser_controller($idUser){
        $model = new homePageUser_model();
        $offers = $model->get_offersUser_model($idUser);
        return $offers;
    }

    public function display_homePageUser_controller($idUser){
        $view = new homePageUser_view();
        $view->display_homePageUser_view($idUser);
    }
}

?>