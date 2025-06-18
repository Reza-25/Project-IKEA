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
<a href="../activities.php">
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
<a href="../activities.php">
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
<a href="../activities.php">
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
<a href="../activities.php">
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
<a href="../activities.php">
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
<a href="../activities.php">View all Notifications</a>
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
<a class="dropdown-item" href="../profile.php"> <i class="me-2" data-feather="user"></i> My Profile</a>
<a class="dropdown-item" href="../generalsettings.php"><i class="me-2" data-feather="settings"></i>Settings</a>
<hr class="m-0">
<a class="dropdown-item logout pb-0" href="../signin.php"><img src="../assets/img/icons/log-out.svg" class="me-2" alt="img">Logout</a>
</div>
</div>
</li>
</ul>


<div class="dropdown mobile-user-menu">
<a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
<div class="dropdown-menu dropdown-menu-right">
<a class="dropdown-item" href="../profile.php">My Profile</a>
<a class="dropdown-item" href="../generalsettings.php">Settings</a>
<a class="dropdown-item" href="../signin.php">Logout</a>
</div>
</div>
</div>  

<!-- BAGIAN ATAS -->
<div class="page-wrapper">
  <div class="content">

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

    <!-- CHART -->
<!-- ROW CHART + CARD -->
<div class="row mt-4">
  <!-- DONUT CHART KIRI -->
  <div class="col-md-6">
    <div class="card h-100">
      <div class="text-center card-header text-white" style="background-color: rgb(100, 149, 237);">
        <h5 class="card-title mb-0">Distribusi Produk per Kategori </h5>
      </div>
      <div class="card-body" style="overflow-y: auto; max-height: 500px;">
        <div id="donutChart"></div>
      </div>
    </div>
  </div>

 <!-- UPCOMING CARD KANAN -->
<div class="col-md-6 d-flex flex-column">
  <!-- Header tetap -->
  <div class="text-center mb-2">
    <h4 class="fw-bold text-primary">UPCOMING</h4>
    <p class="text-muted">Kategori & Produk yang Akan Datang</p>
  </div>

  <!-- Container Scroll mulai dari Card 2 -->
  <div style="max-height: 300px; overflow-y: auto;">
    <div class="d-flex flex-column gap-3 pe-2">
      <!-- Card 1 -->
      <div class="card shadow p-3" style="background-color: #fef9e7;">
        <h5 class="card-title text-dark">🪑 Smart Furniture</h5>
        <p class="card-text">
          Akan diluncurkan <strong>Agustus 2025</strong><br>
          <span class="text-muted">120 produk pintar untuk rumah modern.</span>
        </p>
      </div>

      <!-- Card 2 -->
      <div class="card shadow p-3" style="background-color: #fef9e7;">
        <h5 class="card-title text-dark">📱 Home Tech</h5>
        <p class="card-text">
          Siap hadir <strong>September 2025</strong><br>
          <span class="text-muted">80 produk teknologi dapur & kamar.</span>
        </p>
      </div>

      <!-- Card 3 -->
      <div class="card shadow p-3" style="background-color: #fef9e7;">
        <h5 class="card-title text-dark">🌱 Eco Living</h5>
        <p class="card-text">
          Rilis <strong>Oktober 2025</strong><br>
          <span class="text-muted">Produk ramah lingkungan untuk rumah hijau.</span>
        </p>
      </div>

      <!-- Card 4 -->
      <div class="card shadow p-3" style="background-color: #fef9e7;">
        <h5 class="card-title text-dark">🛋️ Modular Sofa</h5>
        <p class="card-text">
          Hadir <strong>November 2025</strong><br>
          <span class="text-muted">Sofa fleksibel untuk berbagai gaya ruang.</span>
        </p>
      </div>
    </div>
  </div>
</div>

