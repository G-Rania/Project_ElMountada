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

        $sql = "SELECT idUser, idTypeCarte, photo FROM demandecarte WHERE ID = :cardRequest_id";
        $request = $this_conn->prepare(query: $sql);
        $request->bindParam(':cardRequest_id', $cardRequest_id, PDO::PARAM_INT);
        $request->execute();
        $result = $request->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            throw new Exception("Aucune donnée trouvée pour la demande de carte ID : $cardRequest_id");
        }

        $idUser = $result["idUser"];
        $idTypeCarte = $result["idTypeCarte"];
        $photo = $result["photo"];

        $sql = "SELECT * FROM carte WHERE idUser = :idUser";
        $request = $this_conn->prepare($sql);
        $request->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $request->execute();
        $result = $request->fetch(PDO::FETCH_ASSOC);

        if ($result){ 
            // the user has already a card => upgrade card
            $sql = "UPDATE carte SET 
            idTypeCarte = :idTypeCarte,
            photo = :photo,
            date_exp = DATE_ADD(NOW(), INTERVAL 1 YEAR)
            WHERE ID = :idCarte";
            $request = $this_conn->prepare($sql);
            $request->bindParam(':idTypeCarte', $idTypeCarte, PDO::PARAM_INT);
            $request->bindParam(':photo', $photo, PDO::PARAM_STR);
            $request->bindParam(':idCarte', $result["ID"], PDO::PARAM_INT);
            $request->execute();
        } else{
            // the user is buying a card for the first time => is member
            $sql = "INSERT INTO carte (idUser, idTypeCarte, photo, date_exp) VALUES (:idUser, :idTypeCarte, :photo, DATE_ADD(NOW(), INTERVAL 1 YEAR))";
            $request = $this_conn->prepare($sql);
            $request->bindParam(':idUser', $idUser, PDO::PARAM_INT);
            $request->bindParam(':idTypeCarte', $idTypeCarte, PDO::PARAM_INT);
            $request->bindParam(':photo', $photo, PDO::PARAM_STR);
            $request->execute();

            $sql = "UPDATE user SET isMember = 1 WHERE ID = :idUser";
            $request = $this_conn->prepare(query: $sql);
            $request->bindParam(':idUser', $idUser, PDO::PARAM_INT);
            $request->execute();
        }   

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