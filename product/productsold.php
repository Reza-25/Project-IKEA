<?php
require_once __DIR__ . '/../include/config.php'; // Import config.php
// Ambil data tahun yang tersedia
$tahunQuery = $pdo->query("SELECT DISTINCT year FROM product_sales ORDER BY year DESC");
$tahunList = $tahunQuery->fetchAll(PDO::FETCH_COLUMN);
$currentYear = isset($_GET['tahun']) ? (int)$_GET['tahun'] : (count($tahunList) ? max($tahunList) : date('Y'));

// Ambil data penjualan per bulan
$salesData = [];
$monthlySalesQuery = $pdo->prepare("
    SELECT month, 
           SUM(total_sales) AS total_sold,
           CASE 
               WHEN SUM(furniture_sales) >= GREATEST(SUM(electronics_sales), SUM(decor_sales), SUM(lighting_sales)) THEN 'Furniture'
               WHEN SUM(electronics_sales) >= GREATEST(SUM(furniture_sales), SUM(decor_sales), SUM(lighting_sales)) THEN 'Electronics'
               WHEN SUM(decor_sales) >= GREATEST(SUM(furniture_sales), SUM(electronics_sales), SUM(lighting_sales)) THEN 'Decor'
               ELSE 'Lighting'
           END AS top_category
    FROM product_sales
    WHERE year = ?
    GROUP BY month
    ORDER BY month
");
$monthlySalesQuery->execute([$currentYear]);
$monthlySales = $monthlySalesQuery->fetchAll(PDO::FETCH_ASSOC);

// Format data untuk chart
$bulanShort = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
foreach ($bulanShort as $index => $bulan) {
    $monthNum = $index + 1;
    $found = false;
    
    foreach ($monthlySales as $sale) {
        if ($sale['month'] == $monthNum) {
            $salesData[] = [
                'bulan' => $bulan,
                'totalSold' => (int)$sale['total_sold'],
                'topCategory' => $sale['top_category'],
                'topProduct' => 'Sofa KVK', // Tetap menggunakan contoh produk
                'avgSold' => round($sale['total_sold'] / 30) // Asumsi 30 hari
            ];
            $found = true;
            break;
        }
    }
    
    if (!$found) {
        $salesData[] = [
            'bulan' => $bulan,
            'totalSold' => 0,
            'topCategory' => 'Furniture',
            'topProduct' => 'Sofa KVK',
            'avgSold' => 0
        ];
    }
}

// Hitung statistik utama
$statsQuery = $pdo->prepare("
    SELECT 
        SUM(total_sales) AS total_sold,
        SUM(furniture_sales) AS furniture,
        SUM(electronics_sales) AS electronics,
        SUM(decor_sales) AS decor,
        SUM(lighting_sales) AS lighting
    FROM product_sales
    WHERE year = ?
");
$statsQuery->execute([$currentYear]);
$stats = $statsQuery->fetch(PDO::FETCH_ASSOC);

// Hitung total sold dari semua bulan
$totalSold = 0;
foreach ($salesData as $data) {
    $totalSold += (int)$data['totalSold'];
}

// Pastikan tidak dibagi nol
$avgSales = $totalSold > 0 ? $totalSold / 12 : 0;

$totalSold = $stats['total_sold'] ?? 0;
$categoryTotals = [
    'Furniture' => $stats['furniture'] ?? 0,
    'Electronics' => $stats['electronics'] ?? 0,
    'Decor' => $stats['decor'] ?? 0,
    'Lighting' => $stats['lighting'] ?? 0
];
$totalCategories = array_sum($categoryTotals);
$categoryDistribution = [];
foreach ($categoryTotals as $category => $total) {
    $categoryDistribution[$category] = $totalCategories > 0 ? round(($total / $totalCategories) * 100) : 0;
}

// Ambil top category
arsort($categoryTotals);
$topCategory = key($categoryTotals) ?: 'Furniture';

// Konversi data ke JSON untuk JS
$salesDataJson = json_encode($salesData);
$categoryDistributionJson = json_encode($categoryDistribution);

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
    <link href="../assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="../assets/plugins/fontawesome/css/fontawesome.min.css" rel="stylesheet" />
    <link href="../assets/plugins/fontawesome/css/all.min.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

   <style>
    body {
      background-color: #f8f9fa;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .content {
      padding: 20px;
    }

    /* Layout utama seperti gambar */
    .main-dashboard {
      display: flex;
      gap: 20px;
      margin-bottom: 30px;
    }

    .left-section {
      flex: 0 0 65%;
    }

    .right-section {
      flex: 0 0 33%;
    }

    /* Chart container seperti gambar */
    .chart-container {
      background: white;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }

    .chart-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .chart-title {
      font-size: 16px;
      font-weight: 600;
      color: #1a73e8;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .year-select {
      padding: 6px 12px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 14px;
    }

    /* Product cards seperti di gambar kanan */
    .product-card {
      background: white;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 15px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      position: relative;
    }

    .product-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 10px;
    }

    .product-name {
      font-size: 18px;
      font-weight: bold;
      color: #1a73e8;
    }

    .product-subtitle {
      font-size: 12px;
      color: #666;
      margin-bottom: 8px;
    }

    .product-stats {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }

    .stat-item {
      text-align: center;
      flex: 1;
    }

    .stat-label {
      font-size: 11px;
      color: #666;
      margin-bottom: 2px;
    }

    .stat-value {
      font-size: 14px;
      font-weight: bold;
    }

    .promo-badge {
      background: #e8f5e8;
      color: #2e7d32;
      padding: 4px 8px;
      border-radius: 12px;
      font-size: 11px;
      font-weight: 500;
    }

    /* Location distribution section */
    .location-section {
      background: white;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 15px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .location-header {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 15px;
      color: #1a73e8;
      font-weight: 600;
    }

    .location-item {
      margin-bottom: 15px;
    }

    .location-name {
      font-weight: 600;
      margin-bottom: 5px;
    }

    .location-subtitle {
      font-size: 12px;
      color: #666;
      margin-bottom: 8px;
    }

    .location-tags {
      display: flex;
      gap: 6px;
      flex-wrap: wrap;
    }

    .location-tag {
      padding: 4px 10px;
      border-radius: 15px;
      font-size: 11px;
      font-weight: 500;
    }

    .tag-jakarta { background: #1976d2; color: white; }
    .tag-surabaya { background: #e3f2fd; color: #1976d2; }
    .tag-medan { background: #e3f2fd; color: #1976d2; }
    .tag-bandung { background: #e3f2fd; color: #1976d2; }
    .tag-yogya { background: #1976d2; color: white; }
    .tag-malang { background: #e3f2fd; color: #1976d2; }
    .tag-denpasar { background: #e3f2fd; color: #1976d2; }

    /* AI Suggestion box */
    .ai-suggestion {
      background: linear-gradient(135deg, #1976d2, #42a5f5);
      color: white;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 15px;
    }

    .ai-header {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 10px;
      font-weight: 600;
    }

    /* Bottom section layout */
    .bottom-section {
      display: flex;
      gap: 20px;
    }

    .bottom-left {
      flex: 0 0 65%;
    }

    .bottom-right {
      flex: 0 0 33%;
    }

    /* Brand comparison cards */
    .comparison-section {
      background: white;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .comparison-title {
      font-size: 16px;
      font-weight: 600;
      color: #1a73e8;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .comparison-row {
      display: flex;
      gap: 30px;
      margin-bottom: 30px;
    }

    .comparison-item {
      flex: 1;
      text-align: center;
      padding: 15px;
      border-radius: 8px;
      background: #f8f9fa;
    }

    .vs-divider {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      background: #ff5722;
      color: white;
      border-radius: 50%;
      font-weight: bold;
      align-self: center;
    }

    .brand-name {
      font-size: 16px;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .brand-category {
      font-size: 12px;
      color: #666;
      margin-bottom: 8px;
    }

    .brand-rating {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 5px;
      margin-bottom: 5px;
    }

    .brand-price {
      font-size: 12px;
      color: #666;
    }

    /* Right side components */
    .prediction-card {
      background: white;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 15px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .prediction-header {
      background: linear-gradient(135deg, #1976d2, #42a5f5);
      color: white;
      padding: 10px 15px;
      border-radius: 6px;
      margin: -15px -15px 15px -15px;
      font-weight: 600;
      font-size: 14px;
    }

    .prediction-content {
      text-align: center;
    }

    .prediction-brand {
      font-size: 18px;
      font-weight: bold;
      color: #1976d2;
      margin-bottom: 5px;
    }

    .prediction-text {
      font-size: 12px;
      color: #666;
      margin-bottom: 10px;
    }

    .prediction-accuracy {
      font-size: 12px;
      color: #666;
    }

    .prediction-details {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
      font-size: 12px;
    }

    /* Notification cards */
    .notification-card {
      background: white;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 15px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .notification-header {
      background: linear-gradient(135deg, #1976d2, #42a5f5);
      color: white;
      padding: 10px 15px;
      border-radius: 6px;
      margin: -15px -15px 15px -15px;
      font-weight: 600;
      font-size: 14px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .notification-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 8px 0;
      border-bottom: 1px solid #f0f0f0;
    }

    .notification-item:last-child {
      border-bottom: none;
    }

    .notification-icon {
      width: 24px;
      height: 24px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      color: white;
    }

    .notification-text {
      flex: 1;
      font-size: 13px;
    }

    .notification-title {
      font-weight: 600;
      margin-bottom: 2px;
    }

    .notification-subtitle {
      color: #666;
      font-size: 11px;
    }

    /* Health score section */
    .health-score-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 0;
      border-bottom: 1px solid #f0f0f0;
    }

    .health-score-item:last-child {
      border-bottom: none;
    }

    .health-brand {
      font-weight: 600;
    }

    .health-subtitle {
      font-size: 11px;
      color: #666;
    }

    .health-score {
      font-size: 18px;
      font-weight: bold;
    }

    .score-good { color: #4caf50; }
    .score-warning { color: #ff9800; }

    /* Brand readiness */
    .readiness-section {
      text-align: center;
      padding: 20px;
    }

    .readiness-score {
      font-size: 48px;
      font-weight: bold;
      color: #1976d2;
      margin-bottom: 5px;
    }

    .readiness-brand {
      font-size: 16px;
      font-weight: 600;
      color: #333;
    }

    /* Statistics cards - keep original styling */
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

    .das1 {
      border-top: 6px solid #1a5ea7;
    }
    .das1 * {
      color: #1a5ea7 !important;
    }

    .das2 {
      border-top: 6px solid #751e8d;
    }
    .das2 * {
      color: #751e8d !important;
    }

    .das3 {
      border-top: 6px solid #e78001;
    }
    .das3 * {
      color: #e78001 !important;
    }

    .das4 {
      border-top: 6px solid #018679;
    }
    .das4 * {
      color: #018679 !important;
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

    /* Enhanced Activity & Summary Cards */
    .activity-card {
      background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%);
      border-radius: 16px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
      border: 1px solid rgba(26, 115, 232, 0.1);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .activity-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, #1976d2, #42a5f5);
    }

    .activity-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 16px 48px rgba(0, 0, 0, 0.12);
    }

    .activity-header {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 20px;
      padding-bottom: 15px;
      border-bottom: 2px solid #e3f2fd;
    }

    .activity-icon {
      width: 48px;
      height: 48px;
      background: linear-gradient(135deg, #1976d2, #42a5f5);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 20px;
      box-shadow: 0 4px 16px rgba(25, 118, 210, 0.3);
    }

    .activity-title {
      font-size: 18px;
      font-weight: 700;
      color: #1976d2;
      margin: 0;
    }

    .activity-subtitle {
      font-size: 13px;
      color: #666;
      margin: 0;
    }

    .activity-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .activity-item {
      display: flex;
      align-items: center;
      gap: 15px;
      padding: 15px 0;
      border-bottom: 1px solid #f0f4ff;
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .activity-item:hover {
      background: rgba(25, 118, 210, 0.05);
      border-radius: 8px;
      padding-left: 10px;
      margin: 0 -10px;
    }

    .activity-item:last-child {
      border-bottom: none;
    }

    .activity-date {
      width: 48px;
      height: 48px;
      background: linear-gradient(135deg, #e3f2fd, #bbdefb);
      border-radius: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      font-size: 10px;
      font-weight: 600;
      color: #1976d2;
      flex-shrink: 0;
    }

    .activity-content {
      flex: 1;
    }

    .activity-action {
      font-weight: 600;
      color: #333;
      margin-bottom: 4px;
    }

    .activity-description {
      font-size: 12px;
      color: #666;
    }

    .activity-status {
      padding: 4px 8px;
      border-radius: 12px;
      font-size: 10px;
      font-weight: 600;
      text-transform: uppercase;
    }

    .status-success { background: #e8f5e8; color: #2e7d32; }
    .status-warning { background: #fff3e0; color: #f57c00; }
    .status-info { background: #e3f2fd; color: #1976d2; }

    /* Summary Cards Enhancement */
    .summary-item {
      display: flex;
      align-items: center;
      gap: 15px;
      padding: 15px 0;
      border-bottom: 1px solid #f0f4ff;
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .summary-item:hover {
      background: rgba(25, 118, 210, 0.05);
      border-radius: 8px;
      padding-left: 10px;
      margin: 0 -10px;
    }

    .summary-item:last-child {
      border-bottom: none;
    }

    .summary-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      flex-shrink: 0;
    }

    .icon-success { background: linear-gradient(135deg, #4caf50, #81c784); color: white; }
    .icon-warning { background: linear-gradient(135deg, #ff9800, #ffb74d); color: white; }
    .icon-trophy { background: linear-gradient(135deg, #ffc107, #ffeb3b); color: white; }
    .icon-location { background: linear-gradient(135deg, #2196f3, #64b5f6); color: white; }

    .summary-content {
      flex: 1;
    }

    .summary-label {
      font-weight: 600;
      color: #333;
      margin-bottom: 4px;
    }

    .summary-value {
      font-size: 12px;
      color: #666;
    }

    /* Donut Chart Section */
    .donut-section {
      background: white;
      border-radius: 16px;
      padding: 25px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
      border: 1px solid rgba(26, 115, 232, 0.1);
      height: fit-content;
      margin-bottom: 25px; /* Tambah margin bottom untuk jarak dengan section berikutnya */
    }

    .donut-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
      padding-bottom: 15px;
      border-bottom: 2px solid #e3f2fd;
    }

    .donut-title {
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 18px; /* Sedikit diperbesar */
      font-weight: 700;
      color: #1976d2;
    }

    .donut-icon {
      width: 40px; /* Sedikit diperbesar */
      height: 40px;
      background: linear-gradient(135deg, #1976d2, #42a5f5);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 16px;
    }

    .donut-content {
      display: flex;
      gap: 25px; /* Gap diperbesar */
      align-items: center;
    }

    .donut-chart-wrapper {
      flex: 0 0 180px; /* Ukuran chart sedikit diperbesar */
      height: 180px;
      position: relative;
    }

    .donut-stats {
      flex: 1;
    }

    .stat-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 0; /* Padding diperbesar */
      border-bottom: 1px solid #f0f4ff;
    }

    .stat-row:last-child {
      border-bottom: none;
    }

    .stat-info {
      display: flex;
      align-items: center;
      gap: 10px; /* Gap diperbesar */
    }

    .stat-color {
      width: 16px; /* Ukuran indikator warna diperbesar */
      height: 16px;
      border-radius: 4px;
    }

    .stat-name {
      font-weight: 600;
      color: #333;
      font-size: 15px; /* Font size diperbesar */
    }

    .stat-percentage {
      font-weight: 700;
      color: #1976d2;
      font-size: 15px; /* Font size diperbesar */
    }

    /* Perbaikan layout untuk Category Distribution saja */
    .category-ai-section {
      margin-bottom: 30px;
    }

    .category-distribution-container {
      width: 100%; /* Full width karena AI suggestion dihapus */
    }

    /* Hapus AI suggestion container styles */
    .ai-suggestion-container,
    .ai-suggestion-enhanced,
    .ai-header-enhanced,
    .ai-icon-enhanced,
    .ai-content-enhanced,
    .ai-features,
    .ai-feature,
    .ai-feature-icon {
      display: none !important;
    }

    /* Responsive adjustments */
    @media (max-width: 1200px) {
      .donut-content {
        flex-direction: column;
        gap: 20px;
      }
      
      .donut-chart-wrapper {
        flex: none;
      }
    }

    @media (max-width: 768px) {
      .donut-content {
        gap: 15px;
      }
      
      .donut-chart-wrapper {
        width: 160px;
        height: 160px;
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
            <?php include __DIR__ . '/../include/header.php'; ?>
            
            <div class="content">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="page-title">
                        <h4>Product Sold</h4>
                        <h6>View/Search product Category</h6>
                    </div>
                    <div class="page-btn">
                        <a href="addcategory.php" class="btn btn-added">
                            <img src="../assets/img/icons/plus.svg" class="me-1" alt="img">Add Category
                        </a>
                    </div>
                </div>

                <!-- Statistik Utama -->
                <div class="row justify-content-end">
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <a href="revenue/revenue.php" class="w-100 text-decoration-none text-dark">
                            <div class="dash-count das1">
                                <div class="dash-counts">
                                <h4>Rp<span class="counters" data-count="<?= $totalSold ?>" data-format="short"><?= $totalSold ?></span></h4>
                                    <h5>Total Product Sold</h5>
                                    <h2 class="stat-change">+9% from last year</h2>
                                </div>
                                <div class="icon-box bg-ungu">
                                    <i class="fa fa-box"></i>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <a href="people/supplierlist.php" class="w-100 text-decoration-none text-dark">
                            <div class="dash-count das2">
                                <div class="dash-counts">
                                    <h4><?= $topCategory ?></h4>
                                    <h5>Top Category</h5>
                                    <h2 class="stat-change">+9% from last year</h2>
                                </div>
                                <div class="icon-box bg-biru">
                                    <i class="fa fa-couch"></i>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <a href="product/productsold.php" class="w-100 text-decoration-none text-dark">
                            <div class="dash-count das3">
                                <div class="dash-counts">
                                    <h4>Sofa KVK</h4>
                                    <h5>Top-Selling Product</h5>
                                    <h2 class="stat-change">+15% from last year</h2>
                                </div>
                                <div class="icon-box bg-merah">
                                    <i class="fa fa-trophy"></i>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <a href="expense/expensecategory.php" class="w-100 text-decoration-none text-dark">
                            <div class="dash-count das4">
                                <div class="dash-counts">
                                <h4>Rp<span class="counters" data-count="<?= round($totalSold / 12) ?>" data-format="short"><?= round($totalSold / 12) ?></span></h4>
                                    <h5>Average Sales</h5>
                                    <h2 class="stat-change">+6% from last year</h2>
                                </div>
                                <div class="icon-box bg-hijau">
                                    <i class="fa fa-chart-line"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Main Dashboard Layout -->
                <div class="main-dashboard">
                    <!-- Left Section - Chart -->
                    <div class="left-section">
                        <div class="chart-container">
                            <div class="chart-header">
                                <div class="chart-title">
                                    <i class="fas fa-chart-line"></i>
                                    Total Product Sold per Bulan
                                </div>
                                <select id="tahun" class="year-select">
                                    <?php foreach ($tahunList as $tahun): ?>
                                        <option value="<?= $tahun ?>" <?= $tahun == $currentYear ? 'selected' : '' ?>>
                                            <?= $tahun ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div style="position: relative; height: 350px;">
                                <canvas id="chartProduk"></canvas>
                            </div>
                            
                            <!-- Insight box -->
                            <div style="background: #e8f4fd; border-left: 4px solid #1976d2; padding: 12px; margin-top: 15px; border-radius: 4px;">
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 5px;">
                                    <i class="fas fa-lightbulb" style="color: #1976d2;"></i>
                                    <strong style="color: #1976d2;">Insight: Tren Penjualan Produk</strong>
                                </div>
                                <p style="margin: 0; font-size: 13px; color: #555;">
                                    Penjualan produk menunjukkan tren positif dengan peningkatan stabil. Puncak penjualan terjadi pada bulan tertentu karena program promosi.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Section - Product Details -->
                    <div class="right-section">
                        <!-- Product Detail Card -->
                        <div class="product-card">
                            <div class="product-header">
                                <div>
                                    <div class="product-name">Sofa KVK</div>
                                    <div class="product-subtitle">Top-Selling Product</div>
                                </div>
                                <div style="font-size: 24px; font-weight: bold; color: #1976d2;">92%</div>
                            </div>
                            <div class="product-stats">
                                <div class="stat-item">
                                    <div class="stat-label">Stok Tinggi</div>
                                    <div style="color: #4caf50;"><i class="fas fa-box"></i></div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-label">Rating 4.6</div>
                                    <div style="color: #ffc107;"><i class="fas fa-star"></i></div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-label">Stabil</div>
                                    <div style="color: #1976d2;"><i class="fas fa-chart-line"></i></div>
                                </div>
                            </div>
                            <div class="promo-badge">✓ Siap Promo Flash Sale</div>
                        </div>

                        <!-- Notes Section -->
                        <div class="location-section">
                            <div class="location-header">
                                <i class="fas fa-info-circle"></i>
                                Detail Produk: <span id="selectedMonth">Jan</span>
                            </div>
                            
                            <div class="location-item">
                                <div class="location-name">Total Product Sold</div>
                                <div class="location-subtitle" id="totalSold">-</div>
                            </div>

                            <div class="location-item">
                                <div class="location-name">Top Category</div>
                                <div class="location-subtitle" id="topCategory">-</div>
                            </div>

                            <div class="location-item">
                                <div class="location-name">Top Selling Product</div>
                                <div class="location-subtitle" id="topProduct">-</div>
                            </div>

                            <div class="location-item">
                                <div class="location-name">Average Sales</div>
                                <div class="location-subtitle" id="avgSold">-</div>
                            </div>
                        </div>

                        <!-- AI Suggestion -->
                        <div class="ai-suggestion">
                            <div class="ai-header">
                                <i class="fas fa-robot"></i>
                                AI Suggestion: Produk Baru yang Potensial
                            </div>
                            <p style="margin: 0; font-size: 13px;">
                                "Berdasarkan data penjualan, produk furniture menunjukkan tren positif. Pertimbangkan untuk menambah variasi produk sofa untuk meningkatkan penjualan."
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Category Distribution Section -->
                <div class="category-ai-section">
                    <!-- Category Distribution (Full Width) -->
                    <div class="category-distribution-container">
                        <div class="donut-section">
                            <div class="donut-header">
                                <div class="donut-title">
                                    <div class="donut-icon">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                    Category Distribution
                                </div>
                                <select class="year-select">
                                    <?php foreach ($tahunList as $tahun): ?>
                                        <option value="<?= $tahun ?>" <?= $tahun == $currentYear ? 'selected' : '' ?>>
                                            <?= $tahun ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="donut-content">
                                <div class="donut-chart-wrapper">
                                    <canvas id="categoryDonutChart"></canvas>
                                </div>
                                <div class="donut-stats">
                                    <?php foreach ($categoryDistribution as $category => $percentage): ?>
                                        <div class="stat-row">
                                            <div class="stat-info">
                                                <div class="stat-color" style="background: <?= 
                                                    $category == 'Furniture' ? '#1976d2' : 
                                                    ($category == 'Electronics' ? '#42a5f5' : 
                                                    ($category == 'Decor' ? '#64b5f6' : '#90caf9')) 
                                                ?>;"></div>
                                                <div class="stat-name"><?= $category ?></div>
                                            </div>
                                            <div class="stat-percentage"><?= $percentage ?>%</div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Section -->
                <div class="bottom-section">
                    <!-- Left - Enhanced Activity & Summary -->
                    <div class="bottom-left">
                        <!-- Enhanced Activity Log -->
                        <div class="activity-card">
                            <div class="activity-header">
                                <div class="activity-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div>
                                    <div class="activity-title">Aktivitas Terkait & Log</div>
                                    <div class="activity-subtitle">Recent product activities and updates</div>
                                </div>
                            </div>
                            <ul class="activity-list">
                                <li class="activity-item">
                                    <div class="activity-date">
                                        <div>30</div>
                                        <div>JUN</div>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-action">Restok Sofa LINDHULT</div>
                                        <div class="activity-description">Inventory replenishment completed successfully</div>
                                    </div>
                                    <div class="activity-status status-success">COMPLETED</div>
                                </li>
                                <li class="activity-item">
                                    <div class="activity-date">
                                        <div>29</div>
                                        <div>JUN</div>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-action">Harga Rak KALLAX dinaikkan</div>
                                        <div class="activity-description">Price adjustment implemented (+5%)</div>
                                    </div>
                                    <div class="activity-status status-info">ACTIVE</div>
                                </li>
                                <li class="activity-item">
                                    <div class="activity-date">
                                        <div>28</div>
                                        <div>JUN</div>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-action">Diskon 15% Meja LACK</div>
                                        <div class="activity-description">Flash sale promotion launched</div>
                                    </div>
                                    <div class="activity-status status-warning">ONGOING</div>
                                </li>
                                <li class="activity-item">
                                    <div class="activity-date">
                                        <div>27</div>
                                        <div>JUN</div>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-action">Promo Kursi TERJE diterapkan</div>
                                        <div class="activity-description">New promotional campaign started</div>
                                    </div>
                                    <div class="activity-status status-success">LAUNCHED</div>
                                </li>
                            </ul>
                        </div>

                        <!-- Enhanced Summary Information -->
                        <div class="activity-card">
                            <div class="activity-header">
                                <div class="activity-icon">
                                    <i class="fas fa-chart-pie"></i>
                                </div>
                                <div>
                                    <div class="activity-title">Informasi Ringkas</div>
                                    <div class="activity-subtitle">Key performance indicators and insights</div>
                                </div>
                            </div>
                            <div class="activity-list">
                                <div class="summary-item">
                                    <div class="summary-icon icon-success">
                                        <i class="fas fa-trophy"></i>
                                    </div>
                                    <div class="summary-content">
                                        <div class="summary-label">Produk Terlaris</div>
                                        <div class="summary-value">Sofa KLIPPAN (1,340 units sold)</div>
                                    </div>
                                </div>
                                <div class="summary-item">
                                    <div class="summary-icon icon-warning">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="summary-content">
                                        <div class="summary-label">Perlu Perhatian</div>
                                        <div class="summary-value">Lampu LERSTA (low sales performance)</div>
                                    </div>
                                </div>
                                <div class="summary-item">
                                    <div class="summary-icon icon-trophy">
                                        <i class="fas fa-medal"></i>
                                    </div>
                                    <div class="summary-content">
                                        <div class="summary-label">Kategori Top</div>
                                        <div class="summary-value">Ruang Tamu (35% market share)</div>
                                    </div>
                                </div>
                                <div class="summary-item">
                                    <div class="summary-icon icon-location">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="summary-content">
                                        <div class="summary-label">Toko Terbaik</div>
                                        <div class="summary-value">IKEA Alam Sutera (highest revenue)</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right - Notifications & Alerts -->
                    <div class="bottom-right">
                        <!-- Target Achievement -->
                        <div class="prediction-card">
                            <div class="prediction-header">
                                <i class="fas fa-target"></i>
                                Produk Melebihi Target
                            </div>
                            <div class="prediction-content">
                                <div class="prediction-brand">LACK</div>
                                <div class="prediction-text">Telah melebihi target hari ini!</div>
                                <div style="width: 60px; height: 60px; margin: 10px auto;">
                                    <canvas id="donutTarget"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Critical Notifications -->
                        <div class="notification-card">
                            <div class="notification-header">
                                <i class="fas fa-bell"></i>
                                Notifikasi Kritis Otomatis
                            </div>
                            
                            <div class="notification-item">
                                <div class="notification-icon" style="background: #ff9800;">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="notification-text">
                                    <div class="notification-title">MALM - Stok Tinggal 7 Unit</div>
                                    <div class="notification-subtitle">Stok kritis, restock diperlukan segera</div>
                                </div>
                            </div>

                            <div class="notification-item">
                                <div class="notification-icon" style="background: #f44336;">
                                    <i class="fas fa-sync-alt"></i>
                                </div>
                                <div class="notification-text">
                                    <div class="notification-title">BILLY - Hampir Mencapai Target</div>
                                    <div class="notification-subtitle">92% dari target harian tercapai</div>
                                </div>
                            </div>

                            <div class="notification-item">
                                <div class="notification-icon" style="background: #2196f3;">
                                    <i class="fas fa-thumbs-up"></i>
                                </div>
                                <div class="notification-text">
                                    <div class="notification-title">Sofa KVK - Performance Excellent</div>
                                    <div class="notification-subtitle">Penjualan meningkat 15% dari target</div>
                                </div>
                            </div>
                        </div>

                        <!-- Health Score -->
                        <div class="notification-card">
                            <div class="notification-header">
                                <i class="fas fa-heart"></i>
                                Health Score untuk Produk
                            </div>
                            
                            <div class="health-score-item">
                                <div>
                                    <div class="health-brand">Furniture</div>
                                    <div class="health-subtitle">Kategori stabil, penjualan konsisten</div>
                                </div>
                                <div class="health-score score-good">87/100</div>
                            </div>

                            <div class="health-score-item">
                                <div>
                                    <div class="health-brand">Sofa KVK</div>
                                    <div class="health-subtitle">Top performer, rating tinggi</div>
                                </div>
                                <div class="health-score score-good">92/100</div>
                            </div>
                        </div>

                        <!-- Readiness Index -->
                        <div class="notification-card">
                            <div class="notification-header">
                                <i class="fas fa-bolt"></i>
                                Product Readiness Index
                            </div>
                            <div class="readiness-section">
                                <div class="readiness-score">92%</div>
                                <div class="readiness-brand">Sofa KVK</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        // DATA DINAMIS DARI PHP
        const salesData = <?= $salesDataJson ?>;
        const categoryDistribution = <?= $categoryDistributionJson ?>;
        const currentYear = <?= $currentYear ?>;

        // Inisialisasi chart
        let chart;
        const ctx = document.getElementById('chartProduk').getContext('2d');

        function renderChart() {
            const labels = salesData.map(item => item.bulan);
            const values = salesData.map(item => item.totalSold);

            if (chart) chart.destroy();

            const gradient = ctx.createLinearGradient(0, 0, 0, 320);
            gradient.addColorStop(0, "#0d47a1");
            gradient.addColorStop(1, "#66bfff");

            chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: `Total Produk Terjual - ${currentYear}`,
                        data: values,
                        backgroundColor: gradient,
                        borderRadius: 6,
                        barThickness: 30
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 1700,
                        easing: 'easeOut'
                    },
                    onClick: (evt, elements) => {
                        if (elements.length > 0) {
                            const i = elements[0].index;
                            updateNotes(salesData[i]);
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { color: "#666", font: { size: 12 } },
                            grid: { color: "#eee" }
                        },
                        x: {
                            ticks: { color: "#444", font: { size: 12 } },
                            grid: { display: false }
                        }
                    }
                }
            });

            updateNotes(salesData[0]);
        }


// Update function updateNotes
function updateNotes(item) {
    document.getElementById("selectedMonth").textContent = item.bulan;
    document.getElementById("totalSold").textContent = formatRupiahSingkat(item.totalSold);
    document.getElementById("topCategory").textContent = item.topCategory;
    document.getElementById("topProduct").textContent = item.topProduct;
    document.getElementById("avgSold").textContent = formatRupiahSingkat(item.avgSold);
}

        // Fungsi untuk reload halaman saat tahun diubah
        document.getElementById("tahun").addEventListener("change", function() {
            window.location.href = `?tahun=${this.value}`;
        });

        // Inisialisasi chart saat halaman dimuat
        window.addEventListener('DOMContentLoaded', function() {
            renderChart();
            
            // Target achievement donut chart
            const ctxTarget = document.getElementById('donutTarget').getContext('2d');
            new Chart(ctxTarget, {
                type: 'doughnut',
                data: {
                    labels: ['Tercapai', 'Sisa'],
                    datasets: [{
                        data: [120, 30],
                        backgroundColor: ['#007ac2', '#e2f0fb'],
                        borderWidth: 0
                    }]
                },
                options: {
                    cutout: '70%',
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: false },
                        title: { display: false }
                    }
                }
            });

            // Category distribution donut chart
            const ctxCategory = document.getElementById('categoryDonutChart').getContext('2d');
            new Chart(ctxCategory, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(categoryDistribution),
                    datasets: [{
                        data: Object.values(categoryDistribution),
                        backgroundColor: ['#1976d2', '#42a5f5', '#64b5f6', '#90caf9'],
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '60%',
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(255, 255, 255, 0.95)',
                            titleColor: '#1976d2',
                            bodyColor: '#333',
                            borderColor: '#1976d2',
                            borderWidth: 1,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                  return context.dataset.label + ': ' + formatRupiahSingkat(context.parsed.y);
                                }
                            }
                        }
                    },
                    animation: {
                        animateRotate: true,
                        duration: 2000
                    }
                }
            });
        });

  
    </script>

    <!-- ... (SCRIPT LAINNYA TIDAK DIUBAH) ... -->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/feather.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/plugins/select2/js/select2.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalerts.min.js"></script>
    <script src="../assets/js/script.js"></script>
  </body>
</html>
