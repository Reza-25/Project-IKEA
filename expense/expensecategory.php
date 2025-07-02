<!-- animation, hover, shadow -->
<?php
require_once __DIR__ . '/../include/config.php'; // Import config.php
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
    <title>Dreams Pos admin template</title>

    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg" />

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />

    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css" />

    <link rel="stylesheet" href="../assets/css/animate.css" />

    <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css" />

    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css" />

    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css" />

    <link rel="stylesheet" href="../assets/css/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
   <style>
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
  font-size: 16 px;
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
 {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Card Structure Styles */
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .card-body {
            padding: 20px;
        }

        /* Table Top Styles */
        .table-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .search-set {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: white;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-filter, .btn-searchset {
            background: #007bff;
            color: white;
            border-color: #007bff;
        }

        .wordset ul {
            display: flex;
            list-style: none;
            gap: 10px;
        }

        .wordset a {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: white;
            text-decoration: none;
        }

        /* Filter Inputs */
        #filter_inputs {
            margin-bottom: 20px;
            display: none;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: -5px;
        }

        .col-lg-2, .col-lg-1 {
            flex: 0 0 auto;
            padding: 5px;
        }

        .col-lg-2 { width: 16.666%; }
        .col-lg-1 { width: 8.333%; }

        @media (max-width: 768px) {
            .col-lg-2, .col-lg-1 { width: 100%; }
        }

        /* Categories Grid Styles */
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 kolom per baris */
            gap: 20px;
            margin-top: 20px;
        }

        @media (max-width: 1200px) {
            .categories-grid {
                grid-template-columns: repeat(2, 1fr); /* 2 kolom untuk layar sedang */
            }
        }
        @media (max-width: 768px) {
            .categories-grid {
                grid-template-columns: 1fr; /* 1 kolom untuk mobile */
            }
        }

        .category-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .category-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .category-title {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
            margin: 0;
        }

        .status-indicator {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .status-dot.safe {
            background-color: #10b981;
        }

        .status-dot.warning {
            background-color: #f59e0b;    
        }

        .status-dot.danger {
            background-color: #ef4444;
        }

        .status-text {
            font-size: 12px;
            font-weight: 500;
            color: #6b7280;
        }

        .amount-info {
            margin-bottom: 20px;
        }

        .amount-main {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .amount-budget {
            font-size: 14px;
            color: #6b7280;
        }

        .progress-section {
            margin-bottom: 20px;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .progress-label {
            font-size: 14px;
            color: #6b7280;
        }

        .progress-percentage {
            font-size: 14px;
            font-weight: 600;
            color: #1f2937;
        }

        .progress-bar {
            height: 8px;
            background-color: #f3f4f6 !important;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        .progress-fill.safe {
            background: linear-gradient(90deg, #10b981, #059669);
        }

        .progress-fill.warning {
            background: linear-gradient(90deg, #f59e0b, #d97706);
        }

        .progress-fill.danger {
            background: linear-gradient(90deg, #ef4444, #dc2626);
        }

        .engagements {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 16px;
            background-color: #f9fafb;
            border-radius: 8px;
        }

        .engagement-item {
            text-align: center;
            flex: 1;
        }

        .engagement-item .number {
            font-size: 20px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .engagement-item .label {
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            font-weight: 500;
        }

        .engagement-item.total .number {
            color: #3b82f6;
        }

        .engagement-item.active .number {
            color: #10b981;
        }

        .engagement-item.inactive .number {
            color: #ef4444;
        }

        .view-all-btn {
            width: 100%;
            background: linear-gradient(135deg, #26c6da 0%, #1a5ea7 100%);
            color: white;
            border: none;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .view-all-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .view-all-btn span {
            font-size: 16px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .categories-grid {
                grid-template-columns: 1fr;
            }
            
            .table-top {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }
            
            .search-set {
                justify-content: center;
            }
             body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-container {
            display: flex;
            gap: 20px;
            padding: 20px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .cards-container {
            flex: 0 0 70%;
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .side-container {
            flex: 1;
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .category-card {
            background: #fff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .category-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .category-title {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }

        .status-indicator {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .status-dot.safe {
            background-color: #28a745;
        }

        .status-dot.warning {
            background-color: #ffc107;
        }

        .status-dot.danger {
            background-color: #dc3545;
        }

        .status-text {
            font-size: 12px;
            font-weight: 500;
            color: #6c757d;
        }

        .amount-info {
            margin-bottom: 12px;
        }

        .amount-main {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 4px;
        }

        .amount-budget {
            font-size: 12px;
            color: #6c757d;
        }

        .progress-section {
            margin-bottom: 12px;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 6px;
        }

        .progress-label {
            font-size: 12px;
            color: #6c757d;
        }

        .progress-percentage {
            font-size: 12px;
            font-weight: 600;
            color: #2c3e50;
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            background-color: #e9ecef;
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            transition: width 0.3s ease;
        }

        .progress-fill.safe {
            background-color: #28a745;
        }

        .progress-fill.warning {
            background-color: #ffc107;
        }

        .progress-fill.danger {
            background-color: #dc3545;
        }

        .engagements {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            padding: 10px 0;
            background: #f9fafb;
            border-radius: 8px;
        }

        .engagement-item {
            text-align: center;
            flex: 1;
        }

        .engagement-item .number {
            font-size: 16px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 2px;
        }

        .engagement-item .label {
            font-size: 10px;
            color: #6c757d;
            text-transform: uppercase;
            font-weight: 500;
        }

        .engagement-item.total .number {
            color: #17a2b8;
        }

        .engagement-item.active .number {
            color: #28a745;
        }

        .engagement-item.inactive .number {
            color: #6c757d;
        }

        .view-all-btn {
            width: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .view-all-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .view-all-btn span {
            font-size: 12px;
        }

        /* Side Container Styling */
        .side-container h3 {
            color: #2c3e50;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f8f9fa;
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .summary-label {
            font-size: 14px;
            color: #6c757d;
        }

        .summary-value {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
        }

        .summary-total {
            background: linear-gradient(135deg, #0d47a1 0%, #66bfff 100%);
            color: white;
            padding: 13px;
            border-radius: 8px;
            margin-top: 15px;
            text-align: left;
        }

        .summary-total .summary-label {
            color: rgba(255,255,255,0.9);
            font-size: 15px;
            font-weight: 500;
            margin-bottom: 2px;
        }

        .summary-total .summary-value {
            color: white;
            font-size: 20px;
            font-weight: 700;
        }

        @media (max-width: 1200px) {
            .categories-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
                padding: 15px;
            }
            
            .cards-container {
                flex: none;
            }
            
            .categories-grid {
                grid-template-columns: 1fr;
            }
            
        }

        /* Chart Section Styles */
        #expenseBarChart {
            max-width: 100%;
            margin: 0 auto;
        }

        .apexcharts-canvas {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
        }

        .apexcharts-tooltip {
            background: rgba(0, 0, 0, 0.8) !important;
            color: #fff !important;
            border-radius: 4px !important;
            padding: 8px !important;
            font-size: 14px !important;
        }

        .apexcharts-xaxis-label {
            font-size: 12px !important;
            color: #6c757d !important;
        }

        .apexcharts-yaxis-label {
            font-size: 12px !important;
            color: #6c757d !important;
        }

        .apexcharts-bar {
            transition: all 0.3s ease;
        }

        .apexcharts-bar:hover {
            transform: translateY(-2px);
        }

        /* Custom scrollbar for tables */
        .table-responsive {
            -webkit-overflow-scrolling: touch;
            overflow-x: auto;
        }

        .table {
            min-width: 600px;
        }

        /* Modal styles */
        .modal-content {
            border-radius: 12px;
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .btn-close {
            opacity: 0.7;
        }

        .btn-close:hover {
            opacity: 1;
        }

        /* Custom badge styles */
        .badges {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .bg-lightgreen {
            background-color: #d4edda;
            color: #155724;
        }

        .bg-lightred {
            background-color: #f8d7da;
            color: #721c24;
        }
      }
</style>

  </head>
  <body>
    <div id="global-loader">
      <div class="whirly-loader"></div>
    </div>

    <div class="main-wrapper">
    <?php include __DIR__ . '/../include/header.php'; ?> <!-- Import header -->
      <!-- Include sidebar -->
      <?php include BASE_PATH . '/include/sidebar.php'; ?> <!-- Import sidebar -->


      <div class="page-wrapper">
        <div class="content">
          <div class="page-header">
            <div class="page-title">
              <h4>Expenses Category</h4>
              <h6>Manage your purchases</h6>
            </div>
          </div>

          <!-- Total Expenses, Top Category, Top Expense, Avg Daily Expense -->
          <div class="row justify-content-end">
            <!-- Total Product Sold -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="revenue/revenue.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das1">
                  <div class="dash-counts">
                    <h4>$<span class="counters" data-count="385656.50">385,656.50</span></h4>
                    <h5>Total Expenses</h5>
                    <h2 class="stat-change">+8% from last year</h2>
                    </div>
                    <div class="icon-box bg-ungu">
                      <i class="fa fa-box"></i>
                    </div>
                </div>
              </a>
            </div>

            <!-- Most Popular Category -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="people/supplierlist.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das2">
                  <div class="dash-counts">
                    <h4>Logistics</h4>
                    <h5>Top Expense Cat.</h5>
                  <h2 class="stat-change">43% of total</h2>
                </div>
                <div class="icon-box bg-biru">
                  <i class="fa fa-couch"></i>
                </div>
                </div>
              </a>
            </div>

            <!-- Top-Selling Product -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="product/productsold.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das3">
                  <div class="dash-counts">
                    <h4><span class="counters" data-count="7863"></span></h4>
                    <h5>Top Single Expense</h5>
                    <h2 class="stat-change">+18% over averange</h2>
                  </div>
                  <div class="icon-box bg-merah">
                    <i class="fa fa-exclamation-triangle"></i>
                  </div>
                </div>
              </a>
            </div>

            <!-- Average Product Sales -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="expense/expensecategory.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das4">
                  <div class="dash-counts">
                    <h4>$<span class="counters" data-count="185556.30">185,556.30</span></h4>
                    <h5>Avg. Daily Expense</h5>
                   <h2 class="stat-change">+5% from last month</h2>
                    </div>
                    <div class="icon-box bg-hijau">
                      <i class="fa fa-chart-line"></i>
                    </div>
                </div>
              </a>
            </div>
          </div>
          <!-- END KOLOM  -->

        <!-- CHART SECTION -->
<div class="row mt-4" style="gap:24px;">
  <!-- CHART (70%) -->
  <div class="col-md-8" style="flex:0 0 70%;max-width:70%;">
    <div class="card shadow-sm" style="border-radius:18px; padding:24px 24px 18px 24px; background:#fff;">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0 fw-bold" style="color:#2266d1;">Total Expense per Bulan</h5>
        <select id="yearSelector" class="form-select form-select-sm" style="width:auto;min-width:90px;border-radius:8px;">
          <option>2025</option>
          <option>2024</option>
        </select>
      </div>
      <div>
        <div id="expenseBarChart" style="min-height:320px;"></div>
      </div>
    </div>
    <!-- Cards-container DIPINDAH ke sini, di luar card chart, tapi tetap dalam col-md-8 -->
    <div class="cards-container" style="flex: 0 0 70%; max-width: 100%; margin-top: 18px;">
      <div id="cardsView" class="categories-grid" style="grid-template-columns: repeat(3, 1fr); gap: 16px;">
        <!-- Card 1 -->
        <div class="category-card">
          <div class="category-header">
            <h5 class="category-title">Supplies</h5>
            <div class="status-indicator">
              <div class="status-dot safe"></div>
              <span class="status-text">On Track</span>
            </div>
          </div>
          <div class="amount-info">
            <div class="amount-main">Rp 45.000.000</div>
            <div class="amount-budget">Budget: Rp 50.000.000</div>
          </div>
          <div class="progress-section">
            <div class="progress-header">
              <span class="progress-label">Budget Terpakai</span>
              <span class="progress-percentage">90.0%</span>
            </div>
            <div class="progress-bar">
              <div class="progress-fill safe" style="width: 90%"></div>
            </div>
          </div>
          <div style="display: flex; justify-content: space-between; align-items: center; gap: 8px; margin-bottom: 12px;">
            <div style="text-align:center; flex:1;">
              <div class="number" style="font-size:16px; font-weight:700; color:#3b82f6;">45</div>
              <div class="label" style="font-size:10px; color:#6c757d; text-transform:uppercase; font-weight:500;">Total</div>
            </div>
            <div style="text-align:center; flex:1;">
              <div class="number" style="font-size:16px; font-weight:700; color:#10b981;">32</div>
              <div class="label" style="font-size:10px; color:#6c757d; text-transform:uppercase; font-weight:500;">Done</div>
            </div>
            <div style="text-align:center; flex:1;">
              <div class="number" style="font-size:16px; font-weight:700; color:#ef4444;">13</div>
              <div class="label" style="font-size:10px; color:#6c757d; text-transform:uppercase; font-weight:500;">Ongoing</div>
            </div>
          </div>
          <button class="view-all-btn" onclick="showCategoryDetails('Supplies')">
            <span>👁️</span>
            VIEW ALL
          </button>
        </div>

        <!-- Card 2 -->
        <div class="category-card">
          <div class="category-header">
            <h5 class="category-title">Utilities</h5>
            <div class="status-indicator">
              <div class="status-dot safe"></div>
              <span class="status-text">On Track</span>
            </div>
          </div>
          <div class="amount-info">
            <div class="amount-main">Rp 25.000.000</div>
            <div class="amount-budget">Budget: Rp 30.000.000</div>
          </div>
          <div class="progress-section">
            <div class="progress-header">
              <span class="progress-label">Budget Terpakai</span>
              <span class="progress-percentage">83.3%</span>
            </div>
            <div class="progress-bar">
              <div class="progress-fill safe" style="width: 83.3%"></div>
            </div>
          </div>
          <div style="display: flex; justify-content: space-between; align-items: center; gap: 8px; margin-bottom: 12px;">
            <div style="text-align:center; flex:1;">
              <div class="number" style="font-size:16px; font-weight:700; color:#3b82f6;">12</div>
              <div class="label" style="font-size:10px; color:#6c757d; text-transform:uppercase; font-weight:500;">Total</div>
            </div>
            <div style="text-align:center; flex:1;">
              <div class="number" style="font-size:16px; font-weight:700; color:#10b981;">9</div>
              <div class="label" style="font-size:10px; color:#6c757d; text-transform:uppercase; font-weight:500;">Done</div>
            </div>
            <div style="text-align:center; flex:1;">
              <div class="number" style="font-size:16px; font-weight:700; color:#ef4444;">3</div>
              <div class="label" style="font-size:10px; color:#6c757d; text-transform:uppercase; font-weight:500;">Ongoing</div>
            </div>
          </div>
          <button class="view-all-btn" onclick="showCategoryDetails('Utilities')">
            <span>👁️</span>
            VIEW ALL
          </button>
        </div>

        <!-- Card 3 -->
        <div class="category-card">
          <div class="category-header">
            <h5 class="category-title">Transport</h5>
            <div class="status-indicator">
              <div class="status-dot safe"></div>
              <span class="status-text">On Track</span>
            </div>
          </div>
          <div class="amount-info">
            <div class="amount-main">Rp 18.000.000</div>
            <div class="amount-budget">Budget: Rp 25.000.000</div>
          </div>
          <div class="progress-section">
            <div class="progress-header">
              <span class="progress-label">Budget Terpakai</span>
              <span class="progress-percentage">72.0%</span>
            </div>
            <div class="progress-bar">
              <div class="progress-fill safe" style="width: 72%"></div>
            </div>
          </div>
          <div style="display: flex; justify-content: space-between; align-items: center; gap: 8px; margin-bottom: 12px;">
            <div style="text-align:center; flex:1;">
              <div class="number" style="font-size:16px; font-weight:700; color:#3b82f6;">18</div>
              <div class="label" style="font-size:10px; color:#6c757d; text-transform:uppercase; font-weight:500;">Total</div>
            </div>
            <div style="text-align:center; flex:1;">
              <div class="number" style="font-size:16px; font-weight:700; color:#10b981;">12</div>
              <div class="label" style="font-size:10px; color:#6c757d; text-transform:uppercase; font-weight:500;">Done</div>
            </div>
            <div style="text-align:center; flex:1;">
              <div class="number" style="font-size:16px; font-weight:700; color:#ef4444;">6</div>
              <div class="label" style="font-size:10px; color:#6c757d; text-transform:uppercase; font-weight:500;">Ongoing</div>
            </div>
          </div>
          <button class="view-all-btn" onclick="showCategoryDetails('Transport')">
            <span>👁️</span>
            VIEW ALL
          </button>
        </div>

        <!-- Card 4 -->
        <div class="category-card">
          <div class="category-header">
            <h5 class="category-title">Employee</h5>
            <div class="status-indicator">
              <div class="status-dot warning"></div>
              <span class="status-text">Near Limit</span>
            </div>
          </div>
          <div class="amount-info">
            <div class="amount-main">Rp 95.000.000</div>
            <div class="amount-budget">Budget: Rp 100.000.000</div>
          </div>
          <div class="progress-section">
            <div class="progress-header">
              <span class="progress-label">Budget Terpakai</span>
              <span class="progress-percentage">95.0%</span>
            </div>
            <div class="progress-bar">
              <div class="progress-fill warning" style="width: 95%"></div>
            </div>
          </div>
          <div style="display: flex; justify-content: space-between; align-items: center; gap: 8px; margin-bottom: 12px;">
            <div style="text-align:center; flex:1;">
              <div class="number" style="font-size:16px; font-weight:700; color:#3b82f6;">30</div>
              <div class="label" style="font-size:10px; color:#6c757d; text-transform:uppercase; font-weight:500;">Total</div>
            </div>
            <div style="text-align:center; flex:1;">
              <div class="number" style="font-size:16px; font-weight:700; color:#10b981;">22</div>
              <div class="label" style="font-size:10px; color:#6c757d; text-transform:uppercase; font-weight:500;">Done</div>
            </div>
            <div style="text-align:center; flex:1;">
              <div class="number" style="font-size:16px; font-weight:700; color:#ef4444;">8</div>
              <div class="label" style="font-size:10px; color:#6c757d; text-transform:uppercase; font-weight:500;">Ongoing</div>
            </div>
          </div>
          <button class="view-all-btn" onclick="showCategoryDetails('Employee')">
            <span>👁️</span>
            VIEW ALL
          </button>
        </div>

        <!-- Card 5 -->
        <div class="category-card">
          <div class="category-header">
            <h5 class="category-title">Technology</h5>
            <div class="status-indicator">
              <div class="status-dot safe"></div>
              <span class="status-text">On Track</span>
            </div>
          </div>
          <div class="amount-info">
            <div class="amount-main">Rp 60.000.000</div>
            <div class="amount-budget">Budget: Rp 80.000.000</div>
          </div>
          <div class="progress-section">
            <div class="progress-header">
              <span class="progress-label">Budget Terpakai</span>
              <span class="progress-percentage">75.0%</span>
            </div>
            <div class="progress-bar">
              <div class="progress-fill safe" style="width: 75%"></div>
            </div>
          </div>
          <div style="display: flex; justify-content: space-between; align-items: center; gap: 8px; margin-bottom: 12px;">
            <div style="text-align:center; flex:1;">
              <div class="number" style="font-size:16px; font-weight:700; color:#3b82f6;">15</div>
              <div class="label" style="font-size:10px; color:#6c757d; text-transform:uppercase; font-weight:500;">Total</div>
            </div>
            <div style="text-align:center; flex:1;">
              <div class="number" style="font-size:16px; font-weight:700; color:#10b981;">11</div>
              <div class="label" style="font-size:10px; color:#6c757d; text-transform:uppercase; font-weight:500;">Done</div>
            </div>
            <div style="text-align:center; flex:1;">
              <div class="number" style="font-size:16px; font-weight:700; color:#ef4444;">4</div>
              <div class="label" style="font-size:10px; color:#6c757d; text-transform:uppercase; font-weight:500;">Ongoing</div>
            </div>
          </div>
          <button class="view-all-btn" onclick="showCategoryDetails('Technology')">
            <span>👁️</span>
            VIEW ALL
          </button>
        </div>

        <!-- Card 6 -->
        <div class="category-card">
          <div class="category-header">
            <h5 class="category-title">Marketing</h5>
            <div class="status-indicator">
              <div class="status-dot safe"></div>
              <span class="status-text">On Track</span>
            </div>
          </div>
          <div class="amount-info">
            <div class="amount-main">Rp 35.000.000</div>
            <div class="amount-budget">Budget: Rp 40.000.000</div>
          </div>
          <div class="progress-section">
            <div class="progress-header">
              <span class="progress-label">Budget Terpakai</span>
              <span class="progress-percentage">87.5%</span>
            </div>
            <div class="progress-bar">
              <div class="progress-fill safe" style="width: 87.5%"></div>
            </div>
          </div>
          <div style="display: flex; justify-content: space-between; align-items: center; gap: 8px; margin-bottom: 12px;">
            <div style="text-align:center; flex:1;">
              <div class="number" style="font-size:16px; font-weight:700; color:#3b82f6;">20</div>
              <div class="label" style="font-size:10px; color:#6c757d; text-transform:uppercase; font-weight:500;">Total</div>
            </div>
            <div style="text-align:center; flex:1;">
              <div class="number" style="font-size:16px; font-weight:700; color:#10b981;">15</div>
              <div class="label" style="font-size:10px; color:#6c757d; text-transform:uppercase; font-weight:500;">Done</div>
            </div>
            <div style="text-align:center; flex:1;">
              <div class="number" style="font-size:16px; font-weight:700; color:#ef4444;">5</div>
              <div class="label" style="font-size:10px; color:#6c757d; text-transform:uppercase; font-weight:500;">Ongoing</div>
            </div>
          </div>
          <button class="view-all-btn" onclick="showCategoryDetails('Marketing')">
            <span>👁️</span>
            VIEW ALL
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- SUMMARY (30%) -->
  <div class="col-md-4" style="flex:1;max-width:30%;">
    <!-- DETAIL EXPENSE DULU -->
    <div class="card shadow-sm" style="border-radius:22px; background:#fff; padding:0 0 18px 0; margin-bottom:24px;">
      <div style="background:linear-gradient(90deg,#0d47a1 0%,#66bfff 100%); border-radius:22px 22px 0 0; padding:14px 22px;">
        <span style="color:#fff; font-weight:600; font-size:15px;">Detail Expense: <span id="summaryPeriod">Jan - 2025</span></span>
      </div>
      <div style="padding:18px 18px 0 18px;">
        <div class="d-flex align-items-center mb-2" style="gap:8px; font-size:13px;">
          <i class="fa fa-wallet" style="color:#3793ff; font-size:16px;"></i>
          <span>Total Expense</span>
          <span class="ms-auto fw-bold" style="color:#2266d1; font-size:14px;" id="summaryTotalExpense">Rp 0</span>
        </div>
        <div class="d-flex align-items-center mb-2" style="gap:8px; font-size:13px;">
          <i class="fa fa-list" style="color:#10b981; font-size:16px;"></i>
          <span>Top Category</span>
          <span class="ms-auto fw-bold" style="color:#10b981; font-size:14px;" id="summaryTopCategory">-</span>
        </div>
        <div class="d-flex align-items-center mb-2" style="gap:8px; font-size:13px;">
          <i class="fa fa-money-bill-wave" style="color:#f59e0b; font-size:16px;"></i>
          <span>Top Expense</span>
          <span class="ms-auto fw-bold" style="color:#f59e0b; font-size:14px;" id="summaryTopExpense">-</span>
        </div>
        <div class="d-flex align-items-center" style="gap:8px; font-size:13px;">
          <i class="fa fa-chart-line" style="color:#764ba2; font-size:16px;"></i>
          <span>Average Monthly</span>
          <span class="ms-auto fw-bold" style="color:#764ba2; font-size:14px;" id="summaryAvgExpense">-</span>
        </div>
      </div>
    </div>
    <!-- RINGKASAN DI BAWAHNYA -->
    <div class="card shadow-sm" style="border-radius:22px; background:#fff; padding:0 0 18px 0;">
      <div style="background:linear-gradient(90deg,#0d47a1 0%,#66bfff 100%); border-radius:22px 22px 0 0; padding:14px 22px;">
        <span style="color:#fff; font-weight:600; font-size:15px;">Ringkasan</span>
      </div>
      <div style="padding:18px 18px 0 18px;">
        <!-- Mini Pie Chart -->
        <div id="summaryPieChart" style="width:90px; height:90px; margin:0 auto 18px auto; box-shadow:0 2px 8px rgba(13,71,161,0.10); border-radius:50%; background:#fff; transition:box-shadow 0.2s;"></div>
        <div style="display:flex; justify-content:center; gap:12px; margin-bottom:8px;">
          <div style="display:flex; align-items:center; gap:5px;">
            <span style="display:inline-block; width:14px; height:14px; border-radius:3px; background:#0d47a1;"></span>
            <span style="font-size:12px; color:#444;">Used</span>
          </div>
          <div style="display:flex; align-items:center; gap:5px;">
            <span style="display:inline-block; width:14px; height:14px; border-radius:3px; background:#66bfff;"></span>
            <span style="font-size:12px; color:#444;">Remaining</span>
          </div>
        </div>
        <div class="summary-item" style="display:flex; justify-content:space-between; align-items:center; padding:10px 0; border-bottom:1px solid #f8f9fa;">
          <span class="summary-label" style="font-size:13px; color:#6c757d;">Total Category</span>
          <span class="summary-value" style="font-size:15px; font-weight:600; color:#2c3e50;">6</span>
        </div>
        <div class="summary-item" style="display:flex; justify-content:space-between; align-items:center; padding:10px 0; border-bottom:1px solid #f8f9fa;">
          <span class="summary-label" style="font-size:13px; color:#6c757d;">Total Budget</span>
          <span class="summary-value" style="font-size:15px; font-weight:600; color:#2c3e50;">Rp 455.000.000</span>
        </div>
        <div class="summary-item" style="display:flex; justify-content:space-between; align-items:center; padding:10px 0; border-bottom:1px solid #f8f9fa;">
          <span class="summary-label" style="font-size:13px; color:#6c757d;">Total Used</span>
          <span class="summary-value" style="font-size:15px; font-weight:600; color:#2c3e50;">Rp 363.000.000</span>
        </div>
        <div class="summary-total" style="background:linear-gradient(135deg, #0d47a1 0%, #66bfff 100%); color:white; padding:13px; border-radius:8px; margin-top:15px; text-align:left;">
          <div class="summary-label" style="color:rgba(255,255,255,0.9); font-size:15px; font-weight:500; margin-bottom:2px;">
            Budget Remaining
          </div>
          <div class="summary-value" style="color:white; font-size:20px; font-weight:700;">
            Rp 92.000.000
          </div>
        </div>
      </div>
    </div>
    <!-- END RINGKASAN -->

    <!-- Department Spending Breakdown -->
    <div class="card shadow-sm" style="border-radius:22px; background:#fff; padding:0 0 18px 0; margin-top:18px;">
      <div style="background:linear-gradient(90deg,#0d47a1 0%,#66bfff 100%); border-radius:22px 22px 0 0; padding:14px 22px;">
        <span style="color:#fff; font-weight:600; font-size:15px;">Department Spending</span>
      </div>
      <!-- Tambahkan style agar tinggi tetap dan scroll jika overflow -->
      <div style="padding:18px 18px 0 18px; max-height:370px; overflow-y:auto;">
        <div style="display:flex; flex-direction:column; gap:16px;">
          <!-- Logistik -->
          <div>
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:4px;">
              <span style="font-size:18px; color:#1976d2;"><i class="fa fa-truck"></i></span>
              <span style="font-weight:600; color:#1976d2; min-width:80px;">Logistik</span>
              <span style="margin-left:auto; font-weight:600; color:#1976d2;">43%</span>
            </div>
            <div style="background:#e3f2fd; border-radius:8px; height:14px; overflow:hidden;">
              <div style="width:43%; background:linear-gradient(90deg,#1976d2 60%,#64b5f6 100%); height:100%; border-radius:8px;"></div>
            </div>
          </div>
          <!-- Retail Ops -->
          <div>
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:4px;">
              <span style="font-size:18px; color:#43a047;"><i class="fa fa-store"></i></span>
              <span style="font-weight:600; color:#43a047; min-width:80px;">Retail Ops</span>
              <span style="margin-left:auto; font-weight:600; color:#43a047;">25%</span>
            </div>
            <div style="background:#e8f5e9; border-radius:8px; height:14px; overflow:hidden;">
              <div style="width:25%; background:linear-gradient(90deg,#43a047 60%,#a5d6a7 100%); height:100%; border-radius:8px;"></div>
            </div>
          </div>
          <!-- HR -->
          <div>
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:4px;">
              <span style="font-size:18px; color:#fbc02d;"><i class="fa fa-users"></i></span>
              <span style="font-weight:600; color:#fbc02d; min-width:80px;">HR</span>
              <span style="margin-left:auto; font-weight:600; color:#fbc02d;">12%</span>
            </div>
            <div style="background:#fffde7; border-radius:8px; height:14px; overflow:hidden;">
              <div style="width:12%; background:linear-gradient(90deg,#fbc02d 60%,#fff176 100%); height:100%; border-radius:8px;"></div>
            </div>
          </div>
          <!-- IT -->
          <div>
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:4px;">
              <span style="font-size:18px; color:#7e57c2;"><i class="fa fa-laptop-code"></i></span>
              <span style="font-weight:600; color:#7e57c2; min-width:80px;">IT</span>
              <span style="margin-left:auto; font-weight:600; color:#7e57c2;">10%</span>
            </div>
            <div style="background:#ede7f6; border-radius:8px; height:14px; overflow:hidden;">
              <div style="width:10%; background:linear-gradient(90deg,#7e57c2 60%,#b39ddb 100%); height:100%; border-radius:8px;"></div>
            </div>
          </div>
          <!-- Lainnya -->
          <div>
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:4px;">
              <span style="font-size:18px; color:#757575;"><i class="fa fa-ellipsis-h"></i></span>
              <span style="font-weight:600; color:#757575; min-width:80px;">Lainnya</span>
              <span style="margin-left:auto; font-weight:600; color:#757575;">10%</span>
            </div>
            <div style="background:#f5f5f5; border-radius:8px; height:14px; overflow:hidden;">
              <div style="width:10%; background:linear-gradient(90deg,#757575 60%,#bdbdbd 100%); height:100%; border-radius:8px;"></div>
            </div>
          </div>
        </div>
        <!-- Insight Card -->
        <div style="display:flex; align-items:center; gap:10px; background:#fffde7; color:#fbc02d; border-radius:10px; padding:13px 14px; font-size:14px; margin-top:18px; box-shadow:0 2px 8px rgba(251,192,45,0.08);">
          <span style="font-size:22px; color:#fbc02d;"><i class="fa fa-lightbulb"></i></span>
          <span style="color:#b8860b;"><b>Insight:</b> Logistik mendominasi pengeluaran, harus evaluasi</span>
        </div>
        <div style="display:flex; align-items:center; gap:10px; background:#fffde7; color:#fbc02d; border-radius:10px; padding:13px 14px; font-size:14px; margin-top:18px; box-shadow:0 2px 8px rgba(251,192,45,0.08);">
          <span style="font-size:22px; color:#fbc02d;"><i class="fa fa-lightbulb"></i></span>
          <span style="color:#b8860b;"><b>Insight:</b> Logistik mendominasi pengeluaran, harus evaluasi</span>
        </div>
        <div style="display:flex; align-items:center; gap:10px; background:#fffde7; color:#fbc02d; border-radius:10px; padding:13px 14px; font-size:14px; margin-top:18px; box-shadow:0 2px 8px rgba(251,192,45,0.08);">
          <span style="font-size:22px; color:#fbc02d;"><i class="fa fa-lightbulb"></i></span>
          <span style="color:#b8860b;"><b>Insight:</b> Logistik mendominasi pengeluaran, harus evaluasi</span>
        </div>
        <div style="display:flex; align-items:center; gap:10px; background:#fffde7; color:#fbc02d; border-radius:10px; padding:13px 14px; font-size:14px; margin-top:18px; box-shadow:0 2px 8px rgba(251,192,45,0.08);">
          <span style="font-size:22px; color:#fbc02d;"><i class="fa fa-lightbulb"></i></span>
          <span style="color:#b8860b;"><b>Insight:</b> Logistik mendominasi pengeluaran, harus evaluasi</span>
        </div>
        <div style="display:flex; align-items:center; gap:10px; background:#fffde7; color:#fbc02d; border-radius:10px; padding:13px 14px; font-size:14px; margin-top:18px; box-shadow:0 2px 8px rgba(251,192,45,0.08);">
          <span style="font-size:22px; color:#fbc02d;"><i class="fa fa-lightbulb"></i></span>
          <span style="color:#b8860b;"><b>Insight:</b> Logistik mendominasi pengeluaran, harus evaluasi</span>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
const expenseData = {
  2025: {
    months: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
    values: [3200000, 5800000, 2200000, 2000000, 3300000, 1400000, 4900000, 3700000, 2100000, 4000000, 3900000, 3700000],
    topCategory: [
      'Marketing', 'Supplies', 'Utilities', 'Marketing', 'Technology', 'Employee', 'Marketing', 'Supplies', 'Utilities', 'Employee', 'Technology', 'Marketing'
    ],
    topExpense: [
      'Iklan Facebook', 'Pembelian Kertas', 'Bayar Listrik', 'Iklan Instagram', 'Pembelian Laptop', 'Bonus Karyawan', 'Iklan Facebook', 'Pembelian ATK', 'Bayar Air', 'Bonus Karyawan', 'Upgrade Server', 'Iklan Facebook'
    ],
    avg: [
      3200000, 4000000, 2500000, 2100000, 3300000, 1800000, 4200000, 3500000, 2200000, 3900000, 3700000, 3600000
    ]
  },
  2024: {
    months: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
    values: [2100000, 3400000, 1800000, 1700000, 2500000, 1200000, 3100000, 2700000, 1500000, 2900000, 3100000, 2600000],
    topCategory: [
      'Supplies', 'Supplies', 'Utilities', 'Marketing', 'Technology', 'Employee', 'Marketing', 'Supplies', 'Utilities', 'Employee', 'Technology', 'Marketing'
    ],
    topExpense: [
      'Pembelian Kertas', 'Pembelian Kertas', 'Bayar Listrik', 'Iklan Instagram', 'Pembelian Laptop', 'Bonus Karyawan', 'Iklan Facebook', 'Pembelian ATK', 'Bayar Air', 'Bonus Karyawan', 'Upgrade Server', 'Iklan Facebook'
    ],
    avg: [
      2100000, 2300000, 2000000, 1800000, 2500000, 1700000, 2900000, 2600000, 1700000, 3000000, 3100000, 2700000
    ]
  },
  2023: {
    months: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
    values: [1800000, 2200000, 1600000, 1500000, 2000000, 1100000, 2100000, 1900000, 1200000, 1700000, 2100000, 1800000],
    topCategory: [
      'Utilities', 'Supplies', 'Marketing', 'Marketing', 'Technology', 'Employee', 'Marketing', 'Supplies', 'Utilities', 'Employee', 'Technology', 'Marketing'
    ],
    topExpense: [
      'Bayar Listrik', 'Pembelian Kertas', 'Iklan Facebook', 'Iklan Instagram', 'Pembelian Laptop', 'Bonus Karyawan', 'Iklan Facebook', 'Pembelian ATK', 'Bayar Air', 'Bonus Karyawan', 'Upgrade Server', 'Iklan Facebook'
    ],
    avg: [
      1800000, 2000000, 1700000, 1600000, 2000000, 1400000, 2100000, 2000000, 1300000, 1800000, 2100000, 1900000
    ]
  }
};

let currentYear = '2025';
let currentMonthIdx = 0;
let chartInstance = null;

function updateSummary(year, monthIdx = 0) {
  const data = expenseData[year];
  document.getElementById('summaryPeriod').textContent = `${data.months[monthIdx]} - ${year}`;
  document.getElementById('summaryTotalExpense').textContent = 'Rp ' + data.values[monthIdx].toLocaleString('id-ID');
  document.getElementById('summaryTopCategory').textContent = data.topCategory[monthIdx];
  document.getElementById('summaryTopExpense').textContent = data.topExpense[monthIdx];
  document.getElementById('summaryAvgExpense').textContent = 'Rp ' + data.avg[monthIdx].toLocaleString('id-ID');
}

function renderExpenseChart(year) {
  const data = expenseData[year];
  if (chartInstance) {
    chartInstance.destroy();
  }

  // Membuat gradient biru tua ke biru muda untuk bar chart
  // ApexCharts hanya support gradient di seluruh bar, bukan per-bar, jadi gunakan fill.gradient
  chartInstance = new ApexCharts(document.querySelector("#expenseBarChart"), {
    chart: {
      type: 'bar',
      height: 320,
      toolbar: { show: false },
      animations: { enabled: true, easing: 'easeinout', speed: 800 },
      events: {
        dataPointSelection: function(event, chartContext, config) {
          currentMonthIdx = config.dataPointIndex;
          updateSummary(currentYear, currentMonthIdx);
        }
      }
    },
    plotOptions: {
      bar: {
        borderRadius: 8,
        columnWidth: '45%',
        distributed: false // agar gradient rata semua bar
      }
    },
    series: [{ name: 'Expense', data: data.values }],
    xaxis: {
      categories: data.months,
      labels: { style: { fontSize: '14px' } },
      axisTicks: { show: false },
      axisBorder: { show: false }
    },
    fill: {
      type: 'gradient',
      gradient: {
        shade: 'light',
        type: "vertical",
        shadeIntensity: 0.2,
        gradientToColors: ["#66bfff"],
        inverseColors: false,
        opacityFrom: 0.95,
        opacityTo: 0.95,
        stops: [0, 100],
        colorStops: [
          {
            offset: 0,
            color: "#0d47a1",
            opacity: 1
          },
          {
            offset: 100,
            color: "#66bfff",
            opacity: 1
          }
        ]
      }
    },
    colors: ["#0d47a1"], // warna utama bar (atas)
    dataLabels: { enabled: false },
    grid: { strokeDashArray: 4, borderColor: '#e9ecef' },
    yaxis: { labels: { style: { fontSize: '13px' } } },
    tooltip: {
      theme: 'light',
      style: { fontSize: '14px' }
    },
    states: {
      hover: { filter: { type: 'lighten', value: 0.15 } },
      active: { filter: { type: 'darken', value: 0.15 } }
    },
    legend: { show: false }
  });
  chartInstance.render();
  updateSummary(year, currentMonthIdx);
}

document.addEventListener('DOMContentLoaded', function() {
  // Tambahkan tahun 2023 ke select
  const yearSelector = document.getElementById('yearSelector');
  if ([...yearSelector.options].filter(opt => opt.value === '2023').length === 0) {
    const opt2023 = document.createElement('option');
    opt2023.value = '2023';
    opt2023.textContent = '2023';
    yearSelector.appendChild(opt2023);
  }
  renderExpenseChart(currentYear);
  yearSelector.addEventListener('change', function() {
    currentYear = this.value;
    currentMonthIdx = 0;
    document.getElementById('expenseBarChart').innerHTML = '';
    renderExpenseChart(currentYear);
  });
});
</script>
          <!-- END CHART SECTION -->
  
    <!-- Tambahkan modal setelah cardsView, sebelum </body> -->
<div class="modal fade" id="categoryListModal" tabindex="-1" aria-labelledby="categoryListModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="categoryListModalLabel">Daftar Transaksi Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="categoryListContent">
          <!-- List akan diisi oleh JS -->
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// Data transaksi per kategori (dummy, bisa diganti dari backend)
const categoryTransactions = {
  'Supplies': [
    { tanggal: '2025-06-01', deskripsi: 'Pembelian Kertas', jumlah: 1200000, reference: 'SUP-001', status: 'Done' },
    { tanggal: '2025-06-05', deskripsi: 'Pembelian ATK', jumlah: 800000, reference: 'SUP-002', status: 'Ongoing' },
    { tanggal: '2025-06-10', deskripsi: 'Pembelian Printer', jumlah: 2200000, reference: 'SUP-003', status: 'Done' }
  ],
  'Utilities': [
    { tanggal: '2025-06-02', deskripsi: 'Bayar Listrik', jumlah: 1500000, reference: 'UTL-001', status: 'Done' },
    { tanggal: '2025-06-12', deskripsi: 'Bayar Air', jumlah: 700000, reference: 'UTL-002', status: 'Ongoing' }
  ],
  'Transport': [
    { tanggal: '2025-06-03', deskripsi: 'Bensin', jumlah: 500000, reference: 'TRN-001', status: 'Done' },
    { tanggal: '2025-06-15', deskripsi: 'Taksi', jumlah: 300000, reference: 'TRN-002', status: 'Ongoing' }
  ],
  'Employee': [
    { tanggal: '2025-06-04', deskripsi: 'Bonus Karyawan', jumlah: 5000000, reference: 'EMP-001', status: 'Done' },
    { tanggal: '2025-06-20', deskripsi: 'Gaji', jumlah: 90000000, reference: 'EMP-002', status: 'Done' }
  ],
  'Technology': [
    { tanggal: '2025-06-06', deskripsi: 'Pembelian Laptop', jumlah: 12000000, reference: 'TEC-001', status: 'Done' },
    { tanggal: '2025-06-18', deskripsi: 'Upgrade Server', jumlah: 8000000, reference: 'TEC-002', status: 'Ongoing' }
  ],
  'Marketing': [
    { tanggal: '2025-06-07', deskripsi: 'Iklan Facebook', jumlah: 2000000, reference: 'MKT-001', status: 'Done' },
    { tanggal: '2025-06-21', deskripsi: 'Iklan Instagram', jumlah: 1700000, reference: 'MKT-002', status: 'Ongoing' }
  ]
};

// Fungsi untuk menampilkan modal dan list transaksi
function showCategoryDetails(categoryName) {
  const list = categoryTransactions[categoryName] || [];
  let html = `<h6 class="mb-3">Daftar Transaksi: <span class="text-primary">${categoryName}</span></h6>`;
  if (list.length === 0) {
    html += `<div class="alert alert-info">Belum ada transaksi pada kategori ini.</div>`;
  } else {
    html += `<div class="table-responsive"><table class="table table-bordered table-sm">
      <thead>
        <tr>
          <th>No</th>
          <th>Reference</th>
          <th>Tanggal</th>
          <th>Deskripsi</th>
          <th>Jumlah</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>`;
    list.forEach((item, idx) => {
      html += `<tr>
        <td>${idx + 1}</td>
        <td>${item.reference}</td>
        <td>${item.tanggal}</td>
        <td>${item.deskripsi}</td>
        <td>Rp ${item.jumlah.toLocaleString('id-ID')}</td>
        <td>
          <span class="badges ${item.status === 'Done' ? 'bg-lightgreen' : 'bg-lightred'}">${item.status}</span>
        </td>
      </tr>`;
    });
    html += `</tbody></table></div>`;
  }
  document.getElementById('categoryListContent').innerHTML = html;
  // Tampilkan modal Bootstrap
  const modal = new bootstrap.Modal(document.getElementById('categoryListModal'));
  modal.show();
}
</script>
    <script>
// Data untuk pie chart ringkasan
const totalBudget = 455000000;
const totalUsed = 363000000;
const budgetRemaining = totalBudget - totalUsed;

const pieOptions = {
  chart: {
    type: 'pie',
    width: 90,
    height: 90,
    animations: { enabled: true, easing: 'easeinout', speed: 2000 },
    sparkline: { enabled: true },
    dropShadow: {
      enabled: true,
      top: 2,
      left: 0,
      blur: 6,
      color: '#0d47a1',
      opacity: 0.12
    },
    events: {
      dataPointMouseEnter: function(event, chartContext, config) {
        chartContext.el.style.boxShadow = '0 4px 16px rgba(13,71,161,0.18)';
      },
      dataPointMouseLeave: function(event, chartContext, config) {
        chartContext.el.style.boxShadow = '0 2px 8px rgba(13,71,161,0.10)';
      }
    }
  },
  series: [0, 0], // Mulai dari 0 agar animasi jalan saat muncul
  labels: ['Used', 'Remaining'],
  colors: ['#0d47a1', '#66bfff'],
  legend: { show: false },
  dataLabels: { enabled: false },
  tooltip: {
    enabled: true,
    y: {
      formatter: function(val) {
        return 'Rp ' + val.toLocaleString('id-ID');
      }
    }
  },
  stroke: { width: 0 },
  states: {
    hover: { filter: { type: 'lighten', value: 0.12 } },
    active: { filter: { type: 'darken', value: 0.10 } }
  }
};

let pieChartInstance = null;
let pieChartAnimated = false;

function animatePieChart() {
  if (pieChartInstance && !pieChartAnimated) {
    pieChartAnimated = true;
    pieChartInstance.updateSeries([totalUsed, budgetRemaining]);
  }
}

document.addEventListener('DOMContentLoaded', function() {
  const pieContainer = document.getElementById('summaryPieChart');
  if (pieContainer) {
    pieChartInstance = new ApexCharts(pieContainer, pieOptions);
    pieChartInstance.render();

    // Observer: animasi hanya saat pie chart benar-benar terlihat di layar
    const observer = new window.IntersectionObserver(
      (entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting && !pieChartAnimated) {
            animatePieChart();
          }
        });
      },
      { threshold: 0.7 }
    );
    observer.observe(pieContainer);
  }
});
</script>
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
