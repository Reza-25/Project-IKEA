<?php
require_once __DIR__ . '/../include/config.php';

// *** TAMBAHAN: Include AI Helper ***
require_once __DIR__ . '/ai_helper_productsold.php';

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

// Jika semua kategori 0, berikan data default
if (array_sum($categoryDistribution) == 0) {
    $categoryDistribution = [
        'Furniture' => 40,
        'Electronics' => 25,
        'Decor' => 20,
        'Lighting' => 15
    ];
}

// Ambil top category
arsort($categoryTotals);
$topCategory = key($categoryTotals) ?: 'Furniture';

// *** TAMBAHAN: Ambil AI Suggestion ***
$aiSuggestion = getProductSoldAIInsightWithSolutions();
$aiData = $aiSuggestion['data'];

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
    <title>RuanGku</title>
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
        padding: 15px;
    }

    /* Compact layout */
    .main-dashboard {
        display: flex;
        gap: 15px;
        margin-bottom: 0;
    }

    .left-section {
        flex: 0 0 65%;
    }

    .right-section {
        flex: 0 0 33%;
    }

    /* Chart container - more compact */
    .chart-container {
        background: white;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 10px;
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
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

    /* Compact product cards */
    .product-card {
        background: white;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .product-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 8px;
    }

    .product-name {
        font-size: 18px;
        font-weight: bold;
        color: #1a73e8;
    }

    .product-subtitle {
        font-size: 12px;
        color: #666;
        margin-bottom: 6px;
    }

    .product-stats {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
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

    .promo-badge {
        background: #e8f5e8;
        color: #2e7d32;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 500;
    }

    /* Compact location section */
    .location-section {
        background: white;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .location-header {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
        color: #1a73e8;
        font-weight: 600;
    }

    .location-item {
        margin-bottom: 10px;
    }

    .location-name {
        font-weight: 600;
        margin-bottom: 3px;
    }

    .location-subtitle {
        font-size: 12px;
        color: #666;
        margin-bottom: 5px;
    }

    /* Statistics cards - compact */
    .das1, .das2, .das3, .das4 {
        background: white !important;
        border-radius: 15px;
        padding: 15px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .dash-count {
        padding: 18px;
        border-radius: 15px;
        background-color: white;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .dash-count:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    .dash-counts h4 {
        font-size: 22px;
        margin-bottom: 4px;
        font-weight: bold;
    }
    .dash-counts h5 {
        font-size: 13px;
        margin: 0;
    }
    .stat-change {
        font-size: 10px;
        margin-top: 3px;
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
        display: inline-block;
        padding: 2px 5px;
        border-radius: 10px;
        font-weight: 600;
    }

    .das1 { border-top: 4px solid #1a5ea7; }
    .das1 * { color: #1a5ea7 !important; }
    .das2 { border-top: 4px solid #751e8d; }
    .das2 * { color: #751e8d !important; }
    .das3 { border-top: 4px solid #e78001; }
    .das3 * { color: #e78001 !important; }
    .das4 { border-top: 4px solid #018679; }
    .das4 * { color: #018679 !important; }

    .icon-box {
        width: 40px;
        height: 40px;
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
        font-size: 14px;
    }

    .bg-ungu { background: linear-gradient(135deg, #2196f3 0%, #0d47a1 100%); }
    .bg-biru { background: linear-gradient(135deg, #a259c6 0%, #6d28d9 100%); }
    .bg-hijau { background: linear-gradient(135deg,rgb(89, 236, 222) 0%, #018679 100%); }
    .bg-merah { background: linear-gradient(135deg, #ff5858 0%, #e78001 100%); }

    /* Compact AI Suggestion Card */
    .suggestion-card {
        background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
        color: white;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 12px;
        transition: all 0.3s ease;
        box-shadow: 0 3px 10px rgba(25, 118, 210, 0.2);
    }

    .suggestion-header {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        gap: 8px;
    }

    .suggestion-icon {
        width: 32px;
        height: 32px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .suggestion-title {
        font-size: 0.95rem;
        font-weight: 700;
        margin: 0;
        line-height: 1.2;
    }

    .suggestion-content {
        font-size: 0.85rem;
        line-height: 1.4;
        margin: 0;
        opacity: 0.95;
    }

    /* Compact AI Solutions Card */
    .ai-solutions-card {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 12px;
        transition: all 0.3s ease;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    .ai-solutions-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #1976d2 0%, #42a5f5 100%);
    }

    .solutions-header {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        gap: 8px;
    }

    .solutions-icon {
        width: 28px;
        height: 28px;
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        color: white;
        flex-shrink: 0;
    }

    .solutions-title {
        font-size: 0.9rem;
        font-weight: 700;
        margin: 0;
        color: #1e293b;
    }

    .solution-item-card {
        display: flex;
        align-items: flex-start;
        margin-bottom: 8px;
        padding: 8px;
        background: white;
        border-radius: 6px;
        transition: all 0.2s ease;
        border: 1px solid #f1f5f9;
    }

    .solution-number {
        background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
        color: white;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
        font-weight: 700;
        margin-right: 8px;
        flex-shrink: 0;
    }

    .solution-text {
        font-size: 0.8rem;
        line-height: 1.4;
        color: #374151;
        font-weight: 500;
    }

    /* Donut Chart Section - Now inside left section */
    .donut-section {
        background: white;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 10px;
    }

    .donut-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e3f2fd;
    }

    .donut-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 16px;
        font-weight: 700;
        color: #1976d2;
    }

    .donut-icon {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #1976d2, #42a5f5);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 14px;
    }

    .donut-content {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .donut-chart-wrapper {
        flex: 0 0 160px;
        height: 160px;
        position: relative;
    }

    .donut-chart-wrapper canvas {
        width: 100% !important;
        height: 100% !important;
    }

    .donut-stats {
        flex: 1;
    }

    .stat-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 6px 0;
        border-bottom: 1px solid #f0f4ff;
    }

    .stat-row:last-child {
        border-bottom: none;
    }

    .stat-info {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .stat-color {
        width: 12px;
        height: 12px;
        border-radius: 3px;
    }

    .stat-name {
        font-weight: 600;
        color: #333;
        font-size: 13px;
    }

    .stat-percentage {
        font-weight: 700;
        color: #1976d2;
        font-size: 13px;
    }

    /* Compact activity cards - now in left section */
    .activity-card {
        background: white;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .activity-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e3f2fd;
    }

    .activity-icon {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #1976d2, #42a5f5);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 14px;
    }

    .activity-title {
        font-size: 16px;
        font-weight: 700;
        color: #1976d2;
        margin: 0;
    }

    .activity-subtitle {
        font-size: 12px;
        color: #666;
        margin: 0;
    }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 8px 0;
        border-bottom: 1px solid #f0f4ff;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-date {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-size: 8px;
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
        margin-bottom: 2px;
        font-size: 13px;
    }

    .activity-description {
        font-size: 11px;
        color: #666;
    }

    .activity-status {
        padding: 3px 6px;
        border-radius: 10px;
        font-size: 9px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-success { background: #e8f5e8; color: #2e7d32; }
    .status-warning { background: #fff3e0; color: #f57c00; }
    .status-info { background: #e3f2fd; color: #1976d2; }

    /* Compact right side components */
    .prediction-card, .notification-card {
        background: white;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .prediction-header, .notification-header {
        background: linear-gradient(135deg, #1976d2, #42a5f5);
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        margin: -12px -12px 12px -12px;
        font-weight: 600;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .prediction-brand {
        font-size: 16px;
        font-weight: bold;
        color: #1976d2;
        margin-bottom: 4px;
    }

    .prediction-text {
        font-size: 11px;
        color: #666;
        margin-bottom: 8px;
    }

    .notification-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 6px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .notification-item:last-child {
        border-bottom: none;
    }

    .notification-icon {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        color: white;
    }

    .notification-text {
        flex: 1;
        font-size: 12px;
    }

    .notification-title {
        font-weight: 600;
        margin-bottom: 1px;
    }

    .notification-subtitle {
        color: #666;
        font-size: 10px;
    }

    .health-score-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .health-score-item:last-child {
        border-bottom: none;
    }

    .health-brand {
        font-weight: 600;
        font-size: 13px;
    }

    .health-subtitle {
        font-size: 10px;
        color: #666;
    }

    .health-score {
        font-size: 16px;
        font-weight: bold;
    }

    .score-good { color: #4caf50; }

    .readiness-section {
        text-align: center;
        padding: 15px;
    }

    .readiness-score {
        font-size: 36px;
        font-weight: bold;
        color: #1976d2;
        margin-bottom: 4px;
    }

    .readiness-brand {
        font-size: 14px;
        font-weight: 600;
        color: #333;
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
        width: 40px;
        height: 40px;
        border: 3px solid #f3f3f3;
        border-top: 3px solid #1976d2;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
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
                    <!-- Left Section - Chart + Donut Chart + Activity -->
                    <div class="left-section">
                        <!-- Bar Chart Container -->
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
                            <div style="position: relative; height: 300px;">
                                <canvas id="chartProduk"></canvas>
                            </div>
                            
                            <!-- Insight box -->
                            <div style="background: #e8f4fd; border-left: 4px solid #1976d2; padding: 10px; margin-top: 12px; border-radius: 4px;">
                                <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 4px;">
                                    <i class="fas fa-lightbulb" style="color: #1976d2;"></i>
                                    <strong style="color: #1976d2; font-size: 13px;">Insight: Tren Penjualan Produk</strong>
                                </div>
                                <p style="margin: 0; font-size: 12px; color: #555;">
                                    Penjualan produk menunjukkan tren positif dengan peningkatan stabil. Puncak penjualan terjadi pada bulan tertentu karena program promosi.
                                </p>
                            </div>
                        </div>

                        <!-- Category Distribution Section -->
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
                            
                            <!-- Insight box untuk donut chart -->
                            <div style="background: #e8f4fd; border-left: 4px solid #1976d2; padding: 10px; margin-top: 12px; border-radius: 4px;">
                                <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 4px;">
                                    <i class="fas fa-lightbulb" style="color: #ffc107;"></i>
                                    <strong style="color: #1976d2; font-size: 13px;">Insight: Distribusi Kategori Produk</strong>
                                </div>
                                <p style="margin: 0; font-size: 12px; color: #555;">
                                    <?php 
                                    // Ambil kategori tertinggi
                                    arsort($categoryDistribution);
                                    $topCategoryName = key($categoryDistribution);
                                    $topCategoryPercentage = reset($categoryDistribution);
                                    ?>
                                    Kategori <strong><?= $topCategoryName ?></strong> mendominasi penjualan dengan <?= $topCategoryPercentage ?>% dari total. Fokus pada diversifikasi produk di kategori lain dapat meningkatkan balance portfolio penjualan.
                                </p>
                            </div>
                        </div>

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
                            <div class="activity-list">
                                <div class="activity-item">
                                    <div class="activity-date">
                                        <div>30</div>
                                        <div>JUN</div>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-action">Restok Sofa LINDHULT</div>
                                        <div class="activity-description">Inventory replenishment completed successfully</div>
                                    </div>
                                    <div class="activity-status status-success">COMPLETED</div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-date">
                                        <div>29</div>
                                        <div>JUN</div>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-action">Harga Rak KALLAX dinaikkan</div>
                                        <div class="activity-description">Price adjustment implemented (+5%)</div>
                                    </div>
                                    <div class="activity-status status-info">ACTIVE</div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-date">
                                        <div>28</div>
                                        <div>JUN</div>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-action">Diskon 15% Meja LACK</div>
                                        <div class="activity-description">Flash sale promotion launched</div>
                                    </div>
                                    <div class="activity-status status-warning">ONGOING</div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-date">
                                        <div>27</div>
                                        <div>JUN</div>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-action">Promo Kursi TERJE diterapkan</div>
                                        <div class="activity-description">New promotional campaign started</div>
                                    </div>
                                    <div class="activity-status status-success">LAUNCHED</div>
                                </div>
                            </div>
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
                                <div class="activity-item">
                                    <div class="activity-date" style="background: linear-gradient(135deg, #4caf50, #81c784);">
                                        <i class="fas fa-trophy" style="color: white; font-size: 12px;"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-action">Produk Terlaris</div>
                                        <div class="activity-description">Sofa KLIPPAN (1,340 units sold)</div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-date" style="background: linear-gradient(135deg, #ff9800, #ffb74d);">
                                        <i class="fas fa-exclamation-triangle" style="color: white; font-size: 12px;"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-action">Perlu Perhatian</div>
                                        <div class="activity-description">Lampu LERSTA (low sales performance)</div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-date" style="background: linear-gradient(135deg, #ffc107, #ffeb3b);">
                                        <i class="fas fa-medal" style="color: white; font-size: 12px;"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-action">Kategori Top</div>
                                        <div class="activity-description">Ruang Tamu (35% market share)</div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-date" style="background: linear-gradient(135deg, #2196f3, #64b5f6);">
                                        <i class="fas fa-map-marker-alt" style="color: white; font-size: 12px;"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-action">Toko Terbaik</div>
                                        <div class="activity-description">IKEA Alam Sutera (highest revenue)</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Section - Product Details + AI + Notifications -->
                    <div class="right-section">
                        <!-- Product Detail Card -->
                        <div class="product-card">
                            <div class="product-header">
                                <div>
                                    <div class="product-name">Sofa KVK</div>
                                    <div class="product-subtitle">Top-Selling Product</div>
                                </div>
                                <div style="font-size: 20px; font-weight: bold; color: #1976d2;">92%</div>
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

                        <!-- AI Suggestion Card -->
                        <div class="suggestion-card" id="aiSuggestionCard">
                            <div class="suggestion-header">
                                <div class="suggestion-icon">
                                    <i class="fas fa-brain"></i>
                                </div>
                                <h4 class="suggestion-title" id="aiSuggestionTitle">
                                    AI Suggestion: <?= formatProductInsightType($aiData['insight_type']) ?>
                                </h4>
                            </div>
                            <p class="suggestion-content" id="aiSuggestionContent">
                                <?= htmlspecialchars($aiData['recommendation']) ?>
                            </p>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <small style="opacity: 0.8; font-size: 10px;" id="aiSuggestionMeta">
                                    <?= $aiData['product_name'] ?? 'General' ?> • <?= formatProductUrgency($aiData['urgency']) ?>
                                </small>
                                <small style="opacity: 0.7; font-size: 10px;" id="aiSuggestionTime">
                                    <?= date('d M H:i', strtotime($aiData['generated_at'])) ?>
                                </small>
                            </div>
                        </div>

                        <!-- AI Solutions Card -->
                        <div class="ai-solutions-card" id="aiSolutionsCard">
                            <div class="solutions-header">
                                <div class="solutions-icon">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <h5 class="solutions-title">Solusi AI Actionable</h5>
                            </div>
                            <div class="solutions-body">
                                <?php foreach ($aiData['solutions'] as $index => $solution) { ?>
                                <div class="solution-item-card">
                                    <div class="solution-number"><?php echo $index + 1; ?></div>
                                    <div class="solution-text"><?php echo htmlspecialchars($solution); ?></div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Target Achievement -->
                        <div class="prediction-card">
                            <div class="prediction-header">
                                <i class="fas fa-target"></i>
                                Produk Melebihi Target
                            </div>
                            <div class="prediction-content">
                                <div class="prediction-brand">LACK</div>
                                <div class="prediction-text">Telah melebihi target hari ini!</div>
                                <div style="width: 50px; height: 50px; margin: 8px auto;">
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
        // *** TAMBAHAN: Fungsi refresh AI suggestion ***
        function refreshAISuggestion() {
            const refreshBtn = document.getElementById('refreshAiBtn');
            const suggestionTitle = document.getElementById('aiSuggestionTitle');
            const suggestionContent = document.getElementById('aiSuggestionContent');
            const suggestionMeta = document.getElementById('aiSuggestionMeta');
            const suggestionTime = document.getElementById('aiSuggestionTime');
            
            // Add loading state
            refreshBtn.classList.add('loading');
            refreshBtn.disabled = true;
            
            // Show loading message
            suggestionContent.textContent = 'Generating new AI insight...';
            
            fetch('refresh_ai_suggestion_productsold.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        suggestionTitle.textContent = `AI Suggestion: ${data.data.insight_type}`;
                        suggestionContent.textContent = data.data.recommendation;
                        suggestionMeta.textContent = `${data.data.product_name} • ${data.data.urgency}`;
                        suggestionTime.textContent = data.data.generated_at;
                        
                        // Add success animation
                        const card = document.getElementById('aiSuggestionCard');
                        card.style.transform = 'scale(1.02)';
                        setTimeout(() => {
                            card.style.transform = 'scale(1)';
                        }, 200);
                    } else {
                        suggestionContent.textContent = data.data.recommendation;
                        console.error('AI Refresh Error:', data.message);
                    }
                })
                .catch(error => {
                    console.error('Network Error:', error);
                    suggestionContent.textContent = 'Failed to refresh AI suggestion. Please try again.';
                })
                .finally(() => {
                    // Remove loading state
                    refreshBtn.classList.remove('loading');
                    refreshBtn.disabled = false;
                });
        }

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

            const gradient = ctx.createLinearGradient(0, 0, 0, 280);
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
                        barThickness: 25
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 1500,
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
                            ticks: { color: "#666", font: { size: 11 } },
                            grid: { color: "#eee" }
                        },
                        x: {
                            ticks: { color: "#444", font: { size: 11 } },
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

        // Fungsi format rupiah singkat
        function formatRupiahSingkat(angka) {
            if (angka >= 1000000000) {
                return (angka / 1000000000).toFixed(1) + 'B';
            } else if (angka >= 1000000) {
                return (angka / 1000000).toFixed(1) + 'M';
            } else if (angka >= 1000) {
                return (angka / 1000).toFixed(1) + 'K';
            }
            return angka.toString();
        }

        window.addEventListener('DOMContentLoaded', function() {
            // Tunggu sampai semua elemen siap
            setTimeout(function() {
                renderChart();
                
                // Target achievement donut chart
                const ctxTargetElement = document.getElementById('donutTarget');
                if (ctxTargetElement) {
                    const ctxTarget = ctxTargetElement.getContext('2d');
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
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '70%',
                            plugins: {
                                legend: { display: false },
                                tooltip: { enabled: false },
                                title: { display: false }
                            }
                        }
                    });
                }

                // Category distribution donut chart
                const ctxCategory = document.getElementById('categoryDonutChart');
                if (ctxCategory) {
                    const chart = new Chart(ctxCategory.getContext('2d'), {
                        type: 'doughnut',
                        data: {
                            labels: Object.keys(categoryDistribution),
                            datasets: [{
                                data: Object.values(categoryDistribution),
                                backgroundColor: ['#1976d2', '#42a5f5', '#64b5f6', '#90caf9'],
                                borderWidth: 0,
                                hoverOffset: 8
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
                                    cornerRadius: 6,
                                    callbacks: {
                                        label: function(context) {
                                            return context.label + ': ' + context.parsed + '%';
                                        }
                                    }
                                }
                            },
                            animation: {
                                animateRotate: true,
                                duration: 1800
                            }
                        }
                    });
                }
            }, 100);
        });

        // Hide loader
        setTimeout(function() {
            document.getElementById('global-loader').style.display = 'none';
        }, 800);
    </script>

    <!-- Scripts -->
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
