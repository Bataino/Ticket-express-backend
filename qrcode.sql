-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2023 at 09:22 AM
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
(23, 'Test Event', '2023-08-18 06:20:11', '2023-08-18 06:20:11');

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
(28, '2023_08_11_115119_add_event_id_to_users', 3),
(29, '2023_08_18_063715_add_payment_to_tickets', 4);

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
(26, 'App\\Models\\User', 5, 'login', '73722494409cdc3f548937618a380294d6e3083668f9d0c584b3a668ac3103ec', '[\"*\"]', '2023-08-11 13:58:07', NULL, '2023-08-11 13:58:06', '2023-08-11 13:58:07'),
(27, 'App\\Models\\User', 1, 'login', '0b3fea0ab6c0ddfd4e00d024ab95e55a0033db62e494e1f857c68204d4f6f645', '[\"*\"]', '2023-08-17 06:45:35', NULL, '2023-08-16 10:55:28', '2023-08-17 06:45:35'),
(28, 'App\\Models\\User', 4, 'login', 'edd6773851431ebe47d1295618055e1379317e3235862ee2b5f3b537d57658f0', '[\"*\"]', '2023-08-17 07:03:38', NULL, '2023-08-17 07:01:52', '2023-08-17 07:03:38'),
(29, 'App\\Models\\User', 4, 'login', '971ed5ff56a2e880d246217cbc6eff7c0c85411dc756a4412ea673cf2565b7bd', '[\"*\"]', '2023-08-17 12:56:03', NULL, '2023-08-17 09:02:21', '2023-08-17 12:56:03'),
(30, 'App\\Models\\User', 1, 'login', '54e5f5e57022acbc75a3e0dfe2b3f53b2d33590178336dc8716e36079c224ad6', '[\"*\"]', '2023-08-18 05:20:07', NULL, '2023-08-17 13:03:17', '2023-08-18 05:20:07'),
(31, 'App\\Models\\User', 1, 'login', '6893f669e81ec80cbc05fd0ac8c6ae185931d12fa20abc35ac5c60753838147c', '[\"*\"]', '2023-08-18 06:20:12', NULL, '2023-08-18 05:22:44', '2023-08-18 06:20:12'),
(32, 'App\\Models\\User', 13, 'login', 'ccffae96175ab02dad9d2d5e8ca647737d904276b5bc15b7df8cd77ca05daffa', '[\"*\"]', NULL, NULL, '2023-08-18 06:21:38', '2023-08-18 06:21:38');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `page_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_scanned` tinyint(1) NOT NULL DEFAULT 0,
  `event_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `type`, `level`, `price`, `page_name`, `first_name`, `last_name`, `phone`, `email`, `created_at`, `updated_at`, `is_scanned`, `event_id`, `payment`) VALUES
('01H4YWG2FFZTS2K7MS8', NULL, NULL, NULL, NULL, 'Claudia', 'Sanchez', '16262674004', 'oompa1234@yahoo.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-8528'),
('01H4YWG2FG4APSTV610', NULL, NULL, NULL, NULL, 'Claudia', 'Sanchez', '16262674004', 'oompa1234@yahoo.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-8528'),
('01H4YWG2FH61A0HHCM8', NULL, NULL, NULL, NULL, 'Claudia', 'Sanchez', '16262674004', 'oompa1234@yahoo.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-8528'),
('01H58TRN6ADVMYGK2QB', NULL, NULL, NULL, NULL, 'Jazmin', 'Gutierrez', '17472497365', 'jazmingtrz98@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-7929'),
('01H58TRN6BCXRG6XKM9', NULL, NULL, NULL, NULL, 'Jazmin', 'Gutierrez', '17472497365', 'jazmingtrz98@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-7929'),
('01H58TRN6BF1K6A2R9C', NULL, NULL, NULL, NULL, 'Jazmin', 'Gutierrez', '17472497365', 'jazmingtrz98@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-7929'),
('01H5DTJ8F9YK3N3YZ9K', NULL, NULL, NULL, NULL, 'Eva', 'Munoz', '16262162283', 'munozeva@rocketmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-8687'),
('01H5DTJ8FA64KWBTG2T', NULL, NULL, NULL, NULL, 'Eva', 'Munoz', '16262162283', 'munozeva@rocketmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-8687'),
('01H5E4K7T9F3HQC0F75', NULL, NULL, NULL, NULL, 'Marco', 'De La Cruz', '13237060327', 'marcodlc41@gmail.con', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-0367'),
('01H5E4K7TAHNENE4NCR', NULL, NULL, NULL, NULL, 'Marco', 'De La Cruz', '13237060327', 'marcodlc41@gmail.con', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-0367'),
('01H5GSSGMY364V6CKZN', NULL, NULL, NULL, NULL, 'Cristina', 'Morales', '15628849634', 'moralescristina562@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-4755'),
('01H5GSSGMZ9G6X3GSVV', NULL, NULL, NULL, NULL, 'Cristina', 'Morales', '15628849634', 'moralescristina562@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-4755'),
('01H5N7RGBRTQWGWBQY0', NULL, NULL, NULL, NULL, 'Guadalupe', 'Pacheco', '13233856030', 'guadalupepacheco912@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-8995'),
('01H5N7RGBSHAQG08BD0', NULL, NULL, NULL, NULL, 'Guadalupe', 'Pacheco', '13233856030', 'guadalupepacheco912@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-8995'),
('01H5QCXR4F0XDN5J9AK', NULL, NULL, NULL, NULL, 'Blanca', 'Castro Flores', '15622351422', 'bpacheco31648@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'MAST-4141'),
('01H5QCXR4GM85RSTGKV', NULL, NULL, NULL, NULL, 'Blanca', 'Castro Flores', '15622351422', 'bpacheco31648@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'MAST-4141'),
('01H5QNW1VN7S99D4EAX', NULL, NULL, NULL, NULL, 'Anayeli', 'Cruz', '17148042802', 'acruz4343@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-9361'),
('01H5QNW1VQPHMPST5YE', NULL, NULL, NULL, NULL, 'Anayeli', 'Cruz', '17148042802', 'acruz4343@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-9361'),
('01H5RGSFAYXQ3AB46YY', NULL, NULL, NULL, NULL, 'Mayra', 'Colunga', '13234779945', 'mayra_colunga@yahoo.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'MAST-9564'),
('01H5RGSFAZPA0TSMY7Z', NULL, NULL, NULL, NULL, 'Mayra', 'Colunga', '13234779945', 'mayra_colunga@yahoo.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'MAST-9564'),
('01H5RGSFAZX14ZSV7WV', NULL, NULL, NULL, NULL, 'Mayra', 'Colunga', '13234779945', 'mayra_colunga@yahoo.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'MAST-9564'),
('01H5VPV4NPFN44V20F4', NULL, NULL, NULL, NULL, 'Liliana', 'Mata', '17145147613', 'lili.mata@ymail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'AMEX-1005'),
('01H60D56Q8TYC2EQJ36', NULL, NULL, NULL, NULL, 'Leonel', 'Gonzales', '16264618286', 'gonzalezleonel699@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-9962'),
('01H60D56QAF03AGY73M', NULL, NULL, NULL, NULL, 'Leonel', 'Gonzales', '16264618286', 'gonzalezleonel699@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-9962'),
('01H62BB1MJDT8EQT2MF', NULL, NULL, NULL, NULL, 'Angelica', 'Estrada', '19512176677', 'perris3769@hotmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-0401'),
('01H62BB1MKMC09FXRN9', NULL, NULL, NULL, NULL, 'Angelica', 'Estrada', '19512176677', 'perris3769@hotmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-0401'),
('01H630J38TEXARZBY00', NULL, NULL, NULL, NULL, 'José Luis', 'Alvarado', '13107355687', 'ppdon347@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-4428'),
('01H630J38VCWJR076EM', NULL, NULL, NULL, NULL, 'José Luis', 'Alvarado', '13107355687', 'ppdon347@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-4428'),
('01H632WHTAQTV9FAJ74', NULL, NULL, NULL, NULL, 'Marii', 'Becerra', '18186318883', 'mario.cb88@iclou.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-2295'),
('01H632WHTB39H7B9SCC', NULL, NULL, NULL, NULL, 'Marii', 'Becerra', '18186318883', 'mario.cb88@iclou.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-2295'),
('01H636K5EZ1CEGNE7KD', NULL, NULL, NULL, NULL, 'Cindy', 'Acosta', '16264096318', 'cindyacosta13@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'MAST-1795'),
('01H65274ZWRXKWK8MWW', NULL, NULL, NULL, NULL, 'Osvaldo', 'Martinez', '13237705995', 'osvaldom23@icloud.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-8775'),
('01H65VPBSASPRB4Q4QM', NULL, NULL, NULL, NULL, 'Juan', 'Ortega', '19093428444', 'lord1js@yahoo.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'MAST-1923'),
('01H65VPBSD1Y551QQPP', NULL, NULL, NULL, NULL, 'Juan', 'Ortega', '19093428444', 'lord1js@yahoo.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'MAST-1923'),
('01H6J1D0H2F0E4PNS79', NULL, NULL, NULL, NULL, 'Cristina', 'Munoz', '13236029292', 'cristinamunoz0001@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-0149'),
('01H6J1D0H2PKPPSHDJ8', NULL, NULL, NULL, NULL, 'Cristina', 'Munoz', '13236029292', 'cristinamunoz0001@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-0149'),
('01H6MXWDYF52MHGFE1B', NULL, NULL, NULL, NULL, 'Lilia', 'Alfaro', '16264096764', 'liliaalfaro@netzero.net', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'MAST-5389'),
('01H6MXWDYG70BXFN7E9', NULL, NULL, NULL, NULL, 'Lilia', 'Alfaro', '16264096764', 'liliaalfaro@netzero.net', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'MAST-5389'),
('01H6PXN4E4G8RTWREZ5', NULL, NULL, NULL, NULL, 'Manuela', 'BAILON', '13238757882', 'manuela.bailon325@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-0988'),
('01H6PXN4E5FR0GBCZVS', NULL, NULL, NULL, NULL, 'Manuela', 'BAILON', '13238757882', 'manuela.bailon325@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-0988'),
('01H6QNCGA5YARAY16SP', NULL, NULL, NULL, NULL, 'Jorge', 'Hernandez', '12132922547', 'jorgehernandez11600@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'MAST-2897'),
('01H6QPJ1GSNGXGMAEAZ', NULL, NULL, NULL, NULL, 'Maria', 'Castillo', '13234765114', 'estrellita01172592.mc@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-3766'),
('01H6QPMKGPZM8AEA1HW', NULL, NULL, NULL, NULL, 'David', 'Morales', '13264890324', 'dav1dmorales@icloud.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-6151'),
('01H6QPMKGQ1DVETQQYD', NULL, NULL, NULL, NULL, 'David', 'Morales', '13264890324', 'dav1dmorales@icloud.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-6151'),
('01H6RJCHWKHD8QM892D', NULL, NULL, NULL, NULL, 'Belinda', 'Juarez', '16263245783', 'belindajuarez71@yahoo.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-2158'),
('01H6RJCHWMTYYQSGT16', NULL, NULL, NULL, NULL, 'Belinda', 'Juarez', '16263245783', 'belindajuarez71@yahoo.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-2158'),
('01H6SWBN9PMN797Z9B4', NULL, NULL, NULL, NULL, 'Melissa', 'Garcia', '19097316037', 'melissa18221@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-9402'),
('01H6SWBN9QVZX4FMMWF', NULL, NULL, NULL, NULL, 'Melissa', 'Garcia', '19097316037', 'melissa18221@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-9402'),
('01H6T14QTCBGNHKF001', NULL, NULL, NULL, NULL, 'Selena', 'Carmona Medina', '13108494576', 'j.jesuszmzapata@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-2110'),
('01H6T14QTD9782WYCW0', NULL, NULL, NULL, NULL, 'Selena', 'Carmona Medina', '13108494576', 'j.jesuszmzapata@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-2110'),
('01H6T1SCPV0GAD6WF5M', NULL, NULL, NULL, NULL, 'Marco', 'Flores', '19098055543', 'floresmarco9075@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-8121'),
('01H6T1SCPWQJRQZQZC9', NULL, NULL, NULL, NULL, 'Marco', 'Flores', '19098055543', 'floresmarco9075@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-8121'),
('01H6WAWM33DX4Q9PSH9', NULL, NULL, NULL, NULL, 'Apolonio', 'Travis Quinones', '16613407507', 'apoloniozamora@yahoo.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-1968'),
('01H6WDX5SGYNK34QDJW', NULL, NULL, NULL, NULL, 'Cristian', 'Sanchez', '17472449557', 'kyara022302@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-3894'),
('01H6WDX5SJHP3XZ5302', NULL, NULL, NULL, NULL, 'Cristian', 'Sanchez', '17472449557', 'kyara022302@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-3894'),
('01H6WS12F2RSZJMCXP5', NULL, NULL, NULL, NULL, 'Erika', 'Nopaltitla', '16269794069', 'erikanopaltitla@icloud.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-3088'),
('01H6WS12F35JF5X4GXH', NULL, NULL, NULL, NULL, 'Erika', 'Nopaltitla', '16269794069', 'erikanopaltitla@icloud.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-3088'),
('01H6WS12F3SNADD3HMC', NULL, NULL, NULL, NULL, 'Erika', 'Nopaltitla', '16269794069', 'erikanopaltitla@icloud.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-3088'),
('01H6XZ30AT5XKFNE1QE', NULL, NULL, NULL, NULL, 'Aracely', 'Samaniego', '13232739346', 'aracelys12172@yahoo.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-3088'),
('01H6XZ30ATK5ZQ7V1B7', NULL, NULL, NULL, NULL, 'Aracely', 'Samaniego', '13232739346', 'aracelys12172@yahoo.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-3088'),
('01H6YJ2K4H6P259YNBR', NULL, NULL, NULL, NULL, 'Jose S', 'Pérez', '16613875958', 'persaljo78@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-1688'),
('01H6YJ2K4J0BPNK2WJW', NULL, NULL, NULL, NULL, 'Jose S', 'Pérez', '16613875958', 'persaljo78@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-1688'),
('01H6Z23YFWTGXMBZ55D', NULL, NULL, NULL, NULL, 'Monica', 'Flores', '16265871426', 'inca_188@hotmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-8874'),
('01H6Z23YFXHDQJQMPAA', NULL, NULL, NULL, NULL, 'Monica', 'Flores', '16265871426', 'inca_188@hotmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-8874'),
('01H6Z5V6WDM4DAHKWMB', NULL, NULL, NULL, NULL, 'Maria', 'Cardenas', '17143909190', 'mdjcardenas27@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'MAST-3626'),
('01H6Z5V6WEEM9SBQ94G', NULL, NULL, NULL, NULL, 'Maria', 'Cardenas', '17143909190', 'mdjcardenas27@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'MAST-3626'),
('01H70D5X19VDYG54HRR', NULL, NULL, NULL, NULL, 'Denise', 'Mendez', '15626853653', 'dee_0380@yahoo.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-9667'),
('01H717VT6DDEFGGZHMG', NULL, NULL, NULL, NULL, 'Edgardo', 'Santiago', '16265429407', 'gatito.96@icloud.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-3576'),
('01H717VT6E1B8ZBZP3P', NULL, NULL, NULL, NULL, 'Edgardo', 'Santiago', '16265429407', 'gatito.96@icloud.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-3576'),
('01H71CHZT9G96V9T7ZW', NULL, NULL, NULL, NULL, 'Ariana', 'Alonso Flores', '16265596994', 'ariaalo6@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-3947'),
('01H71W8GPJKM2B1RE6D', NULL, NULL, NULL, NULL, 'Alejandro', 'Rosales', '19514277528', 'rosalesalejandro005@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'MAST-8766'),
('01H71W8GPKJGNHTHHYB', NULL, NULL, NULL, NULL, 'Alejandro', 'Rosales', '19514277528', 'rosalesalejandro005@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'MAST-8766'),
('01H71WAKDGW9N45SVF3', NULL, NULL, NULL, NULL, 'Axel', 'Ramirez', '13234988290', 'axeram1208@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-7668'),
('01H71WAKDJDPS5YJ64D', NULL, NULL, NULL, NULL, 'Axel', 'Ramirez', '13234988290', 'axeram1208@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-7668'),
('01H71Z637N31YADTQ9Q', NULL, NULL, NULL, NULL, 'Kimberly', 'Solis', '13109016012', 'kimsolis0601@icloud.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-7548'),
('01H71Z637PVGQPXDQ23', NULL, NULL, NULL, NULL, 'Kimberly', 'Solis', '13109016012', 'kimsolis0601@icloud.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-7548'),
('01H727M2KDFVHF4QZH0', NULL, NULL, NULL, NULL, 'Lizbeth', 'Villa', '12134512017', 'lizbethv0095@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-5459'),
('01H727M2KG51E8Z4YGW', NULL, NULL, NULL, NULL, 'Lizbeth', 'Villa', '12134512017', 'lizbethv0095@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-5459'),
('01H7298CWZ0MQT2KFEC', NULL, NULL, NULL, NULL, 'Ariana', 'Alonso Flores', '16265596994', 'ariaalo6@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'MAST-1769'),
('01H73G6Y66PTW7XQMVC', NULL, NULL, NULL, NULL, 'Jesse', 'Anguiano', '13236747354', 'jesseanguiano55@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-4934'),
('01H73G6Y68A85VRVQGP', NULL, NULL, NULL, NULL, 'Jesse', 'Anguiano', '13236747354', 'jesseanguiano55@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-4934'),
('01H73MA8FJYWGHGHF0K', NULL, NULL, NULL, NULL, 'Cynthia', 'Carrillo', '19514425534', 'cyncarrillo2@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-0155'),
('01H73ZMXAP2RGRZCY7W', NULL, NULL, NULL, NULL, 'Emmanuel', 'Casillas', '13107549160', 'lookout322@hotmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-7299'),
('01H73ZMXAQ4ZEWSVEJG', NULL, NULL, NULL, NULL, 'Emmanuel', 'Casillas', '13107549160', 'lookout322@hotmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-7299'),
('01H73ZQ2TSBS8M6AAN0', NULL, NULL, NULL, NULL, 'Soledad', 'Gutierrez', '16265411477', 'gutierrezs2587@live.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-1726'),
('01H744H430BZFRWV9N3', NULL, NULL, NULL, NULL, 'Esther', 'Esparza', '18182814496', 'vtgesther@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-8222'),
('01H744QEH2EWJ7N1NWH', NULL, NULL, NULL, NULL, 'Cristina', 'Rodriguez', '12135905969', 'cristinarodriguez582@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-0267'),
('01H744QEH53FKC5FP6T', NULL, NULL, NULL, NULL, 'Cristina', 'Rodriguez', '12135905969', 'cristinarodriguez582@gmail.com', '2023-08-18 06:20:11', '2023-08-18 06:20:11', 0, 23, 'VISA-0267');

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
(13, NULL, 'super-admin', 'admin', NULL, '$2y$10$7WIscEjQPs9281Qnw2rwou6ZOqjFx3xLfZ4FjdPnhHeLm3NQuqAzi', NULL, '2023-08-18 06:20:11', '2023-08-18 06:20:11', NULL);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
