-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2020 at 02:33 PM
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
-- Table structure for table `client_information`
--

CREATE TABLE `client_information` (
  `id` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(550) NOT NULL,
  `last_name` varchar(550) NOT NULL,
  `is_sms_service` tinyint(1) NOT NULL DEFAULT '0',
  `is_whatsapp_service` tinyint(1) NOT NULL DEFAULT '0',
  `sms_rate` float NOT NULL DEFAULT '0',
  `whatsapp_rate` float NOT NULL DEFAULT '0',
  `balance` float NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client_information`
--

INSERT INTO `client_information` (`id`, `user_id`, `first_name`, `last_name`, `is_sms_service`, `is_whatsapp_service`, `sms_rate`, `whatsapp_rate`, `balance`, `created_by`, `created_at`, `updated_by`, `updated_at`, `is_status`) VALUES
(1, 2, 'Tanveer', 'Qureshee', 1, 1, 1.25, 3.15, 20, 1, '2020-08-06 19:54:46', NULL, NULL, 1),
(2, 3, 'Meghna', 'Jahan', 1, 0, 1.25, 3.15, 30, 1, '2020-08-06 20:53:53', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `id` int(11) NOT NULL,
  `client_id` int(11) UNSIGNED NOT NULL COMMENT 'this is user id',
  `group_id` int(11) DEFAULT NULL,
  `contact_no` varchar(250) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`id`, `client_id`, `group_id`, `contact_no`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(6, 3, 6, '1716600843', 3, '2020-08-07 15:50:03', NULL, NULL),
(7, 3, 6, '1676545520', 3, '2020-08-07 15:50:03', NULL, NULL),
(8, 3, 6, '07176600943', 3, '2020-08-07 15:50:03', NULL, NULL),
(9, 2, 4, '1716600843', 2, '2020-08-07 15:52:43', NULL, NULL),
(10, 2, 4, '1676545520', 2, '2020-08-07 15:52:43', NULL, NULL),
(11, 2, 4, '07176600943', 2, '2020-08-07 15:52:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `client_id` int(11) UNSIGNED NOT NULL COMMENT 'this is user id',
  `name` varchar(550) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `client_id`, `name`) VALUES
(4, 2, 'TQ Group 1'),
(5, 2, 'TQ Group 2'),
(6, 3, 'MJ Group 1'),
(7, 3, 'MJ Group 2');

-- --------------------------------------------------------

--
-- Table structure for table `regis_info`
--

CREATE TABLE `regis_info` (
  `id` int(11) NOT NULL,
  `name` varchar(650) NOT NULL,
  `mobile` varchar(150) NOT NULL,
  `queue_number` varchar(10) NOT NULL,
  `generated_at` datetime NOT NULL,
  `is_status` tinyint(4) NOT NULL DEFAULT '0',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  `entry_time` datetime DEFAULT NULL,
  `exit_time` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `is_remind_sms` tinyint(1) DEFAULT '0',
  `send_remind_sms_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `regis_info`
--

INSERT INTO `regis_info` (`id`, `name`, `mobile`, `queue_number`, `generated_at`, `is_status`, `is_delete`, `entry_time`, `exit_time`, `updated_at`, `remarks`, `is_remind_sms`, `send_remind_sms_at`) VALUES
(1, 'Tanveer Qureshee', '01716600843', '0001', '2020-07-30 01:52:16', 1, 1, NULL, NULL, '2020-07-30 20:50:22', 'Completed', 0, NULL),
(3, 'Tanveer Qureshee', '01716600845', '0002', '2020-07-30 08:02:44', 0, 1, NULL, NULL, '2020-07-30 20:52:51', 'Pending', 0, NULL),
(4, 'Rizvee Qureshee', '01716600848', '0003', '2020-07-30 08:03:54', 1, 1, NULL, NULL, '2020-07-30 23:04:34', 'Completed', 0, NULL),
(5, 'Meghna Jahana', '01716600849', '0004', '2020-07-30 08:04:24', 1, 1, NULL, NULL, '2020-07-30 23:04:37', 'Completed', 0, NULL),
(9, 'adrian', '+6596278291', '0005', '2020-07-30 10:56:23', 1, 1, NULL, NULL, '2020-07-30 23:04:42', 'Completed', 0, NULL),
(10, 'tt', '+6501716600843', '0005', '2020-07-30 20:54:55', 0, 1, NULL, NULL, '2020-07-30 20:55:58', NULL, 0, NULL),
(11, 'ff', '+6501716600843', '0004', '2020-07-30 20:57:07', 0, 1, NULL, NULL, '2020-07-30 23:04:39', NULL, 0, NULL),
(12, 'ahmed', '+650171660084', '0001', '2020-07-30 23:05:05', 0, 0, NULL, NULL, NULL, NULL, 0, NULL),
(13, 'm', '+6501716600844', '0002', '2020-07-30 23:38:58', 0, 1, NULL, NULL, '2020-07-30 23:39:06', NULL, 0, NULL),
(14, 'm', '+6501716600844', '0002', '2020-07-30 23:39:11', 0, 1, NULL, NULL, '2020-07-30 23:40:44', NULL, 0, NULL),
(15, 'mn', '+6501716600843', '0003', '2020-07-30 23:39:39', 0, 1, NULL, NULL, '2020-07-30 23:40:07', NULL, 0, NULL),
(16, 'v', '+650171660088', '0004', '2020-07-30 23:39:57', 0, 0, NULL, NULL, NULL, NULL, 0, NULL),
(17, 'Circuit change', '+6501729714503', '0005', '2020-07-30 23:40:24', 0, 0, NULL, NULL, NULL, NULL, 0, NULL),
(18, 'Circuit change Update', '+6501729714501', '0006', '2020-07-30 23:40:53', 0, 0, NULL, NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sms_send_details`
--

CREATE TABLE `sms_send_details` (
  `id` int(11) NOT NULL,
  `mobile_number` varchar(100) NOT NULL,
  `sms_type` tinyint(1) NOT NULL DEFAULT '1',
  `send_at` datetime NOT NULL,
  `sms_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `template_details`
--

CREATE TABLE `template_details` (
  `id` int(11) NOT NULL,
  `client_id` int(11) UNSIGNED NOT NULL,
  `template_type` varchar(100) NOT NULL COMMENT 'sms or whatsapp',
  `name` varchar(650) NOT NULL,
  `audio_file` varchar(450) DEFAULT NULL,
  `video_file` varchar(450) DEFAULT NULL,
  `image_file` varchar(450) DEFAULT NULL,
  `header` varchar(650) NOT NULL,
  `body` longtext NOT NULL,
  `footer` varchar(650) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `template_details`
--

INSERT INTO `template_details` (`id`, `client_id`, `template_type`, `name`, `audio_file`, `video_file`, `image_file`, `header`, `body`, `footer`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(10, 2, 'whatsapp', 'ABC', 'template10.mp3', NULL, 'template10.jpg', 'H', 'B', 'F', '2020-08-08 11:59:16', 2, '2020-08-08 11:59:16', 2),
(11, 2, 'sms', 'SMS Template', NULL, NULL, NULL, 'H', 'B', 'F', '2020-08-08 11:59:34', 2, '2020-08-08 12:00:11', 2),
(12, 2, 'sms', 'ABC 2', NULL, NULL, NULL, 'H', 'B', 'F', '2020-08-08 12:00:33', 2, '2020-08-08 20:14:45', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(50) NOT NULL DEFAULT 'sa' COMMENT 'sa;client',
  `first_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `first_name`, `last_name`, `email`, `password`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'sa', 'Super', 'Admin', 'fly@admin.com', '56a5ba871d9eea1b3233c376dea20088', 1, 0, NULL, NULL, NULL),
(2, 'client', 'Tanveer', 'Qureshee', 't@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, '2020-08-06 19:54:46', NULL, NULL),
(3, 'client', 'Meghna', 'Jahan', 'm@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, '2020-08-06 20:53:53', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_information`
--
ALTER TABLE `client_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `regis_info`
--
ALTER TABLE `regis_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_send_details`
--
ALTER TABLE `sms_send_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_details`
--
ALTER TABLE `template_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_information`
--
ALTER TABLE `client_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `regis_info`
--
ALTER TABLE `regis_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `sms_send_details`
--
ALTER TABLE `sms_send_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `template_details`
--
ALTER TABLE `template_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_information`
--
ALTER TABLE `client_information`
  ADD CONSTRAINT `client_information_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD CONSTRAINT `contact_details_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `template_details`
--
ALTER TABLE `template_details`
  ADD CONSTRAINT `template_details_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
