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
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

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
  border-left: 6px solid #1a5ea7;
}
.das1 * {
  color: #1a5ea7 !important;
}

/* Kolom 2 - Ungu */
.das2 {
  border-left: 6px solid #751e8d;
}
.das2 * {
  color: #751e8d !important;
}

/* Kolom 3 - Kuning/Oranye */
.das3 {
  border-left: 6px solid #e78001;
}
.das3 * {
  color: #e78001 !important;
}

/* Kolom 4 - Tosca */
.das4 {
  border-left: 6px solid #018679;
}
.das4 * {
  color: #018679 !important;
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

    <div class="card">
            <div class="card-body">
              <div class="table-top">
                <div class="wordset">
                  <ul>
                    <li>
                      <a data-bs-placement="top" data-bs-toggle="tooltip" title="pdf"><img alt="img" src="../assets/img/icons/pdf.svg" /></a>
                    </li>
                    <li>
                      <a data-bs-placement="top" data-bs-toggle="tooltip" title="excel"><img alt="img" src="../assets/img/icons/excel.svg" /></a>
                    </li>
                    <li>
                      <a data-bs-placement="top" data-bs-toggle="tooltip" title="print"><img alt="img" src="../assets/img/icons/printer.svg" /></a>
                    </li>
                  </ul>
                </div>
              </div>
    <!-- BAGIAN ATAS END-->

<!-- Revenue, Suppliers, Product Sold, Budget Spent -->
<div class="row justify-content-end">
  <!-- Revenue -->
  <div class="col-lg-3 col-sm-6 col-12 d-flex">
    <a href="revenue/revenue.php" class="w-100 text-decoration-none text-dark">
      <div class="dash-count das1">
        <div class="dash-counts">
          <h4>$<span class="counters" data-count="385656.50">385,656.50</span></h4>
          <h5>Revenue</h5>
          <h2 class="stat-change">+9% from last year</h2>
        </div>
        <div class="dash-imgs">
          <i data-feather="trending-up"></i>
        </div>
      </div>
    </a>
  </div>

  <!-- Suppliers -->
  <div class="col-lg-3 col-sm-6 col-12 d-flex">
    <a href="people/supplierlist.php" class="w-100 text-decoration-none text-dark">
      <div class="dash-count das2">
        <div class="dash-counts">
          <h4><span class="counters" data-count="1975">1,975</span></h4>
          <h5>Suppliers</h5>
          <h2 class="stat-change">+2% from last year</h2>
        </div>
        <div class="dash-imgs">
          <i data-feather="user-check"></i>
        </div>
      </div>
    </a>
  </div>

  <!-- Product Sold -->
  <div class="col-lg-3 col-sm-6 col-12 d-flex">
    <a href="product/productsold.php" class="w-100 text-decoration-none text-dark">
      <div class="dash-count das3">
        <div class="dash-counts">
          <h4><span class="counters" data-count="7863">7,863</span></h4>
          <h5>Product Sold</h5>
          <h2 class="stat-change">+15% from last year</h2>
        </div>
        <div class="dash-imgs">
          <i data-feather="package"></i>
        </div>
      </div>
    </a>
  </div>

  <!-- Budget Spent -->
  <div class="col-lg-3 col-sm-6 col-12 d-flex">
    <a href="expense/expensecategory.php" class="w-100 text-decoration-none text-dark">
      <div class="dash-count das4">
        <div class="dash-counts">
          <h4>$<span class="counters" data-count="185556.30">185,556.30</span></h4>
          <h5>Budget Spent</h5>
          <h2 class="stat-change">+6% from last year</h2>
        </div>
        <div class="dash-imgs">
          <i data-feather="activity"></i>
        </div>
      </div>
    </a>
  </div>
</div>
<!-- END KOLOM -->

 <div class="container mt-5">
    <div class="row">
      <!-- Chart Section -->
      <div class="col-md-8">
        <div class="card shadow-sm">
          <div class="card-header ikea-header text-white d-flex justify-content-between align-items-center">
            <div>
              <h5 class="mb-0">Grafik Produk Terjual Terbanyak</h5>
              <small>Bulan-Tahun</small>
            </div>
            <div class="d-flex gap-2">
              <!-- Dropdown Bulan -->
              <select id="bulanSelect" class="ikea-select">
                <option value="0">Jan</option>
                <option value="1">Feb</option>
                <option value="2">Mar</option>
                <option value="3">Apr</option>
                <option value="4">Mei</option>
                <option value="5">Jun</option>
              </select>

              <!-- Dropdown Tahun -->
             <select id="tahunSelect" class="ikea-select">
              <option value="2022">2022</option>
              <option value="2023">2023</option>
              <option value="2024">2024</option>
            </select>
            </div>
          </div>
          <div class="card-body">
            <div id="mainChart"></div>
          </div>
        </div>
      </div>

      <!-- Notes Section -->
<div class="col-md-4">
  <div class="card shadow-sm border-0" style="background-color: #fffbea; border-radius: 12px;">
    <div class="card-header" style="background-color: #FFCC00; color: #000; font-weight: bold; border-radius: 12px 12px 0 0;">
      Catatan
    </div>
    <div class="card-body" style="max-height: 400px; overflow-y: auto;">
      <div id="notesList">
        <!-- Catatan default saat awal bisa dimasukkan jika ingin -->
        <div class="note-card mb-3 p-3" style="background: #fff; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
          <div class="fs-4 mb-1">✅</div>
          <strong>Catatan</strong>
          <p>Hanya kategori terbanyak ditampilkan</p>
        </div>
        <div class="note-card mb-3 p-3" style="background: #fff; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
          <div class="fs-4 mb-1">📊</div>
          <strong>Catatan</strong>
          <p>Pilih bulan/tahun untuk melihat data</p>
        </div>
        <div class="note-card mb-3 p-3" style="background: #fff; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
          <div class="fs-4 mb-1">🎯</div>
          <strong>Catatan</strong>
          <p>Fokus pada visualisasi yang informatif</p>
        </div>
      </div>
    </div>
  </div>
</div>

      </div>


  <!-- Script -->
  <script>
    const dataBulananTahun = {
      "2022": [
        { name: "Jan", data: [120, 80, 0, 0, 0] },
        { name: "Feb", data: [200, 0, 40, 0, 0] },
        { name: "Mar", data: [220, 100, 20, 80, 0] },
        { name: "Apr", data: [150, 0, 0, 60, 70] },
        { name: "Mei", data: [180, 0, 0, 0, 30] },
        { name: "Jun", data: [250, 100, 10, 70, 5] }
      ],
      "2023": [
        { name: "Jan", data: [180, 100, 0, 0, 0] },
        { name: "Feb", data: [260, 0, 60, 0, 0] },
        { name: "Mar", data: [300, 120, 40, 90, 0] },
        { name: "Apr", data: [180, 0, 0, 80, 90] },
        { name: "Mei", data: [240, 0, 0, 0, 40] },
        { name: "Jun", data: [400, 110, 15, 80, 8] }
      ],
      "2024": [
        { name: "Jan", data: [300, 120, 0, 0, 0] },
        { name: "Feb", data: [400, 0, 90, 0, 0] },
        { name: "Mar", data: [450, 150, 60, 100, 0] },
        { name: "Apr", data: [200, 0, 0, 90, 100] },
        { name: "Mei", data: [320, 0, 0, 0, 50] },
        { name: "Jun", data: [500, 130, 20, 90, 10] }
      ]
    };

    const categories = ["Furniture", "Lighting", "Textile", "Storage", "Kitchen"];
    const months = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"];
    let mainChart;

    function updateNotes(type, title, total, jumlahKategori, rataRata) {
  const notesList = document.getElementById("notesList");
  notesList.innerHTML = `
    <div class="note-card mb-3 p-3" style="background: #fff; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
      <div class="fs-4 mb-1">📅</div>
      <strong>Mode Tampilan</strong>
      <p>${type === 'bulan' ? 'Bulanan' : 'Tahunan'} - ${title}</p>
    </div>
    <div class="note-card mb-3 p-3" style="background: #fff; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
      <div class="fs-4 mb-1">🧾</div>
      <strong>Total Penjualan</strong>
      <p><strong>${total}</strong> unit</p>
    </div>
    <div class="note-card mb-3 p-3" style="background: #fff; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
      <div class="fs-4 mb-1">📦</div>
      <strong>Jumlah Kategori</strong>
      <p><strong>${jumlahKategori}</strong> kategori ditampilkan</p>
    </div>
    <div class="note-card mb-3 p-3" style="background: #fff; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
      <div class="fs-4 mb-1">📈</div>
      <strong>Rata-rata Penjualan</strong>
      <p><strong>${rataRata.toFixed(1)}</strong> unit per kategori</p>
    </div>
  `;
}


    function renderMainChart(type = "bulan", index = 0, tahun = "2024") {
      const isBulan = type === "bulan";
      const series = dataBulananTahun[tahun];
      const rawData = isBulan
        ? series[index].data
        : categories.map((_, i) => series.reduce((sum, s) => sum + s.data[i], 0));

      const sortedIndexes = rawData.map((v, i) => [v, i])
        .filter(([v]) => v > 0)
        .sort((a, b) => b[0] - a[0])
        .slice(0, 6);

      const sortedCategories = sortedIndexes.map(i => categories[i[1]]);
      const sortedData = sortedIndexes.map(i => i[0]);
      const total = rawData.reduce((sum, val) => sum + val, 0);
      const rataRata = sortedData.length ? (total / sortedData.length) : 0;

      const titleText = isBulan
        ? `Penjualan Produk Bulan ${months[index]} ${tahun}`
        : `Penjualan Produk Tahun ${tahun}`;

      const options = {
        chart: {
          type: 'bar',
          height: 340,
          animations: { easing: 'easeinout', speed: 500 }
        },
        plotOptions: {
          bar: {
            horizontal: true,
            borderRadius: 4,
            barHeight: '55%'
          }
        },
        dataLabels: {
          enabled: true,
          style: { fontSize: '12px' }
        },
        series: [{
          name: isBulan ? months[index] : "Total per Tahun",
          data: sortedData
        }],
        xaxis: {
          categories: sortedCategories,
          title: { text: "Jumlah Terjual" }
        },
        colors: ['#003366'],
        title: {
          text: titleText,
          align: 'left',
          style: { fontSize: '16px', fontWeight: 'bold' }
        },
        tooltip: { theme: 'light' }
      };

      if (mainChart) {
        mainChart.updateOptions(options);
      } else {
        mainChart = new ApexCharts(document.querySelector("#mainChart"), options);
        mainChart.render();
      }

      updateNotes(type, isBulan ? `${months[index]} ${tahun}` : `${tahun}`, total, sortedData.length, rataRata);
    }

    const bulanSelect = document.getElementById("bulanSelect");
    const tahunSelect = document.getElementById("tahunSelect");

    renderMainChart("bulan", 0, tahunSelect.value);

    bulanSelect.addEventListener("change", function () {
      renderMainChart("bulan", parseInt(this.value), tahunSelect.value);
    });

    tahunSelect.addEventListener("change", function () {
      bulanSelect.value = "0";
      renderMainChart("tahun", 0, this.value);
    });
  </script>

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
