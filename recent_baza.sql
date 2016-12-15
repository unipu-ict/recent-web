-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2016 at 08:00 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recent_baza`
--

-- --------------------------------------------------------

--
-- Table structure for table `evidencija`
--

CREATE TABLE `evidencija` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `razlog_id` int(11) DEFAULT NULL,
  `uredaj_id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `vrijeme` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `evidencija`
--

INSERT INTO `evidencija` (`id`, `user_id`, `razlog_id`, `uredaj_id`, `datum`, `vrijeme`) VALUES
(1, 2, 1, 0, '2016-11-11', '07:00:00'),
(2, 3, 1, 0, '2016-11-11', '07:00:00'),
(3, 4, 1, 0, '2016-11-11', '07:00:00'),
(4, 5, 1, 0, '2016-11-11', '07:00:00'),
(5, 6, 1, 0, '2016-11-11', '07:00:00'),
(6, 2, 3, 0, '2016-11-11', '10:26:00'),
(7, 3, 3, 0, '2016-11-11', '10:26:00'),
(8, 4, 3, 0, '2016-11-11', '10:26:00'),
(9, 5, 3, 0, '2016-11-11', '10:26:00'),
(10, 6, 3, 0, '2016-11-11', '10:26:00'),
(11, 2, 1, 0, '2016-11-11', '10:58:00'),
(12, 3, 1, 0, '2016-11-11', '10:58:00'),
(13, 4, 1, 0, '2016-11-11', '10:58:00'),
(14, 5, 1, 0, '2016-11-11', '10:58:00'),
(15, 6, 1, 0, '2016-11-11', '10:58:00'),
(16, 2, 2, 0, '2016-11-11', '15:03:00'),
(17, 3, 2, 0, '2016-11-11', '15:03:00'),
(18, 4, 2, 0, '2016-11-11', '15:03:00'),
(19, 5, 2, 0, '2016-11-11', '15:03:00'),
(20, 6, 2, 0, '2016-11-11', '15:03:00'),
(21, 2, 1, 0, '2016-11-12', '07:04:00'),
(22, 3, 1, 0, '2016-11-12', '07:04:00'),
(23, 4, 1, 0, '2016-11-12', '07:04:00'),
(24, 5, 1, 0, '2016-11-12', '07:04:00'),
(25, 6, 1, 0, '2016-11-12', '07:04:00'),
(26, 2, 3, 0, '2016-11-12', '10:31:00'),
(27, 3, 3, 0, '2016-11-12', '10:31:00'),
(28, 4, 3, 0, '2016-11-12', '10:31:00'),
(29, 5, 3, 0, '2016-11-12', '10:31:00'),
(30, 6, 3, 0, '2016-11-12', '10:31:00'),
(31, 2, 1, 0, '2016-11-12', '11:09:15'),
(32, 3, 1, 0, '2016-11-12', '11:09:15'),
(33, 4, 1, 0, '2016-11-12', '11:09:15'),
(34, 5, 1, 0, '2016-11-12', '11:09:15'),
(35, 6, 1, 0, '2016-11-12', '11:09:15'),
(36, 2, 2, 0, '2016-11-12', '15:11:26'),
(37, 3, 2, 0, '2016-11-12', '15:11:26'),
(38, 4, 2, 0, '2016-11-12', '15:11:26'),
(39, 5, 2, 0, '2016-11-12', '15:11:26'),
(40, 6, 2, 0, '2016-11-12', '15:11:26');

-- --------------------------------------------------------

--
-- Table structure for table `evidencija_dana`
--

CREATE TABLE `evidencija_dana` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `done_business_hours` double NOT NULL,
  `vrijeme_dolaska` time NOT NULL,
  `vrijeme_odlaska` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `evidencija_dana`
--

