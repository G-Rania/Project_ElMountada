<?php
 require_once('../../Controllers/User/donnation_controller.php');

session_start();

if (isset($_SESSION['username']) && isset($_SESSION['user_id']) ){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (
            isset($_POST['categorieAide']) &&
            isset($_POST['num_ccp']) && isset($_POST['montant']) && isset($_FILES['recu_virement'])
        ) {
            $controller = new donnation_controller();
            $controller->send_donnation_controller(
                $_SESSION['user_id'],
                $_POST['categorieAide'],
                $_POST['num_ccp'],
                $_POST['montant'],
                $_FILES['recu_virement']
            );
        } else {
            throw new Exception("Formulaire incomplet ou non envoyé correctement.");
        }
    } catch (Exception $ex) {
        echo "<p>Erreur : " . $ex->getMessage() . "</p>";
    }
    }else {
        $controller = new donnation_controller();
        $controller->display_donnationPage_controller();
    }

}else{
    header("Location: ./signinUser.php");
}
