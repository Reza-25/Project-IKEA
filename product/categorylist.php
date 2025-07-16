<?php
require_once __DIR__ . '/../include/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>IKEA - Category Dashboard</title>

<link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg">
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/animate.css">
<link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<style>
body {
  background-color: #f8f9fa;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

a {
  text-decoration: none !important;
}

.ikea-select {
  background-color: #E6F0FF !important;
  border: 2px solid #ccc;
  color: #333;
  border-radius: 20px;
  padding: 6px 16px;
  font-size: 0.85rem;
  appearance: none;
  width: 140px;
  background-image: url("data:image/svg+xml,%3Csvg fill='%230051BA' height='20' viewBox='0 0 24 24' width='20' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 0.6rem center;
  background-size: 14px;
  transition: border-color 0.3s ease;
}

.ikea-select:hover { border-color: #0051BA; }
.ikea-select:focus {
  outline: none;
  border-color: #0051BA;
  box-shadow: 0 0 0 3px rgba(230, 240, 255, 0.8);
}

/* Stats Cards */
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

.dash-imgs i {
  font-size: 32px;
}

.das1 { border-top: 6px solid #1a5ea7; }
.das1 * { color: #1a5ea7 !important; }
.das2 { border-top: 6px solid #751e8d; }
.das2 * { color: #751e8d !important; }
.das3 { border-top: 6px solid #e78001; }
.das3 * { color: #e78001 !important; }
.das4 { border-top: 6px solid #018679; }
.das4 * { color: #018679 !important; }

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
.bg-hijau { background: linear-gradient(135deg,rgb(89, 236, 222) 0%, #018679 100%); }
.bg-merah { background: linear-gradient(135deg, #ff5858 0%, #e78001 100%); }

/* Chart Section */
.chart-section {
  background: white;
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
  color: #1976d2;
  margin: 0;
}

.chart-select {
  border: 1px solid #e0e0e0;
  border-radius: 6px;
  padding: 6px 12px;
  background: white;
  font-size: 0.9rem;
  color: #333;
}

.chart-select:focus {
  outline: none;
  border-color: #1976d2;
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
  color: #1976d2 !important;
  font-weight: 600;
}

.insight-container p {
  color: #4a5568;
  line-height: 1.5;
}

/* Sidebar Cards */
.sidebar-card {
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
  margin-bottom: 15px;
  transition: all 0.3s ease;
}

.sidebar-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
}

.sidebar-card-header {
  background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
  color: white;
  padding: 12px 15px;
  font-weight: 600;
  font-size: 0.9rem;
}

.sidebar-card-body {
  padding: 15px;
}

/* Notification Cards */
.notification-card {
  padding: 12px;
  border-radius: 8px;
  margin-bottom: 10px;
  display: flex;
  align-items: center;
  gap: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
  transition: all 0.3s ease;
  border-left: 4px solid transparent;
}

.notification-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
}

.notification-card.warning {
  background-color: #fefbf3;
  border-left-color: #d97706;
}

.notification-card.danger {
  background-color: #fef2f2;
  border-left-color: #dc2626;
}

.notification-card.info {
  background-color: #f0f9ff;
  border-left-color: #0ea5e9;
}

.notification-card h5 {
  font-size: 0.9rem;
  margin-bottom: 2px;
  font-weight: 600;
}

.notification-card p {
  font-size: 0.8rem;
  margin-bottom: 0;
  color: #6b7280;
}

/* Table Styling */
.category-table-section {
  background: white;
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 25px;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
  transition: all 0.3s ease;
}

.category-table-section:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
}

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

.category-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 15px;
}

.category-table th {
  background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
  color: #ffffff;
  font-weight: 600;
  font-size: 0.85rem;
  padding: 12px 10px;
  text-align: left;
  border-bottom: 2px solid #1565c0;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.category-table th:first-child {
  border-top-left-radius: 8px;
}

.category-table th:last-child {
  border-top-right-radius: 8px;
}

.category-table td {
  padding: 12px 10px;
  border-bottom: 1px solid #f1f5f9;
  font-size: 0.85rem;
  color: #374151;
  vertical-align: middle;
}

.category-table tbody tr:hover {
  background-color: #f8fafc;
  transition: all 0.2s ease;
}

.category-name {
  font-weight: 600;
  color: #1e293b;
}

.category-id {
  background: #f1f5f9;
  color: #475569;
  padding: 4px 8px;
  border-radius: 6px;
  font-size: 0.75rem;
  font-weight: 500;
  display: inline-block;
  font-family: 'Courier New', monospace;
}

.category-status {
  padding: 4px 8px;
  border-radius: 12px;
  font-size: 0.7rem;
  font-weight: 600;
  text-align: center;
}

.status-active { background: #d1fae5; color: #065f46; }
.status-inactive { background: #f8d7da; color: #721c24; }
.status-pending { background: #fff3cd; color: #856404; }
.status-ordered { background: #cce5ff; color: #004085; }

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
  .content {
    padding: 15px;
  }
  
  .chart-header {
    flex-direction: column;
    gap: 10px;
    text-align: center;
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
    min-height: 70px;
    padding: 12px;
  }
  
  .dash-counts h4 {
    font-size: 16px;
  }
  
  .dash-counts h5 {
    font-size: 11px;
  }
  
  .icon-box {
    width: 32px;
    height: 32px;
  }
  
  .icon-box i {
    font-size: 12px;
  }
}
/* Suggestion Card */
.suggestion-card {
  background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
  color: white;
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 15px;
  transition: all 0.3s ease;
  box-shadow: 0 4px 12px rgba(25, 118, 210, 0.2);
  position: relative;
  overflow: hidden;
}

.suggestion-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 25px rgba(25, 118, 210, 0.3);
}

.suggestion-card::before {
  content: '';
  position: absolute;
  top: -50%;
  right: -50%;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 50%;
  transition: all 0.3s ease;
}

.suggestion-card:hover::before {
  top: -30%;
  right: -30%;
}

.suggestion-header {
  display: flex;
  align-items: center;
  margin-bottom: 15px;
  gap: 10px;
}

.suggestion-icon {
  width: 40px;
  height: 40px;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.2rem;
  flex-shrink: 0;
}

.suggestion-title {
  font-size: 1.1rem;
  font-weight: 700;
  margin: 0;
  line-height: 1.3;
}

.suggestion-content {
  font-size: 0.9rem;
  line-height: 1.6;
  margin: 0;
  opacity: 0.95;
}
</style>
</head>

<body>
<div id="global-loader">
  <div class="whirly-loader"></div>
</div>

<div class="main-wrapper">
  <?php include BASE_PATH . '/include/sidebar.php'; ?>
  
  <div class="page-wrapper">
    <div class="content">
      <?php include __DIR__ . '/../include/header.php'; ?>
      
      <div class="page-header">
        <div class="page-title">
          <h4>Product Category list</h4>
          <h6>View/Search product Category</h6>
        </div>
        <div class="page-btn">
          <a href="addcategory.php" class="btn btn-added">
            <img src="../assets/img/icons/plus.svg" class="me-1" alt="img">Add Category
          </a>
        </div>
      </div>

      <!-- Stats Cards -->
      <div class="row justify-content-end">
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
          <a href="#" class="w-100 text-decoration-none text-dark">
            <div class="dash-count das1">
              <div class="dash-counts">
                <h4><span class="counters" data-count="21">21</span></h4>
                <h5>Total Categories</h5>
                <h2 class="stat-change">+2% from last year</h2>
              </div>
              <div class="icon-box bg-ungu">
                <i class="fa fa-list"></i>
              </div>
            </div>
          </a>
        </div>

        <div class="col-lg-3 col-sm-6 col-12 d-flex">
          <a href="#" class="w-100 text-decoration-none text-dark">
            <div class="dash-count das2">
              <div class="dash-counts">
                <h4><span class="counters" data-count="12840">12,840</span></h4>
                <h5>Total Products</h5>
                <h2 class="stat-change">+6.3% from last year</h2>
              </div>
              <div class="icon-box bg-biru">
                <i class="fa fa-box"></i>
              </div>
            </div>
          </a>
        </div>

        <div class="col-lg-3 col-sm-6 col-12 d-flex">
          <a href="#" class="w-100 text-decoration-none text-dark">
            <div class="dash-count das3">
              <div class="dash-counts">
                <h4><span class="counters" data-count="89">89</span>%</h4>
                <h5>Avg Popularity Index</h5>
                <h2 class="stat-change">+15% from last year</h2>
              </div>
              <div class="icon-box bg-merah">
                <i class="fa fa-chart-line"></i>
              </div>
            </div>
          </a>
        </div>

        <div class="col-lg-3 col-sm-6 col-12 d-flex">
          <a href="#" class="w-100 text-decoration-none text-dark">
            <div class="dash-count das4">
              <div class="dash-counts">
                <h4>Furniture</h4>
                <h5>Top Category</h5>
                <h2 class="stat-change">1200 products</h2>
              </div>
              <div class="icon-box bg-hijau">
                <i class="fa fa-trophy"></i>
              </div>
            </div>
          </a>
        </div>
      </div>

      <!-- Main Content -->
      <div class="row">
        <div class="col-lg-12">
          <div class="row mb-4">
            <div class="col-lg-8">
              <!-- Bar Chart -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chart-bar me-2"></i>Top 5 Categories with Highest Product Count</h5>
                  <select class="chart-select" id="barChartYear">
                    <option value="2025">2025</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                  </select>
                </div>
                <div id="barChart" style="height: 250px;"></div>
                <div class="insight-container">
                  <div class="d-flex align-items-center">
                    <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
                    <div>
                      <h5 style="font-size: 0.9rem;">Insight: Dominasi Kategori Furniture</h5>
                      <p class="mb-0">Kategori Furniture mendominasi dengan 1200 produk (9.3% dari total). Pertumbuhan stabil dengan penambahan 50 produk baru tahun ini.</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Donut Chart -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chart-pie me-2"></i>Category Distribution</h5>
                </div>
                <div id="donutChart" style="height: 250px;"></div>
                <div class="insight-container">
                  <div class="d-flex align-items-center">
                    <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
                    <div>
                      <h5 style="font-size: 0.9rem;">Insight: Diversifikasi Produk</h5>
                      <p class="mb-0">Top 5 kategori menyumbang 46.5% dari total produk. Kategori Storage menunjukkan pertumbuhan pesat dengan 950 produk.</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Line Chart -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chart-line me-2"></i>Category Growth Trend</h5>
                  <select class="chart-select" id="lineChartYear">
                    <option value="2025">2025</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                  </select>
                </div>
                <div id="lineChart" style="height: 250px;"></div>
                <div class="insight-container">
                  <div class="d-flex align-items-center">
                    <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
                    <div>
                      <h5 style="font-size: 0.9rem;">Insight: Tren Pertumbuhan Konsisten</h5>
                      <p class="mb-0">Kategori Furniture dan Storage menunjukkan tren pertumbuhan yang konsisten. Living Room kategori dengan pertumbuhan tercepat (+12% YoY).</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-lg-4">
              <!-- Prediction -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-calculator me-2"></i>Prediksi Kategori Terpopuler
                </div>
                <div class="sidebar-card-body">
                  <div class="text-center mb-3">
                    <h4 style="color: #1976d2;">Furniture</h4>
                    <p class="mb-2">diprediksi tetap menjadi kategori #1 hingga Q4 2025</p>
                    <div class="progress mb-2" style="height: 6px;">
                      <div class="progress-bar bg-success" style="width: 94%"></div>
                    </div>
                    <small class="text-muted">Akurasi prediksi: 94%</small>
                  </div>
                  <div class="row text-center">
                    <div class="col-6">
                      <h6>Q4 2025</h6>
                      <p class="mb-0 fw-bold">1,280 produk</p>
                    </div>
                    <div class="col-6">
                      <h6>Q1 2026</h6>
                      <p class="mb-0 fw-bold">1,350 produk</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Critical Notifications -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-bell me-2"></i>Notifikasi Kategori
                </div>
                <div class="sidebar-card-body">
                  <div class="notification-card warning">
                    <i class="fas fa-exclamation-triangle text-warning"></i>
                    <div>
                      <h5>Decoration - Produk Sedikit</h5>
                      <p>Hanya 300 produk, perlu ekspansi</p>
                    </div>
                  </div>
                  
                  <div class="notification-card info">
                    <i class="fas fa-trending-up text-info"></i>
                    <div>
                      <h5>Children - Kategori Berkembang</h5>
                      <p>Pertumbuhan 25% dalam 6 bulan terakhir</p>
                    </div>
                  </div>
                  
                  <div class="notification-card danger">
                    <i class="fas fa-pause-circle text-danger"></i>
                    <div>
                      <h5>Appliances - Status Pending</h5>
                      <p>Perlu review untuk aktivasi</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Category Performance -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-chart-bar me-2"></i>Performa Kategori
                </div>
                <div class="sidebar-card-body">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                      <h6 class="mb-1">Furniture</h6>
                      <small class="text-muted">1,200 produk • Index: 89</small>
                    </div>
                    <div class="text-success fw-bold">Excellent</div>
                  </div>
                  
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                      <h6 class="mb-1">Living Room</h6>
                      <small class="text-muted">1,100 produk • Index: 85</small>
                    </div>
                    <div class="text-success fw-bold">Very Good</div>
                  </div>
                  
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <h6 class="mb-1">Storage</h6>
                      <small class="text-muted">950 produk • Index: 70</small>
                    </div>
                    <div class="text-warning fw-bold">Good</div>
                  </div>
                </div>
              </div>

              <!-- Popular Categories -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-star me-2"></i>Kategori Populer
                </div>
                <div class="sidebar-card-body">
                  <div class="mb-3">
                    <h6>Furniture</h6>
                    <div class="d-flex justify-content-between">
                      <span class="badge bg-primary">Top Category</span>
                      <span class="fw-bold">1,200 produk</span>
                    </div>
                  </div>
                  
                  <div class="mb-3">
                    <h6>Living Room</h6>
                    <div class="d-flex justify-content-between">
                      <span class="badge bg-success">Rising Star</span>
                      <span class="fw-bold">1,100 produk</span>
                    </div>
                  </div>
                  
                  <div>
                    <h6>Bedroom</h6>
                    <div class="d-flex justify-content-between">
                      <span class="badge bg-info">Stable</span>
                      <span class="fw-bold">1,000 produk</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- AI Suggestion -->
              <div class="suggestion-card">
                <div class="suggestion-header">
                  <div class="suggestion-icon">
                    <i class="fas fa-brain"></i>
                  </div>
                  <h4 class="suggestion-title">AI Suggestion: Produk Baru yang Potensial</h4>
                </div>
                <p class="suggestion-content">"Pencarian untuk 'rak dinding kayu minimalis' meningkat 45% dalam 3 bulan terakhir. Pertimbangkan menambahkan varian ini di koleksi LACK."</p>
              </div>
            </div>
          </div>

          <!-- Category Table -->
          <div class="category-table-section">
            <div class="chart-header">
              <h5 class="chart-title"><i class="fas fa-table me-2"></i>Data Kategori IKEA</h5>
              <div class="d-flex align-items-center gap-2">
                <span style="font-size: 0.8rem; color: #64748b;" id="totalCategoriesText">Total: 21 categories</span>
              </div>
            </div>
            
            <div class="table-controls">
              <div class="search-container">
                <input type="text" class="search-input" id="searchInput" placeholder="Cari kategori, deskripsi, atau status...">
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
            
            <table class="category-table" id="categoryTable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>ID Category</th>
                  <th>Category</th>
                  <th>Description</th>
                  <th>Product Count</th>
                  <th>Created Date</th>
                  <th>Created By</th>
                  <th>Status</th>
                  <th>Popularity Index</th>
                </tr>
              </thead>
              <tbody id="categoryTableBody">
                <!-- Data will be populated by JavaScript -->
              </tbody>
            </table>
            
            <div class="no-results" id="noResults" style="display: none;">
              <i class="fas fa-search"></i>
              <h5>Tidak ada data yang ditemukan</h5>
              <p>Coba ubah kata kunci pencarian Anda</p>
            </div>
            
            <div class="table-pagination" id="tablePagination">
              <div class="pagination-info" id="paginationInfo">
                Menampilkan 1-8 dari 21 kategori
              </div>
              <div class="pagination-controls">
                <button class="pagination-btn" id="prevBtn" onclick="changePage(-1)">
                  <i class="fas fa-chevron-left"></i> Prev
                </button>
                <button class="pagination-btn active" id="page1Btn" onclick="goToPage(1)">1</button>
                <button class="pagination-btn" id="page2Btn" onclick="goToPage(2)">2</button>
                <button class="pagination-btn" id="page3Btn" onclick="goToPage(3)">3</button>
                <button class="pagination-btn" id="nextBtn" onclick="changePage(1)">
                  Next <i class="fas fa-chevron-right"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// Data kategori yang lengkap - 21 kategori
const categoryData = [
  ["CAT-01", "Furniture", "Furnitur rumah", 1200, "01 Jan 2022", "Admin A", "Active", 89],
  ["CAT-02", "Lighting", "Pencahayaan rumah modern", 800, "10 Jan 2022", "Admin B", "Inactive", 78],
  ["CAT-03", "Storage", "Lemari dan rak serbaguna", 950, "20 Jan 2022", "Admin C", "Pending", 70],
  ["CAT-04", "Bedroom", "Perlengkapan kamar tidur", 1000, "01 Feb 2022", "Admin D", "Active", 82],
  ["CAT-05", "Living Room", "Dekorasi dan sofa ruang tamu", 1100, "05 Feb 2022", "Admin E", "Pending", 85],
  ["CAT-06", "Kitchen", "Peralatan dapur modern", 700, "10 Feb 2022", "Admin F", "Active", 68],
  ["CAT-07", "Dining", "Meja makan dan aksesoris", 600, "15 Feb 2022", "Admin G", "Ordered", 62],
  ["CAT-08", "Office", "Furniture kantor fungsional", 550, "20 Feb 2022", "Admin H", "Active", 60],
  ["CAT-09", "Outdoor", "Furniture dan dekorasi luar ruangan", 400, "01 Mar 2022", "Admin I", "Pending", 58],
  ["CAT-10", "Textiles", "Tekstil dan karpet rumah", 650, "05 Mar 2022", "Admin J", "Pending", 66],
  ["CAT-11", "Decoration", "Hiasan dan ornamen", 300, "10 Mar 2022", "Admin K", "Active", 52],
  ["CAT-12", "Bathroom", "Perlengkapan kamar mandi", 480, "15 Mar 2022", "Admin L", "Pending", 57],
  ["CAT-13", "Children", "Produk anak-anak", 500, "20 Mar 2022", "Admin M", "Active", 59],
  ["CAT-14", "Appliances", "Peralatan rumah tangga", 320, "25 Mar 2022", "Admin N", "Ordered", 49],
  ["CAT-15", "Rugs", "Karpet berbagai ukuran", 430, "01 Apr 2022", "Admin O", "Active", 53],
  ["CAT-16", "Mirrors", "Cermin dan aksesoris", 280, "05 Apr 2022", "Admin P", "Active", 48],
  ["CAT-17", "Curtains", "Tirai dan gorden", 350, "10 Apr 2022", "Admin Q", "Pending", 51],
  ["CAT-18", "Plants", "Tanaman dan pot", 420, "15 Apr 2022", "Admin R", "Active", 55],
  ["CAT-19", "Laundry", "Perlengkapan cuci", 260, "20 Apr 2022", "Admin S", "Pending", 45],
  ["CAT-20", "Cleaning", "Peralatan kebersihan", 290, "25 Apr 2022", "Admin T", "Active", 47],
  ["CAT-21", "Pet", "Produk untuk hewan peliharaan", 180, "30 Apr 2022", "Admin U", "Ordered", 42]
];

// Chart data
const barChartData = {
  2025: {
    categories: categoryData.slice(0, 5).map(item => item[1]),
    counts: categoryData.slice(0, 5).map(item => item[3])
  },
  2024: {
    categories: categoryData.slice(0, 5).map(item => item[1]),
    counts: categoryData.slice(0, 5).map(item => Math.floor(item[3] * 0.9))
  },
  2023: {
    categories: categoryData.slice(0, 5).map(item => item[1]),
    counts: categoryData.slice(0, 5).map(item => Math.floor(item[3] * 0.8))
  }
};

const lineChartData = {
  2025: [
    { name: "Furniture", data: [1000, 1050, 1100, 1120, 1150, 1180, 1200, 1220] },
    { name: "Living Room", data: [900, 950, 1000, 1030, 1060, 1080, 1100, 1120] },
    { name: "Bedroom", data: [850, 880, 920, 950, 980, 1000, 1020, 1040] },
    { name: "Storage", data: [800, 830, 870, 900, 920, 940, 950, 970] },
    { name: "Lighting", data: [700, 720, 750, 770, 780, 790, 800, 810] }
  ],
  2024: [
    { name: "Furniture", data: [800, 850, 900, 920, 950, 980, 1000, 1020] },
    { name: "Living Room", data: [700, 750, 800, 830, 860, 880, 900, 920] },
    { name: "Bedroom", data: [650, 680, 720, 750, 780, 800, 820, 840] },
    { name: "Storage", data: [600, 630, 670, 700, 720, 740, 750, 770] },
    { name: "Lighting", data: [500, 520, 550, 570, 580, 590, 600, 610] }
  ],
  2023: [
    { name: "Furniture", data: [600, 650, 700, 720, 750, 780, 800, 820] },
    { name: "Living Room", data: [500, 550, 600, 630, 660, 680, 700, 720] },
    { name: "Bedroom", data: [450, 480, 520, 550, 580, 600, 620, 640] },
    { name: "Storage", data: [400, 430, 470, 500, 520, 540, 550, 570] },
    { name: "Lighting", data: [300, 320, 350, 370, 380, 390, 400, 410] }
  ]
};

// Table functionality
let currentPage = 1;
let itemsPerPage = 8;
let filteredData = [...categoryData];
let searchQuery = '';

let barChart, donutChart, lineChart;

// Search functionality
function performSearch(query) {
  searchQuery = query.toLowerCase();
  
  if (searchQuery === '') {
    filteredData = [...categoryData];
  } else {
    filteredData = categoryData.filter(category => 
      category[0].toLowerCase().includes(searchQuery) ||
      category[1].toLowerCase().includes(searchQuery) ||
      category[2].toLowerCase().includes(searchQuery) ||
      category[5].toLowerCase().includes(searchQuery) ||
      category[6].toLowerCase().includes(searchQuery)
    );
  }
  
  currentPage = 1;
  updateTotalPages();
  renderCategoryTable(currentPage);
  updateTotalCategoriesText();
}

function updateTotalPages() {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  
  document.getElementById('page1Btn').style.display = totalPages >= 1 ? 'inline-block' : 'none';
  document.getElementById('page2Btn').style.display = totalPages >= 2 ? 'inline-block' : 'none';
  document.getElementById('page3Btn').style.display = totalPages >= 3 ? 'inline-block' : 'none';
}

function updateTotalCategoriesText() {
  const totalText = document.getElementById('totalCategoriesText');
  if (searchQuery === '') {
    totalText.textContent = `Total: ${categoryData.length} categories`;
  } else {
    totalText.textContent = `Ditemukan: ${filteredData.length} dari ${categoryData.length} categories`;
  }
}

function renderCategoryTable(page = 1) {
  const startIndex = (page - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  const pageData = filteredData.slice(startIndex, endIndex);

  const tableBody = document.getElementById('categoryTableBody');
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

  pageData.forEach((category, index) => {
    const row = document.createElement('tr');
    
    const statusClass = category[6] === 'Active' ? 'status-active' : 
                       category[6] === 'Inactive' ? 'status-inactive' : 
                       category[6] === 'Pending' ? 'status-pending' : 'status-ordered';
    
    const rowNumber = startIndex + index + 1;
    
    row.innerHTML = `
      <td style="color: #374151; font-weight: 600;">${rowNumber}</td>
      <td><span class="category-id">${category[0]}</span></td>
      <td><span class="category-name">${category[1]}</span></td>
      <td>${category[2]}</td>
      <td><span class="fw-bold text-primary">${category[3].toLocaleString()}</span></td>
      <td>${category[4]}</td>
      <td>${category[5]}</td>
      <td><span class="category-status ${statusClass}">${category[6]}</span></td>
      <td><span class="fw-bold" style="color: #059669;">${category[7]}</span></td>
    `;
    
    tableBody.appendChild(row);
  });

  // Update pagination info
  const totalItems = filteredData.length;
  const startItem = startIndex + 1;
  const endItem = Math.min(endIndex, totalItems);
  document.getElementById('paginationInfo').textContent = 
    `Menampilkan ${startItem}-${endItem} dari ${totalItems} kategori`;

  updatePaginationButtons(page);
}

function updatePaginationButtons(page) {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  
  document.getElementById('prevBtn').disabled = page === 1;
  document.getElementById('nextBtn').disabled = page === totalPages;

  document.getElementById('page1Btn').classList.toggle('active', page === 1);
  document.getElementById('page2Btn').classList.toggle('active', page === 2);
  document.getElementById('page3Btn').classList.toggle('active', page === 3);
}

function changePage(direction) {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  const newPage = currentPage + direction;
  if (newPage >= 1 && newPage <= totalPages) {
    currentPage = newPage;
    renderCategoryTable(currentPage);
  }
}

function goToPage(page) {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  if (page >= 1 && page <= totalPages) {
    currentPage = page;
    renderCategoryTable(currentPage);
  }
}

// Export functions
function exportToPDF() {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF();
  
  doc.setFontSize(16);
  doc.text('Data Kategori IKEA', 14, 22);
  
  doc.setFontSize(10);
  doc.text(`Exported on: ${new Date().toLocaleDateString('id-ID')}`, 14, 30);
  
  const tableData = filteredData.map((category, index) => [
    index + 1,
    category[0],
    category[1],
    category[2],
    category[3].toLocaleString(),
    category[4],
    category[5],
    category[6],
    category[7]
  ]);
  
  doc.autoTable({
    head: [['No', 'ID', 'Category', 'Description', 'Products', 'Created', 'Created By', 'Status', 'Index']],
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
  
  doc.save('data-kategori-ikea.pdf');
}

function exportToExcel() {
  const excelData = filteredData.map((category, index) => ({
    'No': index + 1,
    'ID Category': category[0],
    'Category': category[1],
    'Description': category[2],
    'Product Count': category[3],
    'Created Date': category[4],
    'Created By': category[5],
    'Status': category[6],
    'Popularity Index': category[7]
  }));
  
  const wb = XLSX.utils.book_new();
  const ws = XLSX.utils.json_to_sheet(excelData);
  
  XLSX.utils.book_append_sheet(wb, ws, 'Data Kategori IKEA');
  XLSX.writeFile(wb, 'data-kategori-ikea.xlsx');
}

// Initialize charts
function initBarChart(year) {
  const data = barChartData[year];

  const options = {
    series: [{
      data: data.counts
    }],
    chart: {
      type: 'bar',
      height: 250,
      toolbar: {
        show: true
      }
    },
    plotOptions: {
      bar: {
        borderRadius: 6,
        horizontal: false,
        columnWidth: '60%',
      }
    },
    dataLabels: {
      enabled: false
    },
    colors: ['#1976d2'],
    fill: {
      type: 'gradient',
      gradient: {
        shade: 'light',
        type: 'vertical',
        shadeIntensity: 0.25,
        gradientToColors: ['#64b5f6'],
        inverseColors: false,
        opacityFrom: 1,
        opacityTo: 1,
        stops: [0, 100]
      }
    },
    xaxis: {
      categories: data.categories,
    },
    yaxis: {
      title: {
        text: 'Jumlah Produk'
      },
      labels: {
        formatter: function(val) {
          return val.toLocaleString();
        }
      }
    },
    tooltip: {
      y: {
        formatter: function(val) {
          return val.toLocaleString() + ' produk';
        }
      }
    }
  };

  if (barChart) {
    barChart.destroy();
  }

  barChart = new ApexCharts(document.querySelector("#barChart"), options);
  barChart.render();
}

function initDonutChart() {
  const top5Categories = categoryData.slice(0, 5);
  const totalProducts = categoryData.reduce((sum, cat) => sum + cat[3], 0);
  const otherProducts = totalProducts - top5Categories.reduce((sum, cat) => sum + cat[3], 0);
  
  const labels = [...top5Categories.map(cat => cat[1]), 'Lainnya'];
  const series = [...top5Categories.map(cat => ((cat[3] / totalProducts) * 100).toFixed(1)), ((otherProducts / totalProducts) * 100).toFixed(1)];
  
  const options = {
    series: series.map(s => parseFloat(s)),
    chart: {
      type: 'donut',
      height: 250,
    },
    labels: labels,
    colors: ['#0d47a1', '#1565c0', '#1976d2', '#1e88e5', '#2196f3', '#42a5f5'],
    plotOptions: {
      pie: {
        donut: {
          size: '60%',
          labels: {
            show: true,
            total: {
              show: true,
              label: 'Total',
              formatter: function (w) {
                return '100%'
              }
            }
          }
        }
      }
    },
    dataLabels: {
      formatter: function(val) {
        return val.toFixed(1) + '%';
      }
    },
    legend: {
      position: 'bottom',
      horizontalAlign: 'center'
    }
  };

  if (donutChart) {
    donutChart.destroy();
  }

  donutChart = new ApexCharts(document.querySelector("#donutChart"), options);
  donutChart.render();
}

function initLineChart(year) {
  const data = lineChartData[year];

  const options = {
    series: data,
    chart: {
      height: 250,
      type: 'line',
      zoom: {
        enabled: false
      }
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
      width: 2,
    },
    colors: ['#0d47a1', '#1565c0', '#1976d2', '#1e88e5', '#2196f3'],
    xaxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags'],
    },
    yaxis: {
      title: {
        text: 'Jumlah Produk'
      }
    },
    tooltip: {
      y: {
        formatter: function(val) {
          return val + ' produk';
        }
      }
    },
    legend: {
      position: 'bottom'
    }
  };

  if (lineChart) {
    lineChart.destroy();
  }

  lineChart = new ApexCharts(document.querySelector("#lineChart"), options);
  lineChart.render();
}

// Event listeners
document.getElementById('barChartYear').addEventListener('change', function() {
  const year = this.value;
  initBarChart(year);
});

document.getElementById('lineChartYear').addEventListener('change', function() {
  const year = this.value;
  initLineChart(year);
});

document.getElementById('searchInput').addEventListener('input', function() {
  performSearch(this.value);
});

// Initialize everything
document.addEventListener('DOMContentLoaded', function() {
  setTimeout(function() {
    document.getElementById('global-loader').style.display = 'none';
  }, 1000);

  initBarChart('2025');
  initDonutChart();
  initLineChart('2025');
  renderCategoryTable(1);
  updateTotalCategoriesText();
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