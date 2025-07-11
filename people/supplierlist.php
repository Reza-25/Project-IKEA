﻿<?php
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

    <link rel="stylesheet" href="../assets/css/animate.css" />

    <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css" />

    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css" />

    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css" />

    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css" />

    <link rel="stylesheet" href="../assets/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
 .chart-container {
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(33, 150, 243, 0.15);
    border: 2px solid rgba(33, 150, 243, 0.2);
    transition: all 0.3s ease;
    overflow: hidden;
  }

  .chart-container:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(33, 150, 243, 0.25);
    border: 2px solid rgba(33, 150, 243, 0.3);
  }

  .chart-wrapper {
    height: 500px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 2rem;
    background: linear-gradient(135deg, #f8fbff 0%, #e3f2fd 100%);
  }

  .chart-wrapper h5 {
    color: #0d47a1;
    font-weight: 700;
    margin-bottom: 1rem;
    text-align: center;
    font-size: 1.1rem;
  }

  .chart-canvas-container {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    max-height: 280px;
    margin: 1rem 0;
  }

  canvas {
    max-height: 280px;
    max-width: 100%;
  }

  .legend-container {
    margin-top: 1rem;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 1rem;
    padding-top: 1rem;
  }

  .legend-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: #0d47a1;
    font-weight: 600;
  }

  .legend-color {
    width: 16px;
    height: 16px;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  }

  /* Recent Communication Container */
  .communication-container {
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(33, 150, 243, 0.15);
    border: 2px solid rgba(33, 150, 243, 0.2);
    overflow: hidden;
    transition: all 0.3s ease;
    height: 500px;
  }

  .communication-container:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(33, 150, 243, 0.25);
    border: 2px solid rgba(33, 150, 243, 0.3);
  }

  .communication-header {
    color: #0d47a1;
    padding: 2rem 2rem 1rem 2rem;
    text-align: center;
    background: linear-gradient(135deg, #f8fbff 0%, #e3f2fd 100%);
  }

  .communication-header h5 {
    margin: 0;
    font-weight: 700;
    font-size: 1.1rem;
  }

  .communication-body {
    padding: 1rem 2rem 4rem 2rem;
    max-height: 400px;
    overflow-y: auto;
    background: linear-gradient(135deg, #f8fbff 0%, #e3f2fd 100%);
    /* Extended background to cover entire scrollable area */
    min-height: 450px;
  }

  .communication-item {
    display: flex;
    align-items: flex-start;
    padding: 0.8rem 0;
    margin-bottom: 0.6rem;
    border-bottom: 1px solid rgba(33, 150, 243, 0.1);
    transition: all 0.3s ease;
    opacity: 0;
    transform: translateY(20px);
    animation: slideUp 0.6s ease forwards;
  }

  .communication-item:last-child {
    border-bottom: none;
    /* Add padding to ensure blue background extends to bottom */
    padding-bottom: 4rem;
  }

  .communication-item:hover {
    transform: translateY(-2px);
    background: rgba(255, 255, 255, 0.5);
    border-radius: 8px;
    padding: 0.8rem;
    margin: 0.2rem 0;
  }

  .communication-item:nth-child(1) { animation-delay: 0.1s; }
  .communication-item:nth-child(2) { animation-delay: 0.2s; }
  .communication-item:nth-child(3) { animation-delay: 0.3s; }
  .communication-item:nth-child(4) { animation-delay: 0.4s; }
  .communication-item:nth-child(5) { animation-delay: 0.5s; }
  .communication-item:nth-child(6) { animation-delay: 0.6s; }

  @keyframes slideUp {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .comm-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    font-size: 1rem;
    color: white;
    flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
  }

  .comm-icon.call {
    background: linear-gradient(135deg, #ffca28 0%, #ff8f00 100%);
  }

  .comm-icon.email {
    background: linear-gradient(135deg, #2196f3 0%, #0d47a1 100%);
  }

  .comm-icon.update {
    background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%);
  }

  .comm-content {
    flex: 1;
  }

  .comm-title {
    font-weight: 600;
    color: #ff8f00;
    font-size: 0.9rem;
    margin-bottom: 0.2rem;
  }

  .comm-supplier {
    font-weight: 700;
    color: #2196f3;
    font-size: 0.9rem;
    margin-bottom: 0.2rem;
    text-decoration: underline;
  }

  .comm-message {
    color: #546e7a;
    font-size: 0.85rem;
    margin-bottom: 0.2rem;
  }

  .comm-time {
    color: #90a4ae;
    font-size: 0.8rem;
    font-weight: 500;
  }

  /* Metrics Content */
  .metrics-content {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    align-items: center;
    justify-content: center;
    height: 100%;
  }

  .metric-item {
    text-align: center;
  }

  .metric-number {
    font-size: 2.5rem;
    font-weight: 800;
    color: #0d47a1;
    margin-bottom: 0.5rem;
  }

  .metric-label {
    font-size: 0.9rem;
    color: #546e7a;
    font-weight: 600;
  }

  /* Action Items */
  .action-item {
    display: flex;
    align-items: center;
    padding: 0.8rem 0;
    margin-bottom: 0.6rem;
    border-bottom: 1px solid rgba(33, 150, 243, 0.1);
    transition: all 0.3s ease;
    cursor: pointer;
  }

  .action-item:last-child {
    border-bottom: none;
    /* Add padding to ensure blue background extends to bottom */
    padding-bottom: 4rem;
  }

  .action-item:hover {
    transform: translateY(-2px);
    background: rgba(255, 255, 255, 0.7);
    border-radius: 8px;
    padding: 0.8rem;
    margin: 0.2rem 0;
    box-shadow: 0 4px 12px rgba(33, 150, 243, 0.1);
  }

  .action-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    font-size: 1rem;
    color: white;
    flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
  }

  .action-icon.add {
    background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%);
  }

  .action-icon.export {
    background: linear-gradient(135deg, #2196f3 0%, #0d47a1 100%);
  }

  .action-icon.report {
    background: linear-gradient(135deg, #ff9800 0%, #e65100 100%);
  }

  .action-icon.settings {
    background: linear-gradient(135deg, #607d8b 0%, #37474f 100%);
  }

  .action-icon.notification {
    background: linear-gradient(135deg, #e91e63 0%, #ad1457 100%);
  }

  .action-content {
    flex: 1;
  }

  .action-title {
    font-weight: 700;
    color: #0d47a1;
    font-size: 0.9rem;
    margin-bottom: 0.2rem;
  }

  .action-description {
    color: #546e7a;
    font-size: 0.8rem;
  }

  .communication-body::-webkit-scrollbar {
    width: 6px;
  }

  .communication-body::-webkit-scrollbar-track {
    background: rgba(33, 150, 243, 0.1);
    border-radius: 3px;
  }

  .communication-body::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #2196f3 0%, #0d47a1 100%);
    border-radius: 3px;
  }

  .communication-body::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #1976d2 0%, #0d47a1 100%);
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .chart-wrapper {
      height: 450px;
      padding: 1.5rem;
    }
    
    .chart-canvas-container {
      max-height: 240px;
    }
    
    canvas {
      max-height: 240px;
    }
  }
    </style>
  </head>
  <body>
    <div id="global-loader">
      <div class="whirly-loader"></div>
    </div>

    <div class="main-wrapper">
      <!-- Include sidebar -->
      <?php include BASE_PATH . '/include/sidebar.php'; ?> <!-- Import sidebar -->
      <?php include __DIR__ . '/../include/header.php'; ?> <!-- Import header -->
      </div>

      <div class="page-wrapper">
        <div class="content">
          <div class="page-header">
            <div class="page-title">
              <h4>Supplier List</h4>
              <h6>Manage your Supplier</h6>
            </div>
          </div>

          <!-- Total Expenses, Top Category, Top Expense, Avg Daily Expense -->
          <div class="row justify-content-end">
            <!-- Total Product Sold -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="revenue/revenue.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das1">
                  <div class="dash-counts">
                    <h4><span class="counters" data-count="134"></span></h4>
                    <h5>Registered Suppliers</h5>
                    <h2 class="stat-change">+4 baru bulan ini</h2>
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
                    <h4><span class="counters" data-count="87"></span></h4>
                    <h5>Most Active Suppliers</h5>
                  <h2 class="stat-change">65% of total</h2>
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
                    <h4><span class="counters" data-count="12"></span></h4>
                    <h5>Follow-Up Needed</h5>
                    <h2 class="stat-change">+3 dari minggu lalu</h2>
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
                    <h4>2.4 days</h4>
                    <h5>Avg. Response Time</h5>
                   <h2 class="stat-change">-1 hari dari bulan lalu</h2>
                    </div>
                    <div class="icon-box bg-hijau">
                      <i class="fa fa-chart-line"></i>
                    </div>
                </div>
              </a>
            </div>
          </div>
          <!-- END KOLOM  -->


<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
  .card-body {
    padding: 1rem;
  }

  .chart-wrapper {
    height: 450px; /* Atur tinggi total biar sejajar */
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  canvas {
    max-height: 350px;
    margin: auto;
  }

  .small-icon {
    font-size: 1.5rem;
  }

  .card-dark {
    background-color:rgb(74, 104, 134);
    color: white;
  }

  .list-group-item {
    font-size: 0.9rem;
    padding: 0.5rem 0.75rem;
  }
</style>


<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
  .chart-container {
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(33, 150, 243, 0.15);
    border: 2px solid rgba(33, 150, 243, 0.2);
    transition: all 0.3s ease;
    overflow: hidden;
  }

  .chart-container:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(33, 150, 243, 0.25);
    border: 2px solid rgba(33, 150, 243, 0.3);
  }

  .chart-wrapper {
    height: 500px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 2rem;
    background: linear-gradient(135deg, #f8fbff 0%, #e3f2fd 100%);
  }

  .chart-wrapper h5 {
    color: #0d47a1;
    font-weight: 700;
    margin-bottom: 1rem;
    text-align: center;
    font-size: 1.1rem;
  }

  .chart-canvas-container {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    max-height: 280px;
    margin: 1rem 0;
  }

  canvas {
    max-height: 280px;
    max-width: 100%;
  }

  .legend-container {
    margin-top: 1rem;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 1rem;
    padding-top: 1rem;
  }

  .legend-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: #0d47a1;
    font-weight: 600;
  }

  .legend-color {
    width: 16px;
    height: 16px;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  }

  /* Recent Communication Container */
  .communication-container {
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(33, 150, 243, 0.15);
    border: 2px solid rgba(33, 150, 243, 0.2);
    overflow: hidden;
    transition: all 0.3s ease;
  }

  .communication-container:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(33, 150, 243, 0.25);
    border: 2px solid rgba(33, 150, 243, 0.3);
  }

  .communication-header {
    background: linear-gradient(135deg, #2196f3 0%, #0d47a1 100%);
    color: white;
    padding: 1.5rem 2rem;
    text-align: center;
  }

  .communication-header h5 {
    margin: 0;
    font-weight: 700;
    font-size: 1.2rem;
  }

  .communication-body {
    padding: 1.5rem;
    max-height: 350px;
    overflow-y: auto;
  }

  .communication-item {
    display: flex;
    align-items: center;
    padding: 1rem;
    margin-bottom: 0.8rem;
    background: linear-gradient(135deg, #f8fbff 0%, #e3f2fd 100%);
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(33, 150, 243, 0.1);
    transition: all 0.3s ease;
    opacity: 0;
    transform: translateY(20px);
    animation: slideUp 0.6s ease forwards;
  }

  .communication-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(33, 150, 243, 0.2);
    background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
  }

  .communication-item:nth-child(1) { animation-delay: 0.1s; }
  .communication-item:nth-child(2) { animation-delay: 0.2s; }
  .communication-item:nth-child(3) { animation-delay: 0.3s; }
  .communication-item:nth-child(4) { animation-delay: 0.4s; }
  .communication-item:nth-child(5) { animation-delay: 0.5s; }
  .communication-item:nth-child(6) { animation-delay: 0.6s; }

  @keyframes slideUp {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .comm-icon {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    font-size: 1.2rem;
    color: white;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  }

  .comm-icon.call {
    background: linear-gradient(135deg, #ffca28 0%, #ff8f00 100%);
  }

  .comm-icon.email {
    background: linear-gradient(135deg, #2196f3 0%, #0d47a1 100%);
  }

  .comm-icon.update {
    background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%);
  }

  .comm-content {
    flex: 1;
  }

  .comm-supplier {
    font-weight: 700;
    color: #0d47a1;
    font-size: 0.95rem;
    margin-bottom: 0.3rem;
  }

  .comm-message {
    color: #546e7a;
    font-size: 0.85rem;
    margin-bottom: 0.2rem;
  }

  .comm-time {
    color: #90a4ae;
    font-size: 0.75rem;
    font-weight: 500;
  }

  /* Custom Scrollbar */
  .communication-body::-webkit-scrollbar {
    width: 6px;
  }

  .communication-body::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
  }

  .communication-body::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #2196f3 0%, #0d47a1 100%);
    border-radius: 3px;
  }

  .communication-body::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #1976d2 0%, #0d47a1 100%);
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .chart-wrapper {
      height: 450px;
      padding: 1.5rem;
    }
    
    .chart-canvas-container {
      max-height: 240px;
    }
    
    canvas {
      max-height: 240px;
    }
  }
</style>

<div class="container py-3">
  <div class="row g-3">
    <!-- Enhanced Pie Chart -->
    <div class="col-md-6">
      <div class="chart-container">
        <div class="chart-wrapper">
          <h5>Distribusi Supplier Berdasarkan Negara</h5>
          <div class="chart-canvas-container">
            <canvas id="countryPieChart"></canvas>
          </div>
          <div class="legend-container">
            <div class="legend-item">
              <div class="legend-color" style="background: #2196f3;"></div>
              <span>Indonesia</span>
            </div>
            <div class="legend-item">
              <div class="legend-color" style="background: #0d47a1;"></div>
              <span>China</span>
            </div>
            <div class="legend-item">
              <div class="legend-color" style="background: #64b5f6;"></div>
              <span>Malaysia</span>
            </div>
            <div class="legend-item">
              <div class="legend-color" style="background: #1976d2;"></div>
              <span>Vietnam</span>
            </div>
            <div class="legend-item">
              <div class="legend-color" style="background: #ffca28;"></div>
              <span>India</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Communication -->
    <div class="col-md-6">
      <div class="communication-container">
        <div class="communication-header">
          <h5>Recent Communication</h5>
        </div>
        <div class="communication-body">
          <div class="communication-item">
            <div class="comm-icon call">
              <i class="bi bi-telephone-fill"></i>
            </div>
            <div class="comm-content">
              <div class="comm-title">Call with</div>
              <div class="comm-supplier">PT Mebel Jati</div>
              <div class="comm-message">Called about delivery schedule for order #1234</div>
              <div class="comm-time">2 hours ago</div>
            </div>
          </div>

          <div class="communication-item">
            <div class="comm-icon email">
              <i class="bi bi-envelope-fill"></i>
            </div>
            <div class="comm-content">
              <div class="comm-title">Email sent to</div>
              <div class="comm-supplier">CV Cahaya Lampu</div>
              <div class="comm-message">Sent quotation for LED lighting project</div>
              <div class="comm-time">5 hours ago</div>
            </div>
          </div>

          <div class="communication-item">
            <div class="comm-icon update">
              <i class="bi bi-arrow-clockwise"></i>
            </div>
            <div class="comm-content">
              <div class="comm-title">Status updated by</div>
              <div class="comm-supplier">Textile Nusantara</div>
              <div class="comm-message">Status updated: Payment received</div>
              <div class="comm-time">1 day ago</div>
            </div>
          </div>

          <div class="communication-item">
            <div class="comm-icon call">
              <i class="bi bi-telephone-fill"></i>
            </div>
            <div class="comm-content">
              <div class="comm-title">Call with</div>
              <div class="comm-supplier">Dapur Modern</div>
              <div class="comm-message">Follow-up call for kitchen equipment order</div>
              <div class="comm-time">1 day ago</div>
            </div>
          </div>

          <div class="communication-item">
            <div class="comm-icon email">
              <i class="bi bi-envelope-fill"></i>
            </div>
            <div class="comm-content">
              <div class="comm-title">Email sent to</div>
              <div class="comm-supplier">Rumah Indah</div>
              <div class="comm-message">Contract renewal proposal sent</div>
              <div class="comm-time">2 days ago</div>
            </div>
          </div>

          <div class="communication-item">
            <div class="comm-icon update">
              <i class="bi bi-arrow-clockwise"></i>
            </div>
            <div class="comm-content">
              <div class="comm-title">Status updated by</div>
              <div class="comm-supplier">Apex Computers</div>
              <div class="comm-message">Inventory stock level updated</div>
              <div class="comm-time">3 days ago</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
<script>
  // Enhanced Pie Chart with animations and effects
  const ctx = document.getElementById('countryPieChart').getContext('2d');
  
  const chart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Indonesia', 'China', 'Malaysia', 'Vietnam', 'India'],
      datasets: [{
        data: [40, 30, 15, 10, 5],
        backgroundColor: [
          '#2196f3',
          '#0d47a1', 
          '#64b5f6',
          '#1976d2',
          '#ffca28'
        ],
        borderWidth: 3,
        borderColor: '#ffffff',
        hoverBorderWidth: 5,
        hoverBorderColor: '#ffffff',
        hoverBackgroundColor: [
          '#1976d2',
          '#0a3d91',
          '#42a5f5',
          '#1565c0',
          '#ffc107'
        ]
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
          backgroundColor: 'rgba(13, 71, 161, 0.95)',
          titleColor: '#ffffff',
          bodyColor: '#ffffff',
          borderColor: '#2196f3',
          borderWidth: 2,
          cornerRadius: 12,
          displayColors: true,
          callbacks: {
            label: function(context) {
              const total = context.dataset.data.reduce((a, b) => a + b, 0);
              const percentage = Math.round((context.parsed / total) * 100);
              return `${context.label}: ${percentage}% (${context.parsed} suppliers)`;
            }
          },
          titleFont: {
            size: 14,
            weight: 'bold'
          },
          bodyFont: {
            size: 13
          },
          padding: 12
        },
        datalabels: {
          display: true,
          color: '#ffffff',
          font: {
            weight: 'bold',
            size: 12
          },
          formatter: (value, context) => {
            const total = context.dataset.data.reduce((a, b) => a + b, 0);
            const percentage = Math.round((value / total) * 100);
            return percentage + '%';
          }
        }
      },
      animation: {
        animateRotate: true,
        animateScale: true,
        duration: 2000,
        easing: 'easeInOutQuart'
      },
      hover: {
        mode: 'nearest',
        intersect: true,
        animationDuration: 300
      },
      elements: {
        arc: {
          borderWidth: 3,
          hoverBorderWidth: 5
        }
      },
      onHover: (event, activeElements) => {
        event.native.target.style.cursor = activeElements.length > 0 ? 'pointer' : 'default';
      }
    }
  });

  // Add data labels plugin
  Chart.register({
    id: 'datalabels',
    afterDatasetsDraw: function(chart) {
      const ctx = chart.ctx;
      chart.data.datasets.forEach((dataset, i) => {
        const meta = chart.getDatasetMeta(i);
        meta.data.forEach((element, index) => {
          const data = dataset.data[index];
          const total = dataset.data.reduce((a, b) => a + b, 0);
          const percentage = Math.round((data / total) * 100);
          
          const position = element.tooltipPosition();
          
          ctx.fillStyle = '#ffffff';
          ctx.font = 'bold 12px Arial';
          ctx.textAlign = 'center';
          ctx.textBaseline = 'middle';
          ctx.fillText(percentage + '%', position.x, position.y);
        });
      });
    }
  });

  // Add entrance animation for chart
  setTimeout(() => {
    chart.update('active');
  }, 500);
