-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2020 at 07:16 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learn`
--
create database learn;
use learn;
-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `imekategorije` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`imekategorije`) VALUES
('Finance'),
('Fotografija'),
('Glasba'),
('Grafično oblikovanje'),
('Osebnostini razvoj'),
('Pisarniška produktivnost'),
('Poslovanje'),
('Programiranje'),
('Učenje'),
('Zdravje in vadba'),
('Življenski slog');

-- --------------------------------------------------------

--
-- Table structure for table `odgovori`
--

CREATE TABLE `odgovori` (
  `idodgovori` int(11) NOT NULL,
  `odgovor` varchar(255) NOT NULL,
  `pravilen` enum('ja','ne') NOT NULL,
  `vprasanja_idvprasanja` int(11) NOT NULL,
  `vprasanja_test_idtest` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `odgovori`
--

INSERT INTO `odgovori` (`idodgovori`, `odgovor`, `pravilen`, `vprasanja_idvprasanja`, `vprasanja_test_idtest`) VALUES
(1, 'DA', 'ja', 1, 1),
(2, 'NE', 'ne', 1, 1),
(3, 'DA', 'ne', 2, 1),
(4, 'NE', 'ja', 2, 1),
(5, 'JA', 'ja', 3, 2),
(6, 'NE', 'ne', 3, 2),
(7, 'JA', 'ne', 4, 2),
(8, 'NE', 'ja', 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `resuje`
--

CREATE TABLE `resuje` (
  `test_idtest` int(11) NOT NULL,
  `uporabnik_upime` varchar(255) NOT NULL,
  `zacetek` datetime NOT NULL,
  `rezultat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `resuje`
--

