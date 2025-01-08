<?php
require_once('../../Models/general/signinLogic_model.php');
require_once('../../Views/Partenaire/signinPartenaire_view.php');

class connexionPartenaire_controller{

     public function signinPartenaire_controller($username, $password){
        $model = new signinLogic_model();
        $model->signin_model("comptepartenaire",$username,$password,"./signinPartenaire.php","./homePagePartenaire.php");
    }


    public function display_signinPartenairePage_controller(){
        $view = new signinPartenaire_view();
        $view->display_signinPartenaire_view();
    }
}


?>