-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29 Mai 2017 la 10:47
-- Versiune server: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `service`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `angajati`
--

CREATE TABLE `angajati` (
  `id_angajati` int(11) NOT NULL,
  `nume` varchar(50) DEFAULT NULL,
  `prenume` varchar(50) DEFAULT NULL,
  `varsta` int(11) DEFAULT NULL,
  `salariu` int(11) DEFAULT NULL,
  `data_angajarii` date DEFAULT NULL,
  `profesia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Salvarea datelor din tabel `angajati`
--

INSERT INTO `angajati` (`id_angajati`, `nume`, `prenume`, `varsta`, `salariu`, `data_angajarii`, `profesia`) VALUES
(5, 'Popescu', 'Marian', 30, 1600, '2017-04-20', 'mecanic'),
(6, 'Ionescu', 'Vasile', 50, 1800, '2006-01-13', 'tinichigiu'),
(7, 'Toma', 'Alexandru', 42, 1600, '2006-01-24', 'mecanic'),
(8, 'Ion', 'Marius', 25, 2000, '2016-01-28', 'vopsitor'),
(9, 'aa', 'aaaa', 19, 3211, '2017-05-10', 'wefw'),
(12, 'Nume', 'Marian', 30, 1600, '2017-05-10', 'mecanic'),
(13, 'User', 'Prenume', 30, 1221, '2017-05-24', 'aads');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `clientii`
--

CREATE TABLE `clientii` (
  `nume_client` varchar(50) DEFAULT NULL,
  `telefon` varchar(15) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_comanda` int(11) DEFAULT NULL,
  `adresa` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Salvarea datelor din tabel `clientii`
--

INSERT INTO `clientii` (`nume_client`, `telefon`, `id_client`, `id_comanda`, `adresa`) VALUES
('Alex Ciuperca', '072536215', 4, NULL, NULL),
('Turiac Florin', '07532659', 5, NULL, 'Strada Chisinaului Nr.47'),
('Coman Cosmin', '0235985125', 6, NULL, 'Strada Domneasca Nr.173'),
('Popescu Ovidiu', '0599885', 7, NULL, 'Strada Milcov Nr. 57'),
('Nume Prenume', '0725835741', 9, NULL, NULL),
('User Userescu', '0724262729', 10, NULL, NULL),
('Nume Prenume', '023159568', 11, NULL, NULL),
('Admin Adminescu', '0727818621', 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `comenzi`
--

CREATE TABLE `comenzi` (
  `id_comanda` int(11) NOT NULL,
  `data_efectuarii` date DEFAULT NULL,
  `data_primirii` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Salvarea datelor din tabel `comenzi`
--

INSERT INTO `comenzi` (`id_comanda`, `data_efectuarii`, `data_primirii`) VALUES
(1, '2017-01-16', '2017-01-18'),
(2, '2017-01-11', '2017-01-06'),
(3, '2017-01-05', '2017-01-10'),
(4, '2017-01-10', '2017-01-13'),
(5, '2017-01-16', '2017-01-19');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `factura`
--

CREATE TABLE `factura` (
  `data_facturarii` date DEFAULT NULL,
  `id_client` int(11) NOT NULL,
  `id_piese` varchar(50) NOT NULL,
  `id_garantie` int(11) NOT NULL,
  `id_angajat` int(11) NOT NULL,
  `data_intrarii` date DEFAULT NULL,
  `data_iesirii` date DEFAULT NULL,
  `observatii` varchar(1000) DEFAULT NULL,
  `id_factura` int(11) NOT NULL,
  `suma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Salvarea datelor din tabel `factura`
--

INSERT INTO `factura` (`data_facturarii`, `id_client`, `id_piese`, `id_garantie`, `id_angajat`, `data_intrarii`, `data_iesirii`, `observatii`, `id_factura`, `suma`) VALUES
('2017-01-18', 4, '4', 15, 5, '2017-01-15', '2017-01-18', NULL, 1, 700),
('2017-05-03', 10, '5', 17, 6, '2017-05-01', '2017-05-03', NULL, 2, 200),
('2017-05-23', 4, '6,4,6,4,', 1, 7, '2017-05-22', '2017-05-23', '', 12, 1440),
('2017-05-11', 5, '1,5,5,', 1, 7, '2017-05-10', '2017-05-11', '', 13, 100),
('2017-05-11', 5, '', 1, 7, '2017-05-10', '2017-05-11', '', 14, 0),
('2017-05-09', 6, '6,', 1, 9, '2017-05-09', '2017-05-09', '', 15, 20),
('2017-05-24', 4, '6,', 1, 9, '2017-05-10', '2017-05-24', '', 16, 20),
('2017-05-22', 5, '5,', 1, 7, '2017-05-22', '2017-05-22', '', 18, 25),
('2017-05-12', 4, '5,1,', 1, 7, '2017-05-03', '2017-05-12', '', 19, 75);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `garantie`
--

CREATE TABLE `garantie` (
  `id_garantie` int(11) NOT NULL,
  `data_emiterii` date DEFAULT NULL,
  `data_exp` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Salvarea datelor din tabel `garantie`
--

INSERT INTO `garantie` (`id_garantie`, `data_emiterii`, `data_exp`) VALUES
(15, '2017-01-18', '2017-07-18'),
(16, '2017-01-18', '2017-07-18'),
(17, '2017-01-19', '2017-04-19'),
(18, '2017-01-19', '2017-03-19'),
(19, '2017-01-19', '2017-04-19'),
(20, '2017-01-19', '2017-07-19'),
(21, '2017-01-07', '2017-07-07'),
(22, '2017-01-19', '2017-04-19'),
(23, '2017-01-19', '2017-07-19'),
(24, '2017-01-19', '2017-07-19'),
(25, '2017-01-07', '2017-07-07'),
(26, '2017-01-16', '2017-07-16'),
(27, '2017-01-19', '2017-07-19'),
(28, '2017-01-19', '2017-07-19'),
(29, '2017-05-22', '2017-11-22'),
(44, '2017-05-23', '2017-11-23'),
(45, '2017-05-16', '2017-11-16'),
(46, '2017-05-17', '2017-11-17'),
(47, '2017-05-11', '2017-11-11'),
(48, '2017-05-11', '2017-11-11'),
(49, '2017-05-09', '2017-11-09'),
(50, '2017-05-24', '2017-11-24'),
(51, '2017-05-24', '2017-11-24'),
(52, '2017-05-22', '2017-11-22'),
(53, '2017-05-12', '2017-11-12');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `nume_marca` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `marca`
--

INSERT INTO `marca` (`id_marca`, `nume_marca`) VALUES
(1, 'Renault'),
(2, 'Dacia'),
(3, 'Volkswagen'),
(4, 'Peugeot'),
(5, 'BMW'),
(6, 'Mercedes-Benz'),
(7, 'Ford'),
(8, 'Toyota'),
(9, 'Mazda'),
(10, 'Nissan'),
(11, 'Audi'),
(14, 'Seat'),
(13, 'Opel');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `model`
--

CREATE TABLE `model` (
  `id_model` int(11) NOT NULL,
  `nume_model` varchar(50) NOT NULL,
  `id_marca` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `model`
--

INSERT INTO `model` (`id_model`, `nume_model`, `id_marca`) VALUES
(1, 'Clio 2', 1),
(2, 'Megane 3', 1),
(3, 'Logan', 2),
(4, 'Golf', 3),
(5, 'Seria 3', 5),
(6, 'Seria 3', 5),
(8, '206', 4),
(9, 'Clasa C', 6);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `piese`
--

CREATE TABLE `piese` (
  `id_piesa` int(11) NOT NULL,
  `nume_piesa` varchar(50) NOT NULL,
  `prod` varchar(50) NOT NULL,
  `id_model` int(11) NOT NULL,
  `id_reparatie` int(11) NOT NULL,
  `pret` double NOT NULL,
  `id_garantie` int(11) DEFAULT NULL,
  `id_comanda` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Salvarea datelor din tabel `piese`
--

INSERT INTO `piese` (`id_piesa`, `nume_piesa`, `prod`, `id_model`, `id_reparatie`, `pret`, `id_garantie`, `id_comanda`) VALUES
(1, 'Placute de frana', 'Valeo', 1, 1, 50, NULL, NULL),
(4, 'Kit ambreiaj', 'Sachs', 3, 6, 700, NULL, NULL),
(5, 'Filtru ulei', 'Mann-Filter', 1, 2, 25, NULL, NULL),
(6, 'Filtru ulei', 'Mann-Filter', 3, 2, 20, NULL, NULL);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `tip_reparatie`
--

CREATE TABLE `tip_reparatie` (
  `id_reparatie` int(11) NOT NULL,
  `nume_rep` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `tip_reparatie`
--

INSERT INTO `tip_reparatie` (`id_reparatie`, `nume_rep`) VALUES
(1, 'sistem_franare'),
(2, 'revizie'),
(5, 'verificari_reglaje'),
(6, 'transmisie'),
(7, 'suspensie'),
(8, 'directie'),
(9, 'evacuare'),
(10, 'alimentare'),
(11, 'aprindere'),
(12, 'racire_motor'),
(13, 'distributie'),
(14, 'reparatii_optice'),
(15, 'tinichigerie');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_client` int(15) NOT NULL,
  `tip_user` int(50) NOT NULL DEFAULT '2'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `id_client`, `tip_user`) VALUES
(1, 'root', '1Qwertyu', 0, 1),
(3, 'root1', '2Qwertyu', 9, 1),
(4, 'user', '3Qwertyu', 10, 2),
(5, 'user2', '$2y$10$suVB1s5qwpSOsxVCFky7dOH3Hia1Lb58K9KOuYR1qLL.CEcJQPVSq', 11, 2),
(6, 'root2', '$2y$10$BfhFSKE22DXnURTn5n6tkOsbdSfrD0LJ4mudNNQc5ZjsDc77Bim8W', 12, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angajati`
--
ALTER TABLE `angajati`
  ADD PRIMARY KEY (`id_angajati`);

--
-- Indexes for table `clientii`
--
ALTER TABLE `clientii`
  ADD PRIMARY KEY (`id_client`);

--
-- Indexes for table `comenzi`
--
ALTER TABLE `comenzi`
  ADD PRIMARY KEY (`id_comanda`);

--
-- Indexes for table `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_angajat_idx` (`id_angajat`),
  ADD KEY `id_client_idx` (`id_client`),
  ADD KEY `id_garantie_idx` (`id_garantie`);

--
-- Indexes for table `garantie`
--
ALTER TABLE `garantie`
  ADD PRIMARY KEY (`id_garantie`);

--
-- Indexes for table `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id_model`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indexes for table `piese`
--
ALTER TABLE `piese`
  ADD PRIMARY KEY (`id_piesa`),
  ADD KEY `id_garantiep_idx` (`id_garantie`),
  ADD KEY `id_comanda_idx` (`id_comanda`),
  ADD KEY `id_model` (`id_model`),
  ADD KEY `id_reparatie` (`id_reparatie`);

--
-- Indexes for table `tip_reparatie`
--
ALTER TABLE `tip_reparatie`
  ADD PRIMARY KEY (`id_reparatie`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_client` (`id_client`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angajati`
--
ALTER TABLE `angajati`
  MODIFY `id_angajati` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `clientii`
--
ALTER TABLE `clientii`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `comenzi`
--
ALTER TABLE `comenzi`
  MODIFY `id_comanda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `garantie`
--
ALTER TABLE `garantie`
  MODIFY `id_garantie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id_model` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `piese`
--
ALTER TABLE `piese`
  MODIFY `id_piesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tip_reparatie`
--
ALTER TABLE `tip_reparatie`
  MODIFY `id_reparatie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Restrictii pentru tabele sterse
--

--
-- Restrictii pentru tabele `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `id_angajat` FOREIGN KEY (`id_angajat`) REFERENCES `angajati` (`id_angajati`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_client` FOREIGN KEY (`id_client`) REFERENCES `clientii` (`id_client`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrictii pentru tabele `piese`
--
ALTER TABLE `piese`
  ADD CONSTRAINT `id_comanda` FOREIGN KEY (`id_comanda`) REFERENCES `comenzi` (`id_comanda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_garantie` FOREIGN KEY (`id_garantie`) REFERENCES `garantie` (`id_garantie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
