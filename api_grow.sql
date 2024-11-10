-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 10, 2024 at 02:31 PM
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
-- Database: `api_grow`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certification_images`
--

CREATE TABLE `certification_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `umkm_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_keuangans`
--

CREATE TABLE `laporan_keuangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `umkm_id` bigint(20) UNSIGNED NOT NULL,
  `quarter` varchar(255) NOT NULL,
  `omzet` bigint(20) NOT NULL,
  `net_profit` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `periode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_keuangans`
--

INSERT INTO `laporan_keuangans` (`id`, `umkm_id`, `quarter`, `omzet`, `net_profit`, `created_at`, `updated_at`, `periode`) VALUES
(1, 1, 'Q1', 20000000, 25000000, '2024-11-10 00:50:35', '2024-11-10 00:50:35', 'Periode 1'),
(2, 1, 'Q2', 30000000, 35000000, '2024-11-10 00:50:35', '2024-11-10 00:50:35', 'Periode 2'),
(3, 1, 'Q3', 40000000, 45000000, '2024-11-10 00:50:35', '2024-11-10 00:50:35', 'Periode 3'),
(4, 1, 'Q4', 50000000, 55000000, '2024-11-10 00:50:35', '2024-11-10 00:50:35', 'Periode 4'),
(5, 2, 'Q1', 20000000, 25000000, '2024-11-10 01:53:51', '2024-11-10 01:53:51', 'Periode 1'),
(6, 2, 'Q2', 30000000, 35000000, '2024-11-10 01:53:51', '2024-11-10 01:53:51', 'Periode 2'),
(7, 2, 'Q3', 40000000, 45000000, '2024-11-10 01:53:51', '2024-11-10 01:53:51', 'Periode 3'),
(8, 2, 'Q4', 50000000, 55000000, '2024-11-10 01:53:51', '2024-11-10 01:53:51', 'Periode 4'),
(9, 3, 'Q1', 20000000, 25000000, '2024-11-10 02:03:05', '2024-11-10 02:03:05', 'Periode 1'),
(10, 3, 'Q2', 30000000, 35000000, '2024-11-10 02:03:05', '2024-11-10 02:03:05', 'Periode 2'),
(11, 3, 'Q3', 40000000, 45000000, '2024-11-10 02:03:05', '2024-11-10 02:03:05', 'Periode 3'),
(12, 3, 'Q4', 50000000, 55000000, '2024-11-10 02:03:05', '2024-11-10 02:03:05', 'Periode 4'),
(13, 4, 'Q1', 20000000, 25000000, '2024-11-10 02:09:53', '2024-11-10 02:09:53', 'Periode 1'),
(14, 4, 'Q2', 30000000, 35000000, '2024-11-10 02:09:53', '2024-11-10 02:09:53', 'Periode 2'),
(15, 4, 'Q3', 40000000, 45000000, '2024-11-10 02:09:53', '2024-11-10 02:09:53', 'Periode 3'),
(16, 4, 'Q4', 50000000, 55000000, '2024-11-10 02:09:53', '2024-11-10 02:09:53', 'Periode 4'),
(17, 5, 'Q1', 20000000, 25000000, '2024-11-10 02:17:17', '2024-11-10 02:17:17', 'Periode 1'),
(18, 5, 'Q2', 30000000, 35000000, '2024-11-10 02:17:17', '2024-11-10 02:17:17', 'Periode 2'),
(19, 5, 'Q3', 40000000, 45000000, '2024-11-10 02:17:17', '2024-11-10 02:17:17', 'Periode 3'),
(20, 5, 'Q4', 50000000, 55000000, '2024-11-10 02:17:17', '2024-11-10 02:17:17', 'Periode 4'),
(21, 6, 'Q1', 20000000, 25000000, '2024-11-10 02:26:26', '2024-11-10 02:26:26', 'Periode 1'),
(22, 6, 'Q2', 30000000, 35000000, '2024-11-10 02:26:26', '2024-11-10 02:26:26', 'Periode 2'),
(23, 6, 'Q3', 40000000, 45000000, '2024-11-10 02:26:26', '2024-11-10 02:26:26', 'Periode 3'),
(24, 6, 'Q4', 50000000, 55000000, '2024-11-10 02:26:26', '2024-11-10 02:26:26', 'Periode 4');

-- --------------------------------------------------------

--
-- Table structure for table `location_images`
--

CREATE TABLE `location_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `umkm_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `location_images`
--

INSERT INTO `location_images` (`id`, `image`, `umkm_id`, `created_at`, `updated_at`) VALUES
(1, 'location_images/KVGktWNwjvRlVHap4foArIJgcCvsGsxHi7c9TqbH.jpg', 1, '2024-11-10 00:50:35', '2024-11-10 00:50:35'),
(2, 'location_images/gNCFHUoR9RIQwkpmGJOEHBBrgQpS3Fwy3ZZ7Hhv5.jpg', 2, '2024-11-10 01:53:51', '2024-11-10 01:53:51'),
(3, 'location_images/U31cryDxqGNQLgwVpl71prBwhQX3OQ84W9BO3jk1.jpg', 3, '2024-11-10 02:03:05', '2024-11-10 02:03:05'),
(4, 'location_images/gPaJnureF16GtClAqUXmvLIXp3bflBD7tIRFD6K3.jpg', 4, '2024-11-10 02:09:53', '2024-11-10 02:09:53'),
(5, 'location_images/GPuegEce23EfsAigT8j5SsXHlTe7H0qs5gkNDxRT.jpg', 5, '2024-11-10 02:17:17', '2024-11-10 02:17:17'),
(6, 'location_images/6mRXAon6tbFd1Adl0EDpJbk5m0TwHU6DbaWfIhgw.jpg', 6, '2024-11-10 02:26:26', '2024-11-10 02:26:26');

-- --------------------------------------------------------

--
-- Table structure for table `logo_images`
--

CREATE TABLE `logo_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `umkm_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logo_images`
--

