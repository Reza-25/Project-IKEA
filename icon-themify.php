<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<meta name="description" content="POS - Bootstrap Admin Template">
<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
<meta name="author" content="Dreamguys - Bootstrap Admin Template">
<meta name="robots" content="noindex, nofollow">
<title>Dreams Pos admin template</title>

<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.jpg">

<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/css/animate.css">

<link rel="stylesheet" href="assets/plugins/icons/themify/themify.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div id="global-loader">
<div class="whirly-loader"> </div>
</div>

<div class="main-wrapper">

<div class="header">

<div class="header-left active">
<a href="index.php" class="logo">
<img src="assets/img/logo.png" alt="">
</a>
<a href="index.php" class="logo-small">
<img src="assets/img/logo-small.png" alt="">
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
<span><img src="assets/img/icons/closes.svg" alt="img"></span>
</div>
</div>
<a class="btn" id="searchdiv"><img src="assets/img/icons/search.svg" alt="img"></a>
</form>
</div>
</li>


<li class="nav-item dropdown has-arrow flag-nav">
<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);" role="button">
<img src="assets/img/flags/us1.png" alt="" height="20">
</a>
<div class="dropdown-menu dropdown-menu-right">
<a href="javascript:void(0);" class="dropdown-item">
<img src="assets/img/flags/us.png" alt="" height="16"> English
</a>
<a href="javascript:void(0);" class="dropdown-item">
<img src="assets/img/flags/fr.png" alt="" height="16"> French
</a>
<a href="javascript:void(0);" class="dropdown-item">
<img src="assets/img/flags/es.png" alt="" height="16"> Spanish
</a>
<a href="javascript:void(0);" class="dropdown-item">
<img src="assets/img/flags/de.png" alt="" height="16"> German
</a>
</div>
</li>


<li class="nav-item dropdown">
<a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
<img src="assets/img/icons/notification-bing.svg" alt="img"> <span class="badge rounded-pill">4</span>
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
<img alt="" src="assets/img/profiles/avatar-02.jpg">
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
<img alt="" src="assets/img/profiles/avatar-03.jpg">
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
<img alt="" src="assets/img/profiles/avatar-06.jpg">
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
<img alt="" src="assets/img/profiles/avatar-17.jpg">
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
<img alt="" src="assets/img/profiles/avatar-13.jpg">
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
<span class="user-img"><img src="assets/img/profiles/avator1.jpg" alt="">
<span class="status online"></span></span>
</a>
<div class="dropdown-menu menu-drop-user">
<div class="profilename">
 <div class="profileset">
