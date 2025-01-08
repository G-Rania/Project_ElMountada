<?php
require_once('../../Controllers/Admin/users_controller.php');
require_once('../../ConnectionDB/database_connection.php');

class users_model{

    public function get_users_model(){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();

        $sql = "SELECT  
            user.nom,
            user.prenom,
            user.username, 
            user.email,
            user.num_tlp,
            user.isMember,
            carte.ID AS idCarte,
            carte.photo, 
            carte.date_exp, 
            typecarte.nom AS nom_type_carte
        FROM user
        LEFT JOIN carte ON user.ID = carte.idUser
        LEFT JOIN typecarte ON typecarte.ID = carte.idTypeCarte";

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