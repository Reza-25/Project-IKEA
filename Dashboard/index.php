<?php
session_start();
require_once __DIR__ . '/../include/config.php'; // Import config.php
$userFullName = isset($_SESSION['user_full_name']) ? $_SESSION['user_full_name'] : 'Guest';
require_once __DIR__ . '/../include/popup.php';
require_once __DIR__ . '/../AI-integrated/AI-CHAT.PHP';
// Cek apakah perlu menampilkan notifikasi login
if (isset($_SESSION['show_login_notification']) && $_SESSION['show_login_notification']) {
  $showNotification = true;
  unset($_SESSION['show_login_notification']); // Hapus session agar tidak muncul lagi
} else {
  $showNotification = false;
}
?>
<!DOCTYPE html>
<!-- test sajaa -->
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0, user-scalable=0" name="viewport"/>
<meta content="POS - Bootstrap Admin Template" name="description"/>
<meta content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive" name="keywords"/>
<meta content="Dreamguys - Bootstrap Admin Template" name="author"/>
<meta content="noindex, nofollow" name="robots"/>
<title>RuangKu</title>
<link href="../assets/img/favicon.png" rel="shortcut icon" type="image/x-icon"/>
<link href="../assets/css/bootstrap.min.css" rel="stylesheet"/>
<link href="../assets/css/animate.css" rel="stylesheet"/>
<link href="../assets/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
<link href="../assets/plugins/fontawesome/css/fontawesome.min.css" rel="stylesheet"/>
<link href="../assets/plugins/fontawesome/css/all.min.css" rel="stylesheet"/>
<link href="../assets/css/style.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

</link><link href="../assets/css/dashboard.css" rel="stylesheet"/></head>
<body>
<div id="global-loader">
<div class="whirly-loader"></div>
</div>
<div class="main-wrapper">
<?php
include __DIR__ . '/../include/sidepanel.php';
?>

<?php include __DIR__ . '/../include/header.php'; ?>
<?php include BASE_PATH . '/include/sidebar.php'; ?>

<div class="page-wrapper">
  <!-- Tampilkan popup jika diperlukan -->
<?php if ($showNotification): ?>
    <?php showLoginNotification($_SESSION['user_full_name']); ?>
<?php endif; ?>
<div class="content">
<div class="row">
<div class="col-lg-12 col-12 mb-4">
<div class="greeting-card d-flex align-items-center p-4 shadow-sm rounded animate-on-hover">
<div class="me-3 flex-shrink-0 icon-circle">
<i class="icon-yellow" data-feather="sun"></i>
</div>
<div>
<h4 class="mb-1 text-primary-dark">Good Morning, <?= $userFullName ?>! 👋</h4>
<p class="mb-0 text-primary-dark">
                    Today, you have <strong>3 tasks</strong> and <strong>5 notifications</strong> that need your attention.
                </p>
</div>
</div>
</div>
<script src="https://unpkg.com/feather-icons"></script>
<script>
            feather.replace();
            </script>
