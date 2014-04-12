-- phpMyAdmin SQL Dump
-- version 3.4.8
-- http://www.phpmyadmin.net
--
-- Host: mysql1
-- Generation Time: Apr 27, 2012 at 03:30 PM
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

--
-- Dumping data for table `Activite`
--

INSERT INTO `Activite` (`NOACT`, `NOTYPACT`, `NOMACT`, `INTERIEUR`, `ENFANTACT`) VALUES
(1, 1, 'tennis', 0, 1),
(2, 4, 'ski', 0, 1),
(3, 1, 'piscine', 0, 1),
(4, 1, 'golf', 0, 0),
(5, 2, 'karaoke', 1, 1),
(6, 3, 'speed dating', 1, 0),
(8, 5, 'contes de noel', 0, 1);

--
-- Dumping data for table `APour`
--

INSERT INTO `APour` (`NOSAISON`, `NOHEBERG`, `PRIX`) VALUES
(6, 2, 4000),
(6, 3, 1000),
(6, 4, 1500),
(6, 6, 500),
(8, 5, 30000);

--
-- Dumping data for table `Client`
--

INSERT INTO `Client` (`NOCLIENT`, `NOM`, `PRENOM`, `DATENAISS`, `SEXE`, `SITMARITAL`, `TELEPHONECLIENT`, `EMAILCLIENT`, `ADRESSECLIENT`) VALUES
(2, 'Duo', 'Julia', '1989-02-01', 'F', 'Mariée', '0258963254', 'jul@ul.com', 'adresse julia duo'),
(3, 'Hur', 'Ben', '1979-11-22', 'H', 'célibataire', '0102030405', 'ben.hur@gladiateur.com', 'Rue du petit peplum'),
(4, 'Ron', 'Anthony', '1966-05-16', 'H', 'divorcé', '0908070605', 'anthony.ron@star.com', 'Avenue du touriste'),
(5, 'Apo', 'Junior', '1955-10-10', 'H', 'célibataire', '0761819834', 'apo.fils@stargate.com', '7e porte des étoiles');

--
-- Dumping data for table `Demande`
--

INSERT INTO `Demande` (`NDEM`, `NOCLIENT`, `NOSTAT`, `NOTYPH`, `NOTYPEPREST`, `ETATDEM`, `CODEATTENTE`, `DATDEM`, `DATEDEBUTRES`, `DATEFINRES`, `NBPERSRES`) VALUES
(44, 2, 1, 11, 1, 'validé', 0, '2010-03-01', '2010-04-01', '2010-04-07', 5),
(45, 5, 1, 4, 1, 'validé', 0, '2012-01-01', '2012-02-01', '2012-02-07', 2),
(56, 2, 1, 5, 2, 'validé', 0, '2012-04-27', '2012-05-15', '2012-05-30', 1),
(57, 4, 1, 5, 2, 'renvoie proposition', 1, '2012-04-27', '2012-05-15', '2012-05-30', 1),
(58, 2, 3, 2, 2, 'validé', 0, '2012-04-27', '2012-05-15', '2012-05-30', 1);

--
-- Dumping data for table `Dispo`
--

INSERT INTO `Dispo` (`NODISP`, `NOHEBERG`) VALUES
(9, 2),
(10, 2),
(11, 2),
(16, 2),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(9, 4),
(10, 4),
(11, 4),
(12, 4),
(13, 4),
(14, 4),
(9, 5),
(10, 5),
(11, 5),
(12, 5),
(13, 5),
(14, 5),
(15, 5),
(9, 6),
(10, 6),
(11, 6),
(12, 6),
(13, 6),
(14, 6),
(9, 16),
(10, 16),
(11, 16),
(9, 17),
(10, 17),
(11, 17),
(9, 18),
(10, 18),
(11, 18);

--
-- Dumping data for table `Disponibilite`
--

