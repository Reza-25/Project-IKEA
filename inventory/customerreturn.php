<?php
require_once __DIR__ . '/../include/config.php';

// Check if connection exists, if not create it
if (!isset($conn) || $conn === null) {
  // Assuming your config.php should define these variables
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
}

// Fungsi untuk mengambil statistik utama
function getMainStats($conn) {
    $stats = [];
    
    // Total Returns
    $query = "SELECT COUNT(*) as total_returns FROM customer_returns WHERE MONTH(return_date) = MONTH(CURRENT_DATE()) AND YEAR(return_date) = YEAR(CURRENT_DATE())";
    $result = mysqli_query($conn, $query);
    $stats['total_returns'] = mysqli_fetch_assoc($result)['total_returns'] ?? 0;
    
    // Total Refund Value
    $query = "SELECT SUM(refund_amount) as total_refund FROM customer_returns WHERE MONTH(return_date) = MONTH(CURRENT_DATE()) AND YEAR(return_date) = YEAR(CURRENT_DATE())";
    $result = mysqli_query($conn, $query);
    $total_refund_raw = mysqli_fetch_assoc($result)['total_refund'] ?? 0;
    $stats['total_refund'] = $total_refund_raw;
    
    // Format refund untuk display (dalam ribuan)
    if ($total_refund_raw >= 1000000) {
        $stats['total_refund_display'] = number_format($total_refund_raw / 1000000, 1) . 'M';
    } elseif ($total_refund_raw >= 1000) {
        $stats['total_refund_display'] = number_format($total_refund_raw / 1000, 0) . 'K';
    } else {
        $stats['total_refund_display'] = number_format($total_refund_raw, 0);
    }
    
    // Nilai sederhana untuk counter
    $stats['total_refund_simple'] = $total_refund_raw >= 1000000 ? 
        number_format($total_refund_raw / 1000000, 1) : 
        ($total_refund_raw >= 1000 ? number_format($total_refund_raw / 1000, 0) : $total_refund_raw);
    
    // Average Return Rate
    $query = "SELECT AVG(return_rate) as avg_return_rate FROM return_analytics WHERE month = MONTH(CURRENT_DATE()) AND year = YEAR(CURRENT_DATE())";
    $result = mysqli_query($conn, $query);
    $avg_rate = mysqli_fetch_assoc($result)['avg_return_rate'] ?? 0;
    $stats['avg_return_rate'] = is_numeric($avg_rate) ? $avg_rate : 3.2; // Default value jika null
    
    // Top Category Returns
    $query = "SELECT cp.category_name, COUNT(ri.id) as return_count 
              FROM return_items ri 
              JOIN customer_returns cr ON ri.return_id = cr.id 
              JOIN products p ON ri.item_id = p.id 
              JOIN categories_product cp ON p.category_id = cp.id 
              WHERE MONTH(cr.return_date) = MONTH(CURRENT_DATE()) 
              AND YEAR(cr.return_date) = YEAR(CURRENT_DATE())
              GROUP BY cp.category_name 
              ORDER BY return_count DESC 
              LIMIT 1";
    $result = mysqli_query($conn, $query);
    $top_category = mysqli_fetch_assoc($result);
    $stats['top_category'] = $top_category['category_name'] ?? 'Furniture';
    $stats['top_category_count'] = $top_category['return_count'] ?? 42;
    
    return $stats;
}

// Fungsi untuk mengambil data chart kategori
function getCategoryReturnData($conn, $year = 2025) {
    $query = "SELECT cp.category_name, COUNT(ri.id) as return_count 
              FROM return_items ri 
              JOIN customer_returns cr ON ri.return_id = cr.id 
              JOIN products p ON ri.item_id = p.id 
              JOIN categories_product cp ON p.category_id = cp.id 
              WHERE YEAR(cr.return_date) = ?
              GROUP BY cp.category_name 
              ORDER BY return_count DESC 
              LIMIT 5";
    
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $year);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $categories = [];
    $returns = [];
    
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row['category_name'];
        $returns[] = (int)$row['return_count'];
    }
    
    // Jika tidak ada data, gunakan data default
    if (empty($categories)) {
        $categories = ["Furniture", "Lighting", "Storage", "Bedroom", "Kitchen"];
        $returns = [42, 28, 24, 18, 15];
    }
    
    return ['categories' => $categories, 'returns' => $returns];
}

