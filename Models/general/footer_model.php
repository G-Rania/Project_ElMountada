<?php
require_once('../../Controllers/general/footer_controller.php');
require_once('../../ConnectionDB/database_connection.php');

class footer_model{
    
    public function get_socialMediaLink_model($nom){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();
        $sql = "SELECT lien FROM socialmedialinks WHERE nom = :nom";
        $request = $this_conn->prepare($sql);
        $request->bindParam(':nom', $nom, PDO::PARAM_STR);
        $request->execute();
        $result = $request->fetch(PDO::FETCH_ASSOC);
        $conn->disconnect_db( $this_conn );
        return $result['lien'] ?? null;
    }

}

?>