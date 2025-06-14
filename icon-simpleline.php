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

<link rel="stylesheet" href="assets/plugins/simpleline/simple-line-icons.css">

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
<li><a href="icon-simpleline.php" class="active">Simpleline Icons</a></li>
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
<h3 class="page-title">Simpleline Icon</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
<li class="breadcrumb-item active">Simpleline Icon</li>
</ul>
</div>
</div>
</div>

<div class="row">

<div class="col-md-12">
<div class="card">
<div class="card-header">
<div class="card-title">Simpleline Icons</div>
</div>
<div class="card-body">
<div class="icons-items">
<ul class="icons-list">
<li><i class="si si-user" data-bs-toggle="tooltip" title="si-user"></i></li>
<li><i class="si si-people" data-bs-toggle="tooltip" title="si-people"></i></li>
<li><i class="si si-user-female" data-bs-toggle="tooltip" title="si-user-female"></i></li>
<li><i class="si si-user-follow" data-bs-toggle="tooltip" title="si-user-follow"></i></li>
<li><i class="si si-user-following" data-bs-toggle="tooltip" title="si-user-following"></i></li>
<li><i class="si si-user-unfollow" data-bs-toggle="tooltip" title="si-user-unfollow"></i></li>
<li><i class="si si-login" data-bs-toggle="tooltip" title="si-login"></i></li>
<li><i class="si si-logout" data-bs-toggle="tooltip" title="si-logout"></i></li>
<li><i class="si si-emotsmile" data-bs-toggle="tooltip" title="si-emotsmile"></i></li>
<li><i class="si si-phone" data-bs-toggle="tooltip" title="si-phone"></i></li>
<li><i class="si si-call-end" data-bs-toggle="tooltip" title="si-call-end"></i></li>
<li><i class="si si-call-in" data-bs-toggle="tooltip" title="si-call-in"></i></li>
<li><i class="si si-call-out" data-bs-toggle="tooltip" title="si-call-out"></i></li>
<li><i class="si si-map" data-bs-toggle="tooltip" title="si-map"></i></li>
<li><i class="si si-location-pin" data-bs-toggle="tooltip" title="si-location-pin"></i></li>
<li><i class="si si-direction" data-bs-toggle="tooltip" title="si-direction"></i></li>
<li><i class="si si-directions" data-bs-toggle="tooltip" title="si-directions"></i></li>
<li><i class="si si-compass" data-bs-toggle="tooltip" title="si-compass"></i></li>
<li><i class="si si-layers" data-bs-toggle="tooltip" title="si-layers"></i></li>
<li><i class="si si-menu" data-bs-toggle="tooltip" title="si-menu"></i></li>
<li><i class="si si-list" data-bs-toggle="tooltip" title="si-list"></i></li>
<li><i class="si si-options-vertical" data-bs-toggle="tooltip" title="si-options-vertical"></i></li>
<li><i class="si si-options" data-bs-toggle="tooltip" title="si-options"></i></li>
<li><i class="si si-arrow-down" data-bs-toggle="tooltip" title="si-arrow-down"></i></li>
<li><i class="si si-arrow-left" data-bs-toggle="tooltip" title="si-arrow-left"></i></li>
<li><i class="si si-arrow-right" data-bs-toggle="tooltip" title="si-arrow-right"></i></li>
<li><i class="si si-arrow-up" data-bs-toggle="tooltip" title="si-arrow-up"></i></li>
<li><i class="si si-arrow-up-circle" data-bs-toggle="tooltip" title="si-arrow-up-circle"></i></li>
<li><i class="si si-arrow-left-circle" data-bs-toggle="tooltip" title="si-arrow-left-circle"></i></li>
<li><i class="si si-arrow-right-circle" data-bs-toggle="tooltip" title="si-arrow-right-circle"></i></li>
<li><i class="si si-arrow-down-circle" data-bs-toggle="tooltip" title="si-arrow-down-circle"></i></li>
<li><i class="si si-check" data-bs-toggle="tooltip" title="si-check"></i></li>
<li><i class="si si-clock" data-bs-toggle="tooltip" title="si-clock"></i></li>
<li><i class="si si-plus" data-bs-toggle="tooltip" title="si-plus"></i></li>
<li><i class="si si-minus" data-bs-toggle="tooltip" title="si-minus"></i></li>
<li><i class="si si-close" data-bs-toggle="tooltip" title="si-close"></i></li>
<li><i class="si si-event" data-bs-toggle="tooltip" title="si-event"></i></li>
<li><i class="si si-exclamation" data-bs-toggle="tooltip" title="si-exclamation"></i></li>
<li><i class="si si-organization" data-bs-toggle="tooltip" title="si-organization"></i></li>
<li><i class="si si-trophy" data-bs-toggle="tooltip" title="si-trophy"></i></li>
<li><i class="si si-screen-smartphone" data-bs-toggle="tooltip" title="si-screen-smartphone"></i></li>
<li><i class="si si-screen-desktop" data-bs-toggle="tooltip" title="si-screen-desktop"></i></li>
<li><i class="si si-plane" data-bs-toggle="tooltip" title="si-plane"></i></li>
<li><i class="si si-notebook" data-bs-toggle="tooltip" title="si-notebook"></i></li>
<li><i class="si si-mustache" data-bs-toggle="tooltip" title="si-mustache"></i></li>
<li><i class="si si-mouse" data-bs-toggle="tooltip" title="si-mouse"></i></li>
<li><i class="si si-magnet" data-bs-toggle="tooltip" title="si-magnet"></i></li>
<li><i class="si si-energy" data-bs-toggle="tooltip" title="si-energy"></i></li>
<li><i class="si si-disc" data-bs-toggle="tooltip" title="si-disc"></i></li>
<li><i class="si si-cursor" data-bs-toggle="tooltip" title="si-cursor"></i></li>
<li><i class="si si-cursor-move" data-bs-toggle="tooltip" title="si-cursor-move"></i></li>
<li><i class="si si-crop" data-bs-toggle="tooltip" title="si-crop"></i></li>
<li><i class="si si-chemistry" data-bs-toggle="tooltip" title="si-chemistry"></i></li>
 <li><i class="si si-speedometer" data-bs-toggle="tooltip" title="si-speedometer"></i></li>
