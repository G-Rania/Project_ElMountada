<?php
require_once('../../Views/general/categoryPartenaire_view.php');
require_once('../../Models/general/categoryPartenaire_model.php');

class categoryPartenaire_controller{

    public function get_categoryPartanaires_controller($category){
        $model = new categoryPartenaire_model();
        $partners = $model->get_categoryPartanaires_model($category);
        return $partners;
    }

    public function display_categoryPartenaire_controller($category){
        $view = new categoryPartenaire_view();
        $view->display_categoryPartenaire_view($category);
    }
}

?>