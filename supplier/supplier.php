<?php
require_once __DIR__ . '/../include/config.php'; // Import config.php
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="POS - Bootstrap Admin Template" name="description" />
    <meta content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects" name="keywords" />
    <meta content="Dreamguys - Bootstrap Admin Template" name="author" />
    <meta content="noindex, nofollow" name="robots" />
    <title>IKEA</title>
    <link href="../assets/img/favicon.jpg" rel="shortcut icon" type="image/x-icon" />
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="../assets/css/animate.css" rel="stylesheet" />
    <link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="../assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="../assets/plugins/fontawesome/css/fontawesome.min.css" rel="stylesheet" />
    <link href="../assets/plugins/fontawesome/css/all.min.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
      a {
        text-decoration: none !important;
      }

      .ikea-header {
        background-color: #0051BA !important;
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
        background: linear-gradient(135deg, #a259c6 0%,rgb(80, 45, 137) 100%);
      }
      .bg-hijau {
        background: linear-gradient(135deg,rgb(89, 236, 222) 0%, #018679 100%);
      }
      .bg-merah {
        background: linear-gradient(135deg, #ff5858 0%, #e78001 100%);
      }

      /* Table Styles */
      .mature-table {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: none;
      }
      
      .mature-table .table {
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
      }
      
      .mature-table thead th {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 18px 15px;
        border: none;
        position: relative;
      }
      
      .mature-table thead th:first-child {
        border-top-left-radius: 12px;
      }
      
      .mature-table thead th:last-child {
        border-top-right-radius: 12px;
      }
      
      .mature-table tbody td {
        padding: 16px 15px;
        border-bottom: 1px solid #e9ecef;
        font-size: 0.9rem;
        vertical-align: middle;
        border-left: none;
        border-right: none;
      }
      
      .mature-table tbody tr:last-child td {
        border-bottom: none;
      }
      
      .mature-table tbody tr:nth-child(even) {
        background-color: #fafbfc;
      }
      
      .store-id {
        font-family: 'Courier New', monospace;
        background: #f1f3f4;
        padding: 4px 8px;
        border-radius: 4px;
        font-weight: 600;
        color: #5f6368;
        font-size: 0.8rem;
      }
      
      .store-name {
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.95rem;
      }
      
      .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
      }
      
      .status-active {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
      }
      .status-pending {
        background: linear-gradient(135deg, #c08124, #bec920);
        color: white;
        box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
      }
      
      .status-inactive {
        background: linear-gradient(135deg, #dc3545, #e74c3c);
        color: white;
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
      }
      
      .detail-btn {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 2px 10px rgba(79, 172, 254, 0.3);
      }
      
      .detail-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(79, 172, 254, 0.4);
        color: white;
        text-decoration: none;
      }
      
      .row-number {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.85rem;
        margin: 0 auto;
      }

      /* Chart Styles */
      .chart-section {
        background: #fff;
        border-radius: 16px;
        padding: 20px 20px 10px 20px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        transition: all 0.3s ease;
      }
      .chart-section:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.13);
      }
      .chart-header {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
      }
      .chart-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1976d2;
        margin: 0;
      }
      @media (max-width: 991px) {
        .chart-section { padding: 12px 6px 6px 6px; }
        .chart-title { font-size: 1rem; }
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
              <h4>SUPPLIER</h4>
              <h6>Monitor your supplier transactions</h6>
            </div>
          </div>

          <!-- Dashboard Cards -->
          <div class="row justify-content-end">
            <!-- Total Procurement Value -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <div class="dash-count das1">
                <div class="dash-counts">
                  <h4>$<span class="counters" data-count="4780000">4,780,000</span></h4>
                  <h5>Total Procurement Value</h5>
                  <h2 class="stat-change">+12% from last year</h2>
                </div>
                <div class="icon-box bg-ungu">
                  <i class="fa fa-dollar-sign"></i>
                </div>
              </div>
            </div>

            <!-- Processing Suppliers -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <div class="dash-count das2">
                <div class="dash-counts">
                  <h4><span class="counters" data-count="248">248</span></h4>
                  <h5>Processing Suppliers</h5>
                  <h2 class="stat-change">+5% from last month</h2>
                </div>
                <div class="icon-box bg-biru">
                  <i class="fa fa-truck-loading"></i>
                </div>
              </div>
            </div>

            <!-- New Suppliers -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <div class="dash-count das3">
                <div class="dash-counts">
                  <h4><span class="counters" data-count="32">32</span></h4>
                  <h5>New Suppliers</h5>
                  <h2 class="stat-change">+8% from last quarter</h2>
                </div>
                <div class="icon-box bg-merah">
                  <i class="fa fa-user-plus"></i>
                </div>
              </div>
            </div>

            <!-- Sustainability Score -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <div class="dash-count das4">
                <div class="dash-counts">
                  <h4><span class="counters" data-count="87">87</span>%</h4>
                  <h5>Sustainability Score</h5>
                  <h2 class="stat-change">+3% from last year</h2>
                </div>
                <div class="icon-box bg-hijau">
                  <i class="fa fa-leaf"></i>
                </div>
              </div>
            </div>
          </div>

          <!-- Charts Row -->
          <div class="row mb-4">
            <!-- Bar Chart - Top 5 Suppliers -->
            <div class="col-lg-8">
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chart-bar me-2"></i>Top 5 Performing Suppliers</h5>
                </div>
                <div style="height: 320px;">
                  <canvas id="barChart" style="width:100%;height:100%"></canvas>
                </div>
              </div>
            </div>
            
            <!-- Line Chart - Monthly Trend -->
            <div class="col-lg-4">
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chart-line me-2"></i>Monthly Procurement Trend</h5>
                </div>
                <div style="height: 320px;">
                  <canvas id="lineChart" style="width:100%;height:100%"></canvas>
                </div>
              </div>
            </div>
          </div>

          <div class="card mature-table">
            <div class="card-body" style="padding: 0;">
              <div class="table-top" style="padding: 20px 20px 0 20px;">
                <div class="search-set">
                  <div class="search-path">
                    <a class="btn btn-filter" id="filter_search">
                      <img src="../assets/img/icons/filter.svg" alt="img" />
                      <span><img src="../assets/img/icons/closes.svg" alt="img" /></span>
                    </a>
                  </div>
                  <div class="search-input">
                    <a class="btn btn-searchset"><img src="../assets/img/icons/search-white.svg" alt="img" /></a>
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

              <div class="card" id="filter_inputs" style="margin: 20px;">
                <div class="card-body pb-0" style="background: #f8f9fa; border-radius: 8px;">
                  <div class="row">
                    <div class="col-lg col-sm-6 col-12">
                      <div class="form-group">
                        <input type="text" class="datetimepicker cal-icon" placeholder="Choose Date" />
                      </div>
                    </div>
                    <div class="col-lg col-sm-6 col-12">
                      <div class="form-group">
                        <input type="text" placeholder="Enter Reference" />
                      </div>
                    </div>
                    <div class="col-lg col-sm-6 col-12">
                      <div class="form-group">
                        <select class="select">
                          <option>Choose Supplier</option>
                          <option>Supplier</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg col-sm-6 col-12">
                      <div class="form-group">
                        <select class="select">
                          <option>Choose Status</option>
                          <option>Inprogress</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg col-sm-6 col-12">
                      <div class="form-group">
                        <select class="select">
                          <option>Choose Payment Status</option>
                          <option>Payment Status</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-1 col-sm-6 col-12">
                      <div class="form-group">
                        <a class="btn btn-filters ms-auto"><img src="../assets/img/icons/search-whites.svg" alt="img" /></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="table-responsive" style="padding: 0 20px 20px 20px;">
                <table class="table datanew">
                    <h2>RECENT ORDERS</h2>
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>DATE</th>
                      <th>Store ID</th>
                      <th>Store</th>
                      <th>Status</th>
                      <th>TOTAL</th>
                      <th>Details</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><div class="row-number">1</div></td>
                      <td><span class="store-id">19 NOV 2025</span></td>
                      <td><span class="store-id">PT001</span></td>
                      <td><span class="store-name">Nordic Furnishings AB</span></td>
                      <td><span class="status-badge status-pending">PROCESSING</span></td>
                      <td>
                          250
                      </td>
                      <td>
                        <a href="../editpurchase.php" class="detail-btn">
                          View Details
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td><div class="row-number">2</div></td>
                      <td><span class="store-id">19 NOV 2025</span></td>
                      <td><span class="store-id">PT002</span></td>
                      <td><span class="store-name">Baltic Woodworks Ltd</span></td>
                      <td><span class="status-badge status-pending">PROCESSING</span></td>
                      <td>
                          100
                      </td>
                      <td>
                        <a href="../editpurchase.php" class="detail-btn">
                          View Details
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td><div class="row-number">3</div></td>
                      <td><span class="store-id">19 NOV 2025</span></td>
                      <td><span class="store-id">PT003</span></td>
                      <td><span class="store-name">Scandinavian Lights Co</span></td>
                      <td><span class="status-badge status-active">SHIPPED</span></td>
                      <td>
                          250
                      </td>
                      <td>
                        <a href="../editpurchase.php" class="detail-btn">
                          View Details
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td><div class="row-number">4</div></td>
                      <td><span class="store-id">19 NOV 2025</span></td>
                      <td><span class="store-id">PT004</span></td>
                      <td><span class="store-name">Finnish Design House</span></td>
                      <td><span class="status-badge status-pending">PROCESSING</span></td>
                      <td>
                          130
                      </td>
                      <td>
                        <a href="../editpurchase.php" class="detail-btn">
                          View Details
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td><div class="row-number">5</div></td>
                      <td><span class="store-id">19 NOV 2025</span></td>
                      <td><span class="store-id">PT005</span></td>
                      <td><span class="store-name">Swedish Textile Mills</span></td>
                      <td><span class="status-badge status-pending">PROCESSING</span></td>
                      <td>
                          250
                      </td>
                      <td>
                        <a href="../editpurchase.php" class="detail-btn">
                          View Details
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td><div class="row-number">6</div></td>
                      <td><span class="store-id">19 NOV 2025</span></td>
                      <td><span class="store-id">PT006</span></td>
                      <td><span class="store-name">Scandinavian Lights Co</span></td>
                      <td><span class="status-badge status-pending">PROCESSING</span></td>
                      <td>
                          200
                      </td>
                      <td>
                        <a href="../editpurchase.php" class="detail-btn">
                          View Details
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td><div class="row-number">7</div></td>
                      <td><span class="store-id">19 NOV 2025</span></td>
                      <td><span class="store-id">PT007</span></td>
                      <td><span class="store-name">Nordic Furnishings AB</span></td>
                      <td><span class="status-badge status-inactive">Delivered</span></td>
                      <td>
                          210
                      </td>
                      <td>
                        <a href="../editpurchase.php" class="detail-btn">
                          View Details
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
    </div>

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
      $(document).ready(function() {
        // Data untuk charts berdasarkan tabel
        const storeData = {
          stores: ['Nordic Furnishings AB', 'Scandinavian Lights Co', 'Swedish Textile Mills', 'Baltic Woodworks Ltd', 'Finnish Design House'],
          profits: [3.5, 2.8, 2.3, 1.9, 1.5],
          colors: ['#28a745', '#17a2b8', '#ffc107', '#fd7e14', '#6f42c1']
        };

        // Bar Chart - Top 5 Stores
        const barCtx = document.getElementById('barChart').getContext('2d');
        const gradient = barCtx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(1, '#66bfff');  // Biru muda
        gradient.addColorStop(0, '#0d47a1');  // Biru tua
        const barChart = new Chart(barCtx, {
          type: 'bar',
          data: {
            labels: storeData.stores,
            datasets: [{
              label: 'Performance Score',
              data: storeData.profits,
              backgroundColor: gradient,
              borderColor: '#0d47a1',
              borderWidth: 0,
              borderRadius: 6,
              barThickness: 30,
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
                    return `Score: ${context.parsed.y}`;
                  }
                }
              }
            },
            scales: {
              y: {
                beginAtZero: true,
                max: 4,
                ticks: {
                  color: '#666',
                  callback: function(value) {
                    return value;
                  }
                },
                grid: {
                  color: '#eee'
                }
              },
              x: {
                ticks: {
                  color: '#444'
                },
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
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
              label: 'Procurement Volume (Million $)',
              data: [1.2, 1.8, 2.1, 1.5, 2.3, 1.7],
              borderColor: '#667eea',
              backgroundColor: 'rgba(102, 126, 234, 0.1)',
              borderWidth: 3,
              fill: true,
              tension: 0.4,
              pointRadius: 6,
              pointHoverRadius: 8,
              pointBackgroundColor: '#667eea',
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
                    return `Volume: $${context.parsed.y}M`;
                  }
                }
              }
            },
            scales: {
              y: {
                beginAtZero: true,
                max: 3,
                ticks: {
                  callback: function(value) {
                    return '$' + value + 'M';
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

        // Refresh charts setiap 30 detik dengan data random (simulasi real-time)
        setInterval(() => {
          // Update line chart dengan data baru
          const newData = lineChart.data.datasets[0].data;
          newData.push((Math.random() * 2 + 1).toFixed(1));
          newData.shift();
          
          lineChart.data.labels.push(new Date().toLocaleTimeString().slice(0,5));
          lineChart.data.labels.shift();
          
          lineChart.update('none');
        }, 30000);
      });
    </script>
  </body>
</html>