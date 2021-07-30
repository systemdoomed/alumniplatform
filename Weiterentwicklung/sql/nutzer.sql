-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 30. Jul 2021 um 11:42
-- Server-Version: 10.4.18-MariaDB
-- PHP-Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `alumnidatenbank`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nutzer`
--

CREATE TABLE `nutzer` (
  `nid` int(11) NOT NULL,
  `firstname` varchar(40) COLLATE latin1_german1_ci NOT NULL,
  `lastname` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `course` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `school` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gradyear` year(4) DEFAULT 0000,
  `mail` varchar(254) COLLATE latin1_german1_ci NOT NULL,
  `state` tinyint(4) DEFAULT 0,
  `isSendMail` tinyint(1) DEFAULT NULL,
  `matrikel` varchar(8) COLLATE latin1_german1_ci DEFAULT NULL,
  `address` varchar(30) COLLATE latin1_german1_ci DEFAULT NULL,
  `city` varchar(40) COLLATE latin1_german1_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE latin1_german1_ci DEFAULT '',
  `company` varchar(60) COLLATE latin1_german1_ci DEFAULT '',
  `position` varchar(30) COLLATE latin1_german1_ci DEFAULT '',
  `gender` varchar(3) COLLATE latin1_german1_ci NOT NULL,
  `isSupportingMember` tinyint(4) NOT NULL,
  `title` varchar(20) COLLATE latin1_german1_ci DEFAULT '',
  `birthname` text COLLATE latin1_german1_ci DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Daten für Tabelle `nutzer`
--

INSERT INTO `nutzer` (`nid`, `firstname`, `lastname`, `course`, `school`, `gradyear`, `mail`, `state`, `isSendMail`, `matrikel`, `address`, `city`, `phone`, `company`, `position`, `gender`, `isSupportingMember`, `title`, `birthname`) VALUES
(1, 'root', 'root', 'BA', 'BA Leipzig', 2021, 'root@root.de', 3, 1, '000000', '', '', '', '', '', 'm', 1, '', '');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `nutzer`
--
ALTER TABLE `nutzer`
  ADD PRIMARY KEY (`nid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `nutzer`
--
ALTER TABLE `nutzer`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
