-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 19. Aug 2021 um 18:22
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
-- Tabellenstruktur für Tabelle `Nutzer`
--

CREATE TABLE `Nutzer` (
  `nid` int(11) NOT NULL,
  `firstname` varchar(40) COLLATE latin1_german1_ci NOT NULL,
  `lastname` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `course` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `school` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gradyear` year(4) DEFAULT 0000,
  `mail` varchar(254) COLLATE latin1_german1_ci NOT NULL,
  `state` tinyint(4) DEFAULT 0,
  `isSendMail` tinyint(1) DEFAULT 1,
  `matrikel` varchar(8) COLLATE latin1_german1_ci DEFAULT '',
  `address` varchar(30) COLLATE latin1_german1_ci DEFAULT '',
  `city` varchar(40) COLLATE latin1_german1_ci DEFAULT '',
  `phone` varchar(20) COLLATE latin1_german1_ci DEFAULT '',
  `company` varchar(60) COLLATE latin1_german1_ci DEFAULT '',
  `position` varchar(30) COLLATE latin1_german1_ci DEFAULT '',
  `gender` varchar(3) COLLATE latin1_german1_ci NOT NULL,
  `isSupportingMember` tinyint(4) NOT NULL,
  `title` varchar(20) COLLATE latin1_german1_ci DEFAULT '',
  `birthname` varchar(25) COLLATE latin1_german1_ci DEFAULT '',
  `isExternalLinks` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Daten für Tabelle `Nutzer`
--

INSERT INTO `Nutzer` (`nid`, `firstname`, `lastname`, `course`, `school`, `gradyear`, `mail`, `state`, `isSendMail`, `matrikel`, `address`, `city`, `phone`, `company`, `position`, `gender`, `isSupportingMember`, `title`, `birthname`, `isExternalLinks`) VALUES
(1, 'root', 'root', 'BA', 'BA Leipzig', 2021, 'root@root.de', 3, 1, '000000', '', '', '', '', '', 'm', 1, '', '', 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `Nutzer`
--
ALTER TABLE `Nutzer`
  ADD PRIMARY KEY (`nid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `Nutzer`
--
ALTER TABLE `Nutzer`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
