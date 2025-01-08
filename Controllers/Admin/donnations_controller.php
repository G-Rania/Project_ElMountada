<?php
require_once('../../Views/Admin/donnations_view.php');
require_once('../../Models/Admin/donnations_model.php');

class donnations_controller{

     public function get_donnations_controller(){
        $model = new donnations_model();
        $donnations = $model->get_donnations_model();
        return $donnations;
    }

    public function accept_donnation_controller($donnation_id){
        $model = new donnations_model();
        $model->accept_donnation_model($donnation_id);
    }

    public function reject_donnation_controller($donnation_id){
        $model = new donnations_model();
        $model->reject_donnation_model($donnation_id);
    }

    public function display_donnations_controller(){
        $view = new donnations_view();
        $view->display_donnations_view();
    }
}

?>