INSERT INTO `Disponibilite` (`NODISP`, `DATEDEBDISP`, `DATEFINDISP`) VALUES
(9, '2012-03-01', '2012-03-31'),
(10, '2012-04-01', '2012-04-30'),
(11, '2012-05-01', '2012-05-31'),
(12, '2012-06-01', '2012-06-30'),
(13, '2012-07-01', '2012-07-31'),
(14, '2012-08-01', '2012-08-30'),
(15, '2010-01-01', '2010-12-31'),
(16, '2012-02-01', '2012-02-28');

--
-- Dumping data for table `Hebergement`
--

INSERT INTO `Hebergement` (`NOHEBERG`, `NOPREST`, `NOTYPH`, `ADRESSE`, `QUALITE`, `SURFACE`, `NBLITADULT`, `NBLITENFANT`, `WIFI`, `RESTAURATION`, `GESTIONAGENCE`) VALUES
(2, 1, 4, 'aa', 'neuf', 10, 2, 3, 1, 1, 1),
(3, 2, 5, 'zz', 'récent', 15, 4, 1, 1, 0, 1),
(4, 5, 2, 'Toulon', 'neuf', 50, 0, 0, 0, 1, 1),
(5, 1, 11, '30 avenue de la mer\r\nToulon', 'neuf', 250, 10, 5, 1, 0, 1),
(6, 6, 2, '25 rue du pont\r\nToulon', 'neuf', 300, 0, 0, 0, 0, 1),
(16, 2, 5, 'Rue cyfflé', 'neuf', 24, 2, 1, 1, 0, 0),
(17, 2, 5, 'Rue cyfflé', 'neuf', 24, 2, 1, 1, 0, 0),
(18, 2, 5, 'rue cyfflé', 'neuf', 35, 2, 1, 1, 0, 0);

--
-- Dumping data for table `Interrogation`
--

INSERT INTO `Interrogation` (`noreq`, `nomreq`, `sqlreq`) VALUES
(10, 'Toutes les activités d’intérieurs pour les enfants pour une station donnée', 'SELECT * FROM Activite\r\nWHERE INTERIEUR = 1\r\nAND ENFANTACT = 1'),
(11, 'Tous les hébergements du prestataire', 'SELECT * FROM Hebergement h\r\nINNER JOIN Prestataire p ON h.NOPREST = p.NOPREST\r\nWHERE NOMPREST = "Robin Jeremy"'),
(13, 'Les disponibilités de l’année', 'SELECT * FROM Disponibilite\r\nWHERE DATEDEBDISP > "2012-01-01"\r\nAND DATEFINDISP < "2012-12-31"'),
(14, 'Le bénéfice sur la période', 'SELECT SUM(MONTANTPAIE) as benefice FROM Paiement\r\n'),
(17, 'Les réservations annulées', 'SELECT * FROM Reservation\r\nWHERE ETATRES = "annule"'),
(18, 'Les clients qui ont une réservation non versées', 'SELECT NOM, PRENOM FROM Client c\r\nINNER JOIN Demande d ON c.NOCLIENT = \r\nd.NOCLIENT\r\nINNER JOIN Reservation r ON d.NDEM = r.NDEM WHERE ETATRES = "refusé"'),
(19, 'Les particularités accessibles aux handicapées', 'SELECT NOMPART, ADRESSEPART, DESCRIPTIONPART FROM Particularite\r\nWHERE HANDI_ACCESSIBLE = 1'),
(20, 'Tous les clients en attente d’envoie de proposition', 'SELECT NOM, PRENOM, EMAILCLIENT FROM Demande d\r\nINNER JOIN Client c ON c.NOCLIENT = d.NOCLIENT\r\nWHERE ETATDEM = "renvoie proposition"');

--
-- Dumping data for table `Offert`
--

INSERT INTO `Offert` (`NOSERV`, `NOPREST`) VALUES
(4, 1),
(5, 1),
(4, 4),
(5, 4),
(6, 5);

--
-- Dumping data for table `Paiement`
--

