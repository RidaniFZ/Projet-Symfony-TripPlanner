-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 24 avr. 2020 à 10:45
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tripplannerbd`
--

-- --------------------------------------------------------

--
-- Structure de la table `activit`
--

CREATE TABLE `activit` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `activit`
--

INSERT INTO `activit` (`id`, `nom`, `type`, `description`, `prix`) VALUES
(1, 'balade en ville avec vélo', 'culturelle', 'balade en ville avec vélo', '12'),
(2, 'visite grand zoo', 'culturelle', 'visite grand zoo', '14'),
(3, 'Visite de Musée', 'Culturelle', 'Le Musée Maison des Bouchers est en plein centre-ville, pour ne pas dire dans le cœur historique d’Anvers. Il est entouré de quantité de sites intéressants qui complèteront votre visite du musée pour une belle journée d’excursion.', '9'),
(4, 'Visite guidée  de l\'Alhambra et du Généralife à Grenade.', 'Batiment Architécturaux.', 'L\'Alhambra (en arabe : الْحَمْرَاء, Al-Ḥamrā\' , « la rouge ») de Grenade en Andalousie, est un ensemble palatial constituant l\'un des monuments majeurs de l\'architecture islamique. Acropole médiévale la plus majestueuse du monde méditerranéen, située sur le plateau de la Sabika qui domine la ville, elle se compose essentiellement de quatre parties incluses dans son enceinte fortifiée : l\'Alcazaba, les palais nasrides, le Généralife , ses jardins, et le palais de Charles Quint.', '49'),
(5, 'Visite guidée  de l\'Alhambra et du Généralife à Grenade.', 'Batiment Architécturaux.', 'L\'Alhambra (en arabe : الْحَمْرَاء, Al-Ḥamrā\' , « la rouge ») de Grenade en Andalousie, est un ensemble palatial constituant l\'un des monuments majeurs de l\'architecture islamique. Acropole médiévale la plus majestueuse du monde méditerranéen, située sur le plateau de la Sabika qui domine la ville, elle se compose essentiellement de quatre parties incluses dans son enceinte fortifiée : l\'Alcazaba, les palais nasrides, le Généralife , ses jardins, et le palais de Charles Quint.', '49'),
(6, 'Visite de Musée', 'Culturelle', 'Le Musée Maison des Bouchers est en plein centre-ville, pour ne pas dire dans le cœur historique d’Anvers. Il est entouré de quantité de sites intéressants qui complèteront votre visite du musée pour une belle journée d’excursion.', '9'),
(7, 'Diner-croisière sur la Seine.', 'Gastronomie', 'L\'offre comprend un dîner croisière pour 2 personnes avec entrée, plat et dessert sur la Seine.', '78'),
(8, 'Tour dans un Yacht', 'Plien Aire', 'Excursions en bateau et sports nautiques, Activités de plein air, Plus', '55'),
(9, 'Camping The Molen', 'Plien Aire', 'Camping situé au calme, à 100 m de la plage Ste-Anne et à 1 km des magasins', '45');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_groupe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id`, `nom`, `description`, `admin_groupe_id`) VALUES
(2, 'les amateur de surf', 'le groupe est crée pour les gens qui s’intéresse aux surf.', 10),
(3, 'les amateurs des  fetes', 'le groupe est crée pour les gens qui s’intéresse aux fêtes et aux  festivals.', 9),
(5, 'les amateurs de culturel', 'le groupe est crée pour les gens qui s’intéresse à la culture.', 9),
(6, 'les snientifique', 'le groupe est crée pour les gens qui s’intéresse aux science.', 10),
(7, 'les coupins', 'le groupe est crée entre coupins.', 10),
(8, 'Best Sisters Forever', 'Groupe for my sisters.', 8),
(9, 'Animals lovers', 'le groupe est crée pour les gens qui s’intéresse aux animaux.', 8);

-- --------------------------------------------------------

--
-- Structure de la table `hebergement`
--