<span class="user-img"><img src="assets/img/profiles/avator1.jpg" alt="">
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
<a class="dropdown-item logout pb-0" href="signin.php"><img src="assets/img/icons/log-out.svg" class="me-2" alt="img">Logout</a>
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
<a href="index.php"><img src="assets/img/icons/dashboard.svg" alt="img"><span> Dashboard</span> </a>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="assets/img/icons/product.svg" alt="img"><span> Product</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="productlist.php">Product List</a></li>
<li><a href="addproduct.php">Add Product</a></li>
<li><a href="categorylist.php">Category List</a></li>
<li><a href="addcategory.php">Add Category</a></li>
<li><a href="subcategorylist.php">Sub Category List</a></li>
<li><a href="subaddcategory.php">Add Sub Category</a></li>
<li><a href="brandlist.php">Brand List</a></li>
<li><a href="addbrand.php">Add Brand</a></li>
<li><a href="importproduct.php">Import Products</a></li>
<li><a href="barcode.php">Print Barcode</a></li>
</ul>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="assets/img/icons/sales1.svg" alt="img"><span> Sales</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="saleslist.php">Sales List</a></li>
<li><a href="pos.php">POS</a></li>
<li><a href="pos.php">New Sales</a></li>
<li><a href="salesreturnlists.php">Sales Return List</a></li>
<li><a href="createsalesreturns.php">New Sales Return</a></li>
</ul>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="assets/img/icons/purchase1.svg" alt="img"><span> Purchase</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="purchaselist.php">Purchase List</a></li>
<li><a href="addpurchase.php">Add Purchase</a></li>
<li><a href="importpurchase.php">Import Purchase</a></li>
</ul>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="assets/img/icons/expense1.svg" alt="img"><span> Expense</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="expenselist.php">Expense List</a></li>
<li><a href="createexpense.php">Add Expense</a></li>
<li><a href="expensecategory.php">Expense Category</a></li>
</ul>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="assets/img/icons/quotation1.svg" alt="img"><span> Quotation</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="quotationList.php">Quotation List</a></li>
<li><a href="addquotation.php">Add Quotation</a></li>
</ul>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="assets/img/icons/transfer1.svg" alt="img"><span> Transfer</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="transferlist.php">Transfer List</a></li>
<li><a href="addtransfer.php">Add Transfer </a></li>
<li><a href="importtransfer.php">Import Transfer </a></li>
</ul>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="assets/img/icons/return1.svg" alt="img"><span> Return</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="salesreturnlist.php">Sales Return List</a></li>
<li><a href="createsalesreturn.php">Add Sales Return </a></li>
<li><a href="purchasereturnlist.php">Purchase Return List</a></li>
<li><a href="createpurchasereturn.php">Add Purchase Return </a></li>
</ul>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="assets/img/icons/users1.svg" alt="img"><span> People</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="customerlist.php">Customer List</a></li>
<li><a href="addcustomer.php">Add Customer </a></li>
<li><a href="supplierlist.php">Supplier List</a></li>
<li><a href="addsupplier.php">Add Supplier </a></li>
<li><a href="userlist.php">User List</a></li>
<li><a href="adduser.php">Add User</a></li>
<li><a href="storelist.php">Store List</a></li>
 <li><a href="addstore.php">Add Store</a></li>
</ul>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="assets/img/icons/places.svg" alt="img"><span> Places</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="newcountry.php">New Country</a></li>
<li><a href="countrieslist.php">Countries list</a></li>
<li><a href="newstate.php">New State </a></li>
<li><a href="statelist.php">State list</a></li>
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
<li><a href="icon-themify.php" class="active">Themify Icons</a></li>
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
<a href="javascript:void(0);"><img src="assets/img/icons/product.svg" alt="img"><span> Application</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="chat.php">Chat</a></li>
<li><a href="calendar.php">Calendar</a></li>
<li><a href="email.php">Email</a></li>
</ul>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="assets/img/icons/time.svg" alt="img"><span> Report</span> <span class="menu-arrow"></span></a>
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
<a href="javascript:void(0);"><img src="assets/img/icons/users1.svg" alt="img"><span> Users</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="newuser.php">New User </a></li>
<li><a href="userlists.php">Users List</a></li>
</ul>
</li>
<li class="submenu">
<a href="javascript:void(0);"><img src="assets/img/icons/settings.svg" alt="img"><span> Settings</span> <span class="menu-arrow"></span></a>
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

<div class="page-wrapper cardhead">
<div class="content container-fluid">

<div class="page-header">
<div class="row">
<div class="col-sm-12">
<h3 class="page-title">Themify Icon</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
<li class="breadcrumb-item active">Themify Icon</li>
</ul>
</div>
</div>
</div>

<div class="row">

