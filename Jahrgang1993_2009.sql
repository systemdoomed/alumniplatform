-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 16. Feb 2021 um 00:58
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

--
-- Daten für Tabelle `Jahrgang1993_2009`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
