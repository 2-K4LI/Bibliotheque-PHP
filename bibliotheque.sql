-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 06 mai 2025 à 07:55
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bibliotheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

DROP TABLE IF EXISTS `livres`;
CREATE TABLE IF NOT EXISTS `livres` (
  `isbn` varchar(13) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `auteur` varchar(50) NOT NULL,
  `annee_publication` year DEFAULT NULL,
  `genre` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`isbn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`isbn`, `titre`, `auteur`, `annee_publication`, `genre`) VALUES
('1295478512094', 'Le Saint Graal du Ctrl+C / Ctrl+V : Ma Vie de Développeur', 'collin Paste', '2025', 'Science-Fiction'),
('1235987422094', 'Le Point-Virgule Perdu', 'L\'équipe de DEV', '2025', 'Science-Fiction'),
('2456789654335', 'les Var et Moi', 'Eva Luable', '2020', 'Roman'),
('5465367897965', 'Le Booléen Têtu', 'Alex VraiFaux', '2022', 'Histoire'),
('2334445887688', 'La Mise en Prod', 'Guy T. Hub', '2000', 'Science-Fiction'),
('7658564324477', 'Le Frontend', 'Alex Terrieur', '2023', 'Roman');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
