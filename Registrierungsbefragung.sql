-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 16. Feb 2021 um 22:32
-- Server-Version: 5.5.57-MariaDB
-- PHP-Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Tabellenstruktur für Tabelle `Registrierungsbefragung`
--

CREATE TABLE `Registrierungsbefragung` (
  `bid` int(11) NOT NULL,
  `gradyear` year(4) NOT NULL,
  `course` varchar(5) COLLATE latin1_german1_ci NOT NULL,
  `isSameCompany` tinyint(1) DEFAULT NULL,
  `isDifferentCompany` tinyint(1) DEFAULT NULL,
  `Company` varchar(70) COLLATE latin1_german1_ci DEFAULT NULL,
  `isFreelancer` tinyint(1) DEFAULT NULL,
  `isFederal` tinyint(1) DEFAULT NULL,
  `isFurtherEducation` tinyint(1) DEFAULT NULL,
  `isForeignCountry` tinyint(1) DEFAULT NULL,
  `isWorkSeeking` tinyint(1) DEFAULT NULL,
  `furtherinformation` varchar(100) COLLATE latin1_german1_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `Registrierungsbefragung`
--
ALTER TABLE `Registrierungsbefragung`
  ADD PRIMARY KEY (`bid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `Registrierungsbefragung`
--
ALTER TABLE `Registrierungsbefragung`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
