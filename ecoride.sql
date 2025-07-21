CREATE DATABASE IF NOT EXISTS ecoride_haut_de_france;

USE ecoride_haut_de_france;

SELECT DATABASE();


CREATE TABLE IF NOT EXISTS `chauffeurs` (
  `id_chauffeurs` int(11) NOT NULL AUTO_INCREMENT,
  `moyenne_note_chauffeur` FLOAT NULL,
  `plaque_immatruculation` VARCHAR (50) NOT NULL,
  `date_1_mise_circulation` DATE NOT NULL,
  `modele` varchar(50) NOT NULL,
  `couleur` varchar(50) NOT NULL,
  `marque` varchar(50) NOT NULL,
  `animal`BOOLEAN NOT NULL,
  `fumeur` BOOLEAN NOT NULL,
  `preferences` TEXT NULL,
  PRIMARY KEY (`id_chauffeurs`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `chauffeurs` (`moyenne_note_chauffeur`,`plaque_immatruculation`, `date_1_mise_circulation`, `modele`, `couleur`, `marque`, `animal`, `fumeur`, `preferences`) VALUES
(4.8,'AB-123-CD', '2020-05-15', 'Clio 5', 'Rouge', 'Renault', TRUE, FALSE, 'Musique calme, pas de climatisation'),
(4.2,'EF-456-GH', '2018-03-10', '308', 'Noir', 'Peugeot', FALSE, TRUE, 'Silence'),
(4.9,'IJ-789-KL', '2022-01-22', 'Model 3', 'Blanc', 'Tesla', TRUE, TRUE, 'Musique rock'),
(3.7,'MN-321-OP', '2016-07-05', 'Golf 7', 'Gris', 'Volkswagen', FALSE, FALSE, 'Discussions ouvertes, café offert'),
(4.5,'QR-654-ST', '2019-11-30', 'Civic', 'Bleu', 'Honda', TRUE, FALSE, 'Climatisation à 21°C, pas de musique');

CREATE TABLE IF NOT EXISTS `passagers` (
  `id_passagers` int(11) NOT NULL AUTO_INCREMENT,
  `date_trajet` DATE NOT NULL,
  `heure_trajet` DATETIME NOT NULL,
  `nbre_places` INT NOT NULL,
  `date_crédit_en_cours` DATE NOT NULL,
  `credit_en_cours` INT NOT NULL,
  `credit_provisoire` INT NOT NULL,
  `date_credit_provisoire` DATE NOT NULL,
  `credit_restant` INT NOT NULL,
  PRIMARY KEY (`id_passagers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

USE ecoride_haut_de_france;

INSERT INTO `passagers` (`date_trajet`,`heure_trajet`, `nbre_places`, `date_crédit_en_cours`, `credit_en_cours`, `debit`, `date_debit`, `credit_restant`) VALUES
('2025-07-10 ', '2025-07-10 08:30:00', 1, '2025-07-01', 100, 0, '2025-07-01', 100),
('2025-07-11', '2025-07-11 09:00:00', 2, '2025-07-02', 150, 20,'2025-07-01', 130),
('2025-07-12 ', '2025-07-12 07:45:00', 1, '2025-07-05', 120, 10,'2025-07-04', 110),
('2025-07-13', '2025-07-13 10:15:00', 3, '2025-07-07', 200, 0,'2025-07-07', 200),
('2025-07-14', '2025-07-14 08:00:00', 2, '2025-07-08', 160, 30,'2025-07-08', 130),
('2025-07-15', '2025-07-15 09:45:00', 1, '2025-07-08', 90, 10,'2025-07-07', 80),
('2025-07-16', '2025-07-16 07:30:00', 2, '2025-07-09', 140, 20,'2025-07-08', 120),
('2025-07-17', '2025-07-17 08:50:00', 1, '2025-07-09', 110, 0,'2025-07-09', 110),
('2025-07-18', '2025-07-18 10:00:00', 2, '2025-07-09', 170, 15,'2025-07-08', 155),
('2025-07-19 ', '2025-07-19 09:30:00', 1, '2025-07-09', 95, 5,'2025-07-08', 90);

DESCRIBE passagers;

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateurs` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `date_naissance` DATE DEFAULT NULL,
  `telephone` BIGINT NOT NULL,
  `photo_profil` BLOB DEFAULT NULL,
  `isAdmin` BOOLEAN NOT NULL,
  `isEmploye` BOOLEAN NOT NULL,
  `isPassager` BOOLEAN NOT NULL,
  `isChauffeur` BOOLEAN NOT NULL,
  `isPassagerChauffeur` BOOLEAN NOT NULL,
  `credits` INT NOT NULL,
  `date_credit` DATE NOT NULL,
  `debit` INT NOT NULL,
  `date_debit`DATE NOT NULL,
  `id_chauffeur` INT DEFAULT NULL,
  `id_passager` INT DEFAULT NULL,
  PRIMARY KEY (`id_utilisateurs`),
  KEY `id_chauffeur` (`id_chauffeur`),
  KEY `id_passager` (`id_passager`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `reserver_trajet` (
  `id_reserver_trajet` int(11) NOT NULL AUTO_INCREMENT,
  `num_trajet_reserve` INT NOT NULL,
  `date_arrivee` DATE NOT NULL,
  `date_depart` DATE NOT NULL,
  `heure_depart` TIME NOT NULL,
  `heure_arrivee` TIME NOT NULL,
  `ville_depart` VARCHAR (150) NOT NULL,
  `ville_arrivee` VARCHAR (150) NOT NULL,
  `etat_validation` ENUM('en_attente','valide','refuse') DEFAULT 'en_attente',
  PRIMARY KEY (`id_reserver_trajet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `reserver_trajet` (`num_trajet_reserve`,`date_arrivee`, `date_depart`, `heure_depart`, `heure_arrivee`, `ville_depart`, `ville_arrivee`, `etat_validation`) VALUES
(1001, '2025-07-11','2025-07-11', '08:00:00','09:30:00', 'Lille','Arras', 'valide'),
(1002, '2025-07-12','2025-07-12', '10:15:00','11:45:00', 'Amiens','Douai', 'valide'),
(1003, '2025-07-13','2025-07-13', '07:30:00','09:00:00', 'Valenciennes','Calais', 'valide'),
(1004, '2025-07-14','2025-07-14', '09:00:00','10:30:00', 'Roubaix','Lens', 'valide'),
(1005, '2025-07-15','2025-07-15', '08:45:00','10:00:00', 'Dunkerque','Boulogne-sur-Mer', 'valide'),
(9991, '2025-07-16','2025-07-16', '09:00:00','10:30:00', 'Lille','Saint-Amand-les-Eaux', 'en_attente'),
(9992, '2025-07-17','2025-07-17', '08:00:00','09:20:00', 'Compiègne','Beauvais', 'en_attente'),
(9993, '2025-07-18','2025-07-18', '07:50:00','09:10:00', 'Cambrai','Maubeuge', 'en_attente'),
(8881, '2025-07-19','2025-07-19', '10:00:00','11:30:00', 'Soissons','Paris', 'refuse'),
(8882, '2025-07-20','2025-07-20', '11:00:00','12:30:00', 'Lille','Charleville-Mézières', 'refuse');

CREATE TABLE IF NOT EXISTS `propose_trajet_passagers` (
  `id_propose_trajet_passagers` int(11) NOT NULL AUTO_INCREMENT,
  `date_depart` DATE NOT NULL,
  `date_arrivee` DATE NOT NULL,
  `heure_depart` TIME NOT NULL,
  `heure_arrivee` TIME NOT NULL,
  `ville_depart` VARCHAR (150) NOT NULL,
  `ville_arrivee` VARCHAR (150) NOT NULL,
  `nombre_passagers` INT NOT NULL,
  `fumeur` BOOLEAN NOT NULL,
  `animal` BOOLEAN NOT NULL,
  PRIMARY KEY (`id_propose_trajet_passagers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `propose_trajet_passagers` (`date_depart`,`date_arrivee`, `heure_depart`, `heure_arrivee`, `ville_depart`, `ville_arrivee`, `nombre_passagers`, `fumeur`, `animal`) VALUES
('2025-07-19', '2025-07-19', '10:00:00', '11:30:00', 'Soissons', 'Paris', 3, FALSE,  TRUE),
('2025-07-20', '2025-07-20', '11:00:00', '12:30:00', 'Lille', 'Charleville-Mézières', 2, TRUE, FALSE),
('2025-07-16', '2025-07-16', '09:00:00', '10:30:00', 'Lille', 'Saint-Amand-les-Eaux', 2, FALSE, FALSE),
('2025-07-17', '2025-07-17', '08:00:00', '09:20:00', 'Compiègne', 'Beauvais', 1, TRUE, FALSE),
('2025-07-18', '2025-07-18', '07:50:00', '09:10:00', 'Cambrai', 'Maubeuge', 3, FALSE, TRUE),
('2025-07-21', '2025-07-21', '09:30:00', '10:45:00', 'Saint-Quentin', 'Abbeville', 2, FALSE, FALSE),
('2025-07-22', '2025-07-22', '08:00:00', '09:15:00', 'Hazebrouck',' Berck', 1, TRUE, TRUE),
('2025-07-23', '2025-07-23', '10:00:00', '11:30:00', 'Montreuil-sur-Mer', 'Albert', 2, FALSE, FALSE),
('2025-07-24', '2025-07-24', '07:45:00', '09:00:00', 'Liévin', 'Le Touquet', 3, TRUE, FALSE),
('2025-07-25', '2025-07-25', '09:00:00', '10:30:00', 'Saint-Omer', 'Laon', 2, FALSE, TRUE );

CREATE TABLE IF NOT EXISTS `trajets_effectues` (
  `id_trajets_effectues` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo_chauffeur` VARCHAR (50) NOT NULL,
  `email_chauffeur` VARCHAR (150) NOT NULL,
  `note_chauffeur` FLOAT NOT NULL,
  `date_note_chauffeur` DATETIME NOT NULL,
  `avis_trajet_passagers` VARCHAR (250) NOT NULL,
  `date_avis_trajet_passagers` DATETIME NOT NULL,
  `prix_personne` INT NOT NULL,
  `voyage_ecologique` BOOLEAN NOT NULL,
  `date_trajet` DATETIME NOT NULL,
  `ville_depart` VARCHAR (150) NOT NULL,
  `ville_arrivee` VARCHAR (150) NOT NULL,
  `total_trajet` FLOAT NOT NULL,
  PRIMARY KEY (`id_trajets_effectues`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `trajets_effectues` (`pseudo_chauffeur`,`email_chauffeur`, `note_chauffeur`, `date_note_chauffeur`, `avis_trajet_passagers`, `date_avis_trajet_passagers`, `prix_personne`, `voyage_ecologique`, `date_trajet`, `ville_depart`, `ville_arrivee`, `total_trajet`) VALUES
('ChauffeurLille1', 'lille1@mail.com', 4.5, '2025-07-05 12:30:00', 'Très ponctuel et agréable', '2025-07-05 13:00:00', 10, TRUE, '2025-07-05 08:00:00', 'Lille', 'Arras', 30.0),
('DouaiDriver', 'douai@mail.com', 4.8, '2025-07-06 15:00:00', 'Conduite sécurisée et très sympa', '2025-07-06 16:00:00', 12, TRUE, '2025-07-06 09:00:00', 'Douai', 'Amiens', 36.0),
('ValChauffeur', 'valenciennes@mail.com', 4.2, '2025-07-07 10:15:00', 'Un peu de retard mais tout s’est bien passé.', '2025-07-07 10:45:00', 11, FALSE, '2025-07-07 07:30:00', 'Valenciennes', 'Calais', 33.0),
('RoubaixPro', 'roubaix@mail.com', 4.9, '2025-07-08 11:00:00', 'Super trajet, bonne humeur garantie !', '2025-07-08 11:30:00', 13, TRUE, '2025-07-08 09:00:00', 'Roubaix', 'Lens', 39.0),
('DunkerqueX', 'dunkerque@mail.com', 4.0, '2025-07-09 14:00:00', 'Bon trajet mais voiture un peu bruyante.', '2025-07-09 14:30:00', 9, FALSE, '2025-07-09 10:00:00', 'Dunkerque', 'Boulogne-sur-Mer', 27.0),
('StQuentinTop', 'saintq@mail.com', 4.6, '2025-07-10 12:00:00', 'Ponctuel et aimable.', '2025-07-10 12:30:00', 10, TRUE, '2025-07-10 08:30:00', 'Saint-Quentin', 'Abbeville', 30.0), 
('HazebrouckGo', 'hazebrouck@mail.com', 4.7, '2025-07-11 16:00:00', 'Excellent voyage et très bon échange.', '2025-07-11 16:30:00', 11, TRUE, '2025-07-11 09:00:00', 'Hazebrouck', 'Berck', 33.0),
('AlbertRide', 'albert@mail.com', 4.3, '2025-07-12 13:00:00', 'Voiture propre et confortable.', '2025-07-12 13:30:00', 10, TRUE, '2025-07-12 10:00:00', 'Montreuil-sur-Mer', 'Albert', 30.0),
('LievinMove', 'lievin@mail.com', 4.6, '2025-07-13 15:30:00', 'Rien à redire, parfait !', '2025-07-13 16:00:00', 12, TRUE, '2025-07-13 07:45:00', 'Liévin', 'Le Touquet', 36.0),
('OmerLaon', 'omerlaon@mail.com', 4.1, '2025-07-14 17:00:00', 'Bien mais aurait pu rouler moins vite.', '2025-07-14 17:30:00', 10, FALSE, '2025-07-14 09:30:00', 'Saint-Omer', 'Laon', 30.0);

CREATE TABLE IF NOT EXISTS `propose_trajet_chauffeurs` (
  `num_trajet` int(11) NOT NULL AUTO_INCREMENT,
  `date_arrivee` DATE NOT NULL,
  `date_depart` DATE NOT NULL,
  `heure_depart` TIME NOT NULL,
  `heure_arrivee` TIME NOT NULL,
  `ville_depart` VARCHAR (150) NOT NULL,
  `ville_arrivee` VARCHAR (150) NOT NULL,
  `pseudo_chauffeur` VARCHAR (150) NOT NULL,
  `marque` VARCHAR (150) NOT NULL,
  `modele` VARCHAR (150) NOT NULL,
  `nbr_place_restantes` INT NOT NULL,
  `nbr_place_trajet` INT NOT NULL,
  `prix_personne` INT NOT NULL,
  `temps_trajets` FLOAT NOT NULL,
  `information_sup` TEXT NOT NULL,
  PRIMARY KEY (`num_trajet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `propose_trajet_chauffeurs` (
  `date_arrivee`, `date_depart`,
  `ville_depart`, `ville_arrivee`,
  `pseudo_chauffeur`, `marque`, `modele`,
  `nbr_place_restantes`, `nbr_place_trajet`,
  `prix_personne`, `temps_trajets`, `information_sup`,
  `voyage_ecologique`
) VALUES
('2025-07-15 09:30:00', '2025-07-15 08:00:00', 'Lille', 'Arras', 'LilleExpress', 'Peugeot', '308', 2, 3, 10, 1.5, 'Trajet matinal sans arrêt, pas d’animaux.', TRUE),
('2025-07-16 12:00:00', '2025-07-16 10:00:00', 'Amiens', 'Calais', 'ChauffAmiens', 'Renault', 'Clio', 1, 2, 12, 2.0, 'Pause café prévue à mi-parcours.', FALSE),
('2025-07-17 09:00:00', '2025-07-17 07:30:00', 'Valenciennes', 'Lens', 'ValDriver', 'Citroën', 'C4', 3, 4, 9, 1.5, 'Conducteur non-fumeur, petit bagage autorisé.', TRUE),
('2025-07-18 10:45:00', '2025-07-18 09:15:00', 'Douai', 'Abbeville', 'DoudouDriver', 'Dacia', 'Sandero', 2, 3, 11, 1.5, 'Siège enfant disponible.', FALSE),
('2025-07-19 11:15:00', '2025-07-19 08:45:00', 'Dunkerque', 'Beauvais', 'DKExpress', 'Volkswagen', 'Golf', 1, 2, 14, 2.5, 'Voiture climatisée, pas de musique forte.', TRUE),
('2025-07-20 09:00:00', '2025-07-20 07:00:00', 'Boulogne-sur-Mer', 'Cambrai', 'BoulogneRide', 'Ford', 'Focus', 2, 4, 13, 2.0, 'Départ ponctuel, animaux non admis.', FALSE),
('2025-07-21 08:00:00', '2025-07-21 06:30:00', 'Saint-Omer', 'Laon', 'OmerDriver', 'Opel', 'Corsa', 1, 3, 10, 1.5, 'Conducteur flexible sur le point de RDV.', TRUE),
('2025-07-22 13:00:00', '2025-07-22 10:30:00', 'Maubeuge', 'Berck', 'MaubTrip', 'Toyota', 'Yaris', 3, 4, 15, 2.5, 'Musique douce en voiture, pas d’arrêt prévu.', TRUE),
('2025-07-23 10:30:00', '2025-07-23 09:00:00', 'Compiègne', 'Montreuil-sur-Mer', 'CompCar', 'Hyundai', 'i20', 1, 2, 12, 1.5, 'Bagages en soute uniquement.', FALSE),
('2025-07-24 10:50:00', '2025-07-24 08:20:00', 'Soissons', 'Hazebrouck', 'SoissGo', 'Fiat', 'Panda', 2, 3, 11, 2.5, 'Chien accepté si calme.', TRUE);

DESCRIBE propose_trajet_chauffeurs;

CREATE TABLE IF NOT EXISTS `trajets` (
  `id_trajets` int(11) NOT NULL AUTO_INCREMENT,
  `date_arrivee` DATE NOT NULL,
  `date_depart` DATE NOT NULL,
  `heure_depart` TIME NOT NULL,
  `heure_arrivee` TIME NOT NULL,
  `ville_depart` VARCHAR(255) NOT NULL,
  `ville_arrivee` VARCHAR(255) NOT NULL,
  `id_trajets_effectues` INT DEFAULT NULL,
  `num_trajet` INT DEFAULT NULL,
  PRIMARY KEY (`id_trajets`),
  KEY `id_trajets_effectues` (`id_trajets_effectues`),
  KEY `num_trajet` (`num_trajet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `trajets` (
  `ville_depart`, `ville_arrivee`, `prix_personne`, `pseudo_chauffeur`,
  `voyage_ecologique`, `date_trajet`, `id_trajets_effectues`, `num_trajet`
) VALUES
('Lille', 'Arras', 10.00, 'LilleExpress', TRUE, '2025-07-05', 1, NULL),
('Douai', 'Amiens', 11.00, 'DouaiDriver', FALSE, '2025-07-06', 2, NULL),
('Valenciennes', 'Calais', 12.00, 'ValChauff', TRUE, '2025-07-07', 3, NULL),
('Roubaix', 'Lens', 9.50, 'RoubaixGo', FALSE, '2025-07-08', 4, NULL),
('Lille', 'Arras', 10.00, 'LilleExpress', TRUE, '2025-07-15', NULL, 1),
('Amiens', 'Calais', 12.00, 'ChauffAmiens', TRUE, '2025-07-16', NULL, 2),
('Valenciennes', 'Lens', 9.00, 'ValDriver', FALSE, '2025-07-17', NULL, 3),
('Douai', 'Abbeville', 11.00, 'DoudouDriver', TRUE, '2025-07-18', NULL, 4),
('Dunkerque', 'Beauvais', 13.00, 'DKExpress', FALSE, '2025-07-19', NULL, 5),
('Boulogne-sur-Mer', 'Cambrai', 12.50, 'BoulogneRide', TRUE, '2025-07-20', NULL, 6);

CREATE TABLE IF NOT EXISTS `villes` (
  `id_villes` int(11) NOT NULL AUTO_INCREMENT,
  `nom_ville` VARCHAR (250) NOT NULL,
  PRIMARY KEY (`id_villes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `villes` (`nom_ville`) VALUES
('Lille'),
('Amiens'),
('Dunkerque'),
('Calais'),
('Arras'),
('Boulogne-sur-Mer'),
('Saint-Quentin'),
('Valenciennes'),
('Roubaix'),
('Tourcoing'),
('Lens'),
('Douai'),
('Cambrai'),
('Abbeville'),
('Maubeuge');

CREATE TABLE IF NOT EXISTS `aller` (
  `id_aller` int(11) NOT NULL AUTO_INCREMENT,
  `ville_aller` varchar(150) NOT NULL,
  `id_villes` INT DEFAULT NULL,
  PRIMARY KEY (`id_aller`),
  KEY `id_villes` (`id_villes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `aller` (`ville_aller`, `id_villes`) VALUES
('Lille', 1),
('Amiens', 2),
('Dunkerque', 3),
('Calais', 4),
('Arras', 5),
('Boulogne-sur-Mer', 6),
('Saint-Quentin', 7),
('Valenciennes', 8),
('Roubaix', 9),
('Tourcoing', 10),
('Lens', 11),
('Douai', 12),
('Cambrai', 13),
('Abbeville', 14),
('Maubeuge', 15);

CREATE TABLE IF NOT EXISTS `retour` (
  `id_retour` int(11) NOT NULL AUTO_INCREMENT,
  `ville_retour` varchar(150) NOT NULL,
  `id_villes` INT DEFAULT NULL,
  PRIMARY KEY (`id_retour`),
  KEY `id_villes` (`id_villes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `retour` (`ville_retour`, `id_villes`) VALUES
('Lille', 1),
('Amiens', 2),
('Dunkerque', 3),
('Calais', 4),
('Arras', 5),
('Boulogne-sur-Mer', 6),
('Saint-Quentin', 7),
('Valenciennes', 8),
('Roubaix', 9),
('Tourcoing', 10),
('Lens', 11),
('Douai', 12),
('Cambrai', 13),
('Abbeville', 14),
('Maubeuge', 15);

INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (37, '0:44:00', 1, 2);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (69, '1:22:00', 1, 3);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (120, '2:24:00', 1, 4);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (116, '2:19:00', 1, 5);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (100, '2:00:00', 1, 6);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (58, '1:09:00', 1, 7);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (37, '0:44:00', 1, 8);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (35, '0:42:00', 1, 9);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (104, '2:04:00', 1, 10);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (66, '1:19:00', 1, 11);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (91, '1:49:00', 1, 12);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (89, '1:46:00', 1, 13);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (107, '2:08:00', 1, 14);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (99, '1:58:00', 1, 15);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (40, '0:48:00', 2, 1);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (56, '1:07:00', 2, 3);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (118, '2:21:00', 2, 4);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (35, '0:42:00', 2, 5);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (103, '2:03:00', 2, 6);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (32, '0:38:00', 2, 7);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (138, '2:45:00', 2, 8);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (70, '1:24:00', 2, 9);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (159, '3:10:00', 2, 10);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (72, '1:26:00', 2, 11);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (154, '3:04:00', 2, 12);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (49, '0:58:00', 2, 13);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (94, '1:52:00', 2, 14);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (115, '2:18:00', 2, 15);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (131, '2:37:00', 3, 1);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (143, '2:51:00', 3, 2);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (106, '2:07:00', 3, 4);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (31, '0:37:00', 3, 5);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (101, '2:01:00', 3, 6);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (132, '2:38:00', 3, 7);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (152, '3:02:00', 3, 8);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (110, '2:12:00', 3, 9);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (62, '1:14:00', 3, 10);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (132, '2:38:00', 3, 11);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (49, '0:58:00', 3, 12);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (157, '3:08:00', 3, 13);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (77, '1:32:00', 3, 14);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (46, '0:55:00', 3, 15);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (62, '1:14:00', 4, 1);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (56, '1:07:00', 4, 2);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (48, '0:57:00', 4, 3);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (94, '1:52:00', 4, 5);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (108, '2:09:00', 4, 6);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (101, '2:01:00', 4, 7);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (78, '1:33:00', 4, 8);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (112, '2:14:00', 4, 9);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (86, '1:43:00', 4, 10);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (158, '3:09:00', 4, 11);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (151, '3:01:00', 4, 12);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (93, '1:51:00', 4, 13);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (56, '1:07:00', 4, 14);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (74, '1:28:00', 4, 15);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (66, '1:19:00', 5, 1);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (55, '1:06:00', 5, 2);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (70, '1:24:00', 5, 3);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (131, '2:37:00', 5, 4);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (126, '2:31:00', 5, 6);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (138, '2:45:00', 5, 7);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (126, '2:31:00', 5, 8);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (60, '1:12:00', 5, 9);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (106, '2:07:00', 5, 10);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (52, '1:02:00', 5, 11);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (75, '1:30:00', 5, 12);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (88, '1:45:00', 5, 13);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (84, '1:40:00', 5, 14);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (39, '0:46:00', 5, 15);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (38, '0:45:00', 6, 1);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (152, '3:02:00', 6, 2);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (78, '1:33:00', 6, 3);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (53, '1:03:00', 6, 4);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (155, '3:06:00', 6, 5);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (157, '3:08:00', 6, 7);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (96, '1:55:00', 6, 8);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (92, '1:50:00', 6, 9);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (155, '3:06:00', 6, 10);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (35, '0:42:00', 6, 11);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (105, '2:06:00', 6, 12);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (76, '1:31:00', 6, 13);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (107, '2:08:00', 6, 14);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (110, '2:12:00', 6, 15);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (64, '1:16:00', 7, 1);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (125, '2:30:00', 7, 2);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (69, '1:22:00', 7, 3);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (54, '1:04:00', 7, 4);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (66, '1:19:00', 7, 5);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (77, '1:32:00', 7, 6);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (54, '1:04:00', 7, 8);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (46, '0:55:00', 7, 9);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (151, '3:01:00', 7, 10);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (136, '2:43:00', 7, 11);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (118, '2:21:00', 7, 12);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (50, '1:00:00', 7, 13);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (45, '0:54:00', 7, 14);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (53, '1:03:00', 7, 15);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (31, '0:37:00', 8, 1);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (155, '3:06:00', 8, 2);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (75, '1:30:00', 8, 3);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (140, '2:48:00', 8, 4);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (121, '2:25:00', 8, 5);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (145, '2:54:00', 8, 6);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (60, '1:12:00', 8, 7);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (117, '2:20:00', 8, 9);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (76, '1:31:00', 8, 10);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (46, '0:55:00', 8, 11);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (117, '2:20:00', 8, 12);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (35, '0:42:00', 8, 13);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (147, '2:56:00', 8, 14);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (132, '2:38:00', 8, 15);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (46, '0:55:00', 9, 1);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (121, '2:25:00', 9, 2);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (42, '0:50:00', 9, 3);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (66, '1:19:00', 9, 4);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (156, '3:07:00', 9, 5);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (160, '3:12:00', 9, 6);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (129, '2:34:00', 9, 7);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (101, '2:01:00', 9, 8);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (44, '0:52:00', 9, 10);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (40, '0:48:00', 9, 11);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (135, '2:42:00', 9, 12);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (93, '1:51:00', 9, 13);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (123, '2:27:00', 9, 14);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (132, '2:38:00', 9, 15);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (58, '1:09:00', 10, 1);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (104, '2:04:00', 10, 2);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (69, '1:22:00', 10, 3);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (36, '0:43:00', 10, 4);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (32, '0:38:00', 10, 5);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (76, '1:31:00', 10, 6);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (134, '2:40:00', 10, 7);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (61, '1:13:00', 10, 8);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (88, '1:45:00', 10, 9);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (146, '2:55:00', 10, 11);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (147, '2:56:00', 10, 12);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (94, '1:52:00', 10, 13);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (155, '3:06:00', 10, 14);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (128, '2:33:00', 10, 15);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (69, '1:22:00', 11, 1);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (60, '1:12:00', 11, 2);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (56, '1:07:00', 11, 3);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (104, '2:04:00', 11, 4);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (101, '2:01:00', 11, 5);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (135, '2:42:00', 11, 6);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (108, '2:09:00', 11, 7);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (41, '0:49:00', 11, 8);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (150, '3:00:00', 11, 9);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (106, '2:07:00', 11, 10);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (142, '2:50:00', 11, 12);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (145, '2:54:00', 11, 13);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (63, '1:15:00', 11, 14);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (65, '1:18:00', 11, 15);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (145, '2:54:00', 12, 1);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (38, '0:45:00', 12, 2);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (95, '1:54:00', 12, 3);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (157, '3:08:00', 12, 4);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (77, '1:32:00', 12, 5);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (100, '2:00:00', 12, 6);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (98, '1:57:00', 12, 7);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (99, '1:58:00', 12, 8);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (100, '2:00:00', 12, 9);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (106, '2:07:00', 12, 10);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (120, '2:24:00', 12, 11);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (107, '2:08:00', 12, 13);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (103, '2:03:00', 12, 14);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (145, '2:54:00', 12, 15);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (112, '2:14:00', 13, 1);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (148, '2:57:00', 13, 2);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (122, '2:26:00', 13, 3);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (49, '0:58:00', 13, 4);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (44, '0:52:00', 13, 5);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (142, '2:50:00', 13, 6);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (127, '2:32:00', 13, 7);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (105, '2:06:00', 13, 8);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (91, '1:49:00', 13, 9);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (76, '1:31:00', 13, 10);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (142, '2:50:00', 13, 11);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (93, '1:51:00', 13, 12);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (79, '1:34:00', 13, 14);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (53, '1:03:00', 13, 15);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (40, '0:48:00', 14, 1);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (58, '1:09:00', 14, 2);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (43, '0:51:00', 14, 3);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (112, '2:14:00', 14, 4);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (126, '2:31:00', 14, 5);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (34, '0:40:00', 14, 6);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (78, '1:33:00', 14, 7);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (95, '1:54:00', 14, 8);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (141, '2:49:00', 14, 9);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (87, '1:44:00', 14, 10);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (155, '3:06:00', 14, 11);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (143, '2:51:00', 14, 12);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (106, '2:07:00', 14, 13);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (66, '1:19:00', 14, 15);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (94, '1:52:00', 15, 1);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (155, '3:06:00', 15, 2);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (153, '3:03:00', 15, 3);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (150, '3:00:00', 15, 4);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (47, '0:56:00', 15, 5);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (56, '1:07:00', 15, 6);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (67, '1:20:00', 15, 7);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (132, '2:38:00', 15, 8);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (102, '2:02:00', 15, 9);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (78, '1:33:00', 15, 10);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (129, '2:34:00', 15, 11);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (97, '1:56:00', 15, 12);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (129, '2:34:00', 15, 13);
INSERT INTO `km` (`km`, `temps_trajet`, `id_aller`, `id_retour`) VALUES (44, '0:52:00', 15, 14);

SELECT * FROM chauffeurs

SELECT * FROM chauffeurs
WHERE moyenne_note_chauffeur >= 3

SELECT * FROM chauffeurs
WHERE moyenne_note_chauffeur <= 4

SELECT * FROM trajets_effectues;

SELECT * FROM trajets_effectues
WHERE note_chauffeur <= 4.5

SELECT * FROM trajets_effectues
WHERE note_chauffeur >= 4.5

SELECT * FROM chauffeurs;

SELECT * FROM chauffeurs
WHERE animal = 1;

SELECT * FROM chauffeurs
WHERE animal = 0;

SELECT * FROM chauffeurs
WHERE fumeur = 0;

SELECT * FROM chauffeurs
WHERE fumeur = 1;

SELECT * FROM chauffeurs
WHERE marque = 'Tesla'

SELECT * FROM chauffeurs
WHERE preferences

SELECT * FROM utilisateurs;

INSERT INTO `utilisateurs` (
  `nom`, `prenom`, `pseudo`, `email`, `mot_de_passe`,
  `date_naissance`, `telephone`, `photo_profil`,
  `isAdmin`, `isEmploye`, `isPassager`, `isChauffeur`, `isPassagerChauffeur`,
  `credits`, `date_credit`, `debit`, `date_debit`,
  `id_chauffeur`, `id_passager`
)
VALUES
('Dupont', 'Jean', 'jdupont', 'jean.dupont@mail.com', 'pwd12345', '1985-04-12', 0612345678, NULL, FALSE, FALSE, TRUE, FALSE, FALSE, 100, '2025-07-01', 20, '2025-07-02', NULL, 1),
('Martin', 'Claire', 'cmartin', 'claire.martin@mail.com', 'securepwd', '1990-07-21', 0623456789, NULL, FALSE, FALSE, TRUE, TRUE, TRUE, 120, '2025-06-28', 10, '2025-07-01', 1, 2),
('Bernard', 'Luc', 'lbernard', 'luc.bernard@mail.com', 'azerty123', '1995-09-15', 0634567890, NULL, FALSE, FALSE, TRUE, FALSE, FALSE, 80, '2025-06-15', 5, '2025-06-20', NULL, 3),
('Petit', 'Sophie', 'spetit', 'sophie.petit@mail.com', 'sophiepwd', '1987-02-18', 0645678901, NULL, FALSE, FALSE, FALSE, TRUE, FALSE, 90, '2025-07-03', 25, '2025-07-05', 2, NULL),
('Durand', 'Marc', 'mdurand', 'marc.durand@mail.com', 'pass2024', '1978-12-30', 0656789012, NULL, TRUE, TRUE, FALSE, FALSE, FALSE, 200, '2025-07-01', 50, '2025-07-01', NULL, NULL),
('Lemoine', 'Julie', 'jlemoine', 'julie.lemoine@mail.com', 'julie123', '1992-03-05', 0667890123, NULL, FALSE, FALSE, TRUE, FALSE, FALSE, 60, '2025-06-10', 10, '2025-06-15', NULL, 4),
('Moreau', 'Antoine', 'amoreau', 'antoine.moreau@mail.com', 'antpass', '1989-08-09', 0678901234, NULL, FALSE, FALSE, TRUE, TRUE, TRUE, 150, '2025-07-02', 20, '2025-07-02', 3, 5),
('Garcia', 'Laura', 'lgarcia', 'laura.garcia@mail.com', 'laurapwd', '1994-11-25', 0689012345, NULL, FALSE, FALSE, TRUE, FALSE, FALSE, 70, '2025-07-01', 15, '2025-07-03', NULL, 6),
('Fournier', 'Nicolas', 'nfournier', 'nicolas.fournier@mail.com', 'fournier123', '1986-10-10', 0690123456, NULL, FALSE, TRUE, FALSE, FALSE, FALSE, 50, '2025-07-01', 0, '2025-07-01', NULL, NULL),
('Lopez', 'Emma', 'elopez', 'emma.lopez@mail.com', 'emmapass', '1993-06-30', 0611122233, NULL, FALSE, FALSE, TRUE, FALSE, FALSE, 85, '2025-06-30', 5, '2025-07-01', NULL, 7),
('Giraud', 'Lucas', 'lgiraud', 'lucas.giraud@mail.com', 'lucaspwd', '1991-05-16', 0622233344, NULL, FALSE, FALSE, FALSE, TRUE, FALSE, 100, '2025-06-20', 20, '2025-06-25', 4, NULL),
('Roux', 'Camille', 'croux', 'camille.roux@mail.com', 'crouxpass', '1996-09-14', 0633344455, NULL, FALSE, FALSE, TRUE, TRUE, TRUE, 130, '2025-06-28', 30, '2025-07-01', 5, 8),
('Fontaine', 'Hugo', 'hfontaine', 'hugo.fontaine@mail.com', 'fontainepwd', '1988-01-11', 0644455566, NULL, FALSE, FALSE, TRUE, FALSE, FALSE, 95, '2025-07-02', 5, '2025-07-03', NULL, 9),
('Barbier', 'Léa', 'lbarbier', 'lea.barbier@mail.com', 'barbier123', '1990-04-07', 0655566677, NULL, FALSE, FALSE, FALSE, TRUE, FALSE, 70, '2025-07-01', 0, '2025-07-01', 6, NULL),
('Andre', 'Thomas', 'tandre', 'thomas.andre@mail.com', 'andrepwd', '1992-12-20', 0666677788, NULL, FALSE, FALSE, TRUE, FALSE, FALSE, 110, '2025-07-01', 20, '2025-07-01', NULL, 10),
('Meunier', 'Chloé', 'cmeunier', 'chloe.meunier@mail.com', 'chloepass', '1997-03-03', 0677788899, NULL, FALSE, TRUE, FALSE, FALSE, FALSE, 60, '2025-07-01', 0, '2025-07-01', NULL, NULL),
('Blanc', 'Axel', 'ablanc', 'axel.blanc@mail.com', 'blancpass', '1995-07-12', 0688899900, NULL, FALSE, FALSE, TRUE, TRUE, TRUE, 140, '2025-07-01', 25, '2025-07-02', 7, 11),
('Roy', 'Manon', 'mroy', 'manon.roy@mail.com', 'roy12345', '1998-06-01', 0699900011, NULL, FALSE, FALSE, TRUE, FALSE, FALSE, 90, '2025-07-02', 10, '2025-07-03', NULL, 12),
('Collet', 'Julien', 'jcollet', 'julien.collet@mail.com', 'jcolletpwd', '1984-11-29', 0612341234, NULL, TRUE, TRUE, FALSE, FALSE, FALSE, 200, '2025-06-30', 60, '2025-07-01', NULL, NULL),
('Paul', 'Lucie', 'lpaul', 'lucie.paul@mail.com', 'lpaulpass', '1983-02-17', 0623452345, NULL, FALSE, FALSE, TRUE, TRUE, TRUE, 160, '2025-07-01', 20, '2025-07-02', 8, 13);

SELECT * FROM utilisateurs
WHERE `isChauffeur` = 1;

SELECT * FROM utilisateurs
WHERE `isPassager` = 1;

SELECT * FROM utilisateurs
WHERE `isPassagerChauffeur` = 1;

SELECT * FROM utilisateurs
WHERE `isAdmin`= 1;

SELECT * FROM utilisateurs
WHERE `isEmploye` =1;

SELECT * FROM utilisateurs
WHERE credits <= 50;

SELECT * FROM utilisateurs
WHERE debit <= 5;

SELECT * FROM utilisateurs;

SELECT * FROM utilisateurs
WHERE debit <= 0;

SELECT * FROM passagers;

SELECT utilisateurs.pseudo, utilisateurs.id_utilisateurs
FROM utilisateurs
JOIN passagers ON utilisateurs.id_passager = passagers.id_passagers;

SELECT utilisateurs.pseudo, utilisateurs.id_utilisateurs
FROM utilisateurs
JOIN chauffeurs ON utilisateurs.id_chauffeur = chauffeurs.id_chauffeurs;

SELECT pseudo 
FROM utilisateurs
WHERE `isPassagerChauffeur`;

SELECT * FROM propose_trajet_chauffeurs;

UPDATE propose_trajet_chauffeurs SET marque = 'tesla', modele = 'model 3' WHERE marque = 'peugeot' AND modele = '308';

SELECT * 
FROM propose_trajet_chauffeurs;

UPDATE propose_trajet_chauffeurs SET marque = 'Renault', modele = 'model Zoe E-Tech' WHERE marque = 'Renault' AND modele = 'Clio';

UPDATE propose_trajet_chauffeurs SET marque = 'Volkswagen', modele = 'model ID.4' WHERE marque = 'Citroen' AND modele = 'C4';

UPDATE propose_trajet_chauffeurs SET marque = 'BMW', modele = 'i4 eDrive40' WHERE marque = 'Dacia' AND modele = 'Sandero';

SELECT * FROM propose_trajet_chauffeurs;

UPDATE propose_trajet_chauffeurs 
SET voyage_ecologique = 1 
WHERE marque = 'BMW' AND modele = 'i4 eDrive40' AND voyage_ecologique = 0;

UPDATE propose_trajet_chauffeurs 
SET voyage_ecologique = 1 
WHERE marque = 'Volkswager' AND modele = 'model ID.4' AND voyage_ecologique = 0;

UPDATE propose_trajet_chauffeurs 
SET voyage_ecologique = 1 
WHERE marque = 'Renault' AND modele = 'model Zoe E-Tech' AND voyage_ecologique = 0;

UPDATE propose_trajet_chauffeurs 
SET voyage_ecologique = 1 
WHERE marque = 'tesla' AND modele = 'model 3' AND voyage_ecologique = 0;

UPDATE propose_trajet_chauffeurs 
SET voyage_ecologique = 1 
WHERE marque = 'Volkswagen' AND modele = 'model ID.4' AND voyage_ecologique = 0;

SELECT *
FROM propose_trajet_chauffeurs
WHERE voyage_ecologique = TRUE;

SELECT *
FROM propose_trajet_chauffeurs;

SELECT *
FROM propose_trajet_passagers;

/*select des trajets en commun de la table propose_trajet_passagers avec propose_trajet_chauffeurs et s'il n'y en a pas ça retourne rien. 
*/

DESCRIBE propose_trajet_chauffeurs;
SELECT 
  t.ville_depart AS ville_depart_trajet,
  p.ville_arrivee AS ville_arrivee_proposition
FROM trajets AS t
JOIN propose_trajet_chauffeurs AS p
  ON t.num_trajet = p.num_trajet;

-- s'il y en a retourne la date la plus proche

SELECT 
  t.num_trajet,
  t.ville_depart AS t_ville_depart,
  t.ville_arrivee AS t_ville_arrivee,
  p.ville_depart AS p_ville_depart,
  p.ville_arrivee AS p_ville_arrivee,
  p.date_depart
FROM trajets AS t
JOIN propose_trajet_chauffeurs AS p
  ON t.num_trajet = p.num_trajet
ORDER BY ABS(DATEDIFF(p.date_depart, CURDATE()))
LIMIT 1;

SELECT *
FROM propose_trajet_chauffeurs
WHERE prix_personne <= 10;

SELECT *
FROM propose_trajet_chauffeurs
WHERE prix_personne <= 15;

SELECT *
FROM trajets_effectues;

SELECT * 
FROM trajets_effectues
WHERE note_chauffeur <= 4.5;

SELECT * 
FROM trajets_effectues
WHERE note_chauffeur >= 4.5;

-- pour selectionner les preferences chauffeurs preferences de la table chauffeurs

SELECT *
FROM chauffeurs;

SELECT preferences
FROM chauffeurs ;

SELECT *
FROM trajets_effectues;

SELECT avis_trajet_passagers, pseudo_chauffeur
FROM trajets_effectues;

SELECT *
FROM passagers;

-- renome colonne
ALTER TABLE passagers
RENAME COLUMN credit_provisoire TO debit;

ALTER TABLE passagers
RENAME COLUMN date_credit_provisoire TO date_debit;

-- Pour voir le credit en cours d'un passager
-- Faire une fonction dans la requête pour id = id session

SELECT credit_restant, id_passagers
FROM passagers;

SELECT credit_en_cours, date_crédit_en_cours, id_passagers
FROM passagers
ORDER BY date_crédit_en_cours DESC;

-- pour selectionner le credit restant d'un utilisateur par dernières dates de date_trajet
SELECT credit_restant, date_trajet, id_passagers
FROM passagers
ORDER BY date_trajet DESC;

-- Trigger pour insérer les trajets de propose_trajets_chaffeurs dans la table trajets_effectues


SELECT DATABASE();

USE ecoride_haut_de_france;


DELIMITER $$
CREATE TRIGGER trajets_chauffeurs
AFTER INSERT ON propose_trajet_chauffeurs
FOR EACH ROW 
BEGIN 
  IF NEW.date_arrivee < CURDATE() THEN
    INSERT INTO trajets_effectues (
      ville_depart, 
      ville_arrivee, 
      prix_personne, 
      pseudo_chauffeur, 
      voyage_ecologique, 
      num_trajet,
      date_trajet
    ) 
    VALUES (
      NEW.ville_depart,
      NEW.ville_arrivee,
      NEW.prix_personne,
      NEW.pseudo_chauffeur,
      NEW.voyage_ecologique,
      NEW.num_trajet,
      NEW.date_depart
    );
  END IF;
END$$
DELIMITER ;

SHOW TRIGGERS FROM ecoride_haut_de_france;

DELETE FROM propose_trajet_chauffeurs;

UPDATE utilisateurs
SET `prenom` = 'Jose'
WHERE prenom = 'Marc' AND nom = 'Durand';

DELETE FROM utilisateurs
WHERE id_utilisateurs = 19;

SELECT * FROM trajets;

-- Je vais modifier la colonne num_trajet de la table proposeTrajetChauffeurs en INT NOT NULL AUTO INCREMENT
ALTER TABLE propose_trajet_chauffeurs
MODIFY COLUMN num_trajet INT NOT NULL AUTO_INCREMENT;

-- Je vais modifier les colonnes de ma table trajets pour avoir DATETIME  

ALTER TABLE trajets
DROP COLUMN heure_depart,
DROP COLUMN heure_arrivee,
MODIFY COLUMN date_arrivee DATETIME,
MODIFY COLUMN date_depart DATETIME;

DELETE FROM trajets;

ALTER TABLE trajets
DROP COLUMN date_arrivee,
DROP COLUMN date_depart,
DROP COLUMN ville_depart,
DROP COLUMN ville_arrivee;


-- Jointure de la table propose_trajet_chauffeurs et trajets_effectues sur table trajets
SELECT
t.num_trajet,
pc.pseudo_chauffeur,
vd.ville_depart AS ville_depart_effectuee
FROM trajets t
LEFT JOIN propose_trajet_chauffeurs pc ON t.num_trajet = pc.num_trajet
LEFT JOIN trajets_effectues vd ON t.id_trajets_effectues = vd.id_trajets_effectues;

/* J'efface les données pour la table trajets, trajets_effectues, propose_trajet_chauffeurs pour refaire l'auto increment pour les jointures*/

DELETE FROM trajets;
DELETE FROM trajets_effectues;
DELETE FROM propose_trajet_chauffeurs;

ALTER TABLE trajets AUTO_INCREMENT = 1;
ALTER TABLE trajets_effectues AUTO_INCREMENT = 1;
ALTER TABLE propose_trajet_chauffeurs AUTO_INCREMENT = 1;

-- J'efface ma table trajet et je la refait pour convenir à mes Triggers avec INSERT INTO
 DROP TABLE IF EXISTS trajets;

 CREATE TABLE IF NOT EXISTS `trajets` (
  `id_trajets` int(11) NOT NULL AUTO_INCREMENT,
  `ville_depart` VARCHAR (250) NOT NULL,
  `ville_arrivee` VARCHAR (250) NOT NULL,
  `prix_personne` VARCHAR (250) NOT NULL,
  `pseudo_chauffeur` VARCHAR (250) NOT NULL,
  `voyage_ecologique` VARCHAR (250) NOT NULL,
  `date_trajet` VARCHAR (250) NOT NULL,
  `num_trajet` INT DEFAULT NULL,
  `id_trajets_effectues` INT DEFAULT NULL,
  PRIMARY KEY (`id_trajets`),
  KEY `num_trajet` (`num_trajet`),
  KEY `id_trajets_effectues` (`id_trajets_effectues`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Triggers pour récupérer les nouveaux trajets dans la table trajets
DELIMITER $$
CREATE TRIGGER propose_trajet_chauffeurs
AFTER INSERT ON propose_trajet_chauffeurs
FOR EACH ROW 
BEGIN 
  IF NEW.num_trajet THEN
    INSERT INTO trajets (
      ville_depart, 
      ville_arrivee, 
      prix_personne, 
      pseudo_chauffeur, 
      voyage_ecologique, 
      num_trajet,
      date_trajet
    ) 
    VALUES (
      NEW.ville_depart,
      NEW.ville_arrivee,
      NEW.prix_personne,
      NEW.pseudo_chauffeur,
      NEW.voyage_ecologique,
      NEW.num_trajet,
      NEW.date_depart
    );
  END IF;
END$$
DELIMITER ;

DELIMITER $$

CREATE TRIGGER trajets_effectues_insert
AFTER INSERT ON trajets_effectues
FOR EACH ROW 
BEGIN 
  IF NEW.id_trajets_effectues IS NOT NULL THEN
    INSERT INTO trajets (
      ville_depart, 
      ville_arrivee, 
      prix_personne, 
      pseudo_chauffeur, 
      voyage_ecologique, 
      num_trajet,
      date_trajet
    ) 
    VALUES (
      NEW.ville_depart,
      NEW.ville_arrivee,
      NEW.prix_personne,
      NEW.pseudo_chauffeur,
      NEW.voyage_ecologique,
      NEW.id_trajets_effectues,
      NEW.date_trajet
    );
  END IF;
END$$

DELIMITER ;

SHOW CREATE TABLE propose_trajet_chauffeurs;

SHOW CREATE TABLE trajets_effectues;

INSERT INTO `propose_trajet_chauffeurs` (
  `date_arrivee`, `date_depart`,
  `ville_depart`, `ville_arrivee`,
  `pseudo_chauffeur`, `marque`, `modele`,
  `nbr_place_restantes`, `nbr_place_trajet`,
  `prix_personne`, `temps_trajets`, `information_sup`,
  `voyage_ecologique`
) VALUES
('2025-07-18 09:30:00', '2025-07-18 08:00:00', 'Lille', 'Paris', 'LilleDriver', 'Peugeot', '308', 2, 4, 15, 2.5, 'Climatisation, musique libre.', 1),
('2025-07-19 11:45:00', '2025-07-19 10:15:00', 'Amiens', 'Rouen', 'AmiensExpress', 'Renault', 'Clio', 1, 3, 12, 1.5, 'Pause café prévue.', 0),
('2025-07-20 17:00:00', '2025-07-20 15:30:00', 'Calais', 'Lille', 'CalaisGo', 'Citroën', 'C4', 0, 3, 10, 1.0, 'Pas de bagages encombrants.', 1),
('2025-07-21 14:00:00', '2025-07-21 12:30:00', 'Lens', 'Valenciennes', 'LensDriver', 'Dacia', 'Sandero', 3, 4, 8, 1.2, 'Siège bébé disponible.', 1);

INSERT INTO `trajets_effectues` (
  `pseudo_chauffeur`, `email_chauffeur`, `note_chauffeur`,
  `date_note_chauffeur`, `avis_trajet_passagers`, `date_avis_trajet_passagers`,
  `prix_personne`, `voyage_ecologique`, `date_trajet`,
  `ville_depart`, `ville_arrivee`, `total_trajet`
) VALUES
('ParisDriver', 'parisdriver@mail.com', 4.7, '2025-07-10 14:00:00', 'Très agréable et ponctuel', '2025-07-10 15:00:00', 15, 1, '2025-07-10 08:30:00', 'Paris', 'Lille', 60.0),
('RouenRide', 'rouenride@mail.com', 4.9, '2025-07-11 12:15:00', 'Super ambiance à bord !', '2025-07-11 13:00:00', 12, 1, '2025-07-11 09:00:00', 'Rouen', 'Amiens', 36.0),
('LensSpeed', 'lensspeed@mail.com', 4.5, '2025-07-12 17:30:00', 'Très bon trajet, chauffeur prudent.', '2025-07-12 18:00:00', 10, 0, '2025-07-12 15:00:00', 'Lens', 'Calais', 30.0),
('AmiensTop', 'amienstop@mail.com', 4.8, '2025-07-13 10:30:00', 'Service au top, merci !', '2025-07-13 11:00:00', 9, 1, '2025-07-13 07:30:00', 'Amiens', 'Abbeville', 27.0);

SHOW CREATE TABLE trajets;

INSERT INTO `trajets` (
  ville_depart, ville_arrivee, prix_personne, pseudo_chauffeur,
  voyage_ecologique, date_trajet, num_trajet
) VALUES
('Lille', 'Paris', '15', 'LilleDriver', '1', '2025-07-18 08:00:00', 1),
('Amiens', 'Rouen', '12', 'AmiensExpress', '0', '2025-07-19 10:15:00', 2),
('Calais', 'Lille', '10', 'CalaisGo', '1', '2025-07-20 15:30:00', 3),
('Lens', 'Valenciennes', '8', 'LensDriver', '1', '2025-07-21 12:30:00', 4);

INSERT INTO `trajets` (
  ville_depart, ville_arrivee, prix_personne, pseudo_chauffeur,
  voyage_ecologique, date_trajet, id_trajets_effectues
) VALUES
('Paris', 'Lille', '15', 'ParisDriver', '1', '2025-07-10 08:30:00', 1),
('Rouen', 'Amiens', '12', 'RouenRide', '1', '2025-07-11 09:00:00', 2),
('Lens', 'Calais', '10', 'LensSpeed', '0', '2025-07-12 15:00:00', 3),
('Amiens', 'Abbeville', '9', 'AmiensTop', '1', '2025-07-13 07:30:00', 4);

SELECT * FROM trajets;

-- Pour compter les num_trajet et id_trajets_effectues de la table trajets
SELECT 
  COUNT(num_trajet) AS trajets_proposes,
  COUNT(id_trajets_effectues) AS trajets_effectues
  FROM trajets;

-- Pour faire la somme des trajets
  SELECT 
  SUM(num_trajet) AS trajets_proposes,
  SUM(id_trajets_effectues) AS id_trajets_effectues
  FROM trajets;

  -- Pour faire la somme des trajets par jour
SELECT 
  DATE(date_trajet) AS jour,
  SUM(num_trajet) AS trajets_proposes,
  SUM(id_trajets_effectues) AS id_trajets_effectues
FROM trajets
GROUP BY DATE(date_trajet)
ORDER BY jour;

-- Jointure de la table utilisateurs avec passagers et chauffeurs

SELECT
ut.id_utilisateurs,
ut.nom,
ut.prenom,
ut.pseudo,
ut.email,
ut.mot_de_passe,
ut.date_naissance,
ut.telephone,
ut.photo_profil,
ut.isEmploye,
ut.isPassager,
ut.isChauffeur,
ut.isPassagerChauffeur
FROM utilisateurs ut
LEFT JOIN passagers pas ON ut.id_passager = pas.id_passagers
LEFT JOIN chauffeurs cha ON ut.id_chauffeur = cha.id_chauffeurs;

SELECT DATABASE();

USE ecoride_haut_de_france;

-- Jointures tables villes, aller, retour, km

SELECT
ki.id_km,
vi1.nom_ville AS ville_aller,
vi2.nom_ville AS ville_retour,
ki.km,
ki.temps_trajet
FROM km ki
LEFT JOIN Aller ia ON ki.id_km = ia.id_aller
LEFT JOIN Retour re ON ki.id_km = re.id_retour
LEFT JOIN Villes vi1 ON ia.id_villes = vi1.id_villes
LEFT JOIN Villes vi2 ON re.id_villes = vi2.id_villes;

SHOW TABLES FROM ecoride_haut_de_france;

-- Jointures tables villes, aller, retour, km avec les noms visibles

SELECT
va.ville_aller AS ville_depart,
vr.ville_retour AS ville_arrivee,
k.km,
k.temps_trajet
FROM km k
JOIN aller va ON k.id_aller = va.id_aller
JOIN retour vr ON k.id_retour = vr.id_retour
ORDER BY ville_depart, ville_arrivee;

SELECT DATABASE();

USE ecoride_haut_de_france;


DELIMITER $$

CREATE TRIGGER calcul_credit_restant
BEFORE INSERT ON passagers
FOR EACH ROW 
BEGIN 
  SET NEW.credit_restant = NEW.credit_en_cours - NEW.debit - 2;
END$$

DELIMITER ;

SELECT credit_restant, id_passagers
FROM passagers;

DELETE FROM utilisateurs
WHERE id_utilisateurs IN (5, 25, 39);