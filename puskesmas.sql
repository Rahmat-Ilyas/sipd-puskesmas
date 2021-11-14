-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 14 Nov 2021 pada 22.03
-- Versi server: 8.0.27-0ubuntu0.20.04.1
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `puskesmas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `nama`, `nip`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Muhammad Ilham', '14021998', 'admin', '$2y$10$hQq1vl6PWFknmvXUpjmFieBJpwBj25hagv0xqE/s..p9RQdeP2yo2', 'MCELP0eppnRcWjicF5MLyL7TYT2hnadj4F6sQmEEqENLpXm2Pe1mBRsvi9mr', '2021-10-25 09:08:31', '2021-10-27 14:21:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian`
--

CREATE TABLE `antrian` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `poli_id` int NOT NULL,
  `nomor_antrian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `antrian`
--

INSERT INTO `antrian` (`id`, `user_id`, `poli_id`, `nomor_antrian`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'A-001', 'cancel', '2021-11-02 06:26:20', '2021-11-03 09:48:40'),
(2, 1, 1, 'A-002', 'finish', '2021-11-02 06:26:20', '2021-11-03 09:47:22'),
(3, 1, 1, 'A-001', 'cancel', '2021-11-03 07:15:41', '2021-11-04 09:32:06'),
(4, 2, 1, 'A-002', 'cancel', '2021-11-03 10:33:44', '2021-11-04 09:32:07'),
(10, 1, 1, 'A-001', 'cancel', '2021-11-04 10:39:04', '2021-11-05 06:52:52'),
(11, 2, 1, 'A-002', 'cancel', '2021-11-04 11:03:06', '2021-11-05 06:52:52'),
(16, 3, 2, 'B-001', 'cancel', '2021-11-04 11:15:44', '2021-11-05 06:52:53'),
(17, 1, 1, 'A-001', 'cancel', '2021-11-05 08:42:32', '2021-11-06 07:35:04'),
(18, 4, 2, 'B-001', 'cancel', '2021-11-05 08:43:47', '2021-11-06 07:35:05'),
(19, 7, 1, 'A-002', 'cancel', '2021-11-05 09:37:36', '2021-11-06 07:35:05'),
(20, 1, 1, 'A-001', 'cancel', '2021-11-06 09:39:21', '2021-11-07 06:19:36'),
(21, 1, 1, 'A-001', 'cancel', '2021-11-07 06:20:08', '2021-11-11 05:07:39'),
(22, 2, 1, 'A-001', 'cancel', '2021-11-11 06:16:58', '2021-11-12 06:43:38'),
(23, 1, 3, 'C-001', 'cancel', '2021-11-11 06:17:55', '2021-11-12 06:43:38'),
(24, 4, 3, 'C-002', 'cancel', '2021-11-11 06:30:27', '2021-11-12 06:43:38'),
(25, 3, 3, 'C-003', 'finish', '2021-11-11 06:31:10', '2021-11-11 12:40:04'),
(26, 5, 3, 'C-004', 'finish', '2021-11-11 06:31:48', '2021-11-11 12:42:26'),
(27, 6, 3, 'C-005', 'cancel', '2021-11-11 06:53:00', '2021-11-12 06:43:38'),
(28, 1, 1, 'A-001', 'finish', '2021-11-12 06:56:35', '2021-11-12 06:59:09'),
(29, 1, 1, 'A-002', 'finish', '2021-11-12 07:14:36', '2021-11-12 07:18:01'),
(30, 3, 1, 'A-003', 'finish', '2021-11-12 07:15:27', '2021-11-12 07:16:23'),
(31, 4, 1, 'A-004', 'finish', '2021-11-12 07:51:42', '2021-11-12 12:51:52'),
(32, 1, 1, 'A-001', 'finish', '2021-11-13 12:04:45', '2021-11-13 12:34:32'),
(33, 2, 1, 'A-002', 'cancel', '2021-11-13 12:05:06', '2021-11-13 16:00:15'),
(34, 3, 1, 'A-003', 'cancel', '2021-11-13 12:05:18', '2021-11-13 16:00:21'),
(35, 4, 1, 'A-004', 'cancel', '2021-11-13 12:05:36', '2021-11-13 16:00:22'),
(36, 5, 1, 'A-005', 'cancel', '2021-11-13 12:05:48', '2021-11-13 16:00:23'),
(37, 6, 1, 'A-006', 'cancel', '2021-11-13 12:06:00', '2021-11-13 16:00:24'),
(38, 7, 1, 'A-007', 'cancel', '2021-11-13 12:06:18', '2021-11-13 16:00:25'),
(39, 1, 1, 'A-001', 'calling', '2021-11-14 11:42:30', '2021-11-14 11:44:05'),
(40, 2, 1, 'A-002', 'new', '2021-11-14 11:42:42', '2021-11-14 11:42:42'),
(41, 3, 1, 'A-003', 'new', '2021-11-14 11:42:55', '2021-11-14 11:42:55'),
(42, 4, 2, 'B-001', 'calling', '2021-11-14 11:43:06', '2021-11-14 12:03:52'),
(43, 5, 2, 'B-002', 'new', '2021-11-14 11:43:16', '2021-11-14 11:43:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id` bigint UNSIGNED NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spesialis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id`, `nip`, `nama`, `spesialis`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `status_pegawai`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '140298', 'dr. Rahmat Ilyas', 'Jantung', 'Laki-laki', 'Karangpuang', '1998-02-14', 'BTN. Bina Sarana Residence 2, Moncongloe, Kab. Maros', 'Aktif', '$2y$10$dslqYTP0wIfVRUdwZbolNuNpe4QX5KhLM/vVBxqQnrcik7RDDtImK', NULL, '2021-10-25 03:15:28', '2021-11-06 08:36:03'),
(2, '231196', 'dr. Sri Wahyuni', 'Dokter Umum', 'Perempuan', 'Tanete', '1987-11-23', 'Jl. Kemakmuran Tanete', 'Aktif', '$2y$10$12jy8qVx3GNgl8lrOr6L4OnT38NvJHUBYIOeapJmVPYIIyZGA.atG', NULL, '2021-10-25 14:01:28', '2021-10-25 14:01:28'),
(3, '14021998', 'dr. Karmila Sari', 'Dokter Anak', 'Perempuan', 'Makassar', '1987-10-20', 'Jl. Sungguminasa, Kab. Gowa', 'Aktif', '$2y$10$b7w04GcdDw8.zYwoWJ5nxOykrOp2Ol.DU3vGXXbc7TOf5cczqPzJK', 'U0sh9wQvqBTziRTfbhGhltHYNfqY5VOlnxSoiBroUgLEIBhzs89ZBrXcf8vM', '2021-10-25 14:13:00', '2021-10-25 15:00:25'),
(5, '9843526', 'dr. Wahyddin Annur', 'Tulang', 'Laki-laki', 'Jl. Bunga Harapan', '1988-07-14', 'Jl. Bunga Harapan, Kelurahan Jawi-jawi', 'Aktif', '$2y$10$OPnOtJ6xhI9IKTzuQyT2kO20vBLxD16ZwZi0Wk0cxiAKOMTcAxDeS', NULL, '2021-10-26 09:44:41', '2021-10-27 12:49:26'),
(6, '123654', 'dr. Saryad Ahdi', 'Mata', 'Laki-laki', 'Malakaji', '1992-02-18', 'Jl. Bontonompo Selatan', 'Aktif', '$2y$10$Yb9xYx4x5M9TacCzcswhZOkoxMPoAuQTI92HFg4D41LxmefHEopAe', NULL, '2021-11-06 07:44:25', '2021-11-06 07:44:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id` bigint UNSIGNED NOT NULL,
  `poli_id` int NOT NULL,
  `hari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id`, `poli_id`, `hari`, `jam`, `created_at`, `updated_at`) VALUES
