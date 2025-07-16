-- Script untuk membuat tabel-tabel customer return IKEA
-- Menambahkan tabel baru dan memodifikasi yang sudah ada

-- 1. Buat tabel customers jika belum ada
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_code` varchar(20) NOT NULL UNIQUE,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `membership_level` enum('Regular','Silver','Gold','Platinum') DEFAULT 'Regular',
  `total_purchases` decimal(15,2) DEFAULT 0.00,
  `created_at` timestamp DEFAULT current_timestamp(),
  `updated_at` timestamp DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `customer_code` (`customer_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 2. Buat tabel return_reasons
CREATE TABLE `return_reasons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason_code` varchar(10) NOT NULL UNIQUE,
  `reason_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `reason_code` (`reason_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 3. Buat tabel customer_returns (tabel utama)
CREATE TABLE `customer_returns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `return_code` varchar(20) NOT NULL UNIQUE,
  `customer_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `return_date` datetime NOT NULL DEFAULT current_timestamp(),
  `purchase_date` date DEFAULT NULL,
  `receipt_number` varchar(50) DEFAULT NULL,
  `total_amount` decimal(15,2) DEFAULT 0.00,
  `refund_amount` decimal(15,2) DEFAULT 0.00,
  `status` enum('Pending','Processing','Approved','Rejected','Completed','Cancelled') DEFAULT 'Pending',
  `return_type` enum('Refund','Exchange','Store Credit') DEFAULT 'Refund',
  `priority` enum('Low','Medium','High','Urgent') DEFAULT 'Medium',
  `customer_notes` text DEFAULT NULL,
  `staff_notes` text DEFAULT NULL,
  `processed_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `created_at` timestamp DEFAULT current_timestamp(),
  `updated_at` timestamp DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `store_id` (`store_id`),
  KEY `processed_by` (`processed_by`),
  KEY `approved_by` (`approved_by`),
  KEY `return_date` (`return_date`),
  KEY `status` (`status`),
  FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE,
  FOREIGN KEY (`store_id`) REFERENCES `toko` (`id_toko`) ON UPDATE CASCADE,
  FOREIGN KEY (`processed_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE SET NULL,
  FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 4. Buat tabel return_items (detail item yang di-return)
CREATE TABLE `return_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `return_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `reason_id` int(11) NOT NULL,
  `quantity_returned` int(11) NOT NULL,
  `unit_price` decimal(12,2) NOT NULL,
  `total_price` decimal(15,2) GENERATED ALWAYS AS (`quantity_returned` * `unit_price`) STORED,
  `condition_assessment` enum('New','Good','Fair','Poor','Damaged') DEFAULT 'Good',
  `can_resell` tinyint(1) DEFAULT 1,
  `restocking_fee` decimal(10,2) DEFAULT 0.00,
  `item_notes` text DEFAULT NULL,
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `return_id` (`return_id`),
  KEY `item_id` (`item_id`),
  KEY `reason_id` (`reason_id`),
  FOREIGN KEY (`return_id`) REFERENCES `customer_returns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`item_id`) REFERENCES `barang` (`id_barang`) ON UPDATE CASCADE,
  FOREIGN KEY (`reason_id`) REFERENCES `return_reasons` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 5. Buat tabel return_tracking (tracking status return)
CREATE TABLE `return_tracking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `return_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `return_id` (`return_id`),
  KEY `created_by` (`created_by`),
  FOREIGN KEY (`return_id`) REFERENCES `customer_returns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 6. Buat tabel return_analytics (untuk dashboard analytics)
CREATE TABLE `return_analytics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `total_returns` int(11) DEFAULT 0,
  `total_return_value` decimal(15,2) DEFAULT 0.00,
  `total_refunds` decimal(15,2) DEFAULT 0.00,
  `return_rate` decimal(5,2) DEFAULT 0.00,
  `avg_processing_time` decimal(5,2) DEFAULT 0.00,
  `customer_satisfaction` decimal(3,1) DEFAULT 0.0,
  `top_return_reason_id` int(11) DEFAULT NULL,
  `updated_at` timestamp DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `store_month_year` (`store_id`, `month`, `year`),
  KEY `store_id` (`store_id`),
  KEY `top_return_reason_id` (`top_return_reason_id`),
  FOREIGN KEY (`store_id`) REFERENCES `toko` (`id_toko`) ON UPDATE CASCADE,
  FOREIGN KEY (`top_return_reason_id`) REFERENCES `return_reasons` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 7. Pastikan tabel toko sudah ada dengan data
INSERT IGNORE INTO `toko` (`id_toko`, `nama_toko`, `lokasi_toko`, `manager_toko`, `kontak_toko`) VALUES
(1, 'IKEA Alam Sutera', 'Alam Sutera, Tangerang', 'John Doe', '021-12345678'),
(2, 'IKEA Jakarta Garden City', 'Jakarta Garden City, Jakarta', 'Jane Smith', '021-87654321'),
(3, 'IKEA Sentul City', 'Sentul City, Bogor', 'Bob Wilson', '021-11223344'),
(4, 'IKEA Bali', 'Denpasar, Bali', 'Alice Brown', '0361-556677'),
(5, 'IKEA Kota Baru Parahyangan', 'Bandung, Jawa Barat', 'Charlie Davis', '022-998877'),
(6, 'IKEA Mal Taman Anggrek', 'Jakarta Barat', 'David Lee', '021-445566');

-- 8. Pastikan tabel barang sudah ada dengan data
INSERT IGNORE INTO `barang` (`id_barang`, `id_supplier`, `nama_barang`, `kategori`, `deskripsi`, `harga_satuan`, `satuan`) VALUES
(1, 1, 'HEMNES Bed Frame', 'Furniture', 'Solid wood bed frame', 2500000.00, 'pcs'),
(2, 1, 'BILLY Bookcase', 'Furniture', 'Adjustable shelves bookcase', 899000.00, 'pcs'),
(3, 1, 'MALM Dresser', 'Furniture', '6-drawer dresser', 1799000.00, 'pcs'),
(4, 2, 'FOTO Pendant Lamp', 'Lighting', 'Modern pendant lamp', 299000.00, 'pcs'),
(5, 2, 'LACK Wall Shelf', 'Storage', 'Floating wall shelf', 149000.00, 'pcs'),
(6, 3, 'EKET Storage Cube', 'Storage', 'Modular storage cube', 399000.00, 'pcs'),
(7, 1, 'POÄNG Armchair', 'Living Room', 'Comfortable armchair', 1299000.00, 'pcs'),
(8, 2, 'DOCKSTA Table', 'Dining', 'Round dining table', 2199000.00, 'pcs'),
(9, 3, 'HEMNES Wardrobe', 'Bedroom', '3-door wardrobe', 3499000.00, 'pcs'),
(10, 1, 'KALLAX Shelf Unit', 'Storage', '4x4 shelf unit', 799000.00, 'pcs');

-- 9. Pastikan tabel supplier ada
INSERT IGNORE INTO `supplier` (`id_supplier`, `nama_supplier`, `kontak_supplier`, `alamat_supplier`) VALUES
(1, 'IKEA Supply Chain', '021-1234567', 'Jakarta'),
(2, 'Furniture Supplier', '021-7654321', 'Surabaya'),
(3, 'Home Decor Supplier', '022-1122334', 'Bandung');

