-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jul 2025 pada 08.12
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
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `ID_Barang` int(11) NOT NULL,
  `ID_Supplier` int(11) NOT NULL,
  `Nama_Barang` varchar(150) NOT NULL,
  `Kategori` varchar(50) DEFAULT NULL,
  `Deskripsi` text DEFAULT NULL,
  `Harga_Satuan` decimal(12,2) NOT NULL DEFAULT 0.00,
  `Satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Struktur dari tabel `distribusi_barang`
--

CREATE TABLE `distribusi_barang` (
  `ID_Distribusi` int(11) NOT NULL,
  `ID_Transaksi` int(11) NOT NULL,
  `ID_Gudang` int(11) NOT NULL,
  `ID_Toko` int(11) NOT NULL,
  `Tanggal_Distribusi` datetime NOT NULL,
  `Sumber_Lokasi` varchar(100) NOT NULL,
  `Tujuan_Lokasi` varchar(100) NOT NULL,
  `Status_Distribusi` enum('Proses','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `category_id` int(11) NOT NULL,
  `insight` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Struktur dari tabel `gudang`
--

CREATE TABLE `gudang` (
  `ID_Gudang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `ID_Pengguna` int(11) NOT NULL,
  `Nama_Lengkap` varchar(150) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Kata_Sandi` varchar(255) NOT NULL,
  `Nomor_Telepon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `performa_toko`
--

