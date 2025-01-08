<?php
require_once('../../Views/User/subscriptionUser_view.php');
require_once('../../Models/User/subscriptionUser_model.php');
require_once('../../Controllers/general/uploadingFiles_controller.php');

class subscriptionUser_controller{

     public function get_typesCarte_controller(){
        $model = new subscriptionUser_model();
        $types = $model->get_typesCarte_model();
        return $types;
    }

    public function send_cardRequest_controller($idUser,$typeCarte,$photo,$piece_identite,$recu_paiement) {

        $upload = new uploadingFiles_controller();

        $photoPath = $upload->uploadFile($photo);
        $piece_identitePath = $upload->uploadFile($piece_identite);
        $recu_paiementPath = $upload->uploadFile($recu_paiement);

        $model = new subscriptionUser_model();
        $model->send_cardRequest_model($idUser, $typeCarte, $photoPath, $piece_identitePath, $recu_paiementPath);
    }

    public function display_subscriptionPage_controller(){
        $view = new subscriptionUser_view();
        $view->display_subscriptionPage_view();
    }
}
?>