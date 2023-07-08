-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `piscine`
--

-- --------------------------------------------------------

--
-- Structure de la table `acheteur`
--

DROP TABLE IF EXISTS `acheteur`;
CREATE TABLE IF NOT EXISTS `acheteur` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Mdp` varchar(255) NOT NULL,
  `Adresse1` varchar(255) NOT NULL,
  `Adresse2` varchar(255) NOT NULL,
  `Ville` varchar(255) NOT NULL,
  `CodePostal` int NOT NULL,
  `Pays` varchar(255) NOT NULL,
  `Tel` varchar(255) NOT NULL,
  `TypeCarte` varchar(255) NOT NULL,
  `NumCarte` bigint NOT NULL,
  `NomCarte` varchar(255) NOT NULL,
  `DateExp` date NOT NULL,
  `Code` int NOT NULL,
  `Solde` float NOT NULL,
  `Achats` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `ID` int NOT NULL,
  `Pseudo` varchar(255) NOT NULL,
  `Mdp` varchar(255) NOT NULL,
  `Solde` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`ID`, `Pseudo`, `Mdp`, `Solde`) VALUES
(0, 'admin', 'admin', 100000);

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

DROP TABLE IF EXISTS `conversation`;
CREATE TABLE IF NOT EXISTS `conversation` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Chat` text NOT NULL,
  `ID_P1` int NOT NULL,
  `ID_P2` int NOT NULL,
  `Compteur` int NOT NULL,
  `Offre` float NOT NULL,
  `Item` int NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Prix` float NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Categorie` varchar(255) NOT NULL,
  `TypeVente` varchar(255) NOT NULL,
  `Vendeur` int NOT NULL,
  `Etat` int NOT NULL,
  `ValeurEnchere` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notif`
--

DROP TABLE IF EXISTS `notif`;
CREATE TABLE IF NOT EXISTS `notif` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ID_Acheteur` int NOT NULL,
  `Debut` int NOT NULL,
  `Categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

DROP TABLE IF EXISTS `vendeur`;
CREATE TABLE IF NOT EXISTS `vendeur` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Pseudo` varchar(255) NOT NULL,
  `Mdp` varchar(255) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `Fond` varchar(255) NOT NULL,
  `Solde` float NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
