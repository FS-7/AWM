-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2021 at 06:58 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

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
  `id_no` bigint(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `phone_no` bigint(10) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `vehicle` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_no`, `name`, `phone_no`, `email_id`, `password`, `vehicle`) VALUES
(101, 'Adil ', 9999999999, 'adil@gmail.com', 'hfjk123', 'KA15X7193');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `request_id` bigint(15) NOT NULL,
  `rating` int(1) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`request_id`, `rating`, `description`, `date`) VALUES
(1000, 5, 'excellent', '2021-09-11 11:21:33.000000');

-- --------------------------------------------------------

--
-- Table structure for table `mechanic`
--

CREATE TABLE `mechanic` (
  `id_no` bigint(10) NOT NULL,
  `adhaar_no` bigint(12) NOT NULL,
  `name` varchar(20) NOT NULL,
  `phone_no` bigint(10) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `model_no` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mechanic`
--

INSERT INTO `mechanic` (`id_no`, `adhaar_no`, `name`, `phone_no`, `email_id`, `password`, `model_no`) VALUES
(1, 123486869755, 'mansoor', 9999999999, 'mansoor@gmail.com', 'sdfghj112', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_log`
--

CREATE TABLE `service_log` (
  `c_id` bigint(10) NOT NULL,
  `m_id` bigint(10) NOT NULL,
  `c_email` varchar(50) NOT NULL,
  `c_phno` bigint(10) NOT NULL,
  `c_location` varchar(100) NOT NULL,
  `request_id` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_log`
--

INSERT INTO `service_log` (`c_id`, `m_id`, `c_email`, `c_phno`, `c_location`, `request_id`) VALUES
(101, 1, 'adil@gmail.com', 999999999, 'anand nagar,hubli', 1000);

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
  ADD KEY `req_id` (`request_id`);

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
  MODIFY `id_no` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `mechanic`
--
ALTER TABLE `mechanic`
  MODIFY `id_no` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service_log`
--
ALTER TABLE `service_log`
  MODIFY `request_id` bigint(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
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
