<?php
require_once __DIR__ . '/../include/config.php'; // Import config.php
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <meta name="description" content="POS - Bootstrap Admin Template" />
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive" />
    <meta name="author" content="Dreamguys - Bootstrap Admin Template" />
    <meta name="robots" content="noindex, nofollow" />
    <title>IKEA</title>

    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg" />

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />

    <link rel="stylesheet" href="../assets/css/animate.css" />

    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css" />

    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css" />

   <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
<style>
  
  body {
    background-color: #f8f9fa !important;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
    color: #333 !important;
  }

  .dash-count {
    color: white !important;
    border-radius: 15px !important;
    padding: 20px !important;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08) !important;
    transition: transform 0.3s ease;
  }

  .dash-count:hover {
    transform: translateY(-5px);
  }

  .das1 {
    background: linear-gradient(135deg, #26c6da 0%, #1a5ea7 100%) !important;
  }
  .das2 {
    background: linear-gradient(135deg, #d05ce4 0%, #751e8d 100%) !important;
  }
  .das3 {
    background: linear-gradient(135deg, #ffb443 0%, #e78001 100%) !important;
  }
  .das4 {
    background: linear-gradient(135deg, #36e2d1 0%, #018679 100%) !important;
  }


  .dash-imgs i {
    background: rgba(255, 255, 255, 0.2);
    padding: 10px;
    border-radius: 10px;
    font-size: 24px;
    color: white;
  }

  .card {
    border-radius: 15px !important;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08) !important;
  }

  .card-title {
    font-size: 20px;
    font-weight: 600;
    color: #333;
  }

  .table th {
    background-color: #0047AB !important;
    color: white !important;
  }

  .productimgname a {
    color: #0047AB !important;
    font-weight: 500;
  }

  .d-flex.align-items-center.p-4.rounded.shadow-sm {
    background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%) !important;
    border-left: 6px solid #2196f3 !important;
  }

  .d-flex.align-items-center.p-4 h4,
  .d-flex.align-items-center.p-4 p {
    color: #0d47a1 !important;
  }
 canvas#salesChart {
  padding-bottom: 0 !important;
  margin-bottom: -5px;
  }

  .icon-wrapper {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
  }

  .bg-light-primary {
    background-color: #e0f0ff;
  }
  .text-primary {
    color: #3a8dde;
  }
  .bg-primary {
    background-color: #3a8dde;
  }

  .bg-light-purple {
    background-color: #f3e8fd;
  }
  .text-purple {
    color: #a14fd5;
  }
  .bg-purple {
    background-color: #a14fd5;
  }

  .bg-light-success {
    background-color: #d9f7f0;
  }
  .text-success {
    color: #20c997;
  }
  .bg-success {
    background-color: #20c997;
  }

  .bg-light-info {
    background-color: #daf1f8;
  }
  .text-info {
    color: #17a2b8;
  }
  .bg-info {
    background-color: #17a2b8;
  }

  .number-badge {
    background-color: #eee;
    color: #555;
    font-weight: bold;
    border-radius: 50%;
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
  }

  .icon-wrapper {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
  }

  .bg-light-primary { background-color: #e0f0ff; }
  .text-primary { color: #3a8dde; }
  .bg-primary { background-color: #3a8dde; }

  .bg-light-purple { background-color: #f3e8fd; }
  .text-purple { color: #a14fd5; }
  .bg-purple { background-color: #a14fd5; }

  .bg-light-success { background-color: #d9f7f0; }
  .text-success { color: #20c997; }
  .bg-success { background-color: #20c997; }

  .bg-light-info { background-color: #daf1f8; }
  .text-info { color: #17a2b8; }
  .bg-info { background-color: #17a2b8; }

  .animated-progress .progress-bar {
    width: 0%;
    transition: width 1s ease-in-out;
  }
  /* Gaya kartu sapaan */
  .greeting-card {
    background: linear-gradient(135deg, #e3f2fd, #bbdefb);
    border-left: 6px solid #2196f3;
    transition: all 0.3s ease;
  }

  .greeting-card:hover {
    transform: scale(1.02);
    box-shadow: 0 6px 15px rgba(33, 150, 243, 0.2);
  }

  /* Lingkaran ikon */
  .icon-circle {
    background-color: #fff3cd;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  /* Ikon warna kuning */
  .icon-yellow {
    color: #ffc107;
    width: 32px;
    height: 32px;
  }

  /* Warna teks utama */
  .text-primary-dark {
    color: #0d47a1;
  }

  /* Efek saat hover */
  .animate-on-hover {
    cursor: pointer;
    transition: 0.3s ease;
  }

  .animate-on-hover:hover {
    background: linear-gradient(135deg, #dbeeff, #b3d9f9);
  }
  
/* <!-- css dri ringkasan smpe performance --> */
  .progress-bar {
    animation: loadBar 2s ease-in-out forwards;
    background-image: linear-gradient(45deg, rgba(255,255,255,0.15) 25%, transparent 25%, transparent 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, transparent 75%, transparent);
    background-size: 1rem 1rem;
  }

  @keyframes loadBar {
    from { width: 0; }
  }

  .goal-simple {
    background-color: #e7f1ff;
    border-radius: 0.75rem;
    padding: 1rem;
    text-align: center;
  }

  .goal-simple h1 {
    font-size: 2rem;
    font-weight: bold;
    color: #0d6efd;
    margin-bottom: 0.25rem;
    line-height: 1;
  }

  .goal-simple p {
    font-size: 1rem;
    font-weight: 500;
    color: #0a58ca;
    margin-bottom: 0;
  }

  .goal-simple:hover {
  transform: scale(1.03);
  box-shadow: 0 0 10px rgba(13, 110, 253, 0.2);
}

/* <!-- Top Products Component --> */
  .product-progress-item .price-info {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    font-size: 0.9rem;
    margin-top: 4px;
  }
  .product-progress-item .price-info strong {
    font-size: 1.1rem;
    color: #343a40;
  }
  .product-progress-item .price-info .growth {
    font-size: 0.85rem;
    color: #28a745;
  }
  .product-progress-item .progress {
    height: 6px;
    background-color: #f1f1f1;
    border-radius: 10px;
    overflow: hidden;
    margin-top: 0.3rem;
  }
  .product-progress-item .progress-bar {
    border-radius: 10px;
    transition: width 0.6s ease;
  }
  /* <!-- Top Products Component --> */

  .card-header.gradient-bg {
    background: linear-gradient(135deg, #5dade2 0%, #1a5ea7 100%);
    color: white;
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
    animation: fadeIn 1s ease-in-out;
  }

  .table-responsive table tbody tr:hover {
    background-color: #f5faff;
    transition: 0.3s ease;
    cursor: pointer;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
  }
  /* Terapkan animasi hover dan active untuk semua container */
.card,
.greeting-card,
.goal-simple {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  cursor: pointer;
}

/* Hover: naik dan bayangan */
.card:hover,
.greeting-card:hover,
.goal-simple:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12) !important;
}

/* Klik: animasi kecil saat ditekan */
.card:active,
.greeting-card:active,
.goal-simple:active {
  transform: translateY(1px) scale(0.98);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
}

/* .sidebar .sidebar-menu {
  background: linear-gradient(to bottom, #19589b, #00A3E0) !important;
} */


</style>


</head>
  <body>
    <div id="global-loader">
      <div class="whirly-loader"></div>
    </div>

    <div class="main-wrapper">
    <?php include __DIR__ . '/../include/ai.php'; ?> <!-- Import AI -->
      <div class="header">
        <div class="header-left active">
          <a href="index.php" class="logo">
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
                    <span><img src="assets/img/icons/closes.svg" alt="img" /></span>
                  </div>
                </div>
                <a class="btn" id="searchdiv"><img src="../assets/img/icons/search.svg" alt="img" /></a>
              </form>
            </div>
          </li>

          <li class="nav-item dropdown has-arrow flag-nav">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);" role="button">
              <img src="assets/img/flags/us1.png" alt="" height="20" />
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="javascript:void(0);" class="dropdown-item"> <img src="../assets/img/flags/us.png" alt="" height="16" /> English </a>
              <a href="javascript:void(0);" class="dropdown-item"> <img src="../assets/img/flags/id.png" alt="" height="16" /> Indonesian </a>
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
                  <li class="notification-message">
                    <a href="../activities.php">
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
                    <a href="../activities.php">
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
                    <a href="../activities.php">
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
                    <a href="../activities.php">
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

      <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
          <div id="sidebar-menu" class="sidebar-menu">
            <ul>
              <li class="active">
                <a href="index.php"><img src="../assets/img/icons/dashboard.svg" alt="img" /><span> Dashboard</span> </a>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img src="../assets/img/icons/product.svg" alt="img" /><span> Product</span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../product/productsold.php">Product Sold</a></li>
                  <li><a href="../product/categorylist.php">Category List</a></li>
                  <li><a href="../product/productlist.php">Product List</a></li>
                  <li><a href="../product/brandlist.php">Brand List</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img src="../assets/img/icons/sales1.svg" alt="img" /><span> Supplier</span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../supplier/supplierlist.php">Supplier List</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img src="../assets/img/icons/purchase1.svg" alt="img" /><span> Revenue</span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../revenue/revenue.php">Revenue</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img src="../assets/img/icons/expense1.svg" alt="img" /><span> Expense</span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../expense/expenselist.php">Expense List</a></li>
                  <li><a href="../expense/expensecategory.php">Expense Category</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img src="../assets/img/icons/quotation1.svg" alt="img" /><span> Quotation</span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../quotation/quotationList.php">Quotation List</a></li>
                  <li><a href="../quotation/addquotation.php">Add Quotation</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img src="../assets/img/icons/transfer1.svg" alt="img" /><span> Inventory</span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../inventory/transferlist.php">Transfer List</a></li>
                  <li><a href="../inventory/suplierreturn.php">Supplier Return </a></li>
                  <li><a href="../inventory/customerreturn.php">Customer Return </a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img src="../assets/img/icons/users1.svg" alt="img" /><span> People</span> <span class="menu-arrow"></span></a>
                <ul>
                 <li><a href="../people/customerlist.php">Customer List</a></li>
                  <li><a href="../people/supplierlist.php">Supplier List</a></li>
                  <li><a href="../people/userlist.php">User List</a></li>
                  <li><a href="../people/storelist.php">Store List</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img src="../assets/img/icons/places.svg" alt="img" /><span> Places</span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../places/countrieslist.php">Countries list</a></li>
                  <li><a href="../places/statelist.php">State list</a></li>
                </ul>
              </li>
              <li>
                <a href="components.php"><i data-feather="layers"></i><span> Components</span> </a>
              </li>
              <li>
                <a href="blankpage.php"><i data-feather="file"></i><span> Blank Page</span> </a>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><i data-feather="alert-octagon"></i> <span> Error Pages </span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="error-404.php">404 Error </a></li>
                  <li><a href="error-500.php">500 Error </a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><i data-feather="box"></i> <span>Elements </span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="sweetalerts.php">Sweet Alerts</a></li>
                  <li><a href="tooltip.php">Tooltip</a></li>
                  <li><a href="popover.php">Popover</a></li>
                  <li><a href="ribbon.php">Ribbon</a></li>
                  <li><a href="clipboard.php">Clipboard</a></li>
                  <li><a href="drag-drop.php">Drag & Drop</a></li>
                  <li><a href="rangeslider.php">Range Slider</a></li>
                  <li><a href="rating.php">Rating</a></li>
                  <li><a href="toastr.php">Toastr</a></li>
                  <li><a href="text-editor.php">Text Editor</a></li>
                  <li><a href="counter.php">Counter</a></li>
                  <li><a href="scrollbar.php">Scrollbar</a></li>
                  <li><a href="spinner.php">Spinner</a></li>
                  <li><a href="notification.php">Notification</a></li>
                  <li><a href="lightbox.php">Lightbox</a></li>
                  <li><a href="stickynote.php">Sticky Note</a></li>
                  <li><a href="timeline.php">Timeline</a></li>
                  <li><a href="form-wizard.php">Form Wizard</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><i data-feather="bar-chart-2"></i> <span> Charts </span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="chart-apex.php">Apex Charts</a></li>
                  <li><a href="chart-js.php">Chart Js</a></li>
                  <li><a href="chart-morris.php">Morris Charts</a></li>
                  <li><a href="chart-flot.php">Flot Charts</a></li>
                  <li><a href="chart-peity.php">Peity Charts</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><i data-feather="award"></i><span> Icons </span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="icon-fontawesome.php">Fontawesome Icons</a></li>
                  <li><a href="icon-feather.php">Feather Icons</a></li>
                  <li><a href="icon-ionic.php">Ionic Icons</a></li>
                  <li><a href="icon-material.php">Material Icons</a></li>
                  <li><a href="icon-pe7.php">Pe7 Icons</a></li>
                  <li><a href="icon-simpleline.php">Simpleline Icons</a></li>
                  <li><a href="icon-themify.php">Themify Icons</a></li>
                  <li><a href="icon-weather.php">Weather Icons</a></li>
                  <li><a href="icon-typicon.php">Typicon Icons</a></li>
                  <li><a href="icon-flag.php">Flag Icons</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><i data-feather="columns"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="form-basic-inputs.php">Basic Inputs </a></li>
                  <li><a href="form-input-groups.php">Input Groups </a></li>
                  <li><a href="form-horizontal.php">Horizontal Form </a></li>
                  <li><a href="form-vertical.php"> Vertical Form </a></li>
                  <li><a href="form-mask.php">Form Mask </a></li>
                  <li><a href="form-validation.php">Form Validation </a></li>
                  <li><a href="form-select2.php">Form Select2 </a></li>
                  <li><a href="form-fileupload.php">File Upload </a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><i data-feather="layout"></i> <span> Table </span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="tables-basic.php">Basic Tables </a></li>
                  <li><a href="data-tables.php">Data Table </a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img src="assets/img/icons/product.svg" alt="img" /><span> Application</span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="chat.php">Chat</a></li>
                  <li><a href="calendar.php">Calendar</a></li>
                  <li><a href="email.php">Email</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img src="assets/img/icons/time.svg" alt="img" /><span> Report</span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="purchaseorderreport.php">Purchase order report</a></li>
                  <li><a href="inventoryreport.php">Inventory Report</a></li>
                  <li><a href="salesreport.php">Sales Report</a></li>
                  <li><a href="invoicereport.php">Invoice Report</a></li>
                  <li><a href="purchasereport.php">Purchase Report</a></li>
                  <li><a href="supplierreport.php">Supplier Report</a></li>
                  <li><a href="customerreport.php">Customer Report</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img src="assets/img/icons/users1.svg" alt="img" /><span> Users</span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="newuser.php">New User </a></li>
                  <li><a href="userlists.php">Users List</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img src="assets/img/icons/settings.svg" alt="img" /><span> Settings</span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="generalsettings.php">General Settings</a></li>
                  <li><a href="emailsettings.php">Email Settings</a></li>
                  <li><a href="paymentsettings.php">Payment Settings</a></li>
                  <li><a href="currencysettings.php">Currency Settings</a></li>
                  <li><a href="grouppermissions.php">Group Permissions</a></li>
                  <li><a href="taxrates.php">Tax Rates</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="page-wrapper">
        <div class="content">
          <div class="row">
          <div class="col-lg-12 col-12 mb-4">
            <div class="greeting-card d-flex align-items-center p-4 shadow-sm rounded animate-on-hover">
                <div class="me-3 flex-shrink-0 icon-circle">
                <i data-feather="sun" class="icon-yellow"></i>
                </div>
                <div>
                <h4 class="mb-1 text-primary-dark">Good Morning, Mrs. Bintang! 👋</h4>
                <p class="mb-0 text-primary-dark">
                    Today, you have <strong>3 tasks</strong> and <strong>5 notifications</strong> that need your attention.
                </p>
                </div>
            </div>
            </div>

        <script src="https://unpkg.com/feather-icons"></script>
            <script>
            feather.replace();
            </script>



            <!-- End Total Purchase Due -->

            <!-- Revenue, Suppliers, Product Sold, Budget Spent --> 
            <div class="row justify-content-end">
            <!-- Revenue -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="revenue/revenue.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das1">
                  <div class="dash-counts">
                    <h4>$<span class="counters" data-count="385656.50">385,656.50</span></h4>
                    <h5>Revenue</h5>
                    <h2 class="stat-change" style="font-size: 11px; font-weight: normal; margin-top: 4px;">+9% from last year</h2>
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
                    <h4><span class="counters" data-count="1975"></span></h4>
                    <h5>Suppliers</h5>
                    <h2 class="stat-change" style="font-size: 11px; font-weight: normal; margin-top: 4px;">+2% from last year</h2>
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
                    <h4><span class="counters" data-count="7863"></span></h4>
                    <h5>Product Sold</h5>
                    <h2 class="stat-change" style="font-size: 11px; font-weight: normal; margin-top: 4px;">+15% from last year</h2>
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
                   <h2 class="stat-change" style="font-size: 11px; font-weight: normal; margin-top: 4px;">+6% from last year</h2>
                  </div>
                  <div class="dash-imgs">
                    <i data-feather="activity"></i>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <!-- END KOLOM  -->
        
          <!-- CHART Revenue vs Expense -->
    <div class="row">         
    <div class="col-lg-7 col-sm-12 col-12 d-flex">
    <div class="card flex-fill">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Revenue vs Expense</h5>
        <div class="dropdown ms-auto">
            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="yearDropdown" data-bs-toggle="dropdown">
            2025
            </button>
            <ul class="dropdown-menu" aria-labelledby="yearDropdown">
            <li><a class="dropdown-item year-option" href="#" data-year="2025">2025</a></li>
            <li><a class="dropdown-item year-option" href="#" data-year="2024">2024</a></li>
            <li><a class="dropdown-item year-option" href="#" data-year="2023">2023</a></li>
            </ul>
        </div>
        </div>
        <div class="card-body" style="height: 300px;">
        <canvas id="salesChart"></canvas>
        </div>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // DATA TAHUNAN DENGAN PERUBAHAN DRASTIS YANG BERBEDA
    const chartData = {
        '2025': {
        revenue: [5000, 8000, 15000, 25000, 38000, 45000, 30000, 18000, 12000, 10000, 9000, 8000],
        expense: [3000, 4000, 8000, 12000, 15000, 25000, 18000, 12000, 6000, 4000, 3500, 3000]
        },
        '2024': {
        revenue: [10000, 12000, 18000, 32000, 40000, 30000, 25000, 20000, 18000, 14000, 10000, 8000],
        expense: [7000, 9000, 12000, 16000, 21000, 17000, 14000, 11000, 8000, 5000, 4000, 3500]
        },
        '2023': {
        revenue: [3000, 6000, 11000, 20000, 35000, 42000, 38000, 22000, 14000, 9000, 6000, 4000],
        expense: [2000, 3000, 6000, 9000, 15000, 20000, 18000, 12000, 7000, 4000, 3000, 2500]
        }
    };

    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [
            {
            label: 'Revenue',
            data: chartData['2025'].revenue,
            fill: true,
            backgroundColor: 'rgba(56, 189, 248, 0.1)',
            borderColor: '#38bdf8',
            borderWidth: 2.5,
            pointRadius: 2,
            pointHoverRadius: 5,
            pointBackgroundColor: '#38bdf8',
            tension: 0.5
            },
            {
            label: 'Expense',
            data: chartData['2025'].expense,
            fill: true,
            backgroundColor: 'rgba(168, 85, 247, 0.1)',
            borderColor: '#a855f7',
            borderWidth: 2.5,
            pointRadius: 2,
            pointHoverRadius: 5,
            pointBackgroundColor: '#a855f7',
            tension: 0.5
            }
        ]
        },
        options: {
        maintainAspectRatio: false,
        responsive: true,
        plugins: {
            legend: {
            display: true,
            position: 'top',
            labels: {
                font: { size: 13 },
                color: '#444'
            }
            },
            tooltip: {
            backgroundColor: '#fff',
            titleColor: '#000',
            bodyColor: '#000',
            borderColor: '#ccc',
            borderWidth: 1
            }
        },
        scales: {
            y: {
            beginAtZero: true,
            ticks: {
                callback: value => '$' + value,
                color: '#777'
            },
            grid: {
                color: '#f0f0f0'
            }
            },
            x: {
            ticks: {
                color: '#777'
            },
            grid: {
                display: false
            }
            }
        }
        }
    });

    // DROPDOWN TAHUN (tidak reload halaman)
    document.querySelectorAll('.year-option').forEach(item => {
        item.addEventListener('click', function (e) {
        e.preventDefault(); // agar tidak reload
        const year = this.getAttribute('data-year');
        document.getElementById('yearDropdown').innerText = year;
        salesChart.data.datasets[0].data = chartData[year].revenue;
        salesChart.data.datasets[1].data = chartData[year].expense;
        salesChart.update();
        });
    });
    </script>
          <!-- END CHART Revenue vs Expense -->



 <!-- TOP PRODUCTS -->
<div class="col-lg-5 col-sm-12 col-12 d-flex">
  <div class="card flex-fill">
    <div class="card-header pb-0">
      <ul class="nav nav-tabs card-header-tabs" id="topTabs" role="tablist">
        <li class="nav-item">
          <button class="nav-link active" id="products-tab" data-bs-toggle="tab" data-bs-target="#products" type="button" role="tab">Top Categories Products</button>
        </li>
        <li class="nav-item">
          <button class="nav-link" id="categories-tab" data-bs-toggle="tab" data-bs-target="#categories" type="button" role="tab">Top Products</button>
        </li>
      </ul>
    </div>
    <div class="card-body tab-content" id="topTabsContent">
      <!-- Top Category Tab -->
      <div class="tab-pane fade show active" id="products" role="tabpanel">
        <div class="product-progress-list">
          <div class="product-progress-item d-flex align-items-center mb-4">
            <div class="number-badge">1</div>
            <div class="icon-wrapper bg-light-primary text-primary ms-2 me-3">
              <i class="fas fa-home"></i>
            </div>
            <div class="flex-grow-1">
              <div class="d-flex justify-content-between">
                <span class="fw-semibold">Furniture</span>
              </div>
              <div class="price-info">
                <strong>5070 Pieces </strong>
                <span class="text-primary">+24%</span>
              </div>
              <div class="progress">
                <div class="progress-bar bg-primary" style="width: 85%;"></div>
              </div>
            </div>
          </div>
          <div class="product-progress-item d-flex align-items-center mb-4">
            <div class="number-badge">2</div>
            <div class="icon-wrapper bg-light-purple text-purple ms-2 me-3">
              <i class="fas fa-bed"></i>
            </div>
            <div class="flex-grow-1">
              <div class="d-flex justify-content-between">
                <span class="fw-semibold">Bedroom</span>
              </div>
              <div class="price-info">
                <strong>3880 Pieces</strong>
                <span class="text-purple">+18%</span>
              </div>
              <div class="progress">
                <div class="progress-bar bg-purple" style="width: 72%;"></div>
              </div>
            </div>
          </div>
          <div class="product-progress-item d-flex align-items-center mb-4">
            <div class="number-badge">3</div>
            <div class="icon-wrapper bg-light-success text-success ms-2 me-3">
              <i class="fas fa-utensils"></i>
            </div>
            <div class="flex-grow-1">
              <div class="d-flex justify-content-between">
                <span class="fw-semibold">Kitchen</span>
              </div>
              <div class="price-info">
                <strong>3020 Pieces</strong>
                <span class="text-success">+12%</span>
              </div>
              <div class="progress">
                <div class="progress-bar bg-success" style="width: 65%;"></div>
              </div>
            </div>
          </div>
          <div class="product-progress-item d-flex align-items-center">
            <div class="number-badge">4</div>
            <div class="icon-wrapper bg-light-info text-info ms-2 me-3">
              <i class="fas fas fa-shower"></i>
            </div>
            <div class="flex-grow-1">
              <div class="d-flex justify-content-between">
                <span class="fw-semibold">Bathroom</span>
              </div>
              <div class="price-info">
                <strong>2050 Pieces</strong>
                <span class="text-info">+9%</span>
              </div>
              <div class="progress">
                <div class="progress-bar bg-info" style="width: 58%;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Top Categories Tab -->
      <div class="tab-pane fade" id="categories" role="tabpanel">
        <div class="product-progress-list">
          <div class="product-progress-item d-flex align-items-center mb-4">
            <div class="number-badge">1</div>
            <div class="icon-wrapper bg-light-primary text-primary ms-2 me-3">
              <i class="fas fa-couch"></i>
            </div>
            <div class="flex-grow-1">
              <div class="d-flex justify-content-between">
                <span class="fw-semibold">KIVIK Sofa</span>
              </div>
              <div class="price-info">
              <strong>Rp 7,5 JT</strong>
              <span class="text-primary">+33%</span>
              </div>
              <div class="progress">
                <div class="progress-bar bg-primary" style="width: 88%;"></div>
              </div>
            </div>
          </div>
          <div class="product-progress-item d-flex align-items-center mb-4">
            <div class="number-badge">2</div>
            <div class="icon-wrapper bg-light-purple text-purple ms-2 me-3">
              <i class="fas fa-lightbulb"></i>
            </div>
            <div class="flex-grow-1">
              <div class="d-flex justify-content-between">
                <span class="fw-semibold">MALM Bed Frame</span>
              </div>
              <div class="price-info">
              <strong>Rp 10,5 JT</strong>
               <span class="text-purple">+26%</span>
              </div>
              <div class="progress">
                <div class="progress-bar bg-purple" style="width: 76%;"></div>
              </div>
            </div>
          </div>
          <div class="product-progress-item d-flex align-items-center mb-4">
            <div class="number-badge">3</div>
            <div class="icon-wrapper bg-light-success text-success ms-2 me-3">
              <i class="fas fa-blender"></i>
            </div>
            <div class="flex-grow-1">
              <div class="d-flex justify-content-between">
                <span class="fw-semibold">METOD Cabinet</span>
              </div>
              <div class="price-info">
              <strong>Rp 17,5 JT</strong>
              <span class="text-success">+19%</span>
              </div>
              <div class="progress">
                <div class="progress-bar bg-success" style="width: 69%;"></div>
              </div>
            </div>
          </div>
          <div class="product-progress-item d-flex align-items-center">
            <div class="number-badge">4</div>
            <div class="icon-wrapper bg-light-info text-info ms-2 me-3">
              <i class="fas fa-bath"></i>
            </div>
            <div class="flex-grow-1">
              <div class="d-flex justify-content-between">
                <span class="fw-semibold">BROGRUND Shower Set</span>
              </div>
              <div class="price-info">
              <strong>Rp 9,5 JT</strong>
              <span class="text-info">+17%</span>
              </div>
              <div class="progress">
                <div class="progress-bar bg-info" style="width: 60%;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.animated-progress').forEach(function (progress) {
      let percentage = progress.getAttribute('data-percentage');
      let bar = progress.querySelector('.progress-bar');
      setTimeout(() => {
        bar.style.width = percentage + '%';
      }, 300);
    });
  });
</script>


<div class="row mb-4">
  <!-- Ringkasan Penjualan Harian -->
  <div class="col-lg-8">
    <div class="card shadow-sm">
      <div class="card-header d-flex justify-content-between align-items-center gradient-bg">
        <div>
          <h6 class="mb-0 fw-bold">Ringkasan Penjualan Hari Ini / Minggu Ini</h6>
          <small class="text-light">Data real-time dari sistem penjualan</small>
        </div>
        <div>
          <i class="fas fa-chart-line fa-lg text-white"></i>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table mb-0">
            <thead class="bg-info-subtle text-info">
              <tr>
                <th>Ringkasan Harian</th>
                <th>Nilai</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>Jumlah Pesanan Hari Ini</td><td class="fw-bold text-primary">1.236</td></tr>
              <tr><td>Total Pendapatan Hari Ini</td><td class="fw-bold text-success">Rp 1,1 Miliar</td></tr>
              <tr><td>Produk Terlaris Hari Ini</td><td class="fw-bold">KIVIK Sofa</td></tr>
              <tr><td>Kota dengan Pesanan Terbanyak</td><td class="fw-bold">Jakarta</td></tr>
              <tr><td>Channel Terbesar (Offline/Online)</td><td class="fw-bold text-info">Online (58%)</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  <!-- Performance Metrics -->
  <div class="col-lg-4">
    <div class="card p-4">
      <h6 class="fw-bold mb-3">Performance Metrics</h6>

      <div class="mb-3">
        <div class="d-flex justify-content-between">
          <span>Inventory Turnover</span>
          <span class="text-primary">78%</span>
        </div>
        <div class="progress" style="height: 6px;">
          <div class="progress-bar bg-primary" style="width: 78%;"></div>
        </div>
      </div>

      <div class="mb-3">
        <div class="d-flex justify-content-between">
          <span>Customer Retention</span>
          <span class="text-purple">65%</span>
        </div>
        <div class="progress" style="height: 6px;">
          <div class="progress-bar" style="width: 65%; background-color: #a14fd5;"></div>
        </div>
      </div>

      <div class="mb-3">
        <div class="d-flex justify-content-between">
          <span>Store Efficiency</span>
          <span class="text-success">92%</span>
        </div>
        <div class="progress" style="height: 6px;">
          <div class="progress-bar bg-success" style="width: 92%;"></div>
        </div>
      </div>

      <div class="mb-3">
        <div class="d-flex justify-content-between">
          <span>Online Sales Growth</span>
          <span class="text-info">45%</span>
        </div>
        <div class="progress" style="height: 6px;">
          <div class="progress-bar bg-info" style="width: 45%;"></div>
        </div>
      </div>

      <!-- Goal Completion Simple -->
      <div class="goal-simple">
        <h1>75%</h1>
        <p>🎯 Goal Completed</p>
      </div>

    </div>
  </div>
</div>
<!-- IKEA Executive Dashboard End -->


    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/feather.min.js"></script>
    
    <script src="../assets/js/jquery.slimscroll.min.js"></script>

    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap4.min.js"></script>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>

   
    <script src="../assets/js/script.js"></script>
  </body>
</html>