<div class="col-md-12">
<div class="card">
<div class="card-header">
<div class="card-title">Themify Icon</div>
</div>
<div class="card-body">
<div class="icons-items">
<ul class="icons-list">
<li><i class="ti-arrow-up" data-bs-toggle="tooltip" title="ti-arrow-up"></i></li>
<li><i class="ti-arrow-right" data-bs-toggle="tooltip" title="ti-arrow-right"></i></li>
<li><i class="ti-arrow-left" data-bs-toggle="tooltip" title="ti-arrow-left"></i></li>
<li><i class="ti-arrow-down" data-bs-toggle="tooltip" title="ti-arrow-down"></i></li>
<li><i class="ti-arrows-vertical" data-bs-toggle="tooltip" title="ti-arrows-vertical"></i></li>
<li><i class="ti-arrows-horizontal" data-bs-toggle="tooltip" title="ti-arrows-horizontal"></i></li>
<li><i class="ti-angle-up" data-bs-toggle="tooltip" title="ti-angle-up"></i></li>
<li><i class="ti-angle-right" data-bs-toggle="tooltip" title="ti-angle-right"></i></li>
<li><i class="ti-angle-left" data-bs-toggle="tooltip" title="ti-angle-left"></i></li>
<li><i class="ti-angle-down" data-bs-toggle="tooltip" title="ti-angle-down"></i></li>
<li><i class="ti-angle-double-up" data-bs-toggle="tooltip" title="ti-angle-double-up"></i></li>
<li><i class="ti-angle-double-right" data-bs-toggle="tooltip" title="ti-angle-double-right"></i></li>
<li><i class="ti-angle-double-left" data-bs-toggle="tooltip" title="ti-angle-double-left"></i></li>
<li><i class="ti-angle-double-down" data-bs-toggle="tooltip" title="ti-angle-double-down"></i></li>
<li><i class="ti-move" data-bs-toggle="tooltip" title="ti-move"></i></li>
<li><i class="ti-fullscreen" data-bs-toggle="tooltip" title="ti-fullscreen"></i></li>
<li><i class="ti-arrow-top-right" data-bs-toggle="tooltip" title="ti-arrow-top-right"></i></li>
<li><i class="ti-arrow-top-left" data-bs-toggle="tooltip" title="ti-arrow-top-left"></i></li>
<li><i class="ti-arrow-circle-up" data-bs-toggle="tooltip" title="ti-arrow-circle-up"></i></li>
<li><i class="ti-arrow-circle-right" data-bs-toggle="tooltip" title="ti-arrow-circle-right"></i></li>
<li><i class="ti-arrow-circle-left" data-bs-toggle="tooltip" title="ti-arrow-circle-left"></i></li>
<li><i class="ti-arrow-circle-down" data-bs-toggle="tooltip" title="ti-arrow-circle-down"></i></li>
<li><i class="ti-arrows-corner" data-bs-toggle="tooltip" title="ti-arrows-corner"></i></li>
<li><i class="ti-split-v" data-bs-toggle="tooltip" title="ti-split-v"></i></li>
<li><i class="ti-split-v-alt" data-bs-toggle="tooltip" title="ti-split-v-alt"></i></li>
<li><i class="ti-split-h" data-bs-toggle="tooltip" title="ti-split-h"></i></li>
<li><i class="ti-hand-point-up" data-bs-toggle="tooltip" title="ti-hand-point-up"></i></li>
<li><i class="ti-hand-point-right" data-bs-toggle="tooltip" title="ti-hand-point-right"></i></li>
<li><i class="ti-hand-point-left" data-bs-toggle="tooltip" title="ti-hand-point-left"></i></li>
<li><i class="ti-hand-point-down" data-bs-toggle="tooltip" title="ti-hand-point-down"></i></li>
<li><i class="ti-back-right" data-bs-toggle="tooltip" title="ti-back-right"></i></li>
<li><i class="ti-back-left" data-bs-toggle="tooltip" title="ti-back-left"></i></li>
<li><i class="ti-exchange-vertical" data-bs-toggle="tooltip" title="ti-exchange-vertical"></i></li>
<li><i class="ti-wand" data-bs-toggle="tooltip" title="ti-wand"></i></li>
<li><i class="ti-save" data-bs-toggle="tooltip" title="ti-save"></i></li>
<li><i class="ti-save-alt" data-bs-toggle="tooltip" title="ti-save-alt"></i></li>
<li><i class="ti-direction" data-bs-toggle="tooltip" title="ti-direction"></i></li>
<li><i class="ti-direction-alt" data-bs-toggle="tooltip" title="ti-direction-alt"></i></li>
<li><i class="ti-user" data-bs-toggle="tooltip" title="ti-user"></i></li>
<li><i class="ti-link" data-bs-toggle="tooltip" title="ti-link"></i></li>
<li><i class="ti-unlink" data-bs-toggle="tooltip" title="ti-unlink"></i></li>
<li><i class="ti-trash" data-bs-toggle="tooltip" title="ti-trash"></i></li>
<li><i class="ti-target" data-bs-toggle="tooltip" title="ti-target"></i></li>
<li><i class="ti-tag" data-bs-toggle="tooltip" title="ti-tag"></i></li>
<li><i class="ti-desktop" data-bs-toggle="tooltip" title="ti-desktop"></i></li>
<li><i class="ti-tablet" data-bs-toggle="tooltip" title="ti-tablet"></i></li>
<li><i class="ti-mobile" data-bs-toggle="tooltip" title="ti-mobile"></i></li>
<li><i class="ti-email" data-bs-toggle="tooltip" title="ti-email"></i></li>
<li><i class="ti-star" data-bs-toggle="tooltip" title="ti-star"></i></li>
<li><i class="ti-spray" data-bs-toggle="tooltip" title="ti-spray"></i></li>
<li><i class="ti-signal" data-bs-toggle="tooltip" title="ti-signal"></i></li>
<li><i class="ti-shopping-cart" data-bs-toggle="tooltip" title="ti-shopping-cart"></i></li>
<li><i class="ti-shopping-cart-full" data-bs-toggle="tooltip" title="ti-shopping-cart-full"></i></li>
<li><i class="ti-settings" data-bs-toggle="tooltip" title="ti-settings"></i></li>
<li><i class="ti-search" data-bs-toggle="tooltip" title="ti-search"></i></li>
<li><i class="ti-zoom-in" data-bs-toggle="tooltip" title="ti-zoom-in"></i></li>
<li><i class="ti-zoom-out" data-bs-toggle="tooltip" title="ti-zoom-out"></i></li>
<li><i class="ti-cut" data-bs-toggle="tooltip" title="ti-cut"></i></li>
<li><i class="ti-ruler" data-bs-toggle="tooltip" title="ti-ruler"></i></li>
<li><i class="ti-ruler-alt-2" data-bs-toggle="tooltip" title="ti-ruler-alt-2"></i></li>
<li><i class="ti-ruler-pencil" data-bs-toggle="tooltip" title="ti-ruler-pencil"></i></li>
<li><i class="ti-ruler-alt" data-bs-toggle="tooltip" title="ti-ruler-alt"></i></li>
<li><i class="ti-bookmark" data-bs-toggle="tooltip" title="ti-bookmark"></i></li>
<li><i class="ti-bookmark-alt" data-bs-toggle="tooltip" title="ti-bookmark-alt"></i></li>
<li><i class="ti-reload" data-bs-toggle="tooltip" title="ti-reload"></i></li>
<li><i class="ti-plus" data-bs-toggle="tooltip" title="ti-plus"></i></li>
<li><i class="ti-minus" data-bs-toggle="tooltip" title="ti-minus"></i></li>
<li><i class="ti-close" data-bs-toggle="tooltip" title="ti-close"></i></li>
<li><i class="ti-pin" data-bs-toggle="tooltip" title="ti-pin"></i></li>
<li><i class="ti-pencil" data-bs-toggle="tooltip" title="ti-pencil"></i></li>
<li><i class="ti-pencil-alt" data-bs-toggle="tooltip" title="ti-pencil-alt"></i></li>
<li><i class="ti-paint-roller" data-bs-toggle="tooltip" title="ti-paint-roller"></i></li>
<li><i class="ti-paint-bucket" data-bs-toggle="tooltip" title="ti-paint-bucket"></i></li>
<li><i class="ti-na" data-bs-toggle="tooltip" title="ti-na"></i></li>
<li><i class="ti-medall" data-bs-toggle="tooltip" title="ti-medall"></i></li>
<li><i class="ti-medall-alt" data-bs-toggle="tooltip" title="ti-medall-alt"></i></li>
<li><i class="ti-marker" data-bs-toggle="tooltip" title="ti-marker"></i></li>
<li><i class="ti-marker-alt" data-bs-toggle="tooltip" title="ti-marker-alt"></i></li>
<li><i class="ti-lock" data-bs-toggle="tooltip" title="ti-lock"></i></li>
<li><i class="ti-unlock" data-bs-toggle="tooltip" title="ti-unlock"></i></li>
<li><i class="ti-location-arrow" data-bs-toggle="tooltip" title="ti-location-arrow"></i></li>
<li><i class="ti-layout" data-bs-toggle="tooltip" title="ti-layout"></i></li>
<li><i class="ti-layers" data-bs-toggle="tooltip" title="ti-layers"></i></li>
<li><i class="ti-layers-alt" data-bs-toggle="tooltip" title="ti-layers-alt"></i></li>
<li><i class="ti-key" data-bs-toggle="tooltip" title="ti-key"></i></li>
<li><i class="ti-image" data-bs-toggle="tooltip" title="ti-image"></i></li>
<li><i class="ti-heart" data-bs-toggle="tooltip" title="ti-heart"></i></li>
<li><i class="ti-heart-broken" data-bs-toggle="tooltip" title="ti-heart-broken"></i></li>
<li><i class="ti-hand-stop" data-bs-toggle="tooltip" title="ti-hand-stop"></i></li>
<li><i class="ti-hand-open" data-bs-toggle="tooltip" title="ti-hand-open"></i></li>
<li><i class="ti-hand-drag" data-bs-toggle="tooltip" title="ti-hand-drag"></i></li>
<li><i class="ti-flag" data-bs-toggle="tooltip" title="ti-flag"></i></li>
<li><i class="ti-flag-alt" data-bs-toggle="tooltip" title="ti-flag-alt"></i></li>
<li><i class="ti-flag-alt-2" data-bs-toggle="tooltip" title="ti-flag-alt-2"></i></li>
<li><i class="ti-eye" data-bs-toggle="tooltip" title="ti-eye"></i></li>
<li><i class="ti-import" data-bs-toggle="tooltip" title="ti-import"></i></li>
<li><i class="ti-export" data-bs-toggle="tooltip" title="ti-export"></i></li>
<li><i class="ti-cup" data-bs-toggle="tooltip" title="ti-cup"></i></li>
<li><i class="ti-crown" data-bs-toggle="tooltip" title="ti-crown"></i></li>
<li><i class="ti-comments" data-bs-toggle="tooltip" title="ti-comments"></i></li>
<li><i class="ti-comment" data-bs-toggle="tooltip" title="ti-comment"></i></li>
<li><i class="ti-comment-alt" data-bs-toggle="tooltip" title="ti-comment-alt"></i></li>
<li><i class="ti-thought" data-bs-toggle="tooltip" title="ti-thought"></i></li>
<li><i class="ti-clip" data-bs-toggle="tooltip" title="ti-clip"></i></li>
<li><i class="ti-check" data-bs-toggle="tooltip" title="ti-check"></i></li>
<li><i class="ti-check-box" data-bs-toggle="tooltip" title="ti-check-box"></i></li>
<li><i class="ti-camera" data-bs-toggle="tooltip" title="ti-camera"></i></li>
<li><i class="ti-announcement" data-bs-toggle="tooltip" title="ti-announcement"></i></li>
<li><i class="ti-brush" data-bs-toggle="tooltip" title="ti-brush"></i></li>
<li><i class="ti-brush-alt" data-bs-toggle="tooltip" title="ti-brush-alt"></i></li>
<li><i class="ti-palette" data-bs-toggle="tooltip" title="ti-palette"></i></li>
<li><i class="ti-briefcase" data-bs-toggle="tooltip" title="ti-briefcase"></i></li>
<li><i class="ti-bolt" data-bs-toggle="tooltip" title="ti-bolt"></i></li>
<li><i class="ti-bolt-alt" data-bs-toggle="tooltip" title="ti-bolt-alt"></i></li>
<li><i class="ti-blackboard" data-bs-toggle="tooltip" title="ti-blackboard"></i></li>
<li><i class="ti-bag" data-bs-toggle="tooltip" title="ti-bag"></i></li>
<li><i class="ti-world" data-bs-toggle="tooltip" title="ti-world"></i></li>
<li><i class="ti-wheelchair" data-bs-toggle="tooltip" title="ti-wheelchair"></i></li>
<li><i class="ti-car" data-bs-toggle="tooltip" title="ti-car"></i></li>
<li><i class="ti-truck" data-bs-toggle="tooltip" title="ti-truck"></i></li>
<li><i class="ti-timer" data-bs-toggle="tooltip" title="ti-timer"></i></li>
<li><i class="ti-ticket" data-bs-toggle="tooltip" title="ti-ticket"></i></li>
<li><i class="ti-thumb-up" data-bs-toggle="tooltip" title="ti-thumb-up"></i></li>
<li><i class="ti-thumb-down" data-bs-toggle="tooltip" title="ti-thumb-down"></i></li>
<li><i class="ti-stats-up" data-bs-toggle="tooltip" title="ti-stats-up"></i></li>
<li><i class="ti-stats-down" data-bs-toggle="tooltip" title="ti-stats-down"></i></li>
<li><i class="ti-shine" data-bs-toggle="tooltip" title="ti-shine"></i></li>
<li><i class="ti-shift-right" data-bs-toggle="tooltip" title="ti-shift-right"></i></li>
<li><i class="ti-shift-left" data-bs-toggle="tooltip" title="ti-shift-left"></i></li>
<li><i class="ti-shift-right-alt" data-bs-toggle="tooltip" title="ti-shift-right-alt"></i></li>
<li><i class="ti-shift-left-alt" data-bs-toggle="tooltip" title="ti-shift-left-alt"></i></li>
<li><i class="ti-shield" data-bs-toggle="tooltip" title="ti-shield"></i></li>
<li><i class="ti-notepad" data-bs-toggle="tooltip" title="ti-notepad"></i></li>
<li><i class="ti-server" data-bs-toggle="tooltip" title="ti-server"></i></li>
<li><i class="ti-pulse" data-bs-toggle="tooltip" title="ti-pulse"></i></li>
<li><i class="ti-printer" data-bs-toggle="tooltip" title="ti-printer"></i></li>
<li><i class="ti-power-off" data-bs-toggle="tooltip" title="ti-power-off"></i></li>
<li><i class="ti-plug" data-bs-toggle="tooltip" title="ti-plug"></i></li>
<li><i class="ti-pie-chart" data-bs-toggle="tooltip" title="ti-pie-chart"></i></li>
<li><i class="ti-panel" data-bs-toggle="tooltip" title="ti-panel"></i></li>
<li><i class="ti-package" data-bs-toggle="tooltip" title="ti-package"></i></li>
<li><i class="ti-music" data-bs-toggle="tooltip" title="ti-music"></i></li>
<li><i class="ti-music-alt" data-bs-toggle="tooltip" title="ti-music-alt"></i></li>
<li><i class="ti-mouse" data-bs-toggle="tooltip" title="ti-mouse"></i></li>
<li><i class="ti-mouse-alt" data-bs-toggle="tooltip" title="ti-mouse-alt"></i></li>
<li><i class="ti-money" data-bs-toggle="tooltip" title="ti-money"></i></li>
<li><i class="ti-microphone" data-bs-toggle="tooltip" title="ti-microphone"></i></li>
<li><i class="ti-menu" data-bs-toggle="tooltip" title="ti-menu"></i></li>
<li><i class="ti-menu-alt" data-bs-toggle="tooltip" title="ti-menu-alt"></i></li>
<li><i class="ti-map" data-bs-toggle="tooltip" title="ti-map"></i></li>
<li><i class="ti-map-alt" data-bs-toggle="tooltip" title="ti-map-alt"></i></li>
<li><i class="ti-location-pin" data-bs-toggle="tooltip" title="ti-location-pin"></i></li>
<li><i class="ti-light-bulb" data-bs-toggle="tooltip" title="ti-light-bulb"></i></li>
<li><i class="ti-info" data-bs-toggle="tooltip" title="ti-info"></i></li>
<li><i class="ti-infinite" data-bs-toggle="tooltip" title="ti-infinite"></i></li>
<li><i class="ti-id-badge" data-bs-toggle="tooltip" title="ti-id-badge"></i></li>
<li><i class="ti-hummer" data-bs-toggle="tooltip" title="ti-hummer"></i></li>
<li><i class="ti-home" data-bs-toggle="tooltip" title="ti-home"></i></li>
<li><i class="ti-help" data-bs-toggle="tooltip" title="ti-help"></i></li>
<li><i class="ti-headphone" data-bs-toggle="tooltip" title="ti-headphone"></i></li>
<li><i class="ti-harddrives" data-bs-toggle="tooltip" title="ti-harddrives"></i></li>
<li><i class="ti-harddrive" data-bs-toggle="tooltip" title="ti-harddrive"></i></li>
<li><i class="ti-gift" data-bs-toggle="tooltip" title="ti-gift"></i></li>
<li><i class="ti-game" data-bs-toggle="tooltip" title="ti-game"></i></li>
<li><i class="ti-filter" data-bs-toggle="tooltip" title="ti-filter"></i></li>
<li><i class="ti-files" data-bs-toggle="tooltip" title="ti-files"></i></li>
<li><i class="ti-file" data-bs-toggle="tooltip" title="ti-file"></i></li>
<li><i class="ti-zip" data-bs-toggle="tooltip" title="ti-zip"></i></li>
<li><i class="ti-folder" data-bs-toggle="tooltip" title="ti-folder"></i></li>
<li><i class="ti-envelope" data-bs-toggle="tooltip" title="ti-envelope"></i></li>
<li><i class="ti-dashboard" data-bs-toggle="tooltip" title="ti-dashboard"></i></li>
<li><i class="ti-cloud" data-bs-toggle="tooltip" title="ti-cloud"></i></li>
<li><i class="ti-cloud-up" data-bs-toggle="tooltip" title="ti-cloud-up"></i></li>
<li><i class="ti-cloud-down" data-bs-toggle="tooltip" title="ti-cloud-down"></i></li>
<li><i class="ti-clipboard" data-bs-toggle="tooltip" title="ti-clipboard"></i></li>
<li><i class="ti-calendar" data-bs-toggle="tooltip" title="ti-calendar"></i></li>
<li><i class="ti-book" data-bs-toggle="tooltip" title="ti-book"></i></li>
<li><i class="ti-bell" data-bs-toggle="tooltip" title="ti-bell"></i></li>
<li><i class="ti-basketball" data-bs-toggle="tooltip" title="ti-basketball"></i></li>
<li><i class="ti-bar-chart" data-bs-toggle="tooltip" title="ti-bar-chart"></i></li>
<li><i class="ti-bar-chart-alt" data-bs-toggle="tooltip" title="ti-bar-chart-alt"></i></li>
<li><i class="ti-archive" data-bs-toggle="tooltip" title="ti-archive"></i></li>
<li><i class="ti-anchor" data-bs-toggle="tooltip" title="ti-anchor"></i></li>
<li><i class="ti-alert" data-bs-toggle="tooltip" title="ti-alert"></i></li>
<li><i class="ti-alarm-clock" data-bs-toggle="tooltip" title="ti-alarm-clock"></i></li>
<li><i class="ti-agenda" data-bs-toggle="tooltip" title="ti-agenda"></i></li>
<li><i class="ti-write" data-bs-toggle="tooltip" title="ti-write"></i></li>
<li><i class="ti-wallet" data-bs-toggle="tooltip" title="ti-wallet"></i></li>
<li><i class="ti-video-clapper" data-bs-toggle="tooltip" title="ti-video-clapper"></i></li>
<li><i class="ti-video-camera" data-bs-toggle="tooltip" title="ti-video-camera"></i></li>
<li><i class="ti-vector" data-bs-toggle="tooltip" title="ti-vector"></i></li>
<li><i class="ti-support" data-bs-toggle="tooltip" title="ti-support"></i></li>
<li><i class="ti-stamp" data-bs-toggle="tooltip" title="ti-stamp"></i></li>
<li><i class="ti-slice" data-bs-toggle="tooltip" title="ti-slice"></i></li>
<li><i class="ti-shortcode" data-bs-toggle="tooltip" title="ti-shortcode"></i></li>
<li><i class="ti-receipt" data-bs-toggle="tooltip" title="ti-receipt"></i></li>
<li><i class="ti-pin2" data-bs-toggle="tooltip" title="ti-pin2"></i></li>
<li><i class="ti-pin-alt" data-bs-toggle="tooltip" title="ti-pin-alt"></i></li>
<li><i class="ti-pencil-alt2" data-bs-toggle="tooltip" title="ti-pencil-alt2"></i></li>
<li><i class="ti-eraser" data-bs-toggle="tooltip" title="ti-eraser"></i></li>
<li><i class="ti-more" data-bs-toggle="tooltip" title="ti-more"></i></li>
<li><i class="ti-more-alt" data-bs-toggle="tooltip" title="ti-more-alt"></i></li>
<li><i class="ti-microphone-alt" data-bs-toggle="tooltip" title="ti-microphone-alt"></i></li>
<li><i class="ti-magnet" data-bs-toggle="tooltip" title="ti-magnet"></i></li>
<li><i class="ti-line-double" data-bs-toggle="tooltip" title="ti-line-double"></i></li>
<li><i class="ti-line-dotted" data-bs-toggle="tooltip" title="ti-line-dotted"></i></li>
<li><i class="ti-line-dashed" data-bs-toggle="tooltip" title="ti-line-dashed"></i></li>
<li><i class="ti-ink-pen" data-bs-toggle="tooltip" title="ti-ink-pen"></i></li>
<li><i class="ti-info-alt" data-bs-toggle="tooltip" title="ti-info-alt"></i></li>
<li><i class="ti-help-alt" data-bs-toggle="tooltip" title="ti-help-alt"></i></li>
<li><i class="ti-headphone-alt" data-bs-toggle="tooltip" title="ti-headphone-alt"></i></li>
<li><i class="ti-gallery" data-bs-toggle="tooltip" title="ti-gallery"></i></li>
<li><i class="ti-face-smile" data-bs-toggle="tooltip" title="ti-face-smile"></i></li>
<li><i class="ti-face-sad" data-bs-toggle="tooltip" title="ti-face-sad"></i></li>
<li><i class="ti-credit-card" data-bs-toggle="tooltip" title="ti-credit-card"></i></li>
<li><i class="ti-comments-smiley" data-bs-toggle="tooltip" title="ti-comments-smiley"></i></li>
<li><i class="ti-time" data-bs-toggle="tooltip" title="ti-time"></i></li>
<li><i class="ti-share" data-bs-toggle="tooltip" title="ti-share"></i></li>
<li><i class="ti-share-alt" data-bs-toggle="tooltip" title="ti-share-alt"></i></li>
<li><i class="ti-rocket" data-bs-toggle="tooltip" title="ti-rocket"></i></li>
<li><i class="ti-new-window" data-bs-toggle="tooltip" title="ti-new-window"></i></li>
<li><i class="ti-rss" data-bs-toggle="tooltip" title="ti-rss"></i></li>
<li><i class="ti-rss-alt" data-bs-toggle="tooltip" title="ti-rss-alt"></i></li>
</ul>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>


<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/feather.min.js"></script>

<script src="assets/js/jquery.slimscroll.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/plugins/apexchart/apexcharts.min.js"></script>
<script src="assets/plugins/apexchart/chart-data.js"></script>

<script src="assets/js/script.js"></script>
</body>
</html>