<!-- End Total Purchase Due -->
<!-- Revenue, Suppliers, Product Sold, Budget Spent -->
<div class="row justify-content-end">
<!-- Revenue -->
<div class="col-lg-3 col-sm-6 col-12 d-flex">
<a class="w-100 text-decoration-none text-dark" href="../revenue/revenue.php">
<div class="dash-count das1">
<div class="dash-counts">
<h4>Rp<span class="counters" data-count="385656.50">385,656</span></h4>
<h5>Revenue</h5>
<h2 style="font-size: 11px; font-weight: normal; margin-top: 4px;">+9% from last year</h2>
</div>
<div class="dash-imgs">
<i data-feather="trending-up"></i>
</div>
</div>
</a>
</div>
<!-- Suppliers -->
<div class="col-lg-3 col-sm-6 col-12 d-flex">
<a class="w-100 text-decoration-none text-dark" href="../people/supplierlist.php">
<div class="dash-count das2">
<div class="dash-counts">
<h4><span class="counters" data-count="1975"></span></h4>
<h5>Suppliers</h5>
<h2 style="font-size: 11px; font-weight: normal; margin-top: 4px;">+2% from last year</h2>
</div>
<div class="dash-imgs">
<i data-feather="user-check"></i>
</div>
</div>
</a>
</div>
<!-- Product Sold -->
<div class="col-lg-3 col-sm-6 col-12 d-flex">
<a class="w-100 text-decoration-none text-dark" href="../product/productsold.php">
<div class="dash-count das3">
<div class="dash-counts">
<h4><span class="counters" data-count="7863"></span></h4>
<h5>Product Sold</h5>
<h2 style="font-size: 11px; font-weight: normal; margin-top: 4px;">+15% from last year</h2>
</div>
<div class="dash-imgs">
<i data-feather="package"></i>
</div>
</div>
</a>
</div>
<!-- Budget Spent -->
<div class="col-lg-3 col-sm-6 col-12 d-flex">
<a class="w-100 text-decoration-none text-dark" href="../expense/expensecategory.php">
<div class="dash-count das4">
<div class="dash-counts">
<h4>Rp<span class="counters" data-count="185556.30">185,556.30</span></h4>
<h5>Budget Spent</h5>
<h2 style="font-size: 11px; font-weight: normal; margin-top: 4px;">+6% from last year</h2>
</div>
<div class="dash-imgs">
<i data-feather="activity"></i>
</div>
</div>
</a>
</div>
</div>
<!-- END KOLOM  -->
<!-- CHART Revenue vs Expense -->
<div class="row">
<div class="col-lg-7 col-sm-12 col-12 d-flex">
<div class="card flex-fill">
<div class="card-header pb-0 d-flex justify-content-between align-items-center">
<h5 class="card-title mb-0">Revenue vs Expense</h5>
<div class="dropdown ms-auto">
<button class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" id="yearDropdown" type="button">
            2025
            </button>
<ul aria-labelledby="yearDropdown" class="dropdown-menu">
<li><a class="dropdown-item year-option" data-year="2025" href="#">2025</a></li>
<li><a class="dropdown-item year-option" data-year="2024" href="#">2024</a></li>
<li><a class="dropdown-item year-option" data-year="2023" href="#">2023</a></li>
</ul>
</div>
</div>
<div class="card-body" style="height: 300px;">
<canvas id="salesChart"></canvas>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // DATA TAHUNAN DENGAN PERUBAHAN DRASTIS YANG BERBEDA
    const chartData = {
        '2025': {
        revenue: [5000, 8000, 15000, 25000, 38000, 45000, 30000, 18000, 12000, 10000, 9000, 8000],
        expense: [3000, 4000, 8000, 12000, 15000, 25000, 18000, 12000, 6000, 4000, 3500, 3000]
        },
        '2024': {
        revenue: [10000, 12000, 18000, 32000, 40000, 30000, 25000, 20000, 18000, 14000, 10000, 8000],
        expense: [7000, 9000, 12000, 16000, 21000, 17000, 14000, 11000, 8000, 5000, 4000, 3500]
        },
        '2023': {
        revenue: [3000, 6000, 11000, 20000, 35000, 42000, 38000, 22000, 14000, 9000, 6000, 4000],
        expense: [2000, 3000, 6000, 9000, 15000, 20000, 18000, 12000, 7000, 4000, 3000, 2500]
        }
    };

    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [
            {
            label: 'Revenue',
            data: chartData['2025'].revenue,
            fill: true,
            backgroundColor: 'rgba(56, 189, 248, 0.1)',
            borderColor: '#38bdf8',
            borderWidth: 2.5,
            pointRadius: 2,
            pointHoverRadius: 5,
            pointBackgroundColor: '#38bdf8',
            tension: 0.5
            },
            {
            label: 'Expense',
            data: chartData['2025'].expense,
            fill: true,
            backgroundColor: 'rgba(168, 85, 247, 0.1)',
            borderColor: '#a855f7',
            borderWidth: 2.5,
            pointRadius: 2,
            pointHoverRadius: 5,
            pointBackgroundColor: '#a855f7',
            tension: 0.5
            }
        ]
        },
        options: {
        maintainAspectRatio: false,
        responsive: true,
        plugins: {
            legend: {
            display: true,
            position: 'top',
            labels: {
                font: { size: 13 },
                color: '#444'
            }
            },
            tooltip: {
            backgroundColor: '#fff',
            titleColor: '#000',
            bodyColor: '#000',
            borderColor: '#ccc',
            borderWidth: 1
            }
        },
        scales: {
            y: {
            beginAtZero: true,
            ticks: {
                callback: value => '$' + value,
                color: '#777'
            },
            grid: {
                color: '#f0f0f0'
            }
            },
            x: {
            ticks: {
                color: '#777'
            },
            grid: {
                display: false
            }
            }
        }
        }
    });

    // DROPDOWN TAHUN (tidak reload halaman)
    document.querySelectorAll('.year-option').forEach(item => {
        item.addEventListener('click', function (e) {
        e.preventDefault(); // agar tidak reload
        const year = this.getAttribute('data-year');
        document.getElementById('yearDropdown').innerText = year;
        salesChart.data.datasets[0].data = chartData[year].revenue;
        salesChart.data.datasets[1].data = chartData[year].expense;
        salesChart.update();
        });
    });
    </script>
