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
        <div class="header-left DONE">
          <a href="index.html" class="logo">
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
              <a href="javascript:void(0);" class="dropdown-item"> <img src="../assets/img/flags/fr.png" alt="" height="16" /> French </a>
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
                    <a href="activities.php">
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
                  <li class="notification-message">
                    <a href="activities.php">
                      <div class="media d-flex">
                        <span class="avatar flex-shrink-0">
                          <img alt="" src="../assets/img/profiles/avatar-03.jpg" />
                        </span>
                        <div class="media-body flex-grow-1">
                          <p class="noti-details"><span class="noti-title">Tarah Shropshire</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
                          <p class="noti-time"><span class="notification-time">6 mins ago</span></p>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="notification-message">
                    <a href="activities.php">
                      <div class="media d-flex">
                        <span class="avatar flex-shrink-0">
                          <img alt="" src="../assets/img/profiles/avatar-06.jpg" />
                        </span>
                        <div class="media-body flex-grow-1">
                          <p class="noti-details">
                            <span class="noti-title">Misty Tison</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project
                            <span class="noti-title">Doctor available module</span>
                          </p>
                          <p class="noti-time"><span class="notification-time">8 mins ago</span></p>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="notification-message">
                    <a href="activities.php">
                      <div class="media d-flex">
                        <span class="avatar flex-shrink-0">
                          <img alt="" src="../assets/img/profiles/avatar-17.jpg" />
                        </span>
                        <div class="media-body flex-grow-1">
                          <p class="noti-details"><span class="noti-title">Rolland Webber</span> completed task <span class="noti-title">Patient and Doctor video conferencing</span></p>
                          <p class="noti-time"><span class="notification-time">12 mins ago</span></p>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="notification-message">
                    <a href="activities.php">
                      <div class="media d-flex">
                        <span class="avatar flex-shrink-0">
                          <img alt="" src="../assets/img/profiles/avatar-13.jpg" />
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
                <a href="activities.php">View all Notifications</a>
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
                <a class="dropdown-item" href="profile.php"> <i class="me-2" data-feather="user"></i> My Profile</a>
                <a class="dropdown-item" href="generalsettings.php"><i class="me-2" data-feather="settings"></i>Settings</a>
                <hr class="m-0" />
                <a class="dropdown-item logout pb-0" href="signin.php"><img src="../assets/img/icons/log-out.svg" class="me-2" alt="img" />Logout</a>
              </div>
            </div>
          </li>
        </ul>

        <div class="dropdown mobile-user-menu">
          <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="profile.php">My Profile</a>
            <a class="dropdown-item" href="generalsettings.php">Settings</a>
            <a class="dropdown-item" href="signin.php">Logout</a>
          </div>
        </div>
      </div>

      <div class="page-wrapper">
        <div class="content">
          <div class="page-header">
            <div class="page-title">
              <h4>Expenses LIST</h4>
              <h6>Manage your purchases</h6>
            </div>
          </div>

         <!-- LINE CHART SECTION -->
<div class="row mt-4">
  <!-- LINE CHART -->
  <div class="col-md-8">
    <div class="card h-100">
      <div class="card-header d-flex justify-content-between align-items-center py-2 px-3" style="background-color: rgb(100, 149, 237);">
        <h6 class="card-title mb-0 text-white small">Expense List</h6>
      </div>
      <div class="card-body p-2">
        <div id="expenseLineChart" style="height: 250px;"></div>
        <div class="text-end mt-1">
          <small class="text-muted fst-italic" style="font-size: 1rem;">Data for June 2025</small>
        </div>
      </div>
    </div>
  </div>

  <!-- TOTAL EXPENSE BOX -->
<div class="col-md-4">
  <div class="card h-100 shadow rounded-4" style="background-color: #fffbea; border-left: 6px solid #f39c12;">
    <div class="card-header text-center text-dark py-2 rounded-top-4" style="background-color: #f9e79f;">
      <h6 class="card-title mb-0 fw-bold">🧾 Total Expenses</h6>
    </div>
    <div class="card-body text-center p-3 d-flex flex-column justify-content-center">
      <h3 class="text-danger mb-2 fw-bold" id="totalExpense">Rp 0</h3>
      <p class="text-muted mb-2 small fst-italic">Details:</p>
      <ul class="list-unstyled text-center px-4 mb-0 fs-7 fw-semibold" id="expenseBreakdown">
  <li>Week 1: Rp 500.000</li>
  <li>Week 2: Rp 450.000</li>
  <li>Week 3: Rp 600.000</li>
  <li>Week 4: Rp 620.000</li>
</ul> 
    </div>
  </div>
</div>


