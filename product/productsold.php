<?php
require_once __DIR__ . '/../include/config.php'; // Import config.php

?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="POS - Bootstrap Admin Template" name="description" />
    <meta content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects" name="keywords" />
    <meta content="Dreamguys - Bootstrap Admin Template" name="author" />
    <meta content="noindex, nofollow" name="robots" />
    <title>IKEA</title>
    <link href="../assets/img/favicon.jpg" rel="shortcut icon" type="image/x-icon" />
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/animate.css" rel="stylesheet" />
    <link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="../assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="../assets/plugins/fontawesome/css/fontawesome.min.css" rel="stylesheet" />
    <link href="../assets/plugins/fontawesome/css/all.min.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

   <style>

  
    a {
    text-decoration: none !important;
  }

  .ikea-header {
    background-color: #0051BA !important;
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
  body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f8;
      padding: 30px;
      color: #333;
    }

    h2 {
      margin-bottom: 20px;
      color: #2c3e50;
    }

    .filter-container {
      margin-bottom: 20px;
    }

    select {
      padding: 8px 12px;
      font-size: 14px;
      border-radius: 8px;
      border: 1px solid #ccc;
      background-color: #fff;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .dashboard {
      display: flex;
      justify-content: space-between;
      gap: 20px;
      flex-wrap: wrap;
    }

    .chart-container, .notes-container {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .chart-container:hover,
    .notes-container:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    .chart-container {
      flex: 0 0 64%;
      background: #fff;
      border-radius: 16px;
      padding: 20px;
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
      min-width: 300px;
    }

    .notes-container {
      flex: 0 0 33%;
      background: #fff;
      border-radius: 16px;
      padding: 20px;
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
      min-width: 260px;
      display: flex;
      flex-direction: column;
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

    .note-title i {
      font-size: 16px;
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

    @media (max-width: 768px) {
      .chart-container, .notes-container {
        flex: 100%;
      }
    }

   .chart-wrapper {
  background: #ffffff;
  border-radius: 16px;
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
  padding: 20px 24px;
  position: relative;
  flex: 0 0 64%;
  display: flex;
  flex-direction: column;
  gap: 16px;
  min-width: 300px;
}

.chart-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
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

.chart-notes-row {
  display: flex;
  gap: 20px;
  align-items: flex-start;
}

.chart-wrapper {
  flex: 0 0 55%;   /* Lebih kecil dari sebelumnya */
  min-width: 260px;
  max-width: 55%;
  padding: 18px 16px;
}

.notes-container {
  flex: 0 0 40%;   /* Lebar notes lebih besar sedikit */
  min-width: 200px;
  max-width: 40%;
  padding: 18px 16px;
}

/* Responsive: stack on mobile */
@media (max-width: 900px) {
  .chart-notes-row {
    flex-direction: column;
  }
  .chart-wrapper, .notes-container {
    max-width: 100%;
    flex: 100%;
  }
}
/* END - bar chart & notes */

/* css pie chart & tabel */
 body {
    font-family: 'Segoe UI', sans-serif;
    background-color: #f4f6f8;
    padding: 30px;
    color: #333;
  }
  .section {
    display: flex;
    justify-content: center;
  }
  .table-wrapper {
    width: 100%;
    max-width: 1100px;
  }
  .table-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 16px;
    color: #0d6efd;
  }
  .table-comparison {
    background: #fff;
    padding: 24px;
    border-radius: 20px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.1);
    width: 100%;
    display: flex;
    gap: 24px;
    justify-content: space-between;
    align-items: flex-start;
  }
  .table-box {
    flex: 1;
    background: #ffffff;
    padding: 16px;
    border-radius: 16px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .table-box:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
  }
  .chart-container {
    height: 200px;
    margin-bottom: 20px;
  }
  .divider {
    width: 2px;
    background: linear-gradient(to bottom, #cfd8dc, #90a4ae, #cfd8dc);
    border-radius: 4px;
  }
  table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 10px;
    font-size: 14px;
  }
  thead th {
    text-align: left;
    padding: 12px 16px;
    background: #f0f4f8;
    color: #1e293b;
    font-weight: 600;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
  }
  tbody td {
    background: #ffffff;
    padding: 14px 16px;
    border-bottom: 1px solid #e2e8f0;
    transition: background 0.3s ease;
  }
  tbody tr {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
  }
  tbody tr:hover td {
    background-color: #f1f5f9;
  }
  .highlight {
    background-color: #d2e3fc !important;
    font-weight: bold;
  }
  .caption-icon {
    margin-right: 8px;
    color: #0d6efd;
  }
  .category-icon {
    margin-right: 6px;
  }
   body {
    font-family: 'Segoe UI', sans-serif;
    background-color: #f4f6f8;
    padding: 30px;
    color: #333;
  }
  .section {
    display: flex;
    justify-content: center;
  }
  .table-wrapper {
    width: 100%;
    max-width: 1100px;
  }
  .table-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 16px;
    color: #0d6efd;
  }
  .table-comparison {
    background: #fff;
    padding: 24px;
    border-radius: 20px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.1);
    width: 100%;
    display: flex;
    gap: 24px;
    justify-content: space-between;
    align-items: flex-start;
  }
  .table-box {
    flex: 1;
    background: #ffffff;
    padding: 16px;
    border-radius: 16px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .table-box:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
  }
  .chart-container {
    height: 200px;
    margin-bottom: 20px;
  }
  .divider {
    width: 2px;
    background: linear-gradient(to bottom, #cfd8dc, #90a4ae, #cfd8dc);
    border-radius: 4px;
  }
  table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 10px;
    font-size: 14px;
  }
  thead th {
    text-align: left;
    padding: 12px 16px;
    background: #f0f4f8;
    color: #1e293b;
    font-weight: 600;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
  }
  tbody td {
    background: #ffffff;
    padding: 14px 16px;
    border-bottom: 1px solid #e2e8f0;
    transition: background 0.3s ease;
  }
  tbody tr {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
  }
  tbody tr:hover td {
    background-color: #f1f5f9;
  }
  .highlight {
    background-color: #d2e3fc !important;
    font-weight: bold;
  }
  .caption-icon {
    margin-right: 8px;
    color: #0d6efd;
  }
  .category-icon {
    margin-right: 6px;
  }
  /* END - pie chart & tabel */