(19, 1, 'Senin - Minggu', '00:00 - 23:59', '2021-11-01 11:29:45', '2021-11-01 11:29:45'),
(20, 3, 'Senin - Minggu', '07:00 - 16:00', '2021-11-01 11:30:09', '2021-11-01 11:30:09'),
(21, 2, 'Senin - Minggu', '09:00 - 23:59', '2021-11-04 11:15:10', '2021-11-04 11:15:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2021_10_25_002149_create_admins_table', 2),
(10, '2014_10_12_000000_create_users_table', 3),
(11, '2021_10_25_001732_create_doctors_table', 3),
(12, '2021_10_26_120954_create_polis_table', 4),
(13, '2021_10_26_121355_create_jadwals_table', 4),
(14, '2021_11_01_175900_create_antrians_table', 5),
(15, '2021_11_11_200505_create_pemeriksaans_table', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemeriksaan`
--

CREATE TABLE `pemeriksaan` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `dokter_id` int NOT NULL,
  `poli_id` int NOT NULL,
  `tggl_pemeriksaan` datetime NOT NULL,
  `keluhan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `diagnosis` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pulang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prb` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prolanis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pemeriksaan`
--

INSERT INTO `pemeriksaan` (`id`, `user_id`, `dokter_id`, `poli_id`, `tggl_pemeriksaan`, `keluhan`, `diagnosis`, `status_pulang`, `prb`, `prolanis`, `created_at`, `updated_at`) VALUES
(1, 3, 3, 1, '2021-11-11 20:40:03', 'Tidak enak badan', 'Kejang kejang saat makan, mungkin diare', 'Berobat Jalan', '', '', '2021-11-11 12:40:04', '2021-11-11 12:40:04'),
(2, 5, 3, 1, '2021-11-11 20:42:25', 'mual kalau makan', 'gagal patah hati', 'Rujuk Vertikal', '', '', '2021-11-11 12:42:25', '2021-11-11 12:42:25'),
(3, 1, 1, 1, '2021-11-12 14:59:09', 'Mual dan kejang kejang', 'Diare', 'Berobat Jalan', '', '', '2021-11-12 06:59:09', '2021-11-12 06:59:09'),
(4, 3, 1, 1, '2021-11-12 15:16:23', 'Sakit Kepala', 'Tipes', 'Opname', '', '', '2021-11-12 07:16:23', '2021-11-12 07:16:23'),
(5, 1, 1, 1, '2021-11-12 15:18:01', 'Batuk', 'Diarenya kambuh', 'Berobat Jalan', '', '', '2021-11-12 07:18:01', '2021-11-12 07:18:01'),
(6, 4, 1, 1, '2021-11-12 20:51:50', 'Bersin', 'Corona', 'Rujuk Vertikal', '', '', '2021-11-12 12:51:50', '2021-11-12 12:51:50'),
(7, 1, 1, 1, '2021-11-13 20:34:31', 'Sakit kepala', 'Migren', 'Sembuh', '', '', '2021-11-13 12:34:31', '2021-11-13 12:34:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `poli`
--

CREATE TABLE `poli` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_poli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_poli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dokter_id` int NOT NULL,
  `status_layanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `poli`
--

INSERT INTO `poli` (`id`, `kode_poli`, `nama_poli`, `dokter_id`, `status_layanan`, `keterangan`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'pl0342', 'Poli Umum', 1, 'Aktif', 'Pelayanan kesehatan umum yang menyangkut kesehatan masyarakat', '$2y$10$hQq1vl6PWFknmvXUpjmFieBJpwBj25hagv0xqE/s..p9RQdeP2yo2', NULL, '2021-10-26 08:29:24', '2021-11-12 13:16:30'),
(2, 'pl9876', 'Poli KIA/KB', 2, 'Aktif', 'Poli khsus KIA dll', '$2y$10$hQq1vl6PWFknmvXUpjmFieBJpwBj25hagv0xqE/s..p9RQdeP2yo2', NULL, '2021-10-26 09:06:40', '2021-11-13 11:06:30'),
(3, 'pl7654', 'Poli Gigi', 3, 'Aktif', 'Poli Untuk Pelayanan Gigi Anda', '$2y$10$hQq1vl6PWFknmvXUpjmFieBJpwBj25hagv0xqE/s..p9RQdeP2yo2', NULL, '2021-10-26 09:07:35', '2021-11-11 06:01:06'),
(4, 'pl3966', 'Poli Gizi', 5, 'Aktif', 'Melayani pemeriksaan Gizi', '$2y$10$eng7/otHmw8lkG4kQHQBHOdSS/6QZ31DuMUkERmk28fs/QntLIQGC', NULL, '2021-10-26 09:43:16', '2021-10-26 09:46:04'),
(6, 'pl3401', 'Poli Anak', 6, 'Aktif', 'Melayani imunisasi dan kesehatan anak', '$2y$10$y/TSCzp9VEOVp/yJ.8HL1.8S5K8sMcLM2lTsrDm5PAUPkM8eGYWLq', NULL, '2021-10-28 13:39:28', '2021-11-11 06:04:30'),
(7, 'pl1648', 'Poli TB Kusta', 3, 'Aktif', 'Yuhu', '$2y$10$/CtFsmLLG69oYtB1L.Y7W.BP3kiPg.nhVgUL.oXQJonCp5m3hep5y', NULL, '2021-10-28 13:40:00', '2021-11-13 11:19:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` bigint UNSIGNED NOT NULL,
  `no_rekam_medik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jaminan_kesehatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_perkawinan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `no_rekam_medik`, `nik`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `jaminan_kesehatan`, `status_perkawinan`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'P000001', '99807801402980004', 'Rahmat Ilyas', 'Laki-laki', 'Karangpuang', '1998-02-14', 'Karangpuang', 'BPJS', 'Menikah', '$2y$10$hQq1vl6PWFknmvXUpjmFieBJpwBj25hagv0xqE/s..p9RQdeP2yo2', 'aQB02PnQVDd0AwF2PzeL853yQEmKiGmW4GCrWPjtWTNJe0XXHQAtQOzwXrYT', '2021-10-25 06:19:37', '2021-10-28 09:49:29'),
(2, 'P000002', '99807801402980001', 'Rahmat Ilham', 'Laki-laki', 'Karangpuang', '1998-04-04', 'Karangpuang', 'BPJS', 'Belum Menikah', '$2y$10$hQq1vl6PWFknmvXUpjmFieBJpwBj25hagv0xqE/s..p9RQdeP2yo2', 'rOQ1o6214exPwi6VrrgphdL77I6bsCisc1kp56lBkbTxJtx5Q9UvHrmQTmbt', '2021-10-25 09:41:21', '2021-10-25 09:41:21'),
(3, 'P000003', '998675764700', 'Wahyuddin Annur', 'Laki-laki', 'Karangpuang', '1998-02-14', 'Jl. Andi Tonro, No. 18', 'BPJS', 'Belum Menikah', '$2y$10$5V6f2qmGgVxHrPqWsc7kduw168ZcvC5MZEhm43rhWKhF3MHQGRbz.', NULL, '2021-11-04 11:07:20', '2021-11-11 11:28:44'),
(4, 'P000004', '998013736473', 'Maya Aryani', 'Perempuan', 'Tanete', '2001-09-13', 'Jl. Kemakmuran Tanete, No. 12', 'BPJS', 'Belum Menikah', '$2y$10$EPXdOth/QpE5uSO82m3StuEzzznTHv5gzk3XGaMRoYhBspLkL25/C', NULL, '2021-11-05 07:18:58', '2021-11-05 07:18:58'),
(5, 'P000005', '6998958574645445', 'Wirna Sentia Rahayu', 'Perempuan', 'Bonto Bolaeng', '1998-11-11', 'Desa Bonto Bolaeng', 'BPJS', 'Belum Menikah', '$2y$10$nhkPNBBRjLzYaw6RHRWAh.9r7xTu4NwhTCRFckgfyniucYVaTFG1y', NULL, '2021-11-05 09:25:15', '2021-11-05 09:25:15'),
(6, 'P000006', '9980060676767666', 'A. Nur Lita', 'Perempuan', 'Tanete', '1997-12-10', 'Jl. Langsat, Kel. Tanete', 'BPJS', 'Belum Menikah', '$2y$10$L9zn9h4moiJbkg.RAE7Fge1CEC/MjM1IZf2C1dEwM2/LRtTpxZvJK', NULL, '2021-11-05 09:29:34', '2021-11-05 09:29:34'),
(7, 'P000007', '998670236354634', 'Astriani', 'Perempuan', 'Karangpuag', '1998-09-16', 'Dusun Karangpuanf, Desa Barugae', 'BPJS', 'Belum Menikah', '$2y$10$v6uZaMSmpfZxCOQH8P60purD2ciuk5qrkuGze.MthaRyWYOxFV6Ci', NULL, '2021-11-05 09:37:26', '2021-11-05 09:37:26');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dokter_nip_unique` (`nip`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_poli` (`kode_poli`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_no_rekam_medik_unique` (`no_rekam_medik`),
  ADD UNIQUE KEY `user_nik_unique` (`nik`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `poli`
--
ALTER TABLE `poli`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
