<?php
require_once __DIR__ . '/../include/config.php';

// *** TAMBAHAN: Include AI Helper untuk Category ***
require_once __DIR__ . '/ai_helper_category.php';

// Koneksi database
$db = new mysqli('localhost', 'root', '','ikea');
if ($db->connect_error) {
    die("Koneksi database gagal: " . $db->connect_error);
}

// *** TAMBAHAN: Get AI Insight ***
$aiInsight = getCategoryAIInsight();
$aiData = $aiInsight['data'];

// *** TAMBAHAN: Extract solutions dari AI recommendation ***
function extractCategorySolutions($recommendation) {
    $solutions = [];
    $text = strtolower($recommendation);
    
    if (strpos($text, 'ekspansi') !== false || strpos($text, 'expansion') !== false) {
        $solutions = [
            "Riset pasar untuk kategori baru dalam 2 minggu",
            "Buat roadmap ekspansi produk untuk Q4 2025",
            "Analisis kompetitor di segmen premium selama 1 bulan"
        ];
    } elseif (strpos($text, 'optimasi') !== false || strpos($text, 'optimization') !== false) {
        $solutions = [
            "Audit performa kategori existing dalam 1 minggu",
            "Implementasi strategi cross-selling antar kategori",
            "Review dan update deskripsi kategori untuk SEO"
        ];
    } elseif (strpos($text, 'marketing') !== false || strpos($text, 'promosi') !== false) {
        $solutions = [
            "Buat campaign khusus untuk kategori underperform",
            "Tingkatkan visibility kategori di homepage",
            "Jalankan A/B test untuk kategori layout baru"
        ];
    } else {
        // Default solutions
        $categoryName = $aiData['category_name'] ?? 'kategori';
        $solutions = [
            "Analisis mendalam performa {$categoryName} dalam 1 minggu",
            "Buat action plan spesifik untuk optimasi {$categoryName}",
            "Monitor KPI {$categoryName} secara real-time selama 30 hari"
        ];
    }
    
    return $solutions;
}

$aiSolutions = extractCategorySolutions($aiData['recommendation']);

