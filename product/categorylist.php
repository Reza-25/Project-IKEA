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
<!-- /Include sidebar -->


<!-- BAGIAN ATAS -->
<div class="page-wrapper">
  <div class="content">
  
  <div class="page-header">
  <?php include __DIR__ . '/../include/header.php'; ?> <!-- Import header -->
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
          <a class="btn btn-filters ms-auto">
            <img src="../assets/img/icons/search-whites.svg" alt="img" />
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Tambahan CSS untuk kolom sempit -->
<style>
  th.total-col, td.total-col,
  th.detail-col, td.detail-col {
    white-space: nowrap;
    width: 1%;
    text-align: center;
  }

  .modal-content {
  transition: all 0.3s ease-in-out;
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
}
  
</style>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content shadow-lg border-0" style="border-radius: 12px;">
      <div class="modal-header text-white" style="background-color: #ff9f43; border-top-left-radius: 12px; border-top-right-radius: 12px;">
        <h5 class="modal-title">Category Detail</h5>
        <button type="button" class="btn btn-sm text-white bg-danger border-0" data-bs-dismiss="modal" aria-label="Close" style="padding: 4px 8px; border-radius: 4px;">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-x" viewBox="0 0 16 16">
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
          </svg>
        </button>
      </div>

      <div class="modal-body" style="background-color: #fdfdfd; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
        <div class="row">
          <!-- Panel Kiri - Category Information -->
          <div class="col-md-6 mb-3">
            <div class="card shadow-sm border-0 h-100 rounded-3" style="background-color: #e3f2fd;">
              <div class="card-body p-3">
                <h6 class="fw-bold text-center mb-3 fs-5 text-dark">Category Information</h6>
                <ul id="modalContent" class="list-group fs-6 mb-0"></ul>
              </div>
            </div>
          </div>

          <!-- Panel Kanan - Top Products -->
          <div class="col-md-6 mb-3">
            <div class="card shadow-sm border-0 h-100 rounded-3" style="background-color: #fff9e6;">
              <div class="card-body p-3">
                <h6 class="fw-bold text-center mb-3 fs-5 text-dark">Top 5 Popular Products</h6>
                <div class="table-responsive">
                  <table class="table table-sm table-bordered mb-0 small">
                    <thead class="table-light text-center">
                      <tr style="font-size: 13px;">
                        <th style="width: 10%;">No</th>
                        <th style="width: 55%;">Product</th>
                        <th style="width: 35%;">Action</th>
                      </tr>
                    </thead>
                    <tbody id="topProductTable" class="text-center">
                      <!-- Akan diisi oleh JavaScript -->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- End Row -->
        </div>
      </div>
    </div>
  </div>
</div>




<!-- Tabel Kategori -->
<div class="table-responsive mt-4">
  <table class="table datanew table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Image/Icon</th>
        <th>Category ID</th>
        <th>Category Name</th>
        <th>Description</th>
        <th class="total-col">Total Products</th>
        <th class="detail-col">View Detail</th>
      </tr>
    </thead>
    <tbody>
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

    // Dummy 5 Produk Populer
    const topProducts = [
      "Smart Sofa", "LED Lamp", "Eco Dining Set", "Minimalist Desk", "Smart Drawer"
    ];
    let productRows = "";
    topProducts.forEach((p, i) => {
      productRows += `
        <tr>
          <td>${i + 1}</td>
          <td>${p}</td>
          <td><a href="../product-details.php" class="btn btn-sm btn-outline-primary">View</a></td>
        </tr>
      `;
    });
    document.getElementById("topProductTable").innerHTML = productRows;

    const modal = new bootstrap.Modal(document.getElementById('detailModal'));
    modal.show();
  }


        // Render data ke tabel utama
        categoryData.forEach((item, index) => {
          document.write(`
            <tr>
              <td>${index + 1}</td>
              <td><img src="../assets/img/product/${item[8]}" width="40" alt="icon"></td>
              <td>${item[0]}</td>
              <td>${item[1]}</td>
              <td>${item[2]}</td>
              <td class="total-col">${item[3]}</td>
              <td class="detail-col">
                <button class="btn btn-sm btn-primary" onclick="showDetail(${index})">View Detail</button>
              </td>
            </tr>
          `);
        });
      </script>
    </tbody>
  </table>
</div>

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
