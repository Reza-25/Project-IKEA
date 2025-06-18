<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<meta name="description" content="POS - Bootstrap Admin Template">
<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
<meta name="author" content="Dreamguys - Bootstrap Admin Template">
<meta name="robots" content="noindex, nofollow">
<title>Dreams Pos admin template</title>

<link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg">

<link rel="stylesheet" href="../assets/css/bootstrap.min.css">

<link rel="stylesheet" href="../assets/css/animate.css">

<link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">

<link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">

<link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div id="global-loader">
<div class="whirly-loader"> </div>
</div>

<div class="main-wrapper">

<div class="header">

<div class="header-left active">
<a href="index.html" class="logo">
<img src="../assets/img/logo1.png" alt="">
</a>
<a id="toggle_btn" href="javascript:void(0);">
</a>
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
<input type="text" placeholder="Search Here ...">
<div class="search-addon">
<span><img src="../assets/img/icons/closes.svg" alt="img"></span>
</div>
</div>
<a class="btn" id="searchdiv"><img src="../assets/img/icons/search.svg" alt="img"></a>
</form>
</div>
</li>


<li class="nav-item dropdown has-arrow flag-nav">
<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);" role="button">
<img src="../assets/img/flags/us1.png" alt="" height="20">
</a>
<div class="dropdown-menu dropdown-menu-right">
<a href="javascript:void(0);" class="dropdown-item">
<img src="../assets/img/flags/us.png" alt="" height="16"> English
</a>
<a href="javascript:void(0);" class="dropdown-item">
<img src="../assets/img/flags/fr.png" alt="" height="16"> French
</a>
<a href="javascript:void(0);" class="dropdown-item">
<img src="../assets/img/flags/es.png" alt="" height="16"> Spanish
</a>
<a href="javascript:void(0);" class="dropdown-item">
<img src="../assets/img/flags/de.png" alt="" height="16"> German
</a>
</div>
</li>


<li class="nav-item dropdown">
<a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
<img src="../assets/img/icons/notification-bing.svg" alt="img"> <span class="badge rounded-pill">4</span>
</a>
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
<img alt="" src="../assets/img/profiles/avatar-02.jpg">
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
<img alt="" src="../assets/img/profiles/avatar-03.jpg">
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
<img alt="" src="../assets/img/profiles/avatar-06.jpg">
</span>
<div class="media-body flex-grow-1">
<p class="noti-details"><span class="noti-title">Misty Tison</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project <span class="noti-title">Doctor available module</span></p>
<p class="noti-time"><span class="notification-time">8 mins ago</span></p>
</div>
</div>
</a>
</li>
<li class="notification-message">
<a href="activities.php">
<div class="media d-flex">
<span class="avatar flex-shrink-0">
<img alt="" src="../assets/img/profiles/avatar-17.jpg">
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
<img alt="" src="../assets/img/profiles/avatar-13.jpg">
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
<span class="user-img"><img src="../assets/img/profiles/avator1.jpg" alt="">
<span class="status online"></span></span>
</a>
<div class="dropdown-menu menu-drop-user">
<div class="profilename">
<div class="profileset">
<span class="user-img"><img src="../assets/img/profiles/avator1.jpg" alt="">
<span class="status online"></span></span>
<div class="profilesets">
<h6>John Doe</h6>
<h5>Admin</h5>
</div>
</div>
<hr class="m-0">
<a class="dropdown-item" href="profile.php"> <i class="me-2" data-feather="user"></i> My Profile</a>
<a class="dropdown-item" href="generalsettings.php"><i class="me-2" data-feather="settings"></i>Settings</a>
<hr class="m-0">
<a class="dropdown-item logout pb-0" href="signin.php"><img src="../assets/img/icons/log-out.svg" class="me-2" alt="img">Logout</a>
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