<!-- END UPCOMING CARD KANAN -->    

  <!-- CDN APEXCHARTS -->
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

  <!-- Chart Script -->
  <script>
    const categoryLabels = [
      "Furniture", "Lighting", "Storage", "Bedroom", "Living Room",
      "Kitchen", "Dining", "Office", "Outdoor", "Textiles",
      "Decoration", "Bathroom", "Children", "Appliances", "Rugs",
      "Curtains", "Tableware", "Cookware", "Laundry", "Cleaning", "Pet"
    ];

    const categoryValues = [
      1200, 800, 950, 1000, 1100, 700, 600, 550, 400, 650,
      300, 480, 500, 320, 430, 290, 510, 620, 230, 190, 100
    ];

    // Warna RGB Merah, Biru, Hijau
  const rgbColors = [
    "rgb(72, 61, 139)",    // dark slate blue
    "rgb(100, 149, 237)",  // cornflower blue
    "rgb(119, 136, 153)"   // light slate gray
    ];

    // Mengulang warna untuk setiap kategori
    const repeatedColors = categoryLabels.map((_, i) => rgbColors[i % rgbColors.length]);

    // Donut Chart
    var donutOptions = {
      chart: { type: 'donut' },
      series: categoryValues,
      labels: categoryLabels,
      colors: repeatedColors,
      title: {
        // text: "Distribusi Produk per Kategori"
      },
      responsive: [{
        breakpoint: 480,
        options: {
          chart: { width: 360 },
          legend: { position: 'bottom' }
        }
      }]
    };
    var donutChart = new ApexCharts(document.querySelector("#donutChart"), donutOptions);
    donutChart.render();

    // Bar Chart
    var barOptions = {
      chart: {
        type: 'bar',
        height: 400
      },
      series: [{
        name: "Jumlah Produk",
        data: categoryValues
      }],
      colors: repeatedColors,
      xaxis: {
        categories: categoryLabels,
        labels: { rotate: -45 }
      },
      title: {
        text: "Jumlah Produk per Kategori",
        align: 'center'
      },
      plotOptions: {
        bar: {
          distributed: true
        }
      }
    };
    var barChart = new ApexCharts(document.querySelector("#barChart"), barOptions);
    barChart.render();
    </script>

    <!-- 👇 Bagian Search -->
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

      <!-- CATEGORY PRODUCT -->

              <div class="card" id="filter_inputs">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-lg-2 col-sm-6 col-12">
                      <div class="form-group">
                        <input type="text" class="datetimepicker cal-icon" placeholder="Choose Date" />
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-12">
                      <div class="form-group">
                        <input type="text" placeholder="Enter Reference" />
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-12">
                      <div class="form-group">
                        <select class="select">
                          <option>Choose Category</option>
                          <option>Computers</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-12">
                      <div class="form-group">
                        <select class="select">
                          <option>Choose Sub Category</option>
                          <option>Fruits</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-12">
                      <div class="form-group">
                        <select class="select">
                          <option>Choose Sub Brand</option>
                          <option>Iphone</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-12">
                      <div class="form-group">
                        <a class="btn btn-filters ms-auto"><img src="../assets/img/icons/search-whites.svg" alt="img" /></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="table-responsive">
                <table class="table datanew">
                  <thead>
                    <tr>
                      <th>NO
                      </th>
                      <th>Category Name</th>
                      <th>Date</th>
                      <th>Branch</th>
                      <th>Revund Total</th>
                      <th>Percentage</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        1
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product1.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Furniture</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>Bogor</td>
                      <td>1200</td>
                      <td>10.1%</td>
                      <td><span class="badges bg-lightgreen">Received</span></td>
                    </tr>

                    <tr>
                      <td>
                        2
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product2.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Lighting</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>Jakarta Barat</td>
                      <td>800</td>
                      <td>6.7%</td>
                      <td><span class="badges bg-lightred">Pending</span></td>
                    </tr>
                    
                    <tr>
                      <td>
                        3
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product3.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Storage</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>Jakarta Timur</td>
                      <td>950</td>
                      <td>8.0%</td>
                      <td><span class="badges bg-lightred">Pending</span></td>
                    </tr>

                    <tr>
                      <td>
                        4
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product4.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Bedroom</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>Bandung</td>
                      <td>1000</td>
                      <td>8.4%</td>
                      <td><span class="badges bg-lightgreen">Received</span></td>
                    </tr>

                    <tr>
                      <td>
                        5
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product5.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Living Room</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>Bogor</td>
                      <td>1100</td>
                      <td>9.2%</td>
                      <td><span class="badges bg-lightred">Pending</span></td>
                    </tr>

                    <tr>
                      <td>
                        6
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product6.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Kitchen</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>Kuta</td>
                      <td>700</td>
                      <td>5.9%</td>
                      <td><span class="badges bg-lightgreen">Received</span></td>
                    </tr>

                    <tr>
                      <td>
                        7
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product7.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Dining</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>Bandung</td>
                      <td>600</td>
                      <td>5.0%</td>
                      <td><span class="badges bg-lightyellow">Ordered</span></td>
                    </tr>

                    <tr>
                      <td>
                        8
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product1.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Office</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>Bogor</td>
                      <td>550</td>
                      <td>4.6%</td>
                      <td><span class="badges bg-lightgreen">Received</span></td>
                    </tr>

                    <tr>
                      <td>
                        9
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product2.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Outdoor</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>Jakarta Barat</td>
                      <td>400</td>
                      <td>3.4%</td>
                      <td><span class="badges bg-lightyellow">Pending</span></td>
                    </tr>

                    <tr>
                      <td>
                        10
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product3.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Textiles</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>Jakarta Timur</td>
                      <td>650</td>
                      <td>5.5%</td>
                      <td><span class="badges bg-lightred">Pending</span></td>
                    </tr>

                    <tr>
                      <td>
                        11
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product4.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Decoration</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>Bandung</td>
                      <td>300</td>
                      <td>1.9%</td>
                      <td><span class="badges bg-lightgreen">Received</span></td>
                    </tr>

                    <tr>
                      <td>
                        12
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product5.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Bathroom</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>Bogor</td>
                      <td>480</td>
                      <td>4.0%</td>
                      <td><span class="badges bg-lightred">Pending</span></td>
                    </tr>

                    <tr>
                      <td>
                        13
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product6.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Children</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>Kuta</td>
                      <td>500</td>
                      <td>4.2%</td>
                      <td><span class="badges bg-lightgreen">Received</span></td>
                    </tr>

                    <tr>
                      <td>
                      14
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product7.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Appliances</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>Bandung</td>
                      <td>320</td>
                      <td>1.9%</td>
                      <td><span class="badges bg-lightyellow">Ordered</span></td>
                    </tr>

                    <tr>
                      <td>
                        15
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product2.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Rugs</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>Bogor</td>
                      <td>430</td>
                      <td>3.6%</td>
                      <td><span class="badges bg-lightgreen">Received</span></td>
                    </tr>

                    <tr>
                      <td>
                        16
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product7.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Curtains</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>Jakarta Timur</td>
                      <td>290</td>
                      <td>1.9%</td>
                      <td><span class="badges bg-lightyellow">Ordered</span></td>
                    </tr>

                    <tr>
                      <td>
                        17
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product6.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Tableware</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>Tangerang</td>
                      <td>510</td>
                      <td>4.3%</td>
                      <td><span class="badges bg-lightgreen">Received</span></td>
                    </tr>

                    <tr>
                      <td>
                        18
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product5.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Cookware</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>Bogor</td>
                      <td>620</td>
                      <td>5.2%</td>
                      <td><span class="badges bg-lightgreen">Received</span></td>
                    </tr>

                    <tr>
                      <td>
                        19
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product4.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Laundry</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>Jakarta Timur</td>
                      <td>230</td>
                      <td>1.9%</td>
                      <td><span class="badges bg-lightyellow">Ordered</span></td>
                    </tr>

                    <tr>
                      <td>
                        20
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product3.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Cleaning</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>Bogor</td>
                      <td>190</td>
                      <td>1.9%</td>
                      <td><span class="badges bg-lightgreen">Received</span></td>
                    </tr>

                    <tr>
                      <td>
                        21
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product2.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Pet</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>Bandung</td>
                      <td>100</td>
                      <td>1.9%</td>
                      <td><span class="badges bg-lightyellow">Ordered</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

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
