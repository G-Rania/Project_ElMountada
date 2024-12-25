<?php
require_once('Controllers/landingPage_controller.php');
require_once('ConnectionDB/database_connection.php');

class landingPage_model{

    public function get_diaporama_model(){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();
        $sql = "SELECT * FROM diaporama";
        $request = $this_conn->prepare($sql);
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        $conn->disconnect_db( $this_conn );
        return $result;
    }

    public function get_events_model(){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();
        $sql = "SELECT * FROM evenement ORDER BY date_evenement DESC";
        $request = $this_conn->prepare($sql);
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        $conn->disconnect_db( $this_conn );
        return $result;
    }

    public function get_offers_model(){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();
        $sql = "SELECT * FROM offre WHERE idTypeCarte = 1";
        $request = $this_conn->prepare($sql);
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        $conn->disconnect_db( $this_conn );
        return $result;
    }

    public function get_categoryOffer_model($idPartenaire){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();
        $sql = "SELECT categorie FROM partenaire WHERE ID = :idPartenaire";
        $request = $this_conn->prepare($sql);
        $request->bindParam(':idPartenaire', $idPartenaire, PDO::PARAM_INT);
        $request->execute();
        $result = $request->fetch(PDO::FETCH_ASSOC);
        $conn->disconnect_db( $this_conn );
        return $result['categorie'] ?? null;
    }

     public function get_partners_model(){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();
        $sql = "SELECT * FROM partenaire";
        $request = $this_conn->prepare($sql);
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        $conn->disconnect_db( $this_conn );
        return $result;  
    }


}


?>