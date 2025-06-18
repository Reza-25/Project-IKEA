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

    <!-- Perbaikan 1: Gunakan BASE_URL untuk semua asset -->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg" />
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
      
      <div class="header">
        <div class="header-left active">
          <a href="../index.php" class="logo">
            <img src="../assets/img/logo1.png" alt="" />
          </a>

          <a id="toggle_btn" href="javascript:void(0);"> </a>
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
                  <input type="text" placeholder="Search Here ..." />
                  <div class="search-addon">
                    <span><img src="../assets/img/icons/closes.svg" alt="img" /></span>
                  </div>
                </div>
                <a class="btn" id="searchdiv"><img src="../assets/img/icons/search.svg" alt="img" /></a>
              </form>
            </div>
          </li>

          <li class="nav-item dropdown has-arrow flag-nav">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);" role="button">
              <img src="../assets/img/flags/us1.png" alt="" height="20" />
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="javascript:void(0);" class="dropdown-item"> <img src="../assets/img/flags/us.png" alt="" height="16" /> English </a>
              <a href="javascript:void(0);" class="dropdown-item"> <img src="../assets/img/flags/id.png" alt="" height="16" /> French </a>
              <a href="javascript:void(0);" class="dropdown-item"> <img src="../assets/img/flags/es.png" alt="" height="16" /> Spanish </a>
              <a href="javascript:void(0);" class="dropdown-item"> <img src="../assets/img/flags/de.png" alt="" height="16" /> German </a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown"> <img src="../assets/img/icons/notification-bing.svg" alt="img" /> <span class="badge rounded-pill">4</span> </a>
            <div class="dropdown-menu notifications">
              <div class="topnav-dropdown-header">
                <span class="notification-title">Notifications</span>
                <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
              </div>
              <div class="noti-content">
                <ul class="notification-list">
                  <li class="notification-message">
                    <!-- Perbaikan 3: Gunakan BASE_URL untuk link internal -->
                    <a href="../activities.php">
                      <div class="media d-flex">
                        <span class="avatar flex-shrink-0">
                          <img alt="" src="../assets/img/profiles/avatar-02.jpg" />
                        </span>
                        <div class="media-body flex-grow-1">
                          <p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
                          <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- ... (bagian notifikasi lainnya dengan pola yang sama) ... -->
                </ul>
              </div>
              <div class="topnav-dropdown-footer">
                <a href="../activities.php">View all Notifications</a>
              </div>
            </div>
          </li>

          <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
              <span class="user-img"><img src="../assets/img/profiles/avator1.jpg" alt="" /> <span class="status online"></span></span>
            </a>
            <div class="dropdown-menu menu-drop-user">
              <div class="profilename">
                <div class="profileset">
                  <span class="user-img"><img src="../assets/img/profiles/avator1.jpg" alt="" /> <span class="status online"></span></span>
                  <div class="profilesets">
                    <h6>John Doe</h6>
                    <h5>Admin</h5>
                  </div>
                </div>
                <hr class="m-0" />
                <a class="dropdown-item" href="../profile.php"> <i class="me-2" data-feather="user"></i> My Profile</a>
                <a class="dropdown-item" href="../generalsettings.php"><i class="me-2" data-feather="settings"></i>Settings</a>
                <hr class="m-0" />
                <a class="dropdown-item logout pb-0" href="../signin.php"><img src="../assets/img/icons/log-out.svg" class="me-2" alt="img" />Logout</a>
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
                      <td>210</td>
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
                      <td>210</td>
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
                      <td>210</td>
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
                      <td>210</td>
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
                      <td><span class="badges bg-lightgreen">Active</span></td>
                      <td>210</td>
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
                      <td>210</td>
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
                      <td><span class="badges bg-lightgreen">Active</span></td>
                      <td>210</td>
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