-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 03. Mrz 2021 um 17:01
-- Server-Version: 10.4.17-MariaDB
-- PHP-Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `AlumniDatenbank`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Statenames`
--

CREATE TABLE `Statenames` (
  `stateID` int(11) NOT NULL,
  `shortName` varchar(15) COLLATE latin1_german1_ci NOT NULL,
  `showname` varchar(100) COLLATE latin1_german1_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Daten für Tabelle `Statenames`
--

INSERT INTO `Statenames` (`stateID`, `shortName`, `showname`) VALUES
(0, 'alt', 'Daten aus Excelliste'),
(1, 'unverified', 'Nicht verifizierte Nutzer'),
(2, 'verified', 'Verifizierte Nutzer'),
(3, 'admin', 'Dieser Nutzer ist Administrator');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `Statenames`
--
ALTER TABLE `Statenames`
  ADD PRIMARY KEY (`stateID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
