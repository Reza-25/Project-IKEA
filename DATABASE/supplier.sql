-- Script untuk membuat tabel-tabel supplier management IKEA
-- Menambahkan tabel baru dan memodifikasi yang sudah ada

-- 1. Pastikan tabel supplier sudah ada dengan data lengkap
INSERT IGNORE INTO `supplier` (`id_supplier`, `nama_supplier`, `kontak_supplier`, `alamat_supplier`) VALUES
(1, 'Nordic Furnishings AB', '021-1234567', 'Stockholm, Sweden'),
(2, 'Baltic Woodworks Ltd', '031-7654321', 'Riga, Latvia'),
(3, 'Scandinavian Lights Co', '022-1122334', 'Oslo, Norway'),
(4, 'Finnish Design House', '09-5555666', 'Helsinki, Finland'),
(5, 'Swedish Textile Mills', '08-7777888', 'Gothenburg, Sweden'),
(6, 'Danish Furniture Co', '45-9999000', 'Copenhagen, Denmark'),
(7, 'Estonian Wood Craft', '372-1111222', 'Tallinn, Estonia'),
(8, 'Icelandic Home Decor', '354-3333444', 'Reykjavik, Iceland'),
(9, 'Norwegian Steel Works', '47-5555777', 'Bergen, Norway'),
(10, 'Latvian Glass Studio', '371-8888999', 'Daugavpils, Latvia');

-- 2. Buat tabel supplier_categories untuk kategori supplier
CREATE TABLE `supplier_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 3. Buat tabel supplier_contracts untuk kontrak dengan supplier
CREATE TABLE `supplier_contracts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contract_code` varchar(20) NOT NULL UNIQUE,
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
  `created_at` timestamp DEFAULT current_timestamp(),
  `updated_at` timestamp DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `created_by` (`created_by`),
  KEY `approved_by` (`approved_by`),
  KEY `status` (`status`),
  FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id_supplier`) ON UPDATE CASCADE,
  FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE SET NULL,
  FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 4. Buat tabel supplier_orders untuk pesanan ke supplier
CREATE TABLE `supplier_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_code` varchar(20) NOT NULL UNIQUE,
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
  `created_at` timestamp DEFAULT current_timestamp(),
  `updated_at` timestamp DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `store_id` (`store_id`),
  KEY `contract_id` (`contract_id`),
  KEY `created_by` (`created_by`),
  KEY `order_date` (`order_date`),
  KEY `status` (`status`),
  FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id_supplier`) ON UPDATE CASCADE,
  FOREIGN KEY (`store_id`) REFERENCES `toko` (`id_toko`) ON UPDATE CASCADE,
  FOREIGN KEY (`contract_id`) REFERENCES `supplier_contracts` (`id`) ON UPDATE CASCADE ON DELETE SET NULL,
  FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE SET NULL,
  FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE SET NULL,
  FOREIGN KEY (`received_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 5. Buat tabel supplier_order_items untuk detail item pesanan
CREATE TABLE `supplier_order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity_ordered` int(11) NOT NULL,
  `quantity_delivered` int(11) DEFAULT 0,
  `unit_price` decimal(12,2) NOT NULL,
  `total_price` decimal(15,2) GENERATED ALWAYS AS (`quantity_ordered` * `unit_price`) STORED,
  `delivery_status` enum('Pending','Partial','Complete','Cancelled') DEFAULT 'Pending',
  `quality_check` enum('Pending','Passed','Failed','N/A') DEFAULT 'Pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `item_id` (`item_id`),
  FOREIGN KEY (`order_id`) REFERENCES `supplier_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`item_id`) REFERENCES `barang` (`id_barang`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 6. Buat tabel supplier_performance untuk tracking performa supplier
CREATE TABLE `supplier_performance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `supplier_period` (`supplier_id`, `evaluation_period`, `month`, `year`),
  KEY `supplier_id` (`supplier_id`),
  FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id_supplier`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 7. Buat tabel supplier_analytics untuk dashboard analytics
CREATE TABLE `supplier_analytics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `total_procurement_value` decimal(15,2) DEFAULT 0.00,
  `active_suppliers` int(11) DEFAULT 0,
  `new_suppliers` int(11) DEFAULT 0,
  `avg_sustainability_score` decimal(3,1) DEFAULT 0.0,
  `avg_delivery_time` decimal(5,2) DEFAULT 0.00,
  `cost_savings` decimal(15,2) DEFAULT 0.00,
  `top_performing_supplier_id` int(11) DEFAULT NULL,
  `updated_at` timestamp DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `month_year` (`month`, `year`),
  KEY `top_performing_supplier_id` (`top_performing_supplier_id`),
  FOREIGN KEY (`top_performing_supplier_id`) REFERENCES `supplier` (`id_supplier`) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 8. Buat tabel supplier_certifications untuk sertifikasi supplier
