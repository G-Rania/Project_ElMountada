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

    public function add_partenaire_model ($nom, $description, $logo, $categorie, $ville, $email){
        $conn = new database_connection();
        $this_conn = $conn->connect_db();

        //insertion dans la table partenaire
        $sql = "INSERT INTO partenaire (nom, description, ville ,email, categorie, logo) VALUES (:nom, :description, :ville, :email, :categorie, :logo)";
        $request = $this_conn->prepare($sql);
        $request->bindParam(':nom', $nom, PDO::PARAM_STR);
        $request->bindParam(':description', $description, PDO::PARAM_STR);
        $request->bindParam(':ville', $ville, PDO::PARAM_STR);
        $request->bindParam(':email', $email, PDO::PARAM_STR);
        $request->bindParam(':categorie', $categorie, PDO::PARAM_STR);
        $request->bindParam(':logo', $logo, PDO::PARAM_STR);

        $request->execute();

        //récupérer le id du partenaire
        $sql = "SELECT * FROM partenaire WHERE nom = :nom";
        $request = $this_conn->prepare($sql);
        $request->bindParam(":nom", $nom, PDO::PARAM_STR);
        $request->execute();

        $result = $request->fetch(PDO::FETCH_ASSOC);
        $idPartenaire = $result['ID'];

        //création d'un compte partenaire
        $username = $nom . '_admin';
        $hashedPassword = password_hash($username, PASSWORD_DEFAULT);

        $sql = "INSERT INTO comptepartenaire (idPartenaire, username, password) VALUES (:idPartenaire, :username, :password)";
        $request = $this_conn->prepare($sql);
        $request->bindParam(':idPartenaire', $idPartenaire, PDO::PARAM_INT);
        $request->bindParam(':username', $username, PDO::PARAM_STR);
        $request->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

        $request->execute();

        $conn->disconnect_db($this_conn);

    }


}
?>