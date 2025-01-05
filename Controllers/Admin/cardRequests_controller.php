<?php
require_once('../../Views/Admin/cardRequests_view.php');
require_once('../../Models/Admin/cardRequests_model.php');

class cardRequests_controller{

     public function get_cardRequests_controller(){
        $model = new cardRequests_model();
        $card_requests = $model->get_cardRequests_model();
        return $card_requests;
    }

    public function accept_cardRequest_controller($cardRequest_id){
        $model = new cardRequests_model();
        $model->accept_cardRequest_model($cardRequest_id);
    }

    public function reject_cardRequest_controller($cardRequest_id, $motif){
        $model = new cardRequests_model();
        $model->reject_cardRequest_model($cardRequest_id, $motif);
    }

    public function display_cardRequests_controller(){
        $view = new cardRequests_view();
        $view->display_cardRequests_view();
    }
}

?>