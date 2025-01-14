<?php
require_once('../../Views/Partenaire/homePagePartenaire_view.php');
require_once('../../Models/Partenaire/homePagePartenaire_model.php');

class homePagePartenaire_controller{

    public function get_offersPartenaire_controller($idComptePartenaire){
        $model = new homePagePartenaire_model();
        $offers = $model->get_offersPartenaire_model($idComptePartenaire);
        return $offers;
    }
    public function display_homePagePartenaire_controller($idPartenaire){
        $view = new homePagePartenaire_view();
        $view->display_homePagePartenaire_view($idPartenaire);
    }
}

?>