-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 04. Apr 2019 um 14:08
-- Server-Version: 10.1.36-MariaDB
-- PHP-Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `millionAIR`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `basket`
--

CREATE TABLE `basket` (
  `basketID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `paid_for` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `basket`
--

INSERT INTO `basket` (`basketID`, `userID`, `paid_for`) VALUES
(1, 2, 1),
(2, 2, 1),
(3, 2, 1),
(4, 2, 1),
(6, 2, 1),
(7, 2, 0),
(8, 3, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category`
--

CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL,
  `category` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `category`
--

INSERT INTO `category` (`categoryID`, `category`) VALUES
(1, 'juice'),
(2, 'aroma'),
(3, 'mods'),
(4, 'atomizers'),
(5, 'DIY (base, nic-shots, cotton, tweezers)');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `flavor`
--

CREATE TABLE `flavor` (
  `flavorID` int(11) NOT NULL,
  `flavor` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `flavor`
--

INSERT INTO `flavor` (`flavorID`, `flavor`) VALUES
(1, 'tobacco'),
(2, 'fruity'),
(3, 'bakery');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `item`
--

CREATE TABLE `item` (
  `itemID` int(11) NOT NULL,
  `item` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `flavorID` int(11) DEFAULT NULL,
  `categoryID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `item`
--

INSERT INTO `item` (`itemID`, `item`, `description`, `stock`, `price`, `flavorID`, `categoryID`) VALUES
(1, 'VapeNaysh', 'beschte', 69, 4.2, 2, 1),
(2, 'tghtMOD', 'can do up to 80 watts', 12, 82, NULL, 3),
(3, 'atolf6milli', 'by 45VAPEs', 20, 150, NULL, 4),
(4, 'base70', '70/30', 70, 9.99, NULL, 5),
(5, 'base80', '80/20', 80, 9.99, NULL, 5),
(6, 'sheeps', 'best cotton eue', 120, 4.5, NULL, 5),
(7, 'brrystff', 'i member', 23, 3.5, 2, 2),
(8, 'that one cowboy', 'alpha af', 34, 5, 1, 1),
(9, 'CloudCheeser', 'Ömmis Phili-Torte lit af', 42, 1.49, 3, 2),
(10, 'emsa RTA', 'Léon´s favourite atti', 100, 79.99, NULL, 4),
(11, 'wasd RGB RTA', 'Epic Gamer >9kW', 31, 39.99, NULL, 3),
(12, 'bio cotton', 'by HappySheeps', 89, 4.95, NULL, 5),
(13, 'Tweezus', 'Tweezers 4 real Yeezers', 200, 3.99, NULL, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `position`
--

CREATE TABLE `position` (
  `positionID` int(11) NOT NULL,
  `basketID` int(11) DEFAULT NULL,
  `itemID` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `position`
--

INSERT INTO `position` (`positionID`, `basketID`, `itemID`, `quantity`) VALUES
(1, 1, 3, 1),
(2, 1, 1, 1),
(3, 2, 1, 71),
(4, 2, 1, 1),
(5, 3, 1, 1),
(6, 4, 1, 90),
(9, 6, 1, 69),
(10, 8, 1, 69);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `street` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`userID`, `username`, `firstname`, `lastname`, `admin`, `street`, `city`, `postal_code`, `password`) VALUES
(1, 'admin', 'admin', 'admin', 1, 'admin', 'admin', '11111', '5f4dcc3b5aa765d61d8327deb882cf99'),
(2, 'a', 'a', 'a', NULL, 'a', 'a', 'a', '0cc175b9c0f1b6a831c399e269772661'),
(3, 'b.ouelhazi@gmail.com', 'bedi', 'bedi', NULL, 'bedi', 'bedi', '12345', 'cd944e065096c6b61db1b58b46899ff8');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`basketID`),
  ADD KEY `userID` (`userID`);

--
-- Indizes für die Tabelle `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indizes für die Tabelle `flavor`
--
ALTER TABLE `flavor`
  ADD PRIMARY KEY (`flavorID`);

--
-- Indizes für die Tabelle `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`itemID`),
  ADD KEY `flavorID` (`flavorID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indizes für die Tabelle `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`positionID`),
  ADD KEY `basketID` (`basketID`),
  ADD KEY `itemID` (`itemID`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `basket`
--
ALTER TABLE `basket`
  MODIFY `basketID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `flavor`
--
ALTER TABLE `flavor`
  MODIFY `flavorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `item`
--
ALTER TABLE `item`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `position`
--
ALTER TABLE `position`
  MODIFY `positionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints der Tabelle `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`flavorID`) REFERENCES `flavor` (`flavorID`),
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`);

--
-- Constraints der Tabelle `position`
--
ALTER TABLE `position`
  ADD CONSTRAINT `position_ibfk_1` FOREIGN KEY (`basketID`) REFERENCES `basket` (`basketID`),
  ADD CONSTRAINT `position_ibfk_2` FOREIGN KEY (`itemID`) REFERENCES `item` (`itemID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
