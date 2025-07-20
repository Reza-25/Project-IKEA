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
<title>RuangKu</title>

<link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.png">

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
                        <li class="<?= (['brandlist.php']) ?>">
                            <a href="../product/brandlist.php"class="<?= is_active(['brandlist.php']) ?>">Brand List</a>
                        </li>
                    </ul>
                </li>
                
                <!-- Supplier -->
                <li class="submenu <?= (['supplier.php']) ?>">
                    <a href="javascript:void(0);"><img src="../assets/img/icons/sales1.svg" alt="img" /><span> Supplier</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= (['supplier.php']) ?>"><a href="../supplier/supplier.php"class="<?= is_active(['supplier.php']) ?>">Supplier</a></li>
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
                        <li class="<?= (['suplierreturn.php']) ?>"><a href="../inventory/suplierreturn.php"class="<?= is_active(['supplierreturn.php']) ?>">Supplier Return</a></li>
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