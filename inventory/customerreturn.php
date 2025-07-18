<?php
require_once __DIR__ . '/../include/config.php';

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ikea";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Sample data for customer returns
$totalReturns = 215;
$totalRefundValue = 12450;
$avgReturnRate = 6.8;
$topReturnCategory = 'Furniture';
$monthlyChange = 15;
$refundChange = 8;
$rateChange = -1.2;

// Sample return data
$returnData = [
    ['category' => 'Furniture', 'date' => '2025-01-15', 'branch' => 'IKEA Alam Sutera', 'supplier' => 'Apex Computers', 'refund' => 850.00, 'percentage' => 7.1, 'status' => 'received'],
    ['category' => 'Lighting', 'date' => '2025-01-14', 'branch' => 'IKEA Jakarta GC', 'supplier' => 'Modern Automobile', 'refund' => 1200.00, 'percentage' => 10.0, 'status' => 'pending'],
    ['category' => 'Storage', 'date' => '2025-01-13', 'branch' => 'IKEA Sentul City', 'supplier' => 'AIM Infotech', 'refund' => 950.00, 'percentage' => 7.9, 'status' => 'ordered'],
    ['category' => 'Bedroom', 'date' => '2025-01-12', 'branch' => 'IKEA Bali', 'supplier' => 'Best Power Tools', 'refund' => 1400.00, 'percentage' => 11.7, 'status' => 'received'],
    ['category' => 'Kitchen', 'date' => '2025-01-11', 'branch' => 'IKEA Mal Taman Anggrek', 'supplier' => 'Hatimi Hardware', 'refund' => 1100.00, 'percentage' => 9.2, 'status' => 'pending'],
];

// Chart data
$chartData = [
    'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    'returns' => [850, 1200, 950, 1400, 1100, 1300, 1500, 1250, 1600, 1800, 2100, 2400],
    'categories' => ['Furniture', 'Lighting', 'Storage', 'Bedroom', 'Kitchen', 'Others'],
    'categoryData' => [42, 18, 15, 12, 8, 5]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<meta name="description" content="POS - Bootstrap Admin Template">
<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
<meta name="author" content="Dreamguys - Bootstrap Admin Template">
<meta name="robots" content="noindex, nofollow">
<title>IKEA - Customer Returns</title>

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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!-- Export Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<style>
   a {
    text-decoration: none !important;
  }

  .ikea-select:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  }

  .ikea-select:focus {
    outline: none;
    border-color: #1976d2;
    box-shadow: 0 0 0 3px rgba(25, 118, 210, 0.1);
  }

  .card-header h5 {
    color: #1976d2;
    font-weight: 600;
  }
  
  .ikea-note-card {
    background: linear-gradient(135deg, #f0f8ff 0%, #e6f3ff 100%);
    border: 1px solid rgba(25, 118, 210, 0.2);
    border-radius: 12px;
    padding: 15px;
    margin-bottom: 15px;
    transition: all 0.3s ease;
  }
  
  #notesCarousel::-webkit-scrollbar {
    width: 6px;
  }

  #notesCarousel::-webkit-scrollbar-thumb {
    background: #1976d2;
    border-radius: 3px;
  }
  .note-card p {
    margin-bottom: 8px;
    color: #4a5568;
  }

  .note-card strong {
    color: #1976d2;
  }

  .card-body::-webkit-scrollbar {
    width: 6px;
  }

  .card-body::-webkit-scrollbar-thumb {
    background: #1976d2;
    border-radius: 3px;
  }

/* Reset semua background jadi putih & style dasar kolom */
.das1, .das2, .das3, .das4 {
  background: white !important;
  border-radius: 20px;
  padding: 20px;
  transition: all 0.3s ease;
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
}

/* Struktur utama card */
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

/* Efek saat hover */
.dash-count:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 32px rgba(0, 0, 0, 0.2);
  background-color: #f9f9f9;
}

/* Penyesuaian tampilan angka dan label */
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
}

/* Gaya icon kanan */
.dash-imgs i {
  font-size: 32px;
}

