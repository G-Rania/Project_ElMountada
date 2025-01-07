<?php
require_once('../../Controllers/User/subscriptionUser_controller.php');
require_once('../../ConnectionDB/database_connection.php');

class subscriptionUser_model{

    public function get_typesCarte_model(){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();
        $sql = "SELECT * FROM typecarte WHERE nom != 'Partenaire'";
        $request = $this_conn->prepare($sql);
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        $conn->disconnect_db( $this_conn );
        return $result;
    }

    public function send_cardRequest_model($idUser, $typeCarte, $photo, $piece_identite, $recu_paiement) {
        session_start();
        $conn = new database_connection();
        $this_conn = $conn->connect_db();

        $sql = "INSERT INTO demandecarte (idUser, idTypeCarte, photo, piece_identite, recu_paiement)  VALUES (:idUser, :idTypeCarte, :photo, :piece_identite, :recu_paiement)";
        $request = $this_conn->prepare(query: $sql);
        $request->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $request->bindParam(':idTypeCarte', $typeCarte, PDO::PARAM_INT);
        $request->bindParam(':photo', $photo, PDO::PARAM_STR);
        $request->bindParam(':piece_identite', $piece_identite, PDO::PARAM_STR);
        $request->bindParam(':recu_paiement', $recu_paiement, PDO::PARAM_STR);

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