<?php
require_once('../../Controllers/Partenaire/cardOffers_controller.php');
require_once('../../ConnectionDB/database_connection.php');

class  cardOffers_model{

    public function get_cardOffers_model($idCard, $idComptePartenaire){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();
        $sql = "SELECT * FROM carte WHERE ID = :idCard";
        $request = $this_conn->prepare(query: $sql);
        $request->bindParam(':idCard', $idCard, PDO::PARAM_INT);
        $request->execute(); 
        $result = $request->fetch(PDO::FETCH_ASSOC);
        if ($result and strtotime(datetime: date('Y-m-d H:i:s'))< strtotime($result["date_exp"])){
            $idTypeCarte = $result["idTypeCarte"];
            $sql = "SELECT offre.nom AS nom_offre, offre.wilaya, offre.pourcentage
            FROM comptepartenaire JOIN offre ON comptepartenaire.idPartenaire = offre.idPartenaire
            WHERE idTypeCarte = :idTypeCarte
            AND comptepartenaire.ID = :idComptePartenaire";
            $request = $this_conn->prepare(query: $sql);
            $request->bindParam(':idTypeCarte', $idTypeCarte, PDO::PARAM_INT);
            $request->bindParam(':idComptePartenaire', $idComptePartenaire, PDO::PARAM_INT);
            $request->execute(); 
            $result = $request->fetchAll(PDO::FETCH_ASSOC);
        }
        $conn->disconnect_db( $this_conn );
        return $result;
    }

}


?>