INSERT INTO `logo_images` (`id`, `image`, `created_at`, `updated_at`, `umkm_id`) VALUES
(1, 'logo_images/s1KPLw6rCvwuSfvUpGBaUEKviR77ZElOgkREAl1I.jpg', '2024-11-10 00:50:35', '2024-11-10 00:50:35', 1),
(2, 'logo_images/4wnnG565F5bAVPXeRZWhA8iQOwidoj7CchAWBit3.jpg', '2024-11-10 01:53:51', '2024-11-10 01:53:51', 2),
(3, 'logo_images/Hltq2XWjo8gvCxfSTlpg5yqbKGXrVV3LIkH2k09m.jpg', '2024-11-10 02:03:05', '2024-11-10 02:03:05', 3),
(4, 'logo_images/u1E7YQkZha7QEm0JM69dPAsp9yE5wGxqqx5bUZab.jpg', '2024-11-10 02:09:53', '2024-11-10 02:09:53', 4),
(5, 'logo_images/RW5qseSLGLAsZHeUWxlRmjeRAnsCowr7E3nw5Lnj.jpg', '2024-11-10 02:17:17', '2024-11-10 02:17:17', 5),
(6, 'logo_images/AcjBVyozqGI6Lic1Vz2vFVIcwT5gONXpSG3fla4E.jpg', '2024-11-10 02:26:26', '2024-11-10 02:26:26', 6);

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_09_25_075141_create_personal_access_tokens_table', 1),
(5, '2024_09_29_154702_add_otp_and_is_verified_to_users_table', 1),
(6, '2024_10_01_131214_add_category_to_users_table', 1),
(7, '2024_10_21_135920_create_umkms_table', 1),
(8, '2024_10_21_140106_create_umkm_images_table', 1),
(9, '2024_10_31_074406_create_location_images_table', 1),
(10, '2024_10_31_074443_create_product_images_table', 1),
(11, '2024_10_31_074505_create_logo_images_table', 1),
(12, '2024_10_31_074516_create_n_i_b_images_table', 1),
(13, '2024_10_31_074522_create_n_p_w_p_images_table', 1),
(14, '2024_10_31_074553_create_certification_images_table', 1),
(15, '2024_10_31_191137_add_new_colums_to_umkm', 1),
(16, '2024_11_01_160320_create_laporan_keuangans_table', 1),
(17, '2024_11_01_162427_add_periode_to_laporan_keuangans', 1),
(18, '2024_11_03_082020_add_category_to_umkms', 1);

