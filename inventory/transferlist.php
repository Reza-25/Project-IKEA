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

      /* Dashboard Card Styles */
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
      }

      /* Color Themes */
      .das1 { border-top: 6px solid #1a5ea7; }
      .das1 * { color: #1a5ea7 !important; }
      
      .das2 { border-top: 6px solid #751e8d; }
      .das2 * { color: #751e8d !important; }
      
      .das3 { border-top: 6px solid #e78001; }
      .das3 * { color: #e78001 !important; }
      
      .das4 { border-top: 6px solid #018679; }
      .das4 * { color: #018679 !important; }

      .stat-change {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
        display: inline-block;
        padding: 3px 6px;
        border-radius: 12px;
        font-weight: 600;
      }

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
      }
      
      .mature-table tbody td {
        padding: 16px 15px;
        border-bottom: 1px solid #e9ecef;
        font-size: 0.9rem;
        vertical-align: middle;
      }
      
      .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
      }
      
      .bg-lightgreen {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
      }
      
      .bg-lightyellow {
        background: linear-gradient(135deg, #ffc107, #ff9800);
        color: white;
      }
      
      .bg-lightred {
        background: linear-gradient(135deg, #dc3545, #e74c3c);
        color: white;
      }

      /* Chart Styles */
      .chart-container {
        position: relative;
        height: 350px;
        background: #fff;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.1);
        margin-bottom: 20px;
      }

      .chart-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
      }

      /* Responsive Adjustments */
      @media (max-width: 768px) {
        .chart-container {
          height: 300px;
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
          <div class="page-header">
            <div class="page-title">
              <h4>Transfer List</h4>
              <h6>Transfer your stocks between stores</h6>
            </div>
            <div class="page-btn">
              <a href="addtransfer.php" class="btn btn-added">
                <img src="../assets/img/icons/plus.svg" class="me-1" alt="img">New Transfer
              </a>
            </div>
          </div>

          <!-- Dashboard Cards -->
          <div class="row justify-content-end">
            <!-- Total Transfers -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <div class="dash-count das1">
                <div class="dash-counts">
                  <h4><span class="counters" data-count="156">156</span></h4>
                  <h5>Total Transfers</h5>
                  <h2 class="stat-change">+12% from last month</h2>
                </div>
                <div class="icon-box bg-ungu">
                  <i class="fa fa-exchange-alt"></i>
                </div>
              </div>
            </div>

            <!-- Completed Transfers -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <div class="dash-count das2">
                <div class="dash-counts">
                  <h4><span class="counters" data-count="98">98</span></h4>
                  <h5>Completed</h5>
                  <h2 class="stat-change">+8% from last month</h2>
                </div>
                <div class="icon-box bg-biru">
                  <i class="fa fa-check-circle"></i>
                </div>
              </div>
            </div>

            <!-- In Progress -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <div class="dash-count das3">
                <div class="dash-counts">
                  <h4><span class="counters" data-count="32">32</span></h4>
                  <h5>In Progress</h5>
                  <h2 class="stat-change">+5% from last month</h2>
                </div>
                <div class="icon-box bg-merah">
                  <i class="fa fa-truck-loading"></i>
                </div>
              </div>
            </div>

            <!-- Avg. Transfer Time -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <div class="dash-count das4">
                <div class="dash-counts">
                  <h4><span class="counters" data-count="2.5">2.5</span> days</h4>
                  <h5>Avg. Transfer Time</h5>
                  <h2 class="stat-change">-0.5 days from last month</h2>
                </div>
                <div class="icon-box bg-hijau">
                  <i class="fa fa-clock"></i>
                </div>
              </div>
            </div>
          </div>

          <!-- Charts Row -->
          <div class="row mb-4">
            <!-- Transfer Volume Chart -->
            <div class="col-lg-8">
              <div class="chart-container">
                <div class="chart-title">Monthly Transfer Volume</div>
                <canvas id="transferChart"></canvas>
              </div>
            </div>
            
            <!-- Status Distribution -->
            <div class="col-lg-4">
              <div class="chart-container">
                <div class="chart-title">Transfer Status Distribution</div>
                <canvas id="statusChart"></canvas>
              </div>
            </div>
          </div>

          <!-- Transfer List Table -->
          <div class="card mature-table">
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
                    <input type="text" placeholder="Search..." />
                    <a class="btn btn-searchset">
                      <img src="../assets/img/icons/search-white.svg" alt="img" />
                    </a>
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

              <div class="table-responsive">
                <table class="table datanew">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Reference</th>
                      <th>From Branch</th>
                      <th>To Branch</th>
                      <th>Items Total</th>
                      <th>Money Spent</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Table rows remain the same as original -->
                    <?php for($i=1; $i<=18; $i++): ?>
                    <tr>
                      <td><?= $i ?></td>
                      <td>19 Nov 2022</td>
                      <td>TR01<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></td>
                      <td>IKEA <?= ['Alam Sutera', 'Jakarta Garden City', 'Sentul City', 'Bali', 'Kota Baru Parahyangan', 'Mal Taman Anggrek'][rand(0,5)] ?></td>
                      <td>IKEA <?= ['Alam Sutera', 'Jakarta Garden City', 'Sentul City', 'Bali', 'Kota Baru Parahyangan', 'Mal Taman Anggrek'][rand(0,5)] ?></td>
                      <td><?= rand(5,50) ?></td>
                      <td><?= number_format(rand(100,5000), 2) ?></td>
                      <td>
                        <?php 
                        $status = ['Completed', 'On Progress', 'Pending', 'Not Started'][rand(0,3)];
                        $badgeClass = [
                          'Completed' => 'bg-lightgreen',
                          'On Progress' => 'bg-lightyellow',
                          'Pending' => 'bg-lightred',
                          'Not Started' => 'bg-lightred'
                        ][$status];
                        ?>
                        <span class="badges <?= $badgeClass ?>"><?= $status ?></span>
                      </td>
                      <td>
                        <a class="btn btn-sm btn-outline-primary" href="edittransfer.php?id=<?= $i ?>">
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
      // Transfer Volume Chart
      const transferCtx = document.getElementById('transferChart').getContext('2d');
      const transferChart = new Chart(transferCtx, {
        type: 'bar',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          datasets: [{
            label: 'Transfers',
            data: [12, 19, 15, 21, 14, 16, 18, 17, 20, 22, 25, 28],
            backgroundColor: '#1a5ea7',
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
                color: '#666'
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

      // Status Distribution Chart
      const statusCtx = document.getElementById('statusChart').getContext('2d');
      const statusChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
          labels: ['Completed', 'In Progress', 'Pending', 'Not Started'],
          datasets: [{
            data: [58, 23, 12, 7],
            backgroundColor: [
              '#28a745',
              '#ffc107',
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

      // Counter Animation
      $(document).ready(function() {
        $('.counters').each(function() {
          $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
          }, {
            duration: 2000,
            easing: 'swing',
            step: function(now) {
              if($(this).data('count').toString().includes('.')) {
                $(this).text(now.toFixed(1));
              } else {
                $(this).text(Math.ceil(now));
              }
            }
          });
        });
      });
    </script>
  </body>
</html>