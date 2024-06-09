-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2024 at 10:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `created_at`, `updated_at`, `title`, `description`) VALUES
(2, '2024-04-22 06:14:52', '2024-04-22 06:58:10', 'phpfff', 'backend programming lngfefe'),
(3, '2024-04-22 06:16:00', '2024-04-22 06:16:00', 'javascript', 'frontend programming lng'),
(4, '2024-04-22 11:44:30', '2024-04-22 11:44:30', 'уцауцауца', 'уцуцауц'),
(5, '2024-05-20 06:22:06', '2024-05-20 06:22:06', 'цуауца', 'уцауца');

-- --------------------------------------------------------

--
-- Table structure for table `category_file`
--

CREATE TABLE `category_file` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `file_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_file`
--

INSERT INTO `category_file` (`id`, `category_id`, `file_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, NULL),
(2, 4, 1, NULL, NULL),
(3, 3, 2, NULL, NULL),
(4, 2, 3, NULL, NULL),
(5, 3, 3, NULL, NULL),
(6, 4, 3, NULL, NULL),
(7, 5, 3, NULL, NULL),
(8, 4, 5, NULL, NULL),
(9, 3, 6, NULL, NULL),
(10, 4, 7, NULL, NULL),
(11, 5, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_question`
--

CREATE TABLE `category_question` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_question`
--

INSERT INTO `category_question` (`id`, `created_at`, `updated_at`, `category_id`, `question_id`) VALUES
(1, NULL, NULL, 2, 9),
(2, NULL, NULL, 3, 9),
(11, NULL, NULL, 4, 9),
(12, NULL, NULL, 5, 9);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `created_at`, `updated_at`, `user_id`, `title`, `author`, `description`, `file_path`, `published_at`) VALUES
(1, '2024-05-20 09:33:20', '2024-05-20 09:33:20', 10, 'упуцпц', 'упуцп', 'уцпцупц', '1716208400_For client PayPal.docx', '2024-05-20 09:33:20'),
(2, '2024-05-20 11:23:22', '2024-05-20 11:23:22', 10, '4ewgw', 'ggwegw', 'egewgw', '1716215002_Vegan-fox Atribute tutorial.docx', '2024-05-20 11:23:22'),
(3, '2024-05-20 12:18:45', '2024-05-20 12:18:45', 10, 'title', 'author', 'description', '1716218325_for client Stripe.docx', '2024-05-20 12:18:45'),
(4, '2024-05-20 12:18:58', '2024-05-20 12:18:58', 10, 'efw', 'fwefew', 'ewfewfew', '1716218338_For client PayPal.docx', '2024-05-20 12:18:58'),
(5, '2024-05-20 12:47:52', '2024-05-20 12:47:52', 10, 'ewfewfew', 'fewfewfew', 'wefewfwef', '1716220072_For client PayPal.docx', '2024-05-20 12:47:52'),
(6, '2024-05-20 12:48:07', '2024-05-20 12:48:07', 10, 'fewfew', 'fewfewfewf', 'ewfewfwefw', '1716220087_Vegan-fox Atribute tutorial.docx', '2024-05-20 12:48:07'),
(7, '2024-05-20 13:23:44', '2024-05-20 13:23:44', 10, 'кцпцп', 'цпуцпцу', 'пцупцупц', '1716222224_Maksims_Visockis_DP4-1_kvalifikacijas_dokumentacija.docx', '2024-05-20 13:23:44');

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
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2023_10_30_144010_create_users_table', 2),
(11, '2023_10_30_152342_add_admin_field_to_users_table', 2),
(16, '2023_11_27_175129_create_questions_table', 3),
(17, '2023_12_16_144159_create_question__comments_table', 4),
(19, '2023_12_17_140056_create_files_table', 5),
(20, '2024_04_21_180440_create_categories_table', 5),
(22, '2024_04_21_195853_create_category_question_table', 6),
(23, '2024_05_20_084605_create_category_file_table', 7),
(24, '2024_05_25_121638_add_teacher_to_users_table', 8),
(25, '2024_05_25_122414_create_pending_users_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `pending_users`
--

CREATE TABLE `pending_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `published_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `created_at`, `updated_at`, `user_id`, `title`, `content`, `published_at`) VALUES
(4, '2023-12-17 15:32:53', '2023-12-17 15:32:53', 8, 'ergerger', 'gerge', '2023-12-17 15:32:53'),
(5, '2023-12-17 15:37:54', '2023-12-17 15:37:54', 8, 'regerg', 'erger', '2023-12-17 15:37:54'),
(8, '2024-04-22 11:44:44', '2024-04-22 11:44:44', 10, 'уауц', 'ауцауц', '2024-04-22 11:44:44'),
(9, '2024-04-22 11:49:27', '2024-04-22 11:49:27', 10, 'ewfewfewfew', 'ewfewfewfw', '2024-04-22 11:49:27');

-- --------------------------------------------------------

--
-- Table structure for table `question__comments`
--

CREATE TABLE `question__comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `published_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question__comments`
--

INSERT INTO `question__comments` (`id`, `created_at`, `updated_at`, `user_id`, `question_id`, `text`, `published_at`) VALUES
(10, '2023-12-17 17:58:52', '2023-12-17 17:58:52', 2, 4, 'rgerger', '2023-12-17 17:58:52'),
(11, '2024-03-19 19:51:53', '2024-03-19 19:51:53', 10, 4, 'аиваива', '2024-03-19 19:51:53'),
(12, '2024-03-20 14:53:28', '2024-03-20 14:53:28', 11, 4, 'ghrheg', '2024-03-20 14:53:28'),
(13, '2024-05-14 12:18:28', '2024-05-14 12:18:28', 10, 9, 'цауца', '2024-05-14 12:18:28'),
(16, '2024-05-31 03:14:05', '2024-05-31 03:14:05', 15, 9, 'rp9wug9w', '2024-05-31 03:14:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `uid` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `teacher` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created_at`, `updated_at`, `name`, `email`, `avatar`, `active`, `admin`, `uid`, `password`, `teacher`) VALUES
(2, '2023-11-20 10:25:54', '2023-11-20 10:25:54', 'admin', 'admin@gmail.com', NULL, 1, 1, 'admin', '$2y$10$GUBlBkx0eXe8QVsibilL.uH4sjxRpflOieYnrrFPR0mK8mLqmw04a', 0),
(3, '2023-11-20 14:38:22', '2023-11-20 14:38:22', 'test', 'test@gmail.com', NULL, 1, 0, 'test', '$2y$10$jO1fqtrV8RVFAr8fIDZA4OLZXw33gu8p2iJvHCUFVUiYSAqFf8xxK', 0),
(4, '2023-11-20 14:52:56', '2023-11-20 14:52:56', '3', '3@gmail.com', NULL, 1, 0, '3', '$2y$10$Ia9c5gblLuaj2ExGJ7Fy1eia544gXy94ll/62hBagF6Bjm1vl9ecK', 0),
(6, '2023-11-20 15:01:45', '2023-11-20 15:01:45', '5', '5@gmail.com', NULL, 1, 0, '5', '$2y$10$2PFWWbvDcfm2aeji5OQHH.ZCWTIu9DVJzE9VU0KIgGxa3bS52oxrq', 0),
(7, '2023-11-20 15:04:40', '2023-11-20 15:04:40', '6', '6@gmail.com', NULL, 1, 0, '6', '$2y$10$pWUBdm8netKospLjtUzIo.GBOlJa.Y/ZleVV2R0rCCPiGciEXE3wC', 0),
(8, '2023-12-06 16:59:17', '2023-12-06 16:59:17', 'user', 'user@gmail.com', NULL, 1, 0, 'user', '$2y$10$H9cooofobnxVCF8QpI4Mu.Rrjaoeo40YhEGsCbPz9Sev2vqcmpTQ6', 0),
(10, '2024-03-19 18:20:24', '2024-03-19 18:20:24', 'admin2', 'admin2@gmail.com', NULL, 1, 1, 'admin2', '$2y$10$vBairKc2Q6lT85eFaPAw3OkC9p3kDVXFGV/AhwAMWcT9pcUTX4CbS', 0),
(11, '2024-03-20 14:52:06', '2024-03-20 14:52:06', 'test12', 'test12@gmail.com', NULL, 1, 0, 'test12', '$2y$10$VpodRc54YpsO8remez9/Y.VcXTxa8KhyQ6qu.WuvVnWdR3T3vilv.', 0),
(12, '2024-04-21 17:24:06', '2024-05-31 03:18:52', 'test123456', 'test123456@gmail.com', NULL, 1, 0, 'test123456', '$2y$10$n5CgV/Blf2hMorC7ceWqtub66ELaFVX6i31lRhRlqAhGvVZS5.lhq', 1),
(13, '2024-04-21 17:28:38', '2024-04-21 17:28:38', 'testt', 'testt@gmail.com', NULL, 1, 0, 'testt', '$2y$10$chyJRkNn7xHZ6JfwpYSnm.Ze404LSifPE.ObQ5C0CdIZrq23U3QrO', 0),
(14, '2024-04-21 17:29:12', '2024-04-21 17:29:12', 'testtt', 'testtt@gmail.com', NULL, 1, 0, 'testtt123456', '$2y$10$dCwAsvBdthWKIcPRDdG2R.2AKNfKwYXiFNQEBJWPYTa9h85nsny1y', 0),
(15, '2024-05-31 03:12:28', '2024-05-31 03:12:28', 'name', 'g22785582@gmail.com', NULL, 1, 0, 'username', '$2y$10$rCr.JxrVE9QNsmyyA3Kneu34L3toxMqCaTCpjw7IuEUR.538mAY1G', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_file`
--
ALTER TABLE `category_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_file_category_id_foreign` (`category_id`),
  ADD KEY `category_file_file_id_foreign` (`file_id`);

--
-- Indexes for table `category_question`
--
ALTER TABLE `category_question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_question_category_id_foreign` (`category_id`),
  ADD KEY `category_question_question_id_foreign` (`question_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending_users`
--
ALTER TABLE `pending_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pending_users_email_unique` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_user_id_foreign` (`user_id`);

--
-- Indexes for table `question__comments`
--
ALTER TABLE `question__comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question__comments_user_id_foreign` (`user_id`),
  ADD KEY `question__comments_question_id_foreign` (`question_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_uid_unique` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category_file`
--
ALTER TABLE `category_file`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `category_question`
--
ALTER TABLE `category_question`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pending_users`
--
ALTER TABLE `pending_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `question__comments`
--
ALTER TABLE `question__comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_file`
--
ALTER TABLE `category_file`
  ADD CONSTRAINT `category_file_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `category_file_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`);

--
-- Constraints for table `category_question`
--
ALTER TABLE `category_question`
  ADD CONSTRAINT `category_question_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `category_question_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question__comments`
--
ALTER TABLE `question__comments`
  ADD CONSTRAINT `question__comments_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `question__comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
