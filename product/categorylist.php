<?php
require_once __DIR__ . '/../include/config.php'; // Import config.php
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

<link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg">
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/animate.css">
<link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


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

  style
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

/* css bar chart & notes */
.chart-notes-row {
    display: flex;
    gap: 20px;
    align-items: flex-start;
  }
  .chart-wrapper {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
    padding: 20px 24px;
    flex: 0 0 55%;
    display: flex;
    flex-direction: column;
    gap: 16px;
    min-width: 300px;
  }
  .chart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
  }
  .chart-title {
    font-size: 14px;
    font-weight: 600;
    color: #2c3e50;
    letter-spacing: 0.3px;
    font-family: 'Segoe UI', sans-serif;
  }
  .chart-select {
    font-size: 13px;
    padding: 6px 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    font-family: 'Segoe UI', sans-serif;
  }
  .notes-container {
    flex: 0 0 40%;
    background: #fff;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    min-width: 260px;
    max-height: 370px;      /* Tambahkan tinggi maksimum */
    overflow-y: auto;       /* Aktifkan scroll vertikal */
  }
  .note-title {
    font-size: 15px;
    color: white;
    margin-bottom: 15px;
    font-weight: 600;
    border-radius: 10px;
    padding: 10px 15px;
    background: linear-gradient(135deg, #0d6efd, #66bfff);
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .note-line {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    border-left: 4px solid transparent;
    border-radius: 8px;
    margin-bottom: 10px;
    transition: all 0.3s ease;
    cursor: pointer;
  }
  .note-line:hover {
    background-color: #f0f4ff;
  }
  .note-line.active {
    border-left: 4px solid #0d6efd;
    background-color: #eaf3ff;
  }
  .note-icon {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    color: #fff;
    font-size: 14px;
    flex-shrink: 0;
  }
  .bg-blue { background-color: #0d6efd; }
  .bg-green { background-color: #28a745; }
  .bg-orange { background-color: #fd7e14; }
  .bg-purple { background-color: #6f42c1; }
  .note-text {
    display: flex;
    justify-content: space-between;
    flex: 1;
  }
  .note-label {
    color: #555;
    font-size: 14px;
  }
  .note-value {
    font-size: 15px;
    font-weight: 600;
    color: #0d6efd;
  }
  @media (max-width: 900px) {
    .chart-notes-row {
      flex-direction: column;
    }
    .chart-wrapper, .notes-container {
      max-width: 100%;
      flex: 100%;
    }
  }
  /* END - css bar chart & notes  */

  /* css tabel */
  .container-wrapper {
    background: #fff;
    padding: 24px;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
    margin-top: 30px;
  }

  .d-flex-between {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
  }

  table {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    width: 100%;
    border-collapse: collapse;
    margin-top: 16px;
  }

  thead th {
    background-color:rgb(243, 250, 255) !important;
    color: #0d47a1 !important;
    font-weight: 600 !important;
    font-size: 15px !important;
    padding: 12px !important;
    text-align: center !important;
    letter-spacing: 0.5px !important;
    border-bottom: 3px solid #90caf9 !important;
    box-shadow: 0 2px 8px rgba(13, 71, 161, 0.06) !important;
  }

  tbody tr {
    transition: background-color 0.3s ease;
  }

  tbody tr:hover {
    background-color: #f1f9ff;
  }

  td {
    padding: 10px;
    text-align: center;
  }

  .btn {
    transition: all 0.3s ease;
    font-size: 13px;
    padding: 4px 10px;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  .btn.btn-primary {
    background-color: #0d6efd;
    color: #fff;
    border-radius: 20px;
  }

  .btn.btn-primary:hover {
    background-color: #084298;
    transform: scale(1.05);
  }

  .btn.view-detail {
    background-color: #0d6efd;
    color: #fff;
    border-radius: 20px;
    padding: 4px 10px;
  }

  .btn.view-detail:hover {
    background-color: #084298;
    transform: scale(1.05);
  }

  .export-container {
    background-color: #f1f1f1;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 12px;
  }

  @keyframes fadeInUp {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
  }

  .modal-popup {
    position: fixed;
    z-index: 9999;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    border-radius: 12px;
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.25);
    padding: 20px;
    width: 320px;
    animation: fadeInUp 0.5s ease;
  }

  .modal-popup .modal-header {
    background-color: #0d6efd;
    color: white;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    padding: 10px 15px;
  }

  .modal-popup .modal-body {
    padding: 10px 15px;
  }

  #searchInput {
    padding: 8px 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
    max-width: 280px;
    font-size: 14px;
  }

  .status-pill {
    padding: 4px 8px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  .status-pill::before {
    content: "";
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
  }

  .status-active {
    background-color: #d4edda;
    color: #155724;
  }

  .status-active::before {
    background-color: #28a745;
  }

  .status-pending {
    background-color: #fff3cd;
    color: #856404;
  }

  .status-pending::before {
    background-color: #ffc107;
  }

  .status-ordered {
    background-color: #cce5ff;
    color: #004085;
  }

  .status-ordered::before {
    background-color: #007bff;
  }

  .status-inactive {
    background-color: #f8d7da;
    color: #721c24;
  }

  .status-inactive::before {
    background-color: #dc3545;
  }
  /* END- css tabel */

  /* Hilangkan kotak pada tombol prev, next, dan view detail */
.prev-next-btn,
.btn.view-detail,
.btn.btn-sm[style*="border:1px solid"] {
  background: none !important;
  color: #0d47a1 !important;
  border: none !important;
  border-radius: 999px !important;
  box-shadow: none !important;
  padding: 4px 16px !important;
  font-size: 13px !important;
  transition: background 0.2s, color 0.2s;
}
.prev-next-btn:hover,
.btn.view-detail:hover,
.btn.btn-sm[style*="border:1px solid"]:hover {
  background: #e3f2fd !important;
  color: #084298 !important;
}

.btn.view-detail,
.btn.btn-sm[style*="border:1px solid"] {
  padding: 4px 16px !important;
  font-size: 13px !important;
  border: none !important;
  background: none !important;
  color: #0d47a1 !important;
  border-radius: 999px !important;
  box-shadow: none !important;
}

/* MIS Log & Insight Card */
#mis-log-insight {
  align-items: stretch;
}
#mis-log-insight .mis-card {
  display: flex;
  flex-direction: column;
  height: 100%;
  min-height: 20px;
  background: linear-gradient(120deg, #f8fbff 80%, #e3f2fd 100%);
  border-radius: 18px;
  box-shadow: 0 6px 18px rgba(13,71,161,0.09);
  padding: 22px 26px 18px 26px;
  border-left: 6px solid #0d47a1;
  transition: box-shadow 0.2s, transform 0.2s;
  margin-bottom: 0;
}
#mis-log-insight .mis-card:hover {
  box-shadow: 0 14px 36px rgba(13,71,161,0.16);
  transform: translateY(-2px) scale(1.01);
}
.mis-card-header {
  font-size: 17px;
  font-weight: 700;
  color: #0d47a1;
  margin-bottom: 14px;
  display: flex;
  align-items: center;
  gap: 8px;
  letter-spacing: 0.2px;
}
.mis-log-list {
  max-height: 170px;
  overflow-y: auto !important;    /* Aktifkan scroll vertikal */
  overflow-x: hidden !important;  /* Hilangkan scroll horizontal */
  font-size: 14px;
  background: none;
  border: none;
  padding-left: 0;
  flex-grow: 1;
  scrollbar-width: thin;
  scrollbar-color: #90caf9 #f8fbff;
}
.mis-log-list::-webkit-scrollbar {
  width: 7px;
  background: #f8fbff;
}
.mis-log-list::-webkit-scrollbar-thumb {
  background: #90caf9;
  border-radius: 8px;
}
.mis-log-list li {
  background: linear-gradient(90deg, #f8fbff 80%, #e3f2fd 100%);
  border-radius: 12px;
  margin-bottom: 10px;
  border: none;
  box-shadow: 0 2px 8px rgba(13,71,161,0.06);
  padding: 13px 18px;
  color: #222;
  transition: background 0.2s, transform 0.2s;
  border-left: 5px solid #90caf9;
  position: relative;
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 14px;
  animation: fadeInUp 0.5s;
}
.mis-log-list li:hover {
  background: #e3f2fd;
  transform: scale(1.01);
  border-left: 5px solid #0d47a1;
}
.mis-log-list .log-status-label {
  font-size: 12px;
  font-weight: 600;
  margin-right: 10px;
  letter-spacing: 0.5px;
  color: #fff;
  padding: 3px 14px;
  border-radius: 12px;
  vertical-align: middle;
  display: inline-block;
}
.log-status-add {
  background: #4caf50;
}
.log-status-update {
  background: #ffc107;
  color: #333 !important;
}
.log-status-delete {
  background: #f44336;
}
.mis-log-list span.log-time {
  color: #888;
  font-size: 12px;
  margin-right: 8px;
  min-width: 98px;
  display: inline-block;
}
/* ...existing styles... */
.mis-ai-insight {
  font-size: 14px;
  color: #222;
  line-height: 1.7;
  padding-left: 0;
  max-height: 170px;
  overflow-y: auto;
  flex-grow: 1;
  display: flex;
  flex-direction: column;
  gap: 0;
}
.mis-ai-list {
  list-style: none;
  padding: 0;
  margin: 0;
}
.mis-ai-item {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  background: #f8fbff;
  border-radius: 10px;
  margin-bottom: 10px;
  padding: 12px 14px 12px 16px;
  box-shadow: 0 2px 8px rgba(13,71,161,0.04);
  transition: background 0.2s, border-color 0.2s;
  position: relative;
  animation: fadeInUp 0.5s;
}
.mis-ai-item:last-child {
  margin-bottom: 0;
}
.mis-ai-icon {
  font-size: 18px;
  width: 32px;
  height: 32px;
  background: linear-gradient(135deg, #0d47a1 60%, #66bfff 100%);
  color: #fff;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  margin-top: 2px;
  box-shadow: 0 2px 8px rgba(13,71,161,0.07);
}
.mis-ai-content {
  flex: 1;
  font-size: 14px;
  color: #0d47a1;
}
.mis-ai-content b {
  color: #0d47a1;
}
.mis-ai-content span {
  color: #1976d2;
  font-weight: 600;
}
.mis-ai-item:hover {
  background: #e3f2fd;
  border-left: 5px solid #1976d2;
}
@media (max-width: 900px) {
  #mis-log-insight .mis-card { margin-bottom: 18px; }
  #mis-log-insight { flex-direction: column; }
}

/* ...existing code... */

/* Tambahan: Scrollbar custom untuk notes-container & mis-ai-insight */
.notes-container,
.mis-ai-insight {
  scrollbar-width: thin;
  scrollbar-color: #90caf9 #f8fbff;
}
.notes-container::-webkit-scrollbar,
.mis-ai-insight::-webkit-scrollbar {
  width: 7px;
  background: #f8fbff;
}
.notes-container::-webkit-scrollbar-thumb,
.mis-ai-insight::-webkit-scrollbar-thumb {
  background: #90caf9;
  border-radius: 8px;
}

/* Hilangkan scrollbar pada notes-container */
.notes-container {
  scrollbar-width: none !important;
}
.notes-container::-webkit-scrollbar {
  display: none !important;
}

/* Scrollbar pada mis-ai-insight tetap seperti aktivitas log */
.mis-ai-insight {
  scrollbar-width: thin;
  scrollbar-color: #90caf9 #f8fbff;
}
.mis-ai-insight::-webkit-scrollbar {
  width: 7px;
  background: #f8fbff;
}
.mis-ai-insight::-webkit-scrollbar-thumb {
  background: #90caf9;
  border-radius: 8px;
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
        <h4>Product Category list</h4>
        <h6>View/Search product Category</h6>
      </div>
      <div class="page-btn">
        <a href="addcategory.php" class="btn btn-added">
          <img src="../assets/img/icons/plus.svg" class="me-1" alt="img">Add Category
        </a>
      </div>
    </div>

    <!-- Revenue, Suppliers, Product Sold, Budget Spent -->
          <div class="row justify-content-end">
            <!-- Total Product Sold -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="revenue/revenue.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das1">
                  <div class="dash-counts">
                    <h4>$<span class="counters" data-count="385656.50">385,656.50</span></h4>
                    <h5>Total Product Sold</h5>
                    <h2 class="stat-change">+9% from last year</h2>
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
                    <h4>Furniture</h4>
                    <h5>Top Category</h5>
                  <h2 class="stat-change">+9% from last year</h2>
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
                    <h4>Sofa KVK</span></h4>
                    <h5>Top-Selling Product</h5>
                    <h2 class="stat-change">+15% from last year</h2>
                  </div>
                  <div class="icon-box bg-merah">
                    <i class="fa fa-trophy"></i>
                  </div>
                </div>
              </a>
            </div>

            <!-- Average Product Sales -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="expense/expensecategory.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das4">
                  <div class="dash-counts">
                    <h4>$<span class="counters" data-count="185556.30">185,556.30</span></h4>
                    <h5>Avg. Product Sales</h5>
                   <h2 class="stat-change">+6% from last year</h2>
                    </div>
                    <div class="icon-box bg-hijau">
                      <i class="fa fa-chart-line"></i>
                    </div>
                </div>
              </a>
            </div>
          </div>
          <!-- END KOLOM  -->

    <!-- 🟡 Tambahan: DASHBOARD KATEGORI & PRODUK -->
    <div class="row justify-content-end mb-4">
      <!-- Total Category -->
      <div class="col-lg-4 col-sm-6 col-12 d-flex">
        <a href="productsold.php" class="w-100 text-decoration-none text-dark">
          <div class="dash-count das2">
            <div class="dash-counts">
              <h4><span class="counters" data-count="21">2.1</span></h4>
              <h5>Total Category</h5>
            </div>
            <div class="dash-imgs">
              <i data-feather="layers"></i>
            </div>
          </div>
        </a>
      </div>

      <!-- Total Product -->
      <div class="col-lg-4 col-sm-6 col-12 d-flex">
        <a href="productsold.php" class="w-100 text-decoration-none text-dark">
          <div class="dash-count das2">
            <div class="dash-counts">
              <h4><span class="counters" data-count="12000">12.000</span></h4>
              <h5>Total Product</h5>
            </div>
            <div class="dash-imgs">
              <i data-feather="box"></i>
            </div>
          </div>
        </a>
      </div>

      <!-- Upcoming -->
      <div class="col-lg-4 col-sm-6 col-12 d-flex">
        <a href="productsold.php" class="w-100 text-decoration-none text-dark">
          <div class="dash-count das2" style="padding: 20px; background-color: #FFCC00; border-radius: 10px; color: black;">
            <div class="dash-counts">
              <h4>Upcoming Items</h4>
              <p style="margin: 0; font-weight: bold;">📁 Category: <span class="counters" data-count="6">6</span></p>
              <p style="margin: 0; font-weight: bold;">📦 Product: <span class="counters" data-count="376">376</span></p>
            </div>
            <div class="dash-imgs" style="margin-top: auto;">
              <i data-feather="clock"></i>
            </div>
          </div>
        </a>
      </div>
    </div>
    <!-- END DASHBOARD -->

<!-- Chart & Notes Row -->
<div class="chart-notes-row">
  <!-- Chart Wrapper -->
  <div class="chart-wrapper">
    <div class="chart-header">
      <div class="chart-title">Total Product Sold per Bulan</div>
      <div>
        <button id="prevKategori" class="btn btn-outline-primary btn-sm">⏮ Prev</button>
        <button id="nextKategori" class="btn btn-outline-primary btn-sm">⏭ Next</button>
        <select id="tahun" class="chart-select">
          <option value="2023">2023</option>
          <option value="2024">2024</option>
          <option value="2025" selected>2025</option>
        </select>
      </div>
    </div>

    <!-- Kategori Aktif di Tengah -->
    <div class="text-center fw-bold mt-1" style="font-size: 16px; color: #0d47a1;">
      Kategori: <span id="kategoriAktif" style="padding: 0 4px;">-</span>
    </div>

    <!-- PENTING: canvas tetap id="chartProduk" -->
    <div style="position: relative; height: 320px;">
      <canvas id="chartProduk"></canvas>
    </div>
  </div>

  <!-- Notes -->
  <div class="notes-container">
    <!-- Notes akan diisi secara dinamis oleh JavaScript -->
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const kategoriList = [
    "Furniture", "Lighting", "Storage", "Bedroom", "Living Room",
    "Kitchen", "Dining", "Office", "Outdoor", "Textiles",
    "Decoration", "Bathroom", "Children", "Appliances", "Rugs",
    "Curtains", "Tableware", "Cookware", "Laundry", "Cleaning", "Pet"
  ];

  let currentKategoriIndex = 0;
  const bulanShort = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];

  const dataTahun = {};
  for (let tahun = 2023; tahun <= 2025; tahun++) {
    dataTahun[tahun] = {};
    kategoriList.forEach(kategori => {
      dataTahun[tahun][kategori] = bulanShort.map((bulan, i) => {
        const total = Math.floor(Math.random() * 1000) + 100;
        const topProduct = `${kategori} Product ${i + 1}`;
        const topCategory = kategori;
        const avg = Math.floor(total / 3);
        return {
          bulan,
          totalSold: total,
          topProduct,
          topCategory,
          avgSold: avg
        };
      });
    });
  }

  const notesMap = {
    "Furniture": { totalProduk: 2100, kontribusi: "18% dari seluruh penjualan IKEA", produkKurangLaku: "5 produk < 10 unit", lowStock: "8 produk < 10 stok", insight: "Promo + restok Rak KALLAX", toko: "IKEA Alam Sutera" },
    "Lighting": { totalProduk: 900, kontribusi: "7% dari seluruh penjualan IKEA", produkKurangLaku: "3 produk", lowStock: "5 produk", insight: "Perbanyak stok LED Hemat Energi", toko: "IKEA Sentul" },
    "Storage": { totalProduk: 1100, kontribusi: "9% dari seluruh penjualan IKEA", produkKurangLaku: "2 produk", lowStock: "4 produk", insight: "Push marketing Lemari Serbaguna", toko: "IKEA Kota Baru" },
    "Bedroom": { totalProduk: 1400, kontribusi: "11% dari seluruh penjualan IKEA", produkKurangLaku: "4 produk", lowStock: "7 produk", insight: "Diskon Paket Kasur + Lemari", toko: "IKEA Alam Sutera" },
    "Living Room": { totalProduk: 1300, kontribusi: "10% dari seluruh penjualan IKEA", produkKurangLaku: "3 produk", lowStock: "2 produk", insight: "Tampilkan Sofa Premium", toko: "IKEA Surabaya" },
    "Kitchen": { totalProduk: 1200, kontribusi: "9% dari seluruh penjualan IKEA", produkKurangLaku: "5 produk", lowStock: "6 produk", insight: "Campaign dapur modular", toko: "IKEA Bali" },
    "Dining": { totalProduk: 800, kontribusi: "6% dari seluruh penjualan IKEA", produkKurangLaku: "4 produk", lowStock: "3 produk", insight: "Gabungkan bundling Meja + Kursi", toko: "IKEA Bandung" },
    "Office": { totalProduk: 750, kontribusi: "5% dari seluruh penjualan IKEA", produkKurangLaku: "3 produk", lowStock: "2 produk", insight: "Naikkan ads ergonomic chair", toko: "IKEA Surabaya" },
    "Outdoor": { totalProduk: 670, kontribusi: "4.5% dari seluruh penjualan IKEA", produkKurangLaku: "5 produk", lowStock: "2 produk", insight: "Highlight produk tahan cuaca", toko: "IKEA Bali" },
    "Textiles": { totalProduk: 720, kontribusi: "5.2% dari seluruh penjualan IKEA", produkKurangLaku: "6 produk", lowStock: "3 produk", insight: "Tambah varian warna gorden", toko: "IKEA Jakarta Garden City" },
    "Decoration": { totalProduk: 680, kontribusi: "5% dari seluruh penjualan IKEA", produkKurangLaku: "3 produk", lowStock: "4 produk", insight: "Bundle dekorasi minimalis", toko: "IKEA Sentul" },
    "Bathroom": { totalProduk: 610, kontribusi: "4% dari seluruh penjualan IKEA", produkKurangLaku: "4 produk", lowStock: "5 produk", insight: "Restok rak mandi gantung", toko: "IKEA Surabaya" },
    "Children": { totalProduk: 550, kontribusi: "3.7% dari seluruh penjualan IKEA", produkKurangLaku: "6 produk", lowStock: "4 produk", insight: "Tambah kursi anak multifungsi", toko: "IKEA Bali" },
    "Appliances": { totalProduk: 490, kontribusi: "3.2% dari seluruh penjualan IKEA", produkKurangLaku: "2 produk", lowStock: "1 produk", insight: "Highlight hemat energi", toko: "IKEA Sentul" },
    "Rugs": { totalProduk: 430, kontribusi: "2.9% dari seluruh penjualan IKEA", produkKurangLaku: "1 produk", lowStock: "3 produk", insight: "Diskon karpet rajut", toko: "IKEA Bandung" },
    "Curtains": { totalProduk: 390, kontribusi: "2.7% dari seluruh penjualan IKEA", produkKurangLaku: "2 produk", lowStock: "2 produk", insight: "Tingkatkan stok sheer curtain", toko: "IKEA Kota Baru" },
    "Tableware": { totalProduk: 320, kontribusi: "2.3% dari seluruh penjualan IKEA", produkKurangLaku: "3 produk", lowStock: "1 produk", insight: "Promo piring set", toko: "IKEA Alam Sutera" },
    "Cookware": { totalProduk: 280, kontribusi: "2.1% dari seluruh penjualan IKEA", produkKurangLaku: "2 produk", lowStock: "1 produk", insight: "Kolaborasi chef influencer", toko: "IKEA Jakarta Garden City" },
    "Laundry": { totalProduk: 240, kontribusi: "1.8% dari seluruh penjualan IKEA", produkKurangLaku: "3 produk", lowStock: "2 produk", insight: "Pasarkan keranjang lipat", toko: "IKEA Bandung" },
    "Cleaning": { totalProduk: 200, kontribusi: "1.5% dari seluruh penjualan IKEA", produkKurangLaku: "1 produk", lowStock: "1 produk", insight: "Gabung produk bundling pembersih", toko: "IKEA Surabaya" },
    "Pet": { totalProduk: 180, kontribusi: "1.2% dari seluruh penjualan IKEA", produkKurangLaku: "1 produk", lowStock: "1 produk", insight: "Tampilkan sofa hewan peliharaan", toko: "IKEA Kota Baru" }
  };

  let chart;
  const ctx = document.getElementById('chartProduk').getContext('2d');

  function renderChart(data, tahun, kategori) {
    const labels = data.map(item => item.bulan);
    const values = data.map(item => item.totalSold);

    if (chart) chart.destroy();

    const gradient = ctx.createLinearGradient(0, 0, 0, 320);
    gradient.addColorStop(0, "#0d47a1");
    gradient.addColorStop(1, "#66bfff");

    chart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: `Total Produk Terjual - ${tahun}`,
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
            updateNotes(data[i], tahun);
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

    document.getElementById("kategoriAktif").textContent = kategori;
    updateNotes(data[0], tahun);
  }

  function updateNotes(item, tahun) {
    const kategori = kategoriList[currentKategoriIndex];
    const note = notesMap[kategori];

    document.querySelector(".notes-container").innerHTML = `
      <div class="note-title">Detail Kategori: <span>${kategori} - ${tahun}</span></div>

      <div class="note-line">
        <div class="note-icon bg-blue"><i class="fas fa-box"></i></div>
        <div class="note-text">
          <div class="note-label">Total Penjualan</div>
          <div class="note-value">${item.totalSold} unit</div>
        </div>
      </div>

      <div class="note-line">
        <div class="note-icon bg-green"><i class="fas fa-tags"></i></div>
        <div class="note-text">
          <div class="note-label">Total Produk</div>
          <div class="note-value">${note.totalProduk}</div>
        </div>
      </div>

      <div class="note-line">
        <div class="note-icon bg-orange"><i class="fas fa-star"></i></div>
        <div class="note-text">
          <div class="note-label">Rata-rata Penjualan</div>
          <div class="note-value">${item.avgSold} unit/bulan</div>
        </div>
      </div>

      <div class="note-line">
        <div class="note-icon bg-purple"><i class="fas fa-chart-line"></i></div>
        <div class="note-text">
          <div class="note-label">Kontribusi</div>
          <div class="note-value">${note.kontribusi}</div>
        </div>
      </div>

      <div class="note-line">
        <div class="note-icon bg-blue"><i class="fas fa-trophy"></i></div>
        <div class="note-text">
          <div class="note-label">Produk Terlaris</div>
          <div class="note-value">${item.topProduct}</div>
        </div>
      </div>

      <div class="note-line">
        <div class="note-icon bg-orange"><i class="fas fa-arrow-down"></i></div>
        <div class="note-text">
          <div class="note-label">Produk Kurang Laku</div>
          <div class="note-value">${note.produkKurangLaku}</div>
        </div>
      </div>

      <div class="note-line">
        <div class="note-icon bg-green"><i class="fas fa-battery-quarter"></i></div>
        <div class="note-text">
          <div class="note-label">Produk Low Stock</div>
          <div class="note-value">${note.lowStock}</div>
        </div>
      </div>

      <div class="note-line">
        <div class="note-icon bg-purple"><i class="fas fa-brain"></i></div>
        <div class="note-text">
          <div class="note-label">Insight AI</div>
          <div class="note-value">${note.insight}</div>
        </div>
      </div>

      <div class="note-line">
        <div class="note-icon bg-blue"><i class="fas fa-store"></i></div>
        <div class="note-text">
          <div class="note-label">Toko Penjual Terbaik</div>
          <div class="note-value">${note.toko}</div>
        </div>
      </div>
    `;
  }

  function loadChartByKategori() {
    const tahun = document.getElementById("tahun").value;
    const kategori = kategoriList[currentKategoriIndex];
    const data = dataTahun[tahun][kategori];
    renderChart(data, tahun, kategori);
  }

  document.getElementById("prevKategori").addEventListener("click", () => {
    currentKategoriIndex = (currentKategoriIndex - 1 + kategoriList.length) % kategoriList.length;
    loadChartByKategori();
  });

  document.getElementById("nextKategori").addEventListener("click", () => {
    currentKategoriIndex = (currentKategoriIndex + 1) % kategoriList.length;
    loadChartByKategori();
  });

  document.getElementById("tahun").addEventListener("change", loadChartByKategori);
  window.onload = loadChartByKategori;
</script>

  <!-- Tambahkan di bawah .chart-notes-row sebelum tabel kategori -->
<div class="row mt-4" id="mis-log-insight" style="align-items: stretch;">
  <!-- Aktivitas Log -->
  <div class="col-lg-7 mb-3 d-flex">
    <div class="mis-card flex-fill d-flex flex-column" style="height:100%;">
      <div class="mis-card-header">
        <i class="fa fa-history me-2"></i>Aktivitas Log
      </div>
      <!-- Hilangkan scroll bawah: overflow-y:hidden -->
      <ul id="activityLog" class="list-group list-group-flush mis-log-list flex-grow-1" style="overflow-y:hidden;"></ul>
    </div>
  </div>
  <!-- Insight AI -->
  <div class="col-lg-5 mb-3 d-flex">
    <div class="mis-card flex-fill d-flex flex-column" style="height:100%;">
      <div class="mis-card-header">
        <i class="fa fa-brain me-2"></i>Insight AI
      </div>
      <!-- Tampilan insight AI lebih menarik, tetap scrollable -->
      <div id="aiInsight" class="mis-ai-insight flex-grow-1"></div>
    </div>
  </div>
</div>


<script>
  // Data dummy aktivitas log dengan status
  const activityLogData = [
    { waktu: "2025-07-02 09:15", aktivitas: "Admin A menambah kategori <b>Furniture</b>", status: "Tambah" },
    { waktu: "2025-07-02 09:20", aktivitas: "Admin B mengubah status <b>Lighting</b> menjadi Inactive", status: "Update" },
    { waktu: "2025-07-02 09:30", aktivitas: "Admin C memperbarui deskripsi <b>Storage</b>", status: "Update" },
    { waktu: "2025-07-02 09:45", aktivitas: "Admin D menambah kategori <b>Bedroom</b>", status: "Tambah" },
    { waktu: "2025-07-02 10:00", aktivitas: "Admin E mengubah status <b>Living Room</b> menjadi Pending", status: "Update" },
    { waktu: "2025-07-02 10:10", aktivitas: "Admin F menghapus kategori <b>Outdoor</b>", status: "Hapus" },
    { waktu: "2025-07-02 10:20", aktivitas: "Admin G menambah kategori <b>Kitchen</b>", status: "Tambah" },
    { waktu: "2025-07-02 10:25", aktivitas: "Admin H mengubah deskripsi <b>Dining</b>", status: "Update" }
  ];

  // Mapping warna status
  function getStatusLabel(status) {
    if (status === "Tambah") return `<span class="log-status-label log-status-add">Tambah</span>`;
    if (status === "Update") return `<span class="log-status-label log-status-update">Update</span>`;
    if (status === "Hapus") return `<span class="log-status-label log-status-delete">Hapus</span>`;
    return `<span class="log-status-label">${status}</span>`;
  }

  function renderActivityLog() {
    const ul = document.getElementById("activityLog");
    ul.innerHTML = "";
    activityLogData.forEach(item => {
      const li = document.createElement("li");
      li.className = "list-group-item";
      li.innerHTML = `
        <span class="log-time">${item.waktu}</span>
        ${getStatusLabel(item.status)}
        &mdash; ${item.aktivitas.replace(/<b>(.*?)<\/b>/g, '')}
      `;
      ul.appendChild(li);
    });
  }

  // Data insight AI dengan icon dan highlight
  const aiInsightData = [
    {
      icon: "📊",
      html: "<b>Tren Penjualan:</b> Kategori <span>Furniture</span> tetap menjadi kontributor utama dengan pertumbuhan 9% YoY."
    },
    {
      icon: "⚠️",
      html: "<b>Risiko Stok:</b> 8 produk <span style='color:#e78001;'>low stock</span> pada kategori <b>Furniture</b> dan <b>Kitchen</b>. Rekomendasi: lakukan restock segera."
    },
    {
      icon: "💡",
      html: "<b>Peluang:</b> Produk <span style='color:#28a745;'>Sofa KVK</span> dan <span>Rak KALLAX</span> berpotensi untuk promo bundling bulan depan."
    },
    {
      icon: "🔔",
      html: "<b>Alert:</b> Ada 5 produk dengan penjualan &lt; 10 unit di kategori <b>Textiles</b> dan <b>Children</b>. Rekomendasi: evaluasi strategi pemasaran."
    },
    {
      icon: "🤖",
      html: "<b>AI Suggestion:</b> Optimalkan campaign digital untuk kategori <b>Lighting</b> dan <b>Office</b> yang mengalami penurunan minat."
    },
    {
      icon: "🔥",
      html: "<b>Rekomendasi AI:</b> Coba flash sale untuk <span>Outdoor</span> menjelang akhir pekan."
    },
    {
      icon: "🚩",
      html: "<b>AI Alert:</b> Produk <span>Tableware</span> mulai menurun, cek stok dan review harga."
    }
  ];

  function renderAIInsight() {
    const container = document.getElementById("aiInsight");
    let html = `<ul class="mis-ai-list">`;
    aiInsightData.forEach(item => {
      html += `
        <li class="mis-ai-item">
          <div class="mis-ai-icon">${item.icon}</div>
          <div class="mis-ai-content">${item.html}</div>
        </li>
      `;
    });
    html += `</ul>`;
    container.innerHTML = html;
  }

  // Panggil saat halaman load
  renderActivityLog();
  renderAIInsight();
</script>
<!-- Tabel Kategori dengan Modal Detail -->
<div>
  <div class="d-flex-between my-2">
    <input type="text" id="searchInput" placeholder="Cari kategori..." oninput="filterTable()">
    <div class="d-flex gap-2">
      <button class="btn btn-primary" style="font-size:12px;" onclick="exportToExcel()">
        <i class="fa fa-file-excel"></i> Export Excel
      </button>
      <button class="btn btn-danger" style="font-size:12px;" onclick="exportToPDF()">
        <i class="fa fa-file-pdf"></i> Export PDF
      </button>
    </div>
  </div>
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>No</th>
        <th>Category ID</th>
        <th>Category</th>
        <th>Description</th>
        <th>Status</th>
        <th>View Detail</th>
      </tr>
    </thead>
    <tbody id="kategoriTableBody"></tbody>
  </table>
  <div class="d-flex justify-content-end gap-2 mt-2">
    <button class="btn prev-next-btn" onclick="prevPage()">⬅ Prev</button>
    <button class="btn prev-next-btn" onclick="nextPage()">Next ➡</button>
  </div>
</div>

<!-- Modal Popup untuk Detail Kategori -->
<div id="categoryDetailPopup" class="modal-popup d-none">
  <div class="modal-header d-flex justify-content-between align-items-center">
    <span>Detail Kategori</span>
    <button onclick="closePopup()" style="background:none;border:none;font-size:18px;">&times;</button>
  </div>
  <div class="modal-body">
    <ul id="modalContent" class="list-group list-group-flush"></ul>
  </div>
</div>

<script>
  const categoryData = [
    ["CAT-01", "Furniture", "Furnitur rumah", 1200, "01 Jan 2022", "Admin A", "19 Nov 2022", "Active", "product1.jpg", "-", 89],
    ["CAT-02", "Lighting", "Pencahayaan rumah modern", 800, "10 Jan 2022", "Admin B", "15 Nov 2022", "Inactive", "product2.jpg", "Furniture", 78],
    ["CAT-03", "Storage", "Lemari dan rak serbaguna", 950, "20 Jan 2022", "Admin C", "10 Nov 2022", "Pending", "product3.jpg", "Furniture", 70],
    ["CAT-04", "Bedroom", "Perlengkapan kamar tidur", 1000, "01 Feb 2022", "Admin D", "12 Nov 2022", "Active", "product4.jpg", "Furniture", 82],
    ["CAT-05", "Living Room", "Dekorasi dan sofa ruang tamu", 1100, "05 Feb 2022", "Admin E", "19 Nov 2022", "Pending", "product5.jpg", "Furniture", 85],
    ["CAT-06", "Kitchen", "Peralatan dapur modern", 700, "10 Feb 2022", "Admin F", "22 Nov 2022", "Active", "product6.jpg", "Dining", 68],
    ["CAT-07", "Dining", "Meja makan dan aksesoris", 600, "15 Feb 2022", "Admin G", "25 Nov 2022", "Ordered", "product7.jpg", "Kitchen", 62],
    ["CAT-08", "Office", "Furniture kantor fungsional", 550, "20 Feb 2022", "Admin H", "28 Nov 2022", "Active", "product1.jpg", "Furniture", 60],
    ["CAT-09", "Outdoor", "Furniture dan dekorasi luar ruangan", 400, "01 Mar 2022", "Admin I", "02 Dec 2022", "Pending", "product2.jpg", "Furniture", 58],
    ["CAT-10", "Textiles", "Tekstil dan karpet rumah", 650, "05 Mar 2022", "Admin J", "05 Dec 2022", "Pending", "product3.jpg", "Living Room", 66],
    ["CAT-11", "Decoration", "Hiasan dan ornamen", 300, "10 Mar 2022", "Admin K", "10 Dec 2022", "Active", "product4.jpg", "Living Room", 52],
    ["CAT-12", "Bathroom", "Perlengkapan kamar mandi", 480, "15 Mar 2022", "Admin L", "13 Dec 2022", "Pending", "product5.jpg", "-", 57],
    ["CAT-13", "Children", "Produk anak-anak", 500, "20 Mar 2022", "Admin M", "15 Dec 2022", "Active", "product6.jpg", "-", 59],
    ["CAT-14", "Appliances", "Peralatan rumah tangga", 320, "25 Mar 2022", "Admin N", "18 Dec 2022", "Ordered", "product7.jpg", "Kitchen", 49],
    ["CAT-15", "Rugs", "Karpet berbagai ukuran", 430, "01 Apr 2022", "Admin O", "20 Dec 2022", "Active", "product2.jpg", "Textiles", 53],
    ["CAT-16", "Curtains", "Gorden dan tirai rumah", 290, "05 Apr 2022", "Admin P", "23 Dec 2022", "Ordered", "product7.jpg", "Textiles", 47],
    ["CAT-17", "Tableware", "Peralatan makan", 510, "10 Apr 2022", "Admin Q", "26 Dec 2022", "Active", "product6.jpg", "Kitchen", 60],
    ["CAT-18", "Cookware", "Peralatan masak", 620, "15 Apr 2022", "Admin R", "29 Dec 2022", "Active", "product5.jpg", "Kitchen", 63],
    ["CAT-19", "Laundry", "Alat bantu cuci", 230, "20 Apr 2022", "Admin S", "02 Jan 2023", "Ordered", "product4.jpg", "Bathroom", 40],
    ["CAT-20", "Cleaning", "Produk kebersihan", 190, "25 Apr 2022", "Admin T", "04 Jan 2023", "Active", "product3.jpg", "Bathroom", 38],
    ["CAT-21", "Pet", "Produk untuk hewan peliharaan", 100, "30 Apr 2022", "Admin U", "07 Jan 2023", "Ordered", "product2.jpg", "-", 36]
  ];

   let filteredCategoryData = [...categoryData];
    const rowsPerPage = 7;
    let currentPage = 1;

    function renderTablePage(page) {
      const tbody = document.getElementById("kategoriTableBody");
      tbody.innerHTML = "";
      const start = (page - 1) * rowsPerPage;
      const end = start + rowsPerPage;
      const pageData = filteredCategoryData.slice(start, end);

      pageData.forEach((item, index) => {
        const statusClass = {
          Active: "status-pill status-active",
          Pending: "status-pill status-pending",
          Ordered: "status-pill status-ordered",
          Inactive: "status-pill status-inactive"
        }[item[7]] || "";

        const row = document.createElement("tr");
        row.innerHTML = `
          <td>${start + index + 1}</td>
          <td>${item[0]}</td>
          <td>${item[1]}</td>
          <td>${item[2]}</td>
          <td><span class="${statusClass}">${item[7]}</span></td>
          <td>
            <button class="btn view-detail" onclick="showDetail(${categoryData.indexOf(item)})">View Detail</button>
          </td>
        `;
        tbody.appendChild(row);
      });
    }

    function showDetail(index) {
      const data = categoryData[index];
      const content = `
        <li class="list-group-item"><strong>Created Date:</strong> ${data[4]}</li>
        <li class="list-group-item"><strong>Created By:</strong> ${data[5]}</li>
        <li class="list-group-item"><strong>Updated Date:</strong> ${data[6]}</li>
        <li class="list-group-item"><strong>Status:</strong> ${data[7]}</li>
        <li class="list-group-item"><strong>Parent Category:</strong> ${data[9]}</li>
        <li class="list-group-item"><strong>Popularity Index:</strong> ${data[10]}</li>
      `;
      document.getElementById("modalContent").innerHTML = content;
      document.getElementById("categoryDetailPopup").classList.remove("d-none");
    }

    function closePopup() {
      document.getElementById("categoryDetailPopup").classList.add("d-none");
    }

    function prevPage() {
      if (currentPage > 1) {
        currentPage--;
        renderTablePage(currentPage);
      }
    }

    function nextPage() {
      if ((currentPage * rowsPerPage) < filteredCategoryData.length) {
        currentPage++;
        renderTablePage(currentPage);
      }
    }

    function filterTable() {
      const keyword = document.getElementById("searchInput").value.toLowerCase();
      filteredCategoryData = categoryData.filter(item =>
        item[0].toLowerCase().includes(keyword) ||
        item[1].toLowerCase().includes(keyword) ||
        item[2].toLowerCase().includes(keyword) ||
        item[7].toLowerCase().includes(keyword)
      );
      currentPage = 1;
      renderTablePage(currentPage);
    }

    // Panggil saat pertama kali
    renderTablePage(currentPage);
  </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
  function exportToExcel() {
    const ws = XLSX.utils.table_to_sheet(document.querySelector("table"));
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Kategori");
    XLSX.writeFile(wb, "kategori_produk.xlsx");
  }

  async function exportToPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    const table = document.querySelector("table");
    let y = 20;
    doc.setFontSize(14);
    doc.text("Ringkasan Kategori Produk", 14, y);
    y += 10;
    Array.from(table.rows).forEach((row) => {
      let x = 14;
      Array.from(row.cells).forEach((cell) => {
        doc.text(cell.innerText, x, y);
        x += 40;
      });
      y += 10;
    });
    doc.save("kategori_produk.pdf");
  }
</script>


<!-- Bootstrap 5 JS -->
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


