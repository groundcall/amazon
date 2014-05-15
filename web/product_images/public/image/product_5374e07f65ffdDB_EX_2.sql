-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 13, 2014 at 06:14 PM
-- Server version: 5.5.35-1ubuntu1
-- PHP Version: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `DB EX 2`
--

-- --------------------------------------------------------

--
-- Table structure for table `Discipline`
--

CREATE TABLE IF NOT EXISTS `Discipline` (
  `codD` int(10) NOT NULL AUTO_INCREMENT,
  `Denumire` varchar(50) NOT NULL,
  PRIMARY KEY (`codD`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `Discipline`
--

INSERT INTO `Discipline` (`codD`, `Denumire`) VALUES
(1, 'Televiziune'),
(2, 'Sisteme Digitale'),
(3, 'Protocoale pentru Internet'),
(4, 'Tehnologii Multimedia'),
(5, 'Dispozitive si Circuite Electronice'),
(6, 'Prelucrare Numerica a Semnalelor'),
(7, 'Prelucrarea Numerica a Imaginilor'),
(8, 'Next Generation Networks'),
(9, 'Modelarea Bazelor de Date'),
(10, 'Analiza Matematica');

-- --------------------------------------------------------

--
-- Table structure for table `Examene`
--

CREATE TABLE IF NOT EXISTS `Examene` (
  `codS` int(10) NOT NULL,
  `codD` int(10) NOT NULL,
  `ziua` int(10) NOT NULL,
  `grupa` int(10) NOT NULL,
  KEY `codS` (`codS`,`codD`),
  KEY `Examene_ibfk_2` (`codD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Examene`
--

INSERT INTO `Examene` (`codS`, `codD`, `ziua`, `grupa`) VALUES
(1, 1, 15, 2),
(1, 1, 15, 1),
(1, 3, 5, 3),
(1, 4, 27, 5),
(1, 4, 27, 1),
(2, 2, 10, 3),
(2, 2, 9, 1),
(2, 2, 8, 2),
(3, 10, 1, 1),
(3, 10, 30, 1),
(3, 6, 14, 2),
(1, 9, 21, 6);

-- --------------------------------------------------------

--
-- Table structure for table `PlanInv`
--

CREATE TABLE IF NOT EXISTS `PlanInv` (
  `codS` int(10) NOT NULL,
  `codD` int(10) NOT NULL,
  `nrCredite` int(10) NOT NULL,
  `anStudiu` int(10) NOT NULL,
  PRIMARY KEY (`codS`,`codD`),
  KEY `codD` (`codD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PlanInv`
--

INSERT INTO `PlanInv` (`codS`, `codD`, `nrCredite`, `anStudiu`) VALUES
(1, 1, 5, 4),
(1, 3, 5, 3),
(1, 4, 4, 4),
(1, 7, 5, 3),
(1, 8, 4, 6),
(1, 9, 3, 5),
(2, 2, 2, 3),
(2, 5, 4, 2),
(3, 6, 6, 4),
(3, 10, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Sectii`
--

CREATE TABLE IF NOT EXISTS `Sectii` (
  `codS` int(10) NOT NULL AUTO_INCREMENT,
  `Denumire` varchar(50) NOT NULL,
  PRIMARY KEY (`codS`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Sectii`
--

INSERT INTO `Sectii` (`codS`, `Denumire`) VALUES
(1, 'Comunicatii'),
(2, 'Electronica Aplicata'),
(3, 'Bazele Electronicii');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Examene`
--
ALTER TABLE `Examene`
  ADD CONSTRAINT `Examene_ibfk_1` FOREIGN KEY (`codS`) REFERENCES `PlanInv` (`codS`),
  ADD CONSTRAINT `Examene_ibfk_2` FOREIGN KEY (`codD`) REFERENCES `PlanInv` (`codD`);

--
-- Constraints for table `PlanInv`
--
ALTER TABLE `PlanInv`
  ADD CONSTRAINT `PlanInv_ibfk_1` FOREIGN KEY (`codS`) REFERENCES `Sectii` (`codS`),
  ADD CONSTRAINT `PlanInv_ibfk_2` FOREIGN KEY (`codD`) REFERENCES `Discipline` (`codD`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