CREATE TABLE `supplier_certifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `certification_name` varchar(100) NOT NULL,
  `certification_body` varchar(100) DEFAULT NULL,
  `issue_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `status` enum('Valid','Expired','Suspended','Revoked') DEFAULT 'Valid',
  `certificate_file` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp DEFAULT current_timestamp(),
  `updated_at` timestamp DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `status` (`status`),
  KEY `expiry_date` (`expiry_date`),
  FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id_supplier`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 9. Update tabel barang dengan data lengkap
INSERT IGNORE INTO `barang` (`id_barang`, `id_supplier`, `nama_barang`, `kategori`, `deskripsi`, `harga_satuan`, `satuan`) VALUES
(1, 1, 'HEMNES Bed Frame', 'Furniture', 'Solid wood bed frame', 2500000.00, 'pcs'),
(2, 1, 'BILLY Bookcase', 'Furniture', 'Adjustable shelves bookcase', 899000.00, 'pcs'),
(3, 2, 'MALM Dresser', 'Furniture', '6-drawer dresser', 1799000.00, 'pcs'),
(4, 3, 'FOTO Pendant Lamp', 'Lighting', 'Modern pendant lamp', 299000.00, 'pcs'),
(5, 3, 'LACK Wall Shelf', 'Storage', 'Floating wall shelf', 149000.00, 'pcs'),
(6, 4, 'EKET Storage Cube', 'Storage', 'Modular storage cube', 399000.00, 'pcs'),
(7, 4, 'POÄNG Armchair', 'Living Room', 'Comfortable armchair', 1299000.00, 'pcs'),
(8, 5, 'DOCKSTA Table', 'Dining', 'Round dining table', 2199000.00, 'pcs'),
(9, 5, 'HEMNES Wardrobe', 'Bedroom', '3-door wardrobe', 3499000.00, 'pcs'),
(10, 6, 'KALLAX Shelf Unit', 'Storage', '4x4 shelf unit', 799000.00, 'pcs'),
(11, 6, 'SKÅDIS Pegboard', 'Organizer', 'Perforated board for organization', 299000.00, 'pcs'),
(12, 7, 'VARIERA Shelf Insert', 'Storage', 'Adjustable shelf insert', 249000.00, 'pcs'),
(13, 8, 'FRIHETEN Sofa Bed', 'Living Room', 'Corner sofa bed with storage', 4999000.00, 'pcs'),
(14, 9, 'IVAR Shelf Unit', 'Storage', 'Solid wood shelf unit', 1299000.00, 'pcs'),
(15, 10, 'BEKANT Desk', 'Office', 'Office desk with adjustable legs', 1599000.00, 'pcs');

-- 10. Pastikan tabel toko sudah ada dengan data
INSERT IGNORE INTO `toko` (`id_toko`, `nama_toko`, `lokasi_toko`, `manager_toko`, `kontak_toko`) VALUES
(1, 'IKEA Alam Sutera', 'Alam Sutera, Tangerang', 'John Doe', '021-12345678'),
(2, 'IKEA Jakarta Garden City', 'Jakarta Garden City, Jakarta', 'Jane Smith', '021-87654321'),
(3, 'IKEA Sentul City', 'Sentul City, Bogor', 'Bob Wilson', '021-11223344'),
(4, 'IKEA Bali', 'Denpasar, Bali', 'Alice Brown', '0361-556677'),
(5, 'IKEA Kota Baru Parahyangan', 'Bandung, Jawa Barat', 'Charlie Davis', '022-998877'),
(6, 'IKEA Mal Taman Anggrek', 'Jakarta Barat', 'David Lee', '021-445566');
