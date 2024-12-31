<?php
require_once('../../Controllers/Admin/partenairesAdmin_controller.php');
require_once('../../ConnectionDB/database_connection.php');

class partenairesAdmin_model{

    public function get_partenaires_model(){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();
        $sql = "SELECT partenaire.nom, partenaire.logo, partenaire.categorie, partenaire.email, comptepartenaire.username FROM partenaire JOIN comptepartenaire ON partenaire.ID = comptepartenaire.idPartenaire";
        $request = $this_conn->prepare($sql);
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        if (!$result) {
            error_log("Aucune donnée trouvée dans la requête SQL.");
        }
        $conn->disconnect_db( $this_conn );
        return $result;
    }


}
?>