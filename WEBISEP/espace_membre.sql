-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 13 juin 2019 à 01:03
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `espace_membre`
--

-- --------------------------------------------------------

--
-- Structure de la table `billet`
--

DROP TABLE IF EXISTS `billet`;
CREATE TABLE IF NOT EXISTS `billet` (
  `id_billet` int(11) NOT NULL AUTO_INCREMENT,
  `titre` text NOT NULL,
  `date_billet` datetime NOT NULL,
  `author` text NOT NULL,
  `Question` text NOT NULL,
  PRIMARY KEY (`id_billet`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `billet`
--

INSERT INTO `billet` (`id_billet`, `titre`, `date_billet`, `author`, `Question`) VALUES
(1, 'Problème', '2019-05-14 00:00:00', 'hugo', 'Question ?'),
(2, 'Problème 2', '2019-05-14 10:23:27', 'hugo', 'Question 2 ?'),
(4, 'Capteur défectueux', '2019-05-14 10:34:36', 'moi', 'Le capteur de luminosité ne fonctionne pas correctement et mes lumières clignotent');

-- --------------------------------------------------------

--
-- Structure de la table `captor`
--

DROP TABLE IF EXISTS `captor`;
CREATE TABLE IF NOT EXISTS `captor` (
  `CaptorID` int(11) NOT NULL AUTO_INCREMENT,
  `CaptorName` text COLLATE utf8_unicode_520_ci NOT NULL,
  `RoomID` int(11) NOT NULL,
  `CaptorType` text COLLATE utf8_unicode_520_ci NOT NULL,
  PRIMARY KEY (`CaptorID`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Déchargement des données de la table `captor`
--

INSERT INTO `captor` (`CaptorID`, `CaptorName`, `RoomID`, `CaptorType`) VALUES
(3, 'Temp1', 40, 'TEMP'),
(5, 'Lum1', 40, 'LUM'),
(1, 'Mouv1', 42, 'MOUV');

-- --------------------------------------------------------

--
-- Structure de la table `catalogue`
--

DROP TABLE IF EXISTS `catalogue`;
CREATE TABLE IF NOT EXISTS `catalogue` (
  `CatID` int(11) NOT NULL AUTO_INCREMENT,
  `CatName` text CHARACTER SET latin1 NOT NULL,
  `CatDesc` text CHARACTER SET latin1 NOT NULL,
  `CatPrice` text COLLATE utf8_unicode_520_ci NOT NULL,
  `CatImage` text CHARACTER SET latin1,
  `CatWeight` text COLLATE utf8_unicode_520_ci NOT NULL,
  `CatType` text COLLATE utf8_unicode_520_ci NOT NULL,
  PRIMARY KEY (`CatID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Déchargement des données de la table `catalogue`
--

INSERT INTO `catalogue` (`CatID`, `CatName`, `CatDesc`, `CatPrice`, `CatImage`, `CatWeight`, `CatType`) VALUES
(1, 'capteur de mouvement', 'Ce capteur de mouvement est un capteur infrarouge passif d\'une portée de 10 m et d\'angle de vue de 102 degrés. Il est parfaitement adapté pour surveiller une maison.', '10', 'capteur_mouvement.jpg', '349', 'MOUV'),
(2, 'capteur de fumée', 'capteur classique qui détecte la fumée en cas d\'incendie.', '7', 'capteur_fumee.jpg', '210', 'FUM'),
(4, 'capteur de luminosité', 'détecte la lumière', '3', 'capteur_luminosite.jpg', '16', 'LUM'),
(3, 'Capteur de température', 'Détecte la température de -55 à 150°C.', '6', NULL, '7', 'TEMP');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'capteur'),
(2, 'connexion'),
(3, 'Autre catégorie');

-- --------------------------------------------------------

--
-- Structure de la table `classements`
--

DROP TABLE IF EXISTS `classements`;
CREATE TABLE IF NOT EXISTS `classements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idAnnonce` int(11) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `classements`
--

INSERT INTO `classements` (`id`, `idAnnonce`, `idCategorie`) VALUES
(1, 1, 3),
(2, 1, 5),
(3, 2, 1),
(4, 2, 3),
(5, 3, 2),
(6, 4, 3),
(7, 5, 4),
(8, 4, 1),
(9, 4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `dbstatistique`
--

DROP TABLE IF EXISTS `dbstatistique`;
CREATE TABLE IF NOT EXISTS `dbstatistique` (
  `id_stat` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `temperature` double DEFAULT NULL,
  `humite` double DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_stat`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dbstatistique`
--

INSERT INTO `dbstatistique` (`id_stat`, `date`, `temperature`, `humite`, `id_client`) VALUES
(1, '2019-01-01', 15, 45, 35),
(2, '2019-02-01', 17, 55, 35),
(3, '2019-03-01', 19, 48, 35),
(4, '2019-04-01', 18, 56, 35),
(5, '2019-05-01', 14, 67, 35),
(6, '2019-06-01', 17, 44, 35),
(7, '2019-07-01', 13, 34, 35),
(8, '2019-08-01', 19, 45, 35),
(9, '2019-09-01', 10, 23, 35),
(10, '2019-10-01', 6, 35, 35),
(11, '2019-11-01', 4, 45, 35),
(12, '2019-12-01', 2, 67, 35),
(13, '2019-01-13', 6, 46, 35),
(14, '2019-04-01', 35, 75, 35),
(15, '2019-05-02', 38, 84, 35),
(16, '2019-07-03', 2, 39, 35),
(17, '2019-08-04', 36, 27, 35),
(18, '2019-09-05', 27, 36, 35),
(19, '2019-06-06', 6, 67, 35),
(20, '2019-02-07', 63, 40, 35),
(21, '2019-02-08', 37, 29, 35),
(22, '2019-03-09', 26, 19, 35),
(23, '2019-02-10', 17, 74, 35),
(24, '2019-02-11', 30, 89, 35),
(25, '2019-02-12', 37, 54, 35),
(26, '2019-02-13', 26, 45, 34);

-- --------------------------------------------------------

--
-- Structure de la table `house`
--

DROP TABLE IF EXISTS `house`;
CREATE TABLE IF NOT EXISTS `house` (
  `HouseID` int(11) NOT NULL AUTO_INCREMENT,
  `HouseName` varchar(256) NOT NULL,
  `MemberID` int(11) DEFAULT NULL,
  `HouseAddress` varchar(256) DEFAULT NULL,
  `HousePostal` varchar(256) DEFAULT NULL,
  `HouseTown` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`HouseID`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `house`
--

INSERT INTO `house` (`HouseID`, `HouseName`, `MemberID`, `HouseAddress`, `HousePostal`, `HouseTown`) VALUES
(12, 'Exemple', 35, '10 rue Béta', '75000', 'Paris');

-- --------------------------------------------------------

--
-- Structure de la table `lamp`
--

DROP TABLE IF EXISTS `lamp`;
CREATE TABLE IF NOT EXISTS `lamp` (
  `LampID` int(11) NOT NULL AUTO_INCREMENT,
  `LampCondition` tinyint(1) DEFAULT '0',
  `LampName` varchar(256) DEFAULT NULL,
  `RoomID` int(11) DEFAULT NULL,
  PRIMARY KEY (`LampID`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lamp`
--

INSERT INTO `lamp` (`LampID`, `LampCondition`, `LampName`, `RoomID`) VALUES
(75, 0, 'Led Rouge', 40),
(62, 1, 'Led Bleu', 42);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `motdepasse` text NOT NULL,
  `confirmkey` varchar(255) NOT NULL,
  `confirme` int(1) NOT NULL DEFAULT '0',
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` text NOT NULL,
  `codepostal` int(11) NOT NULL,
  `ville` text NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0',
  `fav` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=181 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id`, `pseudo`, `mail`, `motdepasse`, `confirmkey`, `confirme`, `nom`, `prenom`, `adresse`, `codepostal`, `ville`, `admin`, `fav`) VALUES
(44, 'MinhNam', 'nguyen.minhnam@hotmail.fr', 'ea5ebd81330306c1bbf4b7f5607b7901411ff198', '12765221631289', 1, 'Nguyen', 'Minh', '5 rue du 14 juillet 1789', 78280, 'Guyancourt', 0, 14),
(34, 'hugo', 'hugo.gh@gmail.com', '782dd27ea8e3b4f4095ffa38eeb4d20b59069077', '87991336415118', 1, 'Ghesquiere', 'hugo', '28 Rue Notre Dame des Champs', 75006, 'Paris', 1, 9),
(35, 'moi', 'test@exemple.com', '782dd27ea8e3b4f4095ffa38eeb4d20b59069077', '15212935311390', 1, 'Démo', 'Test', '10 Rue Béta', 75000, 'Paris', 0, 12);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_message` datetime DEFAULT NULL,
  `reponse` text NOT NULL,
  `pseudo` text NOT NULL,
  `id_topic` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `date_message`, `reponse`, `pseudo`, `id_topic`) VALUES
(1, '2018-12-20 09:10:25', 'Tu peux essayer de le renvoyer si vrm il marche plus...', 'charlie', 1),
(2, '2018-12-20 12:23:00', 'Vérifie le niveau de batterie avant.', 'charlie', 1),
(4, '2018-12-21 10:27:07', 'maintenant c\'est bon', 'hugo', 1),
(8, '2018-12-21 16:48:39', 'on essaie voir si Ã§a passe Ã  la ligne avec cette longue phrase. Ã§a veut dire qu\'il faut Ã©crire beacoup pour pas grand chose.............................................................flemme ', 'Minh', 3),
(9, '2018-12-21 16:49:52', ' on essaie voir si Ã§a passe Ã  la ligne avec cette longue phrase. Ã§a veut dire qu\'il faut Ã©crire beacoup pour pas grand chose.............................................................flemme ', 'Minh', 3),
(20, '2018-12-24 16:32:42', 'Bonjour Marie,\r\n\r\nDonnez nous plus de détail sur votre problème svp .', 'freddy', 33),
(12, '2018-12-22 10:12:44', 'redirection ?', 'ok', 10),
(13, '2018-12-22 10:12:54', 'ca marche', 'c\'est bon', 10),
(14, '2018-12-22 10:27:12', 'Bonsoir,', '', 1),
(15, '2018-12-22 10:28:57', 'Bonsoir,\r\nJe crois que la mise en page fonctionne plutôt bien. Voyez par vous même.', 'yeees', 1),
(21, '2018-12-24 16:33:50', 'Je n\'ai plus mon mot de passe...', 'Marie', 33),
(22, '2018-12-26 19:56:07', 'test session\r\n', 'hugo', 1),
(23, '2018-12-26 21:05:55', 'ok', 'hugo', 1),
(26, '2019-01-14 11:00:21', 'Manges le ', 'hugo', 4);

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

DROP TABLE IF EXISTS `messagerie`;
CREATE TABLE IF NOT EXISTS `messagerie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_message` datetime DEFAULT NULL,
  `reponse` text NOT NULL,
  `pseudo` text NOT NULL,
  `id_billet` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `messagerie`
--

INSERT INTO `messagerie` (`id`, `date_message`, `reponse`, `pseudo`, `id_billet`) VALUES
(1, '2019-05-13 00:00:00', 'détails du problème', 'hugo', 1),
(2, '2019-05-14 00:00:01', 'reponse', 'hugo', 4);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `Question` longtext NOT NULL,
  `Reponse` longtext NOT NULL,
  `Date_publication` date DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`ID`, `Question`, `Reponse`, `Date_publication`) VALUES
(1, 'Comment ajouter un capteur ?', 'Pour ajouter un capteur allez dans l\'onglet profil et appuyer sur \'ajouter capteur\'.', '2018-11-20'),
(2, 'Mot de passe oublié', ' Appuyer sur \'mot de passe oublié\'; nous vous envoyons un mail.', '2018-11-18'),
(3, 'Quelle application télécharger pour contrôler ses capteurs à distance ?', 'L\'application domisep est disponible sur Android (à  partir de android 4) comme sur iOS.', '2018-11-17'),
(4, 'l\'application fonctionne t-elle sans connexion internet ?', 'Non malheureusement une connexion internet est nécessaire. ', '2018-11-17'),
(6, 'La lumière ne s\'allume plus. Comment faire?', 'Le problème peut venir de l\'ampoule : vérifier que celle-ci est fonctionnelle.\r\n    Si le problÃ¨me persiste, changer l\'ampoule.', '2018-10-23'),
(7, 'Je ne sais pas quels capteurs choisir ni où les placer...', 'Contactez nous via la page \'Nous contacter\' et nous vous conseillerons dans les plus brefs dÃ©lais.', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `recuperation`
--

DROP TABLE IF EXISTS `recuperation`;
CREATE TABLE IF NOT EXISTS `recuperation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) NOT NULL,
  `code` int(11) NOT NULL,
  `confirme` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `recuperation`
--

INSERT INTO `recuperation` (`id`, `mail`, `code`, `confirme`) VALUES
(1, 'hugo.gh@gmail.com', 20489932, 1);

-- --------------------------------------------------------

--
-- Structure de la table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `RoomID` int(11) NOT NULL AUTO_INCREMENT,
  `RoomName` varchar(256) NOT NULL,
  `RoomTempState` int(11) NOT NULL DEFAULT '0',
  `RoomTempReq` int(11) DEFAULT NULL,
  `RoomTemp` int(11) DEFAULT NULL,
  `HouseID` int(11) DEFAULT NULL,
  `MemberID` int(11) DEFAULT NULL,
  PRIMARY KEY (`RoomID`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `room`
--

INSERT INTO `room` (`RoomID`, `RoomName`, `RoomTempState`, `RoomTempReq`, `RoomTemp`, `HouseID`, `MemberID`) VALUES
(1, 'Chambres Parents', 1, 0, 18, 1, 34),
(2, 'Chambres Enfants', 0, 0, 20, 1, 34),
(5, 'Salle de Bain Enfants', 0, 0, NULL, 9, 34),
(6, 'Séjour', 0, 0, 20, 9, 34),
(7, 'Bureau', 0, 0, NULL, 0, 0),
(8, 'Toilette', 0, 0, NULL, 0, 0),
(9, 'Buanderie', 0, 0, NULL, 0, 0),
(10, 'Hall', 0, 0, NULL, 0, 0),
(40, 'Studio', 1, 30, 4, 12, 35),
(42, 'Salle de bain', 0, NULL, NULL, 12, 35);

-- --------------------------------------------------------

--
-- Structure de la table `topic`
--

DROP TABLE IF EXISTS `topic`;
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int(11) NOT NULL AUTO_INCREMENT,
  `titre` text NOT NULL,
  `date_topic` datetime NOT NULL,
  `author` text NOT NULL,
  `nbrMessage` int(11) DEFAULT NULL,
  `pseudo_dernier` text,
  `id_categorie` int(11) NOT NULL,
  `Question` text NOT NULL,
  PRIMARY KEY (`id_topic`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `topic`
--

INSERT INTO `topic` (`id_topic`, `titre`, `date_topic`, `author`, `nbrMessage`, `pseudo_dernier`, `id_categorie`, `Question`) VALUES
(1, 'pb pour connecter mon capteur', '2018-12-26 00:00:00', 'moi', 1, 'Kev', 1, 'comment faire pour reconnecter un capteur?'),
(2, 'Problème de connexion', '2018-12-12 18:39:48', 'marie', 0, 'zaer', 2, 'Je n\'arrive plus à me connecter.... J\'ai besoin d\'aide svp.'),
(3, 'capteur de lumière', '2018-12-02 12:23:00', 'zooma', 0, 'zerty', 1, 'Bonjour,\r\nComment faire pour faire un pré-réglage sur l\'application?'),
(4, 'mon chien déclanche l\'alarme...', '2018-12-21 21:09:28', 'Patrick', NULL, NULL, 1, 'J\'ai un souci car mon chien déclenche souvent l\'alarme, auriez vous des conseils?'),
(5, 'on teste la redircetion', '2018-12-22 09:59:12', 'ee', NULL, NULL, 4, 'ca marche ?'),
(7, 'Je n\'arrive pas à me connecter', '2018-12-24 16:28:48', 'Marie', NULL, NULL, 2, 'Depuis quelques jours je ne peux plus me connecter... '),
(9, 'avec session', '2018-12-26 18:27:48', 'hugo', NULL, NULL, 2, 'ouais'),
(12, 'heure local', '2018-12-26 21:08:44', 'hugo', NULL, NULL, 5, 'et en plus c\'est à l\'heure 21h08');

-- --------------------------------------------------------

--
-- Structure de la table `window`
--

DROP TABLE IF EXISTS `window`;
CREATE TABLE IF NOT EXISTS `window` (
  `WindowID` int(11) NOT NULL AUTO_INCREMENT,
  `WindowCondition` tinyint(1) DEFAULT '0',
  `WindowName` varchar(256) DEFAULT NULL,
  `RoomID` int(11) DEFAULT NULL,
  PRIMARY KEY (`WindowID`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `window`
--

INSERT INTO `window` (`WindowID`, `WindowCondition`, `WindowName`, `RoomID`) VALUES
(52, 0, 'Store', 40);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
