<?php
require_once('../../Views/User/donnation_view.php');
require_once('../../Models/User/donnation_model.php');
require_once('../../Controllers/general/uploadingFiles_controller.php');

class donnation_controller{

     public function get_categoriesAide_controller(){
        $model = new donnation_model();
        $categories = $model->get_ctegoriesAide_model();
        return $categories;
    }

    public function send_donnation_controller($idUser,$idCategorieAide,$num_ccp,$montant,$recu_virement) {

        $upload = new uploadingFiles_controller();
        $recu_virementPath = $upload->uploadFile($recu_virement);

        $model = new donnation_model();
        $model->send_donnation_model($idUser,$idCategorieAide,$num_ccp,$montant,$recu_virementPath);
    }

    public function display_donnationPage_controller(){
        $view = new donnation_view();
        $view->display_donnationPage_view();
    }
}
?>