</style>


  </head>
  <body>
    <div id="global-loader">
      <div class="whirly-loader"></div>
    </div>
    
    <div class="main-wrapper">
        <!-- Include sidebar -->
       <?php include BASE_PATH . '/include/sidebar.php'; ?> <!-- Import sidebar -->
     
    


     <!-- BAGIAN ATAS -->
<div class="page-wrapper">
<?php include __DIR__ . '/../include/header.php'; ?> <!-- Import header -->
  <div class="content">
  
  <div class="page-header">
      <div class="page-title">
        <h4>Product Sold</h4>
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
                    <h4><span class="counters" data-count="1975"></span></h4>
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
                    <h4><span class="counters" data-count="7863"></span></h4>
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

    <!-- Chart & Notes Row -->
<div class="chart-notes-row" style="display: flex; gap: 20px;">
  <!-- Chart Wrapper -->
<div class="chart-wrapper">
  <div class="chart-header">
    <div class="chart-title">Total Product Sold per Bulan</div>
    <select id="tahun" class="chart-select">
      <option value="2023">2023</option>
      <option value="2024">2024</option>
      <option value="2025" selected>2025</option>
    </select>
  </div>
  <!-- PENTING: canvas tetap id="chartProduk" -->
  <div style="position: relative; height: 320px;">
    <canvas id="chartProduk"></canvas>
  </div>
</div>

