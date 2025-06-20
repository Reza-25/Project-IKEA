<?php
require_once __DIR__ . '/../include/config.php'; // Import config.php
?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../include/headbar.php'; ?> <!-- Import headbar -->
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <meta name="description" content="POS - Bootstrap Admin Template" />
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects" />
    <meta name="author" content="Dreamguys - Bootstrap Admin Template" />
    <meta name="robots" content="noindex, nofollow" />
    <title>Dreams Pos admin template</title>

    <!-- Perbaikan 1: Gunakan BASE_URL untuk semua asset -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flaticon@1.0.0/css/flaticon.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="../assets/css/animate.css" />
    <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
  </head>
  <body>
    <div id="global-loader">
      <div class="whirly-loader"></div>
    </div>

    <div class="main-wrapper">
       <!-- Include sidebar -->
       <?php include BASE_PATH . '/include/sidebar.php'; ?> <!-- Import sidebar -->
      
      

      <div class="page-wrapper">
        <div class="content">
          <div class="page-header">
            <div class="page-title">
              <h4>Revenue</h4>
            </div>
          </div>

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
                    <!-- ... (form inputs) ... -->
                  </div>
                </div>
              </div>

              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Cabang</th>
                      <th>Kode Toko</th>
                      <th>Status</th>
                      <th>Keuntungan</th>
                      <th>Rincian</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-bolds">IKE Alam Sutera</td>
                      <td>PT001</td>
                      <td><span class="badges bg-lightgreen">Active</span></td>
                      <td><span style="color: #28a745; font-weight: bold;">+1.5%</span></td>
                      <td>
                        <!-- Perbaikan 4: Gunakan BASE_URL untuk link internal -->
                        <a href="../editpurchase.php">
                          <span class="badges bg-lightgreen">Detail</span>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-bolds">IKEA Sentul City</td>
                      <td>PT001</td>
                      <td><span class="badges bg-lightgreen">Active</span></td>
                      <td><span style="color: #28a745; font-weight: bold;">+3.5%</td>
                      <td>
                        <!-- Perbaikan 4: Gunakan BASE_URL untuk link internal -->
                        <a href="../editpurchase.php">
                          <span class="badges bg-lightgreen">Detail</span>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-bolds">IKEA Kota Baru Parahyangan</td>
                      <td>PT001</td>
                      <td><span class="badges bg-lightgreen">Active</span></td>
                      <td><span style="color: #28a745; font-weight: bold;">+1.5%<i data-feather="trending-up"></i></span></td>
                      <td>
                        <!-- Perbaikan 4: Gunakan BASE_URL untuk link internal -->
                        <a href="../editpurchase.php">
                          <span class="badges bg-lightgreen">Detail</span>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-bolds">IKEA Jakarta Garden City</td>
                      <td>PT001</td>
                      <td><span class="badges bg-lightgreen">Active</span></td>
                      <td><span style="color: #dc3545; font-weight: bold;">-0.2%<i data-feather="trending-down"></i></span></td>
                      <td>
                        <!-- Perbaikan 4: Gunakan BASE_URL untuk link internal -->
                        <a href="../editpurchase.php">
                          <span class="badges bg-lightgreen">Detail</span>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-bolds">IKEA  Bali</td>
                      <td>PT001</td>
                      <td><span class="color: #28a745; font-weight: bold;">Active</span></td>
                      <td><span style="color: #dc3545; font-weight: bold;">+1.5%</span></td>
                      <td>
                        <!-- Perbaikan 4: Gunakan BASE_URL untuk link internal -->
                        <a href="../editpurchase.php">
                          <span class="badges bg-lightgreen">Detail</span>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-bolds">IKEA Mal Taman Anggrek</td>
                      <td>PT001</td>
                      <td><span class="badges bg-lightgreen">Active</span></td>
                      <td><span style="color: #28a745; font-weight: bold;"><i class="fi fi-rs-arrow-trend-up"></i>+2.0%</span></td>
                      <td>
                        <!-- Perbaikan 4: Gunakan BASE_URL untuk link internal -->
                        <a href="../editpurchase.php">
                          <span class="badges bg-lightgreen">Detail</span>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-bolds">IKEA Ciputra World Surabaya</td>
                      <td>PT001</td>
                      <td><span class="badges bg-lightgreen">InActive</span></td>
                      <td><span style="color: #dc3545; font-weight: bold;">-1.0%</span></td>
                      <td>
                        <!-- Perbaikan 4: Gunakan BASE_URL untuk link internal -->
                        <a href="../editpurchase.php">
                          <span class="badges bg-lightgreen">Detail</span>
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
    </div>

    <!-- Perbaikan 5: Gunakan BASE_URL untuk semua script -->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/feather.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/moment.min.js"></script>
    <script src="../assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalerts.min.js"></script>
    <script src="../assets/js/script.js"></script>
    
    <!-- Perbaikan 6: Tambahkan inisialisasi JavaScript -->
    <script>
      $(document).ready(function() {
        // Inisialisasi Feather Icons
        feather.replace();
        
        // Inisialisasi dropdown Bootstrap
        $('.dropdown-toggle').dropdown();
        
        // Inisialisasi sidebar toggle
        $('#toggle_btn').on('click', function() {
          $('body').toggleClass('mini-sidebar');
        });
      });
    </script>
  </body>
</html>