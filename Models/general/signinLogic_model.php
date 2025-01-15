<?php
require_once('../../ConnectionDB/database_connection.php');

class signinLogic_model{

    public function signin_model($table, $username, $password, $current, $router) {
    session_start();
    $conn = new database_connection();
    $this_conn = $conn->connect_db();

    $sql = "SELECT * FROM $table WHERE username = :username";
    $request = $this_conn->prepare($sql);
    $request->bindParam(":username", $username, PDO::PARAM_STR);
    $request->execute();

    if ($request->rowCount() === 1) {
        $row = $request->fetch(PDO::FETCH_ASSOC);
        
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
 
            //depends on the type of user : admin, partenaire, simple user
            $session_id_key = $table . '_id'; 
            $_SESSION[$session_id_key] = $row['ID'];

            header("Location: $router");
            $conn->disconnect_db($this_conn);
            exit();
        } else {
            $_SESSION['error_message'] = "Mot de passe incorrect !";
            header("Location: $current");
            $conn->disconnect_db($this_conn);
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Nom d'utilisateur incorrect !";
        header("Location: $current");
        $conn->disconnect_db($this_conn);
        exit();
    }
}


}


?>