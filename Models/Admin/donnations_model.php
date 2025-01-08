<?php
require_once('../../Controllers/Admin/donnations_controller.php');
require_once('../../ConnectionDB/database_connection.php');

class donnations_model{

    public function get_donnations_model(){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();
        
        $sql = "SELECT  
            user.username, 
            don.ID, 
            don.num_ccp, 
            don.montant, 
            don.date, 
            don.recu_virement, 
            categorieaide.nom AS categorie_aide_nom
        FROM user
        JOIN don ON user.ID = don.idUser
        JOIN categorieaide ON categorieaide.ID = don.idCategorieAide
        WHERE don.status = 'pending'";

        $request = $this_conn->prepare($sql);
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        if (!$result) {
            error_log("Aucune donnée trouvée dans la requête SQL.");
        }
        $conn->disconnect_db( $this_conn );
        return $result;
    }

    public function accept_donnation_model($donnation_id){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();
        $sql = "UPDATE don SET status = 'approved' WHERE ID = :donnation_id";
        $request = $this_conn->prepare(query: $sql);
        $request->bindParam(':donnation_id', $donnation_id, PDO::PARAM_INT);
        $request->execute();
        $conn->disconnect_db($this_conn);
    }

    public function reject_donnation_model($donnation_id){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();
        $sql = "UPDATE don SET status = 'rejected' WHERE ID = :donnation_id";
        $request = $this_conn->prepare(query: $sql);
        $request->bindParam(':donnation_id', $donnation_id, PDO::PARAM_INT);
        $request->execute();
        $conn->disconnect_db($this_conn);
    }
}
?>