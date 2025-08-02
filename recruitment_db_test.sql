-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 02, 2025 at 10:31 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recruitment_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `biodata`
--

CREATE TABLE `biodata` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('Pria','Wanita') DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `agama` enum('Islam','Kristen Protestan','Katolik','Hindu','Buddha','Konghucu','lainnya') DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `status` enum('Menikah','Belum Menikah') DEFAULT NULL,
  `pendidikan_terakhir` enum('SD (Sekolah Dasar)','SMP (Sekolah Menengah Pertama)','SMA (Sekolah Menengah Atas) / SMK (Sekolah Menengah Kejuruan)','D1 (Diploma 1)','D2 (Diploma 2)','D3 (Diploma 3)','D4 (Diploma 4)','Sarjana (S1)','Magister (S2)','Doktor (S3)') DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nomor_hp` varchar(255) DEFAULT NULL,
  `cv` text DEFAULT NULL,
  `ijazah` text DEFAULT NULL,
  `ktp` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `surat_pengalaman_kerja` text DEFAULT NULL,
  `surat_keterangan_sehat` text DEFAULT NULL,
  `skck` text DEFAULT NULL,
  `transkrip_nilai` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `biodata`
--

INSERT INTO `biodata` (`id`, `nik`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `agama`, `alamat`, `status`, `pendidikan_terakhir`, `email`, `nomor_hp`, `cv`, `ijazah`, `ktp`, `foto`, `surat_pengalaman_kerja`, `surat_keterangan_sehat`, `skck`, `transkrip_nilai`, `user_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Pria', NULL, NULL, 'Islam', 'Jl H Muyan\r\nBekasi', NULL, NULL, 'rioanggoro37@gmail.com', '081381293250', '55b0ee1a-9787-46fc-ba3e-0a4b361eaa72.csv', '4509799b-bf0e-4271-8906-d3548cf67fdf.csv', 'd6effcce-000b-4145-b592-b28288599581.csv', NULL, 'a8501e48-9d5b-4c3a-b899-dc343efc5ffc.csv', '080eadcd-aeae-4504-b6c8-01aab474603c.csv', NULL, NULL, 2, '2025-07-21 11:15:34', '2025-07-21 11:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `devisi`
--

