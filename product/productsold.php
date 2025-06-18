<?php

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

  <style>
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


</style>


  </head>
  <body>
    <div id="global-loader">
      <div class="whirly-loader"></div>
    </div>
    <div class="main-wrapper">
      <div class="header">
        <div class="header-left active">
          <a class="logo" href="index.html">
            <img alt="" src="../assets/img/logo1.png" />
          </a>

          <a href="javascript:void(0);" id="toggle_btn"> </a>
        </div>
        <a class="mobile_btn" href="#sidebar" id="mobile_btn">
          <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
          </span>
        </a>
        <ul class="nav user-menu">
          <li class="nav-item">
            <div class="top-nav-search">
              <a class="responsive-search" href="javascript:void(0);">
                <i class="fa fa-search"></i>
              </a>
              <form action="#">
                <div class="searchinputs">
                  <input placeholder="Search Here ..." type="text" />
                  <div class="search-addon">
                    <span><img alt="img" src="../assets/img/icons/closes.svg" /></span>
                  </div>
                </div>
                <a class="btn" id="searchdiv"><img alt="img" src="../assets/img/icons/search.svg" /></a>
              </form>
            </div>
          </li>
          <li class="nav-item dropdown has-arrow flag-nav">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);" role="button">
              <img alt="" height="20" src="../assets/img/flags/us1.png" />
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="javascript:void(0);"> <img alt="" height="16" src="../assets/img/flags/us.png" /> English </a>
              <a class="dropdown-item" href="javascript:void(0);"> <img alt="" height="16" src="../assets/img/flags/fr.png" /> French </a>
              <a class="dropdown-item" href="javascript:void(0);"> <img alt="" height="16" src="../assets/img/flags/es.png" /> Spanish </a>
              <a class="dropdown-item" href="javascript:void(0);"> <img alt="" height="16" src="../assets/img/flags/de.png" /> German </a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="dropdown-toggle nav-link" data-bs-toggle="dropdown" href="javascript:void(0);"> <img alt="img" src="../assets/img/icons/notification-bing.svg" /> <span class="badge rounded-pill">4</span> </a>
            <div class="dropdown-menu notifications">
              <div class="topnav-dropdown-header">
                <span class="notification-title">Notifications</span>
                <a class="clear-noti" href="javascript:void(0)"> Clear All </a>
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
            <a class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown" href="javascript:void(0);">
              <span class="user-img"><img alt="" src="../assets/img/profiles/avator1.jpg" /> <span class="status online"></span></span>
            </a>
            <div class="dropdown-menu menu-drop-user">
              <div class="profilename">
                <div class="profileset">
                  <span class="user-img"><img alt="" src="../assets/img/profiles/avator1.jpg" /> <span class="status online"></span></span>
                  <div class="profilesets">
                    <h6>John Doe</h6>
                    <h5>Admin</h5>
                  </div>
                </div>
                <hr class="m-0" />
                <a class="dropdown-item" href="../profile.php"> <i class="me-2" data-feather="user"></i> My Profile</a>
                <a class="dropdown-item" href="../generalsettings.php"><i class="me-2" data-feather="settings"></i>Settings</a>
                <hr class="m-0" />
                <a class="dropdown-item logout pb-0" href="../signin.php"><img alt="img" class="me-2" src="../assets/img/icons/log-out.svg" />Logout</a>
              </div>
            </div>
          </li>
        </ul>
        <div class="dropdown mobile-user-menu">
          <a aria-expanded="false" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);"><i class="fa fa-ellipsis-v"></i></a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="../profile.php">My Profile</a>
            <a class="dropdown-item" href="../generalsettings.php">Settings</a>
            <a class="dropdown-item" href="../signin.php">Logout</a>
          </div>
        </div>
      </div>
      <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
          <div class="sidebar-menu" id="sidebar-menu">
            <ul>
              <li>
                <a href="../index.html"><img alt="img" src="../assets/img/icons/dashboard.svg" /><span> Dashboard</span> </a>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img alt="img" src="../assets/img/icons/product.svg" /><span> Product</span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a class="active" href="productsold.php">Product Sold</a></li>
                  <li><a href="productlist.php">Product List</a></li>
                  <li><a href="categorylist.php">Category List</a></li>
                  <li><a href="brandlist.php">Brand List</a></li>            
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img alt="img" src="../assets/img/icons/sales1.svg" /><span> Supplier</span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../suppelier/supplierlist.php">Supplier List</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img alt="img" src="../assets/img/icons/purchase1.svg" /><span> Purchase</span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../purchase/purchaselist.php">Purchase List</a></li>
                  <li><a href="../purchase/addpurchase.php">Add Purchase</a></li>
                  <li><a href="../purchase/importpurchase.php">Import Purchase</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img alt="img" src="../assets/img/icons/expense1.svg" /><span> Expense</span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../expense/expenselist.php">Expense List</a></li>
                  <li><a href="../expense/createexpense.php">Add Expense</a></li>
                  <li><a href="../expense/expensecategory.php">Expense Category</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img alt="img" src="../assets/img/icons/quotation1.svg" /><span> Quotation</span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../quotation/quotationlist.php">Quotation List</a></li>
                  <li><a href="../quotation/addquotation.php">Add Quotation</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img alt="img" src="../assets/img/icons/transfer1.svg" /><span> Inventory</span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../inventory/transferlist.php">Transfer List </a></li>
                  <li><a href="../inventory/suplierreturn.php">Supplier Return </a></li>
                  <li><a href="../inventory/customerreturn.php">Customer Return </a></li>
                </ul>
              </li>
              <li>
                <a href="../components.php"><i data-feather="layers"></i><span> Components</span> </a>
              </li>
              <li>
                <a href="../blankpage.php"><i data-feather="file"></i><span> Blank Page</span> </a>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><i data-feather="alert-octagon"></i> <span> Error Pages </span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../error-404.php">404 Error </a></li>
                  <li><a href="../error-500.php">500 Error </a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><i data-feather="box"></i> <span>Elements </span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../sweetalerts.php">Sweet Alerts</a></li>
                  <li><a href="../tooltip.php">Tooltip</a></li>
                  <li><a href="../popover.php">Popover</a></li>
                  <li><a href="../ribbon.php">Ribbon</a></li>
                  <li><a href="../clipboard.php">Clipboard</a></li>
                  <li><a href="../drag-drop.php">Drag &amp; Drop</a></li>
                  <li><a href="../rangeslider.php">Range Slider</a></li>
                  <li><a href="../rating.php">Rating</a></li>
                  <li><a href="../toastr.php">Toastr</a></li>
                  <li><a href="../text-editor.php">Text Editor</a></li>
                  <li><a href="../counter.php">Counter</a></li>
                  <li><a href="../scrollbar.php">Scrollbar</a></li>
                  <li><a href="../spinner.php">Spinner</a></li>
                  <li><a href="../notification.php">Notification</a></li>
                  <li><a href="../lightbox.php">Lightbox</a></li>
                  <li><a href="../stickynote.php">Sticky Note</a></li>
                  <li><a href="../timeline.php">Timeline</a></li>
                  <li><a href="../form-wizard.php">Form Wizard</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><i data-feather="bar-chart-2"></i> <span> Charts </span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../chart-apex.php">Apex Charts</a></li>
                  <li><a href="../chart-js.php">Chart Js</a></li>
                  <li><a href="../chart-morris.php">Morris Charts</a></li>
                  <li><a href="../chart-flot.php">Flot Charts</a></li>
                  <li><a href="../chart-peity.php">Peity Charts</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><i data-feather="award"></i><span> Icons </span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../icon-fontawesome.php">Fontawesome Icons</a></li>
                  <li><a href="../icon-feather.php">Feather Icons</a></li>
                  <li><a href="../icon-ionic.php">Ionic Icons</a></li>
                  <li><a href="../icon-material.php">Material Icons</a></li>
                  <li><a href="../icon-pe7.php">Pe7 Icons</a></li>
                  <li><a href="../icon-simpleline.php">Simpleline Icons</a></li>
                  <li><a href="../icon-themify.php">Themify Icons</a></li>
                  <li><a href="../icon-weather.php">Weather Icons</a></li>
                  <li><a href="../icon-typicon.php">Typicon Icons</a></li>
                  <li><a href="../icon-flag.php">Flag Icons</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><i data-feather="columns"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../form-basic-inputs.php">Basic Inputs </a></li>
                  <li><a href="../form-input-groups.php">Input Groups </a></li>
                  <li><a href="../form-horizontal.php">Horizontal Form </a></li>
                  <li><a href="../form-vertical.php"> Vertical Form </a></li>
                  <li><a href="../form-mask.php">Form Mask </a></li>
                  <li><a href="../form-validation.php">Form Validation </a></li>
                  <li><a href="../form-select2.php">Form Select2 </a></li>
                  <li><a href="../form-fileupload.php">File Upload </a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><i data-feather="layout"></i> <span> Table </span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../tables-basic.php">Basic Tables </a></li>
                  <li><a href="../data-tables.php">Data Table </a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img alt="img" src="../assets/img/icons/product.svg" /><span> Application</span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../chat.php">Chat</a></li>
                  <li><a href="../calendar.php">Calendar</a></li>
                  <li><a href="../email.php">Email</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img alt="img" src="../assets/img/icons/users1.svg" /><span> People</span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../people/customerlist.php">Customer List</a></li>
                  <li><a href="../people/addcustomer.php">Add Customer </a></li>
                  <li><a href="../people/supplierlist.php">Supplier List</a></li>
                  <li><a href="../people/addsupplier.php">Add Supplier </a></li>
                  <li><a href="../people/userlist.php">User List</a></li>
                  <li><a href="../people/adduser.php">Add User</a></li>
                  <li><a href="../people/storelist.php">Store List</a></li>
                  <li><a href="../people/addstore.php">Add Store</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img alt="img" src="../assets/img/icons/places.svg" /><span> Places</span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../newcountry.php">New Country</a></li>
                  <li><a href="../countrieslist.php">Countries list</a></li>
                  <li><a href="../newstate.php">New State </a></li>
                  <li><a href="../statelist.php">State list</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img alt="img" src="../assets/img/icons/time.svg" /><span> Report</span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../purchaseorderreport.php">Purchase order report</a></li>
                  <li><a href="../inventoryreport.php">Inventory Report</a></li>
                  <li><a href="../salesreport.php">Sales Report</a></li>
                  <li><a href="../invoicereport.php">Invoice Report</a></li>
                  <li><a href="../purchasereport.php">Purchase Report</a></li>
                  <li><a href="../supplierreport.php">Supplier Report</a></li>
                  <li><a href="../customerreport.php">Customer Report</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img alt="img" src="../assets/img/icons/users1.svg" /><span> Users</span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../newuser.php">New User </a></li>
                  <li><a href="../userlists.php">Users List</a></li>
                </ul>
              </li>
              <li class="submenu">
                <a href="javascript:void(0);"><img alt="img" src="../assets/img/icons/settings.svg" /><span> Settings</span> <span class="menu-arrow"></span></a>
                <ul>
                  <li><a href="../generalsettings.php">General Settings</a></li>
                  <li><a href="../emailsettings.php">Email Settings</a></li>
                  <li><a href="../paymentsettings.php">Payment Settings</a></li>
                  <li><a href="../currencysettings.php">Currency Settings</a></li>
                  <li><a href="../grouppermissions.php">Group Permissions</a></li>
                  <li><a href="../taxrates.php">Tax Rates</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>


     <!-- BAGIAN ATAS -->
