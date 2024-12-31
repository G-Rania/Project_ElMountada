<?php
require_once('../../Views/Admin/partenairesAdmin_view.php');
require_once('../../Models/Admin/partenairesAdmin_model.php');

class partenairesAdmin_controller{

     public function get_partenaires_controller(){
        $model = new partenairesAdmin_model();
        $partenaires = $model->get_partenaires_model();
        return $partenaires;
    }

    public function display_partenairesAdmin_controller(){
        $view = new partenairesAdmin_view();
        $view->display_partenairesAdmin_view();
    }
}

?>