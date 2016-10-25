-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 25 Octobre 2016 à 10:08
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cdp_scrum_bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `member_relations`
--

CREATE TABLE `member_relations` (
  `id` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `member` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `title` char(0) NOT NULL,
  `description` text NOT NULL,
  `date_added` date NOT NULL,
  `date_available` date NOT NULL,
  `product_owner` int(11) NOT NULL,
  `creator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sprint`
--

CREATE TABLE `sprint` (
  `id` int(11) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `state` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `implementer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `task_dependency`
--

CREATE TABLE `task_dependency` (
  `id` int(11) NOT NULL,
  `task_first` int(11) NOT NULL,
  `task_second` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `task_relations`
--

CREATE TABLE `task_relations` (
  `id` int(11) NOT NULL,
  `task` int(11) NOT NULL,
  `sprint` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` char(0) NOT NULL,
  `first_name` char(0) NOT NULL,
  `email` char(0) NOT NULL,
  `password` char(0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user story`
--

CREATE TABLE `user story` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `cost` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `us_relations`
--

CREATE TABLE `us_relations` (
  `id` int(11) NOT NULL,
  `user_story` int(11) NOT NULL,
  `sprint` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `member_relations`
--
ALTER TABLE `member_relations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project` (`project`),
  ADD KEY `member` (`member`);

--
-- Index pour la table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator` (`creator`),
  ADD KEY `product_owner` (`product_owner`);

--
-- Index pour la table `sprint`
--
ALTER TABLE `sprint`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `implementer` (`implementer`);

--
-- Index pour la table `task_dependency`
--
ALTER TABLE `task_dependency`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_first` (`task_first`),
  ADD KEY `task_second` (`task_second`);

--
-- Index pour la table `task_relations`
--
ALTER TABLE `task_relations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task` (`task`),
  ADD KEY `sprint` (`sprint`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user story`
--
ALTER TABLE `user story`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `us_relations`
--
ALTER TABLE `us_relations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_story` (`user_story`),
  ADD KEY `sprint` (`sprint`);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `member_relations`
--
ALTER TABLE `member_relations`
  ADD CONSTRAINT `member_relations_ibfk_1` FOREIGN KEY (`project`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `member_relations_ibfk_2` FOREIGN KEY (`member`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `project_ibfk_2` FOREIGN KEY (`product_owner`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`implementer`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `task_dependency`
--
ALTER TABLE `task_dependency`
  ADD CONSTRAINT `task_dependency_ibfk_1` FOREIGN KEY (`task_first`) REFERENCES `task` (`id`),
  ADD CONSTRAINT `task_dependency_ibfk_2` FOREIGN KEY (`task_second`) REFERENCES `task` (`id`);

--
-- Contraintes pour la table `task_relations`
--
ALTER TABLE `task_relations`
  ADD CONSTRAINT `task_relations_ibfk_1` FOREIGN KEY (`sprint`) REFERENCES `sprint` (`id`),
  ADD CONSTRAINT `task_relations_ibfk_2` FOREIGN KEY (`task`) REFERENCES `task` (`id`);

--
-- Contraintes pour la table `us_relations`
--
ALTER TABLE `us_relations`
  ADD CONSTRAINT `us_relations_ibfk_1` FOREIGN KEY (`user_story`) REFERENCES `user story` (`id`),
  ADD CONSTRAINT `us_relations_ibfk_2` FOREIGN KEY (`sprint`) REFERENCES `sprint` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
