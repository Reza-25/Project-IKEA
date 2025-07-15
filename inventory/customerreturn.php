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
    <title>IKEA - Customer Returns Dashboard</title>
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

      .stat-change.negative {
        background: rgba(244, 67, 54, 0.1);
        color: #F44336;
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

      .category-score {
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

      /* Top Categories Section */
      .top-categories {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 32px;
      }

      .categories-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
      }

      .categories-title {
        font-size: 18px;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
      }

      .category-bars {
        display: flex;
        flex-direction: column;
        gap: 16px;
      }

      .category-bar {
        display: flex;
        align-items: center;
        gap: 16px;
      }

      .category-name {
        min-width: 100px;
        font-size: 14px;
        font-weight: 500;
        color: #2c3e50;
      }

      .bar-container {
        flex: 1;
        height: 24px;
        background: #f0f0f0;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
      }

      .bar-fill {
        height: 100%;
        border-radius: 12px;
        transition: width 0.8s ease;
      }

      .bar-value {
        min-width: 60px;
        text-align: right;
        font-size: 14px;
        font-weight: 600;
        color: #2c3e50;
      }

      /* Location Distribution */
      .location-panel {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 24px;
      }

      .location-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
      }

      .location-icon {
        width: 24px;
        height: 24px;
        margin-right: 12px;
        color: #2196F3;
      }

      .location-title {
        font-size: 16px;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
      }

      .location-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
      }

      .location-item:last-child {
        border-bottom: none;
      }

      .location-name {
        font-size: 14px;
        color: #2c3e50;
      }

      .location-badge {
        padding: 4px 12px;
        border-radius: 16px;
        font-size: 12px;
        font-weight: 600;
      }

      .badge-top-seller { background: #E3F2FD; color: #1976D2; }
      .badge-rising-star { background: #E8F5E8; color: #2E7D32; }

      .location-tags {
        display: flex;
        gap: 8px;
        margin-top: 8px;
      }

      .location-tag {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: 600;
        background: #2196F3;
        color: white;
      }

      /* AI Suggestions */
      .ai-suggestions {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 24px;
      }

      .ai-header {
        display: flex;
        align-items: center;
        margin-bottom: 16px;
      }

      .ai-icon {
        width: 24px;
        height: 24px;
        margin-right: 12px;
        color: #2196F3;
      }

      .ai-title {
        font-size: 16px;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
      }

      .ai-content {
        color: #6c757d;
        font-size: 14px;
        line-height: 1.6;
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

      .productimgname {
        display: flex;
        align-items: center;
        gap: 12px;
      }

      .productimgname img {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        object-fit: cover;
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
              <h4>Customer Returns Dashboard</h4>
              <h6>Comprehensive customer return analytics and insights</h6>
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
                  <div class="stat-value">215</div>
                  <div class="stat-label">Total Returns</div>
                  <div class="stat-change">+15% from last month</div>
                </div>
                <div class="stat-icon blue">
                  <i class="fas fa-undo"></i>
                </div>
              </div>
            </div>

            <div class="stat-card purple">
              <div class="stat-header">
                <div>
                  <div class="stat-value">$12,450</div>
                  <div class="stat-label">Total Refund Value</div>
                  <div class="stat-change">+8% from last month</div>
                </div>
                <div class="stat-icon purple">
                  <i class="fas fa-dollar-sign"></i>
                </div>
              </div>
            </div>

            <div class="stat-card orange">
              <div class="stat-header">
                <div>
                  <div class="stat-value">6.8%</div>
                  <div class="stat-label">Avg. Return Rate</div>
                  <div class="stat-change negative">-1.2% from last month</div>
                </div>
                <div class="stat-icon orange">
                  <i class="fas fa-percentage"></i>
                </div>
              </div>
            </div>

            <div class="stat-card green">
              <div class="stat-header">
                <div>
                  <div class="stat-value">42</div>
                  <div class="stat-label">Top Category Returns</div>
                  <div class="stat-change">Furniture</div>
                </div>
                <div class="stat-icon green">
                  <i class="fas fa-couch"></i>
                </div>
              </div>
            </div>
          </div>

          <!-- Top Categories with Highest Returns -->
          <div class="top-categories">
            <div class="categories-header">
              <div class="insight-header">
                <i class="fas fa-chart-bar insight-icon"></i>
                <h3 class="categories-title">Top 5 Categories with Highest Returns</h3>
              </div>
              <select class="chart-dropdown">
                <option>2025</option>
                <option>2024</option>
              </select>
            </div>
            <div class="category-bars">
              <div class="category-bar">
                <div class="category-name">Furniture</div>
                <div class="bar-container">
                  <div class="bar-fill" style="width: 85%; background: #2196F3;"></div>
                </div>
                <div class="bar-value">Rp 9K</div>
              </div>
              <div class="category-bar">
                <div class="category-name">Lighting</div>
                <div class="bar-container">
                  <div class="bar-fill" style="width: 70%; background: #2196F3;"></div>
                </div>
                <div class="bar-value">Rp 8K</div>
              </div>
              <div class="category-bar">
                <div class="category-name">Storage</div>
                <div class="bar-container">
                  <div class="bar-fill" style="width: 65%; background: #2196F3;"></div>
                </div>
                <div class="bar-value">Rp 7K</div>
              </div>
              <div class="category-bar">
                <div class="category-name">Bedroom</div>
                <div class="bar-container">
                  <div class="bar-fill" style="width: 60%; background: #2196F3;"></div>
                </div>
                <div class="bar-value">Rp 7K</div>
              </div>
              <div class="category-bar">
                <div class="category-name">Kitchen</div>
                <div class="bar-container">
                  <div class="bar-fill" style="width: 55%; background: #2196F3;"></div>
                </div>
                <div class="bar-value">Rp 6K</div>
              </div>
            </div>
            <div class="insight-card" style="margin-top: 20px; margin-bottom: 0;">
              <div class="insight-header">
                <i class="fas fa-lightbulb insight-icon"></i>
                <h4 class="insight-title">Insight: Customer Return Dominance</h4>
              </div>
              <div class="insight-content">
                Furniture category dominates customer returns with highest contribution. Returns peaked in Q2 due to "Summer Refresh" promotion campaign.
              </div>
            </div>
          </div>

          <!-- Charts Section -->
          <div class="chart-section">
            <div class="chart-card">
              <div class="chart-header">
                <h3 class="chart-title">Category Return Contribution to Total Returns</h3>
              </div>
              <div class="chart-container">
                <canvas id="contributionChart"></canvas>
              </div>
            </div>

            <div>
              <!-- Category Readiness Index -->
              <div class="chart-card" style="margin-bottom: 24px;">
                <div class="chart-header">
                  <h3 class="chart-title">Category Readiness Index</h3>
                  <select class="chart-dropdown">
                    <option>Furniture</option>
                    <option>Lighting</option>
                    <option>Storage</option>
                  </select>
                </div>
                <div class="category-score">
                  <div class="score-value">89%</div>
                  <div class="score-label">Furniture</div>
                  <div class="score-subtitle">Return Management Score</div>
                  <div class="score-indicators">
                    <div class="score-indicator">
                      <div class="indicator-dot green"></div>
                      <div class="indicator-label">Stable</div>
                      <div style="font-size: 10px; color: #999;">Stock</div>
                    </div>
                    <div class="score-indicator">
                      <div class="indicator-dot yellow"></div>
                      <div class="indicator-label">Rating 4.7</div>
                      <div style="font-size: 10px; color: #999;">Rating</div>
                    </div>
                    <div class="score-indicator">
                      <div class="indicator-dot blue"></div>
                      <div class="indicator-label">Normal</div>
                      <div style="font-size: 10px; color: #999;">Restock</div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Location Distribution -->
              <div class="location-panel">
                <div class="location-header">
                  <i class="fas fa-map-marker-alt location-icon"></i>
                  <h4 class="location-title">Return Distribution by Location</h4>
                </div>
                
                <div class="location-item">
                  <div>
                    <div class="location-name">Furniture</div>
                    <div class="location-tags">
                      <div class="location-tag">Jakarta</div>
                      <div class="location-tag">Surabaya</div>
                      <div class="location-tag">Medan</div>
                      <div class="location-tag">Bandung</div>
                    </div>
                  </div>
                  <div class="location-badge badge-top-seller">Top Seller</div>
                </div>

                <div class="location-item">
                  <div>
                    <div class="location-name">Storage</div>
                    <div class="location-tags">
                      <div class="location-tag">Bandung</div>
                      <div class="location-tag">Yogyakarta</div>
                      <div class="location-tag">Malang</div>
                      <div class="location-tag">Denpasar</div>
                    </div>
                  </div>
                  <div class="location-badge badge-rising-star">Rising Star</div>
                </div>
              </div>
            </div>
          </div>

          <!-- AI Suggestions and Notifications -->
          <div class="row">
            <div class="col-lg-6">
              <div class="ai-suggestions">
                <div class="ai-header">
                  <i class="fas fa-robot ai-icon"></i>
                  <h4 class="ai-title">AI Suggestion: Return Optimization</h4>
                </div>
                <div class="ai-content">
                  "Analysis shows 'furniture defects' increased 45% in the last 3 months. AI Recommendation: Implement quality control + restock strategy for KALLAX series"
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <!-- Notifications Panel -->
              <div class="notifications-panel">
                <div class="insight-header">
                  <i class="fas fa-bell insight-icon"></i>
                  <h4 class="insight-title">Critical Return Alerts</h4>
                </div>
                
                <div class="notification-item">
                  <div class="notification-icon critical">
                    <i class="fas fa-exclamation-triangle"></i>
                  </div>
                  <div class="notification-content">
                    <div class="notification-title">
                      Furniture - High Return Rate
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
                      Lighting - Quality Issues
                      <span class="notification-badge badge-warning">Warning</span>
                    </div>
                    <div class="notification-desc">15% MoM increase, rating dropped to 4.1</div>
                  </div>
                </div>

                <div class="notification-item">
                  <div class="notification-icon info">
                    <i class="fas fa-comment"></i>
                  </div>
                  <div class="notification-content">
                    <div class="notification-title">
                      Customer Feedback - 12 Reviews
                      <span class="notification-badge badge-info">Info</span>
                    </div>
                    <div class="notification-desc">Main issue: damaged during shipping</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Returns Table -->
          <div class="modern-table">
            <div class="table-header">
              <h3 class="table-title">Recent Customer Returns</h3>
            </div>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>NO</th>
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
                <tbody>
                  <?php 
                  $categories = ['Furniture', 'Lighting', 'Storage', 'Bedroom', 'Living Room', 'Kitchen', 'Dining', 'Office', 'Outdoor', 'Textiles', 'Decoration', 'Bathroom', 'Children', 'Appliances', 'Rugs', 'Curtains', 'Tableware', 'Cookware', 'Laundry', 'Cleaning', 'Pet'];
                  $branches = ['IKEA Alam Sutera', 'IKEA Sentul City', 'IKEA Jakarta Garden City', 'IKEA Kota Baru Parahyangan', 'IKEA Bali', 'IKEA Mal Taman Anggrek'];
                  $suppliers = ['Apex Computers', 'Modern Automobile', 'AIM Infotech', 'Best Power Tools', 'Hatimi Hardware & Tools'];
                  $products = ['product1.jpg', 'product2.jpg', 'product3.jpg', 'product4.jpg', 'product5.jpg', 'product6.jpg', 'product7.jpg', 'product8.jpg', 'product9.jpg', 'product10.jpg'];
                  
                  for($i=1; $i<=21; $i++): 
                    $status = ['Received', 'Ordered', 'Pending'][rand(0,2)];
                    $total = rand(100, 1200);
                    $percentage = number_format(($total/12000)*100, 1);
                  ?>
                  <tr>
                    <td><?= $i ?></td>
                    <td class="productimgname">
                      <img src="../assets/img/product/<?= $products[rand(0,9)] ?>" alt="product" />
                      <span><?= $categories[rand(0,20)] ?></span>
                    </td>
                    <td><?= rand(1,12).'/'.rand(1,28).'/2022' ?></td>
                    <td><?= $branches[rand(0,5)] ?></td>
                    <td><?= $suppliers[rand(0,4)] ?></td>
                    <td>$<?= number_format($total, 2) ?></td>
                    <td><?= $percentage ?>%</td>
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
      // Category Contribution Chart (Donut)
      const contributionCtx = document.getElementById('contributionChart').getContext('2d');
      const contributionChart = new Chart(contributionCtx, {
        type: 'doughnut',
        data: {
          labels: ['Living Room', 'Storage', 'Outdoor', 'Cleaning', 'Curtains', 'Furniture'],
          datasets: [{
            data: [5, 5, 5, 5, 5, 74],
            backgroundColor: [
              '#2196F3',
              '#757575',
              '#4CAF50',
              '#FF9800',
              '#F44336',
              '#9C27B0'
            ],
            borderWidth: 0
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom',
              labels: {
                usePointStyle: true,
                padding: 20
              }
            }
          },
          cutout: '60%'
        }
      });

      // Counter Animation
      $(document).ready(function() {
        $('.stat-value').each(function() {
          const $this = $(this);
          let countTo;
          
          if ($this.text().includes('$')) {
            countTo = parseInt($this.text().replace(/[^0-9]/g, ''));
          } else if ($this.text().includes('%')) {
            countTo = parseFloat($this.text().replace('%', ''));
          } else {
            countTo = parseInt($this.text());
          }
          
          $({ countNum: 0 }).animate({
            countNum: countTo
          }, {
            duration: 2000,
            easing: 'swing',
            step: function() {
              if ($this.text().includes('$')) {
                $this.text('$' + Math.floor(this.countNum).toLocaleString());
              } else if ($this.text().includes('%')) {
                $this.text(this.countNum.toFixed(1) + '%');
              } else {
                $this.text(Math.floor(this.countNum));
              }
            },
            complete: function() {
              if ($this.text().includes('$')) {
                $this.text('$' + countTo.toLocaleString());
              } else if (countTo === 6.8) {
                $this.text('6.8%');
              } else {
                $this.text(countTo);
              }
            }
          });
        });

        // Animate category bars
        setTimeout(() => {
          $('.bar-fill').each(function() {
            const width = $(this).css('width');
            $(this).css('width', '0%').animate({ width: width }, 1000);
          });
        }, 500);
      });
    </script>
  </body>
</html>