<div class="sidebar" id="sidebar">
<div class="sidebar-inner slimscroll">
<div id="sidebar-menu" class="sidebar-menu">
<ul>
<li>
<a href="../index.html"><img src="../assets/img/icons/dashboard.svg" alt="img"><span> Dashboard</span> </a>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="../assets/img/icons/product.svg" alt="img"><span> Product</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="../product/productlist.php">Product List</a></li>
<li><a href="../product/categorylist.php">Category List</a></li>
<li><a href="../product/brandlist.php">Brand List</a></li>
</ul>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="../assets/img/icons/sales1.svg" alt="img"><span> Supplier</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="../supplier/supplierlist.php">Supplier List</a></li>
</ul>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="../assets/img/icons/purchase1.svg" alt="img"><span> Purchase</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="../purchase/purchaselist.php">Purchase List</a></li>
<li><a href="../purchase/addpurchase.php">Add Purchase</a></li>
<li><a href="../purchase/importpurchase.php">Import Purchase</a></li>
</ul>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="../assets/img/icons/expense1.svg" alt="img"><span> Expense</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="../expense/expenselist.php">Expense List</a></li>
<li><a href="../expense/createexpense.php">Add Expense</a></li>
<li><a href="../expense/expensecategory.php">Expense Category</a></li>
</ul>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="../assets/img/icons/quotation1.svg" alt="img"><span> Quotation</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="../quotation/quotationlist.php">Quotation List</a></li>
<li><a href="../quotation/addquotation.php">Add Quotation</a></li>
</ul>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="../assets/img/icons/transfer1.svg" alt="img" /><span> Inventory</span> <span class="menu-arrow"></span></a>
                <ul>
                <li><a href="../inventory/transferlist.php">Transfer List </a></li>
                <li><a href="../inventory/suplierreturn.php">Supplier Return </a></li>
                <li><a href="../inventory/customerreturn.php">Customer Return </a></li>
                </ul>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="../assets/img/icons/return1.svg" alt="img"><span> Return</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="../return/salesreturnlists.php">Sales Return List</a></li>
<li><a href="../return/createsalesreturn.php">Add Sales Return </a></li>
<li><a href="../return/purchasereturnlist.php">Purchase Return List</a></li>
<li><a href="../return/createpurchasereturn.php">Add Purchase Return </a></li>
</ul>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="../assets/img/icons/users1.svg" alt="img"><span> People</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="customerlist.php">Customer List</a></li>
<li><a href="supplierlist.php">Supplier List</a></li>
<li><a href="userlist.php">User List</a></li>
<li><a href="storelist.php">Store List</a></li>
</ul>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="../assets/img/icons/places.svg" alt="img"><span> Places</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="../places/newcountry.php">New Country</a></li>
<li><a href="../places/countrieslist.php">Countries list</a></li>
<li><a href="../places/newstate.php">New State </a></li>
<li><a href="../places/statelist.php">State list</a></li>
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
<li><a href="../drag-drop.php">Drag & Drop</a></li>
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
<a href="javascript:void(0);"><img src="../assets/img/icons/product.svg" alt="img"><span> Application</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="../chat.php">Chat</a></li>
<li><a href="../calendar.php">Calendar</a></li>
<li><a href="../email.php">Email</a></li>
</ul>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="../assets/img/icons/time.svg" alt="img"><span> Report</span> <span class="menu-arrow"></span></a>
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
<a href="javascript:void(0);"><img src="../assets/img/icons/users1.svg" alt="img"><span> Users</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="../newuser.php">New User </a></li>
<li><a href="../userlists.php">Users List</a></li>
</ul>
</li>
 <li class="submenu">
<a href="javascript:void(0);"><img src="../assets/img/icons/settings.svg" alt="img"><span> Settings</span> <span class="menu-arrow"></span></a>
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

<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>User List</h4>
<h6>Manage your User</h6>
</div>
<div class="page-btn">
<a href="adduser.php" class="btn btn-added"><img src="../assets/img/icons/plus.svg" alt="img" class="me-2">Add User</a>
</div>
</div>

<!-- KPI Boxes -->
<div class="container py-4">
  <div class="row justify-content-center text-center mb-4">
    <div class="col-md-3 mb-2">
      <div class="card shadow-sm">
        <div class="card-body">
          <h6 class="text-muted">Cabang Terbaik</h6>
          <h4 class="text-primary">Jakarta</h4>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-2">
      <div class="card shadow-sm">
        <div class="card-body">
          <h6 class="text-muted">Karyawan Terbaik</h6>
          <h4 class="text-success">Andi Saputra</h4>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-2">
      <div class="card shadow-sm">
        <div class="card-body">
          <h6 class="text-muted">Total User</h6>
          <h4>87</h4>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-2">
      <div class="card shadow-sm">
        <div class="card-body">
          <h6 class="text-muted">Rata-rata Poin</h6>
          <h4>82.3</h4>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card mt-4">
<div class="card-body">
<div class="table-top">
<div class="search-set">
<div class="search-path">
<a class="btn btn-filter" id="filter_search">
<img src="../assets/img/icons/filter.svg" alt="img">
<span><img src="../assets/img/icons/closes.svg" alt="img"></span>
</a>
</div>
<div class="search-input">
<a class="btn btn-searchset">
<img src="../assets/img/icons/search-white.svg" alt="img">
</a>
</div>
</div>
<div class="wordset">
<ul>
<li>
<a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="../assets/img/icons/pdf.svg" alt="img"></a>
</li>
<li>
<a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="../assets/img/icons/excel.svg" alt="img"></a>
</li>
<li>
<a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="../assets/img/icons/printer.svg" alt="img"></a>
</li>
</ul>
</div>
</div>

