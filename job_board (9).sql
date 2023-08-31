-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 31 août 2023 à 03:23
-- Version du serveur : 5.7.31
-- Version de PHP : 8.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `job_board`
--

-- --------------------------------------------------------

--
-- Structure de la table `contrats`
--

DROP TABLE IF EXISTS `contrats`;
CREATE TABLE IF NOT EXISTS `contrats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contrats`
--

INSERT INTO `contrats` (`id`, `nom`) VALUES
(1, 'CDI'),
(2, 'CDD'),
(3, 'Stage'),
(4, 'Apprentissage'),
(5, 'Intérim'),
(6, 'Freelance');

-- --------------------------------------------------------

--
-- Structure de la table `metiers`
--

DROP TABLE IF EXISTS `metiers`;
CREATE TABLE IF NOT EXISTS `metiers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `metiers`
--

INSERT INTO `metiers` (`id`, `nom`) VALUES
(1, 'Développeur Web'),
(2, 'Designer Graphique'),
(3, 'Ingénieur Logiciel'),
(4, 'Analyste de Données'),
(5, 'Chef de Projet'),
(6, 'Comptable'),
(7, 'Infirmier'),
(8, 'Enseignant'),
(9, 'Avocat'),
(10, 'Electricien'),
(11, 'Plombier'),
(12, 'Cuisinier');

-- --------------------------------------------------------

--
-- Structure de la table `offres_emploi`
--

DROP TABLE IF EXISTS `offres_emploi`;
CREATE TABLE IF NOT EXISTS `offres_emploi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_publication` date NOT NULL,
  `date_mise_a_jour` date DEFAULT NULL,
  `reference` varchar(255) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `entreprise` varchar(100) NOT NULL,
  `ville_id` int(11) NOT NULL,
  `contrat_id` int(11) NOT NULL,
  `metier_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reference` (`reference`),
  KEY `fk_ville_id` (`ville_id`),
  KEY `fk_contrat_id` (`contrat_id`),
  KEY `fk_metier_id` (`metier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `offres_emploi`
--

