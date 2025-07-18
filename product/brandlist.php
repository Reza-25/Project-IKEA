
<?php
require_once __DIR__ . '/../include/config.php';

// *** TAMBAHAN: Include AI Helper ***
require_once __DIR__ . '/ai_helper.php';

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ikea";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Fetch brand data for statistics
$brandStatsSql = "SELECT 
    COUNT(*) as total_brands,
    AVG(monthly_sales) as avg_monthly_sales,
    AVG(stock_availability) as avg_stock_availability,
    (SELECT category_name FROM categories_product cp 
     JOIN brand b ON cp.id = b.category_id 
     GROUP BY cp.category_name 
     ORDER BY COUNT(*) DESC LIMIT 1) as dominant_category
    FROM brand WHERE status != 'inactive'";
$brandStatsStmt = $pdo->prepare($brandStatsSql);
$brandStatsStmt->execute();
$brandStats = $brandStatsStmt->fetch(PDO::FETCH_ASSOC);

// Fetch all brand data for table and charts
$brandDataSql = "SELECT b.*, cp.category_name 
                 FROM brand b 
                 LEFT JOIN categories_product cp ON b.category_id = cp.id 
                 ORDER BY b.monthly_sales DESC";
$brandDataStmt = $pdo->prepare($brandDataSql);
$brandDataStmt->execute();
$allBrands = $brandDataStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch top performing stores for sidebar
$topStoresSql = "SELECT b.brand_name, t.nama_toko AS store_name, 
                 bsp.sales_percentage, bsp.monthly_units_sold
                 FROM brand_store_performance bsp
                 JOIN brand b ON bsp.brand_id = b.id
                 JOIN toko t ON bsp.id_toko = t.id_toko
                 WHERE bsp.is_top_location = 1
                 ORDER BY bsp.sales_percentage DESC
                 LIMIT 2";
$topStoresStmt = $pdo->prepare($topStoresSql);
$topStoresStmt->execute();
$topStores = $topStoresStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch brand sales history for line chart
$salesHistorySql = "SELECT b.brand_name, bsh.year, bsh.month, bsh.units_sold
                    FROM brand_sales_history bsh
                    JOIN brand b ON bsh.brand_id = b.id
                    WHERE bsh.year = 2025
                    ORDER BY b.monthly_sales DESC, bsh.month ASC";
$salesHistoryStmt = $pdo->prepare($salesHistorySql);
$salesHistoryStmt->execute();
$salesHistory = $salesHistoryStmt->fetchAll(PDO::FETCH_ASSOC);

// *** TAMBAHAN: Ambil AI Suggestion ***
$aiSuggestion = getLatestAISuggestion();

// Fallback jika tidak ada AI suggestion
if (!$aiSuggestion) {
    $aiSuggestionText = "Berdasarkan data penjualan, kategori " . ($brandStats['dominant_category'] ?? 'Furniture') . " menunjukkan potensi pertumbuhan. Pertimbangkan menambahkan varian baru di koleksi " . ($allBrands[0]['brand_name'] ?? 'Brand Terbaik') . ".";
} else {
    $aiSuggestionText = $aiSuggestion['recommendation'];
}

// Process data for JavaScript
$jsBarData = [];
$jsDonutData = [];
$jsLineData = [];
$totalSales = 0;

// Prepare bar chart data (top 5 brands)
$topBrands = array_slice($allBrands, 0, 5);
foreach ($topBrands as $brand) {
    $jsBarData[] = [
        'brand' => $brand['brand_name'],
        'sales' => (int)($brand['monthly_sales'] / 1000) // Convert to thousands for better display
    ];
    $totalSales += $brand['monthly_sales'];
}

// Prepare donut chart data
foreach ($topBrands as $brand) {
    $percentage = round(($brand['monthly_sales'] / $totalSales) * 100, 1);
    $jsDonutData[] = [
        'label' => $brand['brand_name'],
        'value' => $percentage
    ];
}

// Calculate "Others" percentage
$othersPercentage = 100 - array_sum(array_column($jsDonutData, 'value'));
if ($othersPercentage > 0) {
    $jsDonutData[] = [
        'label' => 'Lainnya',
        'value' => round($othersPercentage, 1)
    ];
}

// Prepare line chart data from sales history
$lineChartBrands = [];
foreach ($salesHistory as $record) {
    $brandName = $record['brand_name'];
    if (!isset($lineChartBrands[$brandName])) {
        $lineChartBrands[$brandName] = array_fill(0, 8, 0); // 8 months
    }
    $monthIndex = (int)$record['month'] - 1;
    if ($monthIndex >= 0 && $monthIndex < 8) {
        $lineChartBrands[$brandName][$monthIndex] = (int)$record['units_sold'];
    }
}

// Convert to JavaScript format
foreach ($lineChartBrands as $brandName => $data) {
    $jsLineData[] = [
        'name' => $brandName,
        'data' => $data
    ];
}

