<?php
// Pastikan BASE_URL sudah terdefinisi sebelumnya
if (!defined('BASE_URL')) {
    die('BASE_URL not defined. Please include config.php before this file.');
}

// Dapatkan nama file saat ini
$current_file = basename($_SERVER['PHP_SELF']);

// Fungsi untuk mengecek halaman aktif
function is_active($pages) {
    global $current_file;
    return in_array($current_file, (array)$pages) ? 'active' : '';
}
?>

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
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <!-- Dashboard -->
                <li class="<?= (['index.php']) ?>">
                    <a href="../Dashboard/index.php"><img src="../assets/img/icons/dashboard.svg" alt="img" /><span> Dashboard</span> </a>
                </li>
                
                <!-- Product -->
                <li class="submenu <?= (['productlist.php', 'categorylist.php', 'productlist.php', 'brandlist.php']) ?>">
                    <a href="javascript:void(0);">
                        <img src="../assets/img/icons/product.svg" alt="img" />
                        <span> Product</span> <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li class="<?= (['productsold.php']) ?>">
                            <a href="../product/productsold.php" class="<?=is_active(['productsold.php']) ?>">Product Sold</a>
                        </li>
                        <li class="<?= (['categorylist.php']) ?>">
                            <a href="../product/categorylist.php"class="<?=is_active(['categorylist.php']) ?>">Category List</a>
                        </li>
                        <li class="<?= (['productlist.php']) ?>">
                            <a href="../product/productlist.php"class="<?= is_active(['productlist.php']) ?>">Product List</a>
                        </li>
                        <li class="<?= (['brandlist.php']) ?>">
                            <a href="../product/brandlist.php"class="<?= is_active(['brandlist.php']) ?>">Brand List</a>
                        </li>
                    </ul>
                </li>
                
                <!-- Supplier -->
                <li class="submenu <?= (['supplier.php']) ?>">
                    <a href="javascript:void(0);"><img src="../assets/img/icons/sales1.svg" alt="img" /><span> Supplier</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= (['supplier.php']) ?>"><a href="../supplier/supplier.php"class="<?= is_active(['supplier.php']) ?>">Supplier List</a></li>
                    </ul>
                </li>
                
                <!-- Revenue -->
                <li class="submenu <?= (['revenue.php']) ?>">
                    <a href="javascript:void(0);"><img src="../assets/img/icons/purchase1.svg" alt="img" /><span> Revenue</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= (['revenue.php']) ?>"><a href="../revenue/revenue.php"class="<?= is_active(['revenue.php']) ?>">Revenue</a></li>
                    </ul>
                </li>
                
                <!-- Expense -->
                <li class="submenu <?= (['expenselist.php', 'createexpense.php', 'expensecategory.php']) ?>">
                    <a href="javascript:void(0);"><img src="../assets/img/icons/expense1.svg" alt="img" /><span> Expense</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= (['expensecategory.php']) ?>"><a href="../expense/expensecategory.php"class="<?= is_active(['expensecategory.php']) ?>">Expense</a></li>
                    </ul>
                </li>
                
                <!-- Inventory -->
                <li class="submenu <?= (['transferlist.php', 'suplierreturn.php', 'customerreturn.php']) ?>">
                    <a href="javascript:void(0);"><img src="../assets/img/icons/transfer1.svg" alt="img" /><span> Inventory</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= (['transferlist.php']) ?>"><a href="../inventory/transferlist.php"class="<?= is_active(['transferlist.php']) ?>">Transfer List</a></li>
                        <li class="<?= (['suplierreturn.php']) ?>"><a href="../inventory/suplierreturn.php"class="<?= is_active(['suplierreturn.php']) ?>">Supplier Return</a></li>
                        <li class="<?= (['customerreturn.php']) ?>"><a href="../inventory/customerreturn.php"class="<?= is_active(['customerreturn.php']) ?>">Customer Return</a></li>
                    </ul>
                </li>
                
                <!-- People -->
                <li class="submenu <?= (['managerslist.php', 'supplierlist.php', 'employeelist.php']) ?>">
                    <a href="javascript:void(0);"><img src="../assets/img/icons/users1.svg" alt="img" /><span> People</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= (['managerslist.php']) ?>"><a href="../people/managerslist.php"class="<?= is_active(['managerslist.php']) ?>">Manager List</a></li>
                        <li class="<?= (['supplierlist.php']) ?>"><a href="../people/supplierlist.php"class="<?= is_active(['supplierlist.php']) ?>">Supplier List</a></li>
                        <li class="<?= (['employeelist.php']) ?>"><a href="../people/employeelist.php"class="<?= is_active(['employeelist.php']) ?>">Employee List</a></li>
                    </ul>
                </li>
                
                <!-- Places -->
                <li class="submenu <?= (['newcountry.php', 'countrieslist.php', 'newstate.php', 'statelist.php']) ?>">
                    <a href="javascript:void(0);">
                        <img src="../assets/img/icons/places.svg" alt="img" />
                        <span> Location</span> <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li class="<?= (['countrieslist.php']) ?>">
                            <a href="../places/countrieslist.php" class="<?= is_active(['countrieslist.php']) ?>">Store Location</a>
                        </li>
                        <li class="<?= (['statelist.php']) ?>">
                            <a href="../places/statelist.php" class="<?= is_active(['statelist.php']) ?>">Inventory Location</a>
                        </li>
                    </ul>
                </li>
                
                <!-- Components -->
                <li class="<?= (['components.php']) ?>">
                    <a href="../components.php"><i data-feather="layers"></i><span> Components</span> </a>
                </li>
                
                <!-- Blank Page -->
                <li class="<?= (['blankpage.php']) ?>">
                    <a href="../blankpage.php"><i data-feather="file"></i><span> Blank Page</span> </a>
                </li>
                
                <!-- Error Pages -->
                <li class="submenu <?= (['error-404.php', 'error-500.php']) ?>">
                    <a href="javascript:void(0);"><i data-feather="alert-octagon"></i> <span> Error Pages </span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= (['error-404.php']) ?>"><a href="../error-404.php">404 Error </a></li>
                        <li class="<?= (['error-500.php']) ?>"><a href="../error-500.php">500 Error </a></li>
                    </ul>
                </li>
                
                <!-- Elements -->
                <li class="submenu <?= (['sweetalerts.php', 'tooltip.php', 'popover.php', 'ribbon.php', 'clipboard.php', 'drag-drop.php', 'rangeslider.php', 'rating.php', 'toastr.php', 'text-editor.php', 'counter.php', 'scrollbar.php', 'spinner.php', 'notification.php', 'lightbox.php', 'stickynote.php', 'timeline.php', 'form-wizard.php']) ?>">
                    <a href="javascript:void(0);"><i data-feather="box"></i> <span>Elements </span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= (['sweetalerts.php']) ?>"><a href="../sweetalerts.php">Sweet Alerts</a></li>
                        <li class="<?= (['tooltip.php']) ?>"><a href="../tooltip.php">Tooltip</a></li>
                        <li class="<?= (['popover.php']) ?>"><a href="../popover.php">Popover</a></li>
                        <li class="<?= (['ribbon.php']) ?>"><a href="../ribbon.php">Ribbon</a></li>
                        <li class="<?= (['clipboard.php']) ?>"><a href="../clipboard.php">Clipboard</a></li>
                        <li class="<?= (['drag-drop.php']) ?>"><a href="../drag-drop.php">Drag & Drop</a></li>
                        <li class="<?= (['rangeslider.php']) ?>"><a href="../rangeslider.php">Range Slider</a></li>
                        <li class="<?= (['rating.php']) ?>"><a href="../rating.php">Rating</a></li>
                        <li class="<?= (['toastr.php']) ?>"><a href="../toastr.php">Toastr</a></li>
                        <li class="<?= (['text-editor.php']) ?>"><a href="../text-editor.php">Text Editor</a></li>
                        <li class="<?= (['counter.php']) ?>"><a href="../counter.php">Counter</a></li>
                        <li class="<?= (['scrollbar.php']) ?>"><a href="../scrollbar.php">Scrollbar</a></li>
                        <li class="<?= (['spinner.php']) ?>"><a href="../spinner.php">Spinner</a></li>
                        <li class="<?= (['notification.php']) ?>"><a href="../notification.php">Notification</a></li>
                        <li class="<?= (['lightbox.php']) ?>"><a href="../lightbox.php">Lightbox</a></li>
                        <li class="<?= (['stickynote.php']) ?>"><a href="../stickynote.php">Sticky Note</a></li>
                        <li class="<?= (['timeline.php']) ?>"><a href="../timeline.php">Timeline</a></li>
                        <li class="<?= (['form-wizard.php']) ?>"><a href="../form-wizard.php">Form Wizard</a></li>
                    </ul>
                </li>
                
                <!-- Charts -->
                <li class="submenu <?= (['chart-apex.php', 'chart-js.php', 'chart-morris.php', 'chart-flot.php', 'chart-peity.php']) ?>">
                    <a href="javascript:void(0);"><i data-feather="bar-chart-2"></i> <span> Charts </span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= (['chart-apex.php']) ?>"><a href="../chart-apex.php">Apex Charts</a></li>
                        <li class="<?= (['chart-js.php']) ?>"><a href="../chart-js.php">Chart Js</a></li>
                        <li class="<?= (['chart-morris.php']) ?>"><a href="../chart-morris.php">Morris Charts</a></li>
                        <li class="<?= (['chart-flot.php']) ?>"><a href="../chart-flot.php">Flot Charts</a></li>
                        <li class="<?= (['chart-peity.php']) ?>"><a href="../chart-peity.php">Peity Charts</a></li>
                    </ul>
                </li>
                
                <!-- Icons -->
                <li class="submenu <?= (['icon-fontawesome.php', 'icon-feather.php', 'icon-ionic.php', 'icon-material.php', 'icon-pe7.php', 'icon-simpleline.php', 'icon-themify.php', 'icon-weather.php', 'icon-typicon.php', 'icon-flag.php']) ?>">
                    <a href="javascript:void(0);"><i data-feather="award"></i><span> Icons </span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= (['icon-fontawesome.php']) ?>"><a href="../icon-fontawesome.php">Fontawesome Icons</a></li>
                        <li class="<?= (['icon-feather.php']) ?>"><a href="../icon-feather.php">Feather Icons</a></li>
                        <li class="<?= (['icon-ionic.php']) ?>"><a href="../icon-ionic.php">Ionic Icons</a></li>
                        <li class="<?= (['icon-material.php']) ?>"><a href="../icon-material.php">Material Icons</a></li>
                        <li class="<?= (['icon-pe7.php']) ?>"><a href="../icon-pe7.php">Pe7 Icons</a></li>
                        <li class="<?= (['icon-simpleline.php']) ?>"><a href="../icon-simpleline.php">Simpleline Icons</a></li>
                        <li class="<?= (['icon-themify.php']) ?>"><a href="../icon-themify.php">Themify Icons</a></li>
                        <li class="<?= (['icon-weather.php']) ?>"><a href="../icon-weather.php">Weather Icons</a></li>
                        <li class="<?= (['icon-typicon.php']) ?>"><a href="../icon-typicon.php">Typicon Icons</a></li>
                        <li class="<?= (['icon-flag.php']) ?>"><a href="../icon-flag.php">Flag Icons</a></li>
                    </ul>
                </li>
                
                <!-- Forms -->
                <li class="submenu <?= (['form-basic-inputs.php', 'form-input-groups.php', 'form-horizontal.php', 'form-vertical.php', 'form-mask.php', 'form-validation.php', 'form-select2.php', 'form-fileupload.php']) ?>">
                    <a href="javascript:void(0);"><i data-feather="columns"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= (['form-basic-inputs.php']) ?>"><a href="../form-basic-inputs.php">Basic Inputs </a></li>
                        <li class="<?= (['form-input-groups.php']) ?>"><a href="../form-input-groups.php">Input Groups </a></li>
                        <li class="<?= (['form-horizontal.php']) ?>"><a href="../form-horizontal.php">Horizontal Form </a></li>
                        <li class="<?= (['form-vertical.php']) ?>"><a href="../form-vertical.php"> Vertical Form </a></li>
                        <li class="<?= (['form-mask.php']) ?>"><a href="../form-mask.php">Form Mask </a></li>
                        <li class="<?= (['form-validation.php']) ?>"><a href="../form-validation.php">Form Validation </a></li>
                        <li class="<?= (['form-select2.php']) ?>"><a href="../form-select2.php">Form Select2 </a></li>
                        <li class="<?= (['form-fileupload.php']) ?>"><a href="../form-fileupload.php">File Upload </a></li>
                    </ul>
                </li>
                
                <!-- Table -->
                <li class="submenu <?= (['tables-basic.php', 'data-tables.php']) ?>">
                    <a href="javascript:void(0);"><i data-feather="layout"></i> <span> Table </span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= (['tables-basic.php']) ?>"><a href="../tables-basic.php">Basic Tables </a></li>
                        <li class="<?= (['data-tables.php']) ?>"><a href="../data-tables.php">Data Table </a></li>
                    </ul>
                </li>
                
                <!-- Application -->
                <li class="submenu <?= (['chat.php', 'calendar.php', 'email.php']) ?>">
                    <a href="javascript:void(0);"><img src="../assets/img/icons/product.svg" alt="img" /><span> Application</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= (['chat.php']) ?>"><a href="../chat.php">Chat</a></li>
                        <li class="<?= (['calendar.php']) ?>"><a href="../calendar.php">Calendar</a></li>
                        <li class="<?= (['email.php']) ?>"><a href="../email.php">Email</a></li>
                    </ul>
                </li>
                
                <!-- Report -->
                <li class="submenu <?= (['purchaseorderreport.php', 'inventoryreport.php', 'salesreport.php', 'invoicereport.php', 'purchasereport.php', 'supplierreport.php', 'customerreport.php']) ?>">
                    <a href="javascript:void(0);"><img src="../assets/img/icons/time.svg" alt="img" /><span> Report</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= (['purchaseorderreport.php']) ?>"><a href="../purchaseorderreport.php">Purchase order report</a></li>
                        <li class="<?= (['inventoryreport.php']) ?>"><a href="../inventoryreport.php">Inventory Report</a></li>
                        <li class="<?= (['salesreport.php']) ?>"><a href="../salesreport.php">Sales Report</a></li>
                        <li class="<?= (['invoicereport.php']) ?>"><a href="../invoicereport.php">Invoice Report</a></li>
                        <li class="<?= (['purchasereport.php']) ?>"><a href="../purchasereport.php">Purchase Report</a></li>
                        <li class="<?= (['supplierreport.php']) ?>"><a href="../supplierreport.php">Supplier Report</a></li>
                        <li class="<?= (['customerreport.php']) ?>"><a href="../customerreport.php">Customer Report</a></li>
                    </ul>
                </li>
                
                <!-- Users -->
                <li class="submenu <?= (['newuser.php', 'userlists.php']) ?>">
                    <a href="javascript:void(0);"><img src="../assets/img/icons/users1.svg" alt="img" /><span> Users</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= (['newuser.php']) ?>"><a href="../newuser.php">New User </a></li>
                        <li class="<?= (['userlists.php']) ?>"><a href="../userlists.php">Users List</a></li>
                    </ul>
                </li>
                
                <!-- Settings -->
                <li class="submenu <?= (['generalsettings.php', 'emailsettings.php', 'paymentsettings.php', 'currencysettings.php', 'grouppermissions.php', 'taxrates.php']) ?>">
                    <a href="javascript:void(0);"><img src="../assets/img/icons/settings.svg" alt="img" /><span> Settings</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= (['generalsettings.php']) ?>"><a href="../generalsettings.php">General Settings</a></li>
                        <li class="<?= (['emailsettings.php']) ?>"><a href="../emailsettings.php">Email Settings</a></li>
                        <li class="<?= (['paymentsettings.php']) ?>"><a href="../paymentsettings.php">Payment Settings</a></li>
                        <li class="<?= (['currencysettings.php']) ?>"><a href="../currencysettings.php">Currency Settings</a></li>
                        <li class="<?= (['grouppermissions.php']) ?>"><a href="../grouppermissions.php">Group Permissions</a></li>
                        <li class="<?= (['taxrates.php']) ?>"><a href="../taxrates.php">Tax Rates</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/plugins/select2/js/select2.min.js"></script>

<script src="../assets/js/moment.min.js"></script>
<script src="../assets/js/bootstrap-datetimepicker.min.js"></script>

<script src="../assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="../assets/plugins/sweetalert/sweetalerts.min.js"></script>

<script src="../assets/js/script.js"></script>
</div>