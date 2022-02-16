-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 16, 2022 at 06:47 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learn`
--
CREATE DATABASE learn;
USE learn;
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
(8, 'NE', 'ja', 4, 2),
(9, '0', 'ne', 5, 3),
(10, '1', 'ja', 5, 3),
(11, 'blah', 'ja', 6, 3),
(12, 'rikotov kombi', 'ne', 6, 3),
(13, 'JA', 'ja', 7, 4),
(14, 'NE', 'ne', 7, 4),
(15, 'odgovor', 'ja', 8, 5),
(16, 'neodgovor', 'ne', 8, 5),
(17, '1', 'ja', 9, 6),
(18, '2', 'ne', 9, 6),
(19, 'Odgovor1.1', 'ja', 10, 7),
(20, 'Odgovor1.2', 'ja', 10, 7),
(21, 'Odgovor2.1', 'ne', 11, 7),
(22, 'Odgovor2.2', 'ne', 11, 7),
(23, 'jezus', 'ja', 12, 8),
(24, 'riko', 'ne', 12, 8);

-- --------------------------------------------------------

--
-- Table structure for table `resuje`
--

CREATE TABLE `resuje` (
  `test_idtest` int(11) NOT NULL,
  `uporabnik_upime` varchar(255) NOT NULL,
  `zacetek` datetime NOT NULL,
  `rezultat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `resuje`
--

INSERT INTO `resuje` (`test_idtest`, `uporabnik_upime`, `zacetek`, `rezultat`) VALUES
(1, 'franch', '2020-04-01 19:04:42', 2),
(1, 'markok', '2020-04-01 19:01:00', 0),
(1, 'merjan', '2020-07-21 19:48:59', 1),
(1, 'mlakarivan', '2020-04-01 18:56:13', 0),
(1, 'novakj', '2020-04-01 18:26:09', 2),
(2, 'markok', '2020-04-01 19:01:10', 2),
(2, 'merjan', '2020-09-07 01:46:12', -1),
(2, 'mlakarivan', '2020-04-01 18:58:13', 2),
(3, 'merjan', '2020-08-06 16:37:41', 2),
(4, 'merjan', '2020-08-06 16:46:05', 1),
(5, 'merjan', '2020-09-11 00:36:53', 0),
(8, 'merjan', '2020-09-11 00:39:47', 1);

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
(3, 'Učilnica z vsebino', 'Vsebina'),
(4, 'Učilnica z vsebino', 'neki sklp'),
(5, 'Učilnica z vsebino', '123'),
(6, 'Učilnica z vsebino', '234423'),
(7, 'Učilnica z vsebino', '123213'),
(8, 'Učilnica z vsebino', '12321'),
(9, 'Učilnica z vsebino', '12321'),
(10, 'Učilnica z vsebino', 'adfads'),
(11, 'Učilnica z vsebino', 'fasdfdsa'),
(12, 'Učilnica z vsebino', 'nekaj'),
(13, 'Učilnica z vsebino', 'dasdas'),
(14, 'Učilnica z vsebino', 'vasda'),
(15, 'Učilnica z vsebino', '12312'),
(16, 'Učilnica z vsebino', 'novi sklop2'),
(17, 'Zaklenjena učilnica', 'sklop zaklenjene učilnice'),
(18, 'Učilnica z vsebino', 'novi sklop2'),
(19, 'Učilnica z vsebino', 'novi sklop2'),
(20, 'Učilnica z vsebino', '12321'),
(21, 'Učilnica z vsebino', 'fadsfads'),
(22, 'Učilnica z vsebino', 'e21312'),
(23, 'Učilnica z vsebino', '12321'),
(24, 'Učilnica z vsebino', '12321'),
(25, 'Učilnica z vsebino', 'nova vsebina'),
(26, 'Učilnica z vsebino', '123'),
(27, 'Učilnica z vsebino', 'novo ime sklopa'),
(28, 'Učilnica z vsebino', 'novo ime sklopa'),
(29, 'Učilnica z vsebino', 'novo ime sklopa'),
(30, 'Učilnica z vsebino', 'novo ime sklopa'),
(31, 'Učilnica z vsebino', 'novo ime sklopa'),
(32, 'Učilnica z vsebino', 'novo ime sklopa'),
(33, 'Učilnica z vsebino', 'novo ime sklopa'),
(34, 'Učilnica z vsebino', 'novo ime sklopa'),
(35, 'Učilnica z vsebino', 'novo ime sklopa'),
(36, 'Učilnica z vsebino', 'novo ime sklopa'),
(37, 'Učilnica z vsebino', 'novo ime sklopa'),
(38, 'Učilnica z vsebino', 'novo ime sklopa'),
(39, 'Učilnica z vsebino', 'novo ime sklopa'),
(40, 'Učilnica z vsebino', 'novo ime sklopa'),
(41, 'Učilnica z vsebino', 'novo ime sklopa'),
(42, 'Učilnica z vsebino', 'fake vnos'),
(43, 'Učilnica z vsebino', 'fake vnos2'),
(44, 'Učilnica z vsebino', 'fake vnos lol'),
(45, 'Učilnica z vsebino', '123'),
(46, 'Učilnica z vsebino', '123'),
(47, 'Učilnica z vsebino', 'gejjj'),
(48, 'Učilnica z vsebino', '123');

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
(1, 'Učilnica s testi', 'Test z DA in NE', 7, 2, 'ja'),
(2, 'Učilnica s testi', 'Test z odgovori NE in DA', 30, 2, 'ja'),
(3, 'Učilnica s testi', 'eZ test', 5, 2, 'ja'),
(4, 'Prazna javna učilnica', 'brezveze test', 2, 1, 'ja'),
(5, 'Učilnica s testi', 'test test', 10, 1, 'ja'),
(6, 'Učilnica s testi', '1', 1, 1, 'ja'),
(7, 'Učilnica s testi', 'test z novo db povezavo', 543, 32, 'ja'),
(8, 'Učilnica z vsebino', 'test z enim odgovorom', 15, 2, 'ja');

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
('123', 'zasebna', 'NULL', 'Finance'),
('Photoshop fejk', 'zasebna', 'NULL', 'Grafično oblikovanje'),
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
  `hash` varchar(255) DEFAULT NULL,
  `refresh_token` varchar(255) DEFAULT NULL,
  `token_generated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uporabnik`