-- --------------------------------------------------------

--
-- Table structure for table `n_i_b_images`
--

CREATE TABLE `n_i_b_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `umkm_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `n_p_w_p_images`
--

CREATE TABLE `n_p_w_p_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `umkm_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'Personal Access Token', 'ceebabe020ba376e786f8cf01ed7e320bffd0edd2c1931a46cf47baa0bb21913', '[\"*\"]', NULL, NULL, '2024-11-09 23:45:30', '2024-11-09 23:45:30'),
(2, 'App\\Models\\User', 2, 'Personal Access Token', '126f019e555cfb098973d6dc49993fdf62ae767a410775702e258a32ae2e584a', '[\"*\"]', NULL, NULL, '2024-11-09 23:46:15', '2024-11-09 23:46:15'),
(3, 'App\\Models\\User', 3, 'Personal Access Token', '0c62c476e56833cef47dc86f9dc0f4e2b250d2ba4bf386ecf7191d9f8a86f456', '[\"*\"]', NULL, NULL, '2024-11-09 23:46:52', '2024-11-09 23:46:52'),
(4, 'App\\Models\\User', 4, 'Personal Access Token', '4e39b941c35c0ba2f0c01794d52eeb67b2e197ca7d517040cef6d53186378721', '[\"*\"]', NULL, NULL, '2024-11-09 23:47:23', '2024-11-09 23:47:23'),
(5, 'App\\Models\\User', 5, 'Personal Access Token', 'c8c74c395d2a38cfee9392f614539dcd9dfd96eeab7d06903a162be8fb28a595', '[\"*\"]', NULL, NULL, '2024-11-09 23:48:03', '2024-11-09 23:48:03'),
(6, 'App\\Models\\User', 6, 'Personal Access Token', '71d242dbb8d487fd97a7677367043d4b1add56002edbcf055ebf34546fffd947', '[\"*\"]', NULL, NULL, '2024-11-09 23:48:32', '2024-11-09 23:48:32'),
(7, 'App\\Models\\User', 7, 'Personal Access Token', '2f432abba05e8e56ca35374adf2a36e14ce52b97361cef364f78d1f631289b75', '[\"*\"]', '2024-11-10 00:50:35', NULL, '2024-11-10 00:15:30', '2024-11-10 00:50:35'),
(8, 'App\\Models\\User', 8, 'Personal Access Token', '7c6dbbb19ab77698a14007e9db3cc741d146d7d363ba9fb450f3966c5076b417', '[\"*\"]', '2024-11-10 02:03:04', NULL, '2024-11-10 00:16:30', '2024-11-10 02:03:04'),
(9, 'App\\Models\\User', 9, 'Personal Access Token', '30e635f5eec8d5b46b369293a0936f316c497752e908fe2ef92af3e3738b66a9', '[\"*\"]', '2024-11-10 01:53:51', NULL, '2024-11-10 00:17:12', '2024-11-10 01:53:51'),
(10, 'App\\Models\\User', 10, 'Personal Access Token', '9c79383fc5e43ffe41399053f725f7cb5b76696b061adf6a73ff3c5782451d74', '[\"*\"]', '2024-11-10 02:09:53', NULL, '2024-11-10 00:17:37', '2024-11-10 02:09:53'),
(11, 'App\\Models\\User', 11, 'Personal Access Token', '09467e7ace4d7541b61bc4330e97b5144d307f0a6b366e4c5fcddb9ee0be5ff8', '[\"*\"]', '2024-11-10 02:17:17', NULL, '2024-11-10 00:18:12', '2024-11-10 02:17:17'),
(12, 'App\\Models\\User', 12, 'Personal Access Token', 'b00524805c53523b27667e19dc9b4ed12a9691975bcd9422162115d98c86dbfa', '[\"*\"]', '2024-11-10 02:26:26', NULL, '2024-11-10 00:18:33', '2024-11-10 02:26:26');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `umkm_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `image`, `umkm_id`, `created_at`, `updated_at`) VALUES
(1, 'product_images/7VTdW9WIR2pS10NPEEF3ewrCNirIV96qWTYHgqXC.jpg', 1, '2024-11-10 00:50:35', '2024-11-10 00:50:35'),
(2, 'product_images/TLbq0DciCsoJ19H7mx6fywGt6rxbdi4tbm5nl1By.jpg', 2, '2024-11-10 01:53:51', '2024-11-10 01:53:51'),
(3, 'product_images/jdJZnyLN4Wozjood9TYHtg8noqRLxplGuHXf8KsX.jpg', 3, '2024-11-10 02:03:05', '2024-11-10 02:03:05'),
(4, 'product_images/F3kswLnSpT1I1ALYms5WFeGiuJUq3U6PGH5cfkyZ.jpg', 4, '2024-11-10 02:09:53', '2024-11-10 02:09:53'),
(5, 'product_images/VCsQitkvTL6tIbj8pGxHE68w4T5d1FclPO0M0eCC.jpg', 5, '2024-11-10 02:17:17', '2024-11-10 02:17:17'),
(6, 'product_images/Jy2UImu3qnBJChGR2Jan0If63u9Nn8x6KJDB6eHP.jpg', 6, '2024-11-10 02:26:26', '2024-11-10 02:26:26');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `umkms`
--

CREATE TABLE `umkms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `entity` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `assets` bigint(20) NOT NULL,
  `area` varchar(255) NOT NULL,
  `market_share` int(11) NOT NULL,
  `sertifikasi` varchar(255) NOT NULL,
  `pendanaan` bigint(20) NOT NULL,
  `peruntukan` varchar(255) NOT NULL,
  `rencana` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `umkms`