<!-- END CHART Revenue vs Expense -->
<!-- TOP PRODUCTS -->
<div class="col-lg-5 col-sm-12 col-12 d-flex">
<div class="card flex-fill">
<div class="card-header pb-0">
<ul class="nav nav-tabs card-header-tabs" id="topTabs" role="tablist">
<li class="nav-item">
<button class="nav-link active" data-bs-target="#products" data-bs-toggle="tab" id="products-tab" role="tab" type="button">Top Categories Products</button>
</li>
<li class="nav-item">
<button class="nav-link" data-bs-target="#categories" data-bs-toggle="tab" id="categories-tab" role="tab" type="button">Top Products</button>
</li>
</ul>
</div>
<div class="card-body tab-content" id="topTabsContent">
<!-- Top Category Tab -->
<div class="tab-pane fade show active" id="products" role="tabpanel">
<div class="product-progress-list">
<div class="product-progress-item d-flex align-items-center mb-4">
<div class="number-badge">1</div>
<div class="icon-wrapper bg-light-primary text-primary ms-2 me-3">
<i class="fas fa-home"></i>
</div>
<div class="flex-grow-1">
<div class="d-flex justify-content-between">
<span class="fw-semibold">Furniture</span>
</div>
<div class="price-info">
<strong>5070 Pieces </strong>
<span class="text-primary">+24%</span>
</div>
<div class="progress">
<div class="progress-bar bg-primary" style="width: 85%;"></div>
</div>
</div>
</div>
<div class="product-progress-item d-flex align-items-center mb-4">
<div class="number-badge">2</div>
<div class="icon-wrapper bg-light-purple text-purple ms-2 me-3">
<i class="fas fa-bed"></i>
</div>
<div class="flex-grow-1">
<div class="d-flex justify-content-between">
<span class="fw-semibold">Bedroom</span>
</div>
<div class="price-info">
<strong>3880 Pieces</strong>
<span class="text-purple">+18%</span>
</div>
<div class="progress">
<div class="progress-bar bg-purple" style="width: 72%;"></div>
</div>
</div>
</div>
<div class="product-progress-item d-flex align-items-center mb-4">
<div class="number-badge">3</div>
<div class="icon-wrapper bg-light-success text-success ms-2 me-3">
<i class="fas fa-utensils"></i>
</div>
<div class="flex-grow-1">
<div class="d-flex justify-content-between">
<span class="fw-semibold">Kitchen</span>
</div>
<div class="price-info">
<strong>3020 Pieces</strong>
<span class="text-success">+12%</span>
</div>
<div class="progress">
<div class="progress-bar bg-success" style="width: 65%;"></div>
</div>
</div>
</div>
<div class="product-progress-item d-flex align-items-center">
<div class="number-badge">4</div>
<div class="icon-wrapper bg-light-info text-info ms-2 me-3">
<i class="fas fas fa-shower"></i>
</div>
<div class="flex-grow-1">
<div class="d-flex justify-content-between">
<span class="fw-semibold">Bathroom</span>
</div>
<div class="price-info">
<strong>2050 Pieces</strong>
<span class="text-info">+9%</span>
</div>
<div class="progress">
<div class="progress-bar bg-info" style="width: 58%;"></div>
</div>
</div>
</div>
</div>
</div>
<!-- Top Categories Tab -->
<div class="tab-pane fade" id="categories" role="tabpanel">
<div class="product-progress-list">
<div class="product-progress-item d-flex align-items-center mb-4">
<div class="number-badge">1</div>
<div class="icon-wrapper bg-light-primary text-primary ms-2 me-3">
<i class="fas fa-couch"></i>
</div>
<div class="flex-grow-1">
<div class="d-flex justify-content-between">
<span class="fw-semibold">KIVIK Sofa</span>
</div>
<div class="price-info">
<strong>Rp 7,5 JT</strong>
<span class="text-primary">+33%</span>
</div>
<div class="progress">
<div class="progress-bar bg-primary" style="width: 88%;"></div>
</div>
</div>
</div>
<div class="product-progress-item d-flex align-items-center mb-4">
<div class="number-badge">2</div>
<div class="icon-wrapper bg-light-purple text-purple ms-2 me-3">
<i class="fas fa-lightbulb"></i>
</div>
<div class="flex-grow-1">
<div class="d-flex justify-content-between">
<span class="fw-semibold">MALM Bed Frame</span>
</div>
<div class="price-info">
<strong>Rp 10,5 JT</strong>
<span class="text-purple">+26%</span>
</div>
<div class="progress">
<div class="progress-bar bg-purple" style="width: 76%;"></div>
</div>
</div>
</div>
<div class="product-progress-item d-flex align-items-center mb-4">
<div class="number-badge">3</div>
<div class="icon-wrapper bg-light-success text-success ms-2 me-3">
<i class="fas fa-blender"></i>
</div>
<div class="flex-grow-1">
<div class="d-flex justify-content-between">
<span class="fw-semibold">METOD Cabinet</span>
</div>
<div class="price-info">
<strong>Rp 17,5 JT</strong>
<span class="text-success">+19%</span>
</div>
<div class="progress">
<div class="progress-bar bg-success" style="width: 69%;"></div>
</div>
</div>
</div>
<div class="product-progress-item d-flex align-items-center">
<div class="number-badge">4</div>
<div class="icon-wrapper bg-light-info text-info ms-2 me-3">
<i class="fas fa-bath"></i>
</div>
<div class="flex-grow-1">
<div class="d-flex justify-content-between">
<span class="fw-semibold">BROGRUND Shower Set</span>
</div>
<div class="price-info">
<strong>Rp 9,5 JT</strong>
<span class="text-info">+17%</span>
</div>
<div class="progress">
<div class="progress-bar bg-info" style="width: 60%;"></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.animated-progress').forEach(function (progress) {
      let percentage = progress.getAttribute('data-percentage');
      let bar = progress.querySelector('.progress-bar');
      setTimeout(() => {
        bar.style.width = percentage + '%';
      }, 300);
    });
  });