<!-- Notes -->
<div class="notes-container">
      <div class="note-title">Detail Produk: <span id="selectedMonth">Jan</span></div>

      <div class="note-line">
        <div class="note-icon bg-blue"><i class="fas fa-box"></i></div>
        <div class="note-text">
          <div class="note-label">Total Product Sold</div>
          <div class="note-value" id="totalSold">-</div>
        </div>
      </div>

      <div class="note-line">
        <div class="note-icon bg-green"><i class="fas fa-tags"></i></div>
        <div class="note-text">
          <div class="note-label">Top Category</div>
          <div class="note-value" id="topCategory">-</div>
        </div>
      </div>

      <div class="note-line">
        <div class="note-icon bg-orange"><i class="fas fa-star"></i></div>
        <div class="note-text">
          <div class="note-label">Top Selling Product</div>
          <div class="note-value" id="topProduct">-</div>
        </div>
      </div>

      <div class="note-line">
        <div class="note-icon bg-purple"><i class="fas fa-chart-line"></i></div>
        <div class="note-text">
          <div class="note-label">Average Sales</div>
          <div class="note-value" id="avgSold">-</div>
        </div>
      </div>
    </div>
  </div>
</div>

  <script>
    const bulanListFull = [
      "Januari", "Februari", "Maret", "April", "Mei", "Juni",
      "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    const bulanShort = [
      "Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
      "Jul", "Agu", "Sep", "Okt", "Nov", "Des"
    ];

    const produkList = ["Meja", "Kursi", "Lampu", "Sofa", "TV", "Lemari", "AC", "Kipas"];
    const kategoriMap = {
      "Meja": "Furniture", "Kursi": "Furniture", "Sofa": "Furniture", "Lemari": "Furniture",
      "Lampu": "Elektronik", "TV": "Elektronik", "AC": "Elektronik", "Kipas": "Elektronik"
    };

    const dataTahun = {};

    for (let tahun = 2023; tahun <= 2025; tahun++) {
      dataTahun[tahun] = bulanListFull.map((bulan, i) => {
        const total = Math.floor(Math.random() * 500) + 100;
        const topProduct = produkList[Math.floor(Math.random() * produkList.length)];
        const topCategory = kategoriMap[topProduct];
        const avg = Math.floor(total / 3);
        return {
          bulan: bulanShort[i],
          totalSold: total,
          topProduct,
          topCategory,
          avgSold: avg
        };
      });
    }

    let chart;
    const ctx = document.getElementById('chartProduk').getContext('2d');


    function renderChart(data, tahun) {
      const labels = data.map(item => item.bulan);
      const values = data.map(item => item.totalSold);

      if (chart) chart.destroy();

      // Gradasi biru tua ke biru muda
      const gradient = ctx.createLinearGradient(0, 0, 0, 320);
      gradient.addColorStop(0, "#0d47a1");   // Biru tua (atas)
      gradient.addColorStop(1, "#66bfff");   // Biru muda (bawah)

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
              updateNotes(data[i]);
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

      updateNotes(data[0]);
    }

    function updateNotes(item) {
      const tahun = document.getElementById("tahun").value;
      document.getElementById("selectedMonth").textContent = item.bulan + ' - ' + tahun;
      document.getElementById("totalSold").textContent = item.totalSold;
      document.getElementById("topCategory").textContent = item.topCategory;
      document.getElementById("topProduct").textContent = item.topProduct;
      document.getElementById("avgSold").textContent = item.avgSold;
    }

    function loadData() {
      const tahun = document.getElementById("tahun").value;
      const data = dataTahun[tahun];
      renderChart(data, tahun);
    }

    document.getElementById("tahun").addEventListener("change", loadData);
    window.onload = loadData;
  </script>
  <!-- END Chart & Notes Row -->

  <!-- Pie chart & Tabel -->
    <div class="section">
    <div class="table-wrapper">
      <div class="table-title"></div>
      <div class="table-comparison">
        <div class="table-box">
          <div class="chart-container">
            <canvas id="donutTerbanyak"></canvas>
          </div>
          <table id="tableTerbanyak">
            <thead>
              <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Produk</th>
                <th>Terjual</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>1</td><td><i class="fas fa-couch category-icon"></i>Furniture</td><td>Sofa Minimalis</td><td>250</td></tr>
              <tr><td>2</td><td><i class="fas fa-couch category-icon"></i>Furniture</td><td>Meja Kayu</td><td>210</td></tr>
              <tr><td>3</td><td><i class="fas fa-tv category-icon"></i>Elektronik</td><td>TV LED 50"</td><td>180</td></tr>
              <tr><td>4</td><td><i class="fas fa-couch category-icon"></i>Furniture</td><td>Kursi Kantor</td><td>160</td></tr>
              <tr><td>5</td><td><i class="fas fa-couch category-icon"></i>Furniture</td><td>Lemari Sliding</td><td>150</td></tr>
            </tbody>
          </table>
        </div>

        <div class="divider"></div>

        <div class="table-box">
          <div class="chart-container">
            <canvas id="donutTersedikit"></canvas>
          </div>
          <table id="tableTersedikit">
            <thead>
              <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Produk</th>
                <th>Terjual</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>1</td><td><i class="fas fa-brush category-icon"></i>Dekorasi</td><td>Rak Dinding</td><td>30</td></tr>
              <tr><td>2</td><td><i class="fas fa-lightbulb category-icon"></i>Dekorasi</td><td>Lampu Gantung</td><td>35</td></tr>
              <tr><td>3</td><td><i class="fas fa-rug category-icon"></i>Dekorasi</td><td>Karpet Bulat</td><td>38</td></tr>
              <tr><td>4</td><td><i class="fas fa-mirror category-icon"></i>Dekorasi</td><td>Cermin Hias</td><td>40</td></tr>
              <tr><td>5</td><td><i class="fas fa-clock category-icon"></i>Dekorasi</td><td>Jam Dinding</td><td>42</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script>
    function highlightRow(tableId, index) {
      const table = document.getElementById(tableId);
      const rows = table.querySelectorAll("tbody tr");
      rows.forEach((row, i) => {
        row.classList.toggle("highlight", i === index);
      });
    }

    new Chart(document.getElementById('donutTerbanyak'), {
      type: 'doughnut',
      data: {
        labels: ['Sofa Minimalis', 'Meja Kayu', 'TV LED 50"', 'Kursi Kantor', 'Lemari Sliding'],
        datasets: [{
          data: [250, 210, 180, 160, 150],
          backgroundColor: ['#3a8dde','#a14fd5','#20c997','#17a2b8','#ffb443'],
          borderWidth: 1   
        }]
      },
      options: {
        animation: {
          animateScale: true,
          duration: 4000, // Animasi lebih pelan (2 detik)
          easing: 'easeOutQuart'
        },
        plugins: {
          legend: { position: 'bottom' },
          title: {
            display: true,
            text: 'Produk Terbanyak Terjual',
            align: 'center',
            font: { size: 16, weight: 'bold' },
            color: '#0d6efd',
            padding: { top: 10, bottom: 10 }
          }
        },
        responsive: true,
        maintainAspectRatio: false,
        onClick: (evt, elements) => {
          if (elements.length > 0) {
            const index = elements[0].index;
            highlightRow('tableTerbanyak', index);
          }
        }
      }
    });

    new Chart(document.getElementById('donutTersedikit'), {
      type: 'doughnut',
      data: {
        labels: ['Rak Dinding', 'Lampu Gantung', 'Karpet Bulat', 'Cermin Hias', 'Jam Dinding'],
        datasets: [{
          data: [30, 35, 38, 40, 42],
          backgroundColor: ['#3a8dde','#a14fd5','#20c997','#17a2b8','#ffb443'],
          borderWidth: 1
        }]
      },
      options: {
        animation: {
          animateScale: true,
          duration: 4000, // Animasi lebih pelan (2 detik)
          easing: 'easeOutQuart'
        },
        plugins: {
          legend: { position: 'bottom' },
          title: {
            display: true,
            text: 'Produk Tersedikit Terjual',
            align: 'center',
            font: { size: 16, weight: 'bold' },
            color: '#0d6efd',
            padding: { top: 10, bottom: 10 }
          }
        },
        responsive: true,
        maintainAspectRatio: false,
        onClick: (evt, elements) => {
          if (elements.length > 0) {
            const index = elements[0].index;
            highlightRow('tableTersedikit', index);
          }
        }
      }
    });
  </script>
  <!-- END - Pie chart & tabel -->

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/feather.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/plugins/select2/js/select2.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalerts.min.js"></script>
    <script src="../assets/js/script.js"></script>
  </body>
</html>
