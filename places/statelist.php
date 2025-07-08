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
    <title>IKEA - Inventory Locations</title>

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
      .map-container {
        border-radius: 8px;
        overflow: hidden;
        height: 300px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        margin-bottom: 20px;
      }
      .map-container:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      }
      .warehouse-marker {
        position: relative;
        display: inline-block;
        width: 30px;
        height: 30px;
        background-color: #4CAF50;
        border-radius: 50% 50% 50% 0;
        transform: rotate(-45deg);
        box-shadow: 0 2px 5px rgba(0,0,0,0.3);
        cursor: pointer;
      }
      .warehouse-marker::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 14px;
        height: 14px;
        background: white;
        border-radius: 50%;
        transform: translate(-50%, -50%) rotate(45deg);
      }
      .warehouse-marker.highlight {
        width: 40px;
        height: 40px;
        z-index: 10;
        background-color: #FF5722;
      }
      .highlight-row {
        background-color: #f0f9ff !important;
        transform: scale(1.01);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        z-index: 1;
        position: relative;
      }
      .map-card {
        margin-bottom: 20px;
      }
      
      /* Styling untuk chart */
      .chart-container {
        position: relative;
        height: 300px;
        margin: 20px 0;
      }
      .chart-card {
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        padding: 20px;
        background: white;
        transition: all 0.3s ease;
      }
      .chart-card:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      }
      .chart-title {
        text-align: center;
        margin-bottom: 15px;
        font-weight: 600;
        color: #333;
      }
      .chart-hover-info {
        position: absolute;
        background: white;
        border-radius: 8px;
        padding: 10px 15px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.15);
        z-index: 100;
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.3s;
      }
      .chart-hover-title {
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
      }
      .chart-hover-warehouses {
        font-size: 14px;
        color: #666;
      }
      
      /* Animasi untuk kartu */
      @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
      }
      .animated-card {
        animation: fadeIn 0.6s ease-out forwards;
      }
      .card:nth-child(1) { animation-delay: 0.1s; }
      .card:nth-child(2) { animation-delay: 0.2s; }
      .card:nth-child(3) { animation-delay: 0.3s; }
      .card:nth-child(4) { animation-delay: 0.4s; }
    </style>
  </head>
  <body>
    <div id="global-loader">
      <div class="whirly-loader"></div>
    </div>

    <div class="main-wrapper">
      <?php include BASE_PATH . '../include/sidebar.php'; ?>
      <?php include __DIR__ . '/../include/header.php'; ?>
      
      <div class="page-wrapper">
        <div class="content">
          <div class="page-header">
            <div class="page-title">
              <h4>Inventory Locations</h4>
              <h6>Manage your warehouse locations</h6>
            </div>
          </div>

           <!-- Total Expenses, Top Category, Top Expense, Avg Daily Expense -->
          <div class="row justify-content-end">
            <!-- Total Product Sold -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="revenue/revenue.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das1">
                  <div class="dash-counts">
                     <h4><span class="counters" data-count="17"></span></h4>
                    <h5>Total Warehouses</h5>
                    <h2 class="stat-change">Doing Amazing!</h2>
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
                      <h4>78%</span></h4>
                    <h5>Utilization Rate</h5>
                  <h2 class="stat-change"> Almost High usage!</h2>
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
                    <h4>4.2x/month</h4>
                    <h5>Inventory Turnover</h5>
                    <h2 class="stat-change">+18% over averange</h2>
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
                   <h4><span class="counters" data-count="111.500">111,500</span>m</h4>
                    <h5>Total Land Area</h5>
                    <h2 class="stat-change">Keep it up!</h2>
                    </div>
                    <div class="icon-box bg-hijau">
                      <i class="fa fa-chart-line"></i>
                    </div>
                </div>
              </a>
            </div>
          </div>
          <!-- END KOLOM  -->

          <!-- Donut Chart Section -->
          <div class="chart-card animated-card">
            <h5 class="chart-title">Warehouse Distribution by Type</h5>
            <div class="chart-container">
              <canvas id="warehouseTypeChart"></canvas>
              <div class="chart-hover-info" id="chartHoverInfo"></div>
            </div>
          </div>

          <!-- Map Container -->
          <div class="card map-card animated-card">
            <div class="card-header">
              <h5 class="card-title">Warehouse Locations Map</h5>
            </div>
            <div class="card-body">
              <div class="map-container">
                <div id="warehouse-map" style="height: 100%;"></div>
              </div>
            </div>
          </div>

          <div class="card animated-card">
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
                    <a class="btn btn-searchset"><img src="../assets/img/icons/search-white.svg" alt="img" /></a>
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
                    <div class="col-lg-3 col-sm-6 col-12">
                      <div class="form-group">
                        <input type="text" placeholder="Enter Name" />
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                      <div class="form-group">
                        <input type="text" placeholder="Enter Reference No" />
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                      <div class="form-group">
                        <select class="select">
                          <option>Completed</option>
                          <option>Paid</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
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
                      <th>NO</th>
                      <th>WareHouse ID</th>
                      <th>WareHouse Name</th>
                      <th>Address</th>
                      <th>City</th>
                      <th>WareHouse Type</th>
                      <th>Capacity</th>
                      <th>Land Area</th>
                      <th>Operational Year</th>
                      <th>Status</th>
                      <th>Telephone</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr data-id="1" data-lat="-6.2241" data-lng="106.6583" data-type="Distribution & Storage">
                      <td>1</td>
                      <td>STR001</td>
                      <td>Gudang Utama IKEA Alam Sutera</td>
                      <td>Kawasan Industri XYZ Blok A-5, Alam Sutera</td>
                      <td>Tangerang (Banten)</td>
                      <td>Distribution & Storage</td>
                      <td>80.000 unit</td>
                      <td>25.000 m²</td>
                      <td>2014</td>
                      <td><span class="badges bg-lightgreen">Active</span></td>
                      <td>(021) 12345678</td>
                    </tr>
                    <tr data-id="2" data-lat="-6.5622" data-lng="106.8460" data-type="Fullfilment Center">
                      <td>2</td>
                      <td>STR002</td>
                      <td>Gudang IKEA Sentul Logistics</td>
                      <td>Kawasan Industri Sentul, Bogor</td>
                      <td>Bogor (Jawa Barat)</td>
                      <td>Fullfilment Center</td>
                      <td>80.000 unit</td>
                      <td>20.000 m²</td>
                      <td>2020</td>
                      <td><span class="badges bg-lightgreen">Active</span></td>
                      <td>(021) 12345678</td>
                    </tr>
                    <tr data-id="3" data-lat="-6.1775" data-lng="106.9423" data-type="Transit & Sorting">
                      <td>3</td>
                      <td>STR003</td>
                      <td>Gudang Transit IKEA Cakung</td>
                      <td>Kawasan Industri Cakung, Jakarta Timur</td>
                      <td>Jakarta Timur (Jakarta)</td>
                      <td>Transit & Sorting</td>
                      <td>60.000 unit</td>
                      <td>15.000 m²</td>
                      <td>2021</td>
                      <td><span class="badges bg-lightgreen">Active</span></td>
                      <td>(022) 34567890</td>
                    </tr>
                    <tr data-id="4" data-lat="-8.6500" data-lng="115.2167" data-type="Regional Distribution">
                      <td>4</td>
                      <td>STR004</td>
                      <td>Gudang Regional IKEA Bali</td>
                      <td> Jl. Cargo Timur No.88, Denpasar</td>
                      <td>Denpasar (Bali)</td>
                      <td>Regional Distribution</td>
                      <td>40.000 unit</td>
                      <td>10.000 m²</td>
                      <td>2021</td>
                      <td><span class="badges bg-lightgreen">Active</span></td>
                      <td>(021) 45678901</td>
                    </tr>
                    <tr data-id="5" data-lat="-7.2892" data-lng="112.7344" data-type="Fullfilment Center">
                      <td>5</td>
                      <td>STR005</td>
                      <td>Gudang IKEA Surabaya Hub</td>
                      <td>Jl. Rungkut Industri, Surabaya</td>
                      <td>Surabaya (Jawa Timur)</td>
                      <td>Fullfilment Center</td>
                      <td>75.000 unit</td>
                      <td>18.000 m²</td>
                      <td>2025</td>
                      <td><span class="badges bg-lightred">In Progress</span></td>
                      <td>(021) 45678901</td>
                    </tr>
                    <tr data-id="6" data-lat="3.5952" data-lng="98.6722" data-type="Distribution & Storage">
                      <td>6</td>
                      <td>STR006</td>
                      <td>Gudang Pendukung IKEA Medan</td>
                      <td>Jl. KIM I, Kawasan Industri Medan</td>
                      <td>Medan (Sumatera Utara)</td>
                      <td>Distribution & Storage</td>
                      <td>50.000 unit</td>
                      <td>12.000 m²</td>
                      <td>2023</td>
                      <td><span class="badges bg-lightred">In Progress</span></td>
                      <td>(021) 45678901</td>
                    </tr>
                    <tr data-id="7" data-lat="-5.1477" data-lng="119.4327" data-type="Transit & Sorting">
                      <td>7</td>
                      <td>STR007</td>
                      <td>Gudang IKEA Makassar</td>
                      <td>Jl. Poros Makassar-Maros KM 15</td>
                      <td>Makassar (Sulawesi Selatan)</td>
                      <td>Transit & Sorting</td>
                      <td>45.000 unit</td>
                      <td>11.500 m²</td>
                      <td>2024</td>
                      <td><span class="badges bg-lightred">In Progress</span></td>
                      <td>(021) 45678901</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ... (modal dan script lainnya tetap sama) ... -->

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
    
    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
      $(document).ready(function() {
        // Data warehouse per tipe
        const warehouseTypeData = {
          'Distribution & Storage': { count: 2, color: '#3498db' },
          'Fullfilment Center': { count: 2, color: '#2ecc71' },
          'Transit & Sorting': { count: 2, color: '#f1c40f' },
          'Regional Distribution': { count: 1, color: '#e74c3c' }
        };
        
        // Inisialisasi chart
        const ctx = document.getElementById('warehouseTypeChart').getContext('2d');
        const warehouseTypeChart = new Chart(ctx, {
          type: 'doughnut',
          data: {
            labels: Object.keys(warehouseTypeData),
            datasets: [{
              data: Object.values(warehouseTypeData).map(p => p.count),
              backgroundColor: Object.values(warehouseTypeData).map(p => p.color),
              borderWidth: 0,
              hoverOffset: 15
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
              legend: {
                position: 'bottom',
                labels: {
                  font: {
                    size: 12
                  },
                  padding: 20,
                  generateLabels: function(chart) {
                    const data = chart.data;
                    if (data.labels.length && data.datasets.length) {
                      return data.labels.map((label, i) => {
                        const meta = chart.getDatasetMeta(0);
                        const style = meta.controller.getStyle(i);
                        
                        return {
                          text: `${label} (${data.datasets[0].data[i]})`,
                          fillStyle: style.backgroundColor,
                          strokeStyle: style.borderColor,
                          lineWidth: style.borderWidth,
                          hidden: false,
                          index: i
                        };
                      });
                    }
                    return [];
                  }
                }
              },
              tooltip: {
                callbacks: {
                  label: function(context) {
                    const label = context.label || '';
                    const value = context.raw || 0;
                    return `${label}: ${value} warehouse${value > 1 ? 's' : ''}`;
                  }
                }
              }
            },
            animation: {
              animateRotate: true,
              animateScale: true
            }
          }
        });
        
        // Interaksi hover pada chart
        const chartHoverInfo = $('#chartHoverInfo');
        const chartCanvas = $('#warehouseTypeChart');
        
        chartCanvas.on('mousemove', function(e) {
          const points = warehouseTypeChart.getElementsAtEventForMode(e, 'nearest', { intersect: true }, true);
          
          if (points.length) {
            const index = points[0].index;
            const type = warehouseTypeChart.data.labels[index];
            const count = warehouseTypeChart.data.datasets[0].data[index];
            
            chartHoverInfo.html(`
              <div class="chart-hover-title">${type}</div>
              <div class="chart-hover-warehouses">${count} Warehouse${count > 1 ? 's' : ''}</div>
            `);
            
            chartHoverInfo.css({
              left: e.pageX + 15,
              top: e.pageY + 15,
              opacity: 1
            });
            
            // Highlight warehouse di tabel dan peta
            $(`tr[data-type="${type}"]`).addClass('highlight-row');
          } else {
            chartHoverInfo.css('opacity', 0);
            $('tr.highlight-row').removeClass('highlight-row');
          }
        });
        
        chartCanvas.on('mouseleave', function() {
          chartHoverInfo.css('opacity', 0);
          $('tr.highlight-row').removeClass('highlight-row');
        });
        
        // Inisialisasi peta
        const map = L.map('warehouse-map').setView([-2.5489, 118.0149], 5);
        
        // Tambahkan tile layer (peta dasar)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        // Simpan semua marker dalam array
        const markers = [];
        const warehouseData = {};
        
        // Buat marker untuk setiap warehouse
        $('table.datanew tbody tr').each(function() {
          const id = $(this).data('id');
          const lat = $(this).data('lat');
          const lng = $(this).data('lng');
          const type = $(this).data('type');
          const warehouseName = $(this).find('td:eq(2)').text();
          const address = $(this).find('td:eq(3)').text();
          const status = $(this).find('td:eq(9)').text().includes('Active') ? 'active' : 'progress';
          
          // Simpan data warehouse
          warehouseData[id] = {
            element: this,
            name: warehouseName,
            address: address,
            status: status,
            type: type
          };
          
          // Buat marker custom
          const marker = L.marker([lat, lng], {
            icon: L.divIcon({
              className: 'custom-marker',
              html: `<div class="warehouse-marker" data-id="${id}" style="background-color: ${warehouseTypeData[type].color};"></div>`,
              iconSize: [30, 30],
              iconAnchor: [15, 30]
            })
          }).addTo(map);
          
          // Tambahkan popup
          marker.bindPopup(`
            <div class="p-2">
              <h6>${warehouseName}</h6>
              <p class="mb-1">${address}</p>
              <div class="d-flex justify-content-between">
                <span class="badge ${status === 'active' ? 'bg-lightgreen' : 'bg-lightred'}">
                  ${status === 'active' ? 'Active' : 'In Progress'}
                </span>
                <span class="badge" style="background: ${warehouseTypeData[type].color}">${type}</span>
              </div>
            </div>
          `);
          
          // Simpan marker
          markers.push({
            id: id,
            marker: marker,
            element: this
          });
          
          // Event untuk marker
          marker.on('mouseover', function() {
            $(this.getElement()).find('.warehouse-marker').addClass('highlight');
            const id = $(this.getElement()).find('.warehouse-marker').data('id');
            $(warehouseData[id].element).addClass('highlight-row');
            map.setView(marker.getLatLng(), 8);
          });
          
          marker.on('mouseout', function() {
            $(this.getElement()).find('.warehouse-marker').removeClass('highlight');
            const id = $(this.getElement()).find('.warehouse-marker').data('id');
            $(warehouseData[id].element).removeClass('highlight-row');
          });
          
          marker.on('click', function() {
            map.setView([lat, lng], 13);
          });
        });
        
        // Event untuk baris tabel
        $('table.datanew tbody tr').hover(
          function() {
            const id = $(this).data('id');
            $(this).addClass('highlight-row');
            
            // Highlight marker yang sesuai
            markers.forEach(m => {
              if (m.id === id) {
                $(m.marker.getElement()).find('.warehouse-marker').addClass('highlight');
                map.setView(m.marker.getLatLng(), 8);
              }
            });
          },
          function() {
            const id = $(this).data('id');
            $(this).removeClass('highlight-row');
            
            // Unhighlight marker
            markers.forEach(m => {
              if (m.id === id) {
                $(m.marker.getElement()).find('.warehouse-marker').removeClass('highlight');
              }
            });
          }
        );
        
        // Hitung luas total
        let totalArea = 0;
        let totalCapacity = 0;
        let activeWarehouses = 0;
        
        $('table.datanew tbody tr').each(function() {
          const areaText = $(this).find('td:eq(7)').text();
          const capacityText = $(this).find('td:eq(6)').text();
          const status = $(this).find('td:eq(9)').text();
          
          if (areaText !== '-') {
            const areaValue = parseFloat(areaText.replace('.', '').replace(' m²', ''));
            totalArea += areaValue;
          }
          
          if (capacityText !== '-') {
            const capacityValue = parseFloat(capacityText.replace('.', '').replace(' unit', ''));
            totalCapacity += capacityValue;
          }
          
          if (status.includes('Active')) {
            activeWarehouses++;
          }
        });
        
        // Format angka dengan separator
        $('#total-area').text(totalArea.toLocaleString('id-ID') + ' m²');
        $('#total-capacity').text(totalCapacity.toLocaleString('id-ID') + ' unit');
        $('#active-warehouses').text(activeWarehouses);
      });
    </script>
  </body>
</html>