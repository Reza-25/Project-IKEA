<?php
require_once __DIR__ . '/../include/config.php'; // Import config.php
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
    <title>Dreams Pos admin template</title>

    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg" />

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />

    <link rel="stylesheet" href="../assets/css/animate.css" />

    <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css" />

    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css" />

    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css" />

    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css" />

    <link rel="stylesheet" href="../assets/css/style.css" />
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
      <div class="whirly-loader"></div>
    </div>

    <div class="main-wrapper">
      <!-- Include sidebar -->
      <?php include BASE_PATH . '/include/sidebar.php'; ?> <!-- Import sidebar -->
      <?php include __DIR__ . '/../include/header.php'; ?> <!-- Import header -->
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
                    <h4><span class="counters" data-count="134"></span></h4>
                    <h5>Registered Suppliers</h5>
                    <h2 class="stat-change">+4 baru bulan ini</h2>
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


<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
  .card-body {
    padding: 1rem;
  }

  .chart-wrapper {
    height: 450px; /* Atur tinggi total biar sejajar */
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  canvas {
    max-height: 350px;
    margin: auto;
  }

  .small-icon {
    font-size: 1.5rem;
  }

  .card-dark {
    background-color:rgb(74, 104, 134);
    color: white;
  }

  .list-group-item {
    font-size: 0.9rem;
    padding: 0.5rem 0.75rem;
  }
</style>

<div class="container py-3">
  <div class="row g-3">
    <!-- Pie Chart -->
    <div class="col-md-6">
      <div class="card shadow h-100">
        <div class="card-body text-center chart-wrapper">
          <h5 class="mb-3">Distribusi Supplier Berdasarkan Negara</h5>
          <canvas id="countryPieChart"></canvas>
          <div class="mt-3 d-flex justify-content-center flex-wrap gap-3">
            <span style="color: #483D8B;">■ Indonesia</span>   <!-- Dark Slate Blue -->
            <span style="color: #6495ED;">■ China</span>       <!-- Cornflower Blue -->
            <span style="color: #778899;">■ Malaysia</span>    <!-- Light Slate Gray -->
            <span style="color: #6A5ACD;">■ Vietnam</span>     <!-- Slate Blue -->
            <span style="color: #708090;">■ India</span>       <!-- Slate Gray -->
          </div>
        </div>
      </div>
    </div>

    <!-- Kanan: 2 kartu -->
    <div class="col-md-6 d-flex flex-column gap-3">
      <!-- Total Supplier Aktif -->
      <div class="card card-dark text-center shadow-sm">
        <div class="card-body py-3">
          <i class="bi bi-truck small-icon mb-1"></i>
          <h6 class="mb-1">Total Supplier Aktif</h6>
          <h4 class="mb-0">128</h4>
        </div>
      </div>

      <!-- Top 5 Supplier -->
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="text-center mb-3">Top 5 Supplier Berdasarkan Nilai Transaksi</h5>
          <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between">PT Mebel Jati <span>Rp 1.200.000.000</span></li>
            <li class="list-group-item d-flex justify-content-between">CV Cahaya Lampu <span>Rp 980.000.000</span></li>
            <li class="list-group-item d-flex justify-content-between">Textile Nusantara <span>Rp 750.000.000</span></li>
            <li class="list-group-item d-flex justify-content-between">Dapur Modern <span>Rp 680.000.000</span></li>
            <li class="list-group-item d-flex justify-content-between">Rumah Indah <span>Rp 610.000.000</span></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const ctx = document.getElementById('countryPieChart').getContext('2d');
  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Indonesia', 'China', 'Malaysia', 'Vietnam', 'India'],
      datasets: [{
        data: [40, 30, 15, 10, 5],
        backgroundColor: ['#483D8B', '#6495ED', '#778899', '#6A5ACD', '#708090'],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false }
      }
    }
  });