--

INSERT INTO `umkms` (`id`, `name`, `alamat`, `entity`, `deskripsi`, `user_id`, `created_at`, `updated_at`, `assets`, `area`, `market_share`, `sertifikasi`, `pendanaan`, `peruntukan`, `rencana`) VALUES
(1, 'Serverus Ltd.', 'Jalan Mawar No. 10, Kelurahan Melati, Kecamatan Kembangan, Jakarta Barat, DKI Jakarta, 11610', 'PT', 'Berikut adalah contoh deskripsi perusahaan untuk Serverus Ltd., sebuah perusahaan pengembang game:\n\nServerus Ltd. adalah perusahaan pengembang game yang berfokus pada menciptakan pengalaman bermain yang imersif dan inovatif bagi para gamer di seluruh dunia. Berdiri dengan misi untuk membangun dunia digital yang mendalam dan penuh cerita, Serverus Ltd. menghadirkan game yang tak hanya menghibur tetapi juga memicu imajinasi dan kreativitas pemain.\n\nDengan tim yang terdiri dari para ahli dalam desain, pemrograman, dan animasi, Serverus Ltd. menggabungkan teknologi mutakhir dengan ide-ide kreatif untuk menghasilkan game berkualitas tinggi di berbagai platform, dari mobile hingga PC dan konsol. Kami berdedikasi untuk terus menghadirkan permainan yang tidak hanya menghibur tetapi juga membawa dampak positif, memberikan pemain kesempatan untuk menjelajahi dunia baru, menantang kemampuan mereka, dan menghubungkan mereka dengan komunitas gamer yang dinamis.\n\nServerus Ltd. – Menghidupkan dunia digital untuk generasi pemain yang tak terbatas.', 7, '2024-11-10 00:50:35', '2024-11-10 00:50:35', 950000000, 'luar negeri', 5, 'nib, npwp, HAKI', 15000000000, 'Project Game Baru', 'Project Game Baru'),
(2, 'Aphrodite', 'Kompleks Permata Indah Blok A2 No. 15, Kelurahan Seruni, Kecamatan Ciputat, Tangerang Selatan, Banten, 15411', 'PT', 'Aphrodite adalah surga bagi para wanita yang mencari keindahan abadi. Dengan koleksi busana yang terinspirasi dari dewi kecantikan Yunani, butik ini menawarkan pengalaman berbelanja yang mewah dan memanjakan. Setiap desain yang kami hadirkan adalah perpaduan sempurna antara gaya klasik dan modern, sehingga Anda selalu tampil memukau dalam setiap kesempatan.', 9, '2024-11-10 01:53:51', '2024-11-10 01:53:51', 950000000, 'dalam negeri', 5, 'nib, npwp, HAKI', 15000000000, 'Pembukaaan cabang baru', 'Pembukaan cabang baru'),
(3, 'Carnet de menus', 'Jalan Kenanga No. 24, Kelurahan Menteng, Kecamatan Menteng, Jakarta Pusat, DKI Jakarta, 10310', 'PT', 'Sebuah petualangan kuliner yang ditulis dalam setiap hidangan. Nikmati pengalaman bersantap yang tak terlupakan dengan menu-menu kreatif yang terinspirasi dari berbagai penjuru dunia. Setiap hidangan adalah sebuah karya seni yang memanjakan lidah dan mata.', 8, '2024-11-10 02:03:05', '2024-11-10 02:03:05', 950000000, 'dalam negeri', 5, 'nib, npwp, HAKI', 15000000000, 'Pembukaaan cabang baru', 'Pembukaan cabang baru'),
(4, 'Casa Della Ceramica', 'Jalan Pahlawan No. 7, Kelurahan Sukamaju, Kecamatan Beji, Depok, Jawa Barat, 16425', 'Perorangan', 'Casa Della Ceramica adalah surga bagi para pencinta keramik. Di sini, Anda bisa menjelajahi dunia keramik melalui kelas-kelas yang menarik, atau sekadar bersantai sambil mengagumi keindahan karya-karya keramik yang unik.', 10, '2024-11-10 02:09:53', '2024-11-10 02:09:53', 950000000, 'luar negeri', 5, 'nib, npwp, HAKI', 15000000000, 'Pembukaaan cabang baru', 'Pembukaan cabang baru'),
(5, 'House Of Music', 'Perumahan Griya Asri Blok C No. 12, Kelurahan Mekar Jaya, Kecamatan Sukmajaya, Depok, Jawa Barat, 16415', 'Perorangan', 'House of Music adalah label musik yang menghadirkan harmoni indah dari berbagai genre musik. Kami berkomitmen untuk menggali potensi musisi berbakat dan menghadirkan karya-karya berkualitas tinggi yang menginspirasi. Dengan sentuhan klasik dan modern, House of Music menjadi rumah bagi para penikmat musik yang mencari pengalaman mendengarkan yang tak terlupakan.', 11, '2024-11-10 02:17:17', '2024-11-10 02:17:17', 950000000, 'dalam negeri', 5, 'nib, npwp, HAKI', 15000000000, 'Pembanguanan studio', 'Pembanguan studio'),
(6, 'Adikarya Advertising', 'Jalan Merpati Raya No. 8, Kelurahan Pondok Bambu, Kecamatan Duren Sawit, Jakarta Timur, DKI Jakarta, 13430', 'CV', 'Adikarya Advertising adalah perusahaan periklanan yang mengedepankan kreativitas, inovasi, dan hasil yang terukur. Kami membangun kemitraan jangka panjang dengan klien kami untuk membantu mereka mencapai tujuan bisnis. Dengan tim yang berdedikasi dan berpengalaman, kami siap membantu merek Anda bersinar.', 12, '2024-11-10 02:26:26', '2024-11-10 02:26:26', 950000000, 'dalam negeri', 5, 'nib, npwp, HAKI', 15000000000, 'Perluasan banguanan', 'Perluasan banguanan');

