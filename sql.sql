-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1:3306
-- Tid vid skapande: 22 mars 2019 kl 19:55
-- Serverversion: 5.7.21
-- PHP-version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `gyar`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(259) NOT NULL,
  `post` text NOT NULL,
  `img` text NOT NULL,
  `articledate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `article`
--

INSERT INTO `article` (`id`, `title`, `post`, `img`, `articledate`) VALUES
(1, 'What the old town is?', 'Head to Stockholm’s Old Town, Gamla Stan, one of Europe’s largest and best preserved medieval city centres in Europe. Founded in 1252, it’s no wonder that it is a stunning, atmospheric part of the city, steeped in history, with narrow streets and grand buildings. Read our guide to exploring the highlights of this beautiful neighbourhood.\r\nCurrently housing the offices of the Royal Family, the Swedish Royal Palace stands on the same ground as its predecessor, the medieval Tre Kronor Castle, destroyed in a fire in the 17th century. There are five museums now open to the public, showing the Hall of the State, the silver throne of Queen Kristina, the Treasury and more. The palace has several hundred rooms decorated in the Rococo style. The Change of the Guard is a spectacular ceremony that occurs daily, so be sure to stop by and see it.', 'img/article.jpg', '2019-03-10'),
(2, 'The old town', 'The tiny island of Helgeandsholmen is home to the Swedish Parliament, the Riksdaghuset, which takes up about half of the island in its totality. There are free guided tours of the Parliament that last around an hour. The building is built in the Neoclassical style, with a Neo-Baroque façade and two Neoclassical wings and large Corinthian columns. There is a large glass gallery located above the hall, through which visitors can observe the ongoing parliamentary sessions.\r\nThe tiny island of Helgeandsholmen is home to the Swedish Parliament, the Riksdaghuset, which takes up about half of the island in its totality. There are free guided tours of the Parliament that last around an hour. The building is built in the Neoclassical style, with a Neo-Baroque façade and two Neoclassical wings and large Corinthian columns. There is a large glass gallery located above the hall, through which visitors can observe the ongoing parliamentary sessions.', 'img/article.jpg', '2019-03-10'),
(3, 'The old town:', 'The tiny island of Helgeandsholmen is home to the Swedish Parliament, the Riksdaghuset, which takes up about half of the island in its totality. There are free guided tours of the Parliament that last around an hour. The building is built in the Neoclassical style, with a Neo-Baroque façade and two Neoclassical wings and large Corinthian columns. There is a large glass gallery located above the hall, through which visitors can observe the ongoing parliamentary sessions.', 'img/article.jpg', '2019-03-10');

-- --------------------------------------------------------

--
-- Tabellstruktur `generalsettings`
--

DROP TABLE IF EXISTS `generalsettings`;
CREATE TABLE IF NOT EXISTS `generalsettings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(59) NOT NULL,
  `language` varchar(3) NOT NULL,
  `facebook` varchar(259) NOT NULL,
  `instagram` varchar(259) NOT NULL,
  `youtube` varchar(259) NOT NULL,
  `address` text NOT NULL,
  `telnr` varchar(59) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `generalsettings`
--

INSERT INTO `generalsettings` (`id`, `title`, `language`, `facebook`, `instagram`, `youtube`, `address`, `telnr`) VALUES
(1, 'Gran hotel', 'en', 'https://www.FACEBOOK.COM/habiballahafg', 'https://www.instagram.com/habiballahafg', 'https://www.\r\nyoutube.com/habiballahafg', 'Södra Blasieholmshamnen 8, 103 27 Stockholm', '08-679 35 00');

-- --------------------------------------------------------

--
-- Tabellstruktur `guest`
--

DROP TABLE IF EXISTS `guest`;
CREATE TABLE IF NOT EXISTS `guest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` varchar(256) DEFAULT NULL,
  `roomID` varchar(50) NOT NULL,
  `userOrder` int(11) NOT NULL,
  `checkin` varchar(11) NOT NULL,
  `checkout` varchar(11) NOT NULL,
  `progress` int(1) NOT NULL,
  `roomnumber` int(3) NOT NULL,
  `username` varchar(59) NOT NULL,
  `roomtype` varchar(59) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `guest`
--

INSERT INTO `guest` (`id`, `userID`, `roomID`, `userOrder`, `checkin`, `checkout`, `progress`, `roomnumber`, `username`, `roomtype`) VALUES
(1, '5', '1', 123456, '2019-07-20', '2019-07-27', 0, 61, 'Habiballah Hezarehee', 'single bed'),
(2, '1', '2', 123456, '2019-07-20', '2019-07-27', 0, 62, 'Habiballah HEzarehee', 'single bed');

-- --------------------------------------------------------

--
-- Tabellstruktur `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `number` int(11) NOT NULL,
  `availability` int(11) NOT NULL,
  `image` varchar(259) COLLATE utf8_unicode_ci NOT NULL,
  `article` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `room`
--

INSERT INTO `room` (`id`, `name`, `number`, `availability`, `image`, `article`, `price`) VALUES
(1, 'single bedroom', 25, 25, 'img/single-bed.jpg', 'Jump-start your day with a good night  sleep. With the comfort and quality you get from our sturdy single\r\n                    beds, you will wake up refreshed and ready to roll. To make more of your space, go for a storage bed or one\r\n                    that you can slide underbed storage underneath. And we have everything else, like a mattress or a duvet, to\r\n                    complete your bed in style.', 75),
(2, 'double bed', 25, 25, 'img/double-bed.jpg', 'Jump-start your day with a good night  sleep. With the comfort and quality you get from our sturdy single\r\n                    beds, you will wake up refreshed and ready to roll. To make more of your space, go for a storage bed or one\r\n                    that you can slide underbed storage underneath. And we have everything else, like a mattress or a duvet, to\r\n                    complete your bed in style.\r\n\r\n', 120),
(3, 'triple bed', 10, 0, 'img/tripple-bed.jpg', 'Jump-start your day with a good night  sleep. With the comfort and quality you get from our sturdy single\r\n                    beds, you will wake up refreshed and ready to roll. To make more of your space, go for a storage bed or one\r\n                    that you can slide underbed storage underneath. And we have everything else, like a mattress or a duvet, to\r\n                    complete your bed in style.', 180),
(4, 'apartment', 5, 5, 'img/apartment.jpg', 'Jump-start your day with a good night  sleep. With the comfort and quality you get from our sturdy single\r\n                    beds, you will wake up refreshed and ready to roll. To make more of your space, go for a storage bed or one\r\n                    that you can slide underbed storage underneath. And we have everything else, like a mattress or a duvet, to\r\n                    complete your bed in style.', 250);

-- --------------------------------------------------------

--
-- Tabellstruktur `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(259) NOT NULL,
  `email` varchar(259) NOT NULL,
  `telnr` varchar(50) NOT NULL,
  `password` varchar(259) NOT NULL,
  `address` varchar(259) NOT NULL,
  `country` varchar(259) NOT NULL,
  `zip` varchar(11) NOT NULL,
  `city` varchar(259) NOT NULL,
  `address2` text NOT NULL,
  `image` text NOT NULL,
  `accesslevel` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user-email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `telnr`, `password`, `address`, `country`, `zip`, `city`, `address2`, `image`, `accesslevel`) VALUES
(5, 'Habiballah Hezarehee', 'hezarehee@outlook.com', '0732475275', '03ed7298b1e029377a51c617b3d02c47', 'Stalbogavagen 23 LGH 1102', 'Sweden', '12456', 'Bandhagen', 'c/o Habiballah Hezarehee', 'img-profile/profile.jpg\r\n', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
