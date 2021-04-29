-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 28 apr 2021 om 20:16
-- Serverversie: 10.3.25-MariaDB-0ubuntu0.20.04.1-log
-- PHP-versie: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `p1905532`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Categorie`
--

CREATE TABLE `Categorie` (
  `catId` int(11) NOT NULL,
  `nomCat` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `Categorie`
--

INSERT INTO `Categorie` (`catId`, `nomCat`) VALUES
(1, 'fantasy'),
(2, 'comedy'),
(3, 'dramas');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Photo`
--

CREATE TABLE `Photo` (
  `photoId` int(11) NOT NULL,
  `nomFich` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `catId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `Photo`
--

INSERT INTO `Photo` (`photoId`, `nomFich`, `description`, `catId`) VALUES
(985, 'La_Casa_de_Papel.jpg', 'Huit voleurs font une prise d otages dans la Maison royale de la Monnaie d Espagne, tandis qu un génie du crime manipule la police pour mettre son plan à exécution.', 3),
(986, 'Outer_Banks.jpg', 'Sur une île où les inégalités sont accentuées, John B recrute ses trois meilleurs amis pour partir à la recherche d un trésor légendaire lié à la disparition de son père.', 3),
(987, 'Lupin.jpg', 'Inspiré par les aventures d Arsène Lupin, le gentleman cambrioleur Assane Diop décide de venger son père d une terrible injustice.', 3),
(988, 'Gossip_Girl.jpg','La vie, les amours et les malheurs d un groupe d étudiants privilégiés appartenant aux sphères huppées de l Upper East Side, à Manhattan. Deux inséparables amies Blair et Serena et leurs amis, vivent au rythme des commentaires de la mystérieuse Gossip Girl, qui colporte les derniers potins sur son blog.', 3),
(989, 'Elite.jpg', 'Lorsque trois ados issus de la classe ouvrière accèdent à une école élitiste d Espagne, le fossé qui les sépare des élèves fortunés conduit à la pire des tragédies.', 3),
(990, '13_RW.jpg', 'Le jeune Clay Jensen se retrouve au centre d une série de secrets déchirants qui prennent un tour tragique après le suicide d une camarade de classe.', 3),
(991, 'The_Good_Place.jpg', 'À sa mort, l égocentrique Eleanor Shellstrop se retrouve par erreur dans un monde paradisiaque. Déterminée à y rester, elle va tenter de devenir une meilleure personne.', 1),
(992, 'Riverdale.jpg', 'Naviguant dans les eaux troubles du sexe, de l amour, de l éducation et de la famille, Archie et ses amis se retrouvent plongés au cœur d une mystérieuse affaire.', 1),
(993, 'How_i_met.jpg', 'Ted Mosby raconte à ses enfants la suite d événements qui l a conduit à rencontrer leur mère. Entouré de sa bande d amis, il a vécu bon nombre de situations comiques au cours de sa recherche du grand amour.', 2),
(994, 'Sweet_Magnolias.jpg', 'Amies depuis toujours, Maddie, Helen et Dana Sue s épaulent alors qu elles essaient de concilier couple, famille et carrière dans une petite ville du Sud des États-Unis.', 2),
(995, 'Emily_in_Paris.jpg', 'Quand elle décroche le boulot de ses rêves à Paris, Emily, jeune cadre ambitieuse de Chicago, adopte une nouvelle vie tout en jonglant entre marketing, amis et amours.', 2),
(996, 'Gilmore_Girls.jpg', 'Lorelai, mère célibataire très indépendante et pleine d esprit, élève sa fille surdouée Rory pour la faire entrer dans l une des meilleures universités.', 2),
(997, 'Friends.jpg', 'Les aventures de six amis à New York. Entre amour, travail et famille, Monica, Rachel, Ross, Phoebe, Joey et Chandler aiment se retrouver pour partager leurs bonheurs, leurs soucis et se raconter leurs péripéties au Central Perk, leur café favori.', 2),
(998, 'winx_sage.jpg', 'À Alféa, un internat magique, des amies déterminées à maîtriser leurs pouvoirs poursuivent leurs études sur le surnaturel tout en découvrant les rivalités et l amour.', 1),
(999, 'lucifer.jpg', 'Lassé d’être le Seigneur des Enfers, le diable s’installe à Los Angeles où il ouvre un nightclub et se lie avec une policière de la brigade criminelle.', 1);


--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `Categorie`
--
ALTER TABLE `Categorie`
  ADD PRIMARY KEY (`catId`);

--
-- Indexen voor tabel `Photo`
--
ALTER TABLE `Photo`
  ADD PRIMARY KEY (`photoId`),
  ADD KEY `catId` (`catId`);

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `Photo`
--
ALTER TABLE `Photo`
  ADD CONSTRAINT `Photo_ibfk_1` FOREIGN KEY (`catId`) REFERENCES `Categorie` (`catId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
