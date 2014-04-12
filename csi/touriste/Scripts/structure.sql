-- phpMyAdmin SQL Dump
-- version 3.4.8
-- http://www.phpmyadmin.net
--
-- Host: mysql1
-- Generation Time: Apr 27, 2012 at 03:29 PM
-- Server version: 5.1.39
-- PHP Version: 5.3.6-11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `freaxmind_touriste`
--

-- --------------------------------------------------------

--
-- Table structure for table `Activite`
--

CREATE TABLE IF NOT EXISTS `Activite` (
  `NOACT` int(11) NOT NULL AUTO_INCREMENT,
  `NOTYPACT` int(11) NOT NULL,
  `NOMACT` varchar(30) NOT NULL,
  `INTERIEUR` tinyint(1) NOT NULL,
  `ENFANTACT` tinyint(1) NOT NULL,
  PRIMARY KEY (`NOACT`),
  KEY `NOTYPACT` (`NOTYPACT`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `APour`
--

CREATE TABLE IF NOT EXISTS `APour` (
  `NOSAISON` int(11) NOT NULL,
  `NOHEBERG` int(11) NOT NULL,
  `PRIX` float NOT NULL,
  PRIMARY KEY (`NOSAISON`,`NOHEBERG`),
  KEY `NOHEBERG` (`NOHEBERG`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Client`
--

CREATE TABLE IF NOT EXISTS `Client` (
  `NOCLIENT` int(11) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(30) NOT NULL,
  `PRENOM` varchar(30) NOT NULL,
  `DATENAISS` date NOT NULL,
  `SEXE` char(1) NOT NULL,
  `SITMARITAL` varchar(30) NOT NULL,
  `TELEPHONECLIENT` varchar(15) NOT NULL,
  `EMAILCLIENT` varchar(50) NOT NULL,
  `ADRESSECLIENT` varchar(100) NOT NULL,
  PRIMARY KEY (`NOCLIENT`),
  UNIQUE KEY `EMAILCLIENT` (`EMAILCLIENT`),
  UNIQUE KEY `TELEPHONECLIENT` (`TELEPHONECLIENT`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `Demande`
--

CREATE TABLE IF NOT EXISTS `Demande` (
  `NDEM` int(11) NOT NULL AUTO_INCREMENT,
  `NOCLIENT` int(11) NOT NULL,
  `NOSTAT` int(11) NOT NULL,
  `NOTYPH` int(11) NOT NULL,
  `NOTYPEPREST` int(11) NOT NULL,
  `ETATDEM` varchar(30) NOT NULL,
  `CODEATTENTE` int(11) NOT NULL,
  `DATDEM` date NOT NULL,
  `DATEDEBUTRES` date NOT NULL,
  `DATEFINRES` date NOT NULL,
  `NBPERSRES` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`NDEM`),
  KEY `NOCLIENT` (`NOCLIENT`),
  KEY `NOSTAT` (`NOSTAT`),
  KEY `NOTYPH` (`NOTYPH`),
  KEY `NOTYPEPREST` (`NOTYPEPREST`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

-- --------------------------------------------------------

--
-- Table structure for table `Dispo`
--

CREATE TABLE IF NOT EXISTS `Dispo` (
  `NODISP` int(11) NOT NULL,
  `NOHEBERG` int(11) NOT NULL,
  PRIMARY KEY (`NODISP`,`NOHEBERG`),
  KEY `NOHEBERG` (`NOHEBERG`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Disponibilite`
--

CREATE TABLE IF NOT EXISTS `Disponibilite` (
  `NODISP` int(11) NOT NULL AUTO_INCREMENT,
  `DATEDEBDISP` date NOT NULL,
  `DATEFINDISP` date NOT NULL,
  PRIMARY KEY (`NODISP`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `Hebergement`
--

CREATE TABLE IF NOT EXISTS `Hebergement` (
  `NOHEBERG` int(11) NOT NULL AUTO_INCREMENT,
  `NOPREST` int(11) NOT NULL,
  `NOTYPH` int(11) NOT NULL,
  `ADRESSE` varchar(100) NOT NULL,
  `QUALITE` varchar(30) NOT NULL,
  `SURFACE` float NOT NULL,
  `NBLITADULT` int(11) NOT NULL,
  `NBLITENFANT` int(11) NOT NULL,
  `WIFI` tinyint(1) NOT NULL,
  `RESTAURATION` tinyint(1) NOT NULL,
  `GESTIONAGENCE` tinyint(1) NOT NULL,
  PRIMARY KEY (`NOHEBERG`),
  KEY `NOPREST` (`NOPREST`),
  KEY `NOTYPH` (`NOTYPH`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `Interrogation`
--

CREATE TABLE IF NOT EXISTS `Interrogation` (
  `noreq` int(11) NOT NULL AUTO_INCREMENT,
  `nomreq` varchar(100) NOT NULL,
  `sqlreq` text NOT NULL,
  PRIMARY KEY (`noreq`),
  UNIQUE KEY `nom` (`nomreq`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Table structure for table `Offert`
--

CREATE TABLE IF NOT EXISTS `Offert` (
  `NOSERV` int(11) NOT NULL,
  `NOPREST` int(11) NOT NULL,
  PRIMARY KEY (`NOSERV`,`NOPREST`),
  KEY `NOPREST` (`NOPREST`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Paiement`
--

CREATE TABLE IF NOT EXISTS `Paiement` (
  `NOPAIE` int(11) NOT NULL AUTO_INCREMENT,
  `NORES` int(11) NOT NULL,
  `NOTYPPAIE` int(11) NOT NULL,
  `LIBELLEPAIE` varchar(50) NOT NULL,
  `MONTANTPAIE` float NOT NULL,
  `DATEPAIE` date NOT NULL,
  `REMBOURSEPAIE` tinyint(1) NOT NULL,
  PRIMARY KEY (`NOPAIE`),
  KEY `NOTYPPAIE` (`NOTYPPAIE`),
  KEY `NORES` (`NORES`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

-- --------------------------------------------------------

--
-- Table structure for table `Particularite`
--

CREATE TABLE IF NOT EXISTS `Particularite` (
  `NOPART` int(11) NOT NULL AUTO_INCREMENT,
  `NOMPART` varchar(30) NOT NULL,
  `ADRESSEPART` varchar(100) NOT NULL,
  `DESCRIPTIONPART` text NOT NULL,
  `HANDI_ACCESSIBLE` tinyint(1) NOT NULL,
  PRIMARY KEY (`NOPART`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `Possible`
--

CREATE TABLE IF NOT EXISTS `Possible` (
  `NOACT` int(11) NOT NULL,
  `NOSTAT` int(11) NOT NULL,
  PRIMARY KEY (`NOACT`,`NOSTAT`),
  KEY `NOSTAT` (`NOSTAT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Prestataire`
--

CREATE TABLE IF NOT EXISTS `Prestataire` (
  `NOPREST` int(11) NOT NULL AUTO_INCREMENT,
  `NOSTAT` int(11) NOT NULL,
  `NOTYPP` int(11) NOT NULL,
  `NOMPREST` varchar(30) NOT NULL,
  `TELEPHONEPREST` varchar(15) NOT NULL,
  `EMAILPREST` varchar(50) NOT NULL,
  PRIMARY KEY (`NOPREST`),
  UNIQUE KEY `EMAILPREST` (`EMAILPREST`),
  KEY `NOSTAT` (`NOSTAT`),
  KEY `NOTYPP` (`NOTYPP`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `Reservation`
--

CREATE TABLE IF NOT EXISTS `Reservation` (
  `NORES` int(11) NOT NULL AUTO_INCREMENT,
  `NDEM` int(11) NOT NULL,
  `NOHEBERG` int(11) NOT NULL,
  `DATERES` date NOT NULL,
  `MONTANTRES` float NOT NULL,
  `DATANNUL` date DEFAULT NULL,
  `ETATRES` varchar(30) NOT NULL,
  `ASSURANCE` tinyint(1) NOT NULL,
  PRIMARY KEY (`NORES`),
  UNIQUE KEY `NDEM` (`NDEM`),
  KEY `NOHEBERG` (`NOHEBERG`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- Table structure for table `Saison`
--

CREATE TABLE IF NOT EXISTS `Saison` (
  `NOSAISON` int(11) NOT NULL AUTO_INCREMENT,
  `DATEDEBS` date NOT NULL,
  `DATEFINS` date NOT NULL,
  PRIMARY KEY (`NOSAISON`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `Service`
--

CREATE TABLE IF NOT EXISTS `Service` (
  `NOSERV` int(11) NOT NULL AUTO_INCREMENT,
  `NOMSERVICE` varchar(30) NOT NULL,
  `COMPRIS` tinyint(1) NOT NULL,
  PRIMARY KEY (`NOSERV`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `Station`
--

CREATE TABLE IF NOT EXISTS `Station` (
  `NOSTAT` int(11) NOT NULL AUTO_INCREMENT,
  `NOMSTAT` varchar(30) NOT NULL,
  `ADRESSESTAT` varchar(100) NOT NULL,
  `TELEPHONESTAT` varchar(15) NOT NULL,
  `EMAILSTAT` varchar(50) NOT NULL,
  PRIMARY KEY (`NOSTAT`),
  UNIQUE KEY `EMAILSTAT` (`EMAILSTAT`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `TypeActivite`
--

CREATE TABLE IF NOT EXISTS `TypeActivite` (
  `NOTYPACT` int(11) NOT NULL AUTO_INCREMENT,
  `NOMTYPACT` varchar(30) NOT NULL,
  PRIMARY KEY (`NOTYPACT`),
  UNIQUE KEY `NOMTYPACT` (`NOMTYPACT`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `TypeHeberg`
--

CREATE TABLE IF NOT EXISTS `TypeHeberg` (
  `NOTYPH` int(11) NOT NULL AUTO_INCREMENT,
  `NOMTYPH` varchar(30) NOT NULL,
  PRIMARY KEY (`NOTYPH`),
  UNIQUE KEY `NOMTYPH` (`NOMTYPH`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `TypePaiement`
--

CREATE TABLE IF NOT EXISTS `TypePaiement` (
  `NOTYPPAIE` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLETYPPAIE` varchar(30) NOT NULL,
  PRIMARY KEY (`NOTYPPAIE`),
  UNIQUE KEY `LIBELLETYPPAIE` (`LIBELLETYPPAIE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `TypePrest`
--

CREATE TABLE IF NOT EXISTS `TypePrest` (
  `NOTYPP` int(11) NOT NULL AUTO_INCREMENT,
  `NOMTYP` varchar(30) NOT NULL,
  PRIMARY KEY (`NOTYPP`),
  UNIQUE KEY `NOMTYP` (`NOMTYP`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `Voir`
--

CREATE TABLE IF NOT EXISTS `Voir` (
  `NOPART` int(11) NOT NULL,
  `NOSTAT` int(11) NOT NULL,
  PRIMARY KEY (`NOPART`,`NOSTAT`),
  KEY `NOSTAT` (`NOSTAT`),
  KEY `NOPART` (`NOPART`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Activite`
--
ALTER TABLE `Activite`
  ADD CONSTRAINT `Activite_ibfk_1` FOREIGN KEY (`NOTYPACT`) REFERENCES `TypeActivite` (`NOTYPACT`);

--
-- Constraints for table `APour`
--
ALTER TABLE `APour`
  ADD CONSTRAINT `APour_ibfk_4` FOREIGN KEY (`NOHEBERG`) REFERENCES `Hebergement` (`NOHEBERG`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `APour_ibfk_3` FOREIGN KEY (`NOSAISON`) REFERENCES `Saison` (`NOSAISON`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Demande`
--
ALTER TABLE `Demande`
  ADD CONSTRAINT `Demande_ibfk_10` FOREIGN KEY (`NOSTAT`) REFERENCES `Station` (`NOSTAT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Demande_ibfk_6` FOREIGN KEY (`NOTYPH`) REFERENCES `TypeHeberg` (`NOTYPH`),
  ADD CONSTRAINT `Demande_ibfk_7` FOREIGN KEY (`NOTYPEPREST`) REFERENCES `TypePrest` (`NOTYPP`),
  ADD CONSTRAINT `Demande_ibfk_9` FOREIGN KEY (`NOCLIENT`) REFERENCES `Client` (`NOCLIENT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Dispo`
--
ALTER TABLE `Dispo`
  ADD CONSTRAINT `Dispo_ibfk_2` FOREIGN KEY (`NOHEBERG`) REFERENCES `Hebergement` (`NOHEBERG`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Dispo_ibfk_1` FOREIGN KEY (`NODISP`) REFERENCES `Disponibilite` (`NODISP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Hebergement`
--
ALTER TABLE `Hebergement`
  ADD CONSTRAINT `Hebergement_ibfk_3` FOREIGN KEY (`NOPREST`) REFERENCES `Prestataire` (`NOPREST`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Hebergement_ibfk_2` FOREIGN KEY (`NOTYPH`) REFERENCES `TypeHeberg` (`NOTYPH`);

--
-- Constraints for table `Offert`
--
ALTER TABLE `Offert`
  ADD CONSTRAINT `Offert_ibfk_2` FOREIGN KEY (`NOPREST`) REFERENCES `Prestataire` (`NOPREST`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Offert_ibfk_1` FOREIGN KEY (`NOSERV`) REFERENCES `Service` (`NOSERV`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Paiement`
--
ALTER TABLE `Paiement`
  ADD CONSTRAINT `Paiement_ibfk_3` FOREIGN KEY (`NORES`) REFERENCES `Reservation` (`NORES`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Paiement_ibfk_1` FOREIGN KEY (`NOTYPPAIE`) REFERENCES `TypePaiement` (`NOTYPPAIE`);

--
-- Constraints for table `Possible`
--
ALTER TABLE `Possible`
  ADD CONSTRAINT `Possible_ibfk_2` FOREIGN KEY (`NOSTAT`) REFERENCES `Station` (`NOSTAT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Possible_ibfk_1` FOREIGN KEY (`NOACT`) REFERENCES `Activite` (`NOACT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Prestataire`
--
ALTER TABLE `Prestataire`
  ADD CONSTRAINT `Prestataire_ibfk_2` FOREIGN KEY (`NOTYPP`) REFERENCES `TypePrest` (`NOTYPP`),
  ADD CONSTRAINT `Prestataire_ibfk_1` FOREIGN KEY (`NOSTAT`) REFERENCES `Station` (`NOSTAT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Reservation`
--
ALTER TABLE `Reservation`
  ADD CONSTRAINT `Reservation_ibfk_3` FOREIGN KEY (`NDEM`) REFERENCES `Demande` (`NDEM`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Reservation_ibfk_4` FOREIGN KEY (`NOHEBERG`) REFERENCES `Hebergement` (`NOHEBERG`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Voir`
--
ALTER TABLE `Voir`
  ADD CONSTRAINT `Voir_ibfk_1` FOREIGN KEY (`NOPART`) REFERENCES `Particularite` (`NOPART`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Voir_ibfk_2` FOREIGN KEY (`NOSTAT`) REFERENCES `Station` (`NOSTAT`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
