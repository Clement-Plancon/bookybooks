-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 30 avr. 2021 à 18:23
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `booky`
--

-- --------------------------------------------------------

--
-- Structure de la table `achete`
--

DROP TABLE IF EXISTS `achete`;
CREATE TABLE IF NOT EXISTS `achete` (
  `ID_Livre` int(11) NOT NULL,
  `ID_Users` int(11) NOT NULL,
  `Date_achat` date NOT NULL,
  PRIMARY KEY (`ID_Livre`,`ID_Users`),
  KEY `Achete_Users0_FK` (`ID_Users`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

DROP TABLE IF EXISTS `factures`;
CREATE TABLE IF NOT EXISTS `factures` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Achat_Livre` int(11) NOT NULL,
  `Achat_Users` int(11) NOT NULL,
  `facture_titre` varchar(100) NOT NULL,
  `facture_prix` float NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Achat_Livre` (`Achat_Livre`),
  KEY `Achat_Users` (`Achat_Users`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `factures`
--

INSERT INTO `factures` (`ID`, `Achat_Livre`, `Achat_Users`, `facture_titre`, `facture_prix`) VALUES
(97, 2, 7, 'Harry Potter 2', 15),
(98, 3, 7, 'Harry Potter 3', 15),
(99, 9, 7, 'Alice au pays des merveille', 12);

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `ID_Livre` int(11) NOT NULL AUTO_INCREMENT,
  `Titre` varchar(50) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `Prix` float NOT NULL,
  `Quantite` int(11) NOT NULL,
  `Resumer` varchar(2000) NOT NULL,
  `Image` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_Livre`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`ID_Livre`, `Titre`, `categorie`, `Prix`, `Quantite`, `Resumer`, `Image`) VALUES
(1, 'Harry Potter', 'Roman', 12, 1000, 'Harry Potter est un garçon ordinaire. Mais le jour de ses onze ans, son existence bascule : un géant vient le chercher pour l\'emmener dans une école de sorciers. Quel mystère entoure donc sa naissance et qui est l\'effroyable V..., le mage dont personne n\'ose prononcer le nom ? Voler à cheval sur des balais, jeter des sorts, combattre les Trolls : Harry Potter se révèle un sorcier vraiment doué. Quand il décide, avec ses amis, d\'explorer les moindres recoins de son école, il va se trouver entraîné dans d\'extraordinaires aventures.', 'images/HP1.jpg'),
(2, 'Harry Potter 2', 'Roman', 15, 1, 'Harry Potter fait une rentrée fracassante en voiture volante à l\'école des sorciers. Cette deuxième année ne s\'annonce pas de tout repos... surtout depuis qu\'une étrange malédiction s\'est abattue sur les élèves. Entre les cours de potion magique, les matches de Quidditch et les combats de mauvais sorts, Harry trouvera-t-il le temps de percer le mystère de la Chambre des Secrets ?Un livre magique pour sorciers confirmés.', 'images/HP2.jpg'),
(3, 'Harry Potter 3', 'Roman', 15, 52, 'Sirius Black, le dangereux criminel qui s\'est échappé de la forteresse d\'Azkaban, recherche Harry Potter. C\'est donc sous bonne garde que l\'apprenti sorcier fait sa troisième rentrée. Au programme : des cours de divination, la fabrication d\'une potion de ratatinage, le dressage des hippogriffes... Mais Harry est-il vraiment à l\'abri du danger qui le menace ?Un livre époustouflant qui vous emportera dans un tourbillon de surprises et d\'émotions.', 'images/HP3.jpg'),
(4, 'Harry Potter 4', 'Roman', 12, 1, 'Après un horrible été chez les Dursley, Harry Potter entre en quatrième année au collège de Poudlard. À quatorze ans, il voudrait simplement être un jeune sorcier comme les autres, retrouver ses amis Ron et Hermione, assister avec eux à la Coupe du Monde de Quidditch, apprendre de nouveaux sortilèges et essayer des potions inconnues. Une grande nouvelle l\'attend à son arrivée : la tenue à Poudlard d\'un tournoi de magie entre les plus célèbres écoles de sorcellerie. Déjà les spectaculaires délégations étrangères font leur entrée... Harry se réjouit. Trop vite. Il va se trouver plongé au coeur des événements les plus dramatiques qu\'il ait jamais eu à affronter.Envoûtant, drôle, bouleversant, ce quatrième tome est le pilier central des aventures de Harry Potter.', 'images/HP4.jpg'),
(5, 'Harry Potter 5', 'Roman', 12, 0, 'À quinze ans, Harry s\'apprête à entrer en cinquième année à Poudlard. Et s\'il est heureux de retrouver le monde des sorciers, il n\'a jamais été aussi anxieux. L\'adolescence, la perspective des examens importants en fin d\'année et ces étranges cauchemars... Car Celui-Dont-On-Ne-Doit-Pas-Prononcer-Le-Nom est de retour et, plus que jamais, Harry sent peser sur lui une terrible menace. Une menace que le ministère de la Magie ne semble pas prendre au sérieux, contrairement à Dumbledore. Poudlard devient alors le terrain d\'une véritable lutte de pouvoir. La résistance s\'organise autour de Harry qui va devoir compter sur le courage et la fidélité de ses amis de toujours...D\'une inventivité et d\'une virtuosité rares, découvrez le cinquième tome de cette saga que son auteur a su hisser au rang de véritable phénomène littéraire.', 'images/HP5.jpg'),
(6, 'Harry Potter 6', 'Roman', 12, 20, '\r\nDans un monde de plus en plus inquiétant, Harry se prépare à retrouver Ron et Hermione. Bientôt, ce sera la rentrée à Poudlard, avec les autres étudiants de sixième année. Mais pourquoi Dumbledore vient-il en personne chercher Harry chez les Dursley ? Dans quels extraordinaires voyages au coeur de la mémoire va-t-il l\'entraîner ?', 'images/HP6.jpg'),
(7, 'Harry Potter 7', 'Roman', 12, 30, 'Cette année, Harry a dix-sept ans et ne retourne pas à Poudlard. Avec Ron et Hermione, il se consacre à la dernière mission confiée par Dumbledore. Mais le Seigneur des Ténèbres règne en maître. Traqués, les trois fidèles amis sont contraints à la clandestinité. D\'épreuves en révélations, le courage, les choix et les sacrifices de Harry seront déterminants dans la lutte contre les forces du Mal.', 'images/HP7.jpg'),
(8, 'L\'Attaque des Titans tome 1', 'Manga', 6.95, 21, 'Le monde appartient désormais aux Titans, des êtres gigantesques qui ont presque décimé l’Humanité. Voilà une centaine d’années, les derniers rescapés ont bâti une place forte, une cité cernée d’une haute muraille au sein de laquelle vivent aujourd’hui leurs descendants. Parqués, ignorants tout du monde extérieur, ils s’estiment au moins à l’abri de ces effroyables êtres qui ne feraient d’eux qu’une bouchée. Hélas, cette illusion de sécurité vole en éclats le jour où surgit un Titan démesuré, encore bien plus colossal que tous les autres. S’engage alors un combat désespéré pour la survie du genre humain..', 'images/SNK1.jpg'),
(9, 'Alice au pays des merveille', 'conte', 12, 9, 'Cette exceptionnelle édition anniversaire immerge son lecteur au coeur d\'un univers pétri de références satiriques, magiquement illustré par Benjamin Lacombe.Les Aventures d\'Alice au pays des merveilles (titre original : Alice\'s Adventures in Wonderland), fréquemment abrégé en Alice au pays des merveilles, est un roman écrit en 1865 par Lewis Carroll (nom de plume de Charles Lutwidge Dodgson).à l\'heure de commémorer les 150 ans du roman, cette très belle édition inédite, traduite par Henri Parisot, propose une immersion singulière : au fil du récit, les images s\'imprègnent d\'une envoûtante fantaisie baroque. Grâce à différentes techniques (gouache, huile et aquarelle), Benjamin Lacombe auteur phare de la nouvelle illustration française offre une dimension graphique surréaliste et subversive à un grand classique de la littérature anglaise.', 'images/ALICE.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `ID_Note` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Livre` int(11) NOT NULL,
  `ID_Users` int(11) NOT NULL,
  `Etoile` int(11) NOT NULL,
  `Com` varchar(1000) NOT NULL,
  PRIMARY KEY (`ID_Note`),
  KEY `lol` (`ID_Livre`),
  KEY `baba` (`ID_Users`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`ID_Note`, `ID_Livre`, `ID_Users`, `Etoile`, `Com`) VALUES
(19, 2, 16, 5, 'Merci pour ça'),
(20, 9, 16, 5, 'J\'aime bien se livre il est cool'),
(21, 3, 16, 5, 'Clement est vraiment pas cool'),
(22, 1, 7, 1, 'nul'),
(23, 1, 7, 2, 'bof'),
(24, 1, 7, 1, 'Nul'),
(25, 3, 7, 4, 'Je mange du chocolat'),
(26, 2, 7, 5, 'AAA\r\n'),
(27, 2, 7, 5, 'AAAAA'),
(28, 2, 7, 5, 'AAAAA'),
(29, 2, 7, 5, 'AAAAA'),
(30, 2, 7, 5, 'AAAAA'),
(31, 2, 7, 5, 'AAAA'),
(32, 4, 7, 5, 'azertyuio'),
(33, 3, 7, 1, 'nul');

-- --------------------------------------------------------

--
-- Structure de la table `paniers`
--

DROP TABLE IF EXISTS `paniers`;
CREATE TABLE IF NOT EXISTS `paniers` (
  `ID_Panier` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Livre` int(100) NOT NULL,
  `ID_Users` int(100) NOT NULL,
  `Panier_Titre` varchar(100) NOT NULL,
  `Prix_livre` float NOT NULL,
  PRIMARY KEY (`ID_Panier`),
  KEY `Chocolat` (`ID_Users`),
  KEY `boubou` (`ID_Livre`)
) ENGINE=InnoDB AUTO_INCREMENT=1270 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL,
  `motdepasse` varchar(500) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `Telephone` varchar(20) DEFAULT NULL,
  `Ville` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `motdepasse`, `mail`, `adresse`, `Telephone`, `Ville`) VALUES
(7, 'CLEMENT', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'a@a.com', '91 rue de mon boule', '0621836024', 'Paris'),
(16, 'Binout', '395df8f7c51f007019cb30201c49e884b46b92fa', 'z@z.com', '7 rue de sevigné', '0678910111', 'Paris'),
(17, 'z', '395df8f7c51f007019cb30201c49e884b46b92fa', 'zz@z.com', 'a', 'a', 'a'),
(18, 'z', '395df8f7c51f007019cb30201c49e884b46b92fa', 'ze@z.com', ' ', ' ', ' '),
(19, 'q', '22ea1c649c82946aa6e479e1ffd321e4a318b1b0', 'q@q.com', NULL, NULL, NULL),
(20, 'a', '602c57ffb51af99d6f3b54c0ee9587bb110fb990', 'l@l.com', NULL, NULL, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achete`
--
ALTER TABLE `achete`
  ADD CONSTRAINT `Achete_Livre_FK` FOREIGN KEY (`ID_Livre`) REFERENCES `livre` (`ID_Livre`),
  ADD CONSTRAINT `Achete_Users0_FK` FOREIGN KEY (`ID_Users`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `factures`
--
ALTER TABLE `factures`
  ADD CONSTRAINT `factures_ibfk_1` FOREIGN KEY (`Achat_Livre`) REFERENCES `livre` (`ID_Livre`),
  ADD CONSTRAINT `factures_ibfk_2` FOREIGN KEY (`Achat_Users`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`ID_Livre`) REFERENCES `livre` (`ID_Livre`),
  ADD CONSTRAINT `note_ibfk_2` FOREIGN KEY (`ID_Users`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `paniers`
--
ALTER TABLE `paniers`
  ADD CONSTRAINT `paniers_ibfk_1` FOREIGN KEY (`ID_Users`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `paniers_ibfk_2` FOREIGN KEY (`ID_Livre`) REFERENCES `livre` (`ID_Livre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
