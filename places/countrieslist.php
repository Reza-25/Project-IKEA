<?php
require_once __DIR__ . '/../include/config.php'; // Import config.php
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <meta name="description" content="IKEA Store Locations Management" />
    <meta name="keywords" content="ikea, store, locations, management" />
    <meta name="author" content="IKEA Management System" />
    <meta name="robots" content="noindex, nofollow" />
    <title>IKEA - Store Locations</title>

    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg" />

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/animate.css" />
    <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <style>
      /* Styling untuk summary cards */
      .info-container {
        margin-bottom: 20px;
        padding-bottom: 10px;
      }
      .summary-card {
        border-radius: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        height: 100%;
      }
      .summary-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      }
      .summary-value {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 5px;
      }
      .summary-label {
        font-size: 14px;
        color: #666;
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
      .store-marker {
        position: relative;
        display: inline-block;
        width: 24px;
        height: 24px;
        background-color: #4CAF50;
        border-radius: 50% 50% 50% 0;
        transform: rotate(-45deg);
        box-shadow: 0 2px 5px rgba(0,0,0,0.3);
        cursor: pointer;
      }
      .store-marker::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 12px;
        height: 12px;
        background: white;
        border-radius: 50%;
        transform: translate(-50%, -50%) rotate(45deg);
      }
      .store-marker.highlight {
        width: 32px;
        height: 32px;
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
      .chart-hover-stores {
        font-size: 14px;
        color: #666;
      }
      
      /* Styling tambahan */
      .store-table-container {
        margin-top: 30px;
      }
      .page-title h4 {
        color: #0051BA;
        font-weight: 700;
      }
      .badges.bg-lightgreen {
        background-color: #d4edda !important;
        color: #155724;
      }
      .badges.bg-lightred {
        background-color: #f8d7da !important;
        color: #721c24;
      }
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
              <h4>Store Locations</h4>
              <h6>Manage your IKEA store locations</h6>
            </div>
          </div>
          
          <div class="info-container">
            <!-- Summary Cards -->
            <div class="row">
              <div class="col-md-3">
                <div class="card summary-card bg-light-primary">
                  <div class="card-body text-center p-3">
                    <div class="summary-value" id="total-stores">5</div>
                    <div class="summary-label">Total Stores</div>
                    <i class="fas fa-store fa-2x mt-3 text-success"></i>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card summary-card bg-light-success">
                  <div class="card-body text-center p-3">
                    <div class="summary-value" id="active-stores">4</div>
                    <div class="summary-label">Active Stores</div>
                    <i class="fas fa-check-circle fa-2x mt-3 text-success"></i>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card summary-card bg-light-warning">
                  <div class="card-body text-center p-3">
                    <div class="summary-value" id="inprogress-stores">1</div>
                    <div class="summary-label">In Progress</div>
                    <i class="fas fa-hard-hat fa-2x mt-3 text-warning"></i>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card summary-card bg-light-info">
                  <div class="card-body text-center p-3">
                    <div class="summary-value" id="total-area">143,000 m²</div>
                    <div class="summary-label">Total Area</div>
                    <i class="fas fa-vector-square fa-2x mt-3 text-info"></i>
                  </div>
                </div>
              </div>
            </div>

            <!-- Donut Chart Section -->
            <div class="chart-card">
              <h5 class="chart-title">Store Distribution by Province</h5>
              <div class="chart-container">
                <canvas id="provinceChart"></canvas>
                <div class="chart-hover-info" id="chartHoverInfo"></div>
              </div>
            </div>
          </div>
          <!-- Map Container -->
          <div class="card map-card">
              <div class="card-header">
                <h5 class="card-title">Store Locations Map</h5>
              </div>
              <div class="card-body">
                <div class="map-container">
                  <div id="store-map" style="height: 100%;"></div>
                </div>
              </div>
            </div>
          
          <div class="store-table-container">
            <div class="card">
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
                          <input type="text" placeholder="Enter Store Name" />
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                          <input type="text" placeholder="Enter Store ID" />
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                          <select class="select">
                            <option>All Status</option>
                            <option>Open</option>
                            <option>In Progress</option>
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
                        <th>Store ID</th>
                        <th>Store Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Telephone</th>
                        <th>Land Area</th>
                        <th>Establish</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr data-id="1" data-lat="-6.2241" data-lng="106.6583" data-province="Banten">
                        <td>1</td>
                        <td>STR001</td>
                        <td>IKEA Alam Sutera</td>
                        <td>Jl. Jalur Sutera Boulevard No.45, Alam Sutera</td>
                        <td>Tangerang (Banten)</td>
                        <td>(021) 12345678</td>
                        <td>35.000 m²</td>
                        <td>2014</td>
                        <td><span class="badges bg-lightgreen">Open</span></td>
                      </tr>
                      <tr data-id="2" data-lat="-6.5622" data-lng="106.8460" data-province="Jawa Barat">
                        <td>2</td>
                        <td>STR002</td>
                        <td>IKEA Sentul City</td>
                        <td>Jl. MH Thamrin, Sentul City</td>
                        <td>Bogor (Jawa Barat)</td>
                        <td>(021) 12345678</td>
                        <td>36.000 m²</td>
                        <td>2021</td>
                        <td><span class="badges bg-lightgreen">Open</span></td>
                      </tr>
                      <tr data-id="3" data-lat="-6.8512" data-lng="107.5328" data-province="Jawa Barat">
                        <td>3</td>
                        <td>STR003</td>
                        <td>IKEA Kota Baru Parahyangan</td>
                        <td>Jl. Parahyangan KM 3</td>
                        <td>Bandung Barat (Jawa Barat)</td>
                        <td>(022) 34567890</td>
                        <td>33.000 m²</td>
                        <td>2021</td>
                        <td><span class="badges bg-lightgreen">Open</span></td>
                      </tr>
                      <tr data-id="4" data-lat="-6.1775" data-lng="106.9423" data-province="DKI Jakarta">
                        <td>4</td>
                        <td>STR004</td>
                        <td>IKEA Jakarta Garden City</td>
                        <td>JGC, Cakung</td>
                        <td>Jakarta Timur (Jakarta)</td>
                        <td>(021) 45678901</td>
                        <td>39.000 m²</td>
                        <td>2021</td>
                        <td><span class="badges bg-lightgreen">Open</span></td>
                      </tr>
                      <tr data-id="5" data-lat="-8.7075" data-lng="115.1720" data-province="Bali">
                        <td>5</td>
                        <td>STR005</td>
                        <td>IKEA Bali</td>
                        <td>Sunset Road, Kuta</td>
                        <td>Badung (Bali)</td>
                        <td>-</td>
                        <td>-</td>
                        <td>2025</td>
                        <td><span class="badges bg-lightred">InProgress</span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
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
    <script src="../assets/plugins/select2/js/select2.min.js"></script>
    <script src="../assets/js/moment.min.js"></script>
    <script src="../assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalerts.min.js"></script>
    <script src="../assets/js/script.js"></script>
    
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
      $(document).ready(function() {
        // Data toko per provinsi
        const provinceData = {
          'Banten': { count: 1, color: '#3498db' },
          'Jawa Barat': { count: 2, color: '#2ecc71' },
          'DKI Jakarta': { count: 1, color: '#f1c40f' },
          'Bali': { count: 1, color: '#e74c3c' }
        };
        
        // Inisialisasi chart
        const ctx = document.getElementById('provinceChart').getContext('2d');
        const provinceChart = new Chart(ctx, {
          type: 'doughnut',
          data: {
            labels: Object.keys(provinceData),
            datasets: [{
              data: Object.values(provinceData).map(p => p.count),
              backgroundColor: Object.values(provinceData).map(p => p.color),
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
                    return `${label}: ${value} store${value > 1 ? 's' : ''}`;
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
        const chartCanvas = $('#provinceChart');
        
        chartCanvas.on('mousemove', function(e) {
          const points = provinceChart.getElementsAtEventForMode(e, 'nearest', { intersect: true }, true);
          
          if (points.length) {
            const index = points[0].index;
            const province = provinceChart.data.labels[index];
            const count = provinceChart.data.datasets[0].data[index];
            
            chartHoverInfo.html(`
              <div class="chart-hover-title">${province}</div>
              <div class="chart-hover-stores">${count} Store${count > 1 ? 's' : ''}</div>
            `);
            
            chartHoverInfo.css({
              left: e.pageX + 15,
              top: e.pageY + 15,
              opacity: 1
            });
            
            // Highlight toko di tabel dan peta
            $(`tr[data-province="${province}"]`).addClass('highlight-row');
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
        const map = L.map('store-map').setView([-6.1754, 106.8272], 5);
        
        // Tambahkan tile layer (peta dasar)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        // Simpan semua marker dalam array
        const markers = [];
        const storeData = {};
        
        // Buat marker untuk setiap toko
        $('table.datanew tbody tr').each(function() {
          const id = $(this).data('id');
          const lat = $(this).data('lat');
          const lng = $(this).data('lng');
          const province = $(this).data('province');
          const storeName = $(this).find('td:eq(2)').text();
          const address = $(this).find('td:eq(3)').text();
          const status = $(this).find('td:eq(8)').text().includes('Open') ? 'open' : 'progress';
          
          // Simpan data toko
          storeData[id] = {
            element: this,
            name: storeName,
            address: address,
            status: status,
            province: province
          };
          
          // Buat marker custom
          const marker = L.marker([lat, lng], {
            icon: L.divIcon({
              className: 'custom-marker',
              html: `<div class="store-marker" data-id="${id}" style="background-color: ${provinceData[province].color};"></div>`,
              iconSize: [24, 24],
              iconAnchor: [12, 24]
            })
          }).addTo(map);
          
          // Tambahkan popup
          marker.bindPopup(`
            <div class="p-2">
              <h6>${storeName}</h6>
              <p class="mb-1">${address}</p>
              <div class="d-flex justify-content-between">
                <span class="badge ${status === 'open' ? 'bg-lightgreen' : 'bg-lightred'}">
                  ${status === 'open' ? 'Open' : 'In Progress'}
                </span>
                <span class="badge" style="background: ${provinceData[province].color}">${province}</span>
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
            $(this.getElement()).find('.store-marker').addClass('highlight');
            const id = $(this.getElement()).find('.store-marker').data('id');
            $(storeData[id].element).addClass('highlight-row');
          });
          
          marker.on('mouseout', function() {
            $(this.getElement()).find('.store-marker').removeClass('highlight');
            const id = $(this.getElement()).find('.store-marker').data('id');
            $(storeData[id].element).removeClass('highlight-row');
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
                $(m.marker.getElement()).find('.store-marker').addClass('highlight');
                map.setView(m.marker.getLatLng(), 13);
              }
            });
          },
          function() {
            const id = $(this).data('id');
            $(this).removeClass('highlight-row');
            
            // Unhighlight marker
            markers.forEach(m => {
              if (m.id === id) {
                $(m.marker.getElement()).find('.store-marker').removeClass('highlight');
              }
            });
          }
        );
        
        // Hitung luas total
        let totalArea = 0;
        $('table.datanew tbody tr').each(function() {
          const areaText = $(this).find('td:eq(6)').text();
          if (areaText !== '-') {
            const areaValue = parseFloat(areaText.replace('.', '').replace(' m²', ''));
            totalArea += areaValue;
          }
        });
        
        // Format angka dengan separator
        $('#total-area').text(totalArea.toLocaleString('id-ID') + ' m²');
      });
    </script>
  </body>
</html>