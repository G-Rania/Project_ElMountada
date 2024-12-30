<?php
require_once('../../Views/User/subscriptionUser_view.php');
require_once('../../Models/User/subscriptionUser_model.php');

class subscriptionUser_controller{

     public function get_typesCarte_controller(){
        $model = new subscriptionUser_model();
        $types = $model->get_typesCarte_model();
        return $types;
    }

    public function send_cardRequest_controller($typeCarte,$photo,$piece_identite,$recu_paiement) {

        $photoPath = $this->uploadFile($photo);
        $piece_identitePath = $this->uploadFile($piece_identite);
        $recu_paiementPath = $this->uploadFile($recu_paiement);

        $model = new subscriptionUser_model();
        $model->send_cardRequest_model($typeCarte, $photoPath, $piece_identitePath, $recu_paiementPath);
    }

    public function uploadFile($file) {
        $targetDir = "../../assets/uploads/";
        $targetFile = $targetDir . basename($file["name"]);
        
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }
        
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return $targetFile;
        } else {
            throw new Exception("Erreur lors de l'upload du fichier : " . $file["error"]);
        }
    }


    public function display_subscriptionPage_controller(){
        $view = new subscriptionUser_view();
        $view->display_subscriptionPage_view();
    }
}
?>