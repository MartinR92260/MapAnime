-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 16 mai 2022 à 12:33
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mapanime_bd`
--

-- --------------------------------------------------------

--
-- Structure de la table `ami`
--

DROP TABLE IF EXISTS `ami`;
CREATE TABLE IF NOT EXISTS `ami` (
  `idAmi` bigint(20) UNSIGNED NOT NULL,
  `pseudoAmi` varchar(32) DEFAULT NULL,
  `PhotoProfil` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`idAmi`),
  UNIQUE KEY `idAmi` (`idAmi`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ami`
--

INSERT INTO `ami` (`idAmi`, `pseudoAmi`, `PhotoProfil`) VALUES
(2, 'Martin', 'livai.jpg'),
(3, 'MartinV2', 'meliodas.jpg'),
(1, 'Ganeche', 'calamity-ganon.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `anime`
--

DROP TABLE IF EXISTS `anime`;
CREATE TABLE IF NOT EXISTS `anime` (
  `idAnime` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(32) DEFAULT NULL,
  `ImageAnime` varchar(32) DEFAULT NULL,
  `nbEpisodes` int(11) DEFAULT NULL,
  `nbSaisons` int(11) DEFAULT NULL,
  `synopsis` text,
  `NoteG` int(11) DEFAULT NULL,
  `Popularite` int(11) DEFAULT '0',
  PRIMARY KEY (`idAnime`),
  UNIQUE KEY `idAnime` (`idAnime`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `anime`
--

INSERT INTO `anime` (`idAnime`, `nom`, `ImageAnime`, `nbEpisodes`, `nbSaisons`, `synopsis`, `NoteG`, `Popularite`) VALUES
(1, 'Dragon Ball', 'dbz.jpg', 4, 3, 'Dragon Ball Z se déroule cinq ans après le mariage de Son Goku et de Chichi, désormais parents de Son Gohan. Raditz, un mystérieux guerrier extraterrestre, qui s\'avère être le frère de Son Goku, arrive sur Terre pour retrouver ce dernier. Ce dernier apprend qu\'il vient d\'une planète de guerriers redoutables dont il ne reste plus que quatre survivants, et qu\'il avait été envoyé sur la planète Terre dans le but de la conquérir (une chute alors qu\'il était enfant lui aurait fait perdre la mémoire).', 5, 2),
(2, 'Radiant', 'radiant.jpg', 42, 2, 'Dans un univers fantastique, des monstres, appelés Némésis, tombent du ciel. L\'origine de ces monstres reste inconnue, mais une chose est sûre, ils ne sont pas là pour notre bien ! Heureusement, des hommes et des femmes organisent la lutte contre ces Némésis. Ces individus sont des infectés rejetés par la société et bien souvent aussi craints que les créatures elles-mêmes. Ils représentent pourtant le seul et unique rempart contre cette menace. Ce sont les sorciers.\r\n\r\nD\'après certaines rumeurs, ces monstres tomberaient d\'un nid de Némésis appelé « Radiant ».\r\n\r\nSeth, le protagoniste de Radiant, est un adolescent qui a survécu à une attaque de Némésis. Il rêve de vaincre tous les Némésis et d\'apporter la paix entre les sorciers et le reste de l\'humanité. Pour ce faire, il doit trouver le lieu d\'origine des Némésis, le légendaire Radiant, et ainsi détruire leur berceau. Lui et d\'autres sorciers parcourent la région à la recherche du Radiant tout en évitant l\'inquisition, une organisation opposée aux Sorciers.', 2, 0),
(3, 'Black Clover', 'BC.jpg', 158, 1, 'Asta est un jeune garçon déterminé qui vit avec son ami d’enfance, Yuno, dans un orphelinat du royaume de Clover. Depuis tout petit, Asta a pour ambition de devenir le magicien le plus puissant du royaume, \"l’Empereur-Mage\", ce qui a aussi inspiré Yuno à vouloir la même chose. Mais malheureusement, Asta est né sans aucun talent magique, alors que Yuno possède des prédispositions spectaculaires.\r\n\r\nLorsqu\'ils atteignent leurs 15 ans, tous les jeunes du royaume sont conviés à une cérémonie où leur est remis leur grimoire, alors que Yuno reçoit le légendaire grimoire avec un trèfle à quatre feuilles, considéré comme un mythe puisque la légende prétend que le premier Empereur-Mage utilisait également un grimoire portant un trèfle à quatre feuilles, Asta ne reçoit rien. Après la cérémonie, Yuno est attaqué par un brigand qui souhaite lui voler son grimoire pour ensuite tenter de le revendre.\r\n\r\nAsta part pour le sauver mais se retrouve en difficulté, heureusement il est sauvé par un mystérieux grimoire avec un trèfle à cinq feuilles et une grande épée rouillée, qui symbolise le démon.\r\n\r\nAsta et Yuno se font la promesse de se battre tous les deux pour le titre d’Empereur-Mage. Alors que leurs chemins se séparent sur la route des Chevaliers-Mages, leur objectif est toujours le même, devenir le prochain Empereur-Mage.', 10, 3),
(4, 'Vinland Saga', 'vinland.jpg', 24, 1, 'Mêlant personnages et évènements historiques avec de nombreux éléments fictifs, Vinland Saga est le récit de la vie d\'un jeune islandais, Thorfinn Thorsson. Ce fils d\'un illustre guerrier repenti verra sa vie basculer lorsque son père est assassiné par des pirates mené par le rusé Askeladd. Animé par la vengeance, Thorfinn suivra puis intégrera cette bande, avec le désir affiché de tuer dans un duel loyal l\'assassin de son père.\r\n\r\nLa quête vengeresse de Thorfinn est le fil rouge du prologue de l\'histoire (tomes 01 à 08). Elle le mènera notamment à participer à l\'invasion de l\'Angleterre par les Danois, au début du xie siècle. Cette partie de l\'histoire traite avec brio de sujets divers tels que la guerre, la politique, la religion, et brosse un portrait convaincant et humain de la vie quotidienne des populations victimes de la guerre mais aussi et surtout des guerriers, bien loin des clichés véhiculés habituellement par les Vikings.\r\n\r\nÀ partir du tome 08 débute le deuxième arc de l\'histoire. L\'action quitte les champs de bataille anglais pour s\'établir dans une propriété agricole d\'Europe du Nord, tandis que le thème de la guerre fait place à celui de la rédemption.', 15, 2),
(5, 'Sword Art Online', 'SAO.jpg', 96, 5, 'La série Sword Art Online se déroule dans différents jeux vidéo d\'immersion virtuelle appelés « VRMMORPG » (Virtual Reality Multi Massively Online Role Playing Game).', 14, 1),
(6, 'Hajime No Ippo', 'Ippo.jpg', 126, 3, 'Ippo Makunouchi est un jeune et timide lycéen de 16 ans qui n’a pas d’amis car il consacre tout son temps libre à aider sa mère, qui l\'élève seule, dans l’entreprise familiale de location de bateaux de pêche. Il est couramment victime de brutalités et d’humiliations par une bande de voyous menée par Umezawa, un de ses camarades de classe. Un jour, un boxeur professionnel témoin de la scène, Mamoru Takamura, le sauve de ses bourreaux et emmène Ippo blessé au club de boxe Kamogawa, tenu par le boxeur retraité Genji Kamogawa, pour le soigner.\r\n\r\nUne fois Ippo réveillé, Takamura tente de lui remonter le moral en le persuadant de se défouler sur un sac de sable, expérience qui révèle chez lui une grande puissance de frappe et un talent inné pour la boxe. Se découvrant une passion pour ce sport et poussé par le désir de devenir fort, le jeune Ippo décide de devenir boxeur professionnel et commence son entraînement au sein du club vers les plus hauts niveaux.', -1, 2),
(7, 'Pokemon', 'Affiche-Pokemon.jpg', 1067, 9, 'Dans l\'univers des Pokémon , les animaux du monde réel n\'existent pas (ou très peu). Le monde est peuplé de Pokémon, des créatures qui vivent en harmonie avec les humains, mais possèdent des aptitudes quasiment impossibles pour des animaux du monde réel, telles que cracher du feu, comme Dracaufeu, ou encore générer de grandes quantités d\'électricité, comme Magnéti3. Chaque sorteN 2 de Pokémon possède un nom, qui peut à la fois être utilisé pour parler de Pokémon individuels ou de l\'ensemble des Pokémon de la même sorte. dans les jeux récents sont des entités incarnant une puissance naturelle. Dans la série animée, les Pokémon ne peuvent prononcer en règle générale que leur nomN 3, mais il existe quelques cas rares où des Pokémon ont appris un langage humainN 4,4,5. Des humains utilisent ces aptitudes dans leurs activités professionnelles : ainsi les Caninos de l\'Agent Jenny l\'aident à poursuivre les criminels.\r\n\r\nCertains dressent les Pokémon pour organiser des combats entre eux, transportant généralement les Pokémon dans des Poké Balls, des balles compactes où un Pokémon peut être contenu3,6,7. ', -1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `avoir`
--

DROP TABLE IF EXISTS `avoir`;
CREATE TABLE IF NOT EXISTS `avoir` (
  `idUtilisateur` int(11) NOT NULL,
  `idAmi` int(11) NOT NULL,
  PRIMARY KEY (`idUtilisateur`,`idAmi`),
  KEY `FK_lister_idAmi` (`idAmi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `avoir`
--

INSERT INTO `avoir` (`idUtilisateur`, `idAmi`) VALUES
(1, 2),
(1, 3),
(1, 18),
(2, 1),
(3, 1),
(19, 1);

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

DROP TABLE IF EXISTS `club`;
CREATE TABLE IF NOT EXISTS `club` (
  `idClub` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomClub` varchar(32) DEFAULT NULL,
  `DescriptionClub` varchar(255) DEFAULT NULL,
  `Gerant` varchar(32) DEFAULT NULL,
  `ImageClub` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`idClub`),
  UNIQUE KEY `idClub` (`idClub`),
  KEY `fk_gerant` (`Gerant`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `club`
--

INSERT INTO `club` (`idClub`, `nomClub`, `DescriptionClub`, `Gerant`, `ImageClub`) VALUES
(1, 'FanIsekai', '« Isekai » signifie « autre monde », « monde parallèle ». Dans ces histoires, le héros, la plupart du temps un homme banal et sans succès, se retrouve projeté (par exemple après réincarnation ou connexion à un jeu) dans un autre monde.', '2', 'isekai.jpg'),
(2, 'Pocket Monsters', 'Pour tous ceux qui ont une passion pour Pokemon, Rejoignez-nous !\r\nDiscutez avec d\'autres fan du jeu, de l\'animé, du manga et même des jeux de cartes à collectionner.\r\nRejoignez-nous dans la quête pour tous les attraper, GATCHA !!!', '1', 'pokemon.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `idCommentaire` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idUtilisateur` int(11) DEFAULT NULL,
  `idAnime` int(11) DEFAULT NULL,
  `idClub` int(11) DEFAULT NULL,
  `contenu` text,
  `Date` date DEFAULT NULL,
  `Heure` time DEFAULT NULL,
  PRIMARY KEY (`idCommentaire`),
  UNIQUE KEY `idCommentaire` (`idCommentaire`),
  KEY `fk_poster` (`idUtilisateur`) USING BTREE,
  KEY `fk_porter` (`idAnime`) USING BTREE,
  KEY `fk_posterDans` (`idClub`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`idCommentaire`, `idUtilisateur`, `idAnime`, `idClub`, `contenu`, `Date`, `Heure`) VALUES
(101, 1, NULL, 1, 'ezarza', '2021-01-24', '18:17:40'),
(108, 19, 3, NULL, 'Tro bien quand meme', '2021-01-25', '13:12:47'),
(103, 1, 5, NULL, 'aze', '2021-01-25', '13:03:42'),
(110, 19, NULL, 1, ':/', '2021-01-25', '13:13:49'),
(111, 19, NULL, 42, 'C mon club', '2021-01-25', '13:14:56'),
(113, 21, 6, NULL, 'Re', '2021-01-25', '14:34:27'),
(115, 21, NULL, 2, 'Re', '2021-01-25', '14:35:12'),
(116, 21, NULL, 43, 'LE mien', '2021-01-25', '14:35:48');

-- --------------------------------------------------------

--
-- Structure de la table `etre`
--

DROP TABLE IF EXISTS `etre`;
CREATE TABLE IF NOT EXISTS `etre` (
  `idGenre` int(11) NOT NULL,
  `idAnime` int(11) NOT NULL,
  PRIMARY KEY (`idGenre`,`idAnime`),
  KEY `FK_etre_idAnime` (`idAnime`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etre`
--

INSERT INTO `etre` (`idGenre`, `idAnime`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 5),
(1, 6),
(1, 7),
(2, 4),
(2, 6),
(3, 5),
(4, 7);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `idGenre` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `NomGenre` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`idGenre`),
  UNIQUE KEY `idGenre` (`idGenre`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`idGenre`, `NomGenre`) VALUES
(1, 'Shonen'),
(2, 'Seinen'),
(3, 'Isekai'),
(4, 'Kodomo');

-- --------------------------------------------------------

--
-- Structure de la table `liste`
--

DROP TABLE IF EXISTS `liste`;
CREATE TABLE IF NOT EXISTS `liste` (
  `idUtilisateur` int(11) NOT NULL,
  `idAnime` int(11) NOT NULL,
  `Etat` text,
  `note` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUtilisateur`,`idAnime`),
  KEY `FK_liste_idAnime` (`idAnime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `liste`
--

INSERT INTO `liste` (`idUtilisateur`, `idAnime`, `Etat`, `note`) VALUES
(1, 2, NULL, 2),
(1, 4, NULL, 9),
(19, 3, 'Completer', 20),
(2, 3, NULL, 0),
(3, 5, NULL, 14),
(2, 4, NULL, 20),
(2, 1, 'EnCour', 5),
(1, 6, NULL, NULL),
(1, 3, NULL, NULL),
(1, 1, NULL, NULL),
(1, 24, NULL, NULL),
(21, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `idMessage` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idUtilisateur` int(11) NOT NULL,
  `idAmi` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `Date` date NOT NULL,
  `Heure` time NOT NULL,
  PRIMARY KEY (`idMessage`),
  UNIQUE KEY `idMessage` (`idMessage`),
  KEY `fk_poster` (`idUtilisateur`),
  KEY `fk_adresser` (`idAmi`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`idMessage`, `idUtilisateur`, `idAmi`, `contenu`, `Date`, `Heure`) VALUES
(1, 1, 2, 'salut a tous les zamis', '2021-01-21', '12:44:44'),
(27, 2, 1, '??', '2021-01-25', '13:20:14'),
(28, 2, 1, 'Tu prefere Black clover ou Fairy Tail?', '2021-01-25', '13:20:28'),
(29, 1, 2, 'Fairy tail c\'est mieux', '2021-01-25', '13:21:03'),
(30, 1, 2, 'Salut Martin', '2021-01-25', '14:37:48');

-- --------------------------------------------------------

--
-- Structure de la table `possede`
--

DROP TABLE IF EXISTS `possede`;
CREATE TABLE IF NOT EXISTS `possede` (
  `idUtilisateur` int(11) NOT NULL,
  `idClub` int(11) NOT NULL,
  PRIMARY KEY (`idUtilisateur`,`idClub`),
  KEY `FK_possede_idAnime` (`idClub`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `possede`
--

INSERT INTO `possede` (`idUtilisateur`, `idClub`) VALUES
(1, 1),
(1, 2),
(1, 40),
(19, 1),
(19, 42),
(21, 1),
(21, 2),
(21, 43);

-- --------------------------------------------------------

--
-- Structure de la table `signalement`
--

DROP TABLE IF EXISTS `signalement`;
CREATE TABLE IF NOT EXISTS `signalement` (
  `idSignalement` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idUtilisateur` int(11) NOT NULL,
  `idMessage` int(11) NOT NULL,
  `idCommentaire` int(11) NOT NULL,
  `contenu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idSignalement`),
  UNIQUE KEY `idSignalement` (`idSignalement`),
  KEY `fk_auteur` (`idUtilisateur`),
  KEY `fk_porterC` (`idCommentaire`),
  KEY `fk_porterM` (`idMessage`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(32) DEFAULT NULL,
  `mdp` varchar(32) DEFAULT NULL,
  `Email` varchar(32) DEFAULT NULL,
  `PhotoProfil` varchar(32) DEFAULT NULL,
  `Admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idUtilisateur`),
  UNIQUE KEY `idUtilisateur` (`idUtilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `pseudo`, `mdp`, `Email`, `PhotoProfil`, `Admin`) VALUES
(1, 'Ganeche', 'azerty', 'Ganeche@gmail.com', 'calamity-ganon.jpg', 1),
(2, 'Martin', 'test', NULL, 'livai.jpg', 2),
(3, 'MartinV2', 'test', NULL, 'meliodas.jpg', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
