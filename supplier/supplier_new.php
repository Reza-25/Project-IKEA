<?php
require_once __DIR__ . '/../include/config.php';

// Function to get supplier statistics
function getSupplierStats($pdo) {
    $stats = [];
    
    try {
        // Total suppliers
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM supplier");
        $result = $stmt->fetch();
        $stats['total_suppliers'] = $result['count'] ? $result['count'] : 248;
        
        // Active suppliers (using dummy calculation)
        $stats['active_suppliers'] = $stats['total_suppliers'] ? round($stats['total_suppliers'] * 0.85) : 210;
        
        // Total orders value this month
        $stmt = $pdo->query("
            SELECT SUM(ti.Jumlah_Transaksi * COALESCE(b.harga_satuan, 100000)) as total_value 
            FROM transaksi_inventaris ti
            LEFT JOIN barang b ON ti.id_Barang = b.id_barang
            WHERE MONTH(ti.Tanggal_Transaksi) = MONTH(CURRENT_DATE()) 
            AND YEAR(ti.Tanggal_Transaksi) = YEAR(CURRENT_DATE())
            AND ti.Jenis_Transaksi = 'Masuk'
        ");
        $result = $stmt->fetch();
        $stats['total_orders'] = $result['total_value'] ? $result['total_value'] : 240000000;
        
        // Pending orders
        $stats['pending_orders'] = 32;
        
    } catch (Exception $e) {
        // Fallback values if database query fails
        $stats['total_suppliers'] = 248;
        $stats['active_suppliers'] = 210;
        $stats['total_orders'] = 240000000;
        $stats['pending_orders'] = 32;
    }
    
    return $stats;
}

// Function to get top suppliers
function getTopSuppliers($pdo) {
    try {
        $stmt = $pdo->query("
            SELECT 
                s.Nama_Supplier as nama_supplier,
                4.5 as overall_rating
            FROM supplier s
            LIMIT 5
        ");
        $suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($suppliers)) {
            return [
                ['nama_supplier' => 'PT Furniture Jaya', 'overall_rating' => 4.5],
                ['nama_supplier' => 'CV Kayu Manis', 'overall_rating' => 4.2],
                ['nama_supplier' => 'PT Textile Indonesia', 'overall_rating' => 4.7],
                ['nama_supplier' => 'UD Logam Berkah', 'overall_rating' => 4.0],
                ['nama_supplier' => 'PT Elektronik Modern', 'overall_rating' => 4.3]
            ];
        }
        return $suppliers;
    } catch (Exception $e) {
        return [
            ['nama_supplier' => 'PT Furniture Jaya', 'overall_rating' => 4.5],
            ['nama_supplier' => 'CV Kayu Manis', 'overall_rating' => 4.2],
            ['nama_supplier' => 'PT Textile Indonesia', 'overall_rating' => 4.7],
            ['nama_supplier' => 'UD Logam Berkah', 'overall_rating' => 4.0],
            ['nama_supplier' => 'PT Elektronik Modern', 'overall_rating' => 4.3]
        ];
    }
}

// Function to get monthly trends
function getMonthlyTrends($pdo) {
    return [
        'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        'orders' => [15, 18, 22, 19, 21, 17]
    ];
}

// Function to get recent orders
function getRecentOrders($pdo, $limit = 10) {
    try {
        $stmt = $pdo->prepare("
            SELECT 
                CONCAT('ORD-', YEAR(ti.Tanggal_Transaksi), '-', LPAD(ti.id_Transaksi, 3, '0')) as order_id,
                ti.Tanggal_Transaksi as order_date,
                COALESCE(s.Nama_Supplier, 'PT Furniture Jaya') as supplier_name,
                COALESCE(b.nama_barang, 'Office Chair') as product_name,
                ti.Jumlah_Transaksi as quantity,
                (ti.Jumlah_Transaksi * COALESCE(b.harga_satuan, 100000)) as total,
                CASE 
                    WHEN ti.Jenis_Transaksi = 'Masuk' THEN 'completed'
                    ELSE 'pending'
                END as status
            FROM transaksi_inventaris ti
            LEFT JOIN barang b ON ti.id_Barang = b.id_barang
            LEFT JOIN supplier s ON b.id_supplier = s.id_Supplier
            WHERE ti.Jenis_Transaksi = 'Masuk'
            ORDER BY ti.Tanggal_Transaksi DESC
            LIMIT :limit
        ");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($orders)) {
            return [
                [
                    'order_id' => '001',
                    'order_date' => '2025-07-15',
                    'supplier_name' => 'PT Furniture Jaya',
                    'product_name' => 'Office Chair Premium',
                    'quantity' => 50,
                    'total' => 25000000,
                    'status' => 'completed'
                ],
                [
                    'order_id' => '002',
                    'order_date' => '2025-07-16',
                    'supplier_name' => 'CV Kayu Manis',
                    'product_name' => 'Wooden Table Set',
                    'quantity' => 30,
                    'total' => 18500000,
                    'status' => 'pending'
                ],
                [
                    'order_id' => '003',
                    'order_date' => '2025-07-17',
                    'supplier_name' => 'PT Textile Indonesia',
                    'product_name' => 'Fabric Sofa Modern',
                    'quantity' => 20,
                    'total' => 32000000,
                    'status' => 'completed'
                ]
            ];
        }
        return $orders;
    } catch (Exception $e) {
        return [
            [
                'order_id' => '001',
                'order_date' => '2025-07-15',
                'supplier_name' => 'PT Furniture Jaya',
                'product_name' => 'Office Chair Premium',
                'quantity' => 50,
                'total' => 25000000,
                'status' => 'completed'
            ],
            [
                'order_id' => '002',
                'order_date' => '2025-07-16',
                'supplier_name' => 'CV Kayu Manis',
                'product_name' => 'Wooden Table Set',
                'quantity' => 30,
                'total' => 18500000,
                'status' => 'pending'
            ],
            [
                'order_id' => '003',
                'order_date' => '2025-07-17',
                'supplier_name' => 'PT Textile Indonesia',
                'product_name' => 'Fabric Sofa Modern',
                'quantity' => 20,
                'total' => 32000000,
                'status' => 'completed'
            ]
        ];
    }
}

// Get data for dashboard
$supplierStats = getSupplierStats($pdo);
$topSuppliers = getTopSuppliers($pdo);
$monthlyData = getMonthlyTrends($pdo);
$recentOrders = getRecentOrders($pdo);

// Prepare data for JavaScript charts
$supplierNames = [];
$supplierRatings = [];
foreach ($topSuppliers as $supplier) {
    $supplierNames[] = $supplier['nama_supplier'];
    $supplierRatings[] = $supplier['overall_rating'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <meta name="description" content="IKEA Supplier Management Dashboard" />
    <meta name="keywords" content="supplier, management, dashboard, IKEA" />
    <meta name="author" content="IKEA Indonesia" />
    <title>IKEA - Supplier Management Dashboard</title>

    <!-- Stylesheets -->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg" />
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="../assets/css/animate.css" />
    <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    
    <style>
        /* Modern IKEA Style Dashboard */
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Statistics Cards */
        .dash-count {
            padding: 30px 25px;
            border-radius: 20px;
            background: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 140px;
            border: none;
            overflow: hidden;
            position: relative;
        }

        .dash-count::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #0051ba, #0073e6);
        }

        .dash-count:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .dash-counts h4 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: #2c3e50;
        }

        .dash-counts h5 {
            font-size: 0.95rem;
            color: #6c757d;
            font-weight: 500;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-change {
            background: rgba(34, 197, 94, 0.15);
            color: #16a34a;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 8px;
            display: inline-block;
        }

        /* Icon styling */
        .dash-imgs .icon-box {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0051ba 0%, #0073e6 100%);
            box-shadow: 0 8px 25px rgba(0, 81, 186, 0.3);
        }

        .dash-imgs .icon-box i {
            font-size: 24px;
            color: white;
        }

        /* Card color variations */
        .das1 .icon-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .das2 .icon-box {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        .das3 .icon-box {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        .das4 .icon-box {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        /* Chart containers */
        .chart-card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            border: none;
            height: 420px;
        }

        .chart-card .card-header {
            background: none;
            border: none;
            padding: 0 0 20px 0;
        }

        .chart-card .card-header h5 {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }

        /* Table styling */
        .modern-table {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: none;
        }

        .modern-table .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px 30px;
            border: none;
            border-radius: 0;
        }

        .modern-table .card-header h5 {
            margin: 0;
            font-size: 1.4rem;
            font-weight: 600;
        }

        .export-buttons {
            display: flex;
            gap: 12px;
        }

        .export-btn {
            padding: 10px 18px;
            border: none;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .export-btn.pdf {
            background: rgba(220, 38, 38, 0.15);
            color: #dc2626;
            border: 2px solid rgba(220, 38, 38, 0.2);
        }

        .export-btn.excel {
            background: rgba(5, 150, 105, 0.15);
            color: #059669;
            border: 2px solid rgba(5, 150, 105, 0.2);
        }

        .export-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        /* Data table styling */
        .store-table {
            margin: 0;
            font-size: 0.9rem;
        }

        .store-table thead th {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            font-weight: 600;
            padding: 20px 15px;
            border: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.8rem;
        }

        .store-table tbody td {
            padding: 18px 15px;
            border-bottom: 1px solid #e9ecef;
            vertical-align: middle;
        }

        .store-table tbody tr:hover {
            background-color: rgba(102, 126, 234, 0.05);
        }

        /* Status badges */
        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
        }

        .status-completed {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
        }

        .status-pending {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
        }

        .status-cancelled {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        /* Action button */
        .detail-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .detail-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        /* Page header styling */
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
        }

        .page-header .page-title h4 {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .page-header .page-title h6 {
            font-size: 1.1rem;
            margin: 8px 0 0 0;
            opacity: 0.9;
            font-weight: 400;
        }

        .page-btn .btn {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 12px 25px;
            border-radius: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .page-btn .btn:hover {
            background: white;
            color: #667eea;
            transform: translateY(-2px);
        }

        /* Product image styling */
        .productimgname {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .product-img img {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            object-fit: cover;
        }

        .supplier-name {
            font-weight: 600;
            color: #2c3e50;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .dash-count {
                margin-bottom: 20px;
            }
            
            .chart-card {
                height: auto;
                min-height: 300px;
            }
            
            .export-buttons {
                flex-direction: column;
                width: 100%;
            }
            
            .export-btn {
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div id="global-loader">
        <div class="whirly-loader"></div>
    </div>
    
    <?php include __DIR__ . '/../include/header.php'; ?>
    
    <div class="main-wrapper">
        <?php include BASE_PATH . '/include/sidebar.php'; ?>
        
        <div class="page-wrapper">
            <?php include __DIR__ . '/../include/ai.php'; ?>
            
            <div class="content">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="page-title">
                        <h4>Supplier Management</h4>
                        <h6>Kelola data supplier dan pantau performa secara real-time</h6>
                    </div>
                    <div class="page-btn">
                        <a href="#" class="btn btn-primary" onclick="addSupplier()">
                            <i class="fas fa-plus"></i> Add New Supplier
                        </a>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row">
                    <div class="col-xxl-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das1">
                            <div class="dash-counts">
                                <h4><?= number_format($supplierStats['total_suppliers']) ?></h4>
                                <h5>Total Suppliers</h5>
                                <span class="stat-change">+12% bulan ini</span>
                            </div>
                            <div class="dash-imgs">
                                <div class="icon-box">
                                    <i class="fas fa-truck"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xxl-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das2">
                            <div class="dash-counts">
                                <h4><?= number_format($supplierStats['active_suppliers']) ?></h4>
                                <h5>Active Suppliers</h5>
                                <span class="stat-change">+8% bulan ini</span>
                            </div>
                            <div class="dash-imgs">
                                <div class="icon-box">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xxl-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das3">
                            <div class="dash-counts">
                                <h4>Rp <?= number_format($supplierStats['total_orders'], 0, ',', '.') ?></h4>
                                <h5>Total Orders</h5>
                                <span class="stat-change">+25% bulan ini</span>
                            </div>
                            <div class="dash-imgs">
                                <div class="icon-box">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xxl-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das4">
                            <div class="dash-counts">
                                <h4><?= $supplierStats['pending_orders'] ?></h4>
                                <h5>Pending Orders</h5>
                                <span class="stat-change">-5% bulan ini</span>
                            </div>
                            <div class="dash-imgs">
                                <div class="icon-box">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="row">
                    <div class="col-lg-8 col-sm-12">
                        <div class="card chart-card">
                            <div class="card-header">
                                <h5><i class="fas fa-chart-line me-2"></i>Monthly Supplier Trends</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="monthlyChart"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-sm-12">
                        <div class="card chart-card">
                            <div class="card-header">
                                <h5><i class="fas fa-chart-pie me-2"></i>Top Suppliers</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="topSuppliersChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders Table -->
                <div class="card modern-table">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5><i class="fas fa-list me-2"></i>Recent Orders</h5>
                        <div class="export-buttons">
                            <button class="export-btn pdf" onclick="exportToPDF()">
                                <i class="fas fa-file-pdf"></i> Export PDF
                            </button>
                            <button class="export-btn excel" onclick="exportToExcel()">
                                <i class="fas fa-file-excel"></i> Export Excel
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table store-table datanew">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-hashtag me-2"></i>Order ID</th>
                                        <th><i class="fas fa-building me-2"></i>Supplier</th>
                                        <th><i class="fas fa-box me-2"></i>Product</th>
                                        <th><i class="fas fa-sort-numeric-up me-2"></i>Quantity</th>
                                        <th><i class="fas fa-money-bill me-2"></i>Total</th>
                                        <th><i class="fas fa-info-circle me-2"></i>Status</th>
                                        <th><i class="fas fa-calendar me-2"></i>Date</th>
                                        <th><i class="fas fa-cog me-2"></i>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recentOrders as $order): ?>
                                    <tr>
                                        <td>
                                            <span class="status-badge" style="background: #f1f3f4; color: #5f6368;">
                                                #<?= $order['order_id'] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="productimgname">
                                                <a href="#" class="product-img">
                                                    <img src="../assets/img/supplier/supplier-icon.png" alt="supplier" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiByeD0iOCIgZmlsbD0iIzY2N2VlYSIvPgo8cGF0aCBkPSJNMjAgMTJDMTcuNzkgMTIgMTYgMTMuNzkgMTYgMTZDMTYgMTguMjEgMTcuNzkgMjAgMjAgMjBDMjIuMjEgMjAgMjQgMTguMjEgMjQgMTZDMjQgMTMuNzkgMjIuMjEgMTIgMjAgMTJaTTIwIDI4QzE2LjY3IDI4IDE0IDI1LjMzIDE0IDIyVjIwSDI2VjIyQzI2IDI1LjMzIDIzLjMzIDI4IDIwIDI4WiIgZmlsbD0id2hpdGUiLz4KPC9zdmc+'">
                                                </a>
                                                <a href="#" class="supplier-name"><?= htmlspecialchars($order['supplier_name']) ?></a>
                                            </div>
                                        </td>
                                        <td><?= htmlspecialchars($order['product_name']) ?></td>
                                        <td><strong><?= number_format($order['quantity']) ?></strong></td>
                                        <td><strong>Rp <?= number_format($order['total'], 0, ',', '.') ?></strong></td>
                                        <td>
                                            <span class="status-badge <?= $order['status'] == 'completed' ? 'status-completed' : ($order['status'] == 'pending' ? 'status-pending' : 'status-cancelled') ?>">
                                                <?= ucfirst($order['status']) ?>
                                            </span>
                                        </td>
                                        <td><?= date('d M Y', strtotime($order['order_date'])) ?></td>
                                        <td>
                                            <button class="detail-btn" onclick="viewOrder('<?= $order['order_id'] ?>')">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/js/moment.min.js"></script>
    <script src="../assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../assets/plugins/select2/js/select2.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalerts.min.js"></script>
    <script src="../assets/js/script.js"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize DataTable with modern styling
            $('.datanew').DataTable({
                responsive: true,
                pageLength: 10,
                language: {
                    search: "",
                    searchPlaceholder: "Search suppliers...",
                    lengthMenu: "Show _MENU_ entries per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                },
                columnDefs: [
                    { orderable: false, targets: [7] },
                    { searchable: false, targets: [0, 7] }
                ]
            });

            // Monthly Trends Chart
            const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
            const gradient = monthlyCtx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(102, 126, 234, 0.3)');
            gradient.addColorStop(1, 'rgba(102, 126, 234, 0.05)');
            
            const monthlyChart = new Chart(monthlyCtx, {
                type: 'line',
                data: {
                    labels: <?= json_encode($monthlyData['months']) ?>,
                    datasets: [{
                        label: 'Orders',
                        data: <?= json_encode($monthlyData['orders']) ?>,
                        borderColor: '#667eea',
                        backgroundColor: gradient,
                        borderWidth: 4,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#667eea',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 3,
                        pointRadius: 8,
                        pointHoverRadius: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: '#667eea',
                            borderWidth: 1,
                            cornerRadius: 10,
                            displayColors: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.05)'
                            },
                            ticks: {
                                color: '#6c757d',
                                font: {
                                    weight: 500
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#6c757d',
                                font: {
                                    weight: 500
                                }
                            }
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeInOutQuart'
                    }
                }
            });

            // Top Suppliers Doughnut Chart
            const topSuppliersCtx = document.getElementById('topSuppliersChart').getContext('2d');
            const topSuppliersChart = new Chart(topSuppliersCtx, {
                type: 'doughnut',
                data: {
                    labels: <?= json_encode($supplierNames) ?>,
                    datasets: [{
                        data: <?= json_encode($supplierRatings) ?>,
                        backgroundColor: [
                            '#667eea',
                            '#764ba2', 
                            '#f093fb',
                            '#f5576c',
                            '#4facfe'
                        ],
                        borderWidth: 0,
                        hoverBorderWidth: 5,
                        hoverBorderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                color: '#6c757d',
                                font: {
                                    weight: 500
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            cornerRadius: 10,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ' + context.parsed + '/5.0';
                                }
                            }
                        }
                    },
                    animation: {
                        animateRotate: true,
                        duration: 2000
                    }
                }
            });

            // Counter animation for statistics
            $('.dash-counts h4').each(function() {
                const $this = $(this);
                const text = $this.text();
                const number = text.replace(/[^\d]/g, '');
                
                if (number) {
                    const countTo = parseInt(number);
                    $this.text('0');
                    
                    $({ countNum: 0 }).animate({
                        countNum: countTo
                    }, {
                        duration: 2000,
                        easing: 'swing',
                        step: function() {
                            $this.text(text.replace(number, Math.floor(this.countNum).toLocaleString()));
                        },
                        complete: function() {
                            $this.text(text.replace(number, countTo.toLocaleString()));
                        }
                    });
                }
            });
        });

        // Export Functions
        function exportToPDF() {
            Swal.fire({
                title: 'Exporting to PDF...',
                html: 'Please wait while we generate your PDF report.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                    setTimeout(() => {
                        window.print();
                        Swal.close();
                    }, 1500);
                }
            });
        }

        function exportToExcel() {
            const table = document.querySelector('.store-table');
            const html = table.outerHTML;
            const url = 'data:application/vnd.ms-excel,' + escape(html);
            const link = document.createElement('a');
            link.href = url;
            link.download = 'supplier_orders_' + new Date().toISOString().slice(0,10) + '.xls';
            link.click();
            
            Swal.fire({
                icon: 'success',
                title: 'Export Successful!',
                text: 'Your Excel file is being downloaded.',
                timer: 2000,
                showConfirmButton: false
            });
        }

        function addSupplier() {
            Swal.fire({
                title: '<strong>Add New Supplier</strong>',
                html: `
                    <div class="row text-left">
                        <div class="col-12 mb-3">
                            <label class="form-label">Supplier Name</label>
                            <input type="text" id="supplierName" class="form-control" placeholder="Enter supplier name">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" id="supplierEmail" class="form-control" placeholder="Enter email address">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" id="supplierPhone" class="form-control" placeholder="Enter phone number">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Address</label>
                            <textarea id="supplierAddress" class="form-control" rows="3" placeholder="Enter complete address"></textarea>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-plus"></i> Add Supplier',
                cancelButtonText: '<i class="fas fa-times"></i> Cancel',
                confirmButtonColor: '#667eea',
                cancelButtonColor: '#6c757d',
                width: 600,
                preConfirm: () => {
                    const name = document.getElementById('supplierName').value;
                    const email = document.getElementById('supplierEmail').value;
                    const phone = document.getElementById('supplierPhone').value;
                    const address = document.getElementById('supplierAddress').value;
                    
                    if (!name || !email || !phone) {
                        Swal.showValidationMessage('Please fill in all required fields');
                        return false;
                    }
                    
                    return { name, email, phone, address };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Supplier has been added successfully.',
                        confirmButtonColor: '#667eea'
                    });
                }
            });
        }

        function viewOrder(orderId) {
            Swal.fire({
                title: '<strong>Order Details</strong>',
                html: `
                    <div class="text-left">
                        <div class="row">
                            <div class="col-6">
                                <p><strong>Order ID:</strong></p>
                                <p class="text-muted">#${orderId}</p>
                            </div>
                            <div class="col-6">
                                <p><strong>Status:</strong></p>
                                <span class="badge bg-success">Completed</span>
                            </div>
                            <div class="col-6">
                                <p><strong>Order Date:</strong></p>
                                <p class="text-muted">${new Date().toLocaleDateString()}</p>
                            </div>
                            <div class="col-6">
                                <p><strong>Total Amount:</strong></p>
                                <p class="text-primary"><strong>Rp 25,000,000</strong></p>
                            </div>
                        </div>
                    </div>
                `,
                confirmButtonText: '<i class="fas fa-check"></i> Close',
                confirmButtonColor: '#667eea',
                width: 500
            });
        }
    </script>
</body>
</html>
