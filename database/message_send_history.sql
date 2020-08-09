-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2020 at 10:15 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registro_fly`
--

-- --------------------------------------------------------

--
-- Table structure for table `message_send_history`
--

CREATE TABLE `message_send_history` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `contact_no` varchar(50) NOT NULL,
  `is_status` tinyint(4) NOT NULL DEFAULT '0',
  `sent_status` tinyint(4) NOT NULL DEFAULT '0',
  `api_response` longtext,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `sent_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message_send_history`
--
ALTER TABLE `message_send_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_id` (`message_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message_send_history`
--
ALTER TABLE `message_send_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `message_send_history`
--
ALTER TABLE `message_send_history`
  ADD CONSTRAINT `message_send_history_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `message_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
