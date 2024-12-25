<?php
require_once('Controllers/general/header_controller.php');
require_once('ConnectionDB/database_connection.php');

class header_model{

    public function get_menu_model(){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();
        $sql = "SELECT * FROM menu";
        $request = $this_conn->prepare($sql);
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        $conn->disconnect_db( $this_conn );
        return $result;
    }

    public function get_submenu_model($idMenu){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();
        $sql = "SELECT * FROM submenu WHERE idMenu = :idMenu";
        $request = $this_conn->prepare($sql);
        $request->bindParam(':idMenu', $idMenu, PDO::PARAM_INT);
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        $conn->disconnect_db( $this_conn );
        return $result;
    }

}


?>