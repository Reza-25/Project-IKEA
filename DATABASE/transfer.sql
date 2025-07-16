-- Drop tables in reverse order to avoid dependency issues
DROP TABLE IF EXISTS `transfer_analytics`;
DROP TABLE IF EXISTS `transfer_tracking`;
DROP TABLE IF EXISTS `transfer_items`;
DROP TABLE IF EXISTS `transfer_requests`;

-- 1. Make sure parent tables exist first (toko, users, barang should already exist)
-- Check if they exist, if not create them:
CREATE TABLE IF NOT EXISTS `toko` (
  `id_toko` int(11) NOT NULL AUTO_INCREMENT,
  `nama_toko` varchar(100) NOT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `manager_toko` varchar(100) DEFAULT NULL,
  `kontak_toko` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_toko`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 2. Create transfer_requests first as it's referenced by other tables
CREATE TABLE `transfer_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transfer_code` varchar(20) NOT NULL UNIQUE,
  `from_store_id` int(11) NOT NULL,
  `to_store_id` int(11) NOT NULL,
  `request_date` datetime NOT NULL DEFAULT current_timestamp(),
  `expected_date` datetime NULL,
  `actual_date` datetime NULL,
  `status` enum('Pending','In Progress','Completed','Cancelled') DEFAULT 'Pending',
  `priority` enum('Low','Medium','High','Urgent') DEFAULT 'Medium',
  `total_value` decimal(15,2) DEFAULT 0.00,
  `notes` text NULL,
  `created_by` int(11) NULL,
  `approved_by` int(11) NULL,
  `completed_by` int(11) NULL,
  PRIMARY KEY (`id`),
  KEY `from_store_id` (`from_store_id`),
  KEY `to_store_id` (`to_store_id`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `fk_transfer_from_store` FOREIGN KEY (`from_store_id`) 
    REFERENCES `toko` (`id_toko`) ON UPDATE CASCADE,
  CONSTRAINT `fk_transfer_to_store` FOREIGN KEY (`to_store_id`) 
    REFERENCES `toko` (`id_toko`) ON UPDATE CASCADE,
  CONSTRAINT `fk_transfer_creator` FOREIGN KEY (`created_by`) 
    REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 3. Create transfer_items which depends on transfer_requests
CREATE TABLE `transfer_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transfer_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity_requested` int(11) NOT NULL,
  `quantity_sent` int(11) DEFAULT 0,
  `quantity_received` int(11) DEFAULT 0,
  `unit_price` decimal(12,2) NOT NULL,
  `total_price` decimal(15,2) GENERATED ALWAYS AS (`quantity_requested` * `unit_price`) STORED,
  `condition_notes` text NULL,
  PRIMARY KEY (`id`),
  KEY `transfer_id` (`transfer_id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `fk_transfer_items_request` FOREIGN KEY (`transfer_id`) 
    REFERENCES `transfer_requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_transfer_items_barang` FOREIGN KEY (`item_id`) 
    REFERENCES `barang` (`id_barang`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 4. Create transfer_tracking which depends on transfer_requests
CREATE TABLE `transfer_tracking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transfer_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` int(11) NULL,
  PRIMARY KEY (`id`),
  KEY `transfer_id` (`transfer_id`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `fk_tracking_request` FOREIGN KEY (`transfer_id`) 
    REFERENCES `transfer_requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tracking_creator` FOREIGN KEY (`created_by`) 
    REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 5. Buat tabel transfer_analytics (untuk analytics dashboard)
CREATE TABLE `transfer_analytics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `total_transfers_out` int(11) DEFAULT 0,
  `total_transfers_in` int(11) DEFAULT 0,
  `total_value_out` decimal(15,2) DEFAULT 0.00,
  `total_value_in` decimal(15,2) DEFAULT 0.00,
  `avg_processing_time` decimal(5,2) DEFAULT 0.00,
  `success_rate` decimal(5,2) DEFAULT 0.00,
  `updated_at` timestamp DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `store_month_year` (`store_id`, `month`, `year`),
  KEY `store_id` (`store_id`),
  FOREIGN KEY (`store_id`) REFERENCES `toko` (`id_toko`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
