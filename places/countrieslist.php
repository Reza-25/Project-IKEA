<?php
require_once __DIR__ . '/../include/config.php'; // Import config.php

// 1. Ambil data toko aktif
try {
  $stmt = $pdo->query("
      SELECT id_toko, nama_toko, kode_toko, alamat, provinsi, kota, telepon AS telephone, 
             land_area, tahun_berdiri, status_toko, latitude, longitude
      FROM toko
      WHERE status = 'active'
      ORDER BY id_toko ASC
  ");
  $stores = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  error_log("Database error: " . $e->getMessage());
  $stores = [];
}

// 2. Hitung total toko dan distribusi provinsi
$totalStores = count($stores);
$provinceDistribution = [];
foreach ($stores as $store) {
  $prov = $store['provinsi'] ?: 'Unknown';
  $provinceDistribution[$prov] = ($provinceDistribution[$prov] ?? 0) + 1;
}

// 3. Warna untuk chart provinsi
$provinceColors = [
  'Banten'      => '#2196f3',
  'Jawa Barat'  => '#0d47a1',
  'DKI Jakarta' => '#64b5f6',
  'Bali'        => '#1976d2',
  'Unknown'     => '#9e9e9e'
];

// 4. Data dummy untuk kotak info (atau ambil dari DB jika tersedia)
$topSatisfactionStore = 'Surabaya';
$topStoreTraffic      = 78630;
$avgDailyVisitors     = 4200;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>IKEA - Store List</title>
    
    <!-- Same CSS includes as brandlist.php -->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    
    <!-- ApexCharts for donut chart -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
    <!-- Leaflet for maps -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        a {
            text-decoration: none !important;
        }

        .ikea-header {
            background-color: #0051BA !important;
        }

        /* Dashboard Cards CSS - Same as brandlist.php */
        .das1, .das2, .das3, .das4 {
            background: white !important;
            border-radius: 20px;
            padding: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .dash-count {
            padding: 24px;
            border-radius: 20px;
            background-color: white;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dash-count:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.2);
            background-color: #f9f9f9;
        }

        .dash-counts h4 {
            font-size: 24px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .dash-counts h5 {
            font-size: 14px;
            margin: 0;
        }

        .stat-change {
            font-size: 11px;
            font-weight: normal;
            margin-top: 4px;
            color: #6c757d;
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
            display: inline-block;
            padding: 3px 6px;
            border-radius: 12px;
            font-weight: 600;
        }

        /* Color schemes for dashboard cards */
        .das1 { border-top: 6px solid #1a5ea7; }
        .das1 * { color: #1a5ea7 !important; }
        .das2 { border-top: 6px solid #751e8d; }
        .das2 * { color: #751e8d !important; }
        .das3 { border-top: 6px solid #e78001; }
        .das3 * { color: #e78001 !important; }
        .das4 { border-top: 6px solid #018679; }
        .das4 * { color: #018679 !important; }

        /* Icon Box Style */
        .icon-box {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            box-shadow: 0 2px 6px rgba(33, 150, 243, 0.2);
            transition: box-shadow 0.2s, transform 0.2s;
            cursor: pointer;
        }

        .icon-box i {
            color: #ffffff !important;
            font-size: 16px;
        }

        .icon-box:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.18);
            transform: scale(1.08);
        }

        .bg-ungu { background: linear-gradient(135deg, #2196f3 0%, #0d47a1 100%); }
        .bg-biru { background: linear-gradient(135deg, #a259c6 0%, #6d28d9 100%); }
        .bg-hijau { background: linear-gradient(135deg, rgb(89, 236, 222) 0%, #018679 100%); }
        .bg-merah { background: linear-gradient(135deg, #ff5858 0%, #e78001 100%); }

        /* Table Section CSS - Same as brandlist.php */
        .store-table-section {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .store-table-section:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
        }

        .chart-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1976d2;
            margin: 0;
        }

        /* Table Controls */
        .table-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .search-container {
            position: relative;
            flex: 1;
            max-width: 300px;
        }

        .search-input {
            width: 100%;
            padding: 10px 40px 10px 15px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #1976d2;
            box-shadow: 0 0 0 3px rgba(25, 118, 210, 0.1);
        }

        .search-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 1rem;
        }

        .export-buttons {
            display: flex;
            gap: 10px;
        }

        .export-btn {
            padding: 8px 16px;
            border: 2px solid transparent;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .export-btn.pdf {
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
            color: white;
        }

        .export-btn.pdf:hover {
            background: linear-gradient(135deg, #b91c1c 0%, #dc2626 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }

        .export-btn.excel {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            color: white;
        }

        .export-btn.excel:hover {
            background: linear-gradient(135deg, #047857 0%, #059669 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
        }

        /* Store Table Styles */
        .store-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .store-table th {
            background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
            color: #ffffff;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 12px 10px;
            text-align: left;
            border-bottom: 2px solid #1565c0;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .store-table th:first-child {
            border-top-left-radius: 8px;
        }

        .store-table th:last-child {
            border-top-right-radius: 8px;
        }

        .store-table td {
            padding: 12px 10px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.85rem;
            color: #374151;
            vertical-align: middle;
        }

        .store-table tbody tr:hover {
            background-color: #f8fafc;
            transition: all 0.2s ease;
        }

        .store-name {
            font-weight: 600;
            color: #1e293b;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .store-name:hover {
            color: #1976d2;
            text-decoration: underline;
        }

        .store-id {
            background: #f1f5f9;
            color: #475569;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-block;
            font-family: 'Courier New', monospace;
        }

        .store-city {
            background: #f8fafc;
            color: #64748b;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-block;
            border: 1px solid #e2e8f0;
        }

        .store-area {
            font-weight: 600;
            color: #059669;
        }

        .store-phone {
            font-weight: 500;
            color: #1e293b;
        }

        .store-status {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
            text-align: center;
        }

        .status-active { 
            background: #d1fae5; 
            color: #065f46; 
        }

        .store-hours {
            font-size: 0.8rem;
            color: #6b7280;
        }

        .store-year {
            font-weight: 600;
            color: #1976d2;
        }

        /* No Results Message */
        .no-results {
            text-align: center;
            padding: 40px 20px;
            color: #64748b;
        }

        .no-results i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #cbd5e1;
        }

        .no-results h5 {
            font-size: 1.1rem;
            margin-bottom: 8px;
            color: #475569;
        }

        .no-results p {
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        /* Pagination */
        .table-pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
        }

        .pagination-info {
            font-size: 0.85rem;
            color: #64748b;
        }

        .pagination-controls {
            display: flex;
            gap: 8px;
        }

        .pagination-btn {
            padding: 6px 12px;
            border: 1px solid #d1d5db;
            background: white;
            color: #374151;
            border-radius: 6px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .pagination-btn:hover {
            background: #f3f4f6;
            border-color: #9ca3af;
        }

        .pagination-btn.active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .pagination-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Loading Animation */
        #global-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .whirly-loader {
            width: 50px;
            height: 50px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #1976d2;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .table-controls {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-container {
                max-width: 100%;
            }
            
            .export-buttons {
                justify-content: center;
            }
            
            .store-table {
                font-size: 0.75rem;
            }
            
            .store-table th,
            .store-table td {
                padding: 8px 6px;
            }

            .chart-container,
            .map-container {
                height: auto;
                min-height: 450px;
            }

            .donut-chart-wrapper {
                min-height: 200px;
            }

            #donutChart {
                height: 200px;
            }

            #map {
                height: 300px;
            }

            .chart-title {
                font-size: 1rem;
            }

            .insight-container {
                padding: 15px;
            }

            .insight-container h5 {
                font-size: 0.85rem;
            }

            .insight-container p {
                font-size: 0.8rem;
            }

            .strategic-location-container {
                padding: 15px;
            }

            .strategic-location-container h5 {
                font-size: 0.85rem;
            }

            .strategic-location-container p {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .chart-container,
            .map-container {
                min-height: 400px;
            }

            .donut-legend {
                flex-direction: column;
                align-items: center;
                gap: 8px;
            }

            .legend-item {
                font-size: 0.8rem;
            }
        }

        /* Charts and Map Section */
        .analytics-section {
            margin-bottom: 25px;
        }

        .chart-container {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            height: 520px;
            display: flex;
            flex-direction: column;
        }

        .chart-container:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
        }

        .map-container {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            height: 520px;
            display: flex;
            flex-direction: column;
        }

        .map-container:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
        }

        #map {
            height: 400px;
            border-radius: 8px;
            flex: 1;
            margin-top: 15px;
        }

        .chart-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 0;
        }

        .donut-chart-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 200px;
        }

        #donutChart {
            width: 100%;
            max-width: 200px;
            height: 200px;
        }

        /* Donut Legend */
        .donut-legend {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 12px;
            margin-top: 15px;
            padding: 10px 0;
        }

        .legend-item {
            display: flex;
            align-items: center;
            font-size: 0.85rem;
            color: #4b5563;
            font-weight: 500;
        }

        .legend-color {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            margin-right: 8px;
            flex-shrink: 0;
        }

        /* Insight Container */
        .insight-container {
            padding: 18px;
            background: linear-gradient(135deg, #f0f8ff 0%, #e6f3ff 100%);
            border-top: 1px solid rgba(25, 118, 210, 0.1);
            border-radius: 0 0 12px 12px;
            font-size: 0.85rem;
            margin-top: auto;
        }

        .insight-container h5 {
            color: #1976d2 !important;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .insight-container p {
            color: #4a5568;
            line-height: 1.5;
            margin-bottom: 0;
        }

        /* Strategic Location Container */
        .strategic-location-container {
            padding: 18px;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border-top: 1px solid rgba(59, 130, 246, 0.1);
            border-radius: 0 0 12px 12px;
            font-size: 0.85rem;
            margin-top: auto;
        }

        .strategic-location-container h5 {
            color: #3b82f6 !important;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .strategic-location-container p {
            color: #4a5568;
            line-height: 1.5;
            margin-bottom: 0;
        }

        .chart-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1976d2;
            margin: 0 0 15px 0;
            padding-bottom: 10px;
            border-bottom: 2px solid #e2e8f0;
        }

        .chart-title i {
            margin-right: 8px;
        }

        /* Modal Styles */
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 20px;
        }

        .modal-title {
            font-weight: 600;
            font-size: 1.2rem;
        }

        .modal-body {
            padding: 25px;
        }

        .store-detail-card {
            background: #f8fafc;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #1976d2;
        }

        .store-detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .store-detail-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .store-detail-label {
            font-weight: 600;
            color: #374151;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .store-detail-value {
            color: #64748b;
            font-weight: 500;
        }

        .chart-row {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .chart-item {
            flex: 1;
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .chart-item h6 {
            font-weight: 600;
            color: #1976d2;
            margin-bottom: 15px;
            text-align: center;
        }

        .rating-display {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .rating-stars {
            color: #fbbf24;
            font-size: 1.2rem;
        }

        .rating-score {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1976d2;
        }

        .visitor-stats {
            text-align: center;
        }

        .visitor-number {
            font-size: 2rem;
            font-weight: bold;
            color: #059669;
            margin-bottom: 5px;
        }

        .visitor-label {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .visitor-trend {
            color: #10b981;
            font-size: 0.8rem;
            margin-top: 5px;
        }

        /* Custom Marker Styles */
        .custom-marker {
            background: #1976d2;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .marker-popup {
            font-size: 0.9rem;
        }

        .marker-popup h6 {
            color: #1976d2;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .marker-popup p {
            margin-bottom: 5px;
            color: #374151;
        }

        .marker-popup .btn {
            font-size: 0.8rem;
            padding: 5px 10px;
            margin-top: 8px;
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
                <div class="page-header">
                    <div class="page-title">
                        <h4>STORE LOCATIONS</h4>
                        <h6>Monitor IKEA store locations across Indonesia</h6>
                    </div>
                </div>

                <!-- Dashboard Cards -->
                <div class="row justify-content-end">
                    <!-- Total Stores -->
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das1">
                            <div class="dash-counts">
                                <h4><span class="counters" data-count="7">7</span></h4>
                                <h5>Total Stores</h5>
                                <h2 class="stat-change">All stores active</h2>
                            </div>
                            <div class="icon-box bg-ungu">
                                <i class="fa fa-store"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Largest Store -->
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das2">
                            <div class="dash-counts">
                                <h4>Alam Sutera</h4>
                                <h5>Largest Store</h5>
                                <h2 class="stat-change">35,000 m² area</h2>
                            </div>
                            <div class="icon-box bg-biru">
                                <i class="fa fa-building"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Newest Store -->
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das3">
                            <div class="dash-counts">
                                <h4>IKEA Bali</h4>
                                <h5>Newest Store</h5>
                                <h2 class="stat-change">Opened in 2024</h2>
                            </div>
                            <div class="icon-box bg-merah">
                                <i class="fa fa-calendar-plus"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Total Area -->
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das4">
                            <div class="dash-counts">
                                <h4><span class="counters" data-count="132900">132,900</span></h4>
                                <h5>Total Area (m²)</h5>
                                <h2 class="stat-change">Across all stores</h2>
                            </div>
                            <div class="icon-box bg-hijau">
                                <i class="fa fa-expand-arrows-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>

                

                <!-- Analytics Section -->
                <div class="analytics-section">
                    <div class="row">
                        <!-- Donut Chart -->
                        <div class="col-lg-6 col-md-12 mb-4">
                            <div class="chart-container">
                                <h5 class="chart-title">
                                    <i class="fas fa-chart-pie"></i>
                                    Distribusi Toko per Pulau
                                </h5>
                                <div class="chart-content">
                                    <div class="donut-chart-wrapper">
                                        <div id="donutChart"></div>
                                        <div class="donut-legend" id="donutLegend"></div>
                                    </div>
                                </div>
                                <div class="insight-container">
                                    <h5><i class="fas fa-lightbulb" style="color: #fbbf24; margin-right: 8px;"></i>Key Insight</h5>
                                    <p>Pulau Jawa mendominasi dengan 71.4% dari total toko IKEA di Indonesia. Sumatera dan Bali masing-masing memiliki 14.3% yang menunjukkan potensi ekspansi ke pulau-pulau lain.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Map -->
                        <div class="col-lg-6 col-md-12 mb-4">
                            <div class="map-container">
                                <h5 class="chart-title">
                                    <i class="fas fa-map-marked-alt"></i>
                                    Lokasi Toko IKEA
                                </h5>
                                <div id="map"></div>
                                <div class="strategic-location-container">
                                    <h5><i class="fas fa-map-marked-alt" style="color: #3b82f6; margin-right: 8px;"></i>Strategic Location</h5>
                                    <p>Rekomendasi lokasi prioritas: Medan (Sumatera), Bandung (Jawa Barat), dan Makassar (Sulawesi) berdasarkan density populasi dan daya beli masyarakat.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Store Table Section -->
                <div class="store-table-section">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="chart-title"><i class="fas fa-table me-2"></i>Data Toko IKEA Indonesia</h5>
                        <div class="d-flex align-items-center gap-2">
                            <span style="font-size: 0.8rem; color: #64748b;" id="totalStoresText">Total: 7 stores</span>
                        </div>
                    </div>
                    
                    <!-- Table Controls -->
                    <div class="table-controls">
                        <div class="search-container">
                            <input type="text" class="search-input" id="searchInput" placeholder="Cari nama toko, kota, atau provinsi...">
                            <i class="fas fa-search search-icon"></i>
                        </div>
                        <div class="export-buttons">
                            <button class="export-btn pdf" onclick="exportToPDF()">
                                <i class="fas fa-file-pdf"></i>
                                Export PDF
                            </button>
                            <button class="export-btn excel" onclick="exportToExcel()">
                                <i class="fas fa-file-excel"></i>
                                Export Excel
                            </button>
                        </div>
                    </div>
                    
                    <table class="store-table" id="storeTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Store ID</th>
                                <th>Nama Toko</th>
                                <th>Kota</th>
                                <th>Provinsi</th>
                                <th>Telepon</th>
                                <th>Jam Operasional</th>
                                <th>Tahun Dibuka</th>
                                <th>Luas Toko (m²)</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="storeTableBody">
                            <!-- Data akan diisi oleh JavaScript -->
                        </tbody>
                    </table>
                    
                    <!-- No Results Message -->
                    <div class="no-results" id="noResults" style="display: none;">
                        <i class="fas fa-search"></i>
                        <h5>Tidak ada data yang ditemukan</h5>
                        <p>Coba ubah kata kunci pencarian Anda</p>
                    </div>
                    
                    <div class="table-pagination" id="tablePagination">
                        <div class="pagination-info" id="paginationInfo">
                            Menampilkan 1-7 dari 7 toko
                        </div>
                        <div class="pagination-controls">
                            <button class="pagination-btn" id="prevBtn" onclick="changePage(-1)">
                                <i class="fas fa-chevron-left"></i> Prev
                            </button>
                            <button class="pagination-btn active" id="page1Btn" onclick="goToPage(1)">1</button>
                            <button class="pagination-btn" id="nextBtn" onclick="changePage(1)">
                                Next <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Store Detail Modal -->
    <div class="modal fade" id="storeDetailModal" tabindex="-1" aria-labelledby="storeDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="storeDetailModalLabel">
                        <i class="fas fa-store me-2"></i>
                        Detail Toko IKEA
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="store-detail-card">
                        <div class="store-detail-item">
                            <div class="store-detail-label">
                                <i class="fas fa-tag"></i>
                                Store ID
                            </div>
                            <div class="store-detail-value" id="modalStoreId">-</div>
                        </div>
                        <div class="store-detail-item">
                            <div class="store-detail-label">
                                <i class="fas fa-map-marker-alt"></i>
                                Alamat Lengkap
                            </div>
                            <div class="store-detail-value" id="modalStoreAddress">-</div>
                        </div>
                        <div class="store-detail-item">
                            <div class="store-detail-label">
                                <i class="fas fa-phone"></i>
                                Telepon
                            </div>
                            <div class="store-detail-value" id="modalStorePhone">-</div>
                        </div>
                        <div class="store-detail-item">
                            <div class="store-detail-label">
                                <i class="fas fa-clock"></i>
                                Jam Operasional
                            </div>
                            <div class="store-detail-value" id="modalStoreHours">-</div>
                        </div>
                        <div class="store-detail-item">
                            <div class="store-detail-label">
                                <i class="fas fa-calendar-alt"></i>
                                Tahun Dibuka
                            </div>
                            <div class="store-detail-value" id="modalStoreYear">-</div>
                        </div>
                        <div class="store-detail-item">
                            <div class="store-detail-label">
                                <i class="fas fa-expand-arrows-alt"></i>
                                Luas Toko
                            </div>
                            <div class="store-detail-value" id="modalStoreArea">-</div>
                        </div>
                    </div>

                    <div class="chart-row">
                        <div class="chart-item">
                            <h6><i class="fas fa-star me-2"></i>Rating Toko</h6>
                            <div class="rating-display">
                                <div class="rating-stars" id="modalRatingStars">
                                    ★★★★★
                                </div>
                                <div class="rating-score" id="modalRatingScore">4.5</div>
                            </div>
                            <div style="text-align: center; color: #6b7280; font-size: 0.8rem;">
                                Berdasarkan <span id="modalRatingCount">1,234</span> ulasan
                            </div>
                        </div>
                        <div class="chart-item">
                            <h6><i class="fas fa-users me-2"></i>Pengunjung Bulanan</h6>
                            <div class="visitor-stats">
                                <div class="visitor-number" id="modalVisitorCount">45,678</div>
                                <div class="visitor-label">Pengunjung/bulan</div>
                                <div class="visitor-trend">
                                    <i class="fas fa-arrow-up me-1"></i>+12% dari bulan lalu
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Store Data
        const storeData = [
            {
                id: "IK-JKT01",
                name: "IKEA Alam Sutera",
                address: "Jl. Jalur Sutera Boulevard No.45, Alam Sutera, Tangerang",
                city: "Tangerang",
                province: "Banten",
                phone: "(021) 2985 3900",
                hours: "10.00 – 21.00 WIB",
                year: 2014,
                area: 35000,
                status: "active",
                island: "Jawa",
                coordinates: [-6.2088, 106.6453], // Tangerang coordinates
                rating: 4.5,
                ratingCount: 1234,
                monthlyVisitors: 45678
            },
            {
                id: "IK-JKT02",
                name: "IKEA Jakarta Garden",
                address: "Jl. Boulevard Barat Raya, Kelapa Gading, Jakarta Utara",
                city: "Jakarta Utara",
                province: "DKI Jakarta",
                phone: "(021) 2948 9999",
                hours: "10.00 – 21.00 WIB",
                year: 2021,
                area: 9400,
                status: "active",
                island: "Jawa",
                coordinates: [-6.1745, 106.8227], // Jakarta Utara coordinates
                rating: 4.3,
                ratingCount: 987,
                monthlyVisitors: 38945
            },
            {
                id: "IK-BDG01",
                name: "IKEA Kota Baru Parahyangan",
                address: "Jl. Parahyangan Raya, Padalarang, Bandung Barat",
                city: "Bandung Barat",
                province: "Jawa Barat",
                phone: "(022) 8888 1122",
                hours: "10.00 – 21.00 WIB",
                year: 2021,
                area: 15000,
                status: "active",
                island: "Jawa",
                coordinates: [-6.8957, 107.4791], // Bandung Barat coordinates
                rating: 4.2,
                ratingCount: 756,
                monthlyVisitors: 28543
            },
            {
                id: "IK-SBY01",
                name: "IKEA Surabaya",
                address: "Jl. Ahmad Yani No.160, Margorejo, Surabaya",
                city: "Surabaya",
                province: "Jawa Timur",
                phone: "(031) 3003 2000",
                hours: "10.00 – 21.00 WIB",
                year: 2021,
                area: 14000,
                status: "active",
                island: "Jawa",
                coordinates: [-7.2575, 112.7521], // Surabaya coordinates
                rating: 4.4,
                ratingCount: 892,
                monthlyVisitors: 32156
            },
            {
                id: "IK-BKS01",
                name: "IKEA Sentul City",
                address: "Jl. MH Thamrin, Sentul, Babakan Madang, Bogor",
                city: "Bogor",
                province: "Jawa Barat",
                phone: "(021) 5088 2200",
                hours: "10.00 – 21.00 WIB",
                year: 2020,
                area: 17000,
                status: "active",
                island: "Jawa",
                coordinates: [-6.5956, 106.8584], // Bogor coordinates
                rating: 4.6,
                ratingCount: 1456,
                monthlyVisitors: 41234
            },
            {
                id: "IK-MDN01",
                name: "IKEA Medan",
                address: "Jl. Gatot Subroto No. 209, Medan Helvetia",
                city: "Medan",
                province: "Sumatera Utara",
                phone: "(061) 8888 7700",
                hours: "10.00 – 21.00 WIB",
                year: 2023,
                area: 12500,
                status: "active",
                island: "Sumatera",
                coordinates: [3.5952, 98.6722], // Medan coordinates
                rating: 4.1,
                ratingCount: 634,
                monthlyVisitors: 23789
            },
            {
                id: "IK-BALI1",
                name: "IKEA Bali",
                address: "Sunset Road No. 888, Kuta, Badung",
                city: "Badung",
                province: "Bali",
                phone: "(0361) 9090 888",
                hours: "10.00 – 21.00 WITA",
                year: 2024,
                area: 10000,
                status: "active",
                island: "Bali",
                coordinates: [-8.6405, 115.1584], // Bali coordinates
                rating: 4.7,
                ratingCount: 1876,
                monthlyVisitors: 56789
            }
        ];

        // Pagination and search variables
        let currentPage = 1;
        let itemsPerPage = 7;
        let filteredData = [...storeData];
        let searchQuery = '';
        let map, donutChart;

        // Donut Chart Data
        const donutChartData = {
            labels: ["Jawa", "Sumatera", "Bali"],
            series: [71.4, 14.3, 14.3], // persentase berdasarkan data toko
            colors: ['#1976d2', '#42a5f5', '#64b5f6'] // Warna biru konsisten dengan brandlist.php
        };

        // Initialize maps and charts
        function initializeMapsAndCharts() {
            initializeMap();
            initializeDonutChart();
        }

        // Initialize Donut Chart
        function initializeDonutChart() {
            const options = {
                series: donutChartData.series,
                chart: {
                    type: 'donut',
                    height: 200,
                    width: 200,
                },
                labels: donutChartData.labels,
                colors: donutChartData.colors,
                responsive: [{
                    breakpoint: 768,
                    options: {
                        chart: {
                            width: 180,
                            height: 180
                        }
                    }
                }],
                legend: {
                    show: false
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '60%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total Toko',
                                    color: '#1976d2',
                                    fontSize: '14px',
                                    fontWeight: 600,
                                    formatter: function (w) {
                                        return '7 Toko'
                                    }
                                }
                            }
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val, opts) {
                        return val.toFixed(1) + '%';
                    },
                    style: {
                        fontSize: '12px',
                        fontWeight: '600'
                    },
                    dropShadow: {
                        enabled: false
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + '%'
                        }
                    }
                }
            };

            if (donutChart) {
                donutChart.destroy();
            }

            donutChart = new ApexCharts(document.querySelector("#donutChart"), options);
            donutChart.render();

            // Buat custom legend setelah chart di-render
            createDonutLegend();
        }

        // Membuat custom legend untuk donut chart
        function createDonutLegend() {
            const legendContainer = document.getElementById('donutLegend');
            legendContainer.innerHTML = '';

            donutChartData.labels.forEach((label, index) => {
                const legendItem = document.createElement('div');
                legendItem.className = 'legend-item';

                const colorBox = document.createElement('div');
                colorBox.className = 'legend-color';
                colorBox.style.backgroundColor = donutChartData.colors[index];

                const labelText = document.createElement('span');
                labelText.textContent = `${label} (${donutChartData.series[index]}%)`;

                legendItem.appendChild(colorBox);
                legendItem.appendChild(labelText);
                legendContainer.appendChild(legendItem);
            });
        }

        // Initialize Leaflet Map
        function initializeMap() {
            // Initialize map centered on Indonesia
            map = L.map('map').setView([-2.5489, 118.0149], 5);

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Add markers for each store
            storeData.forEach(store => {
                const marker = L.marker(store.coordinates).addTo(map);
                
                // Create popup content
                const popupContent = `
                    <div class="marker-popup">
                        <h6>${store.name}</h6>
                        <p><strong>Kota:</strong> ${store.city}</p>
                        <p><strong>Provinsi:</strong> ${store.province}</p>
                        <p><strong>Telepon:</strong> ${store.phone}</p>
                        <p><strong>Tahun:</strong> ${store.year}</p>
                        <button class="btn btn-primary btn-sm" onclick="showStoreDetail('${store.id}')">
                            <i class="fas fa-info-circle me-1"></i>Detail
                        </button>
                    </div>
                `;
                
                marker.bindPopup(popupContent);
            });
        }

        // Show store detail modal
        function showStoreDetail(storeId) {
            const store = storeData.find(s => s.id === storeId);
            if (!store) return;

            // Fill modal data
            document.getElementById('modalStoreId').textContent = store.id;
            document.getElementById('modalStoreAddress').textContent = store.address;
            document.getElementById('modalStorePhone').textContent = store.phone;
            document.getElementById('modalStoreHours').textContent = store.hours;
            document.getElementById('modalStoreYear').textContent = store.year;
            document.getElementById('modalStoreArea').textContent = formatNumber(store.area) + ' m²';
            
            // Rating display
            const fullStars = Math.floor(store.rating);
            const hasHalfStar = store.rating % 1 !== 0;
            let starsHtml = '';
            
            for (let i = 0; i < fullStars; i++) {
                starsHtml += '★';
            }
            if (hasHalfStar) {
                starsHtml += '☆';
            }
            for (let i = fullStars + (hasHalfStar ? 1 : 0); i < 5; i++) {
                starsHtml += '☆';
            }
            
            document.getElementById('modalRatingStars').innerHTML = starsHtml;
            document.getElementById('modalRatingScore').textContent = store.rating.toFixed(1);
            document.getElementById('modalRatingCount').textContent = formatNumber(store.ratingCount);
            
            // Visitor stats
            document.getElementById('modalVisitorCount').textContent = formatNumber(store.monthlyVisitors);
            
            // Update modal title
            document.getElementById('storeDetailModalLabel').innerHTML = `
                <i class="fas fa-store me-2"></i>
                ${store.name}
            `;

            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('storeDetailModal'));
            modal.show();
        }

        // Format number with thousand separators
        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        // Search functionality
        function performSearch(query) {
            searchQuery = query.toLowerCase();
            
            if (searchQuery === '') {
                filteredData = [...storeData];
            } else {
                filteredData = storeData.filter(store => 
                    store.name.toLowerCase().includes(searchQuery) ||
                    store.city.toLowerCase().includes(searchQuery) ||
                    store.province.toLowerCase().includes(searchQuery) ||
                    store.id.toLowerCase().includes(searchQuery)
                );
            }
            
            currentPage = 1;
            renderStoreTable(currentPage);
            updateTotalStoresText();
        }

        // Update total stores text
        function updateTotalStoresText() {
            const totalText = document.getElementById('totalStoresText');
            if (searchQuery === '') {
                totalText.textContent = `Total: ${storeData.length} stores`;
            } else {
                totalText.textContent = `Ditemukan: ${filteredData.length} dari ${storeData.length} stores`;
            }
        }

        // Export to PDF function
        function exportToPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF('landscape');
            
            // Add title
            doc.setFontSize(16);
            doc.text('Data Toko IKEA Indonesia', 14, 22);
            
            // Add export date
            doc.setFontSize(10);
            doc.text(`Exported on: ${new Date().toLocaleDateString('id-ID')}`, 14, 30);
            
            // Prepare table data
            const tableData = filteredData.map((store, index) => [
                index + 1,
                store.id,
                store.name,
                store.city,
                store.province,
                store.phone,
                store.hours,
                store.year,
                formatNumber(store.area),
                'Aktif'
            ]);
            
            // Add table
            doc.autoTable({
                head: [['No', 'Store ID', 'Nama Toko', 'Kota', 'Provinsi', 'Telepon', 'Jam Operasional', 'Tahun', 'Luas (m²)', 'Status']],
                body: tableData,
                startY: 35,
                styles: {
                    fontSize: 8,
                    cellPadding: 2
                },
                headStyles: {
                    fillColor: [25, 118, 210],
                    textColor: 255
                }
            });
            
            // Save the PDF
            doc.save('data-toko-ikea.pdf');
        }

        // Export to Excel function
        function exportToExcel() {
            // Prepare data for Excel
            const excelData = filteredData.map((store, index) => ({
                'No': index + 1,
                'Store ID': store.id,
                'Nama Toko': store.name,
                'Alamat Lengkap': store.address,
                'Kota': store.city,
                'Provinsi': store.province,
                'Telepon': store.phone,
                'Jam Operasional': store.hours,
                'Tahun Dibuka': store.year,
                'Luas Toko (m²)': store.area,
                'Status': 'Aktif'
            }));
            
            // Create workbook and worksheet
            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.json_to_sheet(excelData);
            
            // Add worksheet to workbook
            XLSX.utils.book_append_sheet(wb, ws, 'Data Toko IKEA');
            
            // Save the Excel file
            XLSX.writeFile(wb, 'data-toko-ikea.xlsx');
        }

        // Render Store Table
        function renderStoreTable(page = 1) {
            const startIndex = (page - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const pageData = filteredData.slice(startIndex, endIndex);

            const tableBody = document.getElementById('storeTableBody');
            const noResults = document.getElementById('noResults');
            const tablePagination = document.getElementById('tablePagination');
            
            if (filteredData.length === 0) {
                tableBody.innerHTML = '';
                noResults.style.display = 'block';
                tablePagination.style.display = 'none';
                return;
            } else {
                noResults.style.display = 'none';
                tablePagination.style.display = 'flex';
            }

            tableBody.innerHTML = '';

            pageData.forEach((store, index) => {
                const row = document.createElement('tr');
                const rowNumber = startIndex + index + 1;
                
                row.innerHTML = `
                    <td style="color: #374151; font-weight: 600;">${rowNumber}</td>
                    <td><span class="store-id">${store.id}</span></td>
                    <td>
                        <span class="store-name" style="cursor: pointer;" onclick="showStoreDetail('${store.id}')">
                            ${store.name}
                        </span>
                    </td>
                    <td><span class="store-city">${store.city}</span></td>
                    <td style="color: #6b7280;">${store.province}</td>
                    <td><span class="store-phone">${store.phone}</span></td>
                    <td><span class="store-hours">${store.hours}</span></td>
                    <td><span class="store-year">${store.year}</span></td>
                    <td><span class="store-area">${formatNumber(store.area)}</span></td>
                    <td><span class="store-status status-active">Aktif</span></td>
                `;
                
                tableBody.appendChild(row);
            });

            // Update pagination info
            const totalItems = filteredData.length;
            const startItem = startIndex + 1;
            const endItem = Math.min(endIndex, totalItems);
            document.getElementById('paginationInfo').textContent = 
                `Menampilkan ${startItem}-${endItem} dari ${totalItems} toko`;

            // Update pagination buttons
            updatePaginationButtons(page);
        }

        // Update Pagination Buttons
        function updatePaginationButtons(page) {
            const totalPages = Math.ceil(filteredData.length / itemsPerPage);
            
            document.getElementById('prevBtn').disabled = page === 1;
            document.getElementById('nextBtn').disabled = page === totalPages || totalPages === 0;

            // Update page buttons
            document.getElementById('page1Btn').classList.toggle('active', page === 1);
        }

        // Change Page Function
        function changePage(direction) {
            const totalPages = Math.ceil(filteredData.length / itemsPerPage);
            const newPage = currentPage + direction;
            if (newPage >= 1 && newPage <= totalPages) {
                currentPage = newPage;
                renderStoreTable(currentPage);
            }
        }

        // Go to Specific Page
        function goToPage(page) {
            const totalPages = Math.ceil(filteredData.length / itemsPerPage);
            if (page >= 1 && page <= totalPages) {
                currentPage = page;
                renderStoreTable(currentPage);
            }
        }

        // Search input event listener
        document.getElementById('searchInput').addEventListener('input', function() {
            performSearch(this.value);
        });

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Hide loader
            setTimeout(function() {
                document.getElementById('global-loader').style.display = 'none';
            }, 1000);

            renderStoreTable(1);
            updateTotalStoresText();
            initializeMapsAndCharts();
        });
    </script>

    <!-- Include same JS files as brandlist.php -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/feather.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/moment.min.js"></script>
    <script src="../assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../assets/plugins/select2/js/select2.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalerts.min.js"></script>
    <script src="../assets/js/script.js"></script>

    
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
      // Data toko per provinsi dari PHP
      const provinceData = <?php echo json_encode(array_map(function($count, $prov) use ($provinceColors) {
      return ['count'=>$count, 'color'=>$provinceColors[$prov] ?? '#9e9e9e'];
    }, $provinceDistribution, array_keys($provinceDistribution))); ?>;
      
      // Data toko lengkap untuk modal detail
      const storeDetailData = {
      <?php foreach ($stores as $i => $store): ?>
        <?php $idx = $i+1; ?>
        <?= $idx ?>: {
          name:       <?= json_encode($store['nama_toko']) ?>,
          id:         <?= json_encode($store['kode_toko'] ?: 'N/A') ?>,
          address:    <?= json_encode($store['alamat']) ?>,
          city:       <?= json_encode($store['kota'] ?: 'Unknown') ?>,
          telephone:  <?= json_encode($store['telephone'] ?: 'N/A') ?>,
          landArea:   <?= json_encode($store['land_area'] ?: 'N/A') ?>,
          establish:  <?= json_encode($store['tahun_berdiri'] ?: 'N/A') ?>,
          status:     <?= json_encode($store['status_toko'] ?: 'Open') ?>,
          province:   <?= json_encode($store['provinsi'] ?: 'Unknown') ?>,
          lat:        <?= $store['latitude'] ?: -6.2241 ?>,
          lng:        <?= $store['longitude'] ?: 106.6583 ?>
        },
      <?php endforeach; ?>,
    };

      // Inisialisasi chart
      const ctx = document.getElementById('provinceChart').getContext('2d');
      const provinceChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: Object.keys(provinceData),
          datasets: [{
            data: Object.values(provinceData).map(p => p.count),
            backgroundColor: Object.values(provinceData).map(p => p.color),
            borderWidth: 0,
            hoverOffset: 15
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          cutout: '65%',
          plugins: {
            legend: {
              position: 'bottom',
              labels: {
                font: {
                  size: 11
                },
                padding: 15,
                generateLabels: function(chart) {
                  const data = chart.data;
                  if (data.labels.length && data.datasets.length) {
                    return data.labels.map((label, i) => {
                      const meta = chart.getDatasetMeta(0);
                      const style = meta.controller.getStyle(i);
                      
                      return {
                        text: `${label} (${data.datasets[0].data[i]})`,
                        fillStyle: style.backgroundColor,
                        strokeStyle: style.borderColor,
                        lineWidth: style.borderWidth,
                        hidden: false,
                        index: i
                      };
                    });
                  }
                  return [];
                }
              }
            },
            tooltip: {
              callbacks: {
                label: function(context) {
                  const label = context.label || '';
                  const value = context.raw || 0;
                  return `${label}: ${value} store${value > 1 ? 's' : ''}`;
                }
              }
            }
          },
          animation: {
            animateRotate: true,
            animateScale: true,
            duration: 2000,
            easing: 'easeInOutQuart'
          }
        }
      });
      
      // Interaksi hover pada chart
      const chartHoverInfo = $('#chartHoverInfo');
      const chartCanvas = $('#provinceChart');
      
      chartCanvas.on('mousemove', function(e) {
        const points = provinceChart.getElementsAtEventForMode(e, 'nearest', { intersect: true }, true);
        
        if (points.length) {
          const index = points[0].index;
          const province = provinceChart.data.labels[index];
          const count = provinceChart.data.datasets[0].data[index];
          
          chartHoverInfo.html(`
            <div class="chart-hover-title">${province}</div>
            <div class="chart-hover-stores">${count} Store${count > 1 ? 's' : ''}</div>
          `);
          
          chartHoverInfo.css({
            left: e.pageX + 15,
            top: e.pageY + 15,
            opacity: 1
          });
          
          // Highlight toko di tabel dan peta
          $(`tr[data-province="${province}"]`).addClass('highlight-row');
        } else {
          chartHoverInfo.css('opacity', 0);
          $('tr.highlight-row').removeClass('highlight-row');
        }
      });
      
      chartCanvas.on('mouseleave', function() {
        chartHoverInfo.css('opacity', 0);
        $('tr.highlight-row').removeClass('highlight-row');
      });
      
      // Inisialisasi peta
      const storeMap = L.map('store-map').setView([-6.1754, 106.8272], 5);
      
      // Tambahkan tile layer (peta dasar)
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);
      
      // Simpan semua marker dalam array
      const markers = [];
      
      // Buat marker untuk setiap toko
      $('table.datanew tbody tr').each(function() {
        const id = $(this).data('id');
        const lat = $(this).data('lat');
        const lng = $(this).data('lng');
        const province = $(this).data('province');
        const storeName = $(this).find('td:eq(2)').text();
        const address = $(this).find('td:eq(3)').text();
        const status = storeDetailData[id].status === 'Open' ? 'open' : 'progress';
        const provinceColor = provinceData[province]?.color || '#9e9e9e';
        
        // Buat marker custom
        const marker = L.marker([lat, lng], {
          icon: L.divIcon({
            className: 'custom-marker',
            html: `<div class="store-marker" data-id="${id}" style="background-color: ${provinceColor};"></div>`,
            iconSize: [24, 24],
            iconAnchor: [12, 24]
          })
        }).addTo(map);
        
        // Tambahkan popup
        marker.bindPopup(`
          <div class="p-2">
            <h6>${storeName}</h6>
            <p class="mb-1">${address}</p>
            <div class="d-flex justify-content-between">
              <span class="badge ${status === 'open' ? 'bg-lightgreen' : 'bg-lightred'}">
                ${status === 'open' ? 'Open' : 'In Progress'}
              </span>
              <span class="badge" style="background: ${provinceColor}">${province}</span>
            </div>
          </div>
        `);
        
        // Simpan marker
        markers.push({
          id: id,
          marker: marker,
          element: this
        });
        
        // Event untuk marker
        marker.on('mouseover', function() {
          $(this.getElement()).find('.store-marker').addClass('highlight');
          const id = $(this.getElement()).find('.store-marker').data('id');
          $(`tr[data-id="${id}"]`).addClass('highlight-row');
        });
        
        marker.on('mouseout', function() {
          $(this.getElement()).find('.store-marker').removeClass('highlight');
          const id = $(this.getElement()).find('.store-marker').data('id');
          $(`tr[data-id="${id}"]`).removeClass('highlight-row');
        });
        
        marker.on('click', function() {
          map.setView([lat, lng], 13);
        });
      });
      
      // Event untuk baris tabel
      $('table.datanew tbody tr').hover(
        function() {
          const id = $(this).data('id');
          $(this).addClass('highlight-row');
          
          // Highlight marker yang sesuai
          markers.forEach(m => {
            if (m.id === id) {
              $(m.marker.getElement()).find('.store-marker').addClass('highlight');
              map.setView(m.marker.getLatLng(), 13);
            }
          });
        },
        function() {
          const id = $(this).data('id');
          $(this).removeClass('highlight-row');
          
          // Unhighlight marker
          markers.forEach(m => {
            if (m.id === id) {
              $(m.marker.getElement()).find('.store-marker').removeClass('highlight');
            }
          });
        }
      );
      
      // Fungsi untuk menampilkan detail toko di modal
      function showStoreDetail(storeId) {
        const store = storeDetailData[storeId];
        
        // Update modal content
        document.getElementById('detail-store-name').textContent = store.name;
        document.getElementById('detail-store-id').textContent = store.id;
        document.getElementById('detail-store-address').textContent = store.address;
        document.getElementById('detail-city').textContent = store.city;
        document.getElementById('detail-telephone').textContent = store.telephone;
        document.getElementById('detail-land-area').textContent = store.landArea;
        document.getElementById('detail-establish').textContent = store.establish;
        document.getElementById('detail-status').innerHTML = 
          store.status === 'Open' ? 
          '<span class="status-badge status-active">Open</span>' : 
          '<span class="status-badge status-inprogress">In Progress</span>';
        document.getElementById('detail-province').textContent = store.province;
        
        // Create mini map preview
        const mapPreviewDiv = document.getElementById('map-preview');
        mapPreviewDiv.innerHTML = '<div id="mini-map" style="height: 100%; width: 100%;"></div>';
        
        // Initialize mini map
        const miniMap = L.map('mini-map').setView([store.lat, store.lng], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(miniMap);
        
        // Add marker to mini map
        const provinceColor = provinceData[store.province]?.color || '#9e9e9e';
        const customIcon = L.divIcon({
          className: 'custom-marker',
          html: `<div class="store-marker" style="background-color: ${provinceColor};"></div>`,
          iconSize: [24, 24],
          iconAnchor: [12, 24]
        });
        
        L.marker([store.lat, store.lng], {icon: customIcon}).addTo(miniMap)
          .bindPopup(`<b>${store.name}</b><br>${store.address}`)
          .openPopup();
        
        // Show the modal
        const modal = new bootstrap.Modal(document.getElementById('storeDetailModal'));
        modal.show();
      }
    </script>
  </body>
=======
</body>
>>>>>>> 365fc33c49903f487fc9dfa987f5c179bac0dd0c
</html>