<?php
require_once('../../Views/Partenaire/cardOffers_view.php');
require_once('../../Models/Partenaire/cardOffers_model.php');

class cardOffers_controller{

    public function get_cardOffers_controller($idCard, $idComptePartenaire){
        $model = new cardOffers_model();
        $offers = $model->get_cardOffers_model($idCard, $idComptePartenaire);
        return $offers;
    }
    public function display_cardOffers_controller($idCard, $idComptePartenaire){
        $view = new cardOffers_view();
        $view->display_cardOffers_view($idCard, $idComptePartenaire);
    }
}
?>