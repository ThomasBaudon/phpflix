-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : dim. 23 oct. 2022 à 18:05
-- Version du serveur :  5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `phpflix`
--

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(3) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `civilite` enum('m','f','else') NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `zip` int(6) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `statut` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `nom`, `prenom`, `civilite`, `pseudo`, `mdp`, `photo`, `email`, `adresse`, `zip`, `ville`, `statut`) VALUES
(10, 'Ventura', 'Ace', 'm', 'user', '$2y$10$HZI06P6LD1oa809JHq4ot.TrbohisGfmrBsn/XIKb7PdPd/uyqnXm', 'http://localhost:8080/phpflix/avatars/1666457830_user_avatar-2.jpg', 'aceventura@petdetective.com', '747 high street', 99999, 'San Francisco', 0),
(11, 'Baudon', 'Thomas', 'm', 'admin', '$2y$10$.dbqC8CHqr4tTKoqt1hgpO6RyYMHyAlbjq/cifObtW6H0tcArP4LS', 'http://localhost:8080/phpflix/avatars/1666548251_admin_avatar.jpg', 'tbaudon@yahoo.fr', '1 rue des développeurs perdus', 60190, 'Moyvillers', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
