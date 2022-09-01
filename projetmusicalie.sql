-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 01 sep. 2022 à 16:12
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetmusicalie`
--

-- --------------------------------------------------------

--
-- Structure de la table `artiste`
--

CREATE TABLE `artiste` (
  `id` int(11) NOT NULL,
  `nom_scene` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `style` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `artiste`
--

INSERT INTO `artiste` (`id`, `nom_scene`, `style`) VALUES
(1, 'Tama Impala', 'Musique alternative/indé'),
(3, 'Eminem', 'Rap'),
(4, 'Three days Grace', 'Rock'),
(5, 'Skrillex', 'Dubstep'),
(6, 'Mystery skulls', 'Pop');

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`id`, `nom`, `numero`) VALUES
(25, 'Charente', 16),
(26, 'Charente-Maritime', 17),
(34, 'Deux-Sèvres', 79);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220901133133', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `festival`
--

CREATE TABLE `festival` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `departement_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `festival`
--

INSERT INTO `festival` (`id`, `nom`, `lieu`, `photo`, `description`, `departement_id`) VALUES
(1, 'Rock en seine', 'Grande place', 'rockenseine-6310aaf9286a1.png', 'dadzazd', 25),
(2, 'AbracadraMusiq', 'Hotel de ville', 'istockphoto-1271341003-1024x1024-6310aaec12690.jpg', 'dazdazdaz', 34),
(3, 'Epic rap battle', 'Troisième arrondissement', 'telechargement-6310b79169ba3.png', 'juhtygrtfrdze', 34),
(4, 'Festival de ouf ta vu', 'Dans la caravane', 'depositphotos-11864318-stock-photo-psychedelic-background-6310ab0c9ca52.webp', 'cxsvdfbgnhjyt', 26),
(32, 'LAndia musik', 'Lyon', 'shutterstock-733274026-small-1024x871-6310ab13107fb.jpg', 'non', 26),
(33, 'FrontEnd 😥', 'Lyon', 'mav-image-psychedelique-6310aa03c8177.jpg', 'dzadazadza', 25);

-- --------------------------------------------------------

--
-- Structure de la table `festival_artiste`
--

CREATE TABLE `festival_artiste` (
  `festival_id` int(11) NOT NULL,
  `artiste_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `festival_artiste`
--

INSERT INTO `festival_artiste` (`festival_id`, `artiste_id`) VALUES
(1, 1),
(1, 3),
(2, 1),
(2, 3),
(2, 4),
(2, 5),
(3, 3),
(3, 5),
(4, 1),
(4, 5),
(32, 1),
(32, 5),
(33, 1),
(33, 3);

-- --------------------------------------------------------

--
-- Structure de la table `instrument`
--

CREATE TABLE `instrument` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `artiste_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `instrument`
--

INSERT INTO `instrument` (`id`, `nom`, `artiste_id`) VALUES
(1, 'Guitare VX5400', 1),
(2, 'Flûte', 5),
(3, 'Triangle', 1),
(4, 'Guitare électrique', 6),
(5, 'Velo qui fait de la musique ???', 1);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `artiste`
--
ALTER TABLE `artiste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `festival`
--
ALTER TABLE `festival`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_57CF789CCF9E01E` (`departement_id`);

--
-- Index pour la table `festival_artiste`
--
ALTER TABLE `festival_artiste`
  ADD PRIMARY KEY (`festival_id`,`artiste_id`),
  ADD KEY `IDX_B1E20C5E8AEBAF57` (`festival_id`),
  ADD KEY `IDX_B1E20C5E21D25844` (`artiste_id`);

--
-- Index pour la table `instrument`
--
ALTER TABLE `instrument`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3CBF69DD21D25844` (`artiste_id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `artiste`
--
ALTER TABLE `artiste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `festival`
--
ALTER TABLE `festival`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `instrument`
--
ALTER TABLE `instrument`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `festival`
--
ALTER TABLE `festival`
  ADD CONSTRAINT `FK_57CF789CCF9E01E` FOREIGN KEY (`departement_id`) REFERENCES `departement` (`id`);

--
-- Contraintes pour la table `festival_artiste`
--
ALTER TABLE `festival_artiste`
  ADD CONSTRAINT `FK_B1E20C5E21D25844` FOREIGN KEY (`artiste_id`) REFERENCES `artiste` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B1E20C5E8AEBAF57` FOREIGN KEY (`festival_id`) REFERENCES `festival` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `instrument`
--
ALTER TABLE `instrument`
  ADD CONSTRAINT `FK_3CBF69DD21D25844` FOREIGN KEY (`artiste_id`) REFERENCES `artiste` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