/* Kolom 1 - Biru Laut */
.das1 {
  border-top: 6px solid #1a5ea7;
}
.das1 * {
  color: #1a5ea7 !important;
}

/* Kolom 2 - Ungu */
.das2 {
  border-top: 6px solid #751e8d;
}
.das2 * {
  color: #751e8d !important;
}

/* Kolom 3 - Kuning/Oranye */
.das3 {
  border-top: 6px solid #e78001;
}
.das3 * {
  color: #e78001 !important;
}

/* Kolom 4 - Tosca */
.das4 {
  border-top: 6px solid #018679;
}
.das4 * {
  color: #018679 !important;
}

.stat-change {
    background: rgba(40, 167, 69, 0.1);
    color: #28a745;         /* Warna teks */
    display: inline-block;
    padding: 3px 6px;
    border-radius: 12px;
    font-weight: 600;
}

.stat-change.negative {
    background: rgba(244, 67, 54, 0.1);
    color: #f44336;
}

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
/* Efek hover dan active */
.icon-box:hover,
.icon-box:active {
  box-shadow: 0 4px 12px rgba(0,0,0,0.18);
  transform: scale(1.08);
}
.bg-ungu {
  background: linear-gradient(135deg, #2196f3 0%, #0d47a1 100%);
}
.bg-biru {
  background: linear-gradient(135deg, #a259c6 0%, #6d28d9 100%);
}
.bg-hijau {
  background: linear-gradient(135deg,rgb(89, 236, 222) 0%, #018679 100%);
}
.bg-merah {
  background: linear-gradient(135deg, #ff5858 0%, #e78001 100%);
}
/* END - CSS Kolom */

/* Custom CSS Variables */
:root {
  --primary-blue: #1976d2;
  --secondary-blue: #42a5f5;
  --success-green: #4caf50;
  --warning-orange: #ff9800;
  --danger-red: #f44336;
  --info-cyan: #00bcd4;
  --light-gray: #f5f5f5;
  --white: #ffffff;
  --text-dark: #333333;
  --border-color: #e0e0e0;
}

/* Chart Section */
.chart-section {
  background: var(--white);
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 25px;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
  transition: all 0.3s ease;
}

.chart-section:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
}

.chart-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.chart-title {
  font-size: 1.1rem;
  font-weight: 600;
  color: var(--primary-blue);
  margin: 0;
}

.chart-select {
  border: 1px solid var(--border-color);
  border-radius: 6px;
  padding: 6px 12px;
  background: var(--white);
  font-size: 0.9rem;
  color: var(--text-dark);
}

.chart-select:focus {
  outline: none;
  border-color: var(--primary-blue);
  box-shadow: 0 0 0 2px rgba(25, 118, 210, 0.2);
}

/* Insight Container */
.insight-container {
  padding: 15px;
  background: linear-gradient(135deg, #f0f8ff 0%, #e6f3ff 100%);
  border-top: 1px solid rgba(25, 118, 210, 0.1);
  border-radius: 0 0 12px 12px;
  font-size: 0.85rem;
  margin-top: 20px;
}

.insight-container h5 {
  color: var(--primary-blue) !important;
  font-weight: 600;
}

.insight-container p {
  color: #4a5568;
  line-height: 1.5;
}

/* Enhanced Return Data Table - Extended Width and Blue Gradient Headers */
.return-table-section {
  background: var(--white);
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 25px;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
  transition: all 0.3s ease;
}

.return-table-section:hover {
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
  border-color: var(--primary-blue);
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

.return-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 15px;
}

.return-table th {
  background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
  color: #ffffff;
  font-weight: 600;
  font-size: 0.85rem;
  padding: 12px 10px;
  text-align: left;
  border-bottom: 2px solid #1565c0;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.return-table th:first-child {
  border-top-left-radius: 8px;
}

.return-table th:last-child {
  border-top-right-radius: 8px;
}

.return-table td {
  padding: 12px 10px;
  border-bottom: 1px solid #f1f5f9;
  font-size: 0.85rem;
  color: #374151;
  vertical-align: middle;
}

.return-table tbody tr:hover {
  background-color: #f8fafc;
  transition: all 0.2s ease;
}

.return-category {
  display: flex;
  align-items: center;
  gap: 12px;
}

.product-img img {
  width: 40px;
  height: 40px;
  object-fit: cover;
  border-radius: 6px;
  border: 2px solid #f0f0f0;
}

.return-id {
  background: #f1f5f9;
  color: #475569;
  padding: 4px 8px;
  border-radius: 6px;
  font-size: 0.75rem;
  font-weight: 500;
  display: inline-block;
  font-family: 'Courier New', monospace;
}

.return-branch {
  background: #f8fafc;
  color: #64748b;
  padding: 4px 10px;
  border-radius: 15px;
  font-size: 0.75rem;
  font-weight: 500;
  display: inline-block;
  border: 1px solid #e2e8f0;
}

.return-refund {
  font-weight: 600;
  color: #059669;
}

.return-percentage {
  font-weight: 600;
  color: #1e293b;
}

.return-status {
  padding: 4px 8px;
  border-radius: 12px;
  font-size: 0.7rem;
  font-weight: 600;
  text-align: center;
}

.status-received { background: #d1fae5; color: #065f46; }
.status-ordered { background: #fef3c7; color: #92400e; }
.status-pending { background: #fee2e2; color: #991b1b; }

.detail-btn {
  background: #1976d2;
  color: white;
  border: none;
  padding: 8px 16px;
  border-radius: 8px;
  font-size: 0.8rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

.detail-btn:hover {
  background: #1565c0;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(25, 118, 210, 0.3);
  color: white;
}

.detail-btn:active {
  transform: translateY(0);
}

/* Modal Styles */
.modal-content {
  border-radius: 12px;
  border: none;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.modal-header {
  background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
  color: white;
  border-radius: 12px 12px 0 0;
  padding: 20px;
}

.modal-title {
  font-weight: 600;
  font-size: 1.2rem;
}

.modal-body {
  padding: 25px;
}

.metrics-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
  gap: 15px;
  margin-bottom: 20px;
}

.metric-item {
  text-align: center;
  padding: 15px;
  background: #f8fafc;
  border-radius: 8px;
  border: 1px solid #e2e8f0;
}

.metric-value {
  font-size: 1.4rem;
  font-weight: 700;
  color: #1976d2;
  margin-bottom: 5px;
}

.metric-label {
  font-size: 0.75rem;
  color: #64748b;
  font-weight: 500;
}

.return-info {
  background: #f8fafc;
  border-radius: 8px;
  padding: 15px;
  margin-bottom: 15px;
}

.return-info h6 {
  color: #1976d2;
  margin-bottom: 10px;
  font-weight: 600;
}

.info-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 8px;
}

.info-label {
  font-weight: 500;
  color: #475569;
}

.info-value {
  color: #1e293b;
  font-weight: 600;
}

/* Responsive */
@media (max-width: 768px) {
  .content {
    padding: 15px;
  }
  
  .chart-header {
    flex-direction: column;
    gap: 15px;
  }
  
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
  
  .dash-count {
    padding: 16px;
  }
  
  .dash-counts h4 {
    font-size: 20px;
  }
  
  .dash-counts h5 {
    font-size: 12px;
  }
  
  .icon-box {
    width: 36px;
    height: 36px;
  }
  
  .icon-box i {
    font-size: 14px;
  }
  
  .return-table {
    font-size: 0.8rem;
  }
  
  .return-table th,
  .return-table td {
    padding: 8px 6px;
  }
  
  .metrics-grid {
    grid-template-columns: repeat(2, 1fr);
  }
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
  border-top: 4px solid var(--primary-blue);
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.trend-indicator {
  font-size: 1rem;
  display: inline-block;
  margin-left: 4px;
}

.trend-up {
  color: var(--success-green);
}

.trend-down {
  color: var(--danger-red);
}
</style>
</head>
<body>
<div id="global-loader">
<div class="whirly-loader"> </div>
</div>

<div class="main-wrapper">
<!-- Include sidebar -->
<?php include BASE_PATH . '/include/sidebar.php'; ?>
<!-- /Include sidebar -->

<!-- BAGIAN ATAS -->
<div class="page-wrapper">
  <div class="content">
    <?php include __DIR__ . '/../include/header.php'; ?>
  <div class="page-header">
    <div class="page-title">
      <h4>Customer Returns Analytics</h4>
      <h6>Comprehensive return insights and customer satisfaction analysis</h6>
    </div>
    <div class="page-btn">
      <a href="addreturn.php" class="btn btn-added">
        <img src="../assets/img/icons/plus.svg" alt="img" class="me-2">Add Return
      </a>
    </div>
  </div>

  <!-- BAGIAN KOLOM DASHBOARD -->
  <div class="row">
    <div class="col-lg-3 col-sm-6 col-12">
      <div class="dash-count das1">
        <div class="dash-counts">
          <h4><?= $totalReturns ?></h4>
          <h5>Total Returns</h5>
          <div class="stat-change <?= $monthlyChange < 0 ? 'negative' : '' ?>">
            <?= $monthlyChange > 0 ? '+' : '' ?><?= $monthlyChange ?>% from last month
          </div>
        </div>
        <div class="dash-imgs">
          <div class="icon-box bg-ungu">
            <i class="fa fa-undo"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-12">
      <div class="dash-count das2">
        <div class="dash-counts">
          <h4>$<?= number_format($totalRefundValue) ?></h4>
          <h5>Total Refund Value</h5>
          <div class="stat-change <?= $refundChange < 0 ? 'negative' : '' ?>">
            <?= $refundChange > 0 ? '+' : '' ?><?= $refundChange ?>% from last month
          </div>
        </div>
        <div class="dash-imgs">
          <div class="icon-box bg-biru">
            <i class="fa fa-dollar-sign"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-12">
      <div class="dash-count das3">
        <div class="dash-counts">
          <h4><?= $avgReturnRate ?>%</h4>
          <h5>Avg Return Rate</h5>
          <div class="stat-change <?= $rateChange < 0 ? 'negative' : '' ?>">
            <?= $rateChange > 0 ? '+' : '' ?><?= $rateChange ?>% from last month
          </div>
        </div>
        <div class="dash-imgs">
          <div class="icon-box bg-merah">
            <i class="fa fa-percentage"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-12">
      <div class="dash-count das4">
        <div class="dash-counts">
          <h4><?= $topReturnCategory ?></h4>
          <h5>Top Return Category</h5>
          <div class="stat-change">
            42 returns this month
          </div>
        </div>
        <div class="dash-imgs">
          <div class="icon-box bg-hijau">
            <i class="fa fa-tags"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- BAGIAN CHART -->
  <div class="row">
    <!-- Chart 1: Monthly Returns -->
    <div class="col-lg-8 col-sm-12 col-12 d-flex">
      <div class="chart-section flex-fill">
        <div class="chart-header">
          <h3 class="chart-title">Monthly Customer Returns Trend</h3>
          <select class="chart-select" id="returnsChartYear">
            <option value="2025">2025</option>
            <option value="2024">2024</option>
            <option value="2023">2023</option>
          </select>
        </div>
        <div id="returnsChart"></div>
        <div class="insight-container">
          <h5>Key Insights</h5>
          <p>Return volume has increased by 15% from last month. December shows highest return rate, likely due to holiday purchases. Furniture category dominates returns at 42 cases.</p>
        </div>
      </div>
    </div>

    <!-- Chart 2: Returns by Category -->
    <div class="col-lg-4 col-sm-12 col-12 d-flex">
      <div class="chart-section flex-fill">
        <div class="chart-header">
          <h3 class="chart-title">Returns by Category</h3>
        </div>
        <div id="categoryChart"></div>
        <div class="insight-container">
          <h5>Top Return Categories</h5>
          <p>Furniture leads with 42 returns, followed by Lighting (18) and Storage (15). Focus on quality improvement for these categories.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- BAGIAN TABEL -->
  <div class="return-table-section">
    <div class="table-controls">
      <div class="search-container">
        <input type="text" class="search-input" id="searchInput" placeholder="Search customer returns...">
        <i class="fas fa-search search-icon"></i>
      </div>
      <div class="export-buttons">
        <button class="export-btn excel" onclick="exportToExcel()">
          <i class="fas fa-file-excel"></i> Export Excel
        </button>
        <button class="export-btn pdf" onclick="exportToPDF()">
          <i class="fas fa-file-pdf"></i> Export PDF
        </button>
      </div>
    </div>

    <div class="table-responsive">
      <table class="return-table" id="returnTable">
        <thead>
          <tr>
            <th>No</th>
            <th>Category</th>
            <th>Date</th>
            <th>Branch</th>
            <th>Supplier</th>
            <th>Refund Total</th>
            <th>Percentage</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="returnTableBody">
          <!-- Data will be populated by JavaScript -->
        </tbody>
      </table>
    </div>
  </div>

  </div>
</div>
</div>

<!-- Modal for View Details -->
<div class="modal fade" id="returnModal" tabindex="-1" aria-labelledby="returnModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="returnModalLabel">Customer Return Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="metrics-grid">
          <div class="metric-item">
            <div class="metric-value" id="modalRefund">$0.00</div>
            <div class="metric-label">Refund Value</div>
          </div>
          <div class="metric-item">
            <div class="metric-value" id="modalPercentage">0%</div>
            <div class="metric-label">Return Rate</div>
          </div>
          <div class="metric-item">
            <div class="metric-value" id="modalStatus">-</div>
            <div class="metric-label">Status</div>
          </div>
        </div>
        
        <div class="return-info">
          <h6>Return Information</h6>
          <div class="info-row">
            <span class="info-label">Category:</span>
            <span class="info-value" id="modalCategory">-</span>
          </div>
          <div class="info-row">
            <span class="info-label">Date:</span>
            <span class="info-value" id="modalDate">-</span>
          </div>
          <div class="info-row">
            <span class="info-label">Branch:</span>
            <span class="info-value" id="modalBranch">-</span>
          </div>
          <div class="info-row">
            <span class="info-label">Supplier:</span>
            <span class="info-value" id="modalSupplier">-</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// Customer Return Data
const returnData = <?php echo json_encode($returnData); ?>;

// Chart Data
const chartData = <?php echo json_encode($chartData); ?>;

// Extend return data with more sample data
const extendedReturnData = [
  ...returnData,
  {category: 'Living Room', date: '2025-01-10', branch: 'IKEA Kota Baru Parahyangan', supplier: 'Modern Automobile', refund: 1300.00, percentage: 10.8, status: 'received'},
  {category: 'Dining', date: '2025-01-09', branch: 'IKEA Alam Sutera', supplier: 'AIM Infotech', refund: 1500.00, percentage: 12.5, status: 'pending'},
  {category: 'Office', date: '2025-01-08', branch: 'IKEA Jakarta GC', supplier: 'Best Power Tools', refund: 1250.00, percentage: 10.4, status: 'ordered'},
  {category: 'Outdoor', date: '2025-01-07', branch: 'IKEA Sentul City', supplier: 'Hatimi Hardware', refund: 1600.00, percentage: 13.3, status: 'received'},
  {category: 'Textiles', date: '2025-01-06', branch: 'IKEA Bali', supplier: 'Apex Computers', refund: 1800.00, percentage: 15.0, status: 'pending'},
  {category: 'Decoration', date: '2025-01-05', branch: 'IKEA Mal Taman Anggrek', supplier: 'Modern Automobile', refund: 2100.00, percentage: 17.5, status: 'received'},
  {category: 'Bathroom', date: '2025-01-04', branch: 'IKEA Kota Baru Parahyangan', supplier: 'AIM Infotech', refund: 2400.00, percentage: 20.0, status: 'ordered'},
  {category: 'Children', date: '2025-01-03', branch: 'IKEA Alam Sutera', supplier: 'Best Power Tools', refund: 950.00, percentage: 7.9, status: 'pending'},
  {category: 'Appliances', date: '2025-01-02', branch: 'IKEA Jakarta GC', supplier: 'Hatimi Hardware', refund: 1100.00, percentage: 9.2, status: 'received'},
  {category: 'Rugs', date: '2025-01-01', branch: 'IKEA Sentul City', supplier: 'Apex Computers', refund: 800.00, percentage: 6.7, status: 'ordered'},
  {category: 'Curtains', date: '2024-12-31', branch: 'IKEA Bali', supplier: 'Modern Automobile', refund: 1400.00, percentage: 11.7, status: 'received'},
  {category: 'Tableware', date: '2024-12-30', branch: 'IKEA Mal Taman Anggrek', supplier: 'AIM Infotech', refund: 1200.00, percentage: 10.0, status: 'pending'},
  {category: 'Cookware', date: '2024-12-29', branch: 'IKEA Kota Baru Parahyangan', supplier: 'Best Power Tools', refund: 1700.00, percentage: 14.2, status: 'ordered'},
  {category: 'Laundry', date: '2024-12-28', branch: 'IKEA Alam Sutera', supplier: 'Hatimi Hardware', refund: 900.00, percentage: 7.5, status: 'received'},
  {category: 'Cleaning', date: '2024-12-27', branch: 'IKEA Jakarta GC', supplier: 'Apex Computers', refund: 1300.00, percentage: 10.8, status: 'pending'},
  {category: 'Pet', date: '2024-12-26', branch: 'IKEA Sentul City', supplier: 'Modern Automobile', refund: 750.00, percentage: 6.3, status: 'ordered'},
];

// Pagination and search variables
let currentPage = 1;
let itemsPerPage = 10;
let filteredData = [...extendedReturnData];
let searchQuery = '';

// Initialize charts
let returnsChart, categoryChart;

// Format number function
function formatNumber(num) {
  return num.toLocaleString();
}

// Format currency function
function formatCurrency(num) {
  return '$' + num.toFixed(2);
}

// Search functionality
function performSearch(query) {
  searchQuery = query.toLowerCase();
  filteredData = extendedReturnData.filter(item => 
    item.category.toLowerCase().includes(searchQuery) ||
    item.branch.toLowerCase().includes(searchQuery) ||
    item.supplier.toLowerCase().includes(searchQuery) ||
    item.status.toLowerCase().includes(searchQuery) ||
    item.date.includes(searchQuery)
  );
  currentPage = 1;
  renderReturnTable();
}

// Export to PDF function
function exportToPDF() {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF();
  
  doc.setFontSize(18);
  doc.text('Customer Returns Report', 20, 20);
  doc.setFontSize(12);
  doc.text(`Generated on: ${new Date().toLocaleDateString()}`, 20, 30);
  
  const headers = [['No', 'Category', 'Date', 'Branch', 'Supplier', 'Refund', 'Percentage', 'Status']];
  const data = filteredData.map((item, index) => [
    index + 1,
    item.category,
    item.date,
    item.branch,
    item.supplier,
    formatCurrency(item.refund),
    item.percentage + '%',
    item.status
  ]);
  
  doc.autoTable({
    head: headers,
    body: data,
    startY: 40,
    theme: 'grid',
    headStyles: { fillColor: [25, 118, 210] },
    styles: { fontSize: 8 }
  });
  
  doc.save('customer-returns-report.pdf');
}

// Export to Excel function
function exportToExcel() {
  const ws = XLSX.utils.json_to_sheet(filteredData.map((item, index) => ({
    'No': index + 1,
    'Category': item.category,
    'Date': item.date,
    'Branch': item.branch,
    'Supplier': item.supplier,
    'Refund Total': formatCurrency(item.refund),
    'Percentage': item.percentage + '%',
    'Status': item.status
  })));
  
  const wb = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(wb, ws, 'Customer Returns');
  XLSX.writeFile(wb, 'customer-returns-report.xlsx');
}

// Render Return Table
function renderReturnTable() {
  const tbody = document.getElementById('returnTableBody');
  if (!tbody) return;
  
  const startIndex = (currentPage - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  const pageData = filteredData.slice(startIndex, endIndex);
  
  tbody.innerHTML = '';
  
  pageData.forEach((item, index) => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${startIndex + index + 1}</td>
      <td class="return-category">
        <img src="../assets/img/product/product${(index % 10) + 1}.jpg" alt="product" class="product-img" style="width: 40px; height: 40px; object-fit: cover; border-radius: 6px; margin-right: 8px;" />
        ${item.category}
      </td>
      <td>${item.date}</td>
      <td><span class="return-branch">${item.branch}</span></td>
      <td>${item.supplier}</td>
      <td class="return-refund">${formatCurrency(item.refund)}</td>
      <td class="return-percentage">${item.percentage}%</td>
      <td><span class="return-status status-${item.status}">${item.status.charAt(0).toUpperCase() + item.status.slice(1)}</span></td>
      <td>
        <button class="detail-btn" onclick="showReturnDetails(${startIndex + index})">
          <i class="fas fa-eye"></i> View Details
        </button>
      </td>
    `;
    tbody.appendChild(row);
  });
}

// Show return details in modal
function showReturnDetails(index) {
  const item = filteredData[index];
  if (!item) return;
  
  document.getElementById('modalRefund').textContent = formatCurrency(item.refund);
  document.getElementById('modalPercentage').textContent = item.percentage + '%';
  document.getElementById('modalStatus').textContent = item.status.charAt(0).toUpperCase() + item.status.slice(1);
  document.getElementById('modalCategory').textContent = item.category;
  document.getElementById('modalDate').textContent = item.date;
  document.getElementById('modalBranch').textContent = item.branch;
  document.getElementById('modalSupplier').textContent = item.supplier;
  
  const modal = new bootstrap.Modal(document.getElementById('returnModal'));
  modal.show();
}

// Initialize Returns Chart
function initReturnsChart() {
  const options = {
    series: [{
      name: 'Returns Value',
      data: chartData.returns
    }],
    chart: {
      type: 'bar',
      height: 350,
      toolbar: {
        show: false
      }
    },
    colors: ['#1976d2'],
    plotOptions: {
      bar: {
        borderRadius: 4,
        horizontal: false,
        columnWidth: '60%',
      }
    },
    dataLabels: {
      enabled: false
    },
    xaxis: {
      categories: chartData.months,
      labels: {
        style: {
          colors: '#666'
        }
      }
    },
    yaxis: {
      title: {
        text: 'Return Value ($)',
        style: {
          color: '#666'
        }
      },
      labels: {
        formatter: function (val) {
          return '$' + val;
        },
        style: {
          colors: '#666'
        }
      }
    },
    grid: {
      borderColor: '#e0e0e0',
      strokeDashArray: 5,
    },
    tooltip: {
      theme: 'light',
      y: {
        formatter: function (val) {
          return '$' + val;
        }
      }
    }
  };
  
  returnsChart = new ApexCharts(document.querySelector("#returnsChart"), options);
  returnsChart.render();
}

// Initialize Category Chart
function initCategoryChart() {
  const options = {
    series: chartData.categoryData,
    chart: {
      type: 'donut',
      height: 350
    },
    colors: ['#1976d2', '#42a5f5', '#64b5f6', '#90caf9', '#bbdefb', '#e3f2fd'],
    labels: chartData.categories,
    legend: {
      position: 'bottom',
      fontSize: '12px'
    },
    plotOptions: {
      pie: {
        donut: {
          size: '70%'
        }
      }
    },
    tooltip: {
      theme: 'light',
      y: {
        formatter: function (val) {
          return val + ' returns';
        }
      }
    }
  };
  
  categoryChart = new ApexCharts(document.querySelector("#categoryChart"), options);
  categoryChart.render();
}

// Search input event listener
document.getElementById('searchInput').addEventListener('input', function() {
  performSearch(this.value);
});

// Initialize everything when page loads
document.addEventListener('DOMContentLoaded', function() {
  // Hide loader
  const loader = document.getElementById('global-loader');
  if (loader) {
    setTimeout(() => {
      loader.style.display = 'none';
    }, 1000);
  }
  
  // Initialize charts
  initReturnsChart();
  initCategoryChart();
  
  // Render initial table
  renderReturnTable();
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
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
</body>
</html>
