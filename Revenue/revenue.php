<?php
require_once __DIR__ . '/../include/config.php'; // Import config.php
require_once __DIR__ . '/../AI-integrated/AI-CHAT.PHP';
// Fetch revenue growth data
$revenueGrowthQuery = "SELECT growth_amount, growth_percentage FROM revenue_growth ORDER BY periode DESC LIMIT 1";
$revenueGrowthStmt = $pdo->query($revenueGrowthQuery);
$revenueGrowth = $revenueGrowthStmt->fetch(PDO::FETCH_ASSOC);

// Fetch total revenue
$totalRevenueQuery = "SELECT SUM(pendapatan) as total_revenue FROM revenue WHERE periode = (SELECT MAX(periode) FROM revenue)";
$totalRevenueStmt = $pdo->query($totalRevenueQuery);
$totalRevenue = $totalRevenueStmt->fetch(PDO::FETCH_ASSOC);

// Fetch target achievement (average)
$targetQuery = "SELECT AVG(target) as avg_target FROM revenue WHERE periode = (SELECT MAX(periode) FROM revenue)";
$targetStmt = $pdo->query($targetQuery);
$targetData = $targetStmt->fetch(PDO::FETCH_ASSOC);

// Fetch top performer store
$topPerformerQuery = "
    SELECT t.nama_toko 
    FROM revenue r 
    JOIN toko t ON r.id_toko = t.id_toko 
    WHERE r.periode = (SELECT MAX(periode) FROM revenue) 
    ORDER BY r.profit DESC 
    LIMIT 1
";
$topPerformerStmt = $pdo->query($topPerformerQuery);
$topPerformer = $topPerformerStmt->fetch(PDO::FETCH_ASSOC);

// Fetch top 5 performing stores for chart
$topStoresQuery = "
    SELECT t.nama_toko, r.profit 
    FROM revenue r 
    JOIN toko t ON r.id_toko = t.id_toko 
    WHERE r.periode = (SELECT MAX(periode) FROM revenue) 
    ORDER BY r.profit DESC 
    LIMIT 5
";
$topStoresStmt = $pdo->query($topStoresQuery);
$topStores = $topStoresStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch monthly profit trend
$monthlyTrendQuery = "SELECT month, average_profit FROM monthly_profit_trend WHERE year = 2025 ORDER BY month";
$monthlyTrendStmt = $pdo->query($monthlyTrendQuery);
$monthlyTrend = $monthlyTrendStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all stores data for table
$storesDataQuery = "
    SELECT 
        t.id_toko,
        t.kode_toko,
        t.nama_toko,
        t.status,
        r.profit,
        r.pendapatan,
        r.target,
        spm.achievement_percentage,
        spm.is_top_performer,
        spm.rank
    FROM toko t
    LEFT JOIN revenue r ON t.id_toko = r.id_toko AND r.periode = (SELECT MAX(periode) FROM revenue)
    LEFT JOIN store_performance_metrics spm ON t.id_toko = spm.id_toko AND spm.periode = (SELECT MAX(periode) FROM store_performance_metrics)
    ORDER BY r.profit DESC
";
$storesDataStmt = $pdo->query($storesDataQuery);
$storesData = $storesDataStmt->fetchAll(PDO::FETCH_ASSOC);

// Format numbers for display - UPDATED TO RUPIAH
function formatCurrency($amount) {
    return 'Rp ' . number_format($amount, 0, ',', '.');
}

