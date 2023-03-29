-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2023 at 12:56 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cffms`
--

-- --------------------------------------------------------

--
-- Table structure for table `plu`
--

CREATE TABLE `plu` (
  `id` int(11) NOT NULL,
  `plu_num` int(11) NOT NULL,
  `plu_desc` varchar(100) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `added_on` date NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_on` date NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  `deleted_on` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plu`
--

INSERT INTO `plu` (`id`, `plu_num`, `plu_desc`, `added_by`, `added_on`, `updated_by`, `updated_on`, `deleted_by`, `deleted_on`, `is_deleted`) VALUES
(6, 1, 'CSI JLT BABY BACK', 'Adrian Pol Peligrino', '2023-03-22', 'Adrian Pol Peligrino', '2023-03-23', 'Admin', '2023-03-26', 0),
(7, 2, 'CSI JLT BACON SLICE', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(8, 3, 'CSI JLT LEAN GROUND', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(9, 4, 'PFTJ REGULAR HD', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(10, 5, 'CSI JLT BELLY BO', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(11, 6, 'CSI JLT BUTTERFLY', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(12, 7, 'CSI JLT PORK CHOP BL', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(13, 8, 'CSI JLT PORK CHOP', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(14, 9, 'CSI JLT PIGS FEET', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(15, 10, 'CSI JLT PORK BONES', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(16, 11, 'CSI JLT PORK KASIM', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(17, 12, 'CSI JLT PORK LIVER', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(18, 13, 'CSI JLT PORK LOIN', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(19, 14, 'CSI JLT PORK MASKARA', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(20, 15, 'CSI JLT PATA FRONT', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(21, 16, 'CSI JLT PATA HIND', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(22, 17, 'CSI JLT PORK PIGUE', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(23, 18, 'CSI JLT PORK RIB', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(24, 19, 'CSI JLT PORK SKULL', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(25, 20, 'CSI JLT PORK', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(26, 21, 'CSI JLT PORK ADOBO', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(27, 22, 'CSI JLT GROUND PORK', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(28, 23, 'CSI JLT SINIGANG CUT', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(29, 24, 'CSI JLT SMALL', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(30, 25, 'CSI JLT PANGGISA CUT', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(31, 26, 'CSI JLT PORK SKIN &', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(32, 27, 'CSI JLT PORK SAWDUST', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(33, 28, 'CSI JLT SHOULDER RIB', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(34, 29, 'CSI JLT LARGE', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(35, 30, 'CSI JLT PORK HEAD', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(36, 31, 'CSI JLT PATA SLICE', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(37, 32, 'CSI JLT PORK KASIM', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(38, 33, 'CSI JLT PORK BONES', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(39, 34, 'PFTJ JUMBO JUICY HD', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(40, 35, 'CSI-EAS MAGNOLIA', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(41, 36, 'CSI JLT PORK SARI', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(42, 37, 'CSI JLT PORK', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(43, 38, 'PFTJ COCKTAIL HD', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(44, 39, 'PFTJ KZ HD', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(45, 40, 'CSI-CGT BONE MARROW', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(46, 41, 'CSI-CGT BEEF BARBEQUE', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(47, 42, 'CSI-CGT BEEF BONES', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(48, 43, 'CSI-CGT BEEF UNOD', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(49, 44, 'CSI-CGT GROUND BEEF', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(50, 45, 'CSI-CGT BEEF STEAK', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(51, 46, 'CSI-CGT TOP ROUND', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(52, 47, 'CSI-CGT RIBS', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(53, 48, 'CSI-CGT BEEF SHANK', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0),
(54, 49, 'CSI-CGT SIRLOIN', 'Adrian Pol Peligrino', '2023-03-22', '', '0000-00-00', '', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `process`
--

CREATE TABLE `process` (
  `id` int(11) NOT NULL,
  `from_plu_id` int(11) NOT NULL,
  `from_plu` varchar(100) NOT NULL,
  `to_plu_id` int(11) NOT NULL,
  `to_plu` varchar(100) NOT NULL,
  `yield` varchar(11) NOT NULL,
  `transformed_by` varchar(100) NOT NULL,
  `transformed_on` date NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `added_on` date NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_on` date NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  `deleted_on` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `added_on` date NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_on` date NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  `deleted_on` date NOT NULL,
  `is_logged_in` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `username`, `password`, `user_type`, `added_by`, `added_on`, `updated_by`, `updated_on`, `deleted_by`, `deleted_on`, `is_logged_in`, `is_deleted`) VALUES
(1, 'Admin', 'admin', 'admin', 'admin', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', 0, 0),
(5, 'Encoder', 'encoder', 'encoder', 'encoder', 'Admin', '2023-03-26', 'Admin', '2023-03-26', '', '0000-00-00', 0, 0),
(7, 'Supervisor', 'supervisor', 'supervisor', 'supervisor', 'Admin', '2023-03-26', '', '0000-00-00', 'Admin', '2023-03-26', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `weight`
--

CREATE TABLE `weight` (
  `id` int(11) NOT NULL,
  `plu_num` int(11) NOT NULL,
  `plu_desc` varchar(100) NOT NULL,
  `fb_bi` varchar(11) NOT NULL,
  `delivery_cw` varchar(11) NOT NULL,
  `delivery_sn` int(11) NOT NULL,
  `ps` varchar(11) NOT NULL,
  `bi_d_ps` varchar(11) NOT NULL,
  `ei` varchar(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `added_on` date NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `updated_on` date NOT NULL,
  `deleted_by` varchar(100) NOT NULL,
  `deleted_on` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weight`
--

INSERT INTO `weight` (`id`, `plu_num`, `plu_desc`, `fb_bi`, `delivery_cw`, `delivery_sn`, `ps`, `bi_d_ps`, `ei`, `added_by`, `added_on`, `updated_by`, `updated_on`, `deleted_by`, `deleted_on`, `is_deleted`) VALUES
(25, 1, 'CSI JLT BABY BACK', ' 5.80 ', '0', 0, ' 2.00 ', '3.8', '2.5', 'Test Admin', '2023-03-26', 'Admin', '2023-03-26', 'Admin', '2023-03-26', 0),
(27, 3, '', ' 5.80 ', '7', 123456, ' 2.00 ', '10.8', '2.5', 'Admin', '2023-03-26', '', '0000-00-00', '', '0000-00-00', 0),
(28, 17, '', ' 5.80 ', '0', 0, ' 2.00 ', '3.8', '2', 'Admin', '2023-03-26', '', '0000-00-00', '', '0000-00-00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plu`
--
ALTER TABLE `plu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `process`
--
ALTER TABLE `process`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weight`
--
ALTER TABLE `weight`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plu`
--
ALTER TABLE `plu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `process`
--
ALTER TABLE `process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `weight`
--
ALTER TABLE `weight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
