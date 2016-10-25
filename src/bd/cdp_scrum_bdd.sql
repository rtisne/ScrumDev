CREATE DATABASE cdp_scrum_bdd;

CREATE TABLE cdp_scrum_bdd.member_relations (
  `id` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `member` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE cdp_scrum_bdd.project (
  `id` int(11) NOT NULL,
  `title` char(0) NOT NULL,
  `description` text NOT NULL,
  `date_added` date NOT NULL,
  `date_available` date NOT NULL,
  `product_owner` int(11) NOT NULL,
  `creator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE cdp_scrum_bdd.sprint (
  `id` int(11) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE cdp_scrum_bdd.task (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `state` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `implementer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE cdp_scrum_bdd.task_dependency (
  `id` int(11) NOT NULL,
  `task_first` int(11) NOT NULL,
  `task_second` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE cdp_scrum_bdd.task_relations (
  `id` int(11) NOT NULL,
  `task` int(11) NOT NULL,
  `sprint` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE cdp_scrum_bdd.user (
  `id` int(11) NOT NULL,
  `name` char(0) NOT NULL,
  `first_name` char(0) NOT NULL,
  `email` char(0) NOT NULL,
  `password` char(0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE cdp_scrum_bdd.user_story (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `cost` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE cdp_scrum_bdd.us_relations (
  `id` int(11) NOT NULL,
  `user_story` int(11) NOT NULL,
  `sprint` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE cdp_scrum_bdd.member_relations
  ADD PRIMARY KEY (`id`),
  ADD KEY `project` (`project`),
  ADD KEY `member` (`member`);

--
-- Index pour la table `project`
--
ALTER TABLE cdp_scrum_bdd.project
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator` (`creator`),
  ADD KEY `product_owner` (`product_owner`);

--
-- Index pour la table `sprint`
--
ALTER TABLE cdp_scrum_bdd.sprint
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `task`
--
ALTER TABLE cdp_scrum_bdd.task
  ADD PRIMARY KEY (`id`),
  ADD KEY `implementer` (`implementer`);

--
-- Index pour la table `task_dependency`
--
ALTER TABLE cdp_scrum_bdd.task_dependency
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_first` (`task_first`),
  ADD KEY `task_second` (`task_second`);

--
-- Index pour la table `task_relations`
--
ALTER TABLE cdp_scrum_bdd.task_relations
  ADD PRIMARY KEY (`id`),
  ADD KEY `task` (`task`),
  ADD KEY `sprint` (`sprint`);

--
-- Index pour la table `user`
--
ALTER TABLE cdp_scrum_bdd.user
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user story`
--
ALTER TABLE cdp_scrum_bdd.user_story
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `us_relations`
--
ALTER TABLE cdp_scrum_bdd.us_relations
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_story` (`user_story`),
  ADD KEY `sprint` (`sprint`);

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
-- Contraintes pour la table `task`
--
ALTER TABLE cdp_scrum_bdd.task
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`implementer`) REFERENCES cdp_scrum_bdd.user (`id`);

--
-- Contraintes pour la table `task_dependency`
--
ALTER TABLE cdp_scrum_bdd.task_dependency
  ADD CONSTRAINT `task_dependency_ibfk_1` FOREIGN KEY (`task_first`) REFERENCES cdp_scrum_bdd.task (`id`),
  ADD CONSTRAINT `task_dependency_ibfk_2` FOREIGN KEY (`task_second`) REFERENCES cdp_scrum_bdd.task (`id`);

--
-- Contraintes pour la table `task_relations`
--
ALTER TABLE cdp_scrum_bdd.task_relations
  ADD CONSTRAINT `task_relations_ibfk_1` FOREIGN KEY (`sprint`) REFERENCES cdp_scrum_bdd.sprint (`id`),
  ADD CONSTRAINT `task_relations_ibfk_2` FOREIGN KEY (`task`) REFERENCES cdp_scrum_bdd.task (`id`);

--
-- Contraintes pour la table `us_relations`
--
ALTER TABLE cdp_scrum_bdd.us_relations
  ADD CONSTRAINT `us_relations_ibfk_1` FOREIGN KEY (`user_story`) REFERENCES cdp_scrum_bdd.user_story (`id`),
  ADD CONSTRAINT `us_relations_ibfk_2` FOREIGN KEY (`sprint`) REFERENCES cdp_scrum_bdd.sprint (`id`);