CREATE TABLE `devisi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_devisi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `devisi`
--

INSERT INTO `devisi` (`id`, `nama_devisi`, `created_at`, `updated_at`) VALUES
(1, 'Manufactur', '2025-07-21 11:28:49', '2025-07-21 11:28:49'),
(2, 'Dept kosmetik', '2025-07-21 19:19:45', '2025-07-21 19:19:45'),
(3, 'Dept Pkrt', '2025-07-21 19:19:45', '2025-07-21 19:19:45'),
(4, 'Dept. Autocare', '2025-07-21 19:19:45', '2025-07-21 19:19:45'),
(5, 'e-commers', '2025-07-21 19:19:45', '2025-07-21 19:19:45'),
(6, 'accounting & finance', '2025-07-21 19:19:45', '2025-07-21 19:19:45'),
(7, 'hrd & ga', '2025-07-21 19:19:45', '2025-07-21 19:19:45'),
(8, 'marketing & sales', '2025-07-21 19:19:45', '2025-07-21 19:19:45');

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
-- Table structure for table `lamaran`
--

CREATE TABLE `lamaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status_lamaran` enum('seleksi','wawancara','diterima','ditolak') NOT NULL,
  `link_wawancara` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `loker_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loker`
--

CREATE TABLE `loker` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `status` enum('Open','Close') NOT NULL,
  `devisi_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loker`
--

INSERT INTO `loker` (`id`, `title`, `deskripsi`, `status`, `devisi_id`, `created_at`, `updated_at`) VALUES
(1, 'Manufactur', '<p>Manufactur</p>', 'Open', 2, '2025-07-21 11:29:06', '2025-07-21 12:40:22');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_06_17_044352_create_biodata_table', 1),
(6, '2024_06_17_045549_create_devisi_table', 1),
(7, '2024_06_17_045646_create_loker_table', 1),
(8, '2024_06_17_045930_create_lamaran_table', 1),
(9, '2025_05_19_182102_create_notifications_table', 1),
(10, '2025_05_28_173610_add_link_wawancara_to_lamaran_table', 1),
(11, '2025_07_21_122528_create_tests_table', 1),
(12, '2025_07_21_122558_create_questions_table', 1),
(13, '2025_07_21_122615_create_options_table', 1),
(14, '2025_07_21_122632_create_user_tests_table', 1),
(15, '2025_07_21_122645_create_user_answers_table', 1),
(16, '2025_07_21_123426_add_min_score_to_pass_to_tests_table', 1),
(17, '2025_07_21_180754_add_recommended_devisi_id_to_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('442786a2-3b88-4a39-9775-6470a9a0830e', 'App\\Notifications\\LamaranWawancaraNotification', 'App\\Models\\User', 2, '{\"message\":\"Lamaran Anda untuk posisi Manufactur masuk ke tahap wawancara.\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/pelamar\\/lamaran\"}', '2025-07-21 12:21:28', '2025-07-21 11:40:36', '2025-07-21 12:21:28'),
('9199527e-0dd3-4cad-ade3-e83c45c9299f', 'App\\Notifications\\LamaranMasukNotification', 'App\\Models\\User', 1, '{\"message\":\"Lamaran baru dari Rio Anggoro\",\"pelamar_name\":\"Rio Anggoro\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/manage-loker\"}', '2025-08-01 05:23:14', '2025-07-21 11:40:16', '2025-08-01 05:23:14'),
('e04454d5-da64-4120-b1c0-23dc0baa2147', 'App\\Notifications\\LamaranDiterimaNotification', 'App\\Models\\User', 2, '{\"message\":\"Selamat! Anda diterima untuk posisi Manufactur.\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/pelamar\\/lamaran\"}', '2025-07-21 12:21:28', '2025-07-21 11:44:56', '2025-07-21 12:21:28');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `option_text` text NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `question_id`, `option_text`, `is_correct`, `created_at`, `updated_at`) VALUES
(1, 2, 'A', 0, '2025-07-21 11:30:08', '2025-07-21 11:30:08'),
(2, 2, 'B', 0, '2025-07-21 11:30:08', '2025-07-21 11:30:08'),
(3, 2, 'C', 1, '2025-07-21 11:30:08', '2025-07-21 11:30:08'),
(4, 3, 'A', 0, '2025-07-21 11:30:24', '2025-07-21 11:30:24'),
(5, 3, 'B', 1, '2025-07-21 11:30:24', '2025-07-21 11:30:24'),
(6, 3, 'C', 0, '2025-07-21 11:30:24', '2025-07-21 11:30:24'),
(7, 4, 'A', 1, '2025-07-21 11:30:35', '2025-07-21 11:30:35'),
(8, 4, 'B', 0, '2025-07-21 11:30:35', '2025-07-21 11:30:35'),
(9, 4, 'C', 0, '2025-07-21 11:30:35', '2025-07-21 11:30:35'),
(10, 5, 'A', 0, '2025-07-21 11:30:45', '2025-07-21 11:30:45'),
(11, 5, 'B', 0, '2025-07-21 11:30:45', '2025-07-21 11:30:45'),
(12, 5, 'C', 1, '2025-07-21 11:30:45', '2025-07-21 11:30:45'),
(13, 6, 'A', 1, '2025-07-21 11:31:00', '2025-07-21 11:31:00'),
(14, 6, 'B', 0, '2025-07-21 11:31:00', '2025-07-21 11:31:00'),
(15, 6, 'C', 0, '2025-07-21 11:31:00', '2025-07-21 11:31:00');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
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

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `test_id` bigint(20) UNSIGNED NOT NULL,
  `question_text` text NOT NULL,
  `question_type` varchar(255) NOT NULL DEFAULT 'multiple_choice',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `test_id`, `question_text`, `question_type`, `created_at`, `updated_at`) VALUES
(2, 1, 'Apa fungsi utama dari router dalam jaringan komputer?', 'multiple_choice', '2025-07-21 11:30:08', '2025-07-21 11:30:08'),
(3, 1, 'Testing 2', 'multiple_choice', '2025-07-21 11:30:24', '2025-07-21 11:30:24'),
(4, 1, 'Testing 3', 'multiple_choice', '2025-07-21 11:30:35', '2025-07-21 11:30:35'),
(5, 1, 'Testing 4', 'multiple_choice', '2025-07-21 11:30:45', '2025-07-21 11:30:45'),
(6, 1, 'Testing 5', 'multiple_choice', '2025-07-21 11:31:00', '2025-07-21 11:31:00');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `devisi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `duration_minutes` int(11) NOT NULL DEFAULT 30,
  `min_score_to_pass` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `name`, `description`, `devisi_id`, `duration_minutes`, `min_score_to_pass`, `created_at`, `updated_at`) VALUES