// Prepare brand table data
$jsBrandData = [];
foreach ($allBrands as $index => $brand) {
    $jsBrandData[] = [
        'id' => $brand['brand_code'],
        'brand' => $brand['brand_name'],
        'category' => $brand['category_name'] ?: 'Uncategorized',
        'rating' => (float)$brand['rating'],
        'sales' => (int)$brand['monthly_sales'],
        'price' => 'Rp ' . number_format($brand['average_price'], 0, ',', '.'),
        'status' => $brand['status']
    ];
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
<title>IKEA</title>

<!-- Link CSS - TETAP SAMA -->
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
.health-score.average { color: #d97706; }

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
.health-fill.average { background: #d97706; }

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

/* AI Suggestion Card */
.suggestion-card {
  background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
  color: white;
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 15px;
  transition: all 0.3s ease;
  box-shadow: 0 4px 12px rgba(25, 118, 210, 0.2);
  position: relative;
  overflow: hidden;
}

.suggestion-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 25px rgba(25, 118, 210, 0.3);
}

.suggestion-card::before {
  content: '';
  position: absolute;
  top: -50%;
  right: -50%;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 50%;
  transition: all 0.3s ease;
}

.suggestion-card:hover::before {
  top: -30%;
  right: -30%;
}

.suggestion-header {
  display: flex;
  align-items: center;
  margin-bottom: 15px;
  gap: 10px;
}

.suggestion-icon {
  width: 40px;
  height: 40px;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.2rem;
  flex-shrink: 0;
}

.suggestion-title {
  font-size: 1.1rem;
  font-weight: 700;
  margin: 0;
  line-height: 1.3;
}

.suggestion-content {
  font-size: 0.9rem;
  line-height: 1.6;
  margin: 0;
  opacity: 0.95;
}

.refresh-btn {
  position: absolute;
  top: 15px;
  right: 15px;
  background: rgba(255, 255, 255, 0.2);
  border: none;
  color: white;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
  font-size: 0.9rem;
}

.refresh-btn:hover {
  background: rgba(255, 255, 255, 0.3);
  transform: rotate(180deg);
}

.refresh-btn.loading {
  animation: spin 1s linear infinite;
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
<?php include BASE_PATH . '/include/sidebar.php'; ?>
<!-- /Include sidebar -->

<!-- BAGIAN ATAS -->
<div class="page-wrapper">
  <div class="content">
    <?php include __DIR__ . '/../include/header.php'; ?>
  <div class="page-header">
      <div class="page-title">
        <h4>Product Category list</h4>
        <h6>View/Search product Category</h6>
      </div>
      <div class="page-btn">
        <a href="addcategory.php" class="btn btn-added">
          <img src="../assets/img/icons/plus.svg" class="me-1" alt="img">Add Category
        </a>
      </div>
    </div>

    <!-- Revenue, Suppliers, Product Sold, Budget Spent - TETAP SAMA -->
          <div class="row justify-content-end">
          <!-- 🔢 Total Active Brands -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="#" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das1">
                  <div class="dash-counts">
                    <h4><span class="counters" data-count="<?php echo $brandStats['total_brands']; ?>"><?php echo $brandStats['total_brands']; ?></span></h4>
                    <h5>Total Active Brands</h5>
                    <h2 class="stat-change">+2% from last year</h2>
                    </div>
                    <div class="icon-box bg-ungu">
                      <i class="fa fa-box"></i>
                    </div>
                </div>
              </a>
            </div>

            <!-- 🛒 Avg Monthly Sales per Brand -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="#" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das2">
                  <div class="dash-counts">
                  <h4><span class="counters" data-count="<?php echo round($brandStats['avg_monthly_sales']); ?>"><?php echo number_format($brandStats['avg_monthly_sales'], 0); ?></span></h4>
                   <h5>Avg Month Brand</h5>
                  <h2 class="stat-change">+6.3% from last year</h2>
                </div>
                <div class="icon-box bg-biru">
                  <i class="fa fa-chart-line"></i>
                </div>
                </div>
              </a>
            </div>

             <!-- 📦 Stock Availability -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="#" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das3">
                  <div class="dash-counts">
                  <h4><span class="counters" data-count="<?php echo round($brandStats['avg_stock_availability']); ?>"><?php echo round($brandStats['avg_stock_availability']); ?></span>%</h4> 
                  <h5>Stock Availability</h5>                 
                    <h2 class="stat-change">+15% from last year</h2>
                  </div>
                  <div class="icon-box bg-merah">
                    <i class="fa fa-box-open"></i>
                  </div>
                </div>
              </a>
            </div>

            <!-- 🗂️ Dominant Category -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="#" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das4">
                  <div class="dash-counts">
                     <h4><?php echo $brandStats['dominant_category'] ?: 'Furniture'; ?></h4>
                    <h5>Dominant Category</h5>
                   <h2 class="stat-change">Dominated by <?php echo $allBrands[0]['brand_name']; ?></h2>
                    </div>
                    <div class="icon-box bg-hijau">
                      <i class="fa fa-trophy"></i>
                    </div>
                </div>
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
              <!-- Bar Chart - TETAP SAMA -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chart-bar me-2"></i>Top 5 Brands with Highest Sales</h5>
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
                      <h5 style="font-size: 0.9rem;">Insight: Dominasi Brand <?php echo $allBrands[0]['brand_name']; ?></h5>
                      <p class="mb-0">Brand <?php echo $allBrands[0]['brand_name']; ?> mendominasi penjualan dengan kontribusi <?php echo round(($allBrands[0]['monthly_sales'] / $totalSales) * 100); ?>% dari total revenue. Penjualan tertinggi dengan <?php echo number_format($allBrands[0]['monthly_sales']); ?> unit per bulan.</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Donut Chart - TETAP SAMA -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chart-pie me-2"></i>Brand Contribution to Total Sales</h5>
                </div>
                <div id="donutChart" style="height: 200px;"></div>
                <div class="donut-legend" id="donutLegend"></div>
                <div class="insight-container">
                  <div class="d-flex align-items-center">
                    <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
                    <div>
                      <h5 style="font-size: 0.9rem;">Insight: Distribusi Merata</h5>
                      <p class="mb-0">Top 5 brand menyumbang <?php echo round(array_sum(array_column(array_slice($jsDonutData, 0, 5), 'value'))); ?>% total penjualan. Brand <?php echo $allBrands[1]['brand_name']; ?> menunjukkan peningkatan kontribusi terbesar.</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Line Chart - TETAP SAMA -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chart-line me-2"></i>Brand Growth Trend (Top 5 Brands)</h5>
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
                      <h5 id="lineChartInsightTitle" style="font-size: 0.9rem;">Insight: Tren Brand <?php echo $allBrands[0]['brand_name']; ?></h5>
                      <p class="mb-0" id="lineChartInsightText">Brand <?php echo $allBrands[0]['brand_name']; ?> menunjukkan pertumbuhan stabil dengan rating <?php echo $allBrands[0]['rating']; ?> dan status <?php echo $allBrands[0]['status']; ?>.</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Insight Produk Bersaing - TETAP SAMA SAMPAI AKHIR SECTION -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chess-board me-2"></i>Insight "Produk Bersaing" Antar Brand</h5>
                </div>
                <div class="row">
                  <?php 
                  // Get top competing brands from same categories
                  $competingBrands = [];
                  $categories = [];
                  foreach ($allBrands as $brand) {
                    $cat = $brand['category_name'] ?: 'Uncategorized';
                    if (!isset($categories[$cat])) {
                      $categories[$cat] = [];
                    }
                    $categories[$cat][] = $brand;
                  }
                  
                  $competitionPairs = [];
                  foreach ($categories as $catName => $brands) {
                    if (count($brands) >= 2) {
                      usort($brands, function($a, $b) {
                        return $b['monthly_sales'] - $a['monthly_sales'];
                      });
                      $competitionPairs[] = [
                        'category' => $catName,
                        'brand1' => $brands[0],
                        'brand2' => $brands[1]
                      ];
                    }
                  }
                  
                  // Display top 2 competition pairs
                  for ($i = 0; $i < min(2, count($competitionPairs)); $i++) {
                    $pair = $competitionPairs[$i];
                  ?>
                  <div class="col-md-6 mb-3">
                    <div class="p-3" style="background: linear-gradient(135deg, #f8f9ff 0%, #e8f2ff 100%); border-radius: 10px; border: 1px solid rgba(25, 118, 210, 0.1);">
                      <div class="text-center mb-2">
                        <h6 class="mb-1" style="color: var(--primary-blue); font-weight: 600;"><?php echo $pair['brand1']['brand_name']; ?> vs <?php echo $pair['brand2']['brand_name']; ?></h6>
                        <span style="background: var(--primary-blue); color: white; padding: 2px 8px; border-radius: 10px; font-size: 0.7rem;"><?php echo $pair['category']; ?></span>
                      </div>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="text-center" style="flex: 1;">
                          <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 5px; color: #b8860b;">
                            <i class="fas fa-crown" style="font-size: 0.8rem;"></i>
                          </div>
                          <h6 style="font-size: 0.8rem; margin-bottom: 3px;"><?php echo $pair['brand1']['brand_name']; ?></h6>
                          <small style="font-size: 0.7rem; color: #666;"><?php echo $pair['brand1']['rating']; ?>⭐ | Rp <?php echo number_format($pair['brand1']['average_price']/1000); ?>K | <?php echo number_format($pair['brand1']['monthly_sales']); ?>/bln</small>
                        </div>
                        <div style="margin: 0 10px;">
                          <div style="width: 25px; height: 25px; background: var(--danger-red); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.6rem; font-weight: 700;">VS</div>
                        </div>
                        <div class="text-center" style="flex: 1;">
                          <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #c0c0c0 0%, #e8e8e8 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 5px; color: #666;">
                            <i class="fas fa-medal" style="font-size: 0.8rem;"></i>
                          </div>
                          <h6 style="font-size: 0.8rem; margin-bottom: 3px;"><?php echo $pair['brand2']['brand_name']; ?></h6>
                          <small style="font-size: 0.7rem; color: #666;"><?php echo $pair['brand2']['rating']; ?>⭐ | Rp <?php echo number_format($pair['brand2']['average_price']/1000); ?>K | <?php echo number_format($pair['brand2']['monthly_sales']); ?>/bln</small>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                </div>
                <div class="insight-container">
                  <div class="d-flex align-items-center">
                    <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
                    <div>
                      <h5 style="font-size: 0.9rem;">Insight: Kompetisi Brand</h5>
                      <p class="mb-0">Kompetisi ketat terjadi dalam kategori yang sama. Brand dengan rating tinggi cenderung memiliki harga premium, sementara brand dengan volume penjualan tinggi fokus pada harga kompetitif.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Right Column - Sidebar tetap di samping charts -->
            <div class="col-lg-4">
              <!-- Prediksi Penjualan - TETAP SAMA SAMPAI SEBELUM AI SUGGESTION -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-calculator me-2"></i>Prediksi Penjualan Brand per Bulan
                </div>
                <div class="sidebar-card-body">
                  <div class="d-flex align-items-center mb-2">
                    <div class="bg-light p-2 rounded-circle me-2" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                      <i class="fas fa-chart-line text-primary" style="font-size: 1.2rem;"></i>
                    </div>
                    <div>
                      <h5 class="mb-1" style="font-size: 1rem;"><?php echo $allBrands[0]['brand_name']; ?></h5>
                      <p class="mb-0" style="font-size: 0.85rem;">diprediksi terjual <span class="fw-bold"><?php echo number_format($allBrands[0]['monthly_sales'] * 1.1); ?> unit</span> di Agustus 2025</p>
                    </div>
                    <div class="ms-auto">
                      <span class="trend-indicator trend-up" style="font-size: 1.5rem;">▲</span>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div>
                      <p class="mb-1" style="font-size: 0.8rem;">Akurasi prediksi:</p>
                      <div class="progress" style="height: 6px; width: 100px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 88%" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <span class="fw-bold" style="font-size: 0.8rem;">88%</span>
                    </div>
                    <div>
                      <p class="mb-1" style="font-size: 0.8rem;">Bandingkan dengan:</p>
                      <p class="mb-0 fw-bold" style="font-size: 0.8rem;">Jul 2025: <?php echo number_format($allBrands[0]['monthly_sales']); ?> unit</p>
                      <p class="mb-0 fw-bold" style="font-size: 0.8rem;">Ags 2024: <?php echo number_format($allBrands[0]['monthly_sales'] * 0.9); ?> unit</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Notifikasi Kritis - TETAP SAMA -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-bell me-2"></i>Notifikasi Kritis Otomatis
                </div>
                <div class="sidebar-card-body">
                  <?php
                  // Get notifications from database
                  $notificationsSql = "SELECT bn.*, b.brand_name 
                                      FROM brand_notifications bn 
                                      JOIN brand b ON bn.brand_id = b.id 
                                      WHERE bn.is_read = 0 
                                      ORDER BY bn.created_at DESC 
                                      LIMIT 3";
                  $notificationsStmt = $pdo->prepare($notificationsSql);
                  $notificationsStmt->execute();
                  $notifications = $notificationsStmt->fetchAll(PDO::FETCH_ASSOC);
                  
                  if (empty($notifications)) {
                    // Fallback to sample notifications if none in database
                    $notifications = [
                      ['notification_type' => 'stock_critical', 'brand_name' => $allBrands[0]['brand_name'], 'message' => 'Stok kritis, restock diperlukan segera'],
                      ['notification_type' => 'restock_frequent', 'brand_name' => $allBrands[1]['brand_name'], 'message' => 'Permintaan melonjak dari bulan lalu'],
                      ['notification_type' => 'review_negative', 'brand_name' => $allBrands[2]['brand_name'], 'message' => 'Review negatif meningkat minggu ini']
                    ];
                  }
                  
                  foreach ($notifications as $notification) {
                    $iconClass = '';
                    $colorClass = '';
                    switch ($notification['notification_type']) {
                      case 'stock_critical':
                        $iconClass = 'fas fa-exclamation-triangle';
                        $colorClass = 'warning';
                        break;
                      case 'restock_frequent':
                        $iconClass = 'fas fa-sync-alt';
                        $colorClass = 'danger';
                        break;
                      case 'review_negative':
                        $iconClass = 'fas fa-thumbs-down';
                        $colorClass = 'info';
                        break;
                      default:
                        $iconClass = 'fas fa-bell';
                        $colorClass = 'primary';
                    }
                  ?>
                  <div class="notification-card <?php echo $colorClass; ?>">
                    <i class="<?php echo $iconClass; ?> text-<?php echo $colorClass; ?>"></i>
                    <div>
                      <h5 class="mb-1"><?php echo $notification['brand_name']; ?> - <?php echo ucfirst(str_replace('_', ' ', $notification['notification_type'])); ?></h5>
                      <p class="mb-0"><?php echo $notification['message']; ?></p>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>

              <!-- Health Score - TETAP SAMA -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-heartbeat me-2"></i>Health Score untuk Brand
                </div>
                <div class="sidebar-card-body">
                  <?php
                  // Get health scores from database
                  $healthScoresSql = "SELECT bhs.*, b.brand_name 
                                     FROM brand_health_scores bhs 
                                     JOIN brand b ON bhs.brand_id = b.id 
                                     ORDER BY bhs.health_score DESC 
                                     LIMIT 2";
                  $healthScoresStmt = $pdo->prepare($healthScoresSql);
                  $healthScoresStmt->execute();
                  $healthScores = $healthScoresStmt->fetchAll(PDO::FETCH_ASSOC);
                  
                  if (empty($healthScores)) {
                    // Fallback to calculated health scores
                    $healthScores = [
                      ['brand_name' => $allBrands[0]['brand_name'], 'health_score' => 87, 'stock_score' => 95, 'rating_score' => 94],
                      ['brand_name' => $allBrands[count($allBrands)-1]['brand_name'], 'health_score' => 62, 'stock_score' => 45, 'rating_score' => 68]
                    ];
                  }
                  
                  foreach ($healthScores as $score) {
                    $healthClass = $score['health_score'] >= 80 ? 'good' : ($score['health_score'] >= 60 ? 'average' : 'poor');
                    $description = $score['health_score'] >= 80 ? 
                      'Stok stabil, rating tinggi, performa baik' : 
                      'Perlu perhatian, penjualan menurun';
                  ?>
                  <div class="health-score-item">
                    <div class="health-brand-info">
                      <h6><?php echo $score['brand_name']; ?></h6>
                      <p><?php echo $description; ?></p>
                    </div>
                    <div class="health-score-value">
                      <div class="health-score <?php echo $healthClass; ?>"><?php echo $score['health_score']; ?>/100</div>
                      <div class="health-progress">
                        <div class="health-fill <?php echo $healthClass; ?>" style="width: <?php echo $score['health_score']; ?>%"></div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>

              <!-- Compact Brand Readiness - TETAP SAMA -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-bolt me-2"></i>Brand Readiness Index
                </div>
                <div class="sidebar-card-body">
                  <?php 
                  $readyBrand = $allBrands[0]; // Top brand
                  $readinessScore = min(95, round($readyBrand['stock_availability'] + ($readyBrand['rating'] * 10)));
                  ?>
                  <div class="readiness-compact">
                    <div class="readiness-score-compact"><?php echo $readinessScore; ?>%</div>
                    <div class="readiness-brand-compact"><?php echo $readyBrand['brand_name']; ?></div>
                    <div class="readiness-label-compact">Promo-Ready Score</div>
                    
                    <div class="readiness-features-compact">
                      <div class="readiness-feature-compact">
                        <i class="fas fa-box-open text-success"></i>
                        <p>Stok Tinggi</p>
                      </div>
                      <div class="readiness-feature-compact">
                        <i class="fas fa-star text-warning"></i>
                        <p>Rating <?php echo $readyBrand['rating']; ?></p>
                      </div>
                      <div class="readiness-feature-compact">
                        <i class="fas fa-chart-line text-primary"></i>
                        <p><?php echo ucfirst($readyBrand['status']); ?></p>
                      </div>
                    </div>
                    
                    <div class="readiness-progress-compact">
                      <div class="readiness-fill-compact" style="width: <?php echo $readinessScore; ?>%"></div>
                    </div>
                    
                    <div class="readiness-status-compact">
                      ✓ Siap Promo Flash Sale
                    </div>
                  </div>
                </div>
              </div>

              <!-- Distribusi Lokasi - TETAP SAMA -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-map-marker-alt me-2"></i>Distribusi Lokasi Penjualan Terbanyak
                </div>
                <div class="sidebar-card-body">
                  <?php foreach ($topStores as $index => $store) { ?>
                  <div class="location-brand-section">
                    <div class="location-brand-header">
                      <h6 class="location-brand-name"><?php echo $store['brand_name']; ?></h6>
                      <span class="location-status-badge <?php echo $index === 0 ? 'top' : 'rising'; ?>">
                        <?php echo $index === 0 ? 'Top Seller' : 'Rising Star'; ?>
                      </span>
                    </div>
                    <p class="location-description"><?php echo $index === 0 ? 'Paling banyak terjual di:' : 'Populer di:'; ?></p>
                    <div class="location-tags">
                      <span class="location-tag <?php echo $index === 0 ? 'highlight' : ''; ?>"><?php echo $store['store_name']; ?></span>
                      <span class="location-tag">Jakarta</span>
                      <span class="location-tag">Surabaya</span>
                      <span class="location-tag">Bandung</span>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>

                <!-- AI Suggestion Card -->
                <div class="suggestion-card" id="aiSuggestionCard">
                <button class="refresh-btn" id="refreshAiBtn" onclick="refreshAISuggestion()" title="Refresh AI Suggestion">
                  <i class="fas fa-sync-alt"></i>
                </button>
                <div class="suggestion-header">
                  <div class="suggestion-icon">
                  <i class="fas fa-brain"></i>
                  </div>
                  <h4 class="suggestion-title" id="aiSuggestionTitle">
                  AI Suggestion: Produk Baru yang Potensial
                  </h4>
                </div>
                <p class="suggestion-content" id="aiSuggestionContent">
                  <?php echo htmlspecialchars($aiSuggestionText); ?>
                </p>
                <div class="d-flex justify-content-between align-items-center mt-3">
                  <small style="opacity: 0.8;" id="aiSuggestionMeta">
                  <?php echo $brandStats['dominant_category'] ?: 'General'; ?> • High Priority
                  </small>
                  <small style="opacity: 0.7;" id="aiSuggestionTime">
                  <?php echo date('d M H:i'); ?>
                  </small>
                </div>
                </div>
              </div>
              </div>

          <!-- Enhanced Brand Data Table - Full Width Professional with Search & Export - TETAP SAMA -->
          <div class="brand-table-section">
            <div class="chart-header">
              <h5 class="chart-title"><i class="fas fa-table me-2"></i>Data Brand IKEA</h5>
              <div class="d-flex align-items-center gap-2">
                <span style="font-size: 0.8rem; color: #64748b;" id="totalBrandsText">Total: <?php echo count($allBrands); ?> brands</span>
              </div>
            </div>
            
            <!-- Table Controls -->
            <div class="table-controls">
              <div class="search-container">
                <input type="text" class="search-input" id="searchInput" placeholder="Cari brand, kategori, atau status...">
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
            
            <table class="brand-table" id="brandTable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>ID Brand</th>
                  <th>Brand</th>
                  <th>Kategori</th>
                  <th>Rating</th>
                  <th>Penjualan/Bulan</th>
                  <th>Harga Rata-rata</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="brandTableBody">
                <!-- Data akan diisi oleh JavaScript -->
              </tbody>
            </table>
            
            <!-- No Results Message -->
            <div class="no-results" id="noResults" style="display: none;">
              <i class="fas fa-search"></i>
              <h5>Tidak ada data yang ditemukan</h5>
              <p>Coba ubah kata kunci pencarian Anda</p>
            </div>
            
            <div class="table-pagination" id="tablePagination">
              <div class="pagination-info" id="paginationInfo">
                Menampilkan 1-4 dari <?php echo count($allBrands); ?> brand
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
// *** TAMBAHAN: Fungsi refresh AI suggestion ***
function refreshAISuggestion() {
    const refreshBtn = document.querySelector('.ai-refresh-btn');
    const suggestionText = document.getElementById('aiSuggestionText');
    
    // Show loading state
    refreshBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    refreshBtn.disabled = true;
    
    fetch('refresh_ai_suggestion.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.suggestion) {
            // Update suggestion text
            suggestionText.textContent = '"' + data.suggestion.recommendation + '"';
        } else {
            console.log('No new suggestion available');
        }
    })
    .catch(error => {
        console.error('Error refreshing AI suggestion:', error);
    })
    .finally(() => {
        // Reset button
        refreshBtn.innerHTML = '<i class="fas fa-sync-alt"></i>';
        refreshBtn.disabled = false;
    });
}

// Data dari database PHP - dikonversi ke JavaScript - TETAP SAMA
const barChartData = {
  2025: {
    brands: <?php echo json_encode(array_column($jsBarData, 'brand')); ?>,
    sales: <?php echo json_encode(array_column($jsBarData, 'sales')); ?>,
    insights: {
      <?php foreach ($jsBarData as $item) { ?>
      "<?php echo $item['brand']; ?>": "Brand <?php echo $item['brand']; ?> menunjukkan performa yang solid dengan penjualan <?php echo number_format($item['sales'] * 1000); ?> unit per bulan."<?php if ($item !== end($jsBarData)) echo ','; ?>
      <?php } ?>,
    }
  },
  2024: {
    brands: <?php echo json_encode(array_column($jsBarData, 'brand')); ?>,
    sales: <?php echo json_encode(array_map(function($x) { return $x * 0.9; }, array_column($jsBarData, 'sales'))); ?>,
    insights: {
      <?php foreach ($jsBarData as $item) { ?>
      "<?php echo $item['brand']; ?>": "Brand <?php echo $item['brand']; ?> di tahun 2024 menunjukkan kinerja yang konsisten."<?php if ($item !== end($jsBarData)) echo ','; ?>
      <?php } ?>,
    }
  },
  2023: {
    brands: <?php echo json_encode(array_column($jsBarData, 'brand')); ?>,
    sales: <?php echo json_encode(array_map(function($x) { return $x * 0.8; }, array_column($jsBarData, 'sales'))); ?>,
    insights: {
      <?php foreach ($jsBarData as $item) { ?>
      "<?php echo $item['brand']; ?>": "Brand <?php echo $item['brand']; ?> di tahun 2023 masih dalam tahap pengembangan pasar."<?php if ($item !== end($jsBarData)) echo ','; ?>
      <?php } ?>,
    }
  }
};

// Fallback data jika data dari database kosong
if (!barChartData[2025].brands || barChartData[2025].brands.length === 0) {
  console.warn('Bar chart data is empty, using fallback data');
  window.barChartData = {
    2025: {
      brands: ["LACK", "SKÅDIS", "HEMNES", "KALLAX", "VITTSJÖ"],
      sales: [385, 315, 280, 265, 240],
      insights: {
        "LACK": "Brand LACK menunjukkan performa yang solid dengan penjualan 385.000 unit per bulan.",
        "SKÅDIS": "Brand SKÅDIS menunjukkan performa yang solid dengan penjualan 315.000 unit per bulan.",
        "HEMNES": "Brand HEMNES menunjukkan performa yang solid dengan penjualan 280.000 unit per bulan.",
        "KALLAX": "Brand KALLAX menunjukkan performa yang solid dengan penjualan 265.000 unit per bulan.",
        "VITTSJÖ": "Brand VITTSJÖ menunjukkan performa yang solid dengan penjualan 240.000 unit per bulan."
      }
    },
    2024: {
      brands: ["LACK", "SKÅDIS", "HEMNES", "KALLAX", "VITTSJÖ"],
      sales: [347, 284, 252, 239, 216],
      insights: {
        "LACK": "Brand LACK di tahun 2024 menunjukkan kinerja yang konsisten.",
        "SKÅDIS": "Brand SKÅDIS di tahun 2024 menunjukkan kinerja yang konsisten.",
        "HEMNES": "Brand HEMNES di tahun 2024 menunjukkan kinerja yang konsisten.",
        "KALLAX": "Brand KALLAX di tahun 2024 menunjukkan kinerja yang konsisten.",
        "VITTSJÖ": "Brand VITTSJÖ di tahun 2024 menunjukkan kinerja yang konsisten."
      }
    },
    2023: {
      brands: ["LACK", "SKÅDIS", "HEMNES", "KALLAX", "VITTSJÖ"],
      sales: [308, 252, 224, 212, 192],
      insights: {
        "LACK": "Brand LACK di tahun 2023 masih dalam tahap pengembangan pasar.",
        "SKÅDIS": "Brand SKÅDIS di tahun 2023 masih dalam tahap pengembangan pasar.",
        "HEMNES": "Brand HEMNES di tahun 2023 masih dalam tahap pengembangan pasar.",
        "KALLAX": "Brand KALLAX di tahun 2023 masih dalam tahap pengembangan pasar.",
        "VITTSJÖ": "Brand VITTSJÖ di tahun 2023 masih dalam tahap pengembangan pasar."
      }
    }
  };
} else {
  window.barChartData = barChartData;
}

// Donut Chart Data dari database
const donutChartData = {
  labels: <?php echo json_encode(array_column($jsDonutData, 'label')); ?>,
  series: <?php echo json_encode(array_column($jsDonutData, 'value')); ?>,
  colors: ['#1976d2', '#42a5f5', '#64b5f6', '#90caf9', '#bbdefb', '#e3f2fd']
};

// Fallback data jika data dari database kosong
if (!donutChartData.labels || donutChartData.labels.length === 0) {
  console.warn('Donut chart data is empty, using fallback data');
  window.donutChartData = {
    labels: ["LACK", "SKÅDIS", "HEMNES", "KALLAX", "VITTSJÖ", "Lainnya"],
    series: [28, 22, 18, 15, 12, 5],
    colors: ['#1976d2', '#42a5f5', '#64b5f6', '#90caf9', '#bbdefb', '#e3f2fd']
  };
} else {
  window.donutChartData = donutChartData;
}

// Line Chart Data dari database
const lineChartData = {
  2025: <?php echo json_encode($jsLineData); ?>,
  2024: <?php echo json_encode(array_map(function($item) { 
    return ['name' => $item['name'], 'data' => array_map(function($x) { return $x * 0.9; }, $item['data'])]; 
  }, $jsLineData)); ?>,
  2023: <?php echo json_encode(array_map(function($item) { 
    return ['name' => $item['name'], 'data' => array_map(function($x) { return $x * 0.8; }, $item['data'])]; 
  }, $jsLineData)); ?>
};

// Fallback data jika data dari database kosong
if (!lineChartData[2025] || lineChartData[2025].length === 0) {
  console.warn('Line chart data is empty, using fallback data');
  window.lineChartData = {
    2025: [
      { name: "LACK", data: [320, 350, 380, 410, 440, 420, 450, 480] },
      { name: "SKÅDIS", data: [220, 240, 260, 290, 310, 330, 350, 380] },
      { name: "HEMNES", data: [280, 290, 310, 300, 320, 330, 340, 350] },
      { name: "KALLAX", data: [260, 250, 270, 280, 290, 300, 310, 320] },
      { name: "VITTSJÖ", data: [190, 200, 210, 220, 230, 240, 250, 260] }
    ],
    2024: [
      { name: "LACK", data: [288, 315, 342, 369, 396, 378, 405, 432] },
      { name: "SKÅDIS", data: [198, 216, 234, 261, 279, 297, 315, 342] },
      { name: "HEMNES", data: [252, 261, 279, 270, 288, 297, 306, 315] },
      { name: "KALLAX", data: [234, 225, 243, 252, 261, 270, 279, 288] },
      { name: "VITTSJÖ", data: [171, 180, 189, 198, 207, 216, 225, 234] }
    ],
    2023: [
      { name: "LACK", data: [256, 280, 304, 328, 352, 336, 360, 384] },
      { name: "SKÅDIS", data: [176, 192, 208, 232, 248, 264, 280, 304] },
      { name: "HEMNES", data: [224, 232, 248, 240, 256, 264, 272, 280] },
      { name: "KALLAX", data: [208, 200, 216, 224, 232, 240, 248, 256] },
      { name: "VITTSJÖ", data: [152, 160, 168, 176, 184, 192, 200, 208] }
    ]
  };
} else {
  window.lineChartData = lineChartData;
}

// Brand Data untuk tabel dari database
const brandData = <?php echo json_encode($jsBrandData); ?>;

// Debug: log semua data untuk memastikan ada data
console.log('=== DEBUG DATA ===');
console.log('Bar Chart Data:', barChartData);
console.log('Donut Chart Data:', donutChartData);
console.log('Line Chart Data:', lineChartData);
console.log('Brand Data:', brandData);
console.log('=== END DEBUG ===');

// Jika data kosong, gunakan fallback data
if (!brandData || brandData.length === 0) {
  console.warn('Brand data is empty, using fallback data');
  window.brandData = [
    { id: "BRD001", brand: "LACK", category: "Furniture", rating: 4.5, sales: 1850, price: "Rp 199.000", status: "active" },
    { id: "BRD002", brand: "SKÅDIS", category: "Organizer", rating: 4.6, sales: 1240, price: "Rp 299.000", status: "trending" },
    { id: "BRD003", brand: "HEMNES", category: "Furniture", rating: 4.7, sales: 1420, price: "Rp 599.000", status: "active" },
    { id: "BRD004", brand: "KALLAX", category: "Storage", rating: 4.4, sales: 1180, price: "Rp 399.000", status: "stable" },
    { id: "BRD005", brand: "VITTSJÖ", category: "Furniture", rating: 4.2, sales: 980, price: "Rp 449.000", status: "stable" }
  ];
} else {
  window.brandData = brandData;
}

// Pagination and search variables
let currentPage = 1;
let itemsPerPage = 4;
let filteredData = [...window.brandData];
let searchQuery = '';

// Inisialisasi chart
let barChart, donutChart, lineChart;
let currentYear = '2025';

// Fungsi untuk memformat angka
function formatNumber(num) {
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// Search functionality
function performSearch(query) {
  searchQuery = query.toLowerCase();
  
  if (searchQuery === '') {
    filteredData = [...window.brandData];
  } else {
    filteredData = window.brandData.filter(brand => 
      brand.brand.toLowerCase().includes(searchQuery) ||
      brand.category.toLowerCase().includes(searchQuery) ||
      brand.status.toLowerCase().includes(searchQuery) ||
      brand.id.toLowerCase().includes(searchQuery)
    );
  }
  
  currentPage = 1;
  updateTotalPages();
  renderBrandTable(currentPage);
  updateTotalBrandsText();
}

// Update total pages based on filtered data
function updateTotalPages() {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  
  // Show/hide pagination buttons based on total pages
  document.getElementById('page1Btn').style.display = totalPages >= 1 ? 'inline-block' : 'none';
  document.getElementById('page2Btn').style.display = totalPages >= 2 ? 'inline-block' : 'none';
  document.getElementById('page3Btn').style.display = totalPages >= 3 ? 'inline-block' : 'none';
}

// Update total brands text
function updateTotalBrandsText() {
  const totalText = document.getElementById('totalBrandsText');
  if (searchQuery === '') {
    totalText.textContent = `Total: ${window.brandData.length} brands`;
  } else {
    totalText.textContent = `Ditemukan: ${filteredData.length} dari ${window.brandData.length} brands`;
  }
}

// Export to PDF function
function exportToPDF() {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF();
  
  // Add title
  doc.setFontSize(16);
  doc.text('Data Brand IKEA', 14, 22);
  
  // Add export date
  doc.setFontSize(10);
  doc.text(`Exported on: ${new Date().toLocaleDateString('id-ID')}`, 14, 30);
  
  // Prepare table data
  const tableData = filteredData.map((brand, index) => [
    index + 1,
    brand.id,
    brand.brand,
    brand.category,
    brand.rating.toString(),
    brand.sales.toLocaleString(),
    brand.price,
    brand.status === 'active' ? 'Aktif' : 
    brand.status === 'trending' ? 'Trending' : 'Stabil'
  ]);
  
  // Add table
  doc.autoTable({
    head: [['No', 'ID Brand', 'Brand', 'Kategori', 'Rating', 'Penjualan/Bulan', 'Harga Rata-rata', 'Status']],
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
  
  // Save the PDF
  doc.save('data-brand-ikea.pdf');
}

// Export to Excel function
function exportToExcel() {
  // Prepare data for Excel
  const excelData = filteredData.map((brand, index) => ({
    'No': index + 1,
    'ID Brand': brand.id,
    'Brand': brand.brand,
    'Kategori': brand.category,
    'Rating': brand.rating,
    'Penjualan/Bulan': brand.sales,
    'Harga Rata-rata': brand.price,
    'Status': brand.status === 'active' ? 'Aktif' : 
              brand.status === 'trending' ? 'Trending' : 'Stabil'
  }));
  
  // Create workbook and worksheet
  const wb = XLSX.utils.book_new();
  const ws = XLSX.utils.json_to_sheet(excelData);
  
  // Add worksheet to workbook
  XLSX.utils.book_append_sheet(wb, ws, 'Data Brand IKEA');
  
  // Save the Excel file
  XLSX.writeFile(wb, 'data-brand-ikea.xlsx');
}

// Membuat custom legend untuk donut chart
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

// Update insight untuk bar chart
function updateBarChartInsight(brand) {
  const insight = barChartData[currentYear].insights[brand] || 
                 `Brand ${brand} menunjukkan kinerja yang solid dengan kontribusi signifikan terhadap total penjualan.`;

  const insightHTML = `
    <div class="d-flex align-items-center">
      <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
      <div>
        <h5 style="font-size: 0.9rem;">Insight: Brand ${brand}</h5>
        <p class="mb-0">${insight}</p>
      </div>
    </div>
  `;

  document.getElementById('barChartInsight').innerHTML = insightHTML;
}

// Update insight untuk line chart
function updateLineChartInsight(brand) {
  const insight = `Tren penjualan brand ${brand} menunjukkan pola yang menarik dengan fluktuasi musiman berdasarkan data historis.`;

  const insightHTML = `
    <div class="d-flex align-items-center">
      <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
      <div>
        <h5 style="font-size: 0.9rem;">Insight: Tren Brand ${brand}</h5>
        <p class="mb-0">${insight}</p>
      </div>
    </div>
  `;

  document.getElementById('lineChartInsight').innerHTML = insightHTML;
}

// Render Brand Table with Row Numbers and IDs
function renderBrandTable(page = 1) {
  const startIndex = (page - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  const pageData = filteredData.slice(startIndex, endIndex);

  const tableBody = document.getElementById('brandTableBody');
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

  pageData.forEach((brand, index) => {
    const row = document.createElement('tr');
    
    const statusClass = brand.status === 'active' ? 'status-active' : 
                       brand.status === 'trending' ? 'status-trending' : 'status-stable';
    const statusText = brand.status === 'active' ? 'Aktif' : 
                      brand.status === 'trending' ? 'Trending' : 'Stabil';
    
    const rowNumber = startIndex + index + 1;
    
    row.innerHTML = `
      <td style="color: #374151; font-weight: 600;">${rowNumber}</td>
      <td><span class="brand-id">${brand.id}</span></td>
      <td><span class="brand-name">${brand.brand}</span></td>
      <td><span class="brand-category">${brand.category}</span></td>
      <td>
        <div class="brand-rating">
          <span class="stars">★</span>
          <span class="brand-rating-value">${brand.rating}</span>
        </div>
      </td>
      <td><span class="brand-sales">${brand.sales.toLocaleString()}</span></td>
      <td><span class="brand-price">${brand.price}</span></td>
      <td><span class="brand-status ${statusClass}">${statusText}</span></td>
    `;
    
    tableBody.appendChild(row);
  });

  // Update pagination info
  const totalItems = filteredData.length;
  const startItem = startIndex + 1;
  const endItem = Math.min(endIndex, totalItems);
  document.getElementById('paginationInfo').textContent = 
    `Menampilkan ${startItem}-${endItem} dari ${totalItems} brand`;

  // Update pagination buttons
  updatePaginationButtons(page);
}

// Update Pagination Buttons
function updatePaginationButtons(page) {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  
  document.getElementById('prevBtn').disabled = page === 1;
  document.getElementById('nextBtn').disabled = page === totalPages;

  // Update page buttons
  document.getElementById('page1Btn').classList.toggle('active', page === 1);
  document.getElementById('page2Btn').classList.toggle('active', page === 2);
  document.getElementById('page3Btn').classList.toggle('active', page === 3);
  
  // Hide/show page buttons based on total pages
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
    renderBrandTable(currentPage);
  }
}

// Go to Specific Page
function goToPage(page) {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  if (page >= 1 && page <= totalPages) {
    currentPage = page;
    renderBrandTable(currentPage);
  }
}

// Inisialisasi Bar Chart
function initBarChart(year) {
  const data = window.barChartData[year];
  currentYear = year;

  // Debug: log data untuk memastikan ada data
  console.log('Bar Chart Data for year', year, ':', data);

  if (!data || !data.brands || !data.sales) {
    console.error('Bar chart data is missing or incomplete for year:', year);
    return;
  }

  const options = {
    series: [{
      name: 'Penjualan (dalam ribuan)',
      data: data.sales
    }],
    chart: {
      type: 'bar',
      height: 250,
      toolbar: {
        show: true
      },
      events: {
        dataPointSelection: function(event, chartContext, config) {
          const brand = data.brands[config.dataPointIndex];
          updateBarChartInsight(brand);
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
      categories: data.brands,
    },
    yaxis: {
      title: {
        text: 'Penjualan (ribuan)'
      },
      labels: {
        formatter: function(val) {
          return formatNumber(val);
        }
      }
    },
    tooltip: {
      y: {
        formatter: function(val) {
          return formatNumber(val) + ' unit';
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

// Inisialisasi Donut Chart
function initDonutChart() {
  // Debug: log data untuk memastikan ada data
  console.log('Donut Chart Data:', window.donutChartData);

  if (!window.donutChartData || !window.donutChartData.series || !window.donutChartData.labels) {
    console.error('Donut chart data is missing or incomplete');
    return;
  }

  const options = {
    series: window.donutChartData.series,
    chart: {
      type: 'donut',
      height: 200,
    },
    labels: window.donutChartData.labels,
    colors: window.donutChartData.colors,
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

  // Buat custom legend setelah chart di-render
  createDonutLegend();
}

// Inisialisasi Line Chart
function initLineChart(year) {
  const data = window.lineChartData[year];

  // Debug: log data untuk memastikan ada data
  console.log('Line Chart Data for year', year, ':', data);

  if (!data || data.length === 0) {
    console.error('Line chart data is missing or incomplete for year:', year);
    return;
  }

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
          const brand = data[config.seriesIndex].name;
          updateLineChartInsight(brand);
        },
        legendClick: function(chartContext, seriesIndex, config) {
          const brand = data[seriesIndex].name;
          updateLineChartInsight(brand);
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
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags'],
    },
    yaxis: {
      title: {
        text: 'Penjualan (unit)'
      }
    },
    tooltip: {
      y: {
        formatter: function(val) {
          return val + ' unit';
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

// Search input event listener
document.getElementById('searchInput').addEventListener('input', function() {
  performSearch(this.value);
});

// Inisialisasi saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
  // Hide loader
  setTimeout(function() {
    document.getElementById('global-loader').style.display = 'none';
  }, 1000);

  initBarChart('2025');
  initDonutChart();
  initLineChart('2025');
  renderBrandTable(1);
  updateTotalBrandsText();
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
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
