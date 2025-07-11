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
    <title>IKEA Transfer Analytics</title>
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

      /* Main Dashboard Cards */
      .analytics-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: none;
        margin-bottom: 24px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
      }

      .analytics-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
      }

      /* Metric Cards */
      .metric-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        text-align: left;
        border-left: 4px solid;
        margin-bottom: 16px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      }

      .metric-card.blue { border-left-color: #4285f4; }
      .metric-card.purple { border-left-color: #9c27b0; }
      .metric-card.orange { border-left-color: #ff9800; }
      .metric-card.teal { border-left-color: #009688; }

      .metric-number {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        color: #333;
      }

      .metric-label {
        font-size: 0.9rem;
        color: #666;
        margin: 4px 0;
        font-weight: 500;
      }

      .metric-change {
        font-size: 0.8rem;
        color: #28a745;
        font-weight: 600;
      }

      /* Chart Containers */
.chart-container {
  background: white;
  border-radius: 16px;
  padding: 24px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  margin-bottom: 24px;
}
.chart-container.fixed-height {
  height: 400px;
  max-height: 400px;
  min-height: 400px;
  overflow: hidden;
  position: relative;
}

.chart-container.fixed-height canvas {
  height: 100% !important;
}
.chart-container canvas {
  max-height: 300px;
  height: 100% !important;
}
.trend-chart-wrapper {
  height: 100% !important;
  max-height: 300px;
}


      .chart-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
      }

      .chart-title i {
        margin-right: 8px;
        color: #4285f4;
      }

      /* Insight Boxes */
      .insight-box {
        background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        border-left: 4px solid #4285f4;
      }

      .insight-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #4285f4;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
      }

      .insight-title i {
        margin-right: 8px;
      }

      .insight-text {
        color: #666;
        font-size: 0.9rem;
        line-height: 1.5;
      }

      /* Blue Header Cards */
      .blue-header-card {
        background: linear-gradient(135deg, #4285f4 0%, #1976d2 100%);
        color: white;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 24px;
      }

      .blue-header-card h5 {
        margin: 0;
        font-weight: 600;
        display: flex;
        align-items: center;
      }

      .blue-header-card i {
        margin-right: 8px;
      }

      /* Brand Comparison Cards */
      .comparison-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 16px;
      }

      .vs-badge {
        background: #dc3545;
        color: white;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin: 10px auto;
      }

      .brand-name {
        font-size: 1.1rem;
        font-weight: 600;
        margin: 10px 0 5px 0;
      }

      .brand-stats {
        font-size: 0.85rem;
        color: #666;
      }

      /* Status Badges */
      .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
      }

      .status-completed { background: #d4edda; color: #155724; }
      .status-progress { background: #fff3cd; color: #856404; }
      .status-pending { background: #f8d7da; color: #721c24; }

      /* Legend */
      .legend-item {
        display: inline-flex;
        align-items: center;
        margin-right: 20px;
        margin-bottom: 8px;
        font-size: 0.85rem;
      }

      .legend-color {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-right: 6px;
      }

      /* Notification Cards */
      .notification-card {
        background: white;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 12px;
        border-left: 4px solid;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
      }

      .notification-card.warning { border-left-color: #ff9800; }
      .notification-card.danger { border-left-color: #dc3545; }
      .notification-card.info { border-left-color: #17a2b8; }

      .notification-title {
        font-weight: 600;
        margin-bottom: 4px;
        font-size: 0.9rem;
      }

      .notification-text {
        font-size: 0.8rem;
        color: #666;
      }

      /* Table Improvements */
      .modern-table {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      }

      .modern-table .table thead th {
        background: linear-gradient(135deg, #4285f4 0%, #1976d2 100%);
        color: white;
        font-weight: 600;
        border: none;
        padding: 16px;
      }

      .modern-table .table tbody td {
        padding: 14px 16px;
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
      }

      /* City Tags */
      .city-tag {
        display: inline-block;
        background: #4285f4;
        color: white;
        padding: 4px 12px;
        border-radius: 16px;
        font-size: 0.8rem;
        margin: 2px;
      }

      .city-tag.secondary {
        background: #6c757d;
      }

      /* Score Display */
      .score-display {
        text-align: center;
        padding: 20px;
      }

      .score-number {
        font-size: 3rem;
        font-weight: 700;
        color: #4285f4;
        margin: 0;
      }

      .score-label {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        margin: 8px 0;
      }

      .score-subtitle {
        font-size: 0.9rem;
        color: #666;
      }

      .score-indicators {
        display: flex;
        justify-content: space-around;
        margin-top: 16px;
      }

      .score-indicator {
        text-align: center;
      }

      .score-indicator i {
        font-size: 1.2rem;
        margin-bottom: 4px;
      }

      .score-indicator .label {
        font-size: 0.8rem;
        font-weight: 600;
      }

      .progress-bar-custom {
        height: 6px;
        border-radius: 3px;
        background: #e9ecef;
        margin: 12px 0;
      }

      .progress-fill {
        height: 100%;
        border-radius: 3px;
        background: linear-gradient(90deg, #4285f4, #1976d2);
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
          <!-- Header -->
          <div class="page-header mb-4">
            <div class="page-title">
              <h4>Transfer Analytics Dashboard</h4>
              <h6>Comprehensive transfer insights and branch distribution analysis</h6>
            </div>
            <div class="page-btn">
              <a href="addtransfer.php" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>New Transfer
              </a>
            </div>
          </div>

          <!-- Top Metrics Row -->
          <div class="row">
            <div class="col-lg-3 col-md-6">
              <div class="metric-card blue">
                <div class="metric-number">156</div>
                <div class="metric-label">Total Active Transfers</div>
                <div class="metric-change">+12% from last month</div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="metric-card purple">
                <div class="metric-number">2.4</div>
                <div class="metric-label">Avg Transfer Time (Days)</div>
                <div class="metric-change">+8.3% from last year</div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="metric-card orange">
                <div class="metric-number">89%</div>
                <div class="metric-label">Success Rate</div>
                <div class="metric-change">+15% from last month</div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="metric-card teal">
                <div class="metric-number">Furniture</div>
                <div class="metric-label">Top Transfer Category</div>
                <div class="metric-change">Dominated by HEMNES</div>
              </div>
            </div>
          </div>

          <!-- Main Analytics Row -->
          <div class="row">
            <!-- Transfer Distribution Chart -->
            <div class="col-lg-8">
              <div class="chart-container ">
                <div class="chart-title">
                  <i class="fas fa-chart-pie"></i>
                  Branch Transfer Distribution
                </div>
                
                <!-- Legend -->
                <div class="mb-3">
                  <div class="legend-item">
                    <div class="legend-color" style="background: #4285f4;"></div>
                    IKEA Alam Sutera (28%)
                  </div>
                  <div class="legend-item">
                    <div class="legend-color" style="background: #9c27b0;"></div>
                    IKEA Jakarta Garden City (22%)
                  </div>
                  <div class="legend-item">
                    <div class="legend-color" style="background: #00bcd4;"></div>
                    IKEA Sentul City (18%)
                  </div>
                  <div class="legend-item">
                    <div class="legend-color" style="background: #3f51b5;"></div>
                    IKEA Bali (15%)
                  </div>
                  <div class="legend-item">
                    <div class="legend-color" style="background: #e91e63;"></div>
                    IKEA Kota Baru Parahyangan (12%)
                  </div>
                  <div class="legend-item">
                    <div class="legend-color" style="background: #00bcd4;"></div>
                    Others (5%)
                  </div>
                </div>

                <canvas id="distributionChart" height="300"></canvas>
                
                <div class="insight-box mt-3">
                  <div class="insight-title">
                    <i class="fas fa-lightbulb"></i>
                    Insight: Branch Distribution
                  </div>
                  <div class="insight-text">
                    Top 3 branches account for 68% of total transfers. IKEA Jakarta Garden City shows highest growth (+5% YoY) in transfer volume.
                  </div>
                </div>
              </div>
            </div>

            <!-- Transfer Readiness Index -->
            <div class="col-lg-4">
              <div class="blue-header-card">
                <h5><i class="fas fa-bolt"></i> Transfer Readiness Index</h5>
              </div>
              
              <div class="analytics-card">
                <div class="score-display">
                  <div class="score-number">92%</div>
                  <div class="score-label">IKEA ALAM SUTERA</div>
                  <div class="score-subtitle">Transfer-Ready Score</div>
                  
                  <div class="score-indicators">
                    <div class="score-indicator">
                      <i class="fas fa-boxes text-success"></i>
                      <div class="label">Stock Ready</div>
                    </div>
                    <div class="score-indicator">
                      <i class="fas fa-star text-warning"></i>
                      <div class="label">Rating 4.6</div>
                    </div>
                    <div class="score-indicator">
                      <i class="fas fa-chart-line text-primary"></i>
                      <div class="label">Stable</div>
                    </div>
                  </div>
                  
                  <div class="progress-bar-custom">
                    <div class="progress-fill" style="width: 92%;"></div>
                  </div>
                  
                  <div class="text-center mt-2">
                    <small class="text-success">✓ Ready for Flash Transfer</small>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Transfer Trend Chart -->
          <div class="row">
            <div class="col-12">
              <div class="chart-container fixed-height">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <div class="chart-title">
                    <i class="fas fa-chart-line"></i>
                    Transfer Growth Trend (Top 5 Branches)
                  </div>
                  <select class="form-select" style="width: auto;">
                    <option>2025</option>
                    <option>2024</option>
                  </select>
                </div>
                <canvas id="trendChart"></canvas>
                
                <div class="insight-box mt-3">
                  <div class="insight-title">
                    <i class="fas fa-lightbulb"></i>
                    Insight: Transfer Trend Analysis
                  </div>
                  <div class="insight-text">
                    IKEA Alam Sutera shows consistent growth with 8% QoQ improvement. Slight decline in June due to inventory optimization program.
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Branch Comparison and Insights -->
          <div class="row">
            <div class="col-lg-8">
              <div class="analytics-card">
                <div class="chart-title">
                  <i class="fas fa-balance-scale"></i>
                  Branch Performance Comparison
                </div>
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="comparison-card">
                      <div class="d-flex justify-content-between align-items-center">
                        <div>
                          <div class="brand-name">IKEA ALAM SUTERA</div>
                          <div class="brand-stats">4.6⭐ | 156 transfers | 2.1 days avg</div>
                        </div>
                        <div class="vs-badge">VS</div>
                        <div>
                          <div class="brand-name">IKEA SENTUL CITY</div>
                          <div class="brand-stats">4.3⭐ | 98 transfers | 2.8 days avg</div>
                        </div>
                      </div>
                      <div class="mt-2">
                        <span class="badge bg-primary">Furniture</span>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="comparison-card">
                      <div class="d-flex justify-content-between align-items-center">
                        <div>
                          <div class="brand-name">IKEA JAKARTA GC</div>
                          <div class="brand-stats">4.5⭐ | 142 transfers | 2.3 days avg</div>
                        </div>
                        <div class="vs-badge">VS</div>
                        <div>
                          <div class="brand-name">IKEA BALI</div>
                          <div class="brand-stats">4.7⭐ | 89 transfers | 3.1 days avg</div>
                        </div>
                      </div>
                      <div class="mt-2">
                        <span class="badge bg-info">Storage</span>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="insight-box mt-3">
                  <div class="insight-title">
                    <i class="fas fa-lightbulb"></i>
                    Insight: Branch Competition
                  </div>
                  <div class="insight-text">
                    Alam Sutera leads in efficiency and volume, while Sentul City excels in customer satisfaction. Jakarta GC dominates furniture category transfers.
                  </div>
                </div>
              </div>
            </div>

            <!-- AI Suggestions and Notifications -->
            <div class="col-lg-4">
              <div class="blue-header-card">
                <h5><i class="fas fa-robot"></i> AI Transfer Optimization</h5>
              </div>
              
              <div class="analytics-card">
                <div class="insight-title">
                  <i class="fas fa-lightbulb"></i>
                  AI Suggestion: Route Optimization
                </div>
                <div class="insight-text mb-3">
                  "Consider direct transfer route for furniture items to reduce 45% transfer time. Optimize Jakarta-Bali corridor for better efficiency."
                </div>
              </div>

              <div class="blue-header-card">
                <h5><i class="fas fa-map-marker-alt"></i> Top Transfer Locations</h5>
              </div>
              
              <div class="analytics-card">
                <div class="mb-3">
                  <strong>IKEA ALAM SUTERA</strong>
                  <div class="text-muted small">Most transfers to:</div>
                  <div class="mt-2">
                    <span class="city-tag">Jakarta GC</span>
                    <span class="city-tag secondary">Sentul City</span>
                    <span class="city-tag secondary">Bali</span>
                    <span class="city-tag secondary">Bandung</span>
                  </div>
                </div>
                
                <div class="mb-3">
                  <strong>IKEA JAKARTA GC</strong>
                  <div class="text-muted small">Popular destinations:</div>
                  <div class="mt-2">
                    <span class="city-tag secondary">Bandung</span>
                    <span class="city-tag">Alam Sutera</span>
                    <span class="city-tag secondary">Sentul</span>
                    <span class="city-tag secondary">Bali</span>
                  </div>
                </div>
              </div>

              <div class="blue-header-card">
                <h5><i class="fas fa-exclamation-triangle"></i> Critical Notifications</h5>
              </div>
              
              <div class="notification-card warning">
                <div class="notification-title">⚠️ IKEA ALAM SUTERA - High Volume Alert</div>
                <div class="notification-text">Transfer volume critical, optimize routing immediately</div>
              </div>
              
              <div class="notification-card danger">
                <div class="notification-title">🔄 IKEA JAKARTA GC - 4x Restocks in 30 Days</div>
                <div class="notification-text">Inventory requests increased 45% from last month</div>
              </div>
              
              <div class="notification-card info">
                <div class="notification-title">📊 Transfer Prediction Ready</div>
                <div class="notification-text">IKEA Bali predicted to need 2,100 units in August 2025</div>
              </div>
            </div>
          </div>

          <!-- Transfer List Table -->
          <div class="modern-table mt-4">
            <div class="card-body">
              <div class="table-top mb-3">
                <div class="search-set">
                  <div class="search-input">
                    <input type="text" placeholder="Search transfers..." class="form-control" />
                  </div>
                </div>
                <div class="wordset">
                  <button class="btn btn-primary btn-sm me-2">
                    <i class="fas fa-file-excel"></i> Export Excel
                  </button>
                  <button class="btn btn-danger btn-sm">
                    <i class="fas fa-file-pdf"></i> Export PDF
                  </button>
                </div>
              </div>

              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Category ID</th>
                      <th>From Branch</th>
                      <th>To Branch</th>
                      <th>Items</th>
                      <th>Value</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $branches = ['Alam Sutera', 'Jakarta Garden City', 'Sentul City', 'Bali', 'Kota Baru Parahyangan', 'Mal Taman Anggrek'];
                    $categories = ['Furniture', 'Lighting', 'Storage', 'Bedroom', 'Living Room', 'Kitchen', 'Dining'];
                    for($i=1; $i<=12; $i++): 
                    ?>
                    <tr>
                      <td><?= $i ?></td>
                      <td>TR-<?= str_pad($i, 3, '0', STR_PAD_LEFT) ?></td>
                      <td>IKEA <?= $branches[array_rand($branches)] ?></td>
                      <td>IKEA <?= $branches[array_rand($branches)] ?></td>
                      <td><?= $categories[array_rand($categories)] ?></td>
                      <td>Rp <?= number_format(rand(100000, 5000000), 0, ',', '.') ?></td>
                      <td>
                        <?php 
                        $statuses = [
                          ['Completed', 'status-completed'],
                          ['In Progress', 'status-progress'], 
                          ['Pending', 'status-pending']
                        ];
                        $status = $statuses[array_rand($statuses)];
                        ?>
                        <span class="status-badge <?= $status[1] ?>"><?= $status[0] ?></span>
                      </td>
                      <td>
                        <button class="btn btn-sm btn-outline-primary">
                          <i class="fas fa-eye"></i>
                        </button>
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
      // Distribution Pie Chart
      const distributionCtx = document.getElementById('distributionChart').getContext('2d');
      const distributionChart = new Chart(distributionCtx, {
        type: 'doughnut',
        data: {
          labels: ['IKEA Alam Sutera', 'IKEA Jakarta GC', 'IKEA Sentul City', 'IKEA Bali', 'IKEA Kota Baru Parahyangan', 'Others'],
          datasets: [{
            data: [28, 22, 18, 15, 12, 5],
            backgroundColor: [
              '#4285f4',
              '#9c27b0', 
              '#00bcd4',
              '#3f51b5',
              '#e91e63',
              '#00bcd4'
            ],
            borderWidth: 0,
            cutout: '60%'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false
            }
          }
        }
      });

      // Transfer Trend Line Chart
      const trendCtx = document.getElementById('trendChart').getContext('2d');
      const trendChart = new Chart(trendCtx, {
        type: 'line',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
          datasets: [
            {
              label: 'IKEA Alam Sutera',
              data: [320, 350, 380, 410, 440, 420, 450, 480],
              borderColor: '#4285f4',
              backgroundColor: 'rgba(66, 133, 244, 0.1)',
              tension: 0.4,
              fill: false
            },
            {
              label: 'IKEA Jakarta GC',
              data: [280, 290, 310, 330, 340, 350, 370, 380],
              borderColor: '#9c27b0',
              backgroundColor: 'rgba(156, 39, 176, 0.1)',
              tension: 0.4,
              fill: false
            },
            {
              label: 'IKEA Sentul City',
              data: [250, 260, 270, 290, 300, 320, 330, 350],
              borderColor: '#00bcd4',
              backgroundColor: 'rgba(0, 188, 212, 0.1)',
              tension: 0.4,
              fill: false
            },
            {
              label: 'IKEA Bali',
              data: [200, 210, 220, 230, 240, 250, 260, 270],
              borderColor: '#3f51b5',
              backgroundColor: 'rgba(63, 81, 181, 0.1)',
              tension: 0.4,
              fill: false
            },
            {
              label: 'IKEA Kota Baru Parahyangan',
              data: [180, 190, 200, 210, 220, 230, 240, 250],
              borderColor: '#e91e63',
              backgroundColor: 'rgba(233, 30, 99, 0.1)',
              tension: 0.4,
              fill: false
            }
          ]
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
          scales: {
            y: {
              beginAtZero: false,
              grid: {
                color: '#f0f0f0'
              }
            },
            x: {
              grid: {
                display: false
              }
            }
          }
        }
      });

      // Counter Animation
      $(document).ready(function() {
        $('.metric-number').each(function() {
          const $this = $(this);
          const countTo = parseInt($this.text()) || 0;
          
          if (countTo > 0) {
            $({ countNum: 0 }).animate({
              countNum: countTo
            }, {
              duration: 2000,
              easing: 'swing',
              step: function() {
                $this.text(Math.floor(this.countNum));
              },
              complete: function() {
                $this.text(countTo);
              }
            });
          }
        });
      });
    </script>
  </body>
</html>
