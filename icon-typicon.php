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

<link rel="stylesheet" href="assets/plugins/icons/typicons/typicons.css">

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
<li><a href="icon-themify.php">Themify Icons</a></li>
<li><a href="icon-weather.php">Weather Icons</a></li>
<li><a href="icon-typicon.php" class="active">Typicon Icons</a></li>
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
<h3 class="page-title">Typicon Icon</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
<li class="breadcrumb-item active">Typicon Icon</li>
</ul>
</div>
</div>
</div>

<div class="row">

<div class="col-md-12">
<div class="card">
<div class="card-header">
<div class="card-title">Typicon Icon</div>
</div>
<div class="card-body">
<div class="icons-items">
<ul class="icons-list">
<li class="icons-list-item"><i class="typcn typcn-chart-pie-outline" data-bs-toggle="tooltip" title="typcn typcn-chart-pie-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-chart-pie" data-bs-toggle="tooltip" title="typcn typcn-chart-pie"></i></li>
<li class="icons-list-item"><i class="typcn typcn-chevron-left-outline" data-bs-toggle="tooltip" title="typcn typcn-chevron-left-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-chevron-left" data-bs-toggle="tooltip" title="typcn typcn-chevron-left"></i></li>
<li class="icons-list-item"><i class="typcn typcn-chevron-right-outline" data-bs-toggle="tooltip" title="typcn typcn-chevron-right-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-chevron-right" data-bs-toggle="tooltip" title="typcn typcn-chevron-right"></i></li>
<li class="icons-list-item"><i class="typcn typcn-clipboard" data-bs-toggle="tooltip" title="typcn typcn-clipboard"></i></li>
<li class="icons-list-item"><i class="typcn typcn-cloud-storage" data-bs-toggle="tooltip" title="typcn typcn-cloud-storage"></i></li>
<li class="icons-list-item"><i class="typcn typcn-cloud-storage-outline" data-bs-toggle="tooltip" title="typcn typcn-cloud-storage-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-code-outline" data-bs-toggle="tooltip" title="typcn typcn-code-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-code" data-bs-toggle="tooltip" title="typcn typcn-code"></i></li>
<li class="icons-list-item"><i class="typcn typcn-coffee" data-bs-toggle="tooltip" title="typcn typcn-coffee"></i></li>
<li class="icons-list-item"><i class="typcn typcn-cog-outline" data-bs-toggle="tooltip" title="typcn typcn-cog-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-cog" data-bs-toggle="tooltip" title="typcn typcn-cog"></i></li>
<li class="icons-list-item"><i class="typcn typcn-compass" data-bs-toggle="tooltip" title="typcn typcn-compass"></i></li>
<li class="icons-list-item"><i class="typcn typcn-contacts" data-bs-toggle="tooltip" title="typcn typcn-contacts"></i></li>
<li class="icons-list-item"><i class="typcn typcn-credit-card" data-bs-toggle="tooltip" title="typcn typcn-credit-card"></i></li>
<li class="icons-list-item"><i class="typcn typcn-css3" data-bs-toggle="tooltip" title="typcn typcn-css3"></i></li>
<li class="icons-list-item"><i class="typcn typcn-database" data-bs-toggle="tooltip" title="typcn typcn-database"></i></li>
<li class="icons-list-item"><i class="typcn typcn-delete-outline" data-bs-toggle="tooltip" title="typcn typcn-delete-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-delete" data-bs-toggle="tooltip" title="typcn typcn-delete"></i></li>
<li class="icons-list-item"><i class="typcn typcn-device-desktop" data-bs-toggle="tooltip" title="typcn typcn-device-desktop"></i></li>
<li class="icons-list-item"><i class="typcn typcn-device-laptop" data-bs-toggle="tooltip" title="typcn typcn-device-laptop"></i></li>
<li class="icons-list-item"><i class="typcn typcn-device-phone" data-bs-toggle="tooltip" title="typcn typcn-device-phone"></i></li>
<li class="icons-list-item"><i class="typcn typcn-device-tablet" data-bs-toggle="tooltip" title="typcn typcn-device-tablet"></i></li>
<li class="icons-list-item"><i class="typcn typcn-directions" data-bs-toggle="tooltip" title="typcn typcn-directions"></i></li>
<li class="icons-list-item"><i class="typcn typcn-divide-outline" data-bs-toggle="tooltip" title="typcn typcn-divide-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-divide" data-bs-toggle="tooltip" title="typcn typcn-divide"></i></li>
<li class="icons-list-item"><i class="typcn typcn-document-add" data-bs-toggle="tooltip" title="typcn typcn-document-add"></i></li>
<li class="icons-list-item"><i class="typcn typcn-document-delete" data-bs-toggle="tooltip" title="typcn typcn-document-delete"></i></li>
<li class="icons-list-item"><i class="typcn typcn-document-text" data-bs-toggle="tooltip" title="typcn typcn-document-text"></i></li>
<li class="icons-list-item"><i class="typcn typcn-document" data-bs-toggle="tooltip" title="typcn typcn-document"></i></li>
<li class="icons-list-item"><i class="typcn typcn-download-outline" data-bs-toggle="tooltip" title="typcn typcn-download-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-download" data-bs-toggle="tooltip" title="typcn typcn-download"></i></li>
<li class="icons-list-item"><i class="typcn typcn-dropbox" data-bs-toggle="tooltip" title="typcn typcn-dropbox"></i></li>
<li class="icons-list-item"><i class="typcn typcn-edit" data-bs-toggle="tooltip" title="typcn typcn-edit"></i></li>
<li class="icons-list-item"><i class="typcn typcn-eject-outline" data-bs-toggle="tooltip" title="typcn typcn-eject-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-eject" data-bs-toggle="tooltip" title="typcn typcn-eject"></i></li>
<li class="icons-list-item"><i class="typcn typcn-equals-outline" data-bs-toggle="tooltip" title="typcn typcn-equals-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-equals" data-bs-toggle="tooltip" title="typcn typcn-equals"></i></li>
<li class="icons-list-item"><i class="typcn typcn-export-outline" data-bs-toggle="tooltip" title="typcn typcn-export-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-export" data-bs-toggle="tooltip" title="typcn typcn-export"></i></li>
<li class="icons-list-item"><i class="typcn typcn-eye-outline" data-bs-toggle="tooltip" title="typcn typcn-eye-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-eye" data-bs-toggle="tooltip" title="typcn typcn-eye"></i></li>
<li class="icons-list-item"><i class="typcn typcn-feather" data-bs-toggle="tooltip" title="typcn typcn-feather"></i></li>
<li class="icons-list-item"><i class="typcn typcn-film" data-bs-toggle="tooltip" title="typcn typcn-film"></i></li>
<li class="icons-list-item"><i class="typcn typcn-filter" data-bs-toggle="tooltip" title="typcn typcn-filter"></i></li>
<li class="icons-list-item"><i class="typcn typcn-flag-outline" data-bs-toggle="tooltip" title="typcn typcn-flag-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-flag" data-bs-toggle="tooltip" title="typcn typcn-flag"></i></li>
<li class="icons-list-item"><i class="typcn typcn-flash-outline" data-bs-toggle="tooltip" title="typcn typcn-flash-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-flash" data-bs-toggle="tooltip" title="typcn typcn-flash"></i></li>
<li class="icons-list-item"><i class="typcn typcn-flow-children" data-bs-toggle="tooltip" title="typcn typcn-flow-children"></i></li>
<li class="icons-list-item"><i class="typcn typcn-flow-merge" data-bs-toggle="tooltip" title="typcn typcn-flow-merge"></i></li>
<li class="icons-list-item"><i class="typcn typcn-flow-parallel" data-bs-toggle="tooltip" title="typcn typcn-flow-parallel"></i></li>
<li class="icons-list-item"><i class="typcn typcn-flow-switch" data-bs-toggle="tooltip" title="typcn typcn-flow-switch"></i></li>
<li class="icons-list-item"><i class="typcn typcn-folder-add" data-bs-toggle="tooltip" title="typcn typcn-folder-add"></i></li>
<li class="icons-list-item"><i class="typcn typcn-folder-delete" data-bs-toggle="tooltip" title="typcn typcn-folder-delete"></i></li>
<li class="icons-list-item"><i class="typcn typcn-folder-open" data-bs-toggle="tooltip" title="typcn typcn-folder-open"></i></li>
<li class="icons-list-item"><i class="typcn typcn-folder" data-bs-toggle="tooltip" title="typcn typcn-folder"></i></li>
<li class="icons-list-item"><i class="typcn typcn-gift" data-bs-toggle="tooltip" title="typcn typcn-gift"></i></li>
<li class="icons-list-item"><i class="typcn typcn-globe-outline" data-bs-toggle="tooltip" title="typcn typcn-globe-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-globe" data-bs-toggle="tooltip" title="typcn typcn-globe"></i></li>
<li class="icons-list-item"><i class="typcn typcn-group-outline" data-bs-toggle="tooltip" title="typcn typcn-group-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-group" data-bs-toggle="tooltip" title="typcn typcn-group"></i></li>
<li class="icons-list-item"><i class="typcn typcn-headphones" data-bs-toggle="tooltip" title="typcn typcn-headphones"></i></li>
<li class="icons-list-item"><i class="typcn typcn-heart-full-outline" data-bs-toggle="tooltip" title="typcn typcn-heart-full-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-heart-half-outline" data-bs-toggle="tooltip" title="typcn typcn-heart-half-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-heart-outline" data-bs-toggle="tooltip" title="typcn typcn-heart-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-heart" data-bs-toggle="tooltip" title="typcn typcn-heart"></i></li>
<li class="icons-list-item"><i class="typcn typcn-home-outline" data-bs-toggle="tooltip" title="typcn typcn-home-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-home" data-bs-toggle="tooltip" title="typcn typcn-home"></i></li>
<li class="icons-list-item"><i class="typcn typcn-html5" data-bs-toggle="tooltip" title="typcn typcn-html5"></i></li>
<li class="icons-list-item"><i class="typcn typcn-image-outline" data-bs-toggle="tooltip" title="typcn typcn-image-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-image" data-bs-toggle="tooltip" title="typcn typcn-image"></i></li>
<li class="icons-list-item"><i class="typcn typcn-infinity-outline" data-bs-toggle="tooltip" title="typcn typcn-infinity-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-info-large-outline" data-bs-toggle="tooltip" title="typcn typcn-info-large-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-info-large" data-bs-toggle="tooltip" title="typcn typcn-info-large"></i></li>
<li class="icons-list-item"><i class="typcn typcn-info-outline" data-bs-toggle="tooltip" title="typcn typcn-info-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-info" data-bs-toggle="tooltip" title="typcn typcn-info"></i></li>
<li class="icons-list-item"><i class="typcn typcn-input-checked-outline" data-bs-toggle="tooltip" title="typcn typcn-input-checked-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-input-checked" data-bs-toggle="tooltip" title="typcn typcn-input-checked"></i></li>
<li class="icons-list-item"><i class="typcn typcn-key-outline" data-bs-toggle="tooltip" title="typcn typcn-key-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-key" data-bs-toggle="tooltip" title="typcn typcn-key"></i></li>
<li class="icons-list-item"><i class="typcn typcn-keyboard" data-bs-toggle="tooltip" title="typcn typcn-keyboard"></i></li>
<li class="icons-list-item"><i class="typcn typcn-leaf" data-bs-toggle="tooltip" title="typcn typcn-leaf"></i></li>
<li class="icons-list-item"><i class="typcn typcn-lightbulb" data-bs-toggle="tooltip" title="typcn typcn-lightbulb"></i></li>
<li class="icons-list-item"><i class="typcn typcn-link-outline" data-bs-toggle="tooltip" title="typcn typcn-link-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-link" data-bs-toggle="tooltip" title="typcn typcn-link"></i></li>
<li class="icons-list-item"><i class="typcn typcn-location-arrow-outline" data-bs-toggle="tooltip" title="typcn typcn-location-arrow-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-location-arrow" data-bs-toggle="tooltip" title="typcn typcn-location-arrow"></i></li>
<li class="icons-list-item"><i class="typcn typcn-location-outline" data-bs-toggle="tooltip" title="typcn typcn-location-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-location" data-bs-toggle="tooltip" title="typcn typcn-location"></i></li>
<li class="icons-list-item"><i class="typcn typcn-lock-closed-outline" data-bs-toggle="tooltip" title="typcn typcn-lock-closed-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-lock-closed" data-bs-toggle="tooltip" title="typcn typcn-lock-closed"></i></li>
<li class="icons-list-item"><i class="typcn typcn-lock-open-outline" data-bs-toggle="tooltip" title="typcn typcn-lock-open-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-lock-open" data-bs-toggle="tooltip" title="typcn typcn-lock-open"></i></li>
<li class="icons-list-item"><i class="typcn typcn-mail" data-bs-toggle="tooltip" title="typcn typcn-mail"></i></li>
<li class="icons-list-item"><i class="typcn typcn-map" data-bs-toggle="tooltip" title="typcn typcn-map"></i></li>
<li class="icons-list-item"><i class="typcn typcn-media-eject-outline" data-bs-toggle="tooltip" title="typcn typcn-media-eject-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-media-eject" data-bs-toggle="tooltip" title="typcn typcn-media-eject"></i></li>
<li class="icons-list-item"><i class="typcn typcn-media-fast-forward-outline" data-bs-toggle="tooltip" title="typcn typcn-media-fast-forward-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-media-fast-forward" data-bs-toggle="tooltip" title="typcn typcn-media-fast-forward"></i></li>
<li class="icons-list-item"><i class="typcn typcn-media-pause-outline" data-bs-toggle="tooltip" title="typcn typcn-media-pause-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-media-pause" data-bs-toggle="tooltip" title="typcn typcn-media-pause"></i></li>
<li class="icons-list-item"><i class="typcn typcn-media-play-outline" data-bs-toggle="tooltip" title="typcn typcn-media-play-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-media-play-reverse-outline" data-bs-toggle="tooltip" title="typcn typcn-media-play-reverse-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-media-play-reverse" data-bs-toggle="tooltip" title="typcn typcn-media-play-reverse"></i></li>
<li class="icons-list-item"><i class="typcn typcn-media-play" data-bs-toggle="tooltip" title="typcn typcn-media-play"></i></li>
<li class="icons-list-item"><i class="typcn typcn-media-record-outline" data-bs-toggle="tooltip" title="typcn typcn-media-record-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-media-record" data-bs-toggle="tooltip" title="typcn typcn-media-record"></i></li>
<li class="icons-list-item"><i class="typcn typcn-media-rewind-outline" data-bs-toggle="tooltip" title="typcn typcn-media-rewind-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-media-rewind" data-bs-toggle="tooltip" title="typcn typcn-media-rewind"></i></li>
<li class="icons-list-item"><i class="typcn typcn-media-stop-outline" data-bs-toggle="tooltip" title="typcn typcn-media-stop-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-media-stop" data-bs-toggle="tooltip" title="typcn typcn-media-stop"></i></li>
<li class="icons-list-item"><i class="typcn typcn-message-typing" data-bs-toggle="tooltip" title="typcn typcn-message-typing"></i></li>
<li class="icons-list-item"><i class="typcn typcn-message" data-bs-toggle="tooltip" title="typcn typcn-message"></i></li>
<li class="icons-list-item"><i class="typcn typcn-messages" data-bs-toggle="tooltip" title="typcn typcn-messages"></i></li>
<li class="icons-list-item"><i class="typcn typcn-microphone-outline" data-bs-toggle="tooltip" title="typcn typcn-microphone-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-microphone" data-bs-toggle="tooltip" title="typcn typcn-microphone"></i></li>
<li class="icons-list-item"><i class="typcn typcn-minus-outline" data-bs-toggle="tooltip" title="typcn typcn-minus-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-minus" data-bs-toggle="tooltip" title="typcn typcn-minus"></i></li>
<li class="icons-list-item"><i class="typcn typcn-mortar-board" data-bs-toggle="tooltip" title="typcn typcn-mortar-board"></i></li>
<li class="icons-list-item"><i class="typcn typcn-news" data-bs-toggle="tooltip" title="typcn typcn-news"></i></li>
<li class="icons-list-item"><i class="typcn typcn-notes-outline" data-bs-toggle="tooltip" title="typcn typcn-notes-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-notes" data-bs-toggle="tooltip" title="typcn typcn-notes"></i></li>
<li class="icons-list-item"><i class="typcn typcn-pen" data-bs-toggle="tooltip" title="typcn typcn-pen"></i></li>
<li class="icons-list-item"><i class="typcn typcn-pencil" data-bs-toggle="tooltip" title="typcn typcn-pencil"></i></li>
<li class="icons-list-item"><i class="typcn typcn-phone-outline" data-bs-toggle="tooltip" title="typcn typcn-phone-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-phone" data-bs-toggle="tooltip" title="typcn typcn-phone"></i></li>
<li class="icons-list-item"><i class="typcn typcn-pi-outline" data-bs-toggle="tooltip" title="typcn typcn-pi-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-pi" data-bs-toggle="tooltip" title="typcn typcn-pi"></i></li>
<li class="icons-list-item"><i class="typcn typcn-pin-outline" data-bs-toggle="tooltip" title="typcn typcn-pin-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-pin" data-bs-toggle="tooltip" title="typcn typcn-pin"></i></li>
<li class="icons-list-item"><i class="typcn typcn-pipette" data-bs-toggle="tooltip" title="typcn typcn-pipette"></i></li>
<li class="icons-list-item"><i class="typcn typcn-plane-outline" data-bs-toggle="tooltip" title="typcn typcn-plane-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-plane" data-bs-toggle="tooltip" title="typcn typcn-plane"></i></li>
<li class="icons-list-item"><i class="typcn typcn-plug" data-bs-toggle="tooltip" title="typcn typcn-plug"></i></li>
<li class="icons-list-item"><i class="typcn typcn-plus-outline" data-bs-toggle="tooltip" title="typcn typcn-plus-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-plus" data-bs-toggle="tooltip" title="typcn typcn-plus"></i></li>
<li class="icons-list-item"><i class="typcn typcn-point-of-interest-outline" data-bs-toggle="tooltip" title="typcn typcn-point-of-interest-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-point-of-interest" data-bs-toggle="tooltip" title="typcn typcn-point-of-interest"></i></li>
<li class="icons-list-item"><i class="typcn typcn-power-outline" data-bs-toggle="tooltip" title="typcn typcn-power-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-power" data-bs-toggle="tooltip" title="typcn typcn-power"></i></li>
<li class="icons-list-item"><i class="typcn typcn-printer" data-bs-toggle="tooltip" title="typcn typcn-printer"></i></li>
<li class="icons-list-item"><i class="typcn typcn-puzzle-outline" data-bs-toggle="tooltip" title="typcn typcn-puzzle-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-puzzle" data-bs-toggle="tooltip" title="typcn typcn-puzzle"></i></li>
<li class="icons-list-item"><i class="typcn typcn-radar-outline" data-bs-toggle="tooltip" title="typcn typcn-radar-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-radar" data-bs-toggle="tooltip" title="typcn typcn-radar"></i></li>
<li class="icons-list-item"><i class="typcn typcn-refresh-outline" data-bs-toggle="tooltip" title="typcn typcn-refresh-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-refresh" data-bs-toggle="tooltip" title="typcn typcn-refresh"></i></li>
<li class="icons-list-item"><i class="typcn typcn-rss-outline" data-bs-toggle="tooltip" title="typcn typcn-rss-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-rss" data-bs-toggle="tooltip" title="typcn typcn-rss"></i></li>
<li class="icons-list-item"><i class="typcn typcn-scissors-outline" data-bs-toggle="tooltip" title="typcn typcn-scissors-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-scissors" data-bs-toggle="tooltip" title="typcn typcn-scissors"></i></li>
<li class="icons-list-item"><i class="typcn typcn-shopping-bag" data-bs-toggle="tooltip" title="typcn typcn-shopping-bag"></i></li>
<li class="icons-list-item"><i class="typcn typcn-shopping-cart" data-bs-toggle="tooltip" title="typcn typcn-shopping-cart"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-at-circular" data-bs-toggle="tooltip" title="typcn typcn-social-at-circular"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-dribbble-circular" data-bs-toggle="tooltip" title="typcn typcn-social-dribbble-circular"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-dribbble" data-bs-toggle="tooltip" title="typcn typcn-social-dribbble"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-facebook-circular" data-bs-toggle="tooltip" title="typcn typcn-social-facebook-circular"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-facebook" data-bs-toggle="tooltip" title="typcn typcn-social-facebook"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-flickr-circular" data-bs-toggle="tooltip" title="typcn typcn-social-flickr-circular"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-flickr" data-bs-toggle="tooltip" title="typcn typcn-social-flickr"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-github-circular" data-bs-toggle="tooltip" title="typcn typcn-social-github-circular"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-github" data-bs-toggle="tooltip" title="typcn typcn-social-github"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-google-plus-circular" data-bs-toggle="tooltip" title="typcn typcn-social-google-plus-circular"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-google-plus" data-bs-toggle="tooltip" title="typcn typcn-social-google-plus"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-instagram-circular" data-bs-toggle="tooltip" title="typcn typcn-social-instagram-circular"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-instagram" data-bs-toggle="tooltip" title="typcn typcn-social-instagram"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-last-fm-circular" data-bs-toggle="tooltip" title="typcn typcn-social-last-fm-circular"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-last-fm" data-bs-toggle="tooltip" title="typcn typcn-social-last-fm"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-linkedin-circular" data-bs-toggle="tooltip" title="typcn typcn-social-linkedin-circular"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-linkedin" data-bs-toggle="tooltip" title="typcn typcn-social-linkedin"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-pinterest-circular" data-bs-toggle="tooltip" title="typcn typcn-social-pinterest-circular"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-pinterest" data-bs-toggle="tooltip" title="typcn typcn-social-pinterest"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-skype-outline" data-bs-toggle="tooltip" title="typcn typcn-social-skype-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-skype" data-bs-toggle="tooltip" title="typcn typcn-social-skype"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-tumbler-circular" data-bs-toggle="tooltip" title="typcn typcn-social-tumbler-circular"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-tumbler" data-bs-toggle="tooltip" title="typcn typcn-social-tumbler"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-twitter-circular" data-bs-toggle="tooltip" title="typcn typcn-social-twitter-circular"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-twitter" data-bs-toggle="tooltip" title="typcn typcn-social-twitter"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-vimeo-circular" data-bs-toggle="tooltip" title="typcn typcn-social-vimeo-circular"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-vimeo" data-bs-toggle="tooltip" title="typcn typcn-social-vimeo"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-youtube-circular" data-bs-toggle="tooltip" title="typcn typcn-social-youtube-circular"></i></li>
<li class="icons-list-item"><i class="typcn typcn-social-youtube" data-bs-toggle="tooltip" title="typcn typcn-social-youtube"></i></li>
<li class="icons-list-item"><i class="typcn typcn-sort-alphabetically-outline" data-bs-toggle="tooltip" title="typcn typcn-sort-alphabetically-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-sort-alphabetically" data-bs-toggle="tooltip" title="typcn typcn-sort-alphabetically"></i></li>
<li class="icons-list-item"><i class="typcn typcn-sort-numerically-outline" data-bs-toggle="tooltip" title="typcn typcn-sort-numerically-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-sort-numerically" data-bs-toggle="tooltip" title="typcn typcn-sort-numerically"></i></li>
<li class="icons-list-item"><i class="typcn typcn-spanner-outline" data-bs-toggle="tooltip" title="typcn typcn-spanner-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-spanner" data-bs-toggle="tooltip" title="typcn typcn-spanner"></i></li>
<li class="icons-list-item"><i class="typcn typcn-spiral" data-bs-toggle="tooltip" title="typcn typcn-spiral"></i></li>
<li class="icons-list-item"><i class="typcn typcn-star-full-outline" data-bs-toggle="tooltip" title="typcn typcn-star-full-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-star-half-outline" data-bs-toggle="tooltip" title="typcn typcn-star-half-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-star-half" data-bs-toggle="tooltip" title="typcn typcn-star-half"></i></li>
<li class="icons-list-item"><i class="typcn typcn-star-outline" data-bs-toggle="tooltip" title="typcn typcn-star-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-star" data-bs-toggle="tooltip" title="typcn typcn-star"></i></li>
<li class="icons-list-item"><i class="typcn typcn-starburst-outline" data-bs-toggle="tooltip" title="typcn typcn-starburst-outline"></i></li>
<li class="icons-list-item"><i class="typcn typcn-starburst" data-bs-toggle="tooltip" title="typcn typcn-starburst"></i></li>
<li class="icons-list-item"><i class="typcn typcn-stopwatch" data-bs-toggle="tooltip" title="typcn typcn-stopwatch"></i></li>
<li class="icons-list-item"><i class="typcn typcn-support" data-bs-toggle="tooltip" title="typcn typcn-support"></i></li>
<li class="icons-list-item"><i class="typcn typcn-tabs-outline" data-bs-toggle="tooltip" title="typcn typcn-tabs-outline"></i></li>
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