</script>
<div class="row mb-4" style="margin-bottom: 16px !important;">
<!-- Ringkasan Penjualan Harian -->
<div class="col-lg-8">
<div class="card shadow-sm">
<div class="card-header d-flex justify-content-between align-items-center gradient-bg">
<div>
<h6 class="mb-0 fw-bold">Ringkasan Penjualan Hari Ini / Minggu Ini</h6>
<small class="text-light">Data real-time dari sistem penjualan</small>
</div>
<div>
<i class="fas fa-chart-line fa-lg text-white"></i>
</div>
</div>
<div class="card-body p-0">
<div class="table-responsive">
<table class="table mb-0">
<thead class="bg-info-subtle text-info">
<tr>
<th>Ringkasan Harian</th>
<th>Nilai</th>
</tr>
</thead>
<tbody>
<tr><td>Jumlah Pesanan Hari Ini</td><td class="fw-bold text-primary">1.236</td></tr>
<tr><td>Total Pendapatan Hari Ini</td><td class="fw-bold text-success">Rp 1,1 Miliar</td></tr>
<tr><td>Produk Terlaris Hari Ini</td><td class="fw-bold">KIVIK Sofa</td></tr>
<tr><td>Kota dengan Pesanan Terbanyak</td><td class="fw-bold">Jakarta</td></tr>
<tr><td>Channel Terbesar (Offline/Online)</td><td class="fw-bold text-info">Online (58%)</td></tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
<!-- Performance Metrics -->
<div class="col-lg-4">
<div class="card p-4">
<h6 class="fw-bold mb-3">Performance Metrics</h6>
<div class="mb-3">
<div class="d-flex justify-content-between">
<span>Inventory Turnover</span>
<span class="text-primary">78%</span>
</div>
<div class="progress" style="height: 6px;">
<div class="progress-bar bg-primary" style="width: 78%;"></div>
</div>
</div>
<div class="mb-3">
<div class="d-flex justify-content-between">
<span>Customer Retention</span>
<span class="text-purple">65%</span>
</div>
<div class="progress" style="height: 6px;">
<div class="progress-bar" style="width: 65%; background-color: #a14fd5;"></div>
</div>
</div>
<div class="mb-3">
<div class="d-flex justify-content-between">
<span>Store Efficiency</span>
<span class="text-success">92%</span>
</div>
<div class="progress" style="height: 6px;">
<div class="progress-bar bg-success" style="width: 92%;"></div>
</div>
</div>
<div class="mb-3">
<div class="d-flex justify-content-between">
<span>Online Sales Growth</span>
<span class="text-info">45%</span>
</div>
<div class="progress" style="height: 6px;">
<div class="progress-bar bg-info" style="width: 45%;"></div>
</div>
</div>
<!-- Goal Completion Simple -->
<div class="goal-simple">
<h1>75%</h1>
<p>🎯 Goal Completed</p>
</div>
</div>
</div>
</div>
<!-- IKEA Executive Dashboard End -->
<!-- ...existing code... -->
<div class="row mb-4" style="margin-top: -16px !important;">
<!-- Kontainer Gabungan CSAT & Traffic Source -->
<div class="col-lg-8 col-md-12 mb-4">
<div class="card shadow d-flex flex-row align-items-stretch" style="min-height: 260px;">
<!-- Customer Satisfaction -->
<div class="flex-fill d-flex align-items-center px-4 py-3 csat-vertical" style="min-width:0;">
<div class="me-3 flex-shrink-0">
<canvas height="50" id="csatDonut" width="50"></canvas>
</div>
<div>
<h6 class="fw-bold mb-1 text-primary">Customer Satisfaction</h6>
<div class="mb-1">
<span class="fs-3 fw-bold text-primary">4.5/5</span>
<span class="text-warning ms-2" style="font-size: 1.3rem;">
<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
</span>
</div>
<div class="mb-1">
<span class="fw-semibold">Feedback:</span>
<span class="text-success">4.5/5</span>
</div>
<div class="mb-1">
<span class="fw-semibold">Bintang Produk:</span>
<span class="text-warning">12.350</span>
</div>
<div class="mb-1">
<span class="fw-semibold">Komplain vs Pembelian:</span>
<span class="text-danger">120</span> / <span class="text-success">7.863</span>
</div>
<small class="text-muted">Tingkat kepuasan tinggi, komplain &lt;2%</small>
</div>
</div>
<!-- Garis Vertikal -->
<div class="d-none d-md-block" style="width:1px; background:rgba(0,0,0,0.08); margin:24px 0;"></div>
<!-- Traffic Source -->
<div class="flex-fill d-flex align-items-center px-4 py-3 csat-vertical" style="min-width:0;">
<div class="me-3 flex-shrink-0">
<canvas height="50" id="trafficDonut" width="50"></canvas>
</div>
<div>
<h6 class="fw-bold mb-1 text-purple">Traffic Source</h6>
<div class="mb-2">
<div class="d-flex justify-content-between">
<span>SEO</span>
<span class="text-primary">3.2% CR</span>
</div>
<div class="progress mb-1" style="height: 5px;">
<div class="progress-bar bg-primary" style="width: 60%"></div>
</div>
<div class="d-flex justify-content-between">
<span>Instagram</span>
<span class="text-purple">2.7% CR</span>
</div>
<div class="progress mb-1" style="height: 5px;">
<div class="progress-bar" style="width: 45%; background-color: #751e8d;"></div>
</div>
<div class="d-flex justify-content-between">
<span>Tiktok</span>
<span class="text-success">4.1% CR</span>
</div>
<div class="progress mb-1" style="height: 5px;">
<div class="progress-bar bg-success" style="width: 70%"></div>
</div>
<div class="d-flex justify-content-between">
<span>Email</span>
<span class="text-info">1.8% CR</span>
</div>
<div class="progress" style="height: 5px;">
<div class="progress-bar bg-info" style="width: 30%"></div>
</div>
</div>
<small class="text-muted">Produk terlaris dari IG: KIVIK Sofa</small>
</div>
</div>
</div>
<!-- PETA IKEA Langsung di bawah kontainer CSAT & Traffic Source -->
<div style="margin-top: 24px;">
<div class="dashboard-card" style="background: linear-gradient(135deg, #2196f3 0%, #64b5f6 100%);">
<div class="card-header">
<h2>Lokasi Toko IKEA</h2>
<a href="#" onclick="zoomOut()">Lihat Semua</a>
</div>
<div id="map" style="height: 260px;"></div>
</div>
</div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const csatCtx = document.getElementById('csatDonut').getContext('2d');
  const trafficCtx = document.getElementById('trafficDonut').getContext('2d');

  new Chart(csatCtx, {
    type: 'doughnut',
    data: {
      labels: ['Puas', 'Tidak Puas'],
      datasets: [{
        data: [90, 10],
        backgroundColor: ['#3a8dde', '#eee'],
        borderWidth: 0
      }]
    },
    options: {
      responsive: false,
      maintainAspectRatio: false,
      cutout: '70%',
      plugins: {
        legend: { display: false },
        tooltip: { enabled: false }
      }
    }
  });

  new Chart(trafficCtx, {
    type: 'doughnut',
    data: {
      labels: ['SEO', 'IG', 'Tiktok', 'Email'],
      datasets: [{
        data: [30, 25, 35, 10],
        backgroundColor: ['#3a8dde', '#a14fd5', '#20c997', '#17a2b8'],
        borderWidth: 0
      }]
    },
    options: {
      responsive: false,
      maintainAspectRatio: false,
      cutout: '70%',
      plugins: {
        legend: { display: false },
        tooltip: { enabled: false }
      }
    }
  });
});
</script>
<!-- Flatpickr CSS di head -->
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
<!-- Kalender & Aktivitas -->
<div class="col-lg-4 col-md-12 mb-4">
<div class="ikea-calendar-card shadow-sm p-4 mb-2">
<div class="d-flex justify-content-between align-items-center mb-3">
<h6 class="fw-bold mb-0 text-dark">Kalender Kegiatan</h6>
<button class="btn btn-sm btn-outline-secondary" id="openCalendarBtn" type="button">
<i class="fas fa-calendar-alt"></i>
</button>
</div>
<input class="form-control mb-3" id="calendarPicker" placeholder="Pilih Tanggal" type="text"/>
<!-- Jadwal Hari Ini -->
<div class="mb-3">
<div class="mb-2">
<strong class="text-muted">09:00</strong>
<div class="bg-primary text-white p-2 rounded d-flex justify-content-between align-items-center">
<span><i class="fas fa-boxes me-2"></i>Stok Opname Gudang Sentul</span>
<span class="badge bg-light text-dark">Inventaris</span>
</div>
</div>
<div class="mb-2">
<strong class="text-muted">11:00</strong>
<div class="bg-info text-white p-2 rounded d-flex justify-content-between align-items-center">
<span><i class="fas fa-truck me-2"></i>Monitoring Pengiriman Jakarta</span>
<span class="badge bg-light text-dark">Distribusi</span>
</div>
</div>
<div class="mb-2">
<strong class="text-muted">14:00</strong>
<div class="bg-warning text-white p-2 rounded d-flex justify-content-between align-items-center">
<span><i class="fas fa-users me-2"></i>Evaluasi Staff Gudang</span>
<span class="badge bg-light text-dark">HR</span>
</div>
</div>
</div>
<!-- Aktivitas Terbaru -->
<h6 class="fw-bold mb-3 text-dark">Aktivitas Terbaru</h6>
<ul class="list-group list-group-flush">
<li class="list-group-item px-0 d-flex flex-column">
<div class="d-flex align-items-center mb-1">
<img class="rounded-circle me-2" height="28" src="https://i.pravatar.cc/28?img=12" width="28"/>
<div>
<strong>Yusuf M.</strong> mengunggah laporan persediaan.
              <div class="text-muted small">Hari ini, 08:45</div>
