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
      /* Chart Container Styling */
      .chart-container {
        position: relative;
        height: 350px;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        padding: 20px;
        transition: all 0.3s ease;
        margin-bottom: 30px;
        margin-top: 30px;
        align-items: center;
      }

      .chart-container canvas {
        width: 100%;
        height: auto;
        max-width: 380px;
        max-height: 280px;
      }
      
      .chart-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
      }
      
      .chart-title {
        font-size: 1.0rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
        text-align: center;
      }
      
      /* Map Container Styling */
      .map-container-wrapper {
        position: relative;
        height: 350px;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        margin-top: 30px;
        overflow: hidden;
      }
      
      .map-container-wrapper:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
      }
      
      .map-header {
        padding: 20px 20px 10px 20px;
        background: #fff;
        border-bottom: 1px solid #e9ecef;
      }
      
      .map-header h5 {
        font-size: 1.2rem;
        font-weight: 600;
        margin: 0;
        color: #333;
      }
      
      .map-container {
        height: 280px;
        width: 100%;
      }
      
      /* Store Marker Styling */
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
      
      /* Chart Hover Info */
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
      
      /* Table Styling */
      .highlight-row {
        background-color: #f0f9ff !important;
        transform: scale(1.01);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        z-index: 1;
        position: relative;
      }
      
      .store-table-container {
        margin-top: 30px;
      }
      .page-title h4 {
        color: #0051BA;
        font-weight: 700;
      }
      .page-title h6 {
        color: #666;
        font-size: 14px;
      }
      .badges.bg-lightgreen {
        background-color: #d4edda !important;
        color: #155724;
      }
      .badges.bg-lightred {
        background-color: #f8d7da !important;
        color: #721c24;
      }
      
      /* Gaya header tabel baru */
      .card-header.gradient-bg {
        background: linear-gradient(135deg, #5dade2 0%, #1a5ea7 100%);
        color: white;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
      }
      
      .table th {
        background-color: #0047AB !important;
        color: white !important;
      }
      
      .table-responsive table tbody tr:hover {
        background-color: #f5faff;
        transition: 0.3s ease;
        cursor: pointer;
      }
      
      /* Responsive Design */
      @media (max-width: 991px) {
        .chart-container {
          margin-bottom: 20px;
        }
        .map-container-wrapper {
          margin-bottom: 20px;
        }
      }

      /* Style untuk modal */
      .modal-content {
        transition: all 0.3s ease-in-out;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
        border-radius: 12px;
        overflow: hidden;
      }
      
      .modal-header {
        background: linear-gradient(135deg, #ff9f43 0%, #ff7b00 100%);
        color: white;
        border-top-left-radius: 12px !important;
        border-top-right-radius: 12px !important;
        padding: 15px 20px;
      }
      
      .modal-title {
        font-weight: 600;
        font-size: 1.2rem;
      }
      
      .modal-body {
        padding: 20px;
      }
      
      .detail-container {
        display: flex;
        gap: 20px;
      }
      
      .store-details {
        flex: 1;
        min-width: 300px;
      }
      
      .map-preview {
        flex: 1;
        min-width: 300px;
        height: 300px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      }
      
      .detail-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #e9ecef;
      }
      
      .detail-label {
        font-weight: 600;
        color: #495057;
        flex: 0 0 40%;
      }
      
      .detail-value {
        flex: 0 0 60%;
        color: #212529;
        text-align: right;
      }
      
      .status-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
      }
      
      .status-active {
        background-color: #d4edda;
        color: #155724;
      }
      
      .status-inprogress {
        background-color: #f8d7da;
        color: #721c24;
      }
      
      .store-name {
        font-size: 1.3rem;
        font-weight: 700;
        color: #0051BA;
        margin-bottom: 5px;
      }
      
      .store-id {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 15px;
        display: block;
      }
      
      .store-address {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 15px;
        font-size: 0.95rem;
      }
      
      @media (max-width: 768px) {
        .detail-container {
          flex-direction: column;
        }
        
        .map-preview {
          height: 250px;
        }
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
          
           <!-- Total Expenses, Top Category, Top Expense, Avg Daily Expense -->
          <div class="row justify-content-end">
            <!-- Total Product Sold -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="revenue/revenue.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das1">
                  <div class="dash-counts">
                     <h4><span class="counters" data-count="7"></span></h4>
                    <h5>Total Store</h5>
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
                      <h4>Surabaya</span></h4>
                    <h5>Top Satisfaction Store</h5>
                  <h2 class="stat-change">3 months in a row</h2>
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
                    <h4><span class="counters" data-count="78630"></span></h4>
                    <h5>Top Store Traffic</h5>
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
                     <h4><span class="counters" data-count="4200"></span></h4>
                    <h5>Avg. Daily Visitors</h5>
                   <h2 class="stat-change">+8% from last week</h2>
                    </div>
                    <div class="icon-box bg-hijau">
                      <i class="fa fa-chart-line"></i>
                    </div>
                </div>
              </a>
            </div>
          </div>
          <!-- END KOLOM  -->

          <div class="info-container">
            <!-- Summary Cards - Diubah sesuai index.php -->
            <div class="row">
              <div class="col-md-3">
              </div>
              <div class="col-md-3">
              </div>
              <div class="col-md-3">
              </div>
            </div>

            <!-- Charts and Map Row -->
            <div class="row mb-4">
              <!-- Donut Chart -->
              <div class="col-lg-5">
                <div class="chart-container">
                  <div class="chart-title">Store Distribution by Province</div>
                  <canvas id="provinceChart"></canvas>
                  <div class="chart-hover-info" id="chartHoverInfo"></div>
                </div>
              </div>
              
              <!-- Map Container -->
              <div class="col-lg-7">
                <div class="map-container-wrapper">
                  <div class="map-header">
                    <h5>Store Locations Map</h5>
                  </div>
                  <div class="map-container">
                    <div id="store-map" style="height: 100%;"></div>
                  </div>
                </div>
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
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr data-id="1" data-lat="-6.2241" data-lng="106.6583" data-province="Banten">
                        <td>1</td>
                        <td>STR001</td>
                        <td>IKEA Alam Sutera</td>
                        <td>Jl. Jalur Sutera Boulevard No.45, Alam Sutera</td>
                        <td>
                          <button class="btn btn-sm btn-primary" onclick="showStoreDetail(1)">View Detail</button>
                        </td>
                      </tr>
                      <tr data-id="2" data-lat="-6.5622" data-lng="106.8460" data-province="Jawa Barat">
                        <td>2</td>
                        <td>STR002</td>
                        <td>IKEA Sentul City</td>
                        <td>Jl. MH Thamrin, Sentul City</td>
                        <td>
                          <button class="btn btn-sm btn-primary" onclick="showStoreDetail(2)">View Detail</button>
                        </td>
                      </tr>
                      <tr data-id="3" data-lat="-6.8512" data-lng="107.5328" data-province="Jawa Barat">
                        <td>3</td>
                        <td>STR003</td>
                        <td>IKEA Kota Baru Parahyangan</td>
                        <td>Jl. Parahyangan KM 3</td>
                        <td>
                          <button class="btn btn-sm btn-primary" onclick="showStoreDetail(3)">View Detail</button>
                        </td>
                      </tr>
                      <tr data-id="4" data-lat="-6.1775" data-lng="106.9423" data-province="DKI Jakarta">
                        <td>4</td>
                        <td>STR004</td>
                        <td>IKEA Jakarta Garden City</td>
                        <td>JGC, Cakung</td>
                        <td>
                          <button class="btn btn-sm btn-primary" onclick="showStoreDetail(4)">View Detail</button>
                        </td>
                      </tr>
                      <tr data-id="5" data-lat="-8.7075" data-lng="115.1720" data-province="Bali">
                        <td>5</td>
                        <td>STR005</td>
                        <td>IKEA Bali</td>
                        <td>Sunset Road, Kuta</td>
                        <td>
                          <button class="btn btn-sm btn-primary" onclick="showStoreDetail(5)">View Detail</button>
                        </td>
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

    <!-- Store Detail Modal -->
    <div class="modal fade" id="storeDetailModal" tabindex="-1" aria-labelledby="storeDetailModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="storeDetailModalLabel">Store Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="detail-container">
              <div class="store-details">
                <div class="store-name" id="detail-store-name">-</div>
                <span class="store-id" id="detail-store-id">-</span>
                
                <div class="store-address" id="detail-store-address">-</div>
                
                <div class="detail-item">
                  <div class="detail-label">City:</div>
                  <div class="detail-value" id="detail-city">-</div>
                </div>
                
                <div class="detail-item">
                  <div class="detail-label">Telephone:</div>
                  <div class="detail-value" id="detail-telephone">-</div>
                </div>
                
                <div class="detail-item">
                  <div class="detail-label">Land Area:</div>
                  <div class="detail-value" id="detail-land-area">-</div>
                </div>
                
                <div class="detail-item">
                  <div class="detail-label">Establish:</div>
                  <div class="detail-value" id="detail-establish">-</div>
                </div>
                
                <div class="detail-item">
                  <div class="detail-label">Status:</div>
                  <div class="detail-value" id="detail-status">-</div>
                </div>
                
                <div class="detail-item">
                  <div class="detail-label">Province:</div>
                  <div class="detail-value" id="detail-province">-</div>
                </div>
              </div>
              
              <div class="map-preview" id="map-preview">
                <!-- Map preview will be inserted here -->
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
      // Data toko per provinsi
      const provinceData = {
        'Banten': { count: 1, color: '#3498db' },
        'Jawa Barat': { count: 2, color: '#2ecc71' },
        'DKI Jakarta': { count: 1, color: '#f1c40f' },
        'Bali': { count: 1, color: '#e74c3c' }
      };
      
      // Data toko lengkap untuk modal detail
      const storeDetailData = {
        1: {
          name: "IKEA Alam Sutera",
          id: "STR001",
          city: "Tangerang (Banten)",
          telephone: "(021) 12345678",
          landArea: "35.000 m²",
          establish: "2014",
          status: "Open",
          province: "Banten",
          address: "Jl. Jalur Sutera Boulevard No.45, Alam Sutera",
          lat: -6.2241,
          lng: 106.6583
        },
        2: {
          name: "IKEA Sentul City",
          id: "STR002",
          city: "Bogor (Jawa Barat)",
          telephone: "(021) 12345678",
          landArea: "36.000 m²",
          establish: "2021",
          status: "Open",
          province: "Jawa Barat",
          address: "Jl. MH Thamrin, Sentul City",
          lat: -6.5622,
          lng: 106.8460
        },
        3: {
          name: "IKEA Kota Baru Parahyangan",
          id: "STR003",
          city: "Bandung Barat (Jawa Barat)",
          telephone: "(022) 34567890",
          landArea: "33.000 m²",
          establish: "2021",
          status: "Open",
          province: "Jawa Barat",
          address: "Jl. Parahyangan KM 3",
          lat: -6.8512,
          lng: 107.5328
        },
        4: {
          name: "IKEA Jakarta Garden City",
          id: "STR004",
          city: "Jakarta Timur (Jakarta)",
          telephone: "(021) 45678901",
          landArea: "39.000 m²",
          establish: "2021",
          status: "Open",
          province: "DKI Jakarta",
          address: "JGC, Cakung",
          lat: -6.1775,
          lng: 106.9423
        },
        5: {
          name: "IKEA Bali",
          id: "STR005",
          city: "Badung (Bali)",
          telephone: "-",
          landArea: "-",
          establish: "2025",
          status: "InProgress",
          province: "Bali",
          address: "Sunset Road, Kuta",
          lat: -8.7075,
          lng: 115.1720
        }
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
          maintainAspectRatio: true,
          cutout: '65%',
          plugins: {
            legend: {
              position: 'bottom',
              labels: {
                font: {
                  size: 11
                },
                padding: 15,
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
            animateScale: true,
            duration: 2000,
            easing: 'easeInOutQuart'
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
      
      // Buat marker untuk setiap toko
      $('table.datanew tbody tr').each(function() {
        const id = $(this).data('id');
        const lat = $(this).data('lat');
        const lng = $(this).data('lng');
        const province = $(this).data('province');
        const storeName = $(this).find('td:eq(2)').text();
        const address = $(this).find('td:eq(3)').text();
        const status = storeDetailData[id].status === 'Open' ? 'open' : 'progress';
        
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
          $(storeDetailData[id].element).addClass('highlight-row');
        });
        
        marker.on('mouseout', function() {
          $(this.getElement()).find('.store-marker').removeClass('highlight');
          const id = $(this.getElement()).find('.store-marker').data('id');
          $(storeDetailData[id].element).removeClass('highlight-row');
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
        const id = $(this).data('id');
        const areaText = storeDetailData[id].landArea;
        if (areaText !== '-') {
          const areaValue = parseFloat(areaText.replace('.', '').replace(' m²', ''));
          if (!isNaN(areaValue)) {
            totalArea += areaValue;
          }
        }
      });
      
      // Format angka dengan separator
      $('#total-area').text(totalArea.toLocaleString('id-ID') + ' m²');
      
      // Fungsi untuk menampilkan detail toko di modal
      function showStoreDetail(storeId) {
        const store = storeDetailData[storeId];
        
        // Update modal content
        document.getElementById('detail-store-name').textContent = store.name;
        document.getElementById('detail-store-id').textContent = store.id;
        document.getElementById('detail-store-address').textContent = store.address;
        document.getElementById('detail-city').textContent = store.city;
        document.getElementById('detail-telephone').textContent = store.telephone;
        document.getElementById('detail-land-area').textContent = store.landArea;
        document.getElementById('detail-establish').textContent = store.establish;
        document.getElementById('detail-status').innerHTML = 
          store.status === 'Open' ? 
          '<span class="status-badge status-active">Open</span>' : 
          '<span class="status-badge status-inprogress">InProgress</span>';
        document.getElementById('detail-province').textContent = store.province;
        
        // Create mini map preview
        const mapPreviewDiv = document.getElementById('map-preview');
        mapPreviewDiv.innerHTML = '<div id="mini-map" style="height: 100%; width: 100%;"></div>';
        
        // Initialize mini map
        const miniMap = L.map('mini-map').setView([store.lat, store.lng], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(miniMap);
        
        // Add marker to mini map
        const customIcon = L.divIcon({
          className: 'custom-marker',
          html: `<div class="store-marker" style="background-color: ${provinceData[store.province].color};"></div>`,
          iconSize: [24, 24],
          iconAnchor: [12, 24]
        });
        
        L.marker([store.lat, store.lng], {icon: customIcon}).addTo(miniMap)
          .bindPopup(`<b>${store.name}</b><br>${store.address}`)
          .openPopup();
        
        // Show the modal
        const modal = new bootstrap.Modal(document.getElementById('storeDetailModal'));
        modal.show();
      }
    </script>
  </body>
</html>