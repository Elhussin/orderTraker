-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2024 at 11:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `ID` int(20) NOT NULL,
  `NUMBER` int(20) NOT NULL,
  `SEND_DATA` datetime NOT NULL DEFAULT current_timestamp(),
  `RECIVE_DATE` datetime NOT NULL,
  `DONE_DATE` datetime DEFAULT NULL,
  `NOTE` varchar(255) NOT NULL,
  `STATA` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`ID`, `NUMBER`, `SEND_DATA`, `RECIVE_DATE`, `DONE_DATE`, `NOTE`, `STATA`) VALUES
(85, 9000, '2024-12-29 13:57:01', '2024-12-29 16:09:33', NULL, '', 'IN SHOP'),
(100, 6666, '2024-12-29 14:32:09', '2024-12-29 15:49:11', NULL, '', 'IN SHOP'),
(108, 9001, '2024-12-29 15:12:33', '2024-12-29 15:34:49', NULL, '', 'IN SHOP'),
(109, 9002, '2024-12-29 15:12:43', '2024-12-29 15:35:35', NULL, '222', 'IN SHOP'),
(115, 9213, '2024-12-29 16:23:54', '2024-12-30 00:43:01', '2024-12-30 00:43:12', '', 'Delivered'),
(116, 9231, '2024-12-29 16:23:55', '2024-12-29 16:36:33', '2024-12-30 00:44:29', ' 99999', 'Delivered'),
(117, 9235, '2024-12-29 16:31:32', '2024-12-29 16:36:16', NULL, '5555', 'IN SHOP'),
(118, 9999, '2024-12-29 16:49:01', '0000-00-00 00:00:00', NULL, '5555', 'IN LAP'),
(119, 2901, '2024-12-30 00:20:17', '0000-00-00 00:00:00', NULL, '9999', 'IN LAP'),
(120, 2000, '2024-12-30 00:20:59', '0000-00-00 00:00:00', NULL, '2222', 'IN LAP'),
(121, 2002, '2024-12-30 00:21:04', '0000-00-00 00:00:00', NULL, '2222', 'IN LAP'),
(122, 2003, '2024-12-30 00:21:08', '0000-00-00 00:00:00', NULL, '', 'IN LAP'),
(124, 900333, '2024-12-30 01:17:03', '0000-00-00 00:00:00', NULL, '', 'IN LAP');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
