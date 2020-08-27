-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : jeu. 27 août 2020 à 12:25
-- Version du serveur :  8.0.17
-- Version de PHP : 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `timers`
--

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
('DoctrineMigrations\\Version20200827101048', '2020-08-27 10:11:32', 3030);

-- --------------------------------------------------------

--
-- Structure de la table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `id_status_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `name_project` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `project`
--

INSERT INTO `project` (`id`, `id_status_id`, `team_id`, `name_project`, `date_creation`) VALUES
(1, NULL, NULL, 'projetmag', '2020-08-27 11:39:03'),
(2, NULL, 1, 'test', '2020-08-27 11:39:23');

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `id_status_id` int(11) DEFAULT NULL,
  `team_admin_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `team`
--

INSERT INTO `team` (`id`, `id_status_id`, `team_admin_id`, `name`, `date_creation`) VALUES
(1, NULL, 1, 'teamOne', '2020-08-27 11:34:21');

-- --------------------------------------------------------

--
-- Structure de la table `timer`
--

CREATE TABLE `timer` (
  `id` int(11) NOT NULL,
  `id_user_id` int(11) NOT NULL,
  `id_team_id` int(11) NOT NULL,
  `id_project_id` int(11) NOT NULL,
  `date_time_debut` datetime NOT NULL,
  `date_time_fin` datetime DEFAULT NULL,
  `cumul_s` int(11) DEFAULT NULL,
  `timer_comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `timer`
--

INSERT INTO `timer` (`id`, `id_user_id`, `id_team_id`, `id_project_id`, `date_time_debut`, `date_time_fin`, `cumul_s`, `timer_comment`) VALUES
(1, 1, 1, 2, '2020-08-27 11:44:48', '2020-08-27 11:52:19', NULL, 'test');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `status_id`, `email`, `roles`, `password`, `name`, `last_name`, `date_creation`) VALUES
(1, NULL, 'mag@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$d2NESi5Cb0E1a2dFUHgybw$A2sCuWI8RB7/fimyoKUaNE79GOiCwcDlnScr00gCATo', 'test', 'testing', '2020-08-27 11:28:26'),
(2, NULL, 'gregory@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$cXNnQWF4NXFKODZ2Lk15cw$tgqTm5dPF7PiDoP9zVR+I3zrzxnizy/j+yg/h1fgZ7w', 'gregory', 'gds', '2020-08-27 11:36:38'),
(3, NULL, 'charles@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$T0JkbS5zcG9iLmg3aU82Zg$PKX297u4gmgsPIhemZzu8utx4tfIbU7J0WQkJbymDMU', 'charles', 'charles', '2020-08-27 11:37:57');

-- --------------------------------------------------------

--
-- Structure de la table `user_project`
--

CREATE TABLE `user_project` (
  `id` int(11) NOT NULL,
  `id_user_id` int(11) NOT NULL,
  `id_project_id` int(11) NOT NULL,
  `id_status_id` int(11) DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_project`
--

INSERT INTO `user_project` (`id`, `id_user_id`, `id_project_id`, `id_status_id`, `date_creation`) VALUES
(1, 1, 2, NULL, '2020-08-27 11:44:15'),
(2, 2, 2, NULL, '2020-08-27 11:44:15'),
(3, 3, 2, NULL, '2020-08-27 11:44:15');

-- --------------------------------------------------------

--
-- Structure de la table `user_team`
--

CREATE TABLE `user_team` (
  `id` int(11) NOT NULL,
  `id_user_id` int(11) NOT NULL,
  `id_team_id` int(11) NOT NULL,
  `id_status_id` int(11) DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_team`
--

INSERT INTO `user_team` (`id`, `id_user_id`, `id_team_id`, `id_status_id`, `date_creation`) VALUES
(1, 2, 1, NULL, '2020-08-27 11:42:52'),
(2, 3, 1, NULL, '2020-08-27 11:43:31');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2FB3D0EEEBC2BC9A` (`id_status_id`),
  ADD KEY `IDX_2FB3D0EE296CD8AE` (`team_id`);

--
-- Index pour la table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C4E0A61FEBC2BC9A` (`id_status_id`),
  ADD KEY `IDX_C4E0A61FDC695E6E` (`team_admin_id`);

--
-- Index pour la table `timer`
--
ALTER TABLE `timer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6AD0DE1A79F37AE5` (`id_user_id`),
  ADD KEY `IDX_6AD0DE1AF7F171DE` (`id_team_id`),
  ADD KEY `IDX_6AD0DE1AB3E79F4B` (`id_project_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD KEY `IDX_8D93D6496BF700BD` (`status_id`);

--
-- Index pour la table `user_project`
--
ALTER TABLE `user_project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_77BECEE479F37AE5` (`id_user_id`),
  ADD KEY `IDX_77BECEE4B3E79F4B` (`id_project_id`),
  ADD KEY `IDX_77BECEE4EBC2BC9A` (`id_status_id`);

--
-- Index pour la table `user_team`
--
ALTER TABLE `user_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BE61EAD679F37AE5` (`id_user_id`),
  ADD KEY `IDX_BE61EAD6F7F171DE` (`id_team_id`),
  ADD KEY `IDX_BE61EAD6EBC2BC9A` (`id_status_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `timer`
--
ALTER TABLE `timer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user_project`
--
ALTER TABLE `user_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user_team`
--
ALTER TABLE `user_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `FK_2FB3D0EE296CD8AE` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`),
  ADD CONSTRAINT `FK_2FB3D0EEEBC2BC9A` FOREIGN KEY (`id_status_id`) REFERENCES `status` (`id`);

--
-- Contraintes pour la table `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `FK_C4E0A61FDC695E6E` FOREIGN KEY (`team_admin_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_C4E0A61FEBC2BC9A` FOREIGN KEY (`id_status_id`) REFERENCES `status` (`id`);

--
-- Contraintes pour la table `timer`
--
ALTER TABLE `timer`
  ADD CONSTRAINT `FK_6AD0DE1A79F37AE5` FOREIGN KEY (`id_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_6AD0DE1AB3E79F4B` FOREIGN KEY (`id_project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `FK_6AD0DE1AF7F171DE` FOREIGN KEY (`id_team_id`) REFERENCES `team` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6496BF700BD` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);

--
-- Contraintes pour la table `user_project`
--
ALTER TABLE `user_project`
  ADD CONSTRAINT `FK_77BECEE479F37AE5` FOREIGN KEY (`id_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_77BECEE4B3E79F4B` FOREIGN KEY (`id_project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `FK_77BECEE4EBC2BC9A` FOREIGN KEY (`id_status_id`) REFERENCES `status` (`id`);

--
-- Contraintes pour la table `user_team`
--
ALTER TABLE `user_team`
  ADD CONSTRAINT `FK_BE61EAD679F37AE5` FOREIGN KEY (`id_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_BE61EAD6EBC2BC9A` FOREIGN KEY (`id_status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `FK_BE61EAD6F7F171DE` FOREIGN KEY (`id_team_id`) REFERENCES `team` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
