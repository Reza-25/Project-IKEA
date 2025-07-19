<?php
require_once __DIR__ . '/../include/config.php';

// Database connection
$conn = new mysqli("localhost", "root", "", "ikea");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Get summary statistics
$stats_query = "
    SELECT 
        COUNT(*) as total_returns,
        SUM(total_amount) as total_value,
        AVG(DATEDIFF(completed_at, return_date)) as avg_processing_days,
        (SELECT s.Nama_Supplier 
         FROM supplier_returns sr 
         JOIN supplier s ON sr.supplier_id = s.ID_Supplier 
         GROUP BY sr.supplier_id 
         ORDER BY COUNT(*) DESC 
         LIMIT 1) as top_supplier,
        (SELECT COUNT(*) 
         FROM supplier_returns sr2 
         WHERE sr2.supplier_id = (
             SELECT supplier_id 
             FROM supplier_returns 
             GROUP BY supplier_id 
             ORDER BY COUNT(*) DESC 
             LIMIT 1
         )) as top_supplier_count
    FROM supplier_returns 
    WHERE MONTH(return_date) = MONTH(CURRENT_DATE()) 
    AND YEAR(return_date) = YEAR(CURRENT_DATE())
";

$stats_result = $conn->query($stats_query);
$stats = $stats_result->fetch_assoc();

// Get return data for table
$returns_query = "
    SELECT 
        sr.id,
        sr.return_code,
        sr.return_date,
        s.Nama_Supplier as supplier_name,
        t.nama_toko as store_name,
        sr.total_amount,
        sr.refund_amount,
        sr.status,
        sr.return_type,
        sr.priority,
        (sr.total_amount - sr.refund_amount) as due_amount,
        CASE 
            WHEN sr.refund_amount = 0 THEN 'Unpaid'
            WHEN sr.refund_amount = sr.total_amount THEN 'Paid'
            ELSE 'Partial'
        END as payment_status
    FROM supplier_returns sr
    LEFT JOIN supplier s ON sr.supplier_id = s.ID_Supplier
    LEFT JOIN toko t ON sr.store_id = t.id_toko
    ORDER BY sr.return_date DESC
    LIMIT 20
";

$returns_result = $conn->query($returns_query);
$returns_data = [];
while ($row = $returns_result->fetch_assoc()) {
    $returns_data[] = $row;
}

// Get bar chart data (returns by month for current year)
$bar_chart_query = "
    SELECT 
        MONTH(return_date) as month,
        COUNT(*) as return_count,
        MONTHNAME(return_date) as month_name
    FROM supplier_returns 
    WHERE YEAR(return_date) = YEAR(CURRENT_DATE())
    GROUP BY MONTH(return_date), MONTHNAME(return_date)
    ORDER BY MONTH(return_date)
";

$bar_chart_result = $conn->query($bar_chart_query);
$bar_chart_data = [];
while ($row = $bar_chart_result->fetch_assoc()) {
    $bar_chart_data[] = $row;
}

// Get donut chart data (returns by supplier)
$donut_chart_query = "
    SELECT 
        s.Nama_Supplier as supplier_name,
        COUNT(*) as return_count,
        ROUND((COUNT(*) * 100.0 / (SELECT COUNT(*) FROM supplier_returns)), 1) as percentage
    FROM supplier_returns sr
    LEFT JOIN supplier s ON sr.supplier_id = s.ID_Supplier
    GROUP BY sr.supplier_id, s.Nama_Supplier
    ORDER BY return_count DESC
    LIMIT 6
";

$donut_chart_result = $conn->query($donut_chart_query);
$donut_chart_data = [];
while ($row = $donut_chart_result->fetch_assoc()) {
    $donut_chart_data[] = $row;
}

// Get line chart data (monthly trend by top suppliers)
$line_chart_query = "
    SELECT 
        s.Nama_Supplier as supplier_name,
        MONTH(sr.return_date) as month,
        COUNT(*) as return_count
    FROM supplier_returns sr
    LEFT JOIN supplier s ON sr.supplier_id = s.ID_Supplier
    WHERE YEAR(sr.return_date) = YEAR(CURRENT_DATE())
    AND sr.supplier_id IN (
        SELECT supplier_id 
        FROM supplier_returns 
        GROUP BY supplier_id 
        ORDER BY COUNT(*) DESC 
        LIMIT 5
    )
    GROUP BY sr.supplier_id, s.Nama_Supplier, MONTH(sr.return_date)
    ORDER BY s.Nama_Supplier, MONTH(sr.return_date)
";

$line_chart_result = $conn->query($line_chart_query);
$line_chart_data = [];
while ($row = $line_chart_result->fetch_assoc()) {
    $line_chart_data[] = $row;
}

// Get analytics data
$analytics_query = "
    SELECT 
        supplier_id,
        total_returns,
        total_return_value,
        return_rate,
        avg_processing_time,
        quality_score
    FROM supplier_return_analytics 
    WHERE month = MONTH(CURRENT_DATE()) 
    AND year = YEAR(CURRENT_DATE())
";

$analytics_result = $conn->query($analytics_query);
$analytics_data = [];
while ($row = $analytics_result->fetch_assoc()) {
    $analytics_data[] = $row;
}

// Get supplier performance data
$performance_query = "
    SELECT 
        s.Nama_Supplier as supplier_name,
        sp.overall_rating,
        sp.quality_score,
        sp.on_time_delivery_rate
    FROM supplier_performance sp
    LEFT JOIN supplier s ON sp.supplier_id = s.ID_Supplier
    WHERE sp.month = MONTH(CURRENT_DATE()) 
    AND sp.year = YEAR(CURRENT_DATE())
    ORDER BY sp.overall_rating DESC
    LIMIT 5
";

$performance_result = $conn->query($performance_query);
$performance_data = [];
while ($row = $performance_result->fetch_assoc()) {
    $performance_data[] = $row;
}

// Function to safely execute query and handle errors
function executeQuery($conn, $sql, $errorMessage = "Database query failed") {
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        error_log("SQL Error: " . mysqli_error($conn) . " | Query: " . $sql);
        return false;
    }
    return $result;
}

