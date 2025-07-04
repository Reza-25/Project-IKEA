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
<title>Dreams Pos admin template</title>

<link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg">

<link rel="stylesheet" href="../assets/css/bootstrap.min.css">

<link rel="stylesheet" href="../assets/css/animate.css">

<link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">

<link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">

<link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

.card-header.bg-primary.text-white.text-center.py-2 {
  background: linear-gradient(90deg, #1976d2 0%, #64b5f6 100%) !important;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}
.card-header.bg-success.text-white.text-center.py-2 {
  background: linear-gradient(90deg, #1976d2 0%, #64b5f6 100%) !important;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}

#totalKaryawan {
  color: #1976d2 !important;
  font-weight: 700 !important;
  letter-spacing: 1px;
}

#selectedCabangInfo {
  margin-top: 32px !important;
  display: block;
  color: #1976d2 !important;
  font-size: 1rem !important;
  font-weight: 700 !important;
}

.card.h-100 {
  transition: box-shadow 0.25s, transform 0.25s;
  box-shadow: 0 2px 10px rgba(25, 118, 210, 0.07);
  animation: fadeInCard 0.7s cubic-bezier(.4,1.4,.6,1) both;
}
.card.h-100:hover {
  box-shadow: 0 8px 32px rgba(25, 118, 210, 0.18), 0 1.5px 6px rgba(44,62,80,0.07);
  transform: translateY(-6px) scale(1.02);
  z-index: 2;
}

@keyframes fadeInCard {
  0% {
    opacity: 0;
    transform: translateY(30px) scale(0.97);
  }
  100% {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

/* Hover effect untuk list cabang */
#listCabangKaryawan .list-group-item {
  transition: background 0.18s, color 0.18s, box-shadow 0.18s;
}
#listCabangKaryawan .list-group-item:hover {
  background: #e3f0fa;
  color: #1976d2;
  box-shadow: 0 2px 8px rgba(25, 118, 210, 0.10);
  cursor: pointer;
}

  .chart-container {
            max-width: 900px;
            margin: 20px auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .chart-header {
            background: linear-gradient(90deg, #1657b6 0%, #6ec6ff 100%);
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chart-header h5 {
            margin: 0;
            font-weight: 600;
        }

        .chart-tabs {
            display: flex;
            gap: 5px;
        }

        .tab-btn {
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tab-btn.active {
            background: rgba(255,255,255,0.9);
            color: #1657b6;
            font-weight: 600;
        }

        .tab-btn:hover:not(.active) {
            background: rgba(255,255,255,0.3);
        }

        .chart-body {
            padding: 20px;
            height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .chart-content {
            display: none;
            height: 100%;
        }

        .chart-content.active {
            display: block;
        }

        /* Bar Chart Styles */
        .bar-chart {
            display: flex;
            align-items: end;
            justify-content: space-around;
            height: 220px;
            margin: 20px 0;
        }

        .bar {
            width: 70px;
            border-radius: 8px 8px 0 0;
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
        }

        .bar:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .bar.excellent {
            background: linear-gradient(to top, #0051BA, #16a34a);
        }

        .bar.good {
            background: linear-gradient(to top, #FFCC00, #f59e0b);
        }

        .bar.average {
            background: linear-gradient(to top, #C8102E, #dc2626);
        }

        .bar-label {
            position: absolute;
            bottom: -25px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 11px;
            color: #6b7280;
            font-weight: 500;
            text-align: center;
            width: 80px;
        }

        .bar-value {
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 12px;
            color: #1f2937;
            font-weight: 600;
        }

        /* Radar Chart Styles */
        .radar-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 300px;
            position: relative;
        }

        .radar-chart {
            width: 280px;
            height: 280px;
            position: relative;
        }

        .radar-grid {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .radar-labels {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .radar-label {
            position: absolute;
            font-size: 12px;
            color: #6b7280;
            font-weight: 500;
            text-align: center;
            width: 80px;
            transform: translate(-50%, -50%);
        }

        .branch-selector {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .branch-btn {
            background: #e5e7eb;
            border: none;
            color: #374151;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .branch-btn.active {
            background: #1657b6;
            color: white;
        }

        /* Stacked Chart Styles */
        .stacked-chart {
            display: flex;
            align-items: end;
            justify-content: space-around;
            height: 220px;
            margin: 20px 0;
        }

        .stacked-bar {
            width: 70px;
            display: flex;
            flex-direction: column;
            position: relative;
            cursor: pointer;
        }

        .stacked-segment {
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
        }

        .stacked-segment:hover {
            opacity: 0.8;
        }

        .tooltip {
            position: absolute;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 12px;
            pointer-events: none;
            z-index: 1000;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .tooltip.show {
            opacity: 1;
        }

        .stacked-segment:first-child {
            border-radius: 8px 8px 0 0;
        }

        .stacked-segment.tugas {
            background: linear-gradient(to top, #0051BA, #2563eb);
        }

        .stacked-segment.komentar {
            background: linear-gradient(to top, #f59e0b, #d97706);
        }

        .stacked-segment.reward {
            background: linear-gradient(to top, #10b981, #059669);
        }

        .stacked-segment.voting {
            background: linear-gradient(to top, #8b5cf6, #7c3aed);
        }

        .stacked-bar:hover .stacked-segment {
            transform: scale(1.05);
        }

        .chart-legend {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #6b7280;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 2px;
        }

        .stats-info {
            text-align: center;
            margin-top: 10px;
            color: #6b7280;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .chart-container {
                margin: 10px;
                border-radius: 10px;
            }
            
            .chart-header {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }
            
            .bar, .stacked-bar {
                width: 45px;
            }
            
            .chart-legend {
                flex-wrap: wrap;
                gap: 10px;
            }

            .radar-chart {
                width: 220px;
                height: 220px;
            }
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
<?php include __DIR__ . '/../include/header.php'; ?> <!-- Import header -->
</div>

</div>

<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>Employee List</h4>
<h6>Manage your Employee</h6>
</div>
</div>

<!-- Total Expenses, Top Category, Top Expense, Avg Daily Expense -->
          <div class="row justify-content-end">
            <!-- Total Product Sold -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="revenue/revenue.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das1">
                  <div class="dash-counts">
                    <h4>Bali</h4>
                    <h5>Cabang Terbaik</h5>
                    <h2 class="stat-change">Keep up the good work</h2>
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
                    <h4>Andi S.</h4>
                    <h5>Karyawan Terbaik</h5>
                  <h2 class="stat-change">+10% from last week</h2>
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
                    <h4><span class="counters" data-count="134870"></span></h4>
                    <h5>Total User</h5>
                    <h2 class="stat-change">+71 dari minggu lalu</h2>
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
                    <h4>8.9</h4>
                    <h5>Rata-Rata Poin</h5>
                   <h2 class="stat-change">-0.5 from last month</h2>
                    </div>
                    <div class="icon-box bg-hijau">
                      <i class="fa fa-chart-line"></i>
                    </div>
                </div>
              </a>
            </div>
          </div>
          <!-- END KOLOM  -->


  <!-- DONUT & DETAIL KARYAWAN -->
<div class="row mt-4">
  <!-- Donut Chart Karyawan per Cabang -->
  <div class="col-md-5">
    <div class="card h-100">
      <div class="card-header bg-primary text-white text-center py-2">
        <h6 class="mb-0 small">Karyawan per Cabang</h6>
      </div>
      <div class="card-body d-flex flex-column justify-content-center align-items-center">
        <div id="donutChartKaryawan"></div>
        <div id="selectedCabangInfo" class="text-center mt-2" style="font-size: 14px;"></div>
      </div>
    </div>
  </div>

  <!-- Total Karyawan dan List Detail -->
  <div class="col-md-7">
    <div class="card h-100">
      <div class="card-header bg-success text-white text-center py-2">
        <h6 class="mb-0 small">Total Karyawan & Detail Cabang</h6>
      </div>
      <div class="card-body">
        <h3 class="text-center text-success mb-3" id="totalKaryawan">Total: -</h3>
        <p class="text-muted small">Detail per Cabang:</p>
        <ul id="listCabangKaryawan" class="list-group small"></ul>
      </div>
    </div>
  </div>
</div>

<!-- ApexCharts CDN -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  // Data Hardcoded
  const cabangData = [
    { nama: "Alam Sutera", jumlah: 35 },
    { nama: "Sentul City", jumlah: 28 },
    { nama: "Kota Baru Parahyangan", jumlah: 22 },
    { nama: "Surabaya", jumlah: 18 },
    { nama: "Bali", jumlah: 25 },
    { nama: "Jakarta Garden City", jumlah: 10 },
    { nama: "Mal Taman Anggrek", jumlah: 55 }
  ];

  const labels = cabangData.map(c => c.nama);
  const values = cabangData.map(c => c.jumlah);
  const total = values.reduce((sum, val) => sum + val, 0);

  // Update total karyawan
  document.getElementById("totalKaryawan").textContent = `Total: ${total} Karyawan`;

  // Update list cabang
  const listContainer = document.getElementById("listCabangKaryawan");
  cabangData.forEach(item => {
    const li = document.createElement("li");
    li.className = "list-group-item d-flex justify-content-between align-items-center";
    li.textContent = item.nama;

    const badge = document.createElement("span");
    badge.className = "badge bg-primary rounded-pill";
    badge.textContent = item.jumlah;
    li.appendChild(badge);

    listContainer.appendChild(li);
  });

  // Donut Chart config
  const chart = new ApexCharts(document.querySelector("#donutChartKaryawan"), {
    chart: {
      type: 'donut',
      height: 260,
      events: {
        dataPointSelection: function(event, chartContext, config) {
          const index = config.dataPointIndex;
          const cabang = labels[index];
          const jumlah = values[index];
          document.getElementById("selectedCabangInfo").textContent = `${cabang}: ${jumlah} karyawan`;
        }
      }
    },
    series: values,
    labels: labels,
    colors: [
      "#1976d2", "#42a5f5", "#64b5f6", "#1565c0", "#90caf9", "#1e88e5", "#0d47a1"
    ],
    dataLabels: {
      enabled: false // label di dalam donat disembunyikan
    },
    legend: {
      position: 'bottom'
    }
  });

  chart.render();
});
</script>
<div class="chart-container">
        <div class="chart-header">
            <h5><i class="fa fa-chart-bar me-2"></i>Visualisasi Kinerja Karyawan</h5>
            <div class="chart-tabs">
                <button class="tab-btn active" data-tab="kehadiran">Kehadiran</button>
                <button class="tab-btn" data-tab="pelayanan">Pelayanan</button>
                <button class="tab-btn" data-tab="tugas">Tugas</button>
            </div>
        </div>
        
        <div class="chart-body">
            <!-- Kehadiran Chart -->
            <div class="chart-content active" id="kehadiran">
                <div class="bar-chart">
                    <div class="bar excellent" style="height: 95%" data-value="95">
                        <div class="bar-value">95%</div>
                        <div class="bar-label">Alam Sutera</div>
                    </div>
                    <div class="bar excellent" style="height: 88%" data-value="88">
                        <div class="bar-value">88%</div>
                        <div class="bar-label">Sentul</div>
                    </div>
                    <div class="bar excellent" style="height: 92%" data-value="92">
                        <div class="bar-value">92%</div>
                        <div class="bar-label">Bandung</div>
                    </div>
                    <div class="bar good" style="height: 78%" data-value="78">
                        <div class="bar-value">78%</div>
                        <div class="bar-label">Surabaya</div>
                    </div>
                    <div class="bar excellent" style="height: 85%" data-value="85">
                        <div class="bar-value">85%</div>
                        <div class="bar-label">Bali</div>
                    </div>
                    <div class="bar good" style="height: 72%" data-value="72">
                        <div class="bar-value">72%</div>
                        <div class="bar-label">Jakarta</div>
                    </div>
                    <div class="bar excellent" style="height: 90%" data-value="90">
                        <div class="bar-value">90%</div>
                        <div class="bar-label">Taman Anggrek</div>
                    </div>
                </div>
                <div class="chart-legend">
                    <div class="legend-item">
                        <div class="legend-color" style="background: #0051BA;"></div>
                        <span>Excellent (≥85%)</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: #FFCC00;"></div>
                        <span>Good (70-84%)</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: #C8102E;"></div>
                        <span>Perlu Perbaikan (<70%)</span>
                    </div>
                </div>
                <div class="stats-info">
                    Tingkat kehadiran karyawan per cabang • Rata-rata 86%
                </div>
            </div>

            <!-- Pelayanan Chart (Radar) -->
            <div class="chart-content" id="pelayanan">
                <div class="branch-selector">
                    <button class="branch-btn active" data-branch="alam-sutera">Alam Sutera</button>
                    <button class="branch-btn" data-branch="sentul">Sentul</button>
                    <button class="branch-btn" data-branch="bandung">Bandung</button>
                    <button class="branch-btn" data-branch="surabaya">Surabaya</button>
                    <button class="branch-btn" data-branch="bali">Bali</button>
                    <button class="branch-btn" data-branch="jakarta">Jakarta</button>
                    <button class="branch-btn" data-branch="taman-anggrek">Taman Anggrek</button>
                </div>
                <div class="radar-container">
                    <div class="radar-chart">
                        <svg class="radar-grid" width="280" height="280">
                            <!-- Grid circles -->
                            <circle cx="140" cy="140" r="28" fill="none" stroke="#e5e7eb" stroke-width="1"/>
                            <circle cx="140" cy="140" r="56" fill="none" stroke="#e5e7eb" stroke-width="1"/>
                            <circle cx="140" cy="140" r="84" fill="none" stroke="#e5e7eb" stroke-width="1"/>
                            <circle cx="140" cy="140" r="112" fill="none" stroke="#e5e7eb" stroke-width="1"/>
                            <circle cx="140" cy="140" r="140" fill="none" stroke="#e5e7eb" stroke-width="1"/>
                            
                            <!-- Grid lines -->
                            <line x1="140" y1="0" x2="140" y2="280" stroke="#e5e7eb" stroke-width="1"/>
                            <line x1="0" y1="140" x2="280" y2="140" stroke="#e5e7eb" stroke-width="1"/>
                            <line x1="41" y1="41" x2="239" y2="239" stroke="#e5e7eb" stroke-width="1"/>
                            <line x1="239" y1="41" x2="41" y2="239" stroke="#e5e7eb" stroke-width="1"/>
                            
                            <!-- Radar polygon -->
                            <polygon id="radar-polygon" points="140,28 224,85 224,195 140,252 56,195 56,85" 
                                     fill="rgba(22, 87, 182, 0.2)" stroke="#1657b6" stroke-width="2"/>
                        </svg>
                        <div class="radar-labels">
                            <div class="radar-label" style="top: 10px; left: 140px;">Kepatuhan<br><span id="kepatuhan-score">90%</span></div>
                            <div class="radar-label" style="top: 50px; right: 10px;">Pelayanan<br><span id="pelayanan-score">85%</span></div>
                            <div class="radar-label" style="bottom: 50px; right: 10px;">Ketepatan<br><span id="ketepatan-score">80%</span></div>
                            <div class="radar-label" style="bottom: 10px; left: 140px;">Kepemimpinan<br><span id="kepemimpinan-score">75%</span></div>
                            <div class="radar-label" style="bottom: 50px; left: 10px;">Kolaborasi<br><span id="kolaborasi-score">88%</span></div>
                        </div>
                    </div>
                </div>
                <div class="stats-info">
                    Evaluasi komprehensif 5 aspek kinerja • <span id="current-branch">Alam Sutera</span>
                </div>
            </div>

            <!-- Tugas Chart (Stacked) -->
            <div class="chart-content" id="tugas">
                <div class="stacked-chart">
                    <div class="stacked-bar">
                        <div class="stacked-segment tugas" style="height: 80px;" data-value="40"></div>
                        <div class="stacked-segment komentar" style="height: 30px;" data-value="15"></div>
                        <div class="stacked-segment reward" style="height: 50px;" data-value="25"></div>
                        <div class="stacked-segment voting" style="height: 40px;" data-value="20"></div>
                        <div class="bar-label">Alam Sutera</div>
                    </div>
                    <div class="stacked-bar">
                        <div class="stacked-segment tugas" style="height: 70px;" data-value="35"></div>
                        <div class="stacked-segment komentar" style="height: 40px;" data-value="20"></div>
                        <div class="stacked-segment reward" style="height: 35px;" data-value="18"></div>
                        <div class="stacked-segment voting" style="height: 35px;" data-value="17"></div>
                        <div class="bar-label">Sentul</div>
                    </div>
                    <div class="stacked-bar">
                        <div class="stacked-segment tugas" style="height: 75px;" data-value="38"></div>
                        <div class="stacked-segment komentar" style="height: 35px;" data-value="18"></div>
                        <div class="stacked-segment reward" style="height: 40px;" data-value="20"></div>
                        <div class="stacked-segment voting" style="height: 30px;" data-value="15"></div>
                        <div class="bar-label">Bandung</div>
                    </div>
                    <div class="stacked-bar">
                        <div class="stacked-segment tugas" style="height: 60px;" data-value="30"></div>
                        <div class="stacked-segment komentar" style="height: 45px;" data-value="23"></div>
                        <div class="stacked-segment reward" style="height: 30px;" data-value="15"></div>
                        <div class="stacked-segment voting" style="height: 25px;" data-value="12"></div>
                        <div class="bar-label">Surabaya</div>
                    </div>
                    <div class="stacked-bar">
                        <div class="stacked-segment tugas" style="height: 85px;" data-value="42"></div>
                        <div class="stacked-segment komentar" style="height: 25px;" data-value="13"></div>
                        <div class="stacked-segment reward" style="height: 45px;" data-value="22"></div>
                        <div class="stacked-segment voting" style="height: 35px;" data-value="18"></div>
                        <div class="bar-label">Bali</div>
                    </div>
                    <div class="stacked-bar">
                        <div class="stacked-segment tugas" style="height: 50px;" data-value="25"></div>
                        <div class="stacked-segment komentar" style="height: 50px;" data-value="25"></div>
                        <div class="stacked-segment reward" style="height: 25px;" data-value="12"></div>
                        <div class="stacked-segment voting" style="height: 35px;" data-value="18"></div>
                        <div class="bar-label">Jakarta</div>
                    </div>
                    <div class="stacked-bar">
                        <div class="stacked-segment tugas" style="height: 90px;" data-value="45"></div>
                        <div class="stacked-segment komentar" style="height: 20px;" data-value="10"></div>
                        <div class="stacked-segment reward" style="height: 55px;" data-value="28"></div>
                        <div class="stacked-segment voting" style="height: 45px;" data-value="22"></div>
                        <div class="bar-label">Taman Anggrek</div>
                    </div>
                </div>
                <div class="chart-legend">
                    <div class="legend-item">
                        <div class="legend-color" style="background: #0051BA;"></div>
                        <span>Tugas</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: #f59e0b;"></div>
                        <span>Komentar</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: #10b981;"></div>
                        <span>Reward</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: #8b5cf6;"></div>
                        <span>Voting</span>
                    </div>
                </div>
                <div class="stats-info">
                    Distribusi aktivitas karyawan per cabang • Total rata-rata 100 aktivitas/bulan
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample data for radar chart
        const radarData = {
            'alam-sutera': { kepatuhan: 90, pelayanan: 85, ketepatan: 80, kepemimpinan: 75, kolaborasi: 88 },
            'sentul': { kepatuhan: 85, pelayanan: 78, ketepatan: 85, kepemimpinan: 70, kolaborasi: 82 },
            'bandung': { kepatuhan: 88, pelayanan: 82, ketepatan: 75, kepemimpinan: 80, kolaborasi: 85 },
            'surabaya': { kepatuhan: 75, pelayanan: 70, ketepatan: 72, kepemimpinan: 65, kolaborasi: 78 },
            'bali': { kepatuhan: 82, pelayanan: 88, ketepatan: 85, kepemimpinan: 78, kolaborasi: 90 },
            'jakarta': { kepatuhan: 70, pelayanan: 75, ketepatan: 68, kepemimpinan: 72, kolaborasi: 80 },
            'taman-anggrek': { kepatuhan: 92, pelayanan: 90, ketepatan: 88, kepemimpinan: 85, kolaborasi: 92 }
        };

        // Tab switching functionality
        document.querySelectorAll('.tab-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
                document.querySelectorAll('.chart-content').forEach(content => content.classList.remove('active'));
                
                this.classList.add('active');
                
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });

        // Branch selector for radar chart
        document.querySelectorAll('.branch-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.branch-btn').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                const branchId = this.getAttribute('data-branch');
                updateRadarChart(branchId);
                document.getElementById('current-branch').textContent = this.textContent;
            });
        });

        // Update radar chart
        function updateRadarChart(branchId) {
            const data = radarData[branchId];
            const center = 140;
            const maxRadius = 112;
            
            // Calculate points for polygon
            const points = [];
            const angles = [0, 72, 144, 216, 288]; // 5 points, 72 degrees apart
            
            Object.values(data).forEach((value, index) => {
                const angle = (angles[index] - 90) * Math.PI / 180; // Start from top
                const radius = (value / 100) * maxRadius;
                const x = center + radius * Math.cos(angle);
                const y = center + radius * Math.sin(angle);
                points.push(`${x},${y}`);
            });
            
            // Update polygon
            document.getElementById('radar-polygon').setAttribute('points', points.join(' '));
            
            // Update labels
            document.getElementById('kepatuhan-score').textContent = data.kepatuhan + '%';
            document.getElementById('pelayanan-score').textContent = data.pelayanan + '%';
            document.getElementById('ketepatan-score').textContent = data.ketepatan + '%';
            document.getElementById('kepemimpinan-score').textContent = data.kepemimpinan + '%';
            document.getElementById('kolaborasi-score').textContent = data.kolaborasi + '%';
        }

        // Bar hover effects
        document.querySelectorAll('.bar, .stacked-bar').forEach(element => {
            element.addEventListener('mouseenter', function() {
                if (this.classList.contains('bar')) {
                    this.style.transform = 'translateY(-5px)';
                    this.style.boxShadow = '0 5px 15px rgba(0,0,0,0.2)';
                }
            });
            
            element.addEventListener('mouseleave', function() {
                if (this.classList.contains('bar')) {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = 'none';
                }
            });
        });

        // Animation on load
        window.addEventListener('load', function() {
            document.querySelectorAll('.bar, .stacked-bar').forEach((element, index) => {
                setTimeout(() => {
                    element.style.opacity = '0';
                    element.style.transform = 'translateY(50px)';
                    element.style.transition = 'all 0.5s ease';
                    
                    setTimeout(() => {
                        element.style.opacity = '1';
                        element.style.transform = 'translateY(0)';
                    }, 50);
                }, index * 100);
            });
        });
    </script>
<div class="card mt-4">
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
<a class="btn btn-searchset">
<img src="../assets/img/icons/search-white.svg" alt="img">
</a>
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
<input type="text" placeholder="Enter User Name">
</div>
</div>
<div class="col-lg-2 col-sm-6 col-12">
<div class="form-group">
<input type="text" placeholder="Enter Phone">
</div>
</div>
<div class="col-lg-2 col-sm-6 col-12">
<div class="form-group">
<input type="text" placeholder="Enter Email">
</div>
</div>
<div class="col-lg-2 col-sm-6 col-12">
<div class="form-group">
<select class="select">
<option>Disable</option>
<option>Enable</option>
</select>
</div>
</div>
<div class="col-lg-1 col-sm-6 col-12 ms-auto">
<div class="form-group">
<a class="btn btn-filters ms-auto"><img src="../assets/img/icons/search-whites.svg" alt="img"></a>
</div>
</div>
</div>
</div>
</div>

<!-- List Evaluasi Karyawan IKEA -->
<div class="row justify-content-center">
  <div class="col-md-10">
    <!-- ITEM 1 -->
    <div class="card mb-3 shadow-sm">
      <div class="card-body">
        <h5 class="mb-1">Andi Saputra</h5>
        <p class="text-muted mb-2">Sales Associate - Alam Sutera (Tangerang)</p>
        <div class="row mb-2 small">
          <div class="col-4">Kehadiran</div>
          <div class="col-4">Pelayanan</div>
          <div class="col-4">Penyelesaian Tugas</div>
        </div>
        <div class="row align-items-center mb-2">
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 98%">98%</div></div></div>
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 90%">90%</div></div></div>
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 95%">95%</div></div></div>
        </div>
        <div class="text-end">
          <span class="badge bg-success fs-6">94 <i class="bi bi-arrow-up"></i> +3%</span>
        </div>
      </div>
    </div>

    <!-- ITEM 2 -->
    <div class="card mb-3 shadow-sm">
      <div class="card-body">
        <h5 class="mb-1">Rina Pramesti</h5>
        <p class="text-muted mb-2">Customer Service - Sentul City (Bogor)</p>
        <div class="row mb-2 small">
          <div class="col-4">Kehadiran</div>
          <div class="col-4">Pelayanan</div>
          <div class="col-4">Penyelesaian Tugas</div>
        </div>
        <div class="row align-items-center mb-2">
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 95%">95%</div></div></div>
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 88%">88%</div></div></div>
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 91%">91%</div></div></div>
        </div>
        <div class="text-end">
          <span class="badge bg-success fs-6">91 <i class="bi bi-arrow-up"></i> +2%</span>
        </div>
      </div>
    </div>

    <!-- ITEM 3 -->
    <div class="card mb-3 shadow-sm">
      <div class="card-body">
        <h5 class="mb-1">Dimas Wahyu</h5>
        <p class="text-muted mb-2">Warehouse Staff - Kota Baru Parahyangan (Bandung)</p>
        <div class="row mb-2 small">
          <div class="col-4">Kehadiran</div>
          <div class="col-4">Pelayanan</div>
          <div class="col-4">Penyelesaian Tugas</div>
        </div>
        <div class="row align-items-center mb-2">
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 92%">92%</div></div></div>
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 85%">85%</div></div></div>
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 88%">88%</div></div></div>
        </div>
        <div class="text-end">
          <span class="badge bg-success fs-6">88 <i class="bi bi-arrow-up"></i> +1%</span>
        </div>
      </div>
    </div>

    <!-- ITEM 4 -->
    <div class="card mb-3 shadow-sm">
      <div class="card-body">
        <h5 class="mb-1">Siska Lestari</h5>
        <p class="text-muted mb-2">Cashier - Bali</p>
        <div class="row mb-2 small">
          <div class="col-4">Kehadiran</div>
          <div class="col-4">Pelayanan</div>
          <div class="col-4">Penyelesaian Tugas</div>
        </div>
        <div class="row align-items-center mb-2">
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 90%">90%</div></div></div>
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 80%">80%</div></div></div>
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 84%">84%</div></div></div>
        </div>
        <div class="text-end">
          <span class="badge bg-danger fs-6">84 <i class="bi bi-arrow-down"></i> -1%</span>
        </div>
      </div>
    </div>

    <!-- ITEM 5 -->
    <div class="card mb-3 shadow-sm">
      <div class="card-body">
        <h5 class="mb-1">Yudha Hermawan</h5>
        <p class="text-muted mb-2">Delivery Driver - Surabaya</p>
        <div class="row mb-2 small">
          <div class="col-4">Kehadiran</div>
          <div class="col-4">Pelayanan</div>
          <div class="col-4">Penyelesaian Tugas</div>
        </div>
        <div class="row align-items-center mb-2">
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 88%">88%</div></div></div>
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 78%">78%</div></div></div>
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 80%">80%</div></div></div>
        </div>
        <div class="text-end">
          <span class="badge bg-danger fs-6">80 <i class="bi bi-arrow-down"></i> -2%</span>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="showpayment" tabindex="-1" aria-labelledby="showpayment" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Show Payments</h5>
<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">
<div class="table-responsive">
<table class="table">
<thead>
<tr>
<th>Date</th>
<th>Reference</th>
<th>Amount	</th>
<th>Paid By	</th>
<th>Paid By	</th>
</tr>
</thead>
<tbody>
<tr class="bor-b1">
<td>2022-03-07	</td>
<td>INV/SL0101</td>
<td>$ 1500.00	</td>
<td>Cash</td>
<td>
<a class="me-2" href="javascript:void(0);">
<img src="../assets/img/icons/printer.svg" alt="img">
</a>
<a class="me-2" href="javascript:void(0);" data-bs-target="#editpayment" data-bs-toggle="modal" data-bs-dismiss="modal">
<img src="../assets/img/icons/edit.svg" alt="img">
</a>
<a class="me-2 confirm-text" href="javascript:void(0);">
<img src="../assets/img/icons/delete.svg" alt="img">
</a>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>


<div class="modal fade" id="createpayment" tabindex="-1" aria-labelledby="createpayment" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Create Payment</h5>
<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">
<div class="row">
<div class="col-lg-6 col-sm-12 col-12">
<div class="form-group">
<label>Customer</label>
<div class="input-group">
<input type="text" value="2022-03-07" class="datetimepicker">
<a class="scanner-set input-group-text">
<img src="../assets/img/icons/datepicker.svg" alt="img">
</a>
</div>
</div>
</div>
<div class="col-lg-6 col-sm-12 col-12">
<div class="form-group">
<label>Reference</label>
<input type="text" value="INV/SL0101">
</div>
</div>
<div class="col-lg-6 col-sm-12 col-12">
<div class="form-group">
<label>Received Amount</label>
<input type="text" value="1500.00">
</div>
</div>
<div class="col-lg-6 col-sm-12 col-12">
<div class="form-group">
<label>Paying Amount</label>
<input type="text" value="1500.00">
</div>
</div>
<div class="col-lg-6 col-sm-12 col-12">
<div class="form-group">
<label>Payment type</label>
<select class="select">
<option>Cash</option>
<option>Online</option>
<option>Inprogress</option>
</select>
</div>
</div>
<div class="col-lg-12">
<div class="form-group">
<label>Note</label>
<textarea class="form-control"></textarea>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-submit">Submit</button>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>


<div class="modal fade" id="editpayment" tabindex="-1" aria-labelledby="editpayment" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Edit Payment</h5>
<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">
<div class="row">
<div class="col-lg-6 col-sm-12 col-12">
<div class="form-group">
<label>Customer</label>
<div class="input-group">
<input type="text" value="2022-03-07" class="datetimepicker">
<a class="scanner-set input-group-text">
<img src="../assets/img/icons/datepicker.svg" alt="img">
</a>
</div>
</div>
</div>
<div class="col-lg-6 col-sm-12 col-12">
<div class="form-group">
<label>Reference</label>
<input type="text" value="INV/SL0101">
</div>
</div>
<div class="col-lg-6 col-sm-12 col-12">
<div class="form-group">
<label>Received Amount</label>
<input type="text" value="1500.00">
</div>
</div>
<div class="col-lg-6 col-sm-12 col-12">
<div class="form-group">
<label>Paying Amount</label>
<input type="text" value="1500.00">
</div>
</div>
<div class="col-lg-6 col-sm-12 col-12">
<div class="form-group">
<label>Payment type</label>
<select class="select">
<option>Cash</option>
<option>Online</option>
<option>Inprogress</option>
</select>
</div>
</div>
<div class="col-lg-12">
<div class="form-group">
<label>Note</label>
<textarea class="form-control"></textarea>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-submit">Submit</button>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>


<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="../assets/js/jquery-3.6.0.min.js"></script>

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