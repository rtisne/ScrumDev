CREATE DATABASE cdp_scrum_bdd;

CREATE TABLE cdp_scrum_bdd.member_relations (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `project` int(11) NOT NULL,
  `member` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO cdp_scrum_bdd.member_relations (`id`, `project`, `member`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 2, 1);

CREATE TABLE cdp_scrum_bdd.project (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `date_added` date NOT NULL,
  `date_available` date NOT NULL,
  `product_owner` int(11) NOT NULL,
  `creator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO cdp_scrum_bdd.project (`id`, `title`, `description`, `date_added`, `date_available`, `product_owner`, `creator`) VALUES
(1, 'ScrumProject', 'Un projet scrum', '2016-10-01', '2016-10-31', 4, 1),
(2, 'TestProjet2', 'Un deuxieme projet', '2016-09-01', '2016-10-29', 1, 2);

CREATE TABLE cdp_scrum_bdd.sprint (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` text NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `id_project` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE cdp_scrum_bdd.task (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `state` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `implementer` int(11) NOT NULL,
  `id_us` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE cdp_scrum_bdd.task_dependency (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `task` int(11) NOT NULL,
  `depend_to` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE cdp_scrum_bdd.user (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(250) NOT NULL,
  `first_name` VARCHAR(250) NOT NULL,
  `email` VARCHAR(250) NOT NULL,
  `password` VARCHAR(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO cdp_scrum_bdd.user (`id`, `name`, `first_name`, `email`, `password`) VALUES
(1, 'Labrousse', 'Thomas', 'thomaslab@lol.fr', '1234'),
(2, 'Tisne', 'Romain', 'romaintisne@lol.fr', '1234'),
(3, 'Traore', 'Ismael', 'ismaeltraore@lol.fr', '1234'),
(4, 'Blanc', 'Xavier', 'xavierblanc@lol.fr', '1234');


CREATE TABLE cdp_scrum_bdd.user_story (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `cost` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `id_sprint` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;





ALTER TABLE cdp_scrum_bdd.member_relations
  ADD KEY `project` (`project`),
  ADD KEY `member` (`member`);

--
-- Index pour la table `project`
--
ALTER TABLE cdp_scrum_bdd.project
  ADD KEY `creator` (`creator`),
  ADD KEY `product_owner` (`product_owner`);

--
-- Index pour la table `sprint`
--
ALTER TABLE cdp_scrum_bdd.sprint
   ADD KEY `id_project` (`id_project`);

--
-- Index pour la table `task`
--
ALTER TABLE cdp_scrum_bdd.task
  ADD KEY `implementer` (`implementer`),
  ADD KEY `id_us` (`id_us`);

--
-- Index pour la table `task_dependency`
--
ALTER TABLE cdp_scrum_bdd.task_dependency
  ADD KEY `task` (`task`),
  ADD KEY `depend_to` (`depend_to`);


--
-- Index pour la table `user`
--
-- ALTER TABLE cdp_scrum_bdd.user
--   ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user story`
--
ALTER TABLE cdp_scrum_bdd.user_story
  ADD KEY `id_sprint` (`id_sprint`);


--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `member_relations`
--
ALTER TABLE cdp_scrum_bdd.member_relations
  ADD CONSTRAINT `member_relations_ibfk_1` FOREIGN KEY (`project`) REFERENCES cdp_scrum_bdd.project (`id`),
  ADD CONSTRAINT `member_relations_ibfk_2` FOREIGN KEY (`member`) REFERENCES cdp_scrum_bdd.user (`id`);

--
-- Contraintes pour la table `project`
--
ALTER TABLE cdp_scrum_bdd.project
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`creator`) REFERENCES cdp_scrum_bdd.user (`id`),
  ADD CONSTRAINT `project_ibfk_2` FOREIGN KEY (`product_owner`) REFERENCES cdp_scrum_bdd.user (`id`);


--
-- Contraintes pour la table `sprint`
--
ALTER TABLE cdp_scrum_bdd.sprint
  ADD CONSTRAINT `sprint_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES cdp_scrum_bdd.project (`id`);


--
-- Contraintes pour la table `task`
--
ALTER TABLE cdp_scrum_bdd.task
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`implementer`) REFERENCES cdp_scrum_bdd.user (`id`),
  ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`id_us`) REFERENCES cdp_scrum_bdd.user_story (`id`);

--
-- Contraintes pour la table `task_dependency`
--
ALTER TABLE cdp_scrum_bdd.task_dependency
  ADD CONSTRAINT `task_dependency_ibfk_1` FOREIGN KEY (`task`) REFERENCES cdp_scrum_bdd.task (`id`),
  ADD CONSTRAINT `task_dependency_ibfk_2` FOREIGN KEY (`depend_to`) REFERENCES cdp_scrum_bdd.task (`id`);


--
-- Contraintes pour la table `user story`
--
ALTER TABLE cdp_scrum_bdd.user_story
  ADD CONSTRAINT `user story_ibfk_1` FOREIGN KEY (`id_sprint`) REFERENCES cdp_scrum_bdd.sprint (`id`);
