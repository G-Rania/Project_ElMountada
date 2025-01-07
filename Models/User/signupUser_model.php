<?php
require_once('../../ConnectionDB/database_connection.php');
require_once("../../Controllers/User/connexionUser_controller.php");

class signupUser_model{
   
    public function signupUser_model($nom, $prenom, $num_tlp, $username, $email, $password) {
        session_start();
        $conn = new database_connection();
        $this_conn = $conn->connect_db();
        $sql = "SELECT * FROM user WHERE username = :username OR email = :email";
        $request = $this_conn->prepare($sql);
        $request->bindParam(':username', $username, PDO::PARAM_STR);
        $request->bindParam(':email', $email, PDO::PARAM_STR);
        $request->execute();

        if ($request->rowCount() > 0) {
            $_SESSION['error_message'] = "Nom d'utilisateur ou email existant !";
            header("Location: ./signupUser.php");
            $conn->disconnect_db($this_conn);
            return false; 
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (nom, prenom, num_tlp ,username, email, password) VALUES (:nom, :prenom, :num_tlp, :username, :email, :password)";
        $request = $this_conn->prepare($sql);
        $request->bindParam(':nom', $nom, PDO::PARAM_STR);
        $request->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $request->bindParam(':num_tlp', $num_tlp, PDO::PARAM_STR);
        $request->bindParam(':username', $username, PDO::PARAM_STR);
        $request->bindParam(':email', $email, PDO::PARAM_STR);
        $request->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

        $request->execute();

        $sql = "SELECT * FROM user WHERE username = :username";
        $request = $this_conn->prepare($sql);
        $request->bindParam(":username", $username, PDO::PARAM_STR);
        $request->execute();

        $result = $request->fetch(PDO::FETCH_ASSOC);
        $idUser = $result['ID'];

        $conn->disconnect_db($this_conn);

        if ($request->rowCount() > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['ID'] = $idUser;
            header("Location: ./homePageUser.php");
            return true; 
        } else {
            return false; 
        }

    }
}

?>