// Function to safely fetch data with fallback
function fetchData($conn, $sql, $defaultValue = []) {
    $result = executeQuery($conn, $sql);
    if (!$result) {
        return $defaultValue;
    }
    
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

// Get database connection
$conn = getDBConnection();
if (!$conn) {
    die("Database connection failed");
}

// Get statistics with error handling
try {
    // Total Returns
    $totalReturnsQuery = "SELECT COUNT(*) as total FROM supplier_returns WHERE MONTH(return_date) = MONTH(CURDATE()) AND YEAR(return_date) = YEAR(CURDATE())";
    $totalReturnsResult = executeQuery($conn, $totalReturnsQuery);
    $totalReturns = $totalReturnsResult ? mysqli_fetch_assoc($totalReturnsResult)['total'] : 124;

    // Total Value
    $totalValueQuery = "SELECT SUM(total_amount) as total_value FROM supplier_returns WHERE MONTH(return_date) = MONTH(CURDATE()) AND YEAR(return_date) = YEAR(CURDATE())";
    $totalValueResult = executeQuery($conn, $totalValueQuery);
    $totalValue = $totalValueResult ? (mysqli_fetch_assoc($totalValueResult)['total_value'] ?? 8650) : 8650;

    // Average Processing Time
    $avgProcessingQuery = "SELECT AVG(DATEDIFF(completed_at, return_date)) as avg_days FROM supplier_returns WHERE completed_at IS NOT NULL AND MONTH(return_date) = MONTH(CURDATE()) AND YEAR(return_date) = YEAR(CURDATE())";
    $avgProcessingResult = executeQuery($conn, $avgProcessingQuery);
    $avgProcessing = $avgProcessingResult ? (mysqli_fetch_assoc($avgProcessingResult)['avg_days'] ?? 3.2) : 3.2;

    // Top Supplier
    $topSupplierQuery = "SELECT s.Nama_Supplier, COUNT(*) as return_count 
                        FROM supplier_returns sr 
                        JOIN supplier s ON sr.supplier_id = s.ID_Supplier 
                        WHERE MONTH(sr.return_date) = MONTH(CURDATE()) AND YEAR(sr.return_date) = YEAR(CURDATE())
                        GROUP BY sr.supplier_id 
                        ORDER BY return_count DESC 
                        LIMIT 1";
    $topSupplierResult = executeQuery($conn, $topSupplierQuery);
    $topSupplier = $topSupplierResult ? (mysqli_fetch_assoc($topSupplierResult)['Nama_Supplier'] ?? 'Apex Computers') : 'Apex Computers';
    $topSupplierCount = $topSupplierResult ? (mysqli_fetch_assoc($topSupplierResult)['return_count'] ?? 28) : 28;

} catch (Exception $e) {
    error_log("Error fetching statistics: " . $e->getMessage());
    // Set default values
    $totalReturns = 124;
    $totalValue = 8650;
    $avgProcessing = 3.2;
    $topSupplier = 'Apex Computers';
    $topSupplierCount = 28;
}

// Get chart data with error handling
try {
    // Bar Chart Data - Monthly returns by category
    $barChartQuery = "SELECT 
                        MONTH(sr.return_date) as month,
                        COUNT(*) as return_count
                      FROM supplier_returns sr
                      WHERE YEAR(sr.return_date) = 2025
                      GROUP BY MONTH(sr.return_date)
                      ORDER BY month";
    $barChartData = fetchData($conn, $barChartQuery, []);

    // Donut Chart Data - Returns by supplier
    $donutChartQuery = "SELECT 
                          s.Nama_Supplier,
                          COUNT(*) as return_count,
                          ROUND((COUNT(*) * 100.0 / (SELECT COUNT(*) FROM supplier_returns)), 1) as percentage
                        FROM supplier_returns sr
                        JOIN supplier s ON sr.supplier_id = s.ID_Supplier
                        GROUP BY sr.supplier_id, s.Nama_Supplier
                        ORDER BY return_count DESC
                        LIMIT 6";
    $donutChartData = fetchData($conn, $donutChartQuery, []);

    // Line Chart Data - Monthly trend by supplier
    $lineChartQuery = "SELECT 
                         s.Nama_Supplier,
                         MONTH(sr.return_date) as month,
                         COUNT(*) as return_count
                       FROM supplier_returns sr
                       JOIN supplier s ON sr.supplier_id = s.ID_Supplier
                       WHERE YEAR(sr.return_date) = 2025
                       GROUP BY sr.supplier_id, s.Nama_Supplier, MONTH(sr.return_date)
                       ORDER BY s.Nama_Supplier, month";
    $lineChartData = fetchData($conn, $lineChartQuery, []);

} catch (Exception $e) {
    error_log("Error fetching chart data: " . $e->getMessage());
    $barChartData = [];
    $donutChartData = [];
    $lineChartData = [];
}

// Get table data with error handling
try {
    $tableQuery = "SELECT 
                     sr.id,
                     sr.return_code,
                     DATE_FORMAT(sr.return_date, '%d/%m/%Y') as return_date,
                     s.Nama_Supplier as supplier_name,
                     t.nama_toko as store_name,
                     sr.total_amount,
                     sr.refund_amount,
                     (sr.total_amount - sr.refund_amount) as due_amount,
                     sr.status,
                     CASE 
                       WHEN sr.refund_amount >= sr.total_amount THEN 'Paid'
                       WHEN sr.refund_amount > 0 THEN 'Partial'
                       ELSE 'Unpaid'
                     END as payment_status
                   FROM supplier_returns sr
                   LEFT JOIN supplier s ON sr.supplier_id = s.ID_Supplier
                   LEFT JOIN toko t ON sr.store_id = t.id_toko
                   ORDER BY sr.return_date DESC
                   LIMIT 20";
    $tableData = fetchData($conn, $tableQuery, []);

} catch (Exception $e) {
    error_log("Error fetching table data: " . $e->getMessage());
    $tableData = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<meta name="description" content="POS - Bootstrap Admin Template">
<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
<meta name="author" content="Dreamguys - Bootstrap Admin Template">
<meta name="robots" content="noindex, nofollow">
<title>RuanGku</title>

<link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg">
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/animate.css">
<link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!-- Export Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<style>
   a {
    text-decoration: none !important;
  }

    .ikea-select {
      background-color: #E6F0FF !important; /* Soft blue */
      border: 2px solid #ccc;
      color: #333;
      border-radius: 20px;
      padding: 6px 16px;
      font-size: 0.85rem;
      appearance: none;
      width: 140px; /* Lebar diperpanjang */
      background-image: url("data:image/svg+xml,%3Csvg fill='%230051BA' height='20' viewBox='0 0 24 24' width='20' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 0.6rem center;
      background-size: 14px;
      transition: border-color 0.3s ease;
    }

  .ikea-select:hover {
    border-color: #0051BA;
  }

  .ikea-select:focus {
    outline: none;
    border-color: #0051BA;
    box-shadow: 0 0 0 3px rgba(230, 240, 255, 0.8); /* glow soft blue */
  }

  .card-header h5 {
    color: white;
  }
  
  .ikea-note-card {
    background-color: #fffbea;
    border: none;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    border-left: 8px solid #FFCC00;
    border-radius: 10px;
    margin-bottom: 20px;
  }
  
  #notesCarousel::-webkit-scrollbar {
    height: 8px;
  }

  #notesCarousel::-webkit-scrollbar-thumb {
    background-color: #ccc;
    border-radius: 4px;
  }
  .note-card p {
    margin: 0;
    color: #333;
    font-size: 14px;
  }

  .note-card strong {
    font-size: 16px;
  }

  .card-body::-webkit-scrollbar {
    width: 6px;
  }

  .card-body::-webkit-scrollbar-thumb {
    background-color: #ccc;
    border-radius: 4px;
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
/* END - CSS Kolom */

/* Custom CSS Variables */
:root {
  --primary-blue: #1976d2;
  --secondary-blue: #42a5f5;
  --success-green: #4caf50;
  --warning-orange: #ff9800;
  --danger-red: #f44336;
  --info-cyan: #00bcd4;
  --light-gray: #f5f5f5;
  --white: #ffffff;
  --text-dark: #333333;
  --border-color: #e0e0e0;
}


/* Chart Section */
.chart-section {
  background: var(--white);
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 25px;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
  transition: all 0.3s ease;
}

.chart-section:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
}

.chart-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.chart-title {
  font-size: 1.1rem;
  font-weight: 600;
  color: var(--primary-blue);
  margin: 0;
}

.chart-select {
  border: 1px solid var(--border-color);
  border-radius: 6px;
  padding: 6px 12px;
  background: var(--white);
  font-size: 0.9rem;
  color: var(--text-dark);
}

.chart-select:focus {
  outline: none;
  border-color: var(--primary-blue);
  box-shadow: 0 0 0 2px rgba(25, 118, 210, 0.2);
}

/* Insight Container */
.insight-container {
  padding: 15px;
  background: linear-gradient(135deg, #f0f8ff 0%, #e6f3ff 100%);
  border-top: 1px solid rgba(25, 118, 210, 0.1);
  border-radius: 0 0 12px 12px;
  font-size: 0.85rem;
  margin-top: 20px;
}

.insight-container h5 {
  color: var(--primary-blue) !important;
  font-weight: 600;
}

.insight-container p {
  color: #4a5568;
  line-height: 1.5;
}

/* Stats Grid */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
  gap: 12px;
  margin-bottom: 15px;
}

.stats-card {
  background: var(--white);
  padding: 15px;
  text-align: center;
  border-radius: 12px;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
  margin-bottom: 12px;
  transition: all 0.3s ease;
  min-height: 120px;
}

.stats-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.stats-card i {
  font-size: 1.8rem;
  margin-bottom: 8px;
}

.stats-card h3 {
  font-size: 1.2rem;
  font-weight: 700;
  margin: 6px 0;
}

.stats-card p {
  color: #6c757d;
  margin-bottom: 0;
  font-size: 0.8rem;
}

/* Insight Cards */
.insight-card {
  background: var(--white);
  border-radius: 12px;
  padding: 15px;
  margin-bottom: 15px;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
  transition: all 0.3s ease;
}

.insight-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
}

.insight-card-header {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
  gap: 8px;
}

.insight-card-header i {
  font-size: 1.2rem;
  color: var(--primary-blue);
}

.insight-card-header h4 {
  font-size: 1rem !important;
  margin: 0;
  font-weight: 600;
}

