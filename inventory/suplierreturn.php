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
    <title>IKEA - Supplier Returns Dashboard</title>
    <link href="../assets/img/favicon.jpg" rel="shortcut icon" type="image/x-icon" />
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/animate.css" rel="stylesheet" />
    <link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="../assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="../assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="../assets/plugins/fontawesome/css/fontawesome.min.css" rel="stylesheet" />
    <link href="../assets/plugins/fontawesome/css/all.min.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
      body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }

      a {
        text-decoration: none !important;
      }

      .ikea-header {
        background-color: #0051BA !important;
      }

      /* Modern Card Styles */
      .insight-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: none;
        margin-bottom: 24px;
        transition: all 0.3s ease;
      }

      .insight-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
      }

      .insight-header {
        display: flex;
        align-items: center;
        margin-bottom: 16px;
      }

      .insight-icon {
        width: 24px;
        height: 24px;
        margin-right: 12px;
        color: #2196F3;
      }

      .insight-title {
        font-size: 18px;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
      }

      .insight-content {
        color: #6c757d;
        font-size: 14px;
        line-height: 1.6;
      }

      /* Dashboard Stats Cards */
      .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
      }

      .stat-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border-left: 4px solid;
        transition: all 0.3s ease;
      }

      .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
      }

      .stat-card.blue { border-left-color: #2196F3; }
      .stat-card.purple { border-left-color: #9C27B0; }
      .stat-card.orange { border-left-color: #FF9800; }
      .stat-card.green { border-left-color: #4CAF50; }

      .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 16px;
      }

      .stat-value {
        font-size: 32px;
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
      }

      .stat-label {
        font-size: 14px;
        color: #6c757d;
        margin: 4px 0 8px 0;
      }

      .stat-change {
        font-size: 12px;
        padding: 4px 8px;
        border-radius: 12px;
        background: rgba(76, 175, 80, 0.1);
        color: #4CAF50;
        font-weight: 600;
      }

      .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: white;
      }

      .stat-icon.blue { background: linear-gradient(135deg, #2196F3, #1976D2); }
      .stat-icon.purple { background: linear-gradient(135deg, #9C27B0, #7B1FA2); }
      .stat-icon.orange { background: linear-gradient(135deg, #FF9800, #F57C00); }
      .stat-icon.green { background: linear-gradient(135deg, #4CAF50, #388E3C); }

      /* Chart Containers */
      .chart-section {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
        margin-bottom: 32px;
      }

      .chart-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      }

      .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
      }

      .chart-title {
        font-size: 18px;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
      }

      .chart-dropdown {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 14px;
        background: white;
      }

      .chart-container {
        position: relative;
        height: 300px;
      }

      .readiness-score {
        text-align: center;
        padding: 40px 20px;
      }

      .score-value {
        font-size: 64px;
        font-weight: 700;
        color: #2196F3;
        margin: 0;
      }

      .score-label {
        font-size: 18px;
        font-weight: 600;
        color: #2c3e50;
        margin: 8px 0;
      }

      .score-subtitle {
        font-size: 14px;
        color: #6c757d;
      }

      .score-indicators {
        display: flex;
        justify-content: space-around;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid #e0e0e0;
      }

      .score-indicator {
        text-align: center;
      }

      .indicator-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin: 0 auto 8px;
      }

      .indicator-dot.green { background: #4CAF50; }
      .indicator-dot.yellow { background: #FF9800; }
      .indicator-dot.blue { background: #2196F3; }

      .indicator-label {
        font-size: 12px;
        color: #6c757d;
        font-weight: 600;
      }

      /* Comparison Cards */
      .comparison-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 32px;
      }

      .comparison-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      }

      .comparison-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
      }

      .comparison-icon {
        width: 24px;
        height: 24px;
        margin-right: 12px;
        color: #2196F3;
      }

      .comparison-title {
        font-size: 16px;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
      }

      .vs-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
      }

      .brand-item {
        text-align: center;
        flex: 1;
      }

      .brand-logo {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        margin: 0 auto 12px;
        background: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: #666;
      }

      .brand-name {
        font-size: 18px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 4px;
      }

      .brand-stats {
        font-size: 12px;
        color: #6c757d;
      }

      .brand-category {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 16px;
        font-size: 12px;
        font-weight: 600;
        margin-top: 8px;
      }

      .category-organizer { background: #E3F2FD; color: #1976D2; }
      .category-storage { background: #E0F2F1; color: #00796B; }
      .category-furniture { background: #E8F5E8; color: #2E7D32; }
      .category-bedroom { background: #FFF3E0; color: #F57C00; }

      .vs-badge {
        background: linear-gradient(135deg, #FF5722, #D32F2F);
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
      }

      /* Notifications Panel */
      .notifications-panel {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 24px;
      }

      .notification-item {
        display: flex;
        align-items: flex-start;
        padding: 16px 0;
        border-bottom: 1px solid #f0f0f0;
      }

      .notification-item:last-child {
        border-bottom: none;
      }

      .notification-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
        font-size: 16px;
        color: white;
      }

      .notification-icon.warning { background: #FF9800; }
      .notification-icon.info { background: #2196F3; }
      .notification-icon.critical { background: #F44336; }

      .notification-content {
        flex: 1;
      }

      .notification-title {
        font-size: 14px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 4px;
      }

      .notification-badge {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: 600;
        margin-left: 8px;
      }

      .badge-critical { background: #FFEBEE; color: #D32F2F; }
      .badge-warning { background: #FFF3E0; color: #F57C00; }
      .badge-info { background: #E3F2FD; color: #1976D2; }

      .notification-desc {
        font-size: 12px;
        color: #6c757d;
        line-height: 1.4;
      }

      /* Table Styles */
      .modern-table {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-top: 24px;
      }

      .table-header {
        padding: 24px;
        border-bottom: 1px solid #e0e0e0;
      }

      .table-title {
        font-size: 20px;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
      }

      .modern-table .table {
        margin: 0;
      }

      .modern-table thead th {
        background: #f8f9fa;
        color: #2c3e50;
        font-weight: 600;
        font-size: 14px;
        padding: 16px;
        border: none;
      }

      .modern-table tbody td {
        padding: 16px;
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
      }

      .status-badge {
        padding: 6px 12px;
        border-radius: 16px;
        font-size: 12px;
        font-weight: 600;
      }

      .badge-success { background: #E8F5E8; color: #2E7D32; }
      .badge-warning { background: #FFF3E0; color: #F57C00; }
      .badge-danger { background: #FFEBEE; color: #D32F2F; }

      @media (max-width: 768px) {
        .chart-section {
          grid-template-columns: 1fr;
        }
        
        .comparison-section {
          grid-template-columns: 1fr;
        }
        
        .stats-grid {
          grid-template-columns: 1fr;
        }
      }
    </style>
  </head>
  <body>
    <div id="global-loader">
      <div class="whirly-loader"></div>
    </div>

    <div class="main-wrapper">
      <?php include BASE_PATH . '/include/sidebar.php'; ?>
      <?php include __DIR__ . '/../include/header.php'; ?>

      <div class="page-wrapper">
        <div class="content">
          <!-- Page Header -->
          <div class="page-header mb-4">
            <div class="page-title">
              <h4>Supplier Returns Dashboard</h4>
              <h6>Comprehensive returns analytics and management</h6>
            </div>
            <div class="page-btn">
              <a href="addreturn.php" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>New Return
              </a>
            </div>
          </div>

          <!-- Stats Grid -->
          <div class="stats-grid">
            <div class="stat-card blue">
              <div class="stat-header">
                <div>
                  <div class="stat-value">124</div>
                  <div class="stat-label">Total Returns</div>
                  <div class="stat-change">+8% from last month</div>
                </div>
                <div class="stat-icon blue">
                  <i class="fas fa-undo"></i>
                </div>
              </div>
            </div>

            <div class="stat-card purple">
              <div class="stat-header">
                <div>
                  <div class="stat-value">$8,650</div>
                  <div class="stat-label">Total Value</div>
                  <div class="stat-change">+12% from last month</div>
                </div>
                <div class="stat-icon purple">
                  <i class="fas fa-dollar-sign"></i>
                </div>
              </div>
            </div>

            <div class="stat-card orange">
              <div class="stat-header">
                <div>
                  <div class="stat-value">3.2</div>
                  <div class="stat-label">Avg. Processing Days</div>
                  <div class="stat-change">-0.8 days improvement</div>
                </div>
                <div class="stat-icon orange">
                  <i class="fas fa-clock"></i>
                </div>
              </div>
            </div>

            <div class="stat-card green">
              <div class="stat-header">
                <div>
                  <div class="stat-value">28</div>
                  <div class="stat-label">Top Supplier Returns</div>
                  <div class="stat-change">Apex Computers</div>
                </div>
                <div class="stat-icon green">
                  <i class="fas fa-user-tie"></i>
                </div>
              </div>
            </div>
          </div>

          <!-- Charts Section -->
          <div class="chart-section">
            <div class="chart-card">
              <div class="chart-header">
                <h3 class="chart-title">Return Growth Trend (Top 5 Categories)</h3>
                <select class="chart-dropdown">
                  <option>2025</option>
                  <option>2024</option>
                </select>
              </div>
              <div class="chart-container">
                <canvas id="trendChart"></canvas>
              </div>
              <div class="insight-card" style="margin-top: 20px; margin-bottom: 0;">
                <div class="insight-header">
                  <i class="fas fa-lightbulb insight-icon"></i>
                  <h4 class="insight-title">Insight: Return Category Trends</h4>
                </div>
                <div class="insight-content">
                  Furniture category shows stable growth with 8% QoQ increase. Small decline in June due to stock issues.
                </div>
              </div>
            </div>

            <div class="chart-card">
              <div class="chart-header">
                <h3 class="chart-title">Category Readiness Index</h3>
                <select class="chart-dropdown">
                  <option>Furniture</option>
                  <option>Storage</option>
                  <option>Lighting</option>
                </select>
              </div>
              <div class="readiness-score">
                <div class="score-value">92%</div>
                <div class="score-label">Furniture</div>
                <div class="score-subtitle">Promo-Ready Score</div>
                <div class="score-indicators">
                  <div class="score-indicator">
                    <div class="indicator-dot green"></div>
                    <div class="indicator-label">High</div>
                    <div style="font-size: 10px; color: #999;">Stock</div>
                  </div>
                  <div class="score-indicator">
                    <div class="indicator-dot yellow"></div>
                    <div class="indicator-label">Rating 4.6</div>
                    <div style="font-size: 10px; color: #999;">Rating</div>
                  </div>
                  <div class="score-indicator">
                    <div class="indicator-dot blue"></div>
                    <div class="indicator-label">Stable</div>
                    <div style="font-size: 10px; color: #999;">Stability</div>
                  </div>
                </div>
                <div style="margin-top: 16px; padding: 8px; background: #E3F2FD; border-radius: 8px; font-size: 12px; color: #1976D2;">
                  <i class="fas fa-check-circle"></i> Ready for Flash Sale
                </div>
              </div>
            </div>
          </div>

          <!-- Comparison Section -->
          <div class="comparison-section">
            <div class="comparison-card">
              <div class="comparison-header">
                <i class="fas fa-chart-bar comparison-icon"></i>
                <h4 class="comparison-title">Insight "Top Returning Products" Brand Comparison</h4>
              </div>
              <div class="vs-container">
                <div class="brand-item">
                  <div class="brand-logo">SKÅDIS</div>
                  <div class="brand-name">SKÅDIS</div>
                  <div class="brand-stats">4.6 | Rp 299K | 240/bln</div>
                  <div class="brand-category category-organizer">Organizer</div>
                </div>
                <div class="vs-badge">VS</div>
                <div class="brand-item">
                  <div class="brand-logo">VARIERA</div>
                  <div class="brand-name">VARIERA</div>
                  <div class="brand-stats">4.3 | Rp 249K | 0.850/bln</div>
                  <div class="brand-category category-storage">Storage</div>
                </div>
              </div>
            </div>

            <div class="comparison-card">
              <div class="comparison-header">
                <i class="fas fa-chart-bar comparison-icon"></i>
                <h4 class="comparison-title">Insight "Top Returning Products" Brand Comparison</h4>
              </div>
              <div class="vs-container">
                <div class="brand-item">
                  <div class="brand-logo">LACK</div>
                  <div class="brand-name">LACK</div>
                  <div class="brand-stats">4.5 | Rp 199K | 0.950/bln</div>
                  <div class="brand-category category-furniture">Furniture</div>
                </div>
                <div class="vs-badge">VS</div>
                <div class="brand-item">
                  <div class="brand-logo">HEMNES</div>
                  <div class="brand-name">HEMNES</div>
                  <div class="brand-stats">4.7 | Rp 599K | 1.403/bln</div>
                  <div class="brand-category category-bedroom">Bedroom</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Notifications Panel -->
          <div class="notifications-panel">
            <div class="insight-header">
              <i class="fas fa-bell insight-icon"></i>
              <h4 class="insight-title">Critical Return Notifications</h4>
            </div>
            
            <div class="notification-item">
              <div class="notification-icon critical">
                <i class="fas fa-exclamation-triangle"></i>
              </div>
              <div class="notification-content">
                <div class="notification-title">
                  Furniture - High Return Rate Alert
                  <span class="notification-badge badge-critical">Critical</span>
                </div>
                <div class="notification-desc">Critical stock levels, restock required immediately</div>
              </div>
            </div>

            <div class="notification-item">
              <div class="notification-icon warning">
                <i class="fas fa-exclamation-circle"></i>
              </div>
              <div class="notification-content">
                <div class="notification-title">
                  Furniture - 5 Products Low Stock
                  <span class="notification-badge badge-warning">Warning</span>
                </div>
                <div class="notification-desc">Evaluate marketing strategy for these products</div>
              </div>
            </div>

            <div class="notification-item">
              <div class="notification-icon info">
                <i class="fas fa-comment"></i>
              </div>
              <div class="notification-content">
                <div class="notification-title">
                  Customer Complaints - 8 Negative Reviews This Week
                  <span class="notification-badge badge-info">Info</span>
                </div>
                <div class="notification-desc">Main complaint: damaged during shipping</div>
              </div>
            </div>
          </div>

          <!-- Returns Table -->
          <div class="modern-table">
            <div class="table-header">
              <h3 class="table-title">Recent Supplier Returns</h3>
            </div>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>NO</th>
                    <th>Image</th>
                    <th>Date</th>
                    <th>Supplier</th>
                    <th>To Storage</th>
                    <th>Reference</th>
                    <th>Grand Total ($)</th>
                    <th>Paid ($)</th>
                    <th>Due ($)</th>
                    <th>Payment Status</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $suppliers = ['Apex Computers', 'Modern Automobile', 'AIM Infotech', 'Best Power Tools', 'Hatimi Hardware & Tools'];
                  $stores = ['IKEA Alam Sutera', 'IKEA Sentul City', 'IKEA Jakarta Garden City', 'IKEA Kota Baru Parahyangan', 'IKEA Bali', 'IKEA Mal Taman Anggrek'];
                  $products = ['product1.jpg', 'product2.jpg', 'product3.jpg', 'product4.jpg', 'product5.jpg', 'product6.jpg', 'product7.jpg', 'product8.jpg', 'product9.jpg', 'product10.jpg'];
                  
                  for($i=1; $i<=12; $i++): 
                    $status = ['Received', 'Ordered', 'Pending'][rand(0,2)];
                    $paymentStatus = ['Paid', 'Partial', 'Unpaid'][rand(0,2)];
                    $total = rand(200, 5000);
                    $paid = $paymentStatus == 'Paid' ? $total : ($paymentStatus == 'Partial' ? rand(100, $total-100) : 0);
                  ?>
                  <tr>
                    <td><?= $i ?></td>
                    <td>
                      <img src="../assets/img/product/<?= $products[rand(0,9)] ?>" alt="product" style="width: 40px; height: 40px; border-radius: 8px; object-fit: cover;" />
                    </td>
                    <td><?= rand(1,12).'/'.rand(1,28).'/2022' ?></td>
                    <td><?= $suppliers[rand(0,4)] ?></td>
                    <td><?= $stores[rand(0,5)] ?></td>
                    <td>RT<?= str_pad($i, 4, '0', STR_PAD_LEFT) ?></td>
                    <td><?= number_format($total, 2) ?></td>
                    <td><?= number_format($paid, 2) ?></td>
                    <td><?= number_format($total - $paid, 2) ?></td>
                    <td>
                      <span class="status-badge <?= 
                        $paymentStatus == 'Paid' ? 'badge-success' : 
                        ($paymentStatus == 'Partial' ? 'badge-warning' : 'badge-danger') 
                      ?>"><?= $paymentStatus ?></span>
                    </td>
                    <td>
                      <span class="status-badge <?= 
                        $status == 'Received' ? 'badge-success' : 
                        ($status == 'Ordered' ? 'badge-warning' : 'badge-danger') 
                      ?>"><?= $status ?></span>
                    </td>
                    <td>
                      <a class="btn btn-sm btn-outline-primary" href="editreturn.php?id=<?= $i ?>">
                        <i class="fas fa-edit"></i>
                      </a>
                    </td>
                  </tr>
                  <?php endfor; ?>
                </tbody>
              </table>
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
      // Trend Chart
      const trendCtx = document.getElementById('trendChart').getContext('2d');
      const trendChart = new Chart(trendCtx, {
        type: 'line',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
          datasets: [{
            label: 'Furniture Returns',
            data: [1000, 400, 800, 530, 620, 150, 900, 800],
            borderColor: '#F44336',
            backgroundColor: 'rgba(244, 67, 54, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#F44336',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 6
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
              backgroundColor: 'rgba(0,0,0,0.8)',
              titleColor: '#fff',
              bodyColor: '#fff',
              borderColor: '#F44336',
              borderWidth: 1
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              grid: {
                color: '#f0f0f0'
              },
              ticks: {
                color: '#666'
              }
            },
            x: {
              grid: {
                display: false
              },
              ticks: {
                color: '#666'
              }
            }
          },
          elements: {
            point: {
              hoverRadius: 8
            }
          }
        }
      });

      // Counter Animation
      $(document).ready(function() {
        $('.stat-value').each(function() {
          const $this = $(this);
          const countTo = parseInt($this.text().replace(/[^0-9.]/g, ''));
          
          $({ countNum: 0 }).animate({
            countNum: countTo
          }, {
            duration: 2000,
            easing: 'swing',
            step: function() {
              const formattedNumber = Math.floor(this.countNum);
              if ($this.text().includes('$')) {
                $this.text('$' + formattedNumber.toLocaleString());
              } else if ($this.text().includes('.')) {
                $this.text((this.countNum).toFixed(1));
              } else {
                $this.text(formattedNumber.toLocaleString());
              }
            },
            complete: function() {
              if ($this.text().includes('$')) {
                $this.text('$' + countTo.toLocaleString());
              } else if (countTo === 3.2) {
                $this.text('3.2');
              } else {
                $this.text(countTo.toLocaleString());
              }
            }
          });
        });
      });
    </script>
  </body>
</html>