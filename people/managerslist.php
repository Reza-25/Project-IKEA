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
<title>RuanGku</title>

<link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg">
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/animate.css">
<link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style.css">

<!-- Export Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
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

/* Enhanced Manager Data Table - Extended Width and Blue Gradient Headers */
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

/* Chart Header */
.chart-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  padding-bottom: 10px;
  border-bottom: 2px solid #f1f5f9;
}

.chart-title {
  font-size: 1.1rem;
  font-weight: 600;
  color: #1e293b;
  margin: 0;
  display: flex;
  align-items: center;
}

.chart-title i {
  color: #1976d2;
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
  font-weight: 600;
  margin-bottom: 8px;
  color: #475569;
}

.no-results p {
  font-size: 0.9rem;
  margin: 0;
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

<!-- Enhanced Manager Data Table - Full Width Professional with Search & Export -->
<div class="brand-table-section">
    <div class="chart-header">
        <h5 class="chart-title"><i class="fas fa-users me-2"></i>Data Manager IKEA</h5>
        <div class="d-flex align-items-center gap-2">
            <span style="font-size: 0.8rem; color: #64748b;" id="totalManagersText">Total: <?= count($managers) ?> managers</span>
        </div>
    </div>
    
    <!-- Table Controls -->
    <div class="table-controls">
        <div class="search-container">
            <input type="text" class="search-input" id="searchInput" placeholder="Cari manager, email, atau branch...">
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
    
    <table class="brand-table" id="managerTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Manager Name</th>
                <th>Code</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Branch</th>
            </tr>
        </thead>
        <tbody id="managerTableBody">
            <?php if (empty($managers)): ?>
                <tr>
                    <td colspan="6" class="text-center">No managers found</td>
                </tr>
            <?php else: ?>
                <?php foreach ($managers as $index => $manager): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td class="productimgname">
                            <div class="d-flex align-items-center">
                                <img src="../assets/img/profiles/<?= $manager['foto_profil'] ?: 'default.jpg' ?>" alt="<?= htmlspecialchars($manager['nama']) ?>" width="40" height="40" class="rounded-circle me-2">
                                <span class="brand-name"><?= htmlspecialchars($manager['nama']) ?></span>
                            </div>
                        </td>
                        <td>
                            <span class="brand-id"><?= htmlspecialchars($manager['kode_manager']) ?></span>
                        </td>
                        <td><?= htmlspecialchars($manager['telepon']) ?></td>
                        <td><?= htmlspecialchars($manager['email']) ?></td>
                        <td>
                            <span class="brand-category"><?= htmlspecialchars($manager['branch']) ?></span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    
    <!-- No Results Message -->
    <div class="no-results" id="noResults" style="display: none;">
        <i class="fas fa-search"></i>
        <h5>Tidak ada data yang ditemukan</h5>
        <p>Coba ubah kata kunci pencarian Anda</p>
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

<script>
// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('#managerTableBody tr');
    const noResults = document.getElementById('noResults');
    let visibleRows = 0;

    tableRows.forEach(row => {
        const cells = row.querySelectorAll('td');
        let matchFound = false;
        
        cells.forEach(cell => {
            if (cell.textContent.toLowerCase().includes(searchTerm)) {
                matchFound = true;
            }
        });
        
        if (matchFound) {
            row.style.display = '';
            visibleRows++;
        } else {
            row.style.display = 'none';
        }
    });
    
    // Show/hide no results message
    if (visibleRows === 0 && searchTerm !== '') {
        noResults.style.display = 'block';
        document.querySelector('.brand-table').style.display = 'none';
    } else {
        noResults.style.display = 'none';
        document.querySelector('.brand-table').style.display = 'table';
    }
});

// Export to PDF function
function exportToPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    
    // Title
    doc.setFontSize(16);
    doc.text('Data Manager IKEA', 14, 15);
    
    // Get table data
    const table = document.getElementById('managerTable');
    const rows = [];
    
    // Headers
    const headers = ['No', 'Manager Name', 'Code', 'Phone', 'Email', 'Branch'];
    rows.push(headers);
    
    // Data rows
    const dataRows = table.querySelectorAll('tbody tr');
    dataRows.forEach(row => {
        if (row.style.display !== 'none') {
            const cells = row.querySelectorAll('td');
            const rowData = [];
            cells.forEach((cell, index) => {
                if (index === 1) {
                    // For manager name column, get text content only
                    rowData.push(cell.querySelector('.brand-name')?.textContent || cell.textContent.trim());
                } else if (index === 2) {
                    // For code column, get text content only
                    rowData.push(cell.querySelector('.brand-id')?.textContent || cell.textContent.trim());
                } else if (index === 5) {
                    // For branch column, get text content only
                    rowData.push(cell.querySelector('.brand-category')?.textContent || cell.textContent.trim());
                } else {
                    rowData.push(cell.textContent.trim());
                }
            });
            rows.push(rowData);
        }
    });
    
    // Generate table
    doc.autoTable({
        head: [headers],
        body: rows.slice(1),
        startY: 25,
        theme: 'grid',
        headStyles: {
            fillColor: [25, 118, 210],
            textColor: 255
        }
    });
    
    doc.save('data-manager-ikea.pdf');
}

// Export to Excel function
function exportToExcel() {
    const table = document.getElementById('managerTable');
    const wb = XLSX.utils.table_to_book(table, {sheet: "Managers"});
    XLSX.writeFile(wb, 'data-manager-ikea.xlsx');
}
</script>
</body>
</html>