</script>
</div>
          <div class="card mt-4">
            <div class="card-body">
              <div class="table-top">
                <div class="search-set">
                  <div class="search-path">
                    <a class="btn btn-filter" id="filter_search">
                      <img src="../assets/img/icons/filter.svg" alt="img" />
                      <span><img src="../assets/img/icons/closes.svg" alt="img" /></span>
                    </a>
                  </div>
                  <div class="search-input">
                    <a class="btn btn-searchset">
                    <img src="../assets/img/icons/search-white.svg" alt="img" /></a>
                  </div>
                </div>
                <div class="wordset">
                  <ul>
                    <li>
                      <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="../assets/img/icons/pdf.svg" alt="img" /></a>
                    </li>
                    <li>
                      <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="../assets/img/icons/excel.svg" alt="img" /></a>
                    </li>
                    <li>
                      <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="../assets/img/icons/printer.svg" alt="img" /></a>
                    </li>
                  </ul>
                </div>
              </div>

              <div class="card" id="filter_inputs">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-lg-2 col-sm-6 col-12">
                      <div class="form-group">
                        <input type="text" placeholder="Enter Supplier Code" />
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-12">
                      <div class="form-group">
                        <input type="text" placeholder="Enter Supplier" />
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-12">
                      <div class="form-group">
                        <input type="text" placeholder="Enter Phone" />
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-12">
                      <div class="form-group">
                        <input type="text" placeholder="Enter Email" />
                      </div>
                    </div>
                    <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                      <div class="form-group">
                        <a class="btn btn-filters ms-auto"><img src="../assets/img/icons/search-whites.svg" alt="img" /></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="table-responsive">
                <table class="table datanew">
                  <thead>
                    <tr>
                      <th>
                        <label class="checkboxs">
                          <input type="checkbox" id="select-all" />
                          <span class="checkmarks"></span>
                        </label>
                      </th>
                      <th>Supplier Name</th>
                      <th>code</th>
                      <th>Phone</th>
                      <th>email</th>
                      <th>Country</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product">
                        </a>
                        <a href="javascript:void(0);">Apex Computers</a>
                      </td>
                      <td>201</td>
                      <td>+12163547758</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="b8ccd0d7d5d9cbf8ddc0d9d5c8d4dd96dbd7d5">[email&#160;protected]</a></td>
                      <td>China</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product">
                        </a>
                        <a href="javascript:void(0);">Modern Automobile</a>
                      </td>
                      <td>202</td>
                      <td>123-456-888</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="f794828483989a9285b7928f969a879b92d994989a">[email&#160;protected]</a></td>
                      <td>USA</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product">
                        </a>
                        <a href="javascript:void(0);">AIM Infotech</a>
                      </td>
                      <td>521</td>
                      <td>123-456-888</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="83e0f6f0f7eceee6f1c3e6fbe2eef3efe6ade0ecee">[email&#160;protected]</a></td>
                      <td>USA</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product">
                        </a>
                        <a href="javascript:void(0);">Best Power Tools</a>
                      </td>
                      <td>555</td>
                      <td>123-456-888</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="abc9d9dec0c7c2c5ebced3cac6dbc7ce85c8c4c6">[email&#160;protected]</a></td>
                      <td>Thailand</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product">
                        </a>
                        <a href="javascript:void(0);">AIM Infotech</a>
                      </td>
                      <td>325</td>
                      <td>+12163547758</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="1f5d7a697a6d73665f7a677e726f737a317c7072">[email&#160;protected]</a></td>
                      <td>Phuket island</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product">
                        </a>
                        <a href="javascript:void(0);">Best Power Tools</a>
                      </td>
                      <td>589</td>
                      <td>123-456-888</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="38704d5a5d4a785d40595548545d165b5755">[email&#160;protected]</a></td>
                      <td>Germany</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Apex Computers</a>
                      </td>
                      <td>254</td>
                      <td>+12163547758</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="6c0f191f180301091e2c09140d011c0009420f0301">[email&#160;protected]</a></td>
                      <td>Angola</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product">                        </a>
                        <a href="javascript:void(0);">Vinayak Tools</a>
                      </td>
                      <td>681</td>
                      <td>123-456-888</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="305a5f585e705548515d405c551e535f5d">[email&#160;protected]</a></td>
                      <td>Albania</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product">                        </a>
                        <a href="javascript:void(0);">Best Power Tools</a>
                      </td>
                      <td>555</td>
                      <td>123-456-888</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="83e1f1f6e8efeaedc3e6fbe2eef3efe6ade0ecee">[email&#160;protected]</a></td>
                      <td>Thailand</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">AIM Infotech</a>
                      </td>
                      <td>325</td>
                      <td>+12163547758</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="b5f7d0c3d0c7d9ccf5d0cdd4d8c5d9d09bd6dad8">[email&#160;protected]</a></td>
                      <td>Phuket island</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product">                        </a>
                        <a href="javascript:void(0);">Best Power Tools</a>
                      </td>
                      <td>589</td>
                      <td>123-456-888</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="d29aa7b0b7a092b7aab3bfa2beb7fcb1bdbf">[email&#160;protected]</a></td>
                      <td>Germany</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Apex Computers</a>
                      </td>
                      <td>254</td>
                      <td>+12163547758</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="9af9efe9eef5f7ffe8daffe2fbf7eaf6ffb4f9f5f7">[email&#160;protected]</a></td>
                      <td>Angola</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product">
                        </a>
                        <a href="javascript:void(0);">Vinayak Tools</a>
                      </td>
                      <td>681</td>
                      <td>123-456-888</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="bad0d5d2d4fadfc2dbd7cad6df94d9d5d7">[email&#160;protected]</a></td>
                      <td>Albania</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="showpayment" tabindex="-1" aria-labelledby="showpayment" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Show Payments</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Reference</th>
                    <th>Amount</th>
                    <th>Paid By</th>
                    <th>Paid By</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="bor-b1">
                    <td>2022-03-07</td>
                    <td>INV/SL0101</td>
                    <td>$ 1500.00</td>
                    <td>Cash</td>
                    <td>
                      <a class="me-2" href="javascript:void(0);">
                        <img src="../assets/img/icons/printer.svg" alt="img" />
                      </a>
                      <a class="me-2" href="javascript:void(0);" data-bs-target="#editpayment" data-bs-toggle="modal" data-bs-dismiss="modal">
                        <img src="../assets/img/icons/edit.svg" alt="img" />
                      </a>
                      <a class="me-2 confirm-text" href="javascript:void(0);">
                        <img src="../assets/img/icons/delete.svg" alt="img" />
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="createpayment" tabindex="-1" aria-labelledby="createpayment" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Create Payment</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Customer</label>
                  <div class="input-group">
                    <input type="text" value="2022-03-07" class="datetimepicker" />
                    <a class="scanner-set input-group-text">
                      <img src="../assets/img/icons/datepicker.svg" alt="img" />
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Reference</label>
                  <input type="text" value="INV/SL0101" />
                </div>
              </div>
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Received Amount</label>
                  <input type="text" value="1500.00" />
                </div>
              </div>
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Paying Amount</label>
                  <input type="text" value="1500.00" />
                </div>
              </div>
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Payment type</label>
                  <select class="select">
                    <option>Cash</option>
                    <option>Online</option>
                    <option>Inprogress</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label>Note</label>
                  <textarea class="form-control"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-submit">Submit</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editpayment" tabindex="-1" aria-labelledby="editpayment" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Payment</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Customer</label>
                  <div class="input-group">
                    <input type="text" value="2022-03-07" class="datetimepicker" />
                    <a class="scanner-set input-group-text">
                      <img src="../assets/img/icons/datepicker.svg" alt="img" />
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Reference</label>
                  <input type="text" value="INV/SL0101" />
                </div>
              </div>
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Received Amount</label>
                  <input type="text" value="1500.00" />
                </div>
              </div>
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Paying Amount</label>
                  <input type="text" value="1500.00" />
                </div>
              </div>
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Payment type</label>
                  <select class="select">
                    <option>Cash</option>
                    <option>Online</option>
                    <option>Inprogress</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label>Note</label>
                  <textarea class="form-control"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-submit">Submit</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <script src="../assets/js/feather.min.js"></script>

    <script src="../assets/js/jquery.slimscroll.min.js"></script>

    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap4.min.js"></script>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/plugins/select2/js/select2.min.js"></script>

    <script src="../assets/js/moment.min.js"></script>
    <script src="../assets/js/bootstrap-datetimepicker.min.js"></script>

    <script src="../assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalerts.min.js"></script>

    <script src="../assets/js/script.js"></script>
  </body>
</html>
