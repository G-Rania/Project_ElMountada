<?php

$passwords = [
    'password123',  // Haddad Ahmed
    'securePass',   // Bouzidi Fatima
    'pass1234',     // Kacem Nour
    'pass5678',     // Sidhoum Amine
    'secure456',    // Mebarki Salima
    'pass7890',     // Ouadah Rachid
    'securePass2',  // Gouasmia Amina
    'pass1122',     // Touati Yacine
    'pass3344',     // Boudjema Lila
    'securePass3',   // Saadi Khaled
    'admin1',        //Benhaminda Khaled
    'admin2',       //Boukhalfa Amira
    'admin3',       //Achour Yacine
    'admin',
    'gestionnaire1', //Dahmane Karim
    'gestionnaire2', //Brahimi Salima
    'gestionnaire3',  //Toumi Samir
    'partenaire1',
    'partenaire2',
    'partenaire3',
    'partenaire4',
    'partenaire5',
    'partenaire6',
    'partenaire7',
    'partenaire8',
    'partenaire9',
    'partenaire10',
    'partenaire11',
    'partenaire12'
];

// Hachage des mots de passe
$hashedPasswords = array_map(fn($password) => password_hash($password, PASSWORD_DEFAULT), $passwords);


// Connexion MySQL
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ElMountada';

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $data = [
        // Données pour la table User
        "INSERT INTO User (nom, prenom, username, password, email, num_tlp, isMember) VALUES
        ('Haddad', 'Ahmed', 'ahmed123', '{$hashedPasswords[0]}', 'ahmed.haddad@example.com', '0555555555', true),
        ('Bouzidi', 'Fatima', 'fatima.b', '{$hashedPasswords[1]}', 'fatima.bouzid@example.com', '0666666666', false),
        ('Kacem', 'Nour', 'nour_kacem', '{$hashedPasswords[2]}', 'nour.kacem@example.com', '0777777777', true),
        ('Sidhoum', 'Amine', 'amine.sid', '{$hashedPasswords[3]}', 'amine.sidhoum@example.com', '0558888888', false),
        ('Mebarki', 'Salima', 'salima_mebarki', '{$hashedPasswords[4]}', 'salima.mebarki@example.com', '0669999999', true),
        ('Ouadah', 'Rachid', 'rachid.ouadah', '{$hashedPasswords[5]}', 'rachid.ouadah@example.com', '0771111111', true),
        ('Gouasmia', 'Amina', 'amina.g', '{$hashedPasswords[6]}', 'amina.gouasmia@example.com', '0552222222', false),
        ('Touati', 'Yacine', 'yacine_t', '{$hashedPasswords[7]}', 'yacine.touati@example.com', '0663333333', true),
        ('Boudjema', 'Lila', 'lila.boudjema', '{$hashedPasswords[8]}', 'lila.boudjema@example.com', '0774444444', false),
        ('Saadi', 'Khaled', 'khaled.saadi', '{$hashedPasswords[9]}', 'khaled.saadi@example.com', '0555550000', true);",

        //Données pour la table Admin
        "INSERT INTO Admin (username, password, nom, prenom, num_tlp, email, photo) VALUES
        ('khaled_ben',  '{$hashedPasswords[10]}', 'Benhamida', 'Khaled', '0555123456', 'khaled_ben@example.com', 'khaled_ben.jpg'),
        ('amira_bou', '{$hashedPasswords[11]}', 'Boukhalfa', 'Amira', '0556789012', 'amira_bou@example.com', 'amira_bou.jpg'),
        ('yacine_ach', '{$hashedPasswords[12]}', 'Achour', 'Yacine', '0559876543', 'yacine_ach@example.com', 'yacine_ach.jpg'),
        ('admin', '{$hashedPasswords[13]}', 'test_admin', 'test_admin', '0559276543', 'test_admin@example.com', 'admin.jpg');",

        //Données pour la table gestionnaire
        "INSERT INTO Gestionnaire (username, password, nom, prenom, num_tlp, email, photo) VALUES
        ('karim_dah', '{$hashedPasswords[14]}', 'Dahmane', 'Karim', '0551234567', 'karim_dah@example.com', 'karim_dah.jpg'),
        ('salima_bra', '{$hashedPasswords[15]}', 'Brahimi', 'Salima', '0552345678', 'salima_bra@example.com', 'salima_bra.jpg'),
        ('samir_tou', '{$hashedPasswords[16]}', 'Toumi', 'Samir', '0553456789', 'samir_tou@example.com', 'samir_tou.jpg');",

        //Données pour la table ComptePartenaire
        "INSERT INTO ComptePartenaire (idPartenaire, username, password, idCarte) VALUES
        (1, 'hoteleldjazair_admin', '{$hashedPasswords[17]}', 4),
        (2, 'cliniquechifa_admin', '{$hashedPasswords[18]}', 5),
        (3, 'ecolelumiere_admin', '{$hashedPasswords[19]}', 6),
        (4, 'voyagehorizons_admin', '{$hashedPasswords[20]}', 7),
        (5, 'hotelsafir_admin', '{$hashedPasswords[21]}', 8),
        (6, 'clinique_nour_admin', '{$hashedPasswords[22]}', 9),
        (7, 'ecoleibnkhaldoun_admin', '{$hashedPasswords[23]}', 10),
        (8, 'voyagesahara_admin', '{$hashedPasswords[24]}', 11),
        (9, 'hoteltassili_admin', '{$hashedPasswords[25]}', 12),
        (10, 'cliniqueespoir_admin', '{$hashedPasswords[26]}', 13),
        (11, 'ecoleelite_admin', '{$hashedPasswords[27]}', 14),
        (12, 'voyageevasion_admin', '{$hashedPasswords[28]}', 15);",

        // Données pour la table TypeCarte
        "INSERT INTO TypeCarte (nom, description, prix) VALUES
        ('Classique', 'Carte d\'adhérent classique', 500.00),
        ('Premium', 'Carte d\'adhérent premium avec plus de privilèges', 1000.00),
        ('Jeune', 'Carte d\'adhérent pour les jeunes', 300.00),
        ('Partenaire', 'Carte pour les partenaires de EL Mountada', NULL);",

        // Données pour la table Partenaire
        "INSERT INTO Partenaire (nom, description, ville, email, categorie, logo) VALUES
        ('Hôtel El Djazair', 'Un hôtel 5 étoiles au cœur d\'Alger', 'Alger', 'contact@eldjazairhotel.com', 'Hôtel', '../../assets/partenaire/eldjazair_logo.jpg'),
        ('Clinique Chifa', 'Clinique privée spécialisée en cardiologie', 'Oran', 'contact@cliniquechifa.com', 'Clinique', '../../assets/partenaire/chifa_logo.jpg'),
        ('École Lumière', 'École primaire et secondaire de renom', 'Constantine', 'contact@ecolelumiere.com', 'École', '../../assets/partenaire/lumiere_logo.jpg'),
        ('Agence Voyage Horizons', 'Spécialiste des voyages organisés', 'Tizi Ouzou', 'contact@voyagehorizons.com', 'Agence de Voyage', '../../assets/partenaire/horizons_logo.jpg'),
        ('Hôtel Safir', 'Hôtel économique avec des services de qualité', 'Annaba', 'contact@safirhotel.com', 'Hôtel', '../../assets/partenaire/safir_logo.jpg'),
        ('Clinique Nour', 'Clinique esthétique et dermatologique', 'Alger', 'contact@cliniquenour.com', 'Clinique', '../../assets/partenaire/nour_logo.jpg'), 
        ('École Internationale Ibn Khaldoun', 'École internationale avec programme bilingue', 'Setif', 'contact@ibnkhaldounschool.com', 'École', '../../assets/partenaire/ibnkhaldoun_logo.jpg'),
        ('Agence Voyage Sahara', 'Excursions et circuits dans le sud algérien', 'Ouargla', 'contact@voyagesahara.com', 'Agence de Voyage', '../../assets/partenaire/sahara_logo.jpg'),
        ('Hôtel Tassili', 'Hôtel traditionnel avec vue panoramique', 'Béjaïa', 'contact@tassilihotel.com', 'Hôtel', '../../assets/partenaire/tassili_logo.jpg'),
        ('Clinique Espoir', 'Clinique spécialisée en soins orthopédiques', 'Batna', 'contact@cliniqueespoir.com', 'Clinique', '../../assets/partenaire/espoir_logo.jpg'),
        ('École Élite', 'École privée avec activités parascolaires enrichies', 'Oran', 'contact@ecoleelite.com', 'École', '../../assets/partenaire/elite_logo.jpg'),
        ('Agence Voyage Évasion', 'Voyages personnalisés pour les particuliers et entreprises', 'Alger', 'contact@voyageevasion.com', 'Agence de Voyage', '../../assets/partenaire/evasion_logo.jpg');",

        // Données pour la table Offre
        "INSERT INTO Offre (idPartenaire, idTypeCarte, nom, wilaya, pourcentage) VALUES

        -- Offres pour Hôtel El Djazair
        (1, 1, 'Réduction sur les chambres de luxe', 'Alger', 15.00),
        (1, 2, 'Offre spéciale week-end', 'Alger', 20.00),
        (1, 3, 'Promotion sur les suites Présidentielles', 'Alger', 10.00),
        (1, 1, 'Accès gratuit au spa pour deux nuits réservées', 'Alger', 0.00),
        (1, 2, 'Petit-déjeuner offert pour toute réservation', 'Alger', 5.00),
        (1, 3, 'Tarif réduit pour les membres Premium', 'Alger', 25.00),

        -- Offres pour Clinique Chifa
        (2, 1, 'Consultation gratuite après une première visite', 'Alger', 100.00),
        (2, 2, 'Réduction sur les examens cardiaques complets', 'Oran', 15.00),
        (2, 3, 'Offre spéciale pour les suivis post-opératoires', 'Alger', 10.00),
        (2, 1, 'Tarif réduit pour les bilans annuels', 'Oran', 20.00),
        (2, 2, 'Réduction sur les tests de laboratoire', 'Oran', 12.00),
        (2, 3, 'Forfait spécial pour les membres étudiants', 'Oran', 30.00),

        -- Offers for École Lumière
        (3, 1, 'Réduction sur les frais de scolarité pour la première année', 'Constantine', 20.00),
        (3, 2, 'Tarif réduit pour les activités extrascolaires', 'Constantine', 15.00),
        (3, 3, 'Offre pour les inscriptions de plusieurs enfants', 'Constantine', 25.00),
        (3, 1, 'Fournitures scolaires gratuites pour les nouveaux élèves', 'Constantine', 0.00),
        (3, 2, 'Réduction sur les voyages scolaires', 'Constantine', 10.00),

        -- Offers for Agence Voyage Horizons
        (4, 1, 'Réduction sur les circuits touristiques locaux', 'Tizi Ouzou', 20.00),
        (4, 2, 'Offre spéciale sur les destinations internationales', 'Tizi Ouzou', 15.00),
        (4, 3, 'Promotions pour les réservations en groupe', 'Tizi Ouzou', 30.00),
        (4, 1, 'Réduction pour les membres Premium', 'Tizi Ouzou', 25.00),
        (4, 2, 'Tarif réduit pour les circuits culturels', 'Tizi Ouzou', 10.00),

        -- Offers for Hôtel Safir
        (5, 1, 'Promotion pour les réservations de trois nuits', 'Annaba', 10.00),
        (5, 2, 'Petit-déjeuner inclus pour les séjours prolongés', 'Annaba', 5.00),
        (5, 3, 'Réduction pour les chambres standard', 'Annaba', 15.00),
        (5, 1, 'Accès gratuit au Wi-Fi premium', 'Annaba', 0.00),
        (5, 2, 'Tarif réduit pour les membres réguliers', 'Annaba', 8.00),

        -- Offres pour Clinique Nour
        (6, 1, 'Réduction sur les consultations dermatologiques', 'Alger', 10.00),
        (6, 2, 'Offre spéciale pour les soins anti-âge', 'Alger', 20.00),
        (6, 3, 'Promotion sur les traitements esthétiques', 'Alger', 15.00),
        (6, 1, 'Forfait complet pour les soins du visage', 'Alger', 25.00),
        (6, 2, 'Réduction sur les services pour les membres Premium', 'Alger', 30.00),
        (6, 3, 'Offre d\'évaluation dermatologique gratuite', 'Alger', 100.00),

        -- Offres pour École Internationale Ibn Khaldoun
        (7, 1, 'Réduction sur les frais d\'inscription', 'Setif', 10.00),
        (7, 2, 'Promotions sur les programmes bilingues', 'Setif', 15.00),
        (7, 3, 'Offre pour les étudiants brillants', 'Setif', 25.00),
        (7, 1, 'Réduction pour les activités sportives', 'Setif', 8.00),
        (7, 2, 'Tarif spécial pour les familles nombreuses', 'Setif', 20.00),

        -- Offres pour Agence Voyage Sahara
        (8, 1, 'Promotion sur les circuits dans le désert', 'Ouargla', 20.00),
        (8, 2, 'Offre spéciale pour les réservations en groupe', 'Ouargla', 15.00),
        (8, 3, 'Réduction sur les voyages de deux semaines ou plus', 'Ouargla', 25.00),
        (8, 1, 'Forfait tout compris pour les circuits', 'Ouargla', 30.00),
        (8, 2, 'Tarif spécial pour les étudiants', 'Ouargla', 12.00),

        -- Offres pour Hôtel Tassili
        (9, 1, 'Réduction sur les suites avec vue panoramique', 'Béjaïa', 15.00),
        (9, 2, 'Petit-déjeuner offert pour toutes les réservations', 'Béjaïa', 0.00),
        (9, 3, 'Promotion pour les séjours de plus de deux nuits', 'Béjaïa', 20.00),
        (9, 1, 'Réduction sur les activités touristiques organisées', 'Béjaïa', 10.00),
        (9, 2, 'Offre spéciale pour les réservations anticipées', 'Béjaïa', 25.00),

        -- Offres pour Clinique Espoir
        (10, 1, 'Réduction sur les consultations orthopédiques', 'Batna', 20.00),
        (10, 2, 'Promotion sur les examens médicaux complets', 'Batna', 15.00),
        (10, 3, 'Offre spéciale pour les suivis post-traitement', 'Batna', 10.00),
        (10, 1, 'Tarif réduit pour les soins réguliers', 'Batna', 5.00),
        (10, 2, 'Réduction pour les membres Premium', 'Batna', 25.00);",

        //Données pour la table OffreSpeciale
        "INSERT INTO OffreSpeciale (idPartenaire, idTypeCarte, nom, description, pourcentage, date_debut, date_fin) VALUES
        (1, 1, 'Offre spéciale 1', 'Offre de réduction de 20% sur les réservations à l\'Hôtel El Djazair.', 20.00, '2024-12-01', '2025-01-15'),
        (2, 2, 'Offre spéciale 2', 'Réduction de 15% sur les soins cardiovasculaires à la Clinique Chifa.', 15.00, '2025-01-01', '2025-02-30'),
        (3, 3, 'Offre spéciale 3', 'Bénéficiez de 10% de réduction sur les frais de scolarité à l\'École Lumière.', 10.00, '2025-12-01', '2025-01-01'),
        (4, 4, 'Offre spéciale 4', 'Réduction de 25% sur les voyages organisés avec l\'Agence Voyage Horizons.', 25.00, '2024-04-01', '2024-11-30'),
        (5, 1, 'Offre spéciale 5', '10% de réduction sur les chambres à l\'Hôtel Safir.', 10.00, '2024-12-01', '2025-01-31'),
        (6, 2, 'Offre spéciale 6', 'Réduction de 30% sur les soins dermatologiques à la Clinique Nour.', 30.00, '2024-06-01', '2024-12-31'),
        (7, 3, 'Offre spéciale 7', 'Bénéficiez de 12% de réduction sur les frais d\'inscription à l\'École Internationale Ibn Khaldoun.', 12.00, '2024-07-01', '2024-12-31'),
        (8, 4, 'Offre spéciale 8', 'Réduction de 20% sur les excursions avec l\'Agence Voyage Sahara.', 20.00, '2024-12-01', '2025-01-31'),
        (9, 1, 'Offre spéciale 9', '15% de réduction sur les réservations à l\'Hôtel Tassili.', 15.00, '2024-09-01', '2024-12-31'),
        (10, 2, 'Offre spéciale 10', 'Réduction de 18% sur les soins orthopédiques à la Clinique Espoir.', 18.00, '2024-10-01', '2024-12-31'),
        (11, 3, 'Offre spéciale 11', '10% de réduction sur les frais d\'inscription à l\'École Élite.', 10.00, '2024-11-01', '2024-12-31'),
        (12, 4, 'Offre spéciale 12', 'Réduction de 30% sur les voyages personnalisés avec l\'Agence Voyage Évasion.', 30.00, '2024-12-01', '2024-12-31');",

        // Données pour la table DemandeCarte
        "INSERT INTO DemandeCarte (idUser, idTypeCarte, photo, piece_identite, recu_paiement, status) VALUES
        (1, 1, 'photo1.jpg', 'id1.jpg', 'recu1.pdf', 'approved'),
        (2, 2, 'photo2.jpg', 'id2.jpg', 'recu2.pdf', 'pending'),
        (3, 3, 'photo3.jpg', 'id3.jpg', 'recu3.pdf', 'rejected'),
        (4, 1, 'photo4.jpg', 'id4.jpg', 'recu4.pdf', 'approved'),
        (5, 3, 'photo3.jpg', 'id3.jpg', 'recu3.pdf', 'pending'),
        (6, 1, 'photo6.jpg', 'id6.jpg', 'recu6.pdf', 'pending'),
        (7, 1, 'photo7.jpg', 'id7.jpg', 'recu7.pdf', 'pending'),
        (8, 2, 'photo8.jpg', 'id8.jpg', 'recu8.pdf', 'pending'),
        (9, 2, 'photo9.jpg', 'id9.jpg', 'recu9.pdf', 'approved'),        
        (10, 2, 'photo10.jpg', 'id10.jpg', 'recu10.pdf', 'pending');",

        //Données pour la table Carte
        "INSERT INTO Carte (idUser, idTypeCarte, date_exp, recu_paiement) VALUES
        (1, 1, '2025-12-22', 'recu1.pdf'),
        (4, 1, '2025-12-22', 'recu4.pdf'),
        (9, 2, '2025-12-22', 'recu9.pdf');",

        //Données de la table OffreCarte
        "INSERT INTO OffreCarte (idCarte, idOffre, date) VALUES
        (1, 1, '2024-12-01'),
        (1, 4, '2024-11-11'),
        (1, 7, '2024-12-15'),
        (2, 7, '2024-12-06'),
        (3, 2, '2024-12-05'),
        (3, 5, '2024-12-10'),
        (3, 8, '2025-11-30');",

        //Données pour la table CategorieAide
        "INSERT INTO CategorieAide (nom, description) VALUES
        ('Santé', 'Aide pour les frais médicaux, soins, et traitements.'),
        ('Éducation', 'Soutien financier pour la scolarité, les fournitures et la formation.'),
        ('Alimentation', 'Assistance pour l\'achat de produits alimentaires de première nécessité.'),
        ('Logement', 'Aide pour la réparation ou la recherche d\'un logement.'),
        ('Catastrophes naturelles', 'Soutien pour les victimes d\'intempéries ou de sinistres naturels.'),
        ('Vêtements', 'Aide pour l\'achat de vêtements pour les personnes dans le besoin.');",


        //Données pour la table DemandeAide
        "INSERT INTO DemandeAide (idUser, idCategorieAide, nom, prenom, date_naissance, description, dossier, date, status, motif_rejet) VALUES
        (1, 1, 'Benali', 'Ahmed', '1985-05-15', 'Demande d\'aide pour des soins médicaux urgents.', 'dossier_medical_ahmed.pdf', '2024-12-01 10:00:00', 'approved', NULL),
        (2, 2, 'Bouzid', 'Fatima', '1990-08-22', 'Soutien financier pour payer les frais de scolarité de mes enfants.', 'justificatif_scolarite_fatima.pdf', '2024-12-02 11:30:00', 'pending', NULL),
        (3, 3, 'Kacem', 'Nour', '1995-03-10', 'Aide alimentaire pour le mois en cours.', 'declaration_revenus_nour.pdf', '2024-12-03 09:15:00', 'rejected', 'Dossier incomplet. Veuillez ajouter les justificatifs.'),
        (4, 1, 'Sidhoum', 'Amine', '1978-12-05', 'Demande d\'assistance pour financer une opération chirurgicale.', 'rapport_medical_amine.pdf', '2024-12-04 14:45:00', 'approved', NULL),
        (5, 5, 'Mebarki', 'Salima', '1989-07-18', 'Soutien pour réparer les dégâts causés par les intempéries.', 'photos_degats_salima.pdf', '2024-12-05 16:20:00', 'pending', NULL),
        (6, 4, 'Ouadah', 'Rachid', '1983-09-11', 'Demande d\'aide pour trouver un logement temporaire après un incendie.', 'dossier_incendie_rachid.pdf', '2024-12-06 12:00:00', 'approved', NULL),
        (7, 6, 'Gouasmia', 'Amina', '1992-04-09', 'Soutien financier pour acheter des vêtements d\'hiver pour mes enfants.', 'justificatif_vetements_am.pdf', '2024-12-07 08:40:00', 'rejected', 'Montant demandé excessif pour ce type d\'aide.'),
        (8, 3, 'Touati', 'Yacine', '1987-01-20', 'Demande de bons alimentaires pour ma famille.', 'declaration_famille_yacine.pdf', '2024-12-08 13:55:00', 'pending', NULL),
        (9, 1, 'Boudjema', 'Lila', '1993-11-30', 'Aide financière pour des soins dentaires.', 'rapport_dentaire_lila.pdf', '2024-12-09 17:10:00', 'approved', NULL),
        (10, 5, 'Saadi', 'Khaled', '1976-06-14', 'Assistance pour des réparations suite à un sinistre naturel.', 'photos_sinistre_khaled.pdf', '2024-12-10 19:25:00', 'pending', NULL);",

        //Données pour la table Aide 
        "INSERT INTO Aide (idUser, idCategorieAide, description, nom, prenom, adresse, phoneNumber, montant, dossier) VALUES
        (1, 1, 'Demande d\'aide pour des soins médicaux urgents.', 'Benali', 'Ahmed', 'Alger, Rue de la liberté', '0555555555', 15000.00, 'dossier_medical_ahmed.pdf'),
        (4, 1, 'Demande d\'assistance pour financer une opération chirurgicale.', 'Sidhoum', 'Amine', 'Tizi Ouzou, Route des montagnes', '0666666666', 30000.00, 'rapport_medical_amine.pdf'),
        (6, 5, 'Demande d\'aide pour trouver un logement temporaire après un incendie.', 'Ouadah', 'Rachid', 'Sétif, Cité des Rosiers', '0777777777', 20000.00, 'dossier_incendie_rachid.pdf'),
        (9, 1, 'Aide financière pour des soins dentaires.', 'Boudjema', 'Lila', 'Oran, Avenue de la Paix', '0558888888', 10000.00, 'rapport_dentaire_lila.pdf');",

        //Données pour la table Evenement
        "INSERT INTO Evenement (nom, description, texte, img, date_evenement, heure_evenement) VALUES
        ('Collecte de Fonds pour les Orphelins', 
        'Un événement caritatif visant à collecter des fonds pour soutenir les orphelins en Algérie.',
        'Participez à cette collecte pour faire une différence dans la vie des enfants défavorisés.', 
        '../../assets/general/event1.png',
        '2024-12-30', '10:00:00'),

        ('Distribution de Repas Chauds', 
        'Une action de bénévolat pour distribuer des repas chauds aux sans-abris.',
        'Rejoignez notre équipe pour offrir un moment de réconfort aux personnes dans le besoin.', 
        '../../assets/general/event2.png',
        '2024-12-25', '12:00:00'),

        ('Journée de Nettoyage de Quartier', 
        'Une initiative locale pour nettoyer et embellir notre quartier.',
        'Mobilisons-nous pour rendre notre environnement plus propre et accueillant.', 
        '../../assets/general/event3.png',
        '2024-12-28', '09:00:00'),

        ('Atelier d\'Aide Scolaire', 
        'Un atelier destiné à aider les enfants en difficulté scolaire.',
        'Apportez votre soutien pour encadrer des sessions éducatives et encourager la réussite.', 
        '../../assets/general/event4.png',
        '2025-01-10', '14:00:00'),

        ('Campagne de Don de Vêtements', 
        'Une campagne pour collecter et distribuer des vêtements aux familles démunies.',
        'Vos contributions peuvent aider à garder les enfants et adultes au chaud cet hiver.', 
        '../../assets/general/event5.png',
        '2025-01-15', '16:30:00'),

        ('Forum des Associations', 
        'Un forum réunissant plusieurs associations caritatives pour échanger et collaborer.',
        'Découvrez les initiatives en cours et comment vous pouvez contribuer.', 
        '../../assets/general/event6.png',
        '2025-02-05', '10:00:00'),

        ('Soirée de Sensibilisation sur la Pauvreté', 
        'Une soirée dédiée à sensibiliser le public sur les défis liés à la pauvreté.',
        'Rejoignez-nous pour des discussions et témoignages inspirants.', 
        '../../assets/general/event7.png',
        '2025-02-10', '18:00:00'),

        ('Marche Solidaire pour la Santé', 
        'Une marche organisée pour sensibiliser à l\'importance de l\'accès aux soins de santé.',
        'Faites partie de cet événement pour soutenir les communautés marginalisées.', 
        '../../assets/general/event8.png',
        '2025-03-01', '08:00:00');",

        //Données pour la table Benevolat
        "INSERT INTO Benevolat (idUser, idEvenement) VALUES
        (1, 5),
        (2,4),
        (5,1),
        (2,2),
        (4,3),
        (6,1),
        (10,2),
        (8,4),
        (6,5),
        (4,4);",

        //Données pour la table Don 
        "INSERT INTO Don (idUser, num_ccp, montant, recu_virement, idCategorieAide, status) VALUES
        (1, '1234567890', 100.00, 'reçu1.png', 1, 'approved'),
        (2, '0987654321', 50.00, 'reçu2.png', 2, 'pending'),     
        (3, '1122334455', 200.00, 'reçu3.png', 3, 'approved'),  
        (4, '2233445566', 75.00, 'reçu4.png', 4, 'rejected'),  
        (5, '6677889900', 150.00, 'reçu5.png', 5, 'pending'),   
        (6, '3344556677', 300.00, 'reçu6.png', 6, 'approved');",   

        //Données pour la table PartenaireFavoris
        "INSERT INTO PartenaireFavoris (idUser, idPartenaire) VALUES
        (1,5),
        (1,12),
        (1,1),
        (2,4),
        (5,1),
        (2,2),
        (4,3),
        (6,1),
        (10,2),
        (8,4),
        (6,5),
        (4,4);",

        //Données pour la table Menu
        "INSERT INTO Menu (nom, lien) VALUES
        ('Accueil', ''),
        ('Nos activités', ''),
        ('Nos offres', ''),
        ('Nos partenaires', ''),
        ('Contactez nous', '');",
  

        //Données pour la table Submenu
        "INSERT INTO Submenu (nom, idMenu, lien) VALUES
        ('Hôtels', 4, ''),
        ('Cliniques', 4, ''),
        ('Ecoles', 4, ''),
        ('Agences de voyage', 4, '');",

        //Données pour la table Diaporama
        "INSERT INTO Diaporama (nom, lien) VALUES
        ('pic1', '../../assets/diaporama/pic1.jpg'),
        ('pic2', '../../assets/diaporama/pic2.jpg'),
        ('pic3', '../../assets/diaporama/pic3.jpg'),
        ('pic4', '../../assets/diaporama/pic4.jpg'),
        ('pic5', '../../assets/diaporama/pic5.jpg');",

        //Données pour la table SocialMediaLinks
        "INSERT INTO SocialMediaLinks (nom, logo, lien) VALUES
        ('facebook', '../../assets/socialMedia/facebook.png', 'https://www.facebook.com/'),
        ('instagram', '../../assets/socialMedia/instagram.png', 'https://www.instagram.com/'),
        ('linkedin', '../../assets/socialMedia/linkedin.png', 'https://www.linkedin.com/');",
    ];

    foreach ($data as $query) {
        $conn->exec($query);
    }

    echo "Données insérées avec succès dans la base de données !";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
