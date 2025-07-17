<?php
require_once __DIR__ . '/../include/config.php'; // Import config.php

// Hitung statistik
$stats = [];
$stats['total_warehouses'] = $pdo->query("SELECT COUNT(*) FROM warehouses")->fetchColumn();
$stats['utilization_rate'] = 78; // Dummy data, asumsikan 78%
$stats['inventory_turnover'] = "4.2x/month"; // Dummy data
$stats['total_land_area'] = $pdo->query("SELECT SUM(land_area) FROM warehouses")->fetchColumn();

// Ambil data untuk pie chart
$warehouseTypes = $pdo->query("SELECT type, COUNT(*) as count FROM warehouses GROUP BY type")->fetchAll(PDO::FETCH_ASSOC);

// Mapping warna untuk tipe gudang
$typeColors = [
    'Distribution & Storage' => '#3498db',
    'Fullfilment Center' => '#1e3a8a',
    'Transit & Sorting' => '#f1c40f',
    'Regional Distribution' => '#e74c3c'
];

// Ambil semua data gudang
$warehouses = $pdo->query("SELECT * FROM warehouses")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>IKEA - Inventory Locations</title>
    
    <!-- Same CSS includes as countrieslist.php -->
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

        /* Dashboard Cards CSS - Same as countrieslist.php */
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

        /* Analytics Section CSS */
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

        #warehouse-map {
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

        #warehouseTypeChart {
            width: 100%;
            max-width: 200px;
            height: 200px;
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

        /* Table Section CSS */
        .warehouse-table-section {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .warehouse-table-section:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
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

        /* Warehouse Table Styles */
        .warehouse-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .warehouse-table th {
            background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
            color: #ffffff;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 12px 10px;
            text-align: left;
            border-bottom: 2px solid #1565c0;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .warehouse-table th:first-child {
            border-top-left-radius: 8px;
        }

        .warehouse-table th:last-child {
            border-top-right-radius: 8px;
        }

        .warehouse-table td {
            padding: 12px 10px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.85rem;
            color: #374151;
            vertical-align: middle;
        }

        .warehouse-table tbody tr:hover {
            background-color: #f8fafc;
            transition: all 0.2s ease;
        }

        .warehouse-name {
            font-weight: 600;
            color: #1e293b;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .warehouse-name:hover {
            color: #1976d2;
            text-decoration: underline;
        }

        .warehouse-id {
            background: #f1f5f9;
            color: #475569;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-block;
            font-family: 'Courier New', monospace;
        }

        .warehouse-city {
            background: #f8fafc;
            color: #64748b;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-block;
            border: 1px solid #e2e8f0;
        }

        .warehouse-type {
            font-weight: 600;
            color: #059669;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.75rem;
            display: inline-block;
        }

        .warehouse-capacity {
            font-weight: 500;
            color: #1e293b;
        }

        .warehouse-status {
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

        .status-progress { 
            background: #fef3c7; 
            color: #92400e; 
        }

        .warehouse-year {
            font-weight: 600;
            color: #1976d2;
        }

        .warehouse-phone {
            font-weight: 500;
            color: #4b5563;
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
                margin-bottom: 10px;
            }
            
            .export-buttons {
                justify-content: center;
            }
            
            .warehouse-table {
                font-size: 0.75rem;
            }
            
            .warehouse-table th,
            .warehouse-table td {
                padding: 8px 5px;
            }

            .chart-container,
            .map-container {
                height: 400px;
            }

            #warehouse-map {
                height: 300px;
            }
        }

        /* Custom Marker Styles */
        .warehouse-marker {
            position: relative;
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50% 50% 50% 0;
            transform: rotate(-45deg);
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .warehouse-marker::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 10px;
            height: 10px;
            background: white;
            border-radius: 50%;
            transform: translate(-50%, -50%) rotate(45deg);
        }

        .warehouse-marker.highlight {
            width: 25px;
            height: 25px;
            z-index: 10;
            transform: rotate(-45deg) scale(1.2);
        }

        .highlight-row {
            background-color: #f0f9ff !important;
            transform: scale(1.01);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            z-index: 1;
            position: relative;
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
                        <h4>Inventory Locations</h4>
                        <h6>Manage your warehouse locations</h6>
                    </div>
                </div>

           <!-- Dashboard Statistics -->
          <div class="row justify-content-end">
            <!-- Total Warehouses -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="revenue/revenue.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das1">
                  <div class="dash-counts">
                     <h4><span class="counters" data-count="<?= $stats['total_warehouses'] ?>"><?= $stats['total_warehouses'] ?></span></h4>
                    <h5>Total Warehouses</h5>
                    <h2 class="stat-change">Doing Amazing!</h2>
                    </div>
                    <div class="icon-box bg-ungu">
                      <i class="fa fa-box"></i>
                    </div>
                </div>
              </a>
            </div>

            <!-- Utilization Rate -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="people/supplierlist.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das2">
                  <div class="dash-counts">
                      <h4><?= $stats['utilization_rate'] ?>%</h4>
                    <h5>Utilization Rate</h5>
                  <h2 class="stat-change">Almost High usage!</h2>
                </div>
                <div class="icon-box bg-biru">
                  <i class="fa fa-couch"></i>
                </div>
                </div>
              </a>
            </div>

            <!-- Inventory Turnover -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="product/productsold.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das3">
                  <div class="dash-counts">
                    <h4><?= $stats['inventory_turnover'] ?></h4>
                    <h5>Inventory Turnover</h5>
                    <h2 class="stat-change">+18% over average</h2>
                  </div>
                  <div class="icon-box bg-merah">
                    <i class="fa fa-exclamation-triangle"></i>
                  </div>
                </div>
              </a>
            </div>

            <!-- Total Land Area -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="expense/expensecategory.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das4">
                  <div class="dash-counts">
                   <h4><span class="counters" data-count="<?= $stats['total_land_area'] ?>"><?= number_format($stats['total_land_area'], 0, ',', '.') ?></span>m²</h4>
                    <h5>Total Land Area</h5>
                    <h2 class="stat-change">Keep it up!</h2>
                    </div>
                    <div class="icon-box bg-hijau">
                      <i class="fa fa-chart-line"></i>
                    </div>
                </div>
              </a>
            </div>
          </div>
          
          <!-- Analytics Section -->
          <div class="analytics-section">
            <div class="row">
              <!-- Chart Section -->
              <div class="col-lg-6 col-md-12">
                <div class="chart-container">
                  <div class="chart-title">
                    <i class="fas fa-chart-pie"></i>
                    Warehouse Distribution by Type
                  </div>
                  <div class="chart-content">
                    <div class="donut-chart-wrapper">
                      <canvas id="warehouseTypeChart"></canvas>
                    </div>
                  </div>
                  <div class="insight-container">
                    <h5><i class="fas fa-lightbulb" style="color: #f1c40f; margin-right: 8px;"></i>Key Insights:</h5>
                    <p>Distribution centers represent the majority of our warehouses, focusing on efficient product distribution across regions.</p>
                  </div>
                </div>
              </div>

              <!-- Map Section -->
              <div class="col-lg-6 col-md-12">
                <div class="map-container">
                  <div class="chart-title">
                    <i class="fas fa-map-marked-alt"></i>
                    Warehouse Locations Map
                  </div>
                  <div id="warehouse-map"></div>
                  <div class="insight-container">
                    <h5><i class="fas fa-lightbulb" style="color: #f1c40f; margin-right: 8px;"></i>Strategic Locations:</h5>
                    <p>Our warehouses are strategically positioned across Indonesia to ensure optimal coverage and efficient logistics.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Table Section -->
          <div class="warehouse-table-section">
            <div class="table-controls">
              <div class="search-container">
                <input type="text" id="searchInput" class="search-input" placeholder="Search warehouses...">
                <i class="fas fa-search search-icon"></i>
              </div>
              <div class="export-buttons">
                <button class="export-btn pdf" onclick="exportToPDF()">
                  <i class="fas fa-file-pdf"></i> Export PDF
                </button>
                <button class="export-btn excel" onclick="exportToExcel()">
                  <i class="fas fa-file-excel"></i> Export Excel
                </button>
              </div>
            </div>

            <div class="table-responsive">
              <table class="warehouse-table" id="warehouseTable">
                <thead>
                  <tr>
                    <th>NO</th>
                    <th>Warehouse ID</th>
                    <th>Warehouse Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Type</th>
                    <th>Capacity</th>
                    <th>Land Area</th>
                    <th>Operational Year</th>
                    <th>Status</th>
                    <th>Telephone</th>
                  </tr>
                </thead>
                <tbody id="warehouseTableBody">
                  <?php $counter = 1; ?>
                  <?php foreach ($warehouses as $warehouse): ?>
                  <tr data-id="<?= $counter ?>" 
                      data-lat="<?= $warehouse['latitude'] ?>" 
                      data-lng="<?= $warehouse['longitude'] ?>" 
                      data-type="<?= $warehouse['type'] ?>">
                    <td><?= $counter++ ?></td>
                    <td><span class="warehouse-id"><?= htmlspecialchars($warehouse['warehouse_id']) ?></span></td>
                    <td><span class="warehouse-name"><?= htmlspecialchars($warehouse['name']) ?></span></td>
                    <td><?= htmlspecialchars($warehouse['address']) ?></td>
                    <td><span class="warehouse-city"><?= htmlspecialchars($warehouse['city']) ?></span></td>
                    <td><span class="warehouse-type"><?= htmlspecialchars($warehouse['type']) ?></span></td>
                    <td><span class="warehouse-capacity"><?= number_format($warehouse['capacity'], 0, ',', '.') ?> unit</span></td>
                    <td><?= number_format($warehouse['land_area'], 0, ',', '.') ?> m²</td>
                    <td><span class="warehouse-year"><?= $warehouse['operational_year'] ?></span></td>
                    <td>
                      <span class="warehouse-status <?= $warehouse['status'] === 'active' ? 'status-active' : 'status-progress' ?>">
                        <?= $warehouse['status'] === 'active' ? 'Active' : 'In Progress' ?>
                      </span>
                    </td>
                    <td><span class="warehouse-phone"><?= htmlspecialchars($warehouse['telephone']) ?></span></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
        // Warehouse data from PHP
        const warehouseData = <?php echo json_encode($warehouses); ?>;
        const warehouseTypeData = <?php echo json_encode($warehouseTypes); ?>;
        const typeColors = <?php echo json_encode($typeColors); ?>;
        
        // Search functionality
        let filteredData = [...warehouseData];
        let searchQuery = '';
        let warehouseMap;

        // Initialize maps and charts
        function initializeMapsAndCharts() {
            initializeMap();
            initializeChart();
        }

        // Initialize Chart.js Donut Chart
        function initializeChart() {
            const ctx = document.getElementById('warehouseTypeChart').getContext('2d');
            
            const chartData = {
                labels: warehouseTypeData.map(item => item.type),
                datasets: [{
                    data: warehouseTypeData.map(item => item.count),
                    backgroundColor: warehouseTypeData.map(item => typeColors[item.type]),
                    borderWidth: 0,
                    hoverOffset: 15
                }]
            }

            warehouseTypeChart = new Chart(ctx, {
                type: 'doughnut',
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: { size: 12 },
                                padding: 20,
                                generateLabels: function(chart) {
                                    const data = chart.data;
                                    if (data.labels.length && data.datasets.length) {
                                        return data.labels.map((label, i) => ({
                                            text: `${label} (${data.datasets[0].data[i]})`,
                                            fillStyle: data.datasets[0].backgroundColor[i],
                                            strokeStyle: data.datasets[0].backgroundColor[i],
                                            lineWidth: 0,
                                            hidden: false,
                                            index: i
                                        }));
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
                                    return `${label}: ${value} warehouse${value > 1 ? 's' : ''}`;
                                }
                            }
                        }
                    },
                    animation: {
                        animateRotate: true,
                        animateScale: true
                    }
                }
            });
        }

        // Initialize Leaflet Map
        function initializeMap() {
            warehouseMap = L.map('warehouse-map').setView([-2.5489, 118.0149], 5);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);
            
            // Debug: Check warehouse data structure
            console.log('Warehouse data:', warehouseData);
            console.log('Sample warehouse:', warehouseData[0]);
            
            // Add markers for each warehouse
            warehouseData.forEach((warehouse, index) => {
                // Debug: Check if latitude and longitude exist
                console.log(`Warehouse ${index + 1}:`, {
                    name: warehouse.name,
                    lat: warehouse.latitude,
                    lng: warehouse.longitude,
                    type: warehouse.type
                });
                
                // Check if coordinates exist
                if (warehouse.latitude && warehouse.longitude) {
                    const marker = L.marker([warehouse.latitude, warehouse.longitude], {
                        icon: L.divIcon({
                            className: 'custom-marker',
                            html: `<div class="warehouse-marker" data-id="${index + 1}" style="background-color: ${typeColors[warehouse.type]};"></div>`,
                            iconSize: [30, 30],
                            iconAnchor: [15, 30]
                        })
                    }).addTo(map);
                    
                    marker.bindPopup(`
                        <div class="p-2">
                            <h6>${warehouse.name}</h6>
                            <p class="mb-1">${warehouse.address}</p>
                            <div class="d-flex justify-content-between">
                                <span class="badge ${warehouse.status === 'active' ? 'bg-success' : 'bg-warning'}">
                                    ${warehouse.status === 'active' ? 'Active' : 'In Progress'}
                                </span>
                                <span class="badge" style="background: ${typeColors[warehouse.type]}">${warehouse.type}</span>
                            </div>
                        </div>
                    `);
                    
                    marker.on('mouseover', function() {
                        const row = document.querySelector(`tr[data-id="${index + 1}"]`);
                        if (row) row.classList.add('highlight-row');
                    });
                    
                    marker.on('mouseout', function() {
                        const row = document.querySelector(`tr[data-id="${index + 1}"]`);
                        if (row) row.classList.remove('highlight-row');
                    });
                } else {
                    console.warn(`Warehouse ${warehouse.name} missing coordinates:`, {
                        latitude: warehouse.latitude,
                        longitude: warehouse.longitude
                    });
                }
            });
            
            // If no markers were added, add some sample markers for testing
            if (warehouseData.length === 0 || !warehouseData[0].latitude) {
                console.log('Adding sample markers for testing...');
                const sampleLocations = [
                    { name: 'Jakarta Distribution Center', lat: -6.2088, lng: 106.8456, type: 'Distribution & Storage' },
                    { name: 'Surabaya Warehouse', lat: -7.2575, lng: 112.7521, type: 'Fullfilment Center' },
                    { name: 'Bandung Transit Hub', lat: -6.9175, lng: 107.6191, type: 'Transit & Sorting' },
                    { name: 'Medan Regional Center', lat: 3.5952, lng: 98.6722, type: 'Regional Distribution' }
                ];
                
                sampleLocations.forEach((location, index) => {
                    const marker = L.marker([location.lat, location.lng], {
                        icon: L.divIcon({
                            className: 'custom-marker',
                            html: `<div class="warehouse-marker" data-id="sample-${index + 1}" style="background-color: ${typeColors[location.type]};"></div>`,
                            iconSize: [30, 30],
                            iconAnchor: [15, 30]
                        })
                    }).addTo(map);
                    
                    marker.bindPopup(`
                        <div class="p-2">
                            <h6>${location.name}</h6>
                            <p class="mb-1">Sample Location</p>
                            <span class="badge" style="background: ${typeColors[location.type]}">${location.type}</span>
                        </div>
                    `);
                });
            }
        }

        // Search functionality
        function performSearch(query) {
            searchQuery = query.toLowerCase();
            const tableBody = document.getElementById('warehouseTableBody');
            const rows = tableBody.querySelectorAll('tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const shouldShow = text.includes(searchQuery);
                row.style.display = shouldShow ? '' : 'none';
            });
        }

        // Export to PDF function
        function exportToPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF('landscape');
            
            doc.setFontSize(16);
            doc.text('Warehouse Data - IKEA Indonesia', 14, 22);
            
            doc.setFontSize(10);
            doc.text(`Exported on: ${new Date().toLocaleDateString('id-ID')}`, 14, 30);
            
            const tableData = warehouseData.map((warehouse, index) => [
                index + 1,
                warehouse.warehouse_id,
                warehouse.name,
                warehouse.address,
                warehouse.city,
                warehouse.type,
                warehouse.capacity + ' unit',
                warehouse.land_area + ' m²',
                warehouse.operational_year,
                warehouse.status === 'active' ? 'Active' : 'In Progress',
                warehouse.telephone
            ]);
            
            doc.autoTable({
                head: [['NO', 'Warehouse ID', 'Name', 'Address', 'City', 'Type', 'Capacity', 'Land Area', 'Year', 'Status', 'Phone']],
                body: tableData,
                startY: 35,
                styles: { fontSize: 8 },
                headStyles: { fillColor: [25, 118, 210] }
            });
            
            doc.save('warehouse-data-ikea.pdf');
        }

        // Export to Excel function
        function exportToExcel() {
            const worksheet = XLSX.utils.json_to_sheet(warehouseData.map((warehouse, index) => ({
                'NO': index + 1,
                'Warehouse ID': warehouse.warehouse_id,
                'Name': warehouse.name,
                'Address': warehouse.address,
                'City': warehouse.city,
                'Type': warehouse.type,
                'Capacity': warehouse.capacity + ' unit',
                'Land Area': warehouse.land_area + ' m²',
                'Operational Year': warehouse.operational_year,
                'Status': warehouse.status === 'active' ? 'Active' : 'In Progress',
                'Telephone': warehouse.telephone
            })));
            
            const workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Warehouses');
            XLSX.writeFile(workbook, 'warehouse-data-ikea.xlsx');
        }

        // Event listeners
        document.getElementById('searchInput').addEventListener('input', function() {
            performSearch(this.value);
        });

        // Table row hover effects
        document.addEventListener('DOMContentLoaded', function() {
            const tableRows = document.querySelectorAll('#warehouseTableBody tr');
            
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    const id = this.getAttribute('data-id');
                    this.classList.add('highlight-row');
                    
                    // Highlight corresponding map marker
                    const marker = document.querySelector(`.warehouse-marker[data-id="${id}"]`);
                    if (marker) {
                        marker.classList.add('highlight');
                    }
                });
                
                row.addEventListener('mouseleave', function() {
                    const id = this.getAttribute('data-id');
                    this.classList.remove('highlight-row');
                    
                    // Remove highlight from map marker
                    const marker = document.querySelector(`.warehouse-marker[data-id="${id}"]`);
                    if (marker) {
                        marker.classList.remove('highlight');
                    }
                });
            });
            
            // Initialize maps and charts after DOM is ready
            initializeMapsAndCharts();
        });
    </script>

    <!-- Include same JS files as countrieslist.php -->
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
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
$(document).ready(function() {
  // Data warehouse per tipe dari PHP
  const warehouseTypeData = {
    <?php foreach ($warehouseTypes as $type): ?>
    "<?= $type['type'] ?>": { 
      count: <?= $type['count'] ?>, 
      color: "<?= $typeColors[$type['type']] ?>" 
    }<?= end($warehouseTypes) !== $type ? ',' : '' ?>
    <?php endforeach; ?>,
  };
  // Inisialisasi chart
  const ctx = document.getElementById('warehouseTypeChart').getContext('2d');
  const warehouseTypeChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: Object.keys(warehouseTypeData),
      datasets: [{
        data: Object.values(warehouseTypeData).map(p => p.count),
        backgroundColor: Object.values(warehouseTypeData).map(p => p.color),
        borderWidth: 0,
        hoverOffset: 15
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      cutout: '70%',
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            font: {
              size: 12
            },
            padding: 20,
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
              return `${label}: ${value} warehouse${value > 1 ? 's' : ''}`;
            }
          }
        }
      },
      animation: {
        animateRotate: true,
        animateScale: true
      }
    }
  });

  // Interaksi hover pada chart
  const chartHoverInfo = $('#chartHoverInfo');
  const chartCanvas = $('#warehouseTypeChart');
  
  chartCanvas.on('mousemove', function(e) {
    const points = warehouseTypeChart.getElementsAtEventForMode(e, 'nearest', { intersect: true }, true);
    
    if (points.length) {
      const index = points[0].index;
      const type = warehouseTypeChart.data.labels[index];
      const count = warehouseTypeChart.data.datasets[0].data[index];
      
      chartHoverInfo.html(`
        <div class="chart-hover-title">${type}</div>
        <div class="chart-hover-warehouses">${count} Warehouse${count > 1 ? 's' : ''}</div>
      `);
      
      chartHoverInfo.css({
        left: e.pageX + 15,
        top: e.pageY + 15,
        opacity: 1
      });
      
      // Highlight warehouse di tabel dan peta
      $(`tr[data-type="${type}"]`).addClass('highlight-row');
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
  const map = L.map('warehouse-map').setView([-2.5489, 118.0149], 5);
  
  // Tambahkan tile layer (peta dasar)
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);
  
  // Simpan semua marker dalam array
  const markers = [];
  // Ensure warehouseData is not redeclared
  if (typeof warehouseData === 'undefined') {
    var warehouseData = {};
  }
  
  // Buat marker untuk setiap warehouse
  $('table.datanew tbody tr').each(function() {
    const id = $(this).data('id');
    const lat = $(this).data('lat');
    const lng = $(this).data('lng');
    const type = $(this).data('type');
    const warehouseName = $(this).find('td:eq(2)').text();
    const address = $(this).find('td:eq(3)').text();
    const status = $(this).find('td:eq(9)').text().includes('Active') ? 'active' : 'progress';
    
    // Simpan data warehouse
    warehouseData[id] = {
      element: this,
      name: warehouseName,
      address: address,
      status: status,
      type: type
    };
    
    // Buat marker custom
    const marker = L.marker([lat, lng], {
      icon: L.divIcon({
        className: 'custom-marker',
        html: `<div class="warehouse-marker" data-id="${id}" style="background-color: ${warehouseTypeData[type].color};"></div>`,
        iconSize: [30, 30],
        iconAnchor: [15, 30]
      })
    }).addTo(map);
    
    // Tambahkan popup
    marker.bindPopup(`
      <div class="p-2">
        <h6>${warehouseName}</h6>
        <p class="mb-1">${address}</p>
        <div class="d-flex justify-content-between">
          <span class="badge ${status === 'active' ? 'bg-lightgreen' : 'bg-lightred'}">
            ${status === 'active' ? 'Active' : 'In Progress'}
          </span>
          <span class="badge" style="background: ${warehouseTypeData[type].color}">${type}</span>
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
      $(this.getElement()).find('.warehouse-marker').addClass('highlight');
      const id = $(this.getElement()).find('.warehouse-marker').data('id');
      $(warehouseData[id].element).addClass('highlight-row');
      map.setView(marker.getLatLng(), 8);
    });
    
    marker.on('mouseout', function() {
      $(this.getElement()).find('.warehouse-marker').removeClass('highlight');
      const id = $(this.getElement()).find('.warehouse-marker').data('id');
      $(warehouseData[id].element).removeClass('highlight-row');
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
          $(m.marker.getElement()).find('.warehouse-marker').addClass('highlight');
          map.setView(m.marker.getLatLng(), 8);
        }
      });
    },
    function() {
      const id = $(this).data('id');
      $(this).removeClass('highlight-row');
      
      // Unhighlight marker
      markers.forEach(m => {
        if (m.id === id) {
          $(m.marker.getElement()).find('.warehouse-marker').removeClass('highlight');
        }
      });
    }
  );
});
    </script>
  </body>

</body>

</html>