CREATE TABLE `performa_toko` (
  `ID_Performa` int(11) NOT NULL,
  `ID_Toko` int(11) NOT NULL,
  `Rating` tinyint(4) NOT NULL CHECK (`Rating` between 1 and 5),
  `Tanggal_Feedback` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok`
--

CREATE TABLE `stok` (
  `ID_Barang` int(11) NOT NULL,
  `ID_Gudang` int(11) NOT NULL,
  `ID_Toko` int(11) NOT NULL,
  `Jumlah_Stok` int(11) NOT NULL DEFAULT 0,
  `Stok_Minimal` int(11) NOT NULL DEFAULT 0,
  `Tanggal_Update` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `ID_Supplier` int(11) NOT NULL,
  `Nama_Supplier` varchar(100) NOT NULL,
  `Kontak_Supplier` varchar(50) DEFAULT NULL,
  `Alamat_Supplier` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `ID_Toko` int(11) NOT NULL,
  `Nama_Toko` varchar(100) NOT NULL,
  `Lokasi_Toko` varchar(150) DEFAULT NULL,
  `Manager_Toko` varchar(100) DEFAULT NULL,
  `Kontak_Toko` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_inventaris`
--

CREATE TABLE `transaksi_inventaris` (
  `ID_Transaksi` int(11) NOT NULL,
  `ID_Barang` int(11) NOT NULL,
  `ID_Gudang` int(11) NOT NULL,
  `ID_Toko` int(11) NOT NULL,
  `Tanggal_Transaksi` datetime NOT NULL DEFAULT current_timestamp(),
  `Jenis_Transaksi` enum('Masuk','Keluar') NOT NULL,
  `Jumlah_Transaksi` int(11) NOT NULL,
  `Keterangan` varchar(255) DEFAULT NULL
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
(3, 'Reza', 'reza25@gmail.com', '$2y$10$VktczJJSJdwJlTw8uN/Eb.Y6qEbhLm/t2rMyZQool2GkO8QUDlPze', '68679765a5a5f.gif', '2025-07-04 08:57:09', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID_Barang`),
  ADD KEY `ID_Supplier` (`ID_Supplier`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indeks untuk tabel `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indeks untuk tabel `distribusi_barang`
--
ALTER TABLE `distribusi_barang`
  ADD PRIMARY KEY (`ID_Distribusi`),
  ADD KEY `ID_Transaksi` (`ID_Transaksi`),
  ADD KEY `ID_Gudang` (`ID_Gudang`),
  ADD KEY `ID_Toko` (`ID_Toko`);

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
  ADD KEY `category_id` (`category_id`);

--
-- Indeks untuk tabel `expense_stats`
--
ALTER TABLE `expense_stats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tahun` (`tahun`,`bulan`),
  ADD KEY `top_category_id` (`top_category_id`);

--
-- Indeks untuk tabel `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`ID_Gudang`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`ID_Pengguna`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indeks untuk tabel `performa_toko`
--
ALTER TABLE `performa_toko`
  ADD PRIMARY KEY (`ID_Performa`),
  ADD KEY `ID_Toko` (`ID_Toko`);

--
-- Indeks untuk tabel `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`ID_Barang`,`ID_Gudang`,`ID_Toko`),
  ADD KEY `ID_Gudang` (`ID_Gudang`),
  ADD KEY `ID_Toko` (`ID_Toko`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`ID_Supplier`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`ID_Toko`);

--
-- Indeks untuk tabel `transaksi_inventaris`
--
ALTER TABLE `transaksi_inventaris`
  ADD PRIMARY KEY (`ID_Transaksi`),
  ADD KEY `ID_Barang` (`ID_Barang`),
  ADD KEY `ID_Gudang` (`ID_Gudang`),
  ADD KEY `ID_Toko` (`ID_Toko`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `ID_Barang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `distribusi_barang`
--
ALTER TABLE `distribusi_barang`
  MODIFY `ID_Distribusi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `expense_insights`
--
ALTER TABLE `expense_insights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `expense_stats`
--
ALTER TABLE `expense_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `ID_Pengguna` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `performa_toko`
--
ALTER TABLE `performa_toko`
  MODIFY `ID_Performa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `ID_Supplier` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `ID_Toko` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi_inventaris`
--
ALTER TABLE `transaksi_inventaris`
  MODIFY `ID_Transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`ID_Supplier`) REFERENCES `supplier` (`ID_Supplier`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `distribusi_barang`
--
ALTER TABLE `distribusi_barang`
  ADD CONSTRAINT `distribusi_barang_ibfk_1` FOREIGN KEY (`ID_Transaksi`) REFERENCES `transaksi_inventaris` (`ID_Transaksi`) ON UPDATE CASCADE,
  ADD CONSTRAINT `distribusi_barang_ibfk_2` FOREIGN KEY (`ID_Gudang`) REFERENCES `gudang` (`ID_Gudang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `distribusi_barang_ibfk_3` FOREIGN KEY (`ID_Toko`) REFERENCES `toko` (`ID_Toko`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `expenses_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Ketidakleluasaan untuk tabel `expense_insights`
--
ALTER TABLE `expense_insights`
  ADD CONSTRAINT `expense_insights_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Ketidakleluasaan untuk tabel `expense_stats`
--
ALTER TABLE `expense_stats`
  ADD CONSTRAINT `expense_stats_ibfk_1` FOREIGN KEY (`top_category_id`) REFERENCES `categories` (`id`);

--
-- Ketidakleluasaan untuk tabel `performa_toko`
--
ALTER TABLE `performa_toko`
  ADD CONSTRAINT `performa_toko_ibfk_1` FOREIGN KEY (`ID_Toko`) REFERENCES `toko` (`ID_Toko`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `stok_ibfk_1` FOREIGN KEY (`ID_Barang`) REFERENCES `barang` (`ID_Barang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `stok_ibfk_2` FOREIGN KEY (`ID_Gudang`) REFERENCES `gudang` (`ID_Gudang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `stok_ibfk_3` FOREIGN KEY (`ID_Toko`) REFERENCES `toko` (`ID_Toko`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_inventaris`
--
ALTER TABLE `transaksi_inventaris`
  ADD CONSTRAINT `transaksi_inventaris_ibfk_1` FOREIGN KEY (`ID_Barang`) REFERENCES `barang` (`ID_Barang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_inventaris_ibfk_2` FOREIGN KEY (`ID_Gudang`) REFERENCES `gudang` (`ID_Gudang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_inventaris_ibfk_3` FOREIGN KEY (`ID_Toko`) REFERENCES `toko` (`ID_Toko`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