/* Notification Cards */
.notification-card {
  padding: 12px;
  border-radius: 8px;
  margin-bottom: 10px;
  display: flex;
  align-items: center;
  gap: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
  transition: all 0.3s ease;
  border-left: 4px solid transparent;
}

.notification-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
}

.notification-card i {
  font-size: 1.1rem;
  min-width: 24px;
  text-align: center;
}

.notification-card.warning {
  background-color: #fefbf3;
  border-left-color: #d97706;
}

.notification-card.danger {
  background-color: #fef2f2;
  border-left-color: #dc2626;
}

.notification-card.info {
  background-color: #f0f9ff;
  border-left-color: #0ea5e9;
}

.notification-card h5 {
  font-size: 0.9rem;
  margin-bottom: 2px;
  font-weight: 600;
}

.notification-card p {
  font-size: 0.8rem;
  margin-bottom: 0;
  color: #6b7280;
}

/* Sidebar Cards */
.sidebar-card {
  background: var(--white);
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
  margin-bottom: 15px;
  transition: all 0.3s ease;
}

.sidebar-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
}

.sidebar-card-header {
  background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
  color: white;
  padding: 12px 15px;
  font-weight: 600;
  font-size: 0.9rem;
}

.sidebar-card-body {
  padding: 15px;
}

/* Professional Health Score */
.health-score-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 0;
  border-bottom: 1px solid #f1f5f9;
}

.health-score-item:last-child {
  border-bottom: none;
}

.health-brand-info h6 {
  font-size: 0.95rem;
  font-weight: 600;
  margin-bottom: 4px;
  color: #1e293b;
}

.health-brand-info p {
  font-size: 0.8rem;
  color: #64748b;
  margin-bottom: 0;
}

.health-score-value {
  text-align: right;
}

.health-score {
  font-size: 1.1rem;
  font-weight: 700;
  margin-bottom: 4px;
}