-- --------------------------------------------------------

--
-- Table structure for table `umkm_images`
--

CREATE TABLE `umkm_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `umkm_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `img_profile` text NOT NULL,
  `img_ktp` text NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `alamat`, `phone`, `img_profile`, `img_ktp`, `remember_token`, `created_at`, `updated_at`, `otp`, `is_verified`, `category`) VALUES
(1, 'John Abruzi', 'johnabruzi@gmail.com', NULL, '$2y$12$vpWv71.KLUvtEqKi4oFnaOaZAdxGYzseNW0/Zge75HLvl0AHG4qaW', 'investor', 'Jl. Merdeka No. 45, Kelurahan Menteng, Kecamatan Menteng, Jakarta Pusat, DKI Jakarta 10310', '081234567890', 'img_profile/3KYDpJiNIBWohNZiyloR8ngZRfWiJ6eThGJcNrLT.jpg', 'img_ktp/I8KNrkEdAvUTxVz7zxOctG1agw7zzYDo3pMhT5hg.png', NULL, '2024-11-09 23:35:18', '2024-11-09 23:45:30', NULL, 1, 'kuliner'),
(2, 'Mike Corleone', 'mikecorleone@gmail.com', NULL, '$2y$12$iZPYRAOBJOAePNzWHl5jnO0bCsowSvlk1Fyu1tM5z1eCWfCkkjjpu', 'investor', 'Jl. Ahmad Yani No. 12, Kelurahan Cihapit, Kecamatan Bandung Wetan, Bandung, Jawa Barat 40115', '082134567891', 'img_profile/Qbej45QVeOerhekTm5WNdjJovWCZZ97X4rPxxkcL.jpg', 'img_ktp/cEm90FIY6vKA5kFzyi899E2QfswFoTgoJCwj10Nt.png', NULL, '2024-11-09 23:37:04', '2024-11-09 23:46:15', NULL, 1, 'fashion'),
(3, 'Antonio Montana', 'antoniomontana@gmail.com', NULL, '$2y$12$AYOJ5Dnd7ePIZwmUzKszROJt/FLXvvr6x2MENR3fO3/d2lCuTNjlC', 'investor', 'Jl. Diponegoro No. 88, Kelurahan Sumurboto, Kecamatan Banyumanik, Semarang, Jawa Tengah 50269', '083134567892', 'img_profile/Zg34iWUadsEmUBtY2olIV05bxsfyIbK8wQN0CKza.jpg', 'img_ktp/L1aHajGl8Z4dFOvBOBrgoDLj4KoMWtOHrRKfGLxP.png', NULL, '2024-11-09 23:38:28', '2024-11-09 23:46:52', NULL, 1, 'kriya'),
(4, 'Margaret', 'margaret@gmail.com', NULL, '$2y$12$anf7FEN3jci.kZxA6ChnGeeJHqds/sgMAd82jtRAbw8qBAfwetHwm', 'investor', 'Jl. Teuku Umar No. 27, Kelurahan Panjer, Kecamatan Denpasar Selatan, Denpasar, Bali 80234', '084134567893', 'img_profile/9bagBeXh6kqdKPW39v4l9jGecRjnq223VPfkmNKW.jpg', 'img_ktp/QfHPNsYTsXiAFQpd5nwuMrU3FEwQr4JwtnC3qcfM.png', NULL, '2024-11-09 23:40:12', '2024-11-09 23:47:23', NULL, 1, 'seni'),
(5, 'Kirana', 'kirana@gmail.com', NULL, '$2y$12$LMtED9T5z7xvv2DwDVxme.UQlQhF7hz5Ec6MTHI/8xHwyxow27hc2', 'investor', 'Jl. Sudirman No. 15, Kelurahan Klojen, Kecamatan Klojen, Malang, Jawa Timur 65116', '085134567894', 'img_profile/ZlBeNgqRAz7N1HQ6uhISnzRppCb5YxLNVj7pBWc7.jpg', 'img_ktp/akfbbSyaKGdxlmIbCTtgPBIO1POmHYVE4M0MDylg.png', NULL, '2024-11-09 23:42:24', '2024-11-09 23:48:03', NULL, 1, 'periklanan'),
(6, 'Jane', 'jane@gmail.com', NULL, '$2y$12$AI0J8gx2bl3qBcRI.yVso.u01cDoEu7/u9AXeGWVzb48V7CktO8CS', 'investor', 'Jl. Imam Bonjol No. 50, Kelurahan Klodran, Kecamatan Klaten Selatan, Klaten, Jawa Tengah 57425', '086134567895', 'img_profile/0abTtzfXvUSz7YvWTL5GaoXXs61orLpnBZxcUt3W.jpg', 'img_ktp/dgOr1wOKjRKn5T8WxyeSMJRi0ohNOvqvLyMRkgQP.png', NULL, '2024-11-09 23:44:32', '2024-11-10 04:30:16', '9332', 0, 'aplikasi&gim'),
(7, 'Tika', 'tika@gmail.com', NULL, '$2y$12$z0NUUd78JhKetB9G1KwqU.rOGSZZp2NCGQ4QHlW2F0/kAmjkbLSAi', 'umkm', 'Jalan Mawar No. 10, Kelurahan Melati, Kecamatan Kembangan, Jakarta Barat, DKI Jakarta, 11610', '081345678901', 'img_profile/0khBIEjnuXDcLEpOR3sxxgGGRNxG7pMrRMsdJGIN.jpg', 'img_ktp/aizTRu9WlY4h3eocky4TcIyVpEThPq9ohldauneq.png', NULL, '2024-11-10 00:05:17', '2024-11-10 00:15:30', NULL, 1, 'aplikasi&gim'),
(8, 'Melati', 'melati@gmail.com', NULL, '$2y$12$uXNcn/drscJDrm8gIQXCR.yC5.r0xxfKaaQseJZanBtS5Wqa8XaeC', 'umkm', 'Kompleks Permata Indah Blok A2 No. 15, Kelurahan Seruni, Kecamatan Ciputat, Tangerang Selatan, Banten, 15411', '082234567890', 'img_profile/k5cvVJH3i2XEwW6X0qGW7vLGu3OWAARyBAVqJw9v.jpg', 'img_ktp/4DVQIOOSuTn74WgHkQOL0oy9dzWUvF8JbhNGEjIj.png', NULL, '2024-11-10 00:07:21', '2024-11-10 00:16:30', NULL, 1, 'kuliner'),
(9, 'Jasmine', 'jasmine@gmail.com', NULL, '$2y$12$wbUAX21QZzx/4kWOQeR8ge.JI8gxnU/ml2nP3Ls61pFsfc3H.GQNy', 'umkm', 'Jalan Kenanga No. 24, Kelurahan Menteng, Kecamatan Menteng, Jakarta Pusat, DKI Jakarta, 10310', '083890123456', 'img_profile/Q49URqusrIPyGMyUoIpUBD7hsLEpfHhRYl0sFcPH.jpg', 'img_ktp/u498DDbYC6klOPcamnV5Ynsgy41LA1VAOVVPVTCe.png', NULL, '2024-11-10 00:08:58', '2024-11-10 00:17:12', NULL, 1, 'fashion'),
(10, 'Liam', 'liam@gmail.com', NULL, '$2y$12$4hHfmd1eCgE1HtdoxDIgD.ZO4dSiEpP9lEUc3Y0o3vRMpOvpkSJ/K', 'umkm', 'Jalan Pahlawan No. 7, Kelurahan Sukamaju, Kecamatan Beji, Depok, Jawa Barat, 16425', '085723456789', 'img_profile/i098YMpKrFovEWt3xZPuGXaaaRGBNRV44rdb6t3q.jpg', 'img_ktp/TvFdG5Goh09Im1XzH5M7edT60NNfuTn2bR160Tif.png', NULL, '2024-11-10 00:12:30', '2024-11-10 00:17:37', NULL, 1, 'kriya'),
(11, 'Noel', 'noel@gmail.com', NULL, '$2y$12$1GltVxgDvFUSKRAkot8QSexHfXx/K3iBQIx/Oguop0TNM10I8gOW6', 'umkm', 'Perumahan Griya Asri Blok C No. 12, Kelurahan Mekar Jaya, Kecamatan Sukmajaya, Depok, Jawa Barat, 16415', '087789012345', 'img_profile/cdansDTaodol3DjvDHWxZil6NYYJNg6OEyW9BL2L.jpg', 'img_ktp/dHcXIVIdGOtWjPXTCkZPyGGe18piaoutLSEvwaR7.png', NULL, '2024-11-10 00:13:51', '2024-11-10 00:18:12', NULL, 1, 'seni'),
(12, 'Jimmy', 'jimmy@gmail.com', NULL, '$2y$12$xvtt4WEuQmhmj3eaO0M1J.UeIu8Q2EUANv5QWtAKPb4qCZxB9uTwu', 'umkm', 'Jalan Merpati Raya No. 8, Kelurahan Pondok Bambu, Kecamatan Duren Sawit, Jakarta Timur, DKI Jakarta, 13430', '089567890123', 'img_profile/BGX7DalLCny6n5VwOF6ZU7DxBrrHkQCY2p6YXFPA.jpg', 'img_ktp/ARISsiRZh5DPnVJrSo89o3CMr3NchjgXeVgsKeqG.png', NULL, '2024-11-10 00:15:03', '2024-11-10 00:18:33', NULL, 1, 'periklanan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `certification_images`
--
ALTER TABLE `certification_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `certification_images_umkm_id_foreign` (`umkm_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_keuangans`
--
ALTER TABLE `laporan_keuangans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_keuangans_umkm_id_foreign` (`umkm_id`);

--
-- Indexes for table `location_images`
--
ALTER TABLE `location_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_images_umkm_id_foreign` (`umkm_id`);

--
-- Indexes for table `logo_images`
--
ALTER TABLE `logo_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logo_images_umkm_id_foreign` (`umkm_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `n_i_b_images`
--
ALTER TABLE `n_i_b_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `n_i_b_images_umkm_id_foreign` (`umkm_id`);

--
-- Indexes for table `n_p_w_p_images`
--
ALTER TABLE `n_p_w_p_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `n_p_w_p_images_umkm_id_foreign` (`umkm_id`);

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
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_umkm_id_foreign` (`umkm_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `umkms`
--
ALTER TABLE `umkms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `umkms_user_id_unique` (`user_id`);

--
-- Indexes for table `umkm_images`
--
ALTER TABLE `umkm_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `umkm_images_umkm_id_foreign` (`umkm_id`);

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
-- AUTO_INCREMENT for table `certification_images`
--
ALTER TABLE `certification_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_keuangans`
--
ALTER TABLE `laporan_keuangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `location_images`
--
ALTER TABLE `location_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `logo_images`
--
ALTER TABLE `logo_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `n_i_b_images`
--
ALTER TABLE `n_i_b_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `n_p_w_p_images`
--
ALTER TABLE `n_p_w_p_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `umkms`
--
ALTER TABLE `umkms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `umkm_images`
--
ALTER TABLE `umkm_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certification_images`
--
ALTER TABLE `certification_images`
  ADD CONSTRAINT `certification_images_umkm_id_foreign` FOREIGN KEY (`umkm_id`) REFERENCES `umkms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `laporan_keuangans`
--
ALTER TABLE `laporan_keuangans`
  ADD CONSTRAINT `laporan_keuangans_umkm_id_foreign` FOREIGN KEY (`umkm_id`) REFERENCES `umkms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `location_images`
--
ALTER TABLE `location_images`
  ADD CONSTRAINT `location_images_umkm_id_foreign` FOREIGN KEY (`umkm_id`) REFERENCES `umkms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `logo_images`
--
ALTER TABLE `logo_images`
  ADD CONSTRAINT `logo_images_umkm_id_foreign` FOREIGN KEY (`umkm_id`) REFERENCES `umkms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `n_i_b_images`
--
ALTER TABLE `n_i_b_images`
  ADD CONSTRAINT `n_i_b_images_umkm_id_foreign` FOREIGN KEY (`umkm_id`) REFERENCES `umkms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `n_p_w_p_images`
--
ALTER TABLE `n_p_w_p_images`
  ADD CONSTRAINT `n_p_w_p_images_umkm_id_foreign` FOREIGN KEY (`umkm_id`) REFERENCES `umkms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_umkm_id_foreign` FOREIGN KEY (`umkm_id`) REFERENCES `umkms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `umkms`
--
ALTER TABLE `umkms`
  ADD CONSTRAINT `umkms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `umkm_images`
--
ALTER TABLE `umkm_images`
  ADD CONSTRAINT `umkm_images_umkm_id_foreign` FOREIGN KEY (`umkm_id`) REFERENCES `umkms` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
