<?php
require_once('Models/general/footer_model.php');
require_once('Views/general/footer_view.php');

class footer_controller{

    public function get_socialMediaLink_controller($nom){
        $model = new footer_model();
        $link = $model->get_socialMediaLink_model(nom: $nom);
        return $link;
    }

    public function display_footer_controller(){
        $view = new footer_view();
        $view->display_footer_view();
    }

}


?>