.health-score.good { color: #059669; }
.health-score.poor { color: #dc2626; }

.health-progress {
  width: 60px;
  height: 4px;
  background: #e2e8f0;
  border-radius: 2px;
  overflow: hidden;
}

.health-fill {
  height: 100%;
  border-radius: 2px;
  transition: width 1.5s ease-out;
}

.health-fill.good { background: #059669; }
.health-fill.poor { background: #dc2626; }

/* Compact Brand Readiness */
.readiness-compact {
  background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
  border: 1px solid rgba(14, 165, 233, 0.2);
  border-radius: 10px;
  padding: 15px;
  text-align: center;
}

.readiness-score-compact {
  font-size: 2rem;
  font-weight: 800;
  color: #0ea5e9;
  margin-bottom: 5px;
}

.readiness-brand-compact {
  font-size: 1rem;
  font-weight: 600;
  color: #1e293b;
  margin-bottom: 3px;
}

.readiness-label-compact {
  font-size: 0.75rem;
  color: #64748b;
  margin-bottom: 12px;
}

.readiness-features-compact {
  display: flex;
  justify-content: space-around;
  margin: 12px 0;
}

.readiness-feature-compact {
  text-align: center;
  flex: 1;
}

.readiness-feature-compact i {
  font-size: 1.2rem;
  margin-bottom: 4px;
  display: block;
}

.readiness-feature-compact p {
  font-size: 0.7rem;
  font-weight: 600;
  margin-bottom: 0;
  color: #374151;
}

.readiness-progress-compact {
  height: 4px;
  background: #e2e8f0;
  border-radius: 2px;
  overflow: hidden;
  margin: 10px 0;
}

.readiness-fill-compact {
  height: 100%;
  background: linear-gradient(90deg, #0ea5e9 0%, #0284c7 100%);
  border-radius: 2px;
  transition: width 2s ease-out;
}

.readiness-status-compact {
  background: rgba(14, 165, 233, 0.1);
  color: #0c4a6e;
  padding: 6px 10px;
  border-radius: 15px;
  font-size: 0.7rem;
  font-weight: 600;
  display: inline-block;
}

/* Professional Location Distribution */
.location-brand-section {
  margin-bottom: 20px;
  padding: 15px;
  background: #fafbfc;
  border-radius: 8px;
  border: 1px solid #e5e7eb;
}

.location-brand-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 12px;
}

.location-brand-name {
  font-size: 1rem;
  font-weight: 600;
  color: #1f2937;
  margin-bottom: 0;
}

.location-status-badge {
  font-size: 0.7rem;
  padding: 3px 8px;
  border-radius: 12px;
  font-weight: 600;
}

.location-status-badge.top { background: #dbeafe; color: #1e40af; }
.location-status-badge.rising { background: #d1fae5; color: #065f46; }

.location-description {
  font-size: 0.8rem;
  color: #6b7280;
  margin-bottom: 10px;
}

.location-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
}

.location-tag {
  background: #e5e7eb;
  color: #374151;
  padding: 4px 10px;
  border-radius: 15px;
  font-size: 0.75rem;
  font-weight: 500;
  transition: all 0.2s ease;
}

.location-tag.highlight {
  background: #3b82f6;
  color: white;
}

.location-tag:hover {
  transform: translateY(-1px);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Donut Legend */
.donut-legend {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 8px;
  margin-top: 15px;
}

.legend-item {
  display: flex;
  align-items: center;
  font-size: 0.8rem;
  color: #4b5563;
}

.legend-color {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  margin-right: 6px;
}

/* Enhanced Brand Data Table - Extended Width and Blue Gradient Headers */
.brand-table-section {
  background: var(--white);
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 25px;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
  transition: all 0.3s ease;
}

.brand-table-section:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
}

/* Table Controls */
.table-controls {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  flex-wrap: wrap;
  gap: 15px;
}

.search-container {
  position: relative;
  flex: 1;
  max-width: 300px;
}

.search-input {
  width: 100%;
  padding: 10px 40px 10px 15px;
  border: 2px solid #e2e8f0;
  border-radius: 8px;
  font-size: 0.9rem;
  transition: all 0.3s ease;
}

.search-input:focus {
  outline: none;
  border-color: var(--primary-blue);
  box-shadow: 0 0 0 3px rgba(25, 118, 210, 0.1);
}

.search-icon {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  color: #64748b;
  font-size: 1rem;
}

.export-buttons {
  display: flex;
  gap: 10px;
}

.export-btn {
  padding: 8px 16px;
  border: 2px solid transparent;
  border-radius: 8px;
  font-size: 0.85rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 6px;
}

.export-btn.pdf {
  background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
  color: white;
}

.export-btn.pdf:hover {
  background: linear-gradient(135deg, #b91c1c 0%, #dc2626 100%);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
}

.export-btn.excel {
  background: linear-gradient(135deg, #059669 0%, #10b981 100%);
  color: white;
}

.export-btn.excel:hover {
  background: linear-gradient(135deg, #047857 0%, #059669 100%);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
}

.brand-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 15px;
}

.brand-table th {
  background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
  color: #ffffff;
  font-weight: 600;
  font-size: 0.85rem;
  padding: 12px 10px;
  text-align: left;
  border-bottom: 2px solid #1565c0;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.brand-table th:first-child {
  border-top-left-radius: 8px;
}

.brand-table th:last-child {
  border-top-right-radius: 8px;
}

.brand-table td {
  padding: 12px 10px;
  border-bottom: 1px solid #f1f5f9;
  font-size: 0.85rem;
  color: #374151;
  vertical-align: middle;
}

.brand-table tbody tr:hover {
  background-color: #f8fafc;
  transition: all 0.2s ease;
}

.brand-name {
  font-weight: 600;
  color: #1e293b;
}

.brand-id {
  background: #f1f5f9;
  color: #475569;
  padding: 4px 8px;
  border-radius: 6px;
  font-size: 0.75rem;
  font-weight: 500;
  display: inline-block;
  font-family: 'Courier New', monospace;
}

.brand-category {
  background: #f8fafc;
  color: #64748b;
  padding: 4px 10px;
  border-radius: 15px;
  font-size: 0.75rem;
  font-weight: 500;
  display: inline-block;
  border: 1px solid #e2e8f0;
}

.brand-rating {
  display: flex;
  align-items: center;
  gap: 4px;
}

.brand-rating .stars {
  color: #fbbf24;
}

.brand-rating-value {
  color: #1e293b;
  font-weight: 600;
}

.brand-sales {
  font-weight: 600;
  color: #059669;
}

.brand-price {
  font-weight: 600;
  color: #1e293b;
}

.brand-status {
  padding: 4px 8px;
  border-radius: 12px;
  font-size: 0.7rem;
  font-weight: 600;
  text-align: center;
}

.status-active { background: #d1fae5; color: #065f46; }
.status-trending { background: #fef3c7; color: #92400e; }
.status-stable { background: #dbeafe; color: #1e40af; }

/* No Results Message */
.no-results {
  text-align: center;
  padding: 40px 20px;
  color: #64748b;
}

.no-results i {
  font-size: 3rem;
  margin-bottom: 15px;
  color: #cbd5e1;
}

.no-results h5 {
  font-size: 1.1rem;
  margin-bottom: 8px;
  color: #475569;
}

.no-results p {
  font-size: 0.9rem;
  margin-bottom: 0;
}

/* Pagination */
.table-pagination {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 20px;
  padding-top: 15px;
  border-top: 1px solid #e2e8f0;
}

.pagination-info {
  font-size: 0.85rem;
  color: #64748b;
}

.pagination-controls {
  display: flex;
  gap: 8px;
}

.pagination-btn {
  padding: 6px 12px;
  border: 1px solid #d1d5db;
  background: white;
  color: #374151;
  border-radius: 6px;
  font-size: 0.8rem;
  cursor: pointer;
  transition: all 0.2s ease;
}

.pagination-btn:hover {
  background: #f3f4f6;
  border-color: #9ca3af;
}

.pagination-btn.active {
  background: #3b82f6;
  color: white;
  border-color: #3b82f6;
}

.pagination-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

/* Suggestion Card */
.suggestion-card {
  background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
  color: white;
  border-radius: 10px;
  padding: 15px;
  margin-bottom: 12px;
  transition: all 0.3s ease;
}

.suggestion-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
}

/* Responsive */
@media (max-width: 768px) {
  .content {
    padding: 15px;
  }
  
  .chart-header {
    flex-direction: column;
    gap: 10px;
    text-align: center;
  }
  
  .table-controls {
    flex-direction: column;
    align-items: stretch;
  }
  
  .search-container {
    max-width: 100%;
  }
  
  .export-buttons {
    justify-content: center;
  }
  
  .dash-count {
    min-height: 70px;
    padding: 12px;
  }
  
  .dash-counts h4 {
    font-size: 16px;
  }
  
  .dash-counts h5 {
    font-size: 11px;
  }
  
  .icon-box {
    width: 32px;
    height: 32px;
  }
  
  .icon-box i {
    font-size: 12px;
  }
  
  .stats-grid {
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 10px;
  }
  
  .brand-table {
    font-size: 0.75rem;
  }
  
  .brand-table th,
  .brand-table td {
    padding: 12px 8px;
  }
  
  .table-stats {
    flex-direction: column;
    gap: 8px;
  }
  
  .pagination-controls {
    flex-wrap: wrap;
    gap: 6px;
  }
  
  .pagination-btn {
    padding: 8px 12px;
    font-size: 0.8rem;
  }
}

/* Loading Animation */
#global-loader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.9);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.whirly-loader {
  width: 50px;
  height: 50px;
  border: 4px solid #f3f3f3;
  border-top: 4px solid var(--primary-blue);
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.trend-indicator {
  font-size: 1rem;
  display: inline-block;
  margin-left: 4px;
}

.trend-up {
  color: var(--success-green);
}

.trend-down {
  color: var(--danger-red);
}

/* Modal Styles */
.detail-card {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  padding: 15px;
}

.detail-header {
  font-size: 1rem;
  font-weight: 600;
  color: #1e293b;
  margin-bottom: 12px;
  padding-bottom: 8px;
  border-bottom: 2px solid #e2e8f0;
}

.detail-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 8px 0;
  border-bottom: 1px solid #f1f5f9;
}

.detail-item:last-child {
  border-bottom: none;
}

.detail-label {
  font-weight: 500;
  color: #64748b;
  font-size: 0.9rem;
}

.detail-value {
  font-weight: 600;
  color: #1e293b;
  font-size: 0.9rem;
}

.analytics-item {
  text-align: center;
  padding: 15px;
  background: white;
  border-radius: 8px;
  border: 1px solid #e2e8f0;
}

.analytics-number {
  font-size: 1.5rem;
  font-weight: 700;
  color: #1976d2;
  margin-bottom: 5px;
}

.analytics-label {
  font-size: 0.8rem;
  color: #64748b;
  font-weight: 500;
}

.modal-content {
  border: none;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
}

.modal-header {
  border-bottom: none;
}

.modal-footer {
  border-top: 1px solid #e2e8f0;
  background: #f8fafc;
}

.btn-close-white {
  filter: brightness(0) invert(1);
}
</style>

</head>
<body>
<div id="global-loader">
<div class="whirly-loader"> </div>
</div>

<div class="main-wrapper">
<!-- Include sidebar -->
<?php include BASE_PATH . '/include/sidebar.php'; ?> <!-- Import sidebar -->
<!-- /Include sidebar -->

<!-- BAGIAN ATAS -->
<div class="page-wrapper">
  <div class="content">
    <?php include __DIR__ . '/../include/header.php'; ?> <!-- Import header -->
  <div class="page-header">
      <div class="page-title">
        <h4>Supplier Returns Dashboard</h4>
        <h6>Comprehensive returns analytics and management</h6>
      </div>
      <div class="page-btn">
        <a href="addreturn.php" class="btn btn-added">
          <img src="../assets/img/icons/plus.svg" class="me-1" alt="img">New Return
        </a>
      </div>
    </div>

    <!-- Revenue, Suppliers, Product Sold, Budget Spent -->
          <div class="row justify-content-end">
          <!-- 🔢 Total Returns -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="#" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das1">
                  <div class="dash-counts">
                    <h4><span class="counters" data-count="<?php echo $totalReturns; ?>"><?php echo $totalReturns; ?></span></h4>
                    <h5>Total Returns</h5>
                    <h2 class="stat-change">+8% from last month</h2>
                    </div>
                    <div class="icon-box bg-ungu">
                      <i class="fa fa-undo"></i>
                    </div>
                </div>
                  <h4><span class="counters" data-count="<?php echo number_format($totalValue); ?>">$<?php echo number_format($totalValue); ?></span></h4>
            </div>

            <!-- 🛒 Total Value -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="#" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das2">
                  <div class="dash-counts">
                  <h4><span class="counters" data-count="<?php echo number_format($stats['total_value'] ?? 0, 0); ?>">$<?php echo number_format($stats['total_value'] ?? 0, 0); ?></span></h4>
                   <h5>Total Value</h5>
                  <h2 class="stat-change">+12% from last month</h2>
                </div>
                <div class="icon-box bg-biru">
                  <i class="fa fa-dollar-sign"></i>
                </div>
                </div>
                  <h4><span class="counters" data-count="<?php echo number_format($avgProcessing, 1); ?>"><?php echo number_format($avgProcessing, 1); ?></span></h4> 
            </div>

             <!-- 📦 Avg Processing Days -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="#" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das3">
                  <div class="dash-counts">
                  <h4><span class="counters" data-count="<?php echo number_format($stats['avg_processing_days'] ?? 3.2, 1); ?>"><?php echo number_format($stats['avg_processing_days'] ?? 3.2, 1); ?></span></h4> 
                  <h5>Avg. Processing Days</h5>                 
                    <h2 class="stat-change">-0.8 days improvement</h2>
                  </div>
                  <div class="icon-box bg-merah">
                    <i class="fa fa-clock"></i>
                  </div>
                </div>
                     <h4><?php echo $topSupplierCount; ?></h4>
            </div>

            <!-- 🗂️ Top Supplier Returns -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="#" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das4">
                  <div class="dash-counts">
                     <h4><?php echo $stats['top_supplier_count'] ?? 0; ?></h4>
                    <h5>Top Supplier Returns</h5>
                   <h2 class="stat-change"><?php echo $topSupplier; ?></h2>
                    </div>
                    <div class="icon-box bg-hijau">
                      <i class="fa fa-user-tie"></i>
                    </div>
// Data dari database untuk visualisasi
<?php
// Prepare JavaScript data from PHP
$jsBarChartData = [];
$jsDonutChartData = [];
$jsLineChartData = [];
$jsTableData = [];

// Process bar chart data
if (!empty($barChartData)) {
    foreach ($barChartData as $row) {
        $jsBarChartData[] = $row['return_count'];
    }
}

// Process donut chart data
if (!empty($donutChartData)) {
    foreach ($donutChartData as $row) {
        $jsDonutChartData['labels'][] = $row['Nama_Supplier'];
        $jsDonutChartData['series'][] = (int)$row['percentage'];
    }
}

// Process table data
if (!empty($tableData)) {
    foreach ($tableData as $index => $row) {
        $jsTableData[] = [
            'id' => $row['id'],
            'image' => 'product' . (($index % 10) + 1) . '.jpg',
            'date' => $row['return_date'],
            'supplier' => $row['supplier_name'] ?? 'Unknown Supplier',
            'storage' => $row['store_name'] ?? 'Unknown Store',
            'reference' => $row['return_code'],
            'total' => (float)$row['total_amount'],
            'paid' => (float)$row['refund_amount'],
            'due' => (float)($row['total_amount'] - $row['refund_amount']),
            'paymentStatus' => $row['payment_status'],
            'status' => ucfirst($row['status'])
        ];
    }
}
?>

              </a>
            </div>
          </div>
          <!-- END KOLOM  -->

    
      <!-- Main Content -->
      <div class="row">
        <!-- Left Column - Charts - Extended Width -->
        <div class="col-lg-12">
          <!-- Charts Section dalam row terpisah -->
          <div class="row mb-4">
            <div class="col-lg-8">
              <!-- Bar Chart -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chart-bar me-2"></i>Monthly Return Trends</h5>
                  <select class="chart-select" id="barChartYear">
                    <option value="2025">2025</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                  </select>
                </div>
                <div id="barChart" style="height: 250px;"></div>
                <div class="insight-container" id="barChartInsight">
                  <div class="d-flex align-items-center">
                    <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
                    <div>
                      <h5 style="font-size: 0.9rem;">Insight: Monthly Return Trends</h5>
                      <p class="mb-0">Analysis shows consistent patterns with seasonal variations. Current trend indicates improvement in return processing.</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Donut Chart -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chart-pie me-2"></i>Return Distribution by Supplier</h5>
                </div>
                <div id="donutChart" style="height: 200px;"></div>
                <div class="donut-legend" id="donutLegend"></div>
                <div class="insight-container">
                  <div class="d-flex align-items-center">
                    <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
                    <div>
                      <h5 style="font-size: 0.9rem;">Insight: Supplier Distribution</h5>
                      <p class="mb-0">Top suppliers account for majority of returns. Focus on quality improvement with leading suppliers.</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Line Chart -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chart-line me-2"></i>Supplier Return Trends</h5>
                  <select class="chart-select" id="lineChartYear">
                    <option value="2025">2025</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                  </select>
                </div>
                <div id="lineChart" style="height: 250px;"></div>
                <div class="insight-container" id="lineChartInsight">
                  <div class="d-flex align-items-center">
                    <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
                    <div>
                      <h5 id="lineChartInsightTitle" style="font-size: 0.9rem;">Insight: Return Trends</h5>
                      <p class="mb-0" id="lineChartInsightText">Supplier performance shows consistent patterns with seasonal variations and quality improvement efforts.</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Insight Produk Bersaing -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chess-board me-2"></i>Top Performing vs Problematic Suppliers</h5>
                </div>
                <div class="row">
                  <?php 
                  $suppliers_sample = [
                    ['name' => 'Modern Automobile', 'returns' => 18, 'value' => 1850, 'quality' => 'High'],
                    ['name' => 'Best Power Tools', 'returns' => 15, 'value' => 1420, 'quality' => 'Medium']
                  ];
                  
                  foreach($suppliers_sample as $index => $supplier): 
                    $crown_color = $index == 0 ? '#ffd700' : '#c0c0c0';
                    $icon = $index == 0 ? 'crown' : 'medal';
                  ?>
                  <div class="col-md-6 mb-3">
                    <div class="p-3" style="background: linear-gradient(135deg, #f8f9ff 0%, #e8f2ff 100%); border-radius: 10px; border: 1px solid rgba(25, 118, 210, 0.1);">
                      <div class="text-center mb-2">
                        <h6 class="mb-1" style="color: var(--primary-blue); font-weight: 600;"><?php echo $supplier['name']; ?></h6>
                        <span style="background: var(--primary-blue); color: white; padding: 2px 8px; border-radius: 10px; font-size: 0.7rem;">Quality: <?php echo $supplier['quality']; ?></span>
                      </div>
                      <div class="text-center">
                        <div style="width: 30px; height: 30px; background: linear-gradient(135deg, <?php echo $crown_color; ?> 0%, #ffed4e 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 5px; color: #b8860b;">
                          <i class="fas fa-<?php echo $icon; ?>" style="font-size: 0.8rem;"></i>
                        </div>
                        <h6 style="font-size: 0.8rem; margin-bottom: 3px;"><?php echo $supplier['name']; ?></h6>
                        <small style="font-size: 0.7rem; color: #666;"><?php echo $supplier['returns']; ?> returns | $<?php echo number_format($supplier['value']); ?> | <?php echo $supplier['quality']; ?></small>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
                <div class="insight-container">
                  <div class="d-flex align-items-center">
                    <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
                    <div>
                      <h5 style="font-size: 0.9rem;">Insight: Supplier Performance</h5>
                      <p class="mb-0">Focus on improving partnerships with high-return suppliers while maintaining relationships with top performers.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Right Column - Sidebar tetap di samping charts -->
            <div class="col-lg-4">
              <!-- Analytics Summary -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-calculator me-2"></i>Return Analytics Summary
                </div>
                <div class="sidebar-card-body">
                  <?php if (!empty($analytics_data)): ?>
                    <?php foreach(array_slice($analytics_data, 0, 3) as $analytics): ?>
                    <div class="d-flex align-items-center mb-2">
                      <div class="bg-light p-2 rounded-circle me-2" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-chart-line text-primary" style="font-size: 1.2rem;"></i>
                      </div>
                      <div>
                        <h5 class="mb-1" style="font-size: 1rem;">Returns: <?php echo $analytics['total_returns']; ?></h5>
                        <p class="mb-0" style="font-size: 0.85rem;">Rate: <span class="fw-bold"><?php echo $analytics['return_rate']; ?>%</span></p>
                      </div>
                      <div class="ms-auto">
                        <span class="trend-indicator <?php echo $analytics['return_rate'] > 5 ? 'trend-up' : 'trend-down'; ?>" style="font-size: 1.5rem;">
                          <?php echo $analytics['return_rate'] > 5 ? '▲' : '▼'; ?>
                        </span>
                      </div>
                    </div>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <div class="text-center text-muted">
                      <i class="fas fa-chart-line mb-2" style="font-size: 2rem;"></i>
                      <p>No analytics data available</p>
                    </div>
                  <?php endif; ?>
                </div>
              </div>

              <!-- Critical Notifications -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-bell me-2"></i>Critical Return Notifications
                </div>
                <div class="sidebar-card-body">
                  <div class="notification-card warning">
                    <i class="fas fa-exclamation-triangle text-warning"></i>
                    <div>
                      <h5 class="mb-1">High Return Rate Alert</h5>
                      <p class="mb-0">Some suppliers showing increased return rates</p>
                    </div>
                  </div>
                  
                  <div class="notification-card danger">
                    <i class="fas fa-sync-alt text-danger"></i>
                    <div>
                      <h5 class="mb-1">Processing Time Increase</h5>
                      <p class="mb-0">Average processing time increased this week</p>
                    </div>
                  </div>
                  
                  <div class="notification-card info">
                    <i class="fas fa-thumbs-down text-info"></i>
                    <div>
                      <h5 class="mb-1">Quality Issues</h5>
                      <p class="mb-0">Multiple quality complaints from customers</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Supplier Health Score -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-heartbeat me-2"></i>Supplier Health Score
                </div>
                <div class="sidebar-card-body">
                  <?php if (!empty($performance_data)): ?>
                    <?php foreach($performance_data as $performance): 
                      $health_class = $performance['overall_rating'] > 8 ? 'good' : 'poor';
                      $health_percentage = $performance['overall_rating'] * 10;
                    ?>
                    <div class="health-score-item">
                      <div class="health-brand-info">
                        <h6><?php echo $performance['supplier_name']; ?></h6>
                        <p>Quality: <?php echo $performance['quality_score']; ?>/10, Delivery: <?php echo $performance['on_time_delivery_rate']; ?>%</p>
                      </div>
                      <div class="health-score-value">
                        <div class="health-score <?php echo $health_class; ?>"><?php echo number_format($performance['overall_rating'] * 10); ?>/100</div>
                        <div class="health-progress">
                          <div class="health-fill <?php echo $health_class; ?>" style="width: <?php echo $health_percentage; ?>%"></div>
                        </div>
                      </div>
                    </div>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <div class="text-center text-muted">
                      <i class="fas fa-heartbeat mb-2" style="font-size: 2rem;"></i>
                      <p>No performance data available</p>
                    </div>
                  <?php endif; ?>
                </div>
              </div>

              <!-- Store Distribution -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-map-marker-alt me-2"></i>Return Distribution by Store
                </div>
                <div class="sidebar-card-body">
                  <?php 
                  $store_data = [
                    ['name' => 'IKEA Alam Sutera', 'status' => 'Highest Returns', 'suppliers' => ['Apex Computers', 'Modern Auto']],
                    ['name' => 'IKEA Jakarta Garden City', 'status' => 'Rising Returns', 'suppliers' => ['Best Tools', 'AIM Infotech']]
                  ];
                  
                  foreach($store_data as $store): 
                  ?>
                  <div class="location-brand-section">
                    <div class="location-brand-header">
                      <h6 class="location-brand-name"><?php echo $store['name']; ?></h6>
                      <span class="location-status-badge <?php echo strpos($store['status'], 'Highest') !== false ? 'top' : 'rising'; ?>">
                        <?php echo $store['status']; ?>
                      </span>
                    </div>
                    <p class="location-description">Most returns from:</p>
                    <div class="location-tags">
                      <?php foreach($store['suppliers'] as $index => $supplier): ?>
                      <span class="location-tag <?php echo $index === 0 ? 'highlight' : ''; ?>"><?php echo $supplier; ?></span>
                      <?php endforeach; ?>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>

              <!-- AI Suggestion -->
              <div class="suggestion-card">
                <div class="insight-card-header">
                  <i class="fas fa-brain text-white"></i>
                  <h4 class="mb-0 text-white">AI Suggestion: Return Pattern Analysis</h4>
                </div>
                <p class="mb-0" style="font-size: 0.85rem;">"Return patterns show seasonal variations. Consider implementing preventive quality measures during peak periods and supplier training programs."</p>
              </div>
            </div>
          </div>

          <!-- Enhanced Supplier Returns Data Table - Full Width Professional with Search & Export -->
          <div class="brand-table-section">
            <div class="chart-header">
              <h5 class="chart-title"><i class="fas fa-table me-2"></i>Recent Supplier Returns</h5>
              <div class="d-flex align-items-center gap-2">
                <span style="font-size: 0.8rem; color: #64748b;" id="totalReturnsText">Total: <?php echo count($returns_data); ?> returns</span>
              </div>
            </div>
            
            <!-- Table Controls -->
            <div class="table-controls">
              <div class="search-container">
                <input type="text" class="search-input" id="searchInput" placeholder="Search supplier, reference, or status...">
                <i class="fas fa-search search-icon"></i>
              </div>
              <div class="export-buttons">
                <button class="export-btn pdf" onclick="exportToPDF()">
                  <i class="fas fa-file-pdf"></i>
                  Export PDF
                </button>
                <button class="export-btn excel" onclick="exportToExcel()">
                  <i class="fas fa-file-excel"></i>
                  Export Excel
                </button>
              </div>
            </div>
            
            <table class="brand-table" id="returnsTable">
              <thead>
                <tr>
                  <th>NO</th>
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
              <tbody id="returnsTableBody">
                <?php if (!empty($returns_data)): ?>
                  <?php foreach(array_slice($returns_data, 0, 10) as $index => $return): 
                    $paymentStatusClass = $return['payment_status'] === 'Paid' ? 'status-active' : 
                                        ($return['payment_status'] === 'Partial' ? 'status-trending' : 'status-stable');
                    $statusClass = $return['status'] === 'Completed' ? 'status-active' : 
                                 ($return['status'] === 'Processing' ? 'status-trending' : 'status-stable');
                  ?>
                  <tr>
                    <td style="color: #374151; font-weight: 600;"><?php echo $index + 1; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($return['return_date'])); ?></td>
                    <td><span class="brand-name"><?php echo $return['supplier_name'] ?? 'Unknown'; ?></span></td>
                    <td><?php echo $return['store_name'] ?? 'Unknown'; ?></td>
                    <td><span class="brand-id"><?php echo $return['return_code']; ?></span></td>
                    <td><span class="brand-price">$<?php echo number_format($return['total_amount'], 2); ?></span></td>
                    <td><span class="brand-sales">$<?php echo number_format($return['refund_amount'], 2); ?></span></td>
                    <td><span class="brand-price">$<?php echo number_format($return['due_amount'], 2); ?></span></td>
                    <td><span class="brand-status <?php echo $paymentStatusClass; ?>"><?php echo $return['payment_status']; ?></span></td>
                    <td><span class="brand-status <?php echo $statusClass; ?>"><?php echo $return['status']; ?></span></td>
                    <td>
                      <button class="btn btn-sm btn-outline-primary" onclick="showReturnDetails(<?php echo $return['id']; ?>)">
                        <i class="fas fa-eye"></i>
                      </button>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="11" class="text-center">No data available</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
            
            <!-- No Results Message -->
            <div class="no-results" id="noResults" style="display: none;">
              <i class="fas fa-search"></i>
              <h5>No data found</h5>
              <p>Try changing your search keywords</p>
            </div>
            
            <div class="table-pagination" id="tablePagination">
              <div class="pagination-info" id="paginationInfo">
                Showing 1-<?php echo min(10, count($returns_data)); ?> of <?php echo count($returns_data); ?> returns
              </div>
              <div class="pagination-controls">
                <button class="pagination-btn" id="prevBtn" onclick="changePage(-1)">
                  <i class="fas fa-chevron-left"></i> Prev
                </button>
                <button class="pagination-btn active" id="page1Btn" onclick="goToPage(1)">1</button>
                <button class="pagination-btn" id="page2Btn" onclick="goToPage(2)">2</button>
                <button class="pagination-btn"  id="page3Btn" onclick="goToPage(3)">3</button>
                <button class="pagination-btn" id="nextBtn" onclick="changePage(1)">
                  Next <i class="fas fa-chevron-right"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

<!-- Supplier Return Details Modal -->
<div class="modal fade" id="returnDetailsModal" tabindex="-1" aria-labelledby="returnDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%); color: white;">
        <h5 class="modal-title" id="returnDetailsModalLabel">
          <i class="fas fa-file-alt me-2"></i>Supplier Return Details
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- Left Column -->
          <div class="col-md-6">
            <div class="detail-card mb-3">
              <h6 class="detail-header">
                <i class="fas fa-info-circle text-primary me-2"></i>Basic Information
              </h6>
              <div class="detail-item">
const returnsData = <?php echo !empty($jsTableData) ? json_encode($jsTableData) : '[]'; ?>;

// Fallback data if no database data available
if (returnsData.length === 0) {
  returnsData.push(
    { 
      id: 1, 
      image: "product1.jpg", 
      date: "19/11/2022", 
      supplier: "No Data Available", 
      storage: "No Data Available", 
      reference: "N/A", 
      total: 0.00, 
      paid: 0.00, 
      due: 0.00, 
      paymentStatus: "N/A", 
      status: "N/A" 
    }
  );
}

// Pagination and search variables
let currentPage = 1;
let itemsPerPage = 10;
let filteredData = [...returnsDataFromDB];
let searchQuery = '';

// Initialize charts
function initBarChart() {
  const options = {
    series: [{
      data: processedBarData.returns.length > 0 ? processedBarData.returns : [0, 0, 0, 0, 0]
    }],
    chart: {
      type: 'bar',
      height: 250,
      toolbar: {
        show: true
      }
    },
    plotOptions: {
      bar: {
        borderRadius: 6,
        horizontal: false,
        columnWidth: '60%',
        distributed: false,
      }
    },
    dataLabels: {
      enabled: false
    },
    colors: ['#1976d2'],
    fill: {
      type: 'gradient',
      gradient: {
        shade: 'light',
        type: 'vertical',
        shadeIntensity: 0.25,
        gradientToColors: ['#64b5f6'],
        inverseColors: false,
        opacityFrom: 1,
        opacityTo: 1,
        stops: [0, 100]
      }
    },
    stroke: {
      show: true,
      width: 2,
      colors: ['transparent']
    },
    xaxis: {
      categories: processedBarData.categories.length > 0 ? processedBarData.categories : ['No Data'],
    },
    yaxis: {
      title: {
      },
      labels: {
        formatter: function(val) {
          return val + ' returns';
        }
      }
    },
    tooltip: {
      y: {
        formatter: function(val) {
          return val + ' returns';
        }
      }
    },
    grid: {
      row: {
        colors: ['#f3f3f3', 'transparent'],
        opacity: 0.5
      }
    }
  };

  if (barChart) {
    barChart.destroy();
  }

  barChart = new ApexCharts(document.querySelector("#barChart"), options);
  barChart.render();
}

function initDonutChart() {
  const options = {
    series: processedDonutData.series.length > 0 ? processedDonutData.series : [100],
    chart: {
      type: 'donut',
      height: 200,
    },
    labels: processedDonutData.labels.length > 0 ? processedDonutData.labels : ['No Data'],
    colors: processedDonutData.colors,
    responsive: [{
      breakpoint: 480,
      options: {
        chart: {
          width: 150
        },
        legend: {
          position: 'bottom'
        }
      }
    }],
    legend: {
      show: false
    },
    plotOptions: {
      pie: {
        donut: {
          size: '60%',
          labels: {
            show: true,
            total: {
              show: true,
              label: 'Total',
              formatter: function (w) {
                return '100%'
              }
            }
          }
        }
      }
    },
    dataLabels: {
      formatter: function(val, opts) {
        return val.toFixed(1) + '%';
      },
      dropShadow: {
        enabled: false
      }
    }
  };

  if (donutChart) {
    donutChart.destroy();
  }

  donutChart = new ApexCharts(document.querySelector("#donutChart"), options);
  donutChart.render();

  createDonutLegend();
}

function initLineChart() {
  const options = {
    series: lineChartSeries.length > 0 ? lineChartSeries : [{name: 'No Data', data: [0,0,0,0,0,0,0,0,0,0,0,0]}],
    chart: {
      height: 250,
      type: 'line',
      zoom: {
        enabled: false
      },
      toolbar: {
        show: true
      }
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
      width: 2,
    },
    colors: ['#1976d2', '#42a5f5', '#64b5f6', '#90caf9', '#bbdefb'],
    markers: {
      size: 4,
      strokeWidth: 0,
      hover: {
        size: 6
      }
    },
    grid: {
      row: {
        colors: ['#f3f3f3', 'transparent'],
        opacity: 0.5
      }
    },
    xaxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    },
    yaxis: {
      title: {
      }
    },
    tooltip: {
      y: {
        formatter: function(val) {
          return val + ' returns';
        }
      }
    }
  };

  if (lineChart) {
    lineChart.destroy();
  }

  lineChart = new ApexCharts(document.querySelector("#lineChart"), options);
  lineChart.render();
}

function createDonutLegend() {
  const legendContainer = document.getElementById('donutLegend');
  legendContainer.innerHTML = '';

  if (processedDonutData.labels.length > 0 && processedDonutData.labels[0] !== 'No Data') {
    processedDonutData.labels.forEach((label, index) => {
      const legendItem = document.createElement('div');
      legendItem.className = 'legend-item';
      
      const colorBox = document.createElement('div');
      colorBox.className = 'legend-color';
      colorBox.style.backgroundColor = processedDonutData.colors[index];
      
      const labelText = document.createElement('span');
      labelText.textContent = `${label} (${processedDonutData.series[index].toFixed(1)}%)`;
      
      legendItem.appendChild(colorBox);
      legendItem.appendChild(labelText);
      legendContainer.appendChild(legendItem);
    });
  }
}

// Search functionality
function performSearch(query) {
  searchQuery = query.toLowerCase();
  
  if (searchQuery === '') {
    filteredData = [...returnsDataFromDB];
  } else {
    filteredData = returnsDataFromDB.filter(item => 
      (item.supplier_name && item.supplier_name.toLowerCase().includes(searchQuery)) ||
      (item.return_code && item.return_code.toLowerCase().includes(searchQuery)) ||
      (item.status && item.status.toLowerCase().includes(searchQuery)) ||
      (item.payment_status && item.payment_status.toLowerCase().includes(searchQuery)) ||
      (item.store_name && item.store_name.toLowerCase().includes(searchQuery))
    );
  }
  
  currentPage = 1;
  updateTotalPages();
  renderReturnsTable(currentPage);
  updateTotalReturnsText();
}

function updateTotalPages() {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  
  document.getElementById('page1Btn').style.display = totalPages >= 1 ? 'inline-block' : 'none';
  document.getElementById('page2Btn').style.display = totalPages >= 2 ? 'inline-block' : 'none';
  document.getElementById('page3Btn').style.display = totalPages >= 3 ? 'inline-block' : 'none';
}

function updateTotalReturnsText() {
  const totalText = document.getElementById('totalReturnsText');
  if (searchQuery === '') {
    totalText.textContent = `Total: ${returnsDataFromDB.length} returns`;
  } else {
    totalText.textContent = `Found: ${filteredData.length} of ${returnsDataFromDB.length} returns`;
  }
}

function renderReturnsTable(page = 1) {
  const startIndex = (page - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  const pageData = filteredData.slice(startIndex, endIndex);

  const tableBody = document.getElementById('returnsTableBody');
  const noResults = document.getElementById('noResults');
  const tablePagination = document.getElementById('tablePagination');
  
  if (filteredData.length === 0) {
    tableBody.innerHTML = '';
    noResults.style.display = 'block';
    tablePagination.style.display = 'none';
    return;
  } else {
    noResults.style.display = 'none';
    tablePagination.style.display = 'flex';
  }

  tableBody.innerHTML = '';

  pageData.forEach((item, index) => {
    const row = document.createElement('tr');
    
    const paymentStatusClass = item.payment_status === 'Paid' ? 'status-active' : 
                              item.payment_status === 'Partial' ? 'status-trending' : 'status-stable';
    const statusClass = item.status === 'Completed' ? 'status-active' : 
                       item.status === 'Processing' ? 'status-trending' : 'status-stable';
    
    const rowNumber = startIndex + index + 1;
    
    row.innerHTML = `
      <td style="color: #374151; font-weight: 600;">${rowNumber}</td>
      <td>${new Date(item.return_date).toLocaleDateString('en-GB')}</td>
      <td><span class="brand-name">${item.supplier_name || 'Unknown'}</span></td>
      <td>${item.store_name || 'Unknown'}</td>
      <td><span class="brand-id">${item.return_code}</span></td>
      <td><span class="brand-price">$${parseFloat(item.total_amount).toFixed(2)}</span></td>
      <td><span class="brand-sales">$${parseFloat(item.refund_amount).toFixed(2)}</span></td>
      <td><span class="brand-price">$${parseFloat(item.due_amount).toFixed(2)}</span></td>
      <td><span class="brand-status ${paymentStatusClass}">${item.payment_status}</span></td>
      <td><span class="brand-status ${statusClass}">${item.status}</span></td>
      <td>
        <button class="btn btn-sm btn-outline-primary" onclick="showReturnDetails(${item.id})">
          <i class="fas fa-eye"></i>
        </button>
      </td>
    `;
    
    tableBody.appendChild(row);
  });

  // Update pagination info
  const totalItems = filteredData.length;
  const startItem = startIndex + 1;
  const endItem = Math.min(endIndex, totalItems);
  document.getElementById('paginationInfo').textContent = 
    `Showing ${startItem}-${endItem} of ${totalItems} returns`;

  updatePaginationButtons(page);
}

function updatePaginationButtons(page) {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  
  document.getElementById('prevBtn').disabled = page === 1;
  document.getElementById('nextBtn').disabled = page === totalPages;

  document.getElementById('page1Btn').classList.toggle('active', page === 1);
  document.getElementById('page2Btn').classList.toggle('active', page === 2);
  document.getElementById('page3Btn').classList.toggle('active', page === 3);
  
  document.getElementById('page1Btn').style.display = totalPages >= 1 ? 'inline-block' : 'none';
  document.getElementById('page2Btn').style.display = totalPages >= 2 ? 'inline-block' : 'none';
  document.getElementById('page3Btn').style.display = totalPages >= 3 ? 'inline-block' : 'none';
}

function changePage(direction) {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  const newPage = currentPage + direction;
  if (newPage >= 1 && newPage <= totalPages) {
    currentPage = newPage;
    renderReturnsTable(currentPage);
  }
}

function goToPage(page) {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  if (page >= 1 && page <= totalPages) {
    currentPage = page;
    renderReturnsTable(currentPage);
  }
}

function showReturnDetails(returnId) {
  const returnData = returnsDataFromDB.find(item => item.id == returnId);
  
  if (!returnData) {
    console.error('Return data not found');
    return;
  }

  // Populate modal with data
  document.getElementById('modalReference').textContent = returnData.return_code;
  document.getElementById('modalDate').textContent = new Date(returnData.return_date).toLocaleDateString('en-GB');
  document.getElementById('modalSupplier').textContent = returnData.supplier_name || 'Unknown';
  document.getElementById('modalStorage').textContent = returnData.store_name || 'Unknown';
  document.getElementById('modalTotal').textContent = '$' + parseFloat(returnData.total_amount).toFixed(2);
  document.getElementById('modalPaid').textContent = '$' + parseFloat(returnData.refund_amount).toFixed(2);
  document.getElementById('modalDue').textContent = '$' + parseFloat(returnData.due_amount).toFixed(2);
  document.getElementById('modalProcessingTime').textContent = '2-3 days';
  document.getElementById('modalReturnRate').textContent = '5.2%';
  document.getElementById('modalSupplierRating').textContent = '4.2/5.0';
  document.getElementById('modalCategory').textContent = 'General';
  document.getElementById('modalReturnType').textContent = returnData.return_type || 'Standard';
  document.getElementById('modalPriority').textContent = returnData.priority || 'Medium';

  // Set payment status with appropriate styling
  const paymentStatusElement = document.getElementById('modalPaymentStatus');
  paymentStatusElement.textContent = returnData.payment_status;
  paymentStatusElement.className = 'detail-value brand-status ' + 
    (returnData.payment_status === 'Paid' ? 'status-active' : 
     returnData.payment_status === 'Partial' ? 'status-trending' : 'status-stable');

  // Set return status with appropriate styling
  const statusElement = document.getElementById('modalStatus');
  statusElement.textContent = returnData.status;
  statusElement.className = 'detail-value brand-status ' + 
    (returnData.status === 'Completed' ? 'status-active' : 
     returnData.status === 'Processing' ? 'status-trending' : 'status-stable');

  // Show modal
  const modal = new bootstrap.Modal(document.getElementById('returnDetailsModal'));
  modal.show();
}

function editReturn() {
  const modal = bootstrap.Modal.getInstance(document.getElementById('returnDetailsModal'));
  modal.hide();
  
  const reference = document.getElementById('modalReference').textContent;
  alert(`Redirecting to edit page for return: ${reference}`);
}

function printReturn() {
  const reference = document.getElementById('modalReference').textContent;
  const supplier = document.getElementById('modalSupplier').textContent;
  const date = document.getElementById('modalDate').textContent;
  const total = document.getElementById('modalTotal').textContent;
  const status = document.getElementById('modalStatus').textContent;

  const printContent = `
    <div style="font-family: Arial, sans-serif; padding: 20px;">
      <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="color: #1976d2;">IKEA - Supplier Return Details</h2>
        <p style="color: #666;">Generated on ${new Date().toLocaleDateString()}</p>
      </div>
      
      <div style="border: 2px solid #1976d2; padding: 20px; border-radius: 8px;">
        <h3 style="color: #1976d2; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px;">Return Information</h3>
        
        <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
          <tr>
            <td style="padding: 8px; font-weight: bold; width: 30%;">Reference:</td>
            <td style="padding: 8px;">${reference}</td>
          </tr>
          <tr style="background: #f8fafc;">
            <td style="padding: 8px; font-weight: bold;">Date:</td>
            <td style="padding: 8px;">${date}</td>
          </tr>
          <tr>
            <td style="padding: 8px; font-weight: bold;">Supplier:</td>
            <td style="padding: 8px;">${supplier}</td>
          </tr>
          <tr style="background: #f8fafc;">
            <td style="padding: 8px; font-weight: bold;">Total Amount:</td>
            <td style="padding: 8px; color: #1976d2; font-weight: bold;">${total}</td>
          </tr>
          <tr>
            <td style="padding: 8px; font-weight: bold;">Status:</td>
            <td style="padding: 8px;">${status}</td>
          </tr>
        </table>
      </div>
      
      <div style="margin-top: 30px; text-align: center; color: #666; font-size: 12px;">
        <p>This is a computer-generated document. No signature required.</p>
      </div>
    </div>
  `;

  const printWindow = window.open('', '_blank');
  printWindow.document.write(`
    <!DOCTYPE html>
    <html>
    <head>
      <title>Return Details - ${reference}</title>
      <style>
        @media print {
          body { margin: 0; }
          .no-print { display: none; }
        }
      </style>
    </head>
    <body>
      ${printContent}
      <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()" style="background: #1976d2; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Print</button>
        <button onclick="window.close()" style="background: #666; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; margin-left: 10px;">Close</button>
      </div>
    </body>
    </html>
  `);
  printWindow.document.close();
}

function exportToPDF() {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF();
  
  doc.setFontSize(16);
  doc.text('Supplier Returns Data', 14, 22);
  
  doc.setFontSize(10);
  doc.text(`Exported on: ${new Date().toLocaleDateString('en-US')}`, 14, 30);
  
  const tableData = filteredData.map((item, index) => [
    index + 1,
    new Date(item.return_date).toLocaleDateString('en-GB'),
    item.supplier_name || 'Unknown',
    item.store_name || 'Unknown',
    item.return_code,
    '$' + parseFloat(item.total_amount).toFixed(2),
    '$' + parseFloat(item.refund_amount).toFixed(2),
    '$' + parseFloat(item.due_amount).toFixed(2),
    item.payment_status,
    item.status
  ]);
  
  doc.autoTable({
    head: [['No', 'Date', 'Supplier', 'Storage', 'Reference', 'Total', 'Paid', 'Due', 'Payment', 'Status']],
    body: tableData,
    startY: 35,
    styles: {
      fontSize: 8,
      cellPadding: 2
    },
    headStyles: {
      fillColor: [25, 118, 210],
      textColor: 255
    }
  });
  
  doc.save('supplier-returns-data.pdf');
}

function exportToExcel() {
  const excelData = filteredData.map((item, index) => ({
    'No': index + 1,
    'Date': new Date(item.return_date).toLocaleDateString('en-GB'),
    'Supplier': item.supplier_name || 'Unknown',
    'To Storage': item.store_name || 'Unknown',
    'Reference': item.return_code,
    'Grand Total ($)': parseFloat(item.total_amount),
    'Paid ($)': parseFloat(item.refund_amount),
    'Due ($)': parseFloat(item.due_amount),
    'Payment Status': item.payment_status,
    'Status': item.status
  }));
  
  const wb = XLSX.utils.book_new();
  const ws = XLSX.utils.json_to_sheet(excelData);
  
  XLSX.utils.book_append_sheet(wb, ws, 'Supplier Returns Data');
  XLSX.writeFile(wb, 'supplier-returns-data.xlsx');
}

// Event listeners
document.getElementById('searchInput').addEventListener('input', function() {
  performSearch(this.value);
});

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
  setTimeout(function() {
    document.getElementById('global-loader').style.display = 'none';
  }, 1000);

  initBarChart();
  initDonutChart();
  initLineChart();
  renderReturnsTable(1);
  updateTotalReturnsText();
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

<?php
$conn->close();
?>