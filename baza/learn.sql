-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 19, 2020 at 07:12 PM
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
(8, 'vegova', 'ne', 1, 1),
(9, 'kočevje', 'ne', 1, 1),
(10, 'litostroj', 'ja', 1, 1),
(11, 'punce', 'ne', 2, 1),
(12, 'profesorji', 'ne', 2, 1),
(13, 'ocene ', 'ja', 2, 1),
(14, 'krneki', 'ja', 2, 1),
(15, 'ja', 'ja', 3, 1),
(16, 'ne', 'ja', 3, 1),
(17, 'bedene odgovor', 'ja', 4, 1),
(18, 'nebeden odgovor', 'ne', 4, 1),
(19, 'ja', 'ja', 5, 1),
(20, 'ne', 'ne', 5, 1),
(21, 'ja ', 'ja', 6, 1),
(22, 'ne', 'ne', 6, 1),
(29, 'so črni', 'ne', 7, 2),
(30, 'niso črni', 'ja', 7, 2),
(31, 'so preveliki', 'ne', 8, 2),
(32, 'polega masla bo plac', 'ja', 8, 2),
(33, '5', 'ne', 9, 2),
(34, '6', 'ne', 9, 2),
(35, '4', 'ja', 9, 2),
(36, 'jep', 'ja', 10, 3),
(37, 'nope', 'ne', 10, 3),
(38, 'maxi, dončič, porzingod', 'ja', 11, 3),
(39, 'neki random tipčki', 'ne', 11, 3),
(40, 'lakers', 'ne', 12, 3),
(41, 'clippers', 'ja', 12, 3);

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
(1, 'franch', '2019-01-01 03:22:21', 19),
(1, 'gej', '2020-03-20 06:11:00', 12),
(2, 'gej', '2018-01-01 23:22:21', 33),
(2, 'marikova', '2018-11-01 23:02:21', 92),
(2, 'riko', '2020-01-01 22:22:23', 69),
(2, 'zupanivan', '2018-03-18 18:18:21', 18),
(3, 'franch', '2020-02-12 04:10:04', 19),
(3, 'gej', '2020-03-20 06:11:00', 12),
(3, 'merjan', '2020-03-17 18:18:35', 2);

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
(1, 'IKP', 'davčna policija'),
(2, 'IKP', ''),
(3, 'IKP', 'drugi sklop pri ikp'),
(4, 'RPA', 'najbolj predmet na svetu'),
(5, 'krneik', 'krneik sloni'),
(6, 'IKP', 'Test slik1'),
(7, 'IKP', 'kawabunga slike'),
(8, '123', 'sadas'),
(9, 'IKP', 'SLIKE na MAPO'),
(10, 'IKP', 'SLIKE na MAPO'),
(11, 'IKP', 'SLIKE ala anti-TOTH'),
(12, 'IKP', 'Davčna stopnja v Sloveniji '),
(13, 'IKP', 'Vzorčne slike'),
(14, 'IKP', 'Nalaganje dokumentov'),
(15, 'IKP', 'asdas'),
(16, 'IKP', 'asdsa'),
(17, 'IKP', 'asda'),
(18, 'IKP', 'slike'),
(19, 'IKP', 'dadsa'),
(20, 'IKP', 'slikce'),
(21, 'IKP', 'dope stuff'),
(22, 'IKP', 'slikce'),
(23, 'IKP', 'slikice - nudes'),
(24, 'IKP', 'neka useless snov'),
(25, 'IKP', 'dokumenti'),
(26, 'IKP', 'dokumenti'),
(27, 'Dodatna učilnica, ki je brez pomena', 'ker nekaj'),
(28, 'Dodatna učilnica, ki je brez pomena', '213'),
(29, 'Nova učilnica', 'Dodajanje vsebine v učilnico');

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
(1, 'IKP', 'tezek kviz', 25, 20, 'ja'),
(2, 'krneik', 'Sloni', 45, 10, 'ja'),
(3, 'IKP', 'NBA', 24, 23, 'ja');

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
('123', 'javna', 'NULL', 'Finance'),
('blah', 'javna', 'NULL', 'Finance'),
('cekin', 'javna', 'NULL', 'Finance'),
('Dodatna učilnica, ki je brez pomena', 'javna', 'NULL', 'Finance'),
('Glazba', 'zasebna', '123', 'Glasba'),
('IKP', 'javna', 'NULL', 'Finance'),
('krneik', 'javna', 'NULL', 'Finance'),
('Neka učilnica brez imena', 'javna', 'NULL', 'Finance'),
('Nova učilnica', 'zasebna', '12345678', 'Finance'),
('RPA', 'javna', 'NULL', 'Programiranje');