function formatPercentage($percent) {
    return number_format($percent, 1) . '%';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <meta name="description" content="POS - Bootstrap Admin Template" />
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects" />
    <meta name="author" content="Dreamguys - Bootstrap Admin Template" />
    <meta name="robots" content="noindex, nofollow" />
    <title>RuanGku</title>

    <!-- Same CSS includes as statelist.php -->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.png">
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
    
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    
    <!-- ApexCharts for donut chart -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
    <style>
        a {
            text-decoration: none !important;
        }

        .ikea-header {
            background-color: #0051BA !important;
        }

        /* Dashboard Cards CSS - Same as statelist.php */
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

        #revenueChart {
            width: 100%;
            max-width: 400px;
            height: 300px;
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

        /* View Details Button - Same style as revenue.php */
        .detail-btn {
            background: #1976d2;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid #1976d2;
            box-shadow: 0 2px 4px rgba(25, 118, 210, 0.2);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
        }

        .detail-btn:hover {
            background: #1565c0;
            border-color: #1565c0;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(25, 118, 210, 0.3);
            color: white;
            text-decoration: none;
        }

        .detail-btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(25, 118, 210, 0.2);
        }

        .detail-btn i {
            font-size: 0.75rem;
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

        .status-inactive { 
            background: #fee2e2; 
            color: #dc2626; 
        }

        .profit-cell {
            font-weight: 500;
            color: #1e293b;
        }

        .profit-positive {
            color: #059669;
        }

        .profit-negative {
            color: #dc2626;
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
            
            .store-table {
                font-size: 0.75rem;
            }
            
            .store-table th,
            .store-table td {
                padding: 8px 5px;
            }

            .chart-container {
                height: 400px;
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

            
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Revenue Analytics Dashboard</h4>
                        <h6>Monitor revenue performance and store analytics</h6>
                    </div>
                </div>

           <!-- Dashboard Statistics -->
          <div class="row justify-content-end">
            <!-- Revenue Growth -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <div class="dash-count das1">
                <div class="dash-counts">
                   <h4><?php echo formatCurrency($revenueGrowth['growth_amount'] ?? 0); ?></h4>
                  <h5>Revenue Growth</h5>
                  <p class="stat-change"><?php echo ($revenueGrowth['growth_percentage'] >= 0 ? '+' : '') . formatPercentage($revenueGrowth['growth_percentage'] ?? 0); ?> from last month</p>
                  </div>
                  <div class="icon-box bg-ungu">
                    <i class="fa fa-chart-line"></i>
                  </div>
              </div>
            </div>

            <!-- Total Revenue -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <div class="dash-count das2">
                <div class="dash-counts">
                  <h4><?php echo formatCurrency($totalRevenue['total_revenue'] ?? 0); ?></h4>
                  <h5>Total Revenue</h5>
                  <p class="stat-change">Keep up the good work!</p>
                </div>
                <div class="icon-box bg-biru">
                  <i class="fa fa-rupiah-sign"></i>
                </div>
              </div>
            </div>

            <!-- Target Achievement -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <div class="dash-count das3">
                <div class="dash-counts">
                  <h4><?php echo formatPercentage($targetData['avg_target'] ?? 0); ?></h4>
                  <h5>Target Achievement</h5>
                  <p class="stat-change">Keep it up!</p>
                </div>
                <div class="icon-box bg-merah">
                  <i class="fas fa-bullseye"></i>
                </div>
              </div>
            </div>

            <!-- Top Performer -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <div class="dash-count das4">
                <div class="dash-counts">
                 <h4><?php echo $topPerformer['nama_toko'] ?? 'N/A'; ?></h4>
                  <h5>Top Performer</h5>
                  <p class="stat-change">Keep it up!</p>
                  </div>
                  <div class="icon-box bg-hijau">
                    <i class="fa fa-trophy"></i>
                  </div>
              </div>
            </div>
          </div>
          
          <!-- Analytics Section -->
          <div class="analytics-section">
            <div class="row">
              <div class="col-lg-8">
                <div class="chart-container">
                  <div class="chart-title">
                    <i class="fas fa-chart-bar"></i>
                    Top 5 Performing Stores
                  </div>
                  <div class="chart-content">
                    <canvas id="barChart"></canvas>
                  </div>
                  <div class="insight-container">
                    <div class="d-flex align-items-center">
                      <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
                      <div>
                        <h5 style="font-size: 0.9rem;">Performance Analysis</h5>
                        <p class="mb-0">Top performing stores show consistent growth. Focus on replicating successful strategies across all locations.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-lg-4">
                <div class="chart-container">
                  <div class="chart-title">
                    <i class="fas fa-chart-line"></i>
                    Monthly Profit Trend
                  </div>
                  <div class="chart-content">
                    <canvas id="lineChart"></canvas>
                  </div>
                  <div class="insight-container">
                    <div class="d-flex align-items-center">
                      <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
                      <div>
                        <h5 style="font-size: 0.9rem;">Trend Analysis</h5>
                        <p class="mb-0">Monthly profits show steady improvement. Continue current growth strategies for optimal results.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Table Section -->
          <div class="store-table-section">
            <div class="table-controls">
              <div class="search-container">
                <input type="text" class="search-input" placeholder="Search stores..." id="searchInput">
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

            <div class="table-responsive">
              <table class="store-table" id="storeTableBody">
                <thead>
                  <tr>
                    <th>NO</th>
                    <th>Store ID</th>
                    <th>Store Name</th>
                    <th>Status</th>
                    <th>Profit (%)</th>
                    <th>Revenue</th>
                    <th>Target</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $counter = 1;
                  foreach($storesData as $store): 
                    $profitClass = ($store['profit'] >= 0) ? 'profit-positive' : 'profit-negative';
                    $statusClass = ($store['status'] == 'active') ? 'status-active' : 'status-inactive';
                    $statusText = ucfirst($store['status']);
                  ?>
                  <tr>
                    <td><?php echo $counter; ?></td>
                    <td><span class="store-id"><?php echo htmlspecialchars($store['kode_toko'] ?? 'N/A'); ?></span></td>
                    <td><span class="store-name"><?php echo htmlspecialchars($store['nama_toko']); ?></span></td>
                    <td><span class="store-status <?php echo $statusClass; ?>"><?php echo $statusText; ?></span></td>
                    <td class="profit-cell <?php echo $profitClass; ?>">
                      <?php echo ($store['profit'] >= 0 ? '+' : '') . formatPercentage($store['profit'] ?? 0); ?>
                    </td>
                    <td class="profit-cell">
                      <?php echo formatCurrency($store['pendapatan'] ?? 0); ?>
                    </td>
                    <td class="profit-cell">
                      <?php echo formatPercentage($store['target'] ?? 0); ?>
                    </td>
                    <td>
                      <button class="detail-btn" onclick="viewStoreDetails('<?php echo $store['id_toko']; ?>')">
                        <i class="fas fa-eye"></i>
                        View Details
                      </button>
                    </td>
                  </tr>
                  <?php 
                  $counter++;
                  endforeach; 
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Include same JS files as statelist.php -->
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

    <script>
        // Store data from PHP (preserving original cek.php data)
        const storeData = {
            stores: <?php echo json_encode(array_column($topStores, 'nama_toko')); ?>,
            profits: <?php echo json_encode(array_column($topStores, 'profit')); ?>,
            colors: ['#1976d2', '#42a5f5', '#64b5f6', '#90caf9', '#bbdefb'] // Warna biru konsisten seperti revenue.php
        };

        const monthlyData = {
            months: <?php echo json_encode(array_map(function($item) {
              return date('M', mktime(0, 0, 0, $item['month'], 1));
            }, $monthlyTrend)); ?>,
            profits: <?php echo json_encode(array_column($monthlyTrend, 'average_profit')); ?>
        };

        // Store table data
        const allStoresData = <?php echo json_encode($storesData); ?>;
        let filteredData = [...allStoresData];

        // UPDATED: Format currency function for Rupiah
        function formatRupiah(amount) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(amount);
        }

        // Initialize charts and functionality
        function initializeCharts() {
            // Bar Chart - Top 5 Stores
            const barCtx = document.getElementById('barChart').getContext('2d');
            const barChart = new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: storeData.stores,
                    datasets: [{
                        label: 'Profit (%)',
                        data: storeData.profits,
                        backgroundColor: storeData.colors,
                        borderColor: storeData.colors,
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
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
                            callbacks: {
                                label: function(context) {
                                    return `Profit: ${context.parsed.y >= 0 ? '+' : ''}${context.parsed.y}%`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return (value >= 0 ? '+' : '') + value + '%';
                                }
                            },
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeInOutQuart'
                    }
                }
            });

            // Line Chart - Monthly Trend
            const lineCtx = document.getElementById('lineChart').getContext('2d');
            const lineChart = new Chart(lineCtx, {
                type: 'line',
                data: {
                    labels: monthlyData.months,
                    datasets: [{
                        label: 'Average Profit',
                        data: monthlyData.profits,
                        borderColor: '#1976d2',
                        backgroundColor: 'rgba(25, 118, 210, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                        pointBackgroundColor: '#1976d2',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2
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
                            callbacks: {
                                label: function(context) {
                                    return `Profit: ${context.parsed.y >= 0 ? '+' : ''}${context.parsed.y}%`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return (value >= 0 ? '+' : '') + value + '%';
                                }
                            },
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeInOutQuart'
                    }
                }
            });
        }

        // Search functionality
        function performSearch(query) {
            const searchQuery = query.toLowerCase();
            const tableBody = document.querySelector('#storeTableBody tbody');
            const rows = tableBody.querySelectorAll('tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const shouldShow = text.includes(searchQuery);
                row.style.display = shouldShow ? '' : 'none';
            });
        }

        // UPDATED: Export to PDF function with Rupiah format
        function exportToPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF('landscape');
            
            doc.setFontSize(16);
            doc.text('Revenue Analytics Data - IKEA', 14, 22);
            
            doc.setFontSize(10);
            doc.text(`Exported on: ${new Date().toLocaleDateString('id-ID')}`, 14, 30);
            
            const tableData = filteredData.map((store, index) => [
                index + 1,
                store.kode_toko || 'N/A',
                store.nama_toko,
                store.status,
                (store.profit >= 0 ? '+' : '') + (store.profit || 0) + '%',
                formatRupiah(store.pendapatan || 0),
                (store.target || 0) + '%'
            ]);
            
            doc.autoTable({
                head: [['NO', 'Store ID', 'Store Name', 'Status', 'Profit (%)', 'Revenue', 'Target']],
                body: tableData,
                startY: 40,
                headStyles: { fillColor: [25, 118, 210] },
                styles: { fontSize: 8 }
            });
            
            doc.save('revenue-analytics-data.pdf');
        }

        // UPDATED: Export to Excel function with Rupiah format
        function exportToExcel() {
            const worksheet = XLSX.utils.json_to_sheet(filteredData.map((store, index) => ({
                'NO': index + 1,
                'Store ID': store.kode_toko || 'N/A',
                'Store Name': store.nama_toko,
                'Status': store.status,
                'Profit (%)': (store.profit >= 0 ? '+' : '') + (store.profit || 0) + '%',
                'Revenue': formatRupiah(store.pendapatan || 0),
                'Target': (store.target || 0) + '%'
            })));
            
            const workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Revenue Analytics');
            XLSX.writeFile(workbook, 'revenue-analytics-data.xlsx');
        }

        // UPDATED: View store details function with Rupiah format
        function viewStoreDetails(storeId) {
            // Find store data
            const store = allStoresData.find(s => s.id_toko == storeId);
            if (store) {
                alert(`Store Details:\n\nName: ${store.nama_toko}\nCode: ${store.kode_toko || 'N/A'}\nStatus: ${store.status}\nProfit: ${store.profit || 0}%\nRevenue: ${formatRupiah(store.pendapatan || 0)}\nTarget: ${store.target || 0}%`);
            }
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize charts
            initializeCharts();
            
            // Search functionality
            document.getElementById('searchInput').addEventListener('input', function() {
                performSearch(this.value);
            });
            
            // Hide global loader
            setTimeout(() => {
                document.getElementById('global-loader').style.display = 'none';
            }, 1000);
        });
    </script>
  </body>
</html>
