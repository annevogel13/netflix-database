-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 07 mai 2021 à 13:26
-- Version du serveur :  10.3.25-MariaDB-0ubuntu0.20.04.1-log
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `p1905532`
--

-- --------------------------------------------------------

--
-- Structure de la table `Categorie`
--

CREATE TABLE `Categorie` (
  `catId` int(11) NOT NULL,
  `nomCat` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Categorie`
--

INSERT INTO `Categorie` (`catId`, `nomCat`) VALUES
(1, 'fantasy'),
(2, 'comedy'),
(3, 'dramas');

-- --------------------------------------------------------

--
-- Structure de la table `Photo`
--

CREATE TABLE `Photo` (
  `photoId` int(11) NOT NULL,
  `nomFich` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `catId` int(11) NOT NULL,
  `utId` varchar(250) NOT NULL,
  `cacher` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Photo`
--

INSERT INTO `Photo` (`photoId`, `nomFich`, `description`, `catId`, `utId`, `cacher`) VALUES
(989, 'Elite.jpg', 'Lorsque trois ados issus de la classe ouvrière accèdent à une école élitiste d Espagne, le fossé qui les sépare des élèves fortunés conduit à la pire des tragédies.', 3, 'p19055555', 0),
(990, '13_RW.jpg', 'Le jeune Clay Jensen se retrouve au centre d une série de secrets déchirants qui prennent un tour tragique après le suicide d une camarade de classe.', 3, 'p19055555', 0),
(991, 'The_Good_Place.jpg', 'À sa mort, l égocentrique Eleanor Shellstrop se retrouve par erreur dans un monde paradisiaque. Déterminée à y rester, elle va tenter de devenir une meilleure personne.', 1, 'p19055555', 0),
(992, 'Riverdale.jpg', 'Naviguant dans les eaux troubles du sexe, de l amour, de l éducation et de la famille, Archie et ses amis se retrouvent plongés au cœur d une mystérieuse affaire.', 1, 'p19055555', 0),
(993, 'How_i_met.jpg', 'Ted Mosby raconte à ses enfants la suite d événements qui l a conduit à rencontrer leur mère. Entouré de sa bande d amis, il a vécu bon nombre de situations comiques au cours de sa recherche du grand amour.', 2, 'AnneVogel', 0),
(994, 'Sweet_Magnolias.jpg', 'Amies depuis toujours, Maddie, Helen et Dana Sue s épaulent alors qu elles essaient de concilier couple, famille et carrière dans une petite ville du Sud des États-Unis.', 2, 'AnneVogel', 0),
(995, 'Emily_in_Paris.jpg', 'Quand elle décroche le boulot de ses rêves à Paris, Emily, jeune cadre ambitieuse de Chicago, adopte une nouvelle vie tout en jonglant entre marketing, amis et amours.', 2, 'AnneVogel', 0),
(996, 'Gilmore_Girls.jpg', 'Lorelai, mère célibataire très indépendante et pleine d esprit, élève sa fille surdouée Rory pour la faire entrer dans l une des meilleures universités.', 2, 'p19055555', 0),
(997, 'Friends.jpg', 'Les aventures de six amis à New York. Entre amour, travail et famille, Monica, Rachel, Ross, Phoebe, Joey et Chandler aiment se retrouver pour partager leurs bonheurs, leurs soucis et se raconter leurs péripéties au Central Perk, leur café favori.', 2, 'p19055555', 0),
(998, 'winx_sage.jpg', 'À Alféa, un internat magique, des amies déterminées à maîtriser leurs pouvoirs poursuivent leurs études sur le surnaturel tout en découvrant les rivalités et l amour.', 1, 'p19055555', 0),
(999, 'lucifer.jpg', 'Lassé d’être le Seigneur des Enfers, le diable s’installe à Los Angeles où il ouvre un nightclub et se lie avec une policière de la brigade criminelle.', 1, 'p19055555', 0);

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `utId` varchar(250) NOT NULL,
  `utMdP` varchar(250) NOT NULL,
  `utAdmin` varchar(250) NOT NULL,
  `etat` varchar(250) DEFAULT 'disconnected'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`utId`, `utMdP`, `utAdmin`, `etat`) VALUES
('admin', '098f6bcd4621d373cade4e832627b4f6', 'admin', 'disconnected'),
('AnneVogel', 'd3286536b5aea9770946af0a83f71020', 'utilisateur', 'disconnected'),
('Merel', '2f3722a9dbcd14dc32262d0c239102f8', 'utilisateur', 'disconnected'),
('p19055555', '4d2606237ea94965b5405c99863da39a', 'utilisateur', 'disconnected'),
('p1906670', '0dd61563d932e44612d95845b0d68ccb', 'utilisateur', 'disconnected');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Categorie`
--
ALTER TABLE `Categorie`
  ADD PRIMARY KEY (`catId`);

--
-- Index pour la table `Photo`
--
ALTER TABLE `Photo`
  ADD PRIMARY KEY (`photoId`),
  ADD KEY `catId` (`catId`),
  ADD KEY `utId` (`utId`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`utId`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Photo`
--
ALTER TABLE `Photo`
  ADD CONSTRAINT `Photo_ibfk_1` FOREIGN KEY (`catId`) REFERENCES `Categorie` (`catId`),
  ADD CONSTRAINT `Photo_ibfk_2` FOREIGN KEY (`utId`) REFERENCES `Utilisateur` (`utId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