INSERT INTO `Paiement` (`NOPAIE`, `NORES`, `NOTYPPAIE`, `LIBELLEPAIE`, `MONTANTPAIE`, `DATEPAIE`, `REMBOURSEPAIE`) VALUES
(27, 26, 2, 'versement arrhes', 6000, '2010-03-07', 0),
(28, 26, 1, 'reception paiement', 24000, '2010-03-14', 0),
(42, 36, 2, 'versement arrhes', 200, '2012-04-27', 0),
(43, 36, 2, 'reception paiement', 400, '2012-04-27', 0),
(44, 36, 2, 'reception paiement', 400, '2012-04-27', 0),
(45, 37, 2, 'versement arrhes', 100, '2012-04-27', 0);

--
-- Dumping data for table `Particularite`
--

INSERT INTO `Particularite` (`NOPART`, `NOMPART`, `ADRESSEPART`, `DESCRIPTIONPART`, `HANDI_ACCESSIBLE`) VALUES
(1, 'dune', 'La Baule', 'La dune du Guézy s''élève derrière celle de Mazy jusqu''à une altitude de 25 mètres et se raccorde au sillon de Guérande vers la route de Nérac.', 0),
(2, 'plage', 'La Baule', 'La plage, que la ville partage avec les communes du Pouliguen et de Pornichet, mesure plus de huit kilomètres et considérée par beaucoup comme « l''une des plus belles plages d''Europe ». Elle borde les quartiers de La Baule-les-Pins, La Baule-Centre et Casino-Benoît. Près du Pouliguen, la plage Benoît est réputée pour son sable blanc très fin. Son estran recèle de grandes quantités de coques', 0),
(3, 'Aiguille du midi', 'Chamonix', 'L''aiguille du Midi fait partie des aiguilles de Chamonix, dans le massif du Mont-Blanc. Culminant à 3 842 mètres, elle est la plus haute des aiguilles de Chamonix', 1),
(4, 'Mer de Glace', 'Chamonix', 'La Mer de Glace est un glacier situé sur la face nord du massif du Mont-Blanc, formé de la jonction de trois glaciers plus petits que sont le glacier du Tacul, le glacier de Leschaux et le glacier de Talèfre.', 0),
(5, 'Cathédrale Notre-Dame-de-la-Se', 'Toulon', 'La cathédrale Sainte-Marie-de-la-Seds de Toulon est la cathédrale du diocèse de Toulon, créé au Ve siècle.', 1),
(6, 'Opéra de Toulon', 'Toulon', 'L''opéra de Toulon est un bâtiment spécialement conçu pour la représentation des opéras. Il est situé dans la ville de Toulon en France.', 1),
(7, 'magasin LVMH', 'Luxe', 'Vins, spiritueux, mode, maroquinerie, parfums, cosmétiques, montres, joaillerie, distribution sélective, médias', 1),
(8, 'Yves Saint Laurent Beauté', 'Luxe', 'Yves Saint Laurent Beauté est une maison de parfums française qui crée ou commercialise les marques YSL, Boucheron, Stella McCartney, Maison Martin Margiela, Viktor&Rolf, Cacharel et Diesel.', 1),
(9, 'Musée du bonbon', 'Uzès', 'Le Musée du bonbon d''Uzès est centré sur l''histoire et la fabrication des bonbons de la marque Haribo.', 1);

--
-- Dumping data for table `Possible`
--

INSERT INTO `Possible` (`NOACT`, `NOSTAT`) VALUES
(2, 1),
(3, 1),
(5, 1),
(8, 1),
(2, 2),
(3, 2),
(6, 2),
(8, 2),
(1, 3),
(2, 3),
(1, 4),
(3, 4),
(2, 5);

--
-- Dumping data for table `Prestataire`
--

