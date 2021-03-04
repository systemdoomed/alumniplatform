-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 04. Mrz 2021 um 19:10
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
-- Tabellenstruktur für Tabelle `Jahrgang1993_2009`
--

CREATE TABLE `Jahrgang1993_2009` (
  `gradyear` varchar(30) COLLATE latin1_german1_ci DEFAULT '',
  `course` varchar(5) COLLATE latin1_german1_ci DEFAULT '',
  `lastname` varchar(40) COLLATE latin1_german1_ci NOT NULL,
  `firstname` varchar(40) COLLATE latin1_german1_ci NOT NULL,
  `address` varchar(50) COLLATE latin1_german1_ci DEFAULT '',
  `city` varchar(50) COLLATE latin1_german1_ci DEFAULT '',
  `mail` varchar(50) COLLATE latin1_german1_ci DEFAULT '',
  `company` varchar(100) COLLATE latin1_german1_ci DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
