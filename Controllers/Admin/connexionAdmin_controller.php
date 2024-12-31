<?php
require_once('../../Models/general/signinLogic_model.php');
require_once('../../Views/Admin/signinAdmin_view.php');

class connexionAdmin_controller{

     public function signinAdmin_controller($username, $password){
        $model = new signinLogic_model();
        $model->signin_model("admin",$username,$password,"./signinAdmin.php","./partenairesAdmin.php");
    }


    public function display_signinAdminPage_controller(){
        $view = new signinAdmin_view();
        $view->display_signinAdmin_view();
    }
}


?>