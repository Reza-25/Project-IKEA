-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jul 2025 pada 09.53
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ikea`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aktivitas_cabang`
--

CREATE TABLE `aktivitas_cabang` (
  `id_aktivitas` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `periode` date NOT NULL,
  `customer_handling` int(11) DEFAULT 0,
  `stock_management` int(11) DEFAULT 0,
  `operational_support` int(11) DEFAULT 0,
  `team_collaboration` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `aktivitas_cabang`
--

INSERT INTO `aktivitas_cabang` (`id_aktivitas`, `id_toko`, `periode`, `customer_handling`, `stock_management`, `operational_support`, `team_collaboration`) VALUES
(1, 1, '2025-05-01', 173, 38, 63, 26),
(2, 1, '2025-06-01', 160, 30, 40, 22),
(3, 1, '2025-07-01', 104, 92, 106, 48),
(4, 2, '2025-05-01', 184, 96, 49, 65),
(5, 2, '2025-06-01', 128, 82, 85, 53),
(6, 2, '2025-07-01', 91, 86, 100, 40),
(7, 3, '2025-05-01', 130, 36, 57, 68),
(8, 3, '2025-06-01', 121, 54, 95, 44),
(9, 3, '2025-07-01', 194, 68, 113, 74),
(10, 4, '2025-05-01', 178, 56, 72, 74);

-- --------------------------------------------------------

--
-- Struktur dari tabel `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand_code` varchar(20) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT 0.0,
  `monthly_sales` int(11) DEFAULT 0,
  `average_price` decimal(12,2) DEFAULT 0.00,
  `status` enum('active','trending','stable','inactive') DEFAULT 'active',
  `stock_availability` decimal(5,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `brand`
--

INSERT INTO `brand` (`id`, `brand_code`, `brand_name`, `category_id`, `description`, `rating`, `monthly_sales`, `average_price`, `status`, `stock_availability`, `created_at`, `updated_at`) VALUES
(1, 'BRD001', 'LACK', 1, 'Meja dan rak serbaguna dengan desain minimalis dan harga terjangkau', 4.5, 1850, 199000.00, 'active', 89.50, '2025-07-16 13:06:31', '2025-07-17 00:45:32'),
(2, 'BRD002', 'SKÅDIS', 3, 'Sistem papan penyimpanan modular untuk dinding', 4.6, 1240, 299000.00, 'trending', 92.30, '2025-07-16 13:06:31', '2025-07-17 00:45:32'),
(3, 'BRD003', 'HEMNES', 1, 'Furniture kayu solid dengan desain klasik Skandinavia', 4.7, 1420, 599000.00, 'active', 88.75, '2025-07-16 13:06:31', '2025-07-17 00:45:32'),
(4, 'BRD004', 'KALLAX', 1, 'Rak serbaguna ikonik dengan desain kotak-kotak modular', 4.4, 1180, 399000.00, 'stable', 91.20, '2025-07-16 13:06:31', '2025-07-17 00:45:32'),
(5, 'BRD005', 'VITTSJÖ', 1, 'Rak dan meja dengan kombinasi kaca dan logam gaya industrial', 4.2, 980, 449000.00, 'stable', 85.60, '2025-07-16 13:06:31', '2025-07-17 00:45:32'),
(6, 'BRD006', 'VARIERA', 3, 'Solusi penyimpanan dapur modular yang praktis', 4.3, 1050, 249000.00, 'active', 90.40, '2025-07-16 13:06:31', '2025-07-17 00:45:32'),
(7, 'BRD007', 'FJÄLLBO', 1, 'Furniture kombinasi logam-kayu dengan gaya industrial', 4.1, 720, 799000.00, 'stable', 78.90, '2025-07-16 13:06:31', '2025-07-17 00:45:32'),
(8, 'BRD008', 'IVAR', 1, 'Sistem rak dan kabinet modular dari kayu pinus alami', 4.5, 890, 349000.00, 'active', 93.20, '2025-07-16 13:06:31', '2025-07-17 00:45:32'),
(9, 'BRD009', 'BILLY', 1, 'Rak buku serbaguna yang sangat populer dan customizable', 4.6, 1320, 199000.00, 'trending', 95.80, '2025-07-16 13:06:31', '2025-07-17 00:45:32'),
(10, 'BRD010', 'MALM', 1, 'Furniture kamar tidur modern dengan desain bersih', 4.4, 1150, 899000.00, 'active', 87.30, '2025-07-16 13:06:31', '2025-07-17 00:45:32'),
(11, 'BRD011', 'POÄNG', 1, 'Kursi malas ikonik dengan bingkai kayu lentur yang ergonomis', 4.8, 950, 1299000.00, 'trending', 82.10, '2025-07-16 13:06:31', '2025-07-17 00:45:32'),
(12, 'BRD012', 'EKET', 1, 'Sistem rak dinding modular minimalis untuk ruang kecil', 4.3, 780, 179000.00, 'stable', 91.70, '2025-07-16 13:06:31', '2025-07-17 00:45:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `brand_health_scores`
--

CREATE TABLE `brand_health_scores` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `health_score` int(3) DEFAULT 0,
  `stock_score` int(3) DEFAULT 0,
  `rating_score` int(3) DEFAULT 0,
  `sales_score` int(3) DEFAULT 0,
  `calculated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `brand_health_scores`
--

INSERT INTO `brand_health_scores` (`id`, `brand_id`, `health_score`, `stock_score`, `rating_score`, `sales_score`, `calculated_at`) VALUES
(1, 3, 87, 95, 94, 72, '2025-07-16 13:13:27'),
(2, 7, 62, 45, 68, 58, '2025-07-16 13:13:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `brand_notifications`
--

CREATE TABLE `brand_notifications` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `notification_type` enum('stock_critical','restock_frequent','review_negative','sales_drop') NOT NULL,
  `message` text NOT NULL,
  `priority` enum('low','medium','high','critical') DEFAULT 'medium',
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `brand_notifications`
--

INSERT INTO `brand_notifications` (`id`, `brand_id`, `notification_type`, `message`, `priority`, `is_read`, `created_at`) VALUES
(1, 1, 'stock_critical', 'LACK - Stok tinggal 6 unit', 'high', 0, '2025-07-16 13:13:13'),
(2, 2, 'restock_frequent', 'SKÅDIS - 4x restock dalam 30 hari', 'medium', 0, '2025-07-16 13:13:13'),
(3, 5, 'review_negative', 'VITTSJÖ - 8 review negatif minggu ini', 'medium', 0, '2025-07-16 13:13:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `brand_sales_history`
--

CREATE TABLE `brand_sales_history` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `sales_amount` decimal(15,2) DEFAULT 0.00,
  `units_sold` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `brand_sales_history`
--

INSERT INTO `brand_sales_history` (`id`, `brand_id`, `year`, `month`, `sales_amount`, `units_sold`, `created_at`) VALUES
(1, 1, 2025, 1, 32000000.00, 1600, '2025-07-16 13:11:15'),
(2, 1, 2025, 2, 35000000.00, 1750, '2025-07-16 13:11:15'),
(3, 1, 2025, 3, 38000000.00, 1900, '2025-07-16 13:11:15'),
(4, 1, 2025, 4, 41000000.00, 2050, '2025-07-16 13:11:15'),
(5, 1, 2025, 5, 44000000.00, 2200, '2025-07-16 13:11:15'),
(6, 1, 2025, 6, 42000000.00, 2100, '2025-07-16 13:11:15'),
(7, 1, 2025, 7, 45000000.00, 2250, '2025-07-16 13:11:15'),
(8, 1, 2025, 8, 48000000.00, 2400, '2025-07-16 13:11:15'),
(9, 2, 2025, 1, 22000000.00, 736, '2025-07-16 13:11:15'),
(10, 2, 2025, 2, 24000000.00, 803, '2025-07-16 13:11:15'),
(11, 2, 2025, 3, 26000000.00, 869, '2025-07-16 13:11:15'),
(12, 2, 2025, 4, 29000000.00, 970, '2025-07-16 13:11:15'),
(13, 2, 2025, 5, 31000000.00, 1037, '2025-07-16 13:11:15'),
(14, 2, 2025, 6, 3300000.00, 1103, '2025-07-16 13:11:15'),
(15, 2, 2025, 7, 35000000.00, 1170, '2025-07-16 13:11:15'),
(16, 2, 2025, 8, 3800000.00, 1270, '2025-07-16 13:11:15'),
(17, 3, 2024, 1, 31000000.00, 517, '2025-07-16 13:11:15'),
(18, 3, 2024, 2, 30000000.00, 500, '2025-07-16 13:11:15'),
(19, 3, 2024, 3, 29000000.00, 483, '2025-07-16 13:11:15'),
(20, 3, 2024, 4, 30000000.00, 500, '2025-07-16 13:11:15'),
(21, 1, 2024, 1, 29000000.00, 1450, '2025-07-16 13:11:15'),
(22, 1, 2024, 2, 31000000.00, 1550, '2025-07-16 13:11:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `brand_store_performance`
--

CREATE TABLE `brand_store_performance` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `sales_percentage` decimal(5,2) DEFAULT 0.00,
  `monthly_units_sold` int(11) DEFAULT 0,
  `is_top_location` tinyint(1) DEFAULT 0,
  `performance_rank` int(3) DEFAULT NULL,
  `period` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `brand_store_performance`
--

INSERT INTO `brand_store_performance` (`id`, `brand_id`, `id_toko`, `sales_percentage`, `monthly_units_sold`, `is_top_location`, `performance_rank`, `period`, `created_at`) VALUES
(1, 3, 1, 35.50, 1420, 1, 1, '2025-07-01', '2025-07-16 23:27:04'),
(2, 3, 5, 28.30, 1150, 1, 2, '2025-07-01', '2025-07-16 23:27:04'),
(3, 3, 9, 22.10, 890, 0, 3, '2025-07-01', '2025-07-16 23:27:04'),
(4, 3, 8, 18.70, 750, 0, 4, '2025-07-01', '2025-07-16 23:27:04'),
(5, 2, 13, 32.80, 1240, 1, 1, '2025-07-01', '2025-07-16 23:27:04'),
(6, 2, 8, 25.60, 980, 1, 2, '2025-07-01', '2025-07-16 23:27:04'),
(7, 2, 17, 21.40, 820, 0, 3, '2025-07-01', '2025-07-16 23:27:04'),
(8, 2, 14, 19.20, 730, 0, 4, '2025-07-01', '2025-07-16 23:27:04'),
(9, 1, 1, 42.30, 1850, 1, 1, '2025-07-01', '2025-07-16 23:27:04'),
(10, 1, 6, 38.90, 1680, 1, 2, '2025-07-01', '2025-07-16 23:27:04'),
(11, 1, 5, 35.20, 1520, 1, 3, '2025-07-01', '2025-07-16 23:27:04'),
(12, 1, 10, 31.80, 1380, 0, 4, '2025-07-01', '2025-07-16 23:27:04'),
(13, 4, 1, 29.50, 1180, 0, 1, '2025-07-01', '2025-07-16 23:27:04'),
(14, 4, 5, 26.80, 1050, 0, 2, '2025-07-01', '2025-07-16 23:27:04'),
(15, 4, 3, 24.30, 950, 0, 3, '2025-07-01', '2025-07-16 23:27:04'),
(16, 4, 8, 22.10, 860, 0, 4, '2025-07-01', '2025-07-16 23:27:04'),
(17, 5, 1, 24.60, 980, 0, 1, '2025-07-01', '2025-07-16 23:27:04'),
(18, 5, 6, 21.80, 870, 0, 2, '2025-07-01', '2025-07-16 23:27:04'),
(19, 5, 8, 19.40, 780, 0, 3, '2025-07-01', '2025-07-16 23:27:04'),
(20, 5, 13, 17.20, 690, 0, 4, '2025-07-01', '2025-07-16 23:27:04'),
(21, 6, 13, 28.70, 1050, 1, 1, '2025-07-01', '2025-07-16 23:27:04'),
(22, 6, 8, 25.30, 920, 0, 2, '2025-07-01', '2025-07-16 23:27:04'),
(23, 6, 14, 22.80, 830, 0, 3, '2025-07-01', '2025-07-16 23:27:04'),
(24, 6, 17, 20.40, 740, 0, 4, '2025-07-01', '2025-07-16 23:27:04'),
(25, 9, 1, 36.80, 1320, 1, 1, '2025-07-01', '2025-07-16 23:27:04'),
(26, 9, 5, 32.40, 1160, 1, 2, '2025-07-01', '2025-07-16 23:27:04'),
(27, 9, 10, 28.90, 1040, 0, 3, '2025-07-01', '2025-07-16 23:27:04'),
(28, 9, 11, 25.60, 920, 0, 4, '2025-07-01', '2025-07-16 23:27:04'),
(29, 10, 1, 31.20, 1150, 1, 1, '2025-07-01', '2025-07-16 23:27:04'),
(30, 10, 6, 27.80, 1020, 0, 2, '2025-07-01', '2025-07-16 23:27:04'),
(31, 10, 5, 24.60, 910, 0, 3, '2025-07-01', '2025-07-16 23:27:04'),
(32, 10, 8, 21.40, 790, 0, 4, '2025-07-01', '2025-07-16 23:27:04'),
(33, 11, 1, 26.50, 950, 1, 1, '2025-07-01', '2025-07-16 23:27:04'),
(34, 11, 6, 23.70, 850, 0, 2, '2025-07-01', '2025-07-16 23:27:04'),
(35, 11, 3, 21.20, 760, 0, 3, '2025-07-01', '2025-07-16 23:27:04'),
(36, 11, 13, 18.90, 680, 0, 4, '2025-07-01', '2025-07-16 23:27:04'),
(37, 7, 1, 19.80, 720, 0, 1, '2025-07-01', '2025-07-16 23:27:04'),
(38, 7, 8, 17.60, 640, 0, 2, '2025-07-01', '2025-07-16 23:27:04'),
(39, 7, 13, 15.40, 560, 0, 3, '2025-07-01', '2025-07-16 23:27:04'),
(40, 7, 10, 13.20, 480, 0, 4, '2025-07-01', '2025-07-16 23:27:04'),
(41, 8, 1, 24.30, 890, 0, 1, '2025-07-01', '2025-07-16 23:27:04'),
(42, 8, 5, 21.80, 800, 0, 2, '2025-07-01', '2025-07-16 23:27:04'),
(43, 8, 8, 19.40, 710, 0, 3, '2025-07-01', '2025-07-16 23:27:04'),
(44, 8, 11, 17.20, 630, 0, 4, '2025-07-01', '2025-07-16 23:27:04'),
(45, 12, 13, 21.60, 780, 0, 1, '2025-07-01', '2025-07-16 23:27:04'),
(46, 12, 8, 19.20, 690, 0, 2, '2025-07-01', '2025-07-16 23:27:04'),
(47, 12, 14, 17.40, 630, 0, 3, '2025-07-01', '2025-07-16 23:27:04'),
(48, 12, 1, 15.80, 570, 0, 4, '2025-07-01', '2025-07-16 23:27:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `budget` decimal(15,2) NOT NULL,
  `status` enum('safe','warning','danger') DEFAULT 'safe'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `budget`, `status`) VALUES
(1, 'Supplies', 50000000.00, 'safe'),
(2, 'Utilities', 30000000.00, 'safe'),
(3, 'Transport', 25000000.00, 'safe'),
(4, 'Employee', 100000000.00, 'safe'),
(5, 'Technology', 80000000.00, 'safe'),
(6, 'Marketing', 40000000.00, 'safe');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories_product`
--

CREATE TABLE `categories_product` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_code` varchar(10) NOT NULL,
  `description` text DEFAULT NULL,
  `color_code` varchar(7) DEFAULT '#1976d2',
  `status` enum('Active','Inactive','Pending','Ordered') DEFAULT 'Active',
  `created_by` varchar(100) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories_product`
--

INSERT INTO `categories_product` (`id`, `category_name`, `category_code`, `description`, `color_code`, `status`, `created_by`, `created_date`, `created_at`) VALUES
(1, 'Furniture', 'FURN', 'Furnitur rumah', '#0d47a1', 'Active', 'Admin A', '2022-01-01', '2025-07-16 16:55:23'),
(2, 'Lighting', 'LIGHT', 'Pencahayaan rumah modern', '#1565c0', 'Inactive', 'Admin B', '2022-01-10', '2025-07-16 16:55:23'),
(3, 'Storage', 'STOR', 'Lemari dan rak serbaguna', '#1976d2', 'Pending', 'Admin C', '2022-01-20', '2025-07-16 16:55:23'),
(4, 'Bedroom', 'BED', 'Perlengkapan kamar tidur', '#1e88e5', 'Active', 'Admin D', '2022-02-01', '2025-07-16 16:55:23'),
(5, 'Living Room', 'LIVE', 'Dekorasi dan sofa ruang tamu', '#2196f3', 'Pending', 'Admin E', '2022-02-05', '2025-07-16 16:55:23'),
(6, 'Kitchen', 'KITCH', 'Peralatan dapur modern', '#42a5f5', 'Active', 'Admin F', '2022-02-10', '2025-07-16 16:55:23'),
(7, 'Dining', 'DINE', 'Meja makan dan aksesoris', '#64b5f6', 'Ordered', 'Admin G', '2022-02-15', '2025-07-16 16:55:23'),
(8, 'Office', 'OFF', 'Furniture kantor fungsional', '#90caf9', 'Active', 'Admin H', '2022-02-20', '2025-07-16 16:55:23'),
(9, 'Outdoor', 'OUT', 'Furniture dan dekorasi luar ruangan', '#bbdefb', 'Pending', 'Admin I', '2022-03-01', '2025-07-16 16:55:23'),
(10, 'Textiles', 'TEXT', 'Tekstil dan karpet rumah', '#e3f2fd', 'Pending', 'Admin J', '2022-03-05', '2025-07-16 16:55:23'),
(11, 'Decoration', 'DECO', 'Hiasan dan ornamen', '#ffecb3', 'Active', 'Admin K', '2022-03-10', '2025-07-16 16:55:23'),
(12, 'Bathroom', 'BATH', 'Perlengkapan kamar mandi', '#fff9c4', 'Pending', 'Admin L', '2022-03-15', '2025-07-16 16:55:23'),
(13, 'Children', 'CHILD', 'Produk anak-anak', '#f0f4c3', 'Active', 'Admin M', '2022-03-20', '2025-07-16 16:55:23'),
(14, 'Appliances', 'APPL', 'Peralatan rumah tangga', '#dcedc8', 'Ordered', 'Admin N', '2022-03-25', '2025-07-16 16:55:23'),
(15, 'Rugs', 'RUG', 'Karpet berbagai ukuran', '#c8e6c9', 'Active', 'Admin O', '2022-04-01', '2025-07-16 16:55:23'),
(16, 'Mirrors', 'MIRR', 'Cermin dan aksesoris', '#b2dfdb', 'Active', 'Admin P', '2022-04-05', '2025-07-16 16:55:23'),
(17, 'Curtains', 'CURT', 'Tirai dan gorden', '#b2ebf2', 'Pending', 'Admin Q', '2022-04-10', '2025-07-16 16:55:23'),
(18, 'Plants', 'PLANT', 'Tanaman dan pot', '#b3e5fc', 'Active', 'Admin R', '2022-04-15', '2025-07-16 16:55:23'),
(19, 'Laundry', 'LAUND', 'Perlengkapan cuci', '#c5cae9', 'Pending', 'Admin S', '2022-04-20', '2025-07-16 16:55:23'),
(20, 'Cleaning', 'CLEAN', 'Peralatan kebersihan', '#d1c4e9', 'Active', 'Admin T', '2022-04-25', '2025-07-16 16:55:23'),
(21, 'Pet', 'PET', 'Produk untuk hewan peliharaan', '#e1bee7', 'Ordered', 'Admin U', '2022-04-30', '2025-07-16 16:55:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `category_budget_allocation`
--

CREATE TABLE `category_budget_allocation` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `fiscal_year` int(4) NOT NULL,
  `allocated_budget` decimal(15,2) NOT NULL,
  `spent_amount` decimal(15,2) DEFAULT 0.00,
  `remaining_budget` decimal(15,2) GENERATED ALWAYS AS (`allocated_budget` - `spent_amount`) STORED,
  `utilization_percentage` decimal(5,2) GENERATED ALWAYS AS (`spent_amount` / `allocated_budget` * 100) STORED,
  `quarter` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `category_budget_allocation`
--

INSERT INTO `category_budget_allocation` (`id`, `category_id`, `fiscal_year`, `allocated_budget`, `spent_amount`, `quarter`) VALUES
(1, 1, 2025, 150000000.00, 125000000.00, 3),
(2, 2, 2025, 120000000.00, 89000000.00, 3),
(3, 3, 2025, 80000000.00, 67000000.00, 3),
(4, 4, 2025, 95000000.00, 78000000.00, 3),
(5, 5, 2025, 115000000.00, 95000000.00, 3),
(6, 6, 2025, 70000000.00, 54000000.00, 3),
(7, 7, 2025, 55000000.00, 42000000.00, 3),
(8, 8, 2025, 50000000.00, 38000000.00, 3),
(9, 9, 2025, 40000000.00, 28000000.00, 3),
(10, 10, 2025, 60000000.00, 45000000.00, 3),
(11, 11, 2025, 30000000.00, 21000000.00, 3),
(12, 12, 2025, 45000000.00, 33000000.00, 3),
(13, 13, 2025, 50000000.00, 35000000.00, 3),
(14, 14, 2025, 35000000.00, 22000000.00, 3),
(15, 15, 2025, 40000000.00, 30000000.00, 3),
(16, 16, 2025, 25000000.00, 19000000.00, 3),
(17, 17, 2025, 35000000.00, 24000000.00, 3),
(18, 18, 2025, 40000000.00, 29000000.00, 3),
(19, 19, 2025, 25000000.00, 18000000.00, 3),
(20, 20, 2025, 30000000.00, 20000000.00, 3),
(21, 21, 2025, 20000000.00, 12000000.00, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `category_competition_analysis`
--

CREATE TABLE `category_competition_analysis` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `competitor_name` varchar(255) NOT NULL,
  `market_position` enum('leader','challenger','follower','niche') DEFAULT 'follower',
  `price_comparison` decimal(5,2) NOT NULL COMMENT 'percentage difference from our price',
  `quality_score` decimal(3,1) DEFAULT NULL,
  `analysis_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `category_competition_analysis`
--

INSERT INTO `category_competition_analysis` (`id`, `category_id`, `competitor_name`, `market_position`, `price_comparison`, `quality_score`, `analysis_date`) VALUES
(1, 1, 'Ashley Furniture', 'challenger', -15.20, 8.2, '2025-07-01'),
(2, 1, 'West Elm', 'challenger', 12.50, 8.8, '2025-07-01'),
(3, 2, 'Philips Lighting', 'leader', 8.30, 9.1, '2025-07-01'),
(4, 2, 'OSRAM', 'challenger', -5.40, 8.5, '2025-07-01'),
(5, 3, 'The Container Store', 'challenger', 18.90, 8.0, '2025-07-01'),
(6, 3, 'Rubbermaid', 'follower', -22.10, 7.5, '2025-07-01'),
(7, 4, 'Wayfair', 'challenger', 10.20, 8.3, '2025-07-01'),
(8, 5, 'Pottery Barn', 'challenger', 25.60, 9.0, '2025-07-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `category_performance_metrics`
--

CREATE TABLE `category_performance_metrics` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `periode` date NOT NULL,
  `total_sales` decimal(15,2) NOT NULL,
  `profit_margin` decimal(5,2) NOT NULL,
  `growth_rate` decimal(5,2) NOT NULL,
  `market_share` decimal(5,2) NOT NULL,
  `units_sold` int(11) NOT NULL,
  `avg_order_value` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `category_performance_metrics`
--

INSERT INTO `category_performance_metrics` (`id`, `category_id`, `periode`, `total_sales`, `profit_margin`, `growth_rate`, `market_share`, `units_sold`, `avg_order_value`) VALUES
(1, 1, '2025-07-01', 12500000.00, 18.50, 12.30, 35.20, 1200, 104166.67),
(2, 2, '2025-07-01', 89000000.00, 22.10, 8.70, 28.50, 800, 111250.00),
(3, 3, '2025-07-01', 67000000.00, 15.80, 15.20, 21.30, 950, 70526.32),
(4, 4, '2025-07-01', 78000000.00, 19.20, 11.50, 24.10, 1000, 78000.00),
(5, 5, '2025-07-01', 95000000.00, 21.40, 16.80, 30.20, 1100, 86363.64),
(6, 6, '2025-07-01', 54000000.00, 17.30, 9.20, 18.50, 700, 77142.86),
(7, 7, '2025-07-01', 42000000.00, 16.80, 7.40, 15.20, 600, 70000.00),
(8, 8, '2025-07-01', 38000000.00, 18.90, 8.10, 14.30, 550, 69090.91),
(9, 9, '2025-07-01', 28000000.00, 14.20, 5.60, 12.10, 400, 70000.00),
(10, 10, '2025-07-01', 45000000.00, 19.50, 10.30, 16.80, 650, 69230.77),
(11, 11, '2025-07-01', 21000000.00, 12.40, 4.20, 8.90, 300, 70000.00),
(12, 12, '2025-07-01', 33000000.00, 16.70, 7.80, 13.20, 480, 68750.00),
(13, 13, '2025-07-01', 35000000.00, 18.20, 25.00, 14.50, 500, 70000.00),
(14, 14, '2025-07-01', 22000000.00, 13.80, 3.10, 9.80, 320, 68750.00),
(15, 15, '2025-07-01', 30000000.00, 15.60, 6.90, 12.50, 430, 69767.44),
(16, 16, '2025-07-01', 19000000.00, 14.30, 4.80, 8.20, 280, 67857.14),
(17, 17, '2025-07-01', 24000000.00, 15.90, 5.70, 10.30, 350, 68571.43),
(18, 18, '2025-07-01', 29000000.00, 17.40, 8.50, 11.90, 420, 69047.62),
(19, 19, '2025-07-01', 18000000.00, 13.20, 3.50, 7.60, 260, 69230.77),
(20, 20, '2025-07-01', 20000000.00, 14.50, 4.30, 8.70, 290, 68965.52),
(21, 21, '2025-07-01', 12000000.00, 11.80, 2.80, 5.90, 180, 66666.67);

-- --------------------------------------------------------

--
-- Struktur dari tabel `category_sales_trends`
--

CREATE TABLE `category_sales_trends` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `weekly_sales` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`weekly_sales`)),
  `monthly_total` decimal(15,2) NOT NULL,
  `trend_direction` enum('up','down','stable') DEFAULT 'stable',
  `percentage_change` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `category_sales_trends`
--

INSERT INTO `category_sales_trends` (`id`, `category_id`, `year`, `month`, `weekly_sales`, `monthly_total`, `trend_direction`, `percentage_change`) VALUES
(1, 1, 2025, 1, '[100, 120, 115, 130, 125, 140, 135, 150]', 120000000.00, 'up', 8.50),
(2, 1, 2025, 2, '[100, 120, 115, 130, 125, 140, 135, 150]', 121000000.00, 'up', 0.83),
(3, 1, 2025, 3, '[100, 120, 115, 130, 125, 140, 135, 150]', 122000000.00, 'up', 0.83),
(4, 1, 2025, 4, '[100, 120, 115, 130, 125, 140, 135, 150]', 123000000.00, 'up', 0.82),
(5, 1, 2025, 5, '[100, 120, 115, 130, 125, 140, 135, 150]', 124000000.00, 'up', 0.81),
(6, 1, 2025, 6, '[100, 120, 115, 130, 125, 140, 135, 150]', 124500000.00, 'up', 0.40),
(7, 1, 2025, 7, '[100, 120, 115, 130, 125, 140, 135, 150]', 125000000.00, 'up', 0.40),
(8, 5, 2025, 1, '[90, 95, 100, 105, 110, 115, 120, 125]', 88000000.00, 'up', 12.30),
(9, 5, 2025, 2, '[90, 95, 100, 105, 110, 115, 120, 125]', 90000000.00, 'up', 2.27),
(10, 5, 2025, 3, '[90, 95, 100, 105, 110, 115, 120, 125]', 91500000.00, 'up', 1.67),
(11, 5, 2025, 4, '[90, 95, 100, 105, 110, 115, 120, 125]', 92800000.00, 'up', 1.42),
(12, 5, 2025, 5, '[90, 95, 100, 105, 110, 115, 120, 125]', 93900000.00, 'up', 1.19),
(13, 5, 2025, 6, '[90, 95, 100, 105, 110, 115, 120, 125]', 94500000.00, 'up', 0.64),
(14, 5, 2025, 7, '[90, 95, 100, 105, 110, 115, 120, 125]', 95000000.00, 'up', 0.53),
(15, 4, 2025, 1, '[70, 75, 80, 85, 90, 95, 100, 105]', 74000000.00, 'up', 10.20),
(16, 4, 2025, 2, '[70, 75, 80, 85, 90, 95, 100, 105]', 75200000.00, 'up', 1.62),
(17, 4, 2025, 3, '[70, 75, 80, 85, 90, 95, 100, 105]', 76100000.00, 'up', 1.20),
(18, 4, 2025, 4, '[70, 75, 80, 85, 90, 95, 100, 105]', 76800000.00, 'up', 0.92),
(19, 4, 2025, 5, '[70, 75, 80, 85, 90, 95, 100, 105]', 77400000.00, 'up', 0.78),
(20, 4, 2025, 6, '[70, 75, 80, 85, 90, 95, 100, 105]', 77700000.00, 'up', 0.39),
(21, 4, 2025, 7, '[70, 75, 80, 85, 90, 95, 100, 105]', 78000000.00, 'up', 0.39),
(22, 3, 2025, 1, '[80, 85, 90, 95, 100, 105, 110, 115]', 62000000.00, 'up', 15.20),
(23, 3, 2025, 2, '[80, 85, 90, 95, 100, 105, 110, 115]', 63500000.00, 'up', 2.42),
(24, 3, 2025, 3, '[80, 85, 90, 95, 100, 105, 110, 115]', 64800000.00, 'up', 2.05),
(25, 3, 2025, 4, '[80, 85, 90, 95, 100, 105, 110, 115]', 65900000.00, 'up', 1.70),
(26, 3, 2025, 5, '[80, 85, 90, 95, 100, 105, 110, 115]', 66500000.00, 'up', 0.91),
(27, 3, 2025, 6, '[80, 85, 90, 95, 100, 105, 110, 115]', 66800000.00, 'up', 0.45),
(28, 3, 2025, 7, '[80, 85, 90, 95, 100, 105, 110, 115]', 67000000.00, 'up', 0.30),
(29, 2, 2025, 1, '[60, 65, 70, 75, 80, 85, 90, 95]', 84000000.00, 'up', 8.70),
(30, 2, 2025, 2, '[60, 65, 70, 75, 80, 85, 90, 95]', 85200000.00, 'up', 1.43),
(31, 2, 2025, 3, '[60, 65, 70, 75, 80, 85, 90, 95]', 86100000.00, 'up', 1.06),
(32, 2, 2025, 4, '[60, 65, 70, 75, 80, 85, 90, 95]', 87000000.00, 'up', 1.05),
(33, 2, 2025, 5, '[60, 65, 70, 75, 80, 85, 90, 95]', 87800000.00, 'up', 0.92),
(34, 2, 2025, 6, '[60, 65, 70, 75, 80, 85, 90, 95]', 88400000.00, 'up', 0.68),
(35, 2, 2025, 7, '[60, 65, 70, 75, 80, 85, 90, 95]', 89000000.00, 'up', 0.68),
(36, 1, 2023, 7, '[90, 110, 105, 120, 115, 130, 125, 140]', 110000000.00, 'up', 5.20),
(37, 2, 2023, 7, '[50, 55, 60, 65, 70, 75, 80, 85]', 75000000.00, 'up', 5.20),
(38, 3, 2023, 7, '[70, 75, 80, 85, 90, 95, 100, 105]', 58000000.00, 'up', 5.20),
(39, 4, 2023, 7, '[60, 65, 70, 75, 80, 85, 90, 95]', 68000000.00, 'up', 5.20),
(40, 5, 2023, 7, '[80, 85, 90, 95, 100, 105, 110, 115]', 82000000.00, 'up', 5.20),
(43, 1, 2024, 7, '[95, 115, 110, 125, 120, 135, 130, 145]', 115000000.00, 'up', 8.50),
(44, 2, 2024, 7, '[55, 60, 65, 70, 75, 80, 85, 90]', 82000000.00, 'up', 8.50),
(45, 3, 2024, 7, '[75, 80, 85, 90, 95, 100, 105, 110]', 62000000.00, 'up', 8.50),
(46, 4, 2024, 7, '[65, 70, 75, 80, 85, 90, 95, 100]', 72000000.00, 'up', 8.50),
(47, 5, 2024, 7, '[85, 90, 95, 100, 105, 110, 115, 120]', 88000000.00, 'up', 8.50);

-- --------------------------------------------------------

--
-- Struktur dari tabel `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `color_code` varchar(7) DEFAULT '#0d47a1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `departments`
--

INSERT INTO `departments` (`id`, `name`, `color_code`) VALUES
(1, 'Logistik', '#1976d2'),
(2, 'Retail Ops', '#43a047'),
(3, 'HR', '#fbc02d'),
(4, 'IT', '#7e57c2'),
(5, 'Lainnya', '#757575');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `department_insights`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `department_insights` (
`id` int(11)
,`name` varchar(255)
,`color_code` varchar(7)
,`total_pengeluaran` varchar(50)
,`rata_bulanan` varchar(52)
,`pengeluaran_terbesar` mediumtext
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `reference` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` text NOT NULL,
  `jumlah` decimal(15,2) NOT NULL,
  `status` enum('Done','Ongoing') DEFAULT 'Ongoing',
  `category_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `expenses`
--

INSERT INTO `expenses` (`id`, `reference`, `tanggal`, `deskripsi`, `jumlah`, `status`, `category_id`, `department_id`, `created_at`) VALUES
(1, 'SUP-001', '2025-06-01', 'Pembelian Kertas', 1200000.00, 'Done', 1, 1, '2025-07-08 10:31:17'),
(2, 'SUP-002', '2025-06-05', 'Pembelian ATK', 800000.00, 'Ongoing', 1, 1, '2025-07-08 10:31:17'),
(3, 'SUP-003', '2025-06-10', 'Pembelian Printer', 2200000.00, 'Done', 1, 1, '2025-07-08 10:31:17'),
(4, 'UTL-001', '2025-06-02', 'Bayar Listrik', 1500000.00, 'Done', 2, 2, '2025-07-08 10:31:17'),
(5, 'UTL-002', '2025-06-12', 'Bayar Air', 700000.00, 'Ongoing', 2, 2, '2025-07-08 10:31:17'),
(6, 'TRN-001', '2025-06-03', 'Bensin', 500000.00, 'Done', 3, 1, '2025-07-08 10:31:17'),
(7, 'TRN-002', '2025-06-15', 'Taksi', 300000.00, 'Ongoing', 3, 1, '2025-07-08 10:31:17'),
(8, 'EMP-001', '2025-06-04', 'Bonus Karyawan', 5000000.00, 'Done', 4, 3, '2025-07-08 10:31:17'),
(9, 'EMP-002', '2025-06-20', 'Gaji', 90000000.00, 'Done', 4, 3, '2025-07-08 10:31:17'),
(10, 'TEC-001', '2025-06-06', 'Pembelian Laptop', 12000000.00, 'Done', 5, 4, '2025-07-08 10:31:17'),
(11, 'TEC-002', '2025-06-18', 'Upgrade Server', 8000000.00, 'Ongoing', 5, 4, '2025-07-08 10:31:17'),
(12, 'MKT-001', '2025-06-07', 'Iklan Facebook', 2000000.00, 'Done', 6, 5, '2025-07-08 10:31:17'),
(13, 'MKT-002', '2025-06-21', 'Iklan Instagram', 1700000.00, 'Ongoing', 6, 5, '2025-07-08 10:31:17'),
(14, 'JAN-001', '2025-01-05', 'Pembelian Perlengkapan Kantor', 1500000.00, 'Done', 1, 1, '2025-07-08 10:33:13'),
(15, 'JAN-002', '2025-01-10', 'Bayar Listrik Bulanan', 1200000.00, 'Done', 2, 2, '2025-07-08 10:33:13'),
(16, 'JAN-003', '2025-01-15', 'Bensin Operasional', 500000.00, 'Done', 3, 1, '2025-07-08 10:33:13'),
(17, 'JAN-004', '2025-01-20', 'Gaji Karyawan', 25000000.00, 'Done', 4, 3, '2025-07-08 10:33:13'),
(18, 'JAN-005', '2025-01-25', 'Pembelian Software', 3500000.00, 'Done', 5, 4, '2025-07-08 10:33:13'),
(19, 'JAN-006', '2025-01-28', 'Iklan Google Ads', 1800000.00, 'Done', 6, 5, '2025-07-08 10:33:13'),
(20, 'FEB-001', '2025-02-05', 'Pembelian Bahan Baku', 2000000.00, 'Done', 1, 1, '2025-07-08 10:33:13'),
(21, 'FEB-002', '2025-02-10', 'Bayar Air', 800000.00, 'Done', 2, 2, '2025-07-08 10:33:13'),
(22, 'FEB-003', '2025-02-15', 'Taksi Meeting', 400000.00, 'Done', 3, 1, '2025-07-08 10:33:13'),
(23, 'FEB-004', '2025-02-20', 'Bonus Kinerja', 5000000.00, 'Done', 4, 3, '2025-07-08 10:33:13'),
(24, 'FEB-005', '2025-02-25', 'Maintenance Server', 2200000.00, 'Done', 5, 4, '2025-07-08 10:33:13'),
(25, 'FEB-006', '2025-02-28', 'Iklan Facebook', 2100000.00, 'Done', 6, 5, '2025-07-08 10:33:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `expense_insights`
--

CREATE TABLE `expense_insights` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `insight` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `expense_insights`
--

INSERT INTO `expense_insights` (`id`, `category_id`, `insight`, `created_at`, `department_id`) VALUES
(3, NULL, 'Departemen Logistik menghabiskan Rp9,400,000.00 pada Q3 2025. Pengeluaran di atas rata-rata perusahaan. | Tren: Turun dari bulan sebelumnya', '2025-07-16 04:55:03', 1),
(4, NULL, 'Departemen Retail Ops menghabiskan Rp4,200,000.00 pada Q3 2025. Pengeluaran di bawah rata-rata perusahaan. | Tren: Turun dari bulan sebelumnya', '2025-07-16 04:55:03', 2),
(5, NULL, 'Departemen HR menghabiskan Rp125,000,000.00 pada Q3 2025. Pengeluaran di atas rata-rata perusahaan. | Tren: Turun dari bulan sebelumnya', '2025-07-16 04:55:03', 3),
(6, NULL, 'Departemen IT menghabiskan Rp25,700,000.00 pada Q3 2025. Pengeluaran di atas rata-rata perusahaan. | Tren: Turun dari bulan sebelumnya', '2025-07-16 04:55:03', 4),
(7, NULL, 'Departemen Lainnya menghabiskan Rp7,600,000.00 pada Q3 2025. Pengeluaran di atas rata-rata perusahaan. | Tren: Turun dari bulan sebelumnya', '2025-07-16 04:55:03', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `expense_stats`
--

CREATE TABLE `expense_stats` (
  `id` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` tinyint(4) NOT NULL,
  `total_pengeluaran` decimal(15,2) NOT NULL,
  `top_category_id` int(11) NOT NULL,
  `top_expense` varchar(255) NOT NULL,
  `avg_monthly` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `peran` varchar(50) NOT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `poin_total` decimal(5,2) DEFAULT 0.00,
  `is_manager` tinyint(1) DEFAULT 0,
  `laporan_langsung` int(11) DEFAULT NULL,
  `deskripsi_peran` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `id_toko`, `nama`, `peran`, `telepon`, `email`, `foto_profil`, `poin_total`, `is_manager`, `laporan_langsung`, `deskripsi_peran`) VALUES
(1, 1, 'Andi Saputra', 'Sales Associate', '0811111111', 'agus1@email.com', 'avator1.jpg', 94.50, 0, NULL, NULL),
(2, 1, 'Budi Hartono', 'Cashier', '0811111112', 'budi2@email.com', 'avatar-03.jpg', 88.20, 0, NULL, NULL),
(3, 1, 'Citra Dewi', 'Store Manager', '0811111113', 'citra3@email.com', '1.jpg', 92.70, 0, NULL, NULL),
(4, 1, 'Dian Kusuma', 'Warehouse Staff', '0811111114', 'dina4@email.com', 'avatar-13.jpg', 85.40, 0, NULL, NULL),
(5, 1, 'Eko Prasetyo', 'Customer Service', '0811111115', 'eko5@email.com', 'avatar-17.jpg', 89.10, 0, NULL, NULL),
(6, 1, 'Fitriani', 'Sales Associate', '0811111116', 'fitri6@email.com', 'avatar04.jpg', 87.60, 0, NULL, NULL),
(7, 1, 'Gunawan', 'IT Support', '0811111117', 'gani7@email.com', 'gunawan.jpg', 82.30, 0, NULL, NULL),
(8, 1, 'Hana Susanti', 'HR Staff', '0811111118', 'hani8@email.com', 'hana.jpg', 90.80, 0, NULL, NULL),
(9, 1, 'Ivan Setiawan', 'Security', '0811111119', 'irwan9@email.com', 'ivan.jpg', 79.50, 0, NULL, NULL),
(10, 1, 'Joko Widodo', 'Logistics', '0811111120', 'joni10@email.com', 'joko.jpg', 84.90, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kinerja_karyawan`
--

CREATE TABLE `kinerja_karyawan` (
  `id_kinerja` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `periode` date NOT NULL,
  `kehadiran` decimal(5,2) NOT NULL,
  `pelayanan` decimal(5,2) NOT NULL,
  `tugas` decimal(5,2) NOT NULL,
  `perubahan` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kinerja_karyawan`
--

INSERT INTO `kinerja_karyawan` (`id_kinerja`, `id_karyawan`, `periode`, `kehadiran`, `pelayanan`, `tugas`, `perubahan`) VALUES
(1, 1, '2025-05-01', 80.00, 99.00, 97.00, 0.14),
(2, 1, '2025-06-01', 98.00, 74.00, 98.00, -1.60),
(3, 1, '2025-07-01', 82.00, 70.00, 95.00, 2.16),
(4, 2, '2025-05-01', 84.00, 83.00, 87.00, -1.59),
(5, 2, '2025-06-01', 87.00, 81.00, 95.00, 1.67),
(6, 2, '2025-07-01', 95.00, 79.00, 83.00, 0.72),
(7, 3, '2025-05-01', 84.00, 79.00, 94.00, -2.37),
(8, 3, '2025-06-01', 95.00, 91.00, 83.00, 0.41),
(9, 3, '2025-07-01', 97.00, 85.00, 75.00, 0.10),
(10, 4, '2025-05-01', 91.00, 77.00, 88.00, -2.33);

-- --------------------------------------------------------

--
-- Struktur dari tabel `komunikasi_supplier`
--

CREATE TABLE `komunikasi_supplier` (
  `id_komunikasi` int(11) NOT NULL,
  `ID_Supplier` int(11) NOT NULL,
  `jenis` enum('call','email','update') NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `komunikasi_supplier`
--

INSERT INTO `komunikasi_supplier` (`id_komunikasi`, `ID_Supplier`, `jenis`, `judul`, `deskripsi`, `waktu`) VALUES
(1, 1, 'call', 'Call with PT Mebel Jati', 'Called about delivery schedule for order #1234', '2025-07-14 21:34:09'),
(2, 1, 'email', 'Email to CV Cahaya Lampu', 'Sent quotation for LED lighting project', '2025-07-14 21:34:09'),
(3, 2, 'update', 'Status update', 'Payment received from Textile Nusantara', '2025-07-14 21:34:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `manager`
--

CREATE TABLE `manager` (
  `id_manager` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `kode_manager` varchar(20) DEFAULT NULL,
  `level_otoritas` enum('Regional','Cabang','Departemen') DEFAULT 'Cabang',
  `tanggal_promosi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `manager`
--

INSERT INTO `manager` (`id_manager`, `id_karyawan`, `kode_manager`, `level_otoritas`, `tanggal_promosi`) VALUES
(1, 3, 'MGR001', 'Cabang', '2025-01-15'),
(2, 8, 'MGR002', 'Regional', '2024-11-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `monthly_profit_trend`
--

CREATE TABLE `monthly_profit_trend` (
  `id` int(11) NOT NULL,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `average_profit` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `monthly_profit_trend`
--

INSERT INTO `monthly_profit_trend` (`id`, `year`, `month`, `average_profit`) VALUES
(1, 2025, 1, 1.20),
(2, 2025, 2, 1.80),
(3, 2025, 3, 2.10),
(4, 2025, 4, 1.50),
(5, 2025, 5, 2.30),
(6, 2025, 6, 1.70),
(7, 2025, 7, 1.90);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_code` varchar(20) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `unit_price` decimal(12,2) NOT NULL,
  `stock_quantity` int(11) DEFAULT 0,
  `min_stock_level` int(11) DEFAULT 10,
  `status` enum('Active','Inactive','Discontinued') DEFAULT 'Active',
  `rating` decimal(2,1) DEFAULT 0.0,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `product_code`, `product_name`, `category_id`, `brand_id`, `brand`, `unit_price`, `stock_quantity`, `min_stock_level`, `status`, `rating`, `description`, `created_at`, `updated_at`) VALUES
(1, 'MEJA001', 'Meja LACK', 1, NULL, 'IKEA', 675000.00, 120, 10, 'Active', 4.2, 'Meja serbaguna untuk ruang kerja dan ruang makan', '2025-07-16 10:02:19', '2025-07-16 10:02:19'),
(2, 'KURSI001', 'Kursi ADDE', 1, NULL, 'IKEA', 525000.00, 85, 10, 'Active', 4.1, 'Kursi ergonomis untuk kenyamanan maksimal', '2025-07-16 10:02:19', '2025-07-16 10:02:19'),
(3, 'SOFA001', 'Sofa EKTORP', 1, NULL, 'IKEA', 37500000.00, 45, 10, 'Active', 4.6, 'Sofa nyaman untuk ruang keluarga', '2025-07-16 10:02:19', '2025-07-16 10:02:19'),
(4, 'LEMARI001', 'Lemari PAX', 1, NULL, 'IKEA', 27000000.00, 30, 10, 'Active', 4.3, 'Lemari penyimpanan dengan desain modern', '2025-07-16 10:02:19', '2025-07-16 10:02:19'),
(5, 'TV001', 'Smart TV 55\"', 2, NULL, 'Samsung', 127500000.00, 25, 10, 'Active', 4.4, 'Smart TV dengan teknologi terdepan', '2025-07-16 10:02:19', '2025-07-16 10:02:19'),
(6, 'AC001', 'AC Split 1PK', 2, NULL, 'LG', 48000000.00, 20, 10, 'Active', 4.2, 'Air conditioner hemat energi', '2025-07-16 10:02:19', '2025-07-16 10:02:19'),
(7, 'KIPAS001', 'Kipas Angin', 2, NULL, 'Panasonic', 675000.00, 60, 10, 'Active', 3.9, 'Kipas angin dengan teknologi silent', '2025-07-16 10:02:19', '2025-07-16 10:02:19'),
(8, 'LAMPU001', 'Lampu LERSTA', 4, NULL, 'IKEA', 337500.00, 80, 10, 'Active', 3.8, 'Lampu dengan desain minimalis dan modern', '2025-07-16 10:02:19', '2025-07-16 10:02:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_activities`
--

CREATE TABLE `product_activities` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `activity_type` enum('restock','price_change','promotion','launch','discontinued') NOT NULL,
  `activity_description` varchar(255) NOT NULL,
  `old_value` varchar(100) DEFAULT NULL,
  `new_value` varchar(100) DEFAULT NULL,
  `activity_date` date NOT NULL,
  `status` enum('completed','active','ongoing','launched') DEFAULT 'completed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product_activities`
--

INSERT INTO `product_activities` (`id`, `product_id`, `activity_type`, `activity_description`, `old_value`, `new_value`, `activity_date`, `status`, `created_at`) VALUES
(1, 3, 'restock', 'Restok Sofa EKTORP', '20', '45', '2025-06-30', 'completed', '2025-07-16 10:02:54'),
(2, 1, 'price_change', 'Harga Meja LACK dinaikkan', 'Rp675.000', 'Rp708.750', '2025-06-29', 'active', '2025-07-16 10:02:54'),
(3, 1, 'promotion', 'Diskon 15% Meja LACK', 'Rp675.000', 'Rp573.750', '2025-06-28', 'ongoing', '2025-07-16 10:02:54'),
(4, 2, 'promotion', 'Promo Kursi ADDE diterapkan', NULL, '20% OFF', '2025-06-27', 'launched', '2025-07-16 10:02:54'),
(5, 3, 'promotion', 'Diskon 20% untuk Sofa EKTORP', NULL, '20% OFF', '2025-01-15', 'active', '2025-07-16 10:02:54'),
(6, 8, 'price_change', 'Penyesuaian harga Lampu LERSTA', 'Rp337.500', 'Rp354.375', '2025-01-12', 'completed', '2025-07-16 10:02:54'),
(7, 8, 'promotion', 'Bundle promo Lampu + Furniture', NULL, 'Bundle 15% OFF', '2025-01-18', 'ongoing', '2025-07-16 10:02:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_sales`
--

CREATE TABLE `product_sales` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `sales_date` date NOT NULL,
  `furniture_sales` bigint(20) NOT NULL DEFAULT 0,
  `electronics_sales` bigint(20) NOT NULL DEFAULT 0,
  `decor_sales` bigint(20) NOT NULL DEFAULT 0,
  `lighting_sales` bigint(20) NOT NULL DEFAULT 0,
  `brand_sales_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`brand_sales_data`)),
  `total_sales` bigint(20) GENERATED ALWAYS AS (`furniture_sales` + `electronics_sales` + `decor_sales` + `lighting_sales`) STORED,
  `month` tinyint(4) NOT NULL,
  `year` year(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product_sales`
--

INSERT INTO `product_sales` (`id`, `store_id`, `sales_date`, `furniture_sales`, `electronics_sales`, `decor_sales`, `lighting_sales`, `brand_sales_data`, `month`, `year`, `created_at`) VALUES
(1, 1, '2023-01-01', 54000, 36000, 20250, 15750, NULL, 1, '2023', '2025-07-16 10:02:40'),
(2, 1, '2023-02-01', 60750, 40500, 22500, 18000, NULL, 2, '2023', '2025-07-16 10:02:40'),
(3, 1, '2023-03-01', 67500, 42750, 24750, 20250, NULL, 3, '2023', '2025-07-16 10:02:40'),
(4, 1, '2023-04-01', 63000, 38250, 21600, 17100, NULL, 4, '2023', '2025-07-16 10:02:40'),
(5, 1, '2023-05-01', 72000, 45000, 27000, 22500, NULL, 5, '2023', '2025-07-16 10:02:40'),
(6, 1, '2023-06-01', 65250, 39600, 23400, 18900, NULL, 6, '2023', '2025-07-16 10:02:40'),
(7, 1, '2023-07-01', 69750, 41400, 26100, 21600, NULL, 7, '2023', '2025-07-16 10:02:40'),
(8, 1, '2023-08-01', 76500, 47250, 29250, 24750, NULL, 8, '2023', '2025-07-16 10:02:40'),
(9, 1, '2023-09-01', 74250, 44100, 27900, 23400, NULL, 9, '2023', '2025-07-16 10:02:40'),
(10, 1, '2023-10-01', 81000, 49500, 31500, 27000, NULL, 10, '2023', '2025-07-16 10:02:40'),
(11, 1, '2023-11-01', 78750, 48600, 30600, 26100, NULL, 11, '2023', '2025-07-16 10:02:40'),
(12, 1, '2023-12-01', 85500, 51750, 33750, 29250, NULL, 12, '2023', '2025-07-16 10:02:40'),
(13, 1, '2024-01-01', 90000, 54000, 36000, 31500, NULL, 1, '2024', '2025-07-16 10:02:40'),
(14, 1, '2024-02-01', 96750, 58500, 38250, 33750, NULL, 2, '2024', '2025-07-16 10:02:40'),
(15, 1, '2024-03-01', 103500, 63000, 40500, 36000, NULL, 3, '2024', '2025-07-16 10:02:40'),
(16, 1, '2024-04-01', 99000, 60750, 39600, 35100, NULL, 4, '2024', '2025-07-16 10:02:40'),
(17, 1, '2024-05-01', 108000, 67500, 42750, 38250, NULL, 5, '2024', '2025-07-16 10:02:40'),
(18, 1, '2024-06-01', 101250, 62100, 41400, 36900, NULL, 6, '2024', '2025-07-16 10:02:40'),
(19, 1, '2024-07-01', 105750, 65250, 44100, 39600, NULL, 7, '2024', '2025-07-16 10:02:40'),
(20, 1, '2024-08-01', 112500, 72000, 47250, 42750, NULL, 8, '2024', '2025-07-16 10:02:40'),
(21, 1, '2024-09-01', 110250, 69750, 45900, 41400, NULL, 9, '2024', '2025-07-16 10:02:40'),
(22, 1, '2024-10-01', 117000, 76500, 49500, 45000, NULL, 10, '2024', '2025-07-16 10:02:40'),
(23, 1, '2024-11-01', 114750, 74250, 48600, 44100, NULL, 11, '2024', '2025-07-16 10:02:40'),
(24, 1, '2024-12-01', 121500, 81000, 51750, 47250, NULL, 12, '2024', '2025-07-16 10:02:40'),
(25, 1, '2025-01-01', 126000, 85500, 54000, 49500, NULL, 1, '2025', '2025-07-16 10:02:40'),
(26, 1, '2025-02-01', 132750, 90000, 56250, 51750, NULL, 2, '2025', '2025-07-16 10:02:40'),
(27, 1, '2025-03-01', 139500, 94500, 58500, 54000, NULL, 3, '2025', '2025-07-16 10:02:40'),
(28, 1, '2025-04-01', 135000, 92250, 57600, 53100, NULL, 4, '2025', '2025-07-16 10:02:40'),
(29, 1, '2025-05-01', 144000, 99000, 60750, 56250, NULL, 5, '2025', '2025-07-16 10:02:40'),
(30, 1, '2025-06-01', 137250, 96750, 59400, 54900, NULL, 6, '2025', '2025-07-16 10:02:40'),
(31, 1, '2025-07-01', 141750, 101250, 62100, 57600, NULL, 7, '2025', '2025-07-16 10:02:40'),
(32, 1, '2025-08-01', 148500, 108000, 65250, 60750, NULL, 8, '2025', '2025-07-16 10:02:40'),
(33, 1, '2025-09-01', 146250, 105750, 63900, 59400, NULL, 9, '2025', '2025-07-16 10:02:40'),
(34, 1, '2025-10-01', 153000, 112500, 67500, 63000, NULL, 10, '2025', '2025-07-16 10:02:40'),
(35, 1, '2025-11-01', 150750, 110250, 66600, 62100, NULL, 11, '2025', '2025-07-16 10:02:40'),
(36, 1, '2025-12-01', 157500, 117000, 69750, 65250, NULL, 12, '2025', '2025-07-16 10:02:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `revenue`
--

CREATE TABLE `revenue` (
  `id` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `periode` date NOT NULL,
  `pendapatan` decimal(15,2) NOT NULL,
  `profit` decimal(5,2) NOT NULL COMMENT 'dalam persentase',
  `target` decimal(5,2) NOT NULL COMMENT 'dalam persentase'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `revenue`
--

INSERT INTO `revenue` (`id`, `id_toko`, `periode`, `pendapatan`, `profit`, `target`) VALUES
(1, 1, '2025-07-01', 15500000.00, 1.50, 92.00),
(2, 2, '2025-07-01', 18200000.00, 3.50, 95.00),
(3, 3, '2025-07-01', 14800000.00, 1.50, 88.00),
(4, 4, '2025-07-01', 12300000.00, -0.20, 85.00),
(5, 5, '2025-07-01', 16700000.00, 1.50, 90.00),
(6, 6, '2025-07-01', 17100000.00, 2.00, 93.00),
(7, 7, '2025-07-01', 11200000.00, -1.00, 75.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `revenue_growth`
--

CREATE TABLE `revenue_growth` (
  `id` int(11) NOT NULL,
  `periode` date NOT NULL,
  `growth_amount` decimal(15,2) NOT NULL,
  `growth_percentage` decimal(5,2) NOT NULL,
  `compared_to_periode` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `revenue_growth`
--

INSERT INTO `revenue_growth` (`id`, `periode`, `growth_amount`, `growth_percentage`, `compared_to_periode`) VALUES
(1, '2025-07-01', 111589.00, 1.70, '2025-06-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `store_performance_metrics`
--

CREATE TABLE `store_performance_metrics` (
  `id` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `periode` date NOT NULL,
  `achievement_percentage` decimal(5,2) NOT NULL,
  `is_top_performer` tinyint(1) DEFAULT 0,
  `rank` int(11) DEFAULT NULL,
  `performance_score` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `store_performance_metrics`
--

INSERT INTO `store_performance_metrics` (`id`, `id_toko`, `periode`, `achievement_percentage`, `is_top_performer`, `rank`, `performance_score`) VALUES
(1, 1, '2025-07-01', 92.00, 0, 3, 85.50),
(2, 2, '2025-07-01', 95.00, 1, 1, 92.80),
(3, 3, '2025-07-01', 88.00, 0, 5, 82.30),
(4, 4, '2025-07-01', 85.00, 0, 7, 78.10),
(5, 5, '2025-07-01', 90.00, 1, 4, 88.20),
(6, 6, '2025-07-01', 93.00, 1, 2, 90.50),
(7, 7, '2025-07-01', 75.00, 0, 6, 70.80);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `ID_Supplier` int(11) NOT NULL,
  `Nama_Supplier` varchar(100) NOT NULL,
  `kode_supplier` varchar(20) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `negara` varchar(50) DEFAULT NULL,
  `status_aktif` tinyint(1) DEFAULT 1,
  `tanggal_registrasi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`ID_Supplier`, `Nama_Supplier`, `kode_supplier`, `telepon`, `email`, `negara`, `status_aktif`, `tanggal_registrasi`) VALUES
(1, 'Apex Computers', '201', '+12163547758', 'info@apex.com', 'China', 1, '2025-01-15'),
(2, 'Modern Automobile', '202', '123-456-888', 'sales@modernauto.com', 'USA', 1, '2025-02-10'),
(3, 'Best Power Tools', '555', '123-456-888', 'support@besttools.com', 'Thailand', 1, '2025-03-22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier_analytics`
--

CREATE TABLE `supplier_analytics` (
  `id` int(11) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `total_procurement_value` decimal(15,2) DEFAULT 0.00,
  `active_suppliers` int(11) DEFAULT 0,
  `new_suppliers` int(11) DEFAULT 0,
  `avg_sustainability_score` decimal(3,1) DEFAULT 0.0,
  `avg_delivery_time` decimal(5,2) DEFAULT 0.00,
  `cost_savings` decimal(15,2) DEFAULT 0.00,
  `top_performing_supplier_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier_categories`
--

CREATE TABLE `supplier_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier_certifications`
--

CREATE TABLE `supplier_certifications` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `certification_name` varchar(100) NOT NULL,
  `certification_body` varchar(100) DEFAULT NULL,
  `issue_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `status` enum('Valid','Expired','Suspended','Revoked') DEFAULT 'Valid',
  `certificate_file` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier_contracts`
--

CREATE TABLE `supplier_contracts` (
  `id` int(11) NOT NULL,
  `contract_code` varchar(20) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `contract_type` enum('Annual','Project','Framework','Spot') DEFAULT 'Annual',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `contract_value` decimal(15,2) DEFAULT 0.00,
  `payment_terms` varchar(100) DEFAULT NULL,
  `delivery_terms` varchar(100) DEFAULT NULL,
  `status` enum('Draft','Active','Expired','Terminated','Renewed') DEFAULT 'Draft',
  `created_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier_orders`
--

CREATE TABLE `supplier_orders` (
  `id` int(11) NOT NULL,
  `order_code` varchar(20) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `expected_delivery` date DEFAULT NULL,
  `actual_delivery` date DEFAULT NULL,
  `total_amount` decimal(15,2) DEFAULT 0.00,
  `paid_amount` decimal(15,2) DEFAULT 0.00,
  `status` enum('Draft','Sent','Confirmed','Processing','Shipped','Delivered','Cancelled') DEFAULT 'Draft',
  `payment_status` enum('Unpaid','Partial','Paid','Overdue') DEFAULT 'Unpaid',
  `priority` enum('Low','Medium','High','Urgent') DEFAULT 'Medium',
  `notes` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `received_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier_order_items`
--

CREATE TABLE `supplier_order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity_ordered` int(11) NOT NULL,
  `quantity_delivered` int(11) DEFAULT 0,
  `unit_price` decimal(12,2) NOT NULL,
  `total_price` decimal(15,2) GENERATED ALWAYS AS (`quantity_ordered` * `unit_price`) STORED,
  `delivery_status` enum('Pending','Partial','Complete','Cancelled') DEFAULT 'Pending',
  `quality_check` enum('Pending','Passed','Failed','N/A') DEFAULT 'Pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier_performance`
--

CREATE TABLE `supplier_performance` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `evaluation_period` varchar(20) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `total_orders` int(11) DEFAULT 0,
  `total_value` decimal(15,2) DEFAULT 0.00,
  `on_time_delivery_rate` decimal(5,2) DEFAULT 0.00,
  `quality_score` decimal(3,1) DEFAULT 0.0,
  `cost_competitiveness` decimal(3,1) DEFAULT 0.0,
  `sustainability_score` decimal(3,1) DEFAULT 0.0,
  `overall_rating` decimal(3,1) DEFAULT 0.0,
  `payment_terms_compliance` decimal(5,2) DEFAULT 0.00,
  `communication_rating` decimal(3,1) DEFAULT 0.0,
  `innovation_score` decimal(3,1) DEFAULT 0.0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier_returns`
--

CREATE TABLE `supplier_returns` (
  `id` int(11) NOT NULL,
  `return_code` varchar(20) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `return_date` datetime NOT NULL DEFAULT current_timestamp(),
  `purchase_order_number` varchar(50) DEFAULT NULL,
  `total_amount` decimal(15,2) DEFAULT 0.00,
  `refund_amount` decimal(15,2) DEFAULT 0.00,
  `status` enum('Pending','Processing','Approved','Rejected','Completed','Cancelled') DEFAULT 'Pending',
  `return_type` enum('Defective','Overstock','Damaged','Wrong Item','Quality Issue') DEFAULT 'Defective',
  `priority` enum('Low','Medium','High','Urgent') DEFAULT 'Medium',
  `notes` text DEFAULT NULL,
  `processed_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier_return_analytics`
--

CREATE TABLE `supplier_return_analytics` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `total_returns` int(11) DEFAULT 0,
  `total_return_value` decimal(15,2) DEFAULT 0.00,
  `total_refunds` decimal(15,2) DEFAULT 0.00,
  `return_rate` decimal(5,2) DEFAULT 0.00,
  `avg_processing_time` decimal(5,2) DEFAULT 0.00,
  `quality_score` decimal(3,1) DEFAULT 0.0,
  `top_return_reason_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier_return_items`
--

CREATE TABLE `supplier_return_items` (
  `id` int(11) NOT NULL,
  `return_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `reason_id` int(11) NOT NULL,
  `quantity_returned` int(11) NOT NULL,
  `unit_price` decimal(12,2) NOT NULL,
  `total_price` decimal(15,2) GENERATED ALWAYS AS (`quantity_returned` * `unit_price`) STORED,
  `condition_assessment` enum('New','Good','Fair','Poor','Damaged') DEFAULT 'Good',
  `can_restock` tinyint(1) DEFAULT 1,
  `restocking_fee` decimal(10,2) DEFAULT 0.00,
  `item_notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier_return_reasons`
--

CREATE TABLE `supplier_return_reasons` (
  `id` int(11) NOT NULL,
  `reason_code` varchar(10) NOT NULL,
  `reason_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier_return_tracking`
--

CREATE TABLE `supplier_return_tracking` (
  `id` int(11) NOT NULL,
  `return_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `nama_toko` varchar(100) NOT NULL,
  `kode_toko` varchar(20) DEFAULT NULL,
  `alamat` text NOT NULL,
  `provinsi` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `telepon` varchar(20) NOT NULL,
  `land_area` varchar(20) DEFAULT NULL,
  `tahun_berdiri` year(4) DEFAULT NULL,
  `status_toko` enum('Open','InProgress') DEFAULT 'Open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `kode_toko`, `alamat`, `provinsi`, `kota`, `telepon`, `land_area`, `tahun_berdiri`, `status_toko`, `created_at`, `status`, `latitude`, `longitude`) VALUES
(1, 'IKEA Alam Sutera', 'STR001', 'Jl. Alam Sutera Boulevard No. 45, Tangerang', 'Banten', 'Tangerang', '(021) 12345678', '35.000 m²', '2014', 'Open', '2025-07-16 16:03:59', 'active', -6.22410000, 106.65830000),
(2, 'IKEA Bali', 'STR006', 'Jl. Raya Kuta No. 88, Kuta', 'Bali', 'Badung', '(0361) 87654321', '22.000 m²', '2025', 'Open', '2025-07-17 01:18:09', 'active', -8.70750000, 115.17200000),
(3, 'IKEA Sentul City', 'STR002', 'Jl. Sentul Raya Blok A-10, Bogor', 'Jawa Barat', 'Bogor', '(021) 55556666', '36.000 m²', '2021', 'Open', '2025-07-16 16:02:55', 'active', -6.56220000, 106.84600000),
(4, 'IKEA Kota Baru Parahyangan', 'STR003', 'Jl. Parahyangan Raya No. 15, Bandung', 'Jawa Barat', 'Bandung Barat', '(022) 33445566', '33.000 m²', '2021', 'Open', '2025-07-16 16:03:09', 'active', -6.85120000, 107.53280000),
(5, 'IKEA Surabaya', 'STR005', 'Jl. Raya Darmo No. 25, Surabaya', 'Jawa Timur', 'Surabaya', '(031) 11223344', '27465 m²', '2012', 'Open', '2025-07-16 16:03:30', 'active', -7.25750000, 112.75210000),
(6, 'IKEA Jakarta Garden City', 'STR004', 'Jl. Boulevard Raya Blok B-20, Jakarta', 'DKI Jakarta', 'Jakarta Timur', '(021) 77778888', '39.000 m²', '2021', 'Open', '2025-07-16 16:03:51', 'active', -6.17750000, 106.94230000),
(7, 'IKEA Mal Taman Anggrek', 'STR007', 'Jl. Letjen S. Parman Kav. 21, Jakarta', 'DKI Jakarta', 'Jakarta Barat', '(021) 99991111', '30349 m²', '2013', 'Open', '2025-07-17 01:18:09', 'active', -6.17539200, 106.79221300);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugas_manager`
--

CREATE TABLE `tugas_manager` (
  `id_tugas` int(11) NOT NULL,
  `id_manager` int(11) NOT NULL,
  `judul_tugas` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `status` enum('Pending','In Progress','Completed','On Hold') DEFAULT 'Pending',
  `tenggat_waktu` date DEFAULT NULL,
  `prioritas` enum('Low','Medium','High','Critical') DEFAULT 'Medium',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT 'default.jpg',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `profile_picture`, `created_at`, `last_login`) VALUES
(1, 'reza', 'reza123@gmail.com', '$2y$10$t.HF3tuhKJdMS05NOwJvZemBzUvREc5wFyoTfypp3bjb77z3o2KRm', '1.jpg', '2025-07-04 07:17:09', NULL),
(2, 'sulthan', 'sul12@gmail.com', '$2y$10$hmDEEDAv1ocnNBLo8QtRW.NjlSlgdvbhUILF8jdpI2y9BbC//4PEq', 'avatar-02.jpg', '2025-07-04 08:27:30', NULL),
(3, 'Reza', 'reza25@gmail.com', '$2y$10$VktczJJSJdwJlTw8uN/Eb.Y6qEbhLm/t2rMyZQool2GkO8QUDlPze', '68679765a5a5f.gif', '2025-07-04 08:57:09', NULL),
(4, 'liebiert', 'liebiert10@gmail.com', '$2y$10$DTZM9Cj0YFteAc493.NvaeZSElb7txgvHSzx7P3W6p5pzqm828ADO', '6870b737cb8c2.jpeg', '2025-07-11 07:03:20', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(11) NOT NULL,
  `warehouse_id` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `type` enum('Distribution & Storage','Fullfilment Center','Transit & Sorting','Regional Distribution') NOT NULL,
  `capacity` int(11) NOT NULL COMMENT 'Dalam unit',
  `land_area` decimal(10,2) NOT NULL COMMENT 'Dalam m²',
  `operational_year` year(4) NOT NULL,
  `status` enum('active','in_progress') NOT NULL DEFAULT 'active',
  `telephone` varchar(20) NOT NULL,
  `latitude` decimal(10,6) NOT NULL,
  `longitude` decimal(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `warehouses`
--

INSERT INTO `warehouses` (`id`, `warehouse_id`, `name`, `address`, `city`, `type`, `capacity`, `land_area`, `operational_year`, `status`, `telephone`, `latitude`, `longitude`) VALUES
(1, 'STR001', 'Gudang Utama IKEA Alam Sutera', 'Kawasan Industri XYZ Blok A-5, Alam Sutera', 'Tangerang (Banten)', 'Distribution & Storage', 80000, 25000.00, '2014', 'active', '(021) 12345678', -6.224100, 106.658300),
(2, 'STR002', 'Gudang IKEA Sentul Logistics', 'Kawasan Industri Sentul, Bogor', 'Bogor (Jawa Barat)', 'Fullfilment Center', 80000, 20000.00, '2020', 'active', '(021) 12345678', -6.562200, 106.846000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `warehouse_types`
--

CREATE TABLE `warehouse_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `color` varchar(7) NOT NULL DEFAULT '#3498db'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `warehouse_types`
--

INSERT INTO `warehouse_types` (`id`, `name`, `color`) VALUES
(1, 'Distribution & Storage', '#3498db'),
(2, 'Fullfilment Center', '#2ecc71'),
(3, 'Transit & Sorting', '#f1c40f'),
(4, 'Regional Distribution', '#e74c3c');

-- --------------------------------------------------------

--
-- Struktur untuk view `department_insights`
--
DROP TABLE IF EXISTS `department_insights`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `department_insights`  AS SELECT `d`.`id` AS `id`, `d`.`name` AS `name`, `d`.`color_code` AS `color_code`, format(sum(`e`.`jumlah`),2) AS `total_pengeluaran`, format(sum(`e`.`jumlah`) / count(distinct month(`e`.`tanggal`)),2) AS `rata_bulanan`, (select `e2`.`deskripsi` from `expenses` `e2` where `e2`.`department_id` = `d`.`id` order by `e2`.`jumlah` desc limit 1) AS `pengeluaran_terbesar` FROM (`expenses` `e` join `departments` `d` on(`e`.`department_id` = `d`.`id`)) GROUP BY `d`.`id` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aktivitas_cabang`
--
ALTER TABLE `aktivitas_cabang`
  ADD PRIMARY KEY (`id_aktivitas`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indeks untuk tabel `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brand_code` (`brand_code`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeks untuk tabel `brand_health_scores`
--
ALTER TABLE `brand_health_scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indeks untuk tabel `brand_notifications`
--
ALTER TABLE `brand_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indeks untuk tabel `brand_sales_history`
--
ALTER TABLE `brand_sales_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `year_month` (`year`,`month`);

--
-- Indeks untuk tabel `brand_store_performance`
--
ALTER TABLE `brand_store_performance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `id_toko` (`id_toko`),
  ADD KEY `period` (`period`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indeks untuk tabel `categories_product`
--
ALTER TABLE `categories_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_code` (`category_code`);

--
-- Indeks untuk tabel `category_budget_allocation`
--
ALTER TABLE `category_budget_allocation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeks untuk tabel `category_competition_analysis`
--
ALTER TABLE `category_competition_analysis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeks untuk tabel `category_performance_metrics`
--
ALTER TABLE `category_performance_metrics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeks untuk tabel `category_sales_trends`
--
ALTER TABLE `category_sales_trends`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_id_2` (`category_id`,`year`,`month`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeks untuk tabel `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indeks untuk tabel `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference` (`reference`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indeks untuk tabel `expense_insights`
--
ALTER TABLE `expense_insights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indeks untuk tabel `expense_stats`
--
ALTER TABLE `expense_stats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tahun` (`tahun`,`bulan`),
  ADD KEY `top_category_id` (`top_category_id`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `id_toko` (`id_toko`),
  ADD KEY `laporan_langsung` (`laporan_langsung`);

--
-- Indeks untuk tabel `kinerja_karyawan`
--
ALTER TABLE `kinerja_karyawan`
  ADD PRIMARY KEY (`id_kinerja`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indeks untuk tabel `komunikasi_supplier`
--
ALTER TABLE `komunikasi_supplier`
  ADD PRIMARY KEY (`id_komunikasi`),
  ADD KEY `ID_Supplier` (`ID_Supplier`);

--
-- Indeks untuk tabel `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id_manager`),
  ADD UNIQUE KEY `kode_manager` (`kode_manager`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indeks untuk tabel `monthly_profit_trend`
--
ALTER TABLE `monthly_profit_trend`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `year` (`year`,`month`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indeks untuk tabel `product_activities`
--
ALTER TABLE `product_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `product_sales`
--
ALTER TABLE `product_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `revenue`
--
ALTER TABLE `revenue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indeks untuk tabel `revenue_growth`
--
ALTER TABLE `revenue_growth`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `store_performance_metrics`
--
ALTER TABLE `store_performance_metrics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`ID_Supplier`);

--
-- Indeks untuk tabel `supplier_analytics`
--
ALTER TABLE `supplier_analytics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `month_year` (`month`,`year`),
  ADD KEY `top_performing_supplier_id` (`top_performing_supplier_id`);

--
-- Indeks untuk tabel `supplier_categories`
--
ALTER TABLE `supplier_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indeks untuk tabel `supplier_certifications`
--
ALTER TABLE `supplier_certifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `status` (`status`),
  ADD KEY `expiry_date` (`expiry_date`);

--
-- Indeks untuk tabel `supplier_contracts`
--
ALTER TABLE `supplier_contracts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contract_code` (`contract_code`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `approved_by` (`approved_by`),
  ADD KEY `status` (`status`);

--
-- Indeks untuk tabel `supplier_orders`
--
ALTER TABLE `supplier_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_code` (`order_code`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `store_id` (`store_id`),
  ADD KEY `contract_id` (`contract_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `order_date` (`order_date`),
  ADD KEY `status` (`status`),
  ADD KEY `approved_by` (`approved_by`),
  ADD KEY `received_by` (`received_by`);

--
-- Indeks untuk tabel `supplier_order_items`
--
ALTER TABLE `supplier_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indeks untuk tabel `supplier_performance`
--
ALTER TABLE `supplier_performance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supplier_period` (`supplier_id`,`evaluation_period`,`month`,`year`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indeks untuk tabel `supplier_returns`
--
ALTER TABLE `supplier_returns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `return_code` (`return_code`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `store_id` (`store_id`),
  ADD KEY `warehouse_id` (`warehouse_id`),
  ADD KEY `processed_by` (`processed_by`),
  ADD KEY `approved_by` (`approved_by`);

--
-- Indeks untuk tabel `supplier_return_analytics`
--
ALTER TABLE `supplier_return_analytics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supplier_month_year` (`supplier_id`,`month`,`year`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `top_return_reason_id` (`top_return_reason_id`);

--
-- Indeks untuk tabel `supplier_return_items`
--
ALTER TABLE `supplier_return_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `return_id` (`return_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `reason_id` (`reason_id`);

--
-- Indeks untuk tabel `supplier_return_reasons`
--
ALTER TABLE `supplier_return_reasons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reason_code` (`reason_code`);

--
-- Indeks untuk tabel `supplier_return_tracking`
--
ALTER TABLE `supplier_return_tracking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `return_id` (`return_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indeks untuk tabel `tugas_manager`
--
ALTER TABLE `tugas_manager`
  ADD PRIMARY KEY (`id_tugas`),
  ADD KEY `id_manager` (`id_manager`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `warehouse_id` (`warehouse_id`);

--
-- Indeks untuk tabel `warehouse_types`
--
ALTER TABLE `warehouse_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aktivitas_cabang`
--
ALTER TABLE `aktivitas_cabang`
  MODIFY `id_aktivitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=496;

--
-- AUTO_INCREMENT untuk tabel `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `brand_health_scores`
--
ALTER TABLE `brand_health_scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `brand_notifications`
--
ALTER TABLE `brand_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `brand_sales_history`
--
ALTER TABLE `brand_sales_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `brand_store_performance`
--
ALTER TABLE `brand_store_performance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `categories_product`
--
ALTER TABLE `categories_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `category_budget_allocation`
--
ALTER TABLE `category_budget_allocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `category_competition_analysis`
--
ALTER TABLE `category_competition_analysis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `category_performance_metrics`
--
ALTER TABLE `category_performance_metrics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `category_sales_trends`
--
ALTER TABLE `category_sales_trends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `expense_insights`
--
ALTER TABLE `expense_insights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `expense_stats`
--
ALTER TABLE `expense_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=958;

--
-- AUTO_INCREMENT untuk tabel `kinerja_karyawan`
--
ALTER TABLE `kinerja_karyawan`
  MODIFY `id_kinerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11062;

--
-- AUTO_INCREMENT untuk tabel `komunikasi_supplier`
--
ALTER TABLE `komunikasi_supplier`
  MODIFY `id_komunikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `manager`
--
ALTER TABLE `manager`
  MODIFY `id_manager` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `monthly_profit_trend`
--
ALTER TABLE `monthly_profit_trend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `product_activities`
--
ALTER TABLE `product_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `product_sales`
--
ALTER TABLE `product_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `revenue`
--
ALTER TABLE `revenue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `revenue_growth`
--
ALTER TABLE `revenue_growth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `store_performance_metrics`
--
ALTER TABLE `store_performance_metrics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `ID_Supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `supplier_analytics`
--
ALTER TABLE `supplier_analytics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `supplier_categories`
--
ALTER TABLE `supplier_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `supplier_certifications`
--
ALTER TABLE `supplier_certifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `supplier_contracts`
--
ALTER TABLE `supplier_contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `supplier_orders`
--
ALTER TABLE `supplier_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `supplier_order_items`
--
ALTER TABLE `supplier_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `supplier_performance`
--
ALTER TABLE `supplier_performance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `supplier_returns`
--
ALTER TABLE `supplier_returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `supplier_return_analytics`
--
ALTER TABLE `supplier_return_analytics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `supplier_return_items`
--
ALTER TABLE `supplier_return_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `supplier_return_reasons`
--
ALTER TABLE `supplier_return_reasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `supplier_return_tracking`
--
ALTER TABLE `supplier_return_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT untuk tabel `tugas_manager`
--
ALTER TABLE `tugas_manager`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `warehouse_types`
--
ALTER TABLE `warehouse_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `brand`
--
ALTER TABLE `brand`
  ADD CONSTRAINT `brands_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories_product` (`id`);

--
-- Ketidakleluasaan untuk tabel `supplier_analytics`
--
ALTER TABLE `supplier_analytics`
  ADD CONSTRAINT `supplier_analytics_ibfk_1` FOREIGN KEY (`top_performing_supplier_id`) REFERENCES `supplier` (`ID_Supplier`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `supplier_certifications`
--
ALTER TABLE `supplier_certifications`
  ADD CONSTRAINT `supplier_certifications_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`ID_Supplier`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `supplier_contracts`
--
ALTER TABLE `supplier_contracts`
  ADD CONSTRAINT `supplier_contracts_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`ID_Supplier`) ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_contracts_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_contracts_ibfk_3` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `supplier_orders`
--
ALTER TABLE `supplier_orders`
  ADD CONSTRAINT `supplier_orders_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`ID_Supplier`) ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_orders_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `toko` (`id_toko`) ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_orders_ibfk_3` FOREIGN KEY (`contract_id`) REFERENCES `supplier_contracts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_orders_ibfk_4` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_orders_ibfk_5` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_orders_ibfk_6` FOREIGN KEY (`received_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `supplier_order_items`
--
ALTER TABLE `supplier_order_items`
  ADD CONSTRAINT `supplier_order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `supplier_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_order_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `supplier_performance`
--
ALTER TABLE `supplier_performance`
  ADD CONSTRAINT `supplier_performance_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`ID_Supplier`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `supplier_returns`
--
ALTER TABLE `supplier_returns`
  ADD CONSTRAINT `supplier_returns_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`ID_Supplier`) ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_returns_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `toko` (`id_toko`) ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_returns_ibfk_3` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_returns_ibfk_4` FOREIGN KEY (`processed_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_returns_ibfk_5` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `supplier_return_analytics`
--
ALTER TABLE `supplier_return_analytics`
  ADD CONSTRAINT `supplier_return_analytics_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`ID_Supplier`) ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_return_analytics_ibfk_2` FOREIGN KEY (`top_return_reason_id`) REFERENCES `supplier_return_reasons` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `supplier_return_items`
--
ALTER TABLE `supplier_return_items`
  ADD CONSTRAINT `fk_item` FOREIGN KEY (`item_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reason` FOREIGN KEY (`reason_id`) REFERENCES `supplier_return_reasons` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_return` FOREIGN KEY (`return_id`) REFERENCES `supplier_returns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `supplier_return_tracking`
--
ALTER TABLE `supplier_return_tracking`
  ADD CONSTRAINT `supplier_return_tracking_ibfk_1` FOREIGN KEY (`return_id`) REFERENCES `supplier_returns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_return_tracking_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