(1, 'Psikotes', NULL, 1, 30, 0, '2025-07-21 11:29:33', '2025-07-21 11:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pelamar') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `recommended_devisi_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `recommended_devisi_id`) VALUES
(1, 'admin', 'admin', '$2y$10$OsG6EK5JKaUNa25z197fBeB9e3lzmF/S.uFETrGiCgZGuTarxPnqe', 'admin', NULL, '2025-07-21 11:13:14', '2025-07-21 11:13:14', NULL),
(2, 'Rio Anggoro', 'rio', '$2y$10$OsG6EK5JKaUNa25z197fBeB9e3lzmF/S.uFETrGiCgZGuTarxPnqe', 'pelamar', NULL, '2025-07-21 11:14:57', '2025-07-21 13:08:48', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

CREATE TABLE `user_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_test_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `option_id` bigint(20) UNSIGNED DEFAULT NULL,
  `answer_text` text DEFAULT NULL,
  `is_correct` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_answers`
--

INSERT INTO `user_answers` (`id`, `user_test_id`, `question_id`, `option_id`, `answer_text`, `is_correct`, `created_at`, `updated_at`) VALUES
(51, 11, 2, 3, NULL, 1, '2025-07-21 13:08:48', '2025-07-21 13:08:48'),
(52, 11, 3, 5, NULL, 1, '2025-07-21 13:08:48', '2025-07-21 13:08:48'),
(53, 11, 4, 7, NULL, 1, '2025-07-21 13:08:48', '2025-07-21 13:08:48'),
(54, 11, 5, 12, NULL, 1, '2025-07-21 13:08:48', '2025-07-21 13:08:48'),
(55, 11, 6, 13, NULL, 1, '2025-07-21 13:08:48', '2025-07-21 13:08:48');

-- --------------------------------------------------------

--
-- Table structure for table `user_tests`
--

CREATE TABLE `user_tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `test_id` bigint(20) UNSIGNED NOT NULL,
  `score` int(11) DEFAULT NULL,
  `passed` tinyint(1) DEFAULT NULL,
  `started_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_tests`
--

INSERT INTO `user_tests` (`id`, `user_id`, `test_id`, `score`, `passed`, `started_at`, `completed_at`, `created_at`, `updated_at`) VALUES
(11, 2, 1, 100, 1, '2025-07-21 13:08:41', '2025-07-21 13:08:48', '2025-07-21 13:08:41', '2025-07-21 13:08:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biodata`
--
ALTER TABLE `biodata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `biodata_user_id_foreign` (`user_id`);

--
-- Indexes for table `devisi`
--
ALTER TABLE `devisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `lamaran`
--
ALTER TABLE `lamaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lamaran_user_id_foreign` (`user_id`),
  ADD KEY `lamaran_loker_id_foreign` (`loker_id`);

--
-- Indexes for table `loker`
--
ALTER TABLE `loker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loker_devisi_id_foreign` (`devisi_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `options_question_id_foreign` (`question_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
  ADD KEY `questions_test_id_foreign` (`test_id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tests_devisi_id_foreign` (`devisi_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_recommended_devisi_id_foreign` (`recommended_devisi_id`);

--
-- Indexes for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_answers_user_test_id_foreign` (`user_test_id`),
  ADD KEY `user_answers_question_id_foreign` (`question_id`),
  ADD KEY `user_answers_option_id_foreign` (`option_id`);

--
-- Indexes for table `user_tests`
--
ALTER TABLE `user_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_tests_user_id_foreign` (`user_id`),
  ADD KEY `user_tests_test_id_foreign` (`test_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biodata`
--
ALTER TABLE `biodata`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `devisi`
--
ALTER TABLE `devisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lamaran`
--
ALTER TABLE `lamaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loker`
--
ALTER TABLE `loker`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `user_tests`
--
ALTER TABLE `user_tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `biodata`
--
ALTER TABLE `biodata`
  ADD CONSTRAINT `biodata_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `lamaran`
--
ALTER TABLE `lamaran`
  ADD CONSTRAINT `lamaran_loker_id_foreign` FOREIGN KEY (`loker_id`) REFERENCES `loker` (`id`),
  ADD CONSTRAINT `lamaran_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `loker`
--
ALTER TABLE `loker`
  ADD CONSTRAINT `loker_devisi_id_foreign` FOREIGN KEY (`devisi_id`) REFERENCES `devisi` (`id`);

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_devisi_id_foreign` FOREIGN KEY (`devisi_id`) REFERENCES `devisi` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_recommended_devisi_id_foreign` FOREIGN KEY (`recommended_devisi_id`) REFERENCES `devisi` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD CONSTRAINT `user_answers_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `user_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_answers_user_test_id_foreign` FOREIGN KEY (`user_test_id`) REFERENCES `user_tests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_tests`
--
ALTER TABLE `user_tests`
  ADD CONSTRAINT `user_tests_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_tests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
