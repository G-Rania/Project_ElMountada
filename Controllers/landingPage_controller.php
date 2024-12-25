<?php
require_once('Models/landingPage_model.php');
require_once('Views/landingPage_view.php');

class landingPage_controller{

     public function get_diaporama_controller(){
        $model = new landingPage_model();
        $diaporama = $model->get_diaporama_model();
        return $diaporama;
    }

     public function get_events_controller(){
        $model = new landingPage_model();
        $events = $model->get_events_model();
        return $events;
    }

    public function get_offers_controller(){
        $model = new landingPage_model();
        $offers = $model->get_offers_model();
        return $offers;
    }

    public function get_categoryOffer_controller($idPartenaire){
        $model = new landingPage_model();
        $category = $model->get_categoryOffer_model($idPartenaire);
        return $category;
    }

    public function get_partners_controller(){
        $model = new landingPage_model();
        $partners = $model->get_partners_model();
        return $partners;
    }

    public function display_landingPage_controller(){
        $view = new landingPage_view();
        $view->display_landingPage_view();
    }

}


?>