// Fungsi untuk mengambil data return trend bulanan
function getMonthlyReturnTrend($conn, $year = 2025) {
    $query = "SELECT cp.category_name, 
                     MONTH(cr.return_date) as month, 
                     COUNT(ri.id) as return_count 
              FROM return_items ri 
              JOIN customer_returns cr ON ri.return_id = cr.id 
              JOIN products p ON ri.item_id = p.id 
              JOIN categories_product cp ON p.category_id = cp.id 
              WHERE YEAR(cr.return_date) = ?
              GROUP BY cp.category_name, MONTH(cr.return_date) 
              ORDER BY cp.category_name, month";
    
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $year);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $trend_data = [];
    $categories = ["Furniture", "Lighting", "Storage", "Bedroom", "Kitchen"];
    
    // Initialize dengan data kosong
    foreach ($categories as $category) {
        $trend_data[$category] = array_fill(0, 8, 0); // 8 bulan data
    }
    
    while ($row = mysqli_fetch_assoc($result)) {
        $category = $row['category_name'];
        $month = $row['month'] - 1; // Convert to 0-based index
        if (isset($trend_data[$category]) && $month < 8) {
            $trend_data[$category][$month] = (int)$row['return_count'];
        }
    }
    
    // Jika tidak ada data, gunakan data default
    if (empty($trend_data) || array_sum($trend_data['Furniture']) == 0) {
        $trend_data = [
            'Furniture' => [35, 38, 42, 45, 40, 48, 42, 38],
            'Lighting' => [22, 25, 28, 32, 30, 35, 28, 26],
            'Storage' => [20, 22, 24, 28, 26, 30, 24, 22],
            'Bedroom' => [15, 16, 18, 20, 18, 22, 18, 16],
            'Kitchen' => [12, 14, 15, 18, 16, 20, 15, 14]
        ];
    }
    
    return $trend_data;
}

// Fungsi untuk mengambil data tabel returns
function getReturnsTableData($conn, $limit = 12) {
    $query = "SELECT cr.return_code, p.product_name, cp.category_name, 
                     c.full_name as customer_name, rr.reason_name, 
                     cr.refund_amount, cr.status, cr.return_date
              FROM customer_returns cr
              JOIN customers c ON cr.customer_id = c.id
              LEFT JOIN return_items ri ON cr.id = ri.return_id
              LEFT JOIN products p ON ri.item_id = p.id
              LEFT JOIN categories_product cp ON p.category_id = cp.id
              LEFT JOIN return_reasons rr ON ri.reason_id = rr.id
              ORDER BY cr.return_date DESC
              LIMIT ?";
    
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $limit);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $returns_data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $returns_data[] = [
            'id' => $row['return_code'] ?? 'RET' . sprintf("%03d", count($returns_data) + 1),
            'product' => $row['product_name'] ?? 'LACK Coffee Table',
            'category' => $row['category_name'] ?? 'Furniture',
            'customer' => $row['customer_name'] ?? 'John Doe',
            'reason' => $row['reason_name'] ?? 'Defect',
            'amount' => 'Rp ' . number_format($row['refund_amount'] ?? 199000, 0, ',', '.'),
            'status' => $row['status'] ?? 'processed'
        ];
    }
    
    // Jika tidak ada data, gunakan data default
    if (empty($returns_data)) {
        $returns_data = [
            ['id' => 'RET001', 'product' => 'LACK Coffee Table', 'category' => 'Furniture', 'customer' => 'John Doe', 'reason' => 'Defect', 'amount' => 'Rp 199K', 'status' => 'processed'],
            ['id' => 'RET002', 'product' => 'FOTO LED Bulb', 'category' => 'Lighting', 'customer' => 'Jane Smith', 'reason' => 'Wrong Item', 'amount' => 'Rp 89K', 'status' => 'pending'],
            ['id' => 'RET003', 'product' => 'KALLAX Shelf Unit', 'category' => 'Storage', 'customer' => 'Mike Johnson', 'reason' => 'Damage', 'amount' => 'Rp 399K', 'status' => 'refunded'],
            ['id' => 'RET004', 'product' => 'HEMNES Bed Frame', 'category' => 'Bedroom', 'customer' => 'Sarah Wilson', 'reason' => 'Size Issue', 'amount' => 'Rp 2.999K', 'status' => 'processed'],
            ['id' => 'RET005', 'product' => 'BILLY Bookcase', 'category' => 'Storage', 'customer' => 'Tom Brown', 'reason' => 'Defect', 'amount' => 'Rp 299K', 'status' => 'pending'],
            ['id' => 'RET006', 'product' => 'MALM Dresser', 'category' => 'Bedroom', 'customer' => 'Lisa Davis', 'reason' => 'Wrong Color', 'amount' => 'Rp 1.499K', 'status' => 'refunded'],
            ['id' => 'RET007', 'product' => 'POÄNG Armchair', 'category' => 'Furniture', 'customer' => 'Chris Lee', 'reason' => 'Comfort', 'amount' => 'Rp 1.299K', 'status' => 'processed'],
            ['id' => 'RET008', 'product' => 'GRUNDTAL Kitchen Rail', 'category' => 'Kitchen', 'customer' => 'Anna White', 'reason' => 'Size Issue', 'amount' => 'Rp 149K', 'status' => 'pending'],
            ['id' => 'RET009', 'product' => 'EKET Cabinet', 'category' => 'Storage', 'customer' => 'David Green', 'reason' => 'Damage', 'amount' => 'Rp 179K', 'status' => 'refunded'],
            ['id' => 'RET010', 'product' => 'FOTO Table Lamp', 'category' => 'Lighting', 'customer' => 'Emma Wilson', 'reason' => 'Defect', 'amount' => 'Rp 259K', 'status' => 'processed'],
            ['id' => 'RET011', 'product' => 'VITTSJÖ Shelf Unit', 'category' => 'Storage', 'customer' => 'Ryan Miller', 'reason' => 'Assembly', 'amount' => 'Rp 449K', 'status' => 'pending'],
            ['id' => 'RET012', 'product' => 'SKÅDIS Pegboard', 'category' => 'Storage', 'customer' => 'Sophie Clark', 'reason' => 'Wrong Size', 'amount' => 'Rp 299K', 'status' => 'refunded']
        ];
    }
    
    return $returns_data;
}