INSERT INTO `resuje` (`test_idtest`, `uporabnik_upime`, `zacetek`, `rezultat`) VALUES
(1, 'franch', '2020-04-01 19:04:42', 2),
(1, 'markok', '2020-04-01 19:01:00', 0),
(1, 'mlakarivan', '2020-04-01 18:56:13', 0),
(1, 'novakj', '2020-04-01 18:26:09', 2),
(2, 'markok', '2020-04-01 19:01:10', 2),
(2, 'mlakarivan', '2020-04-01 18:58:13', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sklop`
--

CREATE TABLE `sklop` (
  `idsklop` int(11) NOT NULL,
  `ucilnica_imeucilnice` varchar(255) NOT NULL,
  `ime_sklopa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sklop`
--

INSERT INTO `sklop` (`idsklop`, `ucilnica_imeucilnice`, `ime_sklopa`) VALUES
(1, 'Učilnica z vsebino', 'Vsebina'),
(2, 'Učilnica z vsebino', 'Vsebina'),
(3, 'Učilnica z vsebino', 'Vsebina');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `idtest` int(11) NOT NULL,
  `ucilnica_imeucilnice` varchar(255) NOT NULL,
  `ime_testa` varchar(255) NOT NULL,
  `trajanje` int(11) NOT NULL,
  `st_vprasanj` int(11) NOT NULL,
  `vidnen` enum('ja','ne') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`idtest`, `ucilnica_imeucilnice`, `ime_testa`, `trajanje`, `st_vprasanj`, `vidnen`) VALUES
(1, 'Učilnica s testi', 'Test z DA in NE', 2, 2, 'ja'),
(2, 'Učilnica s testi', 'Test z odgovori NE in DA', 3, 2, 'ja');

-- --------------------------------------------------------

--
-- Table structure for table `ucilnica`
--

CREATE TABLE `ucilnica` (
  `imeucilnice` varchar(255) NOT NULL,
  `vrsta_ucilnice` enum('zasebna','javna') NOT NULL,
  `kljuc` varchar(50) DEFAULT NULL,
  `kategorija_imekategorije` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ucilnica`
--

INSERT INTO `ucilnica` (`imeucilnice`, `vrsta_ucilnice`, `kljuc`, `kategorija_imekategorije`) VALUES
('Prazna javna učilnica', 'javna', 'NULL', 'Glasba'),
('Učilnica s testi', 'javna', 'NULL', 'Finance'),
('Učilnica z vsebino', 'javna', 'NULL', 'Programiranje'),
('Zaklenjena učilnica', 'zasebna', '123', 'Finance');

-- --------------------------------------------------------

--
-- Table structure for table `uporabnik`
--

CREATE TABLE `uporabnik` (
  `upime` varchar(255) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `priimek` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `vkey` varchar(255) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uporabnik`
--

INSERT INTO `uporabnik` (`upime`, `ime`, `priimek`, `email`, `vkey`, `hash`) VALUES
('franch', 'Franc', 'Horvat', '1@gmail.com', NULL, '$2y$10$3.I71BMZ1iH0oNExckGcTOrZP1ij3S8zgbfYdUnUBzkD0rT524Rly'),
('marikova', 'Marija', 'Kovač', '2@gmail.com', NULL, '$2y$10$uPBCptRV3uVo.pakCUpMFuNRDlBHOl1o2r7VZIZX4dtTGk/bR32wu'),
('markok', 'Marko', 'Kovačič', '3@gmail.com', NULL, '$2y$10$rNWAEJCB3hmv82Ui3pYKQecv6TX74uflPyZb.7e97gskAgbGMv01u'),
('merjan', 'Jan', 'Merhar', 'myspdy@gmail.com', NULL, '$2y$10$2CD1sZgiwhheraUWk0Nn2.hyNXxFtfOBTsCo8BVeoZ6HNrkSE7aCy'),
('mlakarivan', 'Ivan', 'Mlakar', '4@gmail.com', NULL, '$2y$10$H94eCZtme4G5AOPNmfosYuBkgbtdtUiU.QJTsujr9SxF58onyaQSW'),
('novakj', 'Janez', 'Novak', '5@gmail.com', NULL, '$2y$10$XGB.gUgz.F8CXzg5qmgIceHzFajOgcWYi6jWL0vwamB.KWjGFTXQW'),
('zupanivan', 'Ivan', 'Župančič', '6@gmail.com', NULL, '$2y$10$rNWAEJCB3hmv82Ui3pYKQecv6TX74uflPyZb.7e97gskAgbGMv01u');

-- --------------------------------------------------------

--
-- Table structure for table `vclanjen`
--

CREATE TABLE `vclanjen` (
  `ucilnica_imeucilnice` varchar(255) NOT NULL,
  `uporabnik_upime` varchar(255) NOT NULL,
  `vrsta_clanstva` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vclanjen`
--

INSERT INTO `vclanjen` (`ucilnica_imeucilnice`, `uporabnik_upime`, `vrsta_clanstva`) VALUES
('Prazna javna učilnica', 'markok', 'user'),
('Prazna javna učilnica', 'merjan', 'admin'),
('Učilnica s testi', 'franch', 'user'),
('Učilnica s testi', 'markok', 'user'),
('Učilnica s testi', 'merjan', 'admin'),
('Učilnica s testi', 'mlakarivan', 'user'),
('Učilnica s testi', 'novakj', 'user'),
('Učilnica z vsebino', 'markok', 'user'),
('Učilnica z vsebino', 'merjan', 'admin'),
('Učilnica z vsebino', 'mlakarivan', 'user'),
('Zaklenjena učilnica', 'markok', 'user'),
('Zaklenjena učilnica', 'merjan', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `vprasanja`
--

CREATE TABLE `vprasanja` (
  `idvprasanja` int(11) NOT NULL,
  `test_idtest` int(11) NOT NULL,
  `vprasanje` varchar(255) NOT NULL,
  `tocke` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vprasanja`
--

INSERT INTO `vprasanja` (`idvprasanja`, `test_idtest`, `vprasanje`, `tocke`) VALUES
(1, 1, 'Odgovori z DA', 1),
(2, 1, 'Odgovori z NE', 1),
(3, 2, 'Izberi JA', 1),
(4, 2, 'Izberi odgovor, ki ni enak JA', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vsebina`
--

CREATE TABLE `vsebina` (
  `idvsebine` int(11) NOT NULL,
  `sklop_idsklop` int(11) NOT NULL,
  `sklop_ucilnica_imeucilnice` varchar(255) NOT NULL,
  `vrsta` varchar(50) NOT NULL,
  `besedilo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vsebina`
--

INSERT INTO `vsebina` (`idvsebine`, `sklop_idsklop`, `sklop_ucilnica_imeucilnice`, `vrsta`, `besedilo`) VALUES
(1, 3, 'Učilnica z vsebino', 'text', 'Besedilo.'),
(2, 3, 'Učilnica z vsebino', 'image/jpeg', 'learn.jpg'),
(3, 3, 'Učilnica z vsebino', 'application/vnd.oasis.opendocument.text', 'Prazen dokument.odt');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`imekategorije`);

--
-- Indexes for table `odgovori`
--
ALTER TABLE `odgovori`
  ADD PRIMARY KEY (`idodgovori`,`vprasanja_idvprasanja`,`vprasanja_test_idtest`),
  ADD KEY `fk_odgovori_vprasanja1_idx` (`vprasanja_idvprasanja`,`vprasanja_test_idtest`);

--
-- Indexes for table `resuje`
--
ALTER TABLE `resuje`
  ADD PRIMARY KEY (`test_idtest`,`uporabnik_upime`),
  ADD KEY `fk_test_has_uporabnik_uporabnik1_idx` (`uporabnik_upime`),
  ADD KEY `fk_test_has_uporabnik_test1_idx` (`test_idtest`);

--
-- Indexes for table `sklop`
--
ALTER TABLE `sklop`
  ADD PRIMARY KEY (`idsklop`,`ucilnica_imeucilnice`),
  ADD KEY `fk_vsebina_ucilnica1_idx` (`ucilnica_imeucilnice`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`idtest`,`ucilnica_imeucilnice`),
  ADD KEY `fk_test_ucilnica1_idx` (`ucilnica_imeucilnice`);

--
-- Indexes for table `ucilnica`
--
ALTER TABLE `ucilnica`
  ADD PRIMARY KEY (`imeucilnice`,`kategorija_imekategorije`),
  ADD KEY `fk_ucilnica_kategorija1_idx` (`kategorija_imekategorije`);

--
-- Indexes for table `uporabnik`
--
ALTER TABLE `uporabnik`
  ADD PRIMARY KEY (`upime`),
  ADD UNIQUE KEY `upime_UNIQUE` (`upime`);

--
-- Indexes for table `vclanjen`
--
ALTER TABLE `vclanjen`
  ADD PRIMARY KEY (`ucilnica_imeucilnice`,`uporabnik_upime`),
  ADD KEY `fk_ucilnica_has_uporabnik_uporabnik1_idx` (`uporabnik_upime`),
  ADD KEY `fk_ucilnica_has_uporabnik_ucilnica_idx` (`ucilnica_imeucilnice`);

--
-- Indexes for table `vprasanja`
--
ALTER TABLE `vprasanja`
  ADD PRIMARY KEY (`idvprasanja`,`test_idtest`),
  ADD KEY `fk_vprasanja_test1_idx` (`test_idtest`);

--
-- Indexes for table `vsebina`
--
ALTER TABLE `vsebina`
  ADD PRIMARY KEY (`idvsebine`,`sklop_idsklop`,`sklop_ucilnica_imeucilnice`),
  ADD KEY `fk_datoteke_sklop1_idx` (`sklop_idsklop`,`sklop_ucilnica_imeucilnice`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `odgovori`
--
ALTER TABLE `odgovori`
  MODIFY `idodgovori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `resuje`
--
ALTER TABLE `resuje`
  MODIFY `test_idtest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sklop`
--
ALTER TABLE `sklop`
  MODIFY `idsklop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `idtest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vprasanja`
--
ALTER TABLE `vprasanja`
  MODIFY `idvprasanja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vsebina`
--
ALTER TABLE `vsebina`
  MODIFY `idvsebine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `odgovori`
--
ALTER TABLE `odgovori`
  ADD CONSTRAINT `fk_odgovori_vprasanja1` FOREIGN KEY (`vprasanja_idvprasanja`,`vprasanja_test_idtest`) REFERENCES `vprasanja` (`idvprasanja`, `test_idtest`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `resuje`
--
ALTER TABLE `resuje`
  ADD CONSTRAINT `fk_test_has_uporabnik_test1` FOREIGN KEY (`test_idtest`) REFERENCES `test` (`idtest`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_test_has_uporabnik_uporabnik1` FOREIGN KEY (`uporabnik_upime`) REFERENCES `uporabnik` (`upime`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sklop`
--
ALTER TABLE `sklop`
  ADD CONSTRAINT `fk_vsebina_ucilnica1` FOREIGN KEY (`ucilnica_imeucilnice`) REFERENCES `ucilnica` (`imeucilnice`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `fk_test_ucilnica1` FOREIGN KEY (`ucilnica_imeucilnice`) REFERENCES `ucilnica` (`imeucilnice`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ucilnica`
--
ALTER TABLE `ucilnica`
  ADD CONSTRAINT `fk_ucilnica_kategorija1` FOREIGN KEY (`kategorija_imekategorije`) REFERENCES `kategorija` (`imekategorije`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `vclanjen`
--
ALTER TABLE `vclanjen`
  ADD CONSTRAINT `fk_ucilnica_has_uporabnik_ucilnica` FOREIGN KEY (`ucilnica_imeucilnice`) REFERENCES `ucilnica` (`imeucilnice`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ucilnica_has_uporabnik_uporabnik1` FOREIGN KEY (`uporabnik_upime`) REFERENCES `uporabnik` (`upime`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `vprasanja`
--
ALTER TABLE `vprasanja`
  ADD CONSTRAINT `fk_vprasanja_test1` FOREIGN KEY (`test_idtest`) REFERENCES `test` (`idtest`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `vsebina`
--
ALTER TABLE `vsebina`
  ADD CONSTRAINT `fk_datoteke_sklop1` FOREIGN KEY (`sklop_idsklop`,`sklop_ucilnica_imeucilnice`) REFERENCES `sklop` (`idsklop`, `ucilnica_imeucilnice`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
