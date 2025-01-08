<?php
require_once('../../Controllers/User/donnation_controller.php');
require_once('../../ConnectionDB/database_connection.php');

class donnation_model{

    public function get_ctegoriesAide_model(){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();
        $sql = "SELECT * FROM categorieaide";
        $request = $this_conn->prepare($sql);
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        $conn->disconnect_db( $this_conn );
        return $result;
    }

    public function send_donnation_model($idUser,$idCategorieAide,$num_ccp,$montant,$recu_virement) {
        session_start();
        $conn = new database_connection();
        $this_conn = $conn->connect_db();

        $sql = "INSERT INTO don (idUser, idCategorieAide, num_ccp, montant, recu_virement)  VALUES (:idUser, :idCategorieAide, :num_ccp, :montant, :recu_virement)";
        $request = $this_conn->prepare(query: $sql);
        $request->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $request->bindParam(':idCategorieAide', $idCategorieAide, PDO::PARAM_INT);
        $request->bindParam(':num_ccp', $num_ccp, PDO::PARAM_STR);
        $request->bindParam(':montant', $montant, PDO::PARAM_STR);
        $request->bindParam(':recu_virement', $recu_virement, PDO::PARAM_STR);

        $request->execute();
        $conn->disconnect_db($this_conn);

        if ($request->rowCount() > 0) {
            header("Location: ./homePageUser.php");
            return true; 
        } else {
            return false; 
        }

    }

}


?>