<li><i class="si si-shield" data-bs-toggle="tooltip" title="si-shield"></i></li>
<li><i class="si si-screen-tablet" data-bs-toggle="tooltip" title="si-screen-tablet"></i></li>
<li><i class="si si-magic-wand" data-bs-toggle="tooltip" title="si-magic-wand"></i></li>
<li><i class="si si-hourglass" data-bs-toggle="tooltip" title="si-hourglass"></i></li>
<li><i class="si si-graduation" data-bs-toggle="tooltip" title="si-graduation"></i></li>
<li><i class="si si-ghost" data-bs-toggle="tooltip" title="si-ghost"></i></li>
<li><i class="si si-game-controller" data-bs-toggle="tooltip" title="si-game-controller"></i></li>
<li><i class="si si-fire" data-bs-toggle="tooltip" title="si-fire"></i></li>
<li><i class="si si-eyeglass" data-bs-toggle="tooltip" title="si-eyeglass"></i></li>
<li><i class="si si-envelope-open" data-bs-toggle="tooltip" title="si-envelope-open"></i></li>
<li><i class="si si-envelope-letter" data-bs-toggle="tooltip" title="si-envelope-letter"></i></li>
<li><i class="si si-bell" data-bs-toggle="tooltip" title="si-bell"></i></li>
<li><i class="si si-badge" data-bs-toggle="tooltip" title="si-badge"></i></li>
<li><i class="si si-anchor" data-bs-toggle="tooltip" title="si-anchor"></i></li>
<li><i class="si si-wallet" data-bs-toggle="tooltip" title="si-wallet"></i></li>
<li><i class="si si-vector" data-bs-toggle="tooltip" title="si-vector"></i></li>
<li><i class="si si-speech" data-bs-toggle="tooltip" title="si-speech"></i></li>
<li><i class="si si-puzzle" data-bs-toggle="tooltip" title="si-puzzle"></i></li>
<li><i class="si si-printer" data-bs-toggle="tooltip" title="si-printer"></i></li>
<li><i class="si si-present" data-bs-toggle="tooltip" title="si-present"></i></li>
<li><i class="si si-playlist" data-bs-toggle="tooltip" title="si-playlist"></i></li>
<li><i class="si si-pin" data-bs-toggle="tooltip" title="si-pin"></i></li>
<li><i class="si si-picture" data-bs-toggle="tooltip" title="si-picture"></i></li>
<li><i class="si si-handbag" data-bs-toggle="tooltip" title="si-handbag"></i></li>
<li><i class="si si-globe-alt" data-bs-toggle="tooltip" title="si-globe-alt"></i></li>
<li><i class="si si-globe" data-bs-toggle="tooltip" title="si-globe"></i></li>
<li><i class="si si-folder-alt" data-bs-toggle="tooltip" title="si-folder-alt"></i></li>
<li><i class="si si-folder" data-bs-toggle="tooltip" title="si-folder"></i></li>
<li><i class="si si-film" data-bs-toggle="tooltip" title="si-film"></i></li>
<li><i class="si si-feed" data-bs-toggle="tooltip" title="si-feed"></i></li>
<li><i class="si si-drop" data-bs-toggle="tooltip" title="si-drop"></i></li>
<li><i class="si si-drawer" data-bs-toggle="tooltip" title="si-drawer"></i></li>
<li><i class="si si-docs" data-bs-toggle="tooltip" title="si-docs"></i></li>
<li><i class="si si-doc" data-bs-toggle="tooltip" title="si-doc"></i></li>
<li><i class="si si-diamond" data-bs-toggle="tooltip" title="si-diamond"></i></li>
<li><i class="si si-cup" data-bs-toggle="tooltip" title="si-cup"></i></li>
<li><i class="si si-calculator" data-bs-toggle="tooltip" title="si-calculator"></i></li>
<li><i class="si si-bubbles" data-bs-toggle="tooltip" title="si-bubbles"></i></li>
<li><i class="si si-briefcase" data-bs-toggle="tooltip" title="si-briefcase"></i></li>
<li><i class="si si-book-open" data-bs-toggle="tooltip" title="si-book-open"></i></li>
<li><i class="si si-basket-loaded" data-bs-toggle="tooltip" title="si-basket-loaded"></i></li>
<li><i class="si si-basket" data-bs-toggle="tooltip" title="si-basket"></i></li>
<li><i class="si si-bag" data-bs-toggle="tooltip" title="si-bag"></i></li>
<li><i class="si si-action-undo" data-bs-toggle="tooltip" title="si-action-undo"></i></li>
<li><i class="si si-action-redo" data-bs-toggle="tooltip" title="si-action-redo"></i></li>
<li><i class="si si-wrench" data-bs-toggle="tooltip" title="si-wrench"></i></li>
<li><i class="si si-umbrella" data-bs-toggle="tooltip" title="si-umbrella"></i></li>
<li><i class="si si-trash" data-bs-toggle="tooltip" title="si-trash"></i></li>
<li><i class="si si-tag" data-bs-toggle="tooltip" title="si-tag"></i></li>
<li><i class="si si-support" data-bs-toggle="tooltip" title="si-support"></i></li>
<li><i class="si si-frame" data-bs-toggle="tooltip" title="si-frame"></i></li>
<li><i class="si si-size-fullscreen" data-bs-toggle="tooltip" title="si-size-fullscreen"></i></li>
<li><i class="si si-size-actual" data-bs-toggle="tooltip" title="si-size-actual"></i></li>
<li><i class="si si-shuffle" data-bs-toggle="tooltip" title="si-shuffle"></i></li>
<li><i class="si si-share-alt" data-bs-toggle="tooltip" title="si-share-alt"></i></li>
<li><i class="si si-share" data-bs-toggle="tooltip" title="si-share"></i></li>
<li><i class="si si-rocket" data-bs-toggle="tooltip" title="si-rocket"></i></li>
<li><i class="si si-question" data-bs-toggle="tooltip" title="si-question"></i></li>
<li><i class="si si-pie-chart" data-bs-toggle="tooltip" title="si-pie-chart"></i></li>
<li><i class="si si-pencil" data-bs-toggle="tooltip" title="si-pencil"></i></li>
<li><i class="si si-note" data-bs-toggle="tooltip" title="si-note"></i></li>
<li><i class="si si-loop" data-bs-toggle="tooltip" title="si-loop"></i></li>
<li><i class="si si-home" data-bs-toggle="tooltip" title="si-home"></i></li>
<li><i class="si si-grid" data-bs-toggle="tooltip" title="si-grid"></i></li>
<li><i class="si si-graph" data-bs-toggle="tooltip" title="si-graph"></i></li>
<li><i class="si si-microphone" data-bs-toggle="tooltip" title="si-microphone"></i></li>
<li><i class="si si-music-tone-alt" data-bs-toggle="tooltip" title="si-music-tone-alt"></i></li>
<li><i class="si si-music-tone" data-bs-toggle="tooltip" title="si-music-tone"></i></li>
<li><i class="si si-earphones-alt" data-bs-toggle="tooltip" title="si-earphones-alt"></i></li>
<li><i class="si si-earphones" data-bs-toggle="tooltip" title="si-earphones"></i></li>
<li><i class="si si-equalizer" data-bs-toggle="tooltip" title="si-equalizer"></i></li>
<li><i class="si si-like" data-bs-toggle="tooltip" title="si-like"></i></li>
<li><i class="si si-dislike" data-bs-toggle="tooltip" title="si-dislike"></i></li>
<li><i class="si si-control-start" data-bs-toggle="tooltip" title="si-control-start"></i></li>
<li><i class="si si-control-rewind" data-bs-toggle="tooltip" title="si-control-rewind"></i></li>
<li><i class="si si-control-play" data-bs-toggle="tooltip" title="si-control-play"></i></li>
<li><i class="si si-control-pause" data-bs-toggle="tooltip" title="si-control-pause"></i></li>
<li><i class="si si-control-forward" data-bs-toggle="tooltip" title="si-control-forward"></i></li>
<li><i class="si si-control-end" data-bs-toggle="tooltip" title="si-control-end"></i></li>
<li><i class="si si-volume-1" data-bs-toggle="tooltip" title="si-volume-1"></i></li>
<li><i class="si si-volume-2" data-bs-toggle="tooltip" title="si-volume-2"></i></li>
<li><i class="si si-volume-off" data-bs-toggle="tooltip" title="si-volume-off"></i></li>
<li><i class="si si-calendar" data-bs-toggle="tooltip" title="si-calendar"></i></li>
<li><i class="si si-bulb" data-bs-toggle="tooltip" title="si-bulb"></i></li>
<li><i class="si si-chart" data-bs-toggle="tooltip" title="si-chart"></i></li>
<li><i class="si si-ban" data-bs-toggle="tooltip" title="si-ban"></i></li>
<li><i class="si si-bubble" data-bs-toggle="tooltip" title="si-bubble"></i></li>
<li><i class="si si-camrecorder" data-bs-toggle="tooltip" title="si-camrecorder"></i></li>
<li><i class="si si-camera" data-bs-toggle="tooltip" title="si-camera"></i></li>
<li><i class="si si-cloud-download" data-bs-toggle="tooltip" title="si-cloud-download"></i></li>
<li><i class="si si-cloud-upload" data-bs-toggle="tooltip" title="si-cloud-upload"></i></li>
<li><i class="si si-envelope" data-bs-toggle="tooltip" title="si-envelope"></i></li>
<li><i class="si si-eye" data-bs-toggle="tooltip" title="si-eye"></i></li>
<li><i class="si si-flag" data-bs-toggle="tooltip" title="si-flag"></i></li>
<li><i class="si si-heart" data-bs-toggle="tooltip" title="si-heart"></i></li>
<li><i class="si si-info" data-bs-toggle="tooltip" title="si-info"></i></li>
<li><i class="si si-key" data-bs-toggle="tooltip" title="si-key"></i></li>
<li><i class="si si-link" data-bs-toggle="tooltip" title="si-link"></i></li>
<li><i class="si si-lock" data-bs-toggle="tooltip" title="si-lock"></i></li>
<li><i class="si si-lock-open" data-bs-toggle="tooltip" title="si-lock-open"></i></li>
<li><i class="si si-magnifier" data-bs-toggle="tooltip" title="si-magnifier"></i></li>
<li><i class="si si-magnifier-add" data-bs-toggle="tooltip" title="si-magnifier-add"></i></li>
<li><i class="si si-magnifier-remove" data-bs-toggle="tooltip" title="si-magnifier-remove"></i></li>
<li><i class="si si-paper-clip" data-bs-toggle="tooltip" title="si-paper-clip"></i></li>
<li><i class="si si-paper-plane" data-bs-toggle="tooltip" title="si-paper-plane"></i></li>
<li><i class="si si-power" data-bs-toggle="tooltip" title="si-power"></i></li>
<li><i class="si si-refresh" data-bs-toggle="tooltip" title="si-refresh"></i></li>
<li><i class="si si-reload" data-bs-toggle="tooltip" title="si-reload"></i></li>
<li><i class="si si-settings" data-bs-toggle="tooltip" title="si-settings"></i></li>
<li><i class="si si-star" data-bs-toggle="tooltip" title="si-star"></i></li>
<li><i class="si si-symbol-female" data-bs-toggle="tooltip" title="si-symbol-female"></i></li>
<li><i class="si si-symbol-male" data-bs-toggle="tooltip" title="si-symbol-male"></i></li>
<li><i class="si si-target" data-bs-toggle="tooltip" title="si-target"></i></li>
<li><i class="si si-credit-card" data-bs-toggle="tooltip" title="si-credit-card"></i></li>
<li><i class="si si-paypal" data-bs-toggle="tooltip" title="si-paypal"></i></li>
<li><i class="si si-social-tumblr" data-bs-toggle="tooltip" title="si-social-tumblr"></i></li>
<li><i class="si si-social-twitter" data-bs-toggle="tooltip" title="si-social-twitter"></i></li>
<li><i class="si si-social-facebook" data-bs-toggle="tooltip" title="si-social-facebook"></i></li>
<li><i class="si si-social-instagram" data-bs-toggle="tooltip" title="si-social-instagram"></i></li>
<li><i class="si si-social-linkedin" data-bs-toggle="tooltip" title="si-social-linkedin"></i></li>
<li><i class="si si-social-pinterest" data-bs-toggle="tooltip" title="si-social-pinterest"></i></li>
<li><i class="si si-social-github" data-bs-toggle="tooltip" title="si-social-github"></i></li>
<li><i class="si si-social-google" data-bs-toggle="tooltip" title="si-social-google"></i></li>
<li><i class="si si-social-reddit" data-bs-toggle="tooltip" title="si-social-reddit"></i></li>
<li><i class="si si-social-skype" data-bs-toggle="tooltip" title="si-social-skype"></i></li>
 <li><i class="si si-social-dribbble" data-bs-toggle="tooltip" title="si-social-dribbble"></i></li>
<li><i class="si si-social-behance" data-bs-toggle="tooltip" title="si-social-behance"></i></li>
<li><i class="si si-social-foursqare" data-bs-toggle="tooltip" title="si-social-foursqare"></i></li>
<li><i class="si si-social-soundcloud" data-bs-toggle="tooltip" title="si-social-soundcloud"></i></li>
<li><i class="si si-social-spotify" data-bs-toggle="tooltip" title="si-social-spotify"></i></li>
<li><i class="si si-social-stumbleupon" data-bs-toggle="tooltip" title="si-social-stumbleupon"></i></li>
<li><i class="si si-social-youtube" data-bs-toggle="tooltip" title="si-social-youtube"></i></li>
<li><i class="si si-social-dropbox" data-bs-toggle="tooltip" title="si-social-dropbox"></i></li>
<li><i class="si si-social-vkontakte" data-bs-toggle="tooltip" title="si-social-vkontakte"></i></li>
<li><i class="si si-social-steam" data-bs-toggle="tooltip" title="si-social-steam"></i></li>
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