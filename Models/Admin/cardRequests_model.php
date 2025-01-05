<?php
require_once('../../Controllers/Admin/cardRequests_controller.php');
require_once('../../ConnectionDB/database_connection.php');

class cardRequests_model{

    public function get_cardRequests_model(){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();
        
        $sql = "SELECT 
            user.nom, 
            user.prenom, 
            user.username, 
            user.email, 
            user.num_tlp, 
            demandecarte.ID, 
            demandecarte.photo, 
            demandecarte.piece_identite, 
            demandecarte.date, 
            demandecarte.recu_paiement, 
            typecarte.nom AS type_carte_nom
        FROM user
        JOIN demandecarte ON user.ID = demandecarte.idUser
        JOIN typecarte ON typecarte.ID = demandecarte.idTypeCarte
        WHERE demandecarte.status = 'pending'";

        $request = $this_conn->prepare($sql);
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        if (!$result) {
            error_log("Aucune donnée trouvée dans la requête SQL.");
        }
        $conn->disconnect_db( $this_conn );
        return $result;
    }

    public function accept_cardRequest_model($cardRequest_id){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();
        $sql = "UPDATE demandecarte SET status = 'approved' WHERE ID = :cardRequest_id";
        $request = $this_conn->prepare(query: $sql);
        $request->bindParam(':cardRequest_id', $cardRequest_id, PDO::PARAM_INT);
        $request->execute();

        $sql = "SELECT idUser, idTypeCarte FROM demandecarte WHERE ID = :cardRequest_id";
        $request = $this_conn->prepare(query: $sql);
        $request->bindParam(':cardRequest_id', $cardRequest_id, PDO::PARAM_INT);
        $request->execute();
        $result = $request->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            throw new Exception("Aucune donnée trouvée pour la demande de carte ID : $cardRequest_id");
        }

        $idUser = $result["idUser"];
        $idTypeCarte = $result["idTypeCarte"];
        $sql = "INSERT INTO carte (idUser, idTypeCarte, date_exp) VALUES (:idUser, :idTypeCarte, DATE_ADD(NOW(), INTERVAL 1 YEAR))";
        $request = $this_conn->prepare($sql);
        $request->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $request->bindParam(':idTypeCarte', $idTypeCarte, PDO::PARAM_INT);
        $request->execute();
        $conn->disconnect_db($this_conn);
    }

    public function reject_cardRequest_model($cardRequest_id, $motif){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();
        $sql = "UPDATE demandecarte SET status = 'rejected', motif_rejet = :motif WHERE ID = :cardRequest_id";
        $request = $this_conn->prepare(query: $sql);
        $request->bindParam(':cardRequest_id', $cardRequest_id, PDO::PARAM_INT);
        $request->bindParam(':motif',$motif, PDO::PARAM_STR).
        $request->execute();
        $conn->disconnect_db($this_conn);
    }


}
?>