-- --------------------------------------------------------

--
-- Table structure for table `uporabnik`
--

CREATE TABLE `uporabnik` (
  `upime` varchar(255) NOT NULL,
  `geslo` varchar(255) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `priimek` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `vkey` varchar(255) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uporabnik`
--

INSERT INTO `uporabnik` (`upime`, `geslo`, `ime`, `priimek`, `email`, `vkey`, `hash`) VALUES
('dasasad', '123', 'sdfs', 'asdasd', 'myspdy@gmail.com', '8d92de6a1a51d627f7fe12073b12d9a5', '$2y$10$im8rpIalhqqfrjLrlqnQBOzuDXk9JeY33qgjUw0mGrUUAZ8CXipuC'),
('franch', '456', 'Franc', 'Horvat', '', NULL, '$2y$10$3.I71BMZ1iH0oNExckGcTOrZP1ij3S8zgbfYdUnUBzkD0rT524Rly'),
('gej', '123', 'Gej', 'Nekdo', '', NULL, '$2y$10$2CD1sZgiwhheraUWk0Nn2.hyNXxFtfOBTsCo8BVeoZ6HNrkSE7aCy'),
('jangej', 'jangej', 'jangej', 'gej', '', NULL, '$2y$10$wQzu1B9VuKwAa07s3M2UievD0xmygpMTOvuQMSOU9U7J7HLtSBgAC'),
('janmerhar', '123', 'Jan', 'Merhar', 'myspdy@gmail.com', '', '$2y$10$XVCcBTQhrgQ2/d/Q5bsYGu0KmefLGSEIaj9dp4EZZkR96mZuzPCC2'),
('janmerhara', '123', 'd', 'sd', 'myspdy@gmail.com', 'b81c17a1132412ba08e0d8d1880a8753', '$2y$10$4FJm9jSSJwtSMbsx.qvGKeMnGYVd4E7vH5Wm7yh6NmpNbqdeEv7QK'),
('kjlfsdl', '123', 'fsfsdjdfls', 'fdfsdfsd', 'myspdy@gmail.com', '954343423b3e8532b118ad5ee04bd294', '$2y$10$KzXmt5K62sWgmygN5d2/DuTTW2IRrLnCPGr71en/DKl4TdZSCorOm'),
('marikova', '789', 'Marija', 'Kovač', '', NULL, '$2y$10$uPBCptRV3uVo.pakCUpMFuNRDlBHOl1o2r7VZIZX4dtTGk/bR32wu'),
('markok', '654', 'Marko', 'Kovačič', '', NULL, '$2y$10$rNWAEJCB3hmv82Ui3pYKQecv6TX74uflPyZb.7e97gskAgbGMv01u'),
('merjan', '123', 'Jan', 'Merhar', '', NULL, '$2y$10$2CD1sZgiwhheraUWk0Nn2.hyNXxFtfOBTsCo8BVeoZ6HNrkSE7aCy'),
('mlakarivan', '987', 'Ivan', 'Mlakar', '', NULL, '$2y$10$H94eCZtme4G5AOPNmfosYuBkgbtdtUiU.QJTsujr9SxF58onyaQSW'),
('novakj', '321', 'Janez', 'Novak', '', NULL, '$2y$10$XGB.gUgz.F8CXzg5qmgIceHzFajOgcWYi6jWL0vwamB.KWjGFTXQW'),
('novoime', '123', 'Novo', 'Ime', '', NULL, '$2y$10$2CD1sZgiwhheraUWk0Nn2.hyNXxFtfOBTsCo8BVeoZ6HNrkSE7aCy'),
('riko', '123', 'Riko', 'Jerman', '', NULL, '$2y$10$2CD1sZgiwhheraUWk0Nn2.hyNXxFtfOBTsCo8BVeoZ6HNrkSE7aCy'),
('zupanivan', '654', 'Ivan', 'Župančič', '', NULL, '$2y$10$rNWAEJCB3hmv82Ui3pYKQecv6TX74uflPyZb.7e97gskAgbGMv01u');

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
('123', 'jangej', 'user'),
('123', 'merjan', 'user'),
('123', 'novoime', 'admin'),
('blah', 'merjan', 'user'),
('blah', 'novoime', 'admin'),
('cekin', 'merjan', 'user'),
('cekin', 'novoime', 'admin'),
('Dodatna učilnica, ki je brez pomena', 'merjan', 'admin'),
('Glazba', 'jangej', 'user'),
('Glazba', 'merjan', 'user'),
('Glazba', 'novakj', 'admin'),
('Glazba', 'novoime', 'user'),
('Glazba', 'riko', 'user'),
('Glazba', 'zupanivan', 'user'),
('IKP', 'franch', 'user'),
('IKP', 'marikova', 'user'),
('IKP', 'merjan', 'admin'),
('IKP', 'mlakarivan', 'user'),
('IKP', 'novoime', 'user'),
('krneik', 'jangej', 'user'),
('krneik', 'merjan', 'user'),
('krneik', 'novoime', 'user'),
('Neka učilnica brez imena', 'merjan', 'admin'),
('Nova učilnica', 'merjan', 'admin'),
('RPA', 'jangej', 'admin'),
('RPA', 'merjan', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `vprasanja`
--

CREATE TABLE `vprasanja` (
  `idvprasanja` int(11) NOT NULL,
  `test_idtest` int(11) NOT NULL,
  `vprasanje` varchar(255) NOT NULL,
  `tocke` int(11) NOT NULL,
  `slika` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vprasanja`
--

INSERT INTO `vprasanja` (`idvprasanja`, `test_idtest`, `vprasanje`, `tocke`, `slika`) VALUES
(1, 1, 'katera šola boljsa', 1, NULL),
(2, 1, 'zakaj se vpišejo na vegovo', 1, NULL),
(3, 1, 'ali imamo premali wc-jev za moške', 1, NULL),
(4, 1, 'bedno vprašanje', 1, NULL),
(5, 1, 'again?', 1, NULL),
(6, 1, 'rip', 1, NULL),
(7, 2, 'Ali so sloni črni', 1, NULL),
(8, 2, 'Alli lahko spraimo slone v hladilnik', 1, NULL),
(9, 2, 'Koliko nog imajo sloni', 1, NULL),
(10, 3, 'kobe bryant', 1, NULL),
(11, 3, 'tripple dirks', 1, NULL),
(12, 3, 'lakers vs clippers', 1, NULL);

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
(1, 4, 'RPA', 'text', 'krneki besedilo'),
(1, 5, 'krneik', 'text', 'so debeli'),
(1, 8, '123', 'text', 'asasd'),
(1, 29, 'Nova učilnica', 'text', 'Logotip učilnice'),
(2, 4, 'RPA', 'text', 'text2'),
(2, 5, 'krneik', 'text', 'ga lahko spraviš v hladilnik'),
(2, 29, 'Nova učilnica', 'image/png', 'logo.png'),
(3, 5, 'krneik', 'text', 'so čudni'),
(4, 5, 'krneik', 'text', 'ivijo v afriki in niso črni'),
(4, 29, 'Nova učilnica', 'text', 'Dokument'),
(5, 29, 'Nova učilnica', 'application/wps-office.docx', 'Dokument.docx');

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
  MODIFY `idodgovori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `resuje`
--
ALTER TABLE `resuje`
  MODIFY `test_idtest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sklop`
--
ALTER TABLE `sklop`
  MODIFY `idsklop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `idtest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `vprasanja`
--
ALTER TABLE `vprasanja`
  MODIFY `idvprasanja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vsebina`
--
ALTER TABLE `vsebina`
  MODIFY `idvsebine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
