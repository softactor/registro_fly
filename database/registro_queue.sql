--
-- Table structure for table `configure_queue_number`
--

CREATE TABLE `configure_queue_number` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `configure_queue_number`
--

INSERT INTO `configure_queue_number` (`id`, `number`) VALUES
(1, 3);

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super', 'Admin', 'admin@admin.com', 'e10adc3949ba59abbe56e057f20f883e', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `configure_queue_number`
--
ALTER TABLE `configure_queue_number`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `configure_queue_number`
--
ALTER TABLE `configure_queue_number`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
