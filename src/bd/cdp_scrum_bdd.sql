CREATE DATABASE cdp_scrum_bdd;

CREATE TABLE cdp_scrum_bdd.user (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(250) NOT NULL,
  `first_name` VARCHAR(250) NOT NULL,
  `email` VARCHAR(250) NOT NULL,
  `password` VARCHAR(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE cdp_scrum_bdd.project (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text,
  `date_added` date NOT NULL,
  `date_available` date NOT NULL,
  `product_owner` int(11) NOT NULL,
  `creator` int(11) NOT NULL,
  FOREIGN KEY (`product_owner`) REFERENCES cdp_scrum_bdd.user (id),
  FOREIGN KEY (`creator`) REFERENCES cdp_scrum_bdd.user (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE cdp_scrum_bdd.member_relations (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `project` int(11) NOT NULL,
  FOREIGN KEY (`project`) REFERENCES cdp_scrum_bdd.project (id),
  `member` int(11) NOT NULL,
   FOREIGN KEY (`member`) REFERENCES cdp_scrum_bdd.user (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE cdp_scrum_bdd.user_story (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text,
  `cost` int(11),
  `priority` int(11),
  `state` int(11) NOT NULL,
  `is_all` BOOLEAN DEFAULT 0,
  `id_project` int(11) NOT NULL,
  FOREIGN KEY (`id_project`) REFERENCES cdp_scrum_bdd.project (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE cdp_scrum_bdd.sprint (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `title` text NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `id_project` int(11) NOT NULL,
  FOREIGN KEY (`id_project`) REFERENCES cdp_scrum_bdd.project (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE cdp_scrum_bdd.task (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text,
  `state` int(11) NOT NULL,
  `implementer` int(11),
  `id_us` int(11) NOT NULL,
  FOREIGN KEY (`id_us`) REFERENCES cdp_scrum_bdd.user_story (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE cdp_scrum_bdd.task_dependency (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `task` int(11) NOT NULL,
   FOREIGN KEY (`task`) REFERENCES cdp_scrum_bdd.task (id),
  `depend_to` int(11) NOT NULL,
  FOREIGN KEY (`depend_to`) REFERENCES cdp_scrum_bdd.task (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE cdp_scrum_bdd.user_story_in_sprint (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_story` int(11) NOT NULL,
  FOREIGN KEY (`user_story`) REFERENCES cdp_scrum_bdd.user_story (id),
  `sprint` int(11) NOT NULL,
  FOREIGN KEY (`sprint`) REFERENCES cdp_scrum_bdd.sprint (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO cdp_scrum_bdd.user (`id`, `name`, `first_name`, `email`, `password`) VALUES
(1, 'Labrousse', 'Thomas', 'thomaslab@lol.fr', '1234'),
(2, 'Tisne', 'Romain', 'romaintisne@lol.fr', '1234'),
(3, 'Traore', 'Ismael', 'ismaeltraore@lol.fr', '1234'),
(4, 'Blanc', 'Xavier', 'xavierblanc@lol.fr', '1234');


INSERT INTO cdp_scrum_bdd.project (`id`, `title`, `description`, `date_added`, `date_available`, `product_owner`, `creator`) VALUES
(1, 'ScrumProject', 'Un projet scrum', '2016-10-01', '2016-10-31', 4, 1),
(2, 'TestProjet2', 'Un deuxieme projet', '2016-09-01', '2016-10-29', 1, 2);


INSERT INTO cdp_scrum_bdd.member_relations (`id`, `project`, `member`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 2, 1);