INSERT INTO `Prestataire` (`NOPREST`, `NOSTAT`, `NOTYPP`, `NOMPREST`, `TELEPHONEPREST`, `EMAILPREST`) VALUES
(1, 1, 1, 'Robin Jeremy', '0589653287', 'r.jeremy@ul.com'),
(2, 1, 2, 'Apoté', '0258785412', 'apote@ul.com'),
(3, 2, 1, 'Anne-Sophie Duhaut', '0369875421', 'as@ul.com'),
(4, 2, 3, 'Mederic', '0125859632', 'mederic@ul.com'),
(5, 3, 1, 'Jean Durand', '0589632154', 'jd@ul.com'),
(6, 3, 2, 'Jeanne Smith', '0418589632', 'js@ul.com'),
(7, 4, 2, 'Paul Mesange', '0852541256', 'mesange@ul.com'),
(8, 5, 1, 'Julien Dupont', '0235698541', 'jul@ul.com');

--
-- Dumping data for table `Reservation`
--

INSERT INTO `Reservation` (`NORES`, `NDEM`, `NOHEBERG`, `DATERES`, `MONTANTRES`, `DATANNUL`, `ETATRES`, `ASSURANCE`) VALUES
(26, 44, 5, '2010-03-07', 30000, NULL, 'complete', 0),
(27, 45, 2, '2012-01-07', 4000, NULL, 'refusé', 1),
(36, 56, 3, '2012-04-27', 1000, NULL, 'complete', 0),
(37, 58, 6, '2012-04-27', 500, '2012-04-27', 'annule', 0);

--
-- Dumping data for table `Saison`
--

INSERT INTO `Saison` (`NOSAISON`, `DATEDEBS`, `DATEFINS`) VALUES
(6, '2011-01-01', '2012-12-31'),
(8, '2010-01-01', '2010-12-31');

--
-- Dumping data for table `Service`
--

INSERT INTO `Service` (`NOSERV`, `NOMSERVICE`, `COMPRIS`) VALUES
(2, 'garde d''enfant', 0),
(3, 'téléphone', 1),
(4, 'télévision', 1),
(5, 'service de chambre', 0),
(6, 'alcool', 1);

--
-- Dumping data for table `Station`
--

INSERT INTO `Station` (`NOSTAT`, `NOMSTAT`, `ADRESSESTAT`, `TELEPHONESTAT`, `EMAILSTAT`) VALUES
(1, 'La Baule', '35 avenue de la libération 44500 La Baule', '0445859631', 'labaule@ul.com'),
(2, 'ChamonixSki', '22 rue du ski 74000 Chamonix', '0528745123', 'chamonixski@ul.com'),
(3, 'ToulonDetente', '78 rue de la mer 83690 Toulon', '0258963274', 'toulondetente@ul.com'),
(4, 'Luxe station', '96 rue du luxe', '0148756963', 'luxestation@ul.com'),
(5, 'Station coeur', '58 avenue de l''amour 88000 Epinal', '0369875421', 'stationcoeur@ul.com');

--
-- Dumping data for table `TypeActivite`
--

INSERT INTO `TypeActivite` (`NOTYPACT`, `NOMTYPACT`) VALUES
(2, 'chanson'),
(5, 'excursion'),
(3, 'rencontre'),
(1, 'sport été'),
(4, 'sport hiver');

--
-- Dumping data for table `TypeHeberg`
--

INSERT INTO `TypeHeberg` (`NOTYPH`, `NOMTYPH`) VALUES
(5, 'appartement'),
(4, 'chambre'),
(12, 'chambre d''hôte'),
(2, 'emplacement'),
(11, 'villa');

--
-- Dumping data for table `TypePaiement`
--

INSERT INTO `TypePaiement` (`NOTYPPAIE`, `LIBELLETYPPAIE`) VALUES
(2, 'carte bleue'),
(1, 'chèque'),
(3, 'comptant');

--
-- Dumping data for table `TypePrest`
--

INSERT INTO `TypePrest` (`NOTYPP`, `NOMTYP`) VALUES
(2, 'camping'),
(1, 'centre de vacance'),
(3, 'hôtel');

--
-- Dumping data for table `Voir`
--

INSERT INTO `Voir` (`NOPART`, `NOSTAT`) VALUES
(6, 1),
(8, 1),
(9, 1),
(3, 2),
(4, 2),
(5, 3),
(6, 3),
(7, 4),
(8, 4),
(2, 5),
(3, 5),
(4, 5),
(9, 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