</div>
</div>
<div class="bg-light p-2 rounded d-flex justify-content-between align-items-center">
<span>Inventaris Gudang #Q4-2025</span>
<span class="badge bg-primary text-white">Laporan</span>
</div>
</li>
<li class="list-group-item px-0 d-flex flex-column">
<div class="d-flex align-items-center">
<img class="rounded-circle me-2" height="28" src="https://i.pravatar.cc/28?img=32" width="28"/>
<div>
<strong>Linda R.</strong> menyelesaikan evaluasi tim distribusi.
              <div class="text-muted small">Kemarin, 17:20</div>
</div>
</div>
</li>
</ul>
</div>
</div>
</link></div>
<!-- Flatpickr JS sebelum penutup body -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  // Inisialisasi Flatpickr
  const calendarInstance = flatpickr("#calendarPicker", {
    dateFormat: "Y-m-d",
    defaultDate: "today",
    altInput: true,
    altFormat: "l, d M Y",
    allowInput: false,
    monthSelectorType: 'dropdown',
    yearSelectorType: 'dropdown'
  });

  // Buka kalender saat tombol ditekan
  document.getElementById('openCalendarBtn').addEventListener('click', function () {
    calendarInstance.open();
  });
</script>
<!-- Tambahkan di akhir halaman sebelum </body> jika belum ada -->
<link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" rel="stylesheet"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
  const map = L.map('map').setView([-2.5, 118], 5.2);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap',
    minZoom: 4,
    maxZoom: 18
  }).addTo(map);

  const tokoIKEA = [
    { nama: "IKEA Alam Sutera", lokasi: [-6.2246, 106.6529], alamat: "Alam Sutera, Tangerang" },
    { nama: "IKEA Sentul City", lokasi: [-6.5315, 106.8650], alamat: "Sentul City, Bogor" },
    { nama: "IKEA Jakarta Garden City", lokasi: [-6.1913, 106.9517], alamat: "Cakung, Jakarta Timur" },
    { nama: "IKEA Mal Taman Anggrek", lokasi: [-6.1788, 106.7902], alamat: "Grogol, Jakarta Barat" },
    { nama: "IKEA Surabaya", lokasi: [-7.2903, 112.7275], alamat: "Galaxy Mall, Surabaya" },
    { nama: "IKEA Bandung", lokasi: [-6.9167, 107.6000], alamat: "Soekarno-Hatta, Bandung" },
    { nama: "IKEA Bali", lokasi: [-8.7922, 115.2248], alamat: "Ngurah Rai, Badung" }
  ];

  tokoIKEA.forEach(toko => {
    L.circleMarker(toko.lokasi, {
      radius: 8,
      color: "#c62828",
      fillColor: "#e53935",
      fillOpacity: 0.9
    })
    .addTo(map)
    .bindPopup(`<strong>${toko.nama}</strong><br>${toko.alamat}`);
  });

  function zoomOut() {
    map.setView([-2.5, 118], 5.2);
  }
</script>
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/feather.min.js"></script>
<script src="../assets/js/jquery.slimscroll.min.js"></script>
<script src="../assets/js/jquery.dataTables.min.js"></script>
<script src="../assets/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/script.js"></script>
</div></div></div></div></div></body>
</html>