<div class="page-wrapper">
  <div class="content">

  <div class="page-header">
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
    <!-- BAGIAN ATAS END-->

 <div class="container mt-5">
    <div class="row">
      <!-- Chart Section -->
      <div class="col-md-8">
        <div class="card shadow-sm">
          <div class="card-header ikea-header text-white d-flex justify-content-between align-items-center">
            <div>
              <h5 class="mb-0">Kategori Produk Terjual Terbanyak</h5>
              <small>Pilih Bulan atau Tahun</small>
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

          <div class="card">
            <div class="card-body">
              <div class="table-top">
                <div class="search-set">
                  <div class="search-path">
                    <a class="btn btn-filter" id="filter_search">
                      <img alt="img" src="../assets/img/icons/filter.svg" />
                      <span><img alt="img" src="../assets/img/icons/closes.svg" /></span>
                    </a>
                  </div>
                  <div class="search-input">
                    <a class="btn btn-searchset"><img alt="img" src="../assets/img/icons/search-white.svg" /></a>
                  </div>
                </div>
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


              <div class="card mb-0" id="filter_inputs">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-lg-12 col-sm-12">
                      <div class="row">
                        <div class="col-lg col-sm-6 col-12">
                          <div class="form-group">
                            <select class="select">
                              <option>Choose Product</option>
                              <option>Macbook pro</option>
                              <option>Orange</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg col-sm-6 col-12">
                          <div class="form-group">
                            <select class="select">
                              <option>Choose Category</option>
                              <option>Computers</option>
                              <option>Fruits</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg col-sm-6 col-12">
                          <div class="form-group">
                            <select class="select">
                              <option>Choose Sub Category</option>
                              <option>Computer</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg col-sm-6 col-12">
                          <div class="form-group">
                            <select class="select">
                              <option>Brand</option>
                              <option>N/D</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg col-sm-6 col-12">
                          <div class="form-group">
                            <select class="select">
                              <option>Price</option>
                              <option>150.00</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-1 col-sm-6 col-12">
                          <div class="form-group">
                            <a class="btn btn-filters ms-auto"><img alt="img" src="../assets/img/icons/search-whites.svg" /></a>
                          </div>
                        </div>
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
                          <input id="select-all" type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </th>
                      <th>Product Name</th>
                      <th>SKU</th>
                      <th>Category</th>
                      <th>Brand</th>
                      <th>price</th>
                      <th>Unit</th>
                      <th>Qty</th>
                      <th>Created By</th>
                      <th>Action</th>
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
                      <td class="productimgname">
                        <a class="product-img" href="javascript:void(0);">
                          <img alt="product" src="../assets/img/product/product1.jpg" />
                        </a>
                        <a href="javascript:void(0);">Macbook pro</a>
                      </td>
                      <td>PT001</td>
                      <td>Computers</td>
                      <td>N/D</td>
                      <td>1500.00</td>
                      <td>pc</td>
                      <td>100.00</td>
                      <td>Admin</td>
                      <td>
                        <a class="me-3" href="../product-details.php">
                          <img alt="img" src="../assets/img/icons/eye.svg" />
                        </a>
                        <a class="me-3" href="../editproduct.php">
                          <img alt="img" src="../assets/img/icons/edit.svg" />
                        </a>
                        <a class="confirm-text" href="javascript:void(0);">
                          <img alt="img" src="../assets/img/icons/delete.svg" />
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a class="product-img" href="javascript:void(0);">
                          <img alt="product" src="../assets/img/product/product2.jpg" />
                        </a>
                        <a href="javascript:void(0);">Orange</a>
                      </td>
                      <td>PT002</td>
                      <td>Fruits</td>
                      <td>N/D</td>
                      <td>10.00</td>
                      <td>pc</td>
                      <td>100.00</td>
                      <td>Admin</td>
                      <td>
                        <a class="me-3" href="../product-details.php">
                          <img alt="img" src="../assets/img/icons/eye.svg" />
                        </a>
                        <a class="me-3" href="../editproduct.php">
                          <img alt="img" src="../assets/img/icons/edit.svg" />
                        </a>
                        <a class="confirm-text" href="javascript:void(0);">
                          <img alt="img" src="../assets/img/icons/delete.svg" />
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a class="product-img" href="javascript:void(0);">
                          <img alt="product" src="../assets/img/product/product3.jpg" />
                        </a>
                        <a href="javascript:void(0);">Pineapple</a>
                      </td>
                      <td>PT003</td>
                      <td>Fruits</td>
                      <td>N/D</td>
                      <td>10.00</td>
                      <td>pc</td>
                      <td>100.00</td>
                      <td>Admin</td>
                      <td>
                        <a class="me-3" href="../product-details.php">
                          <img alt="img" src="../assets/img/icons/eye.svg" />
                        </a>
                        <a class="me-3" href="../editproduct.php">
                          <img alt="img" src="../assets/img/icons/edit.svg" />
                        </a>
                        <a class="confirm-text" href="javascript:void(0);">
                          <img alt="img" src="../assets/img/icons/delete.svg" />
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a class="product-img" href="javascript:void(0);">
                          <img alt="product" src="../assets/img/product/product4.jpg" />
                        </a>
                        <a href="javascript:void(0);">Strawberry</a>
                      </td>
                      <td>PT004</td>
                      <td>Fruits</td>
                      <td>N/D</td>
                      <td>10.00</td>
                      <td>pc</td>
                      <td>100.00</td>
                      <td>Admin</td>
                      <td>
                        <a class="me-3" href="../product-details.php">
                          <img alt="img" src="../assets/img/icons/eye.svg" />
                        </a>
                        <a class="me-3" href="../editproduct.php">
                          <img alt="img" src="../assets/img/icons/edit.svg" />
                        </a>
                        <a class="confirm-text" href="javascript:void(0);">
                          <img alt="img" src="../assets/img/icons/delete.svg" />
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a class="product-img" href="javascript:void(0);">
                          <img alt="product" src="../assets/img/product/product5.jpg" />
                        </a>
                        <a href="javascript:void(0);">Avocat</a>
                      </td>
                      <td>PT005</td>
                      <td>Accessories</td>
                      <td>N/D</td>
                      <td>10.00</td>
                      <td>pc</td>
                      <td>150.00</td>
                      <td>Admin</td>
                      <td>
                        <a class="me-3" href="../product-details.php">
                          <img alt="img" src="../assets/img/icons/eye.svg" />
                        </a>
                        <a class="me-3" href="../editproduct.php">
                          <img alt="img" src="../assets/img/icons/edit.svg" />
                        </a>
                        <a class="confirm-text" href="javascript:void(0);">
                          <img alt="img" src="../assets/img/icons/delete.svg" />
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a class="product-img" href="javascript:void(0);">
                          <img alt="product" src="../assets/img/product/product6.jpg" />
                        </a>
                        <a href="javascript:void(0);">Macbook Pro</a>
                      </td>
                      <td>PT006</td>
                      <td>Shoes</td>
                      <td>N/D</td>
                      <td>10.00</td>
                      <td>pc</td>
                      <td>100.00</td>
                      <td>Admin</td>
                      <td>
                        <a class="me-3" href="../product-details.php">
                          <img alt="img" src="../assets/img/icons/eye.svg" />
                        </a>
                        <a class="me-3" href="../editproduct.php">
                          <img alt="img" src="../assets/img/icons/edit.svg" />
                        </a>
                        <a class="confirm-text" href="javascript:void(0);">
                          <img alt="img" src="../assets/img/icons/delete.svg" />
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a class="product-img" href="javascript:void(0);">
                          <img alt="product" src="../assets/img/product/product7.jpg" />
                        </a>
                        <a href="javascript:void(0);">Apple Earpods</a>
                      </td>
                      <td>PT007</td>
                      <td>Shoes</td>
                      <td>N/D</td>
                      <td>10.00</td>
                      <td>pc</td>
                      <td>100.00</td>
                      <td>Admin</td>
                      <td>
                        <a class="me-3" href="../product-details.php">
                          <img alt="img" src="../assets/img/icons/eye.svg" />
                        </a>
                        <a class="me-3" href="../editproduct.php">
                          <img alt="img" src="../assets/img/icons/edit.svg" />
                        </a>
                        <a class="confirm-text" href="javascript:void(0);">
                          <img alt="img" src="../assets/img/icons/delete.svg" />
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a class="product-img" href="javascript:void(0);">
                          <img alt="product" src="../assets/img/product/product8.jpg" />
                        </a>
                        <a href="javascript:void(0);">iPhone 11 </a>
                      </td>
                      <td>PT008</td>
                      <td>Fruits</td>
                      <td>N/D</td>
                      <td>10.00</td>
                      <td>pc</td>
                      <td>100.00</td>
                      <td>Admin</td>
                      <td>
                        <a class="me-3" href="../product-details.php">
                          <img alt="img" src="../assets/img/icons/eye.svg" />
                        </a>
                        <a class="me-3" href="../editproduct.php">
                          <img alt="img" src="../assets/img/icons/edit.svg" />
                        </a>
                        <a class="confirm-text" href="javascript:void(0);">
                          <img alt="img" src="../assets/img/icons/delete.svg" />
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a class="product-img" href="javascript:void(0);">
                          <img alt="product" src="../assets/img/product/product9.jpg" />
                        </a>
                        <a href="javascript:void(0);">samsung </a>
                      </td>
                      <td>PT009</td>
                      <td>Earphones</td>
                      <td>N/D</td>
                      <td>10.00</td>
                      <td>pc</td>
                      <td>100.00</td>
                      <td>Admin</td>
                      <td>
                        <a class="me-3" href="../product-details.php">
                          <img alt="img" src="../assets/img/icons/eye.svg" />
                        </a>
                        <a class="me-3" href="../editproduct.php">
                          <img alt="img" src="../assets/img/icons/edit.svg" />
                        </a>
                        <a class="confirm-text" href="javascript:void(0);">
                          <img alt="img" src="../assets/img/icons/delete.svg" />
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a class="product-img" href="javascript:void(0);">
                          <img alt="product" src="../assets/img/product/product11.jpg" />
                        </a>
                        <a href="javascript:void(0);">Banana</a>
                      </td>
                      <td>PT0010</td>
                      <td>Health Care</td>
                      <td>N/D</td>
                      <td>10.00</td>
                      <td>kg</td>
                      <td>100.00</td>
                      <td>Admin</td>
                      <td>
                        <a class="me-3" href="../product-details.php">
                          <img alt="img" src="../assets/img/icons/eye.svg" />
                        </a>
                        <a class="me-3" href="../editproduct.php">
                          <img alt="img" src="../assets/img/icons/edit.svg" />
                        </a>
                        <a class="confirm-text" href="javascript:void(0);">
                          <img alt="img" src="../assets/img/icons/delete.svg" />
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a class="product-img" href="javascript:void(0);">
                          <img alt="product" src="../assets/img/product/product17.jpg" />
                        </a>
                        <a href="javascript:void(0);">Limon</a>
                      </td>
                      <td>PT0011</td>
                      <td>Health Care</td>
                      <td>N/D</td>
                      <td>10.00</td>
                      <td>kg</td>
                      <td>100.00</td>
                      <td>Admin</td>
                      <td>
                        <a class="me-3" href="../product-details.php">
                          <img alt="img" src="../assets/img/icons/eye.svg" />
                        </a>
                        <a class="me-3" href="../editproduct.php">
                          <img alt="img" src="../assets/img/icons/edit.svg" />
                        </a>
                        <a class="confirm-text" href="javascript:void(0);">
                          <img alt="img" src="../assets/img/icons/delete.svg" />
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
