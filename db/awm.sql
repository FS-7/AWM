-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2021 at 11:13 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `awm`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `imgname` varchar(16) DEFAULT NULL,
  `id_no` bigint(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `phone_no` bigint(10) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `vehicle` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`imgname`, `id_no`, `name`, `phone_no`, `email_id`, `password`, `vehicle`) VALUES
(NULL, 103, 'Mansoor', 1345678765, 'jhgfdsa@gmail.com', 'sdfkcvbtk', NULL),
(NULL, 104, 'TEST', 999999999, 'test@gmail.com', 'admin', NULL),
(NULL, 105, 'Adil', 9876543466, 'admin@gmail.com', '1234', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `request_id` bigint(15) NOT NULL,
  `m_id` bigint(10) NOT NULL,
  `rating` int(1) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `date` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mechanic`
--

CREATE TABLE `mechanic` (
  `imgname` varchar(16) DEFAULT NULL,
  `id_no` bigint(10) NOT NULL,
  `adhaar_no` bigint(12) NOT NULL,
  `name` varchar(20) NOT NULL,
  `phone_no` bigint(10) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `gar_loc_lat` float NOT NULL,
  `gar_loc_lng` float NOT NULL,
  `model_no` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mechanic`
--

INSERT INTO `mechanic` (`imgname`, `id_no`, `adhaar_no`, `name`, `phone_no`, `email_id`, `password`, `gar_loc_lat`, `gar_loc_lng`, `model_no`) VALUES
('', 1, 123456789012, 'Faizan', 2345673456, 'fs@gmail.com', 'admin', 15.3465, 75.1455, NULL),
('', 11, 123456789013, 'safsfgas', 8765453232, 'hhdfdsfas@gmail.com', 'wertyuiop', 15, 75, NULL),
(NULL, 12, 765431234533, 'sdfghjtyu', 6789234568, 'asdfghj@gmail.com', 'zwsexdrcfvgbhn', 15.1194, 75.4706, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_log`
--

CREATE TABLE `service_log` (
  `c_id` bigint(10) NOT NULL,
  `m_id` bigint(10) NOT NULL,
  `c_loc_lat` float NOT NULL,
  `c_loc_lon` float NOT NULL,
  `status` enum('Waiting','Accepted','Rejected','Cancelled','Completed','') NOT NULL,
  `date` datetime(1) NOT NULL DEFAULT current_timestamp(1),
  `request_id` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_log`
--

INSERT INTO `service_log` (`c_id`, `m_id`, `c_loc_lat`, `c_loc_lon`, `status`, `date`, `request_id`) VALUES
(104, 11, 15.1274, 75.1244, 'Cancelled', '2021-11-03 22:02:17.1', 1033),
(104, 1, 15.4607, 75.0029, 'Cancelled', '2021-11-03 22:07:00.4', 1034),
(104, 12, 15.0866, 75.2846, 'Cancelled', '2021-11-03 22:07:50.2', 1035),
(104, 11, 14.993, 75.2166, 'Cancelled', '2021-11-03 22:12:16.2', 1036),
(104, 1, 15.1552, 75.1449, '', '2021-11-03 22:12:41.3', 1037);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_no`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD UNIQUE KEY `request_id` (`request_id`),
  ADD KEY `m_id` (`m_id`);

--
-- Indexes for table `mechanic`
--
ALTER TABLE `mechanic`
  ADD PRIMARY KEY (`id_no`);

--
-- Indexes for table `service_log`
--
ALTER TABLE `service_log`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `foriegn_c` (`c_id`),
  ADD KEY `foriegn_m` (`m_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_no` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `mechanic`
--
ALTER TABLE `mechanic`
  MODIFY `id_no` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `service_log`
--
ALTER TABLE `service_log`
  MODIFY `request_id` bigint(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1038;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `mech_id` FOREIGN KEY (`m_id`) REFERENCES `mechanic` (`id_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `req_id` FOREIGN KEY (`request_id`) REFERENCES `service_log` (`request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_log`
--
ALTER TABLE `service_log`
  ADD CONSTRAINT `foriegn_c` FOREIGN KEY (`c_id`) REFERENCES `customer` (`id_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foriegn_m` FOREIGN KEY (`m_id`) REFERENCES `mechanic` (`id_no`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
