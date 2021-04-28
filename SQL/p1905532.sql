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
(998, 'winx_sage.jpg', 'The Winx Saga is a teen drama series based on the Nickelodeon animated series Winx Club', 1),
(999, 'lucifer.jpg', 'The series revolves around the story of Lucifer Morningstar (Tom Ellis), the Devil, who abandons Hell for Los Angeles where he runs his own nightclub named LUX and becomes a consultant to the LAPD.', 1);

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
