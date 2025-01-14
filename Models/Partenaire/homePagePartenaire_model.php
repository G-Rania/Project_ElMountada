<?php
require_once('../../Controllers/Partenaire/homePagePartenaire_controller.php');
require_once('../../ConnectionDB/database_connection.php');

class homePagePartenaire_model{

      public function get_offersPartenaire_model($idComptePartenaire){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();

        $sql = "SELECT 
            offre.nom, 
            offre.wilaya, 
            offre.pourcentage, 
            offre.ID AS idOffre,
            typecarte.nom AS type_carte_nom
        FROM offre
        JOIN typecarte ON typecarte.ID = offre.idTypeCarte
        JOIN comptepartenaire ON offre.idPartenaire = comptepartenaire.idPartenaire
        WHERE comptepartenaire.ID = :idComptePartenaire ";

        $request = $this_conn->prepare(query: $sql);
        $request->bindParam(':idComptePartenaire', $idComptePartenaire, PDO::PARAM_INT);
        $request->execute(); 
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        $conn->disconnect_db( $this_conn );
        return $result;
    }
}


?>