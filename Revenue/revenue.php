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
    <title>IKEA</title>

    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg" />
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="../assets/css/animate.css" />
    <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    
    <style>
      .chart-container {
        position: relative;
        height: 300px;
        margin-bottom: 30px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        padding: 20px;
        transition: all 0.3s ease;
      }
      
      .chart-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
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
  background: linear-gradient(135deg, #a259c6 0%, #6d28d9 100%);
}
.bg-hijau {
  background: linear-gradient(135deg,rgb(89, 236, 222) 0%, #018679 100%);
}
.bg-merah {
  background: linear-gradient(135deg, #ff5858 0%, #e78001 100%);
}
      .profit-positive {
        color: #28a745;
      }
      
      .profit-negative {
        color: #dc3545;
      }
      
      .chart-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
      }
      
      .table-hover-effect {
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
      }
      
      .table-hover-effect:hover {
        transform: translateX(5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        background-color: #f8f9ff;
        border-left: 3px solid #667eea;
      }
      
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
      
      .status-inactive {
        background: linear-gradient(135deg, #dc3545, #e74c3c);
        color: white;
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
      }
      
      .profit-cell {
        font-weight: 700;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 5px;
      }
      
      .profit-positive {
        color: #28a745;
      }
      
      .profit-negative {
        color: #dc3545;
      }
      
      .profit-icon {
        width: 16px;
        height: 16px;
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
              <h4>Revenue Analytics</h4>
              <h6>Monitor your store performance and profits</h6>
            </div>
          </div>

                     <!-- Total Expenses, Top Category, Top Expense, Avg Daily Expense -->
          <div class="row justify-content-end">
            <!-- Total Product Sold -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="revenue/revenue.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das1">
                  <div class="dash-counts">
                     <h4>$<span class="counters" data-count="111598">111,589</span></h4>
                    <h5>Revenue Growth</h5>
                    <h2 class="stat-change">+1.7 from last month</h2>
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
                      <h4>$<span class="counters" data-count="34111598">111,589</span></h4>
                    <h5>Total Revenue</h5>
                  <h2 class="stat-change">Keep up the good work!</h2>
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
                    <h4>92%</h4>
                    <h5>Target Achievement</h5>
                    <h2 class="stat-change">Keep it up!</h2>
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
                   <h4>Bali</h4>
                    <h5>Top Performer</h5>
                    <h2 class="stat-change">Keep it up!</h2>
                    </div>
                    <div class="icon-box bg-hijau">
                      <i class="fa fa-chart-line"></i>
                    </div>
                </div>
              </a>
            </div>
          </div>
          <!-- END KOLOM  -->

          <!-- Charts Row -->
          <div class="row mb-4">
            <!-- Bar Chart - Top 5 Stores -->
            <div class="col-lg-8">
              <div class="chart-container">
                <div class="chart-title">Top 5 Performing Stores</div>
                <canvas id="barChart"></canvas>
              </div>
            </div>
            
            <!-- Line Chart - Monthly Trend -->
            <div class="col-lg-4">
              <div class="chart-container">
                <div class="chart-title">Monthly Profit Trend</div>
                <canvas id="lineChart"></canvas>
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
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>Store ID</th>
                      <th>Store</th>
                      <th>Status</th>
                      <th>Profit</th>
                      <th>Details</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="table-hover-effect">
                      <td><div class="row-number">1</div></td>
                      <td><span class="store-id">PT001</span></td>
                      <td><span class="store-name">IKEA Alam Sutera</span></td>
                      <td><span class="status-badge status-active">Active</span></td>
                      <td>
                        <div class="profit-cell profit-positive">
                          +1.5%
                          <svg class="profit-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                          </svg>
                        </div>
                      </td>
                      <td>
                        <a href="../editpurchase.php" class="detail-btn">
                          View Details
                        </a>
                      </td>
                    </tr>
                    <tr class="table-hover-effect">
                      <td><div class="row-number">2</div></td>
                      <td><span class="store-id">PT002</span></td>
                      <td><span class="store-name">IKEA Sentul City</span></td>
                      <td><span class="status-badge status-active">Active</span></td>
                      <td>
                        <div class="profit-cell profit-positive">
                          +3.5%
                          <svg class="profit-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                          </svg>
                        </div>
                      </td>
                      <td>
                        <a href="../editpurchase.php" class="detail-btn">
                          View Details
                        </a>
                      </td>
                    </tr>
                    <tr class="table-hover-effect">
                      <td><div class="row-number">3</div></td>
                      <td><span class="store-id">PT003</span></td>
                      <td><span class="store-name">IKEA Kota Baru Parahyangan</span></td>
                      <td><span class="status-badge status-active">Active</span></td>
                      <td>
                        <div class="profit-cell profit-positive">
                          +1.5%
                          <svg class="profit-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                          </svg>
                        </div>
                      </td>
                      <td>
                        <a href="../editpurchase.php" class="detail-btn">
                          View Details
                        </a>
                      </td>
                    </tr>
                    <tr class="table-hover-effect">
                      <td><div class="row-number">4</div></td>
                      <td><span class="store-id">PT004</span></td>
                      <td><span class="store-name">IKEA Jakarta Garden City</span></td>
                      <td><span class="status-badge status-active">Active</span></td>
                      <td>
                        <div class="profit-cell profit-negative">
                          -0.2%
                          <svg class="profit-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                          </svg>
                        </div>
                      </td>
                      <td>
                        <a href="../editpurchase.php" class="detail-btn">
                          View Details
                        </a>
                      </td>
                    </tr>
                    <tr class="table-hover-effect">
                      <td><div class="row-number">5</div></td>
                      <td><span class="store-id">PT005</span></td>
                      <td><span class="store-name">IKEA Bali</span></td>
                      <td><span class="status-badge status-active">Active</span></td>
                      <td>
                        <div class="profit-cell profit-positive">
                          +1.5%
                          <svg class="profit-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                          </svg>
                        </div>
                      </td>
                      <td>
                        <a href="../editpurchase.php" class="detail-btn">
                          View Details
                        </a>
                      </td>
                    </tr>
                    <tr class="table-hover-effect">
                      <td><div class="row-number">6</div></td>
                      <td><span class="store-id">PT006</span></td>
                      <td><span class="store-name">IKEA Mal Taman Anggrek</span></td>
                      <td><span class="status-badge status-active">Active</span></td>
                      <td>
                        <div class="profit-cell profit-positive">
                          +2.0%
                          <svg class="profit-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                          </svg>
                        </div>
                      </td>
                      <td>
                        <a href="../editpurchase.php" class="detail-btn">
                          View Details
                        </a>
                      </td>
                    </tr>
                    <tr class="table-hover-effect">
                      <td><div class="row-number">7</div></td>
                      <td><span class="store-id">PT007</span></td>
                      <td><span class="store-name">IKEA Ciputra World Surabaya</span></td>
                      <td><span class="status-badge status-inactive">Inactive</span></td>
                      <td>
                        <div class="profit-cell profit-negative">
                          -1.0%
                          <svg class="profit-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                          </svg>
                        </div>
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
      // Data untuk charts berdasarkan tabel
      const storeData = {
        stores: ['Sentul City', 'Taman Anggrek', 'Alam Sutera', 'Bali', 'Kota Baru'],
        profits: [3.5, 2.0, 1.5, 1.5, 1.5],
        colors: ['#28a745', '#17a2b8', '#ffc107', '#fd7e14', '#6f42c1']
      };

      // Bar Chart - Top 5 Stores
      const barCtx = document.getElementById('barChart').getContext('2d');
      const barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
          labels: storeData.stores,
          datasets: [{
            label: 'Profit (%)',
            data: storeData.profits,
            backgroundColor: storeData.colors,
            borderColor: storeData.colors,
            borderWidth: 2,
            borderRadius: 8,
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
                  return `Profit: +${context.parsed.y}%`;
                }
              }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              max: 4,
              ticks: {
                callback: function(value) {
                  return '+' + value + '%';
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

      // Line Chart - Monthly Trend
      const lineCtx = document.getElementById('lineChart').getContext('2d');
      const lineChart = new Chart(lineCtx, {
        type: 'line',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
          datasets: [{
            label: 'Average Profit',
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
                  return `Profit: +${context.parsed.y}%`;
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
                  return '+' + value + '%';
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

      // Animasi untuk mini dashboard cards
      document.addEventListener('DOMContentLoaded', function() {
        const miniCharts = document.querySelectorAll('.mini-chart-container');
        miniCharts.forEach((chart, index) => {
          setTimeout(() => {
            chart.style.opacity = '0';
            chart.style.transform = 'translateY(20px)';
            chart.style.transition = 'all 0.6s ease';
            
            setTimeout(() => {
              chart.style.opacity = '1';
              chart.style.transform = 'translateY(0)';
            }, 100);
          }, index * 200);
        });
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
    </script>
  </body>
</html>