<div class="card" id="filter_inputs">
<div class="card-body pb-0">
<div class="row">
<div class="col-lg-2 col-sm-6 col-12">
<div class="form-group">
<input type="text" placeholder="Enter User Name">
</div>
</div>
<div class="col-lg-2 col-sm-6 col-12">
<div class="form-group">
<input type="text" placeholder="Enter Phone">
</div>
</div>
<div class="col-lg-2 col-sm-6 col-12">
<div class="form-group">
<input type="text" placeholder="Enter Email">
</div>
</div>
<div class="col-lg-2 col-sm-6 col-12">
<div class="form-group">
<select class="select">
<option>Disable</option>
<option>Enable</option>
</select>
</div>
</div>
<div class="col-lg-1 col-sm-6 col-12 ms-auto">
<div class="form-group">
<a class="btn btn-filters ms-auto"><img src="../assets/img/icons/search-whites.svg" alt="img"></a>
</div>
</div>
</div>
</div>
</div>

<!-- List Evaluasi Karyawan IKEA -->
<div class="row justify-content-center">
  <div class="col-md-10">
    <!-- ITEM 1 -->
    <div class="card mb-3 shadow-sm">
      <div class="card-body">
        <h5 class="mb-1">Andi Saputra</h5>
        <p class="text-muted mb-2">Sales Associate - Jakarta</p>
        <div class="row mb-2 small">
          <div class="col-4">Kehadiran</div>
          <div class="col-4">Pelayanan</div>
          <div class="col-4">Penyelesaian Tugas</div>
        </div>
        <div class="row align-items-center mb-2">
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 98%">98%</div></div></div>
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 90%">90%</div></div></div>
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 95%">95%</div></div></div>
        </div>
        <div class="text-end">
          <span class="badge bg-success fs-6">94 <i class="bi bi-arrow-up"></i> +3%</span>
        </div>
      </div>
    </div>

    <!-- ITEM 2 -->
    <div class="card mb-3 shadow-sm">
      <div class="card-body">
        <h5 class="mb-1">Rina Pramesti</h5>
        <p class="text-muted mb-2">Customer Service - Bandung</p>
        <div class="row mb-2 small">
          <div class="col-4">Kehadiran</div>
          <div class="col-4">Pelayanan</div>
          <div class="col-4">Penyelesaian Tugas</div>
        </div>
        <div class="row align-items-center mb-2">
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 95%">95%</div></div></div>
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 88%">88%</div></div></div>
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 91%">91%</div></div></div>
        </div>
        <div class="text-end">
          <span class="badge bg-success fs-6">91 <i class="bi bi-arrow-up"></i> +2%</span>
        </div>
      </div>
    </div>

    <!-- ITEM 3 -->
    <div class="card mb-3 shadow-sm">
      <div class="card-body">
        <h5 class="mb-1">Dimas Wahyu</h5>
        <p class="text-muted mb-2">Warehouse Staff - Surabaya</p>
        <div class="row mb-2 small">
          <div class="col-4">Kehadiran</div>
          <div class="col-4">Pelayanan</div>
          <div class="col-4">Penyelesaian Tugas</div>
        </div>
        <div class="row align-items-center mb-2">
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 92%">92%</div></div></div>
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 85%">85%</div></div></div>
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 88%">88%</div></div></div>
        </div>
        <div class="text-end">
          <span class="badge bg-success fs-6">88 <i class="bi bi-arrow-up"></i> +1%</span>
        </div>
      </div>
    </div>

    <!-- ITEM 4 -->
    <div class="card mb-3 shadow-sm">
      <div class="card-body">
        <h5 class="mb-1">Siska Lestari</h5>
        <p class="text-muted mb-2">Cashier - Bekasi</p>
        <div class="row mb-2 small">
          <div class="col-4">Kehadiran</div>
          <div class="col-4">Pelayanan</div>
          <div class="col-4">Penyelesaian Tugas</div>
        </div>
        <div class="row align-items-center mb-2">
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 90%">90%</div></div></div>
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 80%">80%</div></div></div>
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 84%">84%</div></div></div>
        </div>
        <div class="text-end">
          <span class="badge bg-danger fs-6">84 <i class="bi bi-arrow-down"></i> -1%</span>
        </div>
      </div>
    </div>

    <!-- ITEM 5 -->
    <div class="card mb-3 shadow-sm">
      <div class="card-body">
        <h5 class="mb-1">Yudha Hermawan</h5>
        <p class="text-muted mb-2">Delivery Driver - Tangerang</p>
        <div class="row mb-2 small">
          <div class="col-4">Kehadiran</div>
          <div class="col-4">Pelayanan</div>
          <div class="col-4">Penyelesaian Tugas</div>
        </div>
        <div class="row align-items-center mb-2">
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 88%">88%</div></div></div>
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 78%">78%</div></div></div>
          <div class="col-4"><div class="progress"><div class="progress-bar bg-primary" style="width: 80%">80%</div></div></div>
        </div>
        <div class="text-end">
          <span class="badge bg-danger fs-6">80 <i class="bi bi-arrow-down"></i> -2%</span>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="showpayment" tabindex="-1" aria-labelledby="showpayment" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Show Payments</h5>
