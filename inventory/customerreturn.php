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
    <title>IKEA - Customer Returns</title>
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
      a {
        text-decoration: none !important;
      }

      .ikea-header {
        background-color: #0051BA !important;
      }

      /* Critical Notifications Section */
      .critical-notifications {
        background: linear-gradient(135deg, #4285f4 0%, #1a73e8 100%);
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 30px;
        color: white;
        position: relative;
        box-shadow: 0 8px 32px rgba(66, 133, 244, 0.3);
      }

      .critical-notifications h3 {
        color: white;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
      }

      .notification-card {
        background: white;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 12px;
        border-left: 4px solid;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
      }

      .notification-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(0,0,0,0.15);
      }

      .notification-card.warning {
        border-left-color: #ff9800;
      }

      .notification-card.danger {
        border-left-color: #f44336;
      }

      .notification-card.info {
        border-left-color: #2196f3;
      }

      .notification-title {
        font-weight: 600;
        color: #333;
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        gap: 8px;
      }

      .notification-desc {
        color: #666;
        font-size: 0.9rem;
        margin: 0;
      }

      /* Dashboard Analytics Cards */
      .analytics-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
      }

      .analytics-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
      }

      .analytics-subtitle {
        color: #666;
        font-size: 0.95rem;
        margin-top: 4px;
      }

      .btn-new-return {
        background: linear-gradient(135deg, #4285f4 0%, #1a73e8 100%);
        border: none;
        border-radius: 8px;
        padding: 12px 24px;
        color: white;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
      }

      .btn-new-return:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(66, 133, 244, 0.4);
        color: white;
      }

      /* Metric Cards */
      .metric-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        border-left: 4px solid;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
      }

      .metric-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
      }

      .metric-card.blue { border-left-color: #4285f4; }
      .metric-card.purple { border-left-color: #9c27b0; }
      .metric-card.orange { border-left-color: #ff9800; }
      .metric-card.teal { border-left-color: #009688; }

      .metric-value {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 8px;
        color: #333;
      }

      .metric-label {
        font-size: 0.95rem;
        color: #666;
        margin-bottom: 8px;
        font-weight: 500;
      }

      .metric-change {
        font-size: 0.85rem;
        padding: 4px 8px;
        border-radius: 12px;
        background: rgba(76, 175, 80, 0.1);
        color: #4caf50;
        font-weight: 600;
      }

      .metric-change.negative {
        background: rgba(244, 67, 54, 0.1);
        color: #f44336;
      }

      /* Export Buttons */
      .export-section {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
        justify-content: flex-end;
      }

      .btn-export {
        padding: 8px 16px;
        border-radius: 8px;
        border: none;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
      }

      .btn-export.excel {
        background: #28a745;
        color: white;
      }

      .btn-export.pdf {
        background: #dc3545;
        color: white;
      }

      .btn-export:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      }

      /* Search Section */
      .search-section {
        background: white;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      }

      .search-input {
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 12px 16px;
        font-size: 0.95rem;
        transition: border-color 0.2s ease;
        width: 100%;
        max-width: 400px;
      }

      .search-input:focus {
        outline: none;
        border-color: #4285f4;
        box-shadow: 0 0 0 3px rgba(66, 133, 244, 0.1);
      }

      /* Table Styles */
      .data-table {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
      }

      .data-table .table {
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
      }

      .data-table thead th {
        background: linear-gradient(135deg, #4285f4 0%, #1a73e8 100%);
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 18px 16px;
        border: none;
        position: sticky;
        top: 0;
        z-index: 10;
      }

      .data-table tbody td {
        padding: 16px;
        border-bottom: 1px solid #f0f0f0;
        font-size: 0.9rem;
        vertical-align: middle;
      }

      .data-table tbody tr:hover {
        background-color: #f8f9fa;
      }

      .productimgname {
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

      .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
      }

      .status-received { background: #e8f5e8; color: #2e7d32; }
      .status-ordered { background: #fff3e0; color: #f57c00; }
      .status-pending { background: #ffebee; color: #c62828; }

      .action-btn {
        background: #4285f4;
        border: none;
        border-radius: 6px;
        padding: 8px 12px;
        color: white;
        transition: all 0.2s ease;
      }

      .action-btn:hover {
        background: #1a73e8;
        transform: translateY(-1px);
        color: white;
      }

      /* Chart Styles */
      .chart-container {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        margin-bottom: 20px;
        height: 400px;
      }

      .chart-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
      }

      /* Responsive */
      @media (max-width: 768px) {
        .critical-notifications {
          margin: 0 -15px 20px -15px;
          border-radius: 0;
        }
        
        .metric-card {
          margin-bottom: 20px;
        }
        
        .export-section {
          justify-content: center;
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
          
          <!-- Critical Notifications Section -->
          <div class="critical-notifications">
            <h3>
              <i class="fas fa-exclamation-triangle"></i>
              Critical Notifications
            </h3>
            <div class="row">
              <div class="col-md-4">
                <div class="notification-card warning">
                  <div class="notification-title">
                    <i class="fas fa-triangle-exclamation" style="color: #ff9800;"></i>
                    IKEA ALAM SUTERA - High Return Volume Alert
                  </div>
                  <p class="notification-desc">Customer return volume critical, review product quality immediately</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="notification-card danger">
                  <div class="notification-title">
                    <i class="fas fa-sync-alt" style="color: #f44336;"></i>
                    IKEA JAKARTA GC - 4x Return Spike in 30 Days
                  </div>
                  <p class="notification-desc">Return requests increased 45% from last month</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="notification-card info">
                  <div class="notification-title">
                    <i class="fas fa-chart-line" style="color: #2196f3;"></i>
                    Return Pattern Analysis Ready
                  </div>
                  <p class="notification-desc">Furniture category shows highest return rate at 6.8%</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Page Header -->
          <div class="analytics-header">
            <div>
              <div class="analytics-title">Customer Return Analytics Dashboard</div>
              <div class="analytics-subtitle">Comprehensive return insights and customer satisfaction analysis</div>
            </div>
            <a href="addreturn.php" class="btn btn-new-return">
              <i class="fas fa-plus"></i>
              New Return
            </a>
          </div>

          <!-- Analytics Cards -->
          <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
              <div class="metric-card blue">
                <div class="metric-value">215</div>
                <div class="metric-label">Total Customer Returns</div>
                <div class="metric-change">+15% from last month</div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
              <div class="metric-card purple">
                <div class="metric-value">$12,450</div>
                <div class="metric-label">Total Refund Value</div>
                <div class="metric-change">+8% from last month</div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
              <div class="metric-card orange">
                <div class="metric-value">6.8%</div>
                <div class="metric-label">Avg Return Rate</div>
                <div class="metric-change negative">-1.2% from last month</div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
              <div class="metric-card teal">
                <div class="metric-value">Furniture</div>
                <div class="metric-label">Top Return Category</div>
                <div class="metric-change">42 returns this month</div>
              </div>
            </div>
          </div>

          <!-- Charts Row -->
          <div class="row mb-4">
            <!-- Monthly Returns Chart -->
            <div class="col-lg-8">
              <div class="chart-container">
                <div class="chart-title">Monthly Customer Returns Value</div>
                <canvas id="returnsChart"></canvas>
              </div>
            </div>
            
            <!-- Returns by Category -->
            <div class="col-lg-4">
              <div class="chart-container">
                <div class="chart-title">Returns by Category</div>
                <canvas id="categoryChart"></canvas>
              </div>
            </div>
          </div>

          <!-- Search and Export Section -->
          <div class="search-section">
            <div class="row align-items-center">
              <div class="col-md-6">
                <input type="text" class="search-input" placeholder="Search customer returns...">
              </div>
              <div class="col-md-6">
                <div class="export-section">
                  <button class="btn btn-export excel">
                    <i class="fas fa-file-excel"></i>
                    Export Excel
                  </button>
                  <button class="btn btn-export pdf">
                    <i class="fas fa-file-pdf"></i>
                    Export PDF
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Data Table -->
          <div class="data-table">
            <div class="table-responsive">
              <table class="table">
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
                      <a class="product-img">
                        <img src="../assets/img/product/<?= $products[rand(0,9)] ?>" alt="product" />
                      </a>
                      <a><?= $categories[rand(0,20)] ?></a>
                    </td>
                    <td><?= rand(1,12).'/'.rand(1,28).'/2022' ?></td>
                    <td><?= $branches[rand(0,5)] ?></td>
                    <td><?= $suppliers[rand(0,4)] ?></td>
                    <td>$<?= number_format($total, 2) ?></td>
                    <td><?= $percentage ?>%</td>
                    <td>
                      <span class="status-badge status-<?= strtolower($status) ?>">
                        <?= $status ?>
                      </span>
                    </td>
                    <td>
                      <button class="action-btn">
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
      // Returns Volume Chart
      const returnsCtx = document.getElementById('returnsChart').getContext('2d');
      const returnsChart = new Chart(returnsCtx, {
        type: 'bar',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          datasets: [{
            label: 'Return Value ($)',
            data: [850, 1200, 950, 1400, 1100, 1300, 1500, 1250, 1600, 1800, 2100, 2400],
            backgroundColor: '#4285f4',
            borderRadius: 6,
            barThickness: 20
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              grid: {
                color: '#eee'
              },
              ticks: {
                color: '#666',
                callback: function(value) {
                  return '$' + value;
                }
              }
            },
            x: {
              grid: {
                display: false
              },
              ticks: {
                color: '#444'
              }
            }
          }
        }
      });

      // Category Distribution Chart
      const categoryCtx = document.getElementById('categoryChart').getContext('2d');
      const categoryChart = new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
          labels: ['Furniture', 'Lighting', 'Storage', 'Bedroom', 'Kitchen', 'Others'],
          datasets: [{
            data: [42, 18, 15, 12, 8, 5],
            backgroundColor: [
              '#4285f4',
              '#9c27b0',
              '#ff9800',
              '#009688',
              '#dc3545',
              '#6c757d'
            ],
            borderWidth: 0
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom'
            }
          },
          cutout: '70%'
        }
      });

      // Initialize DataTable
      $(document).ready(function() {
        $('.table').DataTable({
          "pageLength": 10,
          "responsive": true,
          "searching": false,
          "lengthChange": false,
          "info": false
        });

        // Search functionality
        $('.search-input').on('keyup', function() {
          $('.table').DataTable().search(this.value).draw();
        });
      });
    </script>
  </body>
</html>
