<?php
require_once('../../Models/general/signinLogic_model.php');
require_once('../../Models/User/signupUser_model.php');
require_once('../../Views/User/signinUser_view.php');
require_once('../../Views/User/signupUser_view.php');

class connexionUser_controller{

     public function signinUser_controller($username, $password){
        $model = new signinLogic_model();
        $model->signin_model("user",$username,$password,"./signinUser.php","./homePageUser.php");
    }

    public function signupUser_controller($username, $email, $password){
        $model = new signupUser_model($username, $email, $password);
        $model->signupUser_model($username,$email,$password);
    }


    public function display_signinUserPage_controller(){
        $view = new signinUser_view();
        $view->display_signinUser_view();
    }

       public function display_signupUserPage_controller(){
        $view = new signupUser_view();
        $view->display_signupUser_view();
    }
}


?>