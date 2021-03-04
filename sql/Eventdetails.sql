-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 04. Mrz 2021 um 19:04
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
-- Tabellenstruktur für Tabelle `Eventdetails`
--

CREATE TABLE `Eventdetails` (
  `eid` int(11) NOT NULL,
  `description` varchar(50) COLLATE latin1_german1_ci NOT NULL,
  `startdate` date NOT NULL,
  `starttime` time NOT NULL,
  `enddate` date NOT NULL,
  `endtime` time NOT NULL,
  `contactperson` varchar(20) COLLATE latin1_german1_ci DEFAULT '',
  `contact` varchar(20) COLLATE latin1_german1_ci DEFAULT '',
  `link` varchar(30) COLLATE latin1_german1_ci DEFAULT '',
  `street` varchar(20) COLLATE latin1_german1_ci DEFAULT '',
  `streetnumber` int(11) DEFAULT 0,
  `addition` varchar(2) COLLATE latin1_german1_ci DEFAULT '',
  `postcode` varchar(5) COLLATE latin1_german1_ci DEFAULT '',
  `city` varchar(20) COLLATE latin1_german1_ci DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `Eventdetails`
--
ALTER TABLE `Eventdetails`
  ADD PRIMARY KEY (`eid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
