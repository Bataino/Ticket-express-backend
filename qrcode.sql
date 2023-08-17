-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2023 at 01:13 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qrcode`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ODS', '2023-07-30 12:46:28', '2023-07-30 12:46:28'),
(2, 'ODS', '2023-07-30 12:50:30', '2023-07-30 12:50:30'),
(3, 'ODS', '2023-07-30 12:51:12', '2023-07-30 12:51:12'),
(4, 'ODS', '2023-07-30 12:52:05', '2023-07-30 12:52:05'),
(5, 'ODS', '2023-07-30 12:53:13', '2023-07-30 12:53:13'),
(6, 'ODS', '2023-07-30 12:53:16', '2023-07-30 12:53:16'),
(7, 'ODS', '2023-07-30 12:54:43', '2023-07-30 12:54:43'),
(8, 'ODS', '2023-07-30 12:55:47', '2023-07-30 12:55:47'),
(9, 'ODS', '2023-07-30 13:01:29', '2023-07-30 13:01:29'),
(10, 'ODS', '2023-07-30 13:02:08', '2023-07-30 13:02:08'),
(11, 'res', '2023-08-11 06:57:42', '2023-08-11 06:57:42'),
(12, 'res', '2023-08-11 06:59:07', '2023-08-11 06:59:07'),
(13, 'res', '2023-08-11 06:59:41', '2023-08-11 06:59:41'),
(14, 'Hello', '2023-08-11 13:13:12', '2023-08-11 13:13:12'),
(15, 'Hello', '2023-08-11 13:23:24', '2023-08-11 13:23:24'),
(16, 'Hello', '2023-08-11 13:23:52', '2023-08-11 13:23:52'),
(17, 'Ses', '2023-08-11 13:29:40', '2023-08-11 13:29:40'),
(18, 'Akarui', '2023-08-11 13:56:29', '2023-08-11 13:56:29');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(6, '2014_10_12_000000_create_users_table', 1),
(7, '2014_10_12_100000_create_password_resets_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2023_07_30_063322_create_tickets_table', 1),
(25, '2023_07_30_072356_create_events_table', 2),
(26, '2023_07_30_094847_add_event_to_tickets', 2),
(28, '2023_08_11_115119_add_event_id_to_users', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'login', '1b0d99d87f6c3b7164a95a69869882ee4babca33898ca5674cd9a3ed491e436a', '[\"*\"]', NULL, NULL, '2023-07-30 08:44:22', '2023-07-30 08:44:22'),
(2, 'App\\Models\\User', 1, 'login', 'aec3a62424f65bd94cdfe9baec2795962dd3086c1aeb2e37e1f5e9ae6425c030', '[\"*\"]', '2023-07-30 13:18:31', NULL, '2023-07-30 08:45:38', '2023-07-30 13:18:31'),
(3, 'App\\Models\\User', 1, 'login', '9d78df8c2846e27a5d45e5401bd3bda94fb23cf46f06ff3887ee3b636ece7f78', '[\"*\"]', NULL, NULL, '2023-08-04 12:52:59', '2023-08-04 12:52:59'),
(4, 'App\\Models\\User', 1, 'login', 'e30a3b792658befc3151e528d7f8e7e004be616e8b8599974fbeed57c6366dc0', '[\"*\"]', NULL, NULL, '2023-08-04 12:57:54', '2023-08-04 12:57:54'),
(5, 'App\\Models\\User', 1, 'login', '332f95c4f52d635c679b0a20494231ef002015796c29f0864de890578816d0c3', '[\"*\"]', NULL, NULL, '2023-08-04 12:58:59', '2023-08-04 12:58:59'),
(6, 'App\\Models\\User', 1, 'login', 'bc1aab0aa5d3015f811473894f0b88f4c28f41b458256bf964fd86332c5556f9', '[\"*\"]', NULL, NULL, '2023-08-04 12:59:50', '2023-08-04 12:59:50'),
(7, 'App\\Models\\User', 1, 'login', 'f74d380cf4206b2b2d848de8ea78615fed426fcebd85d7a7ed716ad610128bcf', '[\"*\"]', NULL, NULL, '2023-08-04 13:00:28', '2023-08-04 13:00:28'),
(8, 'App\\Models\\User', 1, 'login', '0f52bd7b1429bfce521077f2339993a1b438bdc22d61b178354677cbed3a7a0d', '[\"*\"]', NULL, NULL, '2023-08-04 13:01:15', '2023-08-04 13:01:15'),
(9, 'App\\Models\\User', 1, 'login', '553a6b47f85318fab06f73c65fecc95298cacecb5f8d5da1e08147d5de86290f', '[\"*\"]', NULL, NULL, '2023-08-04 13:01:46', '2023-08-04 13:01:46'),
(10, 'App\\Models\\User', 1, 'login', '0ea47d5e241815ee78a7ddcc6748120d5cc233bd0eaaa3316f0f76031efd2d2c', '[\"*\"]', NULL, NULL, '2023-08-04 13:02:50', '2023-08-04 13:02:50'),
(11, 'App\\Models\\User', 1, 'login', '9cfa018d41fb94bbe135d862a9388dabf48742ce7f159461f394ceb9970a6de3', '[\"*\"]', '2023-08-08 13:05:35', NULL, '2023-08-04 13:03:06', '2023-08-08 13:05:35'),
(12, 'App\\Models\\User', 1, 'login', 'e0e88d19fec8c896b44988ec1367049d110db9cce756925e35aa060d0ce62ce3', '[\"*\"]', NULL, NULL, '2023-08-11 06:03:09', '2023-08-11 06:03:09'),
(13, 'App\\Models\\User', 1, 'login', 'd73e08c42670393a1044e8dc65e5dd05afa4522258bba9b5b0574f72d9f41784', '[\"*\"]', NULL, NULL, '2023-08-11 06:07:46', '2023-08-11 06:07:46'),
(14, 'App\\Models\\User', 1, 'login', 'a87fd67315f1796a844e8436ce9a4c30631e9c66516d6a0ec45b8377dd46a96a', '[\"*\"]', NULL, NULL, '2023-08-11 06:20:29', '2023-08-11 06:20:29'),
(15, 'App\\Models\\User', 1, 'login', 'd6845d9b849d01212c3838e6afae83eccf1ce0b47d0bfdd10abc45e486aa7d07', '[\"*\"]', NULL, NULL, '2023-08-11 06:21:17', '2023-08-11 06:21:17'),
(16, 'App\\Models\\User', 1, 'login', '77f0b5ea2294377c917ba7d3b58858cc8f199e48bce34f16509a0e10b86c018c', '[\"*\"]', NULL, NULL, '2023-08-11 06:23:13', '2023-08-11 06:23:13'),
(17, 'App\\Models\\User', 1, 'login', '76ec4cd9017db22c94ca3d3d26280699be1f6df8f0bfaac65748cfc2764e806b', '[\"*\"]', '2023-08-11 06:23:41', NULL, '2023-08-11 06:23:40', '2023-08-11 06:23:41'),
(18, 'App\\Models\\User', 1, 'login', 'b199381ef1d4aef16cf05f46e95a50a1714dab7db3ba62dba3bfedafa5bd6716', '[\"*\"]', '2023-08-11 06:23:59', NULL, '2023-08-11 06:23:58', '2023-08-11 06:23:59'),
(19, 'App\\Models\\User', 1, 'login', 'd5debae41720fa65091935f1d3ab9654c0a69c7ca04ae857295f91f263d00213', '[\"*\"]', NULL, NULL, '2023-08-11 06:24:13', '2023-08-11 06:24:13'),
(20, 'App\\Models\\User', 1, 'login', '2c355485c054ca19337fe9b384f8359796b8e13293943a1d8b85f8b2ccf485f1', '[\"*\"]', NULL, NULL, '2023-08-11 06:24:43', '2023-08-11 06:24:43'),
(21, 'App\\Models\\User', 1, 'login', '67819d98055fcd97fac8e942573f6f27ace30000ed4a76596e5bd2fdf16ce466', '[\"*\"]', '2023-08-11 10:00:38', NULL, '2023-08-11 06:27:07', '2023-08-11 10:00:38'),
(22, 'App\\Models\\User', 1, 'login', 'c36d209260c6807e20b0080b17101acbccbb85d435af130af2d20aefec128f18', '[\"*\"]', '2023-08-11 13:24:28', NULL, '2023-08-11 10:35:02', '2023-08-11 13:24:28'),
(23, 'App\\Models\\User', 1, 'login', 'd5e817f61b0e5677c8ca571a0d2f2c93c06eefbd772ff2e7a3fb229fa01a7fa8', '[\"*\"]', '2023-08-11 13:29:43', NULL, '2023-08-11 13:29:09', '2023-08-11 13:29:43'),
(24, 'App\\Models\\User', 4, 'login', 'a4f73148c87bd9ed004c62929dabadfff773f811f75d12c20b55b5dd5d19da4c', '[\"*\"]', '2023-08-11 13:51:53', NULL, '2023-08-11 13:30:56', '2023-08-11 13:51:53'),
(25, 'App\\Models\\User', 1, 'login', 'bb26156bf689f2d5f015bf2818462e501b6c5d4563db6dbbec467f517cfc4c19', '[\"*\"]', '2023-08-11 13:56:30', NULL, '2023-08-11 13:56:09', '2023-08-11 13:56:30'),
(26, 'App\\Models\\User', 5, 'login', '73722494409cdc3f548937618a380294d6e3083668f9d0c584b3a668ac3103ec', '[\"*\"]', '2023-08-11 13:58:07', NULL, '2023-08-11 13:58:06', '2023-08-11 13:58:07');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `price` double(8,2) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_scanned` tinyint(1) NOT NULL DEFAULT 0,
  `event_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `type`, `level`, `price`, `page_name`, `first_name`, `last_name`, `phone`, `email`, `created_at`, `updated_at`, `is_scanned`, `event_id`) VALUES
('01H44RW5PET701BV5QH', 'standard', 'General Admission', 1.00, 'July 4th Weekend', 'Fred', 'Cobar', '18187202605', 'mona@ladigitalstudio.com', '2023-07-30 13:02:08', '2023-08-11 13:56:29', 1, 18),
('01H44TDREWYGC6WMZ6B', 'standard', 'General Admission', 22.50, 'July 4th Weekend', 'Mona', 'Velcu', '18187202605', 'mona@ladigitalstudio.com', '2023-07-30 13:02:08', '2023-08-11 13:56:29', 0, 18),
('01H44WXXRJW6XB34GQE', 'standard', 'General Admission', 22.50, 'July 4th Weekend', 'Freddy', 'Nunez', '13233530674', 'promocionesfreddy@yahoo.com', '2023-07-30 13:02:08', '2023-08-11 13:56:29', 1, 18),
('01H49S7X84WA22ZHK2N', 'standard', 'General Admission', 20.00, 'July 4th Weekend', 'Test', 'Test1', '18187202605', 'mona@ladigitalstudio.com', '2023-07-30 13:02:08', '2023-08-11 13:56:29', 0, 18),
('01H49SCR84PK59KPQDT', 'standard', 'General Admission', 20.00, 'July 4th Weekend', 'Test', 'Test', '18187202605', 'mona@ladigitalstudio.com', '2023-07-30 13:02:08', '2023-08-11 13:56:29', 0, 18),
('01H49TPZAEZW3EFK9YD', 'standard', 'General Admission', 20.00, 'July 4th Weekend', 'Test', 'Test', '18187202605', 'mona@ladigitalstudio.com', '2023-08-11 06:57:42', '2023-08-11 13:56:29', 0, 18),
('01H49TWGNB7HTV9BGPW', 'standard', 'General Admission', 20.00, 'July 4th Weekend', 'Test', 'Test', '18187202605', 'ladigitalstudio@gmail.com', '2023-07-30 13:02:08', '2023-08-11 13:56:29', 0, 18),
('01H6AYDJHVQQP22QKWM', 'standard', 'General Admission', 20.00, 'July 4th Weekend', 'Test', 'Test', '18187202605', 'mona@ladigitalstudio.com', '2023-07-30 13:02:08', '2023-08-11 10:14:36', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `role` enum('admin','super-admin','user') NOT NULL DEFAULT 'user',
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `event_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `event_id`) VALUES
(1, 'Bataino', 'super-admin', 'bataino.ronaldo@gmail.com', NULL, '$2y$10$R/Z1HDgVkQHE9JMQehp/fe1Lyphn43UNCoaFQeNhSBO.VNl/syyta', 'X7prCKffYiSOl1rj0a0avWjvp7PdjL7sNuBCdcrvxAAli0a9xr3I6Et9ihpS', '2023-07-30 08:44:22', '2023-07-30 08:44:22', NULL),
(3, NULL, 'user', 'Carry', NULL, '$2y$10$4mY3Uj3OyZp/CqZeykHvDu/7tU0I.zPBeBU5GJZ3YdGk27sYp2SQC', NULL, '2023-08-11 13:23:52', '2023-08-11 13:23:52', NULL),
(4, NULL, 'user', 'bataino', NULL, '$2y$10$6YYQnI9gkJpGbkrygarxZ.qye68EnJVzjKvnXkmM04MacI5JMpqoi', NULL, '2023-08-11 13:29:40', '2023-08-11 13:29:40', NULL),
(5, NULL, 'user', 'batingo', NULL, '$2y$10$avsfSBrmTCieIB3VzMYBl.Cx8S4vZgUW/J0Nl96zXCEmHaPXKYdR2', NULL, '2023-08-11 13:56:29', '2023-08-11 13:56:29', 18);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_event_id_foreign` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_event_id_foreign` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
