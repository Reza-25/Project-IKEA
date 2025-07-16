-- Script untuk membuat tabel-tabel supplier return IKEA
-- Menambahkan tabel baru dan memodifikasi yang sudah ada

-- 1. Pastikan tabel supplier sudah ada dengan data lengkap
INSERT IGNORE INTO `supplier` (`id_supplier`, `nama_supplier`, `kontak_supplier`, `alamat_supplier`) VALUES
(1, 'IKEA Supply Chain', '021-1234567', 'Jakarta Pusat'),
(2, 'Furniture Supplier Co.', '021-7654321', 'Surabaya'),
(3, 'Home Decor Supplier', '022-1122334', 'Bandung'),
(4, 'Apex Computers', '021-5555666', 'Jakarta Selatan'),
(5, 'Modern Automobile', '031-7777888', 'Surabaya'),
(6, 'AIM Infotech', '022-9999000', 'Bandung'),
(7, 'Best Power Tools', '021-1111222', 'Jakarta Barat'),
(8, 'Hatimi Hardware & Tools', '024-3333444', 'Semarang');

-- 2. Pastikan tabel barang sudah ada dengan data lengkap
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
(10, 1, 'KALLAX Shelf Unit', 'Storage', '4x4 shelf unit', 799000.00, 'pcs'),
(11, 4, 'SKÅDIS Pegboard', 'Organizer', 'Perforated board for organization', 299000.00, 'pcs'),
(12, 4, 'VARIERA Shelf Insert', 'Storage', 'Adjustable shelf insert', 249000.00, 'pcs'),
(13, 5, 'FRIHETEN Sofa Bed', 'Living Room', 'Corner sofa bed with storage', 4999000.00, 'pcs'),
(14, 6, 'IVAR Shelf Unit', 'Storage', 'Solid wood shelf unit', 1299000.00, 'pcs'),
(15, 7, 'BEKANT Desk', 'Office', 'Office desk with adjustable legs', 1599000.00, 'pcs');

-- 3. Pastikan tabel toko sudah ada dengan data
INSERT IGNORE INTO `toko` (`id_toko`, `nama_toko`, `lokasi_toko`, `manager_toko`, `kontak_toko`) VALUES
(1, 'IKEA Alam Sutera', 'Alam Sutera, Tangerang', 'John Doe', '021-12345678'),
(2, 'IKEA Jakarta Garden City', 'Jakarta Garden City, Jakarta', 'Jane Smith', '021-87654321'),
(3, 'IKEA Sentul City', 'Sentul City, Bogor', 'Bob Wilson', '021-11223344'),
(4, 'IKEA Bali', 'Denpasar, Bali', 'Alice Brown', '0361-556677'),
(5, 'IKEA Kota Baru Parahyangan', 'Bandung, Jawa Barat', 'Charlie Davis', '022-998877'),
(6, 'IKEA Mal Taman Anggrek', 'Jakarta Barat', 'David Lee', '021-445566');

-- 4. Pastikan tabel gudang ada
INSERT IGNORE INTO `gudang` (`id_gudang`) VALUES (1), (2), (3), (4), (5), (6);

-- 5. Buat tabel supplier_return_reasons
CREATE TABLE `supplier_return_reasons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason_code` varchar(10) NOT NULL UNIQUE,  -- This already creates an index
  `reason_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
  -- Removed duplicate KEY declaration
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 6. Buat tabel supplier_returns (tabel utama)
CREATE TABLE `supplier_returns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `return_code` varchar(20) NOT NULL UNIQUE,
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
  `created_at` timestamp DEFAULT current_timestamp(),
  `updated_at` timestamp DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `store_id` (`store_id`),
  KEY `warehouse_id` (`warehouse_id`),
  KEY `processed_by` (`processed_by`),
  KEY `approved_by` (`approved_by`),
  KEY `return_date` (`return_date`),
  KEY `status` (`status`),
  FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id_supplier`) ON UPDATE CASCADE,
  FOREIGN KEY (`store_id`) REFERENCES `toko` (`id_toko`) ON UPDATE CASCADE,
  FOREIGN KEY (`warehouse_id`) REFERENCES `gudang` (`id_gudang`) ON UPDATE CASCADE ON DELETE SET NULL,
  FOREIGN KEY (`processed_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE SET NULL,
  FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 7. Buat tabel supplier_return_items (detail item yang di-return)
CREATE TABLE `supplier_return_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `return_id` (`return_id`),
  KEY `item_id` (`item_id`),
  KEY `reason_id` (`reason_id`),
  FOREIGN KEY (`return_id`) REFERENCES `supplier_returns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`item_id`) REFERENCES `barang` (`id_barang`) ON UPDATE CASCADE,
  FOREIGN KEY (`reason_id`) REFERENCES `supplier_return_reasons` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 8. Buat tabel supplier_return_tracking (tracking status return)
CREATE TABLE `supplier_return_tracking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `return_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `return_id` (`return_id`),
  KEY `created_by` (`created_by`),
  FOREIGN KEY (`return_id`) REFERENCES `supplier_returns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 9. Buat tabel supplier_return_analytics (untuk dashboard analytics)
CREATE TABLE `supplier_return_analytics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `supplier_month_year` (`supplier_id`, `month`, `year`),
  KEY `supplier_id` (`supplier_id`),
  KEY `top_return_reason_id` (`top_return_reason_id`),
  FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id_supplier`) ON UPDATE CASCADE,
  FOREIGN KEY (`top_return_reason_id`) REFERENCES `supplier_return_reasons` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