<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">
<div class="table-responsive">
<table class="table">
<thead>
<tr>
<th>Date</th>
<th>Reference</th>
<th>Amount	</th>
<th>Paid By	</th>
<th>Paid By	</th>
</tr>
</thead>
<tbody>
<tr class="bor-b1">
<td>2022-03-07	</td>
<td>INV/SL0101</td>
<td>$ 1500.00	</td>
<td>Cash</td>
<td>
<a class="me-2" href="javascript:void(0);">
<img src="../assets/img/icons/printer.svg" alt="img">
</a>
<a class="me-2" href="javascript:void(0);" data-bs-target="#editpayment" data-bs-toggle="modal" data-bs-dismiss="modal">
<img src="../assets/img/icons/edit.svg" alt="img">
</a>
<a class="me-2 confirm-text" href="javascript:void(0);">
<img src="../assets/img/icons/delete.svg" alt="img">
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


<div class="modal fade" id="createpayment" tabindex="-1" aria-labelledby="createpayment" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Create Payment</h5>
<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">
<div class="row">
<div class="col-lg-6 col-sm-12 col-12">
<div class="form-group">
<label>Customer</label>
<div class="input-group">
<input type="text" value="2022-03-07" class="datetimepicker">
<a class="scanner-set input-group-text">
<img src="../assets/img/icons/datepicker.svg" alt="img">
</a>
</div>
</div>
</div>
<div class="col-lg-6 col-sm-12 col-12">
<div class="form-group">
<label>Reference</label>
<input type="text" value="INV/SL0101">
</div>
</div>
<div class="col-lg-6 col-sm-12 col-12">
<div class="form-group">
<label>Received Amount</label>
<input type="text" value="1500.00">
</div>
</div>
<div class="col-lg-6 col-sm-12 col-12">
<div class="form-group">
<label>Paying Amount</label>
<input type="text" value="1500.00">
</div>
</div>
<div class="col-lg-6 col-sm-12 col-12">
<div class="form-group">
<label>Payment type</label>
<select class="select">
<option>Cash</option>
<option>Online</option>
<option>Inprogress</option>
</select>
</div>
</div>
<div class="col-lg-12">
<div class="form-group">
<label>Note</label>
<textarea class="form-control"></textarea>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-submit">Submit</button>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>


<div class="modal fade" id="editpayment" tabindex="-1" aria-labelledby="editpayment" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Edit Payment</h5>
<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">
<div class="row">
<div class="col-lg-6 col-sm-12 col-12">
<div class="form-group">
<label>Customer</label>
<div class="input-group">
<input type="text" value="2022-03-07" class="datetimepicker">
<a class="scanner-set input-group-text">
<img src="../assets/img/icons/datepicker.svg" alt="img">
</a>
</div>
</div>
</div>
<div class="col-lg-6 col-sm-12 col-12">
<div class="form-group">
<label>Reference</label>
<input type="text" value="INV/SL0101">
</div>
</div>
<div class="col-lg-6 col-sm-12 col-12">
<div class="form-group">
<label>Received Amount</label>
<input type="text" value="1500.00">
</div>
</div>
<div class="col-lg-6 col-sm-12 col-12">
<div class="form-group">
<label>Paying Amount</label>
<input type="text" value="1500.00">
</div>
</div>
<div class="col-lg-6 col-sm-12 col-12">
<div class="form-group">
<label>Payment type</label>
<select class="select">
<option>Cash</option>
<option>Online</option>
<option>Inprogress</option>
</select>
</div>
</div>
<div class="col-lg-12">
<div class="form-group">
<label>Note</label>
<textarea class="form-control"></textarea>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-submit">Submit</button>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>


<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="../assets/js/jquery-3.6.0.min.js"></script>

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
</body>
</html>