-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 04 avr. 2024 à 14:41
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_membre`
--

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `matricule` varchar(60) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(60) DEFAULT NULL,
  `sexe` enum('Masculin','Feminin') NOT NULL,
  `situation_matrimoniale` enum('Célibataire','Marié(e)','Divorcé(e)','Veuf(ve)') NOT NULL,
  `id_statut` int(11) NOT NULL,
  `id_age` int(11) NOT NULL,
  `statut_emploi` enum('Chômeur','Non chômeur') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`matricule`, `nom`, `prenom`, `sexe`, `situation_matrimoniale`, `id_statut`, `id_age`, `statut_emploi`) VALUES
('PATT1', 'Diallo', 'Aïcha', 'Feminin', 'Marié(e)', 3, 5, 'Non chômeur'),
('PATT2', 'Diop', 'Mamadou', 'Masculin', 'Célibataire', 2, 3, 'Chômeur'),
('PATT3', 'Sow', 'Fatou', 'Feminin', 'Célibataire', 2, 2, 'Non chômeur'),
('PATT4', 'Ba', 'Moussa', 'Masculin', 'Marié(e)', 1, 4, 'Non chômeur'),
('PATT5', 'Thiam', 'Aminata', 'Feminin', 'Marié(e)', 3, 5, 'Non chômeur');

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE `statut` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `statut`
--

INSERT INTO `statut` (`id`, `titre`) VALUES
(1, 'Chef de quartier'),
(2, 'Civile'),
(3, 'Badian Gokh');

-- --------------------------------------------------------

--
-- Structure de la table `tranche_age`
--

CREATE TABLE `tranche_age` (
  `id` int(11) NOT NULL,
  `min_age` int(11) NOT NULL,
  `max_age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tranche_age`
--

INSERT INTO `tranche_age` (`id`, `min_age`, `max_age`) VALUES
(1, 0, 17),
(2, 18, 25),
(3, 26, 35),
(4, 36, 45),
(5, 46, 60),
(6, 61, 100);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`matricule`),
  ADD UNIQUE KEY `matricule` (`matricule`),
  ADD KEY `fk_id_statut` (`id_statut`),
  ADD KEY `fk_id_age` (`id_age`);

--
-- Index pour la table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tranche_age`
--
ALTER TABLE `tranche_age`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `statut`
--
ALTER TABLE `statut`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tranche_age`
--
ALTER TABLE `tranche_age`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `membre`
--
ALTER TABLE `membre`
  ADD CONSTRAINT `fk_id_age` FOREIGN KEY (`id_age`) REFERENCES `tranche_age` (`id`),
  ADD CONSTRAINT `fk_id_statut` FOREIGN KEY (`id_statut`) REFERENCES `statut` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