<!-- APEXCHARTS -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const lineChartData = {
    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
    amounts: [350000, 420000, 300000, 500000]
  };

  const total = lineChartData.amounts.reduce((sum, val) => sum + val, 0);
  document.getElementById("totalExpense").textContent = "Rp " + total.toLocaleString();

  const breakdownList = document.getElementById("expenseBreakdown");
  breakdownList.innerHTML = "";
  lineChartData.labels.forEach((label, i) => {
    const amountFormatted = "Rp " + lineChartData.amounts[i].toLocaleString();
    breakdownList.innerHTML += `<li><strong>${label}:</strong> ${amountFormatted}</li>`;
  });

  const options = {
    chart: {
      type: 'line',
      height: 250,
      toolbar: { show: false }
    },
    series: [{
      name: 'Expenses',
      data: lineChartData.amounts
    }],
    xaxis: {
      categories: lineChartData.labels,
      labels: { style: { fontSize: '12px' } }
    },
    stroke: {
      curve: 'smooth',
      width: 2
    },
    markers: {
      size: 4,
      colors: ['#007bff'],
      strokeWidth: 2
    },
    tooltip: {
      y: {
        formatter: val => "Rp " + val.toLocaleString()
      }
    }
  };

  const chart = new ApexCharts(document.querySelector("#expenseLineChart"), options);
  chart.render();
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
                      <img src="../assets/img/icons/search-white.svg" alt="img" />
                    </a>
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
                        <div class="input-groupicon">
                          <input type="text" class="datetimepicker cal-icon" placeholder="Choose Date" />
                          <div class="addonset">
                            <img src="../assets/img/icons/calendars.svg" alt="img" />
                          </div>
                        </div>
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
                      <th>Category name</th>
                      <th>Reference</th>
                      <th>Date</th>
                      <th>Amount</th>
                      <th>Description</th>
                      <th>Status</th>
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
                      <td>Employee Benefits</td>
                      <td>PT001</td>
                      <td>19 Nov 2022</td>
                      <td>120</td>
                      <td>Employee Vehicle</td>
                      <td><span class="badges bg-lightgreen">DONE</span></td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>Foods & Snacks</td>
                      <td>PT002</td>
                      <td>19 Nov 2022</td>
                      <td>250</td>
                      <td>Employee Foods</td>
                      <td><span class="badges bg-lightgreen">DONE</span></td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>Entertainment</td>
                      <td>PT003</td>
                      <td>19 Nov 2022</td>
                      <td>120</td>
                      <td>Office Vehicle</td>
                      <td><span class="badges bg-lightred">ON PROGRESS</span></td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>Office Expenses & Postage</td>
                      <td>PT004</td>
                      <td>19 Nov 2022</td>
                      <td>320</td>
                      <td>Employee Foods</td>
                      <td><span class="badges bg-lightgreen">DONE</span></td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>Employee Benefits</td>
                      <td>PT005</td>
                      <td>19 Nov 2022</td>
                      <td>250</td>
                      <td>Employee Vehicle</td>
                      <td><span class="badges bg-lightgreen">DONE</span></td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>Foods & Snacks</td>
                      <td>PT006</td>
                      <td>19 Nov 2022</td>
                      <td>250</td>
                      <td>Employee Foods</td>
                      <td><span class="badges bg-lightgreen">DONE</span></td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>Entertainment</td>
                      <td>PT007</td>
                      <td>19 Nov 2022</td>
                      <td>120</td>
                      <td>Office Vehicle</td>
                      <td><span class="badges bg-lightred">ON PROGRESS</span></td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>Office Expenses & Postage</td>
                      <td>PT008</td>
                      <td>19 Nov 2022</td>
                      <td>320</td>
                      <td>Employee Foods</td>
                      <td><span class="badges bg-lightgreen">DONE</span></td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>Employee Benefits</td>
                      <td>PT009</td>
                      <td>19 Nov 2022</td>
                      <td>120</td>
                      <td>Employee Vehicle</td>
                      <td><span class="badges bg-lightgreen">DONE</span></td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>Foods & Snacks</td>
                      <td>PT010</td>
                      <td>19 Nov 2022</td>
                      <td>250</td>
                      <td>Employee Foods</td>
                      <td><span class="badges bg-lightgreen">DONE</span></td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>Entertainment</td>
                      <td>PT011</td>
                      <td>19 Nov 2022</td>
                      <td>120</td>
                      <td>Office Vehicle</td>
                      <td><span class="badges bg-lightred">ON PROGRESS</span></td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>Office Expenses & Postage</td>
                      <td>PT012</td>
                      <td>19 Nov 2022</td>
                      <td>320</td>
                      <td>Employee Foods</td>
                      <td><span class="badges bg-lightgreen">DONE</span></td>
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
