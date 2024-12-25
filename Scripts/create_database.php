<?php
// Connexion MySQL
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ElMountada';

try {
    $conn = new PDO("mysql:host=$host", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->exec("CREATE DATABASE IF NOT EXISTS $database CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;");
    $conn->exec("USE $database;");

    $tables = [
        // Table User
        "CREATE TABLE IF NOT EXISTS User (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            nom VARCHAR(100) NOT NULL,
            prenom VARCHAR(100) NOT NULL,
            username VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            email VARCHAR(150) NOT NULL UNIQUE,
            num_tlp VARCHAR(15),
            isMember BOOLEAN DEFAULT FALSE
        );",

        // Table Carte
        "CREATE TABLE IF NOT EXISTS Carte (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            idUser INT,
            idTypeCarte INT NOT NULL,
            date_inscr TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            date_exp TIMESTAMP,
            recu_paiement VARCHAR(255),
            FOREIGN KEY (idUser) REFERENCES User(ID),
            FOREIGN KEY (idTypeCarte) REFERENCES TypeCarte(ID)
        );",

        // Table TypeCarte
        "CREATE TABLE IF NOT EXISTS TypeCarte (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            nom VARCHAR(100) NOT NULL UNIQUE,
            description TEXT,
            prix DECIMAL(10, 2)
        );",

        //Table PartenaireFavoris
         "CREATE TABLE IF NOT EXISTS PartenaireFavoris (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            idUser INT NOT NULL,
            idPartenaire INT NOT NULL,
            UNIQUE(idUser,idPartenaire),
            FOREIGN KEY (idUser) REFERENCES User(ID),
            FOREIGN KEY (idPartenaire) REFERENCES Partenaire(ID)
        );",

        // Table Partenaire
        "CREATE TABLE IF NOT EXISTS Partenaire (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            nom VARCHAR(100) NOT NULL UNIQUE,
            description TEXT,
            ville VARCHAR(100),
            email VARCHAR(150),
            categorie VARCHAR(100),
            logo VARCHAR(255)
        );",

        // Table Offre
        "CREATE TABLE IF NOT EXISTS Offre (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            idPartenaire INT NOT NULL,
            idTypeCarte INT NOT NULL,
            nom VARCHAR(100) NOT NULL,
            wilaya VARCHAR(100) NOT NULL,
            pourcentage DECIMAL(5, 2) NOT NULL,
            UNIQUE (idPartenaire, idTypeCarte, nom, pourcentage),
            FOREIGN KEY (idPartenaire) REFERENCES Partenaire(ID),
            FOREIGN KEY (idTypeCarte) REFERENCES TypeCarte(ID)
        );",

        // Table OffreCarte
        "CREATE TABLE IF NOT EXISTS OffreCarte (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            idCarte INT NOT NULL,
            idOffre INT NOT NULL,
            date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (idCarte) REFERENCES Carte(ID),
            FOREIGN KEY (idOffre) REFERENCES Offre(ID)
        );",

        // Table OffreSpeciale
        "CREATE TABLE IF NOT EXISTS OffreSpeciale (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            idPartenaire INT NOT NULL,
            idTypeCarte INT NOT NULL,
            nom VARCHAR(100) NOT NULL,
            description TEXT,
            pourcentage DECIMAL(5, 2) NOT NULL,
            date_debut DATE NOT NULL,
            date_fin DATE NOT NULL,
            FOREIGN KEY (idPartenaire) REFERENCES Partenaire(ID),
            FOREIGN KEY (idTypeCarte) REFERENCES TypeCarte(ID)
        );",

        // Table ComptePartenaire
        "CREATE TABLE IF NOT EXISTS ComptePartenaire (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            idPartenaire INT NOT NULL,
            username VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            idCarte INT NOT NULL,
            FOREIGN KEY (idPartenaire) REFERENCES Partenaire(ID),
            FOREIGN KEY (idCarte) REFERENCES Carte(ID)
        );",

        // Table Don
        "CREATE TABLE IF NOT EXISTS Don (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            idUser INT NOT NULL,
            num_ccp VARCHAR(20) NOT NULL,
            montant DECIMAL(10, 2) NOT NULL,
            date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            recu_virement VARCHAR(255),
            idCategorieAide INT,
            status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
            FOREIGN KEY (idUser) REFERENCES User(ID),
            FOREIGN KEY (idCategorieAide) REFERENCES CategorieAide(ID)
        );",

        // Table CategorieAide
        "CREATE TABLE IF NOT EXISTS CategorieAide (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            nom VARCHAR(100) NOT NULL UNIQUE,
            description TEXT
        );",

        //Table Aide
        "CREATE TABLE IF NOT EXISTS Aide (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            idUser INT,
            idCategorieAide INT NOT NULL,
            description TEXT,
            nom VARCHAR(100),
            prenom VARCHAR(100),
            adresse VARCHAR(100),
            phoneNumber VARCHAR(100),
            date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            montant DECIMAL(10, 2) NOT NULL,
            dossier VARCHAR(255)
        );",

        // Table DemandeCarte
        "CREATE TABLE IF NOT EXISTS DemandeCarte (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            idUser INT NOT NULL,
            idTypeCarte INT NOT NULL,
            photo VARCHAR(255),
            piece_identite VARCHAR(255),
            date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            recu_paiement VARCHAR(255),
            status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
            motif_rejet TEXT DEFAULT NULL,
            FOREIGN KEY (idUser) REFERENCES User(ID),
            FOREIGN KEY (idTypeCarte) REFERENCES TypeCarte(ID)
        );",

        // Table DemandeAide
        "CREATE TABLE IF NOT EXISTS DemandeAide (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            idUser INT,
            idCategorieAide INT NOT NULL,
            nom VARCHAR(100),
            prenom VARCHAR(100),
            date_naissance DATE,
            description TEXT,
            dossier VARCHAR(255),
            date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
            motif_rejet TEXT DEFAULT NULL,
            FOREIGN KEY (idUser) REFERENCES User(ID),
            FOREIGN KEY (idCategorieAide) REFERENCES CategorieAide(ID)
        );",

        // Table Evenement
        "CREATE TABLE IF NOT EXISTS Evenement (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            nom VARCHAR(100) NOT NULL,
            description TEXT,
            texte TEXT,
            img VARCHAR(100) NOT NULL,
            UNIQUE(nom,date_evenement),
            date_evenement DATE NOT NULL,
            heure_evenement TIME NOT NULL
        );",

        // Table Benevolat
        "CREATE TABLE IF NOT EXISTS Benevolat (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            idUser INT NOT NULL,
            idEvenement INT NOT NULL,
            FOREIGN KEY (idUser) REFERENCES User(ID),
            FOREIGN KEY (idEvenement) REFERENCES Evenement(ID)
        );",

        // Table Admin
        "CREATE TABLE IF NOT EXISTS Admin (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            nom VARCHAR(100),
            prenom VARCHAR(100),
            num_tlp VARCHAR(15),
            email VARCHAR(150) NOT NULL UNIQUE,
            photo VARCHAR(255)
        );",

        // Table Gestionnaire
        "CREATE TABLE IF NOT EXISTS Gestionnaire (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            nom VARCHAR(100),
            prenom VARCHAR(100),
            num_tlp VARCHAR(15),
            email VARCHAR(150) NOT NULL UNIQUE,
            photo VARCHAR(255)
        );",

        // Table SocialMediaLinks
        "CREATE TABLE IF NOT EXISTS SocialMediaLinks (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            nom VARCHAR(100) NOT NULL UNIQUE,
            logo VARCHAR(255),
            lien VARCHAR(255)
        );",

        // Table Portails
        "CREATE TABLE IF NOT EXISTS Portails (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            nom VARCHAR(100) NOT NULL UNIQUE,
            lien VARCHAR(255)
        );",

        // Table Menu
        "CREATE TABLE IF NOT EXISTS Menu (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            nom VARCHAR(100) NOT NULL UNIQUE,
            lien VARCHAR(255)
        );",

        // Table Submenu
        "CREATE TABLE IF NOT EXISTS Submenu (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            idMenu INT NOT NULL,
            nom VARCHAR(100) NOT NULL,
            lien VARCHAR(255),
            FOREIGN KEY (idMenu) REFERENCES Menu(ID)
        );",

        // Table Diaporama
        "CREATE TABLE IF NOT EXISTS Diaporama (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            nom VARCHAR(100) NOT NULL UNIQUE,
            lien VARCHAR(255)
        );"
    ];

    foreach ($tables as $table) {
        $conn->exec($table);
    }

    echo "Base de données et tables créées avec succès !";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
