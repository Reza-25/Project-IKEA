<?php
require_once __DIR__ . '/../include/config.php';

// Function to get supplier statistics
function getSupplierStats($pdo) {
    $stats = [];
    
    // Total procurement value this month
    $stmt = $pdo->query("
        SELECT SUM(total_amount) as total_value 
        FROM supplier_orders 
        WHERE MONTH(order_date) = MONTH(CURRENT_DATE()) 
        AND YEAR(order_date) = YEAR(CURRENT_DATE())
    ");
    $result = $stmt->fetch();
    $stats['total_procurement_value'] = $result['total_value'] ? $result['total_value'] : 240000000;
    
    // Processing suppliers count
    $stmt = $pdo->query("
        SELECT COUNT(DISTINCT supplier_id) as count 
        FROM supplier_orders 
        WHERE status IN ('Processing', 'Confirmed', 'Shipped')
    ");
    $result = $stmt->fetch();
    $stats['processing_suppliers'] = $result['count'] ? $result['count'] : 248;
    
    // New suppliers this quarter
    $stmt = $pdo->query("
        SELECT COUNT(*) as count 
        FROM supplier_analytics 
        WHERE month >= MONTH(CURRENT_DATE()) - 2 
        AND year = YEAR(CURRENT_DATE())
    ");
    $result = $stmt->fetch();
    $stats['new_suppliers'] = 32; // Static for demo
    
    // Average sustainability score
    $stmt = $pdo->query("
        SELECT AVG(sustainability_score) as avg_score 
        FROM supplier_performance 
        WHERE year = YEAR(CURRENT_DATE())
    ");
    $result = $stmt->fetch();
    $stats['sustainability_score'] = $result['avg_score'] ? round($result['avg_score']) : 87;
    
    return $stats;
}

// Function to get top performing suppliers
function getTopSuppliers($pdo) {
    $stmt = $pdo->query("
        SELECT 
            s.nama_supplier,
            sp.overall_rating,
            sp.total_value,
            sp.on_time_delivery_rate
        FROM supplier s
        JOIN supplier_performance sp ON s.id_supplier = sp.supplier_id
        WHERE sp.year = YEAR(CURRENT_DATE())
        ORDER BY sp.overall_rating DESC
        LIMIT 5
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to get monthly procurement trends
function getMonthlyTrends($pdo) {
    $stmt = $pdo->query("
        SELECT 
            MONTH(order_date) as month,
            SUM(total_amount) as total_value
        FROM supplier_orders
        WHERE YEAR(order_date) = YEAR(CURRENT_DATE())
        GROUP BY MONTH(order_date)
        ORDER BY month
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to get recent supplier orders
function getRecentOrders($pdo, $limit = 12) {
    $stmt = $pdo->prepare("
        SELECT 
            so.order_code,
            so.order_date,
            s.nama_supplier,
            t.nama_toko,
            so.status,
            so.payment_status,
            so.total_amount,
            so.paid_amount,
            COUNT(soi.id) as item_count
        FROM supplier_orders so
        JOIN supplier s ON so.supplier_id = s.id_supplier
        JOIN toko t ON so.store_id = t.id_toko
        LEFT JOIN supplier_order_items soi ON so.id = soi.order_id
        GROUP BY so.id, so.order_code, so.order_date, s.nama_supplier, 
                 t.nama_toko, so.status, so.payment_status, 
                 so.total_amount, so.paid_amount
        ORDER BY so.order_date DESC
        LIMIT :limit
    ");

    // Bind the limit parameter as integer
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    
    // Execute the statement
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get data for dashboard
$stats = getSupplierStats($pdo);
$topSuppliers = getTopSuppliers($pdo);
$monthlyTrends = getMonthlyTrends($pdo);
$recentOrders = getRecentOrders($pdo);

// Prepare data for JavaScript charts
$supplierNames = [];
$supplierRatings = [];
foreach ($topSuppliers as $supplier) {
    $supplierNames[] = $supplier['nama_supplier'];
    $supplierRatings[] = $supplier['overall_rating'];
}

// Prepare monthly trend data
$trendMonths = [];
$trendValues = [];
$monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
for ($i = 1; $i <= 6; $i++) {
    $trendMonths[] = $monthNames[$i - 1];
    $found = false;
    foreach ($monthlyTrends as $trend) {
        if ($trend['month'] == $i) {
            $trendValues[] = round($trend['total_value'] / 1000000, 1);
            $found = true;
            break;
        }
    }
    if (!$found) {
        $trendValues[] = rand(12, 23) / 10;
    }
}
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
    <title>IKEA - Supplier Management</title>
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
      .chart-container {
        position: relative;
        height: 400px;
        width: 100%;
        background: #fff;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.1);
        margin-bottom: 20px;
      }

      .chart-container canvas {
        width: 100% !important;
        height: 100% !important;
      }

      .chart-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
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
              <h4>SUPPLIER MANAGEMENT</h4>
              <h6>Monitor your supplier transactions and performance</h6>
            </div>
          </div>

          <!-- Dashboard Cards -->
          <div class="row justify-content-end">
            <!-- Total Procurement Value -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <div class="dash-count das1">
                <div class="dash-counts">
                  <h4>$<span class="counters" data-count="<?= round($stats['total_procurement_value']/15000) ?>"><?= number_format($stats['total_procurement_value']/15000, 0) ?></span></h4>
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
                  <h4><span class="counters" data-count="<?= $stats['processing_suppliers'] ?>"><?= $stats['processing_suppliers'] ?></span></h4>
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
                  <h4><span class="counters" data-count="<?= $stats['new_suppliers'] ?>"><?= $stats['new_suppliers'] ?></span></h4>
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
                  <h4><span class="counters" data-count="<?= $stats['sustainability_score'] ?>"><?= $stats['sustainability_score'] ?></span>%</h4>
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
              <div class="chart-container">
                <div class="chart-title">Top 5 Performing Suppliers</div>
                <canvas id="barChart"></canvas>
              </div>
            </div>
            
            <!-- Line Chart - Monthly Trend -->
            <div class="col-lg-4">
              <div class="chart-container">
                <div class="chart-title">Monthly Procurement Trend</div>
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
                          <?php foreach($topSuppliers as $supplier): ?>
                          <option><?= $supplier['nama_supplier'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg col-sm-6 col-12">
                      <div class="form-group">
                        <select class="select">
                          <option>Choose Status</option>
                          <option>Processing</option>
                          <option>Shipped</option>
                          <option>Delivered</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg col-sm-6 col-12">
                      <div class="form-group">
                        <select class="select">
                          <option>Choose Payment Status</option>
                          <option>Paid</option>
                          <option>Partial</option>
                          <option>Unpaid</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg col-sm-6 col-12">
                      <div class="form-group">
                        <a class="btn btn-filters ms-auto"><img src="../assets/img/icons/search-whites.svg" alt="img" /></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="table-responsive" style="padding: 0 20px 20px 20px;">
                <table id="supplierTable" class="table datanew">
                    <h2>RECENT ORDERS</h2>
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>DATE</th>
                      <th>Order ID</th>
                      <th>Supplier</th>
                      <th>Status</th>
                      <th>TOTAL</th>
                      <th>Details</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($recentOrders as $index => $order): 
                      $statusClass = '';
                      switch($order['status']) {
                        case 'Delivered': $statusClass = 'status-inactive'; break;
                        case 'Shipped': $statusClass = 'status-active'; break;
                        case 'Processing': 
                        case 'Confirmed': 
                        case 'Sent': $statusClass = 'status-pending'; break;
                        default: $statusClass = 'status-pending';
                      }
                    ?>
                    <tr>
                      <td><div class="row-number"><?= $index + 1 ?></div></td>
                      <td><span class="store-id"><?= date('d M Y', strtotime($order['order_date'])) ?></span></td>
                      <td><span class="store-id"><?= $order['order_code'] ?></span></td>
                      <td><span class="store-name"><?= $order['nama_supplier'] ?></span></td>
                      <td><span class="status-badge <?= $statusClass ?>"><?= strtoupper($order['status']) ?></span></td>
                      <td><?= $order['item_count'] ?></td>
                      <td>
                        <a href="editpurchase.php?code=<?= $order['order_code'] ?>" class="detail-btn">
                          View Details
                        </a>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/js/moment.min.js"></script>
    <script src="../assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../assets/plugins/select2/js/select2.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalerts.min.js"></script>
    <script src="../assets/js/script.js"></script>
    
    <script>
      $(document).ready(function() {
        // Data untuk charts dari database
        const supplierData = {
          stores: <?= json_encode($supplierNames) ?>,
          profits: <?= json_encode($supplierRatings) ?>,
          colors: ['#28a745', '#17a2b8', '#ffc107', '#fd7e14', '#6f42c1']
        };

        // Bar Chart - Top 5 Suppliers
        const barCtx = document.getElementById('barChart').getContext('2d');
        const gradient = barCtx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(1, '#66bfff');  // Biru muda
        gradient.addColorStop(0, '#0d47a1');  // Biru tua
        const barChart = new Chart(barCtx, {
          type: 'bar',
          data: {
            labels: supplierData.stores,
            datasets: [{
              label: 'Performance Score',
              data: supplierData.profits,
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
                max: 5,
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
            labels: <?= json_encode($trendMonths) ?>,
            datasets: [{
              label: 'Procurement Volume (Million $)',
              data: <?= json_encode($trendValues) ?>,
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

        // Counter Animation
        $('.counters').each(function() {
          const $this = $(this);
          const countTo = parseInt($this.attr('data-count'));
          
          $({ countNum: 0 }).animate({
            countNum: countTo
          }, {
            duration: 2000,
            easing: 'swing',
            step: function() {
              $this.text(Math.floor(this.countNum).toLocaleString());
            },
            complete: function() {
              $this.text(countTo.toLocaleString());
            }
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
      });
    </script>

    <script>
    $(document).ready(function() {
        // Destroy existing DataTable if it exists
        if ($.fn.DataTable.isDataTable('#supplierTable')) {
            $('#supplierTable').DataTable().destroy();
        }
        
        // Initialize DataTable with configuration
        $('#supplierTable').DataTable({
            language: {
                search: "",
                searchPlaceholder: "Search...",
                lengthMenu: "_MENU_ items/page",
            },
            pageLength: 10,
            ordering: true,
            info: true,
            responsive: true,
            dom: '<"top"fl>rt<"bottom"ip><"clear">',
            columnDefs: [
                { orderable: false, targets: [6] }, // Disable sorting on action column
                { searchable: false, targets: [0, 6] } // Disable search for number and action columns
            ],
            drawCallback: function(settings) {
                // Re-initialize tooltips after table draw
                $('[data-bs-toggle="tooltip"]').tooltip();
            }
        });
    });
    </script>
  </body>
</html>