CREATE TABLE `hebergement` (
  `id` int(11) NOT NULL,
  `adress` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_par_nuit` decimal(10,0) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `hebergement`
--

INSERT INTO `hebergement` (`id`, `adress`, `prix_par_nuit`, `type`) VALUES
(1, 'Avenue louise 123, 17800', '1', ''),
(2, 'Avenue des ancien combatant 86, 10000', '1', ''),
(8, 'Anvers center', '1', 'hotel'),
(9, 'Meistraat 39, 2000 Antwerpen', '91', 'Hôtel Ibis Anvers Centre'),
(12, 'Berrcy 12, 1850.', '250', 'hotel'),
(13, 'Calle Párraga 7, 18002 , Espagne', '67', 'hotel Grenade'),
(14, '3 Rue Arthur Groussier 75010 Paris France', '161', 'La Planque Hotel'),
(15, 'Godefriduskaai 99, 2000 Antwerpen', '250', 'Jachthaven Antwerpen Willemdok'),
(16, 'Houtum 39 2460  Kasterlee Belgique', '28', 'Camping');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200407122231', '2020-04-07 12:24:35'),
('20200408073714', '2020-04-08 07:43:06'),
('20200408085616', '2020-04-08 08:56:33'),
('20200408090652', '2020-04-08 09:07:21'),
('20200408100258', '2020-04-08 10:03:15'),
('20200409205511', '2020-04-09 20:55:36'),
('20200410191507', '2020-04-10 19:15:32'),
('20200410204230', '2020-04-10 20:42:39'),
('20200414195728', '2020-04-14 19:57:43'),
('20200414202054', '2020-04-14 20:21:04'),
('20200414202504', '2020-04-14 20:25:13'),
('20200417112440', '2020-04-17 11:25:04'),
('20200418185216', '2020-04-18 18:52:30'),
('20200421123839', '2020-04-21 12:39:00');

-- --------------------------------------------------------

--
-- Structure de la table `trip`
--

CREATE TABLE `trip` (
  `id` int(11) NOT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `trip_groupe_id` int(11) NOT NULL,
  `trip_hebergement_id` int(11) NOT NULL,
  `trip_admin_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `trip`
--

INSERT INTO `trip` (`id`, `destination`, `date_debut`, `date_fin`, `trip_groupe_id`, `trip_hebergement_id`, `trip_admin_id`, `image`, `description`) VALUES
(6, 'Anvers', '2020-08-01 00:00:00', '2020-08-03 00:00:00', 3, 9, 9, 'e6c0549ed19bfe4f05df81aff917d158.jpeg', 'Anvers est une ville portuaire belge située sur l\'Escaut, dont l\'histoire remonte au Moyen Âge. Au centre-ville, le quartier des diamantaires vieux de plusieurs siècles est le repère de milliers de marchands, tailleurs et polisseurs de diamants.'),
(10, 'Grenade', '2020-08-06 00:00:00', '2020-08-08 00:00:00', 5, 13, 9, '061d2a614a8bd4e1ede828cfc0a5b068.jpeg', 'Grenade est une ville située dans la région de l\'Andalousie au sud de l\'Espagne, dans les contreforts des montagnes de la Sierra Nevada. Elle est réputée pour ses bâtiments à l\'architecture médiévale datant de l\'occupation mauresque'),
(11, 'Paris', '2020-08-18 00:00:00', '2020-08-20 00:00:00', 7, 14, 10, '71251325350c907ea8afe558ac52a23b.jpeg', 'Paris, capitale de la France, est une grande ville européenne et un centre mondial de l\'art, de la mode, de la gastronomie et de la culture. Son paysage urbain du XIXe siècle est traversé par de larges boulevards et la Seine.'),
(12, 'Anvers', '2020-06-28 00:00:00', '2020-06-30 00:00:00', 6, 15, 10, '81ca362e22a228960c6d51e68340184e.jpeg', 'Anvers est une ville portuaire belge située sur l\'Escaut, dont l\'histoire remonte au Moyen Âge. Au centre-ville, le quartier des diamantaires vieux de plusieurs siècles est le repère de milliers de marchands, tailleurs et polisseurs de diamants.'),
(13, 'Anvers', '2020-08-01 00:00:00', '2020-08-03 00:00:00', 9, 16, 8, '98d08365e6fab8b3dfbe1d7afb9d3142.jpeg', 'Anvers est une ville portuaire belge située sur l\'Escaut, dont l\'histoire remonte au Moyen Âge. Au centre-ville, le quartier des diamantaires vieux de plusieurs siècles est le repère de milliers de marchands, tailleurs et polisseurs de diamants.');

-- --------------------------------------------------------

--
-- Structure de la table `trip_activit`
--

CREATE TABLE `trip_activit` (
  `trip_id` int(11) NOT NULL,
  `activit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `trip_activit`
--

INSERT INTO `trip_activit` (`trip_id`, `activit_id`) VALUES
(6, 6),
(10, 5),
(11, 7),
(12, 8),
(13, 9);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `pays`, `adress`, `image`, `description`) VALUES
(8, 'meryam@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$RHBmejNzcmJ2eTZ6aHpMWQ$fBmuvqrlg3Fp8NAg/7P4S9twbo/RDskMk7HUUXSSKIE', 'Ridani', 'Meryam', 'Maroc', 'VN Meknés', '234bbe58a4fbd89da4e4f9d34e953acd.jpeg', 'I lov animals and Nature, I love Free Life.'),
(9, 'ridani.fz@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$bndKaC40RTJMa1EyazBtWg$OKrdC9qVLklhwc1Mp1+z/yVEjZtvcK/IxohLWAsSPWo', 'Ridani', 'Fatimazahra', 'Belgique', 'avenue des Nervien13, 1780.', 'cf22e9adf06c510aa6f4345ac515d033.png', 'I am a web application developper, and I love descovering new places, let\'s do it together'),
(10, 'ayoub@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$UjUvcGZvZWJpQ3VmNENnRw$FiJAnMvG55a5VvDpKgHt2XMRfzTR0qch9Nrn8I4GZms', 'Ridani', 'Ayoub', 'France', 'Metz', 'b2b6f9d6c5ace19bbd5321ebf7efbcbc.jpeg', 'goin all over the world and descovering new places and getting in touch with new ppl.'),
(11, 'ridani@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$NmdHZnQuNURhMnRsRW15dg$PRcO3sOIcRkwxL1WkM58n868fHbyT/NbLUySr5Hf/2k', 'hello', 'hello', 'hello', 'hello', '4a82c60c327efa9a797ddfb8bb502c0c.jpeg', 'hello'),
(12, 'ridani.fatima@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$T1RMeENVOGp1QXBHVXVGMg$lKktnrYShv4AAslcuvSBz/vw0jNt9axRy3XUri6tBeM', 'hello', 'hello', 'hello', 'hello', 'd2da0e53729cdab12317d0b59290af80.jpeg', 'hello');

-- --------------------------------------------------------

--
-- Structure de la table `user_groupe`
--

CREATE TABLE `user_groupe` (
  `user_id` int(11) NOT NULL,
  `groupe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_groupe`
--

INSERT INTO `user_groupe` (`user_id`, `groupe_id`) VALUES
(8, 3),
(8, 6),
(9, 6),
(9, 8),
(9, 9),
(10, 5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activit`
--
ALTER TABLE `activit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4B98C2193B230BE` (`admin_groupe_id`);

--
-- Index pour la table `hebergement`
--
ALTER TABLE `hebergement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_7656F53B675A74DB` (`trip_groupe_id`),
  ADD KEY `IDX_7656F53B6236ABB4` (`trip_hebergement_id`),
  ADD KEY `IDX_7656F53BCC7AB100` (`trip_admin_id`);

--
-- Index pour la table `trip_activit`
--
ALTER TABLE `trip_activit`
  ADD PRIMARY KEY (`trip_id`,`activit_id`),
  ADD KEY `IDX_F1762FD9A5BC2E0E` (`trip_id`),
  ADD KEY `IDX_F1762FD9BA71FC0C` (`activit_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- Index pour la table `user_groupe`
--
ALTER TABLE `user_groupe`
  ADD PRIMARY KEY (`user_id`,`groupe_id`),
  ADD KEY `IDX_61EB971CA76ED395` (`user_id`),
  ADD KEY `IDX_61EB971C7A45358C` (`groupe_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activit`
--
ALTER TABLE `activit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `hebergement`
--
ALTER TABLE `hebergement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `trip`
--
ALTER TABLE `trip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `FK_4B98C2193B230BE` FOREIGN KEY (`admin_groupe_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `trip`
--
ALTER TABLE `trip`
  ADD CONSTRAINT `FK_7656F53B6236ABB4` FOREIGN KEY (`trip_hebergement_id`) REFERENCES `hebergement` (`id`),
  ADD CONSTRAINT `FK_7656F53B675A74DB` FOREIGN KEY (`trip_groupe_id`) REFERENCES `groupe` (`id`),
  ADD CONSTRAINT `FK_7656F53BCC7AB100` FOREIGN KEY (`trip_admin_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `trip_activit`
--
ALTER TABLE `trip_activit`
  ADD CONSTRAINT `FK_F1762FD9A5BC2E0E` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_F1762FD9BA71FC0C` FOREIGN KEY (`activit_id`) REFERENCES `activit` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user_groupe`
--
ALTER TABLE `user_groupe`
  ADD CONSTRAINT `FK_61EB971C7A45358C` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_61EB971CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