--

INSERT INTO `uporabnik` (`upime`, `ime`, `priimek`, `email`, `vkey`, `hash`, `refresh_token`, `token_generated`) VALUES
('franch', 'Franc', 'Horvat', '1@gmail.com', NULL, '$2b$10$lOGPHxCOtEIEx5V.i0SPSemtt5/aezgouDDhfmkE5W7FZg52mUpdu', NULL, NULL),
('marikova', 'Marija', 'Kovač', '2@gmail.com', NULL, '$2b$10$gNJWR4IWeaboTu5hvF7bjupca3qAn7xM27hv3HorleW1dRBhpu//C', NULL, NULL),
('markok', 'Marko', 'Kovačič', '3@gmail.com', NULL, '$2b$10$of1toWBA50C1foN1A3RfO.dF.8G8x.U.1xKx20yctcMCfJJM/fR3.', NULL, NULL),
('merjan', 'Jan', 'Merhar', 'myspdy@gmail.com', NULL, '$2b$10$MdmZ3hXMVIXsBUPTtJVOr.htjZsoVMo6KS/Y1IkH3WfnAgmim75Ky', '$2y$10$4QYUbjwcNZkabudnPZwJNu5zwTNXLr9hIq49l0.4IhjcW0hkyHPle', '2020-09-14'),
('mlakarivan', 'Ivan', 'Mlakar', '4@gmail.com', NULL, '$2b$10$Tovp.0YImZ1bPlahlvt7LOulAGgDWjWNw3WwQS/TiiaZItKNiZDWe', NULL, NULL),
('novakj', 'Janez', 'Novak', '5@gmail.com', NULL, '$2b$10$VV.6bz02YuWwbFh4g/HNE.hxncTFJb0ImQR0uElWqI3.iGv.7vm8W', NULL, NULL),
('zupanivan', 'Ivan', 'Župančič', '6@gmail.com', NULL, '$2b$10$GsirXNcgJN2b2hip8Gkm3uubRANphFaX6r9wNPfRHNb2Voax/G9ny', NULL, NULL);

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
('123', 'merjan', 'admin'),
('Photoshop fejk', 'merjan', 'admin'),
('Prazna javna učilnica', 'markok', 'user'),
('Prazna javna učilnica', 'merjan', 'admin'),
('Učilnica s testi', 'franch', 'user'),
('Učilnica s testi', 'markok', 'user'),
('Učilnica s testi', 'merjan', 'admin'),
('Učilnica s testi', 'mlakarivan', 'user'),
('Učilnica z vsebino', 'franch', 'user'),
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
(4, 2, 'Izberi odgovor, ki ni enak JA', 1),
(5, 3, 'odgovori z 1', 1),
(6, 3, 'izberi blah', 1),
(7, 4, 'JA ali NE', 1),
(8, 5, 'odgovor', 1),
(9, 6, '1', 1),
(10, 7, 'ffdsfsad', 1),
(11, 7, 'vprašanje 2', 1),
(12, 8, 'pravilen odgovor je jezus', 1);

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
(1, 17, 'Zaklenjena učilnica', 'text', 'karnekaj'),
(1, 41, 'Učilnica z vsebino', 'image/x-icon', 'favicon.ico'),
(2, 3, 'Učilnica z vsebino', 'image/jpeg', 'learn.jpg'),
(3, 17, 'Zaklenjena učilnica', 'text', 'novo besedilo');

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
  MODIFY `idodgovori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `resuje`
--
ALTER TABLE `resuje`
  MODIFY `test_idtest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sklop`
--
ALTER TABLE `sklop`
  MODIFY `idsklop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `idtest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vprasanja`
--
ALTER TABLE `vprasanja`
  MODIFY `idvprasanja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vsebina`
--
ALTER TABLE `vsebina`
  MODIFY `idvsebine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
