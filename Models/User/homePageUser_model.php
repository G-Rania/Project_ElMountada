<?php
require_once('../../Controllers/User/homePageUser_controller.php');
require_once('../../ConnectionDB/database_connection.php');

class homePageUser_model{


    public function get_cardUser_model($idUser){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();
        $sql = "SELECT 
            user.nom, 
            user.prenom, 
            carte.photo, 
            typecarte.nom AS type_carte_nom,
            carte.date_exp 
        FROM user
        JOIN carte ON user.ID = carte.idUser
        JOIN typecarte ON typecarte.ID = carte.idTypeCarte
        WHERE carte.idUser = :idUser";
        
        $request = $this_conn->prepare(query: $sql);
        $request->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $request->execute(); 
        $result = $request->fetch(PDO::FETCH_ASSOC);
        if ($result and strtotime(datetime: date(format: 'Y-m-d H:i:s'))< strtotime($result["date_exp"])){
            return $result;
        }
        else if ($result){
            return 1;
        }else {
            return 0;
        }
    }

    public function get_specialOffersUser_model($idUser){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();
        $sql = "SELECT * FROM carte WHERE idUser = :idUser";
        $request = $this_conn->prepare(query: $sql);
        $request->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $request->execute(); 
        $result = $request->fetch(PDO::FETCH_ASSOC);
        if ($result and strtotime(datetime: date('Y-m-d H:i:s'))< strtotime($result["date_exp"])){
            $idTypeCarte = $result["idTypeCarte"];
            $currentDate = date('Y-m-d H:i:s');
            $sql = "SELECT offrespeciale.description AS description_offre, partenaire.ville, partenaire.categorie, partenaire.nom AS nom_partenaire, offrespeciale.date_fin 
            FROM partenaire JOIN offrespeciale ON partenaire.ID = offrespeciale.idPartenaire
            WHERE idTypeCarte = :idTypeCarte AND offrespeciale.date_fin > :currentDate";
            $request = $this_conn->prepare(query: $sql);
            $request->bindParam(':idTypeCarte', $idTypeCarte, PDO::PARAM_INT);
            $request->bindParam(':currentDate', $currentDate, PDO::PARAM_STR);
            $request->execute(); 
            $result = $request->fetchAll(PDO::FETCH_ASSOC);
        }
        $conn->disconnect_db( $this_conn );
        return $result;
    }

    public function get_offersUser_model($idUser){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();
        $sql = "SELECT * FROM carte WHERE idUser = :idUser";
        $request = $this_conn->prepare(query: $sql);
        $request->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $request->execute(); 
        $result = $request->fetch(PDO::FETCH_ASSOC);
        if ($result and strtotime(datetime: date('Y-m-d H:i:s'))< strtotime($result["date_exp"])){
            $idTypeCarte = $result["idTypeCarte"];
            $sql = "SELECT offre.nom AS nom_offre, offre.wilaya, offre.pourcentage, partenaire.categorie, partenaire.nom AS nom_partenaire 
            FROM partenaire JOIN offre ON partenaire.ID = offre.idPartenaire
            WHERE idTypeCarte = :idTypeCarte";
            $request = $this_conn->prepare(query: $sql);
            $request->bindParam(':idTypeCarte', $idTypeCarte, PDO::PARAM_INT);
            $request->execute(); 
            $result = $request->fetchAll(PDO::FETCH_ASSOC);
        }
        $conn->disconnect_db( $this_conn );
        return $result;
    }

}


?>