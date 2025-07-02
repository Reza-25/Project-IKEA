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
<h4>Managers List</h4>
<h6>Manage your Managers</h6>
</div>
</div>

<!-- Total Expenses, Top Category, Top Expense, Avg Daily Expense -->
          <div class="row justify-content-end">
            <!-- Total Product Sold -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="revenue/revenue.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das1">
                  <div class="dash-counts">
                    <h4><span class="counters" data-count="7"></span></h4>
                    <h5>Total Managers</h5>
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
                    <h4>Putri A.</h4>
                    <h5>Most Active Manager</h5>
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
                    <h4><span class="counters" data-count="3"></span></h4>
                    <h5>Pending Tasks</h5>
                    <h2 class="stat-change">+2 dari minggu lalu</h2>
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
                    <h4>2.3 days</h4>
                    <h5>Avg. Task Completion</h5>
                   <h2 class="stat-change">-0.5 days faster</h2>
                    </div>
                    <div class="icon-box bg-hijau">
                      <i class="fa fa-chart-line"></i>
                    </div>
                </div>
              </a>
            </div>
          </div>
          <!-- END KOLOM  -->

          <!-- CHART SECTION -->
<div class="row mt-4" style="gap:24px;">
  <!-- CHART (70%) -->
  <div class="col-md-8" style="flex:0 0 70%;max-width:70%;">
    <div class="card shadow-sm" style="border-radius:18px; padding:24px 24px 18px 24px; background:#fff;">
      <!-- Mulai container: judul + tab + chart -->
      <div>
        <h5 class="mb-0 fw-bold" style="color:#2266d1;">Statistik Interaksi Manager</h5>
        <ul class="nav nav-pills mt-3 mb-3" id="chartTab" style="gap:6px;">
          <li class="nav-item">
            <button class="nav-link active" id="bar-tab" data-bs-toggle="pill" data-chart="bar" type="button" style="border-radius:8px 0 0 8px;">Bar</button>
          </li>
          <li class="nav-item">
            <button class="nav-link" id="line-tab" data-bs-toggle="pill" data-chart="line" type="button">Line</button>
          </li>
          <li class="nav-item">
            <button class="nav-link" id="pie-tab" data-bs-toggle="pill" data-chart="pie" type="button" style="border-radius:0 8px 8px 0;">Pie</button>
          </li>
        </ul>
        <div id="managerChart" style="min-height:320px;"></div>
      </div>
      <!-- Akhir container -->
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<style>
#chartTab .nav-link {
  color: #2266d1;
  background: #f2f6fb;
  font-weight: 500;
  border: none;
  transition: background 0.2s;
}
#chartTab .nav-link.active {
  background: #2266d1;
  color: #fff;
}
</style>
<script>
const barData = {
  series: [{
    data: [34, 28, 22, 19, 15, 12, 9]
  }],
  categories: ['Putri A.', 'James', 'Thomas', 'Benjamin', 'Bruklin', 'Beverly', 'B. Huber']
};
const lineData = {
  series: [{
    name: 'Interaksi',
    data: [12, 19, 15, 22, 28, 34, 30]
  }],
  categories: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min']
};
const pieData = {
  series: [30, 25, 18, 12, 8, 7],
  labels: ['Jakarta Garden City', 'Alam Sutera', 'Sentul City', 'Kota Baru Parahyangan', 'Surabaya', 'Bali']
};
let chart;
function renderChart(type) {
  let options;
  if (type === 'bar') {
    options = {
      chart: { type: 'bar', height: 320 },
      plotOptions: { bar: { horizontal: true, borderRadius: 6 } },
      colors: ['#2266d1'],
      series: barData.series,
      xaxis: { categories: barData.categories },
      title: { text: 'Manager Paling Sering Dihubungi (7 Hari Terakhir)', align: 'left', style: { fontSize: '15px' } },
      dataLabels: { enabled: true }
    };
  } else if (type === 'line') {
    options = {
      chart: { type: 'line', height: 320 },
      colors: ['#2266d1'],
      series: lineData.series,
      xaxis: { categories: lineData.categories },
      title: { text: 'Fluktuasi Interaksi per Hari', align: 'left', style: { fontSize: '15px' } },
      dataLabels: { enabled: true },
      stroke: { curve: 'smooth', width: 3 }
    };
  } else if (type === 'pie') {
    options = {
      chart: { type: 'pie', height: 320 },
      labels: pieData.labels,
      series: pieData.series,
      title: { text: 'Distribusi Interaksi per Lokasi', align: 'left', style: { fontSize: '15px' } },
      colors: ['#2266d1', '#6d28d9', '#e78001', '#018679', '#a259c6', '#ff5858'],
      legend: { position: 'bottom' }
    };
  }
  if (chart) chart.destroy();
  chart = new ApexCharts(document.querySelector("#managerChart"), options);
  chart.render();
}
document.addEventListener('DOMContentLoaded', function() {
  renderChart('bar');
  document.querySelectorAll('#chartTab .nav-link').forEach(btn => {
    btn.addEventListener('click', function() {
      document.querySelectorAll('#chartTab .nav-link').forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      renderChart(this.getAttribute('data-chart'));
    });
  });
});
</script>

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
<input type="text" placeholder="Enter Customer Code">
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
<table class="table  datanew">
<thead>
<tr>
<th>
NO
</th>
<th>Manager Name</th>
<th>Code</th>
<th>Phone</th>
<th>email</th>
<th>Branch</th>
</tr>
</thead>
<tbody>
<tr>
<td>
1
</td>
<td class="productimgname">
<a href="javascript:void(0);" class="product-img">
<img src="../assets/img/customer/customer1.jpg" alt="product">
</a>
<a href="javascript:void(0);">Thomas</a>
</td>
<td>001</td>
<td>+12163547758 </td>
<td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="1165797e7c7062517469707c617d743f727e7c">[email&#160;protected]</a></td>
<td>Alam Sutera (Tangerang)</td>
</tr>

<tr>
<td>
2
</td>
<td class="productimgname">
<a href="javascript:void(0);" class="product-img">
<img src="../assets/img/customer/customer2.jpg" alt="product">
</a>
<a href="javascript:void(0);">Benjamin</a>
</td>
<td>002</td>
<td>123-456-888</td>
<td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="dcbfa9afa8b3b1b9ae9cb9a4bdb1acb0b9f2bfb3b1">[email&#160;protected]</a></td>
<td>Sentul City (Bogor)</td>
</tr>

<tr>
<td>
3
</td>
<td class="productimgname">
<a href="javascript:void(0);" class="product-img">
<img src="../assets/img/customer/customer3.jpg" alt="product">
</a>
<a href="javascript:void(0);">Putri</a>
</td>
<td>003</td>
<td>123-456-880</td>
<td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="aeccdcdbc5c2c7c0eecbd6cfc3dec2cb80cdc1c3">[email&#160;protected]</a></td>
<td>Jakarta Garden City</td>

<tr>
<td>
4
</td>
<td class="productimgname">
<a href="javascript:void(0);" class="product-img">
<img src="../assets/img/customer/customer3.jpg" alt="product">
</a>
<a href="javascript:void(0);">James</a>
</td>
<td>004</td>
<td>123-456-888</td>
<td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="6d0e181e190200081f2d08150c001d0108430e0200">[email&#160;protected]</a></td>
<td>Kota Baru Parahyangan (Bandung)</td>
</tr>

<tr>
<td>
5
</td>
<td class="productimgname">
<a href="javascript:void(0);" class="product-img">
<img src="../assets/img/customer/customer3.jpg" alt="product">
</a>
<a href="javascript:void(0);">Bruklin</a>
</td>
<td>005</td>
<td>123-456-888</td>
<td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="aeccdcdbc5c2c7c0eecbd6cfc3dec2cb80cdc1c3">[email&#160;protected]</a></td>
<td>Surabaya</td>

</tr>
<tr>
<td>6</td>
<td class="productimgname">
<a href="javascript:void(0);" class="product-img">
<img src="../assets/img/customer/customer4.jpg" alt="product">
</a>
<a href="javascript:void(0);">Beverly</a>
</td>
<td>006</td>
<td>+12163547758 </td>
<td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="0143647764736d78416479606c716d642f626e6c">[email&#160;protected]</a></td>
<td>Bali</td>
</tr>

<tr>
<td>7</td>
<td class="productimgname">
<a href="javascript:void(0);" class="product-img">
<img src="../assets/img/customer/customer5.jpg" alt="product">
</a>
<a href="javascript:void(0);">B. Huber</a>
</td>
<td>007</td>
<td>123-456-888</td>
<td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="e8a09d8a8d9aa88d90898598848dc68b8785">[email&#160;protected]</a></td>
<td>Jakarta Garden City</td>
</tr>
</tbody>
</table>
</div>
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