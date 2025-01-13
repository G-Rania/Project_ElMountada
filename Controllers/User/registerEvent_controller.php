<?php
require_once('../../Models/User/registerEvent_model.php');

class registerEvent_controller{

    public function send_registration_controller($idUser,$idEvent){
        $model = new registerEvent_model();
        $model->send_registration_model($idUser,$idEvent);
    }
}
?>