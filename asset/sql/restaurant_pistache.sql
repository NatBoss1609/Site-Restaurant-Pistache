-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 21 juin 2024 à 13:02
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `restaurant_pistache`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Entrees'),
(2, 'Plats'),
(3, 'Desserts');

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `status` enum('draft','published') DEFAULT 'draft',
  `creation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `menu`
--

INSERT INTO `menu` (`id`, `category`, `name`, `price`, `status`, `creation_date`) VALUES
(1, '1', 'Salade Mediteraneenne', 8.00, 'published', '2024-06-21 12:19:32'),
(2, '1', 'Foie Gras Maison', 10.00, 'published', '2024-06-21 12:19:32'),
(3, '1', 'Tartare de Saumon', 12.00, 'published', '2024-06-21 12:19:32'),
(4, '1', 'Escargot a  la Bourguignonne', 10.00, 'published', '2024-06-21 12:19:32'),
(5, '2', 'Filet de Bar Grille', 20.00, 'published', '2024-06-21 12:19:32'),
(6, '2', 'Magret de Canard ', 22.00, 'published', '2024-06-21 12:19:32'),
(7, '2', 'Risotto aux Champignons Sauvages', 18.00, 'published', '2024-06-21 12:19:32'),
(8, '2', 'Entrecote de Boeuf ', 24.00, 'published', '2024-06-21 12:19:32'),
(9, '3', 'Creme Brulee a la Vanille ', 8.00, 'published', '2024-06-21 12:19:32'),
(10, '3', 'Tarte Tatin ', 9.00, 'published', '2024-06-21 12:19:32'),
(11, '3', 'Mousse au Chocolat Maison ', 7.00, 'published', '2024-06-21 12:19:32'),
(12, '3', 'Tarte Citron ', 6.00, 'published', '2024-06-21 12:19:32');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `mdp` varchar(250) NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `email`, `mdp`) VALUES
(1, 'nathan.decraye@apprenant.ifapme.be', '$2y$10$EixZaYVK1fsbw1Zfbx3OXePaWxn96p36w6Pne2Z1/DNq03L81G7eK');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
