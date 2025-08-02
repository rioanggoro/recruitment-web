-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 02, 2025 at 11:35 AM
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
(1, 1, '23', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(2, 1, '31', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(3, 1, '17', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(4, 1, '19', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(5, 2, '8', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(6, 2, '10', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(7, 2, '12', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(8, 2, '14', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(9, 3, 'Galaksi', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(10, 3, 'Planet', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(11, 3, 'Komet', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(12, 3, 'Bumi', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(13, 4, 'Semua mawar indah', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(14, 4, 'Semua bunga adalah mawar', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(15, 4, 'Beberapa mawar tidak indah', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(16, 4, 'Tidak ada mawar yang indah', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(17, 5, 'Jati', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(18, 5, 'Cemara', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(19, 5, 'Apel', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(20, 5, 'Pinus', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(21, 6, '60', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(22, 6, '80', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(23, 6, '100', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(24, 6, '120', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(25, 7, 'Kuda', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(26, 7, 'Sapi', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(27, 7, 'Singa', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(28, 7, 'Kambing', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(29, 8, '4', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(30, 8, '5', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(31, 8, '6', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(32, 8, '7', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(33, 9, '25', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(34, 9, '30', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(35, 9, '36', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(36, 9, '49', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(37, 10, 'Senang', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(38, 10, 'Gembira', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(39, 10, 'Suka', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(40, 10, 'Ceria', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(41, 11, '90184', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(42, 11, '90176', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(43, 11, '9078', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(44, 11, '9016', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(45, 12, 'Terapung', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(46, 12, 'Tenggelam', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(47, 12, 'Menguap', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(48, 12, 'Melayang', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(49, 13, 'Redup', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(50, 13, 'Gelap', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(51, 13, 'Terang', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(52, 13, 'Cahaya', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(53, 14, 'Meja', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(54, 14, 'Kursi', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(55, 14, 'Lemari', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(56, 14, 'Jendela', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(57, 15, 'H', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(58, 15, 'I', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(59, 15, 'J', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(60, 15, 'K', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(61, 16, '100', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(62, 16, '150', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(63, 16, '200', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(64, 16, '250', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(65, 17, 'Akar', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(66, 17, 'Batang', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(67, 17, 'Daun', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(68, 17, 'Kaki', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(69, 18, '8', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(70, 18, '9', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(71, 18, '10', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(72, 18, '11', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(73, 19, 'Lingkaran', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(74, 19, 'Segitiga', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(75, 19, 'Kotak', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(76, 19, 'Jajar genjang', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(77, 20, 'Kecil', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(78, 20, 'Lebar', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(79, 20, 'Luas', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(80, 20, 'Ramping', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(81, 21, 'Semua singa adalah kucing', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(82, 21, 'Semua mamalia adalah kucing', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(83, 21, 'Semua singa dan kucing adalah mamalia', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(84, 21, 'Kucing adalah singa', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(85, 22, 'Barat', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(86, 22, 'Timur', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(87, 22, 'Utara', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(88, 22, 'Selatan', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(89, 23, 'Kubus', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(90, 23, 'Lingkaran', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(91, 23, 'Bola', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(92, 23, 'Kerucut', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(93, 24, '30 derajat', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(94, 24, '60 derajat', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(95, 24, '90 derajat', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(96, 24, '120 derajat', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(97, 25, 'Paris', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(98, 25, 'London', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(99, 25, 'New York', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(100, 25, 'Tokyo', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(101, 26, 'R', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(102, 26, 'S', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(103, 26, 'T', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(104, 26, 'U', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(105, 27, '50', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(106, 27, '25', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(107, 27, '100', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(108, 27, '75', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(109, 28, 'Elang', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(110, 28, 'Ayam', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(111, 28, 'Burung Hantu', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(112, 28, 'Merpati', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(113, 29, 'F', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(114, 29, 'G', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(115, 29, 'H', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(116, 29, 'I', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(117, 30, 'Teliti', 1, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(118, 30, 'Cepat', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(119, 30, 'Lambat', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41'),
(120, 30, 'Tepat', 0, '2025-08-02 09:31:41', '2025-08-02 09:31:41');

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
(1, 1, 'Manakah di antara angka berikut yang paling berbeda dari yang lain?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(2, 1, 'Jika A = 2, B = 4, C = 6, maka E = ...?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(3, 1, 'Apa kata berikutnya dalam deret ini: Matahari, Bulan, Bintang, ...?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(4, 1, 'Jika semua Bunga adalah indah, dan semua Mawar adalah Bunga, maka kesimpulannya adalah...', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(5, 1, 'Manakah yang tidak termasuk dalam kelompok ini: Jati, Cemara, Apel, Pinus?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(6, 1, 'Jika 5, 10, 20, 40, ... angka berikutnya adalah?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(7, 1, 'Yang mana yang tidak cocok: Kuda, Sapi, Singa, Kambing?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(8, 1, 'Jika 2x + 5 = 15, berapakah nilai x?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(9, 1, 'Lengkapilah deret ini: 1, 4, 9, 16, ...?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(10, 1, 'Manakah yang merupakan sinonim dari \"bahagia\"?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(11, 1, 'Jika \"MERAH\" adalah \"45678\", dan \"PUTIH\" adalah \"90123\", maka \"PUTAR\" adalah...', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(12, 1, 'Apa yang akan terjadi jika kamu menjatuhkan batu ke dalam air?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(13, 1, 'Jika \"SENANG\" berlawanan dengan \"SEDih\", maka \"TERANG\" berlawanan dengan...', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(14, 1, 'Manakah yang tidak termasuk: Meja, Kursi, Lemari, Jendela?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(15, 1, 'Lengkapilah pola ini: A, C, E, G, ...?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(16, 1, 'Jika 10% dari sebuah angka adalah 20, maka angka tersebut adalah?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(17, 1, 'Apa yang tidak dimiliki oleh pohon: Akar, Batang, Daun, Kaki?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(18, 1, 'Jika 1 = 3, 2 = 5, 3 = 7, maka 4 = ...?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(19, 1, 'Pilihlah gambar yang berbeda dari kelompoknya.', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(20, 1, 'Manakah yang merupakan antonim dari \"besar\"?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(21, 1, 'Jika semua Kucing adalah mamalia, dan semua Singa adalah mamalia, maka...', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(22, 1, 'Lengkapi pola ini: Utara, Timur, Selatan, ...?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(23, 1, 'Manakah yang tidak cocok: Kubus, Lingkaran, Bola, Kerucut?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(24, 1, 'Jika sebuah jam menunjukkan pukul 3, berapa sudut yang dibentuk oleh jarum jam?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(25, 1, 'Manakah yang tidak termasuk dalam kelompok ini: Paris, London, New York, Tokyo?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(26, 1, 'Lengkapilah pola huruf ini: Z, X, V, T, ...?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(27, 1, 'Jika 100 dibagi 4 dikalikan 2 adalah?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(28, 1, 'Manakah yang tidak termasuk: Elang, Ayam, Burung Hantu, Merpati?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(29, 1, 'Jika A berpasangan dengan B, C dengan D, maka E dengan ...?', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03'),
(30, 1, 'Tentukan kata yang paling dekat artinya dengan \"cermat\".', 'multiple_choice', '2025-08-02 09:30:03', '2025-08-02 09:30:03');

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
(2, 'Rio Anggoro', 'rio', '$2y$10$OsG6EK5JKaUNa25z197fBeB9e3lzmF/S.uFETrGiCgZGuTarxPnqe', 'pelamar', NULL, '2025-07-21 11:14:57', '2025-07-21 13:08:48', NULL);

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
(1, 13, 1, 2, NULL, 1, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(2, 13, 2, 6, NULL, 1, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(3, 13, 3, 11, NULL, 0, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(4, 13, 4, 14, NULL, 0, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(5, 13, 5, 20, NULL, 0, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(6, 13, 6, 22, NULL, 1, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(7, 13, 7, 26, NULL, 0, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(8, 13, 8, 32, NULL, 0, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(9, 13, 9, 35, NULL, 0, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(10, 13, 10, 38, NULL, 0, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(11, 13, 11, 42, NULL, 0, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(12, 13, 12, 46, NULL, 1, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(13, 13, 13, 50, NULL, 0, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(14, 13, 14, 54, NULL, 0, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(15, 13, 15, 59, NULL, 0, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(16, 13, 16, 61, NULL, 0, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(17, 13, 17, 68, NULL, 1, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(18, 13, 18, 70, NULL, 1, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(19, 13, 19, 76, NULL, 1, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(20, 13, 20, 80, NULL, 0, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(21, 13, 21, 83, NULL, 1, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(22, 13, 22, 86, NULL, 0, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(23, 13, 23, 90, NULL, 1, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(24, 13, 24, 94, NULL, 0, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(25, 13, 25, 98, NULL, 0, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(26, 13, 26, 104, NULL, 0, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(27, 13, 27, 108, NULL, 0, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(28, 13, 28, 110, NULL, 1, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(29, 13, 29, 114, NULL, 0, '2025-08-02 02:35:09', '2025-08-02 02:35:09'),
(30, 13, 30, 118, NULL, 0, '2025-08-02 02:35:09', '2025-08-02 02:35:09');

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
(13, 2, 1, 33, 1, '2025-08-02 02:33:51', '2025-08-02 02:35:09', '2025-08-02 02:33:51', '2025-08-02 02:35:09');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_tests`
--
ALTER TABLE `user_tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