INSERT INTO `offres_emploi` (`id`, `date_publication`, `date_mise_a_jour`, `reference`, `nom`, `description`, `entreprise`, `ville_id`, `contrat_id`, `metier_id`) VALUES
(29, '2023-07-30', '2023-08-30', 'REF_833BA', 'Développeur Web', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus', 'InnovativeTech', 6, 3, 1),
(30, '2023-07-15', '2023-08-30', 'REF_83C81', 'Designer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus', 'CreativeDesign', 1, 1, 2),
(31, '2023-07-01', '2023-08-30', 'REF_53756', 'Ingénieur Logiciel', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus', 'TechSolutions', 8, 4, 3),
(32, '2023-02-15', '2023-08-30', 'REF_551CE', 'Développeur Python', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus', 'DataAnalyticsCo', 3, 2, 1),
(33, '2023-03-20', '2023-08-30', 'REF_597D9', 'Chef de Projet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus', 'ProjectMasters', 4, 5, 5),
(34, '2023-04-25', '2023-08-30', 'REF_5A0C7', 'Comptable Sénior', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus', 'NumbersInc', 10, 1, 6),
(35, '2023-05-30', '2023-08-30', 'REF_5A800', 'Infirmier', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus', 'HealthCareServices', 2, 3, 7),
(36, '2023-06-15', '2023-08-30', 'REF_5ADA0', 'Enseignant', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus', 'EduTech', 11, 2, 8),
(37, '2023-07-20', '2023-08-30', 'REF_5B84A', 'Avocat', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus', 'LegalExperts', 9, 4, 9),
(38, '2023-08-25', '2023-08-30', 'REF_5DD94', 'Data Analyste', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus', 'SparkElectrics', 7, 6, 4),
(39, '2023-09-01', '2023-08-30', 'REF_5E56F', 'Plombier', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus', 'EVA', 12, 1, 11),
(40, '2023-10-05', '2023-08-30', 'REF_5EDA5', 'Infirmier', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus', 'CulinaryDelights', 5, 5, 7),
(41, '2023-11-10', '2023-08-30', 'REF_5F6EE', 'Electricien', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus', 'InnovativeTech', 6, 6, 10),
(42, '2023-01-11', '2023-08-30', 'REF_A65B1', 'Chef de projet junior', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus', 'TechSolutions', 8, 4, 5),
(43, '2023-03-20', '2023-08-30', 'REF_AA553', 'Analyste de Données', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus', 'DataAnalyticsCo', 3, 2, 4),
(44, '2023-01-25', '2023-08-30', 'REF_AAEF4', 'Lead développeur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus', 'ProjectMasters', 4, 5, 3),
(45, '2023-05-30', '2023-08-30', 'REF_AB5E0', 'Comptable Sénior', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus', 'NumbersInc', 10, 1, 6),
(46, '2023-06-15', '2023-08-30', 'REF_ABE1D', 'Avocat', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus', 'HealthCareServices', 2, 3, 9),
(47, '2023-07-20', '2023-08-30', 'REF_AC5A4', 'infirmier', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus', 'EduTech', 11, 2, 7),
(48, '2023-08-25', '2023-08-30', 'REF_ACED4', 'Avocat', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus', 'PipeMasters', 9, 6, 9),
(49, '2023-09-01', '2023-08-30', 'REF_AF407', 'Electricien', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus', 'SparkElectrics', 7, 6, 10),
(50, '2023-10-05', '2023-08-30', 'REF_AF9EF', 'Plombier', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus', 'PipeMasters', 12, 1, 11),
(51, '2023-11-10', '2023-08-30', 'REF_B013A', 'Cuisinier', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus', 'CulinaryDelights', 5, 5, 12),
(52, '2023-01-15', NULL, 'REF_35269', 'Développeur Web #C', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'TF1', 1, 1, 1),
(53, '2023-02-10', NULL, 'REF_3728E', 'Designer ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'La main', 2, 2, 2),
(54, '2023-03-20', NULL, 'REF_37D20', 'Ingénieur Logiciel', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'CodeMasters', 3, 3, 3),
(55, '2023-04-30', NULL, 'REF_3837B', 'Analyste de Données', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'NASA', 4, 4, 4),
(56, '2023-05-15', NULL, 'REF_392F8', 'Chef de Projet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'IKEA', 5, 5, 5),
(57, '2023-06-20', NULL, 'REF_3984A', 'Comptable', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'BANQUE DE FRANCE', 6, 6, 6),
(59, '2023-01-02', NULL, 'REF_F34A1', 'Développeur front', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'M6', 1, 1, 1),
(60, '2023-02-10', NULL, 'REF_F3E84', 'UI designer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'TheHand', 2, 2, 2),
(61, '2023-03-20', NULL, 'REF_002E6', 'Ingénieur Logiciel', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'W3school', 3, 3, 3),
(62, '2023-04-30', NULL, 'REF_00DED', 'Analyste de Données', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'Airbus', 7, 1, 4),
(63, '2023-05-15', NULL, 'REF_011B9', 'Chef de Projet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'Conforama', 5, 1, 5),
(64, '2023-06-20', NULL, 'REF_01818', 'Comptable', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'Boursorama', 6, 1, 6),
(65, '2023-07-05', NULL, 'REF_01D5D', 'Infirmier', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'Pharmacie de beauvais', 7, 6, 7),
(66, '2023-01-15', NULL, 'REF_0F0F0', 'Développeur Web Junior', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'WebTech Solutions', 1, 1, 1),
(67, '2023-02-20', NULL, 'REF_181C2', 'Designer Graphique Senior', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'DesignWorks Inc.', 2, 2, 2),
(68, '2023-03-25', NULL, 'REF_18DE6', 'Ingénieur Logiciel Senior', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'SoftSolutions Ltd.', 3, 3, 3),
(69, '2023-04-30', NULL, 'REF_1941B', 'Analyste de Données Junior', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'DataInsights Corp.', 4, 4, 4),
(70, '2023-05-15', NULL, 'REF_04364', 'Chef de Projet Expérimenté', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'ProjectMasters International', 5, 5, 5),
(71, '2023-06-20', NULL, 'REF_05849', 'Comptable Sénior', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'FinAccel Corp.', 6, 6, 6),
(72, '2023-07-25', NULL, 'REF_0956F', 'Infirmier en Soins Intensifs', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'HealthCare Plus', 7, 1, 7),
(73, '2023-08-30', NULL, 'REF_09B10', 'Enseignant en Éducation Primaire', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'EduMasters Academy', 8, 2, 8),
(74, '2023-09-15', NULL, 'REF_0A1FA', 'Avocat en Droit des Affaires', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'LegalEagle Associates', 9, 3, 9),
(75, '2023-10-20', NULL, 'REF_0A87C', 'Électricien Certifié', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'PowerTech Solutions', 10, 4, 10),
(76, '2023-11-25', NULL, 'REF_0ADC5', 'Plombier Qualifié', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'PipeMasters Inc.', 11, 5, 11),
(77, '2023-12-30', NULL, 'REF_0B21A', 'Cuisinier de Restaurant Étoilé', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac tortor vel sem scelerisque rutrum ac id leo. Pellentesque at lacinia erat. Mauris lobortis dapibus viverra. Integer non risus pellentesque ante blandit tempor nec ac turpis. Pellentesque eu erat eu velit sagittis cursus.', 'Gourmet Delights', 12, 6, 12);

-- --------------------------------------------------------

--
-- Structure de la table `villes`
--

DROP TABLE IF EXISTS `villes`;
CREATE TABLE IF NOT EXISTS `villes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `villes`
--

INSERT INTO `villes` (`id`, `nom`) VALUES
(1, 'Paris'),
(2, 'Marseille'),
(3, 'Lyon'),
(4, 'Toulouse'),
(5, 'Nice'),
(6, 'Nantes'),
(7, 'Strasbourg'),
(8, 'Montpellier'),
(9, 'Bordeaux'),
(10, 'Lille'),
(11, 'Rennes'),
(12, 'Reims');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `offres_emploi`
--
ALTER TABLE `offres_emploi`
  ADD CONSTRAINT `fk_contrat_id` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`),
  ADD CONSTRAINT `fk_metier_id` FOREIGN KEY (`metier_id`) REFERENCES `metiers` (`id`),
  ADD CONSTRAINT `fk_ville_id` FOREIGN KEY (`ville_id`) REFERENCES `villes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
