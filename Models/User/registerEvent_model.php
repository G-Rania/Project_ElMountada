<?php
require_once('../../Controllers/User/registerEvent_controller.php');
require_once('../../ConnectionDB/database_connection.php');

class registerEvent_model{

    public function send_registration_model($idUser,$idEvent) {
        $conn = new database_connection();
        $this_conn = $conn->connect_db();

        $sql = "INSERT INTO benevolat (idUser, idEvenement)  VALUES (:idUser, :idEvent)";
        $request = $this_conn->prepare(query: $sql);
        $request->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $request->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
        $request->execute();
        $conn->disconnect_db($this_conn);
    }
}


?>