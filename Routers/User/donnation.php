<?php
 require_once('../../Controllers/User/donnation_controller.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (
            isset($_POST['categorieAide']) &&
            isset($_POST['num_ccp']) && isset($_POST['montant']) && isset($_FILES['recu_virement'])
        ) {
            $controller = new donnation_controller();
            $controller->send_donnation_controller(
                $_SESSION['ID'],
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
