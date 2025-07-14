<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../include/config.php';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}


// Ambil data manajer
$managers = $db->query("
    SELECT 
        m.kode_manager,
        k.nama,
        k.telepon,
        k.email,
        t.nama_toko AS branch,
        k.foto_profil
    FROM manager m
    JOIN karyawan k ON m.id_karyawan = k.id_karyawan
    JOIN toko t ON k.id_toko = t.id_toko
")->fetchAll(PDO::FETCH_ASSOC);

// Hitung statistik untuk dashboard
$totalManagers = $db->query("SELECT COUNT(*) FROM manager")->fetchColumn();
$mostActive = $db->query("
    SELECT k.nama 
    FROM tugas_manager tm
    JOIN manager m ON tm.id_manager = m.id_manager
    JOIN karyawan k ON m.id_karyawan = k.id_karyawan
    GROUP BY tm.id_manager
    ORDER BY COUNT(*) DESC
    LIMIT 1
")->fetchColumn();
$pendingTasks = $db->query("SELECT COUNT(*) FROM tugas_manager WHERE status = 'Pending'")->fetchColumn();
$avgCompletion = $db->query("
    SELECT AVG(DATEDIFF(tenggat_waktu, created_at)) 
    FROM tugas_manager 
    WHERE status = 'Completed'
")->fetchColumn();
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
<meta name="author" content="Dreamguys - Bootstrap Admin Template">
<meta name="robots" content="noindex, nofollow">
<title>IKEA</title>

<link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg">
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/animate.css">
<link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style.css">
<style>
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

/* Tambahkan di dalam <head> setelah style yang sudah ada */
.table.datanew tbody tr:nth-child(even) {
    background-color: #f8fafc;
}
.table.datanew tbody tr:nth-child(odd) {
    background-color: #fff;
}
/* Hover effect pada baris */
.table.datanew tbody tr:hover {
    background-color: #e3f0fa !important;
    transition: background 0.2s;
    cursor: pointer;
}
/* Sedikit border radius pada cell */
.table.datanew td, .table.datanew th {
    border-radius: 6px;
    vertical-align: middle;
}
</style>
</head>
<body>
<div id="global-loader">
<div class="whirly-loader"> </div>
</div>

<div class="main-wrapper">
<?php include __DIR__ . '/../include/sidebar.php'; ?>
<?php include __DIR__ . '/../include/header.php'; ?>
</div>

<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>Managers List</h4>
<h6>Manage your Managers</h6>
</div>
</div>

<!-- Dashboard Cards -->
<div class="row justify-content-end">
    <!-- Total Managers -->
    <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <a href="revenue/revenue.php" class="w-100 text-decoration-none text-dark">
            <div class="dash-count das1">
                <div class="dash-counts">
                    <h4><span class="counters" data-count="<?= $totalManagers ?>"><?= $totalManagers ?></span></h4>
                    <h5>Total Managers</h5>
                    <h2 class="stat-change">Keep up the good work</h2>
                </div>
                <div class="icon-box bg-ungu">
                    <i class="fa fa-users"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Most Active Manager -->
    <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <a href="people/supplierlist.php" class="w-100 text-decoration-none text-dark">
            <div class="dash-count das2">
                <div class="dash-counts">
                    <h4><?= $mostActive ?: 'N/A' ?></h4>
                    <h5>Most Active Manager</h5>
                    <h2 class="stat-change">+10% from last week</h2>
                </div>
                <div class="icon-box bg-biru">
                    <i class="fa fa-star"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Pending Tasks -->
    <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <a href="product/productsold.php" class="w-100 text-decoration-none text-dark">
            <div class="dash-count das3">
                <div class="dash-counts">
                    <h4><span class="counters" data-count="<?= $pendingTasks ?>"><?= $pendingTasks ?></span></h4>
                    <h5>Pending Tasks</h5>
                    <h2 class="stat-change">+2 dari minggu lalu</h2>
                </div>
                <div class="icon-box bg-merah">
                    <i class="fa fa-tasks"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Average Task Completion -->
    <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <a href="expense/expensecategory.php" class="w-100 text-decoration-none text-dark">
            <div class="dash-count das4">
                <div class="dash-counts">
                <h4><?= number_format($avgCompletion ?? 2.3, 1) ?> days</h4>
                    <h5>Avg. Task Completion</h5>
                    <h2 class="stat-change">-0.5 days faster</h2>
                </div>
                <div class="icon-box bg-hijau">
                    <i class="fa fa-check-circle"></i>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-top">
            <div class="search-set">
                <div class="search-path">
                    <a class="btn btn-filter" id="filter_search">
                        <img src="../assets/img/icons/filter.svg" alt="img">
                        <span><img src="../assets/img/icons/closes.svg" alt="img"></span>
                    </a>
                </div>
                <div class="search-input">
                    <a class="btn btn-searchset"><img src="../assets/img/icons/search-white.svg" alt="img"></a>
                </div>
            </div>
            <div class="wordset">
                <ul>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="../assets/img/icons/pdf.svg" alt="img"></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="../assets/img/icons/excel.svg" alt="img"></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="../assets/img/icons/printer.svg" alt="img"></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card" id="filter_inputs">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-lg-2 col-sm-6 col-12">
                        <div class="form-group">
                            <input type="text" placeholder="Enter Manager Code">
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-12">
                        <div class="form-group">
                            <input type="text" placeholder="Enter Manager Name">
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-12">
                        <div class="form-group">
                            <input type="text" placeholder="Enter Phone Number">
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-12">
                        <div class="form-group">
                            <input type="text" placeholder="Enter Email">
                        </div>
                    </div>
                    <div class="col-lg-1 col-sm-6 col-12  ms-auto">
                        <div class="form-group">
                            <a class="btn btn-filters ms-auto"><img src="../assets/img/icons/search-whites.svg" alt="img"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table datanew">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Manager Name</th>
                        <th>Code</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Branch</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($managers)): ?>
                        <tr>
                            <td colspan="6" class="text-center">No managers found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($managers as $index => $manager): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td class="productimgname">
                                    <a href="javascript:void(0);" class="product-img">
                                        <img src="../assets/img/profiles/<?= $manager['foto_profil'] ?: 'default.jpg' ?>" alt="<?= htmlspecialchars($manager['nama']) ?>" width="40" height="40">
                                    </a>
                                    <a href="javascript:void(0);"><?= htmlspecialchars($manager['nama']) ?></a>
                                </td>
                                <td><?= htmlspecialchars($manager['kode_manager']) ?></td>
                                <td><?= htmlspecialchars($manager['telepon']) ?></td>
                                <td><?= htmlspecialchars($manager['email']) ?></td>
                                <td><?= htmlspecialchars($manager['branch']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
</div>
</div>

<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/feather.min.js"></script>
<script src="../assets/js/jquery.slimscroll.min.js"></script>
<script src="../assets/js/jquery.dataTables.min.js"></script>
<script src="../assets/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/plugins/select2/js/select2.min.js"></script>
<script src="../assets/js/moment.min.js"></script>
<script src="../assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="../assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="../assets/plugins/sweetalert/sweetalerts.min.js"></script>
<script src="../assets/js/script.js"></script>
</body>
</html>