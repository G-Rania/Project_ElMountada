<?php
require_once('../../Controllers/general/categoryPartenaire_controller.php');
require_once('../../ConnectionDB/database_connection.php');

class categoryPartenaire_model{

     public function get_categoryPartanaires_model($category){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();
        $sql = "SELECT * FROM partenaire WHERE categorie = :category";
        $request = $this_conn->prepare($sql);
        $request->bindParam(':category', $category, PDO::PARAM_STR);
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        $conn->disconnect_db( $this_conn );
        return $result;  
    }


}


?>