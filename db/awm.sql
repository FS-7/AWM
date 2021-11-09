-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2021 at 08:03 PM
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
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_no`),
  ADD UNIQUE KEY `phone_no` (`phone_no`,`email_id`);

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
  ADD PRIMARY KEY (`id_no`),
  ADD UNIQUE KEY `phone_no` (`phone_no`,`email_id`),
  ADD UNIQUE KEY `email_id` (`email_id`);

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
  MODIFY `id_no` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `service_log`
--
ALTER TABLE `service_log`
  MODIFY `request_id` bigint(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1054;

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