// Query untuk stat cards
$totalCategories = $db->query("SELECT COUNT(*) as total FROM categories_product")->fetch_assoc()['total'];
$totalProductsResult = $db->query("SELECT SUM(units_sold) as total FROM category_performance_metrics")->fetch_assoc();
$totalProducts = $totalProductsResult['total'] ?? 5000; // Fallback jika null
$topCategory = $db->query("
    SELECT c.category_name, p.units_sold 
    FROM categories_product c
    JOIN category_performance_metrics p ON c.id = p.category_id
    ORDER BY p.units_sold DESC 
    LIMIT 1
")->fetch_assoc();

// Fallback jika top category kosong
if (!$topCategory) {
    $topCategory = ['category_name' => 'Furniture', 'units_sold' => 1200];
}

// Query untuk data chart
$barChartData = [];
$years = [2023, 2024, 2025];
foreach ($years as $year) {
    $result = $db->query("
        SELECT c.category_name, s.monthly_total
        FROM category_sales_trends s
        JOIN categories_product c ON s.category_id = c.id
        WHERE s.year = $year AND s.month = 7
        ORDER BY s.monthly_total DESC
        LIMIT 5
    ");
    
    $categories = [];
    $totals = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row['category_name'];
        $totals[] = (int)$row['monthly_total'];
    }
    
    // Fallback data jika database kosong
    if (empty($categories)) {
        $categories = ['Furniture', 'Storage', 'Lighting', 'Textiles', 'Kitchen'];
        $totals = [1200, 950, 800, 650, 500];
    }
    
    $barChartData[$year] = [
        'categories' => $categories,
        'counts' => $totals
    ];
}

// Query untuk donut chart
$donutData = $db->query("
    SELECT c.category_name, p.units_sold
    FROM category_performance_metrics p
    JOIN categories_product c ON p.category_id = c.id
    ORDER BY p.units_sold DESC
    LIMIT 5
");

$top5Categories = [];
$top5Counts = [];
while ($row = $donutData->fetch_assoc()) {
    $top5Categories[] = $row['category_name'];
    $top5Counts[] = (int)$row['units_sold'];
}

// Fallback data jika database kosong
if (empty($top5Categories)) {
    $top5Categories = ['Furniture', 'Storage', 'Lighting', 'Textiles', 'Kitchen'];
    $top5Counts = [1200, 950, 800, 650, 500];
}

$totalUnits = array_sum($top5Counts);
$otherProducts = $totalProducts - $totalUnits;

// Pastikan otherProducts tidak negatif
if ($otherProducts < 0) {
    $otherProducts = 300;
}

// Query untuk line chart
$lineChartData = [];
foreach ($years as $year) {
    $result = $db->query("
        SELECT c.category_name, s.weekly_sales
        FROM category_sales_trends s
        JOIN categories_product c ON s.category_id = c.id
        WHERE s.year = $year
        ORDER BY s.monthly_total DESC
        LIMIT 5
    ");
    
    $series = [];
    while ($row = $result->fetch_assoc()) {
        $weeklySales = [];
        if ($row['weekly_sales'] !== null) {
            $decoded = json_decode($row['weekly_sales'], true);
            $weeklySales = is_array($decoded) ? $decoded : [];
        }
        
        // Pastikan ada 8 data mingguan
        if (count($weeklySales) < 8) {
            $weeklySales = array_pad($weeklySales, 8, 0);
        }
        
        $series[] = [
            'name' => $row['category_name'],
            'data' => $weeklySales
        ];
    }
    
    // Fallback data jika database kosong
    if (empty($series)) {
        $series = [
            ['name' => 'Furniture', 'data' => [100, 120, 115, 130, 125, 140, 135, 150]],
            ['name' => 'Storage', 'data' => [80, 85, 90, 95, 100, 105, 110, 115]],
            ['name' => 'Lighting', 'data' => [60, 65, 70, 75, 80, 85, 90, 95]],
            ['name' => 'Textiles', 'data' => [50, 55, 60, 65, 70, 75, 80, 85]],
            ['name' => 'Kitchen', 'data' => [40, 45, 50, 55, 60, 65, 70, 75]]
        ];
    }
    
    $lineChartData[$year] = $series;
}

// Query untuk sidebar
$prediction = $db->query("
    SELECT c.category_name, p.units_sold
    FROM category_performance_metrics p
    JOIN categories_product c ON p.category_id = c.id
    ORDER BY p.units_sold DESC
    LIMIT 1
")->fetch_assoc();

$notifications = [
    'warning' => $db->query("
        SELECT c.category_name, p.units_sold
        FROM category_performance_metrics p
        JOIN categories_product c ON p.category_id = c.id
        WHERE p.units_sold < 400
        ORDER BY p.units_sold ASC
        LIMIT 1
    ")->fetch_assoc(),
    
    'info' => $db->query("
        SELECT c.category_name, p.growth_rate
        FROM category_performance_metrics p
        JOIN categories_product c ON p.category_id = c.id
        WHERE p.growth_rate > 20
        ORDER BY p.growth_rate DESC
        LIMIT 1
    ")->fetch_assoc(),
    
    'danger' => $db->query("
        SELECT category_name 
        FROM categories_product 
        WHERE status = 'Pending'
        LIMIT 1
    ")->fetch_assoc()
];

$performance = $db->query("
    SELECT c.category_name, p.units_sold, p.profit_margin
    FROM category_performance_metrics p
    JOIN categories_product c ON p.category_id = c.id
    ORDER BY p.units_sold DESC
    LIMIT 3
");

$popularCategories = $db->query("
    SELECT c.category_name, p.units_sold, p.market_share
    FROM category_performance_metrics p
    JOIN categories_product c ON p.category_id = c.id
    ORDER BY p.market_share DESC
    LIMIT 3
");

// Query untuk tabel utama
$categoryTableResult = $db->query("
    SELECT 
        c.id,
        c.category_code,
        c.category_name,
        c.description,
        p.units_sold as product_count,
        DATE_FORMAT(c.created_date, '%d %b %Y') as created_date,
        c.created_by,
        c.status,
        p.profit_margin as popularity_index
    FROM categories_product c
    JOIN category_performance_metrics p ON c.id = p.category_id
    ORDER BY c.id
");

// Simpan hasil query ke array
$categoryTableData = [];
while ($row = $categoryTableResult->fetch_assoc()) {
    $categoryTableData[] = $row;
}

$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>RuanGku</title>

<link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg">
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/animate.css">
<link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!-- Export Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<style>
body {
  background-color: #f8f9fa;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

a {
  text-decoration: none !important;
}

.ikea-select {
  background-color: #E6F0FF !important;
  border: 2px solid #ccc;
  color: #333;
  border-radius: 20px;
  padding: 6px 16px;
  font-size: 0.85rem;
  appearance: none;
  width: 140px;
  background-image: url("data:image/svg+xml,%3Csvg fill='%230051BA' height='20' viewBox='0 0 24 24' width='20' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 0.6rem center;
  background-size: 14px;
  transition: border-color 0.3s ease;
}

.ikea-select:hover { border-color: #0051BA; }
.ikea-select:focus {
  outline: none;
  border-color: #0051BA;
  box-shadow: 0 0 0 3px rgba(230, 240, 255, 0.8);
}

/* Stats Cards */
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
  background: rgba(40, 167, 69, 0.1);
  color: #28a745;
  display: inline-block;
  padding: 3px 6px;
  border-radius: 12px;
  font-weight: 600;
}

.dash-imgs i {
  font-size: 32px;
}

.das1 { border-top: 6px solid #1a5ea7; }
.das1 * { color: #1a5ea7 !important; }
.das2 { border-top: 6px solid #751e8d; }
.das2 * { color: #751e8d !important; }
.das3 { border-top: 6px solid #e78001; }
.das3 * { color: #e78001 !important; }
.das4 { border-top: 6px solid #018679; }
.das4 * { color: #018679 !important; }

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

.icon-box:hover {
  box-shadow: 0 4px 12px rgba(0,0,0,0.18);
  transform: scale(1.08);
}

.bg-ungu { background: linear-gradient(135deg, #2196f3 0%, #0d47a1 100%); }
.bg-biru { background: linear-gradient(135deg, #a259c6 0%, #6d28d9 100%); }
.bg-hijau { background: linear-gradient(135deg,rgb(89, 236, 222) 0%, #018679 100%); }
.bg-merah { background: linear-gradient(135deg, #ff5858 0%, #e78001 100%); }

/* Chart Section */
.chart-section {
  background: white;
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
  color: #1976d2;
  margin: 0;
}

.chart-select {
  border: 1px solid #e0e0e0;
  border-radius: 6px;
  padding: 6px 12px;
  background: white;
  font-size: 0.9rem;
  color: #333;
}

.chart-select:focus {
  outline: none;
  border-color: #1976d2;
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
  color: #1976d2 !important;
  font-weight: 600;
}

.insight-container p {
  color: #4a5568;
  line-height: 1.5;
}

/* Sidebar Cards */
.sidebar-card {
  background: white;
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
  background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
  color: white;
  padding: 12px 15px;
  font-weight: 600;
  font-size: 0.9rem;
}

.sidebar-card-body {
  padding: 15px;
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

/* Table Styling */
.category-table-section {
  background: white;
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 25px;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
  transition: all 0.3s ease;
}

.category-table-section:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
}

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
  border-color: #1976d2;
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

.category-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 15px;
}

.category-table th {
  background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
  color: #ffffff;
  font-weight: 600;
  font-size: 0.85rem;
  padding: 12px 10px;
  text-align: left;
  border-bottom: 2px solid #1565c0;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.category-table th:first-child {
  border-top-left-radius: 8px;
}

.category-table th:last-child {
  border-top-right-radius: 8px;
}

.category-table td {
  padding: 12px 10px;
  border-bottom: 1px solid #f1f5f9;
  font-size: 0.85rem;
  color: #374151;
  vertical-align: middle;
}

.category-table tbody tr:hover {
  background-color: #f8fafc;
  transition: all 0.2s ease;
}

.category-name {
  font-weight: 600;
  color: #1e293b;
}

.category-id {
  background: #f1f5f9;
  color: #475569;
  padding: 4px 8px;
  border-radius: 6px;
  font-size: 0.75rem;
  font-weight: 500;
  display: inline-block;
  font-family: 'Courier New', monospace;
}

.category-status {
  padding: 4px 8px;
  border-radius: 12px;
  font-size: 0.7rem;
  font-weight: 600;
  text-align: center;
}

.status-active { background: #d1fae5; color: #065f46; }
.status-inactive { background: #f8d7da; color: #721c24; }
.status-pending { background: #fff3cd; color: #856404; }
.status-ordered { background: #cce5ff; color: #004085; }

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
  border-top: 4px solid #1976d2;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* AI Suggestion Card - SAMA SEPERTI BRANDLIST */
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

/* AI Solutions Card - SAMA SEPERTI BRANDLIST */
.ai-solutions-card {
  background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
  border: 2px solid #e2e8f0;
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 15px;
  transition: all 0.3s ease;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  position: relative;
  overflow: hidden;
}

.ai-solutions-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
  border-color: #1976d2;
}

.ai-solutions-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #1976d2 0%, #42a5f5 100%);
}

.solutions-header {
  display: flex;
  align-items: center;
  margin-bottom: 15px;
  gap: 10px;
  position: relative;
}

.solutions-icon {
  width: 35px;
  height: 35px;
  background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1rem;
  color: white;
  flex-shrink: 0;
  box-shadow: 0 2px 8px rgba(251, 191, 36, 0.3);
}

.solutions-title {
  font-size: 1rem;
  font-weight: 700;
  margin: 0;
  color: #1e293b;
  line-height: 1.3;
}

.solutions-tooltip {
  position: absolute;
  right: 0;
  top: 0;
  background: rgba(59, 130, 246, 0.1);
  color: #1976d2;
  padding: 4px 8px;
  border-radius: 12px;
  font-size: 0.7rem;
  font-weight: 600;
}

.solutions-body {
  margin-bottom: 15px;
}

.solution-item-card {
  display: flex;
  align-items: flex-start;
  margin-bottom: 12px;
  padding: 12px;
  background: white;
  border-radius: 8px;
  transition: all 0.2s ease;
  border: 1px solid #f1f5f9;
}

.solution-item-card:hover {
  background: #f8fafc;
  border-color: #e2e8f0;
  transform: translateX(5px);
}

.solution-item-card:last-child {
  margin-bottom: 0;
}

.solution-number {
  background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
  color: white;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.8rem;
  font-weight: 700;
  margin-right: 12px;
  flex-shrink: 0;
  box-shadow: 0 2px 6px rgba(25, 118, 210, 0.3);
}

.solution-text {
  font-size: 0.85rem;
  line-height: 1.5;
  color: #374151;
  font-weight: 500;
}

.solutions-footer {
  text-align: center;
  padding-top: 10px;
  border-top: 1px solid #e2e8f0;
}

.solutions-footer small {
  color: #64748b;
  font-size: 0.75rem;
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
}
</style>
</head>

<body>
<div id="global-loader">
  <div class="whirly-loader"></div>
</div>

<div class="main-wrapper">
  <?php include BASE_PATH . '/include/sidebar.php'; ?>
  
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

<!-- Stat Cards -->
<div class="row justify-content-end">
    <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <a href="#" class="w-100 text-decoration-none text-dark">
            <div class="dash-count das1">
                <div class="dash-counts">
                    <h4><span class="counters" data-count="<?= $totalCategories ?>"><?= $totalCategories ?></span></h4>
                    <h5>Total Categories</h5>
                    <h2 class="stat-change">+2% from last year</h2>
                </div>
                <div class="icon-box bg-ungu">
                    <i class="fa fa-list"></i>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <a href="#" class="w-100 text-decoration-none text-dark">
            <div class="dash-count das2">
                <div class="dash-counts">
                    <h4><span class="counters" data-count="<?= $totalProducts ?>"><?= number_format($totalProducts) ?></span></h4>
                    <h5>Total Products</h5>
                    <h2 class="stat-change">+6.3% from last year</h2>
                </div>
                <div class="icon-box bg-biru">
                    <i class="fa fa-box"></i>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <a href="#" class="w-100 text-decoration-none text-dark">
            <div class="dash-count das3">
                <div class="dash-counts">
                    <h4><span class="counters" data-count="89">89</span>%</h4>
                    <h5>Avg Popularity Index</h5>
                    <h2 class="stat-change">+15% from last year</h2>
                </div>
                <div class="icon-box bg-merah">
                    <i class="fa fa-chart-line"></i>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <a href="#" class="w-100 text-decoration-none text-dark">
            <div class="dash-count das4">
                <div class="dash-counts">
                    <h4><?= $topCategory['category_name'] ?></h4>
                    <h5>Top Category</h5>
                    <h2 class="stat-change"><?= number_format($topCategory['units_sold']) ?> products</h2>
                </div>
                <div class="icon-box bg-hijau">
                    <i class="fa fa-trophy"></i>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- Main Content -->
<div class="row">
    <div class="col-lg-12">
        <div class="row mb-4">
            <div class="col-lg-8">
                <!-- Bar Chart -->
                <div class="chart-section">
                    <div class="chart-header">
                        <h5 class="chart-title"><i class="fas fa-chart-bar me-2"></i>Top 5 Categories with Highest Product Count</h5>
                        <select class="chart-select" id="barChartYear">
                            <?php foreach ($years as $year): ?>
                                <option value="<?= $year ?>" <?= $year == 2025 ? 'selected' : '' ?>><?= $year ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div id="barChart" style="height: 250px;"></div>
                    <div class="insight-container">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
                            <div>
                                <h5 style="font-size: 0.9rem;">Insight: Dominasi Kategori Furniture</h5>
                                <p class="mb-0">Kategori Furniture mendominasi dengan 1200 produk (9.3% dari total). Pertumbuhan stabil dengan penambahan 50 produk baru tahun ini.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Donut Chart -->
                <div class="chart-section">
                    <div class="chart-header">
                        <h5 class="chart-title"><i class="fas fa-chart-pie me-2"></i>Category Distribution</h5>
                    </div>
                    <div id="donutChart" style="height: 250px;"></div>
                    <div class="insight-container">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
                            <div>
                                <h5 style="font-size: 0.9rem;">Insight: Diversifikasi Produk</h5>
                                <p class="mb-0">Top 5 kategori menyumbang 46.5% dari total produk. Kategori Storage menunjukkan pertumbuhan pesat dengan 950 produk.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Line Chart -->
                <div class="chart-section">
                    <div class="chart-header">
                        <h5 class="chart-title"><i class="fas fa-chart-line me-2"></i>Category Growth Trend</h5>
                        <select class="chart-select" id="lineChartYear">
                            <?php foreach ($years as $year): ?>
                                <option value="<?= $year ?>" <?= $year == 2025 ? 'selected' : '' ?>><?= $year ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div id="lineChart" style="height: 250px;"></div>
                    <div class="insight-container">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
                            <div>
                                <h5 style="font-size: 0.9rem;">Insight: Tren Pertumbuhan Konsisten</h5>
                                <p class="mb-0">Kategori Furniture dan Storage menunjukkan tren pertumbuhan yang konsisten. Living Room kategori dengan pertumbuhan tercepat (+12% YoY).</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-lg-4">
                <!-- Prediction -->
                <div class="sidebar-card">
                    <div class="sidebar-card-header">
                        <i class="fas fa-calculator me-2"></i>Prediksi Kategori Terpopuler
                    </div>
                    <div class="sidebar-card-body">
                        <div class="text-center mb-3">
                            <h4 style="color: #1976d2;"><?= $prediction['category_name'] ?></h4>
                            <p class="mb-2">diprediksi tetap menjadi kategori #1 hingga Q4 2025</p>
                            <div class="progress mb-2" style="height: 6px;">
                                <div class="progress-bar bg-success" style="width: 94%"></div>
                            </div>
                            <small class="text-muted">Akurasi prediksi: 94%</small>
                        </div>
                        <div class="row text-center">
                            <div class="col-6">
                                <h6>Q4 2025</h6>
                                <p class="mb-0 fw-bold"><?= number_format($prediction['units_sold'] + 80) ?> produk</p>
                            </div>
                            <div class="col-6">
                                <h6>Q1 2026</h6>
                                <p class="mb-0 fw-bold"><?= number_format($prediction['units_sold'] + 150) ?> produk</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Critical Notifications -->
                <div class="sidebar-card">
                    <div class="sidebar-card-header">
                        <i class="fas fa-bell me-2"></i>Notifikasi Kategori
                    </div>
                    <div class="sidebar-card-body">
                        <?php if ($notifications['warning']): ?>
                        <div class="notification-card warning">
                            <i class="fas fa-exclamation-triangle text-warning"></i>
                            <div>
                                <h5><?= $notifications['warning']['category_name'] ?> - Produk Sedikit</h5>
                                <p>Hanya <?= $notifications['warning']['units_sold'] ?> produk, perlu ekspansi</p>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($notifications['info']): ?>
                        <div class="notification-card info">
                            <i class="fas fa-trending-up text-info"></i>
                            <div>
                                <h5><?= $notifications['info']['category_name'] ?> - Kategori Berkembang</h5>
                                <p>Pertumbuhan <?= $notifications['info']['growth_rate'] ?>% dalam 6 bulan terakhir</p>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($notifications['danger']): ?>
                        <div class="notification-card danger">
                            <i class="fas fa-pause-circle text-danger"></i>
                            <div>
                                <h5><?= $notifications['danger']['category_name'] ?> - Status Pending</h5>
                                <p>Perlu review untuk aktivasi</p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Category Performance -->
                <div class="sidebar-card">
                    <div class="sidebar-card-header">
                        <i class="fas fa-chart-bar me-2"></i>Performa Kategori
                    </div>
                    <div class="sidebar-card-body">
                        <?php $count = 0; while ($row = $performance->fetch_assoc()): ?>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6 class="mb-1"><?= $row['category_name'] ?></h6>
                                <small class="text-muted">
                                    <?= number_format($row['units_sold']) ?> produk • Index: <?= (int)$row['profit_margin'] ?>
                                </small>
                            </div>
                            <div class="text-<?= $count === 0 ? 'success' : ($count === 1 ? 'success' : 'warning') ?> fw-bold">
                                <?= $count === 0 ? 'Excellent' : ($count === 1 ? 'Very Good' : 'Good') ?>
                            </div>
                        </div>
                        <?php $count++; endwhile; ?>
                    </div>
                </div>

                <!-- Popular Categories -->
                <div class="sidebar-card">
                    <div class="sidebar-card-header">
                        <i class="fas fa-star me-2"></i>Kategori Populer
                    </div>
                    <div class="sidebar-card-body">
                        <?php $count = 0; 
                        $badges = ['Top Category', 'Rising Star', 'Stable'];
                        $colors = ['primary', 'success', 'info'];
                        while ($row = $popularCategories->fetch_assoc()): ?>
                        <div class="mb-3">
                            <h6><?= $row['category_name'] ?></h6>
                            <div class="d-flex justify-content-between">
                                <span class="badge bg-<?= $colors[$count] ?>"><?= $badges[$count] ?></span>
                                <span class="fw-bold"><?= number_format($row['units_sold']) ?> produk</span>
                            </div>
                        </div>
                        <?php $count++; endwhile; ?>
                    </div>
                </div>

                <!-- AI Suggestion Card - SAMA SEPERTI BRANDLIST -->
                <div class="suggestion-card" id="aiSuggestionCard">
                    <div class="suggestion-header">
                        <div class="suggestion-icon">
                            <i class="fas fa-brain"></i>
                        </div>
                        <h4 class="suggestion-title" id="aiSuggestionTitle">
                            AI Suggestion: <?= formatInsightType($aiData['insight_type']) ?>
                        </h4>
                    </div>
                    <p class="suggestion-content" id="aiSuggestionContent">
                        <?= htmlspecialchars($aiData['recommendation']) ?>
                    </p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small style="opacity: 0.8;" id="aiSuggestionMeta">
                            <?= $aiData['category_name'] ?? 'General' ?> • <?= formatUrgency($aiData['urgency']) ?>
                        </small>
                        <small style="opacity: 0.7;" id="aiSuggestionTime">
                            <?= date('d M H:i', strtotime($aiData['generated_at'])) ?>
                        </small>
                    </div>
                </div>

                <!-- AI Solutions Card - SAMA SEPERTI BRANDLIST -->
                <div class="ai-solutions-card" id="aiSolutionsCard">
                    <div class="solutions-header">
                        <div class="solutions-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h5 class="solutions-title">Solusi AI Actionable</h5>
                        <div class="solutions-tooltip">
                            Solusi berdasarkan AI suggestion di atas
                        </div>
                    </div>
                    <div class="solutions-body">
                        <?php foreach ($aiSolutions as $index => $solution) { ?>
                        <div class="solution-item-card">
                            <div class="solution-number"><?php echo $index + 1; ?></div>
                            <div class="solution-text"><?php echo htmlspecialchars($solution); ?></div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="solutions-footer">
                        <small><i class="fas fa-robot me-1"></i>Generated by AI • <?php echo date('H:i'); ?></small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category Table -->
        <div class="category-table-section">
            <div class="chart-header">
              <h5 class="chart-title"><i class="fas fa-table me-2"></i>Data Kategori IKEA</h5>
              <div class="d-flex align-items-center gap-2">
                <span style="font-size: 0.8rem; color: #64748b;" id="totalCategoriesText">Total: <?= count($categoryTableData) ?> categories</span>
              </div>
            </div>

            <div class="table-controls">
              <div class="search-container">
                <input type="text" class="search-input" id="searchInput" placeholder="Cari kategori, deskripsi, atau status...">
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
            
            <table class="category-table" id="categoryTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Category</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Product Count</th>
                        <th>Created Date</th>
                        <th>Created By</th>
                        <th>Status</th>
                        <th>Popularity Index</th>
                    </tr>
                </thead>
                <tbody id="categoryTableBody">
                    <!-- Data akan diisi oleh JavaScript -->
                </tbody>
            </table>
            
            <div class="no-results" id="noResults" style="display: none;">
              <i class="fas fa-search"></i>
              <h5>Tidak ada data yang ditemukan</h5>
              <p>Coba ubah kata kunci pencarian Anda</p>
            </div>
            
            <div class="table-pagination" id="tablePagination">
              <div class="pagination-info" id="paginationInfo">
                Menampilkan 1-7 dari <?= count($categoryTableData) ?> kategori
              </div>
              <div class="pagination-controls">
                <button class="pagination-btn" id="prevBtn" onclick="changePage(-1)">
                  <i class="fas fa-chevron-left"></i> Prev
                </button>
                <button class="pagination-btn active" id="page1Btn" onclick="goToPage(1)">1</button>
                <button class="pagination-btn" id="page2Btn" onclick="goToPage(2)">2</button>
                <button class="pagination-btn" id="page3Btn" onclick="goToPage(3)">3</button>
                <button class="pagination-btn" id="nextBtn" onclick="changePage(1)">
                  Next <i class="fas fa-chevron-right"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

<script>
// *** TAMBAHAN: Fungsi refresh AI suggestion - SAMA SEPERTI BRANDLIST ***
function refreshAISolutions() {
    console.log('AI Solutions refreshed for categories');
    // Optional: Add refresh functionality for solutions if needed
}

// Data dari PHP diubah menjadi format JS
const barChartData = <?= json_encode($barChartData) ?>;
const top5Categories = <?= json_encode($top5Categories) ?>;
const top5Counts = <?= json_encode($top5Counts) ?>;
const otherProducts = <?= $otherProducts ?>;
const lineChartData = <?= json_encode($lineChartData) ?>;

// Data tabel dari PHP
const categoryData = <?= json_encode($categoryTableData) ?>;

// Table functionality
let currentPage = 1;
const itemsPerPage = 7; // 7 data per halaman
let filteredData = [...categoryData];
let searchQuery = '';

let barChart, donutChart, lineChart;

// Inisialisasi chart dengan data dari database
function initBarChart(year) {
    console.log('Initializing bar chart for year:', year);
    console.log('Bar chart data for year:', barChartData[year]);
    
    // Pastikan data ada untuk tahun yang diminta
    if (!barChartData[year]) {
        console.error(`Data not available for year: ${year}`);
        return;
    }
    
    const data = barChartData[year];
    
    // Validasi data
    if (!data.categories || !data.counts || data.categories.length === 0 || data.counts.length === 0) {
        console.error(`Bar chart data is empty for year: ${year}`);
        return;
    }

    const options = {
        series: [{
            name: "Jumlah Produk",
            data: data.counts
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
        xaxis: {
            categories: data.categories,
        },
        yaxis: {
            title: {
                text: 'Jumlah Produk'
            },
            labels: {
                formatter: function(val) {
                    return val.toLocaleString();
                }
            }
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val.toLocaleString() + ' produk';
                }
            }
        }
    };

    if (barChart) {
        barChart.destroy();
    }

    try {
        const barChartElement = document.querySelector("#barChart");
        if (!barChartElement) {
            console.error('Bar chart element not found');
            return;
        }
        
        barChart = new ApexCharts(barChartElement, options);
        barChart.render();
        console.log('Bar chart rendered successfully');
    } catch (error) {
        console.error('Error rendering bar chart:', error);
    }
}

function initDonutChart() {
    console.log('Initializing donut chart...');
    console.log('Top 5 Categories:', top5Categories);
    console.log('Top 5 Counts:', top5Counts);
    console.log('Other Products:', otherProducts);
    
    // Validasi data
    if (!top5Categories || !top5Counts || top5Categories.length === 0 || top5Counts.length === 0) {
        console.error('Donut chart data is empty or invalid');
        return;
    }
    
    const labels = [...top5Categories, 'Lainnya'];
    const series = [...top5Counts, otherProducts];
    
    const options = {
        series: series,
        chart: {
            type: 'donut',
            height: 250,
        },
        labels: labels,
        colors: ['#0d47a1', '#1565c0', '#1976d2', '#1e88e5', '#2196f3', '#42a5f5'],
        plotOptions: {
            pie: {
                donut: {
                    size: '60%',
                    labels: {
                        show: true,
                        total: {
                            show: true,
                            label: 'Total Produk',
                            formatter: function (w) {
                                return w.globals.seriesTotals.reduce((a, b) => a + b, 0).toLocaleString();
                            }
                        },
                        value: {
                            formatter: function(val) {
                                return parseInt(val).toLocaleString();
                            }
                        }
                    }
                }
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function(val, opts) {
                return opts.w.config.series[opts.seriesIndex].toLocaleString();
            }
        },
        legend: {
            position: 'bottom',
            horizontalAlign: 'center'
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val.toLocaleString() + ' produk';
                }
            }
        }
    };

    if (donutChart) {
        donutChart.destroy();
    }

    try {
        const donutChartElement = document.querySelector("#donutChart");
        if (!donutChartElement) {
            console.error('Donut chart element not found');
            return;
        }
        
        donutChart = new ApexCharts(donutChartElement, options);
        donutChart.render();
        console.log('Donut chart rendered successfully');
    } catch (error) {
        console.error('Error rendering donut chart:', error);
    }
}

function initLineChart(year) {
    console.log('Initializing line chart for year:', year);
    console.log('Line chart data for year:', lineChartData[year]);
    
    // Pastikan data ada untuk tahun yang diminta
    if (!lineChartData[year]) {
        console.error(`Data not available for year: ${year}`);
        return;
    }
    
    const data = lineChartData[year];
    
    // Validasi data
    if (!data || data.length === 0) {
        console.error(`Line chart data is empty for year: ${year}`);
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
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 2,
        },
        colors: ['#0d47a1', '#1565c0', '#1976d2', '#1e88e5', '#2196f3'],
        xaxis: {
            categories: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4', 'Minggu 5', 'Minggu 6', 'Minggu 7', 'Minggu 8'],
        },
        yaxis: {
            title: {
                text: 'Jumlah Produk'
            },
            labels: {
                formatter: function(val) {
                    return val.toLocaleString();
                }
            }
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val.toLocaleString() + ' produk';
                }
            }
        },
        legend: {
            position: 'bottom',
            itemMargin: {
                horizontal: 10,
                vertical: 5
            }
        }
    };

    if (lineChart) {
        lineChart.destroy();
    }

    try {
        const lineChartElement = document.querySelector("#lineChart");
        if (!lineChartElement) {
            console.error('Line chart element not found');
            return;
        }
        
        lineChart = new ApexCharts(lineChartElement, options);
        lineChart.render();
        console.log('Line chart rendered successfully');
    } catch (error) {
        console.error('Error rendering line chart:', error);
    }
}

// Search functionality
function performSearch(query) {
  searchQuery = query.toLowerCase();
  
  if (searchQuery === '') {
    filteredData = [...categoryData];
  } else {
    filteredData = categoryData.filter(category => 
      category.category_code.toLowerCase().includes(searchQuery) ||
      category.category_name.toLowerCase().includes(searchQuery) ||
      category.description.toLowerCase().includes(searchQuery) ||
      category.created_by.toLowerCase().includes(searchQuery) ||
      category.status.toLowerCase().includes(searchQuery)
    );
  }
  
  currentPage = 1;
  updateTotalPages();
  renderCategoryTable(currentPage);
  updateTotalCategoriesText();
}

function updateTotalPages() {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  
  document.getElementById('page1Btn').style.display = totalPages >= 1 ? 'inline-block' : 'none';
  document.getElementById('page2Btn').style.display = totalPages >= 2 ? 'inline-block' : 'none';
  document.getElementById('page3Btn').style.display = totalPages >= 3 ? 'inline-block' : 'none';
}

function updateTotalCategoriesText() {
  const totalText = document.getElementById('totalCategoriesText');
  if (searchQuery === '') {
    totalText.textContent = `Total: ${categoryData.length} categories`;
  } else {
    totalText.textContent = `Ditemukan: ${filteredData.length} dari ${categoryData.length} categories`;
  }
}

function renderCategoryTable(page = 1) {
  const startIndex = (page - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  const pageData = filteredData.slice(startIndex, endIndex);

  const tableBody = document.getElementById('categoryTableBody');
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

  pageData.forEach((category, index) => {
    const row = document.createElement('tr');
    
    const statusClass = category.status === 'Active' ? 'status-active' : 
                       category.status === 'Inactive' ? 'status-inactive' : 
                       category.status === 'Pending' ? 'status-pending' : 'status-ordered';
    
    const rowNumber = startIndex + index + 1;
    
    row.innerHTML = `
      <td style="color: #374151; font-weight: 600;">${rowNumber}</td>
      <td><span class="category-id">${category.category_code}</span></td>
      <td><span class="category-name">${category.category_name}</span></td>
      <td>${category.description}</td>
      <td><span class="fw-bold text-primary">${parseInt(category.product_count).toLocaleString()}</span></td>
      <td>${category.created_date}</td>
      <td>${category.created_by}</td>
      <td>
        <span class="category-status ${statusClass}">
          ${category.status}
        </span>
      </td>
      <td><span class="fw-bold" style="color: #059669;">${parseInt(category.popularity_index)}</span></td>
    `;
    
    tableBody.appendChild(row);
  });

  // Update pagination info
  const totalItems = filteredData.length;
  const startItem = startIndex + 1;
  const endItem = Math.min(endIndex, totalItems);
  document.getElementById('paginationInfo').textContent = 
    `Menampilkan ${startItem}-${endItem} dari ${totalItems} kategori`;

  updatePaginationButtons(page);
}

function updatePaginationButtons(page) {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  
  document.getElementById('prevBtn').disabled = page === 1;
  document.getElementById('nextBtn').disabled = page === totalPages;

  document.getElementById('page1Btn').classList.toggle('active', page === 1);
  document.getElementById('page2Btn').classList.toggle('active', page === 2);
  document.getElementById('page3Btn').classList.toggle('active', page === 3);
}

function changePage(direction) {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  const newPage = currentPage + direction;
  if (newPage >= 1 && newPage <= totalPages) {
    currentPage = newPage;
    renderCategoryTable(currentPage);
  }
}

function goToPage(page) {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  if (page >= 1 && page <= totalPages) {
    currentPage = page;
    renderCategoryTable(currentPage);
  }
}

// Export functions
function exportToPDF() {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF();
  
  doc.setFontSize(16);
  doc.text('Data Kategori IKEA', 14, 22);
  
  doc.setFontSize(10);
  doc.text(`Exported on: ${new Date().toLocaleDateString('id-ID')}`, 14, 30);
  
  const tableData = filteredData.map((category, index) => [
    index + 1,
    category.category_code,
    category.category_name,
    category.description,
    parseInt(category.product_count).toLocaleString(),
    category.created_date,
    category.created_by,
    category.status,
    parseInt(category.popularity_index)
  ]);
  
  doc.autoTable({
    head: [['No', 'ID', 'Category', 'Description', 'Products', 'Created', 'Created By', 'Status', 'Index']],
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
  
  doc.save('data-kategori-ikea.pdf');
}

function exportToExcel() {
  const excelData = filteredData.map((category, index) => ({
    'No': index + 1,
    'ID Category': category.category_code,
    'Category': category.category_name,
    'Description': category.description,
    'Product Count': parseInt(category.product_count),
    'Created Date': category.created_date,
    'Created By': category.created_by,
    'Status': category.status,
    'Popularity Index': parseInt(category.popularity_index)
  }));
  
  const wb = XLSX.utils.book_new();
  const ws = XLSX.utils.json_to_sheet(excelData);
  
  XLSX.utils.book_append_sheet(wb, ws, 'Data Kategori IKEA');
  XLSX.writeFile(wb, 'data-kategori-ikea.xlsx');
}

// Event listeners dan inisialisasi
document.addEventListener('DOMContentLoaded', function() {
    // Cek apakah ApexCharts sudah ter-load
    if (typeof ApexCharts === 'undefined') {
        console.error('ApexCharts is not loaded!');
        return;
    }
    
    // Debug: Tampilkan data yang diterima dari PHP
    console.log('Bar Chart Data:', barChartData);
    console.log('Donut Chart Data:', {categories: top5Categories, counts: top5Counts, other: otherProducts});
    console.log('Line Chart Data:', lineChartData);
    
    // Tunggu sebentar untuk memastikan DOM sudah siap
    setTimeout(function() {
        // Inisialisasi chart dengan tahun 2025
        initBarChart(2025);
        initDonutChart();
        initLineChart(2025);
    }, 100);
    
    // Render tabel dengan paginasi
    renderCategoryTable(1);
    updateTotalCategoriesText();
    updateTotalPages();
    
    // Event listener untuk select bar chart
    document.getElementById('barChartYear').addEventListener('change', function() {
        const year = parseInt(this.value);
        initBarChart(year);
    });
    
    // Event listener untuk select line chart
    document.getElementById('lineChartYear').addEventListener('change', function() {
        const year = parseInt(this.value);
        initLineChart(year);
    });
    
    // Counter animation
    const counters = document.querySelectorAll('.counters');
    const speed = 200;
    
    counters.forEach(counter => {
        const updateCount = () => {
            const target = +counter.getAttribute('data-count');
            const count = +counter.innerText.replace(/,/g, '');
            
            const inc = target / speed;
            
            if (count < target) {
                counter.innerText = Math.ceil(count + inc).toLocaleString();
                setTimeout(updateCount, 1);
            } else {
                counter.innerText = target.toLocaleString();
            }
        };
        
        updateCount();
    });
    
    // Search functionality
    document.getElementById('searchInput').addEventListener('input', function() {
        performSearch(this.value);
    });
    
    // Sembunyikan loader setelah 1 detik
    setTimeout(function() {
        document.getElementById('global-loader').style.display = 'none';
    }, 1000);
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
