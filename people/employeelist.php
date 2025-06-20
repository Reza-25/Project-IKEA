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
</head>
<body>
<div id="global-loader">
<div class="whirly-loader"> </div>
</div>

<div class="main-wrapper">
<!-- Include sidebar -->
<?php include BASE_PATH . '/include/sidebar.php'; ?> <!-- Import sidebar -->
<div class="header">

<div class="header-left active">
<a href="index.html" class="logo">
<img src="../assets/img/logo1.png" alt="">
</a>
<a id="toggle_btn" href="javascript:void(0);">
</a>
</div>

<a id="mobile_btn" class="mobile_btn" href="#sidebar">
<span class="bar-icon">
<span></span>
<span></span>
<span></span>
</span>
</a>

<ul class="nav user-menu">

<li class="nav-item">
<div class="top-nav-search">
<a href="javascript:void(0);" class="responsive-search">
<i class="fa fa-search"></i>
</a>
<form action="#">
<div class="searchinputs">
<input type="text" placeholder="Search Here ...">
<div class="search-addon">
<span><img src="../assets/img/icons/closes.svg" alt="img"></span>
</div>
</div>
<a class="btn" id="searchdiv"><img src="../assets/img/icons/search.svg" alt="img"></a>
</form>
</div>
</li>


<li class="nav-item dropdown has-arrow flag-nav">
<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);" role="button">
<img src="../assets/img/flags/us1.png" alt="" height="20">
</a>
<div class="dropdown-menu dropdown-menu-right">
<a href="javascript:void(0);" class="dropdown-item">
<img src="../assets/img/flags/us.png" alt="" height="16"> English
</a>
<a href="javascript:void(0);" class="dropdown-item">
<img src="../assets/img/flags/fr.png" alt="" height="16"> French
</a>
<a href="javascript:void(0);" class="dropdown-item">
<img src="../assets/img/flags/es.png" alt="" height="16"> Spanish
</a>
<a href="javascript:void(0);" class="dropdown-item">
<img src="../assets/img/flags/de.png" alt="" height="16"> German
</a>
</div>
</li>


<li class="nav-item dropdown">
<a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
<img src="../assets/img/icons/notification-bing.svg" alt="img"> <span class="badge rounded-pill">4</span>
</a>
<div class="dropdown-menu notifications">
<div class="topnav-dropdown-header">
<span class="notification-title">Notifications</span>
<a href="javascript:void(0)" class="clear-noti"> Clear All </a>
</div>
<div class="noti-content">
<ul class="notification-list">
<li class="notification-message">
<a href="activities.php">
<div class="media d-flex">
<span class="avatar flex-shrink-0">
<img alt="" src="../assets/img/profiles/avatar-02.jpg">
</span>
<div class="media-body flex-grow-1">
<p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
</div>
</div>
</a>
</li>
<li class="notification-message">
<a href="activities.php">
<div class="media d-flex">
<span class="avatar flex-shrink-0">
<img alt="" src="../assets/img/profiles/avatar-03.jpg">
</span>
<div class="media-body flex-grow-1">
<p class="noti-details"><span class="noti-title">Tarah Shropshire</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
<p class="noti-time"><span class="notification-time">6 mins ago</span></p>
</div>
</div>
</a>
</li>
<li class="notification-message">
<a href="activities.php">
<div class="media d-flex">
<span class="avatar flex-shrink-0">
<img alt="" src="../assets/img/profiles/avatar-06.jpg">
</span>
<div class="media-body flex-grow-1">
<p class="noti-details"><span class="noti-title">Misty Tison</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project <span class="noti-title">Doctor available module</span></p>
<p class="noti-time"><span class="notification-time">8 mins ago</span></p>
</div>
</div>
</a>
</li>
<li class="notification-message">
<a href="activities.php">
<div class="media d-flex">
<span class="avatar flex-shrink-0">
<img alt="" src="../assets/img/profiles/avatar-17.jpg">
</span>
<div class="media-body flex-grow-1">
<p class="noti-details"><span class="noti-title">Rolland Webber</span> completed task <span class="noti-title">Patient and Doctor video conferencing</span></p>
<p class="noti-time"><span class="notification-time">12 mins ago</span></p>
</div>
</div>
</a>
</li>
<li class="notification-message">
<a href="activities.php">
<div class="media d-flex">
<span class="avatar flex-shrink-0">
<img alt="" src="../assets/img/profiles/avatar-13.jpg">
</span>
<div class="media-body flex-grow-1">
<p class="noti-details"><span class="noti-title">Bernardo Galaviz</span> added new task <span class="noti-title">Private chat module</span></p>
<p class="noti-time"><span class="notification-time">2 days ago</span></p>
</div>
</div>
</a>
</li>
</ul>
</div>
<div class="topnav-dropdown-footer">
<a href="activities.php">View all Notifications</a>
</div>
</div>
</li>

<li class="nav-item dropdown has-arrow main-drop">
<a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
<span class="user-img"><img src="../assets/img/profiles/avator1.jpg" alt="">
<span class="status online"></span></span>
</a>
<div class="dropdown-menu menu-drop-user">
<div class="profilename">
<div class="profileset">
<span class="user-img"><img src="../assets/img/profiles/avator1.jpg" alt="">
<span class="status online"></span></span>
<div class="profilesets">
<h6>John Doe</h6>
<h5>Admin</h5>
</div>
</div>
<hr class="m-0">
<a class="dropdown-item" href="profile.php"> <i class="me-2" data-feather="user"></i> My Profile</a>
<a class="dropdown-item" href="generalsettings.php"><i class="me-2" data-feather="settings"></i>Settings</a>
<hr class="m-0">
<a class="dropdown-item logout pb-0" href="signin.php"><img src="../assets/img/icons/log-out.svg" class="me-2" alt="img">Logout</a>
</div>
</div>
</li>
</ul>


<div class="dropdown mobile-user-menu">
<a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
<div class="dropdown-menu dropdown-menu-right">
<a class="dropdown-item" href="profile.php">My Profile</a>
<a class="dropdown-item" href="generalsettings.php">Settings</a>
<a class="dropdown-item" href="signin.php">Logout</a>
</div>
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
    colors: ['#483D8B', '#6495ED', '#778899', '#6A5ACD', '#708090', '#5F9EA0', '#A9A9A9', '#0051BA', '#FFCC00', '#e83e8c'],
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

<!-- KPI Boxes -->
<div class="container py-4">
  <div class="row justify-content-center text-center mb-4">
    <div class="col-md-3 mb-2">
      <div class="card shadow-sm">
        <div class="card-body">
          <h6 class="text-muted">Cabang Terbaik</h6>
          <h4 class="text-primary">Alam Sutera </h4>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-2">
      <div class="card shadow-sm">
        <div class="card-body">
          <h6 class="text-muted">Karyawan Terbaik</h6>
          <h4 class="text-success">Andi Saputra</h4>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-2">
      <div class="card shadow-sm">
        <div class="card-body">
          <h6 class="text-muted">Total User</h6>
          <h4>87</h4>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-2">
      <div class="card shadow-sm">
        <div class="card-body">
          <h6 class="text-muted">Rata-rata Poin</h6>
          <h4>82.3</h4>
        </div>
      </div>
    </div>
  </div>
</div>

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