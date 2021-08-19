-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 19. Aug 2021 um 18:15
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
-- Tabellenstruktur für Tabelle `Jahrgang2010_2016`
--

CREATE TABLE `Jahrgang2010_2016` (
  `matrikel` varchar(10) COLLATE latin1_german1_ci NOT NULL,
  `course` varchar(10) COLLATE latin1_german1_ci NOT NULL,
  `lastname` varchar(50) COLLATE latin1_german1_ci NOT NULL,
  `firstname` varchar(50) COLLATE latin1_german1_ci NOT NULL,
  `address` varchar(60) COLLATE latin1_german1_ci NOT NULL,
  `city` varchar(60) COLLATE latin1_german1_ci NOT NULL,
  `mail` varchar(200) COLLATE latin1_german1_ci NOT NULL,
  `company` varchar(60) COLLATE latin1_german1_ci NOT NULL,
  `phone` varchar(20) COLLATE latin1_german1_ci NOT NULL,
  `gender` varchar(1) COLLATE latin1_german1_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
