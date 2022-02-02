-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 07 juil. 2021 à 13:08
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `app_2`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `is_active`) VALUES
(1, 'AROUNA', 'sidibearouna71@gmail.com', '$2y$10$4DQdW4r.Zz0Ay5k7zanv1OAw.M2GlJbCDVQYLtSRkwIqLDtgizBXq', '0'),
(2, 'sidibe', 'arouna2058@gmail.com', '$2y$10$8P0U7WTsYFHXOGuc7CDEauSLMTFU5ECqkC7wCX1aRvi7YI9pLRKIW', '0');

-- --------------------------------------------------------

--
-- Structure de la table `capteurs`
--

DROP TABLE IF EXISTS `capteurs`;
CREATE TABLE IF NOT EXISTS `capteurs` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `nom_capteur` text NOT NULL,
  `image_capteur` text NOT NULL,
  `valeur` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `capteurs`
--

INSERT INTO `capteurs` (`id`, `nom_capteur`, `image_capteur`, `valeur`) VALUES
(1, 'fumee', '1625412442_ok.gif', 'Pas de flamme');

-- --------------------------------------------------------

--
-- Structure de la table `marches`
--

DROP TABLE IF EXISTS `marches`;
CREATE TABLE IF NOT EXISTS `marches` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `nom_marche` text NOT NULL,
  `image_marche` text NOT NULL,
  `taille_marche` int(11) NOT NULL,
  `vendeur_marche` int(100) NOT NULL,
  `commune_marche` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `marches`
--

INSERT INTO `marches` (`id`, `nom_marche`, `image_marche`, `taille_marche`, `vendeur_marche`, `commune_marche`) VALUES
(1, 'Gare Bassam', '1625413577_RSC-TECHNOLOGY.jpg', 500, 1000, 'Treichville'),
(4, 'Ray Ban', '1625493663_1625398074_RSC-TECHNOLOGY.jpg', 1000, 4000, 'Abobo');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
