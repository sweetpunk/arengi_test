-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 20 déc. 2024 à 13:22
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET
SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET
time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `arengi`
--

-- --------------------------------------------------------

--
-- Structure de la table `car_type`
--

DROP TABLE IF EXISTS `car_type`;
CREATE TABLE IF NOT EXISTS `car_type`
(
    `id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `name`
    varchar
(
    255
) COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY
(
    `id`
)
    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE =utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `car_type`
--

INSERT INTO `car_type` (`id`, `name`)
VALUES (1, 'berline'),
       (2, 'citadine'),
       (3, 'utilitaire');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;