// Ambil data dari database
$main_stats = getMainStats($conn);
$category_data_2025 = getCategoryReturnData($conn, 2025);
$category_data_2024 = getCategoryReturnData($conn, 2024);
$category_data_2023 = getCategoryReturnData($conn, 2023);
$trend_data_2025 = getMonthlyReturnTrend($conn, 2025);
$trend_data_2024 = getMonthlyReturnTrend($conn, 2024);
$trend_data_2023 = getMonthlyReturnTrend($conn, 2023);
$returns_table_data = getReturnsTableData($conn);
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
<title>RuangKu</title>

<link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.png">
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
        <h4>Customer Returns Dashboard</h4>
        <h6>Comprehensive customer return analytics and insights</h6>
      </div>
      <div class="page-btn">
        <a href="addreturn.php" class="btn btn-added">
          <img src="../assets/img/icons/plus.svg" class="me-1" alt="img">New Return
        </a>
      </div>
    </div>

    <!-- Revenue, Returns, Refunds, Return Rate -->
          <div class="row justify-content-end">
          <!-- 🔢 Total Returns -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="#" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das1">
                  <div class="dash-counts">
                    <h4><span class="counters" data-count="<?php echo $main_stats['total_returns']; ?>"><?php echo $main_stats['total_returns']; ?></span></h4>
                    <h5>Total Returns</h5>
                    <h2 class="stat-change">+15% from last month</h2>
                    </div>
                    <div class="icon-box bg-ungu">
                      <i class="fa fa-undo"></i>
                    </div>
                </div>
              </a>
            </div>

            <!-- 💰 Total Refund Value -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="#" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das2">
                  <div class="dash-counts">
                  <h4>Rp<span class="counters" data-count="<?php echo $main_stats['total_refund_simple']; ?>"><?php echo $main_stats['total_refund_simple']; ?></span></h4>
                   <h5>Total Refund Value</h5>
                  <h2 class="stat-change">+8% from last month</h2>
                </div>
                <div class="icon-box bg-biru">
                  <i class="fa fa-dollar-sign"></i>
                </div>
                </div>
              </a>
            </div>

             <!-- 📊 Average Return Rate -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="#" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das3">
                  <div class="dash-counts">
                  <h4><span class="counters" data-count="<?php echo number_format($main_stats['avg_return_rate'], 1); ?>"><?php echo number_format($main_stats['avg_return_rate'], 1); ?>%</span></h4> 
                  <h5>Avg. Return Rate</h5>                 
                    <h2 class="stat-change">-1.2% from last month</h2>
                  </div>
                  <div class="icon-box bg-merah">
                    <i class="fa fa-percentage"></i>
                  </div>
                </div>
              </a>
            </div>

            <!-- 🏆 Top Category Returns -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="#" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das4">
                  <div class="dash-counts">
                     <h4><?php echo $main_stats['top_category']; ?></h4>
                    <h5>Top Category Returns</h5>
                   <h2 class="stat-change"><?php echo $main_stats['top_category_count']; ?> returns this month</h2>
                    </div>
                    <div class="icon-box bg-hijau">
                      <i class="fa fa-couch"></i>
                    </div>
                </div>
              </a>
            </div>
          </div>
    
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
                  <h5 class="chart-title"><i class="fas fa-chart-bar me-2"></i>Top 5 Categories with Highest Returns</h5>
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
                      <h5 style="font-size: 0.9rem;">Insight: Dominasi Return Furniture</h5>
                      <p class="mb-0">Category Furniture mendominasi customer returns dengan kontribusi 42% dari total returns. Returns tertinggi di Q2 karena program "Summer Refresh" promotion campaign.</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Donut Chart -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chart-pie me-2"></i>Category Return Contribution to Total Returns</h5>
                </div>
                <div id="donutChart" style="height: 200px;"></div>
                <div class="donut-legend" id="donutLegend"></div>
                <div class="insight-container">
                  <div class="d-flex align-items-center">
                    <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
                    <div>
                      <h5 style="font-size: 0.9rem;">Insight: Distribusi Return</h5>
                      <p class="mb-0">Top 5 categories menyumbang 78% total customer returns. Furniture category menunjukkan peningkatan return terbesar (+12% YoY).</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Line Chart -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chart-line me-2"></i>Return Trend (Top 5 Categories)</h5>
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
                      <h5 id="lineChartInsightTitle" style="font-size: 0.9rem;">Insight: Tren Return Furniture</h5>
                      <p class="mb-0" id="lineChartInsightText">Category Furniture menunjukkan tren return yang meningkat dengan puncak di bulan Juni. Penurunan return di bulan Juli setelah perbaikan quality control.</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Insight Produk yang Sering Dikembalikan -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-exclamation-triangle me-2"></i>Insight "Produk yang Sering Dikembalikan"</h5>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <div class="p-3" style="background: linear-gradient(135deg, #fff5f5 0%, #ffe8e8 100%); border-radius: 10px; border: 1px solid rgba(244, 67, 54, 0.1);">
                      <div class="text-center mb-2">
                        <h6 class="mb-1" style="color: #d32f2f; font-weight: 600;">LACK vs HEMNES</h6>
                        <span style="background: #d32f2f; color: white; padding: 2px 8px; border-radius: 10px; font-size: 0.7rem;">Furniture</span>
                      </div>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="text-center" style="flex: 1;">
                          <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #ff5722 0%, #d32f2f 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 5px; color: white;">
                            <i class="fas fa-times" style="font-size: 0.8rem;"></i>
                          </div>
                          <h6 style="font-size: 0.8rem; margin-bottom: 3px;">LACK</h6>
                          <small style="font-size: 0.7rem; color: #666;">18 returns | Alasan: Defect</small>
                        </div>
                        <div style="margin: 0 10px;">
                          <div style="width: 25px; height: 25px; background: var(--danger-red); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.6rem; font-weight: 700;">VS</div>
                        </div>
                        <div class="text-center" style="flex: 1;">
                          <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #ffcc02 0%, #ff9800 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 5px; color: white;">
                            <i class="fas fa-exclamation" style="font-size: 0.8rem;"></i>
                          </div>
                          <h6 style="font-size: 0.8rem; margin-bottom: 3px;">HEMNES</h6>
                          <small style="font-size: 0.7rem; color: #666;">12 returns | Alasan: Size</small>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-6 mb-3">
                    <div class="p-3" style="background: linear-gradient(135deg, #fff8e1 0%, #ffecb3 100%); border-radius: 10px; border: 1px solid rgba(255, 152, 0, 0.1);">
                      <div class="text-center mb-2">
                        <h6 class="mb-1" style="color: #f57c00; font-weight: 600;">KALLAX vs BILLY</h6>
                        <span style="background: #f57c00; color: white; padding: 2px 8px; border-radius: 10px; font-size: 0.7rem;">Storage</span>
                      </div>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="text-center" style="flex: 1;">
                          <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 5px; color: white;">
                            <i class="fas fa-times" style="font-size: 0.8rem;"></i>
                          </div>
                          <h6 style="font-size: 0.8rem; margin-bottom: 3px;">KALLAX</h6>
                          <small style="font-size: 0.7rem; color: #666;">15 returns | Alasan: Damage</small>
                        </div>
                        <div style="margin: 0 10px;">
                          <div style="width: 25px; height: 25px; background: var(--warning-orange); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.6rem; font-weight: 700;">VS</div>
                        </div>
                        <div class="text-center" style="flex: 1;">
                          <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 5px; color: white;">
                            <i class="fas fa-exclamation" style="font-size: 0.8rem;"></i>
                          </div>
                          <h6 style="font-size: 0.8rem; margin-bottom: 3px;">BILLY</h6>
                          <small style="font-size: 0.7rem; color: #666;">10 returns | Alasan: Wrong item</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="insight-container">
                  <div class="d-flex align-items-center">
                    <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
                    <div>
                      <h5 style="font-size: 0.9rem;">Insight: Return Pattern Analysis</h5>
                      <p class="mb-0">LACK furniture menunjukkan tingkat return tertinggi karena defect issues. KALLAX storage mengalami return karena shipping damage. Perlu peningkatan quality control dan packaging.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Right Column - Sidebar tetap di samping charts -->
            <div class="col-lg-4">
              <!-- Prediksi Return -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-chart-line me-2"></i>Prediksi Return per Bulan
                </div>
                <div class="sidebar-card-body">
                  <div class="d-flex align-items-center mb-2">
                    <div class="bg-light p-2 rounded-circle me-2" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                      <i class="fas fa-undo text-danger" style="font-size: 1.2rem;"></i>
                    </div>
                    <div>
                      <h5 class="mb-1" style="font-size: 1rem;">Furniture</h5>
                      <p class="mb-0" style="font-size: 0.85rem;">diprediksi <span class="fw-bold">52 returns</span> di Agustus 2025</p>
                    </div>
                    <div class="ms-auto">
                      <span class="trend-indicator trend-up" style="font-size: 1.5rem;">▲</span>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div>
                      <p class="mb-1" style="font-size: 0.8rem;">Akurasi prediksi:</p>
                      <div class="progress" style="height: 6px; width: 100px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <span class="fw-bold" style="font-size: 0.8rem;">82%</span>
                    </div>
                    <div>
                      <p class="mb-1" style="font-size: 0.8rem;">Bandingkan dengan:</p>
                      <p class="mb-0 fw-bold" style="font-size: 0.8rem;">Jul 2025: 48 returns</p>
                      <p class="mb-0 fw-bold" style="font-size: 0.8rem;">Ags 2024: 45 returns</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Notifikasi Kritis -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-bell me-2"></i>Critical Return Alerts
                </div>
                <div class="sidebar-card-body">
                  <div class="notification-card danger">
                    <i class="fas fa-exclamation-triangle text-danger"></i>
                    <div>
                      <h5 class="mb-1">Furniture - High Return Rate</h5>
                      <p class="mb-0">15% MoM increase, rating dropped to 4.1</p>
                    </div>
                  </div>
                  
                  <div class="notification-card warning">
                    <i class="fas fa-sync-alt text-warning"></i>
                    <div>
                      <h5 class="mb-1">LACK - 8 Defective Returns This Week</h5>
                      <p class="mb-0">Quality issues detected in recent shipments</p>
                    </div>
                  </div>
                  
                  <div class="notification-card info">
                    <i class="fas fa-comment text-info"></i>
                    <div>
                      <h5 class="mb-1">Lighting - Return Spike</h5>
                      <p class="mb-0">Customer complaints about LED compatibility</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Health Score -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-heartbeat me-2"></i>Return Management Health Score
                </div>
                <div class="sidebar-card-body">
                  <div class="health-score-item">
                    <div class="health-brand-info">
                      <h6>Storage Category</h6>
                      <p>Low return rate (3.2%), good customer satisfaction</p>
                    </div>
                    <div class="health-score-value">
                      <div class="health-score good">92/100</div>
                      <div class="health-progress">
                        <div class="health-fill good" style="width: 92%"></div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="health-score-item">
                    <div class="health-brand-info">
                      <h6>Furniture Category</h6>
                      <p>High return rate (8.5%), quality issues reported</p>
                    </div>
                    <div class="health-score-value">
                      <div class="health-score poor">58/100</div>
                      <div class="health-progress">
                        <div class="health-fill poor" style="width: 58%"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Compact Category Readiness -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-shield-alt me-2"></i>Return Prevention Index
                </div>
                <div class="sidebar-card-body">
                  <div class="readiness-compact">
                    <div class="readiness-score-compact">89%</div>
                    <div class="readiness-brand-compact">Furniture</div>
                    <div class="readiness-label-compact">Return Management Score</div>
                    
                    <div class="readiness-features-compact">
                      <div class="readiness-feature-compact">
                        <i class="fas fa-shield-alt text-success"></i>
                        <p>Stable</p>
                      </div>
                      <div class="readiness-feature-compact">
                        <i class="fas fa-star text-warning"></i>
                        <p>Rating 4.7</p>
                      </div>
                      <div class="readiness-feature-compact">
                        <i class="fas fa-chart-line text-primary"></i>
                        <p>Normal</p>
                      </div>
                    </div>
                    
                    <div class="readiness-progress-compact">
                      <div class="readiness-fill-compact" style="width: 89%"></div>
                    </div>
                    
                    <div class="readiness-status-compact">
                      ✓ Normal Return Level
                    </div>
                  </div>
                </div>
              </div>

              <!-- Distribusi Lokasi -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-map-marker-alt me-2"></i>Return Distribution by Location
                </div>
                <div class="sidebar-card-body">
                  <div class="location-brand-section">
                    <div class="location-brand-header">
                      <h6 class="location-brand-name">Furniture</h6>
                      <span class="location-status-badge top">Top Returns</span>
                    </div>
                    <p class="location-description">Most returns from:</p>
                    <div class="location-tags">
                      <span class="location-tag highlight">Jakarta</span>
                      <span class="location-tag">Surabaya</span>
                      <span class="location-tag">Medan</span>
                      <span class="location-tag">Bandung</span>
                    </div>
                  </div>
                  
                  <div class="location-brand-section">
                    <div class="location-brand-header">
                      <h6 class="location-brand-name">Storage</h6>
                      <span class="location-status-badge rising">Rising</span>
                    </div>
                    <p class="location-description">Popular returns in:</p>
                    <div class="location-tags">
                      <span class="location-tag">Bandung</span>
                      <span class="location-tag highlight">Yogyakarta</span>
                      <span class="location-tag">Malang</span>
                      <span class="location-tag">Denpasar</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- AI Suggestion -->
              <div class="suggestion-card">
                <div class="insight-card-header">
                  <i class="fas fa-robot text-white"></i>
                  <h4 class="mb-0 text-white">AI Suggestion: Return Optimization</h4>
                </div>
                <p class="mb-0" style="font-size: 0.85rem;">"Analysis shows 'furniture defects' increased 45% in the last 3 months. AI Recommendation: Implement quality control + restock strategy for KALLAX series"</p>
              </div>
            </div>
          </div>

          <!-- Enhanced Return Data Table - Full Width Professional with Search & Export -->
          <div class="brand-table-section">
            <div class="chart-header">
              <h5 class="chart-title"><i class="fas fa-table me-2"></i>Recent Customer Returns</h5>
              <div class="d-flex align-items-center gap-2">
                <span style="font-size: 0.8rem; color: #64748b;" id="totalReturnsText">Total: <?php echo count($returns_table_data); ?> returns</span>
              </div>
            </div>
            
            <!-- Table Controls -->
            <div class="table-controls">
              <div class="search-container">
                <input type="text" class="search-input" id="searchInput" placeholder="Search return ID, category, product...">
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
                  <th>No</th>
                  <th>Return ID</th>
                  <th>Product</th>
                  <th>Category</th>
                  <th>Customer</th>
                  <th>Reason</th>
                  <th>Amount</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="returnsTableBody">
                <!-- Data akan diisi oleh JavaScript -->
              </tbody>
            </table>
            
            <!-- No Results Message -->
            <div class="no-results" id="noResults" style="display: none;">
              <i class="fas fa-search"></i>
              <h5>No returns found</h5>
              <p>Try adjusting your search keywords</p>
            </div>
            
            <div class="table-pagination" id="tablePagination">
              <div class="pagination-info" id="paginationInfo">
                Showing 1-4 of <?php echo count($returns_table_data); ?> returns
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
    </div>
  </div>
</div>

<script>
// Data for customer returns visualizations from PHP
const barChartData = {
  2025: {
    categories: <?php echo json_encode($category_data_2025['categories']); ?>,
    returns: <?php echo json_encode($category_data_2025['returns']); ?>,
    insights: {
      "Furniture": "Category Furniture mendominasi customer returns dengan kontribusi 42% dari total returns. Returns tertinggi di Q2 karena program 'Summer Refresh' promotion campaign.",
      "Lighting": "Category Lighting menunjukkan peningkatan return 18% YoY, terutama karena LED compatibility issues yang dilaporkan customer.",
      "Storage": "Storage category mengalami return stabil dengan perbaikan packaging yang menurunkan return rate sebesar 5%.",
      "Bedroom": "Bedroom products menunjukkan return rate rendah dengan kepuasan customer yang tinggi.",
      "Kitchen": "Kitchen category mengalami sedikit peningkatan return karena masalah ukuran dan compatibility."
    }
  },
  2024: {
    categories: <?php echo json_encode($category_data_2024['categories']); ?>,
    returns: <?php echo json_encode($category_data_2024['returns']); ?>,
    insights: {
      "Storage": "Storage category menjadi yang tertinggi di tahun 2024 dengan masalah shipping damage.",
      "Furniture": "Furniture mengalami peningkatan return di paruh kedua tahun 2024.",
      "Lighting": "Lighting category stabil dengan return rate yang dapat diterima.",
      "Bedroom": "Bedroom products menunjukkan kinerja konsisten.",
      "Kitchen": "Kitchen category mulai menunjukkan peningkatan return rate."
    }
  },
  2023: {
    categories: <?php echo json_encode($category_data_2023['categories']); ?>,
    returns: <?php echo json_encode($category_data_2023['returns']); ?>,
    insights: {
      "Lighting": "Lighting category mendominasi return di 2023 karena masalah quality control.",
      "Storage": "Storage mengalami return tinggi karena assembly issues.",
      "Furniture": "Furniture category menunjukkan return rate yang stabil.",
      "Kitchen": "Kitchen products mengalami return karena size issues.",
      "Bedroom": "Bedroom category menunjukkan performance terbaik."
    }
  }
};

// Donut chart data for return distribution
const donutChartData = {
  labels: ["Furniture", "Lighting", "Storage", "Bedroom", "Kitchen", "Others"],
  series: [42, 28, 24, 18, 15, 8], // percentage
  colors: ['#1976d2', '#42a5f5', '#64b5f6', '#90caf9', '#bbdefb', '#e3f2fd']
};

// Line chart data for return trends from PHP
const lineChartData = {
  2025: [
    { name: "Furniture", data: <?php echo json_encode($trend_data_2025['Furniture']); ?> },
    { name: "Lighting", data: <?php echo json_encode($trend_data_2025['Lighting']); ?> },
    { name: "Storage", data: <?php echo json_encode($trend_data_2025['Storage']); ?> },
    { name: "Bedroom", data: <?php echo json_encode($trend_data_2025['Bedroom']); ?> },
    { name: "Kitchen", data: <?php echo json_encode($trend_data_2025['Kitchen']); ?> }
  ],
  2024: [
    { name: "Furniture", data: <?php echo json_encode($trend_data_2024['Furniture']); ?> },
    { name: "Lighting", data: <?php echo json_encode($trend_data_2024['Lighting']); ?> },
    { name: "Storage", data: <?php echo json_encode($trend_data_2024['Storage']); ?> },
    { name: "Bedroom", data: <?php echo json_encode($trend_data_2024['Bedroom']); ?> },
    { name: "Kitchen", data: <?php echo json_encode($trend_data_2024['Kitchen']); ?> }
  ],
  2023: [
    { name: "Furniture", data: <?php echo json_encode($trend_data_2023['Furniture']); ?> },
    { name: "Lighting", data: <?php echo json_encode($trend_data_2023['Lighting']); ?> },
    { name: "Storage", data: <?php echo json_encode($trend_data_2023['Storage']); ?> },
    { name: "Bedroom", data: <?php echo json_encode($trend_data_2023['Bedroom']); ?> },
    { name: "Kitchen", data: <?php echo json_encode($trend_data_2023['Kitchen']); ?> }
  ]
};

// Returns data for table from PHP
const returnsData = <?php echo json_encode($returns_table_data); ?>;

// Pagination and search variables
let currentPage = 1;
let itemsPerPage = 4;
let filteredData = [...returnsData];
let searchQuery = '';

// Initialize charts
let barChart, donutChart, lineChart;
let currentYear = '2025';

// Format number function
function formatNumber(num) {
  if (isNaN(num) || num === null || num === undefined) {
    return "0";
  }
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// Search functionality
function performSearch(query) {
  searchQuery = query.toLowerCase();
  
  if (searchQuery === '') {
    filteredData = [...returnsData];
  } else {
    filteredData = returnsData.filter(returnItem => 
      returnItem.product.toLowerCase().includes(searchQuery) ||
      returnItem.category.toLowerCase().includes(searchQuery) ||
      returnItem.customer.toLowerCase().includes(searchQuery) ||
      returnItem.reason.toLowerCase().includes(searchQuery) ||
      returnItem.id.toLowerCase().includes(searchQuery)
    );
  }
  
  currentPage = 1;
  updateTotalPages();
  renderReturnsTable(currentPage);
  updateTotalReturnsText();
}

// Update total pages based on filtered data
function updateTotalPages() {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  
  document.getElementById('page1Btn').style.display = totalPages >= 1 ? 'inline-block' : 'none';
  document.getElementById('page2Btn').style.display = totalPages >= 2 ? 'inline-block' : 'none';
  document.getElementById('page3Btn').style.display = totalPages >= 3 ? 'inline-block' : 'none';
}

// Update total returns text
function updateTotalReturnsText() {
  const totalText = document.getElementById('totalReturnsText');
  if (searchQuery === '') {
    totalText.textContent = `Total: ${returnsData.length} returns`;
  } else {
    totalText.textContent = `Found: ${filteredData.length} of ${returnsData.length} returns`;
  }
}

// Export to PDF function
function exportToPDF() {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF();
  
  doc.setFontSize(16);
  doc.text('Customer Returns Data - IKEA', 14, 22);
  
  doc.setFontSize(10);
  doc.text(`Exported on: ${new Date().toLocaleDateString('id-ID')}`, 14, 30);
  
  const tableData = filteredData.map((returnItem, index) => [
    index + 1,
    returnItem.id,
    returnItem.product,
    returnItem.category,
    returnItem.customer,
    returnItem.reason,
    returnItem.amount,
    returnItem.status === 'processed' ? 'Processed' : 
    returnItem.status === 'pending' ? 'Pending' : 'Refunded'
  ]);
  
  doc.autoTable({
    head: [['No', 'Return ID', 'Product', 'Category', 'Customer', 'Reason', 'Amount', 'Status']],
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
  
  doc.save('customer-returns-data.pdf');
}

// Export to Excel function
function exportToExcel() {
  const excelData = filteredData.map((returnItem, index) => ({
    'No': index + 1,
    'Return ID': returnItem.id,
    'Product': returnItem.product,
    'Category': returnItem.category,
    'Customer': returnItem.customer,
    'Reason': returnItem.reason,
    'Amount': returnItem.amount,
    'Status': returnItem.status === 'processed' ? 'Processed' : 
              returnItem.status === 'pending' ? 'Pending' : 'Refunded'
  }));
  
  const wb = XLSX.utils.book_new();
  const ws = XLSX.utils.json_to_sheet(excelData);
  
  XLSX.utils.book_append_sheet(wb, ws, 'Customer Returns');
  
  XLSX.writeFile(wb, 'customer-returns-data.xlsx');
}

// Create donut legend
function createDonutLegend() {
  const legendContainer = document.getElementById('donutLegend');
  legendContainer.innerHTML = '';

  donutChartData.labels.forEach((label, index) => {
    const legendItem = document.createElement('div');
    legendItem.className = 'legend-item';
    
    const colorBox = document.createElement('div');
    colorBox.className = 'legend-color';
    colorBox.style.backgroundColor = donutChartData.colors[index];
    
    const labelText = document.createElement('span');
    labelText.textContent = `${label} (${donutChartData.series[index]}%)`;
    
    legendItem.appendChild(colorBox);
    legendItem.appendChild(labelText);
    legendContainer.appendChild(legendItem);
  });
}

// Update bar chart insight
function updateBarChartInsight(category) {
  const insight = barChartData[currentYear].insights[category] || 
                 `Category ${category} shows interesting return patterns worth analyzing.`;

  const insightHTML = `
    <div class="d-flex align-items-center">
      <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
      <div>
        <h5 style="font-size: 0.9rem;">Insight: Return Pattern ${category}</h5>
        <p class="mb-0">${insight}</p>
      </div>
    </div>
  `;

  document.getElementById('barChartInsight').innerHTML = insightHTML;
}

// Update line chart insight
function updateLineChartInsight(category) {
  const insight = `Tren return category ${category} menunjukkan pola musiman dengan puncak di bulan tertentu.`;

  const insightHTML = `
    <div class="d-flex align-items-center">
      <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
      <div>
        <h5 style="font-size: 0.9rem;">Insight: Tren Return ${category}</h5>
        <p class="mb-0">${insight}</p>
      </div>
    </div>
  `;

  document.getElementById('lineChartInsight').innerHTML = insightHTML;
}

// Render Returns Table
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

  pageData.forEach((returnItem, index) => {
    const row = document.createElement('tr');
    
    const statusClass = returnItem.status === 'processed' ? 'status-active' : 
                       returnItem.status === 'pending' ? 'status-trending' : 'status-stable';
    const statusText = returnItem.status === 'processed' ? 'Processed' : 
                      returnItem.status === 'pending' ? 'Pending' : 'Refunded';
    
    const rowNumber = startIndex + index + 1;
    
    row.innerHTML = `
      <td style="color: #374151; font-weight: 600;">${rowNumber}</td>
      <td><span class="brand-id">${returnItem.id}</span></td>
      <td><span class="brand-name">${returnItem.product}</span></td>
      <td><span class="brand-category">${returnItem.category}</span></td>
      <td>${returnItem.customer}</td>
      <td>${returnItem.reason}</td>
      <td><span class="brand-price">${returnItem.amount}</span></td>
      <td><span class="brand-status ${statusClass}">${statusText}</span></td>
    `;
    
    tableBody.appendChild(row);
  });

  const totalItems = filteredData.length;
  const startItem = startIndex + 1;
  const endItem = Math.min(endIndex, totalItems);
  document.getElementById('paginationInfo').textContent = 
    `Showing ${startItem}-${endItem} of ${totalItems} returns`;

  updatePaginationButtons(page);
}

// Update Pagination Buttons
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

// Change Page Function
function changePage(direction) {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  const newPage = currentPage + direction;
  if (newPage >= 1 && newPage <= totalPages) {
    currentPage = newPage;
    renderReturnsTable(currentPage);
  }
}

// Go to Specific Page
function goToPage(page) {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  if (page >= 1 && page <= totalPages) {
    currentPage = page;
    renderReturnsTable(currentPage);
  }
}

// Initialize Bar Chart
function initBarChart(year) {
  const data = barChartData[year];
  currentYear = year;

  const options = {
    series: [{
      data: data.returns
    }],
    chart: {
      type: 'bar',
      height: 250,
      toolbar: {
        show: true
      },
      events: {
        dataPointSelection: function(event, chartContext, config) {
          const category = data.categories[config.dataPointIndex];
          updateBarChartInsight(category);
        }
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
      categories: data.categories,
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

// Initialize Donut Chart
function initDonutChart() {
  const options = {
    series: donutChartData.series,
    chart: {
      type: 'donut',
      height: 200,
    },
    labels: donutChartData.labels,
    colors: donutChartData.colors,
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

// Initialize Line Chart
function initLineChart(year) {
  const data = lineChartData[year];

  const options = {
    series: data,
    chart: {
      height: 250,
      type: 'line',
      zoom: {
        enabled: false
      },
      toolbar: {
        show: true
      },
      events: {
        dataPointSelection: function(event, chartContext, config) {
          const category = data[config.seriesIndex].name;
          updateLineChartInsight(category);
        },
        legendClick: function(chartContext, seriesIndex, config) {
          const category = data[seriesIndex].name;
          updateLineChartInsight(category);
        }
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
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
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

// Event listeners
document.getElementById('barChartYear').addEventListener('change', function() {
  const year = this.value;
  initBarChart(year);
  initLineChart(year);
});

document.getElementById('lineChartYear').addEventListener('change', function() {
  const year = this.value;
  initLineChart(year);
});

document.getElementById('searchInput').addEventListener('input', function() {
  performSearch(this.value);
});

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
  setTimeout(function() {
    document.getElementById('global-loader').style.display = 'none';
  }, 1000);

  initBarChart('2025');
  initDonutChart();
  initLineChart('2025');
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