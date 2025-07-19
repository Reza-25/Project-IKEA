<?php
require_once __DIR__ . '/../include/config.php';

// Query untuk mengambil data supplier
$sql = "SELECT * FROM supplier";
$stmt = $pdo->query($sql);
$suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Query untuk menghitung jumlah supplier
$total_suppliers = count($suppliers);

// Query untuk menghitung supplier baru bulan ini
$newSuppliersThisMonth = $pdo->query("
    SELECT COUNT(*) AS total 
    FROM supplier 
    WHERE MONTH(tanggal_registrasi) = MONTH(CURRENT_DATE()) 
      AND YEAR(tanggal_registrasi) = YEAR(CURRENT_DATE())
")->fetch(PDO::FETCH_ASSOC)['total'];

// Query untuk distribusi negara supplier
$sql_countries = "SELECT negara, COUNT(*) as jumlah FROM supplier GROUP BY negara";
$stmt_countries = $pdo->query($sql_countries);
$countries = $stmt_countries->fetchAll(PDO::FETCH_ASSOC);

// Hitung total supplier untuk persentase
$total_countries = 0;
foreach ($countries as $country) {
    $total_countries += $country['jumlah'];
}

// Persiapkan data untuk chart
$country_labels = [];
$country_data = [];
$country_colors = ['#2196f3', '#0d47a1', '#64b5f6', '#1976d2', '#ffca28'];
$i = 0;
foreach ($countries as $country) {
    $country_labels[] = $country['negara'];
    $country_data[] = ($country['jumlah'] / $total_countries) * 100;
    if ($i >= count($country_colors)) $i = 0;
    $i++;
}

// Query untuk komunikasi terbaru
$sql_comm = "SELECT k.*, s.Nama_Supplier 
             FROM komunikasi_supplier k 
             JOIN supplier s ON k.ID_Supplier = s.ID_Supplier 
             ORDER BY waktu DESC LIMIT 6";
$stmt_comm = $pdo->query($sql_comm);
$communications = $stmt_comm->fetchAll(PDO::FETCH_ASSOC);
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
    <title>RuanGku</title>

    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg" />

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/animate.css" />
    <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Export Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <style>
    :root {
      --white: #ffffff;
      --primary-blue: #1976d2;
      --secondary-blue: #42a5f5;
      --success-green: #4caf50;
      --danger-red: #f44336;
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
     .chart-container {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(33, 150, 243, 0.15);
        border: 2px solid rgba(33, 150, 243, 0.2);
        transition: all 0.3s ease;
        overflow: hidden;
      }

      .chart-container:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(33, 150, 243, 0.25);
        border: 2px solid rgba(33, 150, 243, 0.3);
      }

      .chart-wrapper {
        height: 500px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 2rem;
        background: linear-gradient(135deg, #f8fbff 0%, #e3f2fd 100%);
      }

      .chart-wrapper h5 {
        color: #0d47a1;
        font-weight: 700;
        margin-bottom: 1rem;
        text-align: center;
        font-size: 1.1rem;
      }

      .chart-canvas-container {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        max-height: 280px;
        margin: 1rem 0;
      }

      canvas {
        max-height: 280px;
        max-width: 100%;
      }

      .legend-container {
        margin-top: 1rem;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 1rem;
        padding-top: 1rem;
      }

      .legend-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        color: #0d47a1;
        font-weight: 600;
      }

      .legend-color {
        width: 16px;
        height: 16px;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      }

      /* Recent Communication Container */
      .communication-container {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(33, 150, 243, 0.15);
        border: 2px solid rgba(33, 150, 243, 0.2);
        overflow: hidden;
        transition: all 0.3s ease;
        height: 500px;
      }

      .communication-container:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(33, 150, 243, 0.25);
        border: 2px solid rgba(33, 150, 243, 0.3);
      }

      .communication-header {
        color: #0d47a1;
        padding: 2rem 2rem 1rem 2rem;
        text-align: center;
        background: linear-gradient(135deg, #f8fbff 0%, #e3f2fd 100%);
      }

      .communication-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 1.1rem;
      }

      .communication-body {
        padding: 1rem 2rem 4rem 2rem;
        max-height: 400px;
        overflow-y: auto;
        background: linear-gradient(135deg, #f8fbff 0%, #e3f2fd 100%);
        min-height: 450px;
      }

      .communication-item {
        display: flex;
        align-items: flex-start;
        padding: 0.8rem 0;
        margin-bottom: 0.6rem;
        border-bottom: 1px solid rgba(33, 150, 243, 0.1);
        transition: all 0.3s ease;
        opacity: 0;
        transform: translateY(20px);
        animation: slideUp 0.6s ease forwards;
      }

      .communication-item:last-child {
        border-bottom: none;
        padding-bottom: 4rem;
      }

      .communication-item:hover {
        transform: translateY(-2px);
        background: rgba(255, 255, 255, 0.5);
        border-radius: 8px;
        padding: 0.8rem;
        margin: 0.2rem 0;
      }

      .communication-item:nth-child(1) { animation-delay: 0.1s; }
      .communication-item:nth-child(2) { animation-delay: 0.2s; }
      .communication-item:nth-child(3) { animation-delay: 0.3s; }
      .communication-item:nth-child(4) { animation-delay: 0.4s; }
      .communication-item:nth-child(5) { animation-delay: 0.5s; }
      .communication-item:nth-child(6) { animation-delay: 0.6s; }

      @keyframes slideUp {
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      .comm-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 1rem;
        color: white;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
      }

      .comm-icon.call {
        background: linear-gradient(135deg, #ffca28 0%, #ff8f00 100%);
      }

      .comm-icon.email {
        background: linear-gradient(135deg, #2196f3 0%, #0d47a1 100%);
      }

      .comm-icon.update {
        background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%);
      }

      .comm-content {
        flex: 1;
      }

      .comm-title {
        font-weight: 600;
        color: #ff8f00;
        font-size: 0.9rem;
        margin-bottom: 0.2rem;
      }

      .comm-supplier {
        font-weight: 700;
        color: #2196f3;
        font-size: 0.9rem;
        margin-bottom: 0.2rem;
        text-decoration: underline;
      }

      .comm-message {
        color: #546e7a;
        font-size: 0.85rem;
        margin-bottom: 0.2rem;
      }

      .comm-time {
        color: #90a4ae;
        font-size: 0.8rem;
        font-weight: 500;
      }

      /* Metrics Content */
      .metrics-content {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        align-items: center;
        justify-content: center;
        height: 100%;
      }

      .metric-item {
        text-align: center;
      }

      .metric-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: #0d47a1;
        margin-bottom: 0.5rem;
      }

      .metric-label {
        font-size: 0.9rem;
        color: #546e7a;
        font-weight: 600;
      }

      /* Action Items */
      .action-item {
        display: flex;
        align-items: center;
        padding: 0.8rem 0;
        margin-bottom: 0.6rem;
        border-bottom: 1px solid rgba(33, 150, 243, 0.1);
        transition: all 0.3s ease;
        cursor: pointer;
      }

      .action-item:last-child {
        border-bottom: none;
        padding-bottom: 4rem;
      }

      .action-item:hover {
        transform: translateY(-2px);
        background: rgba(255, 255, 255, 0.7);
        border-radius: 8px;
        padding: 0.8rem;
        margin: 0.2rem 0;
        box-shadow: 0 4px 12px rgba(33, 150, 243, 0.1);
      }

      .action-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 1rem;
        color: white;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
      }

      .action-icon.add {
        background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%);
      }

      .action-icon.export {
        background: linear-gradient(135deg, #2196f3 0%, #0d47a1 100%);
      }

      .action-icon.report {
        background: linear-gradient(135deg, #ff9800 0%, #e65100 100%);
      }

      .action-icon.settings {
        background: linear-gradient(135deg, #607d8b 0%, #37474f 100%);
      }

      .action-icon.notification {
        background: linear-gradient(135deg, #e91e63 0%, #ad1457 100%);
      }

      .action-content {
        flex: 1;
      }

      .action-title {
        font-weight: 700;
        color: #0d47a1;
        font-size: 0.9rem;
        margin-bottom: 0.2rem;
      }

      .action-description {
        color: #546e7a;
        font-size: 0.8rem;
      }

      .communication-body::-webkit-scrollbar {
        width: 6px;
      }

      .communication-body::-webkit-scrollbar-track {
        background: rgba(33, 150, 243, 0.1);
        border-radius: 3px;
      }

      .communication-body::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #2196f3 0%, #0d47a1 100%);
        border-radius: 3px;
      }

      .communication-body::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #1976d2 0%, #0d47a1 100%);
      }

      /* Responsive adjustments */
      @media (max-width: 768px) {
        .chart-wrapper {
          height: 450px;
          padding: 1.5rem;
        }
        
        .chart-canvas-container {
          max-height: 240px;
        }
        
        canvas {
          max-height: 240px;
        }
      }

      /* Enhanced Supplier Data Table - Extended Width and Blue Gradient Headers */
      .supplier-table-section {
        background: white;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 25px;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
      }

      .supplier-table-section:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
      }

      /* Chart Header */
      .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f1f5f9;
      }

      .chart-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        display: flex;
        align-items: center;
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

      .supplier-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
      }

      .supplier-table th {
        background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
        color: #ffffff;
        font-weight: 600;
        font-size: 0.85rem;
        padding: 12px 10px;
        text-align: left;
        border-bottom: 2px solid #1565c0;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
      }

      .supplier-table th:first-child {
        border-top-left-radius: 8px;
      }

      .supplier-table th:last-child {
        border-top-right-radius: 8px;
      }

      .supplier-table td {
        padding: 12px 10px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.85rem;
        color: #374151;
        vertical-align: middle;
      }

      .supplier-table tbody tr:hover {
        background-color: #f8fafc;
        transition: all 0.2s ease;
      }

      .supplier-name-cell {
        display: flex;
        align-items: center;
        gap: 10px;
      }

      .supplier-avatar {
        width: 35px;
        height: 35px;
        background: linear-gradient(135deg, #42a5f5 0%, #1976d2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.9rem;
      }

      .supplier-name {
        font-weight: 600;
        color: #1e293b;
      }

      .supplier-code {
        background: #f1f5f9;
        color: #475569;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 500;
        display: inline-block;
        font-family: 'Courier New', monospace;
      }

      .supplier-country {
        background: #f8fafc;
        color: #64748b;
        padding: 4px 10px;
        border-radius: 15px;
        font-size: 0.75rem;
        font-weight: 500;
        display: inline-block;
        border: 1px solid #e2e8f0;
      }

      .supplier-email {
        color: #1976d2;
        text-decoration: none;
        font-weight: 500;
      }

      .supplier-email:hover {
        color: #0d47a1;
        text-decoration: underline;
      }

      .supplier-status {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 600;
        text-align: center;
      }

      .status-active { 
        background: #d1fae5; 
        color: #065f46; 
      }

      .status-inactive { 
        background: #fee2e2; 
        color: #991b1b; 
      }

      .status-pending { 
        background: #fef3c7; 
        color: #92400e; 
      }

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

      /* Responsive for supplier table */
      @media (max-width: 768px) {
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
        
        .supplier-table {
          font-size: 0.75rem;
        }
        
        .supplier-table th,
        .supplier-table td {
          padding: 8px 6px;
        }
        
        .supplier-name-cell {
          flex-direction: column;
          gap: 5px;
          text-align: center;
        }
        
        .supplier-avatar {
          width: 30px;
          height: 30px;
        }
        
        .pagination-controls {
          flex-wrap: wrap;
          gap: 6px;
        }
        
        .pagination-btn {
          padding: 6px 10px;
          font-size: 0.75rem;
        }
      }
    </style>
  </head>
  <body>
    <div id="global-loader">
      <div class="whirly-loader"></div>
    </div>

    <div class="main-wrapper">
      <!-- Include sidebar -->
      <?php include BASE_PATH . '/include/sidebar.php'; ?>
      <?php include __DIR__ . '/../include/header.php'; ?>
      </div>

      <div class="page-wrapper">
        <div class="content">
          <div class="page-header">
            <div class="page-title">
              <h4>Supplier List</h4>
              <h6>Manage your Supplier</h6>
            </div>
          </div>

          <!-- Total Expenses, Top Category, Top Expense, Avg Daily Expense -->
          <div class="row justify-content-end">
            <!-- Total Product Sold -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="revenue/revenue.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das1">
                  <div class="dash-counts">
                    <h4><span class="counters" data-count="<?= htmlspecialchars($total_suppliers) ?>"></span></h4>
                    <h5>Registered Suppliers</h5>
                    <h2 class="stat-change">+<?= htmlspecialchars($newSuppliersThisMonth) ?> baru bulan ini</h2>
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
                    <h4><span class="counters" data-count="87"></span></h4>
                    <h5>Most Active Suppliers</h5>
                  <h2 class="stat-change">65% of total</h2>
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
                    <h4><span class="counters" data-count="12"></span></h4>
                    <h5>Follow-Up Needed</h5>
                    <h2 class="stat-change">+3 dari minggu lalu</h2>
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
                    <h4>2.4 days</h4>
                    <h5>Avg. Response Time</h5>
                   <h2 class="stat-change">-1 hari dari bulan lalu</h2>
                    </div>
                    <div class="icon-box bg-hijau">
                      <i class="fa fa-chart-line"></i>
                    </div>
                </div>
              </a>
            </div>
          </div>
          <!-- END KOLOM  -->

          <div class="container py-3">
            <div class="row g-3">
              <!-- Enhanced Pie Chart -->
              <div class="col-md-6">
                <div class="chart-container">
                  <div class="chart-wrapper">
                    <h5>Distribusi Supplier Berdasarkan Negara</h5>
                    <div class="chart-canvas-container">
                      <canvas id="countryPieChart"></canvas>
                    </div>
                    <div class="legend-container">
                      <?php foreach ($countries as $index => $country): ?>
                      <div class="legend-item">
                        <div class="legend-color" style="background: <?= $country_colors[$index % count($country_colors)] ?>;"></div>
                        <span><?= htmlspecialchars($country['negara']) ?></span>
                      </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Recent Communication -->
              <div class="col-md-6">
                <div class="communication-container">
                  <div class="communication-header">
                    <h5>Recent Communication</h5>
                  </div>
                  <div class="communication-body">
                    <?php foreach ($communications as $comm): ?>
                    <div class="communication-item">
                      <div class="comm-icon <?= $comm['jenis'] ?>">
                        <i class="bi <?= $comm['jenis'] == 'call' ? 'bi-telephone-fill' : ($comm['jenis'] == 'email' ? 'bi-envelope-fill' : 'bi-arrow-clockwise') ?>"></i>
                      </div>
                      <div class="comm-content">
                        <div class="comm-title">
                          <?= ucfirst($comm['jenis']) ?> 
                          <?= $comm['jenis'] == 'call' ? 'with' : ($comm['jenis'] == 'email' ? 'sent to' : 'by') ?>
                        </div>
                        <div class="comm-supplier"><?= htmlspecialchars($comm['Nama_Supplier']) ?></div>
                        <div class="comm-message"><?= htmlspecialchars($comm['deskripsi']) ?></div>
                        <div class="comm-time">
                          <?= date('d M Y H:i', strtotime($comm['waktu'])) ?>
                        </div>
                      </div>
                    </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Enhanced Supplier Data Table - Full Width Professional with Search & Export -->
          <div class="supplier-table-section">
            <div class="chart-header">
              <h5 class="chart-title"><i class="fas fa-users me-2"></i>Data Supplier</h5>
              <div class="d-flex align-items-center gap-2">
                <span style="font-size: 0.8rem; color: #64748b;" id="totalSuppliersText">Total: <?= count($suppliers) ?> suppliers</span>
              </div>
            </div>
            
            <!-- Table Controls -->
            <div class="table-controls">
              <div class="search-container">
                <input type="text" class="search-input" id="searchInput" placeholder="Cari supplier, kode, email, atau negara...">
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
            
            <table class="supplier-table" id="supplierTable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Supplier Name</th>
                  <th>Code</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Country</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="supplierTableBody">
                <?php foreach ($suppliers as $index => $supplier): ?>
                <tr>
                  <td><?= $index + 1 ?></td>
                  <td>
                    <div class="supplier-name-cell">
                      <div class="supplier-avatar">
                        <i class="fas fa-building"></i>
                      </div>
                      <div class="supplier-info">
                        <span class="supplier-name"><?= htmlspecialchars($supplier['Nama_Supplier']) ?></span>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="supplier-code"><?= htmlspecialchars($supplier['kode_supplier']) ?></span>
                  </td>
                  <td><?= htmlspecialchars($supplier['telepon']) ?></td>
                  <td>
                    <a href="mailto:<?= htmlspecialchars($supplier['email']) ?>" class="supplier-email">
                      <?= htmlspecialchars($supplier['email']) ?>
                    </a>
                  </td>
                  <td>
                    <span class="supplier-country"><?= htmlspecialchars($supplier['negara']) ?></span>
                  </td>
                  <td>
                    <span class="supplier-status status-active">Active</span>
                  </td>
                </tr>
                <?php endforeach; ?>
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
                Menampilkan 1-<?= min(10, count($suppliers)) ?> dari <?= count($suppliers) ?> supplier
              </div>
              <div class="pagination-controls">
                <button class="pagination-btn" id="prevBtn" onclick="changePage(-1)">
                  <i class="fas fa-chevron-left"></i> Prev
                </button>
                <button class="pagination-btn active" id="page1Btn" onclick="goToPage(1)">1</button>
                <?php if (count($suppliers) > 10): ?>
                <button class="pagination-btn" id="page2Btn" onclick="goToPage(2)">2</button>
                <?php endif; ?>
                <?php if (count($suppliers) > 20): ?>
                <button class="pagination-btn" id="page3Btn" onclick="goToPage(3)">3</button>
                <?php endif; ?>
                <button class="pagination-btn" id="nextBtn" onclick="changePage(1)">
                  Next <i class="fas fa-chevron-right"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script>
        // Enhanced Pie Chart with animations and effects
        const ctx = document.getElementById('countryPieChart').getContext('2d');
        
        const chart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: <?= json_encode($country_labels) ?>,
            datasets: [{
              data: <?= json_encode($country_data) ?>,
              backgroundColor: <?= json_encode($country_colors) ?>,
              borderWidth: 3,
              borderColor: '#ffffff',
              hoverBorderWidth: 5,
              hoverBorderColor: '#ffffff',
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
                backgroundColor: 'rgba(13, 71, 161, 0.95)',
                titleColor: '#ffffff',
                bodyColor: '#ffffff',
                borderColor: '#2196f3',
                borderWidth: 2,
                cornerRadius: 12,
                displayColors: true,
                callbacks: {
                  label: function(context) {
                    const label = context.label || '';
                    const value = context.raw || 0;
                    return `${label}: ${value.toFixed(2)}%`;
                  }
                },
                titleFont: {
                  size: 14,
                  weight: 'bold'
                },
                bodyFont: {
                  size: 13
                },
                padding: 12
              },
            },
            animation: {
              animateRotate: true,
              animateScale: true,
              duration: 2000,
              easing: 'easeInOutQuart'
            },
            hover: {
              mode: 'nearest',
              intersect: true,
              animationDuration: 300
            },
            elements: {
              arc: {
                borderWidth: 3,
                hoverBorderWidth: 5
              }
            },
            onHover: (event, activeElements) => {
              event.native.target.style.cursor = activeElements.length > 0 ? 'pointer' : 'default';
            }
          }
        });

        // Add entrance animation for chart
        setTimeout(() => {
          chart.update('active');
        }, 500);

        // Enhanced Supplier Table Search and Pagination
        let currentPage = 1;
        const rowsPerPage = 10;
        let filteredData = [];
        let allSuppliers = [];

        // Collect all supplier data from the table
        document.addEventListener('DOMContentLoaded', function() {
          const tableRows = document.querySelectorAll('#supplierTableBody tr');
          allSuppliers = Array.from(tableRows).map(row => {
            const cells = row.querySelectorAll('td');
            return {
              no: cells[0]?.textContent?.trim() || '',
              name: cells[1]?.querySelector('.supplier-name')?.textContent?.trim() || '',
              code: cells[2]?.textContent?.trim() || '',
              phone: cells[3]?.textContent?.trim() || '',
              email: cells[4]?.textContent?.trim() || '',
              country: cells[5]?.textContent?.trim() || '',
              status: cells[6]?.textContent?.trim() || '',
              element: row
            };
          });
          filteredData = [...allSuppliers];
          updateTable();
          updatePagination();
        });

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
          const searchTerm = e.target.value.toLowerCase();
          
          if (searchTerm === '') {
            filteredData = [...allSuppliers];
          } else {
            filteredData = allSuppliers.filter(supplier => 
              supplier.name.toLowerCase().includes(searchTerm) ||
              supplier.code.toLowerCase().includes(searchTerm) ||
              supplier.phone.toLowerCase().includes(searchTerm) ||
              supplier.email.toLowerCase().includes(searchTerm) ||
              supplier.country.toLowerCase().includes(searchTerm) ||
              supplier.status.toLowerCase().includes(searchTerm)
            );
          }
          
          currentPage = 1;
          updateTable();
          updatePagination();
        });

        function updateTable() {
          const tableBody = document.getElementById('supplierTableBody');
          const noResults = document.getElementById('noResults');
          const startIndex = (currentPage - 1) * rowsPerPage;
          const endIndex = startIndex + rowsPerPage;
          const pageData = filteredData.slice(startIndex, endIndex);
          
          // Hide all rows first
          allSuppliers.forEach(supplier => {
            supplier.element.style.display = 'none';
          });
          
          if (pageData.length === 0) {
            noResults.style.display = 'block';
            document.getElementById('tablePagination').style.display = 'none';
          } else {
            noResults.style.display = 'none';
            document.getElementById('tablePagination').style.display = 'flex';
            
            // Show only the current page data
            pageData.forEach(supplier => {
              supplier.element.style.display = 'table-row';
            });
          }
          
          // Update total count
          document.getElementById('totalSuppliersText').textContent = `Total: ${filteredData.length} suppliers`;
        }

        function updatePagination() {
          const totalPages = Math.ceil(filteredData.length / rowsPerPage);
          const startItem = filteredData.length === 0 ? 0 : (currentPage - 1) * rowsPerPage + 1;
          const endItem = Math.min(currentPage * rowsPerPage, filteredData.length);
          
          document.getElementById('paginationInfo').textContent = 
            `Menampilkan ${startItem}-${endItem} dari ${filteredData.length} supplier`;
          
          // Update pagination buttons
          const prevBtn = document.getElementById('prevBtn');
          const nextBtn = document.getElementById('nextBtn');
          const page1Btn = document.getElementById('page1Btn');
          const page2Btn = document.getElementById('page2Btn');
          const page3Btn = document.getElementById('page3Btn');
          
          prevBtn.disabled = currentPage === 1;
          nextBtn.disabled = currentPage === totalPages || totalPages === 0;
          
          // Update page buttons visibility and active state
          [page1Btn, page2Btn, page3Btn].forEach((btn, index) => {
            if (btn) {
              const pageNum = index + 1;
              btn.style.display = pageNum <= totalPages ? 'inline-block' : 'none';
              btn.classList.toggle('active', pageNum === currentPage);
              btn.textContent = pageNum;
            }
          });
        }

        function changePage(direction) {
          const totalPages = Math.ceil(filteredData.length / rowsPerPage);
          const newPage = currentPage + direction;
          
          if (newPage >= 1 && newPage <= totalPages) {
            currentPage = newPage;
            updateTable();
            updatePagination();
          }
        }

        function goToPage(page) {
          const totalPages = Math.ceil(filteredData.length / rowsPerPage);
          
          if (page >= 1 && page <= totalPages) {
            currentPage = page;
            updateTable();
            updatePagination();
          }
        }

        // Export functions
        function exportToPDF() {
          const { jsPDF } = window.jspdf;
          const doc = new jsPDF();
          
          // Add title
          doc.setFontSize(18);
          doc.setTextColor(25, 118, 210);
          doc.text('Data Supplier IKEA', 20, 20);
          
          // Add date
          doc.setFontSize(10);
          doc.setTextColor(100);
          doc.text(`Generated on: ${new Date().toLocaleDateString()}`, 20, 30);
          
          // Prepare table data
          const tableData = filteredData.map(supplier => [
            supplier.no,
            supplier.name,
            supplier.code,
            supplier.phone,
            supplier.email,
            supplier.country,
            supplier.status
          ]);
          
          // Add table
          doc.autoTable({
            head: [['No', 'Supplier Name', 'Code', 'Phone', 'Email', 'Country', 'Status']],
            body: tableData,
            startY: 40,
            theme: 'grid',
            headStyles: {
              fillColor: [25, 118, 210],
              textColor: 255,
              fontStyle: 'bold'
            },
            styles: {
              fontSize: 8,
              cellPadding: 3
            },
            columnStyles: {
              0: { cellWidth: 15 },
              1: { cellWidth: 40 },
              2: { cellWidth: 25 },
              3: { cellWidth: 30 },
              4: { cellWidth: 45 },
              5: { cellWidth: 25 },
              6: { cellWidth: 20 }
            }
          });
          
          doc.save('supplier-data.pdf');
        }

        function exportToExcel() {
          const data = filteredData.map(supplier => ({
            'No': supplier.no,
            'Supplier Name': supplier.name,
            'Code': supplier.code,
            'Phone': supplier.phone,
            'Email': supplier.email,
            'Country': supplier.country,
            'Status': supplier.status
          }));
          
          const ws = XLSX.utils.json_to_sheet(data);
          const wb = XLSX.utils.book_new();
          XLSX.utils.book_append_sheet(wb, ws, 'Suppliers');
          
          // Style the header row
          const range = XLSX.utils.decode_range(ws['!ref']);
          for (let C = range.s.c; C <= range.e.c; ++C) {
            const address = XLSX.utils.encode_cell({ r: 0, c: C });
            if (!ws[address]) continue;
            ws[address].s = {
              font: { bold: true },
              fill: { fgColor: { rgb: "1976D2" } },
              color: { rgb: "FFFFFF" }
            };
          }
          
          XLSX.writeFile(wb, 'supplier-data.xlsx');
        }
      </script>
    </div>

    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/feather.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/plugins/select2/js/select2.min.js"></script>
    <script src="../assets/js/moment.min.js"></script>
    <script src="../assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalerts.min.js"></script>
    <script src="../assets/js/script.js"></script>
  </body>
</html>