INSERT INTO `evidencija_dana` (`id`, `user_id`, `datum`, `done_business_hours`, `vrijeme_dolaska`, `vrijeme_odlaska`) VALUES
(1, 2, '2016-11-11', 8, '07:00:00', '15:00:00'),
(2, 3, '2016-11-11', 8, '07:00:00', '15:00:00'),
(3, 4, '2016-11-11', 8, '07:00:00', '15:00:00'),
(4, 5, '2016-11-11', 8, '07:00:00', '15:00:00'),
(5, 6, '2016-11-11', 8, '07:00:00', '15:00:00'),
(6, 2, '2016-11-12', 8, '07:00:00', '15:00:00'),
(7, 3, '2016-11-12', 8, '07:00:00', '15:00:00'),
(8, 4, '2016-11-12', 8, '07:00:00', '15:00:00'),
(9, 5, '2016-11-12', 8, '07:00:00', '15:00:00'),
(10, 6, '2016-11-12', 8, '07:00:00', '15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `fos_group`
--

CREATE TABLE `fos_group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `name`, `surname`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 'admin@gmail.com', 1, 'lf2yg3q9ayowwsggow4wwgkogcckwck', '$2y$13$ymzmn2TbLaeVzPp91XLFt./sHcQXm4LZXqfepqE0I5kKdC4MScy6O', '2016-12-01 17:03:25', 'wp4Hjce8v687ksWiRY6vGv7Q-3kbjQ-evaijEGm-g7A', '2016-11-03 17:50:46', 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 'admin', 'admin'),
(2, 'masimo.orbanic', 'masimo.orbanic', 'masimo.orbanic@gmai.com', 'masimo.orbanic@gmai.com', 1, '6xpat06anps80w8kcokkk4og84wss08', '$2y$13$Ya/hXTqnFGrngaRCIPbJ1uIk8j2eNfdB/q8ApHVOPGBFnmrCaAenW', '2016-12-09 08:09:00', 'gvj57N3bgMgLPqaDTgWx9dlINpjXjOqJArrHM_YvXjM', '2016-12-01 17:03:08', 'a:0:{}', 'Masimo', 'Orbanic'),
(3, 'mihovil.petkovic', 'mihovil.petkovic', 'mihovil.petko@gmail.com', 'mihovil.petko@gmail.com', 1, 'j5x1sim12coocowcs44kwccswcgoco0', '$2y$13$b175PXqh4h3siH6e9he7yenGbERBUmUU2bOMYjZVbxlisxdNZOS/a', '2016-11-01 13:15:15', NULL, NULL, 'a:0:{}', 'Mihovil', 'Peković'),
(4, 'patrik.grof', 'patrik.grof', 'patrik.grofina@unipu.xom', 'patrik.grofina@unipu.xom', 1, 'md8r6n0vx80scs0cww48ogc48s0oc4o', '$2y$13$bC49BJd.Zo02BvNzmUgrne60DV9mmnxmSESGKsBAYBAt8ZjYsgKEq', '2016-11-02 14:27:45', NULL, NULL, 'a:0:{}', 'Patrik', 'Grof'),
(5, 'antun.kova', 'antun.kova', 'antun.kova@unipu.com', 'antun.kova@unipu.com', 1, 'md8r6n0vx80scs0cww48ogc48s0oc4o', '$2y$13$bC49BJd.Zo02BvNzmUgrne60DV9mmnxmSESGKsBAYBAt8ZjYsgKEq', '2016-11-21 18:08:32', NULL, NULL, 'a:0:{}', 'Antun', 'Kovacevic'),
(6, 'marino.peresa', 'marino.peresa', 'maperes@unipu.hr', 'maperes@unipu.hr', 1, NULL, '$2y$13$RsIwL2KbPQ8XmL.6w1xDvOzKZCuViNkbz1468.xB0wsA.ZrrD3sKe', '2016-12-07 13:16:57', NULL, NULL, 'a:0:{}', 'Marino', 'Peresa');

-- --------------------------------------------------------

--
-- Table structure for table `fos_user_user_group`
--

CREATE TABLE `fos_user_user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `razlog`
--

CREATE TABLE `razlog` (
  `id` int(11) NOT NULL,
  `razlog` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `razlog`
--

INSERT INTO `razlog` (`id`, `razlog`) VALUES
(1, 'dolazak'),
(2, 'odlazak'),
(3, 'pauza'),
(4, 'terenski rad'),
(5, 'privatni izlazak'),
(6, 'ostalo');

-- --------------------------------------------------------

--
-- Table structure for table `tag_user`
--

CREATE TABLE `tag_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_tag` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tag_user`
--

INSERT INTO `tag_user` (`id`, `user_id`, `user_tag`) VALUES
(1, 1, 'adscew'),
(2, 1, 'ewer233'),
(3, 2, 'qwd11we'),
(4, 3, 'g43ew4'),
(5, 3, 'weer2232'),
(6, 4, 'grdr33r3'),
(7, 5, '23eqq33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `evidencija`
--
ALTER TABLE `evidencija`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_52A9E31FA76ED395` (`user_id`),
  ADD KEY `IDX_52A9E31F37A02C98` (`razlog_id`);

--
-- Indexes for table `evidencija_dana`
--
ALTER TABLE `evidencija_dana`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fos_group`
--
ALTER TABLE `fos_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_4B019DDB5E237E06` (`name`);

--
-- Indexes for table `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`);

--
-- Indexes for table `fos_user_user_group`
--
ALTER TABLE `fos_user_user_group`
  ADD PRIMARY KEY (`user_id`,`group_id`),
  ADD KEY `IDX_B3C77447A76ED395` (`user_id`),
  ADD KEY `IDX_B3C77447FE54D947` (`group_id`);

--
-- Indexes for table `razlog`
--
ALTER TABLE `razlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag_user`
--
ALTER TABLE `tag_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `evidencija`
--
ALTER TABLE `evidencija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `evidencija_dana`
--
ALTER TABLE `evidencija_dana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `fos_group`
--
ALTER TABLE `fos_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `razlog`
--
ALTER TABLE `razlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `evidencija`
--
ALTER TABLE `evidencija`
  ADD CONSTRAINT `FK_52A9E31F37A02C98` FOREIGN KEY (`razlog_id`) REFERENCES `razlog` (`id`),
  ADD CONSTRAINT `FK_52A9E31FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Constraints for table `fos_user_user_group`
--
ALTER TABLE `fos_user_user_group`
  ADD CONSTRAINT `FK_B3C77447A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_B3C77447FE54D947` FOREIGN KEY (`group_id`) REFERENCES `fos_group` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