</script>
          <div class="card mt-4">
            <div class="card-body">
              <div class="table-top">
                <div class="search-set">
                  <div class="search-path">
                    <a class="btn btn-filter" id="filter_search">
                      <img src="../assets/img/icons/filter.svg" alt="img" />
                      <span><img src="../assets/img/icons/closes.svg" alt="img" /></span>
                    </a>
                  </div>
                  <div class="search-input">
                    <a class="btn btn-searchset">
                    <img src="../assets/img/icons/search-white.svg" alt="img" /></a>
                  </div>
                </div>
                <div class="wordset">
                  <ul>
                    <li>
                      <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="../assets/img/icons/pdf.svg" alt="img" /></a>
                    </li>
                    <li>
                      <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="../assets/img/icons/excel.svg" alt="img" /></a>
                    </li>
                    <li>
                      <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="../assets/img/icons/printer.svg" alt="img" /></a>
                    </li>
                  </ul>
                </div>
              </div>

              <div class="card" id="filter_inputs">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-lg-2 col-sm-6 col-12">
                      <div class="form-group">
                        <input type="text" placeholder="Enter Supplier Code" />
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-12">
                      <div class="form-group">
                        <input type="text" placeholder="Enter Supplier" />
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-12">
                      <div class="form-group">
                        <input type="text" placeholder="Enter Phone" />
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-12">
                      <div class="form-group">
                        <input type="text" placeholder="Enter Email" />
                      </div>
                    </div>
                    <div class="col-lg-1 col-sm-6 col-12 ms-auto">
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
                      <th>
                        <label class="checkboxs">
                          <input type="checkbox" id="select-all" />
                          <span class="checkmarks"></span>
                        </label>
                      </th>
                      <th>Supplier Name</th>
                      <th>code</th>
                      <th>Phone</th>
                      <th>email</th>
                      <th>Country</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product">
                        </a>
                        <a href="javascript:void(0);">Apex Computers</a>
                      </td>
                      <td>201</td>
                      <td>+12163547758</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="b8ccd0d7d5d9cbf8ddc0d9d5c8d4dd96dbd7d5">[email&#160;protected]</a></td>
                      <td>China</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product">
                        </a>
                        <a href="javascript:void(0);">Modern Automobile</a>
                      </td>
                      <td>202</td>
                      <td>123-456-888</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="f794828483989a9285b7928f969a879b92d994989a">[email&#160;protected]</a></td>
                      <td>USA</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product">
                        </a>
                        <a href="javascript:void(0);">AIM Infotech</a>
                      </td>
                      <td>521</td>
                      <td>123-456-888</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="83e0f6f0f7eceee6f1c3e6fbe2eef3efe6ade0ecee">[email&#160;protected]</a></td>
                      <td>USA</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product">
                        </a>
                        <a href="javascript:void(0);">Best Power Tools</a>
                      </td>
                      <td>555</td>
                      <td>123-456-888</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="abc9d9dec0c7c2c5ebced3cac6dbc7ce85c8c4c6">[email&#160;protected]</a></td>
                      <td>Thailand</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product">
                        </a>
                        <a href="javascript:void(0);">AIM Infotech</a>
                      </td>
                      <td>325</td>
                      <td>+12163547758</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="1f5d7a697a6d73665f7a677e726f737a317c7072">[email&#160;protected]</a></td>
                      <td>Phuket island</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product">
                        </a>
                        <a href="javascript:void(0);">Best Power Tools</a>
                      </td>
                      <td>589</td>
                      <td>123-456-888</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="38704d5a5d4a785d40595548545d165b5755">[email&#160;protected]</a></td>
                      <td>Germany</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Apex Computers</a>
                      </td>
                      <td>254</td>
                      <td>+12163547758</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="6c0f191f180301091e2c09140d011c0009420f0301">[email&#160;protected]</a></td>
                      <td>Angola</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product">                        </a>
                        <a href="javascript:void(0);">Vinayak Tools</a>
                      </td>
                      <td>681</td>
                      <td>123-456-888</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="305a5f585e705548515d405c551e535f5d">[email&#160;protected]</a></td>
                      <td>Albania</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product">                        </a>
                        <a href="javascript:void(0);">Best Power Tools</a>
                      </td>
                      <td>555</td>
                      <td>123-456-888</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="83e1f1f6e8efeaedc3e6fbe2eef3efe6ade0ecee">[email&#160;protected]</a></td>
                      <td>Thailand</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">AIM Infotech</a>
                      </td>
                      <td>325</td>
                      <td>+12163547758</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="b5f7d0c3d0c7d9ccf5d0cdd4d8c5d9d09bd6dad8">[email&#160;protected]</a></td>
                      <td>Phuket island</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product">                        </a>
                        <a href="javascript:void(0);">Best Power Tools</a>
                      </td>
                      <td>589</td>
                      <td>123-456-888</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="d29aa7b0b7a092b7aab3bfa2beb7fcb1bdbf">[email&#160;protected]</a></td>
                      <td>Germany</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Apex Computers</a>
                      </td>
                      <td>254</td>
                      <td>+12163547758</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="9af9efe9eef5f7ffe8daffe2fbf7eaf6ffb4f9f5f7">[email&#160;protected]</a></td>
                      <td>Angola</td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/customer/customer1.jpg" alt="product">
                        </a>
                        <a href="javascript:void(0);">Vinayak Tools</a>
                      </td>
                      <td>681</td>
                      <td>123-456-888</td>
                      <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="bad0d5d2d4fadfc2dbd7cad6df94d9d5d7">[email&#160;protected]</a></td>
                      <td>Albania</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modern Timeline Recent Activity Feed (rapi grid 2 kolom) -->
<div class="recent-activity-feed-modern mx-auto my-4">
  <div class="raf-header-gradient d-flex align-items-center justify-content-center">
    <i class="fa fa-clock me-2"></i>
    <span>Recent Activity Feed</span>
  </div>
  <div class="raf-timeline px-0 py-3">
    <!-- Timeline Item -->
    <div class="raf-timeline-row">
      <div class="raf-timeline-col-icon">
        <span class="raf-timeline-dot bg-primary"><i class="fa fa-file-alt"></i></span>
        <span class="raf-timeline-line"></span>
      </div>
      <a href="#" class="raf-timeline-content text-primary">
        <div class="fw-semibold">PO sent to <span class="timeline-supplier timeline-link text-primary">PT Mebel Jati</span></div>
        <div class="raf-timeline-date">2 days ago</div>
      </a>
    </div>
    <div class="raf-timeline-row">
      <div class="raf-timeline-col-icon">
        <span class="raf-timeline-dot bg-success"><i class="fa fa-truck"></i></span>
        <span class="raf-timeline-line"></span>
      </div>
      <a href="#" class="raf-timeline-content text-success">
        <div class="fw-semibold">Delivery confirmed by <span class="timeline-supplier timeline-link text-success">CV Cahaya Lampu</span></div>
        <div class="raf-timeline-date">Yesterday</div>
      </a>
    </div>
    <div class="raf-timeline-row">
      <div class="raf-timeline-col-icon">
        <span class="raf-timeline-dot bg-warning"><i class="fa fa-phone"></i></span>
        <span class="raf-timeline-line"></span>
      </div>
      <a href="#" class="raf-timeline-content text-warning">
        <div class="fw-semibold">Call with <span class="timeline-supplier timeline-link text-warning">Textile Nusantara</span></div>
        <div class="raf-timeline-date">2025-06-29</div>
      </a>
    </div>
    <div class="raf-timeline-row">
      <div class="raf-timeline-col-icon">
        <span class="raf-timeline-dot bg-info"><i class="fa fa-envelope"></i></span>
        <span class="raf-timeline-line"></span>
      </div>
      <a href="#" class="raf-timeline-content text-info">
        <div class="fw-semibold">Email sent to <span class="timeline-supplier timeline-link text-info">Dapur Modern</span></div>
        <div class="raf-timeline-date">2025-06-28</div>
      </a>
    </div>
    <div class="raf-timeline-row">
      <div class="raf-timeline-col-icon">
        <span class="raf-timeline-dot bg-secondary"><i class="fa fa-sync-alt"></i></span>
        <!-- No line for last item -->
      </div>
      <a href="#" class="raf-timeline-content text-secondary">
        <div class="fw-semibold">Status updated by <span class="timeline-supplier timeline-link text-secondary">Rumah Indah</span></div>
        <div class="raf-timeline-date">3 days ago</div>
      </a>
    </div>
  </div>
</div>

<style>
.recent-activity-feed-modern {
  background: #fff;
  border-radius: 22px;
  box-shadow: 0 4px 18px rgba(80,100,120,0.11), 0 1.5px 8px rgba(80,100,120,0.07);
  max-width: 340px;
  margin: 24px auto 24px auto;
  padding-bottom: 0;
  overflow: visible;
}
.raf-header-gradient {
  background: linear-gradient(90deg, #1657b6 0%, #6ec6ff 100%);
  border-top-left-radius: 22px;
  border-top-right-radius: 22px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
  padding: 14px 0 10px 0;
  color: #fff;
  font-size: 1.18rem;
  font-weight: 700;
  text-align: center;
  letter-spacing: 0.5px;
}
.raf-header-gradient .fa-clock {
  font-size: 1.1em;
  color: #fff;
}
.raf-timeline {
  padding: 10px 8px 10px 8px;
}
.raf-timeline-row {
  display: grid;
  grid-template-columns: 38px 1fr;
  align-items: flex-start;
  gap: 0;
  margin-bottom: 10px;
  min-height: 48px;
  position: relative;
}
.raf-timeline-row:last-child { margin-bottom: 0; }
.raf-timeline-col-icon {
  display: flex;
  flex-direction: column;
  align-items: center;
  position: relative;
  min-width: 38px;
  width: 38px;
  height: 100%;
}
.raf-timeline-dot {
  width: 28px;
  height: 28px;
  border-radius: 50%;
  background: #e3eafc;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.05rem;
  color: #fff;
  box-shadow: 0 1px 4px rgba(80,100,120,0.07);
  border: 2px solid #fff;
  z-index: 2;
  margin-bottom: 0;
}
.raf-timeline-dot.bg-primary { background: #2563eb; }
.raf-timeline-dot.bg-success { background: #22c55e; }
.raf-timeline-dot.bg-warning { background: #f59e42; }
.raf-timeline-dot.bg-info    { background: #38bdf8; }
.raf-timeline-dot.bg-secondary { background: #64748b; }
.raf-timeline-dot i { color: #fff; }
.raf-timeline-line {
  flex: 1 1 auto;
  width: 3px;
  background: linear-gradient(to bottom, #e0e7ef 60%, #cfd8dc 100%);
  margin-top: 0;
  margin-bottom: 0;
  border-radius: 2px;
  min-height: 18px;
  margin-left: auto;
  margin-right: auto;
  z-index: 1;
}
.raf-timeline-row:last-child .raf-timeline-line { display: none; }

.raf-timeline-content {
  display: block;
  background: linear-gradient(90deg, #fafdff 80%, #f3f6fa 100%);
  border-radius: 12px;
  box-shadow: 0 1px 6px rgba(80,100,120,0.06);
  padding: 10px 12px;
  min-height: 28px;
  text-decoration: none;
  transition: box-shadow 0.18s, background 0.18s, transform 0.18s;
  margin-left: 0;
  margin-top: 0;
  margin-bottom: 0;
  font-size: 0.98em;
  color: #222;
  line-height: 1.3;
}
.raf-timeline-content:hover {
  background: #e8f0fe;
  box-shadow: 0 4px 16px rgba(80,100,120,0.13);
  transform: translateY(-1px) scale(1.01);
}
.raf-timeline-content .fw-semibold {
  font-size: 1em;
  font-weight: 600;
  letter-spacing: 0.01em;
}
.raf-timeline-date {
  color: #b0b8c1;
  font-size: 0.93em;
  font-style: italic;
  margin-top: 2px;
}
.timeline-supplier.timeline-link {
  text-decoration: underline dotted;
  cursor: pointer;
  transition: color 0.18s, text-decoration 0.18s;
  font-weight: 600;
}
.timeline-supplier.timeline-link:hover {
  color: #0d47a1 !important;
  text-decoration: underline solid;
}

.raf-timeline-content.text-primary .fw-semibold,
.raf-timeline-content.text-primary .timeline-supplier { color: #ff9800 !important; }
.raf-timeline-content.text-success .fw-semibold,
.raf-timeline-content.text-success .timeline-supplier { color: #2e7d32 !important; }
.raf-timeline-content.text-warning .fw-semibold,
.raf-timeline-content.text-warning .timeline-supplier { color: #fbc02d !important; }
.raf-timeline-content.text-info .fw-semibold,
.raf-timeline-content.text-info .timeline-supplier { color: #00bcd4 !important; }
.raf-timeline-content.text-secondary .fw-semibold,
.raf-timeline-content.text-secondary .timeline-supplier { color: #757575 !important; }

/* Lebarkan area content, kurangi margin/padding kiri */
.page-wrapper > .content {
  margin-left: 0;
  padding-left: 10px;
  padding-right: 10px;
  max-width: 100vw;
}

/* Table responsive: biar tabel bisa lebih lebar */
.table-responsive {
  overflow-x: auto;
  min-width: 0;
}

/* Table: biar lebar penuh parent */
.table.datanew {
  width: 100%;
  min-width: 900px; /* atau lebih besar sesuai kebutuhan */
}

/* Responsive: pada layar kecil tetap scroll */
@media (max-width: 991px) {
  .page-wrapper > .content {
    padding-left: 2vw;
    padding-right: 2vw;
  }
}

/* Responsive */
@media (max-width: 480px) {
  .recent-activity-feed-modern {
    max-width: 99vw;
    border-radius: 12px;
    margin: 10px auto;
  }
  .raf-header-gradient {
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    font-size: 1rem;
    padding: 10px 0 8px 0;
  }
  .raf-timeline {
    padding: 6px 2px 6px 2px;
  }
  .raf-timeline-row {
    grid-template-columns: 26px 1fr;
    min-height: 32px;
  }
  .raf-timeline-col-icon {
    min-width: 26px;
    width: 26px;
  }
  .raf-timeline-dot {
    width: 18px;
    height: 18px;
    font-size: 0.8rem;
  }
  .raf-timeline-content {
    border-radius: 7px;
    font-size: 0.93em;
    padding: 6px 6px;
  }
}
  </style>

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
                    <th>Amount</th>
                    <th>Paid By</th>
                    <th>Paid By</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="bor-b1">
                    <td>2022-03-07</td>
                    <td>INV/SL0101</td>
                    <td>$ 1500.00</td>
                    <td>Cash</td>
                    <td>
                      <a class="me-2" href="javascript:void(0);">
                        <img src="../assets/img/icons/printer.svg" alt="img" />
                      </a>
                      <a class="me-2" href="javascript:void(0);" data-bs-target="#editpayment" data-bs-toggle="modal" data-bs-dismiss="modal">
                        <img src="../assets/img/icons/edit.svg" alt="img" />
                      </a>
                      <a class="me-2 confirm-text" href="javascript:void(0);">
                        <img src="../assets/img/icons/delete.svg" alt="img" />
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
                    <input type="text" value="2022-03-07" class="datetimepicker" />
                    <a class="scanner-set input-group-text">
                      <img src="../assets/img/icons/datepicker.svg" alt="img" />
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Reference</label>
                  <input type="text" value="INV/SL0101" />
                </div>
              </div>
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Received Amount</label>
                  <input type="text" value="1500.00" />
                </div>
              </div>
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Paying Amount</label>
                  <input type="text" value="1500.00" />
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
                    <input type="text" value="2022-03-07" class="datetimepicker" />
                    <a class="scanner-set input-group-text">
                      <img src="../assets/img/icons/datepicker.svg" alt="img" />
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Reference</label>
                  <input type="text" value="INV/SL0101" />
                </div>
              </div>
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Received Amount</label>
                  <input type="text" value="1500.00" />
                </div>
              </div>
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Paying Amount</label>
                  